<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Config $config
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Input $input
 * @property Layout $layout
 * Class Course
 */
class Course extends MX_Controller
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
        $this->view_params['sub_tab'] = 'course';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Course'),
            'icon' => 'fa fa-flask'
        ), true);
    }

    private function get_list() {

        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course');

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

        $courses = Orm_Course::get_all($filters, $page, $per_page, array('c.department_id ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['courses'] = $courses;
        $this->view_params['fltr'] = $fltr;
    }


    public function index()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Course'),
            'icon' => 'fa fa-flask',
            'link_attr' => 'href="/course/create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Course')
        ), true);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Courses'), '/course');
        $this->get_list();

        $this->layout->view('/course/list', $this->view_params);
    }

    public function filter() {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course');

        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('/course/data_table', $this->view_params);
        } else {
            $this->index();
        }
    }

    public function create()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Courses'), '/course');
        $this->breadcrumbs->push(lang('Add').' '.lang('Course'), '/course/create');

        $this->view_params['course'] = new Orm_Course();
        $this->layout->view('/course/create_edit', $this->view_params);
    }

    public function save()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course');

        // post data
        $id = (int)$this->input->post('id');
        $course_name_ar = $this->input->post('name_ar');
        $course_name_en = $this->input->post('name_en');
        $course_code_ar = $this->input->post('code_ar');
        $course_code_en = $this->input->post('code_en');
        $type = $this->input->post('type');

        $college_id = (int)$this->input->post('college_id');
        $department_id = (int)$this->input->post('department_id');

        //get instances object
        $obj = Orm_Course::get_instance($id);
        $obj->set_name_en($course_name_en);
        $obj->set_name_ar($course_name_ar);
        $obj->set_code_en($course_code_en);
        $obj->set_code_ar($course_code_ar);
        $obj->set_type($type);
        $obj->set_department_id($department_id);

        //validation errors
        Validator::not_empty_field_validator('college_id', $college_id, lang('Please Select College'));
        Validator::not_empty_field_validator('department_id', $department_id, lang('Please Select Department'));
        Validator::required_field_validator('name_en', $course_name_en, lang('Please Enter Course Name').' ( '.lang('English').' ) ');
        Validator::required_field_validator('name_ar', $course_name_ar, lang('Please Enter Course Name').' ( '.lang('Arabic').' ) ');
        Validator::database_unique_field_validator($obj, 'code_en', 'code_en', $course_code_en, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'code_ar', 'code_ar', $course_code_ar, lang('Unique Field'));
        Validator::required_field_validator('code_en', $course_code_en, lang('Please Enter Course Code').' ( '.lang('English').' ) ');
        Validator::required_field_validator('code_ar', $course_code_ar, lang('Please Enter Course Code').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('type', $type, lang('Please Enter Course Type'));

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/course');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Courses'), '/course');
        $this->breadcrumbs->push(lang('Add').' '.lang('Course'), '/course/create');

        // parameter
        $this->view_params['course'] = $obj;

        $this->view_params['college_id'] = $college_id;
        $this->view_params['department_id'] = $department_id;

        $this->layout->view('/course/create_edit', $this->view_params);
    }

    public function edit($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course');

        $course = Orm_Course::get_instance($id);
        $department = Orm_Department::get_instance($course->get_department_id());

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Courses'), '/course');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Course'), '/course/edit/' . $id);

        $this->view_params['course'] = $course;

        $this->view_params['college_id'] = $department->get_college_id();
        $this->view_params['department_id'] = $course->get_department_id();

        $this->layout->view('/course/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course');

        $obj = Orm_Course::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/course');
    }

    public function find()
    {
        $per_page = 6;
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        $user = Orm_User::get_logged_user();

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['department_id'])) {
            $filters['department_id'] = (int)$fltr['department_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }
        if($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){
            $filters['college_id'] = $user->get_college_id();

        }

        if($user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)){

            $filters['college_id'] = $user->get_college_id();
            $filters['program_id'] = $user->get_program_id();
            $filters['program_plan']= '';

        }
        $courses = Orm_Course::get_all($filters, $page, $per_page, array());

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI'), 'num_elements' => 5));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['courses'] = $courses;
        $this->view_params['fltr'] = $fltr;

        $this->layout->set_layout('layout_blank')->view('/course/find',$this->view_params);
    }

    public function get_courses($by = 'program')
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        switch ($by) {

            case 'program':
                $program_id = intval($this->input->post('program_id'));
                $list = Orm_Course::get_all(array('program_plan' => true, 'program_id' => $program_id));
                break;

            default:
                $list = array();
                break;
        }

        $options = '<option value="">' . lang('All Course') . '</option>';
        if ($list) {
            foreach ($list as $option) {
                $options .= '<option value="' . $option->get_id() . '">' . htmlfilter($option->get_code()) . ' - ' . htmlfilter($option->get_name()) . '</option>';
            }
        }

        $html = '';
        if (boolval($this->input->post('option_only'))) {
            $html .= $options;
        } else {

            $enable = boolval($this->input->post('enable_sections'));
            $suffix = trim($this->input->post('suffix'));

            $onchange = ($enable ? 'onchange="get_sections_by_course(this);"' : '');

            $html .= '<div class="form-group">';
            $html .= '<label class="control-label">' . lang('Course') . '</label>';
            $html .= "<select name='course_id' class='form-control' {$onchange}>";
            $html .= $options;
            $html .= '</select>';
            $html .= '</div>';

            if ($enable) {
                $html .= '<div id="section_block' . $suffix . '" ></div>';
            }
        }

        exit($html);
    }

}
