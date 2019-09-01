<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Lag_Kpi
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @property CI_Loader $load
 */
class Lag_Kpi extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();
    private $strategy;

    /**
     * Lag_Kpi constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!License::get_instance()->check_module('strategic_planning', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        Modules::load('kpi');

        $strategy_id = (int)$this->input->get_post('strategy_id');
        $this->strategy = Orm_Sp_Strategy::get_instance($strategy_id);

        $this->view_params['menu_tab'] = 'strategic_planning';
        $this->view_params['menu_header'] = '<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-sitemap page-header-icon"></i>&nbsp;&nbsp;' . lang('Strategic Planning') . '</h1></i>';
        $this->view_params['strategy'] = $this->strategy;
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

        $filters = array();

        if (!$page) {
            $page = 1;
        }

        $lag_kpis = Orm_Sp_Kpi::get_all($filters, $page, $per_page);
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Sp_Kpi::get_count($filters));

        $this->view_params['lag_kpis'] = $lag_kpis;
        $this->view_params['pager'] = $pager->render(true);
        $this->layout->view('lag_kpi/items', $this->view_params);
    }

    /**
     * this function add edit
     * @return string the html view
     */
    public function add_edit()
    {
        $id = $this->input->get('id');
        $lag_kpi = Orm_Sp_Kpi::get_instance($id);
        $this->view_params['lag_kpi'] = $lag_kpi;
        $this->load->view('lag_kpi/add_edit', $this->view_params);
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        $id = $this->input->post('id');
        $objective_id = $this->input->post('objective_id');
        $initiative_id = $this->input->post('initiative_id');
        $kpi_id = $this->input->post('kpi_id');

        // validation
        Validator::required_field_validator('objective_id', $objective_id, lang('Invalid Objective!'));
        Validator::required_field_validator('initiative_id', $initiative_id, lang('Invalid Initiative!'));
        Validator::required_field_validator('kpi_id', $kpi_id, lang('Invalid Kpi!'));

        $item = Orm_Sp_Kpi::get_instance($id);
        $item->set_type_id($initiative_id);
        $item->set_class_type($initiative_id ? 'Orm_Sp_Initiative' : 'Orm_Sp_Objective');
        $item->set_kpi_id($kpi_id);

        if (Validator::success()) {
            $item->save();
            Validator::set_success_flash_message(lang('Lag Kpi Successfully Saved'));
            json_response(array('error' => FALSE));
        }
        $this->view_params['lag_kpi'] = $item;
        $this->load->view('lag_kpi/add_edit', $this->view_params);
    }

    /**
     * this function delete
     * @redirect success or error
     */
    public function delete()
    {
        $id = $this->input->post('id');
        $item = Orm_Sp_Kpi::get_instance($id);
        if ($item->get_id()) {
            $item->delete();
        }
        Validator::set_success_flash_message(lang('Lag Kpi removed successfully'));
    }
    /**
     * this function indicators by its class type and id
     * @param string $class_type the class type of the show to be viewed
     * @param int $id the id of the show to be viewed
     * @return string the html view
     */
    public function indicators($class_type, $id)
    {
        $period_year = $this->input->get('period_year');

        $filter['year'] = $period_year;
        $this->view_params['filters'] = $filter;
        $this->view_params['class_type'] = $class_type;
        $this->view_params['id'] = $id;

        if (in_array($class_type, array('Orm_Sp_Objective', 'Orm_Sp_Initiative'))) {
            $indicators = Orm_Sp_Kpi::get_all(array('class_type' => $class_type, 'type_id' => $id));
            $this->view_params['indicators'] = $indicators;
            die($this->load->view('lag_kpi/show', $this->view_params, true));
        }
    }
    /**
     * this function indicators by its kpi id and strategy id
     * @param int $kpi_id the kpi id of the show to be viewed
     * @param int $strategy_id the strategy id of the show to be viewed
     * @return string the html view
     */
    public function get_kpi($kpi_id, $strategy_id) {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $kpi = Orm_Kpi::get_instance($kpi_id);
        $strategy = Orm_Sp_Strategy::get_instance($strategy_id);
        $filters = array('academic_year' => Orm_Semester::get_active_semester()->get_year());

        switch ($strategy->get_item_class()) {
            case 'Orm_Sp_Strategy_Institution':
                $kpi_type = Orm_Kpi_Detail::TYPE_INSTITUTION;
                break;
            case 'Orm_Sp_Strategy_College':
                $kpi_type = Orm_Kpi_Detail::TYPE_COLLEGE;
                $filters['college_id'] = $strategy->get_item_id();
                break;
            case 'Orm_Sp_Strategy_Program':
                $filters['program_id'] = $strategy->get_item_id();
                $kpi_type = Orm_Kpi_Detail::TYPE_PROGRAM;
                break;
            default:
                $kpi_type = Orm_Kpi_Detail::TYPE_INSTITUTION;
                break;
        }

        $info = $kpi->get_info($kpi_type, $filters);

        json_response($info);
    }

    /**
     * this function get kpi levels by its kpi id and sp kpi
     * @param int $kpi_id the kpi id of the show to be viewed
     * @param int $sp_kpi the sp kpi of the show to be viewed
     * @return string the html view
     */
    public function get_kpi_levels($kpi_id, $sp_kpi) {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        echo Orm_Sp_Kpi::get_instance($sp_kpi)->draw_bands($kpi_id);
    }

    /**
     * this function add edit kpi
     * @redirect success or error
     */
    public function add_edit_kpi()
    {
        $id = (int)$this->input->get('id');
        $type_id = (int)$this->input->get('type_id');
        $class_type = $this->input->get('class_type');

        if(!$type_id){
            json_response(array('error' => true, 'message' => lang('Objective not found')));
        }

        if (!in_array($class_type,array('Orm_Sp_Objective', 'Orm_Sp_Initiative'))) {
            $class_type = 'Orm_Sp_Objective';
        }

        $sp_kpi = Orm_Sp_Kpi::get_instance($id);
        if (!$sp_kpi->get_id()) {
            $sp_kpi->set_type_id($type_id);
            $sp_kpi->set_class_type($class_type);
        }
        
        $this->view_params['sp_kpi'] = $sp_kpi;
        $this->load->view('lag_kpi/select_kpi', $this->view_params);
    }

    /**
     * this function remove kpi
     * @redirect success or error
     */
    public function remove_kpi()
    {
        $id = $this->input->get('id');
        $sp_kpi = Orm_Sp_Kpi::get_instance($id);

        if($sp_kpi->get_id()) {
            $sp_kpi->delete();
        }

        json_response(array('error' => false));
    }

    /**
     * this function save kpi
     * @redirect success or error
     */
    public function save_kpi()
    {
        $id = (int)$this->input->post('id');
        $kpi_id = $this->input->post('kpi_id');
        $type_id = $this->input->post('type_id');
        $polarity = (int)$this->input->post('polarity');
        $band = (int)$this->input->post('band');
        $class_type = $this->input->post('class_type');

        if (!in_array($class_type,array('Orm_Sp_Objective', 'Orm_Sp_Initiative'))) {
            $class_type = 'Orm_Sp_Objective';
        }

        // validation
        Validator::not_empty_field_validator('type_id', $type_id, lang('Required Field'));
        Validator::not_empty_field_validator('kpi_id', $kpi_id, lang('Required Field'));
        Validator::not_empty_field_validator('band', $band, lang('Levels not defined or not selected'));

        $sp_kpi = Orm_Sp_Kpi::get_one(array('class_type' => $class_type, 'type_id' => $type_id, 'kpi_id' => $kpi_id, 'not_id' => $id));
        if($sp_kpi->get_id()) {
            Validator::set_error('kpi_id', lang('you are already added this KPI!'));
        }

        $item = Orm_Sp_Kpi::get_instance($id);
        $item->set_kpi_id($kpi_id);
        $item->set_type_id($type_id);
        $item->set_class_type($class_type);
        $item->set_polarity($polarity);
        $item->set_band($band);

        if (Validator::success()) {
            $item->save();

            Validator::set_success_flash_message(lang('KPI Successfully Saved'));
            json_response(array('error' => false));
        }

        $this->view_params['sp_kpi'] = $item;
        json_response(array('error' => true, 'html' => $this->load->view('lag_kpi/select_kpi', $this->view_params, true)));
    }

    /**
     * this function search kpi
     * @return string the html view
     */
    public function search_kpi()
    {
        $category_id = (int)$this->input->get_post('id');
        $filters = array('category_id' => $category_id);
        switch ($this->strategy->get_item_class()) {
            case 'Orm_Sp_College_Strategy' :
                $filters['college_id'] = $this->strategy->get_item_id();
                break;
            case 'Orm_Sp_Program_Strategy' :
                $filters['college_id'] = Orm_Program::get_instance($this->strategy->get_item_id())->get_department_obj()->get_college_id();
                break;
            default:
                $filters['college_id'] = 0;
                break;

        }
        $KPIs = Orm_Kpi::get_all($filters);
        $result = array();

        foreach ($KPIs as $kpi) {
            $result[] = array('id' => $kpi->get_id(), 'title' => $kpi->get_code() . '.' . substr($kpi->get_title(), 0, 100) . '...');
        }

        json_response(array('result' => $result));
    }
}
