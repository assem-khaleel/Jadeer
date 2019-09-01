<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Thread_Message extends Orm {

    /**
     * @var $instances Orm_Thread_Message[]
     */
    protected static $instances = array();
    protected static $table_name = 'thread_message';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $thread_id = '';
    protected $sender_id = '';
    protected $sent_date = '';
    protected $subject = '';
    protected $body = '';

    /**
     * @return Thread_Message_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Thread_Message_Model', 'thread');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Thread_Message
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
     * @return Orm_Thread_Message[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Thread_Message
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Thread_Message();
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
        $db_params['sender_id'] = $this->get_sender_id();
        $db_params['sent_date'] = $this->get_sent_date();
        $db_params['subject'] = $this->get_subject();
        $db_params['body'] = $this->get_body();

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

    public function set_sender_id($value) {
        $this->add_object_field('sender_id',$value);
        $this->sender_id = $value;
    }

    public function get_sender_id() {
        return $this->sender_id;
    }

    /**
     * @return Orm_User
     */
    public function get_sender_obj() {
        return Orm_User::get_instance($this->get_sender_id());
    }

    public function set_sent_date($value) {
        $this->add_object_field('sent_date',$value);
        $this->sent_date = $value;
    }

    public function get_sent_date() {
        return $this->sent_date;
    }

    public function set_subject($value) {
        $this->add_object_field('subject',$value);
        $this->subject = $value;
    }

    public function get_subject() {
        return $this->subject;
    }

    public function set_body($value) {
        $this->add_object_field('body',$value);
        $this->body = $value;
    }

    public function get_body() {
        return $this->body;
    }

    public function show_process(){
        $thread_message_read_state_obj = $this->get_logged_read_state();
        $thread_message_read_state_obj->set_thread_message_id($this->get_id());
        $thread_message_read_state_obj->set_user_id(Orm_User::get_logged_user()->get_id());
        $thread_message_read_state_obj->save();
    }

    /**
     * @return mixed|Orm_Thread_Message_Read_State
     */
    public function get_logged_read_state(){
        $user_id = Orm_User::get_logged_user()->get_id();
        return Orm_Thread_Message_Read_State::get_one(array('thread_message_id' => $this->get_id(), 'user_id' => $user_id));
    }

    public function get_is_important() {
        return $this->get_thread_obj()->get_logged_participant()->get_is_important();
    }

    /**
     * @return int|Orm_Thread_Participant[]
     */
    public function get_participants(){
        return Orm_Thread_Participant::get_all(array('thread_id' => $this->get_thread_id()));
    }

    public function get_participant_ids(){
        return array_column(Orm_Thread_Participant::get_model()->get_all(array('thread_id' => $this->get_thread_id()), 0, 0, array(), Orm::FETCH_ARRAY), 'user_id');
    }
}

