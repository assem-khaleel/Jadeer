<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pc_Instructor_Information extends Orm {
    
    /**
    * @var $instances Orm_Pc_Instructor_Information[]
    */
    protected static $instances = array();
    protected static $table_name = 'pc_instructor_information';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $faculty_id = 0;
    protected $section_id = 0;
    protected $office_location = '';
    protected $office_hours = '';
    
    /**
    * @return Pc_Instructor_Information_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pc_Instructor_Information_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pc_Instructor_Information
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
    * @return Orm_Pc_Instructor_Information[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pc_Instructor_Information
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pc_Instructor_Information();
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
        $db_params['faculty_id'] = $this->get_faculty_id();
        $db_params['section_id'] = $this->get_section_id();
        $db_params['office_location'] = $this->get_office_location();
        $db_params['office_hours'] = $this->get_office_hours();
        
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
    
    public function set_faculty_id($value) {
        $this->add_object_field('faculty_id', $value);
        $this->faculty_id = $value;
    }
    
    public function get_faculty_id() {
        return $this->faculty_id;
    }
    
    public function set_section_id($value) {
        $this->add_object_field('section_id', $value);
        $this->section_id = $value;
    }
    
    public function get_section_id() {
        return $this->section_id;
    }
    
    public function set_office_location($value) {
        $this->add_object_field('office_location', $value);
        $this->office_location = $value;
    }
    
    public function get_office_location() {
        return $this->office_location;
    }
    
    public function set_office_hours($value) {
        $this->add_object_field('office_hours', $value);
        $this->office_hours = $value;
    }
    
    public function get_office_hours() {
        return $this->office_hours;
    }
    
    
}

