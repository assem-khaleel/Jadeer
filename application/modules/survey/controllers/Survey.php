<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Config $config
 * @property CI_Session $session
 * @property CI_Input $input
 * Class Survey
 */
class Survey extends MX_Controller
{

    private $view_params = array();
    /** @var  Orm_User $logged_user */
    private $logged_user;

    /**
     * Survey constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!License::get_instance()->check_module('survey', true)) {
            show_404();
        }
    }

    /**
     * this function init
     * @return string the call function
     */
    private function init()
    {
        Orm_User::check_logged_in();

        $this->session->unset_userdata('go_to');

        $this->logged_user = Orm_User::get_logged_user();

        Orm_User::check_permission_or(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, Orm_Survey::get_role_types());

        $this->breadcrumbs->push(lang('Surveys'), '/survey');

        $type = (int)$this->input->get_post('type');
        $type = Orm_Survey::check_role_type($type);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Survey'),
            'icon' => 'fa fa-check-square',
            'menu_view' => 'survey/manager/sub_menu',
            'menu_params' => array('type' => $type)
        ), true);

        $this->view_params['type'] = $type;
        $this->view_params['menu_tab'] = 'survey';
        $this->view_params['logged_user_id'] = $this->logged_user->get_id();

    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {
        $this->init();

        $per_page = $this->config->item('per_page');

        $page = (int)$this->input->get_post('page');
        $fltr = (array)$this->input->get_post('fltr');
        $type = (int)$this->input->get_post('type');

        $type = Orm_Survey::check_role_type($type);

        $survey_type = Orm_Survey::get_survey_type($type);
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY),false,"survey_{$survey_type}-list");

        if (Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_{$survey_type}-manage")) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'title' => lang('Survey'),
                'icon' => 'fa fa-check-square',
                'link_attr' => 'href="/survey/create?type='.$type.'"',
                'link_icon' => 'plus',
                'link_title' => lang('Create').' '.lang('Survey')
            ), true);
        }

        if (!$page) {
            $page = 1;
        }

        $filters = is_array($fltr) ? $fltr : array();
        $filters['type'] = $type;

        $items = Orm_Survey::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Survey::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['items'] = $items;
        $this->view_params['fltr'] = $fltr;

        $this->layout->view('survey/manager/index', $this->view_params);
    }

    /**
     *this function create
     * @return string the html view
     */
    public function create()
    {
        $this->init();

        Orm_User::check_permission_or(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, Orm_Survey::get_role_types('manage'));

        $this->breadcrumbs->push(lang('Create'));
        $this->layout->view('survey/manager/create_edit', $this->view_params);
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        $this->init();

        Orm_User::check_permission_or(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, Orm_Survey::get_role_types('manage'));

        $go_to = $this->input->post('go_to');
        $copy_flag = $this->input->post('copy_flag');
        $title_english = $this->input->post('title_english');
        $title_arabic = $this->input->post('title_arabic');
        $type = $this->input->post('type');
        $created_by = $this->logged_user->get_id();

        $survey_type = Orm_Survey::get_survey_type($type);

        Validator::required_field_validator('title_english', $title_english, lang('Invalid Title'));
        Validator::required_field_validator('title_arabic', $title_arabic, lang('Invalid Title'));
        Validator::not_empty_field_validator('type', $type, lang('Invalid Type'));

        if (!Orm_User::check_credential(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY),false,"survey_{$survey_type}-manage")) {
            Validator::set_error('type',lang('Invalid Type'));
        }

        $obj = new Orm_Survey();

        if ($copy_flag) {
            $survey_id = (int)$this->input->post('survey_id');

            Validator::not_empty_field_validator('survey_id', $survey_id, lang('Invalid Survey Id'));

            if (Validator::success()) {
                $survey = Orm_Survey::get_instance($survey_id);
                $obj = $survey->clone_me(true);
            }

            $this->view_params['survey_id'] = $survey_id;
        } else {
            $id = (int)$this->input->post('id');

            $obj = Orm_Survey::get_instance($id);

            if ($obj->get_id() && $created_by != $obj->get_created_by()) {
                if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() < Orm_User::get_instance($obj->get_created_by())->get_role_obj()->get_admin_level()) {
                    Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                    redirect($this->input->server('HTTP_REFERER'));
                }
            }

            $this->view_params['id'] = $id;
        }

        if (Validator::success()) {
            $obj->set_title_english($title_english);
            $obj->set_title_arabic($title_arabic);
            $obj->set_created_by($created_by);
            $obj->set_type($type);
            $obj->save();

            if ($go_to == 'go_next') {
                redirect("/survey/design?survey_id={$obj->get_id()}");
            }

            redirect("/survey?type={$type}");
        }

        $this->view_params['copy_flag'] = $copy_flag;
        $this->view_params['title_english'] = $title_english;
        $this->view_params['title_arabic'] = $title_arabic;

        if (empty($id)) {
            $this->breadcrumbs->push(lang('Create'));
        } else {
            $this->breadcrumbs->push(lang('Edit'));
        }

        $this->layout->view('survey/manager/create_edit', $this->view_params);
    }

    /**
     * this function edit by its id
     * @param int $id the id of the edit to be viewed
     * @return string the html view
     */
    public function edit($id)
    {
        $this->init();

        $obj = Orm_Survey::get_instance($id);

        $survey_type = Orm_Survey::get_survey_type($obj->get_type());

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, "survey_{$survey_type}-manage");

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }
        if ($this->logged_user->get_id() != $obj->get_created_by()) {
            if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() < Orm_User::get_instance($obj->get_created_by())->get_role_obj()->get_admin_level()) {
                Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                redirect($this->input->server('HTTP_REFERER'));
            }
        }

        $this->view_params['id'] = $obj->get_id();
        $this->view_params['title_english'] = $obj->get_title_english();
        $this->view_params['title_arabic'] = $obj->get_title_arabic();
        $this->view_params['created_by'] = $obj->get_created_by();
        $this->view_params['date_added'] = $obj->get_date_added();
        $this->view_params['date_modified'] = $obj->get_date_modified();
        $this->view_params['type'] = $obj->get_type();
        $this->view_params['is_deleted'] = $obj->get_is_deleted();

        $this->breadcrumbs->push(lang('Edit'),'/survey/edit/'.$id);
        $this->layout->view('survey/manager/create_edit', $this->view_params);
    }

    /**
     * this function delete by its id
     * @param int $id the id of the delete to be viewed
     * @redirect success or error
     */
    public function delete($id)
    {
        $this->init();

        $obj = Orm_Survey::get_instance($id);

        $survey_type = Orm_Survey::get_survey_type($obj->get_type());

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, "survey_{$survey_type}-manage");

        $obj->delete();

        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     * this function preview by its id
     * @param int $id the id of the preview to be viewed
     * @return string the html view
     */
    public function preview($id)
    {
        $this->init();

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Preview Survey'),
            'icon' => 'fa fa-print',
            'link_icon' => 'print',
            'link_attr' => 'href="/survey/pdf/'.$id.'"',
            'link_title' => lang('Print Survey')
        ), true);

        $this->breadcrumbs->push(lang('Surveys Preview'), '/survey/preview');

        $obj = Orm_Survey::get_instance($id);

        $survey_type = Orm_Survey::get_survey_type($obj->get_type());

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, "survey_{$survey_type}-list");

        $this->view_params['survey'] = $obj;

        $this->layout->view('survey/manager/preview', $this->view_params);
    }

    /**
     * this function pdf by its id
     * @param int $id the id of the pdf to be viewed
     * @return string the html file pdf
     */
    public function pdf($id)
    {
        $this->init();

        $survey = Orm_Survey::get_instance($id);

        $survey_type = Orm_Survey::get_survey_type($survey->get_type());

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, "survey_{$survey_type}-report");

        $survey->generate_pdf(array('preview' => 1));
    }
}
