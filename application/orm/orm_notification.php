<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Notification extends Orm
{

    /**
     * @var $instances Orm_Notification[]
     */
    protected static $instances = array();
    protected static $table_name = 'notification';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $sender_id = 0;
    protected $receiver_id = 0;
    protected $body = '';
    protected $subject = '';
    protected $is_read = 0;
    protected $type = 0;
    protected $date_added = '0000-00-00 00:00:00';

    const TYPE_COMMON = 0;
    const TYPE_ACCREDITATION = 1;
    const TYPE_SURVEY = 2;
    const TYPE_RUBRIC = 2;
    const TYPE_MAIL = 3;
    const TYPE_TRAINING = 4;
    const TYPE_AWARD_CANDIDATE = 5;
    const TYPE_AWARD_WINNER = 6;
    const TYPE_RUBRICS =7;
    const TYPE_CLUBS = 8;


    public static $types = array(
        self::TYPE_COMMON => 'Common',
        self::TYPE_ACCREDITATION => 'Accreditation',
        self::TYPE_SURVEY => 'Survey',
        self::TYPE_MAIL=>'Mail',
        self::TYPE_TRAINING=>'Training',
        self::TYPE_AWARD_CANDIDATE =>'Award Candidate',
        self::TYPE_AWARD_WINNER =>'Award Winner',
        self::TYPE_RUBRICS =>'rubrics',
        self::TYPE_CLUBS =>'clubs'
    );

    public static $type_icons = array(
        self::TYPE_COMMON => 'fa-hdd-o',
        self::TYPE_ACCREDITATION => 'fa-sitemap',
        self::TYPE_SURVEY => 'fa-check-square',
        self::TYPE_MAIL => 'fa-envelope',
        self::TYPE_TRAINING => 'fa-briefcase',
        self::TYPE_AWARD_CANDIDATE => 'fa-check-square',
        self::TYPE_AWARD_WINNER => 'fa-check-square',
        self::TYPE_RUBRICS => 'fa-check-square',
        self::TYPE_CLUBS => 'fa-check-square',

    );

    public static $type_colors = array(
        self::TYPE_COMMON => 'danger',
        self::TYPE_ACCREDITATION => 'warning',
        self::TYPE_SURVEY => 'info',
        self::TYPE_MAIL=> 'success',
        self::TYPE_TRAINING=>'primary',
        self::TYPE_AWARD_CANDIDATE => 'info',
        self::TYPE_AWARD_WINNER => 'info',
        self::TYPE_RUBRICS => 'info',
        self::TYPE_CLUBS => 'info'

    );

    /**
     * @return Notification_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Notification_Model', 'notification');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Notification
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
     * @return Orm_Notification[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Notification
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Notification();
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
        $db_params['sender_id'] = $this->get_sender_id();
        $db_params['receiver_id'] = $this->get_receiver_id();
        $db_params['subject'] = $this->get_subject();
        $db_params['body'] = $this->get_body();
        $db_params['is_read'] = $this->get_is_read();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['type'] = $this->get_type();

        return $db_params;
    }

    public static function send_bulk($bulk = array()) {
        if($bulk) {
            Orm::get_ci()->db->insert_batch(self::get_table_name(), $bulk);

            if(self::$bulk_email) {

                $file = FCPATH . 'files/jobs/email/';

                if(!is_dir($file)) {
                    mkdir($file, 0755, true);
                }

                file_put_contents($file . time() . '.json', json_encode(self::$bulk_email));
            }

            if(self::$bulk_sms) {

                $file = FCPATH . 'files/jobs/sms/';

                if(!is_dir($file)) {
                    mkdir($file, 0755, true);
                }

                file_put_contents($file . time() . '.json', json_encode(self::$bulk_sms));
            }
        }
    }

    public function save($is_bulk = false, &$bulk = array()) {
        if ($this->get_object_status() == 'new') {
            $this->set_date_added(date('Y-m-d H:i:s'));

            if($is_bulk) {
                $bulk[] = $this->to_array();
            } else {
                $insert_id = self::get_model()->insert($this->to_array());
                $this->set_id($insert_id);
            }
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

    public function set_sender_id($value)
    {
        $this->add_object_field('sender_id',$value);
        $this->sender_id = $value;
    }

    public function get_sender_id()
    {
        return $this->sender_id;
    }

    public function set_receiver_id($value)
    {
        $this->add_object_field('receiver_id',$value);
        $this->receiver_id = $value;
    }

    public function get_receiver_id()
    {
        return $this->receiver_id;
    }

    public function set_subject($value)
    {
        $this->add_object_field('subject',$value);
        $this->subject = $value;
    }

    public function get_subject()
    {
        return $this->subject;
    }

    public function set_body($value)
    {
        $this->add_object_field('body',$value);
        $this->body = $value;
    }

    public function get_body()
    {
        return $this->body;
    }

    public function set_is_read($value)
    {
        $this->add_object_field('is_read',$value);
        $this->is_read = $value;
    }

    public function get_is_read()
    {
        return $this->is_read;
    }

    public function set_date_added($value)
    {
        $this->add_object_field('date_added',$value);
        $this->date_added = $value;
    }

    public function get_date_added()
    {
        return $this->date_added;
    }

    public function set_type($value) {
        $this->add_object_field('type',$value);
        $this->type = (int) $value;
    }

    public function get_type($to_string = false) {
        if ($to_string) {
            return (isset(self::$types[$this->type]) ? self::$types[$this->type] : '');
        }
        return $this->type;
    }

    public function get_type_icon() {
        return (isset(self::$type_icons[$this->type]) ? self::$type_icons[$this->type] : '');
    }

    public function get_type_color() {
        return (isset(self::$type_colors[$this->type]) ? self::$type_colors[$this->type] : '');
    }

    /**
     * @return Orm_User
     */
    public function get_sender_obj()
    {
        return Orm_User::get_instance($this->get_sender_id());
    }

    /**
     * @return Orm_User
     */
    public function get_receiver_obj()
    {
        return Orm_User::get_instance($this->get_receiver_id());
    }

    public static function send_node_notification($sender_id, $receiver_id, $node_id, $template_name)
    {

        $node = Orm_Node::get_instance($node_id);

        $placeholders = array(
            '%node_name%',
            '%due_date%',
            '%process_status%',
            '%review_status%',
            '%review_comment%',
            '%link%',
        );

        $placeholders_replacement = array(
            htmlfilter($node->get_name()),
            date('Y-m-d', strtotime($node->get_less_due_date())),
            $node->get_is_finished() ? 'Finished' : 'In Process',
            $node->get_review_status(),
            xssfilter($node->get_review_comment()),
            '<a href="' . base_url('accreditation/item/' . $node_id) . '">Click Here</a>',
        );

        self::send_notification($sender_id, $receiver_id, $template_name, self::TYPE_ACCREDITATION, $placeholders, $placeholders_replacement);
    }

    private static $templates = [];

    public static function send_notification($sender_id, $receiver_id, $template_name, $type = self::TYPE_COMMON, $placeholders = array(), $placeholders_replacement = array(), $is_bulk = false, &$bulk = array())
    {

        if (!$sender_id) {
            $sender_id = Orm::get_ci()->config->item('cli_user_id');
        }

        $sender = Orm_User::get_instance($sender_id);
        $receiver = Orm_User::get_instance($receiver_id);

        $template_key = md5($template_name);

        if(!isset(self::$templates[$template_key])) {
            self::$templates[$template_key] = Orm_Notification_Template::get_one(array('name' => $template_name));
        }

        $template = self::$templates[$template_key];

        if (!$template->get_id() || is_null($receiver)) {
            return false;
        }

        $all_placeholders = array_merge($placeholders, array(
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ));

        $all_placeholders_replacement = array_merge($placeholders_replacement, array(
            $sender->get_full_name(),
            $sender->get_email(),
            $sender->get_type_name(),
            $receiver->get_full_name(),
            $receiver->get_email(),
            $receiver->get_type_name()
        ));

        $subject = str_replace($all_placeholders, $all_placeholders_replacement, $template->get_subject());
        $body = str_replace($all_placeholders, $all_placeholders_replacement, $template->get_body());

        $notification = new Orm_Notification();
        $notification->set_sender_id($sender_id);
        $notification->set_receiver_id($receiver_id);
        $notification->set_subject($subject);
        $notification->set_body($body);
        $notification->set_type($type);
        $notification->save($is_bulk, $bulk);

        if (Orm::get_ci()->config->item('send_emails')) {

            $user_settings = self::get_receiver_settings($receiver_id, $template_name);

            if ($user_settings->get_allow_email()) {
                if($is_bulk) {
                    self::send_bulk_email($sender, $receiver, $subject, $body);
                } else {
                    self::send_email($sender, $receiver, $subject, $body);
                }
            }

            if ($user_settings->get_allow_sms()) {
                if($is_bulk) {
                    self::send_bulk_sms($sender, $receiver, $subject, $body);
                } else {
                    self::send_sms($sender, $receiver, $subject, $body);
                }
            }
        }
    }

    private static $notification_settings = [];
    private static $notification_setting_obj = null;

    /**
     * @param $receiver_id
     * @param $template_name
     * @return Orm_Notification_Settings
     */
    public static function get_receiver_settings($receiver_id, $template_name) {

        $template_key = md5($template_name);

        if(!isset(self::$notification_settings[$template_key])) {
            self::$notification_settings[$template_key] = Orm_Notification_Settings::get_by_notification_name($template_name);
        }

        if(isset(self::$notification_settings[$template_key][$receiver_id]) && self::$notification_settings[$template_key][$receiver_id] instanceof Orm_Notification_Settings) {
            return self::$notification_settings[$template_key][$receiver_id];
        }

        if(is_null(self::$notification_setting_obj)) {
            self::$notification_setting_obj = new Orm_Notification_Settings();
        }

        return self::$notification_setting_obj;

    }

    public static function send_email(Orm_User $sender, Orm_User $receiver, $subject, $body) {

        $ci = Orm::get_ci();
        $ci->load->library('email');
        $ci->email->clear(TRUE);

        $config = array();
        $config['mailtype'] = 'html';

        if($ci->config->item('smtp_enabled')) {
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = $ci->config->item('smtp_host');            // Specify main and backup SMTP servers
            $config['smtp_user'] = $ci->config->item('smtp_username');    // SMTP username
            $config['smtp_pass'] = $ci->config->item('smtp_password');    // SMTP password
            $config['smtp_port'] = $ci->config->item('smtp_port');            // TCP port to connect to
        }

        $ci->email->initialize($config);
        $ci->email->set_newline("\r\n");
        $ci->email->set_crlf( "\r\n" );
        $ci->email->to($receiver->get_email());

        if($ci->config->item('smtp_enabled')) {
            $ci->email->from($config['smtp_user'], $sender->get_full_name());
        } else {
            $ci->email->from($sender->get_email(), $sender->get_full_name());
        }

        $ci->email->subject($subject);
        $ci->email->message($body);
        $ci->email->send();
    }

    public static function send_sms(Orm_User $sender, Orm_User $receiver, $subject, $body) {

        $gateway = Orm::get_ci()->config->item('sms_gateway');
        $number = trim($receiver->get_phone());
        $message = trim($subject);

        if (($gateway != '') && ($number != '') && ($message != '')) {
            //IMPORTANT
            $number = htmlentities(urlencode($number));
            $message = htmlentities(urlencode($message));
            //IMPORTANT

            $gateway_placeholders = array(
                '%NUMBER%',
                '%MESSAGE%'
            );

            $gateway_placeholders_replacement = array(
                $number,
                $message
            );

            $url = str_replace($gateway_placeholders, $gateway_placeholders_replacement, $gateway);

            //echo $url;
            @file_get_contents($url);
        }
    }

    private static $bulk_email = [];

    public static function send_bulk_email(Orm_User $sender, Orm_User $receiver, $subject, $body) {

        array_push(self::$bulk_email, [
            'sender_name' => $sender->get_full_name(),
            'sender_email' => $sender->get_email(),
            'receiver_name' => $receiver->get_full_name(),
            'receiver_email' => $receiver->get_email(),
            'subject' => $subject,
            'body' => $body
        ]);

    }

    private static $bulk_sms = [];

    public static function send_bulk_sms(Orm_User $sender, Orm_User $receiver, $subject, $body) {

        $gateway = Orm::get_ci()->config->item('sms_gateway');

        if ($gateway) {
            array_push(self::$bulk_sms, [
                'receiver_name' => $receiver->get_full_name(),
                'receiver_phone' => $receiver->get_phone(),
                'message' => $subject,
            ]);
        }

    }
}
