<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pt_Uni_College_Relation extends Orm {
    
    protected static $table_name = 'pt_uni_college_relation';
    
    /**
    * @var $instances Orm_Pt_Uni_College_Relation[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $kuni_id = 0;
    protected $kcollege_id = 0;
    protected $college_id = 0;

    
    /**
    * @return Pt_Uni_College_Relation_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pt_Uni_College_Relation_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pt_Uni_College_Relation
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
    * @return Orm_Pt_Uni_College_Relation[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array(),$fetch_as=Orm::FETCH_OBJECTS) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, $fetch_as);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pt_Uni_College_Relation
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pt_Uni_College_Relation();
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
        $db_params['kuni_id'] = $this->get_kuni_id();
        $db_params['kcollege_id'] = $this->get_kcollege_id();
        $db_params['college_id'] = $this->get_college_id();

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
    
    public function set_kuni_id($value) {
        $this->add_object_field('kuni_id', $value);
        $this->kuni_id = $value;
    }
    
    public function get_kuni_id() {
        return $this->kuni_id;
    }
    
    public function set_kcollege_id($value) {
        $this->add_object_field('kcollege_id', $value);
        $this->kcollege_id = $value;
    }
    
    public function get_kcollege_id() {
        return $this->kcollege_id;
    }

    public function set_college_id($value) {
        $this->add_object_field('college_id', $value);
        $this->college_id = $value;
    }

    public function get_college_id() {
        return $this->college_id;
    }
    
}

