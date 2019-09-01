<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Criteria extends MX_Controller
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
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-criteria');

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'criteria';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Criteria'),
            'icon' => 'fa fa-tasks'
        ), true);

    }

    public function index()
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Criteria'),
            'icon' => 'fa fa-tasks',
            'link_attr' => 'href="/criteria/create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Criteria')
        ), true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        if (!empty($fltr['standard_id'])) {
            $filters['standard_id'] = (int)$fltr['standard_id'];
        }
        
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $criterias = Orm_Criteria::get_all($filters, $page, $per_page,array('c.code'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Criteria::get_count($filters));

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Criteria'), '/criteria');

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['criterias'] = $criterias;
        $this->view_params['fltr'] = $fltr;

        $this->layout->view('/criteria/list', $this->view_params);
    }

    public function create()
    {
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Criteria'), '/criteria');
        $this->breadcrumbs->push(lang('Add').' '.lang('Criteria'), '/criteria/create');

        $this->view_params['criteria'] = new Orm_Criteria();
        $this->layout->view('/criteria/create_edit', $this->view_params);
    }

    public function save()
    {
        // post data
        $id = (int)$this->input->post('id');
        $criteria_title = $this->input->post('title');
        $criteria_code = $this->input->post('code');
        $standard_id = (int)$this->input->post('standard_id');
        $type = (int)$this->input->post('type');
        $is_program = (int)$this->input->post('is_program');

        //get instances object
        $obj = Orm_Criteria::get_instance($id);
        $obj->set_title($criteria_title);
        $obj->set_code($criteria_code);
        $obj->set_type($type);
        $obj->set_is_program($is_program);
        $obj->set_standard_id($standard_id);

        //validation errors
        Validator::required_field_validator('code', $criteria_code, lang('Please Enter Criteria Code'));
        Validator::required_field_validator('title', $criteria_title, lang('Please Enter Criteria Title'));
        Validator::database_unique_field_validator($obj, 'title', 'title', $criteria_title, lang('Unique Field'));
        Validator::not_empty_field_validator('type', $type, lang('Must select Type'));
        Validator::not_empty_field_validator('standard_id', $standard_id, lang('Please Select Standard'));



        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/criteria');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Criteria'), '/criteria');
        $this->breadcrumbs->push(lang('Add').' '.lang('Criteria'), '/criteria/create');

        // parameter
        $this->view_params['criteria'] = $obj;
        $this->layout->view('/criteria/create_edit', $this->view_params);
    }

    public function edit($id)
    {

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Criteria'), '/criteria');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Criteria'), '/criteria/edit/' . $id);

        $this->view_params['criteria'] = Orm_Criteria::get_instance($id);
        $this->layout->view('/criteria/create_edit', $this->view_params);
    }

    public function delete($id)
    {

        $obj = Orm_Criteria::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/criteria');
    }

}
