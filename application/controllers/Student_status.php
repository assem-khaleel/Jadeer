<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Input $input
 * @property Layout $layout
 * @property CI_Config $config
 * Class Student_status
 */
class Student_status extends MX_Controller
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
        $this->view_params['sub_tab'] = 'student_status';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Student Status'),
            'icon' => 'fa fa-shield'
        ), true);

    }
    private function get_list(){

    $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
        'title' => lang('Student Status'),
        'icon' => 'fa fa-shield',
        'link_attr' => 'href="/student_status/create"',
        'link_icon' => 'plus',
        'link_title' => lang('Add').' '.lang('Student Status')
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

        $statuses = Orm_Student_Status::get_all($filters, $page, $per_page);

    $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
    $pager->set_page($page);
    $pager->set_per_page($per_page);
    $pager->set_total_count(Orm_Student_Status::get_count($filters));

    $this->view_params['pager'] = $pager->render(true);
    $this->view_params['statuses'] = $statuses;
    $this->view_params['fltr'] = $fltr;

}

    public function index()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-user');

        $this->get_list();
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Student Status'), '/student_status');


        $this->layout->view('/student_status/list', $this->view_params);
    }
    
    public function filter(){
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('/student_status/data_table', $this->view_params);
        } else {
            $this->index();
        }

    }

    public function create()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-user');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Student Status'), '/student_status');
        $this->breadcrumbs->push(lang('Add').' '.lang('Student Status'), '/student_status/create');

        $this->view_params['status'] = new Orm_Student_Status();
        $this->layout->view('/student_status/create_edit', $this->view_params);
    }

    public function save()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-user');

        // post data
        $id = (int)$this->input->post('id');
        $student_status_en = $this->input->post('name_en');
        $student_status_ar = $this->input->post('name_ar');

        //get instances object
        $obj = Orm_Student_Status::get_instance($id);
        $obj->set_name_en($student_status_en);
        $obj->set_name_ar($student_status_ar);

        //validation errors
        Validator::required_field_validator('name_ar', $student_status_ar, lang('Please Enter Student Status Name').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('name_en', $student_status_en, lang('Please Enter Student Status Name').' ( '.lang('English').' ) ');
        Validator::database_unique_field_validator($obj, 'name_ar', 'name_ar', $student_status_ar, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'name_en', 'name_en', $student_status_en, lang('Unique Field'));

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/student_status');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Student Status'), '/student_status');
        $this->breadcrumbs->push(lang('Add').' '.lang('Student Status'), '/student_status/create');

        // parameter
        $this->view_params['status'] = $obj;
        $this->layout->view('/student_status/create_edit', $this->view_params);
    }

    public function edit($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-user');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Student Status'), '/student_status');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Student Status'), '/student_status/edit/' . $id);

        $this->view_params['status'] = Orm_Student_Status::get_instance($id);
        $this->layout->view('/student_status/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-user');

        $obj = Orm_Student_Status::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/student_status');
    }
}
