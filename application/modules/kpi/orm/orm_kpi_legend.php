<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Kpi_Legend extends Orm {
    
    /**
    * @var $instances Orm_Kpi_Legend[]
    */
    protected static $instances = array();
    protected static $table_name = 'kpi_legend';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $title = '';
    protected $level_id = 0;
    
    /**
    * @return Kpi_Legend_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Kpi_Legend_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Kpi_Legend
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
    * @return Orm_Kpi_Legend[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Kpi_Legend
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Kpi_Legend();
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
        $db_params['title'] = $this->get_title();
        $db_params['level_id'] = $this->get_level_id();
        
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
    
    public function set_title($value) {
        $this->add_object_field('title',$value);
        $this->title = $value;
    }
    
    public function get_title() {
        return $this->title;
    }
    
    public function set_level_id($value) {
        $this->add_object_field('level_id',$value);
        $this->level_id = $value;
    }
    
    public function get_level_id() {
        return $this->level_id;
    }

    /**
     * remove all related data depends on specific parameters
     * @param $filters => the keywords that will help to remove the legend
     * @return object
     */
    public static function delete_all($filters) {
        return self::get_model()->delete_all($filters);
    }
    
    
}

