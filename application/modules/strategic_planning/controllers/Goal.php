<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Goal
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @property Breadcrumbs $breadcrumbs
 */
class Goal extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();
    private $strategy;

    /**
     * Goal constructor.
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
            'title' => lang('Strategic Planning') . ' - ' . lang('Goals') ,
            'icon' => 'fa fa-road'
        ), true);
        $this->view_params['type'] = 'goals';
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

        $title = $this->input->get_post('keyword');
        if ($title) {
            if (UI_LANG == 'arabic') {
                $key_title = "title_ar";
            } else {
                $key_title = "title_en";
            }
            $filters[$key_title] = $title;
        }

        $goals = Orm_Sp_Goal::get_all($filters, $page, $per_page);
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Sp_Goal::get_count($filters));

        $this->breadcrumbs->push(lang('Developmental Planning'), '/strategic_planning');
        $this->breadcrumbs->push(lang('Goals'), '/strategic_planning/goal');

        $this->view_params['goals'] = $goals;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['keyword'] = $title;

        $this->view_params['sp_view_content'] = 'strategic_planning/goal/items';
        $this->layout->view('sp_layout', $this->view_params);
    }

    /**
     * this function add edit
     * @return string the html view
     */
    public function add_edit()
    {
        $id = $this->input->get('id');
        $goal = Orm_Sp_Goal::get_instance($id);
        $this->view_params['goal'] = $goal;
        $this->load->view('goal/add_edit', $this->view_params);
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        $strategy_id = $this->strategy->get_id();
        $id = $this->input->post('id');
        $parent_id = intval($this->input->post('parent_id'));
        $title_en = $this->input->post('title_en');
        $title_ar = $this->input->post('title_ar');
        $code = $this->input->post('code');

        $item = Orm_Sp_Goal::get_instance($id);

        $item->set_strategy_id(intval($strategy_id));
        $item->set_parent_id($parent_id);
        $item->set_title_ar($title_ar);
        $item->set_title_en($title_en);
        $item->set_code($code);

        // validation
        Validator::required_field_validator('code', $code, lang('field required'));
        Validator::required_field_validator('title_en', $title_en, lang('field required'));
        Validator::required_field_validator('title_ar', $title_ar, lang('field required'));

        if (Validator::success()) {
            $item->save();
            $item->build_parent_tree();

            Validator::set_success_flash_message(lang('Goal Successfully Saved'));
            json_response(array('error' => false));
        }
        $this->view_params['goal'] = $item;
        json_response(array('error' => true, 'html' => $this->load->view('goal/add_edit', $this->view_params, true)));
    }

    /**
     * this function delete
     * @redirect success or error
     */
    public function delete()
    {
        $id = (int)$this->input->get_post('id');
        $item = Orm_Sp_Goal::get_instance($id);

        if ($item->get_id()) {
            $item->delete();
            Validator::set_success_flash_message(lang('Goal removed successfully'));
        } else {
            Validator::set_error_flash_message(lang('Goal not found'));
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
            $this->load->view('strategic_planning/manager/hierarchy/goal', $this->view_params);
        } else {
            $this->layout->add_javascript('https://www.google.com/jsapi', false);
            $this->layout->add_javascript('/assets/jadeer/js/period.js');
            $this->breadcrumbs->push(lang('Strategic Planning'), '/strategic_planning');

            $this->layout->view('manager/details/goal', $this->view_params);
        }
    }

    /**
     * this function integrate
     * @redirect success or error
     */
    public function integrate() {

        switch ($this->strategy->get_item_class()) {

            case Orm_Sp_Strategy_College::class:
                $migrated_ids = array_merge(array_column(Orm_Sp_Goal_Goal::get_model()->get_all(['goal_class_type' => Orm_College_Goal::class], 0, 0, [], Orm::FETCH_ARRAY), 'goal_id'), [0]);
                $goals = Orm_College_Goal::get_all(['not_in_id' => $migrated_ids, 'college_id' => $this->strategy->get_item_id()]);
                break;
            case Orm_Sp_Strategy_Unit::class:
                $migrated_ids = array_merge(array_column(Orm_Sp_Goal_Goal::get_model()->get_all(['goal_class_type' => Orm_Unit_Goal::class], 0, 0, [], Orm::FETCH_ARRAY), 'goal_id'), [0]);
                $goals = Orm_Unit_Goal::get_all(['not_in_id' => $migrated_ids, 'unit_id' => $this->strategy->get_item_id()]);
                break;
            case Orm_Sp_Strategy_Program::class:
                $migrated_ids = array_merge(array_column(Orm_Sp_Goal_Goal::get_model()->get_all(['goal_class_type' => Orm_Program_Goal::class], 0, 0, [], Orm::FETCH_ARRAY), 'goal_id'), [0]);
                $goals = Orm_Program_Goal::get_all(['not_in_id' => $migrated_ids, 'program_id' => $this->strategy->get_item_id()]);
                break;
            case Orm_Sp_Strategy_Institution::class:
                $migrated_ids = array_merge(array_column(Orm_Sp_Goal_Goal::get_model()->get_all(['goal_class_type' => Orm_Institution_Goal::class], 0, 0, [], Orm::FETCH_ARRAY), 'goal_id'), [0]);
                $goals = Orm_Institution_Goal::get_all(['not_in_id' => $migrated_ids]);
                break;
            default:
                $migrated_ids = array_merge(array_column(Orm_Sp_Goal_Goal::get_model()->get_all(['goal_class_type' => Orm_Institution_Goal::class], 0, 0, [], Orm::FETCH_ARRAY), 'goal_id'), [0]);
                $goals = Orm_Institution_Goal::get_all(['not_in_id' => $migrated_ids]);
                break;
        }

        if (!count($goals)) {
            Validator::set_error_flash_message(lang('No goals to be integrated'));
            die("<script>window.location='/strategic_planning/goal/?strategy_id={$this->strategy->get_id()}';</script>");
        }

        $this->view_params['strategy'] = $this->strategy;
        $this->view_params['goals'] = $goals;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $goal_id = $this->input->post('goal_id');

            switch ($this->strategy->get_item_class()) {
                case Orm_Sp_Strategy_College::class:
                    $goal_obj = Orm_College_Goal::get_instance($goal_id);
                    $class_type = Orm_College_Goal::class;
                    break;
                case Orm_Sp_Strategy_Unit::class:
                    $goal_obj = Orm_Unit_Goal::get_instance($goal_id);
                    $class_type = Orm_Unit_Goal::class;
                    break;
                case Orm_Sp_Strategy_Program::class:
                    $goal_obj = Orm_Program_Goal::get_instance($goal_id);
                    $class_type = Orm_Program_Goal::class;
                    break;
                case Orm_Sp_Strategy_Institution::class:
                    $goal_obj = Orm_Institution_Goal::get_instance($goal_id);
                    $class_type = Orm_Institution_Goal::class;
                    break;
                default:
                    $goal_obj = Orm_Institution_Goal::get_instance($goal_id);
                    $class_type = Orm_Institution_Goal::class;
                    break;
            }

            $strategic_goal = new Orm_Sp_Goal();
            $strategic_goal->set_title_en($goal_obj->get_title_en());
            $strategic_goal->set_title_ar($goal_obj->get_title_ar());
            $strategic_goal->set_strategy_id($this->strategy->get_id());
            $strategic_goal->save();

            $migrated_objective = Orm_Sp_Goal_Goal::get_one(array('goal_id' => $goal_id, 'goal_class_type' => $class_type));
            $migrated_objective->set_goal_id($goal_id);
            $migrated_objective->set_sp_goal_id($strategic_goal->get_id());
            $migrated_objective->set_goal_class_type($class_type);
            $migrated_objective->save();

            $this->view_params['goal'] = $strategic_goal;
            $this->view_params['strategy'] = $this->strategy;
            json_response(array('html' => $this->load->view('goal/add_edit', $this->view_params, true)));
        }

        $this->load->view('goal/integrate', $this->view_params);

    }

}