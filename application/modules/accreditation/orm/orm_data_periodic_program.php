<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Data_Periodic_Program extends Orm {
    
    /**
    * @var $instances Orm_Data_Periodic_Program[]
    */
    protected static $instances = array();
    protected static $table_name = 'data_periodic_program';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $program_id = 0;
    protected $academic_year = 0;
    protected $gender = 0;
    protected $nationality = '';
    protected $phd_holder_count = 0;
    protected $teaching_staff_count = 0;
    
    /**
    * @return Data_Periodic_Program_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Data_Periodic_Program_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Data_Periodic_Program
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
    * @return Orm_Data_Periodic_Program[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Data_Periodic_Program
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Data_Periodic_Program();
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
        $db_params['gender'] = $this->get_gender();
        $db_params['nationality'] = $this->get_nationality();
        $db_params['phd_holder_count'] = $this->get_phd_holder_count();
        $db_params['teaching_staff_count'] = $this->get_teaching_staff_count();
        
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
    
    public function set_program_id($value) {
        $this->add_object_field('program_id',$value);
        $this->program_id = $value;
    }
    
    public function get_program_id() {
        return $this->program_id;
    }
    
    public function set_academic_year($value) {
        $this->add_object_field('academic_year',$value);
        $this->academic_year = $value;
    }
    
    public function get_academic_year() {
        return $this->academic_year;
    }
    
    public function set_gender($value) {
        $this->add_object_field('gender',$value);
        $this->gender = $value;
    }
    
    public function get_gender() {
        return $this->gender;
    }
    
    public function set_nationality($value) {
        $this->add_object_field('nationality',$value);
        $this->nationality = $value;
    }
    
    public function get_nationality() {
        return $this->nationality;
    }
    
    public function set_phd_holder_count($value) {
        $this->add_object_field('phd_holder_count',$value);
        $this->phd_holder_count = $value;
    }
    
    public function get_phd_holder_count() {
        return $this->phd_holder_count;
    }
    
    public function set_teaching_staff_count($value) {
        $this->add_object_field('teaching_staff_count',$value);
        $this->teaching_staff_count = $value;
    }
    
    public function get_teaching_staff_count() {
        return $this->teaching_staff_count;
    }

    /**
     * @param array $filters
     * @param null $type
     * @return mixed
     */
    public static function get_sum($filters = array(), $type = null) {
        return self::get_model()->get_sum($filters, $type);
    }

    public function get_program_obj() {
        return Orm_Program::get_instance($this->get_program_id());
    }
}

