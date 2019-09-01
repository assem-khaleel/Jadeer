<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * Class Standard
 */
class Standard extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'standard';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Standard'),
            'icon' => 'fa fa-th-large'
        ), true);

    }

    public function index()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-standard');
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Standard'),
            'icon' => 'fa fa-th-large',
            'link_attr' => 'href="/standard/create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Standard')
        ), true);


        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $standards = Orm_Standard::get_all($filters, $page, $per_page, array('s.code'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Standard::get_count($filters));

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Standard'), '/standard');

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['standards'] = $standards;
        $this->view_params['fltr'] = $fltr;

        $this->layout->view('/standard/list', $this->view_params);
    }

    public function create()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-standard');
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Standard'), '/standard');
        $this->breadcrumbs->push(lang('Add').' '.lang('Standard'), '/standard/create');

        $this->view_params['standard'] = new Orm_Standard();
        $this->layout->view('/standard/create_edit', $this->view_params);
    }

    public function save()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-standard');
        // post data
        $id = (int)$this->input->post('id');
        $standard_title = $this->input->post('title');
        $standard_code = $this->input->post('code');

        //get instances object
        $obj = Orm_Standard::get_instance($id);
        $obj->set_title($standard_title);
        $obj->set_code($standard_code);

        //validation errors
        Validator::required_field_validator('code', $standard_code, lang('Please Enter Standard Code'));
        Validator::required_field_validator('title', $standard_title, lang('Please Enter Standard Name'));
        Validator::database_unique_field_validator($obj, 'title', 'title', $standard_title, lang('Unique Field'));

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/standard');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Standard'), '/standard');
        $this->breadcrumbs->push(lang('Add').' '.lang('Standard'), '/standard/create');

        // parameter
        $this->view_params['standard'] = $obj;
        $this->layout->view('/standard/create_edit', $this->view_params);
    }

    public function edit($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-standard');
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Standard'), '/standard');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Standard'), '/standard/edit/' . $id);

        $this->view_params['standard'] = Orm_Standard::get_instance($id);
        $this->layout->view('/standard/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-standard');
        $obj = Orm_Standard::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/standard');
    }

    public function get_standards() {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }
        $ok = true;
        $html = '';
        foreach (Orm_Standard::get_all() as $standard) {
            if ($ok) {
                $html .= '<option selected="selected" value="'.$standard->get_id().'">'.$standard->get_title().'</option>';
                $ok = false;
            } else {
                $html .= '<option value="'.$standard->get_id().'">'.$standard->get_title().'</option>';
            }
        }
        die($html);
    }
}
