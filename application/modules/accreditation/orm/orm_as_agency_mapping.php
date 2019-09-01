<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_As_Agency_Mapping extends Orm {
    
    /**
    * @var $instances Orm_As_Agency_Mapping[]
    */
    protected static $instances = array();
    protected static $table_name = 'as_agency_mapping';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $college_id = 0;
    protected $agency_id = 0;
    protected $date_added = '0000-00-00 00:00:00';
    protected $date_modified = '0000-00-00 00:00:00';
    
    /**
    * @return As_Agency_Mapping_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('As_Agency_Mapping_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_As_Agency_Mapping
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
    * @return Orm_As_Agency_Mapping[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_As_Agency_Mapping
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_As_Agency_Mapping();
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
        $db_params['college_id'] = $this->get_college_id();
        $db_params['agency_id'] = $this->get_agency_id();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['date_modified'] = $this->get_date_modified();
        
        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $this->set_date_added(date('Y-m-d H:i:s'));

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
    
    public function set_college_id($value) {
        $this->add_object_field('college_id', $value);
        $this->college_id = $value;
    }
    
    public function get_college_id() {
        return $this->college_id;
    }

    public function get_college_obj() {
        return Orm_College::get_instance($this->get_college_id());
    }
    
    public function set_agency_id($value) {
        $this->add_object_field('agency_id', $value);
        $this->agency_id = $value;
    }
    
    public function get_agency_id() {
        return $this->agency_id;
    }

    public function get_agency_obj() {
        return Orm_As_Agency::get_instance($this->get_agency_id());
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

    public static function get_colleges($agency_id){
        return array_column(self::get_model()->get_all(array('agency_id' => $agency_id), 0, 0, array(), Orm::FETCH_ARRAY), 'college_id');
    }
    
}

