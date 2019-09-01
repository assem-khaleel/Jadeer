<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * Class Status_Settings
 */
class Status_Settings extends MX_Controller
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
        if (!License::get_instance()->check_module('accreditation', true)) {
            show_404();
        }

        Orm_User::check_permission(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'settings-accreditation_status');

        $this->view_params['menu_tab'] = 'settings';
        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'agencies';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Accreditation Status Settings'),
            'icon' => 'sitemap'
        ), true);
    }

    public function agencies()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Agency'),
            'icon' => 'certificate',
            'link_attr' => 'href="/accreditation/status_settings/agency_create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Agency')
        ), true);


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

        $agencies = Orm_As_Agency::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_As_Agency::get_count($filters));

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Agencies'), '/accreditation/status_settings/agencies');

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['agencies'] = $agencies;
        $this->view_params['fltr'] = $fltr;

        $this->layout->view('status/settings/agency/list', $this->view_params);
    }

    public function agency_create()
    {
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Agencies'), '/accreditation/status_settings/agencies');
        $this->breadcrumbs->push(lang('Add').' '.lang('Agency'), '/accreditation/status_settings/agency_create');

        $this->view_params['agency'] = new Orm_As_Agency();
        $this->layout->view('status/settings/agency/create_edit', $this->view_params);
    }

    public function agency_save()
    {
        // post data
        $id = (int)$this->input->post('id');
        $name_ar = $this->input->post('name_ar');
        $name_en = $this->input->post('name_en');
        $accredited_years = $this->input->post('accredited_years');
        $before = $this->input->post('before');
        $kind = $this->input->post('kind');

        //get instances object
        $obj = Orm_As_Agency::get_instance($id);
        $obj->set_name_ar($name_ar);
        $obj->set_name_en($name_en);
        $obj->set_accredited_years($accredited_years);
        $obj->set_notify_before((int)$before .' '. $kind);

        //validation errors
        Validator::required_field_validator('name_ar', $name_ar, lang('Please Enter Agency Name').' '.lang('Arabic'));
        Validator::required_field_validator('name_en', $name_en, lang('Please Enter Agency Name').' '.lang('English'));
        Validator::required_field_validator('accredited_years', $accredited_years, lang('Please Enter Accredited Years'));
        Validator::required_field_validator('before', $before, lang('Please Enter Notification Before'));
        Validator::required_field_validator('kind', $kind, lang('Please Enter Kind'));
        Validator::database_unique_field_validator($obj, 'name_ar', 'name_ar', $name_ar, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'name_en', 'name_en', $name_en, lang('Unique Field'));

        if (!in_array($kind, array('months', 'years'))) {
            Validator::set_error('kind', lang('Please Enter Valid Kind'));
        }

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/accreditation/status_settings/agencies');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Agencies'), '/accreditation/status_settings/agencies');
        $this->breadcrumbs->push(lang('Add').' '.lang('Agency'), '/accreditation/status_settings/agency_create');

        // parameter
        $this->view_params['agency'] = $obj;
        $this->layout->view('status/settings/agency/create_edit', $this->view_params);
    }

    public function agency_edit($id)
    {
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Agencies'), '/accreditation/status_settings/agencies');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Agency'), '/accreditation/status_settings/agency_edit/' . $id);

        $this->view_params['agency'] = Orm_As_Agency::get_instance($id);
        $this->layout->view('status/settings/agency/create_edit', $this->view_params);
    }

    public function agency_delete($id)
    {
        $obj = Orm_As_Agency::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/accreditation/status_settings/agencies');
    }

    public function mapping($agency_id)
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Agency Mapping'),
            'icon' => 'sitemap',
            'link_attr' => 'href="/accreditation/status_settings/mapping_manage/'.$agency_id.'"',
            'link_icon' => 'plus',
            'link_title' => lang('Manage').' '.lang('Mapping')
        ), true);

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
        $filters['agency_id'] = $agency_id;

        $mappings = Orm_As_Agency_Mapping::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_As_Agency_Mapping::get_count($filters));

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Agencies'), '/accreditation/status_settings/agencies');
        $this->breadcrumbs->push(lang('Mapping'), '/accreditation/status_settings/mapping/'.$agency_id);

        $this->view_params['agency_id'] = $agency_id;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['mappings'] = $mappings;
        $this->view_params['fltr'] = $fltr;

        $this->layout->view('status/settings/mapping/list', $this->view_params);
    }

    public function mapping_manage($agency_id)
    {
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Agencies'), '/accreditation/status_settings/agencies');
        $this->breadcrumbs->push(lang('Mapping'), '/accreditation/status_settings/mapping/'.$agency_id);
        $this->breadcrumbs->push(lang('Manage'), '/accreditation/agency_mapping/mapping_manage/'.$agency_id);

        $this->view_params['agency_id'] = $agency_id;
        $this->view_params['colleges'] = Orm_As_Agency_Mapping::get_colleges($agency_id);
        $this->layout->view('status/settings/mapping/create_edit', $this->view_params);
    }

    public function mapping_save($agency_id)
    {
        // post data
        $colleges = $this->input->post('colleges');
        $old_colleges = Orm_As_Agency_Mapping::get_colleges($agency_id);

	    $colleges = isset($colleges) && is_array($colleges) ? $colleges : array();

        if (Validator::success()) {
            foreach($colleges as $college_id) {
                $mapping = Orm_As_Agency_Mapping::get_one(array('agency_id' => $agency_id, 'college_id' => $college_id));
                $mapping->set_agency_id($agency_id);
                $mapping->set_college_id($college_id);
                $mapping->save();
            }

	        foreach(array_diff($old_colleges, $colleges) as $college_id) {
		        $mapping = Orm_As_Agency_Mapping::get_one(array('agency_id' => $agency_id, 'college_id' => $college_id));
		        $mapping->delete();
	        }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/accreditation/status_settings/mapping/'.$agency_id);
        }

        $this->layout->view('status/settings/agency_mapping/create_edit', $this->view_params);
    }
}