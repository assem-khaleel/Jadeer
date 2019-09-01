<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Data_Research_Budget extends Orm {
    
    /**
    * @var $instances Orm_Data_Research_Budget[]
    */
    protected static $instances = array();
    protected static $table_name = 'data_research_budget';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $program_id = 0;
    protected $academic_year = '';
    protected $research_budget_total_amount = 0;
    protected $research_budget_actual_expenditure = 0;
    protected $publications_count = 0;
    protected $conferece_presentation_count = 0;
    protected $male_faculty_member_count = 0;
    protected $female_faculty_member_count = 0;
    
    /**
    * @return Data_Research_Budget_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Data_Research_Budget_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Data_Research_Budget
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
    * @return Orm_Data_Research_Budget[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Data_Research_Budget
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Data_Research_Budget();
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
        $db_params['program_id'] = $this->get_program_id();
        $db_params['academic_year'] = $this->get_academic_year();
        $db_params['research_budget_total_amount'] = $this->get_research_budget_total_amount();
        $db_params['research_budget_actual_expenditure'] = $this->get_research_budget_actual_expenditure();
        $db_params['publications_count'] = $this->get_publications_count();
        $db_params['conferece_presentation_count'] = $this->get_conferece_presentation_count();
        $db_params['male_faculty_member_count'] = $this->get_male_faculty_member_count();
        $db_params['female_faculty_member_count'] = $this->get_female_faculty_member_count();
        
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
    
    public function set_program_id($value) {
        $this->add_object_field('program_id',$value);
        $this->program_id = $value;
    }
    
    public function get_program_id() {
        return $this->program_id;
    }
    
    public function set_academic_year($value) {
        $this->add_object_field('academic_year',$value);
        $this->academic_year = $value;
    }
    
    public function get_academic_year() {
        return $this->academic_year;
    }
    
    public function set_research_budget_total_amount($value) {
        $this->add_object_field('research_budget_total_amount',$value);
        $this->research_budget_total_amount = $value;
    }
    
    public function get_research_budget_total_amount() {
        return $this->research_budget_total_amount;
    }
    
    public function set_research_budget_actual_expenditure($value) {
        $this->add_object_field('research_budget_actual_expenditure',$value);
        $this->research_budget_actual_expenditure = $value;
    }
    
    public function get_research_budget_actual_expenditure() {
        return $this->research_budget_actual_expenditure;
    }
    
    public function set_publications_count($value) {
        $this->add_object_field('publications_count',$value);
        $this->publications_count = $value;
    }
    
    public function get_publications_count() {
        return $this->publications_count;
    }
    
    public function set_conferece_presentation_count($value) {
        $this->add_object_field('conferece_presentation_count',$value);
        $this->conferece_presentation_count = $value;
    }
    
    public function get_conferece_presentation_count() {
        return $this->conferece_presentation_count;
    }
    
    public function set_male_faculty_member_count($value) {
        $this->add_object_field('male_faculty_member_count',$value);
        $this->male_faculty_member_count = $value;
    }
    
    public function get_male_faculty_member_count() {
        return $this->male_faculty_member_count;
    }
    
    public function set_female_faculty_member_count($value) {
        $this->add_object_field('female_faculty_member_count',$value);
        $this->female_faculty_member_count = $value;
    }
    
    public function get_female_faculty_member_count() {
        return $this->female_faculty_member_count;
    }

    public function get_program_obj() {
        return Orm_Program::get_instance($this->get_program_id());
    }
}

