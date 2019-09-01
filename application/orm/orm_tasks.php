<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tasks extends Orm {
    
    /**
    * @var $instances Orm_Tasks[]
    */
    protected static $instances = array();
    protected static $table_name = 'tasks';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $from = 0;
    protected $to = 0;
    protected $title = '';
    protected $text = '';
    protected $time = '0000-00-00';
    protected $done = 0;
    
    /**
    * @return Tasks_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Tasks_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Tasks
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
    * @return Orm_Tasks[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Tasks
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Tasks();
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
        $db_params['from'] = $this->get_from();
        $db_params['to'] = $this->get_to();
        $db_params['title'] = $this->get_title();
        $db_params['text'] = $this->get_text();
        $db_params['time'] = $this->get_time();
        $db_params['done'] = $this->get_done();
        
        return $db_params;
    }
    
    public function save() {
        if ($this->get_object_status() == 'new') {

            $this->set_time(date('Y-m-d'));

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
    
    public function set_from($value) {
        $this->add_object_field('from', $value);
        $this->from = $value;
    }
    
    public function get_from($to_object = false) {
        if($to_object) {
            return Orm_User::get_instance($this->from);
        }
        return $this->from;
    }
    
    public function set_to($value) {
        $this->add_object_field('to', $value);
        $this->to = $value;
    }
    
    public function get_to($to_object = false) {
        if($to_object) {
            return Orm_User::get_instance($this->to);
        }
        return $this->to;
    }
    
    public function set_text($value) {
        $this->add_object_field('text', $value);
        $this->text = $value;
    }
    
    public function get_text() {
        return $this->text;
    }

    public function set_title($value) {
        $this->add_object_field('title', $value);
        $this->title = $value;
    }

    public function get_title() {
        return $this->title;
    }

    public function set_time($value) {
        $this->add_object_field('time', $value);
        $this->time = $value;
    }
    
    public function get_time() {
        return $this->time;
    }
    
    public function set_done($value) {
        $this->add_object_field('done', $value);
        $this->done = $value;
    }
    
    public function get_done() {
        return $this->done;
    }
    
}

