<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pc_Report_Components extends Orm {
    
    /**
    * @var $instances Orm_Pc_Report_Components[]
    */
    protected static $instances = array();
    protected static $table_name = 'pc_report_components';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $report_id = 0;
    protected $component_id = 0;
    protected $is_core = 1;

    /**
    * @return Pc_Report_Components_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pc_Report_Components_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pc_Report_Components
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
    * @return Orm_Pc_Report_Components[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pc_Report_Components
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pc_Report_Components();
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
        $db_params['report_id'] = $this->get_report_id();
        $db_params['component_id'] = $this->get_component_id();
        $db_params['is_core'] = $this->get_is_core();

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
    
    public function set_report_id($value) {
        $this->add_object_field('report_id', $value);
        $this->report_id = $value;
    }
    
    public function get_report_id() {
        return $this->report_id;
    }
    
    public function set_component_id($value) {
        $this->add_object_field('component_id', $value);
        $this->component_id = $value;
    }
    
    public function get_component_id() {
        return $this->component_id;
    }

    public function get_component_obj() {
        return Orm_Pc_Category::get_instance($this->get_component_id());
    }

    public function set_is_core($value) {
        $this->add_object_field('is_core', $value);
        $this->is_core = $value;
    }

    public function get_is_core() {
        return $this->is_core;
    }
    
    
}

