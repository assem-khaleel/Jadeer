<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of alumni_center
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author ahmadgx
 */
class Alumni_center extends MX_Controller {

    private $view_params = array();

    public function __construct() {
        parent::__construct();

        if(!License::get_instance()->check_module('alumni_center', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $class_type = $this->input->get_post('type');

        $allow = array(
            Orm_User::USER_ALUMNI,
            Orm_User::USER_EMPLOYER,
        );

        if (!in_array($class_type, $allow)) {
            $class_type = Orm_User::USER_ALUMNI;
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Alumni Center'),
            'icon' => 'fa fa-graduation-cap',
            'menu_view' => 'alumni_center/alumni/sub_menu',
            'menu_params' => array('class_type' => $class_type)
        ), true);
        $this->view_params['menu_tab'] = 'alumni_center';

        $this->breadcrumbs->push(lang('Alumni Center'), '/alumni_center');
    }



    /**
     * default controller action
     * it's function to start alumni module for dashboard page
     */
    public function index() {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'alumni-list');

        $class_type = $this->input->get_post('type');

        $allow = array(
            Orm_User::USER_ALUMNI,
            Orm_User::USER_EMPLOYER,
        );

        if (!in_array($class_type, $allow)) {
            $class_type = Orm_User::USER_ALUMNI;
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Alumni Center'),
            'icon' => 'fa fa-graduation-cap',
            'link_attr' => 'href="/alumni_center/create_edit?type='.$class_type.'"',
            'link_icon' => 'plus',
            'link_title' => lang('Create') . ' ' . ($class_type == Orm_User::USER_ALUMNI ? lang('Alumni') : lang('Employer'))
        ), true);

        $per_page = $this->config->item('per_page');

        $page = (int) $this->input->get_post('page');
        $fltr = (array) $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = is_array($fltr) ? $fltr : array();

        $del_val = '';
        $filters = array_filter($filters, function($e) use ($del_val) {
            return ($e !== $del_val);
        });

        Orm_User::get_logged_user()->get_filters($filters);

        $items = $class_type::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count($class_type::get_count($filters));

        // set view parameters
        $this->view_params['class_type'] = $class_type;
        $this->view_params['items'] = $items;
        $this->view_params['pager'] = $pager->render(true);
        $this->layout->view('alumni_center/alumni/list', $this->view_params);
    }

    /**
     * create new item action
     * create new object or if exist modify and alter it
     */
    public function create_edit() {

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'alumni-manage');
        $class_type = $this->input->get_post('type');

        $allow = array(
            Orm_User::USER_ALUMNI,
            Orm_User::USER_EMPLOYER,
        );

        if (!in_array($class_type, $allow)) {
            Validator::set_error_flash_message(lang('Invalid Type'));
            redirect('alumni_center');
        }

        $id = $this->input->get('id');
        $this->view_params['user'] = $class_type::get_instance($id);

        $this->breadcrumbs->push($id ? lang('Edit') : lang('Add'), '/alumni_center/create_edit');

        $this->layout->view('alumni_center/alumni/create_edit', $this->view_params);
    }

    /**
     * save new item action
     * save object if conditions matches and redirect it to header
     */
    public function save() {
        $id = (int) $this->input->post('id');
        if (Orm_User::get_logged_user()->get_id() != $id) {
            Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'alumni-manage');
        }
        $class_type = $this->input->get_post('type');

        $allow = array(
            Orm_User::USER_ALUMNI,
            Orm_User::USER_EMPLOYER,
        );

        if (!in_array($class_type, $allow)) {
            Validator::set_error_flash_message(lang('Invalid Type'));
            redirect('/alumni_center');
        }

        // get request parameters
        $email = $this->input->post('email');
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

        $user = $class_type::get_instance($id); /* @var $user Orm_User_Alumni | Orm_User_Employer */

        // validation
        Validator::required_field_validator('email', $email, lang('Invalid Email'));
        Validator::required_field_validator('first_name', $first_name, lang('field required'));
        Validator::required_field_validator('last_name', $last_name, lang('field required'));
        Validator::email_field_validator('email', $email, lang('Invalid Email'));
        Validator::database_unique_field_validator($user, 'email', 'email', $email, lang('Email Already Exists'), null, null, Orm_User::class);

        $password = '';
	    $new_user = false;
        if (!$user->get_id()) {
	        $new_user = true;
            $password = random_password();
            $user->set_password(sha1($password));
        }

        $user->set_email($email);
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
//	        if ($new_user)
//	        {
//		        Orm_Notification::send_notification(
//			        Orm_User::get_logged_user_id(),
//			        $user->get_id(),
//			        Orm_Notification_Template::ALUMNI_EMPLOYER_CREATED,
//			        Orm_Notification::TYPE_COMMON,
//			        array(
//				        '%link%',
//				        '%password%',
//				        '%email%',
//			        ),
//			        array(
//				        '<a href="' . base_url($this->config->item('root_url')) . '">' . base_url($this->config->item('root_url')) . '</a>',
//				        $password,
//				        $user->get_email()
//			        )
//		        );
//	        }

            Validator::set_success_flash_message(lang('User Successfully Saved'));
            redirect("/alumni_center?type={$user->get_class_type()}");
        }

        $this->view_params['user'] = $user;
        $this->breadcrumbs->push($id ? lang('Update') : lang('Save'), '/alumni_center/create_edit');

        $this->layout->view('alumni_center/alumni/create_edit', $this->view_params);
    }

    /**
     * delete item action
     *
     * delete object if user has permissions to delete
     */
    public function delete($id) {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'alumni-manage');

        $user = Orm_User::get_instance($id);
        if ($user->get_id()) {
            $user->delete();
        }

        Validator::set_success_flash_message(lang('User Removed Successfully'));
    }

}
