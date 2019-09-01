<?php

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Assignment
 */
class Room_management extends MX_Controller
{

    private $view_params;

    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('room_management', true)) {
            show_404();
        }
        Orm_User::check_logged_in();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'room_management-list');


        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');

        $this->view_params['menu_tab'] = 'room_management';
    }
/** get all room management objects after filtering depending on permissions
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

        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if(Orm_User::get_logged_user()->get_program_id()){
            $program_id=Orm_Program::get_instance(Orm_User::get_logged_user()->get_program_id());
            $department_id=Orm_Department::get_instance($program_id->get_department_id());
            $filters['college_id']=$department_id->get_college_id();
        }

        $rooms = Orm_Rm_Room_Management::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Rm_Room_Management::get_count($filters));
        $check = $pager->get_total_count() / 10;

        if ($check <= 1 && $page != 1) {
            $page = $page - 1;
            $rooms = Orm_Rm_Room_Management::get_all($filters, $page, $per_page);

            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
        }
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['rooms'] = $rooms;
        $this->view_params['fltr'] = $fltr;
    }
/** get index of room management object after get list from above function and render it in the list view
*/
    public function index()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Room Management'),
            'icon' => 'fa fa-building'
        ), true);

        if (Orm_Rm_Room_Management::check_if_can_add()) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/room_management/create_edit" data-toggle="ajaxModal"',
                'link_title' => lang('Create') . ' ' . lang('Room'),
                'link_icon' => 'plus',
                'menu_view' => 'room_management/sub_menu',
                'menu_params' => array('type' => 'room')
            ), true);
        }

        $this->breadcrumbs->push(lang('Room Management'), '/room_management');

        $this->get_list();

        $this->layout->view('room_management/list', $this->view_params);
    }
/** filter depending on request if it's ajax to render it in data table view else that in index view
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

/** create room management or edit it if dosnt exist
 * render in the create edit view
 */
    public function create_edit($id = 0)
    {

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'room_management-manage');

        if (!$this->input->is_ajax_request()) {

            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $room = Orm_Rm_Room_Management::get_instance($id);

        if($id !=0 && !$room->get_id()){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }


        $this->view_params['room'] = $room;
        $this->load->view('create_edit', $this->view_params);
    }
/** manage room management with equipment management and display them in pages
 * render them in equipment list view
*/
    public function manage($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'room_management-manage');

        if (!$this->input->is_ajax_request()) {

            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');

        }

       $room=Orm_Rm_Room_Management::get_instance($id);

        if(!$room->get_id()){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $per_page = 5;//$this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $keyword = trim($this->input->get_post('keyword') ?: '');
        $filters = [];
        if ($keyword != '') {
            $filters['name_like'] = $keyword;
        }

        $this->view_params['filtersKeyword'] = $keyword;
        $this->view_params['room'] = $room;
        $this->view_params['equipments'] = Orm_Rm_Equipment::get_all($filters, $page, $per_page);
        $this->view_params['room_equipment'] = Orm_Rm_Room_Equipment::get_all(array('room_id' => $id));
        $this->load->view('equipment_list', $this->view_params);
    }
    
/** save equipment room depending on equipment id
 *return json response for ajax
 *
 */
    public function equipment_save()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'room_management-manage');

        $room_id = $this->input->post('room_id');
        $equipment_id = (array)$this->input->post('equipment_id');
        $room_equipment = Orm_Rm_Room_Equipment::get_all(array('room_id' => $room_id));

        foreach ($room_equipment as $room) {
            $room->delete();
        }
        foreach ($equipment_id as $equipme) {
            $equip = new Orm_Rm_Room_Equipment();
            $equip->set_room_id($room_id);
            $equip->set_equipment_id($equipme);
            $equip->save();
        }
        Validator::set_success_flash_message(lang('Successfully Saved'));
        json_response(['status' => true]);
    }
    /** save equipment object that related with room object in database
     *return json response for ajax
     *
     */
    public function save()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'room_management-manage');

        $id = $this->input->post('id');
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');
        $room_number = $this->input->post('room_number');
        $room_type = $this->input->post('room_type');
        $college_id = intval($this->input->post('college_id'));


        $room = Orm_Rm_Room_Management::get_instance($id);

        Validator::required_field_validator('name_en', $name_en, lang('Required Field'));
        Validator::required_field_validator('name_ar', $name_ar, lang('Required Field'));
        Validator::database_unique_field_validator($room, 'name_en', 'name_en', $name_en, lang('Unique Field'));
        Validator::database_unique_field_validator($room, 'name_ar', 'name_ar', $name_ar, lang('Unique Field'));
        Validator::numeric_field_validator('room_number',$room_number, lang('Must Be Real Number'));

        if($room_number <= 0 ){
            Validator::set_error('room_number', lang('Room Number Must Be Larger than 0'));

        }
        Validator::required_field_validator('room_type', $room_type, lang('Required Field'));
        Validator::not_empty_field_validator('college_id', $college_id, lang('Required Filed'));
        
        $room->set_name_ar($name_ar);
        $room->set_name_en($name_en);
        $room->set_room_number($room_number);
        $room->set_room_type($room_type);
        $room->set_college_id($college_id);

        if (Validator::success()) {

            Validator::set_success_flash_message(lang('Successfully Saved'));

            json_response(['success' => true, 'id' => $room->save()]);
        }

        $this->view_params['room'] = $room;

        json_response(['success' => false, 'html' => $this->load->view('create_edit', $this->view_params, true)]);
    }
/** delete equipment object
*/
    public function delete($id)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'room_management-manage');


        $room = Orm_Rm_Room_Management::get_instance($id);

        if (!($room && $room->get_id())) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            exit();
        }

        if(License::get_instance()->check_module('meeting_minutes',true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'meeting_minutes-list')) {
            Modules::load('meeting_minutes');

            $meeting = Orm_Mm_Meeting::get_count(array('room_id'=>$id));

            if($meeting !=0 ){
                Validator::set_error_flash_message(lang("This Room is mapped with Meeting, You Can't remove it"));
                exit();
            }
        }

        $room->delete();
        Validator::set_success_flash_message(lang('Successful Delete'));
    }

}