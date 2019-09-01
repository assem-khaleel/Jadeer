<?php
/**
 * Created by PhpStorm.
 * User: laith
 * Date: 3/6/17
 * Time: 12:04 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * Class Committee_work
 */
class Committee_work extends MX_Controller
{

    /**
     * @var $view_params  (array) => the array pf data that will send to views
     */

    private $view_params = array();
    /** @var \Orm_User_Staff | Orm_User_Faculty */
    private $logged_user;

    /**
     * Committee_work constructor.
     */
    function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('committee_work', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'committee_work-list');

        $this->logged_user = Orm_User::get_logged_user();

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Committee'),
            'icon' => 'fa fa-list'
        ), true);
        $this->view_params['menu_tab'] = 'committee_work';

        $this->breadcrumbs->push(lang('Committee'), '/committee_work');
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Committee'),
            'icon' => 'fa fa-users'
        ), true);
    }

    /**
     *This function to get all data that were need for commitee work and used in 2 way as a general list and the other as an ajax list when filter called.
     */
    private function get_list()
    {

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();


        if (!empty($fltr['institution']) && $fltr['institution'] == 1) {
            $filters['type'] = Orm_C_Committee::COMMITTEE_INSTITUTION_LEVEL;
        }
        if (!empty($fltr['college_id']) && $fltr['college_id'] > 0) {
            $filters['type'] = Orm_C_Committee::COMMITTEE_COLLEGE_LEVEL;
            $filters['type_id'] = $fltr['college_id'];
        }
        if (!empty($fltr['program_id']) && $fltr['program_id'] > 0) {
            $filters['type'] = Orm_C_Committee::COMMITTEE_PROGRAM_LEVEL;
            $filters['type_id'] = $fltr['program_id'];
        }


        if ($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
            $filters['type'] = Orm_C_Committee::COMMITTEE_COLLEGE_LEVEL;
            $filters['type_id'] = $this->logged_user->get_college_id();
            $filters['user_id'] = $this->logged_user->get_id();
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['type'] = Orm_C_Committee::COMMITTEE_PROGRAM_LEVEL;
            $filters['type_id'] = $this->logged_user->get_program_id();
            $filters['user_id'] = $this->logged_user->get_id();

        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['teacher_id'] = $this->logged_user->get_id();

        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $committee_objs = Orm_C_Committee::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_C_Committee::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['committee_objs'] = $committee_objs;
        $this->view_params['fltr'] = $fltr;
    }

    /**
     *This function used to get the main page for committee work
     */
    public function index()
    {
        if (Orm_C_Committee::check_if_can_add()) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/committee_work/add_edit" data-toggle="ajaxModal"',
                'link_title' => lang('Add New'),
                'link_icon' => 'plus'
            ), true);
        }

        $this->get_list();

        $this->layout->view('list', $this->view_params);
    }

    /**
     * filter will get a specific view for user when use the filter block will refresh the main view with the new data
     * if not will redirect for the page with the origin view
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
     * add new committee or modified an exist one K the parameter that need for that is :
     * $id => Committee work ID if $id = 0 that mean th committee not created before, else that mean it is already exist in our system
     * @param int $id
     */
    public function add_edit($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'committee_work-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $committee = Orm_C_Committee::get_instance($id);

        if($id !=0 && !$committee->get_id()){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->view_params['user_ids'] = $committee->get_user_ids();
        $this->view_params['committee'] = Orm_C_Committee::get_instance($id);
        $this->load->view('add_edit', $this->view_params);
    }

    /**
     * save function use to save the new committee or updated data in database< if all data that needed exist it will redirect to main page and save
     * else it will show an error message
     * @redirect success or error
     */
    public function save()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'committee_work-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $id = (int)$this->input->post('id');
        $title_en = $this->input->post('title_en');
        $title_ar = $this->input->post('title_ar');
        $description_en = $this->input->post('description_en');
        $description_ar = $this->input->post('description_ar');
        $type = (int)$this->input->post('type');
        $type_id = (int)$this->input->post('type_id');
        $college_id = intval($this->input->post('college_id'));
        $department_id = intval($this->input->post('department_id'));
        $program_id = intval($this->input->post('program_id'));
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $user_ids = (array)$this->input->post('user_ids');
        $leader = $this->input->post('leader');
        $new_ids = array();


        $committee = Orm_C_Committee::get_instance($id);


        Validator::not_empty_field_validator('title_en', $title_en, lang('Please enter Title') . ' ( ' . lang('English') . ' ) ');
        Validator::not_empty_field_validator('title_ar', $title_ar, lang('Please enter Title') . ' ( ' . lang('Arabic') . ' ) ');
        Validator::database_unique_field_validator($committee, 'title_en', 'title_en', $title_en, lang('Unique Field'));
        Validator::database_unique_field_validator($committee, 'title_ar', 'title_ar', $title_ar, lang('Unique Field'));
        Validator::not_empty_field_validator('description_en', $description_en, lang('Please enter Description') . ' ( ' . lang('English') . ' ) ');
        Validator::not_empty_field_validator('description_ar', $description_ar, lang('Please enter Description') . ' ( ' . lang('Arabic') . ' ) ');
        Validator::not_empty_field_validator('start_date', $start_date, lang('Please Enter start Date'));
        Validator::not_empty_field_validator('end_date', $end_date, lang('Please Enter end Date'));
        Validator::required_array_validator('user_ids', $user_ids, lang('Please Select at least Two User'));
        Validator::required_field_validator('leader', $leader, lang('Please Select Leader'));
        
        if (is_numeric($leader)) {
            $leader = intval($leader);
        } else {
            $leader = -1;
        }

        $leader_exist = false;

        if (count($user_ids) < 2) {
            Validator::set_error('user_ids', lang('Please Select at least Two Members'));
        }

        if ($user_ids) {
            foreach ($user_ids as $key => $user_id) {
                if ($user_id['id'] == '') {
                    Validator::required_field_validator("user_id[$key][id]", $user_id['id'], lang('Please Select User'));
                }
                if($key == $leader){
                    $leader_exist = true;
                }
            }

            if(!$leader_exist){
                Validator::set_error('leader', lang('Invalid Leader'));
            }
        }


        if ($start_date > $end_date) {
            Validator::set_error('start_date', lang('Start Date Must be Less than End Date'));
        }


        if ($user_ids) {
            foreach ($user_ids as $key => $user_id) {
                $new_ids[] = $user_id['id'];

            }
        }

        $type = in_array($type, array_keys(Orm_C_Committee::get_types())) ? $type : Orm_C_Committee::COMMITTEE_INSTITUTION_LEVEL;

        if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_INSTITUTION_ADMIN) {
            switch ($type) {
                case Orm_C_Committee::COMMITTEE_COLLEGE_LEVEL:
                    Validator::not_empty_field_validator('college_id', $college_id, lang('Required Filed'));

                    $type_id = $college_id;
                    break;
                case Orm_C_Committee::COMMITTEE_PROGRAM_LEVEL:
                    Validator::not_empty_field_validator('college_id', $college_id, lang('Required Filed'));
                    Validator::not_empty_field_validator('department_id', $department_id, lang('Required Filed'));
                    Validator::not_empty_field_validator('program_id', $program_id, lang('Required Filed'));

                    $type_id = $program_id;
                    break;
                default:
                    $type_id = 0;
                    break;
            }
        } elseif (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_COLLEGE_ADMIN) {
            $type = Orm_C_Committee::COMMITTEE_COLLEGE_LEVEL;
            $type_id = Orm_User::get_logged_user()->get_college_id();
        } else {
            $type = Orm_C_Committee::COMMITTEE_PROGRAM_LEVEL;
            if (Orm_User::get_logged_user()->get_program_id()) {
                $type_id = Orm_User::get_logged_user()->get_program_id();
            } else {
                Validator::set_error_flash_message(lang('Can not assign a committee for your program.'));
                json_response(['status' => true]);
            }
        }


        $ids = array();
        $committee->set_title_en($title_en);
        $committee->set_title_ar($title_ar);
        $committee->set_description_en($description_en);
        $committee->set_description_ar($description_ar);
        $committee->set_type($type);
        $committee->set_type_id($type_id);
        $committee->set_start_date($start_date ?: '0000-00-00');
        $committee->set_end_date($end_date ?: '0000-00-00');

        if (Validator::success()) {

            $committee->save();

            $leader_assigned = false;

            $user_ids[$leader]['leader'] = 1;

            foreach ($user_ids as $user_id) {
                if (isset($user_id['id']) && Validator::success()) {

                    $committee_user = Orm_C_Committee_Member::get_one(array('committee_id' => $committee->get_id(), 'user_id' => $user_id['id']));
                    $committee_user->set_committee_id($committee->get_id());
                    $committee_user->set_user_id($user_id['id']);
                    $committee_user->set_is_leader(isset($user_id['leader']) && !$leader_assigned ? 1 : 0);
                    $committee_user->save();
                    $ids[] = $user_id['id'];

                    if (isset($user_id['leader'])) {
                        $leader_assigned = true;
                    }
                }
            }

            foreach (array_diff($committee->get_user_ids(), $ids) as $user_id) {
                $delete_committee_user = Orm_C_Committee_Member::get_one(array('committee_id' => $committee->get_id(), 'user_id' => $user_id));
                $delete_committee_user->delete();
            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['status' => true]);
        }

        $this->view_params['leader'] = $leader;
        $this->view_params['committee'] = $committee;
        $this->view_params['user_ids'] = $new_ids;

        json_response(['status' => false, 'html' => $this->load->view('add_edit', $this->view_params, true)]);

    }

    /**
     * delete function use for remove xommittee from system, the parameter that need is
     * $id => committee work ID
     * @param $id
     */
    public function delete($id)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'committee_work-manage');

        $committee = Orm_C_Committee::get_instance($id);

        if(!($committee && $committee->get_id())) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
          redirect('/');
        }

        if($committee->check_if_can_map_with_meeting()){
           Validator::set_error_flash_message(lang("This Committee is mapped with Meeting, You Can't remove it"));
           exit();
        }

        if($committee->delete()) {
           Validator::set_success_flash_message(lang('Successful Delete'));
            exit();
        }

        Validator::set_error_flash_message(lang('Record has not Deleted'));
    }

    /**
     * save the committee work as pdf file, the parameter that need is:
     * $id => Committee work ID
     * @param $id
     */
    public function pdf($id)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'committee_work-report');

        $Committee = Orm_C_Committee::get_instance($id);
        if (isset($id)) {
            if ($Committee->get_id()) {
                $Committee->generate_pdf();
            }

            redirect($this->input->server('HTTP_REFERER'));
        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

    }

    /**
     * view all committee data in one page, the parameter that need is :
     * $id => committee work ID
     * @param $id
     */
    public function report($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'committee_work-list');

        $this->breadcrumbs->push(lang('View') . ' ' . Orm_C_Committee::get_instance($id)->get_title(), '/committee_work/report/' . $id);
        
        if (isset($id)) {
            $committee = Orm_C_Committee::get_instance($id);

            if(!$committee->get_id()){
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                redirect('/');
            }

            $this->view_params['committee'] = $committee;

            $this->layout->view('report', $this->view_params);
        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

    }
}