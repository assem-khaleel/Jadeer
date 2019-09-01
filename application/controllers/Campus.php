<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Campus
 */
class Campus extends MX_Controller
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
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-campus');

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'campus';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Campus'),
           'icon' => 'fa fa-building-o'
        ), true);

    }

    public function index()
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Campus'),
            'icon' => 'fa fa-building-o',
            'link_attr' => 'href="/campus/create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Campus')
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

        $campuses = Orm_Campus::get_all($filters, $page, $per_page);
        //die(print_r($campuses));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Campus::get_count($filters));

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Campus'), '/campus');

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['campuses'] = $campuses;
        $this->view_params['fltr'] = $fltr;

        $this->layout->view('/campus/list', $this->view_params);
    }

    public function create()
    {
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Campus'), '/campus');
        $this->breadcrumbs->push(lang('Add').' '.lang('Campus'), '/campus/create');

//        if(!$this->input->is_ajax_request()){
//            Validator::set_error_flash_message(lang('No direct script access allowed'));
//            redirect('/');
//        }

        $this->view_params['campus'] = new Orm_Campus();
        $this->layout->view('/campus/create_edit', $this->view_params);
    }

    public function save()
    {
        // post data
        $id = (int)$this->input->post('id');
        $campus_name_en = $this->input->post('name_en');
        $campus_name_ar = $this->input->post('name_ar');

        //get instances object
        $obj = Orm_Campus::get_instance($id);
        $obj->set_name_en($campus_name_en);
        $obj->set_name_ar($campus_name_ar);

        //validation errors
        Validator::required_field_validator('name_ar', $campus_name_ar, lang('Please Enter Campus Name').' '.lang('Arabic'));
        Validator::required_field_validator('name_en', $campus_name_en, lang('Please Enter Campus Name').' '.lang('English'));
        Validator::database_unique_field_validator($obj, 'name_ar', 'name_ar', $campus_name_ar, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'name_en', 'name_en', $campus_name_en, lang('Unique Field'));

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/campus');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Campus'), '/campus');
        $this->breadcrumbs->push(lang('Add').' '.lang('Campus'), '/campus/create');

        // parameter
        $this->view_params['campus'] = $obj;
        $this->layout->view('/campus/create_edit', $this->view_params);
    }

    public function edit($id)
    {

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Campus'), '/campus');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Campus'), '/campus/edit/' . $id);

        $this->view_params['campus'] = Orm_Campus::get_instance($id);
        $this->layout->view('/campus/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        $obj = Orm_Campus::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/campus');
    }

}