<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Section_Mapping_Question extends Orm {
    
    protected static $table_name = 'cm_section_mapping_question';
    
    /**
    * @var $instances Orm_Cm_Section_Mapping_Question[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $section_id = 0;
    protected $course_assessment_method_id = 0;
    protected $full_mark = 0;
    protected $question = '';
    protected $course_learning_outcomes_ids = '';

    /**
    * @return Cm_Section_Mapping_Question_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Section_Mapping_Question_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Section_Mapping_Question
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
    * @return Orm_Cm_Section_Mapping_Question[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Section_Mapping_Question
    */
    public static function get_one($filters = array(), $orders = array()) {
        /** @var Orm_Cm_Section_Mapping_Question $result */
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Section_Mapping_Question();
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
        $db_params['course_assessment_method_id'] = $this->get_course_assessment_method_id();
        $db_params['full_mark'] = $this->get_full_mark();
        $db_params['question'] = $this->get_question();
        $db_params['course_learning_outcomes_ids'] = json_encode($this->get_course_learning_outcomes_ids());

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
    
    public function set_section_id($value) {
        $this->add_object_field('section_id', $value);
        $this->section_id = $value;
    }
    
    public function get_section_id() {
        return $this->section_id;
    }
    
    public function set_course_assessment_method_id($value) {
        $this->add_object_field('course_assessment_method_id', $value);
        $this->course_assessment_method_id = $value;
    }
    
    public function get_course_assessment_method_id() {
        return $this->course_assessment_method_id;
    }

    public function set_full_mark($value) {
        $this->add_object_field('full_mark', $value);
        $this->full_mark = $value;
    }

    public function get_full_mark() {
        return $this->full_mark;
    }
    
    public function set_question($value) {
        $this->add_object_field('question', $value);
        $this->question = $value;
    }
    
    public function get_question() {
        return $this->question;
    }

    public function set_course_learning_outcomes_ids($value) {
        if(is_array($value)) {
            $this->add_object_field('course_learning_outcomes_ids', json_encode($value));
        } elseif (is_string($value)) {
            $this->add_object_field('course_learning_outcomes_ids', $value);
            $value = json_decode($value, true);
        }

        $this->course_learning_outcomes_ids = $value;
    }

    /**
     * @return array|string
     */
    public function get_course_learning_outcomes_ids() {
        return $this->course_learning_outcomes_ids;
    }
}

