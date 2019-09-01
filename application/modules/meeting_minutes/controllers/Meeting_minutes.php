<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 05/03/2017
 * Time: 01:22 AM
 */
class Meeting_minutes extends MX_Controller
{

    private $view_params = array();
    /** @var \Orm_User_Staff | Orm_User_Faculty */
    private $logged_user;

    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('meeting_minutes', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->logged_user = Orm_User::get_logged_user();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-list');

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js', false);

        $this->breadcrumbs->push(lang('Meeting Minutes'), '/meeting_minutes');
        $this->view_params['menu_tab'] = 'meeting_minutes';
        $this->view_params['user'] = $this->logged_user;


        if (Orm_Mm_Meeting::need_room()) {
            Modules::load('room_management');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Meeting Minutes'),
            'icon' => 'fa fa-plus',
        ), true);

    }

    /** get list of meeting object and fetch two modules committee_work and advisory
     * check on meeting object if there is id and related this with advisory and committee work  and list them depending on filters
    */

    public function get_list()
    {
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        $meetingUserAttendee = array_column(Orm_Mm_Attendance::get_model()->get_all(['user_id' => Orm_User::get_logged_user_id()],0,0,[],Orm::FETCH_ARRAY), 'meeting_id');

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

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN))
        {
            if (empty($fltr['unit_id'])):
            $filters['structure'] = [
                'college_level' => Orm_Mm_Meeting::COLLEGE_LEVEL,
                'college_id' => $this->logged_user->get_college_id(),
                'program_level' => Orm_Mm_Meeting::PROGRAM_LEVEL,
                'program_id' => !empty($fltr['program_id']) && $fltr['program_id'] > 0 ? [$fltr['program_id']] : (array_merge(array_column(Orm_Program::get_model()->get_all(['college_id'=>$this->logged_user->get_college_id()],0,0,[],Orm::FETCH_ARRAY),'id'), [0])),
                'unit_level' => Orm_Mm_Meeting::UNIT_LEVEL,
                'id_in' => array_merge($meetingUserAttendee, [0])
            ];
            else:
                $filters['structure'] = [
                    'college_level' => Orm_Mm_Meeting::COLLEGE_LEVEL,
                    'college_id' => $this->logged_user->get_college_id(),
                    'program_level' => Orm_Mm_Meeting::PROGRAM_LEVEL,
                    'program_id' => !empty($fltr['program_id']) && $fltr['program_id'] > 0 ? [$fltr['program_id']] : (array_merge(array_column(Orm_Program::get_model()->get_all(['college_id'=>$this->logged_user->get_college_id()],0,0,[],Orm::FETCH_ARRAY),'id'), [0])),
                    'unit_level' => Orm_Mm_Meeting::UNIT_LEVEL,
                    'unit_id' => $fltr['unit_id'],
                    'id_in' => array_merge($meetingUserAttendee, [0])
                ];
            endif;
        }
        if ($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            if (empty($fltr['unit_id'])):
            $filters['structure'] = [
                'program_level' => Orm_Mm_Meeting::PROGRAM_LEVEL,
                'program_id' => $this->logged_user->get_program_id(),
                'unit_level' => Orm_Mm_Meeting::UNIT_LEVEL,
                'id_in' => array_merge($meetingUserAttendee, [0])
            ];
            else:
                $filters['structure'] = [
                    'program_level' => Orm_Mm_Meeting::PROGRAM_LEVEL,
                    'program_id' => $this->logged_user->get_program_id(),
                    'unit_level' => Orm_Mm_Meeting::UNIT_LEVEL,
                    'unit_id' => $fltr['unit_id'],
                    'id_in' => array_merge($meetingUserAttendee, [0])
                ];
                endif;
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['facilitator_id'] = $this->logged_user->get_id();

        }
        if (!$this->logged_user->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
            $filters['user_id'] = $this->logged_user->get_id();

        }
        if (!License::get_instance()->check_module('committee_work', false)) {
            $filters['not_type_class'][] = 'Orm_Mm_Meeting_Committee';
        }
        if (!License::get_instance()->check_module('advisory', false)) {
            $filters['not_type_class'][] = 'Orm_Mm_Meeting_Advisory';
        }

        $meeting_objs = Orm_Mm_Meeting::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Mm_Meeting::get_count($filters));
        $check = $pager->get_total_count() / 10;
        if ($check <= 1 && $page != 1) {
            redirect('/meeting_minutes/');
        }
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['meeting_obj'] = $meeting_objs;
        $this->view_params['fltr'] = $fltr;
    }
/** index page for meetings
 * get list from the previous functions and render function in list view
*/
    public function index()
    {

        if (Orm_Mm_Meeting::check_if_can_add()) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/meeting_minutes/add_edit" data-toggle="ajaxModal"',
                'link_title' => lang('Add') . ' ' . lang('Meeting Minutes'),
                'link_icon' => 'plus'
            ), true);
        }

        $this->get_list();

        $this->layout->view('meeting_minutes/list', $this->view_params);

    }

    /** filter request
     * if request is ajax render it to data table view else that to index view
    */

    public function filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('data_table', $this->view_params);
        } else {
            $this->index();
        }
    }

    /**
     * add meeting object if there is no one or edit it
     * add meting depending on many permissins and crediontals and render it to add_edit view
    */
    public function add_edit($id = 0)
    {
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

    /** manage meetings in available room
     * fetch room_management module and check if rooms available for meeting and render it in search room view
    */

    public function load_room($check = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        if ($check == 0) {
            if (!$this->input->is_ajax_request()) {

                Validator::set_error_flash_message(lang('No direct script access allowed'));
                redirect('/');

            }
        }

        if (Orm_Mm_Meeting::need_room()) {

            $current_room_id = $this->input->get('current_room_id');
            $start_time = $this->input->get('start_time');
            $end_time = $this->input->get('end_time');
            $date = $this->input->get('date');
            $changeDT = $this->input->get('changeDT');
            $fltr = $this->input->get_post('fltr');

            Validator::date_format_validator('date', $date, lang('It is a required filed to select date.'));
            Validator::required_field_validator('date', $date, lang('It is a required filed to select date.'));
            Validator::required_field_validator('start_time', $start_time, lang('Required Filed'));
            Validator::not_empty_field_validator('start_time', $start_time, lang('Required Filed'));
            Validator::required_field_validator('end_time', $end_time, lang('Required Filed'));
            Validator::not_empty_field_validator('end_time', $end_time, lang('Required Filed'));
            Validator::date_range_validator('end_time', $start_time, $end_time, lang('End Time should be after Start time'));

            $filters = array();
            $per_page = 5;

            $page = (int)$this->input->get_post('page');

            $keyword = trim($this->input->get_post('keyword') ?: '');

            if (!$page) {
                $page = 1;
            }

            if ($keyword != '') {
                $filters['name_like'] = $keyword;
            }

            $room_not_ave = $this->check_if_room_taken($date, $start_time, $end_time);


            if (($key = array_search($current_room_id, $room_not_ave)) !== false) {
                unset($room_not_ave[$key]);
            }

            $filters['not_in_id'] = $room_not_ave;

            $this->view_params['rooms'] = Orm_Rm_Room_Management::get_all($filters, $page, $per_page);
            $this->view_params['viewRooms'] = 0;
            $this->view_params['current_room_id'] = $current_room_id;
            $this->view_params['error'] = Validator::get_errors();

            if (Validator::success()) {
                $this->view_params['viewRooms'] = 1;
            }
            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_Rm_Room_Management::get_count($filters));
            $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="search-tab"');

            $this->view_params['pager'] = $pager->render(true);
            $this->view_params['fltr'] = $fltr;

            $this->load->view('search_room', $this->view_params);
        }

    }

    /** room object checking
     * check if room taking and reserved for meeting depending on date , start time , end time
    */

    public function check_if_room_taken($date = '0000-00-00', $start_time = '00-00', $end_time = '00-00')
    {

        $start_time = date("H:i:s", strtotime($date . " " . $start_time));
        $end_time = date("H:i:s", strtotime($date . " " . $end_time));
        $start_date = ($date . " " . $start_time);
        $end_date = ($date . " " . $end_time);

        return array_column(Orm_Mm_Meeting::get_model()->get_all(
            array(
                'date' => $date,
                'time_between' => true,
                'start_date' => $start_date,
                'end_date' => $end_date
            )
            , 0, 0, array(), Orm::FETCH_ARRAY),
            'room_id');
    }


    /** save meeting object
     * save meeting object after checking it if it connect with advisory to fill up advisory module and connect with room managment for reserved room
    */
    public function save()
    {
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

        $meeting = $type_class::get_instance($id);

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
            $meeting->set_type_class($type_class);
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

    /** get data as array
     *  get data for meeting depending on levels of meeting and return array
    */
    private function get_data()
    {
        $user = array();
        $user['level'] = Orm_Mm_Meeting::PROGRAM_LEVEL;
        $user['college_id'] = $this->logged_user->get_college_id();
        $user['department_id'] = $this->logged_user->get_department_id();
        $user['program_id'] = $this->logged_user->get_program_id();
        return $user;
    }


    /** draw proprities depending on tyoe class for meeting room object
     * print and draw meeting room charts depending on type class
    */
    public function draw_properties()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $id = $this->input->post_get('id');
        $type_class = $this->input->post_get('type_class');
        /** @var Orm_Mm_Meeting $type_class */

        $type_class = in_array($type_class, Orm_Mm_Meeting::get_types()) ? $type_class : Orm_Mm_Meeting::class;

        echo $type_class::get_instance($id)->draw_properties();
    }

    /** delete meeting
     * delete meeting depending on meeting id
    */
    public function delete($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $meeting = Orm_Mm_Meeting::get_instance($id);

        if ($meeting->get_id()) {
            $meeting->delete();
            Validator::set_success_flash_message(lang('Successful Delete'));
            exit();
        }
        Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
        redirect('/');
    }

    /** meeting details page
     * if meeting is exist change header tio meeting_id details
    */
    public function details($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');


        $meeting = Orm_Mm_Meeting::get_instance($id);


        if (!$meeting->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }


        $this->change_header($meeting);

        $this->breadcrumbs->push(lang('Details'), '/meeting_minutes/details/' . $id);

        $this->view_params['sub_menu'] = 'manage';

        $this->view_params['tab'] = 'details';
        $this->view_params['meeting'] = $meeting;
        $this->layout->view('manage/details', $this->view_params);
    }


    /** meeting objective
     * check if there is objective for meeting and render data in list view
    */
    public function objective($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $this->view_params['meeting'] = Orm_Mm_Meeting::get_instance($id);

        if (!$this->view_params['meeting']->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }

        $this->change_header($this->view_params['meeting']);

        $this->breadcrumbs->push(lang('Objectives'), '/meeting_minutes/objective/' . $id);

        $this->view_params['sub_menu'] = 'manage';

        $this->view_params['tab'] = 'objective';

        $this->layout->view('manage/objective/list', $this->view_params);
    }


    /** edit objective of meeting
     * edit objective of meeting if exist and render it in add_edit view
    */
    public function objective_edit($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $meeting = Orm_Mm_Meeting::get_instance($id);

        if (!$meeting->get_id()) {
            echo error_dialog();
            redirect('/');
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $objective = $this->input->post('objective');

            $meeting->set_objective($objective);
            $meeting->save();
            Validator::set_success_flash_message(lang('Successfully Saved'));

            json_response(['status' => true]);
        }

        $this->view_params['meeting'] = $meeting;

        $this->load->view('/manage/objective/add_edit', $this->view_params);
    }

    /** organise minutes of meeting
     * display meeting of minutes , organise them and render them in list view
    */
    public function minutes($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $this->view_params['meeting'] = Orm_Mm_Meeting::get_instance($id);

        if (!$this->view_params['meeting']->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/dashboard');
        }

        $this->change_header($this->view_params['meeting']);

        $this->breadcrumbs->push(lang('Minutes'), '/meeting_minutes/minutes/' . $id);

        $this->view_params['sub_menu'] = 'manage';

        $this->view_params['tab'] = 'minutes';

        $this->layout->view('manage/minutes/list', $this->view_params);
    }


    /** edit minutes of meeting
     * edit it if exist and modify file attachemnts related to it
    */
    public function minutes_edit($id = 0)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $meeting = Orm_Mm_Meeting::get_instance($id);

        if (!$meeting->get_id()) {
            echo error_dialog();
            exit();
        }

        $this->view_params['meeting'] = $meeting;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $minutes = $this->input->post('meeting_minutes');

            $meeting->set_meeting_minutes($minutes);

            Uploader::common_validator('attachment', 'attachment');
            Uploader::zero_size_validator('attachment', 'attachment', lang('File not found.'));
            Uploader::max_size_validator('attachment', 'attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));

            if (Validator::success()) {

                $files_dir = '/files/Documents/' . $meeting->get_attachments_directory();

                //check if file exists or not
                $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
                if (!is_dir($files_fulldir)) {
                    mkdir($files_fulldir, 0777, true);
                }

                $attachment = $files_dir . '/meeting_minutes-' . date('Y_m_d') . '.' . pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
                Uploader::move_file_to('attachment', rtrim(FCPATH, '/') . $attachment);

                $meeting->set_meeting_minutes_attachment($attachment);
            } elseif (!$meeting->get_meeting_minutes_attachment()) {
                $meeting->set_meeting_minutes_attachment('');
            }

            $meeting->save();
            Validator::set_success_flash_message(lang('Successfully Saved'));

            json_response(['status' => true]);
        }


        $this->load->view('/manage/minutes/add_edit', $this->view_params);
    }


    /**meeting agenda
     * get lists of agenda depending orm_mm_agenda for meeting _id
    */
    public function agenda($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $meeting = Orm_Mm_Meeting::get_instance($id);

        if (!$meeting->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->change_header($meeting);

        $this->breadcrumbs->push(lang('Agenda'), '/meeting_minutes/agenda/' . $id);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Mm_Agenda::get_count(['meeting_id' => $id]));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['meeting'] = $meeting;
        $this->view_params['agendas'] = Orm_Mm_Agenda::get_all(['meeting_id' => $id], $page, $per_page);

        $this->view_params['fltr'] = $fltr;

        $this->view_params['sub_menu'] = 'manage';

        $this->view_params['tab'] = 'agenda';


        $this->layout->view('manage/agenda/list', $this->view_params);
    }


    /** add edit agenda
     *  add agenda if dosnt exist or edit it if exist
    */
    public function agenda_add_edit($meeting_id = 0, $id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');


        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }


        $this->view_params['meeting'] = Orm_Mm_Meeting::get_instance($meeting_id);

        if (!$this->view_params['meeting']->get_id()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                json_response(['status' => false, 'html' => error_dialog()]);
            }
            echo error_dialog();
            exit();
        }

        $this->view_params['agenda'] = Orm_Mm_Agenda::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            if( $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN) && Orm_Mm_Meeting::need_advisory()) {
                $user_id = intval($this->logged_user->get_id());

            }else{
                $user_id = intval($this->input->post('user_id'));

                Validator::required_field_validator('user_id', $user_id, lang('Required Filed'));
                Validator::less_than_validator('user_id', $user_id, 1, lang('Required Filed'));
            }
            $topic = $this->input->post('topic');


            Validator::required_field_validator('topic', $topic, lang('Required Filed'));
            Validator::not_empty_field_validator('topic', $topic, lang('Required Filed'));


            $this->view_params['agenda']->set_meeting_id($meeting_id);
            $this->view_params['agenda']->set_user_id($user_id);
            $this->view_params['agenda']->set_topic($topic);

            if (Validator::success()) {
                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['status' => true, 'id' => $this->view_params['agenda']->save()]);
            }

            json_response(['status' => false, 'html' => $this->load->view('manage/agenda/add_edit', $this->view_params, true)]);
        }

        $this->load->view('manage/agenda/add_edit', $this->view_params);

    }

    /** attachemnt for agenda
     * set attachments for agenda and upload it to correct path and save them in database
    */
    public function agenda_attachment($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $meeting = Orm_Mm_Meeting::get_instance($id);

        if (!$meeting->get_id()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                json_response(['status' => false, 'html' => error_dialog()]);
            }
            echo error_dialog();
            exit();
        }

        $this->view_params['meeting'] = $meeting;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            Uploader::common_validator('attachment', 'attachment');
            Uploader::zero_size_validator('attachment', 'attachment', lang('File not found.'));
            Uploader::max_size_validator('attachment', 'attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));

            if (Validator::success()) {
                $files_dir = '/files/Documents/' . $meeting->get_attachments_directory();

                //check if file exists or not
                $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
                if (!is_dir($files_fulldir)) {
                    mkdir($files_fulldir, 0777, true);
                }

                $attachment = $files_dir . '/agenda-' . date('Y_m_d') . '.' . pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
                Uploader::move_file_to('attachment', rtrim(FCPATH, '/') . $attachment);
            } else {
                $attachment = '';
            }

            $meeting->set_agenda_attachment($attachment);
            if (Validator::success()) {
                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['status' => true, 'id' =>$meeting->save()]);
            }

            json_response(['status' => false, 'html' => $this->load->view('manage/agenda/attachment', $this->view_params, true)]);
        }

        $this->load->view('manage/agenda/attachment', $this->view_params);

    }


    /** Delete agenda
     * delete agenda if exist and redirect to parent page
    */
    public function agenda_delete($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $agenda = Orm_Mm_Agenda::get_instance($id);


        if ($agenda->get_id() && $agenda->get_meeting_id(true)->check_if_can_delete()) {
            $agenda->delete();
            Validator::set_success_flash_message(lang('Successful Delete'));
            exit();
        }

        Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
        redirect('/');
    }

    /** attendance for meeting
     *  get list of attendances related to meeting and render them in list view
    */

    public function attendance($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $meeting = Orm_Mm_Meeting::get_instance($id);

        if (!$meeting->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $this->change_header($meeting);

        $this->breadcrumbs->push(lang('Attendance'), '/meeting_minutes/attendance/' . $id);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Mm_Attendance::get_count(['meeting_id' => $id]));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['meeting'] = $meeting;
        $this->view_params['attendances'] = Orm_Mm_Attendance::get_all(['meeting_id' => $id], $page, $per_page);
        $this->view_params['fltr'] = $fltr;

        $this->view_params['sub_menu'] = 'manage';

        $this->view_params['tab'] = 'attendance';


        $this->layout->view('manage/attendance/list', $this->view_params);
    }


    /** add attendance
     * add attendance either internal attendance or external attendance save them and render them in add view
     */

    public function attendance_add($meeting_id = 0)
    {

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'meeting_minutes-manage');


        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $this->view_params['meeting'] = Orm_Mm_Meeting::get_instance($meeting_id);

        if (!$this->view_params['meeting']->get_id()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                json_response(['status' => false, 'html' => error_dialog()]);
            }
            echo error_dialog();
            exit();
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $user_arr = (array)$this->input->post('attendance');
            $ex_user_arr = (array)$this->input->post('external_attendance');

            $added = false;


            foreach ($user_arr as $user) {
                if (($user['user'] = intval($user['user'])) > 0) {

                    $attendance = Orm_Mm_Attendance::get_one(['user_id' => $user['user'], 'meeting_id' => $meeting_id]);

                    $attendance->set_meeting_id($meeting_id);
                    $attendance->set_user_id($user['user']);
                    $attendance->set_attended(isset($user['attend']) ? $user['attend'] : 0);

                    $attendance->save();
                    $added = true;
                }
            }

            foreach ($ex_user_arr as $user) {
                if (($user['user'] = trim($user['user'])) != '') {

                    $attendance = new Orm_Mm_Attendance();

                    $attendance->set_meeting_id($meeting_id);
                    $attendance->set_external_user_name($user['user']);
                    $attendance->set_attended(isset($user['attend']) ? $user['attend'] : 0);

                    $attendance->save();
                    $added = true;
                }
            }

            if (!$added) {
                Validator::set_error('attendance_ids', lang('You have to select at least one user'));
                Validator::set_error('external_attendance_ids', lang('You have to insert at least one user'));
            }

            if (Validator::success()) {
                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['status' => true]);
            }

            json_response(['status' => false, 'html' => $this->load->view('manage/attendance/add', $this->view_params, true)]);
        }

        $this->load->view('manage/attendance/add', $this->view_params);

    }

    /** edit attendance
     * edit attendance if exit , it will render in edit view
    */

    public function attendance_edit($id = 0)
    {

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');


        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $this->view_params['attend'] = Orm_Mm_Attendance::get_instance($id);

        if (!$this->view_params['attend']->get_id()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                json_response(['status' => false, 'html' => error_dialog()]);
            }
            echo error_dialog();
            exit();
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $user_id = intval($this->input->post('user_id'));
            $attend = $this->input->post('attend');
            $name = trim($this->input->post('name'));


            if ($user_id == 0 && $name == '') {
                Validator::set_error('user_id', lang('Required Filed'));
                Validator::set_error('name', lang('Required Filed'));

            } elseif ($user_id != 0 && Orm_Mm_Attendance::get_one(['user_id' => $user_id, 'meeting_id' => $this->view_params['attend']->get_meeting_id(), 'not_id' => $id])->get_id()) {
                Validator::set_error('user_id', lang('This user is exist'));
            }

            if (Validator::success()) {

                $this->view_params['attend']->set_user_id($user_id);
                $this->view_params['attend']->set_external_user_name($name);
                $this->view_params['attend']->set_attended($attend == 'on' ? 1 : 0);
                $this->view_params['attend']->save();
                Validator::set_success_flash_message(lang('Successfully Saved'));

                json_response(['status' => true]);
            }

            json_response(['status' => false, 'html' => $this->load->view('manage/attendance/edit', $this->view_params, true)]);
        }

        $this->load->view('manage/attendance/edit', $this->view_params);

    }

    /** delete attendance
     * if attendence if exist delete it
    */
    public function attendance_delete($id = 0)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'meeting_minutes-manage');

        $attendance = Orm_Mm_Attendance::get_instance($id);

        if ($attendance->get_id() && $attendance->get_meeting_id(true)->check_if_can_delete()) {
            $attendance->delete();
            Validator::set_success_flash_message(lang('Successful Delete'));
            exit();
        }

        Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
        redirect('/');
    }


    /** meeting actions
     * get actions of meeting and render them in list view
    */
    public function action($id = 0)
    {

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $meeting = Orm_Mm_Meeting::get_instance($id);

        if (!$meeting->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }

        $this->change_header($meeting);

        $this->breadcrumbs->push(lang('Action'), '/meeting_minutes/action/' . $id);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Mm_Action::get_count(['meeting_id' => $id]));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['meeting'] = $meeting;
        $this->view_params['actions'] = Orm_Mm_Action::get_all(['meeting_id' => $id], $page, $per_page);
        $this->view_params['fltr'] = $fltr;

        $this->view_params['sub_menu'] = 'manage';

        $this->view_params['tab'] = 'action';


        $this->layout->view('manage/action/list', $this->view_params);
    }


    /** add or edit action
     *
     * add action if dosnt exit or edit it if is exist
    */
    public function action_add_edit($meeting_id = 0, $id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $this->view_params['meeting'] = Orm_Mm_Meeting::get_instance($meeting_id);

        if (!$this->view_params['meeting']->get_id()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                json_response(['status' => false, 'html' => error_dialog()]);
            }
            echo error_dialog();
            exit();

        }

        $this->view_params['action'] = Orm_Mm_Action::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $Owner_name = trim($this->input->post('owner_name'));
            $action = trim($this->input->post('action'));
            $due = trim($this->input->post('due'));


            Validator::required_field_validator('owner_name', $Owner_name, lang('Required Filed'));
            Validator::not_empty_field_validator('owner_name', $Owner_name, lang('Required Filed'));

            Validator::required_field_validator('action', $action, lang('Required Filed'));
            Validator::not_empty_field_validator('action', $action, lang('Required Filed'));

            Validator::required_field_validator('due', $due, lang('Required Filed'));
            Validator::not_empty_field_validator('due', $due, lang('Required Filed'));


            $this->view_params['action']->set_meeting_id($meeting_id);
            $this->view_params['action']->set_owner_name($Owner_name);
            $this->view_params['action']->set_action($action);
            $this->view_params['action']->set_due($due);

            if (Validator::success()) {
                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['status' => true, 'id' => $this->view_params['action']->save()]);
            }

            json_response(['status' => false, 'html' => $this->load->view('manage/action/add_edit', $this->view_params, true)]);
        }

        $this->load->view('manage/action/add_edit', $this->view_params);

    }


    /** action attachment
     * get attachment of action and upload them to correct path and save in database
    */
    public function action_attachment($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $meeting = Orm_Mm_Meeting::get_instance($id);

        if (!$meeting->get_id()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                json_response(['status' => false, 'html' => error_dialog()]);
            }
            echo error_dialog();
            exit();
        }

        $this->view_params['meeting'] = $meeting;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            Uploader::common_validator('attachment', 'attachment');
            Uploader::zero_size_validator('attachment', 'attachment', lang('File not found.'));
            Uploader::max_size_validator('attachment', 'attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));

            if (Validator::success()) {
                $files_dir = '/files/Documents/' . $meeting->get_attachments_directory();

                //check if file exists or not
                $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
                if (!is_dir($files_fulldir)) {
                    mkdir($files_fulldir, 0777, true);
                }

                $attachment = $files_dir . '/action-' . date('Y_m_d') . '.' . pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
                Uploader::move_file_to('attachment', rtrim(FCPATH, '/') . $attachment);
            } else {
                $attachment = '';
            }

            $meeting->set_action_attachment($attachment);
            if (Validator::success()) {
                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['status' => true, 'id' => $meeting->save()]);
            }

            json_response(['status' => false, 'html' => $this->load->view('manage/action/attachment', $this->view_params, true)]);
        }

        $this->load->view('manage/action/attachment', $this->view_params);

    }

    /** delete action
     * delete action if exist and render it to details page
    */
    public function action_delete($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $attendance = Orm_Mm_Action::get_instance($id);

        if ($attendance->get_id() && $attendance->get_meeting_id(true)->check_if_can_delete()) {
            $attendance->delete();

            Validator::set_success_flash_message(lang('Successful Delete'));
            exit();
        }
        Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
        redirect('/');
    }


    /** get reference
     * get refernce of meeting and render it in detils page for refernce
    */
    public function reference($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        $this->view_params['meeting'] = Orm_Mm_Meeting::get_instance($id);

        if (!$this->view_params['meeting']->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }

        $this->change_header($this->view_params['meeting']);

        $this->breadcrumbs->push(lang('Reference'), '/meeting_minutes/reference/' . $id);

        $this->view_params['sub_menu'] = 'manage';

        $this->view_params['tab'] = 'reference';

        $this->layout->view('manage/reference/details', $this->view_params);
    }


    /** reference edit
     * edit reference if exist
    */
    public function reference_edit($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }


        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $keyword = trim($this->input->get_post('keyword') ?: '');

        if (!$page) {
            $page = 1;
        }


        $meeting = Orm_Mm_Meeting::get_instance($id);

        if (!$meeting->get_id()) {
            echo error_dialog();
            exit();
        }

        $this->view_params['meeting'] = $meeting;

        $filters['not_id'] = $id;

        if ($keyword != '') {
            $filters['name_like'] = $keyword;
        }

        $meeting_objs = Orm_Mm_Meeting::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Mm_Meeting::get_count($filters));
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="ajaxModalDialog"');


        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['meeting_objs'] = $meeting_objs;
        $this->view_params['keyword'] = $keyword;


        $this->load->view('/manage/reference/edit', $this->view_params);
    }


    /** save reference
     *save refernce and assign it to meeting id and render to parent page
    */
    public function reference_save($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'meeting_minutes-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $meeting = Orm_Mm_Meeting::get_instance($id);

        if (!$meeting->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }


        $meeting_id = $this->input->post('meeting_id') ?: 0;

        $meeting->set_meeting_ref_id($meeting_id);
        $meeting->save();
        Validator::set_success_flash_message(lang('Successfully Saved'));

        json_response(['status' => true]);
    }

    /** pdf page
     * print pdf page for meeting and render to parent page
    */
    public function pdf($id = 0)
    {
        $meeting = Orm_Mm_Meeting::get_instance($id);

        if ($meeting->get_id() && Orm_Mm_Meeting::check_if_can_view()) {

            $meeting->generate_pdf();
            redirect($this->input->server('HTTP_REFERER'));
        }

        Validator::set_error_flash_message('The resource you requested does not exist!');
        redirect('/');
    }


    /** change header
     * change header of page
    */
    private function change_header($meeting)
    {
        /** @var $meeting Orm_Mm_Meeting */
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Meeting Minutes') . ': ' . $meeting->get_name(),
            'icon' => 'fa fa-users'
        ), true);

//        if(Orm_Mm_Meeting::check_if_can_generate_report()){
//            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
//                'link_attr' => 'href="/meeting_minutes/pdf/' . $meeting->get_id() . '"',
//                'link_title' => lang('Print'),
//                'link_icon' => 'file-pdf-o'
//            ), true);
//        }
    }


}