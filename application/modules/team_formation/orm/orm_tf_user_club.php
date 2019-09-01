<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tf_User_Club extends Orm {
    
    /**
    * @var $instances Orm_Tf_User_Club[]
    */
    protected static $instances = array();
    protected static $table_name = 'tf_user_club';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $club_id = 0;
    protected $status = 0;
    protected $is_admin = 0;

    /**  status are 4 type :
        0 group that created by me
        1 group user invited to join
        2 group join request for my club
        3 group the user are a member in it **/
    const CLUB_FOR_ME = 0;
    const CLUB_FOR_JOIN = 1;
    const CLUB_SUBSCRIBE = 2;
    const CLUB_MEMEBER = 3;


    /**
     * is_admin tow cases:
     * 0 not admin
     * 1 admin
     */
    const USER_NOT_ADMIN = 0;
    const USER_ADMIN = 1;
    
    
    /**
    * @return Tf_User_Club_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Tf_User_Club_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Tf_User_Club
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
    * @return Orm_Tf_User_Club[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Tf_User_Club
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Tf_User_Club();
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
        $db_params['user_id'] = $this->get_user_id();
        $db_params['club_id'] = $this->get_club_id();
        $db_params['status'] = $this->get_status();
        $db_params['is_admin'] = $this->get_is_admin();
        
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
    
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }
    
    public function get_user_id($toObject = false) {
        if($toObject){
            return Orm_User::get_instance($this->user_id);
        }
        return $this->user_id;
    }
    
    public function set_club_id($value) {
        $this->add_object_field('club_id', $value);
        $this->club_id = $value;
    }
    
    public function get_club_id() {
        return $this->club_id;
    }
    
    public function set_status($value) {
        $this->add_object_field('status', $value);
        $this->status = $value;
    }
    
    public function get_status() {
        return $this->status;
    }
    
    public function set_is_admin($value) {
        $this->add_object_field('is_admin', $value);
        $this->is_admin = $value;
    }

    public function get_is_admin() {
        return $this->is_admin;
    }
    /**
     * this function get memeber obj
     * @return Orm_User the object call function
     */
    public function get_memeber_obj()
    {
        return Orm_User::get_instance($this->get_user_id());
    }

    /**
     * this function get club
     * @return Orm_Tf_Club the object call function
     */
    public function get_club(){
        return Orm_Tf_Club::get_instance($this->get_club_id());
    }
    

}

