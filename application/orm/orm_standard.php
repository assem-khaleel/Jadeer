<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Standard extends Orm {
    
    /**
    * @var $instances Orm_Standard[]
    */
    protected static $instances = array();
    protected static $table_name = 'standard';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $code = '';
    protected $title = '';
    protected $created_by = 0;
    protected $date_added = 0;
    protected $date_modified = 0;
    protected $is_deleted = 0;
    
    /**
    * @return Standard_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Standard_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Standard
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
    * @return Orm_Standard[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Standard
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Standard();
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
        $db_params['code'] = $this->get_code();
        $db_params['title'] = $this->get_title();
        $db_params['created_by'] = $this->get_created_by();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['date_modified'] = $this->get_date_modified();
        $db_params['is_deleted'] = $this->get_is_deleted();
        
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

    public static function to_objects($standards = array()) {
        $objects = array();
        if (count($standards) > 0) {
            foreach ($standards as $row) {
                $objects[] = Orm_Standard::to_object($row);
            }
        }

        return $objects;
    }
    
    public function set_id($value) {
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_code($value) {
        $this->add_object_field('code',$value);
        $this->code = $value;
    }
    
    public function get_code() {
        return $this->code;
    }
    
    public function set_title($value) {
        $this->add_object_field('title',$value);
        $this->title = $value;
    }
    
    public function get_title() {
        return $this->title;
    }
    
    public function set_created_by($value) {
        $this->add_object_field('created_by',$value);
        $this->created_by = $value;
    }
    
    public function get_created_by() {
        return $this->created_by;
    }
    
    public function set_date_added($value) {
        $this->add_object_field('date_added',$value);
        $this->date_added = $value;
    }
    
    public function get_date_added() {
        return $this->date_added;
    }
    
    public function set_date_modified($value) {
        $this->add_object_field('date_modified',$value);
        $this->date_modified = $value;
    }
    
    public function get_date_modified() {
        return $this->date_modified;
    }
    
    public function set_is_deleted($value) {
        $this->add_object_field('is_deleted',$value);
        $this->is_deleted = $value;
    }
    
    public function get_is_deleted() {
        return $this->is_deleted;
    }

    public function draw_performance_scoring() {
        $html = '<div class="col-md-2">';
        $html .= 'Standard ' . htmlfilter($this->get_code() . ' ' . $this->get_title());
        $html .= '</div>';
        $html .= '';
    }
}

