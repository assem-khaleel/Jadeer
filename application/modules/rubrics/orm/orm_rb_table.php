<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rb_Table extends Orm {
    
    /**
    * @var $instances Orm_Rb_Table[]
    */
    protected static $instances = array();
    protected static $table_name = 'rb_table';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $rubric_id = 0;
    protected $skill_id = 0;
    protected $scale_id = 0;
    protected $target = 0;
    protected $description_en = '';
    protected $description_ar = '';
    protected $date_added = 0;
    protected $date_modified = 0;
    
    /**
    * @return Rb_Table_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Rb_Table_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Rb_Table
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
    * @return Orm_Rb_Table[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Rb_Table
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Rb_Table();
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
        $db_params['rubric_id'] = $this->get_rubric_id();
        $db_params['skill_id'] = $this->get_skill_id();
        $db_params['scale_id'] = $this->get_scale_id();
        $db_params['target'] = $this->get_target();
        $db_params['description_en'] = $this->get_description_en();
        $db_params['description_ar'] = $this->get_description_ar();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['date_modified'] = $this->get_date_modified();
        
        return $db_params;
    }
    
    public function save() {
        if ($this->get_object_status() == 'new') {
            self::get_model()->insert($this->to_array());
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }
        
        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this;
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

    public function get_rubric_id() {
        return $this->rubric_id;
    }

    public function set_rubric_id($value) {
        $this->add_object_field('rubric_id', $value);
        $this->rubric_id = $value;
    }

    public function set_skill_id($value) {
        $this->add_object_field('skill_id', $value);
        $this->skill_id = $value;
    }
    
    public function get_skill_id() {
        return $this->skill_id;
    }
    
    public function set_scale_id($value) {
        $this->add_object_field('scale_id', $value);
        $this->scale_id = $value;
    }
    
    public function get_scale_id() {
        return $this->scale_id;
    }

    public function set_target($value) {
        $this->add_object_field('target', $value);
        $this->target = $value;
    }
    
    public function get_target() {
        return $this->target;
    }
    
    public function set_description_en($value) {
        $this->add_object_field('description_en', $value);
        $this->description_en = $value;
    }
    
    public function get_description_en() {
        return $this->description_en;
    }
    
    public function set_description_ar($value) {
        $this->add_object_field('description_ar', $value);
        $this->description_ar = $value;
    }
    
    public function get_description_ar() {
        return $this->description_ar;
    }

    public function get_description($lang=UI_LANG) {
        if($lang=='arabic'){
            return $this->description_ar;
        }

        return $this->description_en;
    }

    public function set_date_added($value) {
        $this->add_object_field('date_added', $value);
        $this->date_added = $value;
    }
    
    public function get_date_added() {
        return $this->date_added;
    }
    
    public function set_date_modified($value) {
        $this->add_object_field('date_modified', $value);
        $this->date_modified = $value;
    }
    
    public function get_date_modified() {
        return $this->date_modified;
    }


}

