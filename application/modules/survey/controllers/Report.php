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
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Report
 */
class Report extends MX_Controller
{

    private $view_params = array();
    private $survey_obj = null;

    /**
     * Report constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!License::get_instance()->check_module('survey', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

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

        $survey_type = Orm_Survey::get_survey_type($this->survey_obj->get_type());

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, "survey_{$survey_type}-report");

        $this->breadcrumbs->push(lang('Surveys'), "/survey?type={$this->survey_obj->get_type()}");
        $this->breadcrumbs->push(lang('Report'), "/survey/report?survey_id={$survey_id}");

        $this->view_params['survey'] = $this->survey_obj;

        $this->view_params['menu_tab'] = 'survey';

        $type = $this->survey_obj->get_type();
        $this->layout->add_javascript('https://www.google.com/jsapi', false);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Survey'),
            'icon' => 'fa fa-check-square',
            'menu_view' => 'survey/manager/sub_menu',
            'menu_params' => array('type' => $type)
        ), true);

    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {
        $fltr = (array)$this->input->get_post('fltr');
        $filters = is_array($fltr) ? $fltr : array();

        $del_val = '';
        $filters = array_filter($filters, function ($e) use ($del_val) {
            return ($e !== $del_val);
        });

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        Orm_User::get_logged_user()->get_filters($filters);
        $this->survey_obj->refine_filters($filters);

        $this->view_params['filters'] = $filters;
        $this->view_params['draw_filters'] = true;

        $this->layout->view('survey/report/index', $this->view_params);
    }

    /**
     * this function evaluation by its evaluation id
     * @param int $evaluation_id the evaluation id of the preview to be viewed
     * @return string the html view
     */
    public function evaluation($evaluation_id)
    {

        $fltr = (array)$this->input->get_post('fltr');
        $filters = is_array($fltr) ? $fltr : array();
        $filters['evaluation_id'] = $evaluation_id;

        $del_val = '';
        $filters = array_filter($filters, function ($e) use ($del_val) {
            return ($e !== $del_val);
        });

        Orm_User::get_logged_user()->get_filters($filters);
        $this->survey_obj->refine_filters($filters);

        $this->view_params['filters'] = $filters;
        $this->view_params['draw_filters'] = true;

        $this->layout->view('survey/report/index', $this->view_params);
    }

    /**
     * this function evaluator by its evaluator id
     * @param int $evaluator_id the evaluator id of the preview to be viewed
     * @return string the html view
     */
    public function evaluator($evaluator_id)
    {
        $this->view_params['filters'] = array('survey_evaluator_id' => $evaluator_id);
        $this->layout->view('survey/report/index', $this->view_params);
    }

    /**
     * this function comments by its question id
     * @param int $question_id the question id of the comments to be viewed
     * @return string the html view
     */
    public function comments($question_id)
    {

        $question = Orm_Survey_Question::get_instance($question_id);
        if (!$question->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }
        if ($question->get_class_type() != 'Orm_Survey_Question_Type_Textarea') {
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
        $filters['question_id'] = $question_id;
        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

        $del_val = '';
        $filters = array_filter($filters, function ($e) use ($del_val) {
            return ($e !== $del_val);
        });

        $this->survey_obj->refine_filters($filters);
        $filters['not_empty'] = true;
        $items = Orm_Survey_User_Response_Text::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Survey_User_Response_Text::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['items'] = $items;
        $this->view_params['fltr'] = $fltr;

        $this->layout->view('survey/report/comments', $this->view_params);
    }

    /**
     * this function summary by its type
     * @param int $type the type of the summary to be viewed
     * @return string the html view
     */
    public function summary($type = Orm_Survey::SUMMARY_REPORT_ONE)
    {
        if (!Orm_Survey_Question_Statement::get_count(array('survey_id' => $this->survey_obj->get_id()))) {
            Validator::set_error_flash_message(lang('This survey does not have a "Factor and Statement" question type.'));
            if(!isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER']=='' ) {
                redirect('/survey?type=' . $this->survey_obj->get_type());
            }else{
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $fltr = (array)$this->input->get_post('fltr');
        $filters = is_array($fltr) ? $fltr : array();

        $del_val = '';
        $filters = array_filter($filters, function ($e) use ($del_val) {
            return ($e !== $del_val);
        });

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        Orm_User::get_logged_user()->get_filters($filters);
        $this->survey_obj->refine_filters($filters);

        $this->view_params['filters'] = $filters;
        $this->view_params['draw_filters'] = true;

        if ($type == Orm_Survey::SUMMARY_REPORT_ONE) {
            $this->layout->view('survey/report/summary', $this->view_params);
        } else {
            $this->layout->view('survey/report/summary_details', $this->view_params);
        }
    }
    /**
     * this function summary by its evaluation id
     * @param null $evaluation_id the evaluation id of the summary to be viewed
     * @return string the html view
     */
    public function details($evaluation_id = null)
    {
        if (!Orm_Survey_Question_Statement::get_count(array('survey_id' => $this->survey_obj->get_id()))) {
            Validator::set_error_flash_message(lang('This survey does not have a "Factor and Statement" question type.'));

            if(!isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER']=='' ) {
                redirect('/survey?type=' . $this->survey_obj->get_type());
            }else{
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $survey_type = Orm_Survey::get_survey_type($this->survey_obj->get_type());

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, "survey_{$survey_type}-report");

        $per_page = $this->config->item('per_page');

        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = is_array($fltr) ? $fltr : array();

        Orm_User::get_logged_user()->get_filters($filters);

        $this->survey_obj->refine_filters($filters);

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        $filters['response_status'] = 1;
        $filters['survey_id'] = $this->survey_obj->get_id();

        if(!is_null($evaluation_id)) {
            $filters['survey_evaluation_id'] = intval($evaluation_id);
        }

        $items = Orm_Survey_Evaluator::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Survey_Evaluator::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['items'] = $items;

        $this->layout->view('survey/report/details',$this->view_params);
    }

    /**
     * this function pdf
     * @return string the html view file pdf
     */
    public function pdf()
    {
        $fltr = (array)$this->input->get_post('fltr');
        $filters = is_array($fltr) ? $fltr : array();

        $del_val = '';
        $filters = array_filter($filters, function ($e) use ($del_val) {
            return ($e !== $del_val);
        });
        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        Orm_User::get_logged_user()->get_filters($filters);
        $this->survey_obj->refine_filters($filters);

        $filters['survey'] = $this->survey_obj;

        $this->survey_obj->generate_pdf($filters);
    }

    /**
     * this function csv
     * @return string the html view file csv
     */
    public function csv()
    {

        $fltr = (array)$this->input->get_post('fltr');
        $filters = is_array($fltr) ? $fltr : array();

        $del_val = '';
        $filters = array_filter($filters, function ($e) use ($del_val) {
            return ($e !== $del_val);
        });
        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        Orm_User::get_logged_user()->get_filters($filters);
        $this->survey_obj->refine_filters($filters);

        $filters['survey'] = $this->survey_obj;

        $this->survey_obj->generate_csv($filters);
    }

    /**
     * this function img
     * @return string the html view file img
     */
    public function img()
    {
        $fltr = (array)$this->input->get_post('fltr');
        $filters = is_array($fltr) ? $fltr : array();

        $del_val = '';
        $filters = array_filter($filters, function ($e) use ($del_val) {
            return ($e !== $del_val);
        });
        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        Orm_User::get_logged_user()->get_filters($filters);
        $this->survey_obj->refine_filters($filters);
        
        $this->survey_obj->generate_image($filters);
    }
}
