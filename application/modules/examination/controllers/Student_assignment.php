<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Assignment
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author ADwairi
 * @author Hamzah
 * @author Laith
 */
class Student_assignment extends MX_Controller
{
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('examination', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        Orm_User::check_permission(array(Orm_User::USER_STUDENT));

        $this->breadcrumbs->push(lang('Examination'), '/examination');
        $this->breadcrumbs->push(lang('Assignments'), '/examination/student_assignment');

        $this->view_params['menu_tab'] = 'examination';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title'       => lang('Assignment'),
            'icon'        => 'fa fa-file-text-o',
        ), true);
    }

    /** index page for student assignment depending on exam type
     * render it in student_assignment/list view
    */
    public function index()
    {
        $this->view_params['sub_menu'] = 'examination/student_sub_menu';
        $this->view_params['type'] = 'assignment';

        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));
        $fltr = $this->input->get_post('fltr');


        $filters = array();

        $filters['type'] = Orm_Tst_Exam::TYPE_ASSIGNMENT;

        if (Orm_User::get_logged_user() == Orm_User_Student::class) {
            $filters['student_id'] = Orm_User::get_logged_user()->get_id();
        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }


        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        $filters['in_course_id'] = Orm_Course_Section_Student::get_course_ids();


        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tst_Exam::get_count($filters));


        $total_page = intval($pager->get_total_count()/$pager->get_per_page());
        $total_page += $pager->get_total_count()%$pager->get_per_page()?1:0;

        if($total_page < $page) {
            $page=1;
        }

        $page = $page?: 1;
        $pager->set_page($page);

        $assignments = Orm_Tst_Exam::get_all($filters, $page, $per_page, ['id desc']);


        $this->view_params['pager'] = $pager->render(true);

        $this->view_params['assignments'] = $assignments;

        $this->layout->view('examination/student_assignment/list', $this->view_params);
    }

    /** save student response and assignment related to every question
    */
    public function save_question($assignment_id=0) {

        if($assignment_id==0){
            Validator::set_error_flash_message(lang('No assignment defined'));
            redirect("/examination/student_assignment");
        }


        $assignment = Orm_Tst_Exam::get_instance($assignment_id);

        if(!($assignment && $assignment->get_id()) || $assignment->get_end(true)<time()) {
            json_response(['success' => false]);
        }

        foreach($assignment->get_questions() as $question){
            $question->get_question_id(true)->save_user_response($assignment_id);
            $question->get_question_id(true)->save_user_attachment($assignment_id);
        }

        Validator::set_success_flash_message(lang('successfully Saved'));

        redirect("/examination/student_assignment");
    }

    /** page to view list of assignment s for evewy student
     * render it in student_assignment/start view
    */
    public function view_assignment($assignment_id=0) {


        $assignment = Orm_Tst_Exam::get_instance($assignment_id);

        if(!($assignment && $assignment->get_id()) || $assignment->get_end(true)<time()){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }

        $this->breadcrumbs->push(lang('View').': '.$assignment->get_name(), '/examination/student_assignment/view_assignment');


        if($attach = $assignment->get_attachment()) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => "href='{$attach}'",
                'link_icon' => 'download',
                'link_title' => lang('View File')
            ), true);
        }

        $this->view_params['assignment'] = $assignment;
        $this->layout->view('examination/student_assignment/start', $this->view_params);
    }

}