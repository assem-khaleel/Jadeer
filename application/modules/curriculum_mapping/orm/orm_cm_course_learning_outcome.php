<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Course_Learning_Outcome extends Orm {
    
    protected static $table_name = 'cm_course_learning_outcome';
    
    /**
    * @var $instances Orm_Cm_Course_Learning_Outcome[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $course_id = 0;
    protected $program_learning_outcome_id = 0;
    protected $learning_domain_id = 0;
    protected $text_en = '';
    protected $text_ar = '';
    protected $code = '';

    /**
    * @return Cm_Course_Learning_Outcome_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Course_Learning_Outcome_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Course_Learning_Outcome
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
    * @return Orm_Cm_Course_Learning_Outcome[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Course_Learning_Outcome
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Course_Learning_Outcome();
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
        $db_params['program_learning_outcome_id'] = $this->get_program_learning_outcome_id();
        $db_params['learning_domain_id'] = $this->get_learning_domain_id();
        $db_params['text_en'] = $this->get_text_en();
        $db_params['text_ar'] = $this->get_text_ar();
        $db_params['code'] = $this->get_code();

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
    
    public function set_program_learning_outcome_id($value) {
        $this->add_object_field('program_learning_outcome_id', $value);
        $this->program_learning_outcome_id = $value;
    }
    
    public function get_program_learning_outcome_id() {
        return $this->program_learning_outcome_id;
    }
    
    public function set_learning_domain_id($value) {
        $this->add_object_field('learning_domain_id', $value);
        $this->learning_domain_id = $value;
    }
    
    public function get_learning_domain_id() {
        return $this->learning_domain_id;
    }

    /**
     * get course learning outcomes name depends on actie language
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_text($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_text_ar();
        }

        return $this->get_text_en();
    }
    
    public function set_text_en($value) {
        $this->add_object_field('text_en', $value);
        $this->text_en = $value;
    }
    
    public function get_text_en() {
        return $this->text_en;
    }
    
    public function set_text_ar($value) {
        $this->add_object_field('text_ar', $value);
        $this->text_ar = $value;
    }
    
    public function get_text_ar() {
        return $this->text_ar;
    }
    
    public function set_code($value) {
        $this->add_object_field('code', $value);
        $this->code = $value;
    }
    
    public function get_code() {
        return $this->code;
    }

    /**
     * get the archive data using semester
     * @param $semester_id
     */
    public static function archive($semester_id) {
        self::get_model()->archive($semester_id);
    }

    /**
     * get course learning outcomes depends on course id and learning domain id
     * @param $course_id
     * @param $domain_id
     * @return int|Orm_Cm_Course_Learning_Outcome[]
     */
    public static function get_outcomes($course_id, $domain_id) {
        return self::get_all(array('course_id' => $course_id, 'learning_domain_id' => $domain_id));
    }

    /**
     * get program learning outcomes data using the id of it
     * @return Orm_Cm_Program_Learning_Outcome
     */
    public function get_program_learning_outcome_obj() {
        return Orm_Cm_Program_Learning_Outcome::get_instance($this->get_program_learning_outcome_id());
    }

    /**
     * get learning domain data using the id of it
     * @return Orm_Cm_Learning_Domain
     */
    public function get_learning_domain_obj() {
        return Orm_Cm_Learning_Domain::get_instance($this->get_learning_domain_id());
    }

    /**
     * get the target data  for course learning outcome
     * @return Orm_Cm_Course_Learning_Outcome_Target
     */
    public function get_target_obj() {
        return Orm_Cm_Course_Learning_Outcome_Target::get_one(['course_learning_outcome_id' => $this->get_id()]);
    }
}

