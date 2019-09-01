<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Committee extends Orm {
    
    /**
    * @var $instances Orm_Fp_Committee[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_committee';


    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $name = '';
    protected $start_date = '0000-00-00';
    protected $end_date = '0000-00-00';
    
    /**
    * @return Fp_Committee_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Committee_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Committee
    */
    public static function get_instance($id) {
        
        $id = intval($id);
        if(isset(self::$instances[$id])) {
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
    * @return Orm_Fp_Committee[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Committee
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Committee();
    }

    /**
     * get count
     *
     * @param array $filters
     * @return array
     */
    public static function get_count($filters = array()) {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }

    /**
     * @return array
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['user_id'] = $this->get_user_id();
        $db_params['name'] = $this->get_name();
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        
        return $db_params;
    }

    /**
     * @return int
     */
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

    /**
     * @return bool
     */
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }

    /**
     * @param $value
     */
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        $this->push_instance();
    }

    /**
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * @param $value
     */
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }

    /**
     * @return int
     */
    public function get_user_id() {
        return $this->user_id;
    }

    /**
     * @param $value
     */
    public function set_name($value) {
        $this->add_object_field('name', $value);
        $this->name = $value;
    }

    /**
     * @return string
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * @param $value
     */
    public function set_start_date($value) {
        $this->add_object_field('start_date', $value);
        $this->start_date = $value;
    }

    /**
     * @return string
     */
    public function get_start_date() {
        return $this->start_date;
    }

    /**
     * @param $value
     */
    public function set_end_date($value) {
        $this->add_object_field('end_date', $value);
        $this->end_date = $value;
    }

    /**
     * @return string
     */
    public function get_end_date() {
        return $this->end_date;
    }
}

