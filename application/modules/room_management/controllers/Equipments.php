<?php

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Assignment
 */
class Equipments extends MX_Controller
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

        Orm_User::check_logged_in();

        $this->breadcrumbs->push(lang('Equipments Management'), '/equipments');

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');

        $this->view_params['menu_tab'] = 'room_management';

        $this->header_array = array(
            'title' => lang('Equipments Management'),
            'icon' => 'fa fa-building'
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $this->header_array, true);
    }
/** check if can user add equipment and get all equipments */
    public function index()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Equipments Management'),
            'icon' => 'fa fa-building',
            'menu_view' => 'room_management/sub_menu',
            'menu_params' => array('type' => 'equipment')
        ), true);

        if (Orm_Rm_Equipment::check_if_can_add()) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/room_management/equipments/create_edit" data-toggle="ajaxModal"',
                'link_title' => lang('Create').' '.lang('Equipment'),
                'link_icon' => 'plus'
            ), true);
        }
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


        $equipments = Orm_Rm_Equipment::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Rm_Equipment::get_count($filters));
        $check = $pager->get_total_count() / 10;

        if ($check <= 1 && $page != 1) {
            $page = $page - 1;
            $rooms = Orm_Rm_Equipment::get_all($filters, $page, $per_page);

            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
        }
        $this->view_params['pager'] = $pager->render(true);

        $this->view_params['equipments'] = $equipments;

        $this->layout->view('room_management/index', $this->view_params);
    }
/** add edit equipment
 * render it in create_edit_equipment view
*/
    public function create_edit($id = 0) {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'room_management-manage');

        if (!$this->input->is_ajax_request()) {

            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');

        }

        $equipment = Orm_Rm_Equipment::get_instance($id);

        if($id !=0 && !$equipment->get_id()){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }


        $this->view_params['equipment'] = $equipment;
        $this->load->view('create_edit_equipment', $this->view_params);
    }
/**save equipment object
 *  and return json request for ajax
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
        $additional = $this->input->post('additional');

        $equipment = Orm_Rm_Equipment::get_instance($id);

        Validator::required_field_validator('name_en', $name_en, lang('Required Field'));
        Validator::required_field_validator('name_ar', $name_ar, lang('Required Field'));
        Validator::database_unique_field_validator($equipment, 'name_en', 'name_en', $name_en, lang('Unique Field'));
        Validator::database_unique_field_validator($equipment, 'name_ar', 'name_ar', $name_ar, lang('Unique Field'));
        Validator::required_field_validator('additional', $additional, lang('Required Field'));

        $equipment->set_name_en($name_en);
        $equipment->set_name_ar($name_ar);
        $equipment->set_additional($additional);

        if(Validator::success() ) {
            Validator::set_success_flash_message(lang('Successfully Saved'));

            json_response(['success' => true, 'id' => $equipment->save()]);
        }

        $this->view_params['equipment'] = $equipment;

        json_response(['success' => false, 'html' => $this->load->view('create_edit_equipment', $this->view_params, true)]);
    }
/** delete equipment if exist
 * redirect to root path
*/
    public function delete($id) {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'room_management-manage');

        if(isset($id)){
            $eq_rooms = Orm_Rm_Room_Equipment::get_count(array('equipment_id'=>$id));

            if($eq_rooms !=0){
                Validator::set_error_flash_message(lang("This Equipment is mapped with Room, You Can't remove it"));

            }else{
                $equipment = Orm_Rm_Equipment::get_instance($id);
                if($equipment->get_id()) {
                    $equipment->delete();
                    Validator::set_success_flash_message(lang('Successful Delete'));
                }
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                redirect('/');

            }

        }else{
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }


    }

}