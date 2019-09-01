<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Activity_History extends Orm {
    
    /**
    * @var $instances Orm_Sp_Activity_History[]
    */
    protected static $instances = array();
    protected static $table_name = 'sp_activity_history';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $activity_id = 0;
    protected $date = '0000-00-00';
    protected $lead = 0;
    protected $lag = 0;
    
    /**
    * @return Sp_Activity_History_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Sp_Activity_History_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Sp_Activity_History
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
    * @return Orm_Sp_Activity_History[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Sp_Activity_History
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Sp_Activity_History();
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
        $db_params['activity_id'] = $this->get_activity_id();
        $db_params['date'] = $this->get_date();
        $db_params['lead'] = $this->get_lead();
        $db_params['lag'] = $this->get_lag();
        
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
    
    public function set_activity_id($value) {
        $this->add_object_field('activity_id', $value);
        $this->activity_id = $value;
    }
    
    public function get_activity_id() {
        return $this->activity_id;
    }
    
    public function set_date($value) {
        $this->add_object_field('date', $value);
        $this->date = $value;
    }
    
    public function get_date() {
        return $this->date;
    }
    
    public function set_lead($value) {
        $this->add_object_field('lead', $value);
        $this->lead = $value;
    }
    
    public function get_lead() {
        return $this->lead;
    }
    
    public function set_lag($value) {
        $this->add_object_field('lag', $value);
        $this->lag = $value;
    }
    
    public function get_lag() {
        return $this->lag;
    }
    
    
}

