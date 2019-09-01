<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 6/30/15
 * Time: 12:05 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * Class Design
 */
class Design extends MX_Controller
{

    private $view_params = array();
    private $logged_user = array();
    private $survey_obj = null;

    /**
     * Design constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!License::get_instance()->check_module('survey', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->logged_user = Orm_User::get_logged_user();

        $survey_id = $this->input->get_post('survey_id');
        $this->survey_obj = Orm_Survey::get_instance($survey_id);

        if (!$this->survey_obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }
        if ($this->logged_user->get_id() != $this->survey_obj->get_created_by()) {
            if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() < Orm_User::get_instance($this->survey_obj->get_created_by())->get_role_obj()->get_admin_level()) {
                Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                redirect($this->input->server('HTTP_REFERER'));
            }
        }

        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');

        $survey_type = Orm_Survey::get_survey_type($this->survey_obj->get_type());

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, "survey_{$survey_type}-manage");

        $this->breadcrumbs->push(lang('Surveys'), "/survey?type={$this->survey_obj->get_type()}");
        $this->breadcrumbs->push(lang('Design'), "/survey/design?survey_id={$survey_id}");

        $this->view_params['survey'] = $this->survey_obj;
        $this->view_params['logged_user_id'] = $this->logged_user->get_id();

        $this->view_params['menu_tab'] = 'survey';

        $go_to = $this->session->userdata('go_to');
        $url = ($go_to ? $go_to : "/survey?type={$this->survey_obj->get_type()}");

        $type = $this->survey_obj->get_type();

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Survey'),
            'icon' => 'fa fa-check-square',
            'link_attr' => 'href="'.$url.'"',
            'link_title' => lang('Finish'),
            'link_icon' => 'floppy-o',
            'menu_view' => 'survey/manager/sub_menu',
            'menu_params' => array('type' => $type)
        ), true);
    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {
        $this->layout->view('survey/design/index', $this->view_params);
    }

    /**
     * this function page add by its page id
     * @param int $page_id the page id of the page add to be viewed
     * @redirect success or error
     */
    public function page_add($page_id = 0)
    {

        $page_obj = Orm_Survey_Page::get_instance($page_id);

        $new_page = new Orm_Survey_Page();
        $new_page->set_survey_id($this->survey_obj->get_id());
        $new_page->set_order($page_obj->get_order() + 1);
        $new_page->save();

        $new_page->fix_orders();

        Validator::set_success_flash_message(lang('Successfully Added'));
        redirect("/survey/design?survey_id={$this->survey_obj->get_id()}", 'location');
    }

    /**
     * this function page move by its from page id and here page id
     * @param int $from_page_id the from page id of the page move to be viewed
     * @param int $here_page_id the here page id of the page move to be viewed
     * @redirect success or error
     */
    public function page_move($from_page_id, $here_page_id)
    {

        $from_page = Orm_Survey_Page::get_instance($from_page_id);
        $here_page = Orm_Survey_Page::get_instance($here_page_id);

        $from_page->set_order($here_page->get_order() + 1);
        $from_page->save();

        $from_page->fix_orders();

        Validator::set_success_flash_message(lang('Successfully Moved'));
        redirect("/survey/design?survey_id={$this->survey_obj->get_id()}", 'location');
    }

    /**
     * this function page copy by its copy page id and paste page id
     * @param int $copy_page_id the copy page id of the page copy to be viewed
     * @param int $paste_page_id the paste page id of the page copy to be viewed
     * @redirect success or error
     */
    public function page_copy($copy_page_id, $paste_page_id)
    {

        $copy_page = Orm_Survey_Page::get_instance($copy_page_id);
        $paste_page = Orm_Survey_Page::get_instance($paste_page_id);

        $new_page = $copy_page->clone_me($this->survey_obj->get_id(), true);
        $new_page->set_order($paste_page->get_order() + 1);
        $new_page->save();

        $new_page->fix_orders();

        Validator::set_success_flash_message(lang('Successfully Copied'));
        redirect("/survey/design?survey_id={$this->survey_obj->get_id()}", 'location');
    }

    /**
     * this function page delete by its page id
     * @param int $page_id the page id of the page delete to be viewed
     * @redirect success or error
     */
    public function page_delete($page_id)
    {

        $page = Orm_Survey_Page::get_instance($page_id);
        $page->delete();

        $page->reorder();

        Validator::set_success_flash_message(lang('Successfully Deleted'));
        redirect("/survey/design?survey_id={$this->survey_obj->get_id()}", 'location');
    }

    /**
     * this function page edit by its page id
     * @param int $page_id the page id of the page edit to be viewed
     * @redirect success or error
     */
    public function page_edit($page_id)
    {

        $page = Orm_Survey_Page::get_instance($page_id);

        if ('POST' == $this->input->server('REQUEST_METHOD')) {

            $title_english = $this->input->post('title_english');
            $title_arabic = $this->input->post('title_arabic');
            $description_english = $this->input->post('description_english');
            $description_arabic = $this->input->post('description_arabic');

            if (Validator::success()) {
                $page->set_title_english($title_english);
                $page->set_title_arabic($title_arabic);
                $page->set_description_english($description_english);
                $page->set_description_arabic($description_arabic);
                $page->save();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                redirect("/survey/design?survey_id={$this->survey_obj->get_id()}", 'location');
            }
        }

        $this->view_params['page'] = $page;
        $this->load->view('survey/design/page/edit', $this->view_params);
    }

    /**
     * this function page split here by its question id
     * @param int $question_id the question id of the page split here to be viewed
     * @redirect success or error
     */
    public function page_split_here($question_id)
    {

        $question_obj = Orm_Survey_Question::get_instance($question_id);
        $page_obj = $question_obj->get_page_obj();

        $new_page = new Orm_Survey_Page();
        $new_page->set_survey_id($this->survey_obj->get_id());
        $new_page->set_order($page_obj->get_order() + 1);
        $new_page->save();

        $new_page->fix_orders();

        $question_obj->set_page_id($new_page->get_id());
        $question_obj->save();

        foreach ($question_obj->get_greater() as $question) {
            $question->set_page_id($new_page->get_id());
            $question->save();
        }

        $question_obj->fix_orders();

        Validator::set_success_flash_message(lang('Successfully Split'));
        redirect("/survey/design?survey_id={$this->survey_obj->get_id()}", 'location');
    }

    /**
     * this function question types
     * @return string the html view
     */
    public function question_types()
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }


        $class_type = $this->input->post('class_type');

        $html = '<h1>' . lang('Please Select Question Type') . '</h1>';

        if (class_exists($class_type)) {
            $question = new $class_type();
            /* @var $question Orm_Survey_Question */
            $html = $question->draw_add_edit();
        }

        exit($html);
    }

    /**
     * this function question add by its page id and order
     * @param int $page_id the page id of the question add to be viewed
     * @param int $order the question order of the question add to be viewed
     * @redirect success or error
     */
    public function question_add($page_id, $order = 1)
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }


        $page = Orm_Survey_Page::get_instance($page_id);

        if (!$page->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $this->breadcrumbs->push(lang('Create').' '.lang('Question'), $this->input->server('REQUEST_URI'));

        $question = new Orm_Survey_Question();
        $question->set_order($order);
        $question->set_page_id($page->get_id());

        $this->view_params['question'] = $question;

        $this->load->view('survey/design/question/create_edit', $this->view_params);
    }

    /**
     * this function question save
     * @redirect success or error
     */
    public function question_save()
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }


        $question_english = $this->input->post('question_english');
        $question_arabic = $this->input->post('question_arabic');
        $class_type = $this->input->post('class_type');
        $order = $this->input->post('order');
        $page_id = $this->input->post('page_id');
        $question_id = $this->input->post('question_id');
        $is_require = $this->input->post('is_require');

        Validator::required_field_validator('question_english', $question_english, lang('Required Question').' ( '.lang('English').' ) ');
        Validator::required_field_validator('question_arabic', $question_arabic, lang('Required Question').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('class_type', $class_type, lang('Please Select Question Type'));
        Validator::required_field_validator('class_type', $page_id, lang('Error : Please try Again'));

        if (!class_exists($class_type)) {
            Validator::set_error('class_type', lang('Error : Please try Again'));
        }

        $question_obj = Orm_Survey_Question::get_instance($question_id);

        if (!$question_obj->get_id() && class_exists($class_type)) {
            $question_obj = new $class_type();
        }

        if ($question_obj->get_id() && class_exists($class_type)) {
            if ($class_type != $question_obj->get_class_type()) {
                $question_obj = $question_obj->update_old_question($class_type);
            }
        }

        $question_obj->set_id($question_id);
        $question_obj->set_page_id($page_id);
        $question_obj->set_class_type($class_type);
        $question_obj->set_order($order);
        $question_obj->set_question_english($question_english);
        $question_obj->set_question_arabic($question_arabic);
        $question_obj->set_is_require($is_require);

        $question_obj->validator();

        if (Validator::success()) {
            $question_obj->save_process();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(array('status' => true));
        }

        $this->view_params['question'] = $question_obj;
        json_response(array('status' => false, 'html' => $this->load->view('survey/design/question/create_edit', $this->view_params, true)));
    }

    /**
     * this function question edit by its question id
     * @param int $question_id the question id of the question edit to be viewed
     * @redirect success or error
     */
    public function question_edit($question_id)
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }


        $question = Orm_Survey_Question::get_instance($question_id);

        if (!$question->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $this->breadcrumbs->push(lang('Edit').' '.lang('Question'), $this->input->server('REQUEST_URI'));

        $this->view_params['question'] = $question;
        $this->load->view('survey/design/question/create_edit', $this->view_params);
    }

    /**
     * this function question note by its question id
     * @param int $question_id the question id of the question note to be viewed
     * @redirect success or error
     */
    public function question_note($question_id)
    {
        $question = Orm_Survey_Question::get_instance($question_id);

        if (!$question->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $description_english = $this->input->post('description_english');
        $description_arabic = $this->input->post('description_arabic');

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $question->set_description_english($description_english);
            $question->set_description_arabic($description_arabic);
            $question->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect("/survey/design?survey_id={$this->survey_obj->get_id()}", 'location');
        }

        $this->view_params['question'] = $question;
        $this->load->view('survey/design/question/note', $this->view_params);
    }

    /**
     * this function question delete by its question id
     * @param int $question_id the question id of the question delete to be viewed
     * @redirect success or error
     */
    public function question_delete($question_id)
    {

        $question = Orm_Survey_Question::get_instance($question_id);

        if (!$question->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $question->delete();

        $question->reorder();

        Validator::set_success_flash_message(lang('Successfully Deleted'));
        redirect("/survey/design?survey_id={$this->survey_obj->get_id()}", 'location');

    }
    /**
     * this function question move by its from question id and here question id and page id
     * @param int $from_question_id the from question id of the question move to be viewed
     * @param int $here_question_id the here question id of the question move to be viewed
     * @param int $page_id the page id of the question move to be viewed
     * @redirect success or error
     */
    public function question_move($from_question_id, $here_question_id, $page_id = 0)
    {

        $from_question = Orm_Survey_Question::get_instance($from_question_id);
        $here_question = Orm_Survey_Question::get_instance($here_question_id);

        if (!$page_id) {
            $page_id = $here_question->get_page_id();
        }

        $from_question->set_order($here_question->get_order() + 1);
        $from_question->set_page_id($page_id);
        $from_question->save();

        $from_question->fix_orders();

        Validator::set_success_flash_message(lang('Successfully Moved'));
        redirect("/survey/design?survey_id={$this->survey_obj->get_id()}", 'location');
    }
    /**
     * this function question copy by its copy question id and paste question id and page id
     * @param int $copy_question_id the copy question id of the question copy to be viewed
     * @param int $paste_question_id the here paste question id of the question copy to be viewed
     * @param int $page_id the page id of the question copy to be viewed
     * @redirect success or error
     */
    public function question_copy($copy_question_id, $paste_question_id, $page_id = 0)
    {

        $copy_question = Orm_Survey_Question::get_instance($copy_question_id);
        $paste_question = Orm_Survey_Question::get_instance($paste_question_id);

        if (!$page_id) {
            $page_id = $paste_question->get_page_id();
        }

        $new_question = $copy_question->clone_me($page_id, true);
        $new_question->set_order($paste_question->get_order() + 1);
        $new_question->save();

        $new_question->fix_orders();

        Validator::set_success_flash_message(lang('Successfully Copied'));
        redirect("/survey/design?survey_id={$this->survey_obj->get_id()}", 'location');
    }

    /**
     * this function get factors
     * @return string the call function
     */
    public function get_factors() {
        $id = $this->input->get('survey_id');
        $factors = Orm_Survey_Question_Factor::get_all(array('survey_id' => $id));
        $factor_array = array();
        foreach ($factors as $factor)
        {
            $factor_array[] = array('id' => $factor->get_id(),'title' => $factor->get_title());
        }
        json_response($factor_array);
    }

    /**
     * this function get statements
     * @return string the call function
     */
    public function get_statements()
    {
        $id = $this->input->get('id');
        $statements = Orm_Survey_Question_Statement::get_all(array('factor_id' => $id));
        $statements_array = array();
        foreach ($statements as $statement)
        {
            $statements_array[] = array('id' => $statement->get_id(),'title' => $statement->get_title());
        }
        json_response($statements_array);
    }
}