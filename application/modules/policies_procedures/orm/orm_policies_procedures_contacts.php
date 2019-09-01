<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Policies_Procedures_Contacts extends Orm {
    
    /**
    * @var $instances Orm_Policies_Procedures_Contacts[]
    */
    protected static $instances = array();
    protected static $table_name = 'policies_procedures_contacts';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $policies_id = 0;
    protected $title = '';
    protected $contact_name = '';
    protected $phone = '';
    protected $mail = '';
    
    /**
    * @return Policies_Procedures_Contacts_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Policies_Procedures_Contacts_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Policies_Procedures_Contacts
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
    * @return Orm_Policies_Procedures_Contacts[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Policies_Procedures_Contacts
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Policies_Procedures_Contacts();
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
        $db_params['title'] = $this->get_title();
        $db_params['contact_name'] = $this->get_contact_name();
        $db_params['phone'] = $this->get_phone();
        $db_params['mail'] = $this->get_mail();
        
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
    /** delete object
     */
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
    
    public function set_title($value) {
        $this->add_object_field('title', $value);
        $this->title = $value;
    }
    
    public function get_title() {
        return $this->title;
    }
    
    public function set_contact_name($value) {
        $this->add_object_field('contact_name', $value);
        $this->contact_name = $value;
    }
    
    public function get_contact_name() {
        return $this->contact_name;
    }
    
    public function set_phone($value) {
        $this->add_object_field('phone', $value);
        $this->phone = $value;
    }
    
    public function get_phone() {
        return $this->phone;
    }
    
    public function set_mail($value) {
        $this->add_object_field('mail', $value);
        $this->mail = $value;
    }
    
    public function get_mail() {
        return $this->mail;
    }
    
    
}

