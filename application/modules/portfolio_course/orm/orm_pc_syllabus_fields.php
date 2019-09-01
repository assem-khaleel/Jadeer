<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pc_Syllabus_Fields extends Orm {
    
    /**
    * @var $instances Orm_Pc_Syllabus_Fields[]
    */
    protected static $instances = array();
    protected static $table_name = 'pc_syllabus_fields';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $category_id = 0;
    protected $course_id = 0;
    protected $title_ar = '';
    protected $title_en = '';
    protected $description_ar = '';
    protected $description_en = '';
    protected $field_type='';
    protected $value = '';
    protected $deleted = '';
    protected $required = '';
    protected $display = '';
    protected $create_date = '0000-00-00 00:00:00';
    protected $update_date = '0000-00-00 00:00:00';
    protected $created_by = 0;
    protected $updated_by = 0;
    
    /**
    * @return Pc_Syllabus_Fields_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pc_Syllabus_Fields_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pc_Syllabus_Fields
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
    * @return Orm_Pc_Syllabus_Fields[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pc_Syllabus_Fields
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pc_Syllabus_Fields();
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
    
        $db_params['category_id'] = $this->get_category_id();
        $db_params['course_id'] = $this->get_course_id();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['description_ar'] = $this->get_description_ar();
        $db_params['description_en'] = $this->get_description_en();
        $db_params['field_type'] = $this->get_field_type();
        $db_params['value'] = $this->get_value();
        $db_params['create_date'] = $this->get_create_date();
        $db_params['update_date'] = $this->get_update_date();
        $db_params['created_by'] = $this->get_created_by();
        $db_params['updated_by'] = $this->get_updated_by();
        $db_params['deleted'] = $this->get_deleted();
        $db_params['required'] = $this->get_required();
        $db_params['display'] = $this->get_display();
        
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
    
    public function set_field_type($value) {
        $this->add_object_field('field_type', $value);
        $this->field_type = $value;
        
        $this->push_instance();
    }
    
    public function get_field_type() {
        return $this->field_type;
    }
    
    public function set_category_id($value) {
        $this->add_object_field('category_id', $value);
        $this->category_id = $value;
        
        $this->push_instance();
    }
    
    public function get_category_id() {
        return $this->category_id;
    }
    
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_course_id($value) {
        $this->add_object_field('course_id', $value);
        $this->course_id = $value;
    }
    
    public function get_course_id() {
        return $this->course_id;
    }
    
    public function set_title_ar($value) {
        $this->add_object_field('title_ar', $value);
        $this->title_ar = $value;
    }
    
    public function get_title_ar() {
        return $this->title_ar;
    }
    
    public function set_title_en($value) {
        $this->add_object_field('title_en', $value);
        $this->title_en = $value;
    }
    
    public function get_title_en() {
        return $this->title_en;
    }

    public function get_title($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_title_ar();
        }
        return $this->get_title_en();
    }

    public function set_description_ar($value) {
        $this->add_object_field('description_ar', $value);
        $this->description_ar = $value;
    }
    
    public function get_description_ar() {
        return $this->description_ar;
    }
    
    public function set_description_en($value) {
        $this->add_object_field('description_en', $value);
        $this->description_en = $value;
    }
    
    public function get_description_en() {
        return $this->description_en;
    }

    public function get_description($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_description_ar();
        }
        return $this->get_description_en();
    }

    public function set_create_date($value) {
        $this->add_object_field('create_date', $value);
        $this->create_date = $value;
    }
    
    public function get_create_date() {
        return $this->create_date;
    }
    
    public function set_update_date($value) {
        $this->add_object_field('update_date', $value);
        $this->update_date = $value;
    }
    
    public function get_update_date() {
        return $this->update_date;
    }
    
    public function set_created_by($value) {
        $this->add_object_field('created_by', $value);
        $this->created_by = $value;
    }
    
    public function get_created_by() {
        return $this->created_by;
    }
    
    public function set_updated_by($value) {
        $this->add_object_field('updated_by', $value);
        $this->updated_by = $value;
    }
    
    public function get_updated_by() {
        return $this->updated_by;
    }
    
    public function set_deleted($value) {
        $this->add_object_field('deleted', $value);
        $this->deleted = $value;
    }
    
    public function get_deleted() {
        return $this->deleted;
    }
    
    public function set_required($value) {
        $this->add_object_field('required', $value);
        $this->required = $value;
    }
    
    public function get_required() {
        return $this->required;
    }
    
    public function set_display($value) {
        $this->add_object_field('display', $value);
        $this->display = $value;
    }
    
    public function get_display() {
        return $this->display;
    }
    
    public function set_value($value) {
        $this->add_object_field('value', $value);
        $this->value = $value;
    }
    
    public function get_value() {
        return $this->value;
    }
}

