<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Notification_Template extends Orm
{

    /**
     * @var $instances Orm_Notification_Template[]
     */
    protected static $instances = array();
    protected static $table_name = 'notification_template';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $name = '';
    protected $subject = '';
    protected $body = '';

    const ADMIN_ADD_USER_ON_NODE = 'admin_add_user_on_node';
    const ADMIN_ENTERD_DUE_DATE_TO_NODE = 'admin_entered_due_date_to_node';
    const ASSESSOR_FINISHED_ENTERING_FORMS_DATA = 'assessor_finished_entering_forms_data';
    const ALL_FORM_ENTERD_AND_CHECKED_COREECTLY = 'all_form_data_enterd_and_checked_correctly';
    const FORM_DATA_INCORRECT_OR_NOT_ENTERD = 'form_data_incorrect_or_not_enterd';
    const SURVEY_INVITATION = 'survey_invitation';
    const RUBRIC_INVITATION = 'rubric_invitation';
    const SURVEY_ALUMNI_INVITATION = 'survey_alumni_invitation';
    const RUBRIC_ALUMNI_INVITATION = 'rubric_alumni_invitation';
    const RUBRIC_EMPLOYER_INVITATION = 'rubric_employer_invitation';
    const SURVEY_EMPLOYER_INVITATION = 'survey_employer_invitation';
    const SURVEY_REMINDER = 'survey_reminder';
    const RUBRIC_REMINDER = 'rubric_reminder';
    const FORGET_PASSWORD = 'forgot_password';
	const ALUMNI_EMPLOYER_CREATED = 'alumni_employer_created';
    const MAIL_RECEIVED = 'email_received';
    const REMIND_USER_TO_FILL = 'remind_user_to_fill';
    const AWARD_CANDIDATE = 'award_candidate';
    const AWARD_WINNER = 'award_winner';
    const RUBRICS = 'rubrics';
    const CLUBS = 'clubs';


    const JOIN_TRAINING = 'join_training';
    const IGNORE_TRAINING = 'ignore_training';
    const APPROVE_TRAINING = 'approve_training';

    private static $template_names = array(
        self::AWARD_CANDIDATE => array(
            '%link%',
            '%award_candidate_name_english%',
            '%award_candidate_name_arabic%',
            '%sender_name%',
            '%sender_email%',
            '%receiver_name%',
            '%receiver_email%'
        ),
        self::AWARD_WINNER => array(
            '%link%',
            '%award_winner_name_english%',
            '%award_winner_name_arabic%',
            '%sender_name%',
            '%sender_email%',
            '%receiver_name%',
            '%receiver_email%'
        ),
        self::RUBRICS => array(
            '%link%',
            '%rubrics_name_english%',
            '%rubrics_name_arabic%',
            '%sender_name%',
            '%sender_email%',
            '%receiver_name%',
            '%receiver_email%'
        ),
        self::ADMIN_ADD_USER_ON_NODE => array(
            '%node_name%',
            '%due_date%',
            '%process_status%',
            '%review_status%',
            '%review_comment%',
            '%link%',
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::ADMIN_ENTERD_DUE_DATE_TO_NODE => array(
            '%node_name%',
            '%due_date%',
            '%process_status%',
            '%review_status%',
            '%review_comment%',
            '%link%',
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::ASSESSOR_FINISHED_ENTERING_FORMS_DATA => array(
            '%node_name%',
            '%due_date%',
            '%process_status%',
            '%review_status%',
            '%review_comment%',
            '%link%',
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::ALL_FORM_ENTERD_AND_CHECKED_COREECTLY => array(
            '%node_name%',
            '%due_date%',
            '%process_status%',
            '%review_status%',
            '%review_comment%',
            '%link%',
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::FORM_DATA_INCORRECT_OR_NOT_ENTERD => array(
            '%node_name%',
            '%due_date%',
            '%process_status%',
            '%review_status%',
            '%review_comment%',
            '%link%',
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::SURVEY_INVITATION => array(
            '%link%',
            '%survey_title_english%',
            '%survey_title_arabic%',
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::SURVEY_ALUMNI_INVITATION => array(
            '%link%',
            '%survey_title_english%',
            '%survey_title_arabic%',
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::SURVEY_EMPLOYER_INVITATION => array(
            '%link%',
            '%survey_title_english%',
            '%survey_title_arabic%',
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::SURVEY_REMINDER => array(
            '%link%',
            '%survey_title_english%',
            '%survey_title_arabic%',
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::FORGET_PASSWORD => array(
            '%link%',
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
	    self::ALUMNI_EMPLOYER_CREATED => array(
            '%link%',
            '%password%',
            '%email%',
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::MAIL_RECEIVED => array(
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::REMIND_USER_TO_FILL => array(
            '%sender_name%',
            '%sender_email%',
            '%sender_role%',
            '%receiver_name%',
            '%receiver_email%',
            '%receiver_role%'
        ),
        self::JOIN_TRAINING=>array(
            '%link%',
            '%training_name_english%',
            '%training_name_arabic%',
            '%sender_name%',
            '%sender_email%',
            '%receiver_name%',
            '%receiver_email%'
        ),
        self::IGNORE_TRAINING=>array(
            '%link%',
            '%training_name_english%',
            '%training_name_arabic%',
            '%sender_name%',
            '%sender_email%',
            '%receiver_name%',
            '%receiver_email%'
        ),
        self::APPROVE_TRAINING=>array(
            '%link%',
            '%training_name_english%',
            '%training_name_arabic%',
            '%sender_name%',
            '%sender_email%',
            '%receiver_name%',
            '%receiver_email%'
        ),
        self::CLUBS=>array(
            '%link%',
            '%club_name_english%',
            '%club_name_arabic%',
            '%sender_name%',
            '%sender_email%',
            '%receiver_name%',
            '%receiver_email%'
        )
    );

    /**
     * @return Notification_Template_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Notification_Template_Model', 'notification');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Notification_Template
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
     * @return Orm_Notification_Template[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Notification_Template
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Notification_Template();
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
        $db_params['name'] = $this->get_name();
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

    public function set_name($value)
    {
        $this->add_object_field('name',$value);
        $this->name = $value;
    }

    public function get_name()
    {
        return $this->name;
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

    public static function get_template_names($template_name = null)
    {
        if(is_null($template_name)) {
            return array_keys(self::$template_names);
        }

        return isset(self::$template_names[$template_name]) ? self::$template_names[$template_name] : array();
    }

    public static function generate()
    {
        foreach(self::get_template_names() as $template_name) {
            $template = self::get_one(array('name' => $template_name));
            $template->set_name($template_name);
            $template->save();
        }
    }

    /**
     * @return Orm_Notification_Settings
     */
    public function get_user_notification_settings() {
        return Orm_Notification_Settings::get_one(array(
            'user_id' => Orm_User::get_logged_user()->get_id(),
            'notification_name' => $this->get_name(),
        ));
    }
}
