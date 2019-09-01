<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Project
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 */
class Project extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();
    private $strategy;

    /**
     * Project constructor.
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

        $this->view_params['strategy'] = $this->strategy;
        $this->view_params['menu_tab'] = 'strategic_planning';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Strategic Planning') . ' - ' . lang('Projects') ,
            'icon' => 'fa fa-road'
        ), true);

        $this->view_params['type'] = 'project';
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

        $projects = Orm_Sp_Project::get_all($filters, $page, $per_page, array('sp.action_plan_id desc', 'sp.start_date asc'));
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Sp_Project::get_count($filters));

        $this->breadcrumbs->push(lang('Developmental Planning'), '/strategic_planning');
        $this->breadcrumbs->push(lang('Projects'), '/strategic_planning/project?strategy_id=' . $this->strategy->get_id());

        $this->view_params['projects'] = $projects;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;

        $this->view_params['sp_view_content'] = 'strategic_planning/project/items';
        $this->layout->view('sp_layout', $this->view_params);
    }

    /**
     * this function add edit
     * @return string the html view
     */
    public function add_edit()
    {
        $id = $this->input->get('id');
        $project = Orm_Sp_Project::get_instance($id);
        $this->view_params['action_plans'] = Orm_Sp_Action_Plan::get_all(array('strategy_id' => $this->strategy->get_id()));
        $this->view_params['project'] = $project;
        $this->load->view('project/add_edit', $this->view_params);
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        $id = $this->input->post('id');
        $parent_id = $this->input->post('parent_id');
        $action_plan_id = $this->input->post('action_plan_id');
        $title_en = $this->input->post('en_title');
        $title_ar = $this->input->post('ar_title');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $budget = $this->input->post('budget');
        $resources = $this->input->post('resources');
        $desc_ar = $this->input->post('desc_ar');
        $desc_en = $this->input->post('desc_en');

        $project = Orm_Sp_Project::get_instance($id);

        $project->set_parent_id(intval($parent_id));
        $project->set_action_plan_id(intval($action_plan_id));
        $project->set_title_ar($title_ar);
        $project->set_title_en($title_en);
        $project->set_start_date($start_date);
        $project->set_end_date($end_date);
        $project->set_budget($budget);
        $project->set_resources($resources);
        $project->set_desc_ar($desc_ar);
        $project->set_desc_en($desc_en);

        // validation
        Validator::required_field_validator('ar_title', $title_ar, lang('Required Title'));
        Validator::required_field_validator('en_title', $title_en, lang('Required Title'));
        Validator::required_field_validator('action_plan_id', $action_plan_id, lang('Required Action Plan'));

        if($budget < 0) {
            Validator::set_error('budget', lang('the budget value can not be less than 0'));
        }

        Validator::date_format_validator('start_date', $start_date, lang('Required Start Date'));
        Validator::date_format_validator('end_date', $end_date, lang('Required End Date'));

        if($parent_id) {
            $parent_project = Orm_Sp_Project::get_instance($parent_id);

            if($parent_project->get_activities()) {
                Validator::set_error('parent_id', lang('the selected project has activities'));
            }
        }

        if($start_date > $end_date) {
            Validator::set_error('start_date', lang('Start Date must be before End Date'));
        }

        if ($project->get_id() && Orm_Sp_Activity::get_all(array('project_id' => $project->get_id()))) {
            $child_start_date  = $project->get_child_start_date();
            if($start_date > $child_start_date) {
                Validator::set_error('start_date', lang('Start Date must be on or before') . ' ' . $child_start_date);
            }

            $child_end_date  = $project->get_child_end_date();
            if($end_date < $child_end_date) {
                Validator::set_error('end_date', lang('End Date must be on or after') . ' ' . $child_end_date);
            }
        }

        if($project->get_action_plan_id()) {
            $action_plan = $project->get_action_plan_obj();

            $total_budget = $action_plan->get_budget() - $project->get_total_budget();
            if ($budget > $total_budget) {
                Validator::set_error('budget', lang('This value exceeds the remaining Action Plan budget balance of') . ' ' . $total_budget. '.');
            }

            if($start_date < $action_plan->get_start_date()) {
                Validator::set_error('start_date', lang('Start Date must be on or after') . ' ' . $action_plan->get_start_date());
            }

            if($start_date > $action_plan->get_end_date()) {
                Validator::set_error('start_date', lang('Start Date must be on or before') . ' ' . $action_plan->get_end_date());
            }

            if($end_date > $action_plan->get_end_date()) {
                Validator::set_error('end_date', lang('End Date must be on or before') . ' ' . $action_plan->get_end_date());
            }

            if($end_date < $action_plan->get_start_date()) {
                Validator::set_error('end_date', lang('End Date must be on or after') . ' ' . $action_plan->get_start_date());
            }

        }

        if (Validator::success()) {
            $project->save();
            $project->build_parent_tree();

            Validator::set_success_flash_message(lang('Project Saved Successfully'));
            json_response(array('error' => FALSE));
        }

        $this->view_params['action_plans'] = Orm_Sp_Action_Plan::get_all(array('strategy_id' => $this->strategy->get_id()));
        $this->view_params['project'] = $project;
        json_response(array('error' => true, 'html' => $this->load->view('project/add_edit', $this->view_params, true)));
    }

    /**
     * this function remove
     * @redirect success or error
     */
    public function remove()
    {
        $id = (int)$this->input->get_post('id');
        $item = Orm_Sp_Project::get_instance($id);

        if ($item->get_id()) {
            $item->delete();
            Validator::set_success_flash_message(lang('Project removed successfully'));
        } else {
            Validator::set_error_flash_message(lang('Project not found'));
        }
    }
    /**
     * this function show by its action plan id and perspective
     * @param int $action_plan_id the class type of the show to be viewed
     * @param int $perspective the perspective of the show to be viewed
     * @return string the html view
     */
    public function show($action_plan_id, $perspective)
    {

        $action_plan = Orm_Sp_Action_Plan::get_instance($action_plan_id);

        $this->view_params['projects'] = Orm_Sp_Project::get_all(array('action_plan_id' => $action_plan->get_id()));
        $this->view_params['strategy_id'] = $this->strategy->get_id();
        $this->view_params['perspective'] = Orm_Sp_Perspective::get_instance($perspective);
        $this->view_params['type'] = $perspective;

        $this->load->view('project/show', $this->view_params);
    }

    /**
     * this function details
     * @return string the html view
     */
    public function details()
    {
        if ($this->input->is_ajax_request()) {
            $strategy_id = $this->input->get_post('strategy_id');
            $this->view_params['strategy'] = Orm_Sp_Strategy::get_instance($strategy_id);
            $this->load->view('strategic_planning/manager/hierarchy/project', $this->view_params);
        } else {
            $this->layout->add_javascript('https://www.google.com/jsapi', false);
            $this->layout->add_javascript('/assets/jadeer/js/period.js');
            $this->breadcrumbs->push(lang('Strategic Planning'), '/strategic_planning');

            $this->layout->view('manager/details/project', $this->view_params);
        }
    }
}