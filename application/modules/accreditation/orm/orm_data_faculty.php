<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Data_Faculty extends Orm {
    
    /**
    * @var $instances Orm_Data_Faculty[]
    */
    protected static $instances = array();
    protected static $table_name = 'data_faculty';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $program_id = 0;
    protected $academic_year = 0;
    protected $teaching_assistant_male = 0;
    protected $teaching_assistant_female = 0;
    protected $instructor_male = 0;
    protected $instructor_female = 0;
    protected $assistant_prof_male = 0;
    protected $assistant_prof_female = 0;
    protected $associate_prof_male = 0;
    protected $associate_prof_female = 0;
    protected $prof_male = 0;
    protected $prof_female = 0;
    
    /**
    * @return Data_Faculty_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Data_Faculty_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Data_Faculty
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
    * @return Orm_Data_Faculty[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Data_Faculty
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Data_Faculty();
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
        $db_params['academic_year'] = $this->get_academic_year();
        $db_params['teaching_assistant_male'] = $this->get_teaching_assistant_male();
        $db_params['teaching_assistant_female'] = $this->get_teaching_assistant_female();
        $db_params['instructor_male'] = $this->get_instructor_male();
        $db_params['instructor_female'] = $this->get_instructor_female();
        $db_params['assistant_prof_male'] = $this->get_assistant_prof_male();
        $db_params['assistant_prof_female'] = $this->get_assistant_prof_female();
        $db_params['associate_prof_male'] = $this->get_associate_prof_male();
        $db_params['associate_prof_female'] = $this->get_associate_prof_female();
        $db_params['prof_male'] = $this->get_prof_male();
        $db_params['prof_female'] = $this->get_prof_female();
        
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

    public function set_program_id($value) {
        $this->add_object_field('program_id', $value);
        $this->program_id = $value;
    }

    public function get_program_id() {
        return $this->program_id;
    }
    
    public function set_academic_year($value) {
        $this->add_object_field('academic_year', $value);
        $this->academic_year = $value;
    }
    
    public function get_academic_year() {
        return $this->academic_year;
    }
    
    public function set_teaching_assistant_male($value) {
        $this->add_object_field('teaching_assistant_male', $value);
        $this->teaching_assistant_male = $value;
    }
    
    public function get_teaching_assistant_male() {
        return $this->teaching_assistant_male;
    }
    
    public function set_teaching_assistant_female($value) {
        $this->add_object_field('teaching_assistant_female', $value);
        $this->teaching_assistant_female = $value;
    }
    
    public function get_teaching_assistant_female() {
        return $this->teaching_assistant_female;
    }
    
    public function set_instructor_male($value) {
        $this->add_object_field('instructor_male', $value);
        $this->instructor_male = $value;
    }
    
    public function get_instructor_male() {
        return $this->instructor_male;
    }
    
    public function set_instructor_female($value) {
        $this->add_object_field('instructor_female', $value);
        $this->instructor_female = $value;
    }
    
    public function get_instructor_female() {
        return $this->instructor_female;
    }
    
    public function set_assistant_prof_male($value) {
        $this->add_object_field('assistant_prof_male', $value);
        $this->assistant_prof_male = $value;
    }
    
    public function get_assistant_prof_male() {
        return $this->assistant_prof_male;
    }
    
    public function set_assistant_prof_female($value) {
        $this->add_object_field('assistant_prof_female', $value);
        $this->assistant_prof_female = $value;
    }
    
    public function get_assistant_prof_female() {
        return $this->assistant_prof_female;
    }
    
    public function set_associate_prof_male($value) {
        $this->add_object_field('associate_prof_male', $value);
        $this->associate_prof_male = $value;
    }
    
    public function get_associate_prof_male() {
        return $this->associate_prof_male;
    }
    
    public function set_associate_prof_female($value) {
        $this->add_object_field('associate_prof_female', $value);
        $this->associate_prof_female = $value;
    }
    
    public function get_associate_prof_female() {
        return $this->associate_prof_female;
    }
    
    public function set_prof_male($value) {
        $this->add_object_field('prof_male', $value);
        $this->prof_male = $value;
    }
    
    public function get_prof_male() {
        return $this->prof_male;
    }
    
    public function set_prof_female($value) {
        $this->add_object_field('prof_female', $value);
        $this->prof_female = $value;
    }
    
    public function get_prof_female() {
        return $this->prof_female;
    }
    
    public function get_total_male() {
        return $this->get_prof_male() + $this->get_associate_prof_male() + $this->get_assistant_prof_male() + $this->get_instructor_male() + $this->get_teaching_assistant_male();
    }

    public function get_total_female() {
        return $this->get_prof_female() + $this->get_associate_prof_female() + $this->get_assistant_prof_female() + $this->get_instructor_female() + $this->get_teaching_assistant_female();
    }

    public function get_total() {
        return $this->get_total_male() + $this->get_total_female();
    }

    public function get_program_obj() {
        return Orm_Program::get_instance($this->get_program_id());
    }
}

