<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Security $security
 * @property Layout $layout
 * @property CI_Config $config
 * Class Welcome
 */
class Welcome extends MX_Controller {

	/**
	 * View Params
	 * @var array
	 */
	private $view_params = array();

	public function index()
	{
		//landing
		if($this->config->item('landing_page')) {
			$page = $this->input->get('page');

			$view = $this->config->item('landing_page');

			if ($page) {
				$view = preg_replace('@[/\\\\][^/\\\\]+$@','/'.$page,$this->config->item('landing_page'));

				if (!file_exists(VIEWPATH.'common'.$view.'.php')) {
					$view = $this->config->item('landing_page');
				}
			}

			$this->view_params['assets'] = $this->config->item('landing_assets');
			$this->load->view('common/'.$view, $this->view_params);
		} else {
			$this->system();
		}
	}

	public function system()
	{
		if(Orm_User::is_logged_in()) {

            Validator::keep_flash_message();
            redirect('/dashboard');
		} else {
			$this->login();
		}
	}

	/**
	 * login
	 */
	public function login()
	{

		Authentication::before_login();

		$email = trim(strtolower($this->input->post('email')));
		$password = trim($this->input->post('password'));

		if (Orm_User::is_logged_in()) {
			redirect($this->config->item('root_url'));
		}

		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			Validator::required_field_validator('login_error', $email, lang('Required Email'));
			Validator::required_field_validator('login_error', $password, lang('Required Password'));

			Authentication::after_login();

			Validator::email_field_validator('login_error', $email, lang('Invalid Email'));

			if (Validator::success()) {

				$user = Orm_User::get_by_email($email);

				if (!is_null($user) && $user->get_id()) {
					if ($user->get_password() != sha1($password)) {
						Validator::set_error('login_error', lang('Invalid Email or Password'));
					}
				} else {
					Validator::set_error('login_error', lang('Invalid Email or Password'));
				}
			}

			if (Validator::success()) {

				$user->login();

				$go_to = $this->session->userdata('go_to');
				$this->session->unset_userdata('go_to');

				$url = ($go_to ? $go_to : $this->config->item('root_url'));
				redirect($url);
			}
		}

		$this->view_params['email'] = $email;

		if ($this->input->is_ajax_request()) {
			$this->view_params['is_ajax'] = true;
			$this->load->view('common/login_form', $this->view_params);
		} else {
			$this->layout->view('common/sign_in', $this->view_params);
		}

	}

	/**
	 * logout
	 */
	public function logout()
	{
		$user = Orm_User::get_logged_user();

        if (!is_null($user) && $user->get_id()) {
			$user->logout();

			Authentication::logout();
		}

		redirect($this->config->item('root_url'));
	}

	public function forgot_password()
	{

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

		$forget_email = $this->input->post('forget_email');
		$user = Orm_User::get_by_email($forget_email);

		if (!($forget_email && !is_null($user) && $user->get_id())) {
			Validator::set_error('forget_email', lang('Error: Invalid Email'));
		}

		if(Validator::success() && $user->get_id()) {

			$token = md5(uniqid($user->get_id()));

			$user->set_token($token);
			$user->save();

			Orm_Notification::send_notification(
				0,
				$user->get_id(),
				Orm_Notification_Template::FORGET_PASSWORD,
				Orm_Notification::TYPE_COMMON,
				array(
					'%link%',
				),
				array(
					'<a href="' . base_url("/welcome/reset_password/{$token}") . '">' . base_url("/welcome/reset_password/{$token}") . '</a>',
				)
			);

			Validator::set_success_flash_message(lang('Check Your Email'));
			json_response(array('status' => true));

		}

		$view_params = array();
		$view_params['forget_email'] = $forget_email;
		json_response(array('status' => false, 'html' => $this->load->view('common/forget_password_form', $view_params ,true)));
	}

	public function reset_password($token) {

		$user =  Orm_User::get_one(array('token' => $token));

		if (!($token && !is_null($user) && $user->get_id())) {
			Validator::set_error_flash_message(lang('Error: Invalid Token'));
			redirect($this->config->item('root_url'));
		}

		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$new_password = $this->input->post('new_password');
			$confirm = $this->input->post('new_password_confirm');

			Validator::required_field_validator('new_password', $new_password, lang('Please Enter Your Password'));
			Validator::minimum_length_validator('new_password', $new_password, 6, lang('Password Must Be Between 6 and 20 Digits'));
			Validator::maximum_length_validator('new_password', $new_password, 20, lang('Password Must Be Between 6 and 20 Digits'));

			Validator::compare_value_validator('new_password_confirm',$new_password, $confirm, lang('Passwords not Matched'));

			if(Validator::success()) {
				$user->set_password(sha1($new_password));
				$user->set_token('');
				$user->save();

				Validator::set_success_flash_message(lang('Password has been Successfully Changed'));
				redirect($this->config->item('root_url'));
			}
		}

		$this->view_params['token'] = $token;

		$this->layout->view('common/reset_password', $this->view_params);
	}

	public function refresh_token() {
	    Orm_User::check_logged_in();
	    echo $this->security->get_csrf_hash();
    }
}
