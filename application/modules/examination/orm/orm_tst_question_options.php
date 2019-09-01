<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tst_Question_Options extends Orm {
    
    /**
    * @var $instances Orm_Tst_Question_Options[]
    */
    protected static $instances = array();
    protected static $table_name = 'tst_question_options';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $question_id = 0;
    protected $text_ar = '';
    protected $text_en = '';
    protected $correct = 0;

    /**
    * @return Tst_Question_Options_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Tst_Question_Options_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Tst_Question_Options
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
    * @return Orm_Tst_Question_Options[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Tst_Question_Options
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Tst_Question_Options();
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
        $db_params['question_id'] = $this->get_question_id();
        $db_params['text_ar'] = $this->get_text_ar();
        $db_params['text_en'] = $this->get_text_en();
        $db_params['correct'] = $this->get_correct();

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
    
    public function set_question_id($value) {
        $this->add_object_field('question_id', $value);
        $this->question_id = $value;
    }
    
    public function get_question_id() {
        return $this->question_id;
    }
    
    public function set_text_ar($value) {
        $this->add_object_field('text_ar', $value);
        $this->text_ar = $value;
    }
    
    public function get_text_ar() {
        return $this->text_ar;
    }
    
    public function set_text_en($value) {
        $this->add_object_field('text_en', $value);
        $this->text_en = $value;
    }
    
    public function get_text_en() {
        return $this->text_en;
    }

    public function set_correct($value) {
        $this->add_object_field('correct', $value);
        $this->correct = $value;
    }

    public function get_correct() {
        return $this->correct;
    }


    public function get_choice($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_text_ar();
        }

        return $this->get_text_en();
    }


    /** delete old choices for the specific question
    */
    public static function delete_old_choices($question_id, $exclude_ids){
        return self::get_model()->delete_old_choices($question_id, $exclude_ids);
    }

    public static function get_choice_ids($question_id, $correct=false){
        return self::get_model()->get_choice_ids($question_id, $correct);
    }

    public function get_user_response($filters = array()) {

        if(!is_array($filters)) {
            $filters = array();
        }

        $filters['choice_id'] = $this->get_id();
        $filters['question_id'] = $this->get_question_id();

        return Orm_Survey_User_Response_Choice::get_count($filters); // todo change to test response
    }


}

