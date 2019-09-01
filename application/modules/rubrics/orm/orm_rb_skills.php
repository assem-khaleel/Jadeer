<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rb_Skills extends Orm {
    
    /**
    * @var $instances Orm_Rb_Skills[]
    */
    protected static $instances = array();
    protected static $table_name = 'rb_skills';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $rubrics_id = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $value = 0;
    protected $extra_data = '';
    protected $date_added = 0;
    protected $date_modified = 0;
    protected $is_deleted = 0;
    
    /**
    * @return Rb_Skills_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Rb_Skills_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Rb_Skills
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
    * @return Orm_Rb_Skills[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Rb_Skills
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Rb_Skills();
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
        $db_params['rubrics_id'] = $this->get_rubrics_id();
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['value'] = $this->get_value();
        $db_params['extra_data'] = $this->get_extra_data();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['date_modified'] = $this->get_date_modified();
        $db_params['is_deleted'] = $this->get_is_deleted();
        
        return $db_params;
    }
    
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
    
    public function set_rubrics_id($value) {
        $this->add_object_field('rubrics_id', $value);
        $this->rubrics_id = $value;
    }
    
    public function get_rubrics_id() {
        return $this->rubrics_id;
    }
    
    public function set_name_en($value) {
        $this->add_object_field('name_en', $value);
        $this->name_en = $value;
    }
    
    public function get_name_en() {
        return $this->name_en;
    }
    
    public function set_name_ar($value) {
        $this->add_object_field('name_ar', $value);
        $this->name_ar = $value;
    }
    
    public function get_name_ar() {
        return $this->name_ar;
    }
    
    public function set_extra_data($value) {
        $this->add_object_field('extra_data', $value);
        $this->extra_data = $value;
    }
    
    public function get_extra_data() {
        return $this->extra_data;
    }
    
    public function set_date_added($value) {
        $this->add_object_field('date_added', $value);
        $this->date_added = $value;
    }
    
    public function get_date_added() {
        return $this->date_added;
    }
    
    public function set_date_modified($value) {
        $this->add_object_field('date_modified', $value);
        $this->date_modified = $value;
    }
    
    public function get_date_modified() {
        return $this->date_modified;
    }
    
    public function set_is_deleted($value) {
        $this->add_object_field('is_deleted', $value);
        $this->is_deleted = $value;
    }
    
    public function get_is_deleted() {
        return $this->is_deleted;
    }

    public function get_value() {
        return $this->value;
    }

    public function set_value($value) {
        $this->add_object_field('value', $value);
        $this->value = $value;
    }
    /**
     * this function get rubric obj
     * @return Orm_Rb_Rubrics the object call function
     */
    public function get_rubric_obj() {
        return Orm_Rb_Rubrics::get_instance($this->get_rubrics_id());
    }

    public function get_name($lang = UI_LANG) {
        if($lang=='arabic'){
            return $this->get_name_ar();
        }

        return $this->get_name_en();
    }

}

