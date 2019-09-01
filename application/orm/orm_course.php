<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Course extends Orm
{
    /**
     * @var $instances Orm_Course[]
     */
    protected static $instances = array();
    protected static $table_name = 'course';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $integration_id = 0;
    protected $department_id = 0;
    protected $is_deleted = 0;
    protected $type = 'theoretical';
    protected $name_en = '';
    protected $name_ar = '';
    protected $code_en = '';
    protected $code_ar = '';

    /**
     * @return Course_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Course_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Course
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
     * @return Orm_Course[] | int
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
     * @return Orm_Course
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Course();
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
        $db_params['type'] = $this->get_type();
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['code_en'] = $this->get_code_en();
        $db_params['code_ar'] = $this->get_code_ar();

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

    public function set_type($value)
    {
        $this->add_object_field('type',$value);
        $this->type = $value;
    }

    public function get_type()
    {
        return $this->type;
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

    public function get_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
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

    public function set_code_en($value)
    {
        $this->add_object_field('code_en',$value);
        $this->code_en = $value;
    }

    public function get_code_en()
    {
        return $this->code_en;
    }

    public function set_code_ar($value)
    {
        $this->add_object_field('code_ar',$value);
        $this->code_ar = $value;
    }

    public function get_code_ar()
    {
        return $this->code_ar;
    }

    public function get_code($lang = UI_LANG) {
        if ($lang == 'arabic') {
            return $this->get_code_ar();
        }
        return $this->get_code_en();
    }

    /**
     * @return Orm_Department
     */
    public function get_department_obj()
    {
        return Orm_Department::get_instance($this->get_department_id());
    }

    private $sections = null;

    /**
     * @return Orm_Course_Section[]
     */
    public function get_sections()
    {
        if(is_null($this->sections)) {
            $this->sections = Orm_Course_Section::get_all(['course_id' => $this->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id()]);
        }

        return $this->sections;
    }

    public static function get_teacher_course_ids($user_id, $active = true, $select = 'id') {
        return self::get_model()->get_teacher_course_ids($user_id, $active, $select);
    }

    public function is_course_teacher($user_id) {
        return self::get_model()->is_course_teacher($user_id, $this->get_id());
    }

    public function get_number($lang = UI_LANG)
    {
        return $this->get_code($lang);
    }

    public function get_credit_hour()
    {
        return 0;
    }

    public function can_manage($user_id = null) {
        if (is_null($user_id)) {
            $user_id = Orm_User::get_logged_user_id();
        }

        if (Orm_Course_Section_Teacher::get_one(array('user_id' => $user_id, 'course_id' => $this->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id()))->get_id()) {
            return true;
        }

        $user_obj = Orm_User::get_instance($user_id);
        if (!$user_obj->get_id()) {
            return false;
        } else {
            switch ($user_obj->get_role_obj()->get_admin_level()) {
                case Orm_Role::ROLE_INSTITUTION_ADMIN:
                    return true;
                    break;
                case Orm_Role::ROLE_COLLEGE_ADMIN:
                    if ($user_obj->get_college_id() == $this->get_department_obj()->get_college_id()) {
                        return true;
                    }
                    return false;
                    break;
                case Orm_Role::ROLE_PROGRAM_ADMIN:
                    if (Orm_Program_Plan::get_one(array('program_id' => $user_obj->get_program_id(), 'course_id' => $this->get_id()))->get_id()) {
                        return true;
                    }
                    return false;
                    break;
            }

            return false;
        }
    }
}

