<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Values extends Orm
{

    /**
     * @var $instances Orm_Sp_Values[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_values';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $strategy_id = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $desc_en = '';
    protected $desc_ar = '';

    /**
     * @return Sp_Values_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Values_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Values
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
     * @return Orm_Sp_Values[] | int
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
     * @return Orm_Sp_Values
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Values();
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
        $db_params['strategy_id'] = $this->get_strategy_id();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['desc_en'] = $this->get_desc_en();
        $db_params['desc_ar'] = $this->get_desc_ar();

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

    public function set_strategy_id($value)
    {
        $this->add_object_field('strategy_id',$value);
        $this->strategy_id = $value;
    }

    public function get_strategy_id()
    {
        return $this->strategy_id;
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

    public function set_desc_en($value)
    {
        $this->add_object_field('desc_en',$value);
        $this->desc_en = $value;
    }

    public function get_desc_en()
    {
        return $this->desc_en;
    }

    public function set_desc_ar($value)
    {
        $this->add_object_field('desc_ar',$value);
        $this->desc_ar = $value;
    }

    public function get_desc_ar()
    {
        return $this->desc_ar;
    }

    public function get_title($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_title_ar() : $this->get_title_en();
    }

    public function get_description($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_desc_ar() : $this->get_desc_en();
    }
}

