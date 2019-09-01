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
class Assignments extends MX_Controller
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

        $this->breadcrumbs->push(lang('Examination'), '/examination');
        $this->breadcrumbs->push(lang('Assignments'), '/examination/assignments');


        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');

        $this->view_params['menu_tab'] = 'examination';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title'       => lang('Assignment'),
            'icon'        => 'fa fa-quora',
            'menu_view'   => 'examination/sub_menu',
            'menu_params' => array('type' => 'assignment')
        ), true);

    }

    /** render all assisnments from  Orm_Tst_Exam::TYPE_ASSIGNMENT
     * and render it in list view
    */
    public function index()
    {
        if (Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "examination-manage")) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'title'      => lang('Assignment'),
                'icon'       => 'fa fa-file-text-o',
                'link_attr'  => 'href="/examination/assignments/create_edit" data-toggle="ajaxModal"',
                'link_icon'  => 'plus',
                'link_title' => lang('Create').' '.lang('Assignment')
            ), true);
        }

        $this->view_params['type'] = 'assignment';

        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }


        $filters = $fltr;

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $user = Orm_User::get_logged_user();

        if ($user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['teacher_id'] = $user->get_id();
            $filters['monitor_id'] = $user->get_id();
        }

        if($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){
            $user_college = $user->get_college_id();
            $college_course = Orm_Course::get_all(['college_id' => $user_college, 'semester_id' => Orm_Semester::get_active_semester()->get_id()]);
            foreach ($college_course as $course){
                $filters['in_course_id'][]=  $course->get_id();
            }
        }

        if($user->has_role_type(Orm_Role::ROLE_DEPARTMENT_ADMIN)){
            $user_department = $user->get_department_id();
            $department_course = Orm_Course::get_all(['department_id' => $user_department, 'semester_id' => Orm_Semester::get_active_semester()->get_id()]);
            foreach ($department_course as $course){
                $filters['in_course_id'][]=  $course->get_id();
            }
        }

        if($user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)){
            $user_program = $user->get_program_id();
            $program_course = Orm_Course::get_all(['program_plan'=> '','program_id' => $user_program, 'semester_id' => Orm_Semester::get_active_semester()->get_id()]);
            foreach ($program_course as $course){
                $filters['in_course_id'][]=  $course->get_id();
            }
        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $filters['type'] = Orm_Tst_Exam::TYPE_ASSIGNMENT;

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

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

        $this->layout->view('examination/assignment/list', $this->view_params);
    }

    /** get ajax request and render assignment page in ajax window
    */
    public function ajax_list()
    {
        $this->view_params['type'] = 'assignment';

        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }


        $filters = $fltr;

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $user = Orm_User::get_logged_user();

        if ($user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['teacher_id'] = $user->get_id();
            $filters['monitor_id'] = $user->get_id();
        }

        if($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){
            $user_college = $user->get_college_id();
            $college_course = Orm_Course::get_all(['college_id' => $user_college, 'semester_id' => Orm_Semester::get_active_semester()->get_id()]);
            foreach ($college_course as $course){
                $filters['in_course_id'][]=  $course->get_id();
            }
        }

        if($user->has_role_type(Orm_Role::ROLE_DEPARTMENT_ADMIN)){
            $user_department = $user->get_department_id();
            $department_course = Orm_Course::get_all(['department_id' => $user_department, 'semester_id' => Orm_Semester::get_active_semester()->get_id()]);
            foreach ($department_course as $course){
                $filters['in_course_id'][]=  $course->get_id();
            }
        }

        if($user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)){
            $user_program = $user->get_program_id();
            $program_course = Orm_Course::get_all(['program_id' => $user_program, 'semester_id' => Orm_Semester::get_active_semester()->get_id()]);
            foreach ($program_course as $course){
                $filters['in_course_id'][]=  $course->get_id();
            }
        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $filters['type'] = Orm_Tst_Exam::TYPE_ASSIGNMENT;

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

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

        $this->load->view('examination/assignment/ajax_list', $this->view_params);
    }

    /** create or edit assignments and save it
     * back it as json response
    */
    public function create_edit($id = 0)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $assignment = Orm_Tst_Exam::get_instance($id);

        if($assignment && $assignment->get_id() && !$assignment->can_edit()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->view_params['assignment'] = $assignment;


        if($this->input->server('REQUEST_METHOD')=='POST') {
            $name_en   = $this->input->post('name_en');
            $name_ar   = $this->input->post('name_ar');
            $desc_en   = $this->input->post('desc_en');
            $desc_ar   = $this->input->post('desc_ar');
            $course_id = $this->input->post('course_id');
            $full_mark  = $this->input->post('fullmark');

            $assignment->set_name_en($name_en);
            $assignment->set_name_ar($name_ar);
            $assignment->set_desc_en($desc_en);
            $assignment->set_desc_ar($desc_ar);
            $assignment->set_fullmark($full_mark);
            $assignment->set_teacher_id(Orm_User::get_logged_user_id());
            $assignment->set_type(Orm_Tst_Exam::TYPE_ASSIGNMENT);
            $assignment->set_semester_id(Orm_Semester::get_current_semester()->get_id());


            /* Validation start*/
            Validator::required_field_validator('name_en', $name_en, lang('Please Enter Name') . ' ( ' . lang('English').' ) ');
            Validator::required_field_validator('name_ar', $name_ar, lang('Please Enter Name') . ' ( ' . lang('Arabic').' ) ');


            Validator::required_field_validator('fullmark', $full_mark, lang('Please Enter mark'));
            Validator::numeric_field_validator('fullmark', $full_mark, lang('Mark must be a number'));
            Validator::integer_field_validator('fullmark', $full_mark, lang('Mark must be integer'));

            if(!$assignment->get_id()) {
                $assignment->set_course_id($course_id);

                Validator::not_empty_field_validator('course_id', $course_id, lang('Please Select course'));
            }

            if (Validator::success()) {
                $assignment->save();
                $assignment->save_file();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['success' => true]);
            } else {
                json_response([
                    'success' => false,
                    'html' => $this->load->view('assignment/create_edit', $this->view_params, true)
                ]);
            }
        }

        $this->load->view('assignment/create_edit', $this->view_params);
    }

    /** delete object if there is assignment then will delete monitor obj , attachment obj
     * delete attendance , delete question if they related to exam
    */
    public function delete($id=0)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if(!$this->input->is_ajax_request()) {
            redirect('/');
        }

        $obj = Orm_Tst_Exam::get_instance($id);

        if(!($obj && $obj->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        if ($obj->get_id() && $obj->can_edit()) {
            if($obj->delete()){
                $monitors = Orm_Tst_Exam_Monitors::get_all(['exam_id'=>$id]);
                foreach ($monitors as $monitor) {
                    $monitor->delete();
                }

                $attachments = Orm_Tst_Exam_Attachment::get_all(['exam_id'=>$id]);
                foreach ($attachments as $attachment) {
                    $attachment->delete();
                }

                $attendance = Orm_Tst_Exam_Attendance::get_all(['exam_id'=>$id]);
                foreach ($attendance as $row) {
                    $row->delete();
                }

                $questions = Orm_Tst_Exam_Questions::get_all(['exam_id'=>$id]);
                foreach ($questions as $question) {
                    $question->delete();
                }
            }

            Validator::set_success_flash_message(lang('Assignment Removed Successfully'));

        }

    }


    /** manage assignments and check if users can edit it then change it
    */
    public function manage($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $assignment = Orm_Tst_Exam::get_instance($id);

        if(!($assignment && $assignment->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        if(!$assignment->can_edit()) {
            Validator::set_error_flash_message(lang('You can not edit this assignment'));

            redirect('/');
        }

        $this->breadcrumbs->push(lang('Design'), '/examination/assignments/manage');

        $this->view_params['assignment'] = $assignment;
        $this->view_params['type'] = Orm_Tst_Exam::TYPE_EXAM;

        $this->layout->view('assignment/design', $this->view_params);
    }


    /** publish assignments to users after finish fill it and put start start time and end time
    */
    public function publish($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $assignment = Orm_Tst_Exam::get_instance($id);

        if (!($assignment && $assignment->get_id())) {
            echo error_dialog();
            exit;
        }

        $this->view_params['assignment'] = $assignment;

        if($this->input->server('REQUEST_METHOD')=='POST'){

            $start_time  = $this->input->post('start');
            $end_time    = $this->input->post('end');

            $assignment->set_start(strtotime($start_time));
            $assignment->set_end(strtotime($end_time));

            Validator::required_field_validator('start', $start_time, lang('Please Enter start time'));
            Validator::required_field_validator('end',   $end_time,   lang('Please Enter end time'));

            if(strtotime($start_time) < strtotime(date('Y-m-d'))){
                Validator::set_error('start', lang('Date Must larger than current date'));
            }

            if(strtotime($end_time) <= strtotime($start_time)) {
                Validator::set_error('end', lang("End time Must be greater than start time"));
            }

            /* Validation end*/

            if (Validator::success() && $assignment && $assignment->get_id() && $assignment->can_edit(true)) {
                $assignment->save();

                Validator::set_success_flash_message(lang('Assignment has Published'));
                json_response(['success'=>true]);
            }

            json_response([
                'success' => false,
                'html'    => $this->load->view('assignment/publish', $this->view_params, true)
            ]);
        }

        $this->load->view('assignment/publish', $this->view_params);
    }

    /** unpublish assignment to set start and end time to 0
    */
    public function unpublish($id=0) {
        if(!$id){
            Validator::set_error_flash_message(lang('Operation not allowed'));
            redirect($this->config->item('root_url'));
        }

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $assignment = Orm_Tst_Exam::get_instance($id);

        if (!($assignment && $assignment->get_id())) {
            echo error_dialog();
            exit;
        }


        if($assignment && $assignment->get_id() && $assignment->can_edit()) {
            $assignment->set_start(0);
            $assignment->set_end(0);
            $assignment->save();

            Validator::set_success_flash_message(lang('Assignment has unpublished.'));
        } else {
            Validator::set_error_flash_message(lang('Assignment has answers.'));
        }

        if(!$this->input->is_ajax_request()){
            redirect('/examination/assignments');
        }
    }

    /** manage section of assignment  and save it
     * render it in section view
    */
    public function section_manage($id=0) {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $assignment = Orm_Tst_Exam::get_instance($id);

        if(!($assignment && $assignment->get_id() && !$assignment->check_end() && $assignment->get_semester_id()==Orm_Semester::get_current_semester()->get_id())) {
            echo error_dialog();
            exit;
        }

        $this->view_params['assignment'] = $assignment;

        if($this->input->server('REQUEST_METHOD')=='POST'){

            $sections = (array)$this->input->post('sections');

            $assignment->set_sections($sections);

            if (Validator::success()) {
                $assignment->save();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['success'=>true]);
            }

            json_response([
                'success' => false,
                'html'    => $this->load->view('assignment/sections', $this->view_params, true)
            ]);
        }

        $this->load->view('assignment/sections', $this->view_params);
    }

    /** add questions of assignments depending on Orm_Tst_Question object and Orm_Tst_Exam_Questions
     * render result in add_edit_question view
    */
    public function add_question($assignment_id=0)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $assignment = Orm_Tst_Exam::get_instance($assignment_id);

        if($assignment_id!=0 && (!$assignment->get_id() || !$assignment->can_edit())) {
            echo error_dialog();
            exit;
        }

        $questions = new Orm_Tst_Question();
        $exams = new Orm_Tst_Exam_Questions();
        $this->view_params['question'] = $questions;
        $this->view_params['exam'] = $exams;
        $this->view_params['exam_id'] = $assignment_id;

        $this->load->view('examination/assignment/question/add_edit_question', $this->view_params);
    }

    /** save question after validitaiong all fields and check exam mark less than full mark
     * back request  as json
    */
    public function save_question()
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }


        $id = (int)$this->input->post('id');
        $question_id = $this->input->post('question_id');
        $mark = $this->input->post('mark');
        $exam_id = $this->input->post('exam_id');
//        $full_mark = $this->input->post('full_mark');

        $exam = Orm_Tst_Exam_Questions::get_instance($id);
        $exam->set_exam_id($exam_id);
        $exam->set_question_id($question_id);
        $exam->set_mark($mark);

        /*Validation start*/

        Validator::not_empty_field_validator('question_id', $question_id, lang('Please Select Question'));
        Validator::required_field_validator('mark', $mark, lang('Please Enter a Mark for this question'));
        Validator::numeric_field_validator('mark', $mark, lang('Mark Must be a Number'));


        if($mark == 0){
            Validator::set_error('mark',lang('Mark must be larger than 0'));
        }

        if($id == 0 && Orm_Tst_Exam_Questions::get_one(['exam_id'=>$exam_id,'question_id'=>$question_id])->get_id()){
            Validator::set_error('question_id',lang('Question already selected'));
        }

        $exam_marks = Orm_Tst_Exam::get_instance($exam_id);

        if($mark > $exam_marks->get_fullmark()){
            Validator::set_error('mark',lang('mark Must be less or equal to'). $exam_marks->get_fullmark());
        }


        $avg = $mark + $exam_marks->get_total_question_marks();
        if($avg > $exam_marks->get_fullmark()){
            Validator::set_error('mark',lang('Total of marks for all question must be equal to'). $exam_marks->get_fullmark());
        }

        /*validation end*/

        if (Validator::success()) {
            $exam->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));

            json_response(array('error' => false));
        }


        $this->view_params['question'] = Orm_Tst_Question::get_instance($exam->get_question_id());
        $this->view_params['exam'] = $exam;
        $this->view_params['exam_id'] = $exam_id;

        $html = $this->load->view('examination/assignment/question/add_edit_question', $this->view_params, true);

        json_response(array('error' => true, 'html' => $html));

    }

    /** remove question if exist and redirect it to /examination/assignments/manage/
     * or / if dosn't exist
    */
    public function remove_question($id=0)
    {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $obj = Orm_Tst_Exam_Questions::get_instance($id);

        if(!($obj && $obj->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $exam_id = $obj->get_exam_id();
        $obj->delete();

        Validator::set_success_flash_message(lang('Question Removed Successfully'), true);

        if($exam_id) {
            redirect('/examination/assignments/manage/' . $exam_id);
        }

        Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
        redirect('/');
    }

    /** find quesion and type if question (public , private)
    */
    public function find()
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $course_id = $this->input->post_get('course_id');

        $per_page = 6;
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $filters['course_id'] = $course_id;
        $filters['is_assignment'] = 1;
        $filters['status'] = Orm_Tst_Question::STATUS_PUBLIC;
        $filters['or_my_status'] = Orm_Tst_Question::STATUS_PRIVATE;
        $questions = Orm_Tst_Question::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI'), 'num_elements' => 5));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tst_Question::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['questions'] = $questions;
        $this->view_params['fltr'] = $fltr;

        $this->layout->set_layout('layout_blank')->view('examination/assignment/question/find', $this->view_params);
    }

    /** view exam page and type if it (assignment)
     * render it in view_exam view
    */
    public function view_exam($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $assignment = Orm_Tst_Exam::get_instance($id);

        if(!($assignment && $assignment->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }

        $this->breadcrumbs->push(lang('View Assignment'), '/examination/view_exam');

        $this->view_params['exam'] = $assignment;
        $this->view_params['type'] = Orm_Tst_Exam::TYPE_ASSIGNMENT;

        $this->layout->view('examination/exam/view_exam', $this->view_params);
    }
}
