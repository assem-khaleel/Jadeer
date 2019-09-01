<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Program_Assessment_Method extends Orm {
    
    protected static $table_name = 'cm_program_assessment_method';
    
    /**
    * @var $instances Orm_Cm_Program_Assessment_Method[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $program_id = 0;
    protected $assessment_method_id = 0;
    
    /**
    * @return Cm_Program_Assessment_Method_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Program_Assessment_Method_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Program_Assessment_Method
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
    * @return Orm_Cm_Program_Assessment_Method[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Program_Assessment_Method
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Program_Assessment_Method();
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

    /**
     * Re-set the Program Assessment Methods list
     *
     * @param int   $programID          Program ID
     * @param array $assessmentMethod   Assessment Methods IDs
     *
     * @return bool
     */
    public static function add_delete_package($programID, $assessmentMethod = []) {
        return self::get_model()->addDeletePackage($programID, $assessmentMethod);
    }

    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['program_id'] = $this->get_program_id();
        $db_params['assessment_method_id'] = $this->get_assessment_method_id();
        
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
        Orm_Cm_Program_Assessment_Component::delete_by_program_assessment_method_id($this->get_id());
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
    
    public function set_program_id($value) {
        $this->add_object_field('program_id', $value);
        $this->program_id = $value;
    }
    
    public function get_program_id() {
        return $this->program_id;
    }
    
    public function set_assessment_method_id($value) {
        $this->add_object_field('assessment_method_id', $value);
        $this->assessment_method_id = $value;
    }
    
    public function get_assessment_method_id() {
        return $this->assessment_method_id;
    }

    /**
     * Get Assessment Method Details
     * @return Orm_Cm_Assessment_Method
     */
    public function get_assessment_method_obj() {
        return Orm_Cm_Assessment_Method::get_instance($this->get_assessment_method_id());
    }

    public static function get_assessment_methods($program_id) {
        return self::get_all(array('program_id' => $program_id));
    }

    private $components = null;

    /**
     * get assessment method component using program assessment method id
     * @return Orm_Cm_Program_Assessment_Component[]
     */
    public function get_assessment_components() {

        if(is_null($this->components)) {
            $this->components = Orm_Cm_Program_Assessment_Component::get_all(array('program_assessment_method_id' => $this->get_id()));
        }

        return $this->components;
    }

    /**
     * get all assessment methods using program id
     * @param $program_id
     * @return array
     */
    public static function get_assessment_method_ids($program_id) {

        $method_ids = array();

        foreach (self::get_assessment_methods($program_id) as $method) {
            $method_ids[$method->get_assessment_method_id()] = $method->get_assessment_method_id();
        }

        return $method_ids;
    }

    /**
     * get the archive data using semester
     * @param $semester_id
     */
    public static function archive($semester_id) {
        self::get_model()->archive($semester_id);
    }

}

