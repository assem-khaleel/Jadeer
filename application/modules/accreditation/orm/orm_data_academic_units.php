<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Data_Academic_Units extends Orm {
    
    /**
    * @var $instances Orm_Data_Academic_Units[]
    */
    protected static $instances = array();
    protected static $table_name = 'data_academic_units';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $academic_year = 0;
    protected $no_deanships = 0;
    protected $no_colleges = 0;
    protected $no_programs = 0;
    protected $no_institutions = 0;
    protected $no_research_center = 0;
    protected $no_research_chairs = 0;
    protected $no_medical_hospital = 0;
    protected $no_scientific = 0;
    
    /**
    * @return Data_Academic_Units_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Data_Academic_Units_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Data_Academic_Units
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
    * @return Orm_Data_Academic_Units[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Data_Academic_Units
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Data_Academic_Units();
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
        $db_params['academic_year'] = $this->get_academic_year();
        $db_params['no_deanships'] = $this->get_no_deanships();
        $db_params['no_colleges'] = $this->get_no_colleges();
        $db_params['no_programs'] = $this->get_no_programs();
        $db_params['no_institutions'] = $this->get_no_institutions();
        $db_params['no_research_center'] = $this->get_no_research_center();
        $db_params['no_research_chairs'] = $this->get_no_research_chairs();
        $db_params['no_medical_hospital'] = $this->get_no_medical_hospital();
        $db_params['no_scientific'] = $this->get_no_scientific();
        
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
    
    public function set_academic_year($value) {
        $this->add_object_field('academic_year', $value);
        $this->academic_year = $value;
    }
    
    public function get_academic_year() {
        return $this->academic_year;
    }
    
    public function set_no_deanships($value) {
        $this->add_object_field('no_deanships', $value);
        $this->no_deanships = $value;
    }
    
    public function get_no_deanships() {
        return $this->no_deanships;
    }
    
    public function set_no_colleges($value) {
        $this->add_object_field('no_colleges', $value);
        $this->no_colleges = $value;
    }
    
    public function get_no_colleges() {
        return $this->no_colleges;
    }
    
    public function set_no_programs($value) {
        $this->add_object_field('no_programs', $value);
        $this->no_programs = $value;
    }
    
    public function get_no_programs() {
        return $this->no_programs;
    }
    
    public function set_no_institutions($value) {
        $this->add_object_field('no_institutions', $value);
        $this->no_institutions = $value;
    }
    
    public function get_no_institutions() {
        return $this->no_institutions;
    }
    
    public function set_no_research_center($value) {
        $this->add_object_field('no_research_center', $value);
        $this->no_research_center = $value;
    }
    
    public function get_no_research_center() {
        return $this->no_research_center;
    }
    
    public function set_no_research_chairs($value) {
        $this->add_object_field('no_research_chairs', $value);
        $this->no_research_chairs = $value;
    }
    
    public function get_no_research_chairs() {
        return $this->no_research_chairs;
    }
    
    public function set_no_medical_hospital($value) {
        $this->add_object_field('no_medical_hospital', $value);
        $this->no_medical_hospital = $value;
    }
    
    public function get_no_medical_hospital() {
        return $this->no_medical_hospital;
    }
    
    public function set_no_scientific($value) {
        $this->add_object_field('no_scientific', $value);
        $this->no_scientific = $value;
    }
    
    public function get_no_scientific() {
        return $this->no_scientific;
    }
    
    
}

