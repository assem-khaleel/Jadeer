<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pc_Teaching_Material extends Orm {
    
    /**
    * @var $instances Orm_Pc_Teaching_Material[]
    */
    protected static $instances = array();
    protected static $table_name = 'pc_teaching_material';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $course_id = 0;
    protected $course_manual_file = '';
    protected $lecture_note_ar = '';
    protected $lecture_note_en = '';
    protected $addition_ar = '';
    protected $addition_en = '';
    protected $semester_id = 0;
    protected $course_manual_title_en = '';
    protected $course_manual_title_ar = '';
    protected $type = 1;

    /**
    * @return Pc_Teaching_Material_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pc_Teaching_Material_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pc_Teaching_Material
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
    * @return Orm_Pc_Teaching_Material[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pc_Teaching_Material
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pc_Teaching_Material();
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
        $db_params['course_manual_file'] = $this->get_course_manual_file();
        $db_params['lecture_note_ar'] = $this->get_lecture_note_ar();
        $db_params['lecture_note_en'] = $this->get_lecture_note_en();
        $db_params['addition_ar'] = $this->get_addition_ar();
        $db_params['addition_en'] = $this->get_addition_en();
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['course_manual_title_en'] = $this->get_course_manual_title_en();
        $db_params['course_manual_title_ar'] = $this->get_course_manual_title_ar();
        $db_params['type'] = $this->get_type();

        return $db_params;
    }
    
    public function save() {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_semester_id(Orm_Semester::get_current_semester()->get_id());
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
    
    public function set_course_manual_file($value) {
        $this->add_object_field('course_manual_file', $value);
        $this->course_manual_file = $value;
    }
    
    public function get_course_manual_file() {
        return $this->course_manual_file;
    }
    
    public function set_lecture_note_ar($value) {
        $this->add_object_field('lecture_note_ar', $value);
        $this->lecture_note_ar = $value;
    }
    
    public function get_lecture_note_ar() {
        return $this->lecture_note_ar;
    }
    
    public function set_lecture_note_en($value) {
        $this->add_object_field('lecture_note_en', $value);
        $this->lecture_note_en = $value;
    }
    
    public function get_lecture_note_en() {
        return $this->lecture_note_en;
    }

    public function set_addition_ar($value) {
        $this->add_object_field('addition_ar', $value);
        $this->addition_ar = $value;
    }
    
    public function get_addition_ar() {
        return $this->addition_ar;
    }
    
    public function set_addition_en($value) {
        $this->add_object_field('addition_en', $value);
        $this->addition_en = $value;
    }
    
    public function get_addition_en() {
        return $this->addition_en;
    }
    
    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }
    
    public function get_semester_id() {
        return $this->semester_id;
    }

    public function set_course_manual_title_en($value) {
        $this->add_object_field('course_manual_title_en', $value);
        $this->course_manual_title_en = $value;
    }

    public function get_course_manual_title_en() {
        return $this->course_manual_title_en;
    }

    public function set_course_manual_title_ar($value) {
        $this->add_object_field('course_manual_title_ar', $value);
        $this->course_manual_title_ar = $value;
    }

    public function get_course_manual_title_ar() {
        return $this->course_manual_title_ar;
    }

    public function get_course_manual_title() {
        if (UI_LANG == 'arabic') {
            return $this->get_course_manual_title_ar();
        }else{
            return $this->get_course_manual_title_en();
        }
    }

    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }

    public function get_type() {
        return $this->type;
    }

    public function get_lecture_note() {
        if (UI_LANG == 'arabic') {
            return $this->get_lecture_note_ar();
        }else{
            return $this->get_lecture_note_en();
        }
    }

    public function get_addition() {
        if (UI_LANG == 'arabic') {
            return $this->get_addition_ar();
        }else{
            return $this->get_addition_en();
        }
    }

}

