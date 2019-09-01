<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/17/16
 * Time: 11:13 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Academic
 */
class Work extends MX_Controller
{

    private $view_params = array();

    /**
     * Work constructor.
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
            $this->view_params['active'] = "work";

            $this->view_params['teaching'] = $this->teaching_load_view(true,$user_id);
            $this->view_params['advisings'] = $this->advising_view(true, $user_id);
            $this->view_params['creative_works'] = $this->creative_work_view(true, $user_id);

        if ($this->input->is_ajax_request()) {
            $this->load->view("faculty_portfolio/work/list", $this->view_params);
        } else {
            $this->layout->view("faculty_portfolio/work/list", $this->view_params);
        }

    }



    /* Teaching Work Load functions */

    /**
     * this function teaching load view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the teaching load view to be viewed
     * @param int $user_id the user id of the teaching load view to be viewed
     * @return mixed the html view
     */
    public function teaching_load_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }
        
        if(!$user_id) {
                $user_id = Orm_User::get_logged_user_id();
            }

        $teaching_load_page = intval($this->input->post_get('teaching_load_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');


        $this->view_params['teaching_loads'] = Orm_Course_Section::get_all(['teacher_id' => $user_id], $teaching_load_page, $per_page);

        $this->view_params['pager'] = '';
        $pager = new Pager(array('url' => '/faculty_portfolio/work/teaching_load_view/0/'.$user_id, 'page_label' => 'teaching_load_page'));
        $pager->set_page($teaching_load_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course_Section::get_count(['teacher_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="teaching_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }


        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/work/teaching_load/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/work/teaching_load/list', $this->view_params);
    }


    /* Advising functions */

    /**
     *this function advising manage
     * @redirect success or error
     */
    public function advising_manage() {
        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $semester_id = $this->input->post('semester_id');
        $level = $this->input->post('level');
        $number_of_students = $this->input->post('number_of_students');
        $number_of_sections = $this->input->post('number_of_sections');
        $subject_taught = $this->input->post('subject_taught');

        $advising_obj = Orm_Fp_Advising::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $advising_obj->set_semester_id($semester_id);
            $advising_obj->set_level($level);
            $advising_obj->set_number_of_students($number_of_students);
            $advising_obj->set_number_of_sections($number_of_sections);
            $advising_obj->set_subject_taught($subject_taught);


            if(!($advising_obj->get_id() && $advising_obj->get_user_id() != $user_id)) {
                $advising_obj->set_user_id($user_id);
            }

            Validator::integer_field_validator('semester_id', $semester_id, lang('This is a required field'));
            Validator::integer_field_validator('level', $level, lang('This is a required field'));
            Validator::integer_field_validator('number_of_students', $number_of_students, lang('This is a required field'));
            Validator::integer_field_validator('number_of_sections', $number_of_sections, lang('This is a required field'));
            Validator::required_field_validator('subject_taught', $subject_taught, lang('This is a required field'));

            if(Validator::success()){
                $advising_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $advising_obj = Orm_Fp_Advising::get_instance($id);
        }

        $this->view_params['advising'] = $advising_obj;

        $html = $this->load->view('faculty_portfolio/work/advising/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function advising delete by its id
     * @param int $id the id of the advising delete to be viewed
     * @redirect success or error
     */
    public function advising_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $advising_obj = Orm_Fp_Advising::get_instance($id);

        if($advising_obj->get_id() && $advising_obj->get_user_id() == $user_id) {
            $advising_obj->delete();
        }
    }

    /**
     * this function advising view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the advising view to be viewed
     * @param int $user_id the user id of the advising view to be viewed
     * @return mixed the html view
     */
    public function advising_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }

        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $advising_page = intval($this->input->post_get('advising_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['advisings'] = Orm_Fp_Advising::get_all(['user_id' => $user_id], $advising_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/work/advising_view', 'page_label' => 'advising_page'));
        $pager->set_page($advising_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Advising::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="advising_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }


        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/work/advising/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/work/advising/list', $this->view_params);
    }


    
    /* Creative Work functions */

    /**
     *this function legend
     * @redirect success or error
     */
    public function creative_work_manage() {
        $user_id = Orm_User::get_logged_user_id();

        $id = $this->input->post_get('id');

        $creative_work_obj = Orm_Fp_Creative_Work::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $name               = $this->input->post('name');
            $owner_name         = $this->input->post('owner_name');
            $dissemination_type = $this->input->post('dissemination_type');
            $funds_type         = $this->input->post('funds_type');
            $funds              = $this->input->post('funds');
            $description        = $this->input->post('description');

            $creative_work_obj->set_name($name);
            $creative_work_obj->set_owner_name($owner_name);
            $creative_work_obj->set_dissemination_type($dissemination_type);
            $creative_work_obj->set_funds_type($funds_type);
            $creative_work_obj->set_funds($funds);
            $creative_work_obj->set_description($description);


            Validator::required_field_validator('name', $name, lang('This is a required field'));
            Validator::required_field_validator('owner_name', $owner_name, lang('This is a required field'));
            Validator::integer_field_validator('dissemination_type', $dissemination_type, lang('This is a required field'));


            if(Validator::success() && !($creative_work_obj->get_id() && $creative_work_obj->get_user_id() != $user_id)){
                Uploader::common_validator('attachment', 'attachment');
                Uploader::zero_size_validator('attachment', 'attachment', lang('File not found.'));
                Uploader::max_size_validator('attachment', 'attachment', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
                Uploader::mime_type_validator('attachment', 'attachment', $this->config->item('upload_allow'), lang('File type not allowed.'));

                if(!$creative_work_obj->get_id() || $creative_work_obj->get_id()!=0) {
                    $attachment = Uploader::get_file_name('attachment', '/files/Users/' . $user_id . '/creative_work/', false);
                    Uploader::move_file_to('attachment', rtrim(FCPATH, '/') . $attachment);
                    $creative_work_obj->set_attachment($attachment);
                }
                
                $creative_work_obj->set_user_id($user_id);

                $creative_work_obj->save();
                json_response(array('status' => true));
            }
        }
        else {
            $creative_work_obj = Orm_Fp_Creative_Work::get_instance($id);
        }

        $this->view_params['creative_work'] = $creative_work_obj;

        $html = $this->load->view('faculty_portfolio/work/creative_work/manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function creative work delete by its id
     * @param int $id the id of the creative work delete to be viewed
     * @redirect success or error
     */
    public function creative_work_delete($id=0) {
        $user_id = Orm_User::get_logged_user_id();

        $creative_work_obj = Orm_Fp_Creative_Work::get_instance($id);

        if($creative_work_obj->get_id() && $creative_work_obj->get_user_id() == $user_id) {
            $creative_work_obj->delete();
        }
    }

    /**
     * this function creative work view by its to buffer and user id
     * @param bool $to_buffer the to buffer of the creative work view to be viewed
     * @param int $user_id the user id of the creative work view to be viewed
     * @return mixed the html view
     */
    public function creative_work_view($to_buffer=false, $user_id=0) {

        if(!Orm_User::get_logged_user_id()){
            show_404();
        }

        if(!$user_id){
            $user_id = Orm_User::get_logged_user_id();
        }

        $creative_work_page = intval($this->input->post_get('creative_work_page')) ? : 1;
        $per_page = $this->config->item('dashboard_per_page');

        $this->view_params['creative_works'] = Orm_Fp_Creative_Work::get_all(['user_id' => $user_id], $creative_work_page, $per_page);


        $this->view_params['pager'] = '';
        $this->view_params['user_id'] = $user_id;
        $pager = new Pager(array('url' => '/faculty_portfolio/work/creative_work_view', 'page_label' => 'creative_work_page'));
        $pager->set_page($creative_work_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Creative_Work::get_count(['user_id' => $user_id]));
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="creative_work_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            $this->view_params['pager'] = '<div class="table-footer">' . $pager->render(true) . '</div>';
        }


        if ($to_buffer) {
            return $this->load->view('faculty_portfolio/work/creative_work/list', $this->view_params, true);
        }

        $this->load->view('faculty_portfolio/work/creative_work/list', $this->view_params);
    }
}