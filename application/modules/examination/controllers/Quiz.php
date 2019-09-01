<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of quiz
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author ADwairi
 * @author Hamzah
 * @author Laith
 */
class Quiz extends MX_Controller
{
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('examination', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        if(Orm_User::check_credential([Orm_User::USER_STUDENT])){
            redirect('/examination/student_exam');
        }

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-list');

        $this->breadcrumbs->push(lang('Examination'), '/examination');
        $this->breadcrumbs->push(lang('Quiz'), '/examination/quiz');

        $this->view_params['menu_tab'] = 'examination';
        $this->view_params['type'] = 'quiz';
    }

    /** index page for quiz
     * render it in quiz/list view
    */
    public function index() {

        $user = Orm_User::get_logged_user();

        $fltr = $this->input->get_post('fltr');

        $filters = $fltr;

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

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

        $page_header_arr = [
            'title'     => lang('Quiz'),
            'icon'      => 'fa fa-file-text-o',
            'menu_view' => 'sub_menu',
            'type'      => 'quiz'
        ];


        if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')){
            $page_header_arr['link_attr'] = 'href="/examination/quiz/create_edit" data-toggle="ajaxModal"';
            $page_header_arr['link_icon'] = 'plus';
            $page_header_arr['link_title'] = lang('Create').' '.lang('Quiz');
        }


        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header_arr, true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        $page = $page?: 1;

        $filters['type'] = Orm_Tst_Exam::TYPE_QUIZ;

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tst_Exam::get_count($filters));

        $total_page = intval($pager->get_total_count()/$pager->get_per_page());
        $total_page += $pager->get_total_count()%$pager->get_per_page()?1:0;

        if($total_page < $page) {
            $page=1;
        }

        $page = $page?: 1;
        $pager->set_page($page);

        $quiz = Orm_Tst_Exam::get_all($filters, $page, $per_page, ['id desc']);

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['quiz'] = $quiz;
        $this->layout->view('quiz/list', $this->view_params);
    }

    /** get quizzes and render them in window as ajax
     * render it in quiz/ajax_list
    */
    public function ajax_list() {

        $user = Orm_User::get_logged_user();

        $fltr = $this->input->get_post('fltr');

        $filters = $fltr;

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

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

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        $page = $page?: 1;

        $filters['type'] = Orm_Tst_Exam::TYPE_QUIZ;

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tst_Exam::get_count($filters));

        $total_page = intval($pager->get_total_count()/$pager->get_per_page());
        $total_page += $pager->get_total_count()%$pager->get_per_page()?1:0;

        if($total_page < $page) {
            $page=1;
        }

        $page = $page?: 1;
        $pager->set_page($page);

        $quiz = Orm_Tst_Exam::get_all($filters, $page, $per_page, ['id desc']);

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['quiz'] = $quiz;
        $this->load->view('quiz/ajax_list', $this->view_params);
    }

    /**create or edit quiz after validate it
     * render it in create_edit view
    */
    public function create_edit($id = 0)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $quiz = Orm_Tst_Exam::get_instance($id);

        if($quiz && $quiz->get_id() && !$quiz->can_edit()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->view_params['quiz'] = $quiz;


        if($this->input->server('REQUEST_METHOD')=='POST'){

            $type        = Orm_Tst_Exam::TYPE_QUIZ;
            $name_en     = $this->input->post('name_en');
            $name_ar     = $this->input->post('name_ar');
            $course_id   = intval($this->input->post('course_id'));
            $full_mark   = intval($this->input->post('fullmark'));


            $quiz->set_name_en($name_en);
            $quiz->set_name_ar($name_ar);
            $quiz->set_type($type);
            $quiz->set_fullmark($full_mark);
            $quiz->set_semester_id(Orm_Semester::get_current_semester()->get_id());
            $quiz->set_teacher_id(Orm_User::get_logged_user_id());



            /* Validation start*/
            Validator::required_field_validator('name_en', $name_en, lang('Please Enter Name').' ( '.lang('English').' ) ');
            Validator::required_field_validator('name_ar', $name_ar, lang('Please Enter Name').' ( '.lang('Arabic').' ) ');

            Validator::required_field_validator('fullmark', $full_mark, lang('Please Enter mark'));
            Validator::numeric_field_validator('fullmark', $full_mark, lang('Mark must be a number'));
            Validator::integer_field_validator('fullmark', $full_mark, lang('Mark must be integer'));


            if(!$quiz->get_id()) {
                $quiz->set_course_id($course_id);
                Validator::not_empty_field_validator('course_id', $course_id, lang('Please Select course'));
            }

            /* Validation end*/

            if (Validator::success()) {
                $quiz->save();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['success'=>true]);
            }

            json_response([
                'success' => false,
                'html'    => $this->load->view('quiz/create_edit', $this->view_params, true)
            ]);
        }

        $this->load->view('quiz/create_edit', $this->view_params);
    }

    /** delete quiz and related object to it likeOrm_Tst_Exam_Monitors , Orm_Tst_Exam_Attachment ,Orm_Tst_Exam_Attendance ,Orm_Tst_Exam_Questions
    */
    public function delete($id=0)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect('/');
        }

        $obj = Orm_Tst_Exam::get_instance($id);

        if(!($obj && $obj->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            echo lang('The resource you requested does not exist!');
            exit;
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

            Validator::set_success_flash_message(lang('Quiz Removed Successfully'));

        }

    }

    /** if quiz already exist , start quiz by add start and end time for it
    */
    public function start($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect('/');
        }

        $quiz = Orm_Tst_Exam::get_instance($id);

        if(!($quiz && $quiz->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            echo lang('The resource you requested does not exist!');
            exit;
        }

        if ($quiz->get_id()) {

            $quiz->set_start(strtotime('-5minutes'));
            $quiz->set_end(strtotime('+2hours'));
            $quiz->save();

            Validator::set_success_flash_message(lang('Quiz has Started'));
        }
    }

    /** stop quiz if quiz has id
    */
    public function stop($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect('/');
        }

        $quiz = Orm_Tst_Exam::get_instance($id);

        if(!($quiz && $quiz->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            echo lang('The resource you requested does not exist!');
            exit;
        }

        if ($quiz->get_id()) {

            $quiz->set_end(time()-30);
            $quiz->save();

            Validator::set_success_flash_message(lang('Quiz has Stopped'));
        }

        if(!$this->input->is_ajax_request()){
            redirect('/examination/quiz');
        }

    }

    /** manage and save sections for quiz if user has authority for that
     *  render it in quiz/sections view
    */
    public function section_manage($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $quiz = Orm_Tst_Exam::get_instance($id);

        if(!($quiz && $quiz->get_id() && $quiz->get_semester_id()==Orm_Semester::get_current_semester()->get_id())) {
            echo error_dialog();
            exit;
        }

        $this->view_params['quiz'] = $quiz;

        if($this->input->server('REQUEST_METHOD')=='POST'){

            $sections = (array)$this->input->post('sections');

            $quiz->set_sections($sections);

            if (Validator::success()) {
                $quiz->save();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['success'=>true]);
            }

            json_response([
                'success' => false,
                'html'    => $this->load->view('quiz/sections', $this->view_params, true)
            ]);
        }

        $this->load->view('quiz/sections', $this->view_params);
    }

    /** manage function to see who has authorization to edit the question
     * render it in quiz/design view
    */
    public function manage($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $this->breadcrumbs->push(lang('Design'), '/examination/quiz/manage');

        $quiz = Orm_Tst_Exam::get_instance($id);

        if(!($quiz && $quiz->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }


        if(!$quiz->can_edit()) {
            Validator::set_error_flash_message(lang('You can not edit this quiz'));

            redirect('/');
        }

        $this->view_params['quiz'] = $quiz;
        $this->view_params['type'] = Orm_Tst_Exam::TYPE_QUIZ;

        $this->layout->view('quiz/design', $this->view_params);
    }

    /** add new question for quiz
     * render it in add_edit_question view
    */
    public function add_question($quiz_id=0, $full_mark=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $quiz1 = Orm_Tst_Exam::get_instance($quiz_id);

        if(!($quiz1 && $quiz1->get_id())){
            echo error_dialog();
            exit;
        }

        $questions = new Orm_Tst_Question();
        $quiz = new Orm_Tst_Exam_Questions();
        $this->view_params['question'] = $questions;
        $this->view_params['quiz'] = $quiz;
        $this->view_params['quiz_id'] = $quiz_id;
        $this->view_params['full_mark'] = $quiz1->get_fullmark();
        $this->load->view('quiz/question/add_edit_question', $this->view_params);
    }

    /** save question after validate it
     * back it as json response
    */
    public function save_question() {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }


        $id          = (int)$this->input->post('id');
        $quiz_id     = $this->input->post('quiz_id');
        $question_id = $this->input->post('question_id');
        $mark        = $this->input->post('mark');
        $full_mark   = $this->input->post('full_mark');

        /*Validation start*/

        Validator::not_empty_field_validator('question_id', $question_id, lang('Please Select Question'));

        Validator::required_field_validator('mark', $mark, lang('Please Enter a Mark for this question'));
        Validator::numeric_field_validator('mark', $mark, lang('Mark Must be a Number'));

        if($mark == 0){
            Validator::set_error('mark',lang('Mark must be larger than 0'));
        }


        if($id == 0 && Orm_Tst_Exam_Questions::get_one(['exam_id'=>$quiz_id,'question_id'=>$question_id])->get_id()){
            Validator::set_error('question_id',lang('Question already selected'));
        }

        $quiz_question = Orm_Tst_Question::get_instance($question_id);
        $quiz_marks = Orm_Tst_Exam::get_instance($quiz_id);

        if($mark > $quiz_marks->get_fullmark()){
            Validator::set_error('mark',lang('Mark must be less or equal to').' '. $quiz_marks->get_fullmark());
        }


        $avg = $mark + $quiz_marks->get_total_question_marks();
        if($avg > $quiz_marks->get_fullmark()){
            Validator::set_error('mark',lang('Total of marks for all question must be equal to').' '. $quiz_marks->get_fullmark());
        }

        /*Validation end*/
        $quiz = Orm_Tst_Exam_Questions::get_instance($id);
        $quiz->set_exam_id($quiz_id);
        $quiz->set_question_id($question_id);
        $quiz->set_mark($mark);


        if (Validator::success()) {
            $quiz->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));

            json_response(array('error' => false));
        }

        $this->view_params['question'] = $quiz_question;
        $this->view_params['quiz'] = $quiz;
        $this->view_params['quiz_id'] = $quiz_id;
        $this->view_params['full_mark'] = $full_mark;

        $html = $this->load->view('quiz/question/add_edit_question', $this->view_params, true);

        json_response(array('error' => true, 'html' => $html));

    }

    /** delete question if exist
     * redirect process to quiz/manage
    */
    public function remove_question($id=0, $quiz_id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $obj = Orm_Tst_Exam_Questions::get_instance($id);

        if(!($obj && $obj->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $obj->delete();

        Validator::set_success_flash_message(lang('Question Removed Successfully'), true);
        redirect('/examination/quiz/manage/' . $quiz_id);
    }

    /** find quiz depending on course id
     * render it in question/find view
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
        $filters['is_assignment'] = 0;
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

        $this->layout->set_layout('layout_blank')->view('quiz/question/find', $this->view_params);
    }

    /** view all list of quizzes
     * render it in quiz/view
    */
    public function view($id) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $this->breadcrumbs->push(lang('View'), '/examination/quiz/view');

        $quiz = Orm_Tst_Exam::get_instance($id);

        if(!($quiz && $quiz->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }

        $this->view_params['quiz'] = $quiz;
        $this->view_params['type'] = Orm_Tst_Exam::TYPE_QUIZ;

        $this->layout->view('quiz/view', $this->view_params);
    }
}
