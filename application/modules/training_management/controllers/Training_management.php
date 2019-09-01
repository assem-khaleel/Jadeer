<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Config $config
 * Class Training_management
 */
class Training_management extends MX_Controller
{

    /**
     * View Params
     * @var array => the array pf data that will send to views
     * Logged User
     * @var Object  => logged user data
     */

    private $view_params = array();
    private $logged_user;

    /**
     * Training_management constructor.
     */
    public function __construct()
    {

        parent::__construct();

        if (!License::get_instance()->check_module('training_management', true)) {
            show_404();
        }


        Orm_User::check_logged_in();
        $this->logged_user = Orm_User::get_logged_user();


        $this->layout->add_javascript('/assets/jadeer/js/add_more.js');
        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');

        $this->breadcrumbs->push(lang('Training Management'), '/training_management');
        $this->view_params['menu_tab'] = 'training_management';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Training Management'),
            'icon' => 'fa fa-briefcase'
        ), true);

    }

    /**
     * This function to get all data that were need in Trainings and used in 2 way as a general list and the other as an ajax list when filter called.
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


        if (!empty($fltr['type_id'])) {
            $filters['type_id'] = (int)$fltr['type_id'];
        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if (!$this->logged_user->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
            $filters['creator_id'] = $this->logged_user->get_id();
            $filters['user_id'] = $this->logged_user->get_id();
        }

        $all_training = Orm_Tm_Training::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tm_Training::get_count($filters));

        $check = $pager->get_total_count() / 10;
        if ($check <= 1 && $page != 1) {
            redirect('/training_management/');
        }

        $this->view_params['all_training'] = $all_training;
        $this->view_params['logged_user'] = $this->logged_user->get_id();
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
    }

    /**
     * Index function used  as the main function that get the data for Training Management
     */
    public function index()
    {
        if (Orm_Tm_Training::check_if_can_add()) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/training_management/types"',
                'link_icon' => 'cogs',
                'link_title' => lang('Settings')
            ), true);
        }
        $this->get_list();

        $this->view_params['sub_menu'] = 'training_management/sub_menu';
        $this->view_params['type'] = 'personal';

        $this->layout->view('list', $this->view_params);
    }

    /**
     * create new training
     * @return  string $training
     */
    public function add()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        $this->breadcrumbs->push(lang('Add') . ' ' . lang('Training'), '/training_management/add');

        $this->view_params['training'] = new Orm_Tm_Training();
        $this->view_params['level_ids'] = array();
        $this->view_params['logged_user'] = $this->logged_user;
        $this->layout->view('add_edit', $this->view_params);
    }


    /**
     * this function used to set update in training that added before for training management moduel, the following parameter are needed
     * @param $id => the training id that need edit
     */
    public function edit($id)
    {

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        $this->breadcrumbs->push(lang('edit') . ' ' . lang('Training'), '/training_management/edit/' . $id);

        $training = Orm_Tm_Training::get_instance($id);

        if (!$training->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }
        if (!$training->check_if_can_modify()) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect('/training_management');
        }

        $level_ids = array_column(Orm_Tm_Level::get_model()->get_all(['training_id' => $training->get_id()], 0, 0, [], Orm::FETCH_ARRAY), 'level_id');

        $this->view_params['logged_user'] = $this->logged_user;
        $this->view_params['level_ids'] = $level_ids;
        $this->view_params['training'] = $training;
        $this->layout->view('add_edit', $this->view_params);
    }

    /**
     * save the new training and the updated data for training that already added
     * @redirect success or error
     */
    public function save()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        $id = (int)$this->input->post('id');
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');
        $duration = $this->input->post('duration');
        $date = $this->input->post('date');
        $type_id = $this->input->post('type_id');
        $organization = $this->input->post('organization');
        $location = $this->input->post('location');
        $instructor_information = $this->input->post('instructor_information');
        $description = $this->input->post('description');
        $outline = $this->input->post('outline');
        $status = $this->input->post('status');

        $level = intval($this->input->post('level'));
        $college_id = intval($this->input->post('college_id'));
        $department_id = intval($this->input->post('department_id'));
        $level_ids = $this->input->post('level_ids');


        $training = Orm_Tm_Training::get_instance($id);

        Validator::required_field_validator('name_en', $name_en, lang('Please Enter name') . ' ( ' . lang('English') . ' ) ');
        Validator::required_field_validator('name_ar', $name_ar, lang('Please Enter name') . ' ( ' . lang('Arabic') . ' ) ');
        Validator::required_field_validator('duration', $duration, lang('Please Enter Duration'));
        Validator::not_empty_field_validator('date', $date, lang('Please Enter Date of Training'));
        Validator::date_format_validator('date', $date, lang('It is a required filed to select date.'));
        Validator::not_empty_field_validator('type_id', $type_id, lang('Please Select Type'));
        Validator::not_empty_field_validator('organization', $organization, lang('Please enter Description'));
        Validator::required_field_validator('location', $location, lang('Please Enter Location'));
        Validator::not_empty_field_validator('instructor_information', $instructor_information, lang('Please enter Instructor Information'));
        Validator::not_empty_field_validator('description', $description, lang('Please enter Description'));
        Validator::not_empty_field_validator('outline', $outline, lang('Please enter Outline'));

        $all_level_id = array();

        switch ($level) {

            case Orm_Tm_Training::COLLEGE_LEVEL:

                Validator::not_empty_field_validator('level_ids', $level_ids, lang('Please Select at least one college'));

                $all_level_id = $level_ids;
                break;

            case Orm_Tm_Training::PROGRAM_LEVEL:

                Validator::not_empty_field_validator('college_id', $college_id, lang('Please Select College'));
                Validator::not_empty_field_validator('department_id', $department_id, lang('Please Select Department'));
                Validator::not_empty_field_validator('level_ids', $level_ids, lang('Please Select at least one Program'));

                $all_level_id = $level_ids;
                break;


        }


        $training->set_name_en($name_en);
        $training->set_name_ar($name_ar);
        $training->set_duration($duration);
        $training->set_date($date);
        $training->set_type_id($type_id);
        $training->set_organization($organization);
        $training->set_location($location);
        $training->set_instructor_information($instructor_information);
        $training->set_description($description);
        $training->set_training_outline($outline);
        $training->set_creator_id($this->logged_user->get_id());
        $training->set_level($level);
        $training->set_status($status ? $status : Orm_Tm_Training::TRAINING_PUBLIC);
        $training->set_college_id($college_id);
        $training->set_department_id($department_id);

        if (Validator::success()) {

            $training->save();

            foreach ($all_level_id as $key => $element) {
                $element_level = Orm_Tm_Level::get_one(array('training_id' => $training->get_id(), 'level_id' => $element));
                $element_level->set_training_id($training->get_id());
                $element_level->set_level_id($element);
                $element_level->save();
            }

            foreach (array_diff($training->get_level_ids(), $all_level_id) as $key => $element) {
                $delete_element = Orm_Tm_Level::get_one(array('training_id' => $training->get_id(), 'level_id' => $element));
                $delete_element->delete();
            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/training_management');
        }


        $this->view_params['logged_user'] = $this->logged_user;
        $this->view_params['level_ids'] = $level_ids;
        $this->view_params['training'] = $training;
        $this->layout->view('add_edit', $this->view_params);

    }

    /**
     * remove one of the training that is set before in training management
     * @param $id
     * @redirect success or error
     */
    public function delete($id)
    {

        Orm_User::check_permission(array(Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }


        $training = Orm_Tm_Training::get_instance($id);

        if ($id && $training->get_id()) {

            $members = Orm_Tm_Members::get_all(array('training_id' => $training->get_id()));

            foreach ($members as $member) {
                $member->delete();
            }

            $survey = Orm_Tm_Survey::get_count(array('training_id' => $training->get_id()));

            if ($survey != 0) {
                Validator::set_error_flash_message(lang("This training are mapped with survey you can't remove it"));
                exit('<script>window.location.reload();</script>');
            }

            $training->delete();

            Validator::set_success_flash_message(lang('Successful Delete'));

        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

    }

    /**
     * remove user from the memebers of training the following parameters are needed
     * @param $training_id
     * @param $id_member
     *  @redirect success or error
     */
    public function delete_memeber($training_id, $id_member)
    {

        Orm_User::check_permission(array(Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $training = Orm_Tm_Training::get_instance($training_id);
        $member_id = Orm_Tm_Members::get_instance($id_member);

        if ($id_member && $member_id->get_user_id()) {

            $members = Orm_Tm_Members::get_all((['training_id' => $training->get_id(), 'user_id' => $member_id->get_user_id()]));


            foreach ($members as $member) {
                $member->delete();
            }


            Validator::set_success_flash_message(lang('Successful Delete'));

        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

    }

    /**
     * This function to get all data that were need in set training types and used in 2 way as a general list and the other as an ajax list when filter called.
     */
    private function get_type_list()
    {
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

        $types = Orm_Tm_Type::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tm_Type::get_count($filters));
        $check = $pager->get_total_count() / 10;
        if ($check <= 1 && $page != 1) {
            redirect('/training_management/type/');
        }

        $this->view_params['types'] = $types;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
    }

    /**
     * Index function used  as the main function that get the data for Types of training
     */

    public function types()
    {

        $this->breadcrumbs->push(lang('Types'), '/training_management/types');

        if (Orm_Tm_Training::check_if_can_add()) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'data-toggle="ajaxModal" href="/training_management/add_edit_type"',
                'link_icon' => 'plus',
                'link_title' => lang('add') . ' ' . lang('Type')
            ), true);
        }

        $this->get_type_list();
        $this->layout->view('type/list', $this->view_params);
    }

    /**
     * add types for training ot update for type that already added, the following parameter are needed:
     * @param int $id
     * @return string $type => type object that has all data ot type depends on if
     */
    public function add_edit_type($id = 0)
    {

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');


        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }


        $type = Orm_Tm_Type::get_instance($id);

        if ($id != 0 && !$type->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->view_params['type'] = $type;
        $this->load->view('type/add_edit', $this->view_params);
    }

    /**
     * save the new type that added by user
     * @redirect success or error
     */
    public function save_type()
    {

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $id = (int)$this->input->post('id');
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');

        $type = Orm_Tm_Type::get_instance($id);

        Validator::not_empty_field_validator('name_en', $name_en, lang('Please enter name') . ' ( ' . lang('English') . ' ) ');
        Validator::not_empty_field_validator('name_ar', $name_ar, lang('Please enter name') . ' ( ' . lang('Arabic') . ' ) ');
        Validator::database_unique_field_validator($type, 'name_en', 'name_en', $name_en, lang('Unique Field'));
        Validator::database_unique_field_validator($type, 'name_ar', 'name_ar', $name_ar, lang('Unique Field'));

        $type->set_name_en($name_en);
        $type->set_name_ar($name_ar);


        if (Validator::success()) {

            $type->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['status' => true]);

        }

        $this->view_params['type'] = $type;
        json_response(['status' => false, 'html' => $this->load->view('type/add_edit', $this->view_params, true)]);

    }

    /**
     * remove type from training type, and the parameter that needed is :
     * @param $id
     * @redirect success or error
     */
    public function delete_type($id)
    {

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        if (!isset($id)) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $type = Orm_Tm_Type::get_instance($id);

        if (Orm_Tm_Training::get_count(['type_id' => $type->get_id()]) != 0) {
            Validator::set_error_flash_message(lang("This type mapped with a training, you can't remove it"));
            exit('<script>window.location.reload();</script>');
        }

        if ($type->get_id() && $type->get_is_editable() == 0) {

            $type->delete();

            Validator::set_success_flash_message(lang('Successfully Deleted'), true);
            redirect('/training_management/types');
        }

        Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
        redirect('/');


    }


    /**
     * show member that takes the training or will take it in future, the parameter that needed are the following (this willc alled in other functions depends on ajax calling or not)
     * @param $training_id
     */
    private function get_member_list($training_id)
    {

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array('training_id' => $training_id);
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $members = Orm_Tm_Members::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tm_Members::get_count($filters));
        $check = $pager->get_total_count() / 10;
        if ($check <= 1 && $page != 1) {
            redirect('/training_management/memeber_list/' . $training_id);
        }

        $this->view_params['members'] = $members;
        $this->view_params['training'] = Orm_Tm_Training::get_instance($training_id);
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
    }

    /**
     * show member that takes the training or will take it in future, the parameter that needed are the following
     * @param $training_id
     */
    public function member_list($training_id)
    {

        Orm_User::check_permission(array(Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');


        if (!$training_id) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $training = Orm_Tm_Training::get_instance($training_id);

        if ($training->get_creator_id() != $this->logged_user->get_id()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $this->breadcrumbs->push(lang('Certified Members'), '/training_management/member_list');

        if (Orm_Tm_Training::check_if_can_add()) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'data-toggle="ajaxModal" href="/training_management/add_edit_member/' . $training_id . '"',
                'link_icon' => 'plus',
                'link_title' => lang('add') . ' ' . lang('Certified Members')
            ), true);
        }

        $this->get_member_list($training_id);


        $this->layout->view('member/list', $this->view_params);

    }

    /**
     * add member for training or update member that already added, the following parameter will needed:
     * @param $training_id
     * @param int $id
     * @return string $member  => the data of member that added
     */
    public function add_edit_member($training_id, $id = 0)
    {

        Orm_User::check_permission(array(Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }


        if ($training_id == 0) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        if (!$training_id) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $training = Orm_Tm_Training::get_instance($training_id);

        if ($training->get_creator_id() != $this->logged_user->get_id()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }


        $member = Orm_Tm_Members::get_instance($id);

        if (!$training_id && $id != 0 && !$member->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->view_params['member'] = $member;
        $this->view_params['training_id'] = $training_id;
        $this->load->view('member/add_edit', $this->view_params);
    }

    /**
     *save the memeber for thaining
     * @redirect success or error
     */
    public function save_member()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $id = (int)$this->input->post('id');
        $member_id = (int)$this->input->post('member_id');
        $training_id = (int)$this->input->post('training_id');

        $member = Orm_Tm_Members::get_instance($id);

        Validator::not_empty_field_validator('member_id', $member_id, lang('Please select a Certified Member'));

        $member->set_training_id($training_id);
        $member->set_user_id($member_id);
        $member->set_status(Orm_Tm_Members::USER_JOINED);


        if (Validator::success()) {

            $member->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['status' => true]);

        }
        $this->view_params['training_id'] = $training_id;
        $this->view_params['member'] = $member;
        json_response(['status' => false, 'html' => $this->load->view('member/add_edit', $this->view_params, true)]);

    }


    /**
     * show the survey that are added for this training , the parameter needed is:
     * @param $training_id => the training that need to add survey for
     *
     */
    public function survey($training_id)
    {

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        if (!$training_id && $training_id == 0) {
            Validator::set_error_flash_message('Operation not allowed!');
            redirect('/');
        }

        if (Orm_Tm_Survey::get_count(['training_id' => $training_id]) == 0) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        if (!Orm_Tm_Training::map_survey()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }
        Modules::load('survey');


        $this->breadcrumbs->push(lang('Survey'), '/training_management/survey');


        $map = Orm_Tm_Survey::get_all(array('training_id' => $training_id));

        $this->view_params['maps'] = $map;
        $this->view_params['training_id'] = $training_id;
        $this->layout->view('survey/list', $this->view_params);
    }

    /**
     * get 2 survey for the training (Need to Active Survey Module to work), and the following parameter is needed
     * @param $training_id => the training that need to add survey for
     * @redirect success or error
     */
    public function manage_survey($training_id)
    {

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        if ($training_id == 0 && !$training_id) {
            Validator::set_error_flash_message('Operation not allowed!');
            redirect('/');
        }


        $training = Orm_Tm_Training::get_instance($training_id);

        if ($training->get_id() == 0) {
            Validator::set_error_flash_message('Operation not allowed!');
            redirect('/');
        }

        /*add 2 survey for this training */
        if (!$training->can_map_with_survey()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        if (Orm_Tm_Survey::get_count(['training_id' => $training_id]) != 0) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        Modules::load('survey');

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'survey_training-manage');


        $title_ar = $training->get_name_ar() . ' ' . lang('Survey');
        $title_en = $training->get_name_en() . ' ' . lang('Survey');

        $before_surveys = new Orm_Survey();
        $before_surveys->set_type(Orm_Survey::TYPE_TRAINING_BEFORE);
        $before_surveys->set_created_by($this->logged_user->get_id());
        $before_surveys->set_title_arabic($title_ar);
        $before_surveys->set_title_english($title_en);
        $before_surveys->save();

        $after_surveys = new Orm_Survey();
        $after_surveys->set_type(Orm_Survey::TYPE_TRAINING_AFTER);
        $after_surveys->set_created_by($this->logged_user->get_id());
        $after_surveys->set_title_arabic($title_ar);
        $after_surveys->set_title_english($title_en);
        $after_surveys->save();

        /*end of add survey*/

        /*map the survey in with training */

        $map_survey_before = new Orm_Tm_Survey();
        $map_survey_before->set_training_id($training->get_id());
        $map_survey_before->set_survey_id($before_surveys->get_id());
        $map_survey_before->set_status(Orm_Tm_Survey::STATUS_BEFORE);
        $map_survey_before->save();

        $map_survey_after = new Orm_Tm_Survey();
        $map_survey_after->set_training_id($training->get_id());
        $map_survey_after->set_survey_id($after_surveys->get_id());
        $map_survey_after->set_status(Orm_Tm_Survey::STATUS_AFTER);
        $map_survey_after->save();
        /*end of survey map*/

        Validator::set_success_flash_message(lang('Successfully Saved'));
        redirect('/training_management');


    }

    /**
     * send the survey for member to take an evaluation for it and will redirect for the main page if success or error message if there are an error in it
     * @param $training_id
     * @param $id
     * @redirect success or error
     */
    public function invite($training_id, $id)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        if ($training_id == 0 && !isset($training_id)) {
            Validator::set_error_flash_message('Operation not allowed!');
            redirect('/');
        }


        $training = Orm_Tm_Training::get_instance($training_id);

        if ($training->get_id() == 0) {
            Validator::set_error_flash_message('Operation not allowed!');
            redirect('/');
        }


        /*add 2 survey for this training */
        if (!$training->can_map_with_survey()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        if (!isset($training_id) && !isset($id)) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        Modules::load('survey');

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'survey_training-manage');


        $survey = Orm_Survey::get_instance($id);

        if (Orm_User::get_logged_user()->get_id() != $survey->get_created_by()) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }


        $description_arabic = "{$training->get_name_ar()}";
        $description_english = "{$training->get_name_en()}";

        $filters = array('survey_id' => $survey->get_id(), 'created_by' => $survey->get_created_by(), 'semester' => Orm_Semester::get_active_semester()->get_id());

        if (Orm_Survey_Evaluation::get_count($filters) != 0) {
            $evaluation = Orm_Survey_Evaluation::get_one($filters);
        } else {
            $evaluation = new Orm_Survey_Evaluation();
        }
        $evaluation->set_survey_id($survey->get_id());
        $evaluation->set_created_by($survey->get_created_by());
        $evaluation->set_description_english($description_english);
        $evaluation->set_description_arabic($description_arabic);
        $evaluation->set_semester_id(Orm_Semester::get_active_semester()->get_id());
        $evaluation->set_description_arabic($description_arabic);
        $evaluation->save();

        Orm_Survey_Evaluator::invite_bulk($evaluation, $training->get_users_obj());

        Validator::set_success_flash_message(lang('Invited Successfully'));
        redirect('training_management/survey/' . $training_id);
    }


    /**
     * show the over all data of training in one page
     * @param $training_id
     */
    public function view($training_id)
    {

        if (!isset($training_id)) {
            Validator::set_error_flash_message('Operation not allowed!');
            redirect('/');
        }

        if ($training_id == 0) {
            Validator::set_error_flash_message('Operation not allowed!');
            redirect('/');
        }

        $this->breadcrumbs->push(lang('View') . ' ' . lang('Training'), '/training_management/view');

        $training = Orm_Tm_Training::get_instance($training_id);


        if ($training->get_id() == 0) {
            Validator::set_error_flash_message('Operation not allowed!');
            redirect('/');
        }

        if (!$training->check_user_can_view() && $training->get_status() == Orm_Tm_Training::TRAINING_PRIVATE) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $this->view_params['training'] = $training;
        $this->layout->view('view', $this->view_params);

    }

}