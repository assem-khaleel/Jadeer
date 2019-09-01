<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Degree extends Orm {
    
    /**
    * @var $instances Orm_Degree[]
    */
    protected static $instances = array();
    protected static $table_name = 'degree';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $integration_id = 0;
    protected $is_deleted = 0;
    protected $is_undergraduate = 1;
    protected $name_en = '';
    protected $name_ar = '';


    const DEGREE_UNDERGRAUDATE_BACHELOR = 1;
    const DEGREE_UNDERGRAUDATE_DIPLOMA = 2;
    const DEGREE_POSTGRAUDATE_HIGH_DIPLOMA = 3;
    const DEGREE_POSTGRAUDATE_MASTER = 4;
    const DEGREE_POSTGRAUDATE_DOCTOR = 5;

    public static $degree_list = array(
        self::DEGREE_UNDERGRAUDATE_BACHELOR => 'Undergraduate - Bachelor',
        self::DEGREE_UNDERGRAUDATE_DIPLOMA => 'Undergraduate - Diploma',
        self::DEGREE_POSTGRAUDATE_HIGH_DIPLOMA => 'Postgraduate - High Diploma',
        self::DEGREE_POSTGRAUDATE_MASTER => 'Postgraduate - Master',
        self::DEGREE_POSTGRAUDATE_DOCTOR => 'Postgraduate - Doctor'
    );

    /**
    * @return Degree_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Degree_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Degree
    */
    public static function get_instance($id) {
        
        $id = intval($id);
        if(isset(self::$instances[$id])) {
            return self::$instances[$id];
        }
        
        return self::get_one(array('id' => $id));
    }
    
    /**
    * get all Objects
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    *
    * @return Orm_Degree[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Degree
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Degree();
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
        $db_params['integration_id'] = $this->get_integration_id();
        $db_params['is_deleted'] = $this->get_is_deleted();
        $db_params['is_undergraduate'] = $this->get_is_undergraduate();
        $db_params['name_en'] = $this->get_name_en();
        $db_params['name_ar'] = $this->get_name_ar();
        
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
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_integration_id($value) {
        $this->add_object_field('integration_id',$value);
        $this->integration_id = $value;
    }
    
    public function get_integration_id() {
        return $this->integration_id;
    }

    public function set_is_undergraduate($value) {
        $this->add_object_field('is_undergraduate',$value);
        $this->is_undergraduate = $value;
    }

    public function get_is_undergraduate($to_string = false)
    {

        if ($to_string) {
            return (isset(self::$degree_list[$this->is_undergraduate]) ? self::$degree_list[$this->is_undergraduate] : '');
        }

        return $this->is_undergraduate;
    }


//    public function get_is_undergraduate() {
//        return $this->is_undergraduate;
//    }

    public function set_is_deleted($value) {
        $this->add_object_field('is_deleted',$value);
        $this->is_deleted = $value;
    }
    
    public function get_is_deleted() {
        return $this->is_deleted;
    }
    
    public function set_name_en($value) {
        $this->add_object_field('name_en',$value);
        $this->name_en = $value;
    }
    
    public function get_name_en() {
        return $this->name_en;
    }
    
    public function set_name_ar($value) {
        $this->add_object_field('name_ar',$value);
        $this->name_ar = $value;
    }
    
    public function get_name_ar() {
        return $this->name_ar;
    }

    public function get_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_name_ar();
        }
        return $this->get_name_en();
    }

    
}

