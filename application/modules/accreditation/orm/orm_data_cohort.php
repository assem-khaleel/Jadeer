<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Data_Cohort extends Orm {
    
    /**
    * @var $instances Orm_Data_Cohort[]
    */
    protected static $instances = array();
    protected static $table_name = 'data_cohort';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $program_id = 0;
    protected $report_year = 0;
    protected $level_year = 0;
    protected $started_on = '0000-00-00';
    protected $status_id = 0;
    protected $student_count = 0;
    
    /**
    * @return Data_Cohort_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Data_Cohort_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Data_Cohort
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
    * @return Orm_Data_Cohort[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Data_Cohort
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Data_Cohort();
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
        $db_params['report_year'] = $this->get_report_year();
        $db_params['level_year'] = $this->get_level_year();
        $db_params['started_on'] = $this->get_started_on();
        $db_params['status_id'] = $this->get_status_id();
        $db_params['student_count'] = $this->get_student_count();
        
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
    
    public function set_report_year($value) {
        $this->add_object_field('report_year',$value);
        $this->report_year = $value;
    }
    
    public function get_report_year() {
        return $this->report_year;
    }
    
    public function set_level_year($value) {
        $this->add_object_field('level_year',$value);
        $this->level_year = $value;
    }
    
    public function get_level_year() {
        return $this->level_year;
    }
    
    public function set_started_on($value) {
        $this->add_object_field('started_on',$value);
        $this->started_on = $value;
    }
    
    public function get_started_on() {
        return $this->started_on;
    }
    
    public function set_status_id($value) {
        $this->add_object_field('status_id',$value);
        $this->status_id = $value;
    }
    
    public function get_status_id() {
        return $this->status_id;
    }
    
    public function set_student_count($value) {
        $this->add_object_field('student_count',$value);
        $this->student_count = $value;
    }
    
    public function get_student_count() {
        return $this->student_count;
    }
    
    
}

