<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tm_Training extends Orm {

    /**
     * @var $instances Orm_Tm_Training[]
     */
    protected static $instances = array();
    protected static $table_name = 'tm_training';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $duration = '';
    protected $date = '';
    protected $type_id = 0;
    protected $organization = '';
    protected $location = '';
    protected $instructor_information = '';
    protected $description = '';
    protected $training_outline = '';
    protected $creator_id = 0;
    protected $level = 0;
    protected $college_id = 0;
    protected $department_id = 0;
    protected $status = 0;
    
    /**
     * level Types
     */
    
    const INSTITUTION_LEVEL = 0;
    const COLLEGE_LEVEL = 1;
    const PROGRAM_LEVEL = 2;

    /**
     * Status Types
     */
    const TRAINING_PUBLIC = 0;
    const TRAINING_PRIVATE = 1;

    public static $status_list = array(
        self::TRAINING_PUBLIC => 'Public',
        self::TRAINING_PRIVATE => 'Private'

    );
  

    /**
     * @return Tm_Training_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Tm_Training_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Tm_Training
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
     * @return Orm_Tm_Training[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Tm_Training
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Tm_Training();
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
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['duration'] = $this->get_duration();
        $db_params['date'] = $this->get_date();
        $db_params['type_id'] = $this->get_type_id();
        $db_params['organization'] = $this->get_organization();
        $db_params['location'] = $this->get_location();
        $db_params['instructor_information'] = $this->get_instructor_information();
        $db_params['description'] = $this->get_description();
        $db_params['training_outline'] = $this->get_training_outline();
        $db_params['creator_id'] = $this->get_creator_id();
        $db_params['level'] = $this->get_level();
        $db_params['college_id'] = $this->get_college_id();
        $db_params['department_id'] = $this->get_department_id();
        $db_params['status'] = $this->get_status();
        
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
        $this->add_object_field('id', $value);
        $this->id = $value;

        $this->push_instance();
    }

    public function get_id() {
        return $this->id;
    }

    public function set_name_en($value) {
        $this->add_object_field('name_en', $value);
        $this->name_en = $value;
    }

    public function get_name_en() {
        return $this->name_en;
    }

    public function set_name_ar($value) {
        $this->add_object_field('name_ar', $value);
        $this->name_ar = $value;
    }

    public function get_name_ar() {
        return $this->name_ar;
    }

    public function set_duration($value) {
        $this->add_object_field('duration', $value);
        $this->duration = $value;
    }

    public function get_duration() {
        return $this->duration;
    }

    public function set_date($value) {
        $this->add_object_field('date', $value);
        $this->date = $value;
    }

    public function get_date() {
        return $this->date;
    }

    public function set_type_id($value) {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }

    public function get_type_id() {
        return $this->type_id;
    }

    public function set_organization($value) {
        $this->add_object_field('organization', $value);
        $this->organization = $value;
    }

    public function get_organization() {
        return $this->organization;
    }

    public function set_location($value) {
        $this->add_object_field('location', $value);
        $this->location = $value;
    }

    public function get_location() {
        return $this->location;
    }

    public function set_instructor_information($value) {
        $this->add_object_field('instructor_information', $value);
        $this->instructor_information = $value;
    }

    public function get_instructor_information() {
        return $this->instructor_information;
    }

    public function set_description($value) {
        $this->add_object_field('description', $value);
        $this->description = $value;
    }

    public function get_description() {
        return $this->description;
    }

    public function set_training_outline($value) {
        $this->add_object_field('training_outline', $value);
        $this->training_outline = $value;
    }

    public function get_training_outline() {
        return $this->training_outline;
    }

    public function set_creator_id($value) {
        $this->add_object_field('creator_id', $value);
        $this->creator_id = $value;
    }

    public function get_creator_id() {
        return $this->creator_id;
    }

    public function set_level($value) {
        $this->add_object_field('level', $value);
        $this->level = $value;
    }

    public function get_level() {
        return $this->level;
    }
    public function set_college_id($value) {
        $this->add_object_field('college_id', $value);
        $this->college_id = $value;
    }

    public function get_college_id() {
        return $this->college_id;
    }

    public function set_department_id($value) {
        $this->add_object_field('department_id', $value);
        $this->department_id = $value;
    }

    public function get_department_id() {
        return $this->department_id;
    }

    public function set_status($value) {
        $this->add_object_field('status', $value);
        $this->status = $value;
    }

    /**
     *  get the training status if it's public anyone can join or private just the member of training join it
     * @param bool $to_string
     * @return int|mixed|string
     */
    public function get_status($to_string = false) {
        if ($to_string) {
            return (isset(self::$status_list[$this->status]) ? self::$status_list[$this->status] : '');
        }
        return $this->status;
    }


    /**
     * name of training in 2 language can get here depends on the active language
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_name($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
    }


    private $members = null;

    /**
     * show all members that are join the training
     * @return Orm_Tm_Members[]
     */
    public function get_members ()
    {
        if(is_null($this->members)) {
            $this->members = Orm_Tm_Members::get_all(['training_id' => $this->get_id()]);
        }

        return $this->members;
    }

    /**
     * get all id's for the joind member for training
     * @return array
     */
    public function get_member_ids()
    {
        $member_ids = array();
        foreach ($this->get_members() as $user) {
            $member_ids[] = $user->get_user_id();
        }
        return $member_ids;
    }
    
    

    /**
     * get the training type as an objects depends on type id
     * @return Orm_Tm_Type
     */
    public function get_type_obj()
    {
        return Orm_Tm_Type::get_instance($this->get_type_id());
    }


    /**
     * check the privilege of user that can do in training "manage"
     * @return bool
     */
    public static function check_if_can_add() {
        return Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class],false,'training_management-manage');
    }

    /**
     * check the privilege of user that can do in training and if he can access the training or not
     * @return bool
     */
    public static function check_if_can_view() {

        return  Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'training_management-list');

    }
    
    
    private $can_edit = null;

    /**
     * check the permissions if user can edit or update the infromation of training
     * @return bool|null
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
    
    private $can_view = null;

    /**
     * check that user can view/show the the overall data for training
     * @return bool|null
     */
    public function check_user_can_view(){
        $user =Orm_User::get_logged_user();
        if(is_null($this->can_view)) {

            $this->can_view = false;

            if(self::check_if_can_view()) {

                if($user->get_id() == $this->get_creator_id() ||
                in_array($user->get_id(),$this->get_member_ids()))
                {
                    
                    $this->can_view = true; 
                }

                return $this->can_view;
            }
        }

        return $this->can_view;

    }
    
    private $can_delete = null;

    /**
     * @return bool|null
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


    private $can_modify =null;

    /**
     * check if user can manage (add,edit,Update) data of training
     * @return bool|null
     */
    public function check_if_can_modify(){
        $user = Orm_User::get_logged_user();
        if(self::check_if_can_add()){

            
            if($this->get_creator_id() == $user->get_id()){
                $this->can_modify = true;

            }
            
            if ($user->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                $this->can_modify = true;
            }

            return  $this->can_modify;
        }

        return  $this->can_modify;

    }

    /**
     * check if the training can mapped with survey Module and can create a survey for (Need to Activate Survey Module if its not will not work )
     * @return bool
     */
    public static function map_survey(){
        
        return License::get_instance()->check_module('survey',true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'survey_training-list');
    }
    private $can_map =null;
    
    public function can_map_with_survey(){

        $user = Orm_User::get_logged_user();

        if(self::map_survey()){
            if($this->get_creator_id() == $user->get_id()){
                $this->can_map = true;
            }
            return  $this->can_map;
        }
        return  $this->can_map;

    }

    /**
     * There are 3 type of units / Level for training (institution , Program, and College)
     * this function will show the name of the unit and if parameter are send will show a specifi unit not all units depends on role
     * @param bool $is_String
     * @return array
     */
    public static function get_unit_types($is_String = false) {

        $access = array();
        if(!$is_String){
            if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                $access[self::INSTITUTION_LEVEL]=lang('Institution');
                $access[self::COLLEGE_LEVEL]=lang('College');
            }
            if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                $access[self::COLLEGE_LEVEL]=lang('College');
            }

        }else{
            $access[self::INSTITUTION_LEVEL]=lang('Institution');
            $access[self::COLLEGE_LEVEL]=lang('College');
        }

        $access[self::PROGRAM_LEVEL]=lang('Program');
        return $access;
    }

    private $level_ids = null;

    /**
     * get the id of Level that are mapped with training after choosing types
     * @return Orm_Tm_Level[]
     */
    public function get_levels_id ()
    {
        if(is_null($this->level_ids)) {
            $this->level_ids = Orm_Tm_Level::get_all(['training_id' => $this->get_id()]);
        }

        return $this->level_ids;
    }

    /**
     * get all ids for a different level or unit that are mapped with training
     * @return array =>array of level ids'
     */
    public function get_level_ids()
    {
        $all_ids = array();
        foreach ($this->get_levels_id() as $level) {
            $all_ids[] = $level->get_level_id();
        }
        return $all_ids;
    }

    /**
     * get the unit of specific level
     * @return mixed
     */
    public function get_current_unit_type() {
        return self::get_unit_types(true)[$this->get_level()];
    }

    /**
     * get the name of unit (name of college or program )
     * @return string
     */
    public function get_current_unit_type_title() {
        switch($this->get_level()) {
            case self::COLLEGE_LEVEL:
                foreach ($this->get_levels_id() as $level){
                    return Orm_College::get_instance($level->get_level_id())->get_name();   
                }
              
            case self::PROGRAM_LEVEL:
                foreach ($this->get_levels_id() as $level){
                    return Orm_Program::get_instance($level->get_level_id())->get_name();
                }
        }

        return '';
    }


    /**
     * get user informations depends on memeber ids that are added for training before
     * @return int|Orm_User[]
     */
    public function get_users_obj(){

        return Orm_User::get_all(['in_id'=>$this->get_member_ids()]);

    }

}

