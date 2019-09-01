<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Thread_Message_Read_State extends Orm {

    /**
     * @var $instances Orm_Thread_Message_Read_State[]
     */
    protected static $instances = array();
    protected static $table_name = 'thread_message_read_state';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $thread_message_id = '';
    protected $user_id = '';
    protected $read_date = 0;

    /**
     * @return Thread_Message_Read_State_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Thread_Message_Read_State_Model', 'thread');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Thread_Message_Read_State
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
     * @return Orm_Thread_Message_Read_State[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Thread_Message_Read_State
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Thread_Message_Read_State();
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
        $db_params['thread_message_id'] = $this->get_thread_message_id();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['read_date'] = $this->get_read_date();

        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $this->set_read_date(date('Y-m-d H:i:s'));

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

    public function set_thread_message_id($value) {
        $this->add_object_field('thread_message_id',$value);
        $this->thread_message_id = $value;
    }

    public function get_thread_message_id() {
        return $this->thread_message_id;
    }

    /**
     * @return Orm_Thread_Message
     */
    public function get_thread_message_obj() {
        return Orm_Thread_Message::get_instance($this->get_thread_message_id());
    }

    public function set_user_id($value) {
        $this->add_object_field('user_id',$value);
        $this->user_id = $value;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function set_read_date($value) {
        $this->add_object_field('read_date',$value);
        $this->read_date = $value;
    }

    public function get_read_date() {
        return $this->read_date;
    }

    /**
     * @return Orm_User
     */
    public function get_user_obj() {
        return Orm_User::get_instance($this->get_user_id());
    }

}

