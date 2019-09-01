<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Action_Plan_Recommend extends Orm
{

    /**
     * @var $instances Orm_Sp_Action_Plan_Recommend[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_action_plan_recommend';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $action_plan_id = 0;
    protected $recommend_id = 0;


    /**
     * @return Sp_Action_Plan_Recommend_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Action_Plan_Recommend_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Action_Plan_Recommend
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
     * @return Orm_Sp_Action_Plan_Recommend[] | int
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
     * @return Orm_Sp_Action_Plan_Recommend
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Action_Plan_Recommend();
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
        $db_params['action_plan_id'] = $this->get_action_plan_id();
        $db_params['recommend_id'] = $this->get_recommend_id();

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

    public function set_action_plan_id($value)
    {
        $this->add_object_field('action_plan_id',$value);
        $this->action_plan_id = $value;
    }

    public function get_action_plan_id()
    {
        return $this->action_plan_id;
    }

    public function set_recommend_id($value)
    {
        $this->add_object_field('recommend_id',$value);
        $this->recommend_id = $value;
    }

    public function get_recommend_id()
    {
        return $this->recommend_id;
    }
    /**
     * this function get recommendation obj
     * @return Orm_Sp_Recommendation the object call function
     */
    public function get_recommendation_obj() {
        return Orm_Sp_Recommendation::get_instance($this->get_recommend_id());
    }
}

