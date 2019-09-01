<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Degree extends MX_Controller
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
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-degree');

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'degree';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Degree'),
            'icon' => 'fa fa-superscript'
        ), true);

    }

    public function index()
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Degree'),
            'icon' => 'fa fa-superscript',
            'link_attr' => 'href="/degree/create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Degree')
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

        $degrees = Orm_Degree::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Degree::get_count($filters));

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Degree'), '/degree');

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['degrees'] = $degrees;
        $this->view_params['fltr'] = $fltr;

        $this->layout->view('/degree/list', $this->view_params);
    }

    public function create()
    {
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Degree'), '/degree');
        $this->breadcrumbs->push(lang('Add').' '.lang('Degree'), '/degree/create');

        $this->view_params['degree'] = new Orm_Degree();
        $this->layout->view('/degree/create_edit', $this->view_params);
    }

    public function save()
    {
        // post data
        $id = (int)$this->input->post('id');
        $degree_name_en = $this->input->post('name_en');
        $degree_name_ar = $this->input->post('name_ar');
        $is_undergraduate = (int)$this->input->post('is_undergraduate');

        //get instances object
        $obj = Orm_Degree::get_instance($id);
        $obj->set_name_en($degree_name_en);
        $obj->set_name_ar($degree_name_ar);
        $obj->set_is_undergraduate($is_undergraduate);

        //validation errors
        Validator::required_field_validator('name_ar', $degree_name_ar, lang('Please Enter Degree Name').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('name_en', $degree_name_en, lang('Please Enter Degree Name').' ( '.lang('English').' ) ');
        Validator::database_unique_field_validator($obj, 'name_ar', 'name_ar', $degree_name_ar, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'name_en', 'name_en', $degree_name_en, lang('Unique Field'));

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/degree');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Degree'), '/degree');
        $this->breadcrumbs->push(lang('Add').' '.lang('Degree'), '/degree/create');

        // parameter
        $this->view_params['degree'] = $obj;
        $this->layout->view('/degree/create_edit', $this->view_params);
    }

    public function edit($id)
    {

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Degree'), '/degree');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Degree'), '/degree/edit/' . $id);

        $this->view_params['degree'] = Orm_Degree::get_instance($id);
        $this->layout->view('/degree/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        $obj = Orm_Degree::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/degree');
    }

}
