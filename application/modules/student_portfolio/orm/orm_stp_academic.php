<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Stp_Academic extends Orm {
    
    /**
    * @var $instances Orm_Stp_Academic[]
    */
    protected static $instances = array();
    protected static $table_name = 'stp_academic';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $student_id = 0;
    protected $lms_link = '';
    protected $edugate_link = '';
    protected $student_academic_advicing = '';
    
    /**
    * @return Stp_Academic_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Stp_Academic_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Stp_Academic
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
    * @return Orm_Stp_Academic[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Stp_Academic
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Stp_Academic();
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
        $db_params['lms_link'] = $this->get_lms_link();
        $db_params['edugate_link'] = $this->get_edugate_link();
        $db_params['student_academic_advicing'] = $this->get_student_academic_advicing();
        
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
    
    public function set_lms_link($value) {
        $this->add_object_field('lms_link', $value);
        $this->lms_link = $value;
    }
    
    public function get_lms_link() {
        return $this->lms_link;
    }
    
    public function set_edugate_link($value) {
        $this->add_object_field('edugate_link', $value);
        $this->edugate_link = $value;
    }
    
    public function get_edugate_link() {
        return $this->edugate_link;
    }
    
    public function set_student_academic_advicing($value) {
        $this->add_object_field('student_academic_advicing', $value);
        $this->student_academic_advicing = $value;
    }
    
    public function get_student_academic_advicing() {
        return $this->student_academic_advicing;
    }
    
    
}

