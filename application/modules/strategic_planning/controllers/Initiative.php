<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Initiative
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @property Breadcrumbs $breadcrumbs
 */
class Initiative extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();
    private $strategy;

    /**
     * Initiative constructor.
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

        if (!$this->strategy->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/strategic_planning');
        }

        $this->view_params['strategy'] = $this->strategy;
        $this->view_params['menu_tab'] = 'strategic_planning';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Strategic Planning') . ' - ' . lang('Initiatives') ,
            'icon' => 'fa fa-road'
        ), true);
        $this->view_params['type'] = 'initiative';
    }

    /**
     *this function index
     * @return string the html view
     * default controller action
     */
    public function index()
    {
        $fltr = $this->input->get('fltr');
        $objective_id = (int)$this->input->get('objective_id');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        if (!$page) {
            $page = 1;
        }

        $filters = array("strategy_id" => $this->strategy->get_id());
        if ($objective_id && $objective_id > 0) {
            $filters['objective_id'] = $objective_id;
        }

        $title = $this->input->get_post('keyword');
        if ($title) {
            if (UI_LANG == 'arabic') {
                $key_title = "title_ar";
            } else {
                $key_title = "title_en";
            }
            $filters[$key_title] = $title;
        }

        $initiatives = Orm_Sp_Initiative::get_all($filters, $page, $per_page, array('si.objective_id', 'si.code'));
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Sp_Initiative::get_count($filters));

        $this->breadcrumbs->push(lang('Developmental Planning'), '/strategic_planning');
        $this->breadcrumbs->push(lang('Initiative'), '/strategic_planning/initiative?strategy_id=' . $this->strategy->get_id());

        $this->view_params['initiatives'] = $initiatives;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['keyword'] = $title;

        $this->view_params['sp_view_content'] = 'strategic_planning/initiative/items';
        $this->layout->view('sp_layout', $this->view_params);
    }

    /**
     * this function add edit
     * @return string the html view
     */
    public function add_edit()
    {
        $id = (int)$this->input->get('id');
        $initiative = Orm_Sp_Initiative::get_instance($id);
        $this->view_params['initiative'] = $initiative;
        $this->view_params['structure'] = $this->strategy;
        $this->load->view('initiative/add_edit', $this->view_params);
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        $id = (int)$this->input->post('id');
        $title_ar = $this->input->post('title_ar');
        $title_en = $this->input->post('title_en');
        $objective_id = $this->input->post('objective_id');
        $owner_id = $this->input->post('owner_id');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $code = $this->input->post('initiative_code');

        $item = Orm_Sp_Initiative::get_instance($id);

        $item->set_code($code);
        $item->set_title_ar($title_ar);
        $item->set_title_en($title_en);
        $item->set_objective_id($objective_id);
        $item->set_owner_id($owner_id);
        $item->set_start_date($start_date);
        $item->set_end_date($end_date);

        // validation
        Validator::required_field_validator('initiative_code', $code, lang('field required'));
        Validator::required_field_validator('title_en', $title_en, lang('field required'));
        Validator::required_field_validator('title_ar', $title_ar, lang('field required'));
        Validator::required_field_validator('objective_id', $objective_id, lang('field required'));

        Validator::date_format_validator('start_date', $start_date, lang('field required'));
        Validator::date_format_validator('end_date', $end_date, lang('field required'));

        if($start_date > $end_date) {
            Validator::set_error('start_date', lang('Start Date must be before End Date'));
        }

        if ($item->get_id() && Orm_Sp_Action_Plan::get_all(array('initiative_id' => $item->get_id()))) {
            $child_start_date  = $item->get_child_start_date();

            if($start_date > $child_start_date) {
                Validator::set_error('start_date', lang('Start Date must be on or before') . ' ' . $child_start_date);
            }

            $child_end_date  = $item->get_child_end_date();
            if($end_date < $child_end_date) {
                Validator::set_error('end_date', lang('End Date must be on or after') . ' ' . $child_end_date);
            }
        }

        if($item->get_objective_id()) {
            $objective = $item->get_objective_obj();

            if($start_date < $objective->get_start_date()) {
                Validator::set_error('start_date', lang('Start Date must be on or after') . ' ' . $objective->get_start_date());
            }

            if($start_date > $objective->get_end_date()) {
                Validator::set_error('start_date', lang('Start Date must be on or before') . ' ' . $objective->get_end_date());
            }

            if($end_date > $objective->get_end_date()) {
                Validator::set_error('end_date', lang('End Date must be on or before') . ' ' . $objective->get_end_date());
            }

            if($end_date < $objective->get_start_date()) {
                Validator::set_error('end_date', lang('End Date must be on or after') . ' ' . $objective->get_start_date());
            }
        }

        if (Validator::success()) {
            $item->save();

            Validator::set_success_flash_message(lang('Initiative Successfully Saved'));
            json_response(array('error' => false));
        }

        $this->view_params['initiative'] = $item;
        $this->view_params['structure'] = $this->strategy;
        json_response(array('error' => true, 'html' => $this->load->view('initiative/add_edit', $this->view_params, true)));
    }

    /**
     * this function delete
     * @redirect success or error
     */
    public function delete()
    {
        $id = (int)$this->input->get_post('id');
        $item = Orm_Sp_Initiative::get_instance($id);

        if ($item->get_id()) {
            $item->delete();
        }
        Validator::set_success_flash_message(lang('Initiative removed successfully'));
    }

    /**
     * this function milestone
     * @redirect success or error
     */
    public function milestone()
    {
        $initiative_id = (int)$this->input->get('id');
        $initiative = Orm_Sp_Initiative::get_instance($initiative_id);

        if (!$initiative->get_id()) {
            json_response(array('error' => true, 'html' => '<script>location.href="/strategic_planning/initiative?strategy_id=' . $this->strategy->get_id() . '";</script>'));
        }

        $ajax = $this->input->post('ajax');
        $year = $this->input->post('year');
        $target = $this->input->post('target');
        if (empty($year) ) {
            $year = Orm_Semester::get_active_semester()->get_year();
        }

        $item = Orm_Sp_Initiative_Milestone::get_one(array('initiative_id' => $initiative_id, 'year' => $year));
        $item->set_year($year);

        if ($ajax == 'post') {
            // validation
            Validator::required_field_validator('year', $year, lang('Invalid Year'));
            Validator::required_field_validator('target', $target, lang('Invalid Target!'));

            $item->set_target($target);
            $item->set_initiative_id($initiative->get_id());

            if (Validator::success()) {
                $item->save();

                Validator::set_success_flash_message(lang('Initiative Milestone Successfully Saved'));
                json_response(array('error' => false));
            }
        }

        $this->view_params['milestone'] = $item;
        $this->view_params['initiative'] = $initiative;

        if ($ajax == 'post') {
            json_response(array('error' => true, 'html' => $this->load->view('initiative/milestone', $this->view_params, true)));
        } else {
            $this->load->view('initiative/milestone', $this->view_params);
        }
    }

    /**
     * this function show by its objective id and perspective
     * @param int $objective_id the initiative id of the show to be viewed
     * @param int $perspective the perspective of the show to be viewed
     * @return string the html view
     */
    public function show($objective_id, $perspective)
    {

        $objective = Orm_Sp_Objective::get_instance($objective_id);

        $mode = $this->input->get('period_mode');
        $period_value = $this->input->get('period_value');
        $period_year = $this->input->get('period_year');

        $filter['year'] = $period_year;

        $this->view_params['initiatives'] = Orm_Sp_Initiative::get_all(array('objective_id' => $objective->get_id()));
        $this->view_params['perspective'] = Orm_Sp_Perspective::get_instance($perspective);
        $this->view_params['type'] = $perspective;
        $this->view_params['filters'] = $filter;

        $this->load->view('initiative/show', $this->view_params);
    }
}