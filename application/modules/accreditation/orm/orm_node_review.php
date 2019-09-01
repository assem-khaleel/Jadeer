<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Node_Review extends Orm {
    
    /**
    * @var $instances Orm_Node_Review[]
    */
    protected static $instances = array();
    protected static $table_name = 'node_review';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $node_id = 0;
    protected $reviewer_id = 0;
    protected $date_added = '0000-00-00 00:00:00';
    protected $status = 'none';
    protected $comment = '';
    
    /**
    * @return Node_Review_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Node_Review_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Node_Review
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
    * @return Orm_Node_Review[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Node_Review
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Node_Review();
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
        $db_params['node_id'] = $this->get_node_id();
        $db_params['reviewer_id'] = $this->get_reviewer_id();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['status'] = $this->get_status();
        $db_params['comment'] = $this->get_comment();
        
        return $db_params;
    }
    
    public function save() {
        if ($this->get_object_status() == 'new') {
            $this->set_date_added(date('Y-m-d H:i:s'));

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
    
    public function set_node_id($value) {
        $this->add_object_field('node_id', $value);
        $this->node_id = $value;
    }
    
    public function get_node_id() {
        return $this->node_id;
    }
    
    public function set_reviewer_id($value) {
        $this->add_object_field('reviewer_id', $value);
        $this->reviewer_id = $value;
    }
    
    public function get_reviewer_id() {
        return $this->reviewer_id;
    }

    public function get_reviewer_obj() {
        return Orm_User::get_instance($this->get_reviewer_id());
    }
    
    public function set_date_added($value) {
        $this->add_object_field('date_added', $value);
        $this->date_added = $value;
    }
    
    public function get_date_added() {
        return $this->date_added;
    }
    
    public function set_status($value) {
        $this->add_object_field('status', $value);
        $this->status = $value;
    }
    
    public function get_status() {
        return $this->status;
    }
    
    public function set_comment($value) {
        $this->add_object_field('comment', $value);
        $this->comment = $value;
    }
    
    public function get_comment() {
        return $this->comment;
    }
    
    
}

