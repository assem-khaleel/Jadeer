<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * Class Settings
 */
class Settings extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-manage');

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['menu_tab'] = 'settings';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Settings'),
            'icon' => 'fa fa-gear'
        ), true);
        $this->breadcrumbs->push(lang('Settings'), '/settings');

    }

    public function index()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Settings'),
            'icon' => 'fa fa-gear'
        ), true);

        $this->view_params['institution'] = Orm_Institution::get_instance();

        $this->view_params['sub_tab'] = 'License Info';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->layout->view('settings/index', $this->view_params);
    }

    public function jobs()
    {

        $this->view_params['sub_tab'] = 'scripts';

        $this->breadcrumbs->push(lang('Settings'), '/settings');
        $this->breadcrumbs->push(lang('Backup'), '/settings/Jobs');

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $job = $this->input->post('job');
            $job_key = intval($this->input->post('job_key'));
            $schedule = $this->input->post('schedule');
            $params = (array)$this->input->post('params');

            $cron_job = Orm_Cron_Job::get_job_by_key($job_key);

            if ($cron_job) {

                if(is_array($cron_job['params'])) {
                    foreach ($cron_job['params'] as $key_params => $param) {
                        if(isset($params[$key_params])) {
                            $job .= " {$params[$key_params]}";
                        }
                    }
                }

                $cron = Orm_Cron_Job::get_one(['job' => $job, 'schedule' => $schedule, 'is_released' => 0]);
                $cron->set_user_added(Orm_User::get_logged_user_id());
                $cron->set_job_key($job_key);
                $cron->set_job($job);
                $cron->set_schedule($schedule);
                $cron->save();
            }

            redirect('settings/jobs');

        } else {
            $this->layout->view('settings/jobs', $this->view_params);
        }
    }

    public function job_delete($id) {
        $cron = Orm_Cron_Job::get_instance($id);

        if($cron->get_id()) {
            $cron->delete();
        }

        redirect('settings/jobs');
    }

    public function institution()
    {

        $obj = Orm_Institution::get_instance();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('Uploader');

            $institution_name_ar = $this->input->post('name_ar');
            $institution_name_en = $this->input->post('name_en');
            $vision_ar = $this->input->post('vision_ar');
            $vision_en = $this->input->post('vision_en');
            $mission_ar = $this->input->post('mission_ar');
            $mission_en = $this->input->post('mission_en');

            Uploader_Image::validator('univ_logo_en', false);
            Uploader_Image::validator('univ_logo_ar', false);
            Uploader_Image::validator('cs_cover', false);
            Uploader_Image::validator('cr_cover', false);
            Uploader_Image::validator('fes_cover', false);
            Uploader_Image::validator('fer_cover', false);
            Uploader_Image::validator('ps_cover', false);
            Uploader_Image::validator('pr_cover', false);
            Uploader_Image::validator('ssr_cover', false);
            Uploader_Image::validator('sesr_cover', false);

            Validator::required_field_validator('name_ar', $institution_name_ar, lang('Please Enter Institution Name'));
            Validator::required_field_validator('name_en', $institution_name_en, lang('Please Enter Institution Name'));

            $obj->set_name_ar($institution_name_ar);
            $obj->set_name_en($institution_name_en);
            $obj->set_vision_en($vision_en);
            $obj->set_vision_ar($vision_ar);
            $obj->set_mission_en($mission_en);
            $obj->set_mission_ar($mission_ar);

            Validator::required_field_validator('name_ar', $institution_name_ar, lang('Please Enter Institution Name'));
            Validator::required_field_validator('name_en', $institution_name_en, lang('Please Enter Institution Name'));
            Validator::database_unique_field_validator($obj, 'name_ar', 'name_ar', $institution_name_ar, lang('Unique Field'));
            Validator::database_unique_field_validator($obj, 'name_en', 'name_en', $institution_name_en, lang('Unique Field'));

            if (Validator::success()) {

                $file = Uploader_Image::do_process('univ_logo_en','/files/Users/univ_logo_en');
                if($file) {
                    $obj->set_univ_logo_en($file);
                }

                $file = Uploader_Image::do_process('univ_logo_ar','/files/Users/univ_logo_ar');
                if($file) {
                    $obj->set_univ_logo_ar($file);
                }

                $file = Uploader_Image::do_process('cs_cover','/files/Users/cs_cover');
                if($file) {
                    $obj->set_cs_cover($file);
                }

                $file = Uploader_Image::do_process('cr_cover','/files/Users/cr_cover');
                if($file) {
                    $obj->set_cr_cover($file);
                }

                $file = Uploader_Image::do_process('fes_cover','/files/Users/fes_cover');
                if($file) {
                    $obj->set_fes_cover($file);
                }

                $file = Uploader_Image::do_process('fer_cover','/files/Users/fer_cover');
                if($file) {
                    $obj->set_fer_cover($file);
                }

                $file = Uploader_Image::do_process('ps_cover','/files/Users/ps_cover');
                if($file) {
                    $obj->set_ps_cover($file);
                }

                $file = Uploader_Image::do_process('pr_cover','/files/Users/pr_cover');
                if($file) {
                    $obj->set_pr_cover($file);
                }

                $file = Uploader_Image::do_process('ssr_cover','/files/Users/ssr_cover');
                if($file) {
                    $obj->set_ssr_cover($file);
                }

                $file = Uploader_Image::do_process('sesr_cover','/files/Users/sesr_cover');
                if($file) {
                    $obj->set_sesr_cover($file);
                }

                $obj->save();
                Validator::set_success_flash_message(lang('Successfully Saved'));
                redirect('/settings/institution/');
            }
        }

        $this->view_params['sub_tab'] = 'institution';
        $this->view_params['institution'] = $obj;
        $this->breadcrumbs->push(lang('Institutions'), '/institution');
        $this->layout->view('settings/institution', $this->view_params);
    }
}
