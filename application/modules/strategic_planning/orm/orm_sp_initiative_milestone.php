<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Initiative_Milestone extends Orm
{

    /**
     * @var $instances Orm_Sp_Initiative_Milestone[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_initiative_milestone';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $initiative_id = 0;
    protected $year = 0;
    protected $target = 0;

    /**
     * @return Sp_Initiative_Milestone_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Initiative_Milestone_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Initiative_Milestone
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
     * @return Orm_Sp_Initiative_Milestone[] | int
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
     * @return Orm_Sp_Initiative_Milestone
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Initiative_Milestone();
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
        $db_params['initiative_id'] = $this->get_initiative_id();
        $db_params['year'] = $this->get_year();
        $db_params['target'] = $this->get_target();

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

    public function set_initiative_id($value)
    {
        $this->add_object_field('initiative_id',$value);
        $this->initiative_id = $value;
    }

    public function get_initiative_id()
    {
        return $this->initiative_id;
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

    public function set_target($value)
    {
        $this->add_object_field('target',$value);
        $this->target = $value;
    }

    public function get_target()
    {
        return $this->target;
    }


}

