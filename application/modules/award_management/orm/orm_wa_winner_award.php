<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Wa_Winner_Award extends Orm {
    
    /**
    * @var $instances Orm_Wa_Winner_Award[]
    */
    protected static $instances = array();
    protected static $table_name = 'wa_winner_award';
    
    /**
    * class attributes
    */
    protected $award_id = 0;
    protected $user_id = 0;
    protected $id = 0;
    protected $received = 0;
    
    /**
    * @return Wa_Winner_Award_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Wa_Winner_Award_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Wa_Winner_Award
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
    * @return Orm_Wa_Winner_Award[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Wa_Winner_Award
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Wa_Winner_Award();
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

    /**
     * get array
     *
     * @param array $db_params
     * @return int
     */
    public function to_array() {
        $db_params = array();
        $db_params['award_id'] = $this->get_award_id();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['received'] = $this->get_received();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        
        return $db_params;
    }

    /**
     * save object
     *
     * @param int $insert_id
     * @return int
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

    /**
     * delete object
     * @return int
     */
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }
    
    public function set_award_id($value) {
        $this->add_object_field('award_id', $value);
        $this->award_id = $value;
    }
    
    public function get_award_id() {
        return $this->award_id;
    }
    
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }
    
    public function get_user_id() {
        return $this->user_id;
    }
    public function set_received($value) {
        $this->add_object_field('received', $value);
        $this->received = $value;
    }

    public function get_received() {
        return $this->received;
    }
    
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    public function get_user() {
        return Orm_User::get_instance($this->get_user_id());
    }
    
    
}

