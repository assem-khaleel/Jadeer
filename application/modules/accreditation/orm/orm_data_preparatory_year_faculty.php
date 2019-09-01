<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Data_Preparatory_Year_Faculty extends Orm {
    
    /**
    * @var $instances Orm_Data_Preparatory_Year_Faculty[]
    */
    protected static $instances = array();
    protected static $table_name = 'data_preparatory_year_faculty';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $stream = '';
    protected $academic_year = 0;
    protected $gender = 0;
    protected $teacher_count = 0;
    
    /**
    * @return Data_Preparatory_Year_Faculty_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Data_Preparatory_Year_Faculty_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Data_Preparatory_Year_Faculty
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
    * @return Orm_Data_Preparatory_Year_Faculty[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Data_Preparatory_Year_Faculty
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Data_Preparatory_Year_Faculty();
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
        $db_params['stream'] = $this->get_stream();
        $db_params['academic_year'] = $this->get_academic_year();
        $db_params['gender'] = $this->get_gender();
        $db_params['teacher_count'] = $this->get_teacher_count();
        
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
    
    public function set_stream($value) {
        $this->add_object_field('stream', $value);
        $this->stream = $value;
    }
    
    public function get_stream() {
        return $this->stream;
    }
    
    public function set_academic_year($value) {
        $this->add_object_field('academic_year', $value);
        $this->academic_year = $value;
    }
    
    public function get_academic_year() {
        return $this->academic_year;
    }
    
    public function set_gender($value) {
        $this->add_object_field('gender', $value);
        $this->gender = $value;
    }
    
    public function get_gender() {
        return $this->gender;
    }
    
    public function set_teacher_count($value) {
        $this->add_object_field('teacher_count', $value);
        $this->teacher_count = $value;
    }
    
    public function get_teacher_count() {
        return $this->teacher_count;
    }
    
    
}

