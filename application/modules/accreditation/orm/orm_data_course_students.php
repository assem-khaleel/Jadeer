<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Data_Course_Students extends Orm {
    
    /**
    * @var $instances Orm_Data_Course_Students[]
    */
    protected static $instances = array();
    protected static $table_name = 'data_course_students';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $program_id = 0;
    protected $course_id = 0;
    protected $section_id = 0;
    protected $semester_id = 0;
    protected $student_start_count = 0;
    protected $student_complete_count = 0;
    
    /**
    * @return Data_Course_Students_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Data_Course_Students_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Data_Course_Students
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
    * @return Orm_Data_Course_Students[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Data_Course_Students
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Data_Course_Students();
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
        $db_params['section_id'] = $this->get_section_id();
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['student_start_count'] = $this->get_student_start_count();
        $db_params['student_complete_count'] = $this->get_student_complete_count();
        
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
    
    public function set_section_id($value) {
        $this->add_object_field('section_id',$value);
        $this->section_id = $value;
    }
    
    public function get_section_id() {
        return $this->section_id;
    }
    
    public function set_semester_id($value) {
        $this->add_object_field('semester_id',$value);
        $this->semester_id = $value;
    }
    
    public function get_semester_id() {
        return $this->semester_id;
    }
    
    public function set_student_start_count($value) {
        $this->add_object_field('student_start_count',$value);
        $this->student_start_count = $value;
    }
    
    public function get_student_start_count() {
        return $this->student_start_count;
    }
    
    public function set_student_complete_count($value) {
        $this->add_object_field('student_complete_count',$value);
        $this->student_complete_count = $value;
    }
    
    public function get_student_complete_count() {
        return $this->student_complete_count;
    }
    
    public static function get_sum($filters) {
        return self::get_model()->get_sum($filters);
    }

    public function get_semester_obj() {
        return Orm_Semester::get_instance($this->get_semester_id());
    }

    public function get_course_obj() {
        return Orm_Course::get_instance($this->get_course_id());
    }

    public function get_program_obj() {
        return Orm_Program::get_instance($this->get_program_id());
    }
}

