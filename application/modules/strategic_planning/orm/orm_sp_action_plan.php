<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Action_Plan extends Orm
{

    /**
     * @var $instances Orm_Sp_Action_Plan[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_action_plan';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $initiative_id = 0;
    protected $responsible_id = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $start_date = '0000-00-00';
    protected $end_date = '0000-00-00';
    protected $budget = 0.00;
    protected $resources = '';
    protected $lead = 0;
    protected $lag = 0;

    /**
     * @return Sp_Action_Plan_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Action_Plan_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Action_Plan
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
     * @return Orm_Sp_Action_Plan[] | int
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
     * @return Orm_Sp_Action_Plan
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Action_Plan();
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
        $db_params['initiative_id'] = $this->get_initiative_id();
        $db_params['responsible_id'] = $this->get_responsible_id();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
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
            $this->get_initiative_obj()->compute_progress();
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    public function set_id($value)
    {
        $this->add_object_field('id',$value);
        $this->id = (int) $value;
        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_initiative_id($value)
    {
        $this->add_object_field('initiative_id',$value);
        $this->initiative_id = (int) $value;
    }

    public function get_initiative_id()
    {
        return $this->initiative_id;
    }

    public function set_responsible_id($value)
    {
        $this->add_object_field('responsible_id',$value);
        $this->responsible_id = (int) $value;
    }

    public function get_responsible_id()
    {
        return $this->responsible_id;
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
     * this function get initiative obj
     * @return Orm_Sp_Initiative the object call function
     */
    public function get_initiative_obj() {
        return Orm_Sp_Initiative::get_instance($this->get_initiative_id());
    }

    public function get_title($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_title_ar() : $this->get_title_en();
    }

    private $projects = null;
    /**
     * this function get projects
     * @return Orm_Sp_Project[] the call function
     */
    public function get_projects() {
        if(is_null($this->projects)) {
            $this->projects = Orm_Sp_Project::get_all(array('action_plan_id' => $this->get_id()));
        }
        return $this->projects;
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
            $this->progress_lead[$period] = Orm_Sp_Strategy::get_progress_type('action_plan', $this->get_id(), 'lead', $last_period);
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
            $this->target_lead = Orm_Sp_Strategy::get_target_type('action_plan', $this->get_id());
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
     * get activities with project titles and dates by action plan id
     * @param array $filters
     * @return array
     */
    public function get_activities($filters = array()) {
        return $this->get_model()->get_activities($this->get_id(), $filters);
    }

    /**
     * get recommendations with recommendation types titles
     * @return array
     */
    public function get_recommendations() {
        $list = $this->get_model()->get_recommendations($this->get_id());

        $results = array();
        foreach ($list as $item) {
            $type = array(
                'id' => $item['id'],
                'title_en' => $item['title_en'],
                'title_ar' => $item['title_ar'],
                'code' => $item['code']
            );
            $rec = array(
                'id' => $item['recommend_id'],
                'title_en' => $item['recommend_title_en'],
                'title_ar' => $item['recommend_title_ar'],
                'type_id' => $item['type_id']
            );
            $results[$item['id']] = $type;
            $results[$item['id']]['data'][$item['recommend_id']] = $rec;
        }
        return $results;
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
    /**
     * this function get total budget
     * @return float|int the call function
     */
    public function get_total_budget() {
        $budgets = self::get_model()->get_all(array('objective_id' => $this->get_initiative_obj()->get_objective_id(), 'not_id' => $this->get_id()), 0,0,array(), Orm::FETCH_ARRAY);
        return array_sum(array_column($budgets, 'budget'));
    }

    /**
     * this function compute progress
     * @redirect success or error
     */
    public function compute_progress() {
        $this->set_lead($this->compute_progress_lead());
        $this->set_lag($this->compute_progress_lag());
        $this->save();
    }
    /**
     * this function compute progress lag
     * @return int the call function
     */
    public function compute_progress_lag() {
        return 0;
    }
    /**
     * this function compute progress lead
     * @return float|int the call function
     */
    public function compute_progress_lead() {

        $progress = 0;

        if($this->get_projects()) {

            $total_lead = 0;
            $total_weight = 0;

            foreach ($this->get_projects() as $project) {
                $total_lead += $project->get_lead();
                $total_weight += 1;
            }

            $progress = $total_weight ? $total_lead / $total_weight : 0;
        }

        return $progress;
    }
}

