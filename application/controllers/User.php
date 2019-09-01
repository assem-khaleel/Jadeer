<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class User
 */
class User extends MX_Controller {

    private $view_params = array();

    public function __construct() {
        parent::__construct();

        Orm_User::check_logged_in();

        $this->view_params['menu_tab'] = 'settings';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('User'),
            'icon' => 'fa fa-user'
        ), true);
    }

    /**
     * default controller action
     */
    public function index() {

	    Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-user');

        $per_page = $this->config->item('per_page');
        $class_type = $this->input->get_post('type');
        $page = (int) $this->input->get_post('page');
        $fltr = (array) $this->input->get_post('fltr');

        $filters = is_array($fltr) ? $fltr : array();

        if (!$page) {
            $page = 1;
        }

        $allow = array(
            Orm_User::USER_STUDENT,
            Orm_User::USER_FACULTY,
            Orm_User::USER_STAFF,
        );

        if (!in_array($class_type, $allow)) {
            $filters = array();
            $class_type = Orm_User::USER_STUDENT;
        }

        $del_val = '';
        $filters = array_filter($filters, function($e) use ($del_val) {
            return ($e !== $del_val);
        });

        $filters['skip_active'] = true;
        $items = $class_type::get_all($filters, $page, $per_page);
        //print_r($items);die;

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count($class_type::get_count($filters));

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Settings'), '/settings');
        $this->breadcrumbs->push(lang('Users'), '/user');

        // set view parameters
        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'user';
        $this->view_params['class_type'] = $class_type;
        $this->view_params['items'] = $items;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('User'),
            'icon' => 'fa fa-user',
            'link_attr' => 'href="/user/create_edit?type='.$class_type.'"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('User'),
            'menu_view' => 'user/sub_menu',
            'menu_params' => array('class_type' => $class_type)
        ), true);

        $this->layout->view('user/list', $this->view_params);
    }

    /**
     * create new item action
     */
    public function create_edit() {

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-user');

        $class_type = $this->input->get_post('type');

        $allow = array(
            Orm_User::USER_STUDENT,
            Orm_User::USER_FACULTY,
            Orm_User::USER_STAFF,
        );

	    $id = $this->input->get('id');

        if (!in_array($class_type, $allow)) {
            Validator::set_error_flash_message(lang('Invalid Type'));
            redirect('/user');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Settings'), '/settings');
        $this->breadcrumbs->push(lang('Users'), '/user');
        if($id) {
            $this->breadcrumbs->push(lang('Edit').' '.lang('User'), '/user/edit');
        } else {
            $this->breadcrumbs->push(lang('Create').' '.lang('User'), '/user/create');
        }

        $this->view_params['user'] = $class_type::get_instance($id);
        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'user';

        $this->layout->view('user/create_edit', $this->view_params);
    }

    /**
     * save item action (add/edit actions)
     */
    public function save() {

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-user');

        $class_type = $this->input->get_post('type');

        $allow = array(
            Orm_User::USER_STUDENT,
            Orm_User::USER_FACULTY,
            Orm_User::USER_STAFF,
        );

        if (!in_array($class_type, $allow)) {
            Validator::set_error_flash_message(lang('Invalid Type'));
            redirect('/user');
        }

        // get request parameters
        $id = (int) $this->input->post('id');
        $reset_password = $this->input->post('reset_password');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $login_id = $this->input->post('login_id');
        $is_active = (int) $this->input->post('is_active');
        //user_personal_info
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $gender = $this->input->post('gender');
        $birth_date = $this->input->post('birth_date');
        $nationality = $this->input->post('nationality');
        //user_contact_info
        $phone = $this->input->post('phone');
        $office_no = $this->input->post('office_no');
        $fax_no = $this->input->post('fax_no');
        $address = $this->input->post('address');

        //echo $class_type."<br>";
        //for faculty Orm_User_Faculty::get_instance()
        $user = $class_type::get_instance($id); /* @var $user Orm_User */

        // validation
        Validator::required_field_validator('first_name', $first_name, lang('Invalid Name!'));
        Validator::required_field_validator('last_name', $last_name, lang('Invalid Name!'));
        Validator::required_field_validator('login_id', $login_id, lang('Invalid Login ID'));
//        Validator::numeric_field_validator('login_id', $login_id, lang('Must be Number'));
        Validator::required_field_validator('email', $email, lang('Invalid Email'));
        Validator::email_field_validator('email', $email, lang('Invalid Email'));
        Validator::database_unique_field_validator($user, 'email', 'email', $email, lang('Email Already Exists'), null, null, Orm_User::class);

        if (!($user->get_id() && !$reset_password)) {
            Validator::required_field_validator('password', $password, lang('Please Enter Your Password'));
            Validator::minimum_length_validator('password', $password, 6, lang('Password Must Be Between 6 and 20 Digits'));
            Validator::maximum_length_validator('password', $password, 20, lang('Password Must Be Between 6 and 20 Digits'));
        }

        if (!($user->get_id() && !$reset_password)) {
            $user->set_password(sha1($password));
        }

        $user->set_email($email);
        $user->set_login_id($login_id);
        $user->set_integration_id($login_id);
        $user->set_is_active($is_active);
        $user->set_first_name($first_name);
        $user->set_last_name($last_name);
        $user->set_gender($gender);
        $user->set_birth_date($birth_date);
        $user->set_nationality($nationality);
        $user->set_phone($phone);
        $user->set_office_no($office_no);
        $user->set_fax_no($fax_no);
        $user->set_address($address);

        $user->fill_post_object();

        if (Validator::success()) {
            $user->save();

            Validator::set_success_flash_message(lang('User Successfully Saved'));
            redirect("/user?type={$user->get_class_type()}");
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Settings'), '/settings');
        $this->breadcrumbs->push(lang('Users'), '/user');
        if($id) {
            $this->breadcrumbs->push(lang('Edit').' '.lang('User'), '/user/edit');
        } else {
            $this->breadcrumbs->push(lang('Create').' '.lang('User'), '/user/create');
        }

        $this->view_params['user'] = $user;
        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'user';

        $this->layout->view('user/create_edit', $this->view_params);
    }

    /**
     * delete item action
     */
    public function delete($id) {

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-user');

        $user = Orm_User::get_instance($id);

        if(!is_null($user) && $user->get_id()) {
            $user->delete();
        }

        Validator::set_success_flash_message(lang('User Removed Successfully'));
    }


    /**
     * activate item action
     */
    public function activate($id) {

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-user');

        $user = Orm_User::get_one(array('id'=>$id,'skip_active'=> 0));

        if(!is_null($user) && $user->get_id()) {
            $user->activate();
        }

        Validator::set_success_flash_message(lang('User Activate Successfully'));
    }

    /**
     * inactivate item action
     */
    public function inactivate($id) {

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-user');

        $user = Orm_User::get_instance($id);

        if(!is_null($user) && $user->get_id()) {
            $user->delete();
        }

        Validator::set_success_flash_message(lang('User inactivate Successfully'));
    }



    public function change_password()
    {

        Orm_User::check_logged_in();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $user = Orm_User::get_logged_user();

            $old_password = trim($this->input->post('old_password'));
            $new_password = trim($this->input->post('new_password'));
            $confirm_password = trim($this->input->post('confirm_password'));

            Validator::required_field_validator('old_password', $old_password, lang('Required Password'));
            Validator::compare_value_validator('old_password', $user->get_password(), sha1($old_password), lang('old password is incorrect'));
            Validator::required_field_validator('new_password', $new_password, lang('Required Password'));
            Validator::minimum_length_validator('new_password', $new_password, 6, lang('Password Must Be Between 6 and 20 Digits'));
            Validator::maximum_length_validator('new_password', $new_password, 20, lang('Password Must Be Between 6 and 20 Digits'));
            Validator::required_field_validator('confirm_password', $confirm_password, lang('Required Password'));
            Validator::compare_value_validator('confirm_password', $new_password, $confirm_password, lang('Confirm Password are not Match with Now'));

            if (Validator::success()) {
                $user->set_password(sha1($new_password));
                $user->save();

                Validator::set_success_flash_message(lang('Password Changed Successfully'));
                json_response(array('status' => true));
            }

            json_response(array('status' => false, 'html' => $this->load->view('user/change_password', $this->view_params, true)));
        }

        $this->load->view('user/change_password', $this->view_params);
    }

    public function change_avatar() {

        $user = Orm_User::get_logged_user();

        $this->load->library('Uploader_Image');

        Uploader_Image::common_validator('file_upload', 'file');
        Uploader_Image::zero_size_validator('file_upload', 'file', lang('File not found.'));
        Uploader_Image::max_size_validator('file_upload', 'file', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
        Uploader_Image::mime_type_validator('file_upload', 'file', array( 'image/png', 'image/gif', 'image/jpeg', 'image/xbm'), lang('File type not allowed.'));

        if (Validator::success()) {
            $file = '/files/Users/' . $user->get_id() . '/avatar.' . Uploader_Image::get_file_extension('file');
            $full_path = rtrim(FCPATH, '/') . $file;

            Uploader_Image::move_file_to('file', $full_path);
            Uploader_Image::imgResize($full_path, 160, 160);

            $user->set_avatar($file);
            $user->save();

            json_response(array('status' => true, 'file' => $file . '?v=' . rand(0,1000)));
        }

        json_response(array('status' => false, 'error' => Validator::get_error_message('file_upload')));

    }

    public function login_as_user($id) {

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-login_as');

        $user = Orm_User::get_instance($id);

        if ($user && $user->get_id() && $user->get_id() != Orm_User::get_logged_user_id()) {
            $user->login();

            Validator::set_success_flash_message(lang('Logged Successfully'));
        } else {
            Validator::set_error_flash_message(lang('Invalid User'));
        }

        redirect($this->config->item('root_url'));
    }

    public function find()
    {
        $user_class = $this->input->get_post('user_class');
        $allowed_types = $this->input->get_post('allowed_types');
        $allow_change_types = boolval($this->input->get_post('allow_change_types'));
        $ids = $this->input->get_post('ids');


        if(empty($allowed_types) || !is_array($allowed_types)) {
            $allowed_types = array(
                Orm_User::USER_FACULTY,
                Orm_User::USER_STAFF,
                Orm_User::USER_STUDENT,
                Orm_User::USER_ALUMNI,
                Orm_User::USER_EMPLOYER,
            );
        }

        if(empty($user_class)) {
            $allow_change_types = true;

            $values = array_values($allowed_types);
            $user_class = array_shift($values); ;
        }

        $per_page = 6;
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if (!empty($ids)) {
            $filters['in_id'] = explode(',', $ids);
        }

        $users = array();
        $user_counts = 0;

        if (in_array($user_class, $allowed_types)) {
            $users = $user_class::get_all($filters, $page, $per_page);
            $user_counts = $user_class::get_count($filters);
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI'), 'num_elements' => 5, 'pager_class' => 'pagination m-a-1'));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count($user_counts);

        $this->view_params['users'] = $users;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;

        $this->view_params['user_class'] = $user_class;
        $this->view_params['allowed_types'] = $allowed_types;
        $this->view_params['allow_change_types'] = $allow_change_types;

        $this->layout->set_layout('layout_blank')->view('user/find', $this->view_params);
    }

    public function profile()
    {
        Orm_User::check_logged_in();

        $this->view_params['user'] = Orm_User::get_logged_user();
        $this->view_params['page_class'] = "page-profile";

        $this->breadcrumbs->push(lang('Profile'), '/user/profile');

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->layout->add_javascript('/assets/jadeer/js/add_more.js');
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('User'),
            'icon' => 'fa fa-user',
            'link_attr' => 'href="/user/account_settings"',
            'link_title' => lang('Account Settings'),
            'link_icon' => 'gear'
        ), true);
        $this->view_params['page_header'] = '';

        $this->layout->view('user/profile', $this->view_params);
    }

    public function account_settings()
    {
        Orm_User::check_logged_in();

        $this->breadcrumbs->push(lang('Profile'), '/user/profile');
        $this->breadcrumbs->push(lang('Account Settings'), '/user/account_settings');

        $this->view_params['user'] = Orm_User::get_logged_user();
        $this->view_params['page_class'] = "page-profile";

        $this->layout->view('user/account_settings', $this->view_params);
    }

    public function save_notification_settings()
    {

        Orm_User::check_logged_in();

        $notifications = $this->input->post('notifications');

        foreach (Orm_Notification_Template::get_all() as $template) {
            $allow_email = (int)(isset($notifications[$template->get_name()]['allow_email']) ? $notifications[$template->get_name()]['allow_email'] : 0);
            $allow_sms = (int)(isset($notifications[$template->get_name()]['allow_sms']) ? $notifications[$template->get_name()]['allow_sms'] : 0);

            $user_notification = $template->get_user_notification_settings();
            $user_notification->set_user_id(Orm_User::get_logged_user()->get_id());
            $user_notification->set_notification_name($template->get_name());
            $user_notification->set_allow_email($allow_email);
            $user_notification->set_allow_sms($allow_sms);
            $user_notification->save();

        }

        Validator::set_success_flash_message(lang('Notification settings saved successfully'));
        redirect('/user/account_settings');
    }

    public function save_theme_settings() {

        Orm_User::check_logged_in();

        $fixed_navbar = boolval($this->input->post('fixed_navbar'));
        $fixed_main_menu = boolval($this->input->post('fixed_main_menu'));
        $flip_main_menu = boolval($this->input->post('flip_main_menu'));
        $theme = $this->input->post('theme');

        if(!in_array($theme, $this->layout->get_themes())) {
            $theme = $this->layout->get_default_theme();
        }

        if($fixed_main_menu && !$fixed_navbar) {
            $fixed_navbar = true;
        }

        $user = Orm_User::get_logged_user();
        $user->set_theme_fixed_navbar($fixed_navbar);
        $user->set_theme_fixed_menu($fixed_main_menu);
        $user->set_theme_flip_menu($flip_main_menu);
        $user->set_theme($theme);
        $user->save();

        Validator::set_success_flash_message(lang('Theme Settings Saved Successfully'));
        redirect('/user/account_settings');
    }

    public function about_me()
    {

        Orm_User::check_logged_in();
        $user = Orm_User::get_logged_user();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $about_me= trim($this->input->post('about_me'));

            Validator::strip_tags_validator('about_me', $about_me, lang('Wrong Text Entered'));

            if (Validator::success()) {
                $user->set_about_me($about_me);
                $user->save();

                Validator::set_success_flash_message(lang('About Me Changed Successfully'));
                json_response(array('status' => true));
            }

            json_response(array('status' => false, 'html' => $this->load->view('user/about_me', $this->view_params, true)));
        }

        $this->view_params['user'] = $user;
        $this->load->view('user/about_me', $this->view_params);
    }

	public function get($id = 0) {
		$user = Orm_User::get_instance((int)$id);

		if (!is_null($user) && $user->get_id()) {
			json_response(array(
				'data' => array(
					'name' => $user->get_full_name(),
					'email' => $user->get_email(),
					'phone' => $user->get_phone()
				),
				'success' => true
			));
		}
		else {
			json_response(array('success' => false));
		}
	}

    public function find_select() {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $txt = $this->input->post_get('txt');

        $users = [];

        foreach(Orm_User::get_all(['keyword'=>$txt], 1, 10, ['first_name', 'last_name']) as $user) {
            $users[] = [
                'id'   => $user->get_id(),
                'name' => $user->get_full_name(),
                'type' => lang($user->get_type_name())
            ];
        }

        json_response(array(
            'data' => $users,
            'success' => true
        ));
    }

}