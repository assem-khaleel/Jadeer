<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Course_Section extends Orm {

    /**
    * @var $instances Orm_Course_Section[]
    */
    protected static $instances = array();
    protected static $table_name = 'course_section';

    /**
    * class attributes
    */
    protected $id = 0;
    protected $integration_id = 0;
    protected $course_id = 0;
    protected $semester_id = 0;
    protected $campus_id = 0;
    protected $is_deleted = 0;
    protected $section_no = '';
    protected $extra_params = '';
    protected $room_id = 0;

    /**
    * @return Course_Section_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Course_Section_Model');
    }

    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Course_Section
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
    * @return Orm_Course_Section[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Course_Section
    */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Course_Section();
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
        $db_params['integration_id'] = $this->get_integration_id();
        $db_params['course_id'] = $this->get_course_id();
        $db_params['room_id'] = $this->get_room_id();
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['campus_id'] = $this->get_campus_id();
        $db_params['is_deleted'] = $this->get_is_deleted();
        $db_params['section_no'] = $this->get_section_no();
        $db_params['extra_params'] = $this->get_extra_params(false);

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
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }

    public function get_id() {
        return $this->id;
    }

    public function set_integration_id($value) {
        $this->add_object_field('integration_id',$value);
        $this->integration_id = $value;
    }

    public function get_integration_id() {
        return $this->integration_id;
    }

    public function set_course_id($value) {
        $this->add_object_field('course_id',$value);
        $this->course_id = $value;
    }

    public function get_course_id() {
        return $this->course_id;
    }
    public function set_room_id($value) {
        $this->add_object_field('room_id',$value);
        $this->room_id = $value;
    }

    public function get_room_id() {
        return $this->room_id;
    }

    public function set_semester_id($value) {
        $this->add_object_field('semester_id',$value);
        $this->semester_id = $value;
    }

    public function get_semester_id() {
        return $this->semester_id;
    }

    public function set_campus_id($value) {
        $this->add_object_field('campus_id',$value);
        $this->campus_id = $value;
    }

    public function get_campus_id() {
        return $this->campus_id;
    }

    public function set_is_deleted($value) {
        $this->add_object_field('is_deleted',$value);
        $this->is_deleted = $value;
    }

    public function get_is_deleted() {
        return $this->is_deleted;
    }

    public function set_section_no($value) {
        $this->add_object_field('section_no',$value);
        $this->section_no = $value;
    }

    public function get_section_no() {
        return $this->section_no;
    }

    public function set_extra_params($value) {

        if(is_array($value)) {
            $value = json_encode($value);
        }

        $this->add_object_field('extra_params', $value);
        $this->extra_params = $value;
    }

    public function get_extra_params($as_json = true) {
        if($as_json) {
            return json_decode($this->extra_params, true);
        }
        return $this->extra_params;
    }

    public function get_extra_item($item) {
        $extra_params = $this->get_extra_params();
        return isset($extra_params[$item]) ? $extra_params[$item] : null;
    }

    public function get_name()
    {
        return $this->get_section_no();
    }

    /**
     * @return Orm_Course
     */
    public function get_course_obj()
    {
        return Orm_Course::get_instance($this->get_course_id());
    }

    /**
     * @return Orm_Semester
     */
    public function get_semester_obj()
    {
        return Orm_Semester::get_instance($this->get_semester_id());
    }

    private $students = null;

    /**
     * @return Orm_Course_Section_Student[]
     */
    public function get_students()
    {
        if(is_null($this->students)) {
            $this->students = Orm_Course_Section_Student::get_all(['section_id' => $this->get_id()]);
        }

        return $this->students;
    }

    private $teachers = null;

    /**
     * @return Orm_Course_Section_Teacher[]
     */
    public function get_teachers()
    {
        if(is_null($this->teachers)) {
            $this->teachers = Orm_Course_Section_Teacher::get_all(['section_id' => $this->get_id()]);
        }

        return $this->teachers;
    }

    public function get_teacher_ids()
    {
        $teacher_ids = array();
        foreach ($this->get_teachers() as $teacher) {
            $teacher_ids[] = $teacher->get_user_id();
        }
        return $teacher_ids;
    }
}

