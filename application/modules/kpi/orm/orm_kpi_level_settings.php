<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Kpi_Level_Settings extends Orm {
    
    /**
    * @var $instances Orm_Kpi_Level_Settings[]
    */
    protected static $instances = array();
    protected static $table_name = 'kpi_level_settings';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $label_ar = '';
    protected $label_en = '';
    protected $level;
    
    /**
    * @return Kpi_Level_Settings_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Kpi_Level_Settings_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Kpi_Level_Settings
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
    * @return Orm_Kpi_Level_Settings[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Kpi_Level_Settings
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Kpi_Level_Settings();
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
        $db_params['label_ar'] = $this->get_label_ar();
        $db_params['label_en'] = $this->get_label_en();
        $db_params['level'] = $this->get_level();
        
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
    
    public function set_label_ar($value) {
        $this->add_object_field('label_ar', $value);
        $this->label_ar = $value;
    }
    
    public function get_label_ar() {
        return $this->label_ar;
    }
    
    public function set_label_en($value) {
        $this->add_object_field('label_en', $value);
        $this->label_en = $value;
    }
    
    public function get_label_en() {
        return $this->label_en;
    }
    
    public function set_level($value) {
        $this->add_object_field('level', $value);
        $this->level = $value;
    }
    
    public function get_level() {
        return $this->level;
    }

    /**
     * get general label of level depends on language
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_label($lang = UI_LANG) {
        return $lang == 'arabic' ? $this->get_label_ar() : $this->get_label_en();
    }
}

