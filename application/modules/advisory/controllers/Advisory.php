<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Config $config
 * Class Advisory
 */
class Advisory extends MX_Controller
{

    private $view_params = array();

    /**
     * Advisory constructor.
     */
    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();

        $this->logged_user = Orm_User::get_logged_user();
        if (!License::get_instance()->check_module('advisory', true)) {
            show_404();
        }

        $this->view_params['menu_tab'] = 'advisory';

        $this->breadcrumbs->push(lang('Advisory'), '/advisory');
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Advisory'),
            'icon' => 'fa fa-gift'
        ), true);
    }

    /**
     *the function get list
     * @return string the calling function
     */
    private function get_list()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Advisory').' - '.lang('Topics'),
            'icon' => 'fa fa-gift'
        ), true);
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');
        if (!$page) {
            $page = 1;
        }

        $filters = array();
        $array_program = array();
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }
        if (!empty($fltr['program_id']) && $fltr['program_id'] > 0) {
            $filters['id'] = $fltr['program_id'];
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['id'] = Orm_User::get_logged_user()->get_program_id();
        }
        if ($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
            $college_id = Orm_User::get_logged_user()->get_college_id();
            $departments = Orm_Department::get_all(['college_id' => $college_id]);

            foreach ($departments as $dep) {
                $program_id = Orm_Program::get_one(['department_id' => $dep->get_id()]);
                array_push($array_program, $program_id->get_id());
            }
            $filters['in_id'] = $array_program;
        }
        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Student::class) {
            $filters['id'] = Orm_User_Student::get_logged_user()->get_program_id();
        }
        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Faculty::class && $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['id'] = Orm_User::get_logged_user()->get_program_id();
        }
        if (!empty($fltr['college_id']) && $fltr['college_id'] > 0) {
            $filters['college_id'] = $fltr['college_id'];
        }
        if (!empty($fltr['campus_id']) && $fltr['campus_id'] > 0) {
            $filters['campus_id'] = $fltr['campus_id'];
        }
        $programs = Orm_Program::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Program::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['programs'] = $programs;
        $this->view_params['fltr'] = $fltr;
    }

    /**
     *this function get list faculty
     * @return string the calling function
     */
    private function get_list_faculty()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Advisory').' - '.lang('Manage'),
            'icon' => 'fa fa-gift'
        ), true);
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');
        $program_id = 0;
        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }
        if (!$this->logged_user->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
            $filters['user_id'] = $this->logged_user->get_id();

        }
        if (!empty($fltr['program_id']) && $fltr['program_id'] > 0) {
            $filters['program_id'] = $fltr['program_id'];
            $program_id = $filters['program_id'];
        }
        if (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['program_id'] = Orm_User::get_logged_user()->get_program_id();
        }

        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Faculty::class && $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['program_id'] = Orm_User::get_logged_user()->get_program_id();
        }
        if (!empty($fltr['college_id']) && $fltr['college_id'] > 0) {
            $filters['college_id'] = $fltr['college_id'];
        }
        if (!empty($fltr['campus_id']) && $fltr['campus_id'] > 0) {
            $filters['campus_id'] = $fltr['campus_id'];
        }


        $faculties = Orm_Ad_Faculty_Program::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Ad_Faculty_Program::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['all_faculty'] = $faculties;
        $this->view_params['program_id'] = $program_id;
        $this->view_params['fltr'] = $fltr;
    }

    /**
     *this function get list report
     * @return string the calling function
     */
    private function get_list_report()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Advisory').' - '.lang('Report'),
            'icon' => 'fa fa-gift'
        ), true);
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');
        $program_id = 0;
        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if (!empty($fltr['program_id'])) {
            $filters['program_id'] = trim($fltr['program_id']);
        }

        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Faculty::class && $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['faculty_id'] = $this->logged_user->get_id();
        }
        if (!empty($fltr['program_id']) && $fltr['program_id'] > 0) {
            $filters['program_id'] = $fltr['program_id'];
            $program_id = $filters['program_id'];
        }
        if (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['program_id'] = Orm_User::get_logged_user()->get_program_id();
        }

        Modules::load('meeting_minutes');

        $student_selected = Orm_Ad_Student_Faculty::get_all($filters, $page, $per_page);

        $filters['type_class'] = 'Orm_Mm_Meeting_Advisory';

        $meeting = Orm_Mm_Meeting::get_all($filters, $page, $per_page);

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN) || $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {

            $faculty_program = Orm_Ad_Faculty_Program::get_all_group_by_program_id($this->logged_user->get_program_id());

        } elseif ($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {

            $program_ids = array();
            $programs = Orm_Program::get_all(array('college_id' => $this->logged_user->get_college_id()));

            foreach ($programs as $program) {
                $program_ids[] = $program->get_id();
            }

            $faculty_program = Orm_Ad_Faculty_Program::get_all_group_by_program_ids($program_ids);

        } else {
            $faculty_program = Orm_Ad_Faculty_Program::get_all_group_by_program();
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Ad_Student_Faculty::get_count($filters));

        $this->view_params['student_selected'] = $student_selected;
        $this->view_params['faculty_program'] = $faculty_program;
        $this->view_params['meeting_info'] = $meeting;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['program_id'] = $program_id;
        $this->view_params['fltr'] = $fltr;
    }

    /**
     *this function get meeting list
     * @return string the calling function
     */
    private function get_meeting_list()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Advisory').' - '.lang('Meeting'),
            'icon' => 'fa fa-gift'
        ), true);
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        if(License::get_instance()->check_module('meeting_minutes')){
            Modules::load('meeting_minutes');
        }else{
            Validator::set_error_flash_message(lang('Error:Permission Denied'));
            redirect('/advisory');
        }

        $filters = array();

        if (!empty($fltr['institution']) && $fltr['institution'] == 1) {
            $filters['level'] = Orm_Mm_Meeting::INSTITUTION_LEVEL;
        }
        if (!empty($fltr['college_id']) && $fltr['college_id'] > 0) {
            $filters['level'] = Orm_Mm_Meeting::COLLEGE_LEVEL;
            $filters['level_id'] = $fltr['college_id'];
        }
        if (!empty($fltr['program_id']) && $fltr['program_id'] > 0) {
            $filters['level'] = Orm_Mm_Meeting::PROGRAM_LEVEL;
            $filters['level_id'] = $fltr['program_id'];
        }
        if (!empty($fltr['unit_id']) && $fltr['unit_id'] > 0) {
            $filters['level'] = Orm_Mm_Meeting::UNIT_LEVEL;
            $filters['level_id'] = $fltr['unit_id'];
        }
        $filters['type_class'] = 'Orm_Mm_Meeting_Advisory';
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
            $filters = array('level' => Orm_Mm_Meeting::COLLEGE_LEVEL, 'level_id' => $this->logged_user->get_college_id());

        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters = array('level' => Orm_Mm_Meeting::PROGRAM_LEVEL, 'level_id' => $this->logged_user->get_program_id());
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['facilitator_id'] = $this->logged_user->get_id();

        }
        if (!$this->logged_user->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
            $filters['user_id'] = $this->logged_user->get_id();

        }

        $meeting_objs = Orm_Mm_Meeting::get_all($filters,$page,$per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Mm_Meeting::get_count($filters));

        $check = $pager->get_total_count() / 10;
        if ($check <= 1 && $page != 1) {
            redirect('/meeting_minutes/');
        }
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['meeting_objs'] = $meeting_objs;
        $this->view_params['fltr'] = $fltr;
    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {

        if (Orm_User::get_logged_user()->get_class_type() != Orm_User_Student::class) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'menu_view' => 'advisory/sub_menu',
                'menu_params' => array('type' => 'topic')
            ), true);
            $this->get_list();
            $this->layout->view('topic/list', $this->view_params);
        } else {
            $this->get_summary_list();
            $this->layout->view('summary', $this->view_params);

        }

    }

    /**
     *this function manage
     * @return string the html view
     */
    public function manage()
    {
        if (Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            if (Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'advisory-manage')) {
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/advisory/add_edit_faculty" data-toggle="ajaxModal"',
                    'link_title' => lang('Add New'),
                    'link_icon' => 'plus',
                    'menu_view' => 'advisory/sub_menu',
                    'menu_params' => array('type' => 'manage')
                ), true);
            }
        }
        $this->breadcrumbs->push(lang('Manage'), '/manage');
        $this->get_list_faculty();
        $this->layout->view('manage/list', $this->view_params);
    }

    /**
     *this function meeting
     * @return string the html view
     */
    public function meeting()
    {
        if (!Orm_User::has_role_teacher()) {
            if (Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class])) {
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/advisory/add_edit_meeting' . '" data-toggle="ajaxModal"',
                    'link_title' => lang('Add New').' '.lang('Advisory Meetings'),
                    'link_icon' => 'plus'
                ), true);
            }
        }
        if (License::get_instance()->check_module('meeting_minutes', true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'meeting_minutes-manage') == true) {
            Modules::load('meeting_minutes');
        } else {
            Validator::set_error_flash_message(lang("You Don't Have Meeting Minutes"));
            redirect('/advisory');
        }
        if (Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {

            if (Orm_User::check_credential([Orm_User_Faculty::class], false, 'advisory-manage')) {
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/meeting_minutes"',
                    'link_title' => lang('Add New Meeting'),
                    'link_icon' => 'plus',
                    'menu_view' => 'advisory/sub_menu',
                    'menu_params' => array('type' => 'meeting')
                ), true);
            }
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'menu_view' => 'advisory/sub_menu',
            'menu_params' => array('type' => 'meeting')
        ), true);

        $this->get_meeting_list();
        $this->layout->view('manage/meeting/list', $this->view_params);
    }

    /**
     * this function add edit meeting by its id
     * @param int $id the id of the meeting to be viewed
     * @return string the html view
     */
    public function add_edit_meeting($id = 0)
    {
        Modules::load('meeting_minutes');
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        if (!$this->input->is_ajax_request()) {

            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');

        }

        $meeting = Orm_Mm_Meeting::get_instance($id);

        if ($id != 0 && !$meeting->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }


        if ($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {

            if (empty($this->logged_user->get_college_id())) {

                Validator::set_error_flash_message(lang('College not exist'));

                $this->view_params['meeting'] = $meeting;
                exit('<script>window.location.reload();</script>');

            } else {
                $this->view_params['meeting'] = $meeting;
                $this->view_params['user_login'] = $this->logged_user;
                $this->load->view('add_edit', $this->view_params);
            }

        } elseif ($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN) || $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {

            if (empty($this->logged_user->get_college_id())) {

                Validator::set_error_flash_message(lang('College not exist'));
                exit('<script>window.location.reload();</script>');

            } elseif (empty($this->logged_user->get_program_id())) {

                Validator::set_error_flash_message(lang('Program not exist'));
                exit('<script>window.location.reload();</script>');

            } else {
                $this->view_params['meeting'] = $meeting;
                $this->view_params['user_login'] = $this->logged_user;
                $this->load->view('add_edit', $this->view_params);
            }
        } else {

            $this->view_params['meeting'] = $meeting;
            $this->view_params['user_login'] = $this->logged_user;
            $this->load->view('add_edit', $this->view_params);
        }


    }

    /**
     *this function save meeting
     * @redirect success or error
     */
    public function save_meeting()
    {
        Modules::load('meeting_minutes');
        if (!$this->input->is_ajax_request()) {

            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');

        }

        Orm_User::check_permission(array(
                Orm_User::USER_STAFF,
                Orm_User::USER_FACULTY)
            , false, 'meeting_minutes-manage');

        $id = intval($this->input->post('id'));

        if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_NOT_ADMIN) || Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $values = $this->get_data();

            $level = intval($values['level']);
            $college_id = intval($values['college_id']);
            $department_id = intval($values['department_id']);
            $program_id = intval($values['program_id']);

        } else {
            $level = intval($this->input->post('level'));
            $college_id = intval($this->input->post('college_id'));
            $department_id = intval($this->input->post('department_id'));
            $program_id = intval($this->input->post('program_id'));
        }

        $facilitator_id = intval($this->input->post('facilitator_id'));
        $type_class = $this->input->post('type_class');

        $unit_id = intval($this->input->post('unit_id'));
        $room_id = intval($this->input->post('room_id'));
        $room_current_id = intval($this->input->post('current_room_id'));

        $name = $this->input->post('name');
        $date = $this->input->post('date');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');

        $room_id = ($room_id == 0) ? $room_current_id : $room_id;
        $changeDT = $this->input->get('changeDT');

        if ($id == 0) {
            $type_class = in_array($type_class, Orm_Mm_Meeting::get_types()) ? $type_class : Orm_Mm_Meeting_Individual::class;
        } else {
            $meetingT = Orm_Mm_Meeting::get_instance($id);
            $type_class = $meetingT->get_type_class();
        }

        $meeting = Orm_Mm_Meeting_Advisory::get_instance($id);

        if ($type_class == Orm_Mm_Meeting_Advisory::class) {

            if (property_exists($meeting, 'student_ids')) {

                $meeting->student_ids = (array)$this->input->post('student_ids');

                if (empty($meeting->student_ids) && count($meeting->student_ids) == 0) {
                    Validator::not_empty_field_validator('type_id', $meeting->student_ids, lang('You Must select at Least one Student'));
                }

            }
        }


        $start_time = date("H:i:s", strtotime($date . " " . $start_time));
        $end_time = date("H:i:s", strtotime($date . " " . $end_time));
        $start_date = ($date . " " . $start_time);
        $end_date = ($date . " " . $end_time);


        Validator::required_field_validator('name', $name, lang('Required Filed'));
        Validator::database_unique_field_validator($meeting, 'name', 'name', $name, lang('Unique Field'));

        Validator::required_field_validator('facilitator_id', $facilitator_id, lang('Required Filed'));
        Validator::not_empty_field_validator('facilitator_id', $facilitator_id, lang('Required Filed'));


        Validator::required_field_validator('level', $level, lang('Required Filed'));
        Validator::in_array_validator('level', $level, array_keys(Orm_Mm_Meeting::get_levels()), lang('Required Filed'));

        Validator::class_exists_validator('type_class', $type_class, lang('Invalid Type'));
        Validator::in_array_validator('item_class', $type_class, Orm_Mm_Meeting::get_types(), lang('Invalid Type'));

        Validator::required_field_validator('date', $date, lang('It is a required filed to select date.'));
        Validator::date_format_validator('date', $date, lang('It is a required filed to select date.'));

        Validator::required_field_validator('start_time', $start_time, lang('Required Filed'));
        Validator::not_empty_field_validator('start_time', $start_time, lang('Required Filed'));

        Validator::required_field_validator('end_time', $end_time, lang('Required Filed'));
        Validator::not_empty_field_validator('end_time', $end_time, lang('Required Filed'));

        if ($start_date >= $end_date) {
            Validator::set_error('end_time', lang('End Time should be after Start time'));
        }

        $level_id = 0;

        switch ($level) {

            case Orm_Mm_Meeting::COLLEGE_LEVEL:

                Validator::not_empty_field_validator('college_id', $college_id, lang('Required Filed'));

                $level_id = $college_id;
                break;

            case Orm_Mm_Meeting::PROGRAM_LEVEL:

                Validator::not_empty_field_validator('college_id', $college_id, lang('Required Filed'));
                Validator::not_empty_field_validator('department_id', $department_id, lang('Required Filed'));
                Validator::not_empty_field_validator('program_id', $program_id, lang('Required Filed'));

                $level_id = $program_id;
                break;

            case Orm_Mm_Meeting::UNIT_LEVEL:

                Validator::not_empty_field_validator('unit_id', $unit_id, lang('Required Filed'));

                $level_id = $unit_id;
                break;
        }
        if (Orm_Mm_Meeting::need_room()) {

            if ($room_id == 0) {
                Validator::set_error('select_room', lang('Please select room'));
            }

        }

        if ($meeting->can_edit()) {
            $meeting->set_level($level);
            $meeting->set_level_id($level_id);
            $meeting->set_room_id($room_id);
            $meeting->set_facilitator_id($facilitator_id);
            $meeting->set_name($name);
            $meeting->set_start_date($start_date);
            $meeting->set_end_date($end_date);
            $meeting->set_type_class('Orm_Mm_Meeting_Advisory');
        } else {
            Validator::clear();
        }

        if ($id != 0) {
            if ($start_date >= $end_date) {
                Validator::set_error('end_time', lang('End Time should be after Start time'));
            }

            $room_id = ($room_id == 0) ? $room_current_id : $room_id;
            $meeting->set_room_id($room_id);
            $meeting->set_start_date($start_date);
            $meeting->set_end_date($end_date);
        }
        if ($meeting->is_valid() && Validator::success()) {
            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['success' => true, 'id' => $meeting->save()]);
        }
        if (Orm_Mm_Meeting::need_room()) {
            $this->view_params['rooms'] = Orm_Rm_Room_Management::get_all();
        }
        $this->view_params['meeting'] = $meeting;
        $this->view_params['user_login'] = $this->logged_user;
        if ($this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN) && Orm_Mm_Meeting::need_advisory()) {

            json_response(['success' => false, 'html' => $this->load->view('add_edit_advisory', $this->view_params, true)]);
        } else {

            json_response(['success' => false, 'html' => $this->load->view('add_edit', $this->view_params, true)]);
        }


    }

    /**
     *this function student
     * @return string the html view
     */
    public function student()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-list');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'menu_view' => 'advisory/sub_menu',
            'menu_params' => array('type' => 'student')
        ), true);
        $filters = array();
        $faculty_id = Orm_User::get_logged_user()->get_id();

        if (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['program_id'] = Orm_User::get_logged_user()->get_program_id();
        }
        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Faculty::class && $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['faculty_id'] = Orm_User::get_logged_user()->get_id();
        }
        $student_selected = Orm_Ad_Student_Faculty::get_all($filters);

        $this->view_params['student_selected'] = $student_selected;
        $this->view_params['faculty_id'] = $faculty_id;
        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Faculty::class && $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $this->layout->view('student/student_list_for_faculty', $this->view_params);
        }
        if (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $this->layout->view('student/student_list_for_faculty', $this->view_params);
        }
        if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
            $this->layout->view('student/student_list_for_faculty', $this->view_params);
        }
    }

    /**
     *this function filter
     * @return string the html view
     */
    public function filter()
    {

        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('topic/data_table', $this->view_params);
        } else {
            $this->index();
        }

    }

    /**
     *this function filter faculty
     * @return string the html view
     */
    public function filter_faculty()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_list_faculty();
            $this->load->view('manage/data_table', $this->view_params);
        } else {
            $this->manage();
        }

    }

    /**
     *this function filter report
     * @return string the html view
     */
    public function filter_report()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_list_report();
            $this->load->view('report', $this->view_params);
        } else {
            $this->report();
        }

    }

    /**
     * this function add edit topic by its id
     * @param int $id the id of the add edit topic to be viewed
     * @return string the html view
     */
    public function add_edit_topic($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/advisory');
        }

        $topic = Orm_Ad_Advice_Topic::get_instance($id);

        if ($id != 0 && !$topic->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }

        $this->view_params['topic'] = $topic;
        $this->view_params['program_id'] = $topic->get_program_id();
        $this->view_params['department_id'] = Orm_Program::get_instance($topic->get_program_id())->get_department_id();
        $this->view_params['college_id'] = Orm_Program::get_instance($topic->get_program_id())->get_department_obj()->get_college_id();
        $this->view_params['user_login'] = $this->logged_user;
        $this->load->view('topic/add_edit_topic', $this->view_params);

    }


    /**
     * this function add new topic by its program_id
     * @param int $program_id the program_id of the add new topic to be viewed
     * @return string the html view
     */
    public function add_new_topic($program_id)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/advisory');
        }

        if($program_id == 0){
            Validator::set_error_flash_message(lang('PArameter is Missing'));
            redirect('/advisory');
        }

        $topic = Orm_Ad_Advice_Topic::get_instance($program_id);

        $this->view_params['topic'] = $topic;
        $this->view_params['program_id'] = $program_id;
        $this->view_params['user_login'] = $this->logged_user;
        $this->load->view('topic/add_new_topic', $this->view_params);

    }

    /**
     * this function add edit faculty by its id
     * @param int $id the id of the add edit faculty to be viewed
     * @return string the html view
     */
    public function add_edit_faculty($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/advisory');
        }

        $faculty_program = Orm_Ad_Faculty_Program::get_instance($id);

        if ($id != 0 && !$faculty_program->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }
        $this->view_params['faculty_program'] = $faculty_program;
        $this->load->view('manage/add_edit_faculty', $this->view_params);
    }

    /**
     * this function delete by its id
     * @param int $id the id of the button to be viewed
     * @redirect success or error
     */
    public function delete($id)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/advisory');
        }

        $advice = Orm_Ad_Advice_Topic::get_instance($id);

        if (!$advice->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }
        if (isset($id)) {
            if ($advice->get_id()) {
                $advice->delete();
                Validator::set_success_flash_message(lang('Successful Delete'));
            }
        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

    }


    /**
     *this function add advisory
     * @redirect string the html view
     */
    public function add_advisory()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }
        $faculty_program = Orm_Ad_Faculty_Program::get_all();

        $this->view_params['faculty_program'] = $faculty_program;
        $this->load->view('student/add_edit_advisory', $this->view_params);
    }

    /**
     *this function save
     * @redirect success or error
     */
    public function save()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $topic_id = (int)$this->input->post('topic_id');
        $college_id = intval($this->input->post('college_id'));
        $department_id = intval($this->input->post('department_id'));
        $program_id = intval($this->input->post('program_id'));
        $topic_en = $this->input->post('topic_en');
        $topic_ar = $this->input->post('topic_ar');
        $created_by = intval(Orm_User::get_logged_user()->get_id());

        $topic = Orm_Ad_Advice_Topic::get_instance($topic_id);

        Validator::not_empty_field_validator('topic_en', $topic_en, lang('Error: This field is required'));
        Validator::not_empty_field_validator('topic_ar', $topic_ar, lang('Error: This field is required'));
        Validator::not_empty_field_validator('program_id', $program_id, lang('Error: This field is required'));
        Validator::not_empty_field_validator('college_id', $college_id, lang('Error: This field is required'));
        Validator::not_empty_field_validator('department_id', $department_id, lang('Error: This field is required'));

        $topic->set_topic_en($topic_en);
        $topic->set_topic_ar($topic_ar);
        $topic->set_program_id($program_id);
        $topic->set_user_id($created_by);

        if (Validator::success()) {

            $topic->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['status' => true]);
        }
        $this->view_params['topic'] = $topic;

        json_response(['status' => false, 'html' => $this->load->view('topic/add_edit_topic', $this->view_params, true)]);

    }

    /**
     * this function save new topic by its id
     * @param int $id the id of the save new topic to be viewed
     * @redirect success or error
     */
    public function save_new_topic($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $topic_id = (int)$this->input->post('topic_id');
        $program_id = (int)$this->input->post('program_id');
        /** @var $programs Orm_Program */

        $topic_en = $this->input->post('topic_en');
        $topic_ar = $this->input->post('topic_ar');
        $created_by = intval(Orm_User::get_logged_user()->get_id());


        if (!empty($topic_id)):

            $topic = Orm_Ad_Advice_Topic::get_instance($topic_id);

            $topic->set_topic_en($topic_en);
            $topic->set_topic_ar($topic_ar);
            $topic->set_program_id($program_id);
            $topic->set_user_id($created_by);

            Validator::not_empty_field_validator('topic_en', $topic_en, lang('Error: This field is required'));
            Validator::not_empty_field_validator('topic_ar', $topic_ar, lang('Error: This field is required'));

            if (Validator::success()) {

                $topic->save();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['status' => true]);
            }
            $this->view_params['topic'] = $topic;
            $this->view_params['program_id'] = $program_id;

            json_response(['status' => false, 'html' => $this->load->view('topic/add_edit_topic', $this->view_params, true)]);

            endif;

        $topic = Orm_Ad_Advice_Topic::get_instance($id);

        Validator::not_empty_field_validator('topic_en', $topic_en, lang('Error: This field is required'));
        Validator::not_empty_field_validator('topic_ar', $topic_ar, lang('Error: This field is required'));

        if (Validator::success()) {
            $topic->set_topic_en($topic_en);
            $topic->set_topic_ar($topic_ar);
            $topic->set_program_id($program_id);
            $topic->set_user_id($created_by);

            $topic->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['status' => true]);
        }
        $this->view_params['program_id'] = $program_id;

        json_response(['status' => false, 'html' => $this->load->view('topic/add_new_topic', $this->view_params, true)]);

    }


    /**
     *this function save faculty
     * @redirect success or error
     */
    public function save_faculty()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,
                Orm_User::USER_FACULTY)
            , false, 'advisory-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $id = $this->input->post('id');
        $user_ids = $this->input->post('user_ids');
        $program_id = $this->input->post('program_id');


        $facultyProgram = Orm_Ad_Faculty_Program::get_instance($id);

        if ($program_id == 0) {
            Validator::not_empty_field_validator('program_id', $program_id, lang('Please Select Program'));
        }
        if ($user_ids) {

            $vals = array_count_values($user_ids);
            if (count($vals) != count($user_ids)) {

                Validator::set_error('user_ids', lang('Please Select 2 different Users'));
            }

            foreach ($user_ids as $key => $user_id) {
                Validator::not_empty_field_validator('user_id', $user_id, lang('Please Select Users'), $key);
            }
        }
        foreach ($user_ids as $key => $user_id) {
            $exist = Orm_Ad_Faculty_Program::get_count(array('program_id' => $program_id, 'faculty_id' => $user_id));
            if ($exist != 0) {
                Validator::set_error('user_ids', lang('This user already added to this program'));
            }
        }

        if (Validator::success()) {

            foreach ($user_ids as $user_id) {
                $manager = Orm_Ad_Faculty_Program::get_one(array('program_id' => $program_id, 'faculty_id' => $user_id));
                $manager->set_program_id($program_id);
                $manager->set_faculty_id($user_id);
                $manager->save();
            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['status' => true]);
        }
        $this->view_params['user_ids'] = $user_ids;
        $this->view_params['facultyProgram'] = $facultyProgram;
        json_response(['status' => false, 'html' => $this->load->view('manage/add_edit_faculty', $this->view_params, true)]);
    }

    /**
     * this function delete faculty by its faculty id and program id
     * @param int $faculty_id the faculty id of the faculty to be viewed
     * @param int $program_id the program id of the faculty to be viewed
     * @redirect success or error
     */
    public function delete_faculty($faculty_id = 0, $program_id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/advisory');
        }


        $faculty = Orm_Ad_Faculty_Program::get_one(['faculty_id' => $faculty_id, 'program_id' => $program_id]);

        if (!$faculty->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }
        if (isset($faculty_id)) {
            if ($faculty->get_id()) {
                $faculty->delete();
                Validator::set_success_flash_message(lang('Successful Delete'));
            }
        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

    }

    /**
     *this function save advisory student
     * @redirect success or error
     */
    public function save_advisory_student()
    {

        Orm_User::check_permission(array(Orm_User::USER_STAFF,
                Orm_User::USER_FACULTY)
            , false, 'advisory-manage');


        $ids = (array)$this->input->post('student_ids');
        $advisory_id = $this->input->post('faculty_id');
        $program_id = $this->input->post('program');



        if (Validator::success()) {
            Orm_Ad_Student_Faculty::deleteMany(array('faculty_id' => $advisory_id, 'program_id' => $program_id));
            foreach ($ids as $item) {
                $manager = Orm_Ad_Student_Faculty::get_one(array('faculty_id' => $advisory_id, 'student_id' => $item));
                $manager->set_faculty_id($advisory_id);
                $manager->set_student_id($item);
                $manager->set_program_id($program_id);
                $manager->save();
            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect("/advisory/advisory_student/$advisory_id/$program_id");
        }
        Validator::set_error_flash_message(lang('Not Saved'));
        redirect("/advisory/advisory_student/$advisory_id/$program_id");
    }

    /**
     * this function advisory student by its faculty id and program id
     * @param int $faculty_id the faculty id of the advisory student to be viewed
     * @param int $program_id the program id of the advisory student to be viewed
     * @return string the html view
     */
    public function advisory_student($faculty_id = 0, $program_id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'advisory-manage');
        $this->breadcrumbs->push(lang('Manage'), 'advisory/manage');
        $this->breadcrumbs->push(lang('Student'), '/advisory_student');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Advisory').' - '.lang('Manage'),
            'icon' => 'fa fa-gift'
        ), true);
        $fltr = $this->input->get_post('fltr');

        $filters = array();

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $filters['faculty_id'] = $faculty_id;
        $filters['program_id'] = $program_id;

        $student_program = Orm_User_Student::get_all($filters);
        $student_selected = Orm_Ad_Student_Faculty::get_student_ids($filters);


        $this->view_params['student_program'] = $student_program;
        $this->view_params['student_selected'] = $student_selected;
        $this->view_params['faculty_id'] = $faculty_id;
        $this->view_params['program_id'] = $program_id;

        $this->view_params['fltr'] = $fltr;

        $this->layout->view('manage/advisory_student', $this->view_params);

    }

    /**
     * this function view topic by its id
     * @param int $id the id of the topic to be viewed
     * @return string the html view
     */
    public function view_topic($id)
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Advisory').' - '.lang('Topics'),
            'icon' => 'fa fa-gift'
        ), true);

        if (Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'advisory-manage')) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/advisory/add_new_topic/' . $id . '" data-toggle="ajaxModal"',
                'link_title' => lang('Add').' '.lang('Topic'),
                'link_icon' => 'plus'
            ), true);
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');
        if (!$page) {
            $page = 1;
        }
        $this->breadcrumbs->push(lang('View'), '/view_topic');
        $filters = array();
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }
        $filters['program_id'] = $id;
        $program_id = $id;

        $Advices = Orm_Ad_Advice_Topic::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Ad_Advice_Topic::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['all_Advice'] = $Advices;
        $this->view_params['program_id'] = $program_id;
        $this->view_params['fltr'] = $fltr;
        $this->layout->view('topic/view', $this->view_params);
    }

    /**
     *this function report
     * @return string the html view
     */
    public function report()
    {
        if (License::get_instance()->check_module('meeting_minutes') && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'meeting_minutes-manage') == true) {
            Modules::load('meeting_minutes');
        } else {
            Validator::set_error_flash_message(lang("You Don't Have Meeting Minutes"));
            redirect('/advisory');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'menu_view' => 'advisory/sub_menu',
            'menu_params' => array('type' => 'report')
        ), true);

        $this->get_list_report();
        $this->layout->view('list_report', $this->view_params);
    }

    /**
     *this function get summary list
     * @return string the html view
     */
    public function get_summary_list()
    {
        $program_id = 0;
        $user_id = Orm_User::get_logged_user()->get_id();
        $filters = array();

        if (!empty($fltr['program_id']) && $fltr['program_id'] > 0) {
            $filters['program_id'] = $fltr['program_id'];
            $program_id = $filters['program_id'];
        }
        $filters['student_id'] = $user_id;
        $filters['user_id'] = $user_id;
        $filters['type_class'] = 'Orm_Mm_Meeting_Advisory';


        $advisory = Orm_Ad_Student_Faculty::get_one($filters);
        $student_selected = Orm_Ad_Student_Faculty::get_all($filters);

        $this->view_params['advisory'] = $advisory;
        $this->view_params['student_selected'] = $student_selected;

        $this->view_params['meeting_info'] = $advisory->get_meeting();

        $this->view_params['program_id'] = $program_id;
    }
}