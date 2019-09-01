<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Recommendation
 * @property Layout $layout
 * @property CI_Input $input
 */
class Recommendation extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    /**
     * Recommendation constructor.
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
     * @return string the html view
     * default controller action
     */
    public function index()
    {
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        if (!$page) {
            $page = 1;
        }
        $filters = array();

        $recommendations = Orm_Sp_Recommendation::get_all($filters, $page, $per_page);
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Sp_Recommendation::get_count($filters));


        $this->view_params['recommendations'] = $recommendations;
        $this->view_params['pager'] = $pager->render(true);
        $this->load->view('recommendation/items', $this->view_params);
    }

    /**
     * this function add edit
     * @return string the html view
     */
    public function add_edit()
    {
        $id = (int)$this->input->get('id');
        $recommendation = Orm_Sp_Recommendation::get_instance($id);
        $this->view_params['recommendation'] = $recommendation;
        $this->load->view('recommendation/add_edit', $this->view_params);
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        $id = (int)$this->input->post('id');
        $type_id = $this->input->post('recommendation_type_id');
        $title_en = $this->input->post('title_en');
        $title_ar = $this->input->post('title_ar');
        $year = $this->input->post('academic_year');
        $program_id = $this->input->post('program_id');

        // validation
        Validator::required_field_validator('title_en', $title_ar, lang('Required Field'));
        Validator::required_field_validator('title_ar', $title_en, lang('Required Field'));
        Validator::required_field_validator('recommendation_type_id', $type_id, lang('Required Field'));
        Validator::required_field_validator('program_id', $program_id, lang('Required Field'));

        $rec = Orm_Sp_Recommendation::get_instance($id);
        $rec->set_recommendation_type_id($type_id);
        $rec->set_title_ar($title_ar);
        $rec->set_title_en($title_en);
        $rec->set_academic_year($year);
        $rec->set_program_id($program_id);

        if (Validator::success()) {
            $rec->save();
            Validator::set_success_flash_message(lang('Recommendation Saved Successfully'));
            json_response(array('error' => false));
        }

        $this->view_params['recommendation'] = $rec;
        json_response(array('error' => true, 'html' => $this->load->view('recommendation/add_edit', $this->view_params, true)));
    }

    /**
     * this function delete
     * @redirect success or error
     */
    public function delete()
    {
        $id = $this->input->get('id');
        $recommendation = Orm_Sp_Recommendation::get_instance($id);
        $recommendation->delete();
        Validator::set_success_flash_message(lang('Recommendation deleted successfully'));
    }
}