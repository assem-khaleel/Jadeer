<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Course_Learning_Outcome_Target extends Orm {
    
    /**
    * @var $instances Orm_Cm_Course_Learning_Outcome_Target[]
    */
    protected static $instances = array();
    protected static $table_name = 'cm_course_learning_outcome_target';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $course_learning_outcome_id = 0;
    protected $target = 0;
    
    /**
    * @return Cm_Course_Learning_Outcome_Target_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Course_Learning_Outcome_Target_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Course_Learning_Outcome_Target
    */
    public static function get_instance($id) {
        
        $id = intval($id);
        
        if(isset(self::$instances[$id])) {
            return self::$instances[$id];
        }
        
        return self::get_one(array('id' => $id));
    }
    
    /**
    * Get all rows as Objects
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    *
    * @return Orm_Cm_Course_Learning_Outcome_Target[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Course_Learning_Outcome_Target
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Course_Learning_Outcome_Target();
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
        $db_params['course_learning_outcome_id'] = $this->get_course_learning_outcome_id();
        $db_params['target'] = $this->get_target();
        
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
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_course_learning_outcome_id($value) {
        $this->add_object_field('course_learning_outcome_id', $value);
        $this->course_learning_outcome_id = $value;
    }
    
    public function get_course_learning_outcome_id() {
        return $this->course_learning_outcome_id;
    }
    
    public function set_target($value) {
        $this->add_object_field('target', $value);
        $this->target = $value;
    }
    
    public function get_target() {
        return $this->target;
    }

    /**
     * get the archive data using semester
     * @param $semester_id
     */
    public static function archive($semester_id) {
        self::get_model()->archive($semester_id);
    }
}

