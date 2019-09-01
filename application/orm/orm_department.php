<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Department extends Orm {

    /**
    * @var $instances Orm_Department[]
    */
    protected static $instances = array();
    protected static $table_name = 'department';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $integration_id = 0;
    protected $college_id = 0;
    protected $is_deleted = 0;
    protected $name_en = '';
    protected $name_ar = '';

    /**
    * @return Department_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Department_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Department
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
    * @return Orm_Department[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Department
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Department();
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
        $db_params['college_id'] = $this->get_college_id();
        $db_params['is_deleted'] = $this->get_is_deleted();
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
    
    public function set_college_id($value) {
        $this->add_object_field('college_id',$value);
        $this->college_id = $value;
    }
    
    public function get_college_id() {
        return $this->college_id;
    }
    
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

    /**
     * @return Orm_College
     */
    public function get_college_obj()
    {
        return Orm_College::get_instance($this->get_college_id());
    }

    public function draw_org_chart($level)
    {
        $name = htmlfilter($this->get_name());
        $title = lang('N/A');

        $result = array('name' => $name, 'title' => $title, 'children' => [], 'className' => 'level-'.$level);

        $programs = Orm_Program::get_all(['department_id' => $this->get_id()]);

        if($programs) {
            foreach ($programs as $program) {
                $result['children'][] = ['name' => htmlfilter($program->get_name()), 'title' => $title, 'children' => [], 'className' => 'level-'.$level];
            }
        }



        return $result;
    }
}

