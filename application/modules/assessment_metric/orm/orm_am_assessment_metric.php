<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Am_Assessment_Metric extends Orm {
    
    /**
    * @var $instances Orm_Am_Assessment_Metric[]
    */
    protected static $instances = array();
    protected static $table_name = 'am_assessment_metric';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $item_class = __CLASS__;
    protected $item_id = 0;
    protected $name_en = '';
    protected $name_ar = '';
    protected $semester_id = 0;
    protected $type = 0;
    protected $level = 0;
    protected $target = 0;
    protected $extra_data = '';
    protected $college_id = 0;
    protected $department_id = 0;
    protected $program_id = 0;

    protected $weakness_en = '';
    protected $weakness_ar = '';
    protected $strength_en = '';
    protected $strength_ar = '';

    /**
    * @return Am_Assessment_Metric_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Am_Assessment_Metric_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Am_Assessment_Metric
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
    * @return Orm_Am_Assessment_Metric[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Am_Assessment_Metric
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

    /**
     * @return array
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['item_class'] = $this->get_item_class();
        $db_params['item_id'] = $this->get_item_id();
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['type'] = $this->get_type();
        $db_params['level'] = $this->get_level();
        $db_params['target'] = $this->get_target();
        $db_params['college_id'] = $this->get_college_id();
        $db_params['department_id'] = $this->get_department_id();
        $db_params['program_id'] = $this->get_program_id();
        $db_params['extra_data'] = $this->get_extra_data(false);

        $db_params['weakness_en'] = $this->get_weakness_en();
        $db_params['weakness_ar'] = $this->get_weakness_ar();
        $db_params['strength_en'] = $this->get_strength_en();
        $db_params['strength_ar'] = $this->get_strength_ar();

        return $db_params;
    }

    /**
     * @return int
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

    /**
     * @return bool
     */
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }

    /**
     * @param $value
     */
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }

    /**
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * @param $value
     */
    public function set_name_en($value) {
        $this->add_object_field('name_en', $value);
        $this->name_en = $value;
    }

    /**
     * @return string
     */
    public function get_name_en() {
        return $this->name_en;
    }

    /**
     * @param $value
     */
    public function set_name_ar($value) {
        $this->add_object_field('name_ar', $value);
        $this->name_ar = $value;
    }

    /**
     * @return string
     */
    public function get_name_ar() {
        return $this->name_ar;
    }

    /**
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_name($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
    }

    /**
     * @param $value
     */
    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }

    /**
     * @return int
     */
    public function get_semester_id() {
        return $this->semester_id;
    }

    /**
     * @param $value
     */
    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }

    /**
     * @return int
     */
    public function get_type() {
        return $this->type;
    }

    /**
     * @param $value
     */
    public function set_level($value) {
        $this->add_object_field('level', $value);
        $this->level = $value;
    }

    /**
     * @return int
     */
    public function get_level() {
        return $this->level;
    }

    /**
     * @param $value
     */
    public function set_target($value) {
        $this->add_object_field('target', $value);
        $this->target = $value;
    }

    /**
     * @return int
     */
    public function get_target() {
        return $this->target;
    }

    /**
     * @return string
     */
    public function draw_properties() {
        return "<div class='alert alert-warning m-a-0'>".lang('Please Choose One Of Assessment Metric Type')."</div>";
    }

    /**
     * @return array
     */
    public static function get_item_class_types() {

        $item_class_types = array();

        $item_class_types[] = Orm_Am_Assessment_Metric_Objective::class;

        if(License::get_instance()->check_module('curriculum_mapping')) {
            $item_class_types[] = Orm_Am_Assessment_Metric_Clo::class;
            $item_class_types[] = Orm_Am_Assessment_Metric_Plo::class;
        }

        if(License::get_instance()->check_module('kpi')){
            $item_class_types[] = Orm_Am_Assessment_Metric_Kpi::class;
        }

        return $item_class_types;
    }

    /**
     * @param $value
     */
    public function set_item_class($value) {
        $this->add_object_field('item_class', $value);
        $this->item_class = $value;
    }

    /**
     * @return string
     */
    public function get_item_class() {
        return $this->item_class;
    }

    /**
     * @param $value
     */
    public function set_item_id($value) {
        $this->add_object_field('item_id', $value);
        $this->item_id = $value;
    }

    /**
     * @return int
     */
    public function get_item_id() {
        return $this->item_id;
    }

    /**
     * @param $value
     */
    public function set_extra_data($value) {

        if(is_array($value)) {
            $value = json_encode($value);
        }

        $this->add_object_field('extra_data', $value);
        $this->extra_data = $value;
    }

    /**
     * @param bool $as_array
     * @return mixed|string
     */
    public function get_extra_data($as_array = true) {
        if($as_array) {
            return json_decode($this->extra_data, true);
        }
        return $this->extra_data;
    }

    /**
     * @param $item
     * @return null
     */
    public function get_item_from_extra_data($item) {
        $extra_data = $this->get_extra_data();
        return isset($extra_data[$item]) ? $extra_data[$item] : null;
    }

    /**
     *
     */
    public function check_extra_data() {
        /* Do Nothing */
    }

    /**
     * @param $value
     */
    public function set_item_type($value) {
        $this->add_object_field('item_type', $value);
        $this->item_type = $value;
    }

    /**
     *
     */
    public function ajax() {
        /* Do Nothing */
    }

    /**
     * @return bool
     */
    public function is_valid() {
        return true;
    }

    /**
     * @param $value
     */
    public function set_college_id($value) {

        $this->add_object_field('college_id', $value);
        $this->college_id = $value;
    }

    /**
     * @return int
     */
    public function get_college_id() {
        return $this->college_id;
    }

    /**
     * @param $value
     */
    public function set_department_id($value) {
        $this->add_object_field('department_id', $value);
        $this->department_id = $value;
    }

    /**
     * @return int
     */
    public function get_department_id() {
        return $this->department_id;
    }

    /**
     * @param int $all_component
     */
    public function generate_pdf($all_component=0) {
        /* Do Nothing */
    }

    /**
     * @param $filters
     * @return string
     */
    public function get_attachments_directory($filters)
    {
        $path = Orm_Semester::get_active_semester()->get_year() . '/';
            $path .= trim(preg_replace('/([^\w\p{Arabic}]|[_])+/u', "_",Orm_Program::get_instance($filters)->get_department_obj()->get_college_obj()->get_name_en()),'_') . '/';
            $path .= trim(preg_replace("/[^\w]+/", "_",Orm_Program::get_instance($filters)->get_name_en()),'_') . '/';

        $path .= 'Assessment Metric';

        return $path;
    }

    /**
     * @param $value
     */
    public function set_program_id($value) {
        $this->add_object_field('program_id', $value);
        $this->program_id = $value;
    }

    /**
     * @return int
     */
    public function get_program_id() {
        return $this->program_id;
    }

    /**
     * @return Orm_Program
     */
    public function get_program_obj()
    {
        return Orm_Program::get_instance($this->get_program_id());
    }

    /**
     * @return string
     */
    public function get_item_title() {
        return '';
    }

    /**
     * @return string
     */
    public function draw() {
        return '';
    }

    /**
     * @param $value
     */
    public function set_weakness_en($value) {
        $this->add_object_field('weakness_en', $value);
        $this->weakness_en = $value;
    }

    /**
     * @return string
     */
    public function get_weakness_en() {
        return $this->weakness_en;
    }

    /**
     * @param $value
     */
    public function set_weakness_ar($value) {
        $this->add_object_field('weakness_ar', $value);
        $this->weakness_ar = $value;
    }

    /**
     * @return string
     */
    public function get_weakness_ar() {
        return $this->weakness_ar;
    }

    /**
     * @param $value
     */
    public function set_strength_en($value) {
        $this->add_object_field('strength_en', $value);
        $this->strength_en = $value;
    }

    /**
     * @return string
     */
    public function get_strength_en() {
        return $this->strength_en;
    }

    /**
     * @param $value
     */
    public function set_strength_ar($value) {
        $this->add_object_field('strength_ar', $value);
        $this->strength_ar = $value;
    }

    /**
     * @return string
     */
    public function get_strength_ar() {
        return $this->strength_ar;
    }

    /**
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_weakness($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_weakness_ar();
        }
        return $this->get_weakness_en();
    }

    /**
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_strength($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_strength_ar();
        }
        return $this->get_strength_en();
    }
}

