<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rb_Scale extends Orm {
    
    /**
    * @var $instances Orm_Rb_Scale[]
    */
    protected static $instances = array();
    protected static $table_name = 'rb_scale';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $rubrics_id = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $weight = 0;

    /**
    * @return Rb_Scale_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Rb_Scale_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Rb_Scale
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
    * @return Orm_Rb_Scale[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Rb_Scale
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Rb_Scale();
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
        $db_params['rubrics_id'] = $this->get_rubrics_id();
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['weight'] = $this->get_weight();
        
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
    
    public function set_rubrics_id($value) {
        $this->add_object_field('rubrics_id', $value);
        $this->rubrics_id = $value;
    }
    
    public function get_rubrics_id() {
        return $this->rubrics_id;
    }
    
    public function set_name_en($value) {
        $this->add_object_field('name_en', $value);
        $this->name_en = $value;
    }
    
    public function get_name_en() {
        return $this->name_en;
    }
    
    public function set_name_ar($value) {
        $this->add_object_field('name_ar', $value);
        $this->name_ar = $value;
    }
    
    public function get_name_ar() {
        return $this->name_ar;
    }

    public function get_name($lang=UI_LANG) {
        if($lang=='arabic') {
            return $this->get_name_ar();
        }

        return $this->get_name_en();
    }
    
    public function set_weight($value) {
        $this->add_object_field('weight', $value);
        $this->weight = $value;
    }
    
    public function get_weight() {
        return $this->weight;
    }

    
}

