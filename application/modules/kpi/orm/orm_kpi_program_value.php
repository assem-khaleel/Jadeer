<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Kpi_Program_Value extends Orm {
    
    /**
    * @var $instances Orm_Kpi_Program_Value[]
    */
    protected static $instances = array();
    protected static $table_name = 'kpi_program_value';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $detail_id = 0;
    protected $program_id = 0;
    protected $actual_benchmark = 0;
    protected $internal_college_benchmark = 0.00;
    protected $internal_institution_benchmark = 0.00;
    protected $target_benchmark = 0.00;
    protected $new_benchmark = 0.00;
    protected $external_benchmark = '';
    
    /**
    * @return Kpi_Program_Value_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Kpi_Program_Value_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Kpi_Program_Value
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
    * @return Orm_Kpi_Program_Value[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Kpi_Program_Value
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Kpi_Program_Value();
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
        $db_params['detail_id'] = $this->get_detail_id();
        $db_params['program_id'] = $this->get_program_id();
        $db_params['actual_benchmark'] = $this->get_actual_benchmark();
        $db_params['internal_college_benchmark'] = $this->get_internal_college_benchmark();
        $db_params['internal_institution_benchmark'] = $this->get_internal_institution_benchmark();
        $db_params['target_benchmark'] = $this->get_target_benchmark();
        $db_params['new_benchmark'] = $this->get_new_benchmark();
        $db_params['external_benchmark'] = $this->get_external_benchmark();
        
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
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_detail_id($value) {
        $this->add_object_field('detail_id',$value);
        $this->detail_id = $value;
    }
    
    public function get_detail_id() {
        return $this->detail_id;
    }
    
    public function set_program_id($value) {
        $this->add_object_field('program_id',$value);
        $this->program_id = $value;
    }
    
    public function get_program_id() {
        return $this->program_id;
    }
    
    public function set_actual_benchmark($value) {
        $this->add_object_field('actual_benchmark',$value);
        $this->actual_benchmark = $value;
    }
    
    public function get_actual_benchmark() {
        return $this->actual_benchmark;
    }
    
    public function set_internal_college_benchmark($value) {
        $this->add_object_field('internal_college_benchmark',$value);
        $this->internal_college_benchmark = $value;
    }
    
    public function get_internal_college_benchmark() {
        return $this->internal_college_benchmark;
    }
    
    public function set_internal_institution_benchmark($value) {
        $this->add_object_field('internal_institution_benchmark',$value);
        $this->internal_institution_benchmark = $value;
    }
    
    public function get_internal_institution_benchmark() {
        return $this->internal_institution_benchmark;
    }
    
    public function set_target_benchmark($value) {
        $this->add_object_field('target_benchmark',$value);
        $this->target_benchmark = $value;
    }
    
    public function get_target_benchmark() {
        return $this->target_benchmark;
    }
    
    public function set_new_benchmark($value) {
        $this->add_object_field('new_benchmark',$value);
        $this->new_benchmark = $value;
    }
    
    public function get_new_benchmark() {
        return $this->new_benchmark;
    }
    
    public function set_external_benchmark($value) {
        $this->add_object_field('external_benchmark',$value);
        $this->external_benchmark = $value;
    }
    
    public function get_external_benchmark() {
        return $this->external_benchmark;
    }

    /**
     * get all external benchmark as array
     * @return mixed
     */
    public function get_external_benchmark_array()
    {
        return json_decode($this->get_external_benchmark(),true);
    }

    /**
     * get external benchmark label after extracting the array
     * @param $label
     * @return int
     */
    public function get_external_benchmark_by_label($label)
    {
        $array = $this->get_external_benchmark_array();
        return isset($array[$label]) ? $array[$label] : 0;
    }
}

