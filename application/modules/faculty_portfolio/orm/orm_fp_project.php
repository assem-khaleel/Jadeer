<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Project extends Orm {
    
    /**
    * @var $instances Orm_Fp_Project[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_project';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $name = '';
    protected $date_from = '0000-00-00';
    protected $date_to = '0000-00-00';
    protected $location = '';
    protected $membership = '';
    protected $description = '';
    
    /**
    * @return Fp_Project_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Project_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Project
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
    * @return Orm_Fp_Project[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Project
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Project();
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
        $db_params['date_from'] = $this->get_date_from();
        $db_params['date_to'] = $this->get_date_to();
        $db_params['location'] = $this->get_location();
        $db_params['membership'] = $this->get_membership();
        $db_params['description'] = $this->get_description();
        
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
    public function set_date_from($value) {
        $this->add_object_field('date_from', $value);
        $this->date_from = $value;
    }

    /**
     * @return string
     */
    public function get_date_from() {
        return $this->date_from;
    }

    /**
     * @param $value
     */
    public function set_date_to($value) {
        $this->add_object_field('date_to', $value);
        $this->date_to = $value;
    }

    /**
     * @return string
     */
    public function get_date_to() {
        return $this->date_to;
    }

    /**
     * @param $value
     */
    public function set_location($value) {
        $this->add_object_field('location', $value);
        $this->location = $value;
    }

    /**
     * @return string
     */
    public function get_location() {
        return $this->location;
    }

    /**
     * @param $value
     */
    public function set_membership($value) {
        $this->add_object_field('membership', $value);
        $this->membership = $value;
    }

    /**
     * @return string
     */
    public function get_membership() {
        return $this->membership;
    }

    /**
     * @param $value
     */
    public function set_description($value) {
        $this->add_object_field('description', $value);
        $this->description = $value;
    }

    /**
     * @return string
     */
    public function get_description() {
        return $this->description;
    }
    
    
}

