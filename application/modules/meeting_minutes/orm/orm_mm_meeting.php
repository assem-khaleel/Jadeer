<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Mm_Meeting extends Orm
{

    /**
     * @var $instances Orm_Mm_Meeting[]
     */
    protected static $instances = array();
    protected static $table_name = 'mm_meeting';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $level = 0;
    protected $level_id = 0;
    protected $room_id = 0;
    protected $type_class = __CLASS__;
    protected $type_id = 0;
    protected $facilitator_id = 0;
    protected $name = '';
    protected $start_date = '';
    protected $end_date = '';
    protected $objective = '';
    protected $agenda_attachment = '';
    protected $meeting_minutes = '';
    protected $meeting_minutes_attachment = '';
    protected $action_attachment = '';
    protected $meeting_ref_id = 0;


    const INSTITUTION_LEVEL = 0;
    const COLLEGE_LEVEL = 1;
    const PROGRAM_LEVEL = 2;
    const UNIT_LEVEL = 3;

    /**
     * @return Mm_Meeting_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Mm_Meeting_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Mm_Meeting
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
     * Get all rows as Objects
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     *
     * @return Orm_Mm_Meeting[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array())
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Mm_Meeting
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new static();
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

    /** get array of object
     * @param array $db_params
     */
    public function to_array()
    {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['level'] = $this->get_level();
        $db_params['level_id'] = $this->get_level_id();
        $db_params['room_id'] = $this->get_room_id();
        $db_params['type_class'] = $this->get_type_class();
        $db_params['type_id'] = $this->get_type_id();
        $db_params['facilitator_id'] = $this->get_facilitator_id();
        $db_params['name'] = $this->get_name();
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        $db_params['objective'] = $this->get_objective();
        $db_params['agenda_attachment'] = $this->get_agenda_attachment();
        $db_params['meeting_minutes'] = $this->get_meeting_minutes();
        $db_params['meeting_minutes_attachment'] = $this->get_meeting_minutes_attachment();
        $db_params['action_attachment'] = $this->get_action_attachment();
        $db_params['meeting_ref_id'] = $this->get_meeting_ref_id();

        return $db_params;
    }

    /** save object
     * @param array $insert_id
     */
    public function save()
    {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif ($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();

        return $this->get_id();
    }

    /** delete object
     *
     */
    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    public function set_id($value)
    {
        $this->add_object_field('id', $value);
        $this->id = $value;

        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_level($value)
    {
        $this->add_object_field('level', $value);
        $this->level = $value;
    }

    public function get_level($title = false)
    {
        if ($title) {
            return self::get_levels($title)[$this->level];
        }
        return $this->level;
    }

    public function set_level_id($value)
    {
        $this->add_object_field('level_id', $value);
        $this->level_id = $value;
    }

    public function get_level_id($title = false)
    {
        if ($title) {
            return $this->get_level_title();
        }

        return $this->level_id;
    }

    public function set_type_class($value)
    {
        $this->add_object_field('type_class', $value);
        $this->type_class = $value;
    }

    public function get_type_class()
    {
        return $this->type_class;
    }

    public function set_type_id($value)
    {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }

    public function get_type_id()
    {
        return $this->type_id;
    }

    public function set_room_id($value)
    {
        $this->add_object_field('room_id', $value);
        $this->room_id = $value;
    }

    public function get_room_id()
    {
        return $this->room_id;
    }

    public function set_facilitator_id($value)
    {
        $this->add_object_field('facilitator_id', $value);
        $this->facilitator_id = $value;
    }

    /**
     * @param bool $obj
     *
     * @return int|Orm_User
     */

    public function get_facilitator_id($obj = false)
    {
        if ($obj) {
            return Orm_User::get_instance($this->facilitator_id);
        }
        return $this->facilitator_id;
    }

    public function set_name($value)
    {
        $this->add_object_field('name', $value);
        $this->name = $value;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function set_start_date($value)
    {
        $this->add_object_field('start_date', $value);
        $this->start_date = $value;
    }

    public function get_start_date()
    {

        return $this->start_date;
    }

    public function set_end_date($value)
    {
        $this->add_object_field('end_date', $value);
        $this->end_date = $value;
    }

    public function get_end_date()
    {
        return $this->end_date;
    }

    public function set_objective($value)
    {
        $this->add_object_field('objective', $value);
        $this->objective = $value;
    }

    public function get_objective()
    {
        return $this->objective;
    }

    public function set_agenda_attachment($value)
    {
        $this->add_object_field('agenda_attachment', $value);
        $this->agenda_attachment = $value;
    }

    public function get_agenda_attachment()
    {
        return $this->agenda_attachment;
    }

    public function set_meeting_minutes($value)
    {
        $this->add_object_field('meeting_minutes', $value);
        $this->meeting_minutes = $value;
    }

    public function get_meeting_minutes()
    {
        return $this->meeting_minutes;
    }

    public function set_meeting_minutes_attachment($value)
    {
        $this->add_object_field('meeting_minutes_attachment', $value);
        $this->meeting_minutes_attachment = $value;
    }

    public function get_meeting_minutes_attachment()
    {
        return $this->meeting_minutes_attachment;
    }

    public function set_action_attachment($value)
    {
        $this->add_object_field('action_attachment', $value);
        $this->action_attachment = $value;
    }

    public function get_action_attachment()
    {
        return $this->action_attachment;
    }

    public function set_meeting_ref_id($value)
    {
        $this->add_object_field('meeting_ref_id', $value);
        $this->meeting_ref_id = $value;
    }

    public function get_date()
    {

        if (empty($this->get_start_date())) {
            $date = '';
        } else {
            $date = date('Y-m-d', strtotime($this->get_start_date()));
        }

        return $date;
    }

    public function get_start_time()
    {

        if (empty($this->get_start_date())) {
            $start_time = '';
        } else {
            $start_time = date("H:i:s", strtotime($this->get_start_date()));
        }

        return time_12_lang($start_time);
    }

    public function get_end_time()
    {
        if (empty($this->get_end_date())) {
            $end_time = '';
        } else {
            $end_time = date("H:i:s", strtotime($this->get_end_date()));
        }

        return time_12_lang($end_time);
    }

    public function get_meeting_ref_id($obj = false)
    {
        if ($obj) {
            return Orm_Mm_Meeting::get_instance($this->meeting_ref_id);
        }
        return $this->meeting_ref_id;
    }

    public static function get_levels($is_String = false)
    {
        $access = array();
        if (!$is_String) {
            if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                $access[self::INSTITUTION_LEVEL] = lang('Institution');
                $access[self::UNIT_LEVEL] = lang('Unit');
                $access[self::COLLEGE_LEVEL] = lang('College');
            }
            if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                $access[self::COLLEGE_LEVEL] = lang('College');
            }

        } else {
            $access[self::INSTITUTION_LEVEL] = lang('Institution');
            $access[self::UNIT_LEVEL] = lang('Unit');
            $access[self::COLLEGE_LEVEL] = lang('College');
        }

        $access[self::PROGRAM_LEVEL] = lang('Program');
        return $access;
    }

    public function get_level_title()
    {
        switch ($this->get_level()) {
            case self::COLLEGE_LEVEL:
                return Orm_College::get_instance($this->get_level_id())->get_name();

            case self::PROGRAM_LEVEL:
                return Orm_Program::get_instance($this->get_level_id())->get_name();

            case self::UNIT_LEVEL:
                return Orm_Unit::get_instance($this->get_level_id())->get_name();
        }

        return '';
    }

    public static function get_types()
    {

        $type_classes['Meeting Individual'] = Orm_Mm_Meeting_Individual::class;

        if (self::need_committee()) {
            $type_classes['Meeting Committee'] = Orm_Mm_Meeting_Committee::class;
        }
        if(!License::get_instance()->check_module('advisory', false)){
        }else{
            if (self::has_advisory()) {
                $type_classes['Meeting Advising Group'] = Orm_Mm_Meeting_Advisory::class;
            }
        }

        return $type_classes;
    }

    public static function get_type($type)
    {
        if ($type == Orm_Mm_Meeting_Individual::class) {
            return lang('Meeting Individual');
        } elseif (self::need_committee() && $type == Orm_Mm_Meeting_Committee::class) {
            return lang('Meeting Committee');
        } elseif (self::has_advisory() && $type == Orm_Mm_Meeting_Advisory::class) {
            return lang('Meeting Advising Group');
        } else {
            return $type;
        }
    }

    public function is_valid()
    {
        $this->set_type_id(0);

        return true;
    }

    public function draw_properties()
    {
        return '';
    }

    public function get_attachments_directory()
    {
        $level = $this->get_level();
        $level_id = $this->get_level_id();

        $path = Orm_Semester::get_active_semester()->get_year() . '/';
        switch ($level) {
            case self::INSTITUTION_LEVEL:
                $path .= 'Institution/';
                break;
            case self::COLLEGE_LEVEL:
                $path .= Orm_College::get_instance($level_id)->get_name_en() . '/';
                break;
            case self::PROGRAM_LEVEL:
                $path .= Orm_Program::get_instance($level_id)->get_department_obj()->get_college_obj()->get_name_en() . '/';
                $path .= Orm_Program::get_instance($level_id)->get_name_en() . '/';
                break;
            case self::UNIT_LEVEL:
                $path .= Orm_Unit::get_instance($level_id)->get_name_en() . '/';
                break;
        }

        $path .= 'Meeting Management/' . $this->get_name() . '_' . $this->get_id();

        return $path;
    }

    public function get_attendances()
    {
        return Orm_Mm_Attendance::get_all(['meeting_id' => $this->get_id()]);
    }

    public function generate_pdf()
    {
    }

    public function get_agenda()
    {
        return Orm_Mm_Agenda::get_all(['meeting_id' => $this->get_id()]);
    }

    public function get_action()
    {
        return Orm_Mm_Action::get_all(['meeting_id' => $this->get_id()]);
    }

    public function can_edit()
    {
        if ($this->get_id() == 0) {
            return true;
        }

        if ($this->get_date() == '' || $this->get_end_time() == '') {
            return true;
        }

        return (($this->get_date() != '0000-00-00' || $this->get_end_time(true) == '00:00:00') && strtotime($this->get_date() . ' ' . $this->get_end_time(true)) > time());
    }

    public function get_type_title()
    {
        return '';
    }

    public function get_type_info()
    {
        return '';
    }

    public function get_type_memebers()
    {
        return '';
    }

    public static function need_room()
    {
        return License::get_instance()->check_module('room_management', true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'room_management-list');

    }

    public static function need_committee()
    {
        return License::get_instance()->check_module('committee_work', true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'committee_work-list');

    }

    public static function need_advisory()
    {
        return License::get_instance()->check_module('advisory', true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'advisory-list');

    }

    public static function check_if_can_view()
    {

        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'meeting_minutes-list') && Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'meeting_minutes-report');

    }

    public static function check_if_can_add()
    {
        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'meeting_minutes-manage');
    }

    private $can_edit = null;

    public function check_if_can_edit()
    {

        if (is_null($this->can_edit)) {

            $this->can_edit = false;

            if (self::check_if_can_add()) {
                $this->can_edit = true;
            }
        }

        return $this->can_edit;

    }

    private $can_delete = null;

    public function check_if_can_delete()
    {

        if (is_null($this->can_delete)) {

            $this->can_delete = false;

            if ($this->check_if_can_edit()) {
                $this->can_delete = true;
            }
        }

        return $this->can_delete;
    }

    public static function check_if_can_generate_report()
    {
        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'meeting_minutes-report');
    }


    private static $has_advisory = null;

    public static function has_advisory()
    {
        if (self::need_advisory()) {

            Modules::load('advisory');

            if (Orm_Ad_Faculty_Program::get_count(['faculty_id' => Orm_User::get_logged_user_id()]) != 0) {

                self::$has_advisory = true;
            }
        }
        return self::$has_advisory;
    }
}

