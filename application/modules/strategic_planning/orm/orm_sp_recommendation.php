<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Recommendation extends Orm
{

    /**
     * @var $instances Orm_Sp_Recommendation[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_recommendation';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $recommendation_type_id = 0;
    protected $program_id = 0;
    protected $academic_year = 0;
    protected $title_en = '';
    protected $title_ar = '';

    /**
     * @return Sp_Recommendation_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Recommendation_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Recommendation
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
     * @return Orm_Sp_Recommendation[] | int
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
     * @return Orm_Sp_Recommendation
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Recommendation();
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
        $db_params['recommendation_type_id'] = $this->get_recommendation_type_id();
        $db_params['program_id'] = $this->get_program_id();
        $db_params['academic_year'] = $this->get_academic_year();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();

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

    public function set_recommendation_type_id($value)
    {
        $this->add_object_field('recommendation_type_id',$value);
        $this->recommendation_type_id = $value;
    }

    public function get_recommendation_type_id()
    {
        return $this->recommendation_type_id;
    }

    public function set_program_id($value)
    {
        $this->add_object_field('program_id',$value);
        $this->program_id = $value;
    }

    public function get_program_id()
    {
        return $this->program_id;
    }

    public function set_academic_year($value)
    {
        $this->add_object_field('academic_year',$value);
        $this->academic_year = $value;
    }

    public function get_academic_year()
    {
        return $this->academic_year;
    }

    public function set_title_en($value)
    {
        $this->add_object_field('title_en',$value);
        $this->title_en = $value;
    }

    public function get_title_en()
    {
        return $this->title_en;
    }

    public function set_title_ar($value)
    {
        $this->add_object_field('title_ar',$value);
        $this->title_ar = $value;
    }

    public function get_title_ar()
    {
        return $this->title_ar;
    }
    /**
     * this function get recommendation type obj
     * @return Orm_Sp_Recommendation_Type the object call function
     */
    public function get_recommendation_type_obj() {
        return Orm_Sp_Recommendation_Type::get_instance($this->get_recommendation_type_id());
    }
    /**
     * this function get program obj
     * @return Orm_Program the object call function
     */
    public function get_program_obj() {
        return Orm_Program::get_instance($this->get_program_id());
    }

    public function get_title($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_title_ar() : $this->get_title_en();
    }
    /**
     * this function get all group by types by its filters
     * @param array $filters the filters of the get all group by types to be call function
     * @return array the call function
     */
    public static function get_all_group_by_types($filters = array()) {
        $types = Orm_Sp_Recommendation_Type::get_all();

        $results = array();
        foreach ($types as $type) {
            $results[$type->get_id()][] = $type;
            $results[$type->get_id()]['data'] = self::get_all(array_merge($filters, array('recommendation_type_id' => $type->get_id())));
        }

        return $results;
    }

}

