<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Criteria extends Orm {
    
    /**
    * @var $instances Orm_Criteria[]
    */
    protected static $instances = array();
    protected static $table_name = 'criteria';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $code = '';
    protected $title = '';
    protected $type = 0;
    protected $standard_id = 0;
    protected $created_by = 0;
    protected $date_added = 0;
    protected $date_modified = 0;
    protected $is_deleted = 0;
    protected $is_program = 0;

    const CRITERIA_NORMAL_TYPE = 1;
    const CRITERIA_INSTITUTION_KPI = 2;
    const CRITERIA_COLLEGE_KPI = 3;
    
    /**
    * @return Criteria_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Criteria_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Criteria
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
    * @return Orm_Criteria[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Criteria
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Criteria();
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
        $db_params['code'] = $this->get_code();
        $db_params['title'] = $this->get_title();
        $db_params['type'] = $this->get_type();
        $db_params['standard_id'] = $this->get_standard_id();
        $db_params['created_by'] = $this->get_created_by();
        $db_params['date_added'] = $this->get_date_added();
        $db_params['date_modified'] = $this->get_date_modified();
        $db_params['is_deleted'] = $this->get_is_deleted();
        
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
    
    public function set_code($value) {
        $this->add_object_field('code',$value);
        $this->code = $value;
    }
    
    public function get_code() {
        return $this->code;
    }
    
    public function set_title($value) {
        $this->add_object_field('title',$value);
        $this->title = $value;
    }
    
    public function get_title() {
        return $this->title;
    }
    
    public function set_type($value) {
        $this->add_object_field('type',$value);
        $this->type = $value;
    }

    public function get_type() {
        return $this->type;
    }

    public function get_type_name() {

        switch($this->get_type()){
            case Orm_Criteria::CRITERIA_COLLEGE_KPI :
                return lang('Result based')." (".lang('College').")";
                break;

            case Orm_Criteria::CRITERIA_INSTITUTION_KPI :
                 return lang('Result based')." (".lang('Institution').")";
                 break;

            case Orm_Criteria::CRITERIA_NORMAL_TYPE :
                return lang('Process based');
                break;

        }
        return $this->type;
    }

    public function set_standard_id($value) {
        $this->add_object_field('standard_id',$value);
        $this->standard_id = $value;
    }
    
    public function get_standard_id() {
        return $this->standard_id;
    }
    
    public function set_created_by($value) {
        $this->add_object_field('created_by',$value);
        $this->created_by = $value;
    }
    
    public function get_created_by() {
        return $this->created_by;
    }
    
    public function set_date_added($value) {
        $this->add_object_field('date_added',$value);
        $this->date_added = $value;
    }
    
    public function get_date_added() {
        return $this->date_added;
    }
    
    public function set_date_modified($value) {
        $this->add_object_field('date_modified',$value);
        $this->date_modified = $value;
    }
    
    public function get_date_modified() {
        return $this->date_modified;
    }
    
    public function set_is_deleted($value) {
        $this->add_object_field('is_deleted',$value);
        $this->is_deleted = $value;
    }
    
    public function get_is_deleted() {
        return $this->is_deleted;
    }

    public function set_is_program($value) {
        $this->add_object_field('is_program',$value);
        $this->is_program = $value;
    }

    public function get_is_program() {
        return $this->is_program;
    }

    public function get_items($college_id = 0)
    {
        return Orm_Kpi::get_all(array('criteria_id' => $this->get_id(),'only_college_id' => $college_id));
    }

    /**
     * @return Orm_Standard
     */
    public function get_standard_obj()
    {
        return Orm_Standard::get_instance($this->get_standard_id());
    }
}

