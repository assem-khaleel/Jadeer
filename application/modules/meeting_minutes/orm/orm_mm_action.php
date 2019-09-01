<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Mm_Action extends Orm {
    
    /**
    * @var $instances Orm_Mm_Action[]
    */
    protected static $instances = array();
    protected static $table_name = 'mm_action';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $meeting_id = 0;
    protected $owner_name = '';
    protected $action = '';
    protected $due = '';
    
    /**
    * @return Mm_Action_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Mm_Action_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Mm_Action
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
    * @return Orm_Mm_Action[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Mm_Action
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Mm_Action();
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
        $db_params['meeting_id'] = $this->get_meeting_id();
        $db_params['owner_name'] = $this->get_owner_name();
        $db_params['action'] = $this->get_action();
        $db_params['due'] = $this->get_due();
        
        return $db_params;
    }



    /**
     * save object
     *
     * @param array $insert_id
     * @return int
     */
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

    /** delete object
    */
    
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
    
    public function set_meeting_id($value) {
        $this->add_object_field('meeting_id', $value);
        $this->meeting_id = $value;
    }
    
    public function get_meeting_id($obj = false) {
        if($obj) {
            return Orm_Mm_Meeting::get_instance($this->meeting_id);
        }
        return $this->meeting_id;
    }
    
    public function set_owner_name($value) {
        $this->add_object_field('owner_name', $value);
        $this->owner_name = $value;
    }
    
    public function get_owner_name() {
        return $this->owner_name;
    }
    
    public function set_action($value) {
        $this->add_object_field('action', $value);
        $this->action = $value;
    }
    
    public function get_action() {
        return $this->action;
    }
    
    public function set_due($value) {
        $this->add_object_field('due', $value);
        $this->due = $value;
    }
    
    public function get_due() {
        return $this->due;
    }
    
    
}

