<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Activity
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 */
class Activity extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();
    private $strategy;

    /**
     * Activity constructor.
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
            'title' => lang('Strategic Planning') . ' - ' . lang('Activities') ,
            'icon' => 'fa fa-road'
        ), true);
        $this->view_params['type'] = 'activity';
    }

    /**
     *this function index
     * @return string the html view
     * default controller action
     */
    public function index()
    {
        $fltr = $this->input->get('fltr');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        $filters = array('strategy_id' => $this->strategy->get_id());

        $activities = Orm_Sp_Activity::get_all($filters, $page, $per_page, array('sa.project_id', 'sa.start_date'));
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Sp_Activity::get_count($filters));

        $this->breadcrumbs->push(lang('Developmental Planning'), '/strategic_planning');
        $this->breadcrumbs->push(lang('Activity'), '/strategic_planning/activity?strategy_id=' . $this->strategy->get_id());

        $this->view_params['activities'] = $activities;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;

        $this->view_params['sp_view_content'] = 'strategic_planning/activity/items';
        $this->layout->view('sp_layout', $this->view_params);
    }

    /**
     * this function add edit
     * @return string the html view
     */
    public function add_edit()
    {
        $id = $this->input->get('id');
        $activity = Orm_Sp_Activity::get_instance($id);
        $projects = Orm_Sp_Project::get_all(array('strategy_id' => $this->strategy->get_id()));
        $this->view_params['projects'] = $projects;
        $this->view_params['activity'] = $activity;
        $this->load->view('activity/add_edit', $this->view_params);
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
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $weight = (int)$this->input->post('weight');
        $done = $this->input->post('value');
        $project_id = $this->input->post('project_id');

        $item = Orm_Sp_Activity::get_instance($id);

        $item->set_title_ar($title_ar);
        $item->set_title_en($title_en);
        $item->set_start_date($start_date);
        $item->set_end_date($end_date);
        $item->set_weight($weight);
        $item->set_lead($done);
        $item->set_project_id($project_id);

        // validation
        Validator::required_field_validator('title_ar', $title_ar, lang('Required Title'));
        Validator::required_field_validator('title_en', $title_en, lang('Required Title'));
        Validator::required_field_validator('project_id', $project_id, lang('Required Project'));
        Validator::less_than_validator('weight', $weight, 1, lang('the weight value should be between 1 and 10.'));
        Validator::greater_than_validator('weight', $weight, 10, lang('the weight value should be between 1 and 10.'));

        if($project_id) {
            if(Orm_Sp_Project::get_count(array('parent_id' => $project_id))) {
                Validator::set_error('project_id', lang('the selected project has sub-projects'));
            }
        }

        Validator::date_format_validator('start_date', $start_date, lang('Required Start Date'));
        Validator::date_format_validator('end_date', $end_date, lang('Required End Date'));

        if($start_date > $end_date) {
            Validator::set_error('start_date', lang('Start Date must be before End Date'));
        }

        if($item->get_project_id()) {
            $project = $item->get_project_obj();

            if($start_date < $project->get_start_date()) {
                Validator::set_error('start_date', lang('Start Date must be on or after') . ' ' . $project->get_start_date());
            }

            if($start_date > $project->get_end_date()) {
                Validator::set_error('start_date', lang('Start Date must be on or before') . ' ' . $project->get_end_date());
            }

            if($end_date > $project->get_end_date()) {
                Validator::set_error('end_date', lang('End Date must be on or before') . ' ' . $project->get_end_date());
            }

            if($end_date < $project->get_start_date()) {
                Validator::set_error('end_date', lang('End Date must be on or after') . ' ' . $project->get_start_date());
            }
        }

        if (Validator::success()) {
            $item->save();
            Validator::set_success_flash_message(lang('Activity Successfully Saved'));
            json_response(array('error' => FALSE));
        }
        $projects = Orm_Sp_Project::get_all(array('strategy_id' => $this->strategy->get_id()));
        $this->view_params['projects'] = $projects;
        $this->view_params['activity'] = $item;
        json_response(array('error' => true, 'html' => $this->load->view('activity/add_edit', $this->view_params, true)));
    }

    /**
     * this function delete
     * @redirect success or error
     */
    public function delete()
    {
        $id = (int)$this->input->get_post('id');
        $item = Orm_Sp_Activity::get_instance($id);

        if ($item->get_id()) {
            $item->delete();
        }
        Validator::set_success_flash_message(lang('Activity removed successfully'));
    }

    /**
     * this function show by its project id and perspective
     * @param int $project_id the project id of the show to be viewed
     * @param int $perspective the perspective of the show to be viewed
     * @return string the html view
     */
    public function show($project_id, $perspective)
    {

        $project = Orm_Sp_Project::get_instance($project_id);

        $this->view_params['activities'] = Orm_Sp_Activity::get_all(array('project_id' => $project->get_id()));
        $this->view_params['perspective'] = Orm_Sp_Perspective::get_instance($perspective);
        $this->view_params['type'] = $perspective;

        $this->load->view('activity/show', $this->view_params);
    }

    /**
     * this function history
     * @return string the html view
     */
    public function history()
    {
        $id = $this->input->get('id');
        $histories = Orm_Sp_Activity_Milestone::get_all(array('activity_id' => $id), 0, 0, array('date'));
        $this->view_params['histories'] = $histories;
        $this->view_params['activity'] = Orm_Sp_Activity::get_instance($id);
        $this->load->view('activity/history', $this->view_params);
    }
}