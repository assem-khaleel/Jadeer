<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tst_Question_Option_Points extends Orm {
    
    /**
    * @var $instances Orm_Tst_Question_Option_Points[]
    */
    protected static $instances = array();
    protected static $table_name = 'tst_question_option_points';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $question_id = 0;
    protected $option_id = 0;
    protected $user_id = 0;
    protected $point = 0;
    
    /**
    * @return Tst_Question_Option_Points_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Tst_Question_Option_Points_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Tst_Question_Option_Points
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
    * @return Orm_Tst_Question_Option_Points[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Tst_Question_Option_Points
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Tst_Question_Option_Points();
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
        $db_params['question_id'] = $this->get_question_id();
        $db_params['option_id'] = $this->get_option_id();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['point'] = $this->get_point();
        
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
    
    public function set_question_id($value) {
        $this->add_object_field('question_id', $value);
        $this->question_id = $value;
    }
    
    public function get_question_id() {
        return $this->question_id;
    }
    
    public function set_option_id($value) {
        $this->add_object_field('option_id', $value);
        $this->option_id = $value;
    }
    
    public function get_option_id() {
        return $this->option_id;
    }
    
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }
    
    public function get_user_id() {
        return $this->user_id;
    }
    
    public function set_point($value) {
        $this->add_object_field('point', $value);
        $this->point = $value;
    }
    
    public function get_point() {
        return $this->point;
    }
    
    
}

