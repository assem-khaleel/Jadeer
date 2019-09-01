<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 22/05/17
 * Time: 01:16 م
 */
class Student_exam extends MX_Controller
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

        $this->view_params['menu_tab'] = 'examination';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Exam'),
            'icon' => 'fa fa-file-text-o'
        ), true);
        $this->view_params['type'] = 'exam';

    }

    /** index page for exams related to student
     * render it in student_exam/list view
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

        $filters['type'] = Orm_Tst_Exam::TYPE_EXAM;


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


        $exams = Orm_Tst_Exam::get_student_exams($filters,$page,$per_page);


        $this->view_params['sub_menu'] = 'examination/student_sub_menu';
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['exams'] = $exams;
        $this->layout->view('examination/student_exam/list', $this->view_params);
    }

    /**
     * start test for student
     * @param int $exam_id
     */
    public function start_test($exam_id=0)
    {
        $exam = Orm_Tst_Exam::get_instance($exam_id);

        if(!($exam && $exam->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }


        if (!$exam->exam_can_start()){
            Validator::set_error_flash_message(lang('You can not start this exam'), true);
            redirect('/examination/student_exam');
        }

        $this->breadcrumbs->push(lang('Student Exam'), '/examination/student_exam');
        $this->breadcrumbs->push(lang('Take Exam'), '/examination/student_exam/start_test');


        if (!$exam->is_active()) {
            Validator::set_error_flash_message(lang('This exam not start yet'), true);
            redirect('/examination/student_exam');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'title'      => lang('Exam'),
                'icon'       => 'fa fa-file-text-o',
                'link_attr'  => ' href="javascript:void(0)" id="finish_btn"',
                'link_icon'  => 'fa fa-sign-out',
                'link_title' => lang('Finish Exam')
            ), true);

        $this->view_params['exam'] = $exam;
        $this->layout->view('examination/student_exam/start', $this->view_params);
    }

    /** finish test for student
    */
    public function finish($exam_id=0) {
        redirect('/examination/student_exam');
    }

    /** set timeout for test
    */
    public function timeout($exam_id=0) {
        Validator::set_success_flash_message(lang('Exam time run out'), true);
        redirect('/examination/student_exam');
    }

    /** save question for exam if exam exist
     * back with json request
    */
    public function save_question($exam_id=0, $question_id=0) {

        if (!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('No direct script access allowed'), true);
            redirect('/examination/student_exam');
        }

        $question = Orm_Tst_Question::get_instance($question_id);

        if($exam_id==0 || !($question && $question->get_id())){
            json_response(['success'=>false]);
        }

        json_response(['success'=>$question->save_user_response($exam_id)]);
    }

    /** get list of questions for specific exam
     *
    */
    public function get_question($exam_id=0, $question_id=0) {

        if (!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('No direct script access allowed'), true);
            redirect('/examination/student_exam');
        }

        $exam_question = Orm_Tst_Exam_Questions::get_one([
            'exam_id' => $exam_id,
            'question_id' => $question_id
        ]);

        if(!($exam_question && $exam_question->get_id())){
            json_response(['success'=>false]);
        }


        if ($exam_question && $exam_question->get_id()) {

            $question = $exam_question->get_question_id(true);

            json_response(['success'=>true,
                'name' => $question->get_text(),
                'html' => form_open("/examination/student_exam/save_question/{$exam_id}/{$question_id}", 'method="post"').
                    $question->get_question_with_user_response($exam_id).
                    form_close()
            ]);
        }

        json_response(['success' => false]);
    }

    /** check if exam exist or not
    */
    public function check_exam($exam_id=0) {

        if (!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('No direct script access allowed'), true);
            redirect('/examination/student_exam');
        }

        $exam = Orm_Tst_Exam::get_instance($exam_id);

        if(!($exam && $exam->get_id())){
            json_response(['status'=>false]);
        }

        json_response(['status'=>$exam->is_active()]);
    }

}