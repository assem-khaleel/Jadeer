<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Config $config
 * Class Ad_Survey
 */
class Ad_Survey extends MX_Controller
{


    private $view_params = array();
    private $logged_user;

    /**
     * Ad_Survey constructor.
     */
    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();

        if (!License::get_instance()->check_module('advisory', true)) {
            show_404();
        }

        $this->logged_user = Orm_User::get_logged_user();

        $this->view_params['menu_tab'] = 'advisory';

        $this->breadcrumbs->push(lang('Advisory Survey'), '/advisory/Ad_Survey');
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Advisory'),
            'icon' => 'fa fa-gift'
        ), true);

    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Advisory').' - '.lang('Survey'),
            'icon' => 'fa fa-gift'
        ), true);
        if (!Orm_Ad_Faculty_Program::map_survey()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }
        if (Orm_Ad_Faculty_Program::check_if_can_add() && Orm_Ad_Faculty_Program::can_add_survey()) {

            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'menu_view' => 'advisory/sub_menu',
                'menu_params' => array('type' => 'survey'),
                'link_attr' => 'href="/advisory/Ad_Survey/add_survey" data-toggle="ajaxModal"',
                'link_title' => lang('Add New'),
                'link_icon' => 'plus'
            ), true);
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');
        if (!$page) {
            $page = 1;
        }

        $filters = array('type' => Orm_Survey::TYPE_Advisory, 'created_by' => $this->logged_user->get_id());

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        Modules::load('survey');

        $surveys = Orm_Survey::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Survey::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['surveys'] = $surveys;
        $this->view_params['fltr'] = $fltr;


        $this->layout->view('survey/list', $this->view_params);

    }

    /**
     *this function init
     * @return string the calling function
     */
    private function init()
    {
        if (!Orm_Ad_Faculty_Program::map_survey()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'survey_advisory-manage');

        Modules::load('survey');

    }

    /**
     *this function add survey
     * @return string the html view
     */
    public function add_survey()
    {
        $this->init();


        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $survey = new Orm_Survey();

        $this->view_params['survey'] = $survey;
        $this->load->view('survey/add_edit', $this->view_params);
    }


    /**
     * this function edit survey by its id
     * @param int $id the id of the survey/add_edit to be viewed
     * @return string the html view
     */
    public function edit_survey($id)
    {
        $this->init();


        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $survey = Orm_Survey::get_instance($id);

        if ($survey->get_created_by() != $this->logged_user->get_id()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $this->view_params['survey'] = $survey;
        $this->load->view('survey/add_edit', $this->view_params);
    }

    /**
     * this function edit survey
     * @redirect success or error
     */
    public function save()
    {

        $this->init();


        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }


        $id = (int)$this->input->post('id');
        $title_en = $this->input->post('title_en');
        $title_ar = $this->input->post('title_ar');

        $survey = Orm_Survey::get_instance($id);

        Validator::required_field_validator('title_en', $title_en, lang('Please enter title') . ' ( ' . lang('English') . ' ) ');
        Validator::required_field_validator('title_ar', $title_ar, lang('Please enter title') . ' ( ' . lang('Arabic') . ' ) ');

        $survey->set_title_english($title_en);
        $survey->set_title_arabic($title_ar);
        $survey->set_created_by($this->logged_user->get_id());
        $survey->set_type(Orm_Survey::TYPE_Advisory);


        if (Validator::success()) {

            $survey->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['status' => true]);

        }

        $this->view_params['survey'] = $survey;
        json_response(['status' => false, 'html' => $this->load->view('survey/add_edit', $this->view_params, true)]);

    }

    /**
     * this function delete survey by its id
     * @param int $id the id of the survey to be viewed
     * @redirect success or error
     */
    public function delete_survey($id)
    {

        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $survey = Orm_Survey::get_instance($id);

        if ($survey->get_created_by() != $this->logged_user->get_id()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        if ($survey->get_id()) {
            $survey->delete();

            Validator::set_success_flash_message(lang('Successfully Deleted'), true);
            redirect('/advisory/Ad_Survey/');
        }

        Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
        redirect('/');

    }

    /**
     * this function get evaluation list by its survey_id
     * @param int $survey_id the survey id of the evaluation to be viewed
     * @return string the calling function
     */
    private function get_evaluation_list($survey_id)
    {

        if (Orm_Ad_Faculty_Program::check_if_can_add() && Orm_Ad_Faculty_Program::can_add_survey()) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/advisory/Ad_Survey/add_evaluation/' . $survey_id . '"',
                'link_title' => lang('Add New'),
                'link_icon' => 'plus'
            ), true);
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');
        if (!$page) {
            $page = 1;
        }

        $filters = array(
            'survey_id' => $survey_id,
            'created_by' => $this->logged_user->get_id(),
            'semester_id' => Orm_Semester::get_active_semester()->get_id()
        );

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }


        $surveys = Orm_Survey_Evaluation::get_all($filters, $page, $per_page);


        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Survey_Evaluation::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['survey_id'] = $survey_id;
        $this->view_params['evaluations'] = $surveys;
        $this->view_params['logged_user'] = Orm_User::get_logged_user()->get_id();
        $this->view_params['fltr'] = $fltr;
    }

    /**
     * this function evaluation by its survey_id
     * @param int $survey_id the survey id of the evaluation to be viewed
     * @return string the html view
     */
    public function evaluation($survey_id)
    {

        if (!Orm_Ad_Faculty_Program::map_survey()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        if (empty($survey_id) || $survey_id == 0) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, "survey_advisory-evaluation");

        Modules::load('survey');
        $this->breadcrumbs->push(lang('Survey Evaluation'), '/Ad_Survey/evaluation' . $survey_id);

        $this->get_evaluation_list($survey_id);


        $this->layout->view('survey/evaluation_list', $this->view_params);

    }

    /**
     * this function get evaluation permission
     * @return string the calling function
     */
    private function get_evaluation_permission()
    {

        if (!Orm_Ad_Faculty_Program::map_survey()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, "survey_advisory-evaluation");

        Modules::load('survey');
    }


    /**
     * this function add evaluation by its survey_id
     * @param int $survey_id the survey id of the survey/add_edit_evaluation to be viewed
     * @return string the html view
     */
    public function add_evaluation($survey_id)
    {

        $this->get_evaluation_permission();

        if (empty($survey_id) || $survey_id == 0) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }


        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Advisory'),
            'icon' => 'fa fa-gift'
        ), true);

        $this->breadcrumbs->push(lang('Create') . ' ' . lang('Survey Evaluation'), '/Ad_Survey/evaluation' . $survey_id);

        $this->view_params['survey_status'] = Orm_Ad_Survey::get_one(['faculty_id' => $this->logged_user->get_id(), 'survey_id' => $survey_id]);
        $this->view_params['survey_id'] = $survey_id;
        $this->view_params['evaluation'] = new Orm_Survey_Evaluation();

        $this->layout->view('survey/add_edit_evaluation', $this->view_params);

    }


    /**
     * this function edit evaluation by its survey_id and id
     * @param int $survey_id int $id the survey id  and id of the survey/add_edit_evaluation to be viewed
     * @return string the html view
     */
    public function edit_evaluation($survey_id, $id)
    {

        $this->get_evaluation_permission();

        if (empty($survey_id) || $survey_id == 0) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $evaluation = Orm_Survey_Evaluation::get_instance($id);

        if (!isset($id) && !$evaluation->get_id()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        if ($evaluation->get_created_by() != $this->logged_user->get_id()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }


        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Advisory'),
            'icon' => 'fa fa-gift'
        ), true);

        $this->breadcrumbs->push(lang('Edit') . ' ' . lang('Survey Evaluation'), '/Ad_Survey/evaluation' . $survey_id);

        $this->view_params['survey_status'] = Orm_Ad_Survey::get_one(['faculty_id' => $this->logged_user->get_id(), 'survey_id' => $survey_id]);
        $this->view_params['survey_id'] = $survey_id;
        $this->view_params['evaluation'] = $evaluation;

        $this->layout->view('survey/add_edit_evaluation', $this->view_params);

    }

    /**
     * this function delete by its survey_id and id
     * @param int $survey_id and int $id the id of the button to be viewed
     * @return string the html view
     */
    public function delete_evaluation($survey_id, $id)
    {

        $this->get_evaluation_permission();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }


        if (empty($survey_id) || $survey_id == 0) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $evaluation = Orm_Survey_Evaluation::get_instance($id);

        if (!isset($id) && !$evaluation->get_id()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        if ($evaluation->get_created_by() != $this->logged_user->get_id()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }


        if ($evaluation->get_id()) {
            $evaluation->delete();

            Validator::set_success_flash_message(lang('Successfully Deleted'), true);

            redirect('/advisory/Ad_Survey/evaluation/'.$survey_id);
        }

        Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
        redirect('/');

    }

    /**
     *this function save evaluation
     * @redirect success or error
     */
    public function save_evaluation()
    {

        $this->get_evaluation_permission();

        $id = (int)$this->input->post('id');
        $survey_id = (int)$this->input->post('survey_id');
        $desc_ar = $this->input->post('desc_ar');
        $desc_en = $this->input->post('desc_en');
        $status = $this->input->post('status');


        $evaluation = Orm_Survey_Evaluation::get_instance($id);

        Validator::required_field_validator('desc_ar', $desc_ar, lang('You must insert this Field'));
        Validator::required_field_validator('desc_en', $desc_en, lang('You must insert this Field'));
        Validator::required_field_validator('status', $status, lang('Required Fields Missing'));

        $evaluation->set_created_by($this->logged_user->get_id());
        $evaluation->set_survey_id($survey_id);
        $evaluation->set_semester_id(Orm_Semester::get_active_semester()->get_id());
        $evaluation->set_description_english($desc_en);
        $evaluation->set_description_arabic($desc_ar);


        $survey_status = Orm_Ad_Survey::get_one(['faculty_id' => $this->logged_user->get_id(), 'survey_id' => $survey_id]);
        $survey_status->set_survey_id($survey_id);
        $survey_status->set_faculty_id($this->logged_user->get_id());
        $survey_status->set_survey_status($status);


        if (Validator::success()) {

            $evaluation->save();

            $survey_status->save();


            if ($status == Orm_Ad_Survey::USER_CUSTOM_EVALUATION) {
                redirect('advisory/Ad_Survey/custom_evaluation/' . $evaluation->get_id());
            } else {
                $student_ids = array_column(Orm_Ad_Student_Faculty::get_model()->get_all(['faculty_id' => $this->logged_user->get_id()], 0, 0, [], Orm::FETCH_ARRAY), 'student_id');
                $students = Orm_User::get_all(['in_id' => $student_ids]);
                Orm_Survey_Evaluator::invite_bulk($evaluation, $students);
            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('advisory/Ad_Survey/evaluation/' . $survey_id);

        }


        $this->view_params['survey_status'] = $survey_status;
        $this->view_params['evaluation'] = $evaluation;
        $this->view_params['survey_id'] = $survey_id;

        $this->layout->view('survey/add_edit_evaluation', $this->view_params);

    }

    /**
     * this function edit evaluation by its survey_id and id
     * @param int $evaluation_id the evaluation id of the survey/custom_evaluation to be viewed
     * @return string the html view
     */
    public function custom_evaluation($evaluation_id)
    {

        $this->get_evaluation_permission();

        $fltr = $this->input->get_post('fltr');

        $filters = array('faculty_id' => $this->logged_user->get_id());

        if (!empty($fltr['keyword'])) {
            $filters['student_like'] = trim($fltr['keyword']);
        }


        $students = Orm_Ad_Student_Faculty::get_all($filters);
        $evaluators = array_column(Orm_Survey_Evaluator::get_model()->get_all(['survey_evaluation_id' => $evaluation_id], 0, 0, [], Orm::FETCH_ARRAY), 'user_id');

        $this->view_params['students'] = $students;
        $this->view_params['evaluators'] = $evaluators;
        $this->view_params['evaluation_id'] = $evaluation_id;
        $this->view_params['fltr'] = $fltr;
        $this->layout->view('survey/custom_evaluation', $this->view_params);
    }


    /**
     * this function save evaluator
     * @redirect success or error
     */
    public function save_evaluator()
    {

        $this->get_evaluation_permission();

        $evaluation_id = (int)$this->input->post('evaluation_id');
        $student_ids = $this->input->post('student_ids');

        $students = Orm_User::get_all(['in_id' => $student_ids]);
        $evaluation = Orm_Survey_Evaluation::get_instance($evaluation_id);

        Orm_Survey_Evaluator::invite_bulk($evaluation, $students);

        Validator::set_success_flash_message(lang('Successfully Saved'));
        redirect('advisory/Ad_Survey/evaluation/' . $evaluation->get_survey_id());

    }

    /**
     * this function preview by its evaluation id
     * @param int $evaluation_id the evaluation id of the survey/preview to be viewed
     * @return string the html view
     */
    public function preview($evaluation_id)
    {
        $this->get_evaluation_permission();


        $obj = Orm_Survey_Evaluation::get_instance($evaluation_id);
        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $this->breadcrumbs->push(lang('Survey Evaluation'), '/advisory/Ad_Survey/evaluation/' . $obj->get_survey_id());
        $this->breadcrumbs->push(lang('Preview'), '/advisory/Ad_Survey/preview/' . $evaluation_id);

        $per_page = $this->config->item('per_page');

        $page = (int)$this->input->get_post('page');
        $fltr = (array)$this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array('survey_evaluation_id' => $obj->get_id());

        $evaluators = Orm_Survey_Evaluator::get_all($filters, $page, $per_page);


        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Survey_Evaluator::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['evaluators'] = $evaluators;
        $this->view_params['fltr'] = $fltr;
        $this->view_params['evaluation'] = $obj;

        $this->layout->view('survey/preview', $this->view_params);

    }

    /**
     * this function remind by its evaluation id
     * @param int $evaluation_id the evaluation id of the remind to be viewed
     * @return string the html view
     */
    public function remind($evaluation_id)
    {
        $this->get_evaluation_permission();

        $obj = Orm_Survey_Evaluation::get_instance($evaluation_id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $evaluators = Orm_Survey_Evaluator::get_all(array('survey_evaluation_id' => $evaluation_id, 'response_status' => 0));

        $this->db->trans_start();
        foreach ($evaluators as $evaluator) {
            $evaluator->remind();
        }
        $this->db->trans_complete();

        Validator::set_success_flash_message(lang('Successfully Reminded'));

        redirect('advisory/Ad_Survey/evaluation/' . $obj->get_survey_id());

    }

    /**
     * this function evaluator delete by its id
     * @param int $id the id of the button to be viewed
     * @redirect success or error
     */
    public function evaluator_delete($id)
    {
        $this->get_evaluation_permission();

        $obj = Orm_Survey_Evaluator::get_instance($id);
        $obj->delete();

        Validator::set_success_flash_message(lang('Successfully Deleted'));
        redirect('advisory/Ad_Survey/evaluation/' . $obj->get_survey_evaluation_obj()->get_survey_id());
    }

    /**
     * this function evaluator remind by its id
     * @param int $id the id of the button to be viewed
     * @return string the html view
     */
    public function evaluator_remind($id)
    {
        $this->get_evaluation_permission();

        $obj = Orm_Survey_Evaluator::get_instance($id);
        if (!$obj->get_response_status()) {
            $obj->remind();
            Validator::set_success_flash_message(lang('Successfully Reminded'));
        } else {
            Validator::set_error_flash_message(lang('Error: Already Submit the Survey'));
        }

        redirect('advisory/Ad_Survey/preview/' . $obj->get_survey_evaluation_id() . '?survey_id=' . $obj->get_survey_evaluation_obj()->get_survey_id());
    }


}