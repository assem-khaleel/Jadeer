<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Acc_Pre_Visit_Reviewer extends Orm {
    
    /**
    * @var $instances Orm_Acc_Pre_Visit_Reviewer[]
    */
    protected static $instances = array();
    protected static $table_name = 'acc_pre_visit_reviewer';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $type = '';
    protected $type_id = 0;
    protected $reviewer_id = 0;

    const TYPE_INSTITUTION = 'institution';
    const TYPE_PROGRAM = 'program';

    /**
    * @return Acc_Pre_Visit_Reviewer_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Acc_Pre_Visit_Reviewer_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Acc_Pre_Visit_Reviewer
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
    * @return Orm_Acc_Pre_Visit_Reviewer[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Acc_Pre_Visit_Reviewer
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Acc_Pre_Visit_Reviewer();
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
        $db_params['type'] = $this->get_type();
        $db_params['type_id'] = $this->get_type_id();
        $db_params['reviewer_id'] = $this->get_reviewer_id();
        
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
    
    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }
    
    public function get_type() {
        return $this->type;
    }
    
    public function set_type_id($value) {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }
    
    public function get_type_id() {
        return $this->type_id;
    }
    
    public function set_reviewer_id($value) {
        $this->add_object_field('reviewer_id', $value);
        $this->reviewer_id = $value;
    }
    
    public function get_reviewer_id() {
        return $this->reviewer_id;
    }

    public function get_reviewer_obj() {
        return Orm_User::get_instance($this->get_reviewer_id());
    }

    public function get_type_obj() {
        return self::get_type_element($this->get_type(), $this->get_type_id());
    }

    public static function get_type_element($type, $type_id = 0) {
        switch ($type) {
            case self::TYPE_PROGRAM:
                return Orm_Program::get_instance($type_id);
                break;
            default:
                return Orm_Institution::get_instance();
                break;
        }
    }

    private static $can_manege = array();

    public static function can_manege($type, $type_id = null, $user_id = null) {

        if(is_null($user_id)) {
            $user_id = Orm_User::get_logged_user_id();
        }

        if(is_null($type_id)) {
            $type_id = 'all';
        }

        if(!isset(self::$can_manege[$type][$type_id][$user_id])) {

            $filters = array();
            $filters['type'] = $type;
            $filters['reviewer_id'] = $user_id;

            if($type_id != 'all') {
                $filters['type_id'] = $type_id;
            }

            self::$can_manege[$type][$type_id][$user_id] = boolval(self::get_count($filters));
        }

        return self::$can_manege[$type][$type_id][$user_id];
    }

    public static function get_reviewer_program_ids($user_id = null) {

        if(is_null($user_id)) {
            $user_id = Orm_User::get_logged_user_id();
        }

        return self::get_model()->get_reviewer_program_ids($user_id, self::TYPE_PROGRAM);

    }


}

