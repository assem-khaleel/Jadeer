<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Objective
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property Breadcrumbs $breadcrumbs
 */
class Objective extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();
    private $strategy;

    /**
     * Objective constructor.
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
            'title' => lang('Strategic Planning') . ' - ' . lang('Objectives') ,
            'icon' => 'fa fa-road'
        ), true);

        $this->view_params['type'] = 'objectives';
    }

    /**
     *this function index
     * @return string the html view
     * default controller action
     */
    public function index()
    {
        $fltr = $this->input->get('fltr');
        $goal_id = (int)$this->input->get('goal_id');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        if (!$page) {
            $page = 1;
        }

        $filters = array();
        $filters['strategy_id'] = $this->strategy->get_id();
        if ($goal_id) {
            $filters['goal_id'] = $goal_id;
        }

        $objectives = Orm_Sp_Objective::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Sp_Objective::get_count($filters));

        $this->breadcrumbs->push(lang('Developmental Planning'), '/strategic_planning');
        $this->breadcrumbs->push(lang('Objective'), '/strategic_planning/objective?strategy_id=' . $this->strategy->get_id());

        $this->view_params['objectives'] = $objectives;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;

        $this->view_params['sp_view_content'] = 'strategic_planning/objective/list';
        $this->layout->view('sp_layout', $this->view_params);
    }

    /**
     * this function show by its typ
     * @param int $type the typ of the show to be viewed
     * @return string the html view
     */
    public function show($type)
    {

        $this->view_params['objectives'] = Orm_Sp_Objective::get_all(array('strategy_id' => $this->strategy->get_id(), 'perspective' => $type));
        $this->view_params['perspective'] = Orm_Sp_Perspective::get_instance($type);
        $this->view_params['type'] = $type;

        echo $this->load->view('objective/show', $this->view_params, true);
    }

    /**
     * this function add edit
     * @return string the html view
     */
    public function add_edit()
    {
        $id = (int)$this->input->get_post('id');
        $objective = Orm_Sp_Objective::get_instance($id);

        $this->view_params['objective'] = $objective;
        $this->view_params['strategy'] = $this->strategy;
        $this->load->view('objective/add_edit', $this->view_params);
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        $strategy_id = $this->strategy->get_id();
        $id = (int)$this->input->post('id');
        $code = $this->input->post('obj_code');
        $title_ar = $this->input->post('title_ar');
        $title_en = $this->input->post('title_en');
        $description_ar = $this->input->post('description_ar');
        $description_en = $this->input->post('description_en');
        $goal_id = $this->input->post('goal_id');
        $parent_id = intval($this->input->post('parent_id'));
        $owner_id = $this->input->post('owner_id');
        $budget = floatval($this->input->post('budget'));
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $perspectives = (array) $this->input->post('perspectives');

        $item = Orm_Sp_Objective::get_instance($id);

        $item->set_title_ar($title_ar);
        $item->set_title_en($title_en);
        $item->set_description_ar($description_ar);
        $item->set_description_en($description_en);
        $item->set_parent_id(intval($parent_id));
        $item->set_code($code);
        $item->set_strategy_id(intval($strategy_id));
        $item->set_goal_id(intval($goal_id));
        $item->set_owner_id(intval($owner_id));
        $item->set_budget($budget);
        $item->set_start_date($start_date);
        $item->set_end_date($end_date);

        // validation
        Validator::required_field_validator('obj_code', $code, lang('field required'));
        Validator::required_field_validator('title_ar', $title_ar, lang('field required'));
        Validator::required_field_validator('title_en', $title_en, lang('field required'));
        Validator::required_array_validator('perspectives', $perspectives, lang('field required'));


        if(Orm_Sp_Perspective::get_count(['in_id'=>$perspectives]) != count($perspectives)){
            Validator::set_error('perspectives', lang('field selected incorrectly'));

        }


        if($budget < 0) {
            Validator::set_error('budget', lang('the budget value can not be less than 0'));
        }

        Validator::date_format_validator('start_date', $start_date, lang('field required'));
        Validator::date_format_validator('end_date', $end_date, lang('field required'));

        if($start_date > $end_date) {
            Validator::set_error('start_date', lang('Start Date must be before End Date'));
        }

        if ($item->get_id() && Orm_Sp_Initiative::get_all(array('objective_id' => $item->get_id()))) {
            $child_budget  = $item->get_child_total_budget();
            if ($budget < $child_budget) {
                Validator::set_error('budget', lang("This value is less than the sum of all the Action Plans' budget of") . ' ' . $child_budget. '.');
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

        if (Validator::success()) {
            $item->save();
            $item->build_parent_tree();

            foreach ($perspectives as $perspective) {
                $objective_perspective = Orm_Sp_Objective_Perspective::get_one(array('objective_id' => $item->get_id(), 'perspective' => $perspective));
                $objective_perspective->set_objective_id($item->get_id());
                $objective_perspective->set_perspective($perspective);
                $objective_perspective->save();
            }

            $non_related_perspectives = Orm_Sp_Objective_Perspective::get_all(array('objective_id' => $item->get_id(), 'perspective_not_in' => $perspectives));
            foreach ($non_related_perspectives as $perspective) {
                $perspective->delete();
            }

            Validator::set_success_flash_message(lang('Objective Successfully Saved'));
            json_response(array('error' => false));
        }


        $this->view_params['objective'] = $item;
        $this->view_params['strategy'] = $this->strategy;
        json_response(array('error' => true, 'html' => $this->load->view('objective/add_edit', $this->view_params, true)));
    }

    /**
     * this function delete
     * @redirect success or error
     */
    public function delete()
    {
        $id = (int)$this->input->get_post('id');
        $item = Orm_Sp_Objective::get_instance($id);

        if ($item->get_id()) {
            $item->delete();
            Validator::set_success_flash_message(lang('Objective removed successfully'));
        } else {
            Validator::set_error_flash_message(lang('Objective not found'));
        }
    }

    /**
     * this function milestone
     * @redirect success or error
     */
    public function milestone()
    {
        $objective_id = (int)$this->input->get('id');
        $objective = Orm_Sp_Objective::get_instance($objective_id);

        if (!$objective->get_id()) {
            json_response(array('error' => true, 'html' => '<script>location.href="/strategic_planning/objective?strategy_id=' . $this->strategy->get_id() . '";</script>'));
        }

        $ajax = $this->input->post('ajax');
        $year = $this->input->post('year');
        $target = $this->input->post('target');
        if (empty($year)) {
            $year = Orm_Semester::get_active_semester()->get_year();
        }

        $item = Orm_Sp_Objective_Milestone::get_one(array('objective_id' => $objective_id, 'year' => $year));
        $item->set_year($year);

        if ($ajax == 'post') {
            // validation
            Validator::required_field_validator('year', $year, lang('Invalid Year'));
            Validator::required_field_validator('target', $target, lang('Invalid Target!'));

            $item->set_target($target);
            $item->set_objective_id($objective->get_id());

            if (Validator::success()) {
                $item->save();

                Validator::set_success_flash_message(lang('Objective Milestone Successfully Saved'));
                json_response(array('error' => false));
            }
        }

        $this->view_params['milestone'] = $item;
        $this->view_params['objective'] = $objective;

        if ($ajax == 'post') {
            json_response(array('error' => true, 'html' => $this->load->view('objective/milestone', $this->view_params, true)));
        } else {
            $this->load->view('objective/milestone', $this->view_params);
        }
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
            echo $this->load->view('strategic_planning/manager/hierarchy/objective', $this->view_params, true);
        } else {
            $this->layout->add_javascript('https://www.google.com/jsapi', false);
            $this->layout->add_javascript('/assets/jadeer/js/period.js');
            $this->breadcrumbs->push(lang('Strategic Planning'), '/strategic_planning');

            $this->layout->view('manager/details/objective', $this->view_params);
        }
    }

    /**
     * this function integrate
     * @return string the html view
     */
    public function integrate() {

        switch ($this->strategy->get_item_class()) {

            case Orm_Sp_Strategy_College::class:
                $migrated_ids = array_merge(array_column(Orm_Sp_Objective_Objective::get_model()->get_all(['objective_class_type' => Orm_College_Objective::class], 0, 0, [], Orm::FETCH_ARRAY), 'objective_id'), [0]);
                $objectives = Orm_College_Objective::get_all(['not_in_id' => $migrated_ids, 'college_id' => $this->strategy->get_item_id()]);
                break;
            case Orm_Sp_Strategy_Unit::class:
                $migrated_ids = array_merge(array_column(Orm_Sp_Objective_Objective::get_model()->get_all(['objective_class_type' => Orm_Unit_Objective::class], 0, 0, [], Orm::FETCH_ARRAY), 'objective_id'), [0]);
                $objectives = Orm_Unit_Objective::get_all(['not_in_id' => $migrated_ids, 'unit_id' => $this->strategy->get_item_id()]);
                break;
            case Orm_Sp_Strategy_Program::class:
                $migrated_ids = array_merge(array_column(Orm_Sp_Objective_Objective::get_model()->get_all(['objective_class_type' => Orm_Program_Objective::class], 0, 0, [], Orm::FETCH_ARRAY), 'objective_id'), [0]);
                $objectives = Orm_Program_Objective::get_all(['not_in_id' => $migrated_ids, 'program_id' => $this->strategy->get_item_id()]);
                break;
            case Orm_Sp_Strategy_Institution::class:
                $migrated_ids = array_merge(array_column(Orm_Sp_Objective_Objective::get_model()->get_all(['objective_class_type' => Orm_Institution_Objective::class], 0, 0, [], Orm::FETCH_ARRAY), 'objective_id'), [0]);
                $objectives = Orm_Institution_Objective::get_all(['not_in_id' => $migrated_ids]);
                break;
            default:
                $migrated_ids = array_merge(array_column(Orm_Sp_Objective_Objective::get_model()->get_all(['objective_class_type' => Orm_Institution_Objective::class], 0, 0, [], Orm::FETCH_ARRAY), 'objective_id'), [0]);
                $objectives = Orm_Institution_Objective::get_all(['not_in_id' => $migrated_ids]);
                break;
        }

        if (!count($objectives)) {
            Validator::set_error_flash_message(lang('No objectives to be integrated'));
            die("<script>window.location='/strategic_planning/objective/?strategy_id={$this->strategy->get_id()}';</script>");
        }

        $this->view_params['strategy'] = $this->strategy;
        $this->view_params['objectives'] = $objectives;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $objective_id = $this->input->post('objective_id');

            switch ($this->strategy->get_item_class()) {
                case Orm_Sp_Strategy_College::class:
                    $objective_obj = Orm_College_Objective::get_instance($objective_id);
                    $class_type = Orm_College_Objective::class;
                    break;
                case Orm_Sp_Strategy_Unit::class:
                    $objective_obj = Orm_Unit_Objective::get_instance($objective_id);
                    $class_type = Orm_Unit_Objective::class;
                    break;
                case Orm_Sp_Strategy_Program::class:
                    $objective_obj = Orm_Program_Objective::get_instance($objective_id);
                    $class_type = Orm_Program_Objective::class;
                    break;
                case Orm_Sp_Strategy_Institution::class:
                    $objective_obj = Orm_Institution_Objective::get_instance($objective_id);
                    $class_type = Orm_Institution_Objective::class;
                    break;
                default:
                    $objective_obj = Orm_Institution_Objective::get_instance($objective_id);
                    $class_type = Orm_Institution_Objective::class;
                    break;
            }

            $strategic_objective = new Orm_Sp_Objective();
            $strategic_objective->set_title_en($objective_obj->get_title_en());
            $strategic_objective->set_title_ar($objective_obj->get_title_ar());
            $strategic_objective->set_strategy_id($this->strategy->get_id());
            $strategic_objective->save();

            $migrated_objective = Orm_Sp_Objective_Objective::get_one(array('objective_id' => $objective_id, 'objective_class_type' => $class_type));
            $migrated_objective->set_objective_id($objective_id);
            $migrated_objective->set_sp_objective_id($strategic_objective->get_id());
            $migrated_objective->set_objective_class_type($class_type);
            $migrated_objective->save();

            $this->view_params['objective'] = $strategic_objective;
            $this->view_params['strategy'] = $this->strategy;
            json_response(array('html' => $this->load->view('objective/add_edit', $this->view_params, true)));
        }

        $this->load->view('objective/integrate', $this->view_params);

    }
}