<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sst_Criteria_Map extends Orm {
    
    /**
    * @var $instances Orm_Sst_Criteria_Map[]
    */
    protected static $instances = array();
    protected static $table_name = 'sst_criteria_map';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $criteria_id = 0;
    protected $rubric_skill_id = 0;
    
    /**
    * @return Sst_Criteria_Map_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Sst_Criteria_Map_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Sst_Criteria_Map
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
    * @return Orm_Sst_Criteria_Map[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Sst_Criteria_Map
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Sst_Criteria_Map();
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
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['criteria_id'] = $this->get_criteria_id();
        $db_params['rubric_skill_id'] = $this->get_rubric_skill_id();
        
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
    
    public function set_name_en($value) {
        $this->add_object_field('name_en', $value);
        $this->name_en = $value;
    }
    
    public function get_name_en() {
        return $this->name_en;
    }
    
    public function set_name_ar($value) {
        $this->add_object_field('name_ar', $value);
        $this->name_ar = $value;
    }
    
    public function get_name_ar() {
        return $this->name_ar;
    }
    
    public function set_criteria_id($value) {
        $this->add_object_field('criteria_id', $value);
        $this->criteria_id = $value;
    }
    
    public function get_criteria_id() {
        return $this->criteria_id;
    }
    
    public function set_rubric_skill_id($value) {
        $this->add_object_field('rubric_skill_id', $value);
        $this->rubric_skill_id = $value;
    }
    
    public function get_rubric_skill_id() {
        return $this->rubric_skill_id;
    }
    
    
}

