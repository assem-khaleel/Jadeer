<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Thread_Group_Members extends Orm {
    
    /**
    * @var $instances Orm_Thread_Group_Members[]
    */
    protected static $instances = array();
    protected static $table_name = 'thread_group_members';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $group_id = 0;
    protected $user_id = 0;
    
    /**
    * @return Thread_Group_Members_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Thread_Group_Members_Model', 'thread');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Thread_Group_Members
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
    * @return Orm_Thread_Group_Members[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Thread_Group_Members
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Thread_Group_Members();
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
        $db_params['group_id'] = $this->get_group_id();
        $db_params['user_id'] = $this->get_user_id();
        
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
    
    public function set_group_id($value) {
        $this->add_object_field('group_id', $value);
        $this->group_id = $value;
    }
    
    public function get_group_id() {
        return $this->group_id;
    }
    
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }
    
    public function get_user_id() {
        return $this->user_id;
    }

    public function get_user_obj() {
        return Orm_User::get_instance($this->get_user_id());
    }

    public function get_group_obj() {
        return Orm_Thread_Group::get_instance($this->get_group_id());
    }
    
}

