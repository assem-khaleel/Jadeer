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
 * Class Analysis
 */
class Analysis extends MX_Controller {

    private $view_params = [];
    private $assessment_loop_id = null;

    /**
     * Analysis constructor.
     */
    public function __construct() {
        parent::__construct();

        if(!License::get_instance()->check_module('assessment_loop', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        $this->assessment_loop_id = intval($this->input->get_post('assessment_loop_id'));

        $assessment_loop = Orm_Al_Assessment_Loop::get_instance($this->assessment_loop_id);


        $this->view_params['assessment_loop'] = $assessment_loop;
        $this->view_params['assessment_loop_id'] = $assessment_loop->get_id();
        $this->view_params['menu_tab'] = 'assessment_loop';
        $this->view_params['type'] = 'analysis';
        $this->view_params['sub_menu'] = 'assessment_loop/manage';
        $this->breadcrumbs->push(lang('Assessment Loop'), '/assessment_loop');
    }
/** it's index page for analysis
 * render it in list view
*/
    public function index()
    {
        $this->layout->add_javascript('https://www.google.com/jsapi', false);
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js', false);

        $analysis = Orm_Al_Analysis::get_one(['assessment_loop_id'=>$this->assessment_loop_id]);

//        $analysis_id = $analysis->get_id();

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Assessment Loop'),
            'icon' => 'fa fa-circle-o-notch',
            'link_attr'  => 'href="/assessment_loop/pdf/'.$this->assessment_loop_id.'"',
            'link_title' => lang('print'),
            'link_icon'  => 'file-pdf-o'
        ), true);

        $this->view_params['analysis'] = $analysis;

        $this->breadcrumbs->push(lang('Analysis'), '/analysis');
        $this->layout->view('analysis/list', $this->view_params);
    }

    /** add or edit analysis for assessment loop
     * @param int $id
     */
    public function add_edit($id = 0)
    {
        if (!$this->view_params['assessment_loop']->can_manage()) {
            Validator::set_error_flash_message(lang('Error: Due Date has Passed'));
            redirect('/assessment_loop');
        }

        $this->view_params['analysis'] = Orm_Al_Analysis::get_instance($id);
        $this->load->view('analysis/add_edit', $this->view_params);
    }
/** save assessment loop for analysis
 * return json response for ajax
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

        //get instances object
        $obj = Orm_Al_Analysis::get_instance($id);
        $obj->set_text_en($text_en);
        $obj->set_text_ar($text_ar);
        $obj->set_assessment_loop_id($this->assessment_loop_id);

        //validation errors
        Validator::required_field_validator('text_ar', $text_ar, lang('Please Enter Analysis').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('text_en', $text_en, lang('Please Enter Analysis').' ( '.lang('English').' ) ');
        Validator::database_unique_field_validator($obj, 'text_ar', 'text_ar', $text_ar, lang('Unique Field'), null, ['assessment_loop_id' => $this->assessment_loop_id]);
        Validator::database_unique_field_validator($obj, 'text_en', 'text_en', $text_en, lang('Unique Field'), null, ['assessment_loop_id' => $this->assessment_loop_id]);



        if ($this->input->server('REQUEST_METHOD') == 'POST' && Validator::success()) {

            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(array('status' => true));

        }

        $this->view_params['analysis'] = $obj;

        json_response(array('status' => false, 'html' => $this->load->view('analysis/add_edit', $this->view_params, true)));

    }

}