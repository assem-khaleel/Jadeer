<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Reason_Action_Plan extends Orm
{

    /**
     * @var $instances Orm_Sp_Reason_Action_Plan[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_reason_action_plan';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $overall_id = 0;
    protected $reason_type = '';
    protected $content = '';

    /**
     * @return Sp_Reason_Action_Plan_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Reason_Action_Plan_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Reason_Action_Plan
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
     * @return Orm_Sp_Reason_Action_Plan[] | int
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
     * @return Orm_Sp_Reason_Action_Plan
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Reason_Action_Plan();
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
        $db_params['overall_id'] = $this->get_overall_id();
        $db_params['reason_type'] = $this->get_reason_type();
        $db_params['content'] = $this->get_content();

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

    public function set_overall_id($value)
    {
        $this->add_object_field('overall_id',$value);
        $this->overall_id = $value;
    }

    public function get_overall_id()
    {
        return $this->overall_id;
    }

    public function set_reason_type($value)
    {
        $this->add_object_field('reason_type',$value);
        $this->reason_type = $value;
    }

    public function get_reason_type()
    {
        return $this->reason_type;
    }

    public function set_content($value)
    {
        $this->add_object_field('content',$value);
        $this->content = $value;
    }

    public function get_content()
    {
        return $this->content;
    }

    /**
     * @return Orm_Sp_Overall_Action_Plan
     */
    public function get_overall_obj() {
        return Orm_Sp_Overall_Action_Plan::get_instance($this->get_overall_id());
    }

}

