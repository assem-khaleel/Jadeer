<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Node_Review_Comments extends Orm {
    
    /**
    * @var $instances Orm_Node_Review_Comments[]
    */
    protected static $instances = array();
    protected static $table_name = 'node_review_comments';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $review_id = 0;
    protected $comment = '';
    
    /**
    * @return Node_Review_Comments_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Node_Review_Comments_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Node_Review_Comments
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
    * @return Orm_Node_Review_Comments[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Node_Review_Comments
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Node_Review_Comments();
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
        $db_params['review_id'] = $this->get_review_id();
        $db_params['comment'] = $this->get_comment();
        
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
    
    public function set_review_id($value) {
        $this->add_object_field('review_id', $value);
        $this->review_id = $value;
    }
    
    public function get_review_id() {
        return $this->review_id;
    }
    
    public function set_comment($value) {
        $this->add_object_field('comment', $value);
        $this->comment = $value;
    }
    
    public function get_comment() {
        return $this->comment;
    }
    
    
}

