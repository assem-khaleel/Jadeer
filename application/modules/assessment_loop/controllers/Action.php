<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 12/26/16
 * Time: 10:29 AM
 */
/**
 * @property CI_Input $input
 * @property Layout $layout
 * @property CI_Config $config
 * @property Breadcrumbs $breadcrumbs
 * Class Action
 */
class Action extends MX_Controller {

    private $view_params = [];
    private $assessment_loop_id = null;

    /**
     * Action constructor.
     */
    public function __construct() {
        parent::__construct();

        if(!License::get_instance()->check_module('assessment_loop', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->assessment_loop_id = (int)$this->input->get_post('assessment_loop_id');

        $assessment_loop = Orm_Al_Assessment_Loop::get_instance($this->assessment_loop_id);

        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');

        $this->view_params['assessment_loop'] = $assessment_loop;
        $this->view_params['assessment_loop_id'] = $assessment_loop->get_id();
        $this->view_params['menu_tab'] = 'assessment_loop';
        $this->view_params['type'] = 'action';
        $this->view_params['sub_menu'] = 'assessment_loop/manage';
        $this->breadcrumbs->push(lang('Assessment Loop'), '/assessment_loop');
    }

    /** dashboard page for action for assessment loop to get all objects of action
     * render it in list view
    */
    public function index()
    {
//        $this->layout->add_javascript('https://www.google.com/jsapi', false);
        $this->layout->add_javascript('https://www.google.com/jsapi', false);
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js', false);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title'      => lang('Assessment Loop'),
            'icon'       => 'fa fa-circle-o-notch',
            'link_attr'  => 'href="/assessment_loop/pdf/'.$this->assessment_loop_id.'"',
            'link_title' => lang('print'),
            'link_icon'  => 'file-pdf-o'
        ), true);

        $actions = Orm_Al_Action::get_all(array('assessment_loop_id' => $this->assessment_loop_id));
        $this->view_params['actions'] = $actions;

        $this->breadcrumbs->push(lang('Action'), '/action');
        $this->layout->view('action/list', $this->view_params);
    }

    /** add or edit action for assessment loop
     * @param int $id
     * render it in add edit view
     */
    public function add_edit($id = 0)
    {
        if (!$this->view_params['assessment_loop']->can_manage()) {
            Validator::set_error_flash_message(lang('Error: Due Date has Passed'));
            redirect('/assessment_loop');
        }

        $this->view_params['action'] = Orm_Al_Action::get_instance($id);
        $this->load->view('action/add_edit', $this->view_params);
    }

/** save action object after validate that user can manage it and request method is post
 * return json response
*/
    public function save()
    {
        if (!$this->view_params['assessment_loop']->can_manage()) {
            Validator::set_error_flash_message(lang('Error: Due Date has Passed'));
            redirect('/assessment_loop');
        }

        $id = intval($this->input->post('id'));
        $action_ar = $this->input->post('action_ar');
        $action_en = $this->input->post('action_en');
        $responsible_ar = $this->input->post('responsible_ar');
        $responsible_en = $this->input->post('responsible_en');
        $time_frame_ar = $this->input->post('time_frame_ar');
        $time_frame_en = $this->input->post('time_frame_en');

        //get instances object
        $obj = Orm_Al_Action::get_instance($id);

        $obj->set_action_ar($action_ar);
        $obj->set_action_en($action_en);
        $obj->set_responsible_ar($responsible_ar);
        $obj->set_responsible_en($responsible_en);
        $obj->set_time_frame_ar($time_frame_ar);
        $obj->set_time_frame_en($time_frame_en);
        $obj->set_assessment_loop_id($this->assessment_loop_id);

        //validation errors
        Validator::required_field_validator('action_ar', $action_ar, lang('Please Enter Action').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('action_en', $action_en, lang('Please Enter Action').' ( '.lang('English').' ) ');
        Validator::required_field_validator('responsible_ar', $responsible_ar, lang('Please Enter responsible').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('responsible_en', $responsible_en, lang('Please Enter responsible').' ( '.lang('English').' ) ');
        Validator::required_field_validator('time_frame_ar', $time_frame_ar, lang('Please Enter Time Frame').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('time_frame_en', $time_frame_en, lang('Please Enter Time Frame').' ( '.lang('English').' ) ');
        Validator::database_unique_field_validator($obj, 'action_ar', 'action_ar', $action_ar, lang('Unique Field'), null, ['assessment_loop_id' => $this->assessment_loop_id]);
        Validator::database_unique_field_validator($obj, 'action_en', 'action_en', $action_en, lang('Unique Field'), null, ['assessment_loop_id' => $this->assessment_loop_id]);
        Validator::database_unique_field_validator($obj, 'responsible_ar', 'responsible_ar', $responsible_ar, lang('Unique Field'), null, ['assessment_loop_id' => $this->assessment_loop_id]);
        Validator::database_unique_field_validator($obj, 'responsible_en', 'responsible_en', $responsible_en, lang('Unique Field'), null, ['assessment_loop_id' => $this->assessment_loop_id]);


        if ($this->input->server('REQUEST_METHOD') == 'POST' && Validator::success()) {

            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));

            json_response(array('status' => true));


        }

        $this->view_params['action'] = $obj;
        json_response(array('status' => false, 'html' => $this->load->view('action/add_edit', $this->view_params, true)));
    }

    /** delete action assessment loop
     * @param $id
     */
    public function delete($id)
    {
        if (!$this->view_params['assessment_loop']->can_manage()) {
            Validator::set_error_flash_message(lang('Error: Due Date has Passed'));
            redirect('/assessment_loop');
        }

        $obj = Orm_Al_Action::get_instance($id);
        if ($obj->get_id()) {
            $obj->delete();
        }
        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect("/assessment_loop/action?assessment_loop_id={$this->assessment_loop_id}");
    }


}