<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Ad_Faculty_Program extends Orm {
    
    /**
    * @var $instances Orm_Ad_Faculty_Program[]
    */
    protected static $instances = array();
    protected static $table_name = 'ad_faculty_program';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $program_id = 0;
    protected $faculty_id = 0;
    
    /**
    * @return Ad_Faculty_Program_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Ad_Faculty_Program_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Ad_Faculty_Program
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
    * @return Orm_Ad_Faculty_Program[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Ad_Faculty_Program
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Ad_Faculty_Program();
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

    /**
     * @return array
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['program_id'] = $this->get_program_id();
        $db_params['faculty_id'] = $this->get_faculty_id();
        
        return $db_params;
    }

    /**
     * @return int
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

    /**
     * @return bool
     */
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }

    /**
     * @param $value
     */
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }

    /**
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * @param $value
     */
    public function set_program_id($value) {
        $this->add_object_field('program_id', $value);
        $this->program_id = $value;
    }

    /**
     * @return int
     */
    public function get_program_id() {
        return $this->program_id;
    }

    /**
     * @param $value
     */
    public function set_faculty_id($value) {
        $this->add_object_field('faculty_id', $value);
        $this->faculty_id = $value;
    }

    /**
     * @return int
     */
    public function get_faculty_id() {
        return $this->faculty_id;
    }


    /**
     * this function get program avg by its program id
     * @param int $id the id of the get program avg to be call function
     * @return int the calling function
     */
    static function  get_program_avg($id){
        return self::get_model()->get_program_avg($id);
    }

    /**
     * this function get all group by program
     * @return array the calling function
     */
    public static function get_all_group_by_program() {
        return self::get_model()->get_all_group_by_program();
    }

    /**
     * this function get all group by program id by its program id
     * @param int $program_id the program id of the get all group by program to be call function
     * @return array the calling function
     */
    public static function get_all_group_by_program_id($program_id) {
        return self::get_model()->get_all_group_by_program_id($program_id);
    }

    /**
     * this function get all group by program ids by its program id
     * @param int $program_ids the program ids of the to et all group by program ids be call function
     * @return array the calling function
     */
    public static function get_all_group_by_program_ids($program_ids) {
        return self::get_model()->get_all_group_by_program_ids($program_ids);
    }

    /**
     * this function check if can add
     * @return bool the call function
     */
    public static function check_if_can_add() {
        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class],false,'advisory-manage');
    }
    

    private $can_edit = null;

    /**
     * this function check if can edit
     * @return bool|null the call function
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

    /**
     * this function check if can delete
     * @return bool|null the call function
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

    /**
     * this function can add survey
     * @return bool the call function
     */
    public static function can_add_survey(){
        return Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'survey_advisory-manage');
    }

    /**
     * this function map survey
     * @return bool the call function
     */
    public static function map_survey(){

        return License::get_instance()->check_module('survey',true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'survey_advisory-list');
    }
    
    private $can_map =null;
    /**
     * this function can map with survey
     * @return bool|null the call function
     */
    public function can_map_with_survey(){

        $user = Orm_User::get_logged_user();

        if(self::map_survey()){
            if($this->get_faculty_id() == $user->get_id()){
                $this->can_map = true;
            }
            return  $this->can_map;
        }
        return  $this->can_map;

    }


    /**
     * this function can evaluation
     * @return bool the call function
     */
    public static function can_evaluation(){
        return License::get_instance()->check_module('survey',true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'survey_advisory-evaluation');
    }
    
}

