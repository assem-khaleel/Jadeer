<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Policies_Procedures_Responsible extends Orm {
    
    /**
    * @var $instances Orm_Policies_Procedures_Responsible[]
    */
    protected static $instances = array();
    protected static $table_name = 'policies_procedures_responsible';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $policies_id = 0;
    protected $role = '';
    protected $responsibilities = '';
    
    /**
    * @return Policies_Procedures_Responsible_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Policies_Procedures_Responsible_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Policies_Procedures_Responsible
    */
    public static function get_instance($id) {
        
        $id = intval($id);
        
        if(isset(self::$instances[$id])) {
            return self::$instances[$id];
        }
        
        return self::get_one(array('id' => $id));
    }
    
    /**
     * @param $policies_id
     * @return Orm_Policies_Procedures_Contacts
     */
    public static function get_policy_instance($policies_id) {

        $policies_id = intval($policies_id);

        if(isset(self::$instances[$policies_id])) {
            return self::$instances[$policies_id];
        }

        return self::get_one(array('policies_id' => $policies_id));
    }
    
    /**
    * Get all rows as Objects
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    *
    * @return Orm_Policies_Procedures_Responsible[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Policies_Procedures_Responsible
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Policies_Procedures_Responsible();
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
    /** convert object to array
     * @param  array $db_params
     * return array
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['policies_id'] = $this->get_policies_id();
        $db_params['role'] = $this->get_role();
        $db_params['responsibilities'] = $this->get_responsibilities();
        
        return $db_params;
    }
    /** save object
     * @param  array $insert_id
     * return int
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
    /**delete object */
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
    
    public function set_policies_id($value) {
        $this->add_object_field('policies_id', $value);
        $this->policies_id = $value;
    }
    
    public function get_policies_id() {
        return $this->policies_id;
    }
    
    public function set_role($value) {
        $this->add_object_field('role', $value);
        $this->role = $value;
    }
    
    public function get_role() {
        return $this->role;
    }
    
    public function set_responsibilities($value) {
        $this->add_object_field('responsibilities', $value);
        $this->responsibilities = $value;
    }
    
    public function get_responsibilities() {
        return $this->responsibilities;
    }

    public static function  get_role_response($policy_id){
        return self::get_all(array('policies_id' => $policy_id));
    }
    
    
}

