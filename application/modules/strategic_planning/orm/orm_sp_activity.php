<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Activity extends Orm
{

    /**
     * @var $instances Orm_Sp_Activity[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_activity';


    /**
     * class attributes
     */
    protected $id = 0;
    protected $project_id = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $start_date = '0000-00-00';
    protected $end_date = '0000-00-00';
    protected $weight = 1;
    protected $lead = 0;
    protected $lag = 0;

    /**
     * @return Sp_Activity_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Activity_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Activity
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
     * @return Orm_Sp_Activity[] | int
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
     * @return Orm_Sp_Activity
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Activity();
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
        $db_params['project_id'] = $this->get_project_id();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        $db_params['weight'] = $this->get_weight();
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

        if($this->check_object_field('lead') || $this->check_object_field('lag') || $this->check_object_field('weight')) {
            $this->get_project_obj()->compute_progress();
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
        $this->id = $value;
        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
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

    public function set_weight($value)
    {
        $this->add_object_field('weight',$value);
        $this->weight = $value;
    }

    public function get_weight()
    {
        return $this->weight;
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
     * this function get recommendation obj
     * @return Orm_Sp_Project the object call function
     */
    public function get_project_obj() {
        return Orm_Sp_Project::get_instance($this->get_project_id());
    }

    public function get_title($lang  = UI_LANG) {
        return $lang == 'arabic' ? $this->get_title_ar() : $this->get_title_en();
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
            $this->progress_lead[$period] = Orm_Sp_Strategy::get_progress_type('activity', $this->get_id(), 'lead', $last_period);
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
            $this->target_lead = Orm_Sp_Strategy::get_target_type('activity', $this->get_id());
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

}

