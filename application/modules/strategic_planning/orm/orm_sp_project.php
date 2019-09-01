<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Project extends Orm
{

    /**
     * @var $instances Orm_Sp_Project[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_project';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $action_plan_id = 0;
    protected $project_id = 0;
    protected $parent_id = 0;
    protected $parent_lft = 0;
    protected $parent_rtl = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $start_date = '0000-00-00';
    protected $end_date = '0000-00-00';
    protected $budget = 0;
    protected $resources = '';
    protected $desc_en = '';
    protected $desc_ar = '';
    protected $lead = 0;
    protected $lag = 0;
    //
    private $children = array();
    private static $prepare_children = false;

    /**
     * @return Sp_Project_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Project_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Project
     */
    public static function get_instance($id)
    {

        $id = intval($id);
        if (isset(self::$instances[$id])) {
            return self::$instances[$id];
        }

        return self::get_one(array('id' => $id));
    }

    /**
     * get all Objects
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     *
     * @return Orm_Sp_Project[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array())
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Sp_Project
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Project();
    }

    /**
     * get count
     *
     * @param array $filters
     * @return int
     */
    public static function get_count($filters = array())
    {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }

    public function to_array()
    {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['action_plan_id'] = $this->get_action_plan_id();
        $db_params['project_id'] = $this->get_project_id();
        $db_params['parent_id'] = $this->get_parent_id();
        $db_params['parent_lft'] = $this->get_parent_lft();
        $db_params['parent_rtl'] = $this->get_parent_rtl();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        $db_params['budget'] = $this->get_budget();
        $db_params['resources'] = $this->get_resources();
        $db_params['desc_en'] = $this->get_desc_en();
        $db_params['desc_ar'] = $this->get_desc_ar();
        $db_params['lead'] = $this->get_lead();
        $db_params['lag'] = $this->get_lag();

        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        if($this->check_object_field('lead') || $this->check_object_field('lag')) {
            $this->get_action_plan_obj()->compute_progress();
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    /**
     * @return $this
     */
    public function prepare_children()
    {
        if(!self::$prepare_children) {

            $projects = self::get_all(array('project_id' => $this->get_project_id(), 'parent_lft' => $this->get_parent_lft(), 'parent_rtl' => $this->get_parent_rtl()));

            if ($projects) {
                foreach ($projects as $project) {
                    if ($project->get_parent_id()) {
                        $parent = self::get_instance($project->get_parent_id());
                        $parent->add_child($project);
                    }
                }
            }

            self::$prepare_children = true;
        }

        return $this;
    }

    /**
     * @param Orm_Sp_Project $project
     */
    public function add_child(Orm_Sp_Project $project) {
        $this->children[$project->get_id()] = $project;
    }

    /**
     * @return Orm_Sp_Project[]
     */
    public function get_children()
    {
        return $this->prepare_children()->children;
    }

    /**
     * @return Orm_Sp_Project
     */
    public function reset_children()
    {
        self::$prepare_children = false;
        return $this;
    }

    /**
     *
     */
    public function build_parent_tree() {

        $old_id = $this->get_project_id();

        if($this->get_parent_id()) {
            $this->set_project_id($this->get_parent_obj()->get_project_id());
        } else {
            $this->set_project_id($this->get_id());
        }

        $this->save();

        self::get_model()->update_group_tree($old_id ,$this->get_project_id(), $this->get_parent_lft(), $this->get_parent_rtl());
        self::get_model()->build_parent_tree($this->get_project_id());
    }

    /**
     * return Orm_Sp_Project
     */
    public function get_parent_obj()
    {
        return self::get_instance($this->get_parent_id());
    }

    public function set_id($value)
    {
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_action_plan_id($value)
    {
        $this->add_object_field('action_plan_id',$value);
        $this->action_plan_id = $value;
    }

    public function get_action_plan_id()
    {
        return $this->action_plan_id;
    }

    public function set_project_id($value)
    {
        $this->add_object_field('project_id',$value);
        $this->project_id = $value;
    }

    public function get_project_id()
    {
        return $this->project_id;
    }

    public function set_parent_id($value)
    {
        $this->add_object_field('parent_id',$value);
        $this->parent_id = $value;
    }

    public function get_parent_id()
    {
        return $this->parent_id;
    }

    public function set_parent_lft($value)
    {
        $this->add_object_field('parent_lft',$value);
        $this->parent_lft = $value;
    }

    public function get_parent_lft()
    {
        return $this->parent_lft;
    }

    public function set_parent_rtl($value)
    {
        $this->add_object_field('parent_rtl',$value);
        $this->parent_rtl = $value;
    }

    public function get_parent_rtl()
    {
        return $this->parent_rtl;
    }

    public function set_title_en($value)
    {
        $this->add_object_field('title_en',$value);
        $this->title_en = $value;
    }

    public function get_title_en()
    {
        return $this->title_en;
    }

    public function set_title_ar($value)
    {
        $this->add_object_field('title_ar',$value);
        $this->title_ar = $value;
    }

    public function get_title_ar()
    {
        return $this->title_ar;
    }

    public function set_start_date($value)
    {
        $this->add_object_field('start_date',$value);
        $this->start_date = $value;
    }

    public function get_start_date()
    {
        return $this->start_date;
    }

    public function set_end_date($value)
    {
        $this->add_object_field('end_date',$value);
        $this->end_date = $value;
    }

    public function get_end_date()
    {
        return $this->end_date;
    }

    public function set_budget($value)
    {
        $this->add_object_field('budget',$value);
        $this->budget = $value;
    }

    public function get_budget()
    {
        return $this->budget;
    }

    public function set_resources($value)
    {
        $this->add_object_field('resources',$value);
        $this->resources = $value;
    }

    public function get_resources()
    {
        return $this->resources;
    }

    public function set_desc_en($value)
    {
        $this->add_object_field('desc_en',$value);
        $this->desc_en = $value;
    }

    public function get_desc_en()
    {
        return $this->desc_en;
    }

    public function set_desc_ar($value)
    {
        $this->add_object_field('desc_ar',$value);
        $this->desc_ar = $value;
    }

    public function get_desc_ar()
    {
        return $this->desc_ar;
    }

    public function set_lead($value)
    {
        $this->add_object_field('lead',$value);
        $this->lead = $value;
    }

    public function get_lead()
    {
        return $this->lead;
    }

    public function set_lag($value)
    {
        $this->add_object_field('lag',$value);
        $this->lag = $value;
    }

    public function get_lag()
    {
        return $this->lag;
    }

    /**
     * @return Orm_Sp_Action_Plan
     */
    public function get_action_plan_obj() {
        return Orm_Sp_Action_Plan::get_instance($this->get_action_plan_id());
    }

    public function get_title($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_title_ar() : $this->get_title_en();
    }

    public function get_desc($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_desc_ar() : $this->get_desc_en();
    }

    private $activities = null;
    /**
     * this function get activities
     * @return Orm_Sp_Activity[] the call function
     */
    public function get_activities() {
        if(is_null($this->activities)) {
            $this->activities = Orm_Sp_Activity::get_all(array('project_id' => $this->get_id()));
        }
        return $this->activities;
    }

    private $progress_lead = null;
    /**
     * this function get progress lead by its last period
     * @param bool $last_period the last period of the get progress lead to be call function
     * @return mixed the call function
     */
    public function get_progress_lead($last_period = false) {

        $period = 'current';
        if($last_period) {
            $period = 'previous';
        }

        if(!isset($this->progress_lead[$period])) {
            $this->progress_lead[$period] = Orm_Sp_Strategy::get_progress_type('project', $this->get_id(), 'lead', $last_period);
        }

        return $this->progress_lead[$period];
    }

    private $target_lead = null;
    /**
     * this function get trend lag
     * @return string the call function
     */
    public function get_target_lead() {

        if(is_null($this->target_lead)) {
            $this->target_lead = Orm_Sp_Strategy::get_target_type('project', $this->get_id());
        }

        return $this->target_lead;
    }

    /**
     * this function get status lead
     * @return string the call function
     */
    public function get_status_lead() {

        $progress = $this->get_progress_lead();
        $target = $this->get_target_lead();

        return Orm_Sp_Strategy::draw_status($progress, $target, $this->get_start_date(), $this->get_end_date());

    }

    /**
     * this function get trend lead
     * @return string the call function
     */
    public function get_trend_lead() {

        $progress = $this->get_progress_lead();
        $progress_last = $this->get_progress_lead(true);

        return Orm_Sp_Strategy::draw_trend($progress, $progress_last);
    }

    /**
     * this function draw gauge lead
     * @return string the call function
     */
    public function draw_gauge_lead() {

        $progress = $this->get_progress_lead();
        $target = (int) $this->get_target_lead();

        return Orm_Sp_Strategy::draw_gauge($progress, $target);
    }

    /**
     * this function get child start date
     * @return string the call function
     */
    public function get_child_start_date() {
        return self::get_model()->get_date_range($this->get_id());
    }

    /**
     * this function get child end date
     * @return string the call function
     */
    public function get_child_end_date() {
        return self::get_model()->get_date_range($this->get_id(), 'end_date');
    }
    /**
     * this function get total budget
     * @return float|int the call function
     */
    public function get_total_budget() {
        $budgets = self::get_model()->get_all(array('action_plan_id' => $this->get_action_plan_id(), 'not_id' => $this->get_id()), 0,0,array(), Orm::FETCH_ARRAY);
        return array_sum(array_column($budgets, 'budget'));
    }

    /**
     *
     */
    public function compute_progress() {
        $this->set_lead($this->compute_progress_lead());
        $this->set_lag($this->compute_progress_lag());
        $this->save();

        if($this->get_parent_id()) {
            $this->get_parent_obj()->compute_progress();
        }
    }

    /**
     * this function compute progress lag
     * @return int the call function
     */
    public function compute_progress_lag() {

        $progress = 0;

        return $progress;
    }

    /**
     * this function compute progress lead
     * @return float|int the call function
     */
    public function compute_progress_lead() {

        $progress = 0;

        if ($this->get_children()) {

            $total_lead = 0;
            $total_weight = 0;

            foreach ($this->get_children() as $child) {
                $total_lead += $child->get_lead();
                $total_weight += 1;
            }

            $progress = $total_weight ? $total_lead / $total_weight : 0;

        } elseif($this->get_activities()) {

            $total_lead = 0;
            $total_weight = 0;

            foreach ($this->get_activities() as $activity) {
                $total_lead += ($activity->get_lead() * $activity->get_weight());
                $total_weight += $activity->get_weight();
            }

            $progress = $total_weight ? $total_lead / $total_weight : 0;
        }

        return $progress;
    }
}

