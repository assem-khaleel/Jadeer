<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Program_Learning_Outcome extends Orm {
    
    protected static $table_name = 'cm_program_learning_outcome';
    
    /**
    * @var $instances Orm_Cm_Program_Learning_Outcome[]
    */
    protected static $instances = array();
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $learning_domain_id = 0;
    protected $learning_outcome_id = 0;
    protected $program_id = 0;
    protected $text_en = '';
    protected $text_ar = '';
    protected $code = '';

    /**
    * @return Cm_Program_Learning_Outcome_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Cm_Program_Learning_Outcome_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Cm_Program_Learning_Outcome
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
    * @return Orm_Cm_Program_Learning_Outcome[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Cm_Program_Learning_Outcome
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Cm_Program_Learning_Outcome();
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
        $db_params['learning_domain_id'] = $this->get_learning_domain_id();
        $db_params['learning_outcome_id'] = $this->get_learning_outcome_id();
        $db_params['program_id'] = $this->get_program_id();
        $db_params['text_en'] = $this->get_text_en();
        $db_params['text_ar'] = $this->get_text_ar();
        $db_params['code'] = $this->get_code();

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
    
    public function set_learning_domain_id($value) {
        $this->add_object_field('learning_domain_id', $value);
        $this->learning_domain_id = $value;
    }
    
    public function get_learning_domain_id() {
        return $this->learning_domain_id;
    }
    
    public function set_learning_outcome_id($value) {
        $this->add_object_field('learning_outcome_id', $value);
        $this->learning_outcome_id = $value;
    }
    
    public function get_learning_outcome_id() {
        return $this->learning_outcome_id;
    }
    
    public function set_program_id($value) {
        $this->add_object_field('program_id', $value);
        $this->program_id = $value;
    }
    
    public function get_program_id() {
        return $this->program_id;
    }

    /**
     * get program learning outcome text depends on active language
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_text($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_text_ar();
        }

        return $this->get_text_en();
    }
    
    public function set_text_en($value) {
        $this->add_object_field('text_en', $value);
        $this->text_en = $value;
    }
    
    public function get_text_en() {
        return $this->text_en;
    }
    
    public function set_text_ar($value) {
        $this->add_object_field('text_ar', $value);
        $this->text_ar = $value;
    }
    
    public function get_text_ar() {
        return $this->text_ar;
    }
    
    public function set_code($value) {
        $this->add_object_field('code', $value);
        $this->code = $value;
    }

    public function get_code() {
        return $this->code;
    }

    /**
     * get learning outcome for program using learning domain id and program id
     * @param $program_id
     * @param $learning_domain_id
     * @return int|Orm_Cm_Program_Learning_Outcome[]
     */
    public static function get_program_learning_outcomes($program_id, $learning_domain_id){
        return self::get_all(array('program_id' => $program_id, 'learning_domain_id' => $learning_domain_id));
    }

    /**
     *  get the archive data using semester
     * @param $semester_id
     */
    public static function archive($semester_id) {
        self::get_model()->archive($semester_id);
    }

    /**
     * get learning domain Details using learning domain id
     * @return Orm_Cm_Learning_Domain
     */
    public function get_learning_domain_obj() {
        return Orm_Cm_Learning_Domain::get_instance($this->get_learning_domain_id());
    }

    /**
     * get target of program learning outcome using id
     * @return Orm_Cm_Program_Learning_Outcome_Target
     */
    public function get_target_obj() {
        return Orm_Cm_Program_Learning_Outcome_Target::get_one(['program_learning_outcome_id' => $this->get_id()]);
    }
}

