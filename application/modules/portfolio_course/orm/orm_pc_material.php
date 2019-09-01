<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pc_Material extends Orm {
    
    /**
    * @var $instances Orm_Pc_Material[]
    */
    protected static $instances = array();
    protected static $table_name = 'pc_material';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $course_id = 0;
    protected $title_ar = '';
    protected $title_en = '';
    protected $description_ar = '';
    protected $description_en = '';
    protected $material_type = 0;
    protected $material_location = '';
    protected $semester_id = 0;
    protected $author = '';
    protected $release_date = '0000-00-00 00:00:00';
    protected $edition = '';
    protected $publisher = '';
    
    /**
    * @return Pc_Material_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pc_Material_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pc_Material
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
    * @return Orm_Pc_Material[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pc_Material
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pc_Material();
    }



    public static function get_types() {
        return [
            1=>'Required Material',
            'Recommended Material',
            'Support Material'
        ];
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
        $db_params['course_id'] = $this->get_course_id();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['description_ar'] = $this->get_description_ar();
        $db_params['description_en'] = $this->get_description_en();
        $db_params['material_type'] = $this->get_material_type();
        $db_params['material_location'] = $this->get_material_location();
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['author'] = $this->get_author();
        $db_params['release_date'] = $this->get_release_date();
        $db_params['edition'] = $this->get_edition();
        $db_params['publisher'] = $this->get_publisher();
        
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

    public function set_material_type($value) {
        $this->add_object_field('material_type', $value);
        $this->material_type = $value;
    }
    
    public function get_material_type() {
        return $this->material_type;
    }
    
    public function set_material_location($value) {
        $this->add_object_field('material_location', $value);
        $this->material_location = $value;
    }
    
    public function get_material_location() {
        return $this->material_location;
    }
    
    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }
    
    public function get_semester_id() {
        return $this->semester_id;
    }
    
    public function set_author($value) {
        $this->add_object_field('author', $value);
        $this->author = $value;
    }
    
    public function get_author() {
        return $this->author;
    }
    
    public function set_release_date($value) {
        $this->add_object_field('release_date', $value);
        $this->release_date = $value;
    }
    
    public function get_release_date() {
        return $this->release_date;
    }
    
    public function set_edition($value) {
        $this->add_object_field('edition', $value);
        $this->edition = $value;
    }
    
    public function get_edition() {
        return $this->edition;
    }
    
    public function set_publisher($value) {
        $this->add_object_field('publisher', $value);
        $this->publisher = $value;
    }
    
    public function get_publisher() {
        return $this->publisher;
    }
    
    
}

