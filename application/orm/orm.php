<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class Orm
{

    const FETCH_COUNT = 0;
    const FETCH_ARRAY = 1;
    const FETCH_OBJECT = 2;
    const FETCH_OBJECTS = 3;
    const FETCH_ROW = 4;

    private $unique_hash;
    private $object_fields = array();
    private $object_status = 'new';

    private static $integration_mode = false;

    public function __construct()
    {
        $this->unique_hash = uniqid();
    }

    public function get_unique_hash()
    {
        return $this->unique_hash;
    }

    public static function get_ci_model($model, $dir = '')
    {

        if ($dir) {
            $dir .= '/';
        }

        $ci = Orm::get_ci();

        if (empty($ci->$model)) {
            $ci->load->model($dir . $model, $model);
        }

        return $ci->$model;
    }

    /**
     * @return CI_Controller
     */
    public static function get_ci()
    {
        $ci = &get_instance();
        return $ci;
    }

    protected function get_object_fields() {
        return $this->object_fields;
    }

    protected function add_object_field($field_name, $field_value) {
        if($this->$field_name != $field_value) {
            $this->object_fields[$field_name] = $field_value;
        }
    }

    protected function get_object_field($field_name) {
        return isset($this->object_fields[$field_name]) ? $this->object_fields[$field_name] : null;
    }

    protected function check_object_field($field_name) {
        return isset($this->object_fields[$field_name]) ? true : false;
    }

    protected function reset_object_fields() {
        $this->object_fields = array();
    }

    protected function set_object_status($status){
        $this->object_status = $status;
    }

    protected function get_object_status(){
        return $this->object_status;
    }

    public static function integration_mode() {
        if(is_cli()) {
            self::$integration_mode = true;
        }
    }

    public static function is_integration_mode() {
        return self::$integration_mode;
    }

    /**
     * get table name
     */
    public static function get_table_name() {

        if(!empty(static::$table_name)){
            return static::$table_name;
        }

        return str_replace("orm_", '', strtolower(static::class));
    }

    /**
     * push instance
     */
    protected function push_instance() {
        if ($this->id) {
            static::$instances[$this->id] = $this;
        }
    }

    /**
     * pull_instance
     *
     * @param array $row
     * @return array (boolean, object)
     */
    protected static function pull_instance($row) {

        $id = intval(isset($row['id']) ? $row['id'] : 0);

        if(isset(static::$instances[$id])) {
            return static::$instances[$id];
        }

        return null;
    }

    public static function to_object($array, $class_name = null)
    {

        if (empty($array)) {
            return null;
        }

        $object = static::pull_instance($array);

        if (is_null($object)) {

            if (is_null($class_name)) {
                $object = new static();
            } else {
                if (class_exists($class_name)) {
                    $object = new $class_name();
                } else {
                    return null;
                }
            }

            foreach ($array as $key => $value) {
                $function = "set_{$key}";
                if (method_exists($object, $function)) {
                    $object->$function($value);
                } else {
                    $object->$key = $value;
                }
            }
        }

        $object->set_object_status('old');
        $object->reset_object_fields();
        return $object;
    }

}