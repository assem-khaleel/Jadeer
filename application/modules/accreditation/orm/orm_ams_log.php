<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Ams_Log extends Orm {
    
    /**
    * @var $instances Orm_Ams_Log[]
    */
    protected static $instances = array();
    protected static $table_name = 'ams_log';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_added = 0;
    protected $date_added = '0000-00-00 00:00:00';
    protected $is_released = 0;
    protected $date_released = '0000-00-00 00:00:00';
    protected $comment = '';
    protected $forms = '';
    protected $type = '';
    
    /**
    * @return Ams_Log_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Ams_Log_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Ams_Log
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
    * @return Orm_Ams_Log[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Ams_Log
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Ams_Log();
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
        $db_params['user_added'] = $this->get_user_added();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['is_released'] = $this->get_is_released();
        $db_params['date_released'] = $this->get_date_released();
        $db_params['comment'] = $this->get_comment();
        $db_params['forms'] = json_encode($this->get_forms());
        $db_params['type'] = $this->get_type();
        
        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $this->set_user_added(Orm_User::get_logged_user()->get_id());
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
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_user_added($value) {
        $this->add_object_field('user_added',$value);
        $this->user_added = $value;
    }
    
    public function get_user_added() {
        return $this->user_added;
    }
    
    public function set_date_added($value) {
        $this->add_object_field('date_added',$value);
        $this->date_added = $value;
    }
    
    public function get_date_added() {
        return $this->date_added;
    }
    
    public function set_is_released($value) {
        $this->add_object_field('is_released',$value);
        $this->is_released = $value;
    }
    
    public function get_is_released() {
        return $this->is_released;
    }
    
    public function set_date_released($value) {
        $this->add_object_field('date_released',$value);
        $this->date_released = $value;
    }
    
    public function get_date_released() {
        return $this->date_released;
    }
    
    public function set_comment($value) {
        $this->add_object_field('comment',$value);
        $this->comment = $value;
    }
    
    public function get_comment() {
        return $this->comment;
    }
    
    public function set_forms($value) {

        if(is_array($value)) {
            $this->add_object_field('forms', json_encode($value));
        } elseif (is_string($value)) {
            $this->add_object_field('forms', $value);
            $value = json_decode($value, true);
        }

        $this->forms = $value;
    }
    
    public function get_forms() {
        return $this->forms;
    }
    
    public function set_type($value) {
        $this->add_object_field('type',$value);
        $this->type = $value;
    }
    
    public function get_type() {
        return $this->type;
    }

    /**
     * @return Orm_User
     */
    public function get_user_added_obj() {
        return Orm_User::get_instance($this->get_user_added());
    }
}

