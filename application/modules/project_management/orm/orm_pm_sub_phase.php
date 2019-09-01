<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Pm_Sub_Phase extends Orm {
    
    /**
    * @var $instances Orm_Pm_Sub_Phase[]
    */
    protected static $instances = array();
    protected static $table_name = 'pm_sub_phase';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $start_date = '0000-00-00';
    protected $end_date = '0000-00-00';
    protected $desc_en = '';
    protected $desc_ar = '';
    protected $phase_id = 0;
    protected $responsible = 0;
    protected $is_complete = 0;

    const UN_COMPLETE =0;
    const COMPLETE = 1;


    public static $sub_phase_status = array(
      self::UN_COMPLETE => 'Uncompleted',
      self::COMPLETE => 'Completed'
    );
    /**
    * @return Pm_Sub_Phase_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Pm_Sub_Phase_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Pm_Sub_Phase
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
    * @return Orm_Pm_Sub_Phase[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Pm_Sub_Phase
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Pm_Sub_Phase();
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
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        $db_params['desc_en'] = $this->get_desc_en();
        $db_params['desc_ar'] = $this->get_desc_ar();
        $db_params['phase_id'] = $this->get_phase_id();
        $db_params['responsible'] = $this->get_responsible();
        $db_params['is_complete'] = $this->get_is_complete();
        
        return $db_params;
    }

    /** save object
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
    
    public function set_title_en($value) {
        $this->add_object_field('title_en', $value);
        $this->title_en = $value;
    }
    
    public function get_title_en() {
        return $this->title_en;
    }
    
    public function set_title_ar($value) {
        $this->add_object_field('title_ar', $value);
        $this->title_ar = $value;
    }
    
    public function get_title_ar() {
        return $this->title_ar;
    }
    
    public function set_start_date($value) {
        $this->add_object_field('start_date', $value);
        $this->start_date = $value;
    }
    
    public function get_start_date() {
        return $this->start_date;
    }
    
    public function set_end_date($value) {
        $this->add_object_field('end_date', $value);
        $this->end_date = $value;
    }
    
    public function get_end_date() {
        return $this->end_date;
    }
    
    public function set_desc_en($value) {
        $this->add_object_field('desc_en', $value);
        $this->desc_en = $value;
    }
    
    public function get_desc_en() {
        return $this->desc_en;
    }
    
    public function set_desc_ar($value) {
        $this->add_object_field('desc_ar', $value);
        $this->desc_ar = $value;
    }
    
    public function get_desc_ar() {
        return $this->desc_ar;
    }
    
    public function set_phase_id($value) {
        $this->add_object_field('phase_id', $value);
        $this->phase_id = $value;
    }
    
    public function get_phase_id() {
        return $this->phase_id;
    }
    
    public function set_responsible($value) {
        $this->add_object_field('responsible', $value);
        $this->responsible = $value;
    }
    
    public function get_responsible() {
        return $this->responsible;
    }
    
    public function set_is_complete($value) {
        $this->add_object_field('is_complete', $value);
        $this->is_complete = $value;
    }
    
    public function get_is_complete() {
        return $this->is_complete;
    }

    public function get_title($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_title_ar() : $this->get_title_en();
    }
}

