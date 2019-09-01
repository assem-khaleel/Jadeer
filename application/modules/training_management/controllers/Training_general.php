<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Config $config
 * Class Training_general
 */
class Training_general extends MX_Controller
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
     * Training_general constructor.
     */

    public function __construct()
    {

        parent::__construct();

        if (!License::get_instance()->check_module('training_management', true)) {
            show_404();
        }


        Orm_User::check_logged_in();
        $this->logged_user = Orm_User::get_logged_user();


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

        $filters['not_creator_id'] = $this->logged_user->get_id();
        $filters['not_user_id'] = $this->logged_user->get_id();
        $filters['status'] =Orm_Tm_Training::TRAINING_PUBLIC;
        $filters['greater_date'] = date('Y-m-d');
        $filters['member_status'] = array(Orm_Tm_Members::USER_PENDING,Orm_Tm_Members::USER_WAITING);


        $all_training = Orm_Tm_Training::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tm_Training::get_count($filters));

        $check = $pager->get_total_count() / 10;
        if ($check <= 1 && $page != 1) {
            redirect('/training_management/training_general');
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
        if($this->logged_user->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }
        $this->breadcrumbs->push(lang('General Training Management'), '/training_management/training_general');
        $this->view_params['sub_menu'] = 'training_management/sub_menu';
        $this->view_params['type'] = 'general';

        $this->get_list();
        $this->layout->view('general/list', $this->view_params);
        
    }

    /**
     * Join function used to send a notification for the Creator of a specific training to join the training< and for that we need this parameter
     * @param $training_id  => this param id the of training
     * @redirect success or error
     */
    public function join($training_id){

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        if (!isset($training_id)) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $member_join = Orm_Tm_Members::get_one(['training_id'=>$training_id,'user_id'=>$this->logged_user->get_id()]);
       // echo "<pre>";print_r($member_join);die();
        $member_join->set_training_id($training_id);
        $member_join->set_status(Orm_Tm_Members::USER_PENDING);
        $member_join->set_user_id($this->logged_user->get_id());
        $member_join->save();

        $training =  Orm_Tm_Training::get_instance($training_id);

        Orm_Notification::send_notification(
            $this->logged_user->get_id(),
            $training->get_creator_id(),
            Orm_Notification_Template::JOIN_TRAINING,
            Orm_Notification::TYPE_TRAINING,
            array(
                '%link%',
                '%training_name_english%',
                '%training_name_arabic%'
            ),
            array(
                '<a href="' . base_url('training_management/training_general/request/') . '">Click Here</a>',
                $training->get_name_en(),
                $training->get_name_ar(),
            )
            );

        Validator::set_success_flash_message(lang('The request for joining this training  successfully sent'), true);
        redirect('/training_management/training_general');

    }

    /**
     * View Function used for get all data for Training In one View, for that we need the following Parameter
     * @param $id  => this param id the of training
     */
    public function view($id){

        if (!$id) {
            Validator::set_error_flash_message('Operation not allowed!');
            redirect('/');
        }
        $this->breadcrumbs->push(lang('General Training Management'), '/training_management/training_general');
        $this->breadcrumbs->push(lang('View') . ' ' . lang('Training'), '/training_management/training_general/view');

        $training = Orm_Tm_Training::get_instance($id);

        if($training->get_status() == Orm_Tm_Training::TRAINING_PRIVATE){
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $this->view_params['training'] = $training;
        $this->layout->view('view', $this->view_params);

    }

    /**
     *This function will show all user that are send a request to join Training that created by the logged user
     *
     */
    public function request(){

        $this->breadcrumbs->push(lang('Training Request'), '/training_management/training_general/request');


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
        $training_ids = array_column(Orm_Tm_Training::get_model()->get_all(['creator_id' => $this->logged_user->get_id(),'status'=>Orm_Tm_Training::TRAINING_PUBLIC], 0, 0, [], Orm::FETCH_ARRAY), 'id');
        $filters['in_training_id'] = $training_ids;
        $filters['status'] = Orm_Tm_Members::USER_PENDING;


        $requests = Orm_Tm_Members::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tm_Members::get_count($filters));

        $check = $pager->get_total_count() / 10;
        if ($check <= 1 && $page != 1) {
            redirect('/training_management/training_general/request');
        }

        $this->view_params['requests'] = $requests;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;

        
        $this->layout->view('general/request', $this->view_params);
    }

    /**
     * Approve function used for accept the request for user that need to join
     * - if user don't have id then it will redirect with error message
     * -if all data and parameter need are correct it will save the request and redirect with successful message
     * -the following parameters are what we need to approve the request:
     * @param $request_id =>the id of  member to be accept
     * @redirect success or error
     */
    public function approve($request_id){
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');


        if (!isset($request_id)) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $request = Orm_Tm_Members::get_instance($request_id);

        if($request->get_id() == 0){
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        if(Orm_Tm_Training::get_instance($request->get_training_id())->get_creator_id() != $this->logged_user->get_id()){
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $request->set_status(Orm_Tm_Members::USER_JOINED);
        $request->save();


        Orm_Notification::send_notification(
            $this->logged_user->get_id(),
            $request->get_user_id(),
            Orm_Notification_Template::APPROVE_TRAINING,
            Orm_Notification::TYPE_TRAINING,
            array(
                '%link%',
                '%training_name_english%',
                '%training_name_arabic%'
            ),
            array(
                '<a href="' . base_url('training_management') . '">Click Here</a>',
                $request->get_training_obj()->get_name_en(),
                $request->get_training_obj()->get_name_ar(),
            )
        );


        Validator::set_success_flash_message(lang('Request Approved successfully'));
        redirect('training_management/training_general/request/');
        
    }

    /**
     * Ignore function used for remove the request to joining the group
     *  - if user don't have id then it will redirect with error message
     * -if all data and parameter need are correct it will delete the request and redirect with successful message
     * -the following parameters are what we need to remove the request:
     * @param $request_id =>the id of  member to be not accept and remove from request and member list
     * @redirect success or error
     */
    public function ignore($request_id){
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'training_management-manage');


        if (!isset($request_id)) {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $request = Orm_Tm_Members::get_instance($request_id);

        if($request->get_id() == 0){
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        if(Orm_Tm_Training::get_instance($request->get_training_id())->get_creator_id() != $this->logged_user->get_id()){
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

        $request->delete();


        Orm_Notification::send_notification(
            $this->logged_user->get_id(),
            $request->get_user_id(),
            Orm_Notification_Template::IGNORE_TRAINING,
            Orm_Notification::TYPE_TRAINING,
            array(
                '%link%',
                '%training_name_english%',
                '%training_name_arabic%'
            ),
            array(
                '<a href="' . base_url('training_management') . '">Click Here</a>',
                $request->get_training_obj()->get_name_en(),
                $request->get_training_obj()->get_name_ar(),
            )
        );


        Validator::set_success_flash_message(lang('Request Ignored'));
        redirect('training_management/training_general/request/');

    }

}