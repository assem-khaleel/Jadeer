<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Thread extends Orm {

    /**
     * @var $instances Orm_Thread[]
     */
    protected static $instances = array();
    protected static $table_name = 'thread';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $last_message_id = 0;

    const LIST_TYPE_INBOX = 'inbox';
    const LIST_TYPE_SENT = 'sent';
    const LIST_TYPE_TRASH = 'trash';
    const LIST_TYPE_IMPORTANT = 'important';
    const LIST_TYPE_GROUPS = 'groups';

    /**
     * @return Thread_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Thread_Model', 'thread');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Thread
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
     * @return Orm_Thread[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Thread
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Thread();
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
        $db_params['last_message_id'] = $this->get_last_message_id();

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

    public function set_last_message_id($value) {
        $this->add_object_field('last_message_id',$value);
        $this->last_message_id = $value;
    }

    public function get_last_message_id() {
        return $this->last_message_id;
    }

    /**
     * @return Orm_Thread_Message
     */
    public function get_last_message_obj() {
        return Orm_Thread_Message::get_instance($this->get_last_message_id());
    }

    public function save_process($to, $subject, $body = '') {

        $this->save();

        $to = Orm_Thread_Participant_Group::prepare_participan($this->get_id(), $to);

        $sender_id = Orm_User::get_logged_user()->get_id();

        //get instances object
        $thread_message_obj = new Orm_Thread_Message();
        $thread_message_obj->set_subject($subject);
        $thread_message_obj->set_body($body);
        $thread_message_obj->set_sender_id($sender_id);
        $thread_message_obj->set_sent_date(date('Y-m-d H:i:s'));
        $thread_message_obj->set_thread_id($this->get_id());
        $thread_message_id = $thread_message_obj->save();

        $to[] = $sender_id;
        foreach ($to as $user_id) {
            $thread_participant_obj = Orm_Thread_Participant::get_one(array('thread_id' => $this->get_id(), 'user_id' => $user_id));
            $thread_participant_obj->set_thread_id($this->get_id());
            $thread_participant_obj->set_user_id($user_id);
            $thread_participant_obj->save();

            if($user_id != $sender_id) {
                Orm_Notification::send_notification($sender_id,$user_id,Orm_Notification_Template::MAIL_RECEIVED,Orm_Notification::TYPE_MAIL);
            }

        }

        $thread_message_read_state_obj = new Orm_Thread_Message_Read_State();
        $thread_message_read_state_obj->set_thread_message_id($thread_message_id);
        $thread_message_read_state_obj->set_user_id($sender_id);
        $thread_message_read_state_obj->save();

        $this->set_last_message_id($thread_message_id);
        $this->save();
    }

    /**
     * @return mixed|Orm_Thread_Participant
     */
    public function get_logged_participant(){
        $user_id = Orm_User::get_logged_user()->get_id();
        return Orm_Thread_Participant::get_one(array('thread_id' => $this->get_id(), 'user_id' => $user_id));
    }

}
