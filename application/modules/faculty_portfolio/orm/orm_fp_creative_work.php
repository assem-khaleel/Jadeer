<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Creative_Work extends Orm {
    
    /**
    * @var $instances Orm_Fp_Creative_Work[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_creative_work';


    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $name = '';
    protected $owner_name = '';
    protected $dissemination_type = 0;
    protected $funds_type = 0;
    protected $funds = 0;
    protected $description = '';
    protected $attachment = 0;

    const Dissemination_Type_1 = 1;
    const Dissemination_Type_2 = 2;

    public static $dissemination_types = array(
        self::Dissemination_Type_1 => 'Exhibition',
        self::Dissemination_Type_2 => 'Used by others',
    );

    const Funds_Type_1 = 1;
    const Funds_Type_2 = 2;

    public static $funds_types = array(
        self::Funds_Type_1 => 'Internal',
        self::Funds_Type_2 => 'External',
    );

    /**
    * @return Fp_Creative_Work_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Creative_Work_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Creative_Work
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
    * @return Orm_Fp_Creative_Work[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Creative_Work
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Creative_Work();
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
        $db_params['owner_name'] = $this->get_owner_name();
        $db_params['dissemination_type'] = $this->get_dissemination_type();
        $db_params['funds_type'] = $this->get_funds_type();
        $db_params['funds'] = $this->get_funds();
        $db_params['description'] = $this->get_description();
        $db_params['attachment'] = $this->get_attachment();

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
    public function set_owner_name($value) {
        $this->add_object_field('owner_name', $value);
        $this->owner_name = $value;
    }

    /**
     * @return string
     */
    public function get_owner_name() {
        return $this->owner_name;
    }

    /**
     * @param $value
     */
    public function set_dissemination_type($value) {
        $this->add_object_field('dissemination_type', $value);
        $this->dissemination_type = $value;
    }

    /**
     * @param bool $to_string
     * @return int|mixed|string
     */
    public function get_dissemination_type($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$dissemination_types[$this->dissemination_type]) ? self::$dissemination_types[$this->dissemination_type] : '');
        }

        return $this->dissemination_type;
    }

    /**
     * @param $value
     */
    public function set_funds_type($value) {
        $this->add_object_field('funds_type', $value);
        $this->funds_type = $value;
    }

    /**
     * @param bool $to_string
     * @return int|mixed|string
     */
    public function get_funds_type($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$funds_types[$this->funds_type]) ? self::$funds_types[$this->funds_type] : '');
        }

        return $this->funds_type;
    }

    /**
     * @param $value
     */
    public function set_funds($value) {
        $this->add_object_field('funds', $value);
        $this->funds = $value;
    }

    /**
     * @return int
     */
    public function get_funds() {
        return $this->funds;
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

    /**
     * @param $value
     */
    public function set_attachment($value) {
        $this->add_object_field('attachment', $value);
        $this->attachment = $value;
    }

    /**
     * @return int
     */
    public function get_attachment() {
        return $this->attachment;
    }
}

