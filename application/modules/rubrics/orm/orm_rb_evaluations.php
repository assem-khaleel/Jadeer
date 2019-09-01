<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rb_Evaluations extends Orm {
    
    /**
    * @var $instances Orm_Rb_Evaluations[]
    */
    protected static $instances = array();
    protected static $table_name = 'rb_evaluations';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $description_en = '';
    protected $description_ar = '';
    protected $rubrics_id = 0;
    protected $date_added = '0000-00-00 ';
    protected $criteria = '';
    
    /**
    * @return Rb_Evaluations_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Rb_Evaluations_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Rb_Evaluations
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
    * @return Orm_Rb_Evaluations[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Rb_Evaluations
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Rb_Evaluations();
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
        $db_params['description_en'] = $this->get_description_en();
        $db_params['description_ar'] = $this->get_description_ar();
        $db_params['rubrics_id'] = $this->get_rubrics_id();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['criteria'] = $this->get_criteria();
        
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
    
    public function set_description_en($value) {
        $this->add_object_field('description_en', $value);
        $this->description_en = $value;
    }
    
    public function get_description_en() {
        return $this->description_en;
    }
    
    public function set_description_ar($value) {
        $this->add_object_field('description_ar', $value);
        $this->description_ar = $value;
    }
    
    public function get_description_ar() {
        return $this->description_ar;
    }
    
    public function set_rubrics_id($value) {
        $this->add_object_field('rubrics_id', $value);
        $this->rubrics_id = $value;
    }
    
    public function get_rubrics_id() {
        return $this->rubrics_id;
    }
    
    public function set_date_added($value) {
        $this->add_object_field('date_added', $value);
        $this->date_added = $value;
    }
    
    public function get_date_added() {
        return $this->date_added;
    }
    
    public function set_criteria($value) {
        $this->add_object_field('criteria', $value);
        $this->criteria = $value;
    }
    
    public function get_criteria() {
        return $this->criteria;
    }

    public function get_description($lang = UI_LANG) {
        if($lang=='arabic'){
            return $this->get_description_ar();
        }
        return $this->get_description_en();
    }

}

