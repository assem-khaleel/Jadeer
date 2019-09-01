<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * @property Layout $layout
 * @property CI_Input $input
 * Class Program
 */
class Program extends MX_Controller
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
        $this->view_params['sub_tab'] = 'program';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program'),
            'icon' => 'fa fa-gears'
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

        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['department_id'])) {
            $filters['department_id'] = (int)$fltr['department_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }
        if (!empty($fltr['degree_id'])) {
            $filters['degree_id'] = (int) $fltr['degree_id'];
        }

        $program = Orm_Program::get_all($filters, $page, $per_page, array('p.department_id ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_program::get_count($filters));



        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['programs'] = $program;
        $this->view_params['fltr'] = $fltr;
    }

    public function index()
    {

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-program');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program'),
            'icon' => 'fa fa-gears',
            'link_attr' => 'href="/program/create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Program')
        ), true);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Program'), '/program');

        $this->get_list();

        $this->layout->view('/program/list', $this->view_params);
    }

    public function filter() {
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('/program/data_table', $this->view_params);
        } else {
            $this->index();
        }
    }

    public function create()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-program');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Program'), '/program');
        $this->breadcrumbs->push(lang('Add').' '.lang('Program'), '/program/create');

        $this->view_params['program'] = new Orm_Program();
        $this->layout->view('/program/create_edit', $this->view_params);
    }

    public function save()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-program');

        // post data
        $id = (int)$this->input->post('id');
        $college_id = (int)$this->input->post('college_id');
        $department_id = (int)$this->input->post('department_id');
        $program_name_ar = $this->input->post('name_ar');
        $program_name_en = $this->input->post('name_en');
        $degree_id = (int)$this->input->post('degree_id');


        //get instances object
        $obj = Orm_Program::get_instance($id);
        $obj->set_name_en($program_name_en);
        $obj->set_name_ar($program_name_ar);
        $obj->set_department_id($department_id);
        $obj->set_degree_id($degree_id);

        //validation errors
        Validator::required_field_validator('name_ar', $program_name_ar, lang('Please Enter Program Name').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('name_en', $program_name_en, lang('Please Enter Program Name').' ( '.lang('English').' ) ');
        Validator::database_unique_field_validator($obj, 'name_ar', 'name_ar', $program_name_ar, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'name_en', 'name_en', $program_name_en, lang('Unique Field'));
        Validator::not_empty_field_validator('college_id', $college_id, lang('Please Select College'));
        Validator::not_empty_field_validator('department_id', $department_id, lang('Please Select Department'));
        Validator::not_empty_field_validator('degree_id', $degree_id, lang('Please Select Degree'));

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/program');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Program'), '/program');
        $this->breadcrumbs->push(lang('Add').' '.lang('Program'), '/program/create');

        // parameter
        $this->view_params['college_id'] = $college_id;
        $this->view_params['department_id'] = $department_id;
        $this->view_params['program'] = $obj;
        $this->layout->view('/program/create_edit', $this->view_params);
    }

    public function edit($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-program');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Program'), '/program');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Program'), '/program/edit/' . $id);

        $this->view_params['program'] = Orm_Program::get_instance($id);
        $this->layout->view('/program/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-program');

        $obj = Orm_Program::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/program');
    }

    public function get_programs($by = 'department')
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        switch ($by) {
            case 'campus':
                $campus_id = intval($this->input->post('campus_id'));
                $list = Orm_Program::get_all(array('campus_id' => $campus_id));
                break;

            case 'college':
                $college_id = intval($this->input->post('college_id'));
                $list = Orm_Program::get_all(array('college_id' => $college_id));
                break;

            case 'department':
                $department_id = intval($this->input->post('department_id'));
                $list = Orm_Program::get_all(array('department_id' => $department_id));
                break;

            default:
                $list = array();
                break;
        }

        $options = '<option value="">' . lang('All Program') . '</option>';
        if ($list) {
            foreach ($list as $option) {
                $options .= '<option value="' . $option->get_id() . '">' . htmlfilter($option->get_name()) . '</option>';
            }
        }

        $html = '';
        if (boolval($this->input->post('option_only'))) {
            $html .= $options;
        } else {

            $enable = boolval($this->input->post('enable_courses'));
            $suffix = trim($this->input->post('suffix'));

            $onchange = ($enable ? 'onchange="get_courses_by_program(this);"' : '');

            $html .= '<div class="form-group">';
            $html .= '<label class="control-label">' . lang('Program') . '</label>';
            $html .= "<select name='program_id' class='form-control' {$onchange}>";
            $html .= $options;
            $html .= '</select>';
            $html .= '</div>';

            if ($enable) {
                $html .= '<div id="course_block' . $suffix . '" ></div>';
            }
        }

        exit($html);
    }

    public function vision_mission($id) {

        $program = Orm_Program::get_instance($id);

        if (!$program->get_id()) {
            redirect('/program');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program') . ' ' . lang('Mission & Vision') . ': ' . htmlfilter($program->get_name()),
            'icon' => 'fa fa-university'
        ), true);

        $this->breadcrumbs->push(lang('Program'), '/program');
        $this->breadcrumbs->push(lang('Vision & Mission'), '/program/vision_mission/' . $id);

        $this->view_params['program'] = $program;

        $this->layout->view('program/vision_mission', $this->view_params);

    }
}
