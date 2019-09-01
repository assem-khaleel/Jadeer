<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Legend_Desc extends Orm {
    
    /**
    * @var $instances Orm_Fp_Legend_Desc[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_legend_desc';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $legend_id = 0;
    protected $legend_en = '';
    protected $legend_ar = '';
    protected $min = 0;
    protected $max = 0;
    protected $desc_en = '';
    protected $desc_ar = '';
    
    /**
    * @return Fp_Legend_Desc_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Legend_Desc_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Legend_Desc
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
    * @return Orm_Fp_Legend_Desc[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Legend_Desc
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Legend_Desc();
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
        $db_params['legend_id'] = $this->get_legend_id();
        $db_params['legend_en'] = $this->get_legend_en();
        $db_params['legend_ar'] = $this->get_legend_ar();
        $db_params['min'] = $this->get_min();
        $db_params['max'] = $this->get_max();
        $db_params['desc_en'] = $this->get_desc_en();
        $db_params['desc_ar'] = $this->get_desc_ar();
        
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
    public function set_legend_id($value) {
        $this->add_object_field('legend_id', $value);
        $this->legend_id = $value;
    }

    /**
     * @return int
     */
    public function get_legend_id() {
        return $this->legend_id;
    }

    /**
     * @param $value
     */
    public function set_legend_en($value) {
        $this->add_object_field('legend_en', $value);
        $this->legend_en = $value;
    }

    /**
     * @return string
     */
    public function get_legend_en() {
        return $this->legend_en;
    }

    /**
     * @param $value
     */
    public function set_legend_ar($value) {
        $this->add_object_field('legend_ar', $value);
        $this->legend_ar = $value;
    }

    /**
     * @return string
     */
    public function get_legend_ar() {
        return $this->legend_ar;
    }

    /**
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_legend($lang = UI_LANG) {
        if($lang=='arabic') {
            return $this->get_legend_ar();
        }

        return $this->get_legend_en();
    }

    /**
     * @param $value
     */
    public function set_min($value) {
        $this->add_object_field('min', $value);
        $this->min = $value;
    }

    /**
     * @return int
     */
    public function get_min() {
        return $this->min;
    }

    /**
     * @param $value
     */
    public function set_max($value) {
        $this->add_object_field('max', $value);
        $this->max = $value;
    }

    /**
     * @return int
     */
    public function get_max() {
        return $this->max;
    }

    /**
     * @param $value
     */
    public function set_desc_en($value) {
        $this->add_object_field('desc_en', $value);
        $this->desc_en = $value;
    }

    /**
     * @return string
     */
    public function get_desc_en() {
        return $this->desc_en;
    }

    /**
     * @param $value
     */
    public function set_desc_ar($value) {
        $this->add_object_field('desc_ar', $value);
        $this->desc_ar = $value;
    }

    /**
     * @return string
     */
    public function get_desc_ar() {
        return $this->desc_ar;
    }

    /**
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_desc($lang = UI_LANG) {
        if($lang=='arabic') {
            return $this->get_desc_ar();
        }

        return $this->get_desc_en();
    }

    /**
     * this function check range by rows by its score
     * @param int $score the score of the call to be controller
     * @return bool
     */
    public function check_range($score){
        return ($score >= $this->get_min() and $score <= $this->get_max());
    }
    
    
}

