<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Policies_Procedures_Files extends Orm {
    
    /**
    * @var $instances Orm_Policies_Procedures_Files[]
    */
    protected static $instances = array();
    protected static $table_name = 'policies_procedures_files';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $policy_id = 0;
    protected $form_name_en = '';
    protected $form_name_ar = '';
    protected $file_path = '';
    
    /**
    * @return Policies_Procedures_Files_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Policies_Procedures_Files_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Policies_Procedures_Files
    */
    public static function get_instance($id) {
        
        $id = intval($id);
        
        if(isset(self::$instances[$id])) {
            return self::$instances[$id];
        }
        
        return self::get_one(array('id' => $id));
    }
    
    /**
    * Get all rows as Objects
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    *
    * @return Orm_Policies_Procedures_Files[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Policies_Procedures_Files
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Policies_Procedures_Files();
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
        $db_params['policy_id'] = $this->get_policy_id();
        $db_params['form_name_en'] = $this->get_form_name_en();
        $db_params['form_name_ar'] = $this->get_form_name_ar();
        $db_params['file_path'] = $this->get_file_path();
        
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
    
    public function set_policy_id($value) {
        $this->add_object_field('policy_id', $value);
        $this->policy_id = $value;
    }
    
    public function get_policy_id() {
        return $this->policy_id;
    }
    
    public function set_form_name_en($value) {
        $this->add_object_field('form_name_en', $value);
        $this->form_name_en = $value;
    }
    
    public function get_form_name_en() {
        return $this->form_name_en;
    }
    
    public function set_form_name_ar($value) {
        $this->add_object_field('form_name_ar', $value);
        $this->form_name_ar = $value;
    }
    
    public function get_form_name_ar() {
        return $this->form_name_ar;
    }
    
    public function set_file_path($value) {
        $this->add_object_field('file_path', $value);
        $this->file_path = $value;
    }
    
    public function get_file_path() {
        return $this->file_path;
    }

    public function get_title($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_form_name_ar();
        }
        return $this->get_form_name_en();
    }
}

