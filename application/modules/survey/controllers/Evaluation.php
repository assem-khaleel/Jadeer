<?php

/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 6/30/15
 * Time: 12:05 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Config $config
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * Class Evaluation
 */
class Evaluation extends MX_Controller
{

    private $view_params = array();
    private $logged_user = array();
    private $survey_obj = null;

    /**
     * Evaluation constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!License::get_instance()->check_module('survey', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->logged_user = Orm_User::get_logged_user();

        $survey_id = $this->input->get_post('survey_id');
        $this->survey_obj = Orm_Survey::get_instance($survey_id);

        if (!$this->survey_obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }
        if (Orm_Survey_Question::get_count(array('survey_id' => $survey_id)) <= 0) {
            Validator::set_error_flash_message(lang('Error: Please add 1 or more questions to the survey before continuing.'));
            redirect($this->input->server('HTTP_REFERER'));
        }
        if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_NOT_ADMIN) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $survey_type = Orm_Survey::get_survey_type($this->survey_obj->get_type());

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, "survey_{$survey_type}-evaluation");

        $this->view_params['survey'] = $this->survey_obj;
        $this->view_params['logged_user_id'] = $this->logged_user->get_id();

        $this->view_params['menu_tab'] = 'survey';

        $this->view_params['type'] = $this->survey_obj->get_type();

        $type = $this->survey_obj->get_type();

        $page_header = array(
            'title' => lang('Survey'),
            'icon' => 'fa fa-check-square',
            'menu_view' => 'survey/manager/sub_menu',
            'menu_params' => array('type' => $type)
        );

        if(intval($type) === Orm_Survey::TYPE_COURSES) {
            $page_header['link_attr'] = data_loading_text() . ' href="/survey/evaluation/launch_to_all_courses?survey_id=' . $this->survey_obj->get_id() . '"';
            $page_header['link_title'] = lang('Launch To All Courses');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);
    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {
        $per_page = $this->config->item('per_page');

        $page = (int)$this->input->get_post('page');
        $fltr = (array)$this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = is_array($fltr) ? $fltr : array();
        $filters['survey_id'] = $this->survey_obj->get_id();
        $filters['academic_year'] = Orm_Semester::get_active_semester()->get_year();

        if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() != Orm_Role::ROLE_INSTITUTION_ADMIN) {
            $filters['created_by'] = Orm_User::get_logged_user_id();
        }

        $items = Orm_Survey_Evaluation::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Survey_Evaluation::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['items'] = $items;
        $this->view_params['fltr'] = $fltr;

        $this->breadcrumbs->push(lang('Surveys'), "/survey?type={$this->survey_obj->get_type()}");
        $this->breadcrumbs->push(lang('Evaluation'), "/survey/evaluation?survey_id={$this->survey_obj->get_id()}");

        $this->layout->view('survey/evaluation/index', $this->view_params);
    }

    /**
     *this function create
     * @return string the html view
     */
    public function create()
    {
        $this->breadcrumbs->push(lang('Surveys'), "/survey?type={$this->survey_obj->get_type()}");
        $this->breadcrumbs->push(lang('Evaluation'), "/survey/evaluation?survey_id={$this->survey_obj->get_id()}");
        $this->breadcrumbs->push(lang('Create'), "/survey/evaluation/create?survey_id={$this->survey_obj->get_id()}");

        $this->layout->view('survey/evaluation/create_edit', $this->view_params);
    }

    /**
     * this function save
     *@redirect success or error
     */
    public function save()
    {
        $id = (int)$this->input->post('id');
        $description_english = $this->input->post('description_english');
        $description_arabic = $this->input->post('description_arabic');
        $date = $this->input->post('date');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
        $criteria = $this->input->post('fltr');
        $created_by = $this->logged_user->get_id();
        $semester_id = Orm_Semester::get_active_semester()->get_id();

        if (!is_array($criteria)) {
            $criteria = array();
        }

        Orm_User::get_logged_user()->get_filters($criteria);

        $evaluation = Orm_Survey_Evaluation::get_instance($id);
        $evaluation->set_description_english($description_english);
        $evaluation->set_description_arabic($description_arabic);
        $evaluation->set_start(strtotime($date . ' ' . $start_time));
        $evaluation->set_end(strtotime($date . ' ' . $end_time));

        Validator::required_field_validator('date', $date, lang('Please Enter date'));


        if (strtotime($date) < strtotime(date('Y-m-d'))) {
            Validator::set_error('date', lang('Date Must larger than current date'));
        }

        Validator::required_field_validator('start_time', $start_time, lang('Please Enter start time'));
        Validator::required_field_validator('end_time', $end_time, lang('Please Enter end time'));

        if (strtotime($end_time) <= strtotime($start_time)) {
            Validator::set_error('end_time', lang("End time Must be greater than start time"));
        }
        if (Validator::success()) {

            if(is_array($criteria) && $criteria) {
                $evaluation->set_criteria($criteria);
            }

            $evaluation->set_survey_id($this->survey_obj->get_id());
            $evaluation->set_created_by($created_by);
            $evaluation->set_semester_id($semester_id);
            $evaluation->save();

            $del_val = '';
            $filters = array_filter($criteria, function ($e) use ($del_val) {
                return ($e !== $del_val);
            });

            $filters['query_not_in_id'] = $evaluation->get_respondent_ids(true);
            $filters['encryption_key'] = $this->config->item('encryption_key');

            /** @var Orm_User[] $users */
            $users = array();
            switch ($this->survey_obj->get_type()) {
                case Orm_Survey::TYPE_ALUMNI :
                    $users = Orm_User_Alumni::get_all($filters);
                    break;

                case Orm_Survey::TYPE_EMPLOYER :
                    $users = Orm_User_Employer::get_all($filters);
                    break;

                case Orm_Survey::TYPE_FACULTY :
                    $users = Orm_User_Faculty::get_all($filters);
                    break;

                case Orm_Survey::TYPE_STAFF :
                    $users = Orm_User_Staff::get_all($filters);
                    break;

                case Orm_Survey::TYPE_STUDENTS :
                    $users = Orm_User_Student::get_all($filters);
                    break;

                case Orm_Survey::TYPE_COURSES :
                    $course_id = $evaluation->get_item_from_criteria('course_id');
                    if($course_id) {
                        $filters['course_id'] = $course_id;
                        $filters['semester_id'] = $semester_id;
                        $users = Orm_User_Student::get_all($filters);
                    }
                    break;
            }

            Orm_Survey_Evaluator::invite_bulk($evaluation, $users, false);

            Validator::set_success_flash_message(lang('Survey has been successfully launched.'));
            redirect('survey/evaluation?survey_id=' . $this->survey_obj->get_id());
        }

        $this->view_params['criteria'] = $criteria;

        if ($evaluation->get_id()) {
            $this->breadcrumbs->push(lang('Edit'));
        } else {
            $this->breadcrumbs->push(lang('Create'));
        }

        $this->view_params['id']                  = $evaluation->get_id();
        $this->view_params['survey_id']           = $evaluation->get_survey_id();
        $this->view_params['semester_id']         = $evaluation->get_semester_id();
        $this->view_params['description_english'] = $evaluation->get_description_english();
        $this->view_params['description_arabic']  = $evaluation->get_description_arabic();
        $this->view_params['created_by']          = $evaluation->get_created_by();
        $this->view_params['date_added']          = $evaluation->get_date_added();
        $this->view_params['date_modified']       = $evaluation->get_date_modified();
        $this->view_params['date']                = $evaluation->get_start_date();
        $this->view_params['time_start']          = $evaluation->get_start_time();
        $this->view_params['time_end']            = $evaluation->get_end_time();

        $this->layout->view('survey/evaluation/create_edit', $this->view_params);
    }

    /**
     * this function edit by its id
     * @param int $id the id of the edit to be viewed
     * @redirect success or error
     */
    public function edit($id)
    {
        $obj = Orm_Survey_Evaluation::get_instance($id);
        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }
        if ($this->logged_user->get_id() != $obj->get_created_by()) {
            if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() < Orm_User::get_instance($this->survey_obj->get_created_by())->get_role_obj()->get_admin_level()) {
                Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                redirect($this->input->server('HTTP_REFERER'));
            }
        }

        //fill last filters
        $_GET['fltr'] = $obj->get_criteria();

        $this->breadcrumbs->push(lang('Surveys'), "/survey?type={$this->survey_obj->get_type()}");
        $this->breadcrumbs->push(lang('Evaluation'), "/survey/evaluation?survey_id={$this->survey_obj->get_id()}");
        $this->breadcrumbs->push(lang('Edit'), "/survey/evaluation/create?survey_id={$this->survey_obj->get_id()}");

        $this->view_params['id'] = $obj->get_id();
        $this->view_params['survey_id'] = $obj->get_survey_id();
        $this->view_params['semester_id'] = $obj->get_semester_id();
        $this->view_params['description_english'] = $obj->get_description_english();
        $this->view_params['description_arabic'] = $obj->get_description_arabic();
        $this->view_params['created_by'] = $obj->get_created_by();
        $this->view_params['date_added'] = $obj->get_date_added();
        $this->view_params['date_modified'] = $obj->get_date_modified();
        $this->view_params['date'] = $obj->get_start_date();
        $this->view_params['time_start'] = $obj->get_start_time();
        $this->view_params['time_end'] = $obj->get_end_time();

        $this->layout->view('survey/evaluation/create_edit', $this->view_params);
    }

    /**
     * this function delete by its id
     * @param int $id the id of the delete to be viewed
     * @redirect success or error
     */
    public function delete($id)
    {
        $obj = Orm_Survey_Evaluation::get_instance($id);
        $obj->delete();

        Validator::set_success_flash_message(lang('Successfully Deleted'));
        redirect('survey/evaluation?survey_id=' . $this->survey_obj->get_id());
    }

    /**
     * this function preview by its id
     * @param int $id the id of the preview to be viewed
     * @return string the html view
     */
    public function preview($id)
    {
        $obj = Orm_Survey_Evaluation::get_instance($id);
        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $per_page = $this->config->item('per_page');

        $page = (int)$this->input->get_post('page');
        $fltr = (array)$this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = is_array($fltr) ? $fltr : array();
        $filters['survey_evaluation_id'] = $obj->get_id();

        $del_val = '';
        $filters = array_filter($filters, function ($e) use ($del_val) {
            return ($e !== $del_val);
        });

        Orm_User::get_logged_user()->get_filters($filters);
        $this->survey_obj->refine_filters($filters);
        
        $evaluators = Orm_Survey_Evaluator::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Survey_Evaluator::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['evaluators'] = $evaluators;
        $this->view_params['fltr'] = $fltr;
        $this->view_params['evaluation'] = $obj;

        $this->breadcrumbs->push(lang('Surveys'), "/survey?type={$this->survey_obj->get_type()}");
        $this->breadcrumbs->push(lang('Evaluation'), "/survey/evaluation?survey_id={$this->survey_obj->get_id()}");
        $this->breadcrumbs->push(lang('Preview'), "/survey/evaluation/preview/{$id}?survey_id={$this->survey_obj->get_id()}");

        $this->layout->view('survey/evaluation/preview', $this->view_params);
    }

    /**
     * this function remind by its id
     * @param int $id the id of the remind to be viewed
     * @return string the html view
     */
    public function remind($id)
    {
        $obj = Orm_Survey_Evaluation::get_instance($id);
        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $evaluators = Orm_Survey_Evaluator::get_all(array('survey_evaluation_id' => $id, 'response_status' => 0));

        $this->db->trans_start();
        foreach ($evaluators as $evaluator) {
            $evaluator->remind();
        }
        $this->db->trans_complete();

        Validator::set_success_flash_message(lang('Successfully Reminded'));
        redirect('survey/evaluation?survey_id=' . $this->survey_obj->get_id());

    }

    /**
     * this function evaluator delete by its id
     * @param int $id the id of the evaluator delete to be viewed
     * @redirect success or error
     */
    public function evaluator_delete($id)
    {
        $obj = Orm_Survey_Evaluator::get_instance($id);
        $obj->delete();

        Validator::set_success_flash_message(lang('Successfully Deleted'));
        redirect('survey/evaluation/preview/' . $obj->get_survey_evaluation_id() . '?survey_id=' . $this->survey_obj->get_id());
    }

    /**
     * this function evaluator remind by its id
     * @param int $id the id of the evaluator remind to be viewed
     * @return string the html view
     */
    public function evaluator_remind($id)
    {
        $obj = Orm_Survey_Evaluator::get_instance($id);
        if (!$obj->get_response_status()) {
            $obj->remind();
            Validator::set_success_flash_message(lang('Successfully Reminded'));
        } else {
            Validator::set_error_flash_message(lang('Error: Already Submit the Survey'));
        }

        redirect('survey/evaluation/preview/' . $obj->get_survey_evaluation_id() . '?survey_id=' . $this->survey_obj->get_id());
    }

    /**
     * this function launch to all courses by its
     * @redirect success or error
     */
    public function launch_to_all_courses() {

        if(intval($this->survey_obj->get_type()) === Orm_Survey::TYPE_COURSES) {

            ini_set('max_execution_time', 300); //300 seconds = 5 minutes

            $survey_id = $this->survey_obj->get_id();
            $semester_id = Orm_Semester::get_active_semester()->get_id();
            $created_by = $this->logged_user->get_id();

            foreach (Orm_Course::get_all(['have_student_in_semester_id' => $semester_id]) as $course) {

                $criteria = array('course_id' => $course->get_id());

                $evaluation = Orm_Survey_Evaluation::get_one(['survey_id' => $survey_id, 'semester_id' => $semester_id, 'criteria' => $criteria]);
                $evaluation->set_survey_id($survey_id);
                $evaluation->set_semester_id($semester_id);
                $evaluation->set_criteria($criteria);
                $evaluation->set_created_by($created_by);
                $evaluation->set_description_english($course->get_name_en());
                $evaluation->set_description_arabic($course->get_name_ar());
                $evaluation->save();

                $filters = array();
                $filters['query_not_in_id'] = $evaluation->get_respondent_ids(true);
                $filters['encryption_key'] = $this->config->item('encryption_key');
                $filters['course_id'] = $course->get_id();
                $filters['semester_id'] = $semester_id;

                $users = Orm_User_Student::get_all($filters);

                Orm_Survey_Evaluator::invite_bulk($evaluation, $users);
            }
        }

        Validator::set_success_flash_message(lang('Survey has been successfully launched.'));
        redirect('survey/evaluation?survey_id=' . $this->survey_obj->get_id());

    }
}
