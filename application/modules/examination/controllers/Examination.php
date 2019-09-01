<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of examination
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author ADwairi
 * @author Hamzah
 * @author Laith
 */

class Examination extends MX_Controller
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

        $this->view_params['menu_tab'] = 'examination';
        $this->view_params['type'] = 'exam';
    }

    /** index page for examination to get all exams after checking permission of users
     * render it in list view
    */
    public function index() {

        $this->breadcrumbs->push(lang('Examination'), '/examination');

        $user = Orm_User::get_logged_user();

        $fltr = $this->input->get_post('fltr');

        $filters = $fltr;

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
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
            'title'     => lang('Exam'),
            'icon'      => 'fa fa-file-text-o',
            'menu_view' => 'examination/sub_menu',
            'type'      => 'exam'
        ];

        if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')){
            $page_header_arr['link_attr'] = 'href="/examination/create_edit" data-toggle="ajaxModal"';
            $page_header_arr['link_icon'] = 'plus';
            $page_header_arr['link_title'] = lang('Create').' '.lang('Exam');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header_arr, true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');


        $filters['type'] = Orm_Tst_Exam::TYPE_EXAM;

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

        $exams = Orm_Tst_Exam::get_all($filters, $page, $per_page, ['id desc']);

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['exams'] = $exams;
        $this->layout->view('exam/list', $this->view_params);
    }

     /** get all exams in window as ajax request
      * render them in ajax_list view
     */
     public function ajax_list()
    {
        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect('/');
        }

        $user = Orm_User::get_logged_user();

        $fltr = $this->input->get_post('fltr');
        $filters = $fltr;

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
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

        $filters['type'] = Orm_Tst_Exam::TYPE_EXAM;

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

        $exams = Orm_Tst_Exam::get_all($filters, $page, $per_page, ['id desc']);

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['exams'] = $exams;
        $this->load->view('exam/ajax_list', $this->view_params);

    }

    /** create or edit exam and if validate save it
     * render it in creaet_edit view
    */
    public function create_edit($id = 0)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $exam = Orm_Tst_Exam::get_instance($id);

        if($exam && $exam->get_id() && !$exam->can_edit()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->view_params['exam'] = $exam;


        if($this->input->server('REQUEST_METHOD')=='POST'){

            $name_en     = $this->input->post('name_en');
            $name_ar     = $this->input->post('name_ar');
            $course_id   = intval($this->input->post('course_id'));
            $full_mark   = intval($this->input->post('fullmark'));

            $exam->set_name_en($name_en);
            $exam->set_name_ar($name_ar);
            $exam->set_sections([]);
            $exam->set_type(Orm_Tst_Exam::TYPE_EXAM);
            $exam->set_fullmark($full_mark);
            $exam->set_semester_id(Orm_Semester::get_current_semester()->get_id());
            $exam->set_teacher_id(Orm_User::get_logged_user_id());



            /* Validation start*/
            Validator::required_field_validator('name_en', $name_en, lang('Please Enter Name').' ( '.lang('English').' ) ');
            Validator::required_field_validator('name_ar', $name_ar, lang('Please Enter Name').' ( '.lang('Arabic').' ) ');

            Validator::required_field_validator('fullmark', $full_mark, lang('Please Enter mark'));
            Validator::numeric_field_validator('fullmark', $full_mark, lang('Mark must be a number'));
            Validator::integer_field_validator('fullmark', $full_mark, lang('Mark must be integer'));
            Validator::less_than_validator('fullmark', intval($full_mark), 1, lang('Must Be Greater than 0'));

            if(!$exam->get_id()) {
                $exam->set_course_id($course_id);
                Validator::not_empty_field_validator('course_id', $course_id, lang('Please Select course'));
            }

            /* Validation end*/

            if (Validator::success()) {
                $exam->save();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['success'=>true]);
            }

            json_response([
                'success' => false,
                'html'    => $this->load->view('exam/create_edit', $this->view_params, true)
            ]);
        }

        $this->load->view('exam/create_edit', $this->view_params);
    }

    /** delete exam object and another related objects Orm_Tst_Exam_Monitors ,Orm_Tst_Exam_Attachment ,Orm_Tst_Exam_Attendance,Orm_Tst_Exam_Questions
    */
    public function delete($id)
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

                Validator::set_success_flash_message('Exam Removed Successfully');
            }
        }
    }

    /** set proctor for exam if monitor exist and get id
    */
    public function proctor_manage($id=0)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $exam = Orm_Tst_Exam::get_instance($id);

        if(!($exam && $exam->get_id() && !$exam->check_end() && $exam->get_semester_id()==Orm_Semester::get_current_semester()->get_id())) {
            echo error_dialog();
            exit;
        }

        $this->view_params['exam'] = $exam;

        $this->view_params['monitor_ids'] = $exam->get_monitor_ids();

        if($this->input->server('REQUEST_METHOD')=='POST'){

            $monitor_ids = (array)$this->input->post('monitor_ids');

            /* Validation start */

            Validator::required_array_validator('monitor_ids', $monitor_ids, lang('Please Select at least one Proctor'));

            foreach ($monitor_ids as $key => $monitor_id) {
                Validator::not_empty_field_validator('monitor_ids', $monitor_id, lang('Please Select Proctor'), $key);
            }

            $this->view_params['monitor_ids'] = $monitor_ids;

            /* Validation end */

            if (Validator::success()) {

                $monitor_ids = array_unique($monitor_ids);

                foreach ($monitor_ids as $monitor_id) {
                    $monitor = Orm_Tst_Exam_Monitors::get_one(['exam_id' => $exam->get_id(), 'monitor_id' => $monitor_id]);

                    if($monitor->get_id()) {
                        continue;
                    }

                    $monitor->set_exam_id($exam->get_id());
                    $monitor->set_monitor_id($monitor_id);
                    $monitor->save();
                }

                foreach ($exam->get_monitors() as $monitor) {
                    if(!in_array($monitor->get_monitor_id(), $monitor_ids)) {
                        $monitor->delete();
                    }
                }

                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['success'=>true]);
            }

            json_response([
                'success' => false,
                'html'    => $this->load->view('exam/proctor_manage', $this->view_params, true)
            ]);
        }

        $this->load->view('exam/proctor_manage', $this->view_params);
    }


    /** publish exam for students after validation it and set start time and end time
     * save it and return json request
    */
    public function publish($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $exam = Orm_Tst_Exam::get_instance($id);

        if (!($exam && $exam->get_id())) {
            echo error_dialog();
            exit;
        }


        $this->view_params['exam'] = $exam;

        if($this->input->server('REQUEST_METHOD')=='POST'){

            $method      = $this->input->post('method');
            $duration    = $this->input->post('duration');
            $date        = $this->input->post('date');
            $start_time  = $this->input->post('start_time');
            $end_time    = $this->input->post('end_time');

            $exam->set_start(strtotime($date . ' ' . $start_time));
            $exam->set_end(strtotime($date . ' ' . $end_time));

            $method= $method? $method: 1;

            /* Validation start*/

            if($method==1) {

                $exam->set_start(strtotime($date . ' ' . $start_time));
                $exam->set_end(strtotime($date . ' ' . $end_time));

                Validator::required_field_validator('date', $date, lang('Please Enter date'));


                if (strtotime($date) < strtotime(date('Y-m-d'))) {
                    Validator::set_error('date', lang('Date Must larger than current date'));
                }

                Validator::required_field_validator('start_time', $start_time, lang('Please Enter start time'));
                Validator::required_field_validator('end_time', $end_time, lang('Please Enter end time'));

                if (strtotime($end_time) <= strtotime($start_time)) {
                    Validator::set_error('end_time', lang("End time Must be greater than start time"));
                }
            }
            else {
                Validator::required_field_validator('duration', $end_time, lang('Please Enter duration time'));

                $duration = explode(':', $duration);
                $duration[0] = isset($duration[0]) ? $duration[0]: 0;
                $duration[1] = isset($duration[1]) ? $duration[1]: 0;
                $duration = (intval($duration[0])*60+intval($duration[1]))*60;


                Validator::less_than_validator('duration', $duration,300, lang('Duration time should not less than 5 minutes'));


                $exam->set_start(time());
                $exam->set_end(time()+$duration);

            }

            /* Validation end*/

            if (Validator::success() && $exam && $exam->get_id() && $exam->can_edit(true)) {
                $exam->save();

                Validator::set_success_flash_message(lang('Exam has Published'));
                json_response(['success'=>true]);
            }

            json_response([
                'success' => false,
                'html'    => $this->load->view('exam/publish', $this->view_params, true)
            ]);
        }

        $this->load->view('exam/publish', $this->view_params);
    }

    /**unpubis exam and set start time and end time to 0
    */
    public function unpublish($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $exam = Orm_Tst_Exam::get_instance($id);

        if (!($exam && $exam->get_id())) {
            echo error_dialog();
            exit;
        }

        if($exam && $exam->get_id() && $exam->can_edit(true)) {
            $exam->set_start(0);
            $exam->set_end(0);
            $exam->save();

            Validator::set_success_flash_message(lang('Exam has unpublished.'));
        } else {
            Validator::set_error_flash_message(lang('Exam has answers.'));
        }

        if(!$this->input->is_ajax_request()){
            redirect('/examination');
        }
    }

    /** manage section of exams
     * render it in sections view
    */
    public function section_manage($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $exam = Orm_Tst_Exam::get_instance($id);

        if(!($exam && $exam->get_id() && $exam->get_semester_id()==Orm_Semester::get_current_semester()->get_id())) {
            echo error_dialog();
            exit;
        }

        $this->view_params['exam'] = $exam;

        if($this->input->server('REQUEST_METHOD')=='POST'){

            $sections = (array)$this->input->post('sections');

            $exam->set_sections($sections);

            if (Validator::success()) {
                $exam->save();

                Validator::set_success_flash_message('Successfully Saved');
                json_response(['success'=>true]);
            }

            json_response([
                'success' => false,
                'html'    => $this->load->view('exam/sections', $this->view_params, true)
            ]);
        }

        $this->load->view('exam/sections', $this->view_params);
    }

    /** manage exam and check if can manage it or not
     * render it in design view
    */
    public function manage($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $exam = Orm_Tst_Exam::get_instance($id);

        if(!($exam && $exam->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }

        $this->breadcrumbs->push(lang('Examination'), '/examination');
        $this->breadcrumbs->push(lang('Design'), '/examination/manage');

        if(!$exam->can_edit()) {
            Validator::set_error_flash_message(lang('You can not edit this exam'));

            redirect('/examination');
        }

        $this->view_params['exam'] = $exam;
        $this->view_params['type'] = Orm_Tst_Exam::TYPE_EXAM;

        $this->layout->view('exam/design', $this->view_params);
    }

    /** add questions for exams \
     * render it in add_edit_questions
    */
    public function add_question($exam_id=0, $full_mark=0) {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $exam = Orm_Tst_Exam::get_instance($exam_id);

        if(!($exam && $exam->get_id())){
            echo error_dialog();
            exit;
        }


        $questions = new Orm_Tst_Question();
        $exams = new Orm_Tst_Exam_Questions();
        $this->view_params['question'] = $questions;
        $this->view_params['exam'] = $exams;
        $this->view_params['exam_id'] = $exam_id;
        $this->view_params['full_mark'] = $exam->get_fullmark();
        $this->load->view('exam/question/add_edit_question', $this->view_params);
    }

    /** save question after validation all requirments
    */
    public function save_question() {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }


        $id = (int)$this->input->post('id');
        $exam_id = $this->input->post('exam_id');
        $question_id = $this->input->post('question_id');
        $mark = intval($this->input->post('mark'));
//        $full_mark = $this->input->post('full_mark');

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

        $exam_question = Orm_Tst_Question::get_instance($question_id);
        $exam_marks = Orm_Tst_Exam::get_instance($exam_id);

        if($mark > $exam_marks->get_fullmark()){
            Validator::set_error('mark',lang('mark Must be less or equal to').' '. $exam_marks->get_fullmark());
        }

        $avg = $mark + $exam_marks->get_total_question_marks();
        if($avg > $exam_marks->get_fullmark()){
            Validator::set_error('mark',lang('Total of marks for all question must be equal to').' '. $exam_marks->get_fullmark());
        }

        /*Validation end*/
        $exam = Orm_Tst_Exam_Questions::get_instance($id);
        $exam->set_exam_id($exam_id);
        $exam->set_question_id($question_id);
        $exam->set_mark($mark);


        if (Validator::success()) {
            $exam->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));

            json_response(array('error' => false));
        }

        $this->view_params['question'] = $exam_question;
        $this->view_params['exam'] = $exam;
        $this->view_params['exam_id'] = $exam_id;
        $this->view_params['full_mark'] = $exam_marks->get_fullmark();

        $html = $this->load->view('exam/question/add_edit_question', $this->view_params, true);

        json_response(array('error' => true, 'html' => $html));

    }

    /** remove question of exam after validation
    */
    public function remove_question($id=0, $exam_id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $obj = Orm_Tst_Exam_Questions::get_instance($id);


        if(!($obj && $obj->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $exam = Orm_Tst_Exam_Questions::get_instance($id);

        if(!($exam && $exam->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $obj->delete();

        Validator::set_success_flash_message(lang('Question Removed Successfully'), true);
        redirect('/examination/manage/' . $exam_id);
    }

    /** find question related to the exam from exam questions bank
    */
    public function find()
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $course_id = $this->input->post_get('course_id');
        $question_id = $this->input->post_get('question_id');

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
        $filters['question_id'] = $question_id;
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

        $this->layout->set_layout('layout_blank')->view('exam/question/find', $this->view_params);
    }

    /** view exam page if exist
     * render it in view_exam view
    */
    public function view_exam($id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');


        $exam = Orm_Tst_Exam::get_instance($id);

        if(!($exam && $exam->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }

        $this->breadcrumbs->push(lang('Examination'), '/examination');
        $this->breadcrumbs->push(lang('View Exam'), '/examination/view_exam');

        $this->view_params['exam'] = $exam;
        $this->view_params['type'] = Orm_Tst_Exam::TYPE_EXAM;

        $this->layout->view('exam/view_exam', $this->view_params);
    }
}
