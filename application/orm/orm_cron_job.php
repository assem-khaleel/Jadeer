<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cron_Job extends Orm {
    
    /**
    * @var $instances Orm_Cron_Job[]
    */
    protected static $instances = array();
    protected static $table_name = 'cron_job';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $job_key = 0;
    protected $job = '';
    protected $user_added = 0;
    protected $date_added = '0000-00-00 00:00:00';
    protected $is_released = 0;
    protected $date_released = '0000-00-00 00:00:00';
    protected $schedule = 0;

    const SCHEDULE_NONE = 0;
    const SCHEDULE_DAILY = 1;
    const SCHEDULE_WEEKLY = 2;
    const SCHEDULE_MONTHLY = 3;
    const SCHEDULE_SEMESTER = 4;

    public static $SCHEDULE_ARRAY = array(
        self::SCHEDULE_NONE => 'One Time',
        self::SCHEDULE_DAILY => 'Daily',
        self::SCHEDULE_WEEKLY => 'Weekly',
        self::SCHEDULE_MONTHLY => 'Monthly',
        self::SCHEDULE_SEMESTER => 'Semester'
    );

    public static $JOBs = array(
        1 => array(
            'cli' => 'strategic_planning',
            'job' => 'index',
            'params' => null,
            'schedule' => self::SCHEDULE_MONTHLY
        ),
        2 => array(
            'cli' => 'backup',
            'hint' => 'Backup to' . '"backup"' . ' Folder',
            'job' => 'index',
            'params' => null,
            'schedule' => self::SCHEDULE_SEMESTER
        ),
        3 => array(
            'cli' => 'sender',
            'hint' => 'Send email notification when bulk email fired',
            'job' => 'mail',
            'params' => null,
            'schedule' => self::SCHEDULE_DAILY
        ),
        4 => array(
            'cli' => 'sender',
            'hint' => 'Send SMS SMSnotification when bulk SMS fired',
            'job' => 'sms',
            'params' => null,
            'schedule' => self::SCHEDULE_DAILY
        ),
    );

    /**
    * @return Cron_Job_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cron_Job_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cron_Job
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
    * @return Orm_Cron_Job[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cron_Job
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cron_Job();
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
        $db_params['job_key'] = $this->get_job_key();
        $db_params['job'] = $this->get_job();
        $db_params['user_added'] = $this->get_user_added();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['is_released'] = $this->get_is_released();
        $db_params['date_released'] = $this->get_date_released();
        $db_params['schedule'] = $this->get_schedule();

        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $this->set_date_added(date('Y-m-d H:i:s'));
            $this->set_user_added(Orm_User::get_logged_user()->get_id());

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
    
    public function set_job($value) {
        $this->add_object_field('job',$value);
        $this->job = $value;
    }
    
    public function get_job() {
        return $this->job;
    }
    
    public function set_user_added($value) {
        $this->add_object_field('user_added',$value);
        $this->user_added = $value;
    }
    
    public function get_user_added() {
        return $this->user_added;
    }

    public function set_date_added($value) {
        $this->add_object_field('date_added',$value);
        $this->date_added = $value;
    }
    
    public function get_date_added() {
        return $this->date_added;
    }

    public function set_job_key($value) {
        $this->add_object_field('job_key',$value);
        $this->job_key = $value;
    }

    public function get_job_key() {
        return $this->job_key;
    }

    public function set_is_released($value) {
        $this->add_object_field('is_released',$value);
        $this->is_released = $value;
    }

    public function get_is_released() {
        return $this->is_released;
    }

    public function set_schedule($value) {
        $this->add_object_field('schedule',$value);
        $this->schedule = $value;
    }

    public function get_schedule() {
        return $this->schedule;
    }
    
    public function set_date_released($value) {
        $this->add_object_field('date_released',$value);
        $this->date_released = $value;
    }
    
    public function get_date_released() {
        return $this->date_released;
    }

    /**
     * @param $job
     * @return string
     */
    public function get_max_released_date($job) {
        return self::get_model()->get_max_released_date($job);

    }

    public static function get_jobs() {
        return self::$JOBs + Orm::get_ci()->config->item('JOBS');
    }

    public static function get_job_by_key($key) {

        $jobs = self::get_jobs();

        return isset($jobs[$key]) ? $jobs[$key] : null;
    }

    public function get_user_added_obj() {
        return Orm_User::get_instance($this->get_user_added());
    }
}

