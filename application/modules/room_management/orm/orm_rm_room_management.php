<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rm_Room_Management extends Orm {
    
    /**
    * @var $instances Orm_Rm_Room_Management[]
    */
    protected static $instances = array();
    protected static $table_name = 'rm_room_management';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $name_ar = '';
    protected $name_en = '';
    protected $room_number = 0;
    protected $room_type = 0;
    protected $college_id = 0;

    const TYPE_LAB = 1;
    const TYPE_OFFICE = 2;
    const TYPE_CLASSROOM = 3;
    const TYPE_AUDITORIUM = 4;
    const TYPE_MEETINGROOM = 5;
    const TYPE_HOLE = 6;
    const TYPE_OTHER = 7;

    public static $type_list = array(
        self::TYPE_LAB => 'Lab',
        self::TYPE_OFFICE => 'Office',
        self::TYPE_CLASSROOM => 'Classroom',
        self::TYPE_AUDITORIUM => 'Auditorium',
        self::TYPE_MEETINGROOM => 'Meeting Room',
        self::TYPE_HOLE => 'Hole',
        self::TYPE_OTHER => 'Others',

    );



    /**
    * @return Rm_Room_Management_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Rm_Room_Management_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Rm_Room_Management
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
    * @return Orm_Rm_Room_Management[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Rm_Room_Management
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Rm_Room_Management();
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
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['name_en'] = $this->get_name_en();
        $db_params['room_number'] = $this->get_room_number();
        $db_params['room_type'] = $this->get_room_type();
        $db_params['college_id'] = $this->get_college_id();
        
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
        Orm_Rm_Room_Equipment::delete_room($this->get_id());
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
    
    public function set_name_ar($value) {
        $this->add_object_field('name_ar', $value);
        $this->name_ar = $value;
    }
    
    public function get_name_ar() {
        return $this->name_ar;
    }
    
    public function set_name_en($value) {
        $this->add_object_field('name_en', $value);
        $this->name_en = $value;
    }
    
    public function get_name_en() {
        return $this->name_en;
    }

    public function get_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
    }
    public function set_room_number($value) {
        $this->add_object_field('room_number', $value);
        $this->room_number = $value;
    }
    public function get_room_number() {
        return $this->room_number;
    }
    public function set_room_type($value) {
        $this->add_object_field('room_type', $value);
        $this->room_type = $value;
    }
    public function get_room_type($to_string = false) {

        if ($to_string) {
            return (isset(self::$type_list[$this->room_type]) ? self::$type_list[$this->room_type] : '');
        }

        return $this->room_type;
        
    }
    public function set_college_id($value) {
        $this->add_object_field('college_id', $value);
        $this->college_id = $value;
    }
    
    public function get_college_id() {
        return $this->college_id;
    }

    public function get_college_obj(){
        return Orm_College::get_instance($this->get_college_id());
    }

    /** check if users can add equipment
     */
    public static function check_if_can_add() {
        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class],false,'room_management-manage');
    }

    private $can_edit = null;
    /** check if users can edit equipment
     */
   public function check_if_can_edit(){

       if(is_null($this->can_edit)) {

           $this->can_edit = false;

           if(self::check_if_can_add()) {
                   $this->can_edit = true;
           }
       }

       return $this->can_edit;

   }
    private $can_delete = null;
    /** check if users can delete equipment
     */
    public  function check_if_can_delete(){
        
        if(is_null($this->can_delete)) {

            $this->can_delete = false;

            if($this->check_if_can_edit()) {
                    $this->can_delete = true;
            }
        }

        return $this->can_delete;
    }
/** check if user can map and access meeting minutes to map with room management
*/
    public static function check_if_can_mapp_with_meeting() {
        return License::get_instance()->check_module('meeting_minutes',true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'meeting_minutes-list');
    }
    
}

