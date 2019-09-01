<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of question_bank
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author ADwairi
 * @author Hamzah
 * @author Laith
 */
class Question_Bank extends MX_Controller
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

        $this->layout->add_javascript('/assets/jadeer/js/outcome.js');

        $this->breadcrumbs->push(lang('Examination'), '/examination');

        $this->view_params['menu_tab'] = 'examination';
        $data=array(
            'title' => lang('Examination'),
            'icon' => 'fa fa-quora',
            'menu_view' => 'examination/sub_menu',
            'menu_params' => array('type' => 'question_bank')
        );
        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Student::class)
        {
            $data['menu_view'] = 'examination/student_sub_menu';
            redirect('examination/student_assignment');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header',$data, true);
    }


    /** list all question s bank in list depending course id
     * render it in question_bank/list view
    */
    public function index() {

        $this->breadcrumbs->push(lang('Question Bank'), '/examination/question_bank');
        $user = Orm_User::get_logged_user();

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        $arr_header = [
            'title' => lang('Question Bank'),
            'icon' => 'fa fa-file-text-o'
        ];

        if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')) {
            $arr_header['link_attr']   = 'href="/examination/question_bank/question_add"';
            $arr_header['link_icon']   = 'plus';
            $arr_header['data_toggle'] = 'ajaxModal';
            $arr_header['link_title']  = lang('Create').' '.lang('Question');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $arr_header, true);

        $this->view_params['type'] = 'question_bank';

        if (!empty($fltr['campus_in'])) {
            $filters['campus_in'] = $fltr['campus_in'];
        }

        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = $fltr['college_id'];
        }

        if (!empty($fltr['program_id'])) {
            $filters['program_id'] = $fltr['program_id'];
        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = $fltr['keyword'];
        }

        if($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){
            $filters['campus_in']=$user->get_college_obj()->get_campus_ids();
            $filters['college_id'] = $user->get_college_id();

        }

        if($user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)){
            $filters['campus_in']=$user->get_college_obj()->get_campus_ids();
            $filters['college_id'] = $user->get_college_id();
            $filters['program_id'] = $user->get_program_id();

        }

        $filters['only_mine'] = true;

        $questions = Orm_Tst_Question::get_all($filters, $page, $per_page, array('tq.id desc'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tst_Question::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);

        $this->view_params['questions'] = $questions;

        $this->layout->view('examination/question_bank/list', $this->view_params);
    }

    /** get all question bank questions and render it as ajax in window
     * render it in question_bank/ajax_list view
    */
    public function ajax_list() {

        $this->view_params['type'] = 'question_bank';

        $fltr = $this->input->get_post('fltr');
        $filters = $fltr;

        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tst_Question::get_count($filters));

        $total_page = intval($pager->get_total_count()/$pager->get_per_page());
        $total_page += $pager->get_total_count()%$pager->get_per_page()?1:0;

        if($total_page < $page) {
            $page=1;
        }

        $page = $page?: 1;
        $pager->set_page($page);

        $questions = Orm_Tst_Question::get_all($filters, $page, $per_page, array('tq.id desc'));

        $this->view_params['questions'] = $questions;
        $this->view_params['pager'] = $pager->render(true);

        $this->load->view('examination/question_bank/ajax_list', $this->view_params);
    }

    /** function to authorized who can see the question depending on user type
     * render it in question_bank/show_question view
    */
    public function show_question($question_id = 0) {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang("No direct script access allowed"));
            redirect("/examination");
        }

        $question = Orm_Tst_Question::get_instance($question_id);

        if (!($question && $question->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));
        }

        $this->view_params['question'] = $question;
        $this->load->view('examination/question_bank/show_question', $this->view_params);
    }

    /** link every question wih question outcome
     * render it in link_question view
    */
    public function link_question($question_id = 0) {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang("No direct script access allowed"));
            redirect("/examination");
        }

        $question = Orm_Tst_Question::get_instance($question_id);

        if (!($question && $question->get_id())) {
            echo error_dialog();
            exit;
        }


        $this->view_params['question'] = $question;

        if($this->input->server('REQUEST_METHOD')=='POST'){

            $learning_outcomes  = (array) $this->input->post('learning_outcome');

            foreach($learning_outcomes as $key=>$learning_outcome){
                Validator::not_empty_field_validator('learning_outcome', $learning_outcome['id'], lang('You have to fill this field'), $key);
            }

            if(Validator::success()) {
                foreach($learning_outcomes as $key=>$learning_outcome) {
                    $question_learning_outcome = Orm_Tst_Question_Outcome::get_one([
                        'question_id' => $question->get_id(),
                        'outcome_id'  => $learning_outcome['id'],
                        'type'        => $learning_outcome['type']
                    ]);

                    if($question_learning_outcome->get_id()){
                        continue;
                    }

                    $question_learning_outcome->set_question_id($question->get_id());
                    $question_learning_outcome->set_outcome_id($learning_outcome['id']);
                    $question_learning_outcome->set_type($learning_outcome['type']);
                    $question_learning_outcome->save();
                    Validator::set_success_flash_message(lang('Successfully Saved'));

                }

                foreach(Orm_Tst_Question_Outcome::get_all(['question_id' => $question->get_id()]) as $question_outcome) {

                    if(!in_array(['id'=>$question_outcome->get_outcome_id(), 'type'=>$question_outcome->get_type()], $learning_outcomes)) {
                        $question_outcome->delete();
                    }
                }

                json_response(['success' => true]);
            }

            json_response([
                'success' => false,
                'html' => $this->load->view('examination/question_bank/link_question', $this->view_params, true)
            ]);
        }

        $this->load->view('examination/question_bank/link_question', $this->view_params);
    }

    /** draw question in chart depending class type of question
     *
    */
    public function question_types()
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect('/');
        }

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $class_type = $this->input->post('class_type');

        if (class_exists($class_type)) {
            $question = new $class_type();
        }
        else {
            $question = new Orm_Tst_Question();
        }

        /* @var $question Orm_Tst_Question */
        $html = $question->draw_add_edit();

        exit($html);
    }

    /** add new question from Orm_Tst_Question
     *render result in create_edit view
    */
    public function question_add() {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $this->breadcrumbs->push(lang('Create').' '.lang('Question'), $this->input->server('REQUEST_URI'));

        $question = new Orm_Tst_Question();
        $this->view_params['question'] = $question;

        $this->load->view('examination/design/question/create_edit', $this->view_params);
    }

    /** save question after exceed all validations processes
     * back with json request
    */
    public function question_save() {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $question_english = $this->input->post('question_english');
        $question_arabic = $this->input->post('question_arabic');
        $class_type = $this->input->post('class_type');
        $question_id = $this->input->post('question_id');
        $course_id = $this->input->post('course_id');
        $question_status = $this->input->post('question_status');
        $is_assignment = intval($this->input->post('is_assignment'));
        $can_attach = intval($this->input->post('can_attach'));

        if(trim($question_english)=='' && trim($question_arabic)!=''){
            $question_english = $question_arabic;
        }
        elseif(trim($question_arabic)=='' && trim($question_english)!=''){
            $question_arabic= $question_english;
        }


        Validator::required_field_validator('question_english', $question_english, lang('Required Question').' ( '.lang('English').' ) ');
        Validator::required_field_validator('question_arabic', $question_arabic, lang('Required Question').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('question_status', $question_status, lang('Please Select Question Status'));
        Validator::required_field_validator('course_id', $course_id, lang('Please Select Course'));
        Validator::less_than_validator('course_id', $course_id, 1, lang('Please Select Course'));

        if (!class_exists($class_type)) {
            Validator::set_error('class_type', lang('Please Select Question Type'));
        }

        $question_obj = Orm_Tst_Question::get_instance($question_id);

        if (!$question_obj->get_id() && class_exists($class_type)) {
            $question_obj = new $class_type();
        }

        $question_obj->set_id($question_id);
        $question_obj->set_course_id($course_id);
        $question_obj->set_type($class_type);
        $question_obj->set_text_en($question_english);
        $question_obj->set_text_ar($question_arabic);
        $question_obj->set_difficulty(0);
        $question_obj->set_status($question_status);
        $question_obj->set_is_assignment($is_assignment);
        $question_obj->set_can_attach($is_assignment? $can_attach: 0);
        $question_obj->set_user_id(Orm_User::get_logged_user_id());

        $question_obj->validator();

        if (Validator::success()) {
            $question_obj->save_process();

            Validator::set_success_flash_message(lang('Successfully Saved'), true);
            json_response(array('status' => true));
        }

        $this->view_params['question'] = $question_obj;
        json_response(array('status' => false, 'html' => $this->load->view('examination/design/question/create_edit', $this->view_params, true)));
    }

    /** edit question if exist
     * render it in create_edit view
    */
    public function question_edit($question_id = 0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $question = Orm_Tst_Question::get_instance($question_id);

        if (!($question && $question->get_id())) {
            echo error_dialog();
            exit;
        }

        if (!$question->get_id() || !$question->can_edit()) {
            Validator::set_error_flash_message(lang("You can not edit this question"));
            exit('<script>location.href="/examination/question_bank";</script>');
        }

        $this->breadcrumbs->push(lang('Edit').' '.lang('Question'), $this->input->server('REQUEST_URI'));

        $this->view_params['question'] = $question;
        $this->load->view('examination/design/question/create_edit', $this->view_params);
    }

    /** delete question after validate that user can manage
     * back to question_bank view after deletion
    */
    public function question_delete($question_id=0) {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage');

        $question = Orm_Tst_Question::get_instance($question_id);


        if(!($question && $question->get_id())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));

        }

        if (!$question->can_edit()) {
            Validator::set_error_flash_message(lang('You can not delete this question'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $question->delete();

        Validator::set_success_flash_message(lang('Deleted Successfully'), true);
        redirect("/examination/question_bank", 'location');

    }
}
