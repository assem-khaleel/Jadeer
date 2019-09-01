<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pt_Obj_Program_Relation extends Orm {
    
    protected static $table_name = 'pt_obj_program_relation';
    
    /**
    * @var $instances Orm_Pt_Obj_Program_Relation[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $obj_id = 0;
    protected $kprogram_id = 0;
    protected $program_id = 0;
    
    /**
    * @return Pt_Obj_Program_Relation_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pt_Obj_Program_Relation_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pt_Obj_Program_Relation
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
    * @return Orm_Pt_Obj_Program_Relation[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array(), $fetchAs=Orm::FETCH_OBJECTS) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, $fetchAs);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pt_Obj_Program_Relation
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pt_Obj_Program_Relation();
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
        $db_params['obj_id'] = $this->get_obj_id();
        $db_params['kprogram_id'] = $this->get_kprogram_id();
        $db_params['program_id'] = $this->get_program_id();
        
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
    
    public function set_obj_id($value) {
        $this->add_object_field('obj_id', $value);
        $this->obj_id = $value;
    }
    
    public function get_obj_id() {
        return $this->obj_id;
    }
    
    public function set_kprogram_id($value) {
        $this->add_object_field('kprogram_id', $value);
        $this->kprogram_id = $value;
    }
    
    public function get_kprogram_id() {
        return $this->kprogram_id;
    }
    
    public function set_program_id($value) {
        $this->add_object_field('program_id', $value);
        $this->program_id = $value;
    }
    
    public function get_program_id() {
        return $this->program_id;
    }
    
    
}

