<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Alumni_Work extends Orm {
    
    /**
    * @var $instances Orm_Alumni_Work[]
    */
    protected static $instances = array();
    protected static $table_name = 'alumni_work';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $alumni_id = 0;
    protected $start_date = 0;
    protected $end_date = 0;
    protected $position = '';
    protected $created_by = 0;
    protected $employer_id = 0;
    
    /**
    * @return Alumni_Work_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Alumni_Work_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Alumni_Work
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
    * @return Orm_Alumni_Work[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Alumni_Work
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Alumni_Work();
    }
    
    /**
    * get count
    *
    * @param array $filters
    * @return array|int
    */
    public static function get_count($filters = array()) {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }


    
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['alumni_id'] = $this->get_alumni_id();
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        $db_params['position'] = $this->get_position();
        $db_params['created_by'] = $this->get_created_by();
        $db_params['employer_id'] = $this->get_employer_id();
        
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
    
    public function set_alumni_id($value) {
        $this->add_object_field('alumni_id', $value);
        $this->alumni_id = $value;
    }
    
    public function get_alumni_id() {
        return $this->alumni_id;
    }
    
    public function set_start_date($value) {
        $this->add_object_field('start_date', $value);
        $this->start_date = $value;
    }
    
    public function get_start_date() {
        return $this->start_date;
    }
    
    public function set_end_date($value) {
        $this->add_object_field('end_date', $value);
        $this->end_date = $value;
    }
    
    public function get_end_date() {
        return $this->end_date;
    }
    
    public function set_position($value) {
        $this->add_object_field('position', $value);
        $this->position = $value;
    }
    
    public function get_position() {
        return $this->position;
    }
    
    public function set_created_by($value) {
        $this->add_object_field('created_by', $value);
        $this->created_by = $value;
    }
    
    public function get_created_by() {
        return $this->created_by;
    }
    
    public function set_employer_id($value) {
        $this->add_object_field('employer_id', $value);
        $this->employer_id = $value;
    }
    
    public function get_employer_id() {
        return $this->employer_id;
    }

    /**
     * @return Orm_User_Alumni
     * return and get alumni Obj
     */
    public function get_alumni_obj() {
        return Orm_User_Alumni::get_instance($this->get_alumni_id());
    }

    /**
     * @return Orm_User_Employer
     * return and get alumni Employee
     */
    public function get_employer_obj() {

        return Orm_User_Employer::get_instance($this->get_employer_id());
    }
    
}

