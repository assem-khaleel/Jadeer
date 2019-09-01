<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Training extends Orm {
    
    /**
    * @var $instances Orm_Fp_Training[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_training';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $title = '';
    protected $date = '0000-00-00';
    protected $duration = '';
    protected $address = '';
    protected $description = '';
    
    /**
    * @return Fp_Training_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Training_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Training
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
    * @return Orm_Fp_Training[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Training
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Training();
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

    /**
     * @return array
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['user_id'] = $this->get_user_id();
        $db_params['title'] = $this->get_title();
        $db_params['date'] = $this->get_date();
        $db_params['duration'] = $this->get_duration();
        $db_params['address'] = $this->get_address();
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
    public function set_title($value) {
        $this->add_object_field('title', $value);
        $this->title = $value;
    }

    /**
     * @return string
     */
    public function get_title() {
        return $this->title;
    }

    /**
     * @param $value
     */
    public function set_date($value) {
        $this->add_object_field('date', $value);
        $this->date = $value;
    }

    /**
     * @return string
     */
    public function get_date() {
        return $this->date;
    }

    /**
     * @param $value
     */
    public function set_duration($value) {
        $this->add_object_field('duration', $value);
        $this->duration = $value;
    }

    /**
     * @return string
     */
    public function get_duration() {
        return $this->duration;
    }

    /**
     * @param $value
     */
    public function set_address($value) {
        $this->add_object_field('address', $value);
        $this->address = $value;
    }

    /**
     * @return string
     */
    public function get_address() {
        return $this->address;
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

