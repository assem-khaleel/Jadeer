<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pc_Format extends Orm {
    
    /**
    * @var $instances Orm_Pc_Format[]
    */
    protected static $instances = array();
    protected static $table_name = 'pc_format';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $course_id = 0;
    protected $assignment_format_file = null;
    protected $homework_format_file = null;
    protected $lab_experiment_format_file = null;
    protected $class_exercise_format_file = null;
    protected $semester_id = 0;
    protected $file_name_ar = '';
    protected $file_name_en = '';
    
    /**
    * @return Pc_Format_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pc_Format_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pc_Format
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
    * @return Orm_Pc_Format[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pc_Format
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pc_Format();
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
        $db_params['course_id'] = $this->get_course_id();
        $db_params['assignment_format_file'] = $this->get_assignment_format_file();
        $db_params['homework_format_file'] = $this->get_homework_format_file();
        $db_params['lab_experiment_format_file'] = $this->get_lab_experiment_format_file();
        $db_params['class_exercise_format_file'] = $this->get_class_exercise_format_file();
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['file_name_ar'] = $this->get_file_name_ar();
        $db_params['file_name_en'] = $this->get_file_name_en();
        
        return $db_params;
    }
    
    public function save() {
        if ($this->get_object_status() == 'new') {
            $this->set_semester_id(Orm_Semester::get_current_semester()->get_id());
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
    
    public function set_course_id($value) {
        $this->add_object_field('course_id', $value);
        $this->course_id = $value;
    }
    
    public function get_course_id() {
        return $this->course_id;
    }
    
    public function set_assignment_format_file($value) {
        $this->add_object_field('assignment_format_file', $value);
        $this->assignment_format_file = $value;
    }
    
    public function get_assignment_format_file() {
        return $this->assignment_format_file;
    }
    
    public function set_homework_format_file($value) {
        $this->add_object_field('homework_format_file', $value);
        $this->homework_format_file = $value;
    }
    
    public function get_homework_format_file() {
        return $this->homework_format_file;
    }
    
    public function set_lab_experiment_format_file($value) {
        $this->add_object_field('lab_experiment_format_file', $value);
        $this->lab_experiment_format_file = $value;
    }
    
    public function get_lab_experiment_format_file() {
        return $this->lab_experiment_format_file;
    }
    
    public function set_class_exercise_format_file($value) {
        $this->add_object_field('class_exercise_format_file', $value);
        $this->class_exercise_format_file = $value;
    }
    
    public function get_class_exercise_format_file() {
        return $this->class_exercise_format_file;
    }
    
    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }

    public function get_semester_id() {
        return $this->semester_id;
    }

    public function set_file_name_ar($value) {
        $this->add_object_field('file_name_ar', $value);
        $this->file_name_ar = $value;
    }

    public function get_file_name_ar() {
        return $this->file_name_ar;
    }

    public function set_file_name_en($value) {
        $this->add_object_field('file_name_en', $value);
        $this->file_name_en = $value;
    }

    public function get_file_name_en() {
        return $this->file_name_en;
    }

    public function get_file_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_file_name_ar();
        }
        return $this->get_file_name_en();
    }
    
    
}

