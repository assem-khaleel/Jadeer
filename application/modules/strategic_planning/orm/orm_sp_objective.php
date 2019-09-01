<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Objective extends Orm
{

    /**
     * @var $instances Orm_Sp_Objective[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_objective';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $strategy_id = 0;
    protected $objective_id = 0;
    protected $parent_id = 0;
    protected $parent_lft = 0;
    protected $parent_rtl = 0;
    protected $goal_id = 0;
    protected $code = '';
    protected $title_en = '';
    protected $title_ar = '';
    protected $start_date = '0000-00-00';
    protected $end_date = '0000-00-00';
    protected $description_en = '';
    protected $description_ar = '';
    protected $owner_id = 0;
    protected $budget = 0;
    protected $resources = '';
    protected $lead = 0;
    protected $lag = 0;
    //
    private $children = array();
    private static $prepare_children = false;

    const PERSPECTIVE_FINANCIAL = "finance";
    const PERSPECTIVE_CUSTOMER = "customer";
    const PERSPECTIVE_BUSINESS_PROCESS = "internal_processes";
    const PERSPECTIVE_LEARNING_GROWTH = "learning_and_growth";

    const PERSPECTIVE_FINANCIAL_STR = "Finance";
    const PERSPECTIVE_CUSTOMER_STR = "Customer";
    const PERSPECTIVE_BUSINESS_PROCESS_STR = "Internal Processes";
    const PERSPECTIVE_LEARNING_GROWTH_STR = "Learning and Growth";

    /**
     * @return Sp_Objective_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Objective_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Objective
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
     * @return Orm_Sp_Objective[] | int
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
     * @return Orm_Sp_Objective
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Objective();
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
        $db_params['strategy_id'] = $this->get_strategy_id();
        $db_params['objective_id'] = $this->get_objective_id();
        $db_params['parent_id'] = $this->get_parent_id();
        $db_params['parent_lft'] = $this->get_parent_lft();
        $db_params['parent_rtl'] = $this->get_parent_rtl();
        $db_params['goal_id'] = $this->get_goal_id();
        $db_params['code'] = $this->get_code();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        $db_params['description_en'] = $this->get_description_en();
        $db_params['description_ar'] = $this->get_description_ar();
        $db_params['owner_id'] = $this->get_owner_id();
        $db_params['budget'] = $this->get_budget();
        $db_params['resources'] = $this->get_resources();
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
            $this->get_goal_obj()->compute_progress();
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    public function prepare_children()
    {
        if(!self::$prepare_children) {

            $objectives = self::get_all(array('objective_id' => $this->get_objective_id(), 'parent_lft' => $this->get_parent_lft(), 'parent_rtl' => $this->get_parent_rtl()));

            if ($objectives) {
                foreach ($objectives as $objective) {
                    if ($objective->get_parent_id()) {
                        $parent = self::get_instance($objective->get_parent_id());
                        $parent->add_child($objective);
                    }
                }
            }

            self::$prepare_children = true;
        }

        return $this;
    }

    public function add_child(Orm_Sp_Objective $objective) {
        $this->children[$objective->get_id()] = $objective;
    }

    /**
     * @return Orm_Sp_Objective[]
     */
    public function get_children()
    {
        return $this->prepare_children()->children;
    }

    /**
     * @return Orm_Sp_Objective
     */
    public function reset_children()
    {
        self::$prepare_children = false;
        return $this;
    }

    public function build_parent_tree() {

        $old_id = $this->get_objective_id();

        if($this->get_parent_id()) {
            $this->set_objective_id($this->get_parent_obj()->get_objective_id());
        } else {
            $this->set_objective_id($this->get_id());
        }

        $this->save();

        self::get_model()->update_group_tree($old_id ,$this->get_objective_id(), $this->get_parent_lft(), $this->get_parent_rtl());
        self::get_model()->build_parent_tree($this->get_objective_id());
    }

    /**
     * return Orm_Sp_Objective
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

    public function set_strategy_id($value)
    {
        $this->add_object_field('strategy_id',$value);
        $this->strategy_id = $value;
    }

    public function get_strategy_id()
    {
        return $this->strategy_id;
    }

    public function set_objective_id($value)
    {
        $this->add_object_field('objective_id',$value);
        $this->objective_id = $value;
    }

    public function get_objective_id()
    {
        return $this->objective_id;
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

    public function set_goal_id($value)
    {
        $this->add_object_field('goal_id',$value);
        $this->goal_id = $value;
    }

    public function get_goal_id()
    {
        return $this->goal_id;
    }

    public function set_code($value)
    {
        $this->add_object_field('code',$value);
        $this->code = $value;
    }

    public function get_code()
    {
        return $this->code;
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

    public function set_description_en($value)
    {
        $this->add_object_field('description_en',$value);
        $this->description_en = $value;
    }

    public function get_description_en()
    {
        return $this->description_en;
    }

    public function set_description_ar($value)
    {
        $this->add_object_field('description_ar',$value);
        $this->description_ar = $value;
    }

    public function get_description_ar()
    {
        return $this->description_ar;
    }

    public function set_owner_id($value)
    {
        $this->add_object_field('owner_id',$value);
        $this->owner_id = $value;
    }

    public function get_owner_id()
    {
        return $this->owner_id;
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
     * @return Orm_Sp_Strategy_Institution | Orm_Sp_Strategy_College | Orm_Sp_Strategy_Program | Orm_Sp_Strategy_Unit | Orm_Sp_Strategy
     */
    public function get_strategy_obj() {
        return Orm_Sp_Strategy::get_instance($this->get_strategy_id());
    }

    /**
     * @return Orm_Sp_Goal
     */
    public function get_goal_obj() {
        return Orm_Sp_Goal::get_instance($this->get_goal_id());
    }

    public function get_title($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_title_ar() : $this->get_title_en();
    }

    public function get_description($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_description_ar() : $this->get_description_en();
    }

    public function set_start_date($value){
        $this->add_object_field('start_date',$value);
        $this->start_date = $value;
    }

    public function get_start_date(){
        return $this->start_date;
    }

    public function set_end_date($value){
        $this->add_object_field('end_date',$value);
        $this->end_date = $value;
    }

    public function get_end_date(){
        return $this->end_date;
    }

    private $progress_lag = null;
    /**
     * this function get progress lag by its last period
     * @param bool $last_period the last period of the get progress lead to be call function
     * @return mixed the call function
     */
    public function get_progress_lag($last_period = false) {

        $period = 'current';
        if($last_period) {
            $period = 'previous';
        }

        if(!isset($this->progress_lag[$period])) {
            $this->progress_lag[$period] = Orm_Sp_Strategy::get_progress_type('objective', $this->get_id(), 'lag', $last_period);
        }

        return $this->progress_lag[$period];
    }

    private $target_lag = null;
    /**
     * this function get target lag
     * @return int|null the call function
     */
    public function get_target_lag() {

        if(is_null($this->target_lag)) {
            $this->target_lag = Orm_Sp_Strategy::get_target_type('objective', $this->get_id());
        }

        return $this->target_lag;
    }
    /**
     * this function get status lag
     * @return string the call function
     */
    public function get_status_lag() {

        $progress = $this->get_progress_lag();
        $target = (int) $this->get_target_lag();

        return Orm_Sp_Strategy::draw_status($progress, $target, $this->get_start_date(), $this->get_end_date());
    }
    /**
     * this function get trend lag
     * @return string the call function
     */
    public function get_trend_lag() {

        $progress = $this->get_progress_lag();
        $progress_last = $this->get_progress_lag(true);

        return Orm_Sp_Strategy::draw_trend($progress, $progress_last);
    }
    /**
     * this function get gauge lag
     * @return string the call function
     */
    public function draw_gauge_lag() {

        $progress = $this->get_progress_lag();

        return Orm_Sp_Strategy::draw_gauge_bands($progress);
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
            $this->progress_lead[$period] = Orm_Sp_Strategy::get_progress_type('objective', $this->get_id(), 'lead', $last_period);
        }

        return $this->progress_lead[$period];
    }

    private $target_lead = null;

    /**
     * this function get target lead
     * @return int|null the call function
     */
    public function get_target_lead() {

        if(is_null($this->target_lead)) {
            $this->target_lead = Orm_Sp_Strategy::get_target_type('objective', $this->get_id());
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
     * this function get child total budget
     * @return int the call function
     */
    public function get_child_total_budget() {
        return self::get_model()->get_child_total_budget($this->get_id());
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

    private $initiatives = null;
    /**
     * this function get initiatives
     * @return Orm_Sp_Initiative[] the call function
     */
    public function get_initiatives() {
        if(is_null($this->initiatives)) {
            $this->initiatives = Orm_Sp_Initiative::get_all(array('objective_id' => $this->get_id()));
        }
        return $this->initiatives;
    }

    private $kpis = null;
    /**
     * this function get kpis
     * @return int|null|Orm_Sp_Kpi[] the call function
     */
    public function get_kpis(){
        if (is_null($this->kpis)) {
            $this->kpis = Orm_Sp_Kpi::get_all(array('class_type' => 'Orm_Sp_Objective', 'type_id' => $this->get_id()));
        }
        return $this->kpis;
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
     * @return float|int the call function
     */
    public function compute_progress_lag() {
        $progress = 0;

        if ($this->get_kpis()) {
            $total_lag = 0;
            $total_weight = 0;
            foreach ($this->get_kpis() as $kpi) {
                $total_lag += $kpi->get_band();
                $total_weight += 1;
            }

            $progress = $total_weight ? $total_lag / $total_weight : 0;
        }

        return $progress;
    }

    /**
     * this function compute progress lead
     * @return float|int the call function
     */
    public function compute_progress_lead() {
        $progress = 0;

        if($this->get_initiatives()) {

            $total_lead = 0;
            $total_weight = 0;

            foreach ($this->get_initiatives() as $initiative) {
                $total_lead += $initiative->get_lead();
                $total_weight += 1;
            }

            $progress = $total_weight ? $total_lead / $total_weight : 0;
        }

        return $progress;
    }
    /**
     * this function get perspectives
     * @return Orm_Sp_Objective_Perspective[] the object call function
     */
    public function get_perspectives() {
        return Orm_Sp_Objective_Perspective::get_all(array('objective_id' => $this->get_id()));
    }
}