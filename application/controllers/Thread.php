<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Thread
 */
class Thread extends MX_Controller {

    /**
     * View Params
     * @var array
     */
    private $view_params = array();
    private $logged_user = null;

    public function __construct() {
        parent::__construct();

        Orm_User::check_logged_in();
        $this->logged_user = Orm_User::get_logged_user();

        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');

        $this->view_params['page_class'] = 'page-mail';
    }

    public function index(){
        $this->items();
    }

    public function items($type = Orm_Thread::LIST_TYPE_INBOX) {

        $per_page = ($this->config->item('per_page') * 2);
        $page = (int)$this->input->get_post('page');
        $search = $this->input->get_post('search');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        $filters['type'] = $type;

        if ($search){
            $filters['keyword'] = trim($search);
        }

        $threads = Orm_Thread::get_all($filters, $page, $per_page, ['tm.sent_date DESC']);

        $this->view_params['total_count'] = Orm_Thread::get_count($filters);
        $this->view_params['page'] = $page;
        $this->view_params['per_page'] = $per_page;

        $this->view_params['threads'] = $threads;
        $this->view_params['search'] = $search;

        $this->view_params['type'] = $type;
        $this->view_params['content_view'] = 'thread/items';
        $this->layout->view('thread/layout', $this->view_params);
    }

    public function compose($receiver_id = 0, $template_name = null) {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if(!is_null($template_name) && $receiver_id) {

            $sender = Orm_User::get_logged_user();
            $receiver = Orm_User::get_instance($receiver_id);

            $template = Orm_Notification_Template::get_one(array('name' => $template_name));

            if ($template->get_id() && (!is_null($receiver) && $receiver->get_id())) {
                $all_placeholders = array(
                    '%sender_name%',
                    '%sender_email%',
                    '%sender_role%',
                    '%receiver_name%',
                    '%receiver_email%',
                    '%receiver_role%'
                );

                $all_placeholders_replacement = array(
                    $sender->get_full_name(),
                    $sender->get_email(),
                    $sender->get_type_name(),
                    $receiver->get_full_name(),
                    $receiver->get_email(),
                    $receiver->get_type_name()
                );

                $subject = str_replace($all_placeholders, $all_placeholders_replacement, $template->get_subject());
                $body = str_replace($all_placeholders, $all_placeholders_replacement, $template->get_body());

                $this->view_params['subject'] = $subject;
                $this->view_params['body'] = $body;
            }
        }

	    $ids = $this->input->get('ids');

        if ($receiver_id) {
            $this->view_params['to'][] = $receiver_id;
        } elseif (isset($ids) && is_array($ids) && count($ids) > 0) {
		    $this->view_params['to'] = $ids;
	    }

        $this->load->view('thread/compose', $this->view_params);

    }

    public function send() {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        //post data
        $to = $this->input->post('to');
        $subject = $this->input->post('subject');
        $body = $this->input->post('body');

        Validator::required_array_validator('to', $to, lang('Please specify at least one recipient.'));
        Validator::required_field_validator('subject', $subject, lang('Please Enter Subject'));

        if (Validator::success()) {

            $thread_obj = new Orm_Thread();
            $thread_obj->save_process($to, $subject, $body);

            json_response(array('status' => true));
        }

        $this->view_params['to'] = $to;
        $this->view_params['subject'] = $subject;
        $this->view_params['body'] = $body;
        json_response(array('status' => false, 'html' => $this->load->view('thread/compose', $this->view_params, true)));
    }

    public function show($type, $id){

        //post data
        $to = $this->input->post('to');
        $body = $this->input->post('body');

        $thread_message_obj = Orm_Thread_Message::get_instance($id);

        if(!$thread_message_obj->get_id()) {
            Validator::set_error_flash_message(lang('Error: Please try again'));
            redirect('/thread/items/' . $type);
        }

        if(!in_array($this->logged_user->get_id(), $thread_message_obj->get_participant_ids())) {
            Validator::set_error_flash_message(lang('Error: Please try again'));
            redirect('/thread/items/' . $type);
        }

        $thread_message_obj->show_process();

        if($this->input->server('REQUEST_METHOD') == 'POST') {

            Validator::required_array_validator('to', $to, lang('Please specify at least one recipient.'));

            if (Validator::success()) {
                $thread_message_obj->get_thread_obj()->save_process($to, $thread_message_obj->get_subject(), $body);

                redirect('/thread/items/' . $type);
            }
        } else {
//            foreach(Orm_Thread_Participant::get_all(array('thread_id' => $thread_message_obj->get_thread_id())) as $participant) {
//                if($participant->get_user_id() != $this->logged_user->get_id()) {
//                    $to[$participant->get_user_id()] = $participant->get_user_id();
//                }
//            }
            foreach(Orm_Thread_Participant_Group::get_all(array('thread_id' => $thread_message_obj->get_thread_id())) as $participant_group) {
                $to[] = "{$participant_group->get_type_class()}-{$participant_group->get_type_id()}";
            }
        }

        $this->view_params['main_message'] = $thread_message_obj;
        $this->view_params['thread_messages'] = Orm_Thread_Message::get_all(array('thread_id' => $thread_message_obj->get_thread_id()));
        $this->view_params['to'] = $to;
        $this->view_params['body'] = $body;

        $this->view_params['type'] = $type;
        $this->view_params['content_view'] = 'thread/show';
        $this->layout->view('thread/layout', $this->view_params);
    }

    public function trash_one($id){
        $thread_message_obj = Orm_Thread_Message::get_instance($id);

        $thread_participant_obj = $thread_message_obj->get_thread_obj()->get_logged_participant();
        if($thread_participant_obj->get_id()) {
            $thread_participant_obj->set_is_deleted(1);
            $thread_participant_obj->save();

            Validator::set_success_flash_message(lang('The conversation has been moved to the Trash.'));
        }

        redirect('/thread/items/' . Orm_Thread::LIST_TYPE_TRASH);
    }

    public function unread_one($type, $id){

        $thread_message_obj = Orm_Thread_Message::get_instance($id);

        $thread_read_state_obj = $thread_message_obj->get_logged_read_state();
        if($thread_read_state_obj->get_id()) {
            $thread_read_state_obj->delete();
            Validator::set_success_flash_message(lang('The conversation has been marked as unread.'));
        }

        redirect('/thread/items/' . $type);
    }

    public function star($id){
        $thread_message_obj = Orm_Thread_Message::get_instance($id);

        $thread_participant_obj = $thread_message_obj->get_thread_obj()->get_logged_participant();
        if($thread_participant_obj->get_id()) {
            if($thread_participant_obj->get_is_important()) {
                Validator::set_success_flash_message(lang('The conversation has been marked as not important.'));
                $thread_participant_obj->set_is_important(0);
            } else {
                Validator::set_success_flash_message(lang('The conversation has been marked as important.'));
                $thread_participant_obj->set_is_important(1);
            }
            $thread_participant_obj->save();
        }

        redirect($this->input->server('HTTP_REFERER'));
    }

    public function trash(){

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $message_ids = $this->input->post('message_ids');

        if(is_array($message_ids) && count($message_ids)) {

            $count = 0;
            foreach($message_ids as $message_id) {
                $thread_message_obj = Orm_Thread_Message::get_instance($message_id);

                $thread_participant_obj = $thread_message_obj->get_thread_obj()->get_logged_participant();
                if($thread_participant_obj->get_id()) {
                    $thread_participant_obj->set_is_deleted(1);
                    $thread_participant_obj->save();

                    $count++;
                }
            }

            if($count == 1) {
                Validator::set_success_flash_message(lang('The conversation has been moved to the Trash.'));
            } else {
                Validator::set_success_flash_message($count . ' ' . lang('conversations have been moved to the Trash.'));
            }
        } else {
            Validator::set_error_flash_message(lang('Error: Please Select at least one conversation.'));
        }

        json_response(array('status' => true));
    }

    public function restore(){

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $message_ids = $this->input->post('message_ids');

        if(is_array($message_ids) && count($message_ids)) {

            $count = 0;
            foreach($message_ids as $message_id) {
                $thread_message_obj = Orm_Thread_Message::get_instance($message_id);

                $thread_participant_obj = $thread_message_obj->get_thread_obj()->get_logged_participant();
                if($thread_participant_obj->get_id()) {
                    $thread_participant_obj->set_is_deleted(0);
                    $thread_participant_obj->save();

                    $count++;
                }
            }

            if($count == 1) {
                Validator::set_success_flash_message(lang('The conversation has been moved to the Inbox.'));
            } else {
                Validator::set_success_flash_message($count . ' ' . lang('conversations have been moved to the Inbox.'));
            }
        } else {
            Validator::set_error_flash_message(lang('Error: Please Select at least one conversation.'));
        }

        json_response(array('status' => true));
    }

    public function unread(){

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $message_ids = $this->input->post('message_ids');

        if(is_array($message_ids) && count($message_ids)) {

            $count = 0;
            foreach($message_ids as $message_id) {
                $thread_message_obj = Orm_Thread_Message::get_instance($message_id);

                $thread_read_state_obj = $thread_message_obj->get_logged_read_state();
                if($thread_read_state_obj->get_id()) {
                    $thread_read_state_obj->delete();
                }
                $count++;
            }

            if($count == 1) {
                Validator::set_success_flash_message(lang('The conversation has been marked as unread.'));
            } else {
                Validator::set_success_flash_message($count . ' ' . lang('conversations have been marked as unread.'));
            }
        } else {
            Validator::set_error_flash_message(lang('Error: Please Select at least one conversation.'));
        }

        json_response(array('status' => true));
    }

    public function important(){

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $message_ids = $this->input->post('message_ids');

        if(is_array($message_ids) && count($message_ids)) {

            $count = 0;
            foreach($message_ids as $message_id) {
                $thread_message_obj = Orm_Thread_Message::get_instance($message_id);

                $thread_participant_obj = $thread_message_obj->get_thread_obj()->get_logged_participant();
                if($thread_participant_obj->get_id()) {
                    $thread_participant_obj->set_is_important(1);
                    $thread_participant_obj->save();

                    $count++;
                }
            }

            if($count == 1) {
                Validator::set_success_flash_message(lang('The conversation has been marked as important.'));
            } else {
                Validator::set_success_flash_message($count . ' ' . lang('conversations have been marked as important.'));
            }
        } else {
            Validator::set_error_flash_message(lang('Error: Please Select at least one conversation.'));
        }

        json_response(array('status' => true));
    }

    public function unimportant(){

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $message_ids = $this->input->post('message_ids');

        if(is_array($message_ids) && count($message_ids)) {

            $count = 0;
            foreach($message_ids as $message_id) {
                $thread_message_obj = Orm_Thread_Message::get_instance($message_id);

                $thread_participant_obj = $thread_message_obj->get_thread_obj()->get_logged_participant();
                if($thread_participant_obj->get_id()) {
                    $thread_participant_obj->set_is_important(0);
                    $thread_participant_obj->save();

                    $count++;
                }
            }

            if($count == 1) {
                Validator::set_success_flash_message(lang('The conversation has been marked as not important.'));
            } else {
                Validator::set_success_flash_message($count . ' ' . lang('conversations have been marked as not important.'));
            }
        } else {
            Validator::set_error_flash_message(lang('Error: Please Select at least one conversation.'));
        }

        json_response(array('status' => true));
    }

    public function autocomplete(){

        $term = $this->input->get('term');

        $filters = array();
        $filters['keyword'] = trim($term);

        $users = Orm_User::get_all($filters, 0, 20);

        $index = 0;
        $response = array();
        foreach ($users as $user) {
            $response[$index]['id'] = $user->get_id();
            $response[$index]['value'] = $user->get_full_name();
            $index++;
        }

        json_response($response);
    }

    public function groups($my_groups = true) {

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $search = $this->input->get_post('search');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        $filters['creator_id'] = Orm_user::get_logged_user_id();

        if ($search){
            $filters['keyword'] = trim($search);
        }

        if($my_groups) {
            $groups = Orm_Thread_Group::get_all($filters, $page, $per_page);
            $total_count = Orm_Thread_Group::get_count($filters);
        } else {
            $system_groups = Orm_Thread_Group::get_system_groups($filters, $page, $per_page);
            list($groups, $total_count) = $system_groups;
        }

        $this->view_params['total_count'] = $total_count;
        $this->view_params['page'] = $page;
        $this->view_params['per_page'] = $per_page;

        $this->view_params['my_groups'] = $my_groups;
        $this->view_params['groups'] = $groups;
        $this->view_params['search'] = $search;

        $this->view_params['type'] = Orm_Thread::LIST_TYPE_GROUPS;
        $this->view_params['content_view'] = 'thread/groups';
        $this->layout->view('thread/layout', $this->view_params);
    }

    public function group_manage($id = 0){

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $group = Orm_Thread_Group::get_instance($id);

        $group->set_creator_id(Orm_User::get_logged_user_id());

        $user_ids = array_column(Orm_Thread_Group_Members::get_model()->get_all(['group_id' => $id], 0, 0, [], Orm::FETCH_ARRAY), 'user_id');
        
        if($this->input->method() == 'post') {

            $old_user_ids = $user_ids;
            $name_english = $this->input->post('name_english');
            $name_arabic = $this->input->post('name_arabic');
            $desc_english = $this->input->post('desc_english');
            $desc_arabic = $this->input->post('desc_arabic');
            $user_ids = $this->input->post('user_ids');

            $user_ids = is_array($user_ids) ? $user_ids : [];
            $user_ids = array_filter($user_ids, function($value) { return $value !== ''; });

            Validator::required_field_validator('name_english', $name_english, lang('Required Name').' '.lang('English'));
            Validator::required_field_validator('name_arabic', $name_arabic, lang('Required Name').' '.lang('Arabic'));
            Validator::required_array_validator('user_ids', array_values($user_ids), lang('Group should have members'));

            $group->set_group_name_en($name_english);
            $group->set_group_name_ar($name_arabic);
            $group->set_group_desc_en($desc_english);
            $group->set_group_desc_ar($desc_arabic);

            if(Validator::success()) {
                $group->save();

                foreach ($user_ids as $user_id) {
                    $group_member = Orm_Thread_Group_Members::get_one(array('group_id' => $group->get_id(), 'user_id' => $user_id));
                    $group_member->set_group_id($group->get_id());
                    $group_member->set_user_id($user_id);
                    $group_member->save();
                }

                $remove_members = arrayRecursiveDiff($old_user_ids, $user_ids);

                if($remove_members && Validator::success()) {
                    foreach ($remove_members as $member) {
                        $course_outcome = Orm_Thread_Group_Members::get_one(['group_id' => $group->get_id(), 'user_id' => $member]);
                        $course_outcome->delete();
                    }
                }

                json_response(['status' => true]);
            }
        }

        $this->view_params['group'] = $group;
        $this->view_params['user_ids'] = $user_ids;

        $html = $this->load->view('thread/group_manage', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    public function group_delete() {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $group_ids = $this->input->post('group_ids');

        if(is_array($group_ids) && count($group_ids)) {

            foreach($group_ids as $group_id) {
                $group_obj = Orm_Thread_Group::get_instance($group_id);
                if ($group_obj->get_creator_id() == Orm_User::get_logged_user_id()) {
                    $group_obj->delete();
                }
            }

            Validator::set_success_flash_message(lang('The Group/s has been deleted.'));
        } else {
            Validator::set_error_flash_message(lang('Error: Please Select at least one group.'));
        }

        json_response(array('status' => true));
    }

    public function find_select() {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $data = [];

        $page = 1;
        $per_page = 10;

        $txt = $this->input->post_get('txt');

        $filters = array();
        $filters['creator_id'] = Orm_user::get_logged_user_id();

        if ($txt){
            $filters['keyword'] = $txt;
        }

        $system_groups = Orm_Thread_Group::get_system_groups($filters, $page, $per_page);
        list($groups, $total_count) = $system_groups;

        if($total_count) {
            foreach($groups as $group) {
                $data[] = [
                    'id'   => get_class($group->get_object()) . '-' . $group->get_id(),
                    'name' => $group->get_group_name(),
                    'type' => lang('System Groups')
                ];
            }
        }

        foreach(Orm_Thread_Group::get_all($filters, $page, $per_page, ['group_name_en']) as $group) {
            $data[] = [
                'id'   => Orm_Thread_Group::class . '-' . $group->get_id(),
                'name' => $group->get_group_name(),
                'type' => lang('My Groups')
            ];
        }

        unset($filters['creator_id']);

        foreach(Orm_User::get_all($filters, $page, $per_page, ['first_name', 'last_name']) as $user) {
            $data[] = [
                'id'   => Orm_User::class . '-' . $user->get_id(),
                'name' => $user->get_full_name(),
                'type' => lang($user->get_type_name())
            ];
        }

        json_response(array(
            'data' => $data,
            'success' => true
        ));
    }

}
