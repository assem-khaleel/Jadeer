<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Value
 * @property Layout $layout
 * @property CI_Input $input
 */
class Value extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    /**
     * Value constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!License::get_instance()->check_module('strategic_planning', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $strategy_id = $this->input->get_post('strategy_id');
        $this->strategy = Orm_Sp_Strategy::get_instance($strategy_id);

        if (!$this->strategy->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/strategic_planning');
        }

        $this->view_params['item'] = $this->strategy;
        $this->view_params['menu_tab'] = 'strategic_planning';
        $this->view_params['menu_header'] = '<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-sitemap page-header-icon"></i>&nbsp;&nbsp;' . lang('Strategic Planning') . '</h1></i>';
    }

    /**
     *this function index
     * @return string the html view
     * default controller action
     */
    public function index()
    {
        $filters = array();

        $values = Orm_Sp_Values::get_all($filters);
        $this->view_params['values'] = $values;
        $this->layout->view('value/items', $this->view_params);
    }

    /**
     * this function add edit
     * @return string the html view
     */
    public function add_edit()
    {
        $id = $this->input->get('id');
        $value = Orm_Sp_Values::get_instance($id);
        $this->view_params['value'] = $value;
        $this->load->view('value/add_edit', $this->view_params);
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        $strategy_id = $this->strategy->get_id();
        $id = (int)$this->input->post('id');
        $title_en = $this->input->post('title_en');
        $title_ar = $this->input->post('title_ar');
        $desc_ar = $this->input->post('desc_ar');
        $desc_en = $this->input->post('desc_en');

        // validation
        Validator::required_field_validator('title_en', $title_en, lang('field required'));
        Validator::required_field_validator('title_ar', $title_ar, lang('field required'));

        $item = Orm_Sp_Values::get_instance($id);
        $item->set_strategy_id($strategy_id);
        $item->set_title_ar($title_ar);
        $item->set_title_en($title_en);
        $item->set_desc_ar($desc_ar);
        $item->set_desc_en($desc_en);

        if (Validator::success()) {
            $item->save();

            Validator::set_success_flash_message(lang('Value Successfully Saved'));
            json_response(array('error' => false));
        }
        $this->view_params['value'] = $item;
        json_response(array('error' => true, 'html' => $this->load->view('value/add_edit', $this->view_params, true)));
    }

    /**
     * this function delete
     * @redirect success or error
     */
    public function delete()
    {
        $id = (int)$this->input->get_post('id');
        $item = Orm_Sp_Values::get_instance($id);

        if ($item->get_id()) {
            $item->delete();
            Validator::set_success_flash_message(lang('Value removed successfully'));
        } else {
            Validator::set_error_flash_message(lang('Value not found'));
        }
    }

}