<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rb_Settings extends Orm {
    
    /**
    * @var $instances Orm_Rb_Settings[]
    */
    protected static $instances = array();
    protected static $table_name = 'rb_settings';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $key_text = '';
    protected $key_value = '';
    
    /**
    * @return Rb_Settings_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Rb_Settings_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Rb_Settings
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
    * @return Orm_Rb_Settings[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Rb_Settings
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Rb_Settings();
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
        $db_params['key_text'] = $this->get_key_text();
        $db_params['key_value'] = $this->get_key_value();
        
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
    
    public function set_key_text($value) {
        $this->add_object_field('key_text', $value);
        $this->key_text = $value;
    }
    
    public function get_key_text() {
        return $this->key_text;
    }
    
    public function set_key_value($value) {
        $this->add_object_field('key_value', $value);
        $this->key_value = $value;
    }
    
    public function get_key_value() {
        return $this->key_value;
    }

    public static function get_value($key) {
        $row = self::get_one(['key_text' => $key]);

        if($row->get_id()){
            return $row->get_key_value();
        }

        return '';
    }

    public static function set_value($key, $value) {
        $row = self::get_one(['key_text' => $key]);

        $row->set_key_text($value);
        $row->set_key_value($value);

        return $row->save();
    }
    
    
}

