<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends MX_Controller
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
        $this->view_params['sub_tab'] = 'department';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Department'),
            'icon' => 'fa fa-table'
        ), true);
    }

    private function get_list() {
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        if (!empty($fltr['campus_in'])) {
            $filters['campus_in'] = $fltr['campus_in'];
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $department = Orm_Department::get_all($filters, $page, $per_page, array('d.college_id ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Department::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['departments'] = $department;
        $this->view_params['fltr'] = $fltr;
    }

    public function index()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-department');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Department'),
            'icon' => 'fa fa-table',
            'link_attr' => 'href="/department/create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Department')
        ), true);

        $this->get_list();

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Department'), '/department');

        $this->layout->view('/department/list', $this->view_params);
    }

    public function filter() {
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('/department/data_table', $this->view_params);
        } else {
            $this->index();
        }
    }

    public function create()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-department');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Department'), '/department');
        $this->breadcrumbs->push(lang('Add').' '.lang('Department'), '/department/create');

        $this->view_params['department'] = new Orm_Department();
        $this->layout->view('/department/create_edit', $this->view_params);
    }

    public function save()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-department');

        // post data
        $id = (int)$this->input->post('id');
        $college_id = (int)$this->input->post('college_id');
        $department_name_ar = $this->input->post('name_ar');
        $department_name_en = $this->input->post('name_en');

        //get instances object
        $obj = Orm_Department::get_instance($id);
        $obj->set_name_ar($department_name_ar);
        $obj->set_name_en($department_name_en);
        $obj->set_college_id($college_id);

        //validation errors
        Validator::required_field_validator('name_ar', $department_name_ar, lang('Please Enter Department Name').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('name_en', $department_name_en, lang('Please Enter Department Name').' ( '.lang('English').' ) ');
        Validator::database_unique_field_validator($obj, 'name_ar', 'name_ar', $department_name_ar, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'name_en', 'name_en', $department_name_en, lang('Unique Field'));
        Validator::not_empty_field_validator('college_id', $college_id, lang('Please Select College'));

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/department');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Department'), '/department');
        $this->breadcrumbs->push(lang('Add').' '.lang('Department'), '/department/create');

        // parameter
        $this->view_params['department'] = $obj;
        $this->layout->view('/department/create_edit', $this->view_params);
    }

    public function edit($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-department');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Department'), '/department');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Department'), '/department/edit/' . $id);

        $this->view_params['department'] = Orm_Department::get_instance($id);
        $this->layout->view('/department/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-department');

        $obj = Orm_Department::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/department');
    }

    public function get_departments($by = 'college')
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        switch ($by) {

            case 'campus':
                $campus_id = intval($this->input->post('campus_id'));
                $list = Orm_Department::get_all(array('campus_id' => $campus_id));
                break;
                
            case 'college':
                $college_id = (int)$this->input->post('college_id');
                $list = Orm_Department::get_all(array('college_id' => $college_id));
                break;

            default:
                $list = array();
                break;
        }

        $options = '<option value="">' . lang('All Department') . '</option>';
        if ($list) {
            foreach ($list as $option) {
                $options .= '<option value="' . $option->get_id() . '">' . htmlfilter($option->get_name()) . '</option>';
            }
        }

        $html = '';
        if (boolval($this->input->post('option_only'))) {
            $html .= $options;
        } else {

            $enable = boolval($this->input->post('enable_programs'));
            $suffix = trim($this->input->post('suffix'));

            $onchange = ($enable ? 'onchange="get_programs_by_department(this);"' : '');

            $html .= '<div class="form-group">';
            $html .= '<label class="control-label">' . lang('Department') . '</label>';
            $html .= "<select name='department_id' class='form-control' {$onchange}>";
            $html .= $options;
            $html .= '</select>';
            $html .= '</div>';

            if ($enable) {
                $html .= '<div id="program_block' . $suffix . '" ></div>';
            }
        }

        exit($html);
    }
}
