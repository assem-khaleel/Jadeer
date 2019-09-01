<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Kpi_Level_Description extends Orm {
    
    /**
    * @var $instances Orm_Kpi_Level_Description[]
    */
    protected static $instances = array();
    protected static $table_name = 'kpi_level_description';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $kpi_id = 0;
    protected $level_number = 0;
    protected $description = '';
    protected $title = '';

    /**
    * @return Kpi_Level_Description_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Kpi_Level_Description_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Kpi_Level_Description
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
    * @return Orm_Kpi_Level_Description[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Kpi_Level_Description
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Kpi_Level_Description();
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
        $db_params['kpi_id'] = $this->get_kpi_id();
        $db_params['level_number'] = $this->get_level_number();
        $db_params['description'] = $this->get_description();
        $db_params['title'] = $this->get_title();

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
    
    public function set_kpi_id($value) {
        $this->add_object_field('kpi_id', $value);
        $this->kpi_id = $value;
    }
    
    public function get_kpi_id() {
        return $this->kpi_id;
    }
    
    public function set_level_number($value) {
        $this->add_object_field('level_number', $value);
        $this->level_number = $value;
    }
    
    public function get_level_number() {
        return $this->level_number;
    }
    
    public function set_description($value) {
        $this->add_object_field('description', $value);
        $this->description = $value;
    }
    
    public function get_description() {
        return $this->description;
    }

    public function set_title($value) {
        $this->add_object_field('title', $value);
        $this->title = $value;
    }

    public function get_title() {
        return $this->title;
    }

    /**
     * get description for levels
     * @param $kpi_id
     * @return array
     */
    public static function get_kpi_descriptions($kpi_id) {
        $levels = array();
        foreach (Orm_Kpi_Level_Description::get_all(['kpi_id' => $kpi_id]) as $item) {
            $levels[$item->get_level_number()]['description'] = $item->get_description();
            $levels[$item->get_level_number()]['title'] = $item->get_title();
        }

        return $levels;
    }
}

