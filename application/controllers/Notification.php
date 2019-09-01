<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property Breadcrumbs breadcrumbs
 * @property Layout layout
 * Class Notification
 */
class Notification extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'notification';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Notification'),
            'icon' => 'fa fa-bullhorn'
        ), true);
    }
    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    private function init_on_login()
    {
        $this->view_params['menu_tab'] = 'settings';

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-notification');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Settings'));
        $this->breadcrumbs->push(lang('Notification'), '/notification');
    }

    public function index()
    {

        $this->init_on_login();

        Orm_Notification_Template::generate();

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        $notifications = Orm_Notification_Template::get_all($filters, $page, $per_page);

        /** @var Pager $pager */
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Notification_Template::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['notifications'] = $notifications;

        $this->view_params['menu_header'] = lang('Notification');
        $this->layout->view('notification/list', $this->view_params);
    }

    public function save()
    {

        $this->init_on_login();

        // post data
        $id = (int)$this->input->post('id');
        $notification_name = $this->input->post('name');
        $notification_subject = $this->input->post('subject');
        $notification_body = $this->input->post('body');

        //validation errors
        Validator::required_field_validator('name', $notification_name, lang('Please Enter Notification Name'));
        Validator::required_field_validator('body', $notification_body, lang('Please Enter Notification Body'));
        Validator::required_field_validator('subject', $notification_subject, lang('Please Enter Notification Subject'));

        //get instances object 
        $obj = Orm_Notification_Template::get_instance($id);
        $obj->set_name($notification_name);
        $obj->set_body($notification_body);
        $obj->set_subject($notification_subject);

        //check validation
        if (Validator::success()) {
            $obj->save();
            redirect('/notification');
        }

        // parameter
        $this->view_params['notification'] = $obj;
        $this->layout->view('notification/create_edit', $this->view_params);
    }

    public function edit($id)
    {

        $this->init_on_login();

        $this->breadcrumbs->push(lang('Edit').' '.lang('Notification'), '/notification/edit/' . $id);

        $this->view_params['notification'] = Orm_Notification_Template::get_instance($id);
        $this->layout->view('notification/create_edit', $this->view_params);
    }

    public function check_notification()
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!Orm_User::is_logged_in()) {
            json_response(array('success' => false));
        }

        $notifications = Orm_Notification::get_all(array('is_read' => 0,'receiver_id' => Orm_User::get_logged_user()->get_id()), 1, 15, array('n.id DESC'));

        $index = 0;
        $unread_count = 0;
        $data = array();
        foreach ($notifications as $notification) {

            $sender = $notification->get_sender_obj();
            if(!is_null($sender) && $sender->get_id()) {
                $sender_name = $sender->get_full_name();
            } else {
                $sender_name = 'SYSTEM';
            }

            $notification_params = array();
            $notification_params['id'] = $notification->get_id();
            $notification_params['sender_id'] = $notification->get_sender_id();
            $notification_params['receiver_id'] = $notification->get_receiver_id();
            $notification_params['subject'] = $notification->get_subject();
            $notification_params['body'] = $notification->get_body();
            $notification_params['is_read'] = $notification->get_is_read();
            $notification_params['date_added'] = $notification->get_date_added();
            $notification_params['type'] = $notification->get_type();

            $data['notifications'][$index] = $notification_params;
            $data['notifications'][$index]['sender_name'] = $sender_name;
            $data['notifications'][$index]['type_name'] = lang($notification->get_type(true));
            $data['notifications'][$index]['type_icon'] = $notification->get_type_icon();
            $data['notifications'][$index]['type_color'] = $notification->get_type_color();

            if (!$notification->get_is_read()) {
                $unread_count++;
            }

            $index++;
        }
        $data['all_count'] = $index;
        $data['unread_count'] = $unread_count;
        $data['label'] = lang('Notifications');
        $data['more_label'] = lang('More Notifications');
        $data['success'] = true;

        json_response($data);
    }

	public function all($view_only = false)
	{
		Orm_User::check_logged_in();

        $this->breadcrumbs->push(lang('Notifications'), '/notification/all');

        $this->view_params['sub_menu'] = '';
        $this->view_params['menu_tab'] = 'settings';
        $this->view_params['items'] = Orm_Notification::get_all(array('receiver_id' => Orm_User::get_logged_user()->get_id()), 1, 15, array('n.id DESC'));;
		$this->view_params['menu_header'] = '<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-bullhorn page-header-icon"></i>&nbsp;&nbsp;' . lang('Notifications List') . '</h1></i>';

		if($view_only) {
            $this->load->view('notification/items',$this->view_params);
        } else {
            $this->layout->view('notification/items',$this->view_params);
        }
	}

    public function view_notification($id)
    {
        Orm_User::check_logged_in();

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $notification = Orm_Notification::get_instance($id);
        $notification->set_is_read(1);
        $notification->save();

        $this->view_params['notification'] = $notification;
        $this->load->view('notification/view', $this->view_params);
    }

    public function save_user_notification_settings()
    {

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
        redirect('/user/my_account');
    }

}
