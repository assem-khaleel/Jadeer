<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Al_Custom extends Orm {
    
    /**
    * @var $instances Orm_Al_Custom[]
    */
    protected static $instances = array();
    protected static $table_name = 'al_custom';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $title = '';
    protected $attachment = '';
    protected $description = '';



    /**
    * @return Al_Custom_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Al_Custom_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Al_Custom
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
    * @return Orm_Al_Custom[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return parent::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Al_Custom
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Al_Custom();
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

    /** convert object to array
    */
    public function to_array() {
        $db_params = array();
        $db_params['id'] = $this->get_id();
        $db_params['title'] = $this->get_title();
        $db_params['attachment'] = $this->get_attachment();
        $db_params['description'] = $this->get_description();
        
        return $db_params;
    }

    /** save object
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
        return $this;
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
    
    public function set_title($value) {
        $this->add_object_field('title', $value);
        $this->title = $value;
    }
    
    public function get_title() {
        return $this->title;
    }
    
    public function set_attachment($value) {
        $this->add_object_field('attachment', $value);
        $this->attachment = $value;
    }
    
    public function get_attachment() {
        return $this->attachment;
    }
    
    public function set_description($value) {
        $this->add_object_field('description', $value);
        $this->description = $value;
    }
    
    public function get_description() {
        return $this->description;
    }

    public function get_assessment_loop_obj() {
        return Orm_Al_Assessment_Loop_Custom::get_one(['item_id' => $this->get_id()]);
    }

}

