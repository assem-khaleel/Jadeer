<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Node_Log extends Orm
{

    /**
     * @var $instances Orm_Node_Log[]
     */
    protected static $instances = array();
    protected static $table_name = 'node_log';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $logged_user_id = 0;
    protected $date_added = '0000-00-00 00:00:00';
    protected $node_id = 0;
    protected $node_parent_id = 0;
    protected $node_item_id = 0;
    protected $node_system_number = 0;
    protected $node_year = 0;
    protected $node_name = '';
    protected $node_class_type = '';
    protected $node_date_added = '0000-00-00 00:00:00';
    protected $node_is_deleted = 0;
    protected $node_is_finished = 0;
    protected $node_due_date = '0000-00-00 00:00:00';
    protected $node_review_status = 'none';
    protected $node_properties = '';

    /**
     * @return Node_Log_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Node_Log_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Node_Log
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
     * @return Orm_Node_Log[] | int
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
     * @return Orm_Node_Log
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Node_Log();
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
        $db_params['logged_user_id'] = $this->get_logged_user_id();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['node_id'] = $this->get_node_id();
        $db_params['node_parent_id'] = $this->get_node_parent_id();
        $db_params['node_item_id'] = $this->get_node_item_id();
        $db_params['node_system_number'] = $this->get_node_system_number();
        $db_params['node_year'] = $this->get_node_year();
        $db_params['node_name'] = $this->get_node_name();
        $db_params['node_class_type'] = $this->get_node_class_type();
        $db_params['node_date_added'] = $this->get_node_date_added();
        $db_params['node_is_deleted'] = $this->get_node_is_deleted();
        $db_params['node_is_finished'] = $this->get_node_is_finished();
        $db_params['node_due_date'] = $this->get_node_due_date();
        $db_params['node_review_status'] = $this->get_node_review_status();
        $db_params['node_properties'] = $this->get_node_properties();

        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $this->set_date_added(date('Y-m-d H:i:s'));

            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        self::get_model()->delete_log($this->get_id());

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
        $this->id = (int) $value;
        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_logged_user_id($value)
    {
        $this->add_object_field('logged_user_id',$value);
        $this->logged_user_id = (int) $value;
    }

    public function get_logged_user_id()
    {
        return $this->logged_user_id;
    }

    public function set_date_added($value)
    {
        $this->add_object_field('date_added',$value);
        $this->date_added = $value;
    }

    public function get_date_added()
    {
        return $this->date_added;
    }

    public function set_node_id($value)
    {
        $this->add_object_field('node_id',$value);
        $this->node_id = (int) $value;
    }

    public function get_node_id()
    {
        return $this->node_id;
    }

    public function set_node_parent_id($value)
    {
        $this->add_object_field('node_parent_id',$value);
        $this->node_parent_id = (int) $value;
    }

    public function get_node_parent_id()
    {
        return $this->node_parent_id;
    }

    public function set_node_item_id($value)
    {
        $this->add_object_field('node_item_id',$value);
        $this->node_item_id = (int) $value;
    }

    public function get_node_item_id()
    {
        return $this->node_item_id;
    }

    public function set_node_system_number($value)
    {
        $this->add_object_field('node_system_number',$value);
        $this->node_system_number = $value;
    }

    public function get_node_system_number()
    {
        return $this->node_system_number;
    }

    public function set_node_year($value)
    {
        $this->add_object_field('node_year',$value);
        $this->node_year = $value;
    }

    public function get_node_year()
    {
        return $this->node_year;
    }

    public function set_node_name($value)
    {
        $this->add_object_field('node_name',$value);
        $this->node_name = $value;
    }

    public function get_node_name()
    {
        return $this->node_name;
    }

    public function set_node_class_type($value)
    {
        $this->add_object_field('node_class_type',$value);
        $this->node_class_type = $value;
    }

    public function get_node_class_type()
    {
        return $this->node_class_type;
    }

    public function set_node_date_added($value)
    {
        $this->add_object_field('node_date_added',$value);
        $this->node_date_added = $value;
    }

    public function get_node_date_added()
    {
        return $this->node_date_added;
    }

    public function set_node_is_deleted($value)
    {
        $this->add_object_field('node_is_deleted',$value);
        $this->node_is_deleted = (int) $value;
    }

    public function get_node_is_deleted()
    {
        return $this->node_is_deleted;
    }

    public function set_node_is_finished($value)
    {
        $this->add_object_field('node_is_finished',$value);
        $this->node_is_finished = (int) $value;
    }

    public function get_node_is_finished()
    {
        return $this->node_is_finished;
    }

    public function set_node_due_date($value)
    {
        $this->add_object_field('node_due_date',$value);
        $this->node_due_date = $value;
    }

    public function get_node_due_date()
    {
        return $this->node_due_date;
    }

    public function set_node_review_status($value)
    {
        $this->add_object_field('node_review_status',$value);
        $this->node_review_status = $value;
    }

    public function get_node_review_status()
    {
        return $this->node_review_status;
    }

    public function set_node_properties($value)
    {
        $this->add_object_field('node_properties',$value);
        $this->node_properties = $value;
    }

    public function get_node_properties()
    {
        return $this->node_properties;
    }

    /**
     * @return Orm_User
     */
    public function get_user_obj()
    {
        return Orm_User::get_instance($this->get_logged_user_id());
    }

    /**
     * @param Orm_Node $node
     * @return Orm_Node_Log
     */
    public static function add_log(Orm_Node $node)
    {

        $log = new Orm_Node_Log();
        $log->set_logged_user_id(Orm_User::get_logged_user()->get_id());

        $log->set_node_id($node->get_id());
        $log->set_node_parent_id($node->get_parent_id());
        $log->set_node_item_id($node->get_item_id());
        $log->set_node_year($node->get_year());
        $log->set_node_system_number($node->get_system_number());
        $log->set_node_name($node->get_name());
        $log->set_node_class_type($node->get_class_type());
        $log->set_node_properties(json_encode($node->get_properties_as_array()));
        $log->set_node_date_added($node->get_date_added());
        $log->set_node_is_finished($node->get_is_finished());
        $log->set_node_is_deleted($node->get_is_deleted());
        $log->set_node_due_date($node->get_due_date());
        $log->set_node_review_status($node->get_review_status());

        $log->save();
        return $log;
    }

    /**
     * @return Orm_Node
     */
    public function get_node_obj()
    {

        $class_name = $this->get_node_class_type();
        if (class_exists($class_name)) {
            $object = new $class_name();
            /* @var $object Orm_Node */
            $object->set_id($this->get_node_id());
            $object->set_parent_id($this->get_node_parent_id());
            $object->set_year($this->get_node_year());
            $object->set_due_date($this->get_node_due_date());
            $object->set_system_number($this->get_node_system_number());
            $object->set_item_id($this->get_node_item_id());
            $object->set_name($this->get_node_name());
            $object->set_class_type($this->get_node_class_type());
            $object->set_properties($this->get_node_properties());
            $object->set_date_added($this->get_node_date_added());
            $object->set_is_finished($this->get_node_is_finished());
            $object->set_is_deleted($this->get_node_is_deleted());
            $object->set_review_status($this->get_node_review_status());

            return $object;
        }

        return null;
    }

    public static function get_progress($user_id = 0) {
        return self::get_model()->get_progress($user_id);
    }
}

