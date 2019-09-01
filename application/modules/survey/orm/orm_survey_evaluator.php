<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Survey_Evaluator extends Orm
{

    /**
     * @var $instances Orm_Survey_Evaluator[]
     */
    protected static $instances = array();
    protected static $table_name = 'survey_evaluator';


    /**
     * class attributes
     */
    protected $id = 0;
    protected $survey_evaluation_id = 0;
    protected $user_id = 0;
    protected $hash_code = '';
    protected $response_status = 0;
    protected $response_date = '0000-00-00 00:00:00';

    /**
     * @return Survey_Evaluator_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Survey_Evaluator_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Survey_Evaluator
     */
    public static function get_instance($id)
    {
        $id = intval($id);
        if (isset(self::$instances[$id])) {
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
     * @return Orm_Survey_Evaluator[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array())
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Survey_Evaluator
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Survey_Evaluator();
    }

    /**
     * get count
     *
     * @param array $filters
     * @return int
     */
    public static function get_count($filters = array())
    {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }

    public function to_array()
    {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['survey_evaluation_id'] = $this->get_survey_evaluation_id();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['hash_code'] = $this->get_hash_code();
        $db_params['response_status'] = $this->get_response_status();
        $db_params['response_date'] = $this->get_response_date();

        return $db_params;
    }

    public static function invite_bulk(Orm_Survey_Evaluation $evaluation, $users, $enabled_notification = true) {

        set_time_limit(0);
        ini_set('memory_limit', -1);

        $bulk = array();
        $bulk_notification = array();

        foreach ($users as $user) { /** @var Orm_User $user */
            $evaluator = new self();
            $evaluator->set_survey_evaluation_id($evaluation->get_id());
            $evaluator->set_user_id($user->get_id());
            $evaluator->save(true, true, $bulk, $bulk_notification);
        }

        if($bulk) {
            Orm::get_ci()->db->insert_batch(self::get_table_name(), $bulk);
        }

        if($enabled_notification) {
            // TODO: make notification cron job
            Orm_Notification::send_bulk($bulk_notification);
        }
    }

    public function save($send_notification = true, $is_bulk = false, &$bulk = array(), &$bulk_notification = array()) {
        if ($this->get_object_status() == 'new') {

            $this->set_hash_code(md5(uniqid($this->get_survey_evaluation_obj()->get_survey_id() . $this->get_survey_evaluation_id() . $this->get_user_id())));

            if($is_bulk) {
                $bulk[] = $this->to_array();
            } else {
                $insert_id = self::get_model()->insert($this->to_array());
                $this->set_id($insert_id);
            }

        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        switch ($this->get_survey_evaluation_obj()->get_survey_obj()->get_type()) {

            case Orm_Survey::TYPE_ALUMNI:
                $template = Orm_Notification_Template::SURVEY_ALUMNI_INVITATION;
                break;

            case Orm_Survey::TYPE_EMPLOYER:
                $template = Orm_Notification_Template::SURVEY_EMPLOYER_INVITATION;
                break;

            default:
                $template = Orm_Notification_Template::SURVEY_INVITATION;
                break;

        }

        if ($send_notification) {
            $this->notify($template, $is_bulk, $bulk_notification);
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    public function delete_response() {
        return self::get_model()->delete_response($this->get_id());
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

    public function set_survey_evaluation_id($value)
    {
        $this->add_object_field('survey_evaluation_id',$value);
        $this->survey_evaluation_id = $value;
    }

    public function get_survey_evaluation_id()
    {
        return $this->survey_evaluation_id;
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

    public function set_hash_code($value)
    {
        $this->add_object_field('hash_code',$value);
        $this->hash_code = $value;
    }

    public function get_hash_code()
    {
        return $this->hash_code;
    }

    public function set_response_status($value)
    {
        $this->add_object_field('response_status',$value);
        $this->response_status = $value;
    }

    public function get_response_status()
    {
        return $this->response_status;
    }

    public function set_response_date($value) {
        $this->add_object_field('response_date',$value);
        $this->response_date = $value;
    }

    public function get_response_date()
    {
        return $this->response_date;
    }
    /**
     * this function get user ids by its evaluation id and as query
     * @param int $evaluation_id the evaluation id of the get user ids to be call function
     * @param bool $as_query the as query of the get user ids to be call function
     * @return array|string the call function
     */
    public static function get_user_ids($evaluation_id, $as_query = false) {
        return self::get_model()->get_user_ids($evaluation_id, $as_query);
    }
    /**
     *this function get user obj
     * @return Orm_User | Orm_User_Faculty | Orm_User_Staff object the call function
     */
    public function get_user_obj() {
        return Orm_User::get_instance($this->get_user_id());
    }
    /**
     *this function  get survey evaluation obj
     * @return Orm_Survey_Evaluation object the call function
     */
    public function get_survey_evaluation_obj() {
        return Orm_Survey_Evaluation::get_instance($this->get_survey_evaluation_id());
    }

    /**
     *this function get response link
     * @return string the call function
     */
    public function get_response_link(){
        return "/survey/respond?token={$this->get_hash_code()}";
    }

    /**
     *
     */
    public function remind(){
        $this->notify(Orm_Notification_Template::SURVEY_REMINDER);
    }

    /**
     * @param $template
     * @param bool $is_bulk
     * @param array $bulk
     */
    public function notify($template, $is_bulk = false, &$bulk = array()) {
        Orm_Notification::send_notification(
            Orm_User::get_logged_user_id(),
            $this->get_user_id(),
            $template,
            Orm_Notification::TYPE_SURVEY,
            array(
                '%link%',
                '%survey_title_english%',
                '%survey_title_arabic%',
                '%sender_email%',
            ),
            array(
                '<a href="' . base_url($this->get_response_link()) . '">' . base_url($this->get_response_link()) . '</a>',
                $this->get_survey_evaluation_obj()->get_survey_obj()->get_title_english(),
                $this->get_survey_evaluation_obj()->get_survey_obj()->get_title_arabic(),
                Orm_User::get_logged_user()->get_email() ? Orm_User::get_logged_user()->get_email() : Orm::get_ci()->config->item('smtp_username')
            ),
            $is_bulk,
            $bulk
        );
    }
}

