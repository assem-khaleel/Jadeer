<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Al_Recommendation extends Orm {
    
    /**
    * @var $instances Orm_Al_Recommendation[]
    */
    protected static $instances = array();
    protected static $table_name = 'al_recommendation';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $assessment_loop_id = 0;
    protected $text_en = '';
    protected $text_ar = '';
    
    /**
    * @return Al_Recommendation_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Al_Recommendation_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Al_Recommendation
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
    * @return Orm_Al_Recommendation[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Al_Recommendation
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Al_Recommendation();
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

    /** convert object to array
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['assessment_loop_id'] = $this->get_assessment_loop_id();
        $db_params['text_en'] = $this->get_text_en();
        $db_params['text_ar'] = $this->get_text_ar();
        
        return $db_params;
    }
    /** save object
     */
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
    /** delete object
    */
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
    
    public function set_assessment_loop_id($value) {
        $this->add_object_field('assessment_loop_id', $value);
        $this->assessment_loop_id = $value;
    }
    
    public function get_assessment_loop_id() {
        return $this->assessment_loop_id;
    }

    public function get_text($lang = UI_LANG) {
        if($lang=='arabic') {
            return $this->get_text_ar();
        }
        return $this->get_text_en();
    }
    
    public function set_text_en($value) {
        $this->add_object_field('text_en', $value);
        $this->text_en = $value;
    }
    
    public function get_text_en() {
        return $this->text_en;
    }
    
    public function set_text_ar($value) {
        $this->add_object_field('text_ar', $value);
        $this->text_ar = $value;
    }
    
    public function get_text_ar() {
        return $this->text_ar;
    }
    
    
}

