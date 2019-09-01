<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tm_Members extends Orm {

    /**
     * @var $instances Orm_Tm_Members[]
     */
    protected static $instances = array();
    protected static $table_name = 'tm_members';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $training_id = 0;
    protected $user_id = 0;
    protected $status = 0;

    /**
     * Status Types
     */
    const USER_WAITING = 0;
    const USER_JOINED = 1;
    const USER_PENDING = 2;



    /**
     * @return Tm_Members_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Tm_Members_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Tm_Members
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
     * @return Orm_Tm_Members[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Tm_Members
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Tm_Members();
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
        $db_params['training_id'] = $this->get_training_id();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['status'] = $this->get_status();

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

    public function set_training_id($value) {
        $this->add_object_field('training_id', $value);
        $this->training_id = $value;
    }

    public function get_training_id() {
        return $this->training_id;
    }

    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }

    public function get_user_id() {
        return $this->user_id;
    } 
    
    public function set_status($value) {
        $this->add_object_field('status', $value);
        $this->status = $value;
    }

    public function get_status() {
        return $this->status;
    }

    /**
     * get user full information
     * @return Orm_User =>user object that has all information that needed
     */
    public function get_user_obj()
    {
        return Orm_User::get_instance($this->get_user_id());
    }

    /**
     * get training information depends on trainig id
     * @return Orm_Tm_Training => training object that has all information that needed
     */
    public function get_training_obj()
    {
        return Orm_Tm_Training::get_instance($this->get_training_id());
    }

    /**
     * check if user can manage training or not
     * @return bool
     */
    public static function check_if_can_add() {
        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class],false,'training_management-manage');
    }

    /**
     *check the user can show the training and make a process on or not
     * @return bool
     */
    public static function check_if_can_view() {

        return  Orm_User::check_permission(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'training_management-list');

    }

    private $can_edit = null;

    /**
     * check if user can manage add/edit , make update or remove records
     * @return bool|null
     */
    public function check_if_can_edit(){

        if(is_null($this->can_edit)) {

            $this->can_edit = false;

            if(self::check_if_can_add()) {
                $this->can_edit = true;
            }
        }

        return $this->can_edit;

    }
    private $can_delete = null;

    /**
     * check if user can manage add/edit , make update or remove records
     * @return bool|null
     */
    public  function check_if_can_delete(){

        if(is_null($this->can_delete)) {

            $this->can_delete = false;

            if($this->check_if_can_edit()) {
                $this->can_delete = true;
            }
        }

        return $this->can_delete;
    }

}
