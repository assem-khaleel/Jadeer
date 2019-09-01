<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Course_Section_Student extends Orm {
    
    /**
    * @var $instances Orm_Course_Section_Student[]
    */
    protected static $instances = array();
    protected static $table_name = 'course_section_student';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $section_id = 0;
    protected $user_id = 0;
    
    /**
    * @return Course_Section_Student_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Course_Section_Student_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Course_Section_Student
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
    * @return Orm_Course_Section_Student[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Course_Section_Student
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Course_Section_Student();
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
        $db_params['section_id'] = $this->get_section_id();
        $db_params['user_id'] = $this->get_user_id();
        
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
    
    public function set_section_id($value) {
        $this->add_object_field('section_id',$value);
        $this->section_id = $value;
    }
    
    public function get_section_id() {
        return $this->section_id;
    }
    
    public function set_user_id($value) {
        $this->add_object_field('user_id',$value);
        $this->user_id = $value;
    }
    
    public function get_user_id() {
        return $this->user_id;
    }

    /**
     * @return Orm_User
     */
    public function get_user_obj()
    {
        return Orm_User::get_instance($this->get_user_id());
    }

    /**
     * @return Orm_Course_Section
     */
    public function get_section_obj()
    {
        return Orm_Course_Section::get_instance($this->get_section_id());
    }

    /**
     * @param $course_id
     * @return int
     */
    public static function get_total_students($course_id) {
        return self::get_model()->get_total_students($course_id);
    }

    public static function get_course_ids($student_id = null, $semester_id = null)
    {
        if (is_null($student_id)) {
            $student_id = Orm_User::get_logged_user_id();
        }

        if (is_null($semester_id)) {
            $semester_id = Orm_Semester::get_active_semester()->get_id();
        }

        $section_ids = self::get_section_ids($student_id);

        $course_ids = array_column(Orm_Course_Section::get_model()->get_all(array('in_id' => $section_ids, 'semester_id' => $semester_id), 0, 0, array(), Orm::FETCH_ARRAY), 'course_id');

        return $course_ids ?: array(0);
    }

    public static function get_section_ids($student_id = null)
    {
        if (is_null($student_id)) {
            $student_id = Orm_User::get_logged_user_id();
        }

        $section_ids = array_column(self::get_model()->get_all(array('user_id' => $student_id), 0, 0, array(), Orm::FETCH_ARRAY), 'section_id');

        return $section_ids ?: array(0);
    }
}

