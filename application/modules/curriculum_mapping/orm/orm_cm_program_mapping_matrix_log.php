<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Program_Mapping_Matrix_Log extends Orm {
    
    protected static $table_name = 'cm_program_mapping_matrix_log';
    
    /**
    * @var $instances Orm_Cm_Program_Mapping_Matrix_Log[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $semester_id = 0;
    protected $log_id = 0;
    protected $log_program_id = 0;
    protected $log_course_id = 0;
    protected $log_program_learning_outcome_id = 0;
    protected $log_ipa = 'i';

    /**
    * @return Cm_Program_Mapping_Matrix_Log_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Program_Mapping_Matrix_Log_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Program_Mapping_Matrix_Log
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
    * @return Orm_Cm_Program_Mapping_Matrix_Log[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Program_Mapping_Matrix_Log
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Program_Mapping_Matrix_Log();
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
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['log_id'] = $this->get_log_id();
        $db_params['log_program_id'] = $this->get_log_program_id();
        $db_params['log_course_id'] = $this->get_log_course_id();
        $db_params['log_program_learning_outcome_id'] = $this->get_log_program_learning_outcome_id();
        $db_params['log_ipa'] = $this->get_log_ipa();

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
    
    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }
    
    public function get_semester_id() {
        return $this->semester_id;
    }
    
    public function set_log_id($value) {
        $this->add_object_field('log_id', $value);
        $this->log_id = $value;
    }
    
    public function get_log_id() {
        return $this->log_id;
    }
    
    public function set_log_program_id($value) {
        $this->add_object_field('log_program_id', $value);
        $this->log_program_id = $value;
    }
    
    public function get_log_program_id() {
        return $this->log_program_id;
    }
    
    public function set_log_course_id($value) {
        $this->add_object_field('log_course_id', $value);
        $this->log_course_id = $value;
    }
    
    public function get_log_course_id() {
        return $this->log_course_id;
    }
    
    public function set_log_program_learning_outcome_id($value) {
        $this->add_object_field('log_program_learning_outcome_id', $value);
        $this->log_program_learning_outcome_id = $value;
    }
    
    public function get_log_program_learning_outcome_id() {
        return $this->log_program_learning_outcome_id;
    }
    
    public function set_log_ipa($value) {
        $this->add_object_field('log_ipa', $value);
        $this->log_ipa = $value;
    }
    
    public function get_log_ipa() {
        return $this->log_ipa;
    }
    
    
}

