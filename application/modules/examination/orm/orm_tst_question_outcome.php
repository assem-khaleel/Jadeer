<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tst_Question_Outcome extends Orm {
    
    /**
    * @var $instances Orm_Tst_Question_Outcome[]
    */
    protected static $instances = array();
    protected static $table_name = 'tst_question_outcome';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $question_id = 0;
    protected $outcome_id = 0;
    protected $type = 0;


    const TYPE_PROGRAM_LEARNING_OUTCOME = 1;
    const TYPE_COURSE_LEARNING_OUTCOME = 2;

    /**
    * @return Tst_Question_Outcome_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Tst_Question_Outcome_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Tst_Question_Outcome
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
    * @return Orm_Tst_Question_Outcome[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Tst_Question_Outcome
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Tst_Question_Outcome();
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
        $db_params['outcome_id'] = $this->get_outcome_id();
        $db_params['type'] = $this->get_type();
        
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
    
    public function set_outcome_id($value) {
        $this->add_object_field('outcome_id', $value);
        $this->outcome_id = $value;
    }
    
    public function get_outcome_id() {
        return $this->outcome_id;
    }
    
    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }
    
    public function get_type() {
        return $this->type;
    }

    public function get_types() {
        return [
            self::TYPE_PROGRAM_LEARNING_OUTCOME => lang('Program Learning Outcome'),
            self::TYPE_COURSE_LEARNING_OUTCOME  => lang('Course Learning Outcome')
        ];
    }

    public function get_outcome_name() {

        if(License::get_instance()->check_module('curriculum_mapping')) {

            Modules::load('curriculum_mapping');

            if ($this->get_type() == self::TYPE_PROGRAM_LEARNING_OUTCOME) {
                $plo = Orm_Cm_Program_Learning_Outcome::get_instance($this->get_outcome_id());

                if ($plo && $plo->get_id()) {
                    return $plo->get_learning_domain_obj()->get_title() . ' - ' . $plo->get_code() . ' : ' . $plo->get_text();
                }
            } elseif ($this->get_type() == self::TYPE_COURSE_LEARNING_OUTCOME) {
                $clo = Orm_Cm_Course_Learning_Outcome::get_instance($this->get_outcome_id());

                if ($clo && $clo->get_id()) {
                    return $clo->get_learning_domain_obj()->get_title() . ' - ' . $clo->get_code() . ' : ' . $clo->get_text();
                }
            }
        }

        return '';
    }

    
}

