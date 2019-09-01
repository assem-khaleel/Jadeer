<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Data_Course_Pre extends Orm {
    
    /**
    * @var $instances Orm_Data_Course_Pre[]
    */
    protected static $instances = array();
    protected static $table_name = 'data_course_pre';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $program_id = 0;
    protected $course_id = 0;
    protected $pre_course_id = 0;
    
    /**
    * @return Data_Course_Pre_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Data_Course_Pre_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Data_Course_Pre
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
    * @return Orm_Data_Course_Pre[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Data_Course_Pre
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Data_Course_Pre();
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
        $db_params['course_id'] = $this->get_course_id();
        $db_params['pre_course_id'] = $this->get_pre_course_id();
        
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
    
    public function set_course_id($value) {
        $this->add_object_field('course_id',$value);
        $this->course_id = $value;
    }
    
    public function get_course_id() {
        return $this->course_id;
    }
    
    public function set_pre_course_id($value) {
        $this->add_object_field('pre_course_id',$value);
        $this->pre_course_id = $value;
    }
    
    public function get_pre_course_id() {
        return $this->pre_course_id;
    }
    
    public function get_pre_course_obj() {
        return Orm_Course::get_instance($this->get_pre_course_id());
    }

    public function get_course_obj() {
        return Orm_Course::get_instance($this->get_course_id());
    }
    
    public function get_program_obj() {
        return Orm_Program::get_instance($this->get_program_id());
    }
}

