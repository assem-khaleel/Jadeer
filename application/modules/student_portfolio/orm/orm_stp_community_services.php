<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Stp_Community_Services extends Orm {
    
    /**
    * @var $instances Orm_Stp_Community_Services[]
    */
    protected static $instances = array();
    protected static $table_name = 'stp_community_services';


    /**
    * class attributes
    */
    protected $id = 0;
    protected $student_id = 0;
    protected $date = '0000-00-00';
    protected $location = '';
    protected $number_of_hours = 0;
    protected $supervisor = '';
    protected $description = '';
    
    /**
    * @return Stp_Community_Services_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Stp_Community_Services_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Stp_Community_Services
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
    * @return Orm_Stp_Community_Services[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Stp_Community_Services
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Stp_Community_Services();
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
        $db_params['student_id'] = $this->get_student_id();
        $db_params['date'] = $this->get_date();
        $db_params['location'] = $this->get_location();
        $db_params['number_of_hours'] = $this->get_number_of_hours();
        $db_params['supervisor'] = $this->get_supervisor();
        $db_params['description'] = $this->get_description();
        
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
    
    public function set_student_id($value) {
        $this->add_object_field('student_id', $value);
        $this->student_id = $value;
    }
    
    public function get_student_id() {
        return $this->student_id;
    }
    
    public function set_date($value) {
        $this->add_object_field('date', $value);
        $this->date = $value;
    }
    
    public function get_date() {
        return $this->date;
    }
    
    public function set_location($value) {
        $this->add_object_field('location', $value);
        $this->location = $value;
    }
    
    public function get_location() {
        return $this->location;
    }
    
    public function set_number_of_hours($value) {
        $this->add_object_field('number_of_hours', $value);
        $this->number_of_hours = $value;
    }
    
    public function get_number_of_hours() {
        return $this->number_of_hours;
    }
    
    public function set_supervisor($value) {
        $this->add_object_field('supervisor', $value);
        $this->supervisor = $value;
    }
    
    public function get_supervisor() {
        return $this->supervisor;
    }
    
    public function set_description($value) {
        $this->add_object_field('description', $value);
        $this->description = $value;
    }
    
    public function get_description() {
        return $this->description;
    }
    
    
}

