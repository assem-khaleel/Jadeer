<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Risk_Tab
 * @property Layout $layout
 * @property CI_Input $input
 */
class Risk_Tab extends MX_Controller
{

    private $types = array(
        'Orm_Sp_Objective',
        'Orm_Sp_Project',
        'Orm_Sp_Action_Plan',
        'Orm_Sp_Initiative',
        'Orm_Sp_Activity',
        'Orm_Sp_Project'
    );

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    /**
     * Risk_Tab constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!License::get_instance()->check_module('strategic_planning', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $this->view_params['menu_tab'] = 'strategic_planning';
        $this->view_params['menu_header'] = '<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-sitemap page-header-icon"></i>&nbsp;&nbsp;' . lang('Strategic Planning') . '</h1></i>';
    }

    /**
     *this function index
     * @redirect string the html view
     */
    public function index()
    {
        redirect('/strategic_planning/dashboard');
        //$this->items();
    }

    /**
     *this function items
     * @return string the html view
     */
    public function items()
    {
        $risk_tabs = Orm_Sp_Risk_Tab::get_all();
        $this->view_params['risk_tabs'] = $risk_tabs;

        $this->layout->view('risk_tab/items', $this->view_params);
    }

    /**
     * this function add edit
     * @return string the html view
     */
    public function add_edit()
    {
        $id = (int)$this->input->get('id');
        $type = $this->input->get('type');
        if (in_array($type, $this->types)) {
            $risk = Orm_Sp_Risk_Tab::get_one(array('type_id' => $id, 'class_type' => $type));
            $this->view_params['risk'] = $risk;
            $this->view_params['obj_id'] = $id;
            $this->view_params['class'] = $type;
            $this->load->view('risk_tab/add_edit', $this->view_params);
        } else {
            json_response(array('error' => true, 'msg' => lang('Type Invalid!')));
        }
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        $id = (int)$this->input->post('id');
        $type_id = (int)$this->input->post('obj_id');
        $class_type = $this->input->post('class');

        if (in_array($class_type, $this->types)) {
            $content = $this->input->post('risk');
            $impact = $this->input->post('impact');

            Validator::required_field_validator('risk', $content, lang('Invalid Risk!'));
            Validator::required_field_validator('impact', $impact, lang('Invalid Impact!'));

            $risk = Orm_Sp_Risk_Tab::get_instance($id);
            $risk->set_class_type($class_type);
            $risk->set_impact($impact);
            $risk->set_type_id($type_id);
            $risk->set_risk($content);

            if (Validator::success()) {
                $risk->save();

                Validator::set_success_flash_message(lang('Risk Successfully Saved'));
                json_response(array('error' => false));
            }

            $this->view_params['risk'] = $risk;
            $this->view_params['obj_id'] = $type_id;
            $this->view_params['class'] = $class_type;
            json_response(array('error' => true, 'html' => $this->load->view('risk_tab/add_edit', $this->view_params, true)));
            //$this->layout->view('risk_tab/add_edit', $this->view_params);
        } else {
            Validator::required_field_validator('risk', null, lang('Invalid Risk!'));
            json_response(array('error' => true, 'html' => $this->load->view('risk_tab/add_edit', $this->view_params, true)));
            //json_response(array('error' => true, 'msg' => lang('Type Invalid!')));
        }
    }

}