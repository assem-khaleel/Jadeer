<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Semester extends Orm
{

    /**
     * @var $instances Orm_Semester[]
     */
    protected static $instances = array();
    protected static $table_name = 'semester';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $integration_id = 0;
    protected $year = 0;
    protected $start = '0000-00-00';
    protected $end = '0000-00-00';
    protected $name_en = '';
    protected $name_ar = '';
    protected $is_deleted = 0;

    /**
     * @return Semester_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Semester_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Semester
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
     * @return Orm_Semester[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array('s.integration_id DESC'))
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Semester
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Semester();
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
        $db_params['year'] = $this->get_year();
        $db_params['start'] = $this->get_start();
        $db_params['end'] = $this->get_end();
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['is_deleted'] = $this->get_is_deleted();

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

    public function set_year($value)
    {
        $this->add_object_field('year',$value);
        $this->year = $value;
    }

    public function get_year()
    {
        return $this->year;
    }

    public function set_start($value)
    {
        $this->add_object_field('start',$value);
        $this->start = $value;
    }

    public function get_start()
    {
        return $this->start;
    }

    public function set_end($value)
    {
        $this->add_object_field('end',$value);
        $this->end = $value;
    }

    public function get_end()
    {
        return $this->end;
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
        return $lang == 'arabic' ? $this->get_name_ar() : $this->get_name_en();
    }

    public function set_name($value)
    {
        $this->set_name_en($value);
        $this->set_name_ar($value);
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

    public static function get_years()
    {
        return array_unique(array_column(self::get_model()->get_all(array(), 0, 0, array('year desc'), Orm::FETCH_ARRAY), 'year'));
    }

    public function set_active_semester()
    {
        if (!is_cli()) {
            Orm::get_ci()->session->set_userdata('semester_id', $this->get_id());
        }
    }

    public static function get_active_semester_id() {

        $semester_id = 0;

        if (!is_cli()) {
            $semester_id = Orm::get_ci()->session->userdata('semester_id');
        }

        return intval($semester_id);
    }

    public static function get_active_semester()
    {
        $semester_id = self::get_active_semester_id();

        if (!empty($semester_id)) {
            $semester = self::get_instance($semester_id);

            if(!$semester->get_id()){
                $semester = self::get_current_semester();
                $semester->set_active_semester();
            }
        } else {
            $semester = self::get_current_semester();
            $semester->set_active_semester();
        }

        return $semester;
    }

    public static $current = null;

    public static function get_current_semester()
    {

        if (is_null(self::$current)) {
            self::$current = self::get_one(array('date' => date('Y-m-d')));

            if (!self::$current->get_id()) {
                self::$current = self::get_last_semester();
            }
        }

        return self::$current;
    }

    public function get_is_current()
    {
        return ($this->get_id() == Orm_Semester::get_current_semester()->get_id());
    }

    /**
     * @return Orm_Semester
     */
    public static function get_last_semester()
    {
        return self::get_instance(self::get_model()->get_max_id());
    }

    public static function get_last_five_years() {
        return self::get_model()->get_last_five_years(Orm_Semester::get_active_semester()->get_year());
    }
}

