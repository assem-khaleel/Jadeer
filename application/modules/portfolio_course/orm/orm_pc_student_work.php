<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pc_Student_Work extends Orm {
    
    /**
    * @var $instances Orm_Pc_Student_Work[]
    */
    protected static $instances = array();
    protected static $table_name = 'pc_student_work';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $course_id = 0;
    protected $title_ar = '';
    protected $title_en = '';
    protected $student_project_file = '';
    protected $grading_guideline_ar = '';
    protected $semester_id = 0;
    protected $grading_guideline_en = '';
    protected $type = 1;

    /**
    * @return Pc_Student_Work_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pc_Student_Work_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pc_Student_Work
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
    * @return Orm_Pc_Student_Work[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pc_Student_Work
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pc_Student_Work();
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
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['student_project_file'] = $this->get_student_project_file();
        $db_params['grading_guideline_ar'] = $this->get_grading_guideline_ar();
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['grading_guideline_en'] = $this->get_grading_guideline_en();
        $db_params['type'] = $this->get_type();

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

    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }

    public function get_type() {
        return $this->type;
    }
    
    public function set_course_id($value) {
        $this->add_object_field('course_id', $value);
        $this->course_id = $value;
    }
    
    public function get_course_id() {
        return $this->course_id;
    }
    
    public function set_title_ar($value) {
        $this->add_object_field('title_ar', $value);
        $this->title_ar = $value;
    }
    
    public function get_title_ar() {
        return $this->title_ar;
    }
    
    public function set_title_en($value) {
        $this->add_object_field('title_en', $value);
        $this->title_en = $value;
    }
    
    public function get_title_en() {
        return $this->title_en;
    }

    public function get_title($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_title_ar();
        }
        return $this->get_title_en();
    }

    public function set_student_project_file($value) {
        $this->add_object_field('student_project_file', $value);
        $this->student_project_file = $value;
    }
    
    public function get_student_project_file() {
        return $this->student_project_file;
    }
    
    public function set_grading_guideline_ar($value) {
        $this->add_object_field('grading_guideline_ar', $value);
        $this->grading_guideline_ar = $value;
    }
    
    public function get_grading_guideline_ar() {
        return $this->grading_guideline_ar;
    }
    
    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }
    
    public function get_semester_id() {
        return $this->semester_id;
    }
    
    public function set_grading_guideline_en($value) {
        $this->add_object_field('grading_guideline_en', $value);
        $this->grading_guideline_en = $value;
    }
    
    public function get_grading_guideline_en() {
        return $this->grading_guideline_en;
    }

    public function get_grading_guideline($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_grading_guideline_ar();
        }
        return $this->get_grading_guideline_en();
    }
    
}

