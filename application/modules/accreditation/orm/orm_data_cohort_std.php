<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Data_Cohort_Std extends Orm {
    
    /**
    * @var $instances Orm_Data_Cohort_Std[]
    */
    protected static $instances = array();
    protected static $table_name = 'data_cohort_std';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $program_id = 0;
    protected $academic_year = 0;
    protected $start_year = 0;
    protected $enrolled = 0;
    protected $plan_duration = 0;
    protected $level = 0;
    protected $completion_status = 0;
    protected $withdrawn_enrolled = 0;
    protected $withdrawn_good = 0;
    protected $graduated = 0;
    
    /**
    * @return Data_Cohort_Std_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Data_Cohort_Std_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Data_Cohort_Std
    */
    public static function get_instance($id) {
        
        $id = intval($id);
        if(isset(self::$instances[$id])) {
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
    * @return Orm_Data_Cohort_Std[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Data_Cohort_Std
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Data_Cohort_Std();
    }
    
    /**
    * get count
    *
    * @param array $filters
    * @return int
    */
    public static function get_count($filters = array()) {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }
    
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['program_id'] = $this->get_program_id();
        $db_params['academic_year'] = $this->get_academic_year();
        $db_params['start_year'] = $this->get_start_year();
        $db_params['enrolled'] = $this->get_enrolled();
        $db_params['plan_duration'] = $this->get_plan_duration();
        $db_params['level'] = $this->get_level();
        $db_params['completion_status'] = $this->get_completion_status();
        $db_params['withdrawn_enrolled'] = $this->get_withdrawn_enrolled();
        $db_params['withdrawn_good'] = $this->get_withdrawn_good();
        $db_params['graduated'] = $this->get_graduated();
        
        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }
    
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }
    
    public function set_id($value) {
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_program_id($value) {
        $this->add_object_field('program_id',$value);
        $this->program_id = $value;
    }
    
    public function get_program_id() {
        return $this->program_id;
    }
    
    public function set_academic_year($value) {
        $this->add_object_field('academic_year',$value);
        $this->academic_year = $value;
    }
    
    public function get_academic_year() {
        return $this->academic_year;
    }
    
    public function set_start_year($value) {
        $this->add_object_field('start_year',$value);
        $this->start_year = $value;
    }
    
    public function get_start_year() {
        return $this->start_year;
    }
    
    public function set_enrolled($value) {
        $this->add_object_field('enrolled',$value);
        $this->enrolled = $value;
    }
    
    public function get_enrolled() {
        return $this->enrolled;
    }
    
    public function set_plan_duration($value) {
        $this->add_object_field('plan_duration',$value);
        $this->plan_duration = $value;
    }
    
    public function get_plan_duration() {
        return $this->plan_duration;
    }
    
    public function set_level($value) {
        $this->add_object_field('level',$value);
        $this->level = $value;
    }
    
    public function get_level() {
        return $this->level;
    }
    
    public function set_completion_status($value) {
        $this->add_object_field('completion_status',$value);
        $this->completion_status = $value;
    }
    
    public function get_completion_status() {
        return $this->completion_status;
    }
    
    public function set_withdrawn_enrolled($value) {
        $this->add_object_field('withdrawn_enrolled',$value);
        $this->withdrawn_enrolled = $value;
    }
    
    public function get_withdrawn_enrolled() {
        return $this->withdrawn_enrolled;
    }
    
    public function set_withdrawn_good($value) {
        $this->add_object_field('withdrawn_good',$value);
        $this->withdrawn_good = $value;
    }
    
    public function get_withdrawn_good() {
        return $this->withdrawn_good;
    }
    
    public function set_graduated($value) {
        $this->add_object_field('graduated',$value);
        $this->graduated = $value;
    }
    
    public function get_graduated() {
        return $this->graduated;
    }
    
    
}

