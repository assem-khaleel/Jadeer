<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Manual extends Orm {
    
    /**
    * @var $instances Orm_Manual[]
    */
    protected static $instances = array();
    protected static $table_name = 'manual';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $label_arabic = '';
    protected $label_english = '';
    protected $link_arabic = '';
    protected $link_english = '';
    
    /**
    * @return Manual_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Manual_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Manual
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
    * @return Orm_Manual[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Manual
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Manual();
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
        $db_params['label_arabic'] = $this->get_label_arabic();
        $db_params['label_english'] = $this->get_label_english();
        $db_params['link_arabic'] = $this->get_link_arabic();
        $db_params['link_english'] = $this->get_link_english();
        
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

    public function get_label($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_label_arabic();
        }
        return $this->get_label_english();
    }
    
    public function set_label_arabic($value) {
        $this->add_object_field('label_arabic', $value);
        $this->label_arabic = $value;
    }
    
    public function get_label_arabic() {
        return $this->label_arabic;
    }
    
    public function set_label_english($value) {
        $this->add_object_field('label_english', $value);
        $this->label_english = $value;
    }
    
    public function get_label_english() {
        return $this->label_english;
    }

    public function get_link($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_link_arabic();
        }
        return $this->get_link_english();
    }
    
    public function set_link_arabic($value) {
        $this->add_object_field('link_arabic', $value);
        $this->link_arabic = $value;
    }
    
    public function get_link_arabic() {
        return $this->link_arabic;
    }
    
    public function set_link_english($value) {
        $this->add_object_field('link_english', $value);
        $this->link_english = $value;
    }
    
    public function get_link_english() {
        return $this->link_english;
    }
    
    
}

