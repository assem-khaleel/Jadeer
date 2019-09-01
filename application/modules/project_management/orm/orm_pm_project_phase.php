<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pm_Project_Phase extends Orm {
    
    /**
    * @var $instances Orm_Pm_Project_Phase[]
    */
    protected static $instances = array();
    protected static $table_name = 'pm_project_phase';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $project_id = 0;
    protected $phase_id = 0;
    protected $project_type = 0;
    
    /**
    * @return Pm_Project_Phase_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pm_Project_Phase_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pm_Project_Phase
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
    * @return Orm_Pm_Project_Phase[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pm_Project_Phase
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pm_Project_Phase();
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

    /** convert object to array
    */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['project_id'] = $this->get_project_id();
        $db_params['phase_id'] = $this->get_phase_id();
        $db_params['project_type'] = $this->get_project_type();
        
        return $db_params;
    }

    /** save object
    */
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

    /** delete object
    */
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
    
    public function set_project_id($value) {
        $this->add_object_field('project_id', $value);
        $this->project_id = $value;
    }
    
    public function get_project_id() {
        return $this->project_id;
    }
    
    public function set_phase_id($value) {
        $this->add_object_field('phase_id', $value);
        $this->phase_id = $value;
    }
    
    public function get_phase_id() {
        return $this->phase_id;
    }
    
    public function set_project_type($value) {
        $this->add_object_field('project_type', $value);
        $this->project_type = $value;
    }
    
    public function get_project_type() {
        return $this->project_type;
    }
    
    
}

