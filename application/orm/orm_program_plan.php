<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Program_Plan extends Orm {

    /**
    * @var $instances Orm_Program_Plan[]
    */
    protected static $instances = array();
    protected static $table_name = 'program_plan';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $program_id = 0;
    protected $course_id = 0;
    protected $level = '';
    protected $credit_hours = 0;
    protected $is_required = 0;
    protected $integration_id = 0;

    /**
    * @return Program_Plan_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Program_Plan_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Program_Plan
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
    * @return Orm_Program_Plan[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Program_Plan
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Program_Plan();
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
        $db_params['level'] = $this->get_level();
        $db_params['credit_hours'] = $this->get_credit_hours();
        $db_params['is_required'] = $this->get_is_required();
        $db_params['integration_id'] = $this->get_integration_id();

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
    
    public function set_program_id($value)
    {
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
    
    public function set_level($value) {
    $this->add_object_field('level',$value);
        $this->level = $value;
    }
    
    public function get_level() {
        return $this->level;
    }

    public function set_credit_hours($value) {
    $this->add_object_field('credit_hours',$value);
        $this->credit_hours = $value;
    }

    public function get_credit_hours() {
        return $this->credit_hours;
    }

    public function set_is_required($value) {
    $this->add_object_field('is_required',$value);
        $this->is_required = $value;
    }

    public function get_is_required() {
        return $this->is_required;
    }

    public function set_integration_id($value) {
    $this->add_object_field('integration_id',$value);
        $this->integration_id = $value;
    }

    public function get_integration_id() {
        return $this->integration_id;
    }

    /**
     * @return Orm_Course
     */
    public function get_course_obj()
    {
        return Orm_Course::get_instance($this->get_course_id());
    }

    /**
     * @return Orm_Program
     */
    public function get_program_obj()
    {
        return Orm_Program::get_instance($this->get_program_id());
    }

    public function get_is_deleted(){
        return 0;
    }

    public function get_year(){
        return 0;
    }

    public function get_semester(){
        return 0;
    }
    
    public static function get_intersect_courses($program_id) {
        return self::get_model()->get_intersect_courses($program_id);
    }

    public static function get_program_levels($program_id, $undergraduate = false) {

        if($undergraduate) {
            $degree_obj = Orm_Program::get_instance($program_id)->get_degree_obj();
            if($degree_obj->get_is_undergraduate()) {
                return array_column(self::get_model()->levels($program_id, array()), 'level');
            }
        }

        return array_column(self::get_model()->levels($program_id), 'level');
    }
}

