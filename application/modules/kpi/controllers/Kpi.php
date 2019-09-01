<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Layout $layout
 * @property Breadcrumbs breadcrumbs
 * @property Orm_User_Faculty | Orm_User_Staff $user
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Kpi
 */
class Kpi extends MX_Controller
{

    /**
     * @var $view_params (array) => the array pf data that will send to views
     * @var user  => user data
     * @var category => type of KPI  (Accreditation KPI  or Strategic KPI )
     */

    private $user;
    private $view_params;
    private $category;


    /**
     * Kpi constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('kpi', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->user = Orm_User::get_logged_user();
        $this->category = $this->input->get_post('c');
    }

    /**
     * Initial function contain all libraries that must run before calling the main page
     */
    private function init()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-list');

        switch ($this->category) {
            case Orm_Kpi::KPI_STRATEGIC :
                $this->view_params['category'] = Orm_Kpi::KPI_STRATEGIC;
                $this->category = Orm_Kpi::KPI_STRATEGIC;
                break;
            DEFAULT:
                $this->view_params['category'] = Orm_Kpi::KPI_ACCREDITATION;
                $this->category = Orm_Kpi::KPI_ACCREDITATION;
                break;
        }

        $this->layout->add_javascript('https://www.google.com/jsapi', false);
        $this->layout->add_javascript('/assets/jadeer/js/jstree/jstree.min.js');
        $this->layout->add_stylesheet('/assets/jadeer/js/jstree/themes/proton/style.min.css');

        $this->view_params['menu_tab'] = 'kpi';
        $this->view_params['menu_header'] = '<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-key page-header-icon"></i>&nbsp;&nbsp;' . lang('KPIS') . '</h1></i>';

        if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'title' => lang('KPIS'),
                'icon' => 'fa fa-key',
                'link_attr' => 'data-toggle="ajaxModal" href="/kpi/create/?c=' . intval($this->category) . '"',
                'link_icon' => 'plus',
                'link_title' => lang('Create') . ' ' . lang('KPIs'),
                'menu_view' => 'kpi/kpi/sub_menu',
                'menu_params' => array('category' => $this->category)
            ), true);
        } else {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'title' => lang('KPIS'),
                'icon' => 'fa fa-key'
            ), true);
        }
    }


    /**
     * call the  main Page and show all data on
     */
    public function index()
    {
        $this->items();

    }


    /**
     * get the nesseccary data that will appear in main page
     */
    public function items()
    {

        $this->init();

        $per_page = (int)$this->input->get('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page || $page < 1) {
            $page = 1;
        }
        if (!$per_page || $per_page < 1) {
            $per_page = 10;
        }

        $search = $this->input->get('s');

        $this->view_params['keyword'] = $search;

        $filters = array('category_id' => $this->category, 'search' => $search);
        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Staff::class && $this->user->get_role_obj()->get_admin_level() != Orm_Role::ROLE_INSTITUTION_ADMIN) {
            $filters['unit_id'] = Orm_User::get_logged_user()->get_unit_obj()->get_id();
        }
        if ($this->user->get_role_obj()->get_admin_level() != Orm_Role::ROLE_INSTITUTION_ADMIN) {
            $filters['college_id'] = $this->user->get_college_id();
        } else {
            $filters['college_id'] = 0;
        }
        $items = Orm_Kpi::get_all($filters, $page, $per_page);

        if (!is_null($this->user->get_institution_role()) && $this->user->get_institution_role() == Orm_Role::ROLE_INSTITUTION_ADMIN) {

            $college_per_page = (int)$this->input->get('per_page');
            $college_page = (int)$this->input->get_post('college_page');
            $college_id = (int)$this->input->get('college_id');
            $college_search = $this->input->get('cs');

            if (!$college_page || $college_page < 1) {
                $college_page = 1;
            }
            if (!$college_per_page || $college_per_page < 1) {
                $college_per_page = 10;
            }

            $college_filter = array('category_id' => $this->category, 'search' => $college_search, 'only_college_id' => $college_id);

            $college_items = array();
            $rendered_pager = '';
            if ($college_id) {
                $college_items = Orm_Kpi::get_all($college_filter, $college_page, $college_per_page);

                $pager_college = new Pager(array('url' => $this->input->server('REQUEST_URI'), 'page_label' => 'college_page'));
                $pager_college->set_page($college_page);
                $pager_college->set_per_page($college_per_page);
                $pager_college->set_total_count(Orm_Kpi::get_count($college_filter));
                $rendered_pager = $pager_college->render(true);
            }
            $this->view_params['college_keyword'] = $college_search;
            $this->view_params['college_pager'] = $rendered_pager;
            $this->view_params['college_items'] = $college_items;
            $this->view_params['college_id'] = $college_id;

        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Kpi::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['title'] = Orm_Kpi::get_category_by_id($this->category);
        $this->view_params['items'] = $items;

        $this->breadcrumbs->push(lang('KPI'), '/kpi');
        $this->breadcrumbs->push(lang(Orm_Kpi::get_category_by_id($this->category)), '/kpi?c=' . $this->category);
        $this->layout->add_javascript('/assets/jadeer/js/unit.selector.js');
        $this->layout->view('kpi/kpi/items', $this->view_params);
    }

    /**
     * add new KPI for the system
     */
    public function create()
    {

        $this->init();

        $id = $this->input->get('id');

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-manage');

        if (in_array($this->user->get_role_obj()->get_admin_level(), array(Orm_Role::ROLE_COLLEGE_ADMIN, Orm_Role::ROLE_INSTITUTION_ADMIN))) {

            if (($this->category != Orm_Kpi::KPI_ACCREDITATION) && $this->user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_COLLEGE_ADMIN) {
                Validator::set_error_flash_message(lang('Error: Permission Denied!'));
                exit('<script>window.location.reload();</script>');
            }
            $KPI = Orm_Kpi::get_instance($id);

            $this->view_params['kpi'] = $KPI;
            $this->view_params['user'] = $this->user;
            $this->view_params['category'] = $this->category;

            if ($KPI->get_kpi_type() == Orm_Kpi::KPI_QUANTITATIVE) {
                $this->view_params['parameters'] = Orm_Kpi_Legend::get_all(array('kpi_id' => $KPI->get_id()));
            } else {
                $this->view_params['parameters'] = array();
            }

            $this->load->view('kpi/kpi/create', $this->view_params);

        } else {

            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            exit('<script>window.location.reload();</script>');
        }
    }

    /**
     * save KPI to the system
     * @redirect success or error
     */
    public function save_kpi()
    {

        $this->init();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if ($this->category == Orm_Kpi::KPI_ACCREDITATION && !in_array($this->user->get_role_obj()->get_admin_level(), array(Orm_Role::ROLE_COLLEGE_ADMIN, Orm_Role::ROLE_INSTITUTION_ADMIN))) {
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            json_response(array('status' => false, 'html' => '<script>location.href="/kpi";</script>'));
        }

        $id = $this->input->post('id');
        $college = $this->input->post('college');
        $unit = $this->input->post('unit');
        $standard_id = $this->input->post('standard');
        $title = $this->input->post('kpi_desc');
        $type = $this->input->post('kpi_type');
        $code = $this->input->post('code');
        $label = $this->input->post('kpi_label');
        $ncaaa = $this->input->post('ncaaa');
        $is_semester = $this->input->post('is_semester');
        $overall_allowed = $this->input->post('overall');
        $parameters = $this->input->post('parameters');
        $parameters_ids = (array)$this->input->post('parameters_ids');
        $category = $this->input->post('c');

        if (empty($parameters) || !is_array($parameters)) {
            $parameters = array();
        }
        if (empty($parameters_ids) || !is_array($parameters_ids)) {
            $parameters_ids = array();
        }

        if ($this->user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_COLLEGE_ADMIN) {
            $college = $this->user->get_college_id();
        }

        $kpi = Orm_Kpi::get_instance($id);

        if ($kpi->get_id()) {
            $type = $kpi->get_kpi_type();
        }

        $kpi->set_college_id($college);
        $kpi->set_criteria_id($college ? Orm_Criteria::get_one(array('standard_id' => $standard_id, 'type' => Orm_Criteria::CRITERIA_COLLEGE_KPI))->get_id() : Orm_Criteria::get_one(array('standard_id' => $standard_id, 'type' => Orm_Criteria::CRITERIA_INSTITUTION_KPI))->get_id());
        $kpi->set_title($title);
        $kpi->set_code($code);
        $kpi->set_unit_id($unit);
        $kpi->set_chart_y_title($label);
        $kpi->set_created_by($this->user->get_id());
        $kpi->set_is_semester($is_semester);
        $kpi->set_category_id($category);
        $kpi->set_ncaaa($ncaaa);
        $kpi->set_overall($type == Orm_Kpi::KPI_QUALITATIVE ? 1 : $overall_allowed);
        $kpi->set_kpi_type($type);

        Validator::required_field_validator('kpi_desc', $title, lang('Error: This field is required'));
        Validator::required_field_validator('unit', $unit, lang('Error: This field is required'));
        Validator::required_field_validator('code', $code, lang('Error: This field is required & should be a number'));
        Validator::required_field_validator('kpi_label', $label, lang('Error: This field is required'));
        Validator::required_field_validator('kpi_type', $type, lang('Error: This field is required'));
        Validator::in_array_validator('kpi_type', $type, array(Orm_Kpi::KPI_QUANTITATIVE, Orm_Kpi::KPI_QUALITATIVE), lang('Error: This field has invalid value'));

        if ($type == Orm_Kpi::KPI_QUANTITATIVE) {
            foreach ($parameters as $parameter) {
                Validator::required_field_validator('parameters', $parameter, lang('Error: This field is required at least one parameter'));
            }
        }

        if (Validator::success()) {
            $kpi->save($standard_id);

            if ($type == Orm_Kpi::KPI_QUANTITATIVE) {

                $level = Orm_Kpi_Level::get_one(array('kpi_id' => $kpi->get_id()));

                if (!$level->get_id()) {
                    $level->set_kpi_id($kpi->get_id());
                    $level->set_level(time());
                    $level->save();
                }

                foreach ($parameters as $key => $parameter) {
                    $legend = Orm_Kpi_Legend::get_instance($parameters_ids[$key]);
                    $legend->set_title($parameter);
                    $legend->set_level_id($level->get_id());
                    $legend->save();
                }

                Validator::set_success_flash_message(lang('KPI Saved Successfully'));

                json_response(array('error' => false));

            } else {

                if (License::get_instance()->check_module('survey')) {
                    Modules::load('survey');
                    $this->view_params['kpi'] = $kpi;
                    //Find the survey
                    json_response(array('error' => true, 'html' => $this->load->view('kpi/kpi/create_step_2', $this->view_params, true)));
                } else {
                    json_response(array('error' => false));
                }
            }
        }

        $this->view_params['kpi'] = $kpi;
        $this->view_params['parameters'] = Orm_Kpi_Legend::get_all(array('kpi_id' => $kpi->get_id()));
        $this->view_params['user'] = $this->user;
        $this->view_params['category'] = $this->category;
        json_response(array('error' => true, 'html' => $this->load->view('kpi/kpi/create', $this->view_params, true)));
    }

    /**
     * if the Type of KPI is Qualitative thats mean it will mapped with a survey
     * so this function will save the new relation between KPI and Survey
     * @redirect success or error
     */
    public function save_step_2()
    {

        if (!License::get_instance()->check_module('survey')) {
            Validator::set_error_flash_message(lang('Permission Denied'));
            json_response(array('status' => false, 'html' => '<script>location.href="/kpi";</script>'));
        } else {
            Modules::load('survey');
        }

        $this->init();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if ($this->category == Orm_Kpi::KPI_ACCREDITATION && !in_array($this->user->get_role_obj()->get_admin_level(), array(Orm_Role::ROLE_COLLEGE_ADMIN, Orm_Role::ROLE_INSTITUTION_ADMIN))) {
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            json_response(array('status' => false, 'html' => '<script>location.href="/kpi";</script>'));
        }
        $kpi_id = $this->input->post('id');
        $selected_items = $this->input->post('selected_items');
        $items = json_decode($selected_items);
        $statements = array(0);

        $levels = Orm_Kpi_Level::get_all(array('kpi_id' => $kpi_id));
        $stakeholders = array('0');
        $legends = array('0');

        foreach ($levels as $level) {
            $stakeholders[$level->get_id()] = $level->get_id();
            $legends_objects = Orm_Kpi_Legend::get_all(array('level_id' => $level->get_id()));
            foreach ($legends_objects as $object) {
                $legends[$object->get_id()] = $object->get_id();
            }
        }

        foreach ($items as $item) {
            $row = explode('_', $item);
            if (isset($row[1]) && is_numeric($row[1]) && isset($row['3']) && is_numeric($row[3]) && isset($row['5']) && is_numeric($row[5])) {
                $obj = Orm_Kpi_Survey::get_one(array('kpi_id' => $kpi_id, 'survey_id' => $row[1], 'factor_id' => $row[3], 'statement_id' => $row[5]));
                if (!$obj->get_id()) {
                    $obj->set_kpi_id($kpi_id);
                    $obj->set_survey_id($row[1]);
                    $obj->set_factor_id($row[3]);
                    $obj->set_statement_id($row[5]);
                    $obj->save();
                }
                $survey = Orm_Survey::get_instance($row[1]);
                $kpi_stakeholder = Orm_Kpi_Level::get_one(array('kpi_id' => $kpi_id, 'level' => $survey->get_type(true)));
                if (!$kpi_stakeholder->get_id()) {
                    $kpi_stakeholder->set_kpi_id($kpi_id);
                    $kpi_stakeholder->set_level($survey->get_type(true));
                    $kpi_stakeholder->save();
                }

                $factor = Orm_Survey_Question_Factor::get_instance($row['3']);
                $stakeholders[$kpi_stakeholder->get_id()] = 0;
                $kpi_legend = Orm_Kpi_Legend::get_one(array('level_id' => $kpi_stakeholder->get_id(), 'title' => $factor->get_report_title()));
                if (!$kpi_legend->get_id()) {
                    $kpi_legend->set_level_id($kpi_stakeholder->get_id());
                    $kpi_legend->set_title($factor->get_report_title());
                    $kpi_legend->save();
                }
                $legends[$kpi_legend->get_id()] = 0;
                $statements[] = $row[5];
            }
        }
        Orm_Kpi_Survey::delete_all(array('kpi_id' => $kpi_id, 'statement_not_in' => $statements));
        Orm_Kpi_Legend::delete_all(array('id_in' => $legends));
        Orm_Kpi_Level::delete_all(array('id_in' => $stakeholders));

        Validator::set_success_flash_message(lang('KPI Saved Successfully'));

        json_response(array('error' => 0, 'html' => ''));
    }

    /**
     * show the 5 benchmarks Values (Actual/Target/College/Institution/New Benchmark)
     */
    public function values()
    {

        $this->init();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-values');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if ($this->category == Orm_Kpi::KPI_ACCREDITATION && in_array($this->user->get_role_obj()->get_admin_level(), array(Orm_Role::ROLE_NOT_ADMIN))) {
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            json_response(array('status' => false, 'html' => '<script>location.href="/kpi";</script>'));
        }

        $id = $this->input->get('kpi_id');
        $college_id = $this->input->get('college_id');
        $program_id = $this->input->get('program_id');
        $this->view_params['kpi'] = Orm_Kpi::get_instance($id);
        $fltr = array('college_id' => $college_id, 'program_id' => $program_id);

        $this->view_params['fltr'] = $fltr;

        if ($program_id) {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_PROGRAM;
        } elseif ($college_id) {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_COLLEGE;
        } else {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_INSTITUTION;
        }

        $this->load->view('kpi/kpi/kpi_values', $this->view_params);
    }

    /**
     * details function will show the details of KPI as chart and table of values
     */
    public function details()
    {

        $this->init();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-report');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $id = $this->input->get('kpi_id');
        $college_id = $this->input->get('college_id');
        $program_id = $this->input->get('program_id');
        $fltr = array('college_id' => $college_id, 'program_id' => $program_id);
        $fltr['is_modal'] = true;
        $kpi = Orm_Kpi::get_instance($id);
        $this->view_params['kpi'] = $kpi;

        if ($kpi->get_is_semester()) {
            $fltr['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        } else {
            $fltr['academic_year'] = Orm_Semester::get_active_semester()->get_year();
        }

        $this->view_params['fltr'] = $fltr;
        if ($program_id) {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_PROGRAM;
        } elseif ($college_id) {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_COLLEGE;
        } else {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_INSTITUTION;
        }
        $this->load->view('kpi/kpi/kpi_details', $this->view_params);
    }

    /**
     * trend_analysis will show the progress and difference for the calues of benchmark in several years
     */
    public function trend_analysis()
    {

        $this->init();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-report');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $id = $this->input->get('kpi_id');
        $college_id = $this->input->get('college_id');
        $program_id = $this->input->get('program_id');
        $fltr = array('college_id' => $college_id, 'program_id' => $program_id);
        $kpi = Orm_Kpi::get_instance($id);
        $this->view_params['kpi'] = $kpi;
        $this->view_params['fltr'] = $fltr;
        if ($program_id) {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_PROGRAM;
        } elseif ($college_id) {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_COLLEGE;
        } else {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_INSTITUTION;
        }
        $this->load->view('kpi/kpi/trend_analysis', $this->view_params);
    }

    /**
     * remove_legend this function use for remove the legend that added to quantitative KPIs
     */
    public function remove_legend()
    {

        $this->init();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY)) || !in_array($this->user->get_role_obj()->get_admin_level(), array(Orm_Role::ROLE_COLLEGE_ADMIN, Orm_Role::ROLE_INSTITUTION_ADMIN))) {
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            json_response(array('status' => false, 'html' => '<script>location.href="/kpi";</script>'));
        }

        $id = $this->input->get('id');
        $legend = Orm_Kpi_Legend::get_instance($id);
        $legend->delete();
        json_response(array('status' => true));
    }

    /**
     * remove delete the kpi and all details that are mapped to it from system
     */
    public function remove()
    {

        $this->init();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!in_array($this->user->get_role_obj()->get_admin_level(), array(Orm_Role::ROLE_COLLEGE_ADMIN, Orm_Role::ROLE_INSTITUTION_ADMIN))) {
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            json_response(array('status' => false, 'html' => '<script>window.location="/kpi";</script>'));
        }

        $id = $this->input->get('id');
        $kpi = Orm_Kpi::get_instance($id);
        if (
            ($kpi->get_college_id() &&
                (
                    $this->user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_INSTITUTION_ADMIN ||
                    ($this->user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_COLLEGE_ADMIN && $kpi->get_college_id() == $this->user->get_college_id())
                )
            ) ||
            (!$kpi->get_college_id() && $this->user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_INSTITUTION_ADMIN)
        ) {
            $kpi->delete();
        }
        Validator::set_success_flash_message(lang('KPI Removed Successfully'));
        json_response(array('status' => true));
    }

    /**
     * save the values of benchmark related to KPI
     * @redirect success or error
     */
    public function save_values()
    {

        $this->init();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-values');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY)) || in_array($this->user->get_role_obj()->get_admin_level(), array(Orm_Role::ROLE_NOT_ADMIN))) {
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            json_response(array('status' => false, 'html' => '<script>location.href="/kpi";</script>'));
        }

        $id = $this->input->post('id');
        $college_id = $this->input->post('college_id');
        $program_id = $this->input->post('program_id');
        $type = $this->input->post('kpi_type');
        $new_benchmarks = (array)$this->input->post('new_benchmark');
        $internal_college_benchmarks = (array)$this->input->post('internal_college_benchmark');
        $internal_institution_benchmarks = (array)$this->input->post('internal_institution_benchmark');
        $actual_benchmarks = (array)$this->input->post('actual_benchmark');
        $target_benchmarks = (array)$this->input->post('target_benchmark');
        $external_titles = $this->input->post('external_title');
        if (empty($external_titles) || !is_array($external_titles)) {
            $external_titles = array();
        }

        $kpi = Orm_Kpi::get_instance($id);

        foreach ($actual_benchmarks as $legend => $actual_benchmark) {
            $legend_obj = Orm_Kpi_Legend::get_instance($legend);
            if ($kpi->get_is_semester()) {
                $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend, 'semester_id' => Orm_Semester::get_active_semester()->get_id()));
            } else {
                $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend, 'academic_year' => Orm_Semester::get_active_semester()->get_year()));
            }
            if (!$detail->get_id()) {
                $detail->set_legend_id($legend);
                $detail->set_semester_id(Orm_Semester::get_active_semester()->get_id());
                $detail->save();
            }
            switch ($type) {
                case Orm_Kpi_Detail::TYPE_PROGRAM:
                    $row = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $program_id));
                    $row->set_detail_id($detail->get_id());
                    $row->set_program_id($program_id);
                    $row->set_actual_benchmark($actual_benchmark);
                    $row->set_target_benchmark($target_benchmarks[$legend]);
                    $row->set_new_benchmark($new_benchmarks[$legend]);
                    $row->set_internal_college_benchmark($internal_college_benchmarks[$legend]);
                    $row->set_internal_institution_benchmark($internal_institution_benchmarks[$legend]);
                    $external_benchmarks = array();
                    if (!empty($external_titles[$legend_obj->get_level_id()])) {
                        $titles = $external_titles[$legend_obj->get_level_id()];
                        $value = $this->input->post('external_values_' . $legend);
                        if ($value) {
                            foreach ($titles as $key => $external_title) {
                                $external_benchmarks[$external_title] = isset($value[$key]) ? $value[$key] : 0;
                            }
                        }
                    }
                    $row->set_external_benchmark(json_encode($external_benchmarks));
                    $row->save();
                    break;
                case Orm_Kpi_Detail::TYPE_COLLEGE:
                    $row = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $college_id));
                    $row->set_detail_id($detail->get_id());
                    $row->set_college_id($college_id);
                    $row->set_actual_benchmark($actual_benchmark);
                    $row->set_target_benchmark($target_benchmarks[$legend]);
                    $row->set_new_benchmark($new_benchmarks[$legend]);
                    $row->set_internal_college_benchmark($internal_college_benchmarks[$legend]);
                    $row->set_internal_institution_benchmark($internal_institution_benchmarks[$legend]);
                    $external_benchmarks = array();
                    if (!empty($external_titles[$legend_obj->get_level_id()])) {
                        $titles = $external_titles[$legend_obj->get_level_id()];
                        $value = $this->input->post('external_values_' . $legend);
                        if ($value) {
                            foreach ($titles as $key => $external_title) {
                                $external_benchmarks[$external_title] = isset($value[$key]) ? $value[$key] : 0;
                            }
                        }
                    }
                    $row->set_external_benchmark(json_encode($external_benchmarks));
                    $row->save();
                    break;
                default:
                    $row = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
                    $row->set_detail_id($detail->get_id());
                    $row->set_actual_benchmark($actual_benchmark);
                    $row->set_target_benchmark($target_benchmarks[$legend]);
                    $row->set_new_benchmark($new_benchmarks[$legend]);
                    $row->set_internal_college_benchmark($internal_college_benchmarks[$legend]);
                    $row->set_internal_institution_benchmark($internal_institution_benchmarks[$legend]);
                    $external_benchmarks = array();
                    if (!empty($external_titles[$legend_obj->get_level_id()])) {
                        $titles = $external_titles[$legend_obj->get_level_id()];
                        $value = $this->input->post('external_values_' . $legend);
                        if ($value) {
                            foreach ($titles as $key => $external_title) {
                                $external_benchmarks[$external_title] = isset($value[$key]) ? $value[$key] : 0;
                            }
                        }
                    }
                    $row->set_external_benchmark(json_encode($external_benchmarks));
                    $row->save();
                    break;
            }
        }
        json_response(array('error' => false));
    }

    /**
     * get all data for kpi in pdf file
     */
    public function pdf()
    {

        $this->init();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-report');

        $id = $this->input->get('id');
        $college_id = $this->input->get('college_id');
        $program_id = $this->input->get('program_id');
        $kpi = Orm_Kpi::get_instance($id);
        $export_type = $this->input->get('t');
        $fltr['program_id'] = $program_id;
        $fltr['college_id'] = $college_id;
        $fltr['is_report'] = true;
        if (isset($fltr['program_id']) && $fltr['program_id']) {
            $type = Orm_Kpi_Detail::TYPE_PROGRAM;
        } elseif (isset($fltr['college_id']) && $fltr['college_id']) {
            $type = Orm_Kpi_Detail::TYPE_COLLEGE;
        } else {
            $type = Orm_Kpi_Detail::TYPE_INSTITUTION;
        }
        if ($kpi->get_is_semester()) {
            $fltr['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        } else {
            $fltr['academic_year'] = Orm_Semester::get_active_semester()->get_year();
        }
        $kpi->generate_pdf($type, ['fltr' => $fltr], $export_type);
    }

    /**
     * get the data of kpi and chart of value as image
     */
    public function image()
    {

        $this->init();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-report');

        $id = $this->input->get('id');
        $college_id = $this->input->get('college_id');
        $program_id = $this->input->get('program_id');
        $kpi = Orm_Kpi::get_instance($id);
        $export_type = $this->input->get('t');
        $fltr['program_id'] = $program_id;
        $fltr['college_id'] = $college_id;
        $fltr['is_report'] = true;
        if (isset($fltr['program_id']) && $fltr['program_id']) {
            $type = Orm_Kpi_Detail::TYPE_PROGRAM;
        } elseif (isset($fltr['college_id']) && $fltr['college_id']) {
            $type = Orm_Kpi_Detail::TYPE_COLLEGE;
        } else {
            $type = Orm_Kpi_Detail::TYPE_INSTITUTION;
        }
        if ($kpi->get_is_semester()) {
            $fltr['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        } else {
            $fltr['academic_year'] = Orm_Semester::get_active_semester()->get_year();
        }
        $kpi->generate_image($type, $fltr, $export_type);
    }

    /**
     * show all information that are need to add or updates for KPI
     */
    public function view()
    {

        $this->init();

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-list');

        $id = $this->input->get('id');
        $kpi_obj = Orm_Kpi::get_instance($id);

        $fltr = $this->input->get_post('fltr');
        if (!is_array($fltr)) {
            $fltr = array();
        }
        if ($this->user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_PROGRAM_ADMIN) {
            $fltr['program_id'] = $this->user->get_program_id();
            $fltr['college_id'] = $this->user->get_college_id();
        } elseif ($this->user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_COLLEGE_ADMIN) {
            $fltr['college_id'] = $this->user->get_college_id();
        }

        if ($kpi_obj->get_college_id()) {
            $this->view_params['college_id'] = $kpi_obj->get_college_id();
            $fltr['college_id'] = $kpi_obj->get_college_id();
        }

        $this->view_params['kpi'] = $kpi_obj;
        if (isset($fltr['program_id']) && $fltr['program_id']) {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_PROGRAM;
        } elseif (isset($fltr['college_id']) && $fltr['college_id']) {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_COLLEGE;
        } else {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_INSTITUTION;
        }
        $fltr = array_merge($fltr, $this->user->get_array_filter());
        if ($kpi_obj->get_is_semester()) {
            $fltr['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        } else {
            $fltr['academic_year'] = Orm_Semester::get_active_semester()->get_year();
        }
        switch ($kpi_obj->get_category_id()) {
            case Orm_Kpi::KPI_STRATEGIC :
                $this->view_params['category'] = Orm_Kpi::KPI_STRATEGIC;
                $this->category = Orm_Kpi::KPI_STRATEGIC;
                break;
            DEFAULT:
                $this->view_params['category'] = Orm_Kpi::KPI_ACCREDITATION;
                $this->category = Orm_Kpi::KPI_ACCREDITATION;
                break;
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('KPIS') . ' - ' . lang('Reports'),
            'icon' => 'fa fa-key',
            'menu_view' => 'kpi/kpi/sub_menu',
            'menu_params' => array('category' => $this->category)
        ), true);
        $this->view_params['fltr'] = $fltr;
        $this->breadcrumbs->push(lang('KPIS'), '/kpi');
        $this->breadcrumbs->push(lang(Orm_Kpi::get_category_by_id($kpi_obj->get_category_id())), '/kpi?c=' . $kpi_obj->get_category_id());
        $this->breadcrumbs->push(lang('kpi'), '/kpi/view/?id=' . $kpi_obj->get_id());
        $this->layout->view('kpi/kpi/view', $this->view_params);
    }

    /**
     * this function will use for show that data of benchmark that added to KPIk the following Parameter are Important for it
     * @param int $type => type of report to show the view (these are the name of folders in report )
     * @param string $sub_type => the name of report that are added in files  (name of file in specific folders)
     */
    public function benchmarks($type = Orm_Kpi::KPI_TYPE_ONE_REPORT, $sub_type = 'trend')
    {
        $this->init();
        if (!in_array($sub_type, array('trend', 'colleges', 'programs'))) {
            $sub_type = 'trend';
        }
        switch ($type) {
            case Orm_Kpi::KPI_TYPE_ONE_REPORT:
                $view = 'type_one';
                break;
            case Orm_Kpi::KPI_TYPE_TWO_REPORT:
                $view = 'type_two';
                break;
            case Orm_Kpi::KPI_TYPE_THREE_REPORT:
                $view = 'type_three';
                break;
            case Orm_Kpi::KPI_TYPE_FOUR_REPORT:
                $view = 'type_four';
                break;
            case Orm_Kpi::KPI_TYPE_FIVE_REPORT:
                $view = 'type_five';
                break;
            default:
                $view = 'type_one';
                break;
        }
        $filters = $this->input->get('fltr');
        if (isset($filters['college_id'])) {
            $sub_type = 'programs';
        }
        $this->view_params['category'] = Orm_Kpi::KPI_REPORTS;
        $this->view_params['fltr'] = $filters;
        $this->layout->view("kpi/reports/{$view}/{$sub_type}", $this->view_params);
    }

    /**
     * get kpi report with specific date depends on parameter that send
     * @param int $type =>type of report
     * @param int $is_pdf => check if need to download as pdf or not if $is_pdf = true thei it will download else will show as view
     * @param int $is_strategic => check if the type of the KPI accreditation or strategic
     */
    public function report($type = Orm_Kpi::KPI_LIST_REPORT_HISTORICAL, $is_pdf = 0, $is_strategic = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-report');

        $fltr = $this->input->get('fltr');
        if (!is_array($fltr)) {
            $fltr = array();
        }

        $this->category = Orm_Kpi::KPI_REPORTS;

        $this->view_params['is_strategic'] = $is_strategic;
        if ($this->user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_PROGRAM_ADMIN) {
            $fltr['program_id'] = $this->user->get_program_id();
            $fltr['college_id'] = $this->user->get_college_id();
        } elseif ($this->user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_COLLEGE_ADMIN) {
            $fltr['college_id'] = $this->user->get_college_id();
        }

        if (isset($fltr['program_id']) && $fltr['program_id']) {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_PROGRAM;
        } elseif (isset($fltr['college_id']) && $fltr['college_id']) {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_COLLEGE;
        } else {
            $this->view_params['type'] = Orm_Kpi_Detail::TYPE_INSTITUTION;
        }
        $fltr = array_merge($fltr, $this->user->get_array_filter());

        switch ($type) {
            case Orm_Kpi::KPI_LIST_REPORT_DETAILS:
                $view = 'details';
                break;
            case Orm_Kpi::KPI_LIST_REPORT_HISTORICAL:
                $view = 'trend';
                break;
            case Orm_Kpi::KPI_LIST_REPORT_NORMAL:
                $view = 'benchmarks';
                break;
            default :
                $view = 'trend';
                break;
        }
        $this->view_params['fltr'] = $fltr;
        if (!in_array($type, array(Orm_Kpi::KPI_LIST_REPORT_DETAILS, Orm_Kpi::KPI_LIST_REPORT_NORMAL, Orm_Kpi::KPI_LIST_REPORT_HISTORICAL))) {
            $type = Orm_Kpi::KPI_LIST_REPORT_HISTORICAL;
        }
        if (!$is_pdf) {
            $this->view_params['menu_tab'] = 'kpi';

            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'title' => lang('KPIS') . ' - ' . lang('Reports'),
                'icon' => 'fa fa-key',
                'menu_view' => 'kpi/kpi/sub_menu',
                'menu_params' => array('category' => $this->category)
            ), true);
            $this->view_params['menu_header'] = '<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-key page-header-icon"></i>&nbsp;&nbsp;' . lang('KPIS') . '</h1></i>';

            $this->view_params['category'] = Orm_Kpi::KPI_REPORTS;

            $this->breadcrumbs->push(lang('KPIS'), '/kpi');
            $this->breadcrumbs->push(lang('Reports'), '/kpi/reports');
            $this->breadcrumbs->push(lang(ucfirst($view) . ' Report'), '/kpi/report/' . $type);

            $this->layout->view('reports/' . $view, $this->view_params);
        } else {
            $this->view_params['export'] = true;
            $this->view_params['landscape'] = true;
            Orm_Kpi::get_instance(0)->generate_pdf($this->view_params['type'], $this->view_params, $type);
        }
    }

    /**
     * show list of report that can manage for kpis
     */
    public function reports()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-report');

        $this->view_params['menu_tab'] = 'kpi';
        $this->category = Orm_Kpi::KPI_REPORTS;

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('KPIS') . ' - ' . lang('Reports'),
            'icon' => 'fa fa-key',
            'menu_view' => 'kpi/kpi/sub_menu',
            'menu_params' => array('category' => $this->category)
        ), true);
        $this->view_params['menu_header'] = '<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-key page-header-icon"></i>&nbsp;&nbsp;' . lang('KPIS') . '</h1></i>';

        $this->breadcrumbs->push(lang('KPIS'), '/kpi');
        $this->breadcrumbs->push(lang('Reports'), '/kpi/reports');

        $this->layout->view('reports/list', $this->view_params);
    }

    /**
     *  show number of scales that will used in KPI and save it
     */
    public function manage_level_settings()
    {

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'kpi-settings');

        $this->view_params['menu_tab'] = 'kpi';
        $this->category = Orm_Kpi::KPI_LEVEL_SETTINGS;

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('KPI') . ' - ' . lang('Level Settings'),
            'icon' => 'fa fa-key',
            'menu_view' => 'kpi/kpi/sub_menu',
            'menu_params' => array('category' => $this->category)
        ), true);

        $level_obj = Orm_Kpi_Level_Settings::get_one();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $label_en = $this->input->post('label_en');
            $label_ar = $this->input->post('label_ar');
            $level = $this->input->post('level');

            Validator::required_field_validator('label_en', $label_en, lang('Required Field'));
            Validator::required_field_validator('label_ar', $label_ar, lang('Required Field'));
            Validator::required_field_validator('level', $level, lang('Required Field'));

            $level_obj->set_label_en($label_en);
            $level_obj->set_label_ar($label_ar);
            $level_obj->set_level($level);

            if (Validator::success()) {
                $level_obj->save();
                Validator::set_success_flash_message(lang('Successfully Saved'));
                redirect('/kpi/manage_level_settings');
            }
        }

        $this->view_params['level_obj'] = $level_obj;
        $this->breadcrumbs->push(lang('KPI'), '/kpi');
        $this->breadcrumbs->push(lang('Level Settings'), '/kpi/level_settings');

        $this->layout->view('kpi/kpi/kpi_level_settings', $this->view_params);
    }

    /**
     * add description for each level depends on KPI ID
     * @param $id
     */
    public function manage_level_desc($id)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!$id) {
            die("<script>window.location.reload();</script>");
        }

        $kpi = Orm_Kpi::get_instance($id);
        $settings = Orm_Kpi_Level_Settings::get_one();

        if (!$settings->get_level()) {
            Validator::set_error_flash_message(lang('Number of levels has not been added'));
            die("<script>window.location.reload();</script>");
        }

        $this->view_params['settings'] = $settings;
        $this->view_params['kpi'] = $kpi;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $levels = (array)$this->input->post('level');

            foreach ($levels as $level_no => $level) {
                $level_description = Orm_Kpi_Level_Description::get_one(array('kpi_id' => $id, 'level_number' => $level_no));
                $level_description->set_kpi_id($id);
                $level_description->set_level_number($level_no);
                $level_description->set_description(isset($level['description']) ? $level['description'] : '');
                $level_description->set_title(isset($level['title']) ? $level['title'] : '');
                $level_description->save();
            }

            Validator::set_success_flash_message(lang('Levels saved successfully'));
            json_response(array('error' => false));
        }

        $this->load->view('kpi/kpi/kpi_level_description', $this->view_params);
    }
}
