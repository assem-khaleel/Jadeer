<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Al_Action extends Orm {
    
    /**
    * @var $instances Orm_Al_Action[]
    */
    protected static $instances = array();
    protected static $table_name = 'al_action';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $assessment_loop_id = 0;
    protected $action_en = '';
    protected $action_ar = '';
    protected $responsible_en = '';
    protected $responsible_ar = '';
    protected $time_frame_en = '';
    protected $time_frame_ar = '';
    
    /**
    * @return Al_Action_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Al_Action_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Al_Action
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
    * @return Orm_Al_Action[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Al_Action
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Al_Action();
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
        $db_params['assessment_loop_id'] = $this->get_assessment_loop_id();
        $db_params['action_en'] = $this->get_action_en();
        $db_params['action_ar'] = $this->get_action_ar();
        $db_params['responsible_en'] = $this->get_responsible_en();
        $db_params['responsible_ar'] = $this->get_responsible_ar();
        $db_params['time_frame_en'] = $this->get_time_frame_en();
        $db_params['time_frame_ar'] = $this->get_time_frame_ar();
        
        return $db_params;
    }

    /** save object of action
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

    
    public function set_action_en($value) {
        $this->add_object_field('action_en', $value);
        $this->action_en = $value;
    }
    
    public function get_action_en() {
        return $this->action_en;
    }
    
    public function set_action_ar($value) {
        $this->add_object_field('action_ar', $value);
        $this->action_ar = $value;
    }
    
    public function get_action_ar() {
        return $this->action_ar;
    }
    
    public function set_responsible_en($value) {
        $this->add_object_field('responsible_en', $value);
        $this->responsible_en = $value;
    }
    
    public function get_responsible_en() {
        return $this->responsible_en;
    }
    
    public function set_responsible_ar($value) {
        $this->add_object_field('responsible_ar', $value);
        $this->responsible_ar = $value;
    }
    
    public function get_responsible_ar() {
        return $this->responsible_ar;
    }
    
    public function set_time_frame_en($value) {
        $this->add_object_field('time_frame_en', $value);
        $this->time_frame_en = $value;
    }
    
    public function get_time_frame_en() {
        return $this->time_frame_en;
    }
    
    public function set_time_frame_ar($value) {
        $this->add_object_field('time_frame_ar', $value);
        $this->time_frame_ar = $value;
    }
    
    public function get_time_frame_ar() {
        return $this->time_frame_ar;
    }

    public function get_action($lang = UI_LANG) {
        if($lang=='arabic') {
            return $this->get_action_ar();
        }
        return $this->get_action_en();
    }

    public function get_responsible($lang = UI_LANG) {
        if($lang=='arabic') {
            return $this->get_responsible_ar();
        }
        return $this->get_responsible_en();
    }

    public function get_time_frame($lang = UI_LANG) {
        if($lang=='arabic') {
            return $this->get_time_frame_ar();
        }
        return $this->get_time_frame_en();
    }


}

