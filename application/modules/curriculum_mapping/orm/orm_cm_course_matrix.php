<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Course_Matrix extends Orm {
    
    /**
    * @var $instances Orm_Cm_Course_Matrix[]
    */
    protected static $instances = array();
    protected static $table_name = 'cm_course_matrix';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $clo_id = 0;
    protected $plo_id = 0;
    
    /**
    * @return Cm_Course_Matrix_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Course_Matrix_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Course_Matrix
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
    * @return Orm_Cm_Course_Matrix[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Course_Matrix
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Course_Matrix();
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
        $db_params['clo_id'] = $this->get_clo_id();
        $db_params['plo_id'] = $this->get_plo_id();
        
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
    
    public function set_clo_id($value) {
        $this->add_object_field('clo_id', $value);
        $this->clo_id = $value;
    }
    
    public function get_clo_id() {
        return $this->clo_id;
    }
    
    public function set_plo_id($value) {
        $this->add_object_field('plo_id', $value);
        $this->plo_id = $value;
    }
    
    public function get_plo_id() {
        return $this->plo_id;
    }
    
    
}

