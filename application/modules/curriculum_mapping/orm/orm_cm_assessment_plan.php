<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Assessment_Plan extends Orm {
    
    /**
    * @var $instances Orm_Cm_Assessment_Plan[]
    */
    protected static $instances = array();
    protected static $table_name = 'cm_assessment_plan';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $name_ar = '';
    protected $name_en = '';
    protected $course_id = 0;
    
    /**
    * @return Cm_Assessment_Plan_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Assessment_Plan_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Assessment_Plan
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
    * @return Orm_Cm_Assessment_Plan[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Assessment_Plan
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Assessment_Plan();
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
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['name_en'] = $this->get_name_en();
        $db_params['course_id'] = $this->get_course_id();
        
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

    /**
     * get the  assessment method map using assessment plan id
     * @return int|Orm_Cm_Assessment_Plan_Map[]
     */
    public function get_map() {

        return Orm_Cm_Assessment_Plan_Map::get_all(['assessment_plan_id'=>$this->get_id()]);
    }
    
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }

    /**
     * get assessment plan name depends on active language
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_name($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }

        return $this->get_name_en();
    }
    public function set_name_ar($value) {
        $this->add_object_field('name_ar', $value);
        $this->name_ar = $value;
    }
    
    public function get_name_ar() {
        return $this->name_ar;
    }
    
    public function set_name_en($value) {
        $this->add_object_field('name_en', $value);
        $this->name_en = $value;
    }
    
    public function get_name_en() {
        return $this->name_en;
    }
    
    public function set_course_id($value) {
        $this->add_object_field('course_id', $value);
        $this->course_id = $value;
    }
    
    public function get_course_id() {
        return $this->course_id;
    }
    
    
}

