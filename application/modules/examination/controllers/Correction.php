<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of correction
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author ADwairi
 * @author Hamzah
 * @author Laith
 */

class Correction extends MX_Controller
{
    private $view_params = array();

    //TODO please implement backend for this

    public function __construct()
    {
        parent::__construct();
        
        if (!License::get_instance()->check_module('examination', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-list');
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $this->breadcrumbs->push(lang('Examination'), '/examination');


        $this->view_params['menu_tab'] = 'examination';

    }

    /** get all of exams if type of user is teacher special for specific teacher
     * render the view in correction/list
    */
    public function index()
    {
        show_404();

        $user = Orm_User::get_logged_user();

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Examination'),
            'icon' => 'fa fa-quora',
            'menu_view' => 'examination/sub_menu',
            'menu_params' => array('type' => 'correction')
        ), true);

        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));
        $fltr = $this->input->get_post('fltr');

        $filters = array();
        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        $filters['end_less_than'] = time();
        $filters['end_greater_than'] = 1;

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }


        $filters['teacher_id'] = $user->get_id();

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

        $exams = Orm_Tst_Exam::get_all($filters, $page, $per_page);


        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['exams'] = $exams;

        $this->layout->view('examination/correction/list', $this->view_params);
    }

    /** get all students for specific exam if it's exam or students for assingments or quiz
     *
    */
    public function students($exam_id=0)
    {
        $exam = Orm_Tst_Exam::get_instance($exam_id);

        if(!($exam && $exam->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }


        $user_id = Orm_User::get_logged_user_id();

        if($exam->get_teacher_id()!=$user_id){
            Validator::set_error_flash_message(lang('You are not exam creator'));
            redirect('/examination');
        }


        $page_header = [
            'title' => lang('examination'),
            'icon' => 'fa fa-quora',
            'menu_view' => 'examination/sub_menu',
            'menu_params' => ['type' => 'exam']
        ];


        // Assignment type
        if($exam->get_type() == Orm_Tst_Exam::TYPE_ASSIGNMENT){
            $this->breadcrumbs->push(lang('Assignment'), '/examination/assignments');
            $page_header['menu_params']['type'] = 'assignment';
        }
        elseif($exam->get_type() == Orm_Tst_Exam::TYPE_QUIZ){
            $this->breadcrumbs->push(lang('Quiz'), '/examination/quiz');
            $page_header['menu_params']['type'] = 'quiz';
        }

        $this->breadcrumbs->push(lang('Correction'), '/examination/correction/students/'.$exam_id);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);


        $per_page = intval($this->config->item('per_page'));
        $page     = intval($this->input->get_post('page'))?: 1;
        $fltr     = $this->input->get_post('fltr');

        $filters = array();
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }


        $this->view_params['exam']     = $exam;
        $this->view_params['students'] = $exam->get_students($filters, $page, $per_page);
        $this->view_params['user_id']  = $user_id;

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count($exam->get_students_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;

        // Exam type
        $view_path = 'examination/correction/exam_students_list';

        // Assignment type
        if($exam->get_type() == Orm_Tst_Exam::TYPE_ASSIGNMENT || $exam->get_type() == Orm_Tst_Exam::TYPE_QUIZ){
            $view_path = 'examination/correction/assignment_students_list';
        }

        $this->layout->view($view_path, $this->view_params);
    }

    /** check answers for students of the exams that takes and check it by teacher user
    */
    public function check_answers($exam_id=0, $student_id=0) {

        $exam = Orm_Tst_Exam::get_instance($exam_id);

        if(!($exam && $exam->get_id()) || !$student_id) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }

        $student = Orm_User::get_instance($student_id);

        if(!($student && $student->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }

        $this->view_params['exam'] = $exam;

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Check Answers').': '.$student->get_full_name(),
            'icon' => 'fa fa-quora',
            'link_attr' => 'href="/examination/correction/students/'.$exam_id.'"',
            'link_icon' => 'reply',
            'link_title' => lang('Students List')
        ), true);

        $this->view_params['user_id'] = $student_id;

        if($this->input->server('REQUEST_METHOD')=='POST') {

            foreach($exam->get_questions() as $question){
                $q = $question->get_question_id(true);

                if($q instanceof Orm_Tst_Question_Type_Textarea){
                    $mark = abs($this->input->post($q->get_html_question_name()));

                    Validator::greater_than_validator($q->get_html_question_name(), $mark, $question->get_mark(), lang("It's greater than").' '.$question->get_mark());
                }
            }

            if(Validator::success()) {

                $attended = true;

                if($exam->get_type() == Orm_Tst_Exam::TYPE_EXAM) {
                    $attended = Orm_Tst_Exam_Attendance::get_count(['exam_id' => $exam_id, 'student_id' => $student_id]);
                }

                foreach($exam->get_questions() as $question) {
                    $q = $question->get_question_id(true);

                    if($q instanceof Orm_Tst_Question_Type_Textarea){
                        $mark = abs($this->input->post($q->get_html_question_name()));

                        $student_mark = Orm_Tst_Exam_Student_Mark::get_one([
                            'user_id'    => $student_id,
                            'exam_id'    => $exam_id,
                            'question_id'=> $q->get_id()
                        ]);

                        $student_mark->set_user_id($student_id);
                        $student_mark->set_exam_id($exam_id);
                        $student_mark->set_question_id($q->get_id());
                        $student_mark->set_mark($mark);

                        $student_mark->save();
                    }
                    elseif($attended) {


                        $student_mark = Orm_Tst_Exam_Student_Mark::get_one([
                            'user_id' => $student_id,
                            'exam_id' => $exam_id,
                            'question_id' => $question->get_question_id()
                        ]);

                        if (!($student_mark && $student_mark->get_id())) {
                            $student_mark->set_user_id($student_id);
                            $student_mark->set_exam_id($exam_id);
                            $student_mark->set_question_id($question->get_question_id());
                            $student_mark->set_mark(0);

                            $student_mark->save();
                        }
                    }
                }

                Validator::set_success_flash_message(lang('Successfully Saved'));
            }
        }

        $this->breadcrumbs->push(lang('Students List'), '/examination/correction/students/'.$exam_id);
        $this->breadcrumbs->push(lang('Check Answers'), '/examination/correction/students/check_answers/'.$exam_id.'/'.$student_id);

        $this->layout->view('examination/correction/check_answers', $this->view_params);
    }

    /** check answers of the exam for every student if the user answer all of them in exam
    */
    public function check_answers_next($exam_id=0, $student_id=0) {

        $exam = Orm_Tst_Exam::get_instance($exam_id);

        if(!($exam && $exam->get_id()) || !$student_id){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }

        $sections = $exam->get_sections();

        if(count($sections)==0) {
            redirect('/examination/correction/students/'.$exam_id);
        }

        $students = Orm_Course_Section_Student::get_model()->get_all(['section_id_in'=>$sections], 0, 0, ['user_id'], Orm::FETCH_ARRAY);

        if(count($students)==0) {
            redirect('/examination/correction/students/'.$exam_id);
        }

        $students = array_column($students, 'user_id');


        if(array_search($student_id, $students)!==false) {
            $key = array_search($student_id, $students)+1;

            redirect('/examination/correction/check_answers/'.$exam_id.'/'.$students[$key % count($students)]);
        }
    }
}
