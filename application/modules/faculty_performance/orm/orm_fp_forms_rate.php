<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Forms_Rate extends Orm {

    /**
     * @var $instances Orm_Fp_Forms_Rate[]
     */
    protected static $instances = array();
    protected static $table_name = 'fp_forms_rate';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $deadline_id = 0;
    protected $type_id = 0;
    protected $rate = 0;
    protected $created_at = '0000-00-00 00:00:00';
    protected $updated_at = '0000-00-00 00:00:00';
    protected $deleted_at = 0;

    /**
     * @return Fp_Forms_Rate_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Forms_Rate_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Fp_Forms_Rate
     */
    public static function get_instance($id) {

        $id = intval($id);

        if(isset(self::$instances[$id])) {
            return self::$instances[$id];
        }

        return self::get_one(array('id' => $id));
    }

    /**
     * @param $type_id
     * @param $deadline
     * @return Orm_Fp_Forms_Rate
     */
    public static function get_rate_by_type($type_id, $deadline) {

        $type_id = intval($type_id);

        return self::get_one(array('type_id' => $type_id,'deadline_id'=> $deadline));
    }

    /**
     * @param $type_id
     * @return Orm_Fp_Forms_Rate
     */
    public static function get_type_instance($type_id) {

        $type_id = intval($type_id);

        if(isset(self::$instances[$type_id])) {
            return self::$instances[$type_id];
        }
        
        return self::get_one(array('type_id' => $type_id));
    }


    /**
     * Get all rows as Objects
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     *
     * @return Orm_Fp_Forms_Rate[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    public static function get_sum_by_deadline($deadline=-1,$type_id) {
        return self::get_model()->get_sum_by_deadline($deadline,$type_id);
    }
    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Fp_Forms_Rate
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Fp_Forms_Rate();
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

    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['deadline_id'] = $this->get_deadline_id();
        $db_params['type_id'] = $this->get_type_id();
        $db_params['rate'] = $this->get_rate();
        $db_params['deleted_at'] = $this->get_deleted_at();
        $db_params['created_at'] = $this->get_created_at();
        $db_params['updated_at'] = $this->get_updated_at();
        return $db_params;
    }

    public function save() {
        $this->set_updated_at(date('Y-m-d H:i:s'));
        if ($this->get_object_status() == 'new') {
            $this->set_created_at(date('Y-m-d H:i:s'));
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete() {
        return self::get_model()->delete($this->get_id());
    }

    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;

        $this->push_instance();
    }

    public function get_id() {
        return $this->id;
    }

    public function set_deadline_id($value) {
        $this->add_object_field('deadline_id', $value);
        $this->deadline_id = $value;
    }

    public function get_deadline_id() {
        return $this->deadline_id;
    }

    public function set_type_id($value) {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }

    public function get_type_id() {
        return $this->type_id;
    }

    public function set_rate($value) {
        $this->add_object_field('rate', $value);
        $this->rate = $value;
    }

    public function get_rate() {
        return $this->rate;
    }

    public function set_created_at($value) {
        $this->add_object_field('created_at', $value);
        $this->created_at = $value;
    }

    public function get_created_at() {
        return $this->created_at;
    }

    public function set_updated_at($value) {
        $this->add_object_field('updated_at', $value);
        $this->updated_at = $value;
    }

    public function get_updated_at() {
        return $this->updated_at;
    }

    public function set_deleted_at($value) {
        $this->add_object_field('deleted_at', $value);
        $this->deleted_at = $value;
    }

    public function get_deleted_at() {
        return $this->deleted_at;
    }

    /**
     *change the value for input " is_delete" from 0 to one
     */
    public function soft_delete()
    {
        $this->set_deleted_at(1);
        $this->save();
    }

}

