<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Stp_Activities extends Orm {
    
    /**
    * @var $instances Orm_Stp_Activities[]
    */
    protected static $instances = array();
    protected static $table_name = 'stp_activities';


    /**
    * class attributes
    */
    protected $id = 0;
    protected $student_id = 0;
    protected $title = '';
    protected $date = '0000-00-00';
    
    /**
    * @return Stp_Activities_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Stp_Activities_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Stp_Activities
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
    * @return Orm_Stp_Activities[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Stp_Activities
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Stp_Activities();
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
        $db_params['title'] = $this->get_title();
        $db_params['date'] = $this->get_date();
        
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
    
    public function set_title($value) {
        $this->add_object_field('title', $value);
        $this->title = $value;
    }
    
    public function get_title() {
        return $this->title;
    }
    
    public function set_date($value) {
        $this->add_object_field('date', $value);
        $this->date = $value;
    }
    
    public function get_date() {
        return $this->date;
    }
    
    
}

