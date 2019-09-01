<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Award extends Orm {
    
    /**
    * @var $instances Orm_Fp_Award[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_award';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $name = '';
    protected $domain = '';
    protected $party = '';
    protected $date = '0000-00-00';
    protected $address = '';
    protected $material_value = '';
    protected $moral_value = '';
    protected $description = '';
    
    /**
    * @return Fp_Award_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Award_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Award
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
    * @return Orm_Fp_Award[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Award
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Award();
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
        $db_params['domain'] = $this->get_domain();
        $db_params['party'] = $this->get_party();
        $db_params['date'] = $this->get_date();
        $db_params['address'] = $this->get_address();
        $db_params['material_value'] = $this->get_material_value();
        $db_params['moral_value'] = $this->get_moral_value();
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
    
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }
    
    public function get_user_id() {
        return $this->user_id;
    }
    
    public function set_name($value) {
        $this->add_object_field('name', $value);
        $this->name = $value;
    }
    
    public function get_name() {
        return $this->name;
    }
    
    public function set_domain($value) {
        $this->add_object_field('domain', $value);
        $this->domain = $value;
    }
    
    public function get_domain() {
        return $this->domain;
    }
    
    public function set_party($value) {
        $this->add_object_field('party', $value);
        $this->party = $value;
    }
    
    public function get_party() {
        return $this->party;
    }
    
    public function set_date($value) {
        $this->add_object_field('date', $value);
        $this->date = $value;
    }
    
    public function get_date() {
        if($this->date=='0000-00-00') {
            $this->date = date('Y').'-1-1';
            return '';

        }
        return $this->date;
    }
    
    public function set_address($value) {
        $this->add_object_field('address', $value);
        $this->address = $value;
    }
    
    public function get_address() {
        return $this->address;
    }
    
    public function set_material_value($value) {
        $this->add_object_field('material_value', $value);
        $this->material_value = $value;
    }
    
    public function get_material_value() {
        return $this->material_value;
    }
    
    public function set_moral_value($value) {
        $this->add_object_field('moral_value', $value);
        $this->moral_value = $value;
    }
    
    public function get_moral_value() {
        return $this->moral_value;
    }
    
    public function set_description($value) {
        $this->add_object_field('description', $value);
        $this->description = $value;
    }
    
    public function get_description() {
        return $this->description;
    }
    
    
}

