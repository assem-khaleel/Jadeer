<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 25/07/18
 * Time: 11:32 ص
 */

class Program_report extends MX_Controller
{
    /**
     * View Params
     * @var array => the array pf data that will send to views
     */
    private $view_params = array();

    /**
     * Program_report constructor.
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
        $this->breadcrumbs->push(lang('Program Management'), '/report/program_report');

        $this->view_params['menu_tab'] = 'report';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Report') . ' - ' . lang('Program Management'),
            'icon' => 'fa fa-flag',
            'menu_view' => 'report/sub_menu',
            'menu_params' => array('type' => 'program')
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
     * check if the Module of Program Tree Active OR Not if Active then will return all data that need for report
     */

   private function get_obj(){
        if (!License::get_instance()->check_module('program_tree')) {
            show_404();
        }

        return   Modules::load('program_tree');
    }

    /**
     * check if the Module of Assessment Loop Active OR Not if Active then will return all data that need for report
     */

    private function get_al_loop(){
        if (!License::get_instance()->check_module('assessment_loop')) {
            show_404();
        }
        Modules::load('assessment_loop');
    }


    /**
     * This function will collecting all data that will appear on the main page of Reports even if called as ajax
     */
    private function get_list()
    {
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        Orm_User::get_logged_user()->get_filters($fltr);

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
            $filters['id'] = (int)$fltr['program_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $programs = Orm_Program::get_all($filters, $page, $per_page, array('p.department_id ASC', 'p.name_en ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_program::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['programs'] = $programs;
        $this->view_params['fltr'] = $fltr;
    }

    /**
     * Index function used  as the main function that show the data for Program Report
     */

    public function index()
    {
        $this->get_list();
        $this->layout->view('program_report/management', $this->view_params);
    }

    /**
     * filter will get a specific view for user when use the filter block will refresh the main view with the new data
     * if not will redirect for the page with the origin view
     */

    public function filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('program_report/data_table', $this->view_params);
        } else {
            $this->index();
        }
    }

    /**
     * show the reports page for the course after choosen < the parameter that will need is
     * $program_id => the id for program that we need to show all collected data for it
     * @param $program_id
     */
    public function view_reports($program_id)
    {
      $this->get_cm();

        $this->breadcrumbs->push(lang('View Report'), '/report/program_report/view_reports/'.$program_id);

        $this->view_params['program_id'] = $program_id;
        $this->view_params['plo_count'] = Orm_Cm_Program_Learning_Outcome::get_count(array('program_id'=>$program_id));
        $this->view_params['objective_counts'] = Orm_Program_Objective::get_count(array('program_id'=>$program_id));
        $this->layout->view('program_report/view', $this->view_params);

    }

    /**
     * IPMA Matrix for Program that show the relation between the program Learing Outocmes and the courses that are in the plan of program as (i => introduces , P => Practiced, M-=> Mastery, A=> Assessed ),
     *the parameter tis $program_id => the id of program that we need to show the ipma matrix for it  (need to check if Curriculum Mapping Module are active )
     * @param $program_id
     */
    public function ipamatrix($program_id)
    {
        $this->get_cm();

        $this->breadcrumbs->push(lang('View Report'), '/report/program_report/view_reports/'.$program_id);
        $this->breadcrumbs->push(lang('IPMA-Matrix'), '/report/program_report/ipamatrix/'.$program_id);

        $program_obj = Orm_Program::get_instance($program_id);

        if (!$program_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }


        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'link_attr' => 'href="/report/program_report/pdf/'.$program_id.'/ipamatrix"',
            'link_title' => lang('Download'),
        ), true);

        $this->view_params['program_id'] = $program_id;
        $this->layout->view('program_report/ipamatrix/list', $this->view_params);

    }

    /**
     * xmatrix function will show the relation between  PLO and Courses in the Plan of program(need to check if Curriculum Mapping Module are active )
     * $program_id => program id  that we need to show the matrix for if not send then will redirect to the main page and show error message that the parameter are not send
     * @param $program_id
     */

    public function xmatrix($program_id)
    {
        $this->get_cm();

        $this->breadcrumbs->push(lang('View Report'), '/report/program_report/view_reports/'.$program_id);
        $this->breadcrumbs->push(lang('X-Matrix'), '/report/program_report/xmatrix/'.$program_id);


        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'link_attr' => 'href="/report/program_report/pdf/'.$program_id.'/pxmatrix"',
            'link_title' => lang('Download'),
        ), true);

        $program_obj = Orm_Program::get_instance($program_id);

        if (!$program_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }

        $courses_ids = Orm_Program_Plan::get_all(array('program_id'=>$program_id));
        $plos = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id'=>$program_id));

        $this->view_params['program_id'] = $program_id;
        $this->view_params['program_obj'] = $program_obj;
        $this->view_params['courses_ids'] = $courses_ids;
        $this->view_params['plos'] = $plos;
        $this->layout->view('program_report/xmatrix/list', $this->view_params);

    }


    /**
     * show the assessment metrics for Program (Need to Activate Assessment Metrics Module)
     * Program ID that we need to show the assessment metrics for it if not exist will return to main page and sow error message that there are missing Parameter
     * @param $program_id
     */
    public function assessment_metric($program_id)
    {
        $this->get_am();


        $this->breadcrumbs->push(lang('View Report'), '/report/program_report/view_reports/'.$program_id);
        $this->breadcrumbs->push(lang('Assessment Metric'), '/report/program_report/assessment_metric/'.$program_id);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'link_attr' => 'href="/report/program_report/pdf/'.$program_id.'/assess_metric"',
            'link_title' => lang('Download'),
        ), true);

        $program_obj = Orm_Program::get_instance($program_id);

        if (!$program_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }
        $all_assessment_metric = Orm_Am_Assessment_Metric::get_all(['program_id'=>$program_id,'item_class'=>'Orm_Am_Assessment_Metric_Plo','semester_id'=>Orm_Semester::get_active_semester()->get_id()]);
        $this->view_params['all_assessment_metric'] = $all_assessment_metric;
        $this->view_params['program_id'] = $program_id;
        $this->layout->view('program_report/assessment_metric', $this->view_params);
    }


    /**
     * show the Assessment Metrics for Program Depends on the Objectives of Program (Assessment Metrics Module must be Active)
     * Program ID that we need to show the assessment metrics for it if not exist will return to main page and sow error message that there are missing Parameter
     * @param $program_id
     */
    public function obj_assessment_metric($program_id)
    {
        $this->get_am();


        $this->breadcrumbs->push(lang('View Report'), '/report/program_report/view_reports/'.$program_id);
        $this->breadcrumbs->push(lang('Assessment Metric'), '/report/program_report/obj_assessment_metric/'.$program_id);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'link_attr' => 'href="/report/program_report/pdf/'.$program_id.'/obj_assessment_metric"',
            'link_title' => lang('Download'),
        ), true);

        $program_obj = Orm_Program::get_instance($program_id);

        if (!$program_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }
        $all_assessment_metric = Orm_Am_Assessment_Metric::get_all(['program_id'=>$program_id,'item_class'=>'Orm_Am_Assessment_Metric_Objective','semester_id'=>Orm_Semester::get_active_semester()->get_id()]);
        $this->view_params['all_assessment_metric'] = $all_assessment_metric;
        $this->view_params['program_id'] = $program_id;
        $this->layout->view('program_report/assessment_metric', $this->view_params);
    }


    /**
     * Show the Relation between the Objectives and Program Learinig Outcomes (program Tree Must be Active)
     * Program ID that we need to show the Objectives for it if not exist will return to main page and sow error message that there are missing Parameter
     * @param $program_id
     */
    public function obj_xmatrix($program_id){
        $this->get_obj();
        $this->get_cm();

        $this->breadcrumbs->push(lang('View Report'), '/report/program_report/view_reports/'.$program_id);
        $this->breadcrumbs->push(lang('Objectives'), '/report/program_report/obj_xmatrix/'.$program_id);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'link_attr' => 'href="/report/program_report/pdf/'.$program_id.'/obj_matrix"',
            'link_title' => lang('Download'),
        ), true);


        $program_obj = Orm_Program::get_instance($program_id);

        if (!$program_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }

        $objectives = Orm_Program_Objective::get_all(array('program_id'=>$program_id));
        $plos = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id'=>$program_id));

        $this->view_params['program_id'] = $program_id;
        $this->view_params['program_obj'] = $program_obj;
        $this->view_params['objectives'] = $objectives;
        $this->view_params['plos'] = $plos;
        $this->layout->view('program_report/objective/list', $this->view_params);

    }


    /**
     * show the assessment Loop for program if it's created for Program Objective or PLO
     * Parameters that will use are
     * $item_id => program  id , $class_type choose if you need to show assessment loop for Objective "Orm_Al_Assessment_Loop_Objective", or for PLO  "Orm_Al_Assessment_Loop_Plo"
     * @param $item_id
     * @param $class_type
     *
     */
    public function assessment_loop($item_id, $class_type)
    {
        $this->get_al_loop();

        $this->breadcrumbs->push(lang('View Report'), '/report/program_report/view_reports/'.$item_id);



        $filters = array();
        $filters['semester_id']= Orm_Semester::get_active_semester()->get_id();
        switch ($class_type){
            case 'plo':
                $class = 'Orm_Al_Assessment_Loop_Plo';

                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/report/program_report/pdf/'.$item_id.'/assessment_loop_pl"',
                    'link_title' => lang('Download'),
                ), true);

                break;
            case 'objective':
                $class = 'Orm_Al_Assessment_Loop_Objective';

                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/report/program_report/pdf/'.$item_id.'/assessment_loop_obj"',
                    'link_title' => lang('Download'),
                ), true);

                break;
            default:
                redirect('');
        }

        $filters['item_class']= $class;
        $filters['item_type_id']= $item_id;

        $assessment_loops = Orm_Al_Assessment_Loop::get_all($filters);

        $this->view_params['item_id'] = $item_id;
        $this->view_params['class_type'] = $class_type;
        $this->view_params['assessment_loops'] = $assessment_loops;

        $this->layout->view('program_report/assessment_loop/list', $this->view_params);

    }

    /**
     * create a pdf version for the reports and Dowload it
     * the following Parameters will specified which report will Download
     * $item_id =>program Id , $string_type => which part of report you need to save for (assessment loop / Assessment Metrics , Program Tree "Objective", XMatrix / IPMA Matrix"
     * @param $item_id
     * @param string $type
     */
    public function pdf($item_id, $type = 'xmatrix'){

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'report-report');

        if (!$item_id) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }

        $data['item_id'] = $item_id;
        $data['type'] = $type;

        Orm_General_Report::pdf($data);

    }


}