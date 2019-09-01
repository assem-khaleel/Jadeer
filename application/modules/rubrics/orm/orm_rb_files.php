<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rb_Files extends Orm {
    
    /**
    * @var $instances Orm_Rb_Files[]
    */
    protected static $instances = array();
    protected static $table_name = 'rb_files';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $rubrics_id = 0;
    protected $user_id = 0;
    protected $file_name = '';
    protected $file_path = '';
    protected $file_header = '';
    protected $date_added = 0;
    protected $date_modified = 0;
    
    /**
    * @return Rb_Files_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Rb_Files_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Rb_Files
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
    * @return Orm_Rb_Files[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Rb_Files
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Rb_Files();
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
        $db_params['user_id'] = $this->get_user_id();
        $db_params['file_name'] = $this->get_file_name();
        $db_params['file_path'] = $this->get_file_path();
        $db_params['file_header'] = $this->get_file_header();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['date_modified'] = $this->get_date_modified();
        
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
    
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }
    
    public function get_user_id() {
        return $this->user_id;
    }
    
    public function set_file_name($value) {
        $this->add_object_field('file_name', $value);
        $this->file_name = $value;
    }
    
    public function get_file_name() {
        return $this->file_name;
    }
    
    public function set_file_path($value) {
        $this->add_object_field('file_path', $value);
        $this->file_path = $value;
    }
    
    public function get_file_path() {
        return $this->file_path;
    }
    
    public function set_file_header($value) {
        $this->add_object_field('file_header', $value);
        $this->file_header = $value;
    }
    
    public function get_file_header() {
        return $this->file_header;
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

