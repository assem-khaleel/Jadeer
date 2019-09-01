<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Backup extends Orm {
    
    /**
    * @var $instances Orm_Backup[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = '';
    protected $is_active = 1;
    protected $params = '';

    const BACKUP_TO_SERVER = 1;
    const BACKUP_TO_OTHER_SERVER = 2;
    const BACKUP_TO_GOOGLE_DRIVE = 3;
    
    /**
    * @return Backup_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Backup_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Backup
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
    * @return Orm_Backup[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Backup
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Backup();
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

        $db_params['id'] = $this->get_id();
        $db_params['is_active'] = $this->get_is_active();
        $db_params['params'] = json_encode($this->get_params());
        
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
    
    public function set_is_active($value) {
        $this->add_object_field('is_active', $value);
        $this->is_active = $value;
    }
    
    public function get_is_active() {
        return $this->is_active;
    }
    
    public function set_params($value) {
        if(is_array($value)) {
            $this->add_object_field('params', json_encode($value));
        } elseif (is_string($value)) {
            $this->add_object_field('params', $value);
            $value = json_decode($value, true);
        }
        $this->params = $value;
    }
    
    public function get_params() {
        return $this->params;
    }
    
    public function draw_form() {

    }
}

