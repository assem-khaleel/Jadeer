<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pc_Support_Material extends Orm {
    
    /**
    * @var $instances Orm_Pc_Support_Material[]
    */
    protected static $instances = array();
    protected static $table_name = 'pc_support_material';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $course_id = 0;
    protected $construction_technique_file = null;
    protected $equipment_documentation_file = null;
    protected $computer_documentation_file = null;
    protected $troubleshooting_tip_file = null;
    protected $debugging_tip_file = null;
    protected $addition_ar = '';
    protected $addition_en = '';
    protected $semester_id = 0;
    protected $file_name_ar = '';
    protected $file_name_en = '';
    protected $type = 1;
    
    /**
    * @return Pc_Support_Material_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pc_Support_Material_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pc_Support_Material
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
    * @return Orm_Pc_Support_Material[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pc_Support_Material
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pc_Support_Material();
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
        $db_params['construction_technique_file'] = $this->get_construction_technique_file();
        $db_params['equipment_documentation_file'] = $this->get_equipment_documentation_file();
        $db_params['computer_documentation_file'] = $this->get_computer_documentation_file();
        $db_params['troubleshooting_tip_file'] = $this->get_troubleshooting_tip_file();
        $db_params['debugging_tip_file'] = $this->get_debugging_tip_file();
        $db_params['addition_ar'] = $this->get_addition_ar();
        $db_params['addition_en'] = $this->get_addition_en();
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['file_name_ar'] = $this->get_file_name_ar();
        $db_params['file_name_en'] = $this->get_file_name_en();
        $db_params['type'] = $this->get_type();

//        protected $file_name_ar = '';
//        protected $file_name_en = '';
//        protected $type = 1;

        return $db_params;
    }
    
    public function save() {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_semester_id(Orm_Semester::get_current_semester()->get_id());
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
    
    public function set_construction_technique_file($value) {
        $this->add_object_field('construction_technique_file', $value);
        $this->construction_technique_file = $value;
    }
    
    public function get_construction_technique_file() {
        return $this->construction_technique_file;
    }
    
    public function set_equipment_documentation_file($value) {
        $this->add_object_field('equipment_documentation_file', $value);
        $this->equipment_documentation_file = $value;
    }
    
    public function get_equipment_documentation_file() {
        return $this->equipment_documentation_file;
    }
    
    public function set_computer_documentation_file($value) {
        $this->add_object_field('computer_documentation_file', $value);
        $this->computer_documentation_file = $value;
    }
    
    public function get_computer_documentation_file() {
        return $this->computer_documentation_file;
    }
    
    public function set_troubleshooting_tip_file($value) {
        $this->add_object_field('troubleshooting_tip_file', $value);
        $this->troubleshooting_tip_file = $value;
    }
    
    public function get_troubleshooting_tip_file() {
        return $this->troubleshooting_tip_file;
    }
    
    public function set_debugging_tip_file($value) {
        $this->add_object_field('debugging_tip_file', $value);
        $this->debugging_tip_file = $value;
    }
    
    public function get_debugging_tip_file() {
        return $this->debugging_tip_file;
    }
    
    public function set_addition_ar($value) {
        $this->add_object_field('addition_ar', $value);
        $this->addition_ar = $value;
    }
    
    public function get_addition_ar() {
        return $this->addition_ar;
    }
    
    public function set_addition_en($value) {
        $this->add_object_field('addition_en', $value);
        $this->addition_en = $value;
    }
    
    public function get_addition_en() {
        return $this->addition_en;
    }

    public function get_addition($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_addition_ar();
        }
        return $this->get_addition_en();
    }

    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }
    
    public function get_semester_id() {
        return $this->semester_id;
    }

    public function set_file_name_ar($value) {
        $this->add_object_field('file_name_ar', $value);
        $this->file_name_ar = $value;
    }

    public function get_file_name_ar() {
        return $this->file_name_ar;
    }

    public function set_file_name_en($value) {
        $this->add_object_field('file_name_en', $value);
        $this->file_name_en = $value;
    }

    public function get_file_name_en() {
        return $this->file_name_en;
    }

    public function get_file_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_file_name_ar();
        }
        return $this->get_file_name_en();
    }

    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }

    public function get_type() {
        return $this->type;
    }


    public function has_attachment($fileType){
        $file_exist = false;
        $file = '';
        switch ($fileType) {
            case "construction":
                $file = $this->get_construction_technique_file();
                break;
            case "equipment":
                $file = $this->get_equipment_documentation_file();
                break;
            case "computerDocumentation":
                $file = $this->get_computer_documentation_file();
                break;
            case "troubleshootingTip":
                $file = $this->get_troubleshooting_tip_file();
                break;
            case "debugging":
                $file = $this->get_debugging_tip_file();
                break;
        }
        if ($file !='')
            $file_exist = true;

        return $file_exist;
    }
    
}

