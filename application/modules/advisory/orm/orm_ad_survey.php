<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Ad_Survey extends Orm {
    
    /**
    * @var $instances Orm_Ad_Survey[]
    */
    protected static $instances = array();
    protected static $table_name = 'ad_survey';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $faculty_id = 0;
    protected $survey_id = 0;
    protected $survey_status = 0;

    const USER_ALL_EVALUATION = 0;
    const USER_CUSTOM_EVALUATION = 1;


    public static $status = array(
        self::USER_ALL_EVALUATION => 'All Users',
        self::USER_CUSTOM_EVALUATION => 'Custom Users',
    );
    
    /**
    * @return Ad_Survey_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Ad_Survey_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Ad_Survey
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
    * @return Orm_Ad_Survey[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Ad_Survey
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Ad_Survey();
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

    /**
     * @return array
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['faculty_id'] = $this->get_faculty_id();
        $db_params['survey_id'] = $this->get_survey_id();
        $db_params['survey_status'] = $this->get_survey_status();
        
        return $db_params;
    }

    /**
     * @return int
     */
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

    /**
     * @return bool
     */
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }

    /**
     * @param $value
     */
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }

    /**
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * @param $value
     */
    public function set_faculty_id($value) {
        $this->add_object_field('faculty_id', $value);
        $this->faculty_id = $value;
    }

    /**
     * @return int
     */
    public function get_faculty_id() {
        return $this->faculty_id;
    }

    /**
     * @param $value
     */
    public function set_survey_id($value) {
        $this->add_object_field('survey_id', $value);
        $this->survey_id = $value;
    }

    /**
     * @return int
     */
    public function get_survey_id() {
        return $this->survey_id;
    }

    /**
     * @param $value
     */
    public function set_survey_status($value) {
        $this->add_object_field('survey_status', $value);
        $this->survey_status = $value;
    }

    /**
     * @param bool $to_string
     * @return int|mixed|string
     */
    public function get_survey_status($to_string = false) {
        if ($to_string) {
            return (isset(self::$status[$this->survey_status]) ? self::$status[$this->survey_status] : '');
        }
        return $this->survey_status;
    }
    
    
}

