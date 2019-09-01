<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Mm_Attendance extends Orm {
    
    /**
    * @var $instances Orm_Mm_Attendance[]
    */
    protected static $instances = array();
    protected static $table_name = 'mm_attendance';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $meeting_id = 0;
    protected $user_id = 0;
    protected $external_user_name = '';
    protected $attended = 0;
    
    /**
    * @return Mm_Attendance_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Mm_Attendance_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Mm_Attendance
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
    * @return Orm_Mm_Attendance[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Mm_Attendance
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Mm_Attendance();
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

    /** get array of object
     * @param array $db_params
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['meeting_id'] = $this->get_meeting_id();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['external_user_name'] = $this->get_external_user_name();
        $db_params['attended'] = $this->get_attended();
        
        return $db_params;
    }

    /** save object
     * @param array $insert_id
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

    /** delete object
     *
     */
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }
    
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_meeting_id($value) {
        $this->add_object_field('meeting_id', $value);
        $this->meeting_id = $value;
    }
    
    public function get_meeting_id($obj = false) {
        if($obj) {
            return Orm_Mm_Meeting::get_instance($this->meeting_id);
        }
        return $this->meeting_id;
    }
    
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }
    
    public function get_user_id($obj = false) {
        if($obj) {
            return Orm_User::get_instance($this->user_id);
        }
        return $this->user_id;
    }
    
    public function set_external_user_name($value) {
        $this->add_object_field('external_user_name', $value);
        $this->external_user_name = $value;
    }

    public function get_external_user_name() {
        return $this->external_user_name;
    }

    public function set_attended($value) {
        $this->add_object_field('attended', $value);
        $this->attended = $value;
    }
    
    public function get_attended($title=false) {
        if($title) {
            if(strtotime($this->get_meeting_id(true)->get_date().' '.$this->get_meeting_id(true)->get_end_time())> time()){
                return lang('N/A');
            }

            return $this->attended ? lang('Attended'): lang('Absent');
        }
        return $this->attended;
    }

    /** delete all attendances
    */

    public function delete_all($meeting_id) {
        return self::get_model()->delete_all($meeting_id);
    }
    
}

