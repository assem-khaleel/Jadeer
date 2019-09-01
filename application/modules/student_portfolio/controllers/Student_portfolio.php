<?php
/**
 * Created by PhpStorm.
 * User: MAZEN
 * Date: 8/10/15
 * Time: 2:40 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Config $config
 * Class Manager
 */
class Student_Portfolio extends MX_Controller
{

    private $view_params = array();
    private $can_manage = false;
    private $header_array = array();

    /**
     * Student_Portfolio constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('student_portfolio', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->can_manage = (Orm_User::get_logged_user() instanceof Orm_User_Student);

        $this->breadcrumbs->push(lang('Student Portfolio'), '/student_portfolio');

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');

        $this->view_params['menu_tab'] = 'student_portfolio';

        $this->header_array = array(
            'title' => lang('Student Portfolio'),
            'icon' => 'fa fa-university'
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $this->header_array, true);
    }


    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {

        if ($this->can_manage) {
            $this->header_array['link_attr'] = 'href="/student_portfolio/view"';
            $this->header_array['link_title'] = lang('My Portfolio');
            $this->header_array['link_icon'] = lang('eye');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $this->header_array, true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        if (!$page) {
            $page = 1;
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));

        $results = array();
        $count = 0;
        $searchText = trim($this->input->get('text'));
        Validator::not_empty_field_validator('text', $searchText, lang('Please Enter Search Text'));
        if (Validator::success()) {
            $filter = ['keyword' => $searchText, 'class_type' => Orm_User::USER_STUDENT];
            $results = Orm_User::get_all($filter, $page, $per_page);
            $count = Orm_User::get_count($filter);
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count($count);
        }
        $this->view_params['searchText'] = $searchText;
        $this->view_params['results'] = $results;
        $this->view_params['count'] = $count;
        $this->view_params['pager'] = $pager->render(true);
        $this->layout->view('student_portfolio/index', $this->view_params);
    }

    /**
     * this function view by its user id
     * @param int $user_id the user id of the view to be viewed
     * @return string the html view
     */
    public function view($user_id = 0)
    {
        $this->general_info($user_id);
    }

    /**
     * this function profile by its user id
     * @param int $user_id the user id of the profile to be viewed
     * @return string the html view
     */
    public function profile($user_id)
    {
        $this->view_params['user'] = Orm_User::get_instance($user_id);
        $this->view_params['page_class'] = "page-profile";
        $this->layout->view('student_portfolio/profile', $this->view_params);
    }
    /**
     * this function profile tabs by its type and user id
     * @param string $type the type of the profile tabs to be viewed
     * @param int $user_id the user id of the profile tabs to be viewed
     * @return string the html view
     */
    public function profile_tabs($type = 'link', $user_id = 0)
    {

        if (!in_array($type, array('link', 'wrapper'))) {
            $type = 'link';
        }
        $this->view_params['user_id'] = $user_id;

        $this->load->view("student_portfolio/tabs/{$type}", $this->view_params);
    }

    /**
     * this function academic info by its user id
     * @param int $user_id the user id of the academic info to be viewed
     * @return string the html view
     */
    public function academic_info($user_id = 0)
    {

        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }
        $this->view_params['sub_menu'] = 'menu';
        $this->view_params['user_id'] = $user_id;
        $this->view_params['student_academic'] = Orm_Stp_Academic::get_one(array('student_id' => $user_id));
        $this->view_params['active'] = "academic";
        $this->view_params['academics'] = $this->academic_view($user_id, true);
        $this->view_params['awards'] = $this->award_view($user_id, true);

        $this->layout->view("student_portfolio/academic", $this->view_params);

    }

    /**
     * this function general info by its user id
     * @param int $user_id the user id of the general info to be viewed
     * @return string the html view
     */
    public function general_info($user_id = 0)
    {

        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $this->view_params['user'] = Orm_User::get_instance($user_id);

        $this->view_params['sub_menu'] = 'menu';
        $this->view_params['user_id'] = $user_id;
        $this->view_params['active'] = "general";

        $this->layout->view("general", $this->view_params);

    }

    /**
     * this function personal info by its user id
     * @param int $user_id the user id of the personal info to be viewed
     * @return string the html view
     */
    public function personal_info($user_id = 0)
    {

        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $this->view_params['sub_menu'] = 'menu';
        $this->view_params['user_id'] = $user_id;

        $this->view_params['social'] = $this->social_view($user_id, true);
        $this->view_params['personal'] = $this->personal_view($user_id, true);
        $this->view_params['services'] = $this->community_view($user_id, true);
        $this->view_params['activities'] = $this->activity_view($user_id, true);
        $this->view_params['skills'] = $this->skill_view($user_id, true);


        $this->view_params['active'] = "personal";

        $this->layout->view("student_portfolio/personal", $this->view_params);
    }

    /**
     * this function recommendation complaint by its user id
     * @param int $user_id the user id of the recommendation complaint to be viewed
     * @return string the html view
     */
    public function recommendation_complaint($user_id = 0)
    {

        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $this->view_params['sub_menu'] = 'menu';
        $this->view_params['user_id'] = $user_id;

        $this->view_params['recommendations'] = Orm_Stp_Recommendations::get_all(array('student_id' => $user_id));

        $this->view_params['complaints'] = ''; //$this->complaint_view($user_id, true);


        $this->view_params['active'] = "recommendation";

        $this->layout->view("student_portfolio/recommendation", $this->view_params);
    }


    /* Award functions */

    /**
     * this function award manage
     * @return string the html view
     */
    public function award_manage()
    {

        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $award_obj = Orm_Stp_Awards_And_Publications::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->can_manage) {

            $title = $this->input->post('title');
            $publish_date = $this->input->post('publish_date');
            $type = $this->input->post('type');

            $award_obj->set_title($title);
            $award_obj->set_publish_date($publish_date);
            $award_obj->set_type($type);

            Validator::required_field_validator('title', $title, lang('This is a required field'));
            Validator::date_format_validator('publish_date', $publish_date, lang('This is a required field'));
            Validator::integer_field_validator('type', $type, lang('This is a required field'));

            $this->load->library('Uploader');

//            Uploader::common_validator('attachment', 'attachment');
//            Uploader::zero_size_validator('attachment', 'attachment', lang('File not found.'));
            Uploader::max_size_validator('attachment', 'attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
            Uploader::mime_type_validator('attachment', 'attachment', $this->config->item('upload_allow'), lang('File type not allowed.'));


            if (Validator::success() && !($award_obj->get_id() && $award_obj->get_student_id() != $user_id)) {

                if (!$award_obj->get_id() || $award_obj->get_id() != 0) {
                    $attachment = Uploader::get_file_name('attachment', '/files/Users/' . $user_id . '/awards/', false);

                    Uploader::move_file_to('attachment', rtrim(FCPATH, '/') . $attachment);
                    $award_obj->set_attachement($attachment);

//                    if ($_FILES['attachment']['size']) {
//                        Uploader::move_file_to('attachment', rtrim(FCPATH, '/') . $attachment);
//                        $award_obj->set_attachement($attachment);
//                    }

                }

                $award_obj->set_student_id($user_id);

                $award_obj->save();
                json_response(array('status' => true));
            }

        } else {
            $award_obj = Orm_Stp_Awards_And_Publications::get_instance($id);
        }

        $this->view_params['award'] = $award_obj;

        $html = $this->load->view('student_portfolio/forms/award/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function award delete by its id
     * @param int $id the id of the award delete to be viewed
     * @redirect success or error
     */
    public function award_delete($id = 0)
    {
        $user_id = Orm_User::get_logged_user_id();

        $award_obj = Orm_Stp_Awards_And_Publications::get_instance($id);

        if ($award_obj->get_id() && $award_obj->get_student_id() == $user_id) {
            $award_obj->delete();
        }
    }
    /**
     * this function award view by its user id and to buffer
     * @param int $user_id the user id of the award view to be viewed
     * @param bool $to_buffer the to buffer of the award view to be viewed
     * @return object|string the html view
     */
    public function award_view($user_id = 0, $to_buffer = false)
    {

        if (!Orm_User::get_logged_user_id()) {
            show_404();
        }

        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $award_page = intval($this->input->post_get('award_page')) ?: 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['awards'] = Orm_Stp_Awards_And_Publications::get_all(['student_id' => $user_id], $award_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/student_portfolio/award_view/'.$user_id, 'page_label' => 'award_page'));
        $pager->set_page($award_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Stp_Awards_And_Publications::get_count(['student_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="award_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('student_portfolio/forms/award/list', $this->view_params, true);
        }

        $this->load->view('student_portfolio/forms/award/list', $this->view_params);
    }


    /**
     * this function community manage
     * @redirect success or error
     */
    public function community_manage()
    {
        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $service_obj = Orm_Stp_Community_Services::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->can_manage) {

            $date = $this->input->post('date');
            $location = $this->input->post('location');
            $number_of_hours = $this->input->post('number_of_hours');
            $supervisor = $this->input->post('supervisor');
            $description = $this->input->post('description');


            $service_obj->set_date($date);
            $service_obj->set_location($location);
            $service_obj->set_number_of_hours($number_of_hours);
            $service_obj->set_supervisor($supervisor);
            $service_obj->set_description($description);

            Validator::date_format_validator('date', $date, lang('This is a required field'));
            Validator::required_field_validator('location', $location, lang('This is a required field'));
            Validator::required_field_validator('supervisor', $supervisor, lang('This is a required field'));
            Validator::numeric_field_validator('number_of_hours', $number_of_hours, lang('This field must be a Number'));


            if (Validator::success() && !($service_obj->get_id() && $service_obj->get_student_id() != $user_id)) {
                $service_obj->set_student_id($user_id);

                $service_obj->save();
                json_response(array('status' => true));
            }
        } else {
            $service_obj = Orm_Stp_Community_Services::get_instance($id);
        }

        $this->view_params['service'] = $service_obj;

        $html = $this->load->view('student_portfolio/forms/service/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function community delete by its id
     * @param int $id the id of the community delete to be viewed
     * @redirect success or error
     */
    public function community_delete($id = 0)
    {
        $user_id = Orm_User::get_logged_user_id();

        $service_obj = Orm_Stp_Community_Services::get_instance($id);

        if ($service_obj->get_id() && $service_obj->get_student_id() == $user_id) {
            $service_obj->delete();
        }
    }

    /**
     * this function community view by its user id and to buffer
     * @param int $user_id the user id of the community view to be viewed
     * @param bool $to_buffer the to buffer of the community view to be viewed
     * @return object|string the html view
     */
    public function community_view($user_id = 0, $to_buffer = false)
    {

        if (!Orm_User::get_logged_user_id()) {
            show_404();
        }

        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $service_page = intval($this->input->post_get('service_page')) ?: 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['services'] = Orm_Stp_Community_Services::get_all(['student_id' => $user_id], $service_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/student_portfolio/community_view', 'page_label' => 'service_page'));
        $pager->set_page($service_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Stp_Community_Services::get_count(['student_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="services_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('student_portfolio/forms/service/list', $this->view_params, true);
        }

        $this->load->view('student_portfolio/forms/service/list', $this->view_params);
    }

    /* Activity functions */

    /**
     * this function activity manage
     * @redirect success or error
     */
    public function activity_manage()
    {
        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $activity_obj = Orm_Stp_Activities::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->can_manage) {

            $date = $this->input->post('date');
            $title = $this->input->post('title');


            $activity_obj->set_date($date);
            $activity_obj->set_title($title);

            Validator::date_format_validator('date', $date, lang('This is a required field'));
            Validator::required_field_validator('title', $title, lang('This is a required field'));


            if (Validator::success() && !($activity_obj->get_id() && $activity_obj->get_student_id() != $user_id)) {
                $activity_obj->set_student_id($user_id);

                $activity_obj->save();
                json_response(array('status' => true));
            }
        } else {
            $activity_obj = Orm_Stp_Activities::get_instance($id);
        }

        $this->view_params['activity'] = $activity_obj;

        $html = $this->load->view('student_portfolio/forms/activity/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function activity delete by its id
     * @param int $id the id of the activity delete to be viewed
     * @redirect success or error
     */
    public function activity_delete($id = 0)
    {
        $user_id = Orm_User::get_logged_user_id();

        $activity_obj = Orm_Stp_Activities::get_instance($id);

        if ($activity_obj->get_id() && $activity_obj->get_student_id() == $user_id) {
            $activity_obj->delete();
        }
    }

    /**
     * this function activity view by its user id and to buffer
     * @param int $user_id the user id of the activity view to be viewed
     * @param bool $to_buffer the to buffer of the activity view to be viewed
     * @return object|string the html view
     */
    public function activity_view($user_id = 0, $to_buffer = false)
    {

        if (!Orm_User::get_logged_user_id()) {
            show_404();
        }

        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $activity_page = intval($this->input->post_get('activity_page')) ?: 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['activities'] = Orm_Stp_Activities::get_all(['student_id' => $user_id], $activity_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/student_portfolio/activity_view', 'page_label' => 'activity_page'));
        $pager->set_page($activity_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Stp_Activities::get_count(['student_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="activities_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('student_portfolio/forms/activity/list', $this->view_params, true);
        }

        $this->load->view('student_portfolio/forms/activity/list', $this->view_params);
    }

    /**
     * this function skill manage
     * @redirect success or error
     */
    public function skill_manage() {

        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $skill_obj = Orm_Stp_Skill::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $skill_name_en           = $this->input->post('skill_name_en');
            $skill_name_ar           = $this->input->post('skill_name_ar');

            $skill_obj->set_skill_name_en($skill_name_en);
            $skill_obj->set_skill_name_ar($skill_name_ar);

            $this->load->library('Uploader');


            Validator::required_field_validator('skill_name_en', $skill_name_en, lang('This is a required field'));
            Validator::required_field_validator('skill_name_ar', $skill_name_ar, lang('This is a required field'));


            if(Validator::success() && !($skill_obj->get_id() && $skill_obj->get_user_id() != $user_id)) {
                $skill_obj->set_user_id($user_id);

                if(!$skill_obj->get_id() || $skill_obj->get_id()!=0 ) {

                    Uploader::common_validator('attachment', 'attachment');
                    Uploader::zero_size_validator('attachment', 'attachment', lang('File not found.'));
                    Uploader::max_size_validator('attachment', 'attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
                    Uploader::mime_type_validator('attachment', 'attachment', $this->config->item('upload_allow'), lang('File type not allowed.'));

                    $attachment = Uploader::get_file_name('attachment', '/files/Users/' . $user_id . '/skills/', false);
                    Uploader::move_file_to('attachment', rtrim(FCPATH, '/') . $attachment);
                    $skill_obj->set_attachment($attachment);
                }


                $skill_obj->save();
                json_response(array('status' => true));
            }

        }
        else {
            $skill_obj = Orm_Stp_Skill::get_instance($id);
        }

        $this->view_params['skill'] = $skill_obj;

        $html = $this->load->view('student_portfolio/forms/skills/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function skill delete by its id
     * @param int $id the id of the skill delete to be viewed
     * @redirect success or error
     */
    public function skill_delete($id = 0) {
        $user_id = Orm_User::get_logged_user_id();

        $skill_obj = Orm_Stp_Skill::get_instance($id);

        if($skill_obj->get_id() && $skill_obj->get_user_id() == $user_id) {
            $skill_obj->delete();
        }
    }

    /**
     * this function skill view by its user id and to buffer
     * @param int $user_id the user id of the skill view to be viewed
     * @param bool $to_buffer the to buffer of the skill view to be viewed
     * @return object|string the html view
     */
    public function skill_view($user_id=0, $to_buffer=false) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }
        if(!$user_id){

            $user_id = Orm_User::get_logged_user_id();
        }
        $skill_page = intval($this->input->post_get('skill_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['skills'] = Orm_Stp_Skill::get_all(['user_id' => $user_id], $skill_page, $per_page);

        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/student_portfolio/skill_view', 'page_label' => 'skill_page'));
        $pager->set_page($skill_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Stp_Skill::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="skill_container"');
        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('student_portfolio/forms/skills/list', $this->view_params, true);
        }

        $this->load->view('student_portfolio/skills/forms/list', $this->view_params);
    }

    /* Complaint functions */

    /**
     * this function complaint manage
     * @redirect success or error
     */
    public function complaint_manage()
    {
        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');


        $complaint_obj = Orm_Stp_Complaints::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->can_manage) {

            $date = $this->input->post('date');
            $complaints = $this->input->post('complaints');

            $complaint_obj->set_date($date);
            $complaint_obj->set_complaints($complaints);

            Validator::date_format_validator('date', $date, lang('This is a required field'));
            Validator::required_field_validator('complaints', $complaints, lang('This is a required field'));


            if (Validator::success() && !($complaint_obj->get_id() && $complaint_obj->get_student_id() != $user_id)) {
                $this->load->library('Uploader');

                Uploader::common_validator('attachment', 'attachment');
                Uploader::zero_size_validator('attachment', 'attachment', lang('File not found.'));
                Uploader::max_size_validator('attachment', 'attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
                Uploader::mime_type_validator('attachment', 'attachment', $this->config->item('upload_allow'), lang('File type not allowed.'));

                if (!$complaint_obj->get_id() || $complaint_obj->get_id() != 0) {
                    $attachment = Uploader::get_file_name('attachment', '/files/Users/' . $user_id . '/complaints/', false);
                    Uploader::move_file_to('attachment', rtrim(FCPATH, '/') . $attachment);
                    $complaint_obj->set_attachement($attachment);
                }

                $complaint_obj->set_student_id($user_id);

                $complaint_obj->save();
                json_response(array('status' => true));
            }
        } else {
            $complaint_obj = Orm_Stp_Complaints::get_instance($id);
        }


        $this->view_params['complaint'] = $complaint_obj;

        $html = $this->load->view('student_portfolio/forms/complaint/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function complaint delete by its id
     * @param int $id the id of the complaint delete to be viewed
     * @redirect success or error
     */
    public function complaint_delete($id = 0)
    {
        $user_id = Orm_User::get_logged_user_id();

        $award_obj = Orm_Stp_Complaints::get_instance($id);

        if ($award_obj->get_id() && $award_obj->get_student_id() == $user_id) {
            $award_obj->delete();
        }
    }

    /**
     * this function complaint view by its user id and to buffer
     * @param int $user_id the user id of the complaint view to be viewed
     * @param bool $to_buffer the to buffer of the complaint view to be viewed
     * @return object|string the html view
     */
    public function complaint_view($user_id = 0, $to_buffer = false)
    {

        if (!Orm_User::get_logged_user_id()) {
            show_404();
        }

        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $award_page = intval($this->input->post_get('award_page')) ?: 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['complaints'] = Orm_Stp_Complaints::get_all(['student_id' => $user_id], $award_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/student_portfolio/complaint_view', 'page_label' => 'award_page'));
        $pager->set_page($award_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Stp_Complaints::get_count(['student_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="complaint_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('student_portfolio/forms/complaint/list', $this->view_params, true);
        }

        $this->load->view('student_portfolio/forms/complaint/list', $this->view_params);
    }


    /* Academic functions */

    /**
     * this function academic manage
     * @redirect success or error
     */
    public function academic_manage()
    {

        $user_id = Orm_User::get_logged_user_id();

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->can_manage) {
            $advising = $this->input->post('advising');

            $academic = Orm_Stp_Academic::get_one(array('student_id' => $user_id));
            $academic->set_student_id(Orm_User::get_logged_user_id());
            $academic->set_student_academic_advicing($advising);
            $academic->save();

            json_response(array('status' => true, 'html' => $this->academic_view($user_id, true)));
        }

        $this->load->view('student_portfolio/forms/academic/manage', $this->view_params);
    }

    /**
     * this function academic view by its user id and to buffer
     * @param int $user_id the user id of the academic view to be viewed
     * @param bool $to_buffer the to buffer of the academic view to be viewed
     * @return object|string the html view
     */
    public function academic_view($user_id = 0, $to_buffer = false)
    {
        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $this->view_params['user_id'] = $user_id;
        $this->view_params['student_academic'] = Orm_Stp_Academic::get_one(array('student_id' => $user_id));
        $this->view_params['active'] = "academic";

        if ($to_buffer) {
            return $this->load->view("student_portfolio/forms/academic/list", $this->view_params, true);
        }

        $this->load->view("student_portfolio/forms/academic/list", $this->view_params);
    }


    /* Personal functions */

    /**
     * this function personal manage
     * @redirect success or error
     */
    public function personal_manage()
    {

        $user_id = Orm_User::get_logged_user_id();

        $personal = Orm_Stp_Personal::get_one(array('student_id' => $user_id));
        $this->view_params['personal'] = $personal;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //    $resume = $this->input->post('resume');
            $personal_goals = $this->input->post('goals');
            $hobbies = $this->input->post('hobbies');

            $personal->set_student_id($user_id);
            $personal->set_personal_goals($personal_goals);
            $personal->set_hobbies($hobbies);


            $file = $this->_attach('resume', $personal->get_resume(), $user_id);
            if ($file) {
                $personal->set_resume($file);
            }
            if (Validator::success()) {

                $personal->save();
            }

            json_response(array('status' => true, 'html' => $this->personal_view($user_id, true)));
        }

        $this->load->view('student_portfolio/forms/personal/manage', $this->view_params);
    }

    /**
     * this function personal view by its user id and to buffer
     * @param int $user_id the user id of the personal view to be viewed
     * @param bool $to_buffer the to buffer of the personal view to be viewed
     * @return object|string the html view
     */
    public function personal_view($user_id = 0, $to_buffer)
    {
        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $this->view_params['user_id'] = $user_id;
        $this->view_params['personal'] = Orm_Stp_Personal::get_one(array('student_id' => $user_id));


        if ($to_buffer) {
            return $this->load->view("student_portfolio/forms/personal/list", $this->view_params, true);
        }

        $this->load->view("student_portfolio/forms/personal/list", $this->view_params);
    }

    /**
     * this function personal download resume by its user id
     * @param int $user_id the user id of the personal download resume to be viewed
     * @return string the html view
     */
    public function personal_download_resume($user_id = 0)
    {

        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $personal = Orm_Stp_Personal::get_one(array('student_id' => $user_id));

        $this->download_file($personal->get_resume());
    }


    /* Social functions */

    /**
     * this function  social view by its user id and to buffer
     * @param int $user_id the user id of the  social view to be viewed
     * @param bool $to_buffer the to buffer of the  social view to be viewed
     * @return object|string the html view
     */
    public function social_view($user_id = 0, $to_buffer = false)
    {

        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $this->view_params['user_id'] = $user_id;
        $this->view_params['social'] = Orm_Stp_Social::get_one(array('student_id' => $user_id));;

        $html = $this->load->view('student_portfolio/forms/social/list', $this->view_params, true);

        if ($to_buffer) {
            return $html;
        } else {
            echo $html;
        }
    }

    /**
     * this function social manage
     * @redirect success or error
     */
    public function social_manage()
    {

        $user_id = Orm_User::get_logged_user_id();
        $social = Orm_Stp_Social::get_one(array('student_id' => Orm_User::get_logged_user_id()));
        $this->view_params['social'] = $social;

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->can_manage) {
            $facebook = $this->input->post('facebook');
            $twitter = $this->input->post('twitter');
            $linkedin = $this->input->post('linkedin');

            $social->set_facebook($facebook);
            $social->set_tweeter($twitter);
            $social->set_linkedin($linkedin);
            $social->set_student_id($user_id);
            $social->save();

            json_response(array('status' => true, 'html' => $this->social_view($user_id, true)));
        }

        $this->load->view('student_portfolio/forms/social/manage', $this->view_params);
    }

    /**
     * this function career by its user id
     * @param int $user_id the user id of the career to be viewed
     * @return string the html view
     */
    public function career($user_id = 0)
    {
        if (!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $this->view_params['sub_menu'] = 'menu';
        $this->view_params['user_id'] = $user_id;

        $this->view_params['active'] = "recommendation";

        $this->load->view('career_opening', $this->view_params);
    }

    /**
     *the function download file by its file
     * @param string $file the file of the career to be calling function
     * @return string the calling function
     */
    private function download_file($file)
    {

        $file = FCPATH . trim($file, '/');
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }

        show_404();
    }

    /**
     *the function download file by its file
     * @param string $fieldName the fieldName of the career to be calling function
     * @param string $file the file of the career to be calling function
     * @param int $user_id the user id of the career to be calling function
     * @return string the calling function
     */
    private function _attach($fieldName, $file, $user_id)
    {

        Uploader::validator($fieldName, false, $file);

        $file_name = $fieldName . '-' . time();
        $file = Uploader::do_process($fieldName, "/files/Users/{$user_id}/resume/{$file_name}");

        return $file;
    }
    
}
