<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Al_Assessment_Loop extends Orm {
    
    /**
    * @var $instances Orm_Al_Assessment_Loop[]
    */
    protected static $instances = array();
    protected static $table_name = 'al_assessment_loop';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $item_class = __CLASS__;
    protected $item_id = 0;
    protected $item_type = 0;
    protected $item_type_id = 0;
    protected $type_id = 0;
    protected $semester_id = 0;
    protected $extra_data = '';
    protected $user_id = 0;
    protected $deadline = '0000-00-00';


    const ASSESSMENT_INSTITUTION_LEVEL = 0;
    const ASSESSMENT_COLLEGE_LEVEL = 1;
    const ASSESSMENT_PROGRAM_LEVEL = 2;
    const ASSESSMENT_UNIT_LEVEL = 3;

    /**
    * @return Al_Assessment_Loop_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Al_Assessment_Loop_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Al_Assessment_Loop
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
    * @return Orm_Al_Assessment_Loop[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Al_Assessment_Loop
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new static();
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
    */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['item_class'] = $this->get_item_class();
        $db_params['item_id'] = $this->get_item_id();
        $db_params['item_type'] = $this->get_item_type();
        $db_params['item_type_id'] = $this->get_item_type_id();
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['extra_data'] = $this->get_extra_data(false);
        $db_params['user_id'] = $this->get_user_id();
        $db_params['deadline'] = $this->get_deadline();
        $db_params['type_id'] = $this->get_type_id();

        return $db_params;
    }

    /** save object
    */
    public function save() {

        if ($this->get_object_status() == 'new') {

            $this->set_user_id(Orm_User::get_logged_user_id());
            $this->set_semester_id(Orm_Semester::get_active_semester()->get_id());

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
    
    public function set_item_class($value) {
        $this->add_object_field('item_class', $value);
        $this->item_class = $value;
    }
    
    public function get_item_class() {
        return $this->item_class;
    }
    
    public function set_item_id($value) {
        $this->add_object_field('item_id', $value);
        $this->item_id = $value;
    }

    public function get_item_id() {
        return $this->item_id;
    }

    public function set_item_type($value) {
        $this->add_object_field('item_type', $value);
        $this->item_type = $value;
    }

    public function get_item_type() {
        return $this->item_type;
    }

    public function set_item_type_id($value) {
        $this->add_object_field('item_type_id', $value);
        $this->item_type_id = $value;
    }

    public function get_item_type_id() {
        return $this->item_type_id;
    }

    public function set_type_id($value) {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }
    public function get_type_id() {
        return $this->type_id;
    }

    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }

    public function get_semester_id() {
        return $this->semester_id;
    }

    public function set_extra_data($value) {

        if(is_array($value)) {
            $value = json_encode($value);
        }

        $this->add_object_field('extra_data', $value);
        $this->extra_data = $value;
    }

    public function get_extra_data($as_array = true) {
        if($as_array) {
            return json_decode($this->extra_data, true);
        }
        return $this->extra_data;
    }

    public function get_item_from_extra_data($item) {
        $extra_data = $this->get_extra_data();
        return isset($extra_data[$item]) ? $extra_data[$item] : null;
    }

    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function set_deadline($value) {
        $this->add_object_field('deadline', $value);
        $this->deadline= $value;
    }

    public function get_deadline() {
        return $this->deadline;
    }

    /* additional code */

    public function get_item_title() {
        return '';
    }

    public function get_current_item_type() {
        return self::get_item_types()[$this->get_item_type()];
    }

    public static function get_item_types() {
        return [
            self::ASSESSMENT_INSTITUTION_LEVEL => lang('Institution'),
            self::ASSESSMENT_COLLEGE_LEVEL     => lang('College'),
            self::ASSESSMENT_PROGRAM_LEVEL     => lang('Program'),
            self::ASSESSMENT_UNIT_LEVEL        => lang('Unit')
        ];
    }

    public static function get_item_class_types() {

        $item_class_types = array();

        $item_class_types[] = Orm_Al_Assessment_Loop_Custom::class;
        $item_class_types[] = Orm_Al_Assessment_Loop_Objective::class;

        if(License::get_instance()->check_module('curriculum_mapping')) {
            $item_class_types[] = Orm_Al_Assessment_Loop_Clo::class;
            $item_class_types[] = Orm_Al_Assessment_Loop_Plo::class;
        }

        if(License::get_instance()->check_module('kpi')){
            $item_class_types[] = Orm_Al_Assessment_Loop_Kpi::class;
        }

        return $item_class_types;
    }

    /** to check if object is validate
    */
    public function is_valid() {
        return true;
    }


    /** function to draw assessment loop type
    */
    public function draw_properties() {
        return "<div class='alert alert-warning m-a-0'>".lang('Please Choose One Of Assessment Loop Type')."</div>";
    }

    /** parent function to render child classes of assessment loop as ajax request
     * if request for clo it will render orm_al_assessment_loop_clo:ajax
     * if request for kpi it will render orm_al_assessment_loop_kpi:ajax
     * if request for plo it will render orm_al_assessment_loop_plo:ajax
     *
    */
    public function ajax() {
        /* Do Nothing */
    }

    /** draw function for assessment loop
    */
    public function draw() {
        return '';
    }

    /** set data for assessment loop types
    */
    public function check_extra_data() {
        /* Do Nothing */
    }

    /**
    */
    public function get_current_item_type_id_title() {
        switch($this->get_item_type()) {
            case self::ASSESSMENT_COLLEGE_LEVEL:
                return Orm_College::get_instance($this->get_item_type_id())->get_name();

            case self::ASSESSMENT_PROGRAM_LEVEL:
                return Orm_Program::get_instance($this->get_item_type_id())->get_name();

            case self::ASSESSMENT_UNIT_LEVEL:
                return Orm_Unit::get_instance($this->get_item_type_id())->get_name();

        }

        return '';
    }

    /** draw pdf page for every assessment loop type
     */
    public function generate_pdf() {
        /* Do Nothing */
    }

    public function get_analysis_obj() {
        return Orm_Al_Analysis::get_one(['assessment_loop_id'=>$this->get_id()]);
    }

    public function get_measure_objs() {
        return Orm_Al_Measure::get_all(['assessment_loop_id'=>$this->get_id()]);
    }

    public function get_result_objs() {
        return Orm_Al_Result::get_all(['assessment_loop_id'=>$this->get_id()]);
    }

    public function get_recommendation_objs() {
        return Orm_Al_Recommendation::get_all(['assessment_loop_id'=>$this->get_id()]);
    }
    public function get_action_objs() {
        return Orm_Al_Action::get_all(['assessment_loop_id'=>$this->get_id()]);
    }

    public function can_manage(){
        return (time() < strtotime($this->get_deadline()));
    }

    public function get_attachments_directory($type, $filters)
    {
        $path = Orm_Semester::get_active_semester()->get_year() . '/';
        switch ($type) {
            case self::ASSESSMENT_INSTITUTION_LEVEL:
                $path .= 'Institution/';
                break;
            case self::ASSESSMENT_COLLEGE_LEVEL:
                $path .= trim(preg_replace('/([^\w\p{Arabic}]|[_])+/u', "_", Orm_College::get_instance($this->get_item_type_id())->get_name()),'_'). '/';
                break;
            case self::ASSESSMENT_PROGRAM_LEVEL:
                $path .= trim(preg_replace('/([^\w\p{Arabic}]|[_])+/u', "_",Orm_Program::get_instance($filters)->get_department_obj()->get_college_obj()->get_name_en()),'_') . '/';
                $path .= trim(preg_replace("/[^\w]+/", "_",Orm_Program::get_instance($filters)->get_name_en()),'_') . '/';
                break;
            case self::ASSESSMENT_UNIT_LEVEL:
                $path .= trim(preg_replace('/([^\w\p{Arabic}]|[_])+/u', "_",Orm_Unit::get_instance($filters)->get_name_en()),'_') . '/';
                break;
        }

        $path .= 'Assessment Loop';

        return $path;
    }
}

