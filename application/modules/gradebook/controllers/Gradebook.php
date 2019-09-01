<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 5/1/17
 * Time: 9:42 AM
 */

class Gradebook extends MX_Controller {

    private $view_params = array();
    private $curriculum_obj = null;

    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('gradebook', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->breadcrumbs->push(lang('Gradebook'), '/gradebook');


        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Gradebook'),
            'icon' => 'fa fa-bookmark-o'
        ), true);
        $this->view_params['menu_tab'] = 'gradebook';
    }

    /** filter courses and get list
     * get all courses depending on active semester and many filters
    */

    private function get_list() {
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

    /** gradebook index page
     *   get list from above function and rendering it in list view
    */
    public function index()
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'gradebook-list');

        $this->get_list();

        $this->layout->view('gradebook/list', $this->view_params);
    }

    /** filter function for ajax
     * if request is ajax redirect it to data table else that redirect to index function
     *
    */
    public function filter() {
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('gradebook/data_table', $this->view_params);
        } else {
            $this->index();
        }
    }

    /** view sections of courses
     * get all sections of courses and filter them depending course_id and active semester
     *
    */

    public function view_sections($course_id=0){
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'gradebook-list');

        $course = Orm_Course::get_instance($course_id);

        if(!($course && $course->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array('course_id' => $course_id,'semester_id'=>Orm_Semester::get_active_semester()->get_id());

        if (!empty($fltr['semester_id'])) {
            $filters['semester_id'] = (int)$fltr['semester_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $sections = Orm_Course_Section::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course_Section::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['sections'] = $sections;
        $this->view_params['course_id'] = $course_id;
        $this->view_params['fltr'] = $fltr;

        $this->breadcrumbs->push(lang('View').' '.lang('Sections'), '/view_sections');

        $this->layout->view('gradebook/view_sections', $this->view_params);
    }


    /** get all question related to section
      * get all students related to the specific section and get all questions related to this section
     */

    private function get_student_list_curriculum($section_id, $method_id){

        if (License::get_instance()->check_module('curriculum_mapping', true)){
            Modules::load('curriculum_mapping',true);
        }
        else {
            json_response(['success'=>false, 'msg'=>lang('Permissions Denied')]);
            redirect('/');
        }

        $section_obj = Orm_Course_Section::get_instance($section_id);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array(
            'section_id' => $section_id
        );

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $map_question = Orm_Cm_Section_Mapping_Question::get_one(['course_assessment_method_id'=>$method_id, 'section_id'=>$section_id]);

        if($map_question && $map_question->get_id() && Orm_Cm_Section_Student_Assessment::get_count(['section_mapping_question_id' => $map_question->get_id()])) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'icon' => 'fa fa-file-text-o',
                'link_attr' => 'href="/gradebook/method_report/' . $section_id . '/' . $method_id . '"',
                'link_title' => lang('Report')
            ), true);
        }

        $students = Orm_Course_Section_Student::get_all($filters, $page, $per_page);

        $assessment_method = Orm_Cm_Course_Assessment_Method::get_all(['course_id'=>$section_obj->get_course_id()]);
        $questions = Orm_Cm_Section_Mapping_Question::get_all(['section_id'=>$section_id,'course_assessment_method_id'=>$method_id]);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course_Section_Student::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['section_id'] = $section_id;
        $this->view_params['method_id'] = $method_id;
        $this->view_params['section'] = $section_obj;
        $this->view_params['students'] = $students;
        $this->view_params['assessment_method'] = $assessment_method;
        $this->view_params['questions'] = $questions;

        $this->layout->view('gradebook/view_students_curriculum', $this->view_params);
    }

    /** curriculum csv
     * generate csv page depending on section id and program assessment method
    */
    public function curriculum_csv($section_id,$method_id)
    {
        if (License::get_instance()->check_module('curriculum_mapping', true)){
            Modules::load('curriculum_mapping',true);
        }
        $this->curriculum_obj = Orm_Cm_Course_Assessment_Method::get_instance($section_id);
        $this->curriculum_obj->generate_csv($section_id,$method_id);
    }

    /** curriculum csv
     * generate csv page depending on section id and program assessment method
     */
    public function examination_csv($section_id,$row_id)
    {
        if (License::get_instance()->check_module('examination', true)){
            Modules::load('examination',true);
        }
        if (License::get_instance()->check_module('curriculum_mapping', true)){
            Modules::load('curriculum_mapping',true);
        }
        $this->examination_obj = Orm_Cm_Course_Assessment_Method::get_instance($section_id);
        $this->examination_obj->generate_examination_csv($section_id,$row_id);
    }

    /** student list related to examination
     *  get all examinations and tests from examination module related to the students related in one section for course
     */
    private function get_student_list_examination($section_id, $exam_id){

        if (License::get_instance()->check_module('examination', true)){
            Modules::load('examination',true);
        }
        else {
            json_response(['success'=>false, 'msg'=>lang('Permissions Denied')]);
            redirect('/');
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        if($exam_id) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'icon' => 'fa fa-file-text-o',
                'link_attr' => 'href="/gradebook/exam_report/' . $section_id . '/' . $exam_id . '"',
                'link_title' => lang('Report')
            ), true);
        }

        $this->view_params['exams']    = Orm_Tst_Exam::get_all(['section_id'=>$section_id, 'end_greater_than' => 1], 0, 0, ['type']);
        $this->view_params['exam']     = Orm_Tst_Exam::get_instance($exam_id);
        $this->view_params['section']  = Orm_Course_Section::get_instance($section_id);
        $this->view_params['students'] = Orm_Course_Section_Student::get_all(['section_id' => $section_id], $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course_Section_Student::get_count(['section_id' => $section_id]));

        $this->view_params['pager'] = $pager->render(true);

        $this->layout->view('gradebook/view_students_examination', $this->view_params);
    }

    /** view student page related to examintion or curriculum
     * users who can see list of students depending their permissions to access these two modules
    */

    public function view_students($type='curriculum', $section_id, $view_id=0)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'gradebook-manage');

        $section_obj = Orm_Course_Section::get_instance($section_id);

        if(!$section_obj->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->breadcrumbs->push(lang('View').' '.lang('Sections'), '/gradebook/view_sections/'.$section_obj->get_course_id());
        $this->breadcrumbs->push(lang('View').' '.lang('Student'), "/gradebook/view_students/{$type}/{$section_id}/$view_id");

        $this->view_params['page_header'] = $this->load->view('/common/page_header', [
            'title'       => lang('Gradebook'),
            'icon'        => 'fa fa-bookmark-o',
            'menu_view'   => 'sub_menu',
            'menu_params' => ['type' => $type, 'section_id'=> $section_id]
        ], true);

        if($type=='curriculum' && License::get_instance()->check_module('curriculum_mapping', true)) {
            $this->get_student_list_curriculum($section_id, $view_id);
        }
        elseif(License::get_instance()->check_module('examination', true)) {
            $this->get_student_list_examination($section_id, $view_id);
        }
        else {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect('/');
        }
    }

    /** get score for students
     * loading curriculum module and get section of course then calculate score of students with full mark and save it in database
    */
    public function save_student_score($section_id=0) {

        if (!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('No direct script access allowed'), true);
            redirect('/');
        }

        if(!Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'gradebook-manage')){
            json_response(['success'=>false, 'msg'=>lang('Permissions Denied')]);
        }

        if (License::get_instance()->check_module('curriculum_mapping', true)){
            Modules::load('curriculum_mapping',true);
        }
        else {
            json_response(['success'=>false, 'msg'=>lang('Permissions Denied')]);
            redirect('/');
        }

        $section = Orm_Course_Section::get_instance($section_id);


        if(!($section && $section->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $all_scores = $this->input->post('scores');
        $full_marks = $this->input->post('q_full_marks');

        if($all_scores){

            foreach ($all_scores as $student_id => $questions){
                foreach ($questions as $question_id => $scores){
                    foreach ($scores as $score_id => $score){

                        $validator_name = 'scores_'.$student_id.'_'.$question_id.'_'.$score_id;

                        Validator::less_than_validator($validator_name, $score, 0, lang('Score Must be Greater than 0'));
                        Validator::greater_than_validator($validator_name, $score, $full_marks[$question_id], lang('Score must be less than').' '.$full_marks[$question_id]);
                    }
                }
            }


            if(Validator::success()) {

                foreach ($all_scores as $student_id => $questions){
                    foreach ($questions as $question_id => $scores){
                        foreach ($scores as $score_id => $score){

                            $obj = Orm_Cm_Section_Student_Assessment::get_instance($score_id);
                            $obj->set_section_id($section_id);
                            $obj->set_section_mapping_question_id($question_id);
                            $obj->set_student_id($student_id);
                            $obj->set_score($score);
                            $obj->save();
                        }
                    }
                }
                Validator::set_success_flash_message(lang('Student Score Successfully Saved'));
                json_response(['success'=>true]);
//                json_response(['success'=>true, 'msg'=>lang('Student Score Successfully Saved') ]);
            }
            else{
                json_response(['success'=>false, 'errors'=>Validator::get_errors()]);
            }
        }
    }


    /** draw charts of reports for every exam
     * get all quizes and assignments and draw them depending on the result of students in them
    */
    public function exam_report($section_id, $exam_id) {

        if (License::get_instance()->check_module('examination', true)){
            Modules::load('examination',true);
        }
        else {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect('/');
        }

        $exam = Orm_Tst_Exam::get_instance($exam_id);

        if(!($exam && $exam->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->breadcrumbs->push(lang('View').' '.lang('Student'), "/gradebook/view_students/examination/{$section_id}");

        switch ($exam->get_type()) {
            case Orm_Tst_Exam::TYPE_QUIZ:
                $this->breadcrumbs->push(lang('Quiz'), "/gradebook/view_students/examination/{$section_id}/$exam_id");
                break;
            case Orm_Tst_Exam::TYPE_ASSIGNMENT:
                $this->breadcrumbs->push(lang('Assignment'), "/gradebook/view_students/examination/{$section_id}/$exam_id");
                break;
            default;
                $this->breadcrumbs->push(lang('Examination'), "/gradebook/view_students/examination/{$section_id}/$exam_id");
                break;
        }

        $this->breadcrumbs->push(lang('Report'), "/gradebook/exam_report/{$section_id}/$exam_id");



        $this->view_params['exam_id'] = $exam_id;

        $this->layout->add_javascript('/assets/jadeer/js/chart.bundle.min.js');
        $this->layout->view('exam_report', $this->view_params);
    }
    /** draw chart depending on assessment methods for section related to course
     * get all questions related  to assessment methods of course and print them as a report
    */
    public function method_report($section_id=0, $method_id=0) {

        if (License::get_instance()->check_module('curriculum_mapping', true)){
            Modules::load('curriculum_mapping',true);
        }
        else {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect('/');
        }

        $method = Orm_Cm_Course_Assessment_Method::get_instance($method_id);

        if(!($method && $method->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $map_question = Orm_Cm_Section_Mapping_Question::get_one(['course_assessment_method_id'=>$method_id, 'section_id'=>$section_id]);

        if(!($map_question && $map_question->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $mapping_id = $map_question->get_id();

        $this->view_params['students'] = Orm_Cm_Section_Student_Assessment::get_all(['section_mapping_question_id' => $mapping_id]);

        $section_id = $map_question->get_section_id();

        $this->view_params['full_mark'] = $map_question->get_full_mark();

        if(count($this->view_params['students'])==0) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->breadcrumbs->push(lang('View').' '.lang('Student'), "/gradebook/view_students/curriculum/{$section_id}");
        $this->breadcrumbs->push(lang('Curriculum'), "/gradebook/view_students/curriculum/{$section_id}/$mapping_id");
        $this->breadcrumbs->push(lang('Report'), "/gradebook/method_report/{$section_id}/$mapping_id");


        $this->layout->add_javascript('/assets/jadeer/js/chart.bundle.min.js');
        $this->layout->view('method_report', $this->view_params);
    }
}