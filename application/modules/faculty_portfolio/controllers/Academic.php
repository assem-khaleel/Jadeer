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
 * Class Academic
 */
class Academic extends MX_Controller
{

    private $view_params = array();

    /**
     * Academic constructor.
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

        $this->view_params['menu_tab'] = 'faculty_portfolio';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Portfolio'),
            'icon' => 'fa fa-university'
        ), true);
    }

    /**
     * this function info by its user id
     * @param int $user_id the user id  of the info to be viewed
     * @return string the html view
     */
    public function info($user_id = 0) {
            if(!$user_id) {
                $user_id = Orm_User::get_logged_user_id();
            }


            $this->view_params['sub_menu'] = 'menu';
            $this->view_params['user_id'] = $user_id;
            $this->view_params['active'] = "academic";

            $this->view_params['academic_qualifications'] = $this->academic_qualification_view(true, $user_id);
            $this->view_params['academic_ranks'] = $this->academic_rank_view(true, $user_id);
            $this->view_params['administrative_works'] = $this->administrative_work_view(true, $user_id);
            $this->view_params['committees'] = $this->committee_view(true, $user_id);
            $this->view_params['supervisions'] = $this->supervision_view(true, $user_id);
            $this->view_params['academic_articles'] = $this->academic_article_view(true, $user_id);

        if ($this->input->is_ajax_request()) {
            $this->load->view("faculty_portfolio/academic/list", $this->view_params);
        } else {
            $this->layout->view("faculty_portfolio/academic/list", $this->view_params);
        }

    }



    /* Academic Qualification functions */
    /**
     * this function academic qualification manage
     * @redirect success or error
     */
    public function academic_qualification_manage() {
        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');


        $academic_qualification_obj = Orm_Fp_Academic_Qualification::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {


            $country         = $this->input->post('country');
            $city            = $this->input->post('city');
            $university      = $this->input->post('university');
            $college         = $this->input->post('college');
            $date_from       = $this->input->post('date_from');
            $date_to         = $this->input->post('date_to');
            $degree          = $this->input->post('degree');
            $grade           = $this->input->post('grade');
            $speciality      = $this->input->post('speciality');
            $supervisor_name = $this->input->post('supervisor_name');
            $thises_title    = $this->input->post('thises_title');
            $description     = $this->input->post('description');

            $academic_qualification_obj->set_country($country);
            $academic_qualification_obj->set_city($city);
            $academic_qualification_obj->set_university($university);
            $academic_qualification_obj->set_college($college);
            $academic_qualification_obj->set_date_from($date_from);
            $academic_qualification_obj->set_date_to($date_to);
            $academic_qualification_obj->set_degree($degree);
            $academic_qualification_obj->set_grade($grade);
            $academic_qualification_obj->set_speciality($speciality);

            $academic_qualification_obj->set_supervisor_name($supervisor_name);
            $academic_qualification_obj->set_thises_title($thises_title);
            $academic_qualification_obj->set_description($description);



            Validator::required_field_validator('country', $country, lang('This is a required field'));
            Validator::required_field_validator('city', $city, lang('This is a required field'));
            Validator::required_field_validator('university', $university, lang('This is a required field'));
            Validator::required_field_validator('college', $college, lang('This is a required field'));
            Validator::required_field_validator('degree', $degree, lang('This is a required field'));
            Validator::required_field_validator('grade', $grade, lang('This is a required field'));
            Validator::required_field_validator('speciality', $speciality, lang('This is a required field'));

            Validator::date_format_validator('date_from', $date_from, lang('This is a required field'));
            Validator::date_format_validator('date_to', $date_to, lang('This is a required field'));


            if(Validator::success() && !($academic_qualification_obj->get_id() && $academic_qualification_obj->get_user_id() != $user_id)) {
                $academic_qualification_obj->set_user_id($user_id);
                $academic_qualification_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $academic_qualification_obj = Orm_Fp_Academic_Qualification::get_instance($id);
        }

        $this->view_params['academic_qualification'] = $academic_qualification_obj;

        $html = $this->load->view('faculty_portfolio/academic/academic_qualification/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function academic qualification delete by its id
     * @param int $id the id  of the academic qualification delete to be viewed
     * @redirect success or error
     */
    public function academic_qualification_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $academic_qualification_obj = Orm_Fp_Academic_Qualification::get_instance($id);

        if($academic_qualification_obj->get_id() && $academic_qualification_obj->get_user_id() == $user_id) {
            $academic_qualification_obj->delete();
        }
    }

    /**
     * this function academic qualification view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the academic qualification view to be viewed
     * @param int $user_id the user id of the academic qualification view to be viewed
     * @return mixed the html view
     */
    public function academic_qualification_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }

        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $academic_qualification_page = intval($this->input->post_get('academic_qualification_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['academic_qualifications'] = Orm_Fp_Academic_Qualification::get_all(['user_id' => $user_id], $academic_qualification_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/academic/academic_qualification_view', 'page_label' => 'academic_qualification_page'));
        $pager->set_page($academic_qualification_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Academic_Qualification::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="academic_qualification_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }


        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/academic/academic_qualification/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/academic/academic_qualification/list', $this->view_params);
    }



    /* Academic Rank functions */

    /**
     *this function academic rank manage
     * @redirect success or error
     */
    public function academic_rank_manage() {

        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $academic_rank = $this->input->post('academic_rank');
        $rank_date     = $this->input->post('rank_date');

        $academic_rank_obj = Orm_Fp_Academic_Rank::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $academic_rank_obj->set_academic_rank($academic_rank);
            $academic_rank_obj->set_rank_date($rank_date);


            Validator::required_field_validator('rank', $academic_rank, lang('This is a required field'));
            Validator::integer_field_validator('rank', $academic_rank, lang('This is a required field'));
            Validator::date_format_validator('rank_date', $rank_date, lang('This is a required field'));

            if(Validator::success() && !($academic_rank_obj->get_id() && $academic_rank_obj->get_user_id() != $user_id)) {
                $academic_rank_obj->set_user_id($user_id);

                $academic_rank_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $academic_rank_obj = Orm_Fp_Academic_Rank::get_instance($id);
        }

        $this->view_params['academic_rank'] = $academic_rank_obj;

        $html = $this->load->view('faculty_portfolio/academic/academic_rank/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function academic rank delete by its id
     * @param int $id the id of the academic rank delete to be viewed
     * @redirect success or error
     */
    public function academic_rank_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $academic_rank_obj = Orm_Fp_Academic_Rank::get_instance($id);

        if($academic_rank_obj->get_id() && $academic_rank_obj->get_user_id() == $user_id) {
            $academic_rank_obj->delete();
        }
    }

    /**
     * this function academic rank view by its to buffer and user id
     * @param bool $to_buffer the to buffer of academic rank view  to be viewed
     * @param int $user_id the user id of academic rank view  to be viewed
     * @return mixed the html view
     */
    public function academic_rank_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }


        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $academic_rank_page = intval($this->input->post_get('academic_rank_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['academic_ranks'] = Orm_Fp_Academic_Rank::get_all(['user_id' => $user_id], $academic_rank_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/academic/academic_rank_view', 'page_label' => 'academic_rank_page'));
        $pager->set_page($academic_rank_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Academic_Rank::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="academic_rank_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }


        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/academic/academic_rank/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/academic/academic_rank/list', $this->view_params);
    }



    /* Administrative Work functions */

    /**
     *this function administrative work manage
     * @redirect success or error
     */
    public function administrative_work_manage() {

        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $start_date     = $this->input->post('start_date');
        $end_date       = $this->input->post('end_date');
        $position       = $this->input->post('position');
        $college_id     = $this->input->post('college_id');
        $department_id  = $this->input->post('department_id');
        $deanship_id    = $this->input->post('deanship_id');
        $vice_recotrate = $this->input->post('vice_recotrate');
        $type           = $this->input->post('type');

        $administrative_work_obj = Orm_Fp_Administrative_Work::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $administrative_work_obj->set_start_date($start_date);
            $administrative_work_obj->set_end_date($end_date);
            $administrative_work_obj->set_position($position);
            $administrative_work_obj->set_college_id($college_id);
            $administrative_work_obj->set_department_id($department_id);
            $administrative_work_obj->set_deanship_id($deanship_id);
            $administrative_work_obj->set_vice_recotrate($vice_recotrate);
            $administrative_work_obj->set_type($type);


            Validator::date_format_validator('start_date', $start_date, lang('This is a required field'));
            Validator::date_format_validator('end_date', $end_date, lang('This is a required field'));
            Validator::required_field_validator('position', $position, lang('This is a required field'));


            if(Validator::success() && !($administrative_work_obj->get_id() && $administrative_work_obj->get_user_id() != $user_id)) {
                $administrative_work_obj->set_user_id($user_id);

                $administrative_work_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $administrative_work_obj = Orm_Fp_Administrative_Work::get_instance($id);
        }

        $this->view_params['administrative_work'] = $administrative_work_obj;

        $html = $this->load->view('faculty_portfolio/academic/administrative_work/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function administrative work delete by its id
     * @param int $id the id of the administrative work delete to be viewed
     * @redirect success or error
     */
    public function administrative_work_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $administrative_work_obj = Orm_Fp_Administrative_Work::get_instance($id);

        if($administrative_work_obj->get_id() && $administrative_work_obj->get_user_id() == $user_id) {
            $administrative_work_obj->delete();
        }
    }

    /**
     * this function administrative work view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the administrative work view to be viewed
     * @param int $user_id the user id of the administrative work view  to be viewed
     * @return mixed the html view
     */
    public function administrative_work_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }

        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $administrative_work_page = intval($this->input->post_get('administrative_work_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['administrative_works'] = Orm_Fp_Administrative_Work::get_all(['user_id' => $user_id], $administrative_work_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/academic/administrative_work_view', 'page_label' => 'administrative_work_page'));
        $pager->set_page($administrative_work_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Administrative_Work::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="administrative_work_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }


        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/academic/administrative_work/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/academic/administrative_work/list', $this->view_params);
    }



    /* Administrative Work functions */

    /**
     *this function committee manage
     * @redirect success or error
     */
    public function committee_manage() {

        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $name       = $this->input->post('name');
        $start_date = $this->input->post('start_date');
        $end_date   = $this->input->post('end_date');

        $committee_obj = Orm_Fp_Committee::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $committee_obj->set_name($name);
            $committee_obj->set_start_date($start_date);
            $committee_obj->set_end_date($end_date);


            Validator::required_field_validator('name', $name, lang('This is a required field'));
            Validator::date_format_validator('start_date', $start_date, lang('This is a required field'));
            Validator::date_format_validator('end_date', $end_date, lang('This is a required field'));

            if(Validator::success() && !($committee_obj->get_id() && $committee_obj->get_user_id() != $user_id)) {
                $committee_obj->set_user_id($user_id);

                $committee_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $committee_obj = Orm_Fp_Committee::get_instance($id);
        }

        $this->view_params['committee'] = $committee_obj;

        $html = $this->load->view('faculty_portfolio/academic/committee/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }
    /**
     * this function committee delete by its id
     * @param int $id the id of the committee delete to be viewed
     * @return void the html view
     */
    public function committee_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $committee_obj = Orm_Fp_Committee::get_instance($id);

        if($committee_obj->get_id() && $committee_obj->get_user_id() == $user_id) {
            $committee_obj->delete();
        }
    }

    /**
     * this function committee view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the committee view to be viewed
     * @param int $user_id the user id of the committee view to be viewed
     * @return mixed the html view
     */
    public function committee_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }

        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $committee_page = intval($this->input->post_get('committee_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['committees'] = Orm_Fp_Committee::get_all(['user_id' => $user_id], $committee_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/academic/committee_view', 'page_label' => 'committee_page'));
        $pager->set_page($committee_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Committee::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="committee_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/academic/committee/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/academic/committee/list', $this->view_params);
    }



    /* Supervision functions */

    /**
     *this function supervision manage
     * @return string the html view
     */
    public function supervision_manage() {

        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $thises_type      = $this->input->post('thises_type');
        $level            = $this->input->post('level');
        $type             = $this->input->post('type');
        $thises_title_ar  = $this->input->post('thises_title_ar');
        $thises_title_en  = $this->input->post('thises_title_en');
        $grant_date       = $this->input->post('grant_date');
        $researcher       = $this->input->post('researcher');
        $summary_ar       = $this->input->post('summary_ar');
        $summary_en       = $this->input->post('summary_en');


        $supervision_obj = Orm_Fp_Supervision::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $supervision_obj->set_level($level);
            $supervision_obj->set_thises_type($thises_type);
            $supervision_obj->set_type($type);
            $supervision_obj->set_thises_title_ar($thises_title_ar);
            $supervision_obj->set_thises_title_en($thises_title_en);
            $supervision_obj->set_grant_date($grant_date);
            $supervision_obj->set_researcher($researcher);
            $supervision_obj->set_summary_ar($summary_ar);
            $supervision_obj->set_summary_en($summary_en);


            $this->load->library('Uploader');



            Validator::required_field_validator('level', $level, lang('This is a required field'));
            Validator::required_field_validator('thises_type', $thises_type, lang('This is a required field'));
            Validator::required_field_validator('type', $type, lang('This is a required field'));
            Validator::required_field_validator('thises_title_en', $thises_title_en, lang('This is a required field'));
            Validator::required_field_validator('thises_title_ar', $thises_title_ar, lang('This is a required field'));

            if(Validator::success() && !($supervision_obj->get_id() && $supervision_obj->get_user_id() != $user_id)) {

                Uploader::common_validator('attachment', 'attachment');
                Uploader::zero_size_validator('attachment', 'attachment', lang('File not found.'));
                Uploader::max_size_validator('attachment', 'attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
                Uploader::mime_type_validator('attachment', 'attachment', $this->config->item('upload_allow'), lang('File type not allowed.'));


                if(!$supervision_obj->get_id() || $supervision_obj->get_id()!=0) {
                    $attachment = Uploader::get_file_name('attachment', '/files/Users/' . $user_id . '/supervision/', false);
                    Uploader::move_file_to('attachment', rtrim(FCPATH, '/') . $attachment);
                    $supervision_obj->set_attachment($attachment);
                }


                $supervision_obj->set_user_id($user_id);

                $supervision_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $supervision_obj = Orm_Fp_Supervision::get_instance($id);
        }

        $this->view_params['supervision'] = $supervision_obj;

        $html = $this->load->view('faculty_portfolio/academic/supervision/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function supervision delete by its to buffer and user id
     * @param int id the id of the supervision delete to be viewed
     * @redirect success or error
     */
    public function supervision_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $supervision_obj = Orm_Fp_Supervision::get_instance($id);

        if($supervision_obj->get_id() && $supervision_obj->get_user_id() == $user_id) {
            $supervision_obj->delete();
        }
    }

    /**
     * this function supervision view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the supervision view to be viewed
     * @param int $user_id the user id of the supervision view to be viewed
     * @return mixed the html view
     */
    public function supervision_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }

        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $supervision_page = intval($this->input->post_get('supervision_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['supervisions'] = Orm_Fp_Supervision::get_all(['user_id' => $user_id], $supervision_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/academic/supervision_view', 'page_label' => 'supervision_page'));
        $pager->set_page($supervision_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Supervision::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="supervision_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/academic/supervision/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/academic/supervision/list', $this->view_params);
    }


    /* Supervision functions */

    /**
     *this function academic article manage
     * @redirect success or error
     */
    public function academic_article_manage() {
        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $authors     = $this->input->post('authors');
        $year        = $this->input->post('year');
        $author_type = $this->input->post('author_type');
        $title       = $this->input->post('title');
        $publisher   = $this->input->post('publisher');

        $academic_article_obj = Orm_Fp_Academic_Article::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $academic_article_obj->set_authors($authors);
            $academic_article_obj->set_year($year);
            $academic_article_obj->set_author_type($author_type);
            $academic_article_obj->set_title($title);
            $academic_article_obj->set_publisher($publisher);


            Validator::required_field_validator('authors', $authors, lang('This is a required field'));
            Validator::required_field_validator('title', $title, lang('This is a required field'));

            if(Validator::success() && !($academic_article_obj->get_id() && $academic_article_obj->get_user_id() != $user_id)) {
                $academic_article_obj->set_user_id($user_id);

                $academic_article_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $academic_article_obj = Orm_Fp_Academic_Article::get_instance($id);
        }

        $this->view_params['academic_article'] = $academic_article_obj;

        $html = $this->load->view('faculty_portfolio/academic/academic_article/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function academic article delete by its id
     * @param int $id the id of the academic article delete to be viewed
     * @redirect success or error
     */
    public function academic_article_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $academic_article_obj = Orm_Fp_Academic_Article::get_instance($id);

        if($academic_article_obj->get_id() && $academic_article_obj->get_user_id() == $user_id) {
            $academic_article_obj->delete();
        }
    }

    /**
     * @param bool $to_buffer
     * @param int $user_id
     * @return mixed
     */
    public function academic_article_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }

        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $academic_article_page = intval($this->input->post_get('academic_article_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['academic_articles'] = Orm_Fp_Academic_Article::get_all(['user_id' => $user_id], $academic_article_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/academic/academic_article_view', 'page_label' => 'academic_article_page'));
        $pager->set_page($academic_article_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Academic_Article::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="academic_article_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }

        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/academic/academic_article/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/academic/academic_article/list', $this->view_params);
    }
}
