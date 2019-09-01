<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of monitor
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author ADwairi
 * @author Hamzah
 * @author Laith
 */
class Proctor extends MX_Controller
{
    private $view_params = array();


    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('examination', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-list');


        $this->breadcrumbs->push(lang('Examination'), '/examination/question_bank');

        $this->view_params['menu_tab'] = 'examination';
        $this->view_params['type'] = 'proctor';


        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Students Attendance'),
            'type'=>'proctor',
            'icon' => 'fa fa-check-square-o',
            'menu_view' => 'sub_menu',
        ), true);

    }

    /** get exams by monitor and insert them in list
     * render list in list view
    */
    public function index() {

        $this->breadcrumbs->push(lang('Proctor'), '/examination/proctor');
        $user = Orm_User::get_logged_user();

        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));
        $fltr = $this->input->get_post('fltr');
        $filters = $fltr;

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $filters['type'] = Orm_Tst_Exam::TYPE_EXAM;
        $user_id = Orm_User::get_logged_user()->get_id();

        if(!Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
            $exam_ids =  Orm_Tst_Exam::get_exam_id_by_monitor($user_id);
            $filters['in_id']=  $exam_ids;
        }

        if($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){
            $filters['campus_in']=$user->get_college_obj()->get_campus_ids();
            $filters['college_id'] = $user->get_college_id();

        }

        if($user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)){
            $filters['campus_in']=$user->get_college_obj()->get_campus_ids();
            $filters['program_id'] = $user->get_program_id();

        }

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

        $exams =  Orm_Tst_Exam::get_all($filters,$page,$per_page, ['start desc']);

        $this->view_params['exams'] = $exams;
        $this->view_params['pager'] = $pager->render(true);

        $this->layout->view('examination/proctor/list', $this->view_params);
    }

    /** render list in window as ajax request
     * render it in view in ajax_list
    */
    public function ajax_list() {

        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));
        $fltr = $this->input->get_post('fltr');

        $filters = $fltr;


        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $filters['type'] = Orm_Tst_Exam::TYPE_EXAM;

        $user = Orm_User::get_logged_user()->get_id();

        if(!Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
            $exam_ids =  Orm_Tst_Exam::get_exam_id_by_monitor($user);
            $filters['in_id']=  $exam_ids;
        }

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

        $exams =  Orm_Tst_Exam::get_all($filters,$page,$per_page, ['start desc']);

        $this->view_params['exams'] = $exams;
        $this->view_params['pager'] = $pager->render(true);

        $this->load->view('examination/proctor/ajax_list', $this->view_params);
    }

    /** get student attendence depending on course section
     * render it in student_attendance
     */
    public function exam_student_attendance($exam_id = 0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $exam = Orm_Tst_Exam::get_instance($exam_id);

        if(!($exam && $exam->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }

        $fltr = $this->input->get_post('fltr');

        $filters = array();
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $filters['course_id'] = $exam->get_course_id();
        $filters['in_id'] = $exam->get_sections();
        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

        $course_sections = Orm_Course_Section::get_all($filters);

        $this->view_params['pager'] = ''; //$pager->render(true);

        $this->view_params['course_sections'] = $course_sections;
        $this->view_params['exam'] = $exam;

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Students Attendance'),
            'icon' => 'fa fa-check-square-o'
        ), true);

        $this->breadcrumbs->push(lang('Proctor'), '/examination/proctor');
        $this->breadcrumbs->push(lang('Students Attendance'), '/exam_student_attendance');
        $this->layout->view('examination/proctor/student_attendance', $this->view_params);

    }

    /** check if student is attending and set monitor of course and monitor id then save it
     * return json request
    */
    public function attend() {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if($this->input->method() == 'post') {
            $student_id = $this->input->post('student_id');
            $attend = $this->input->post('attend');
            $exam_id = $this->input->post('exam_id');
            if (!empty($student_id) && !empty($exam_id)) {
                $filters['student_id'] = $student_id;
                $filters['exam_id'] = $exam_id;
                $attend = Orm_Tst_Exam_Attendance::get_one($filters);
                if ($attend && $attend->get_id()){
                    if ($attend->delete()) {
                        json_response(
                            array('status' => true, 'absence' => false)
                        );
                    }

                }

                $attend->set_exam_id($exam_id);
                $attend->set_student_id($student_id);
                $attend->set_monitor_id(Orm_User::get_logged_user_id());
                if ($attend->save()) {
                    json_response(
                        array('status' => true, 'absence' => true)
                    );
                }
            }

        }
    }


}
