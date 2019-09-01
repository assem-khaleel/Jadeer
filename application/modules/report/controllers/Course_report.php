<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 25/07/18
 * Time: 11:32 ص
 */

class Course_report extends MX_Controller
{
    /**
     * View Params
     * @var array => the array pf data that will send to views
     */

    private $view_params = array();

    /**
     * Course_report constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('report', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'report-list');

        $this->breadcrumbs->push(lang('Report'), '/report');
        $this->breadcrumbs->push(lang('Course Management'), '/report/course_report');

        $this->view_params['menu_tab'] = 'report';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Report') . ' - ' . lang('Course Management'),
            'icon' => 'fa fa-flag',
            'menu_view' => 'report/sub_menu',
            'menu_params' => array('type' => 'course')
        ), true);
    }


    /**
     * check if the Module of Curriculum Mapping Active OR Not if Active then will return all data that need for report
     */
    private function get_cm(){
        if (!License::get_instance()->check_module('curriculum_mapping')) {
            show_404();
        }

        return   Modules::load('curriculum_mapping');
    }

    /**
     * check if the Module of Assessment Metrics Active OR Not if Active then will return all data that need for report
     */
    private function get_am(){

        if(!License::get_instance()->check_module('assessment_metric', true)) {
            show_404();
        }

        return   Modules::load('assessment_metric');
    }

    /**
     * This function will get all data that will appear on the main page of Reports even if called as ajax
     */
    private function get_list(){

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        Orm_User::get_logged_user()->get_filters($fltr);

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if (Orm_User::has_role_teacher() && Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['in_id'] = Orm_Course_Section_Teacher::get_course_ids();
        } else {
            if (!empty($fltr['campus_id'])) {
                $filters['campus_id'] = intval($fltr['campus_id']);
            }
            if (!empty($fltr['college_id'])) {
                $filters['college_id'] = (int)$fltr['college_id'];
            }
            if (!empty($fltr['department_id'])) {
                $filters['department_id'] = (int)$fltr['department_id'];
            }
            if (!empty($fltr['program_id'])) {
                $filters['program_id'] = (int)$fltr['program_id'];
            }
        }

        if (!empty($filters['program_id'])) {
            $filters['program_plan'] = true;
        }

        $courses = Orm_Course::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['courses'] = $courses;
        $this->view_params['fltr'] = $fltr;
    }
    /**
     * Index function used  as the main function that show the data for Course Report
     */

    public function index(){

        $this->get_list();

        $this->layout->view('course_report/management', $this->view_params);

    }

    /**
     * filter will get a specific view for user when use the filter block will refresh the main view with the new data
     * if not will redirect for the page with the origin view
     */
    public function filter(){

        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('course_report/data_table', $this->view_params);
        } else {
            $this->index();
        }

    }

    /**
     * show the reports page for the course after choosen < the parameter that will need is
     * @param $course_id => course id that we need to show the final report for it
     */
    public function view_reports($course_id){

        $this->get_cm();

        $this->breadcrumbs->push(lang('View Report'), '/report/course_report/view_reports/'.$course_id);

        $this->view_params['course_id'] = $course_id;
        $this->view_params['clo_count'] = Orm_Cm_Course_Learning_Outcome::get_count(array('course_id'=>$course_id));
        $this->layout->view('course_report/view', $this->view_params);

    }

    /**
     * xmatrix function will show the relation between the course and program that offered in Curriculum Mapping Before (need to check if Curriculum Mapping Module are active )
     * course id that we need to show the matrix for if not send then will redirect to the main page and show error message that the parameter are not send
     * @param $course_id
     */
    public function xmatrix($course_id)
    {
        $this->get_cm();
        $this->breadcrumbs->push(lang('View Report'), '/report/course_report/view_reports/'.$course_id);
        $this->breadcrumbs->push(lang('X-Matrix'), '/report/course_report/xmatrix/'.$course_id);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'link_attr' => 'href="/report/course_report/pdf/'.$course_id.'/xmatrix"',
            'link_title' => lang('Download'),
        ), true);

        $course_obj = Orm_Course::get_instance($course_id);

        if (!$course_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }

        $programs = Orm_Program_Plan::get_all(array('course_id'=>$course_id,'semester_id'=>Orm_Semester::get_active_semester()->get_id()));
        $clos = Orm_Cm_Course_Learning_Outcome::get_all(array('course_id'=>$course_id));

        $this->view_params['course_id'] = $course_id;
        $this->view_params['course_obj'] = $course_obj;
        $this->view_params['programs'] = $programs;
        $this->view_params['clos'] = $clos;
        $this->layout->view('course_report/xmatrix/list', $this->view_params);

    }

    /**
     * show the assessment metrics for course (Need to Activate Assessment Metrics Module)
     * course ID that we need to show the assessment metrics for it if not exist will return to main page and sow error message that there are missing Parameter
     * @param $course_id
     */
    public function assessment_metric($course_id)
    {
        $this->get_am();


        $this->breadcrumbs->push(lang('View Report'), '/report/program_report/view_reports/'.$course_id);
        $this->breadcrumbs->push(lang('Assessment Metric'), '/report/course_report/assessment_metric/'.$course_id);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'link_attr' => 'href="/report/course_report/pdf/'.$course_id.'/course_assess_metric"',
            'link_title' => lang('Download'),
        ), true);

        $course_obj = Orm_Course::get_instance($course_id);

        if (!$course_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }

        $all_assessment_metric = Orm_Am_Assessment_Metric::get_all(['course_extra_data'=>$course_id,'item_class'=>'Orm_Am_Assessment_Metric_Clo','semester_id'=>Orm_Semester::get_active_semester()->get_id()]);
        $this->view_params['all_assessment_metric'] = $all_assessment_metric;
        $this->view_params['course_id'] = $course_id;
        $this->layout->view('course_report/assessment_metric', $this->view_params);
    }

    /**
     * generate Pdf function used to call the library of PDF and get data on< the parameters that we needs are the following
     * $item ID => the course id that we need to prepare the report for
     * $type the page that we need to prepare and it will be like (xmatrix, course_obj_assessment_metric ,etc
     * @param $item_id
     * @param string $type
     */
    public function pdf($item_id, $type = 'xmatrix')
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'report-report');

        if (!$item_id) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }

        $data['item_id'] = $item_id;
        $data['type'] = $type;

        Orm_General_Report::pdf($data);

    }

    /**
     * show assessment loop for the course, (Need To activate the Assessment Loop Module for it ), the following parameters are important to send with function
     * $item_id => course id
     * $class_type => the type of class that we need to get from assessment loop *here will be clo*
     * @param $item_id
     * @param $class_type
     */
    public function assessment_loop($item_id, $class_type)
    {
        if (!License::get_instance()->check_module('assessment_loop')) {
            show_404();
        }
       Modules::load('assessment_loop');
        $filters = array();
        $filters['semester_id']= Orm_Semester::get_active_semester()->get_id();
        if($class_type == 'clo'){
            $class = $class_type='Orm_Al_Assessment_Loop_Clo';
            $filters['item_class']= $class;
            $filters['course_extra_data']= $item_id;
        }else{
            redirect("/report");
        }

        $assessment_loops = Orm_Al_Assessment_Loop::get_all($filters);

        $this->view_params['item_id'] = $item_id;
        $this->view_params['assessment_loops'] = $assessment_loops;

        $this->layout->view('course_report/assessment_loop/list', $this->view_params);

    }

}