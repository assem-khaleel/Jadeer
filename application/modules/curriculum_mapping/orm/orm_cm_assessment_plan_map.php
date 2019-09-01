<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Assessment_Plan_Map extends Orm {
    
    /**
    * @var $instances Orm_Cm_Assessment_Plan_Map[]
    */
    protected static $instances = array();
    protected static $table_name = 'cm_assessment_plan_map';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $assessment_plan_id = 0;
    protected $assessment_method_id = 0;
    
    /**
    * @return Cm_Assessment_Plan_Map_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Assessment_Plan_Map_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Assessment_Plan_Map
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
    * @return Orm_Cm_Assessment_Plan_Map[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Assessment_Plan_Map
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Assessment_Plan_Map();
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
        $db_params['assessment_plan_id'] = $this->get_assessment_plan_id();
        $db_params['assessment_method_id'] = $this->get_assessment_method_id();
        
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
    public static function delete_map($assessment_plan_id) {
        return self::get_model()->delete_map($assessment_plan_id);
    }
    
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_assessment_plan_id($value) {
        $this->add_object_field('assessment_plan_id', $value);
        $this->assessment_plan_id = $value;
    }
    
    public function get_assessment_plan_id() {
        return $this->assessment_plan_id;
    }
    
    public function set_assessment_method_id($value) {
        $this->add_object_field('assessment_method_id', $value);
        $this->assessment_method_id = $value;
    }
    
    public function get_assessment_method_id() {
        return $this->assessment_method_id;
    }

    /**
     * get all data of course assessment method using assessment method id
     * @return Orm_Cm_Course_Assessment_Method
     */
    public function get_method_obj(){
        return Orm_Cm_Course_Assessment_Method::get_instance($this->get_assessment_method_id());
    }
    
    
}

