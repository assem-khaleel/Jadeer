<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 22/05/17
 * Time: 01:16 م
 */
class Student_quiz extends MX_Controller
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
        $this->breadcrumbs->push(lang('Quiz'), '/examination/student_quiz');

        $this->view_params['menu_tab'] = 'examination';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Quiz'),
            'icon' => 'fa fa-file-text-o'
        ), true);
        $this->view_params['type'] = 'quiz';

    }

    /** index page for quizzes related to student
    */
    public function index(){

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');


        $filters = array();
        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $filters['type'] = Orm_Tst_Exam::TYPE_QUIZ;


        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tst_Exam::get_student_exams($filters,0, 0,true));


        $total_page = intval($pager->get_total_count()/$pager->get_per_page());
        $total_page += $pager->get_total_count()%$pager->get_per_page()?1:0;

        if($total_page < $page) {
            $page=1;
        }

        $page = $page?: 1;
        $pager->set_page($page);


        $quiz = Orm_Tst_Exam::get_student_exams($filters,$page,$per_page);


        $this->view_params['sub_menu'] = 'examination/student_sub_menu';
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['quiz'] = $quiz;
        $this->layout->view('student_quiz/list', $this->view_params);
    }

    /**
     * start test for student
     * @param int $quiz_id
     */
    public function start($quiz_id=0)
    {
        $quiz = Orm_Tst_Exam::get_instance($quiz_id);

        if(!($quiz && $quiz->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }


        if (!($quiz->get_start(true) < time() && $quiz->get_end(true) >= time())){
            Validator::set_error_flash_message(lang('You can not start this quiz'), true);
            redirect('/examination/student_quiz');
        }

        $this->breadcrumbs->push(lang('Start'), '/examination/student_quiz/start/'.$quiz_id);


        if (!$quiz->is_active()) {
            Validator::set_error_flash_message(lang('This quiz not start yet'), true);
            redirect('/examination/student_quiz');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'title'      => lang('Quiz'),
                'icon'       => 'fa fa-file-text-o',
                'link_attr'  => ' href="javascript:void(0)" id="finish_btn"',
                'link_icon'  => 'fa fa-sign-out',
                'link_title' => lang('Finish Quiz')
            ), true);

        $this->view_params['quiz'] = $quiz;
        $this->layout->view('examination/student_quiz/start', $this->view_params);
    }

    /** finish quiz
    */
    public function finish($quiz_id=0) {
        redirect('/examination/student_quiz');
    }


    /** set timeout for the quiz
    */
    public function timeout($exam_id=0) {
        Validator::set_success_flash_message(lang('Exam time run out'), true);
        redirect('/examination/student_quiz');
    }

    /** save question for the specific quiz
    */
    public function save_question($quiz_id=0, $question_id=0) {

        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('No direct script access allowed'), true);
            redirect('/examination/student_quiz');
        }

        $question = Orm_Tst_Question::get_instance($question_id);

        if(!($question && $question->get_id())){
            json_response(['success' => false]);
        }


        json_response(['success'=>$question->save_user_response($quiz_id)]);
    }

    /** get question for the specific quiz
     */
    public function get_question($quiz_id=0, $question_id=0) {

        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('No direct script access allowed'), true);
            redirect('/examination/student_quiz');
        }

        $quiz_question = Orm_Tst_Exam_Questions::get_one([
            'quiz_id' => $quiz_id,
            'question_id' => $question_id
        ]);

        if ($quiz_question && $quiz_question->get_id()) {

            $question = $quiz_question->get_question_id(true);

            json_response(['success'=>true,
                'name' => $question->get_text(),
                'html' => form_open("/examination/student_quiz/save_question/{$quiz_id}/{$question_id}", 'method="post"').
                    $question->get_question_with_user_response($quiz_id).
                    form_close()
            ]);
        }

        json_response(['success' => false]);
    }

    /** check quiz is active or note
     * render it as json object
    */
    public function check_quiz($quiz_id=0) {

        if (!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('No direct script access allowed'), true);
            redirect('/examination/student_quiz');
        }

        $quiz = Orm_Tst_Exam::get_instance($quiz_id);

        if(!($quiz && $quiz->get_id())){
            json_response(['status' => false]);
        }

        json_response(['status'=>$quiz->is_active()]);
    }

}