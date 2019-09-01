<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/26/17
 * Time: 8:59 AM
 */

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Tasks
 */
class Tasks extends MX_Controller {

    private $view_params = [];
    private $user_id = 0;

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();

        $this->user_id = Orm_User::get_logged_user_id();

        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');
    }

    public function index() {
        Validator::set_error_flash_message(lang('Error : Please try Again'));
        redirect('/');
    }

    public function my_tasks() {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $this->load->view('tasks/my_tasks', $this->view_params);
    }

    public function sent_tasks() {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $this->load->view('tasks/sent_tasks', $this->view_params);
    }

    public function add_edit($id = 0) {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $task = Orm_Tasks::get_instance($id);

        if($task->get_id() && $task->get_from() != $this->user_id) {
            return $this->get_details($id);
        }

        if($this->input->server('REQUEST_METHOD') == 'POST') {

            $to = (array)$this->input->post('to');
            $title = $this->input->post('task-title');
            $text = $this->input->post('text');

            Validator::required_field_validator('title', $title, lang('You have to enter title'));
            Validator::required_field_validator('text', $text, lang('You have to enter task'));
            Validator::required_array_validator('to', $to,  lang('You have to select user'));

            if(count($to) == 0) {
                Validator::set_error('to', lang('You have to select user'));
            } else {
                foreach($to as $user){
                    if(!Orm_User::get_instance($user)->get_id()) {
                        Validator::set_error('to', lang('Some users not exist'));
                        break;
                    }
                }
            }

            $task->set_title($title);
            $task->set_text($text);

            if(Validator::success()) {

                foreach($to as $key => $user) {

                    $task->set_title($title);
                    $task->set_text($text);
                    $task->set_to($user);
                    $task->set_from($this->user_id);

                    $task->save();

                    if(count($to) > 1){
                        $task = new Orm_Tasks();
                    }
                }

                if($task->get_to() == $this->user_id) {
                    json_response(['success' => true, 'html' => $this->load->view('tasks/my_tasks', $this->view_params, true)]);
                } else {
                    json_response(['success' => true, 'html' => $this->load->view('tasks/sent_tasks', $this->view_params, true)]);
                }
            }

            $this->view_params['task'] = $task;

            json_response(['success' => false, 'html' => $this->load->view('tasks/add_edit.php', $this->view_params, true)]);
        }

        $this->view_params['task'] = $task;

        $this->load->view('tasks/add_edit.php', $this->view_params);

    }

    public function get_details($id) {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $task = Orm_Tasks::get_instance($id);

        if(!$task->get_id()) {
            show_404();
        }

        if($task->get_from() == $this->user_id) {
            json_response(['success' => false]);
        }

        $this->view_params['task'] = $task;

        $this->load->view('tasks/details', $this->view_params);
    }

    public function delete($id) {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $task = Orm_Tasks::get_instance($id);

        if(!$task->get_id()) {
            show_404();
        }

        if ($task->get_from() == $this->user_id) {
            $task->delete();
        }

        json_response(array('status' => true));
    }

    public function set_done($id) {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $task = Orm_Tasks::get_instance($id);

        if(!$task->get_id()) {
            show_404();
        }

        if($task->get_to() != $this->user_id) {
            json_response(['success' => false]);
        }

        $checked = $this->input->get_post('checked');

        $checked = $checked === false ? 1 : $checked;

        $task->set_done($checked);

        if($task->save()) {
            json_response(['success' => true]);
        }

        json_response(['success' => false]);
    }
}