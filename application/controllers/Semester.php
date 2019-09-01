<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semester extends MX_Controller
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
        $this->view_params['sub_tab'] = 'semester';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Semester'),
            'icon' => 'fa fa-calendar'
        ), true);
    }

    public function index()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Semester'),
            'icon' => 'fa fa-calendar',
            'link_attr' => 'href="/semester/create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Semester')
        ), true);

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-semester');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        if (!empty($fltr['year'])) {
            $filters['year'] = (int)$fltr['year'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $semesters = Orm_Semester::get_all($filters, $page, $per_page, ['year']);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Semester::get_count($filters));

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Semester'), '/semester');

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['semesters'] = $semesters;
        $this->view_params['fltr'] = $fltr;

        $this->layout->view('/semesters/list', $this->view_params);
    }

    public function create()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-semester');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Semester'), '/semester');
        $this->breadcrumbs->push(lang('Add').' '.lang('Semester'), '/semester/create');

        $this->view_params['semester'] = new Orm_Semester();
        $this->layout->view('/semesters/create_edit', $this->view_params);
    }

    public function save()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-semester');

        // post data
        $id = (int)$this->input->post('id');
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');
        $start = $this->input->post('start');
        $end = $this->input->post('end');

        //get instances object
        $obj = Orm_Semester::get_instance($id);
        $obj->set_name_en($name_en);
        $obj->set_name_ar($name_ar);
        $obj->set_start($start);
        $obj->set_end($end);
        $obj->set_year(date('Y', strtotime($end)));

        //validation errors
        Validator::required_field_validator('name_en', $name_en, lang('Please Enter name').' ( '.lang('English').' ) ');
        Validator::required_field_validator('name_ar', $name_ar, lang('Please Enter name').' ( '.lang('Arabic').' ) ');
        Validator::database_unique_field_validator($obj, 'name_ar', 'name_ar', $name_ar, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'name_en', 'name_en', $name_en, lang('Unique Field'));
        Validator::required_field_validator('start', $start, lang('Please Enter start Date'));
        Validator::required_field_validator('end', $end, lang('Please Enter end Date'));
        Validator::date_range_validator('start', $start, $end, lang('Date Range is Wrong'));

        if (Validator::success()) {
            if (strtotime($end) < strtotime($start)) {
                Validator::set_error('end', lang("Invalid start and end date"));
            }
            if (Orm_Semester::get_count(array('date' => $start, 'not_id' => $id))) {
                Validator::set_error('start', lang("Invalid start and end date"));
            }
        }

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/semester');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Semester'), '/semester');
        $this->breadcrumbs->push(lang('Add').' '.lang('Semester'), '/semester/create');

        // parameter
        $this->view_params['semester'] = $obj;
        $this->layout->view('/semesters/create_edit', $this->view_params);
    }

    public function edit($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-semester');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Semester'), '/semester');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Semester'), '/semester/edit/' . $id);

        $this->view_params['semester'] = Orm_Semester::get_instance($id);
        $this->layout->view('/semesters/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-semester');

        $obj = Orm_Semester::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/semester');
    }

    public function change($id)
    {

        $obj = Orm_Semester::get_instance($id);

        if ($obj->get_id()) {
            $obj->set_active_semester();
        }

        Validator::set_success_flash_message(lang('Successfully Changed'), true);
        redirect($this->input->server('HTTP_REFERER'));
    }

}
