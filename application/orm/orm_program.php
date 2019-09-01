<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Program extends Orm{

    /**
     * @var $instances Orm_Program[]
     */
    protected static $instances = array();
    protected static $table_name = 'program';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $integration_id = 0;
    protected $department_id = 0;
    protected $is_deleted = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $code_en = '';
    protected $code_ar = '';
    protected $credit_hours = 0;
    protected $duration = 0;
    protected $degree_id = 0;
    protected $vision_en = '';
    protected $vision_ar = '';
    protected $mission_en = '';
    protected $mission_ar = '';

    /**
     * @return Program_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Program_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Program
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
     * @return Orm_Program[] | int
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
     * @return Orm_Program
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Program();
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
        $db_params['integration_id'] = $this->get_integration_id();
        $db_params['department_id'] = $this->get_department_id();
        $db_params['is_deleted'] = $this->get_is_deleted();
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['code_en'] = $this->get_code_en();
        $db_params['code_ar'] = $this->get_code_ar();
        $db_params['credit_hours'] = $this->get_credit_hours();
        $db_params['duration'] = $this->get_duration();
        $db_params['degree_id'] = $this->get_degree_id();
        $db_params['vision_en'] = $this->get_vision_en();
        $db_params['vision_ar'] = $this->get_vision_ar();
        $db_params['mission_en'] = $this->get_mission_en();
        $db_params['mission_ar'] = $this->get_mission_ar();

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

    public function set_integration_id($value)
    {
        $this->add_object_field('integration_id',$value);
        $this->integration_id = $value;
    }

    public function get_integration_id()
    {
        return $this->integration_id;
    }

    public function set_department_id($value)
    {
        $this->add_object_field('department_id',$value);
        $this->department_id = $value;
    }

    public function get_department_id()
    {
        return $this->department_id;
    }

    public function set_is_deleted($value)
    {
        $this->add_object_field('is_deleted',$value);
        $this->is_deleted = $value;
    }

    public function get_is_deleted()
    {
        return $this->is_deleted;
    }

    public function set_name_en($value)
    {
        $this->add_object_field('name_en',$value);
        $this->name_en = $value;
    }

    public function get_name_en()
    {
        return $this->name_en;
    }

    public function set_name_ar($value)
    {
        $this->add_object_field('name_ar',$value);
        $this->name_ar = $value;
    }

    public function get_name_ar()
    {
        return $this->name_ar;
    }

    public function get_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
    }

    public function set_code_en($value) {
        $this->add_object_field('code_en',$value);
        $this->code_en = $value;
    }

    public function get_code_en() {
        return $this->code_en;
    }

    public function set_code_ar($value) {
        $this->add_object_field('code_ar',$value);
        $this->code_ar = $value;
    }

    public function get_code_ar() {
        return $this->code_ar;
    }

    public function set_credit_hours($value) {
        $this->add_object_field('credit_hours',$value);
        $this->credit_hours = $value;
    }

    public function get_credit_hours() {
        return $this->credit_hours;
    }

    public function set_duration($value) {
        $this->add_object_field('duration',$value);
        $this->duration = $value;
    }

    public function get_duration() {
        return $this->duration ? $this->duration : ceil($this->get_levels() / 2);
    }

    public function get_levels() {
        return Orm_Program_Plan::get_model()->get_max($this->get_id());
    }

    public function set_degree_id($value) {
        $this->add_object_field('degree_id',$value);
        $this->degree_id = $value;
    }

    public function get_degree_id() {
        return $this->degree_id;
    }
    public function get_vision($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_vision_ar();
        }
        return $this->get_vision_en();
    }
    public function set_vision_en($value) {
        $this->add_object_field('vision_en',$value);
        $this->vision_en = $value;
    }

    public function get_vision_en() {
        return $this->vision_en;
    }

    public function set_vision_ar($value) {
        $this->add_object_field('vision_ar',$value);
        $this->vision_ar = $value;
    }

    public function get_vision_ar() {
        return $this->vision_ar;
    }
    public function get_mission($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_mission_ar();
        }
        return $this->get_mission_en();
    }
    public function set_mission_en($value) {
        $this->add_object_field('mission_en',$value);
        $this->mission_en = $value;
    }

    public function get_mission_en() {
        return $this->mission_en;
    }

    public function set_mission_ar($value) {
        $this->add_object_field('mission_ar',$value);
        $this->mission_ar = $value;
    }

    public function get_mission_ar() {
        return $this->mission_ar;
    }
    /**
     * this function get degree obj
     * @return Orm_Degree the object call function
     */
    public function get_degree_obj()
    {
        return Orm_Degree::get_instance($this->get_degree_id());
    }
    /**
     * this function get department obj
     * @return Orm_Department the object call function
     */
    public function get_department_obj()
    {
        return Orm_Department::get_instance($this->get_department_id());
    }

    public function get_number($lang = UI_LANG){
        return $this->get_code($lang);
    }

    public function get_code($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_code_ar();
        }
        return $this->get_code_en();
    }
    /**
     * this function get majors
     * @return Orm_Major[] the object call function
     */
    public function get_majors() {
        return Orm_Major::get_all(array('program_id' => $this->get_id()));
    }

    public function get_is_valid() {
        return 0;
    }
    /**
     * this function get courses
     * @return Orm_Program_Plan[] the object call function
     */
    public function get_courses() {
        return Orm_Program_Plan::get_all(array('program_id' => $this->get_id()));
    }
    /**
     * this function get admin ids
     * @return array the call function
     */
    public function get_admin_ids() {
		return Orm_User::get_user_ids_by_role(Orm_Role::ROLE_PROGRAM_ADMIN, array('program_id' => $this->get_id()));
	}

    private static $objectives = null;
    /**
     * this function get objectives
     * @return Orm_Program_Objective[] the object call function
     */
    public function get_objectives() {
        if(is_null(self::$objectives)) {
            self::$objectives = Orm_Program_Objective::get_all(array('program_id' => $this->get_id()));
        }
        return self::$objectives;
    }

    private static $goals = null;
    /**
     * this function get goals
     * @return Orm_Program_Goal[] the object call function
     */
    public function get_goals() {
        if(is_null(self::$goals)) {
            self::$goals = Orm_Program_Goal::get_all(array('program_id' => $this->get_id()));
        }
        return self::$goals;
    }

    public function draw_mission() {
        return Orm::get_ci()->load->view('setup/mission/view', array('object' => $this), true);
    }

    public function draw_vision() {
        return Orm::get_ci()->load->view('setup/vision/view', array('object' => $this), true);
    }

    public function draw_goals() {
        return Orm::get_ci()->load->view('setup/goal/view', array('object' => $this), true);
    }

    public function draw_objectives() {
        return Orm::get_ci()->load->view('setup/objective/view', array('object' => $this), true);
    }


}

