<?php
/**
 * Created by PhpStorm.
 * User: QANAH
 * Date: 3/6/16 Baker BIRTH DATE
 * Time: 2:51 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Manager
 */
class Faculty_Portfolio extends MX_Controller
{

    private $view_params = array();
    private $header_array = array();

    /**
     * Faculty_Portfolio constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('faculty_portfolio', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->breadcrumbs->push(lang('Faculty Portfolio'), '/faculty_portfolio');

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js', false);


        $this->view_params['menu_tab'] = 'faculty_portfolio';

        $this->header_array = array(
            'title' => lang('Faculty Portfolio'),
            'icon' => 'fa fa-university'
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $this->header_array, true);
    }


    /**
     *this function index
     * @return string the html view
     */
    public function index(){

        if (Orm_User::has_role_teacher()) {
            $this->header_array['link_attr'] = 'href="/faculty_portfolio/view"';
            $this->header_array['link_title'] = lang('My Portfolio');
            $this->header_array['link_icon'] = 'eye';
        }
        elseif(Orm_User::check_credential([Orm_User::USER_STAFF], false, 'faculty_portfolio-manage')){
            $this->header_array['link_attr'] = 'href="/faculty_portfolio/manage"';
            $this->header_array['link_title'] = lang('Manage');
            $this->header_array['link_icon'] = 'gears';
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
        $searchText = $this->input->get('text');
        Validator::not_empty_field_validator('text', $searchText, lang('Please Enter Search Text'));
        if(Validator::success()){
            $filter = ['keyword'=>$searchText, 'class_type' => Orm_User::USER_FACULTY];
            $results = Orm_User::get_all($filter,$page, $per_page);
            $count = Orm_User::get_count($filter);
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count($count);
        }
        $this->view_params['searchText'] = $searchText;
        $this->view_params['results'] = $results;
        $this->view_params['count'] = $count;
        $this->view_params['pager'] = $pager->render(true);
        $this->layout->view('faculty_portfolio/index', $this->view_params);
    }

    /**
     * this function view by its user id
     * @param int $user_id the id of the user id to be viewed
     * @return string the html view
     */
    public function view($user_id = 0) {

            if(!$user_id) {
                $user_id = Orm_User::get_logged_user_id();
            }

            $this->view_params['user'] = Orm_User::get_instance($user_id);
            $this->view_params['peers'] = Orm_User_Faculty::get_all(array('evaluator' => 'peer', 'evaluator_user_id' => $user_id));
            $this->view_params['managers'] = Orm_User_Faculty::get_all(array('evaluator' => 'supervisor', 'evaluator_user_id' => $user_id));
            $this->view_params['sub_menu'] = 'menu';
            $this->view_params['user_id'] = $user_id;
            $this->view_params['active'] = "general";

            $this->layout->view('faculty_portfolio/view', $this->view_params);
    }

    /**
     * this function view by its user id
     * @param int $user_id the user id of the profile to be viewed
     * @return string the html view
     */
    public function profile($user_id) {
        $this->view_params['user'] = Orm_User::get_instance($user_id);
        $this->view_params['page_class'] = "page-profile";
        $this->layout->view('faculty_portfolio/general_information/profile', $this->view_params);
    }
    /**
     * this function profile tabs by its type and user id
     * @param string $type the type of the profile tabs to be viewed
     * @param int $user_id the user id of the profile tabs to be viewed
     * @return string the html view
     */
    public function profile_tabs($type = 'link', $user_id = 0) {

        if(!in_array($type , array('link', 'wrapper'))) {
            $type = 'link';
        }
        $this->view_params['user_id'] = $user_id;
        $this->load->view("faculty_portfolio/tabs/{$type}", $this->view_params);
    }
    /**
     * this function general info by its type and user id
     * @param int $user_id the user id of the general info to be viewed
     * @return string the html view
     */
    public function general_info($user_id = 0) {

        $this->load->helper('text');

        if(!$user_id) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $this->view_params['user'] = Orm_User::get_instance($user_id);
        $this->view_params['sub_menu'] = 'menu';
        $this->view_params['user_id'] = $user_id;
        $this->view_params['active'] = "personal";

        $this->view_params['general_info'] = Orm_Fp_General_Information::get_one(array('user_id' => $user_id));

        $this->view_params['languages'] = $this->language_view(true, $user_id);
        $this->view_params['skills'] = $this->skill_view(true, $user_id);
        $this->view_params['trainings'] = $this->training_view(true, $user_id);
        $this->view_params['experiences'] = $this->experience_view(true, $user_id);

        if ($this->input->is_ajax_request()) {
            $this->load->view("faculty_portfolio/general_information/list", $this->view_params);
        } else {
            $this->layout->view("faculty_portfolio/general_information/list", $this->view_params);
        }
    }

    /**
     *this function general info manage
     * @redirect success or error
     */
    public function general_info_manage() {

        $user_id = Orm_User::get_logged_user_id();
        $general_info = Orm_Fp_General_Information::get_one(array('user_id' => $user_id));

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('Uploader');

            $mobile_no = $this->input->post('mobile_no');
            $personal_email = $this->input->post('personal_email');
            $contract_date = $this->input->post('contract_date');
            $contract_type = $this->input->post('contract_type');
            $cv_text_ar = $this->input->post('cv_text_ar');
            $cv_text_en = $this->input->post('cv_text_en');
            $website = $this->input->post('website');
            $twitter = $this->input->post('twitter');
            $facebook = $this->input->post('facebook');
            $linkedin = $this->input->post('linkedin');

            if(trim($personal_email)!='') {
                Validator::email_field_validator('personal_email', $personal_email, lang('Email is wrong'));
            }
            if((!$general_info->get_id()) and $_FILES['cv_attachment']['error']==0) {
                Uploader::common_validator('contract_attachment', 'contract_attachment');
                Uploader::zero_size_validator('contract_attachment', 'contract_attachment', lang('File not found.'));
                Uploader::max_size_validator('contract_attachment', 'contract_attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
                Uploader::mime_type_validator('contract_attachment', 'contract_attachment', $this->config->item('upload_allow'), lang('File type not allowed.'));
            }

            if((!$general_info->get_id()) and $_FILES['cv_attachment']['error']==0) {
                Uploader::common_validator('cv_attachment', 'cv_attachment');
                Uploader::zero_size_validator('cv_attachment', 'cv_attachment', lang('File not found.'));
                Uploader::max_size_validator('cv_attachment', 'cv_attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
                Uploader::mime_type_validator('cv_attachment', 'cv_attachment', $this->config->item('upload_allow'), lang('File type not allowed.'));
            }

            $general_info->set_mobile_no($mobile_no);
            $general_info->set_personal_email($personal_email);
            $general_info->set_contract_date($contract_date);
            $general_info->set_contract_type($contract_type);
            $general_info->set_cv_text_ar($cv_text_ar);
            $general_info->set_cv_text_en($cv_text_en);
            $general_info->set_website(prep_url($website));
            $general_info->set_twitter(prep_url($twitter));
            $general_info->set_facebook(prep_url($facebook));
            $general_info->set_linkedin(prep_url($linkedin));

            if (Validator::success()) {

                if((!$general_info->get_id() || $general_info->get_id()!=0) && $_FILES['contract_attachment']['error']==0) {
                    $contract_attachment = '/files/Users/' . $user_id . '/contract_attachment.' . Uploader::get_file_extension('contract_attachment');
                    Uploader::move_file_to('contract_attachment', rtrim(FCPATH, '/') . $contract_attachment);

                    $general_info->set_contract_attachment($contract_attachment);
                }

                if((!$general_info->get_id() || $general_info->get_id()!=0) && $_FILES['cv_attachment']['error']==0) {
                    $cv_attachment = '/files/Users/' . $user_id . '/cv_attachment.' . Uploader::get_file_extension('cv_attachment');
                    Uploader::move_file_to('cv_attachment', rtrim(FCPATH, '/') . $cv_attachment);

                    $general_info->set_cv_attachment($cv_attachment);
                }

                $general_info->set_user_id($user_id);
                $general_info->save();

                json_response(array('status' => true, 'html' => $this->general_info($user_id, true)));
            }
        }

        $this->view_params['general_info'] = $general_info;

        $html = $this->load->view('faculty_portfolio/general_information/manage', $this->view_params, true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }
    /**
     * this function general info show cv by its id
     * @param int $id the id of the general info show cv to be viewed
     * @return string the html view
     */
    public function general_info_show_cv($id=0) {
        $fp = Orm_Fp_General_Information::get_instance($id);

        $close = lang('close');
        $title = lang('CV');

        echo <<<HTML
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            {$title}
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>

        <div class="modal-body">
HTML;


        echo $fp->get_cv_text();
    echo <<<HTML
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left" data-dismiss="modal">{$close}</button>
        </div>
    </div>
</div>
HTML;


    }


    /* Language functions */

    /**
     *this function language manage
     * @redirect success or error
     */
    public function language_manage() {

        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $language = $this->input->post('language');
        $level    = $this->input->post('level');

        $language_obj = Orm_Fp_Language::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $language_obj->set_language($language);
            $language_obj->set_level($level);

            if(!($language_obj->get_id() && $language_obj->get_user_id() != $user_id)) {
                $language_obj->set_user_id($user_id);
            }

            Validator::required_field_validator('language', $language, lang('This is a required field'));
            Validator::required_field_validator('level', $level, lang('This is a required field'));
            Validator::integer_field_validator('level', $level, lang('This is a required field'));

            if(Validator::success()){
                $language_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $language_obj = Orm_Fp_Language::get_instance($id);
        }

        $this->view_params['language'] = $language_obj;

        $html = $this->load->view('faculty_portfolio/general_information/language/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function language delete by its id
     * @param int $id the id of the language delete to be viewed
     * @redirect success or error
     */
    public function language_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $language_obj = Orm_Fp_Language::get_instance($id);

        if($language_obj->get_id() && $language_obj->get_user_id() == $user_id) {
            $language_obj->delete();
        }
    }
    /**
     * this function language view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the language view to be viewed
     * @param int $user_id the user id of the language view to be viewed
     * @return mixed the html view
     */
    public function language_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }
        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $language_page = intval($this->input->post_get('language_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['languages'] = Orm_Fp_Language::get_all(['user_id' => $user_id], $language_page, $per_page);

        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/language_view', 'page_label' => 'language_page'));
        $pager->set_page($language_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Language::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="language_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }


        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/general_information/language/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/general_information/language/list', $this->view_params);
    }


    /* Skill functions */

    /**
     *this function skill manage
     * @redirect success or error
     */
    public function skill_manage() {
        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $name = $this->input->post('skill');
        $rank  = $this->input->post('rank');

        $skill_obj = Orm_Fp_Skill::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $skill_obj->set_name($name);
            $skill_obj->set_rank($rank);

            if(!($skill_obj->get_id() && $skill_obj->get_user_id() != $user_id)) {
                $skill_obj->set_user_id($user_id);
            }

            Validator::required_field_validator('skill', $name, lang('This is a required field'));
            Validator::required_field_validator('rank', $rank, lang('This is a required field'));
            Validator::integer_field_validator('rank', $rank, lang('This is a required field'));

            if(Validator::success()){
                $skill_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $skill_obj = Orm_Fp_Skill::get_instance($id);
        }

        $this->view_params['skill'] = $skill_obj;

        $html = $this->load->view('faculty_portfolio/general_information/skill/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }
    /**
     *this function skill delete
     * @param int $id the id of the skill delete to be viewed
     * @redirect success or error
     */
    public function skill_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $skill_obj = Orm_Fp_Skill::get_instance($id);

        if($skill_obj->get_id() && $skill_obj->get_user_id() == $user_id) {
            $skill_obj->delete();
        }
    }
    /**
     * this function skill view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the skill view to be viewed
     * @param int $user_id the user id of the skill view to be viewed
     * @return mixed the html view
     */
    public function skill_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }

        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $skill_page = intval($this->input->post_get('skill_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['skills'] = Orm_Fp_Skill::get_all(['user_id' => $user_id], $skill_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/skill_view', 'page_label' => 'skill_page'));
        $pager->set_page($skill_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Skill::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="skill_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return  $this->load->view('faculty_portfolio/general_information/skill/list', $this->view_params,true);
        }

         $this->load->view('faculty_portfolio/general_information/skill/list', $this->view_params);
    }


    /* Training functions */

    /**
     *this function training manage
     * @@redirect success or error
     */
    public function training_manage() {
        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $title       = $this->input->post('title');
        $date        = $this->input->post('date');
        $duration    = $this->input->post('duration');
        $address     = $this->input->post('address');
        $description = $this->input->post('description');

        $training_obj = Orm_Fp_Training::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $training_obj->set_title($title);
            $training_obj->set_date($date);
            $training_obj->set_duration($duration);
            $training_obj->set_address($address);
            $training_obj->set_description($description);


            if(!($training_obj->get_id() && $training_obj->get_user_id() != $user_id)) {
                $training_obj->set_user_id($user_id);
            }

            Validator::required_field_validator('title', $title, lang('This is a required field'));
            Validator::required_field_validator('date', $date, lang('This is a required field'));
            Validator::required_field_validator('duration', $duration, lang('This is a required field'));
            Validator::date_format_validator('date', $date, lang('This is a required field'));


            if(Validator::success()){
                $training_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $training_obj = Orm_Fp_Training::get_instance($id);
        }

        $this->view_params['training'] = $training_obj;

        $html = $this->load->view('faculty_portfolio/general_information/training/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }
    /**
     *this function training delete by its id
     * @param int $id the id of the training delete to be viewed
     * @@redirect success or error
     */
    public function training_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $training_obj = Orm_Fp_Training::get_instance($id);

        if($training_obj->get_id() && $training_obj->get_user_id() == $user_id) {
            $training_obj->delete();
        }
    }
    /**
     * this function training view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the training view to be viewed
     * @param int $user_id the user id of the training view to be viewed
     * @return mixed the html view
     */
    public function training_view($to_buffer=false, $user_id) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }
        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $training_page = intval($this->input->post_get('training_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['trainings'] = Orm_Fp_Training::get_all(['user_id' => $user_id], $training_page, $per_page);


        $this->view_params['pager'] = '';
        $pager = new Pager(array('url' => '/faculty_portfolio/training_view', 'page_label' => 'training_page'));
        $pager->set_page($training_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Training::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="training_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/general_information/training/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/general_information/training/list', $this->view_params);
    }



    /* Experience functions */

    /**
     *this function experience manage
     * @@redirect success or error
     */
    public function experience_manage() {
        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $organization = $this->input->post('organization');
        $date_from    = $this->input->post('date_from');
        $date_to      = $this->input->post('date_to');
        $position     = $this->input->post('position');
        $address      = $this->input->post('address');
        $description  = $this->input->post('description');

        $training_obj = Orm_Fp_Experience::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $training_obj->set_organization($organization);
            $training_obj->set_date_from($date_from);
            $training_obj->set_date_to($date_to);
            $training_obj->set_position($position);
            $training_obj->set_address($address);
            $training_obj->set_description($description);


            if(!($training_obj->get_id() && $training_obj->get_user_id() != $user_id)) {
                $training_obj->set_user_id($user_id);
            }

            Validator::required_field_validator('organization', $organization, lang('This is a required field'));
            Validator::required_field_validator('date_from', $date_from, lang('This is a required field'));
            Validator::date_format_validator('date', $date_from, lang('This is a required field'));
            Validator::required_field_validator('date_to', $date_to, lang('This is a required field'));
            Validator::date_format_validator('date', $date_to, lang('This is a required field'));
            Validator::required_field_validator('position', $position, lang('This is a required field'));
            Validator::date_range_validator('date_from', $date_from, $date_to, lang('Date range is wrong'));



            if(Validator::success()){
                $training_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $training_obj = Orm_Fp_Experience::get_instance($id);
        }

        $this->view_params['experience'] = $training_obj;

        $html = $this->load->view('faculty_portfolio/general_information/experience/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     *this function experience delete by its id
     * @param int $id the id of the experience delete to be viewed
     * @@redirect success or error
     */
    public function experience_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $experience_obj = Orm_Fp_Experience::get_instance($id);

        if($experience_obj->get_id() && $experience_obj->get_user_id() == $user_id) {
            $experience_obj->delete();
        }
    }

    /**
     * this function experience view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the experience view to be viewed
     * @param int $user_id the user id of the experience view to be viewed
     * @return mixed the html view
     */
    public function experience_view($to_buffer=false, $user_id) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }
        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $experience_page = intval($this->input->post_get('experience_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['experiences'] = Orm_Fp_Experience::get_all(['user_id' => $user_id], $experience_page, $per_page);

        $this->view_params['pager']='';

        $pager = new Pager(array('url' => '/faculty_portfolio/experience_view', 'page_label' => 'experience_page'));
        $pager->set_page($experience_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Experience::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="experience_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/general_information/experience/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/general_information/experience/list', $this->view_params);
    }

}
