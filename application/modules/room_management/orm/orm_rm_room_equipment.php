<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rm_Room_Equipment extends Orm {
    
    /**
    * @var $instances Orm_Rm_Room_Equipment[]
    */
    protected static $instances = array();
    protected static $table_name = 'rm_room_equipment';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $room_id = 0;
    protected $equipment_id = 0;
    
    /**
    * @return Rm_Room_Equipment_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Rm_Room_Equipment_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Rm_Room_Equipment
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
    * @return Orm_Rm_Room_Equipment[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Rm_Room_Equipment
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Rm_Room_Equipment();
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

    public static function delete_room($room_id) {

        foreach(self::get_all(['room_id' =>$room_id]) as $row){
            $row->delete();
        }
    }

    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['room_id'] = $this->get_room_id();
        $db_params['equipment_id'] = $this->get_equipment_id();
        
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
    
    public function set_room_id($value) {
        $this->add_object_field('room_id', $value);
        $this->room_id = $value;
    }
    
    public function get_room_id() {
        return $this->room_id;
    }
    
    public function set_equipment_id($value) {
        $this->add_object_field('equipment_id', $value);
        $this->equipment_id = $value;
    }
    
    public function get_equipment_id() {
        return $this->equipment_id;
    }
    
    
}

