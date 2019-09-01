<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Notification_Settings extends Orm
{

    /**
     * @var $instances Orm_Notification_Settings[]
     */
    protected static $instances = array();
    protected static $table_name = 'notification_settings';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $user_id = 0;
    protected $notification_name = '';
    protected $allow_email = 1;
    protected $allow_sms = 1;

    /**
     * @return Notification_Settings_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Notification_Settings_Model', 'notification');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Notification_Settings
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
     * @return Orm_Notification_Settings[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Notification_Settings
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Notification_Settings();
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

    public function to_array()
    {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['user_id'] = $this->get_user_id();
        $db_params['notification_name'] = $this->get_notification_name();
        $db_params['allow_email'] = $this->get_allow_email();
        $db_params['allow_sms'] = $this->get_allow_sms();

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

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    public function set_id($value)
    {
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_user_id($value)
    {
        $this->add_object_field('user_id',$value);
        $this->user_id = $value;
    }

    public function get_user_id()
    {
        return $this->user_id;
    }

    public function set_notification_name($value)
    {
        $this->add_object_field('notification_name',$value);
        $this->notification_name = $value;
    }

    public function get_notification_name()
    {
        return $this->notification_name;
    }

    public function set_allow_email($value)
    {
        $this->add_object_field('allow_email',$value);
        $this->allow_email = $value;
    }

    public function get_allow_email()
    {
        return $this->allow_email;
    }

    public function set_allow_sms($value)
    {
        $this->add_object_field('allow_sms',$value);
        $this->allow_sms = $value;
    }

    public function get_allow_sms()
    {
        return $this->allow_sms;
    }

    public static function save_user_notification_settings($user_id)
    {

        foreach (Orm_Notification_Template::get_template_names() as $notification_name) {
            $user_notification = Orm_Notification_Settings::get_one(array('user_id' => $user_id, 'notification_name' => $notification_name));
            $user_notification->set_user_id($user_id);
            $user_notification->set_notification_name($notification_name);
            $user_notification->save();
        }
    }

    public static function get_by_notification_name($notification_name) {
        return self::get_model()->get_by_notification_name($notification_name);
    }

}
