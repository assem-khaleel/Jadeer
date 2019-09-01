<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Orm_C_Committee_Member
 */
class Orm_C_Committee_Member extends Orm {

    /**
     * @var $instances Orm_C_Committee_Member[]
     */
    protected static $instances = array();
    protected static $table_name = 'c_committee_member';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $user_id = 0;
    protected $committee_id = 0;
    protected $is_leader = 0;

    /**
     * @return C_Committee_Member_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('C_Committee_Member_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_C_Committee_Member
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
     * @return Orm_C_Committee_Member[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array(),$order_direction ='desc') {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS,$order_direction);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_C_Committee_Member
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_C_Committee_Member();
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
     * @return array
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['user_id'] = $this->get_user_id();
        $db_params['committee_id'] = $this->get_committee_id();
        $db_params['is_leader'] = $this->get_is_leader();

        return $db_params;
    }

    /**
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
     * @return bool
     */
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }

    /**
     * @param $value
     */
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;

        $this->push_instance();
    }

    /**
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * @param $value
     */
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }

    /**
     * @return int
     */
    public function get_user_id() {
        return $this->user_id;
    }

    /**
     * @param $value
     */
    public function set_committee_id($value) {
        $this->add_object_field('committee_id', $value);
        $this->committee_id = $value;
    }

    /**
     * @return int
     */
    public function get_committee_id() {
        return $this->committee_id;
    }

    /**
     * @param $value
     */
    public function set_is_leader($value) {
        $this->add_object_field('is_leader', $value);
        $this->is_leader = $value;
    }

    /**
     * @return int
     */
    public function get_is_leader() {
        return $this->is_leader;
    }

    /**
     * @return Orm_User
     */
    public function get_user_obj()
    {
        return Orm_User::get_instance($this->get_user_id());
    }

    /**
     * @return Orm_C_Committee
     */
    public function get_committee_obj()
    {
        return Orm_C_Committee::get_instance($this->get_committee_id());
    }

    /**
     * @return string
     */
    public function get_user_name() {
        
        $leader = $this->get_is_leader() ? ' <i class="fa fa-gavel text-danger"></i>' : '';
        return  htmlfilter($this->get_user_obj()->get_full_name())  . $leader;
    }

    /**
     * @param null $user_id
     * @return array
     */
    public static function get_committee_ids($user_id = null)
    {
        if (is_null($user_id)) {
            $user_id = Orm_User::get_logged_user_id();
        }

        $committee_ids = array_column(self::get_model()->get_all(array('user_id' => $user_id), 0, 0, array(), Orm::FETCH_ARRAY), 'committee_id');

        return $committee_ids ?: array(0);
    }

    /**
     * get_user_ids
     *
     * @param array $filters
     * @return array
     */
    public static function get_user_ids($filters = array()) {
        return array_column(self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_ARRAY), 'user_id');
    }
}

