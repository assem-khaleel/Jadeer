<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Am_Metric_Item extends Orm {
    
    /**
    * @var $instances Orm_Am_Metric_Item[]
    */
    protected static $instances = array();
    protected static $table_name = 'am_metric_item';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $component_ar = '';
    protected $component_en = '';
    protected $weight = 0;
    protected $course_id = 0;
    protected $high_score = 0;
    protected $average = 0;
    protected $result = 0;
    protected $assessment_metric_id = 0;
    protected $component_type = "";
    protected $component_id = 0;

    /**
    * @return Am_Metric_Item_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Am_Metric_Item_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Am_Metric_Item
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
    * @return Orm_Am_Metric_Item[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Am_Metric_Item
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Am_Metric_Item();
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
        $db_params['component_ar'] = $this->get_component_ar();
        $db_params['component_en'] = $this->get_component_en();
        $db_params['weight'] = $this->get_weight();
        $db_params['course_id'] = $this->get_course_id();
        $db_params['high_score'] = $this->get_high_score();
        $db_params['average'] = $this->get_average();
        $db_params['result'] = $this->get_result();
        $db_params['assessment_metric_id'] = $this->get_assessment_metric_id();
        $db_params['component_id'] = $this->get_component_id();
        $db_params['component_type'] = $this->get_component_type();

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
    public function set_component_ar($value) {
        $this->add_object_field('component_ar', $value);
        $this->component_ar = $value;
    }

    /**
     * @return string
     */
    public function get_component_ar() {
        return $this->component_ar;
    }

    /**
     * @param $value
     */
    public function set_component_en($value) {
        $this->add_object_field('component_en', $value);
        $this->component_en = $value;
    }

    /**
     * @return string
     */
    public function get_component_en() {
        return $this->component_en;
    }

    /**
     * @param $value
     */
    public function set_weight($value) {
        $this->add_object_field('weight', $value);
        $this->weight = $value;
    }

    /**
     * @return int
     */
    public function get_weight() {
        return $this->weight;
    }

    /**
     * @param $value
     */
    public function set_course_id($value) {
        $this->add_object_field('course_id', $value);
        $this->course_id = $value;
    }

    /**
     * @return int
     */
    public function get_course_id() {
        return $this->course_id;
    }

    /**
     * @param $value
     */
    public function set_high_score($value) {
        $this->add_object_field('high_score', $value);
        $this->high_score = $value;
    }

    /**
     * @return int
     */
    public function get_high_score() {
        return $this->high_score;
    }

    /**
     * @param $value
     */
    public function set_average($value) {
        $this->add_object_field('average', $value);
        $this->average = $value;
    }

    /**
     * @return int
     */
    public function get_average() {
        return $this->average;
    }

    /**
     * @param $value
     */
    public function set_result($value) {
        $this->add_object_field('result', $value);
        $this->result = $value;
    }

    /**
     * @return int
     */
    public function get_assessment_metric_id() {
        return $this->assessment_metric_id;
    }

    /**
     * @param $value
     */
    public function set_assessment_metric_id($value) {
        $this->add_object_field('assessment_metric_id', $value);
        $this->assessment_metric_id = $value;
    }

    /**
     * @return int
     */
    public function get_result() {
        return $this->result;
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
    public function set_component_id($value) {
        $this->add_object_field('component_id', $value);
        $this->component_id = $value;
    }

    /**
     * @return int
     */
    public function get_component_id() {
        return $this->component_id;
    }

    /**
     * @param $value
     */
    public function set_component_type($value) {
        $this->add_object_field('component_type', $value);
        $this->component_type = $value;
    }

    /**
     * @return string
     */
    public function get_component_type() {
        return $this->component_type;
    }
    
}

