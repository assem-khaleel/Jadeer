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
 * Class Measure
 */
class Measure extends MX_Controller {

    private $view_params = array();
    private $assessment_loop_id = null;

    /**
     * Measure constructor.
     */
    public function __construct() {
        parent::__construct();

        if(!License::get_instance()->check_module('assessment_loop', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        $this->assessment_loop_id = (int)$this->input->get_post('assessment_loop_id');

        $assessment_loop = Orm_Al_Assessment_Loop::get_instance($this->assessment_loop_id);

        $this->view_params['assessment_loop'] = $assessment_loop;
        $this->view_params['assessment_loop_id'] = $assessment_loop->get_id();
        $this->view_params['menu_tab'] = 'assessment_loop';
        $this->view_params['type'] = 'measure';
        $this->view_params['sub_menu'] = 'assessment_loop/manage';
        $this->breadcrumbs->push(lang('Assessment Loop'), '/assessment_loop');
    }
/** index page for measure assessment loop , get all measures objects
 * render it in list view
*/
    public function index() {
//        $a= Orm_Al_Assessment_Loop::get_instance(1);
//
//        var_dump($a->get_measure_objs());
//        die();

//        $this->layout->add_javascript('https://www.google.com/jsapi', false);
        $this->layout->add_javascript('https://www.google.com/jsapi', false);
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js', false);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Assessment Loop'),
            'icon' => 'fa fa-circle-o-notch',
            'link_attr'  => 'href="/assessment_loop/pdf/'.$this->assessment_loop_id.'"',
            'link_title' => lang('print'),
            'link_icon'  => 'file-pdf-o'
        ), true);

        $measures = Orm_Al_Measure::get_all(['assessment_loop_id' => $this->assessment_loop_id]);
        $this->view_params['measures'] = $measures;
        $this->breadcrumbs->push(lang('Measure'), '/measure');
        $this->layout->view('measure/list', $this->view_params);
    }

    /**add or edit measure depending if user can manage
     * @param int $id
     * render it in add edit view
     */
    public function add_edit($id = 0)
    {
        if (!$this->view_params['assessment_loop']->can_manage()) {
            Validator::set_error_flash_message(lang('Error: Due Date has Passed'));
            redirect('/assessment_loop');
        }

        $this->view_params['measure'] = Orm_Al_Measure::get_instance($id);
        $this->load->view('measure/add_edit', $this->view_params);
    }
/** save measure object
 * return json response to ajax
*/
    public function save()
    {
        if (!$this->view_params['assessment_loop']->can_manage()) {
            Validator::set_error_flash_message(lang('Error: Due Date has Passed'));
            redirect('/assessment_loop');
        }

        $id = intval($this->input->post('id'));
        $text_en = $this->input->post('text_en');
        $text_ar = $this->input->post('text_ar');

        $measure = Orm_Al_Measure::get_instance($id);
        $measure->set_text_en($text_en);
        $measure->set_text_ar($text_ar);
        $measure->set_assessment_loop_id($this->assessment_loop_id);

        //validation errors
        Validator::required_field_validator('text_ar', $text_ar, lang('Please Enter Measure Text').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('text_en', $text_en, lang('Please Enter Measure Text').' ( '.lang('English').' ) ');
        Validator::database_unique_field_validator($measure, 'text_ar', 'text_ar', $text_ar, lang('Unique Field'), null, ['assessment_loop_id' => $this->assessment_loop_id]);
        Validator::database_unique_field_validator($measure, 'text_en', 'text_en', $text_en, lang('Unique Field'), null, ['assessment_loop_id' => $this->assessment_loop_id]);
        //get instances object


        if ($this->input->server('REQUEST_METHOD') == 'POST' && Validator::success()) {

            $measure->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(array('status' => true));

        }

        $this->view_params['measure'] = $measure;
        json_response(array('status'=>false, 'html'=>$this->load->view('measure/add_edit', $this->view_params, true)));

    }


    /** delete object if user can manage
     * @param $id
     */
    public function delete($id)
    {
        if (!$this->view_params['assessment_loop']->can_manage()) {
            Validator::set_error_flash_message(lang('Error: Due Date has Passed'));
            redirect('/assessment_loop');
        }

        $obj = Orm_Al_Measure::get_instance($id);
        if ($obj->get_id()) {
            $obj->delete();
        }
        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect("/assessment_loop/measure?assessment_loop_id={$this->assessment_loop_id}");
    }

}