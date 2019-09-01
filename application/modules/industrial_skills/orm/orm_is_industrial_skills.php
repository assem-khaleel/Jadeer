<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Is_Industrial_Skills extends Orm {

    /**
     * @var $instances Orm_Is_Industrial_Skills[]
     */
    protected static $instances = array();
    protected static $table_name = 'is_industrial_skills';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $program_id = 0;
    protected $college_id = 0;
    protected $is_deleted = 0;


    const INDUSTRIAL_INSTITUTION_LEVEL = 0;
    const INDUSTRIAL_COLLEGE_LEVEL = 1;
    const INDUSTRIAL_PROGRAM_LEVEL = 2;

    /**
     * @return Is_Industrial_Skills_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Is_Industrial_Skills_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Is_Industrial_Skills
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
     * @return Orm_Is_Industrial_Skills[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Is_Industrial_Skills
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Is_Industrial_Skills();
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
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['program_id'] = $this->get_program_id();
        $db_params['college_id'] = $this->get_college_id();
        $db_params['is_deleted'] = $this->get_is_deleted();

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
    public function set_name_en($value) {
        $this->add_object_field('name_en', $value);
        $this->name_en = $value;
    }

    /**
     * @return string
     */
    public function get_name_en() {
        return $this->name_en;
    }

    /**
     * @param $value
     */
    public function set_name_ar($value) {
        $this->add_object_field('name_ar', $value);
        $this->name_ar = $value;
    }

    /**
     * @return string
     */
    public function get_name_ar() {
        return $this->name_ar;
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
    public function set_college_id($value) {
        $this->add_object_field('college_id', $value);
        $this->college_id = $value;
    }

    /**
     * @return int
     */
    public function get_college_id() {
        return $this->college_id;
    }

    /**
     * @param $value
     */
    public function set_is_deleted($value) {
        $this->add_object_field('is_deleted', $value);
        $this->is_deleted = $value;
    }

    /**
     * @return int
     */
    public function get_is_deleted() {
        return $this->is_deleted;
    }


    /**
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_name($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_name_ar() : $this->get_name_en();
    }
    /**
     * this function get program obj
     * @return Orm_Program the object call function
     */
    public function get_program_obj()
    {
        return Orm_Program::get_instance($this->get_program_id());
    }
    /**
     * this function get college obj
     * @return Orm_College the object call function
     */
    public function get_college_obj()
    {
        return Orm_College::get_instance($this->get_college_id());
    }
    /**
     * this function get rubric obj
     * @return bool the call function
     */
    public static function check_if_can_add() {
        return Orm_User::check_credential([Orm_User::USER_FACULTY, Orm_User::USER_STAFF],false,'industrial_skills-manage');
    }

}

