<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Action_Plan
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @property Breadcrumbs $breadcrumbs
 */
class Action_Plan extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();
    private $strategy;

    /**
     * Action_Plan constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!License::get_instance()->check_module('strategic_planning', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $this->load->helper('download');

        $strategy_id = $this->input->get_post('strategy_id');
        $this->strategy = Orm_Sp_Strategy::get_instance($strategy_id);

        if (!$this->strategy->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/strategic_planning');
        }

        $this->view_params['strategy'] = $this->strategy;
        $this->view_params['menu_tab'] = 'strategic_planning';

        $page_header = array(
            'title' => lang('Strategic Planning') . ' - ' . lang('Action Plan') ,
            'icon' => 'fa fa-road'
        );

        if(Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
            $page_header['link_attr'] = 'href="/strategic_planning/recommendation_type"';
            $page_header['link_title'] = lang('Settings');
            $page_header['link_icon'] = 'gear';
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);
        $this->view_params['type'] = 'action_plan';
    }

    /**
     *this function index
     * @return string the html view
     * default controller action
     */
    public function index()
    {
        $fltr = $this->input->get('fltr');

        $per_page = (int)$this->input->get_post('per_page');
        $page = (int)$this->input->get_post('page');
        if (!$page) {
            $page = 1;
        }
        if (!$per_page || $per_page < 1) {
            $per_page = 10;
        }

        $filters = array('strategy_id' => $this->strategy->get_id());

        $title = $this->input->get_post('keyword');
        if ($title) {
            if (UI_LANG == 'arabic') {
                $key_title = "title_ar";
            } else {
                $key_title = "title_en";
            }
            $filters[$key_title] = $title;
        }

        $action_plans = Orm_Sp_Action_Plan::get_all($filters, $page, $per_page, array('sap.initiative_id', 'sap.start_date'));
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Sp_Action_Plan::get_count($filters));

        $this->view_params['action_plans'] = $action_plans;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['keyword'] = $title;

        $this->breadcrumbs->push(lang('Developmental Planning'), '/strategic_planning');
        $this->breadcrumbs->push(lang('Action Plan'), '/strategic_planning/action_plan?strategy_id=' . $this->strategy->get_id());

        // recommendations listing
        $rec_filters = array();
        $rec_page = (int)$this->input->get_post('rec_page');
        if (!$rec_page) {
            $rec_page = 1;
        }
        Orm_User::get_logged_user()->get_filters($rec_filters);

        $recommendations = Orm_Sp_Recommendation::get_all($rec_filters, $rec_page, $per_page);
        $rec_pager = new Pager(array('url' => $this->input->server('REQUEST_URI'), 'page_label' => 'rec_page'));
        $rec_pager->set_page($rec_page);
        $rec_pager->set_per_page($per_page);
        $rec_pager->set_total_count(Orm_Sp_Recommendation::get_count($rec_filters));

        $this->view_params['recommendations'] = $recommendations;
        $this->view_params['rec_pager'] = $rec_pager->render(true);

        $this->view_params['sp_view_content'] = 'strategic_planning/action_plan/items';
        $this->layout->view('sp_layout', $this->view_params);
    }

    /**
     * this function add edit
     * @return string the html view
     */
    public function add_edit()
    {
        $id = $this->input->get('id');
        $action_plan = Orm_Sp_Action_Plan::get_instance($id);
        $recommendations = Orm_Sp_Recommendation::get_all_group_by_types();
        $type_ids = array();
        foreach (Orm_Sp_Action_Plan_Recommend::get_all(array('action_plan_id' => intval($id))) as $obj) {
            $type_ids[] = $obj->get_recommend_id();
        }

        $this->view_params['strategy'] = $this->strategy;
        $this->view_params['action_plan'] = $action_plan;
        $this->view_params['recommendations'] = $recommendations;
        $this->view_params['type_ids'] = $type_ids;
        $this->load->view('action_plan/add_edit', $this->view_params);
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
        $budget = $this->input->post('budget');
        $initiative_id = $this->input->post('initiative_id');
        $responsible_id = $this->input->post('responsible_id');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $resources = $this->input->post('resources');
        $type_ids = (array)$this->input->post('type_ids');
        $recommend_ids = array_unique($type_ids);

        $item = Orm_Sp_Action_Plan::get_instance($id);

        $item->set_title_ar($title_ar);
        $item->set_title_en($title_en);
        $item->set_initiative_id($initiative_id);
        $item->set_budget($budget);
        $item->set_start_date($start_date);
        $item->set_end_date($end_date);
        $item->set_responsible_id($responsible_id);
        $item->set_resources($resources);

        // validation
        Validator::required_field_validator('title_ar', $title_ar, lang('field required'));
        Validator::required_field_validator('title_en', $title_en, lang('field required'));
        Validator::required_field_validator('initiative_id', $initiative_id, lang('field required'));

        if($budget < 0) {
            Validator::set_error('budget', lang('the budget value can not be less than 0'));
        }

        Validator::date_format_validator('start_date', $start_date, lang('field required'));
        Validator::date_format_validator('end_date', $end_date, lang('field required'));

        if($start_date > $end_date) {
            Validator::set_error('start_date', lang('Start Date must be before End Date'));
        }

        if ($item->get_id() && Orm_Sp_Project::get_all(array('action_plan_id' => $item->get_id()))) {
            $child_budget  = $item->get_child_total_budget();
            if ($budget < $child_budget) {
                Validator::set_error('budget', lang("This value is less than the sum of all the Projects' budget of") . ' ' . $child_budget. '.');

            }

            $child_start_date  = $item->get_child_start_date();
            if($start_date > $child_start_date) {
                Validator::set_error('start_date', lang('Start Date must be on or before') . ' ' . $child_start_date);
            }

            $child_end_date  = $item->get_child_end_date();
            if($end_date < $child_end_date) {
                Validator::set_error('end_date', lang('End Date must be on or after') . ' ' . $child_end_date);
            }
        }

        if($item->get_initiative_id()) {
            $initiative = $item->get_initiative_obj();

            $objective_budget = $initiative->get_objective_obj()->get_budget();

            $total_budget = $objective_budget - $item->get_total_budget();
            if ($budget > $total_budget) {
                Validator::set_error('budget', lang('This value exceeds the remaining Objective budget balance of') . ' ' . $total_budget. '.');
            }

            if($start_date < $initiative->get_start_date()) {
                Validator::set_error('start_date', lang('Start Date must be on or after') . ' ' . $initiative->get_start_date());
            }

            if($start_date > $initiative->get_end_date()) {
                Validator::set_error('start_date', lang('Start Date must be on or before') . ' ' . $initiative->get_end_date());
            }

            if($end_date > $initiative->get_end_date()) {
                Validator::set_error('end_date', lang('End Date must be on or before') . ' ' . $initiative->get_end_date());
            }

            if($end_date < $initiative->get_start_date()) {
                Validator::set_error('end_date', lang('End Date must be on or after') . ' ' . $initiative->get_start_date());
            }
        }

        if (Validator::success()) {
            $item->save();

            Orm_Sp_Action_Plan_Recommend::get_model()->delete_all(array('action_plan_id' => $item->get_id()));
            foreach ($recommend_ids as $recommendation_id) {
                $rec = Orm_Sp_Action_Plan_Recommend::get_instance(0);
                $rec->set_action_plan_id($item->get_id());
                $rec->set_recommend_id($recommendation_id);
                $rec->save();
            }

            Validator::set_success_flash_message(lang('Action Plan Successfully Saved'));
            json_response(array('error' => false));
        }

        $recommendations = Orm_Sp_Recommendation::get_all_group_by_types();
        $ids = Orm_Sp_Action_Plan_Recommend::get_all(array('action_plan_id' => $id));
        $type_ids = array();
        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $type_ids[$id->get_id()] = $id->get_id();
            }
        }
        $this->view_params['recommendations'] = $recommendations;
        $this->view_params['type_ids'] = $type_ids;
        $this->view_params['action_plan'] = $item;
        json_response(array('error' => true, 'html' => $this->load->view('action_plan/add_edit', $this->view_params, true)));
    }

    /**
     * this function delete
     * @redirect success or error
     */
    public function delete()
    {
        $id = (int)$this->input->get_post('id');
        $item = Orm_Sp_Action_Plan::get_instance($id);

        if ($item->get_id()) {
            $item->delete();

            Orm_Sp_Action_Plan_Recommend::get_model()->delete_all(array('action_plan_id' => $item->get_id()));
        }
        Validator::set_success_flash_message(lang('Action Plan removed successfully'));
    }
    /**
     * this function show by its initiative id and perspective
     * @param int $initiative_id the initiative id of the show to be viewed
     * @param int $perspective the perspective of the show to be viewed
     * @return string the html view
     */
    public function show($initiative_id, $perspective)
    {
        $initiative = Orm_Sp_Initiative::get_instance($initiative_id);

        $this->view_params['action_plans'] = Orm_Sp_Action_Plan::get_all(array('initiative_id' => $initiative->get_id()));
        $this->view_params['perspective'] = Orm_Sp_Perspective::get_instance($perspective);
        $this->view_params['type'] = $perspective;

        $this->load->view('action_plan/show', $this->view_params);
    }

}