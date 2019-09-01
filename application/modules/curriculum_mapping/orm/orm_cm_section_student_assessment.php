<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Section_Student_Assessment extends Orm {
    
    protected static $table_name = 'cm_section_student_assessment';
    
    /**
    * @var $instances Orm_Cm_Section_Student_Assessment[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $section_id = 0;
    protected $student_id = 0;
    protected $section_mapping_question_id = 0;
    protected $score = 0.00;

    public static $GOOGLE_COLORS = array(
        '#3366CC',
        '#DC3912',
        '#FF9900',
        '#109618',
        '#990099',
        '#3B3EAC',
        '#0099C6',
        '#DD4477',
        '#66AA00',
        '#B82E2E',
        '#316395',
        '#994499',
        '#22AA99',
        '#AAAA11',
        '#6633CC',
        '#E67300',
        '#8B0707',
        '#329262',
        '#5574A6',
        '#3B3EAC'
    );
    
    /**
    * @return Cm_Section_Student_Assessment_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Section_Student_Assessment_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Section_Student_Assessment
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
    * @return Orm_Cm_Section_Student_Assessment[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Section_Student_Assessment
    */
    public static function get_one($filters = array(), $orders = array()) {

        /** @var Orm_Cm_Section_Student_Assessment $result */
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Section_Student_Assessment();
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
        $db_params['student_id'] = $this->get_student_id();
        $db_params['section_mapping_question_id'] = $this->get_section_mapping_question_id();
        $db_params['score'] = $this->get_score();

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
    
    public function set_student_id($value) {
        $this->add_object_field('student_id', $value);
        $this->student_id = $value;
    }
    
    public function get_student_id() {
        return $this->student_id;
    }
    
    public function set_section_mapping_question_id($value) {
        $this->add_object_field('section_mapping_question_id', $value);
        $this->section_mapping_question_id = $value;
    }
    
    public function get_section_mapping_question_id() {
        return $this->section_mapping_question_id;
    }
    
    public function set_score($value) {
        $this->add_object_field('score', $value);
        $this->score = $value;
    }
    
    public function get_score() {
        return $this->score;
    }

    /**
     * get total number of students that already assessed using the following:
     * @param $section_id
     * @param $assessment_method_id
     * @return int
     */
    public static function get_number_of_assessed_students($section_id, $assessment_method_id) {
        return self::get_model()->get_number_of_assessed_students($section_id, $assessment_method_id);
    }

    /**
     * get learning domain score using the following
     * @param null $college_id
     * @param null $program_id
     * @param null $course_id
     * @param null $section_id
     * @param null $student_id
     * @return array
     */
    public static function get_learning_domain_score($college_id = null, $program_id = null, $course_id = null, $section_id = null, $student_id = null) {
        $domains = self::get_model()->get_learning_domain_score($college_id, $program_id, $course_id, $section_id, $student_id);
        return $domains;
    }

    /**
     * get scor of learning domain using the following:
     * @param $domain_id
     * @param null $college_id
     * @param null $program_id
     * @param null $course_id
     * @param null $section_id
     * @return array
     */
    public static function get_level_learning_domain_score($domain_id, $college_id = null, $program_id = null, $course_id = null, $section_id = null) {
        $levels = self::get_model()->get_level_learning_domain_score($domain_id, $college_id, $program_id, $course_id, $section_id);
        return $levels;
    }

    /**
     * get score of learning outcomes using the following
     * @param $domain_id
     * @param null $college_id
     * @param null $program_id
     * @param null $course_id
     * @param null $section_id
     * @param null $student_id
     * @return array
     */
    public static function get_outcomes_score($domain_id, $college_id = null, $program_id = null, $course_id = null, $section_id = null, $student_id = null) {
        $outcomes = self::get_model()->get_outcomes_score($domain_id, $college_id, $program_id, $course_id, $section_id, $student_id);
        return $outcomes;
    }

    /**
     * get score of assessment method using the following
     * @param null $college_id
     * @param null $program_id
     * @param null $course_id
     * @param null $section_id
     * @param null $student_id
     * @return array
     */
    public static function get_assessment_method_score($college_id = null, $program_id = null, $course_id = null, $section_id = null, $student_id = null) {
        $domains = self::get_model()->get_assessment_method_score($college_id, $program_id, $course_id, $section_id, $student_id);
        return $domains;
    }

    /**
     * get score of level course assessment method using the following
     * @param $method_id
     * @param null $college_id
     * @param null $program_id
     * @param null $course_id
     * @param null $section_id
     * @return array
     */
    public static function get_level_assessment_method_score($method_id, $college_id = null, $program_id = null, $course_id = null, $section_id = null) {
        $levels = self::get_model()->get_level_assessment_method_score($method_id, $college_id, $program_id, $course_id, $section_id);
        return $levels;
    }

    /**
     * get score of course assessment method usinf the following
     * @param $course_id
     * @param null $method_id
     * @param null $domain_id
     * @param null $outcome_id
     * @param null $section_id
     * @param null $student_id
     * @return float
     */
    public static function get_course_assessment_method_score($course_id, $method_id = null, $domain_id = null, $outcome_id = null, $section_id = null, $student_id = null) {
        $levels = self::get_model()->get_course_assessment_method_score($course_id, $method_id, $domain_id, $outcome_id, $section_id, $student_id);
        return $levels;
    }
}

