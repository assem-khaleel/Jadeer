<?php

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Pc_Settings
 */
class Pc_settings extends MX_Controller
{

    private $view_params;

    /**
     * Pc_settings constructor.
     */
    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        if (!License::get_instance()->check_module('portfolio_course', true)) {
            show_404();
        }

        $this->breadcrumbs->push(lang('Portfolio Course'), '/portfolio_course');
        $this->breadcrumbs->push(lang('Settings'), '/portfolio_course/settings');

        $this->view_params['menu_tab'] = 'portfolio_course';

        $this->view_params['id'] = $this->input->get('id');
        $this->view_params['type'] = 'settings';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Settings') . ' - ' . lang('Course Evaluation'),
            'icon' => 'fa fa-gear'
        ), true);
    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {
        $this->layout->view('portfolio_course/settings/course_evaluation', $this->view_params);
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save() {

        $entity_key = (int) $this->input->post('entity_key');
        $entity_value = (int) $this->input->post('entity_value');

        //validation errors
        Validator::not_empty_field_validator('entity_value', $entity_value, lang('Please Select Survey'));

        if (Validator::success()) {
            $obj = Orm_Pc_Settings::get_one(array('entity_key' => $entity_key));
            $obj->set_entity_key($entity_key);
            $obj->set_entity_value($entity_value);
            $obj->save();

            Validator::set_success_flash_message(lang('Settings Saved Successfully'));
        }

        $this->layout->view('portfolio_course/settings/course_evaluation', $this->view_params);
    }
}