<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Thread_Participant extends Orm {

    /**
     * @var $instances Orm_Thread_Participant[]
     */
    protected static $instances = array();
    protected static $table_name = 'thread_participant';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $thread_id = '';
    protected $user_id = '';
    protected $is_deleted = 0;
    protected $is_important = 0;

    /**
     * @return Thread_Participant_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Thread_Participant_Model', 'thread');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Thread_Participant
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
     * @return Orm_Thread_Participant[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Thread_Participant
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Thread_Participant();
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
        $db_params['thread_id'] = $this->get_thread_id();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['is_deleted'] = $this->get_is_deleted();
        $db_params['is_important'] = $this->get_is_important();

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
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }

    public function get_id() {
        return $this->id;
    }

    public function set_thread_id($value) {
        $this->add_object_field('thread_id',$value);
        $this->thread_id = $value;
    }

    public function get_thread_id() {
        return $this->thread_id;
    }

    /**
     * @return Orm_Thread
     */
    public function get_thread_obj() {
        return Orm_Thread::get_instance($this->get_thread_id());
    }

    public function set_user_id($value) {
        $this->add_object_field('user_id',$value);
        $this->user_id = $value;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    /**
     * @return Orm_User
     */
    public function get_user_obj() {
        return Orm_User::get_instance($this->get_user_id());
    }

    public function set_is_deleted($value) {
        $this->add_object_field('is_deleted',$value);
        $this->is_deleted = $value;
    }

    public function get_is_deleted() {
        return $this->is_deleted;
    }

    public function set_is_important($value) {
        $this->add_object_field('is_important',$value);
        $this->is_important = $value;
    }

    public function get_is_important() {
        return $this->is_important;
    }

}
