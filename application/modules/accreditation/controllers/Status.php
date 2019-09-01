<?php
/**
 * Created by PhpStorm.
 * User: basel
 * Date: 20/12/15
 * Time: 11:12 am
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $status_obj
 * Class Status
 */
class Status extends MX_Controller
{
	/**
	 * View Params
	 * @var array
	 */
	private $view_params = array();
	private $logged_user = null;

	public function __construct()
	{
		parent::__construct();

		Orm_User::check_logged_in();
		if (!License::get_instance()->check_module('accreditation', true)) {
			show_404();
		}

		$this->logged_user = Orm_User::get_logged_user();
		$this->view_params['menu_tab'] = 'status';

	}

	public function index()
	{
		if (Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
			$this->layout->add_javascript('https://www.google.com/jsapi', false);
			$this->load->view('status/dashboard', $this->view_params);
		} elseif (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
			$this->program_agencies();
		} else {
			Validator::set_error_flash_message(lang('No Permission'));
			redirect('/dashboard');
		}
	}

	public function chart_agency() {
		$agency_id = $this->input->get_post('agency_id');
		$college_id = $this->input->get_post('college_id');

		$filters = array();
		if($college_id) {
			$filters['college_id'] = $college_id;
		}

		$lang_status = lang('Status');
		$lang_count = lang('Count');
		$lang_id = lang('Id');

		$data_table = array("['{$lang_status}', '{$lang_count}', '{$lang_id}']");
		foreach(Orm_As_Status::$types as $status => $type) {
			$count = Orm_As_Status::get_count(array_merge($filters, array('chart' => true, 'agency' => $agency_id, 'status' => $status)));
			$lang_name = lang($type['name']);

			$data_table[$status] = "['{$lang_name}', {$count}, {$status}]";
		}

		$this->view_params['data_table'] = $data_table;
		$this->view_params['agency_id'] = $agency_id;
		$this->view_params['college_id'] = $college_id;
		$this->load->view('status/chart_agency', $this->view_params);
	}

	public function chart_status() {
		$agency_id = $this->input->get_post('agency_id');
		$college_id = $this->input->get_post('college_id');
		$status = $this->input->get_post('status');

		$this->view_params['status'] = $status;
		$this->view_params['agency_id'] = $agency_id;
		$this->view_params['college_id'] = $college_id;
		$this->load->view('status/chart_status', $this->view_params);
	}

	public function program_agencies() {

		$this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');

		if (!Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
			Validator::set_error_flash_message(lang('No Permission'));
			redirect('/dashboard');
		}

		$per_page = $this->config->item('per_page');
		$page = (int)$this->input->get_post('page');
		$fltr = $this->input->get_post('fltr');

		if (!$page) {
			$page = 1;
		}

		$filters = array();
		$filters['program_id'] = $this->logged_user->get_program_id();

		$program_agencies = Orm_As_Status::get_all($filters, $page, $per_page);

		$pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
		$pager->set_page($page);
		$pager->set_per_page($per_page);
		$pager->set_total_count(Orm_As_Status::get_count($filters));

		$this->view_params['pager'] = $pager->render(true);
		$this->view_params['program_agencies'] = $program_agencies;
		$this->view_params['fltr'] = $fltr;

		$this->load->view('status/program_agencies', $this->view_params);
	}

	public function agency_add_edit($id = 0)
	{
		$this->view_params['status_obj'] = Orm_As_Status::get_instance($id);
		$this->load->view('status/agency_add_edit', $this->view_params);
	}

	public function agency_save() {

		$this->load->library('Uploader');

		$id = (int)$this->input->post('id');
		$status_obj = Orm_As_Status::get_instance($id);

		$status = (int)$this->input->post('status');
		$agency = (int)$this->input->post('agency');
		$status_date = $this->input->post('status_date');
		$note = $this->input->post('note');
		$accredited = (int)$this->input->post('accredited');

		$chair_id = (int)$this->input->post('chair_id');
		$chair_name = $this->input->post('chair_name');
		$chair_email = $this->input->post('chair_email');
		$chair_phone = $this->input->post('chair_phone');

		$dean_id = (int)$this->input->post('dean_id');
		$dean_name = $this->input->post('dean_name');
		$dean_email = $this->input->post('dean_email');
		$dean_phone = $this->input->post('dean_phone');

		// validation
		Validator::not_empty_field_validator('dean_name', $dean_id, lang('Please select Dean'));
		Validator::not_empty_field_validator('chair_name', $chair_id, lang('Please select Program chair'));

		if (isset($_FILES['file']['size']) && $_FILES['file']['size']) {
			Uploader::common_validator('file_upload', 'file');
			Uploader::zero_size_validator('file_upload', 'file', lang('File not found.'));
			Uploader::max_size_validator('file_upload', 'file', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
			Uploader::mime_type_validator('file_upload', 'file', $this->config->item('upload_allow'), lang('File type not allowed.'));
		}

		if(!$status_obj->get_id()) {
			Validator::not_empty_field_validator('agency', $agency, lang('Please select Agency'));
			$status_obj->set_agency($agency);
		}

		if (Orm_As_Status::get_one(array('not_id' => $status_obj->get_id(), 'agency' => $status_obj->get_agency(), 'program_id' => $this->logged_user->get_program_id()))->get_id()) {
			Validator::set_error('agency', lang('agency already exist'));
		}

		Validator::not_empty_field_validator('status', $status, lang('Please select Status'));
		if (!in_array($status, array_keys(Orm_As_Status::$types))) {
			Validator::set_error('status', lang('Please choice available status'));
		}

		if(in_array($status , array(Orm_As_Status::ACC_SUBMITTED, Orm_As_Status::ACC_VISITED, Orm_As_Status::ACC_ACCREDITED))){
			Validator::required_field_validator('status_date', $status_date, lang('Please select date'));
			$status_obj->set_status_date($status_date);
		}
		if(in_array($status , array(Orm_As_Status::ACC_ACCREDITED, Orm_As_Status::ACC_NOT_ACCREDITED))) {
			$status_obj->set_accredited($accredited);
		}

		$status_obj->set_status($status);
		$status_obj->set_note($note);

		$status_obj->set_dean($dean_id);
		$status_obj->set_dean_email($dean_email);
		$status_obj->set_dean_name($dean_name);
		$status_obj->set_dean_phone($dean_phone);

		$status_obj->set_program_chair($chair_id);
		$status_obj->set_chair_email($chair_email);
		$status_obj->set_chair_name($chair_name);
		$status_obj->set_chair_phone($chair_phone);

		if (Validator::success()) {

			$status_obj->set_program_id($this->logged_user->get_program_id());
			$status_obj->set_quality_coordinator($this->logged_user->get_id());
			$status_obj->set_year(Orm_Semester::get_active_semester()->get_year());

			$status_obj->save();

			if (isset($_FILES['file']['size']) && $_FILES['file']['size']) {
				$file = Uploader::get_file_name('file', '/files/Generals/Accreditation Status', true);
				Uploader::move_file_to('file', rtrim(FCPATH, '/') . $file);

				$status_obj->set_attachment($file);
				$status_obj->save();
			}

			Validator::set_success_flash_message(lang('Accreditation Status Successfully Saved'));
			json_response(array('status' => true));
		}

		$this->view_params['status_obj'] = $status_obj;
		json_response(array('status' => false, 'html' => $this->load->view('status/agency_add_edit', $this->view_params, true)));
	}

	public function agency_delete($id)
	{
		$status_obj = Orm_As_Status::get_instance($id);

		if ($status_obj->get_id() && $status_obj->get_program_id() == $this->logged_user->get_program_id()) {
			$status_obj->delete();
		}

		Validator::set_success_flash_message(lang('Accreditation Agency removed successfully'));
		redirect('/dashboard/status/program_agencies');
	}

	public function agency_download($id) {

		$this->load->helper('download');

		$status_obj = Orm_As_Status::get_instance($id);
		if ($status_obj->get_id() && $status_obj->get_attachment()) {
			$path =  rtrim(FCPATH, '/') . $status_obj->get_attachment();
			force_download(basename($status_obj->get_attachment()), file_get_contents($path));
		} else {
			Validator::set_error_flash_message(lang('Accreditation Status Not Attached!'));
			redirect($this->input->server('HTTP_REFERER'));
		}
	}

	public function agency_preview($id, $program_id = 0, $agency_id = 0)
	{

		$status_obj = Orm_As_Status::get_instance($id);

		if (!$status_obj->get_id()) {
			if ($program_id && $agency_id) {
				$status_obj->set_program_id($program_id);
				$status_obj->set_agency($agency_id);
			} else {
				Validator::set_error_flash_message(lang('Accreditation Status Not Found!'));
				exit('<script>window.location.reload();</script>');
			}
		}

		$this->view_params['status_obj'] = $status_obj;
		$this->load->view('status/preview', $this->view_params);
	}

}