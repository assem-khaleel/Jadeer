<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pc_Course_Policies extends Orm {
    
    /**
    * @var $instances Orm_Pc_Course_Policies[]
    */
    protected static $instances = array();
    protected static $table_name = 'pc_course_policies';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $course_id = 0;
    protected $grading_ar = null;
    protected $grading_en = null;
    protected $attendance_ar = null;
    protected $attendance_en = null;
    protected $lateness_ar = null;
    protected $lateness_en = null;
    protected $class_participation_en = null;
    protected $class_participation_ar = null;
    protected $missed_exam_ar = null;
    protected $missed_exam_en = null;
    protected $missed_assignment_ar = null;
    protected $missed_assignment_en = null;
    protected $academic_dishonesty_ar = null;
    protected $academic_dishonesty_en = null;
    protected $academic_plagiarism_ar = null;
    protected $academic_plagiarism_en = null;
    protected $semester_id = 0;
    
    /**
    * @return Pc_Course_Policies_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pc_Course_Policies_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pc_Course_Policies
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
    * @return Orm_Pc_Course_Policies[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pc_Course_Policies
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pc_Course_Policies();
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
        $db_params['grading_ar'] = $this->get_grading_ar();
        $db_params['grading_en'] = $this->get_grading_en();
        $db_params['attendance_ar'] = $this->get_attendance_ar();
        $db_params['attendance_en'] = $this->get_attendance_en();
        $db_params['lateness_ar'] = $this->get_lateness_ar();
        $db_params['lateness_en'] = $this->get_lateness_en();
        $db_params['class_participation_en'] = $this->get_class_participation_en();
        $db_params['class_participation_ar'] = $this->get_class_participation_ar();
        $db_params['missed_exam_ar'] = $this->get_missed_exam_ar();
        $db_params['missed_exam_en'] = $this->get_missed_exam_en();
        $db_params['missed_assignment_ar'] = $this->get_missed_assignment_ar();
        $db_params['missed_assignment_en'] = $this->get_missed_assignment_en();
        $db_params['academic_dishonesty_ar'] = $this->get_academic_dishonesty_ar();
        $db_params['academic_dishonesty_en'] = $this->get_academic_dishonesty_en();
        $db_params['academic_plagiarism_ar'] = $this->get_academic_plagiarism_ar();
        $db_params['academic_plagiarism_en'] = $this->get_academic_plagiarism_en();
        $db_params['semester_id'] = $this->get_semester_id();
        
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
    
    public function set_course_id($value) {
        $this->add_object_field('course_id', $value);
        $this->course_id = $value;
    }
    
    public function get_course_id() {
        return $this->course_id;
    }
    
    public function set_grading_ar($value) {
        $this->add_object_field('grading_ar', $value);
        $this->grading_ar = $value;
    }
    
    public function get_grading_ar() {
        return $this->grading_ar;
    }
    
    public function set_grading_en($value) {
        $this->add_object_field('grading_en', $value);
        $this->grading_en = $value;
    }
    
    public function get_grading_en() {
        return $this->grading_en;
    }

    public function get_grading($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_grading_ar();
        }
        return $this->get_grading_en();
    }
    
    public function set_attendance_ar($value) {
        $this->add_object_field('attendance_ar', $value);
        $this->attendance_ar = $value;
    }
    
    public function get_attendance_ar() {
        return $this->attendance_ar;
    }
    
    public function set_attendance_en($value) {
        $this->add_object_field('attendance_en', $value);
        $this->attendance_en = $value;
    }
    
    public function get_attendance_en() {
        return $this->attendance_en;
    }

     public function get_attendance($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_attendance_ar();
        }
        return $this->get_attendance_en();
    }
    
    public function set_lateness_ar($value) {
        $this->add_object_field('lateness_ar', $value);
        $this->lateness_ar = $value;
    }
    
    public function get_lateness_ar() {
        return $this->lateness_ar;
    }
    
    public function set_lateness_en($value) {
        $this->add_object_field('lateness_en', $value);
        $this->lateness_en = $value;
    }
    
    public function get_lateness_en() {
        return $this->lateness_en;
    }

    public function get_lateness($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_lateness_ar();
        }
        return $this->get_lateness_en();
    }

    public function set_class_participation_en($value) {
        $this->add_object_field('class_participation_en', $value);
        $this->class_participation_en = $value;
    }
    
    public function get_class_participation_en() {
        return $this->class_participation_en;
    }
    
    public function set_class_participation_ar($value) {
        $this->add_object_field('class_participation_ar', $value);
        $this->class_participation_ar = $value;
    }
    
    public function get_class_participation_ar() {
        return $this->class_participation_ar;
    }

     public function get_class_participation($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_class_participation_ar();
        }
        return $this->get_class_participation_en();
    }

    public function set_missed_exam_ar($value) {
        $this->add_object_field('missed_exam_ar', $value);
        $this->missed_exam_ar = $value;
    }
    
    public function get_missed_exam_ar() {
        return $this->missed_exam_ar;
    }
    
    public function set_missed_exam_en($value) {
        $this->add_object_field('missed_exam_en', $value);
        $this->missed_exam_en = $value;
    }
    
    public function get_missed_exam_en() {
        return $this->missed_exam_en;
    }

    public function get_missed_exam($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_missed_exam_ar();
        }
        return $this->get_missed_exam_en();
    }

    public function set_missed_assignment_ar($value) {
        $this->add_object_field('missed_assignment_ar', $value);
        $this->missed_assignment_ar = $value;
    }
    
    public function get_missed_assignment_ar() {
        return $this->missed_assignment_ar;
    }
    
    public function set_missed_assignment_en($value) {
        $this->add_object_field('missed_assignment_en', $value);
        $this->missed_assignment_en = $value;
    }
    
    public function get_missed_assignment_en() {
        return $this->missed_assignment_en;
    }

     public function get_missed_assignment($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_missed_assignment_ar();
        }
        return $this->get_missed_assignment_en();
    }

    public function set_academic_dishonesty_ar($value) {
        $this->add_object_field('academic_dishonesty_ar', $value);
        $this->academic_dishonesty_ar = $value;
    }
    
    public function get_academic_dishonesty_ar() {
        return $this->academic_dishonesty_ar;
    }
    
    public function set_academic_dishonesty_en($value) {
        $this->add_object_field('academic_dishonesty_en', $value);
        $this->academic_dishonesty_en = $value;
    }
    
    public function get_academic_dishonesty_en() {
        return $this->academic_dishonesty_en;
    }

     public function get_academic_dishonesty($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_academic_dishonesty_ar();
        }
        return $this->get_academic_dishonesty_en();
    }

    public function set_academic_plagiarism_ar($value) {
        $this->add_object_field('academic_plagiarism_ar', $value);
        $this->academic_plagiarism_ar = $value;
    }
    
    public function get_academic_plagiarism_ar() {
        return $this->academic_plagiarism_ar;
    }
    
    public function set_academic_plagiarism_en($value) {
        $this->add_object_field('academic_plagiarism_en', $value);
        $this->academic_plagiarism_en = $value;
    }
    
    public function get_academic_plagiarism_en() {
        return $this->academic_plagiarism_en;
    }

     public function get_academic_plagiarism($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_academic_plagiarism_ar();
        }
        return $this->get_academic_plagiarism_en();
    }

    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }
    
    public function get_semester_id() {
        return $this->semester_id;
    }
    
    
}

