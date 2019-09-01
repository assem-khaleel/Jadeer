<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Risk_Tab extends Orm
{

    /**
     * @var $instances Orm_Sp_Risk_Tab[]
     */
    protected static $instances = array();
    protected static $table_name = 'sp_risk_tab';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $type_id = 0;
    protected $class_type = '';
    protected $risk = '';
    protected $impact = '';

    /**
     * @return Sp_Risk_Tab_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Sp_Risk_Tab_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Sp_Risk_Tab
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
     * @return Orm_Sp_Risk_Tab[] | int
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
     * @return Orm_Sp_Risk_Tab
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Sp_Risk_Tab();
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
        $db_params['type_id'] = $this->get_type_id();
        $db_params['class_type'] = $this->get_class_type();
        $db_params['risk'] = $this->get_risk();
        $db_params['impact'] = $this->get_impact();

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

    public function set_type_id($value)
    {
        $this->add_object_field('type_id',$value);
        $this->type_id = $value;
    }

    public function get_type_id()
    {
        return $this->type_id;
    }

    public function set_class_type($value)
    {
        $this->add_object_field('class_type',$value);
        $this->class_type = $value;
    }

    public function get_class_type()
    {
        return $this->class_type;
    }

    public function set_risk($value)
    {
        $this->add_object_field('risk',$value);
        $this->risk = $value;
    }

    public function get_risk()
    {
        return $this->risk;
    }

    public function set_impact($value)
    {
        $this->add_object_field('impact',$value);
        $this->impact = $value;
    }

    public function get_impact()
    {
        return $this->impact;
    }


}

