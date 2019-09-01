<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Active_Data extends Orm {
    
    protected static $table_name = 'cm_active_data';
    
    /**
    * @var $instances Orm_Cm_Active_Data[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $semester_id = 0;
    protected $type_id = 0;
    protected $type = 0;
    protected $is_archived = 0;

    const TYPE_PROGRAM = 1;
    const TYPE_COURSE = 2;
    
    /**
    * @return Cm_Active_Data_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Active_Data_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Active_Data
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
    * @return Orm_Cm_Active_Data[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Active_Data
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Active_Data();
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
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['type_id'] = $this->get_type_id();
        $db_params['type'] = $this->get_type();
        $db_params['is_archived'] = $this->get_is_archived();
        
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
    
    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }
    
    public function get_semester_id() {
        return $this->semester_id;
    }
    
    public function set_type_id($value) {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }
    
    public function get_type_id() {
        return $this->type_id;
    }
    
    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }
    
    public function get_type() {
        return $this->type;
    }
    
    public function set_is_archived($value) {
        $this->add_object_field('is_archived', $value);
        $this->is_archived = $value;
    }
    
    public function get_is_archived() {
        return $this->is_archived;
    }

    /**
     * check if the program as active or not
     * @param $program_id
     * @return int
     */
    public static function is_active_program($program_id) {
        return Orm_Cm_Active_Data::get_one(array('type' => self::TYPE_PROGRAM, 'type_id' => $program_id, 'semester_id' => Orm_Semester::get_active_semester()->get_id()))->get_id();
    }

    /**
     * check if tge program active or not
     * @param $course_id
     * @return int
     */
    public static function is_active_course($course_id) {
        return Orm_Cm_Active_Data::get_one(array('type' => self::TYPE_COURSE, 'type_id' => $course_id, 'semester_id' => Orm_Semester::get_active_semester()->get_id()))->get_id();
    }

    /**
     * get semester ids that the program not active in it
     * @param $program_id
     * @return array
     */
    public static function get_not_archived_program_semester_ids($program_id) {
        $to_archive = Orm_Cm_Active_Data::get_model()->get_all(array('type' => Orm_Cm_Active_Data::TYPE_PROGRAM ,'type_id' => $program_id, 'is_archived' => 0),0,0,array(), Orm::FETCH_ARRAY);

        $ids = array_column($to_archive,'semester_id');
        $ids[] = Orm_Semester::get_active_semester()->get_id();
        return $ids;
    }

    /**
     *  get semester ids that the course not active in it
     * @param $course_id
     * @return array
     */
    public static function get_not_archived_course_semester_ids($course_id) {
        $to_archive = Orm_Cm_Active_Data::get_model()->get_all(array('type' => Orm_Cm_Active_Data::TYPE_COURSE ,'type_id' => $course_id, 'is_archived' => 0),0,0,array(), Orm::FETCH_ARRAY);

        $ids = array_column($to_archive,'semester_id');
        $ids[] = Orm_Semester::get_active_semester()->get_id();
        return $ids;
    }
}

