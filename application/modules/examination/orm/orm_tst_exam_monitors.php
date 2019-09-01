<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tst_Exam_Monitors extends Orm {
    
    /**
    * @var $instances Orm_Tst_Exam_Monitors[]
    */
    protected static $instances = array();
    protected static $table_name = 'tst_exam_monitors';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $exam_id = 0;
    protected $monitor_id = 0;

    /**
    * @return Tst_Exam_Monitors_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Tst_Exam_Monitors_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Tst_Exam_Monitors
    */
    public static function get_instance($id) {
        
        $id = intval($id);
        
        if(isset(self::$instances[$id])) {
            return self::$instances[$id];
        }
        
        return self::get_one(array('id' => $id));
    }

    public static function get_instance_monitor($monitor_id) {

        $monitor_id = intval($monitor_id);

        if(isset(self::$instances[$monitor_id])) {
            return self::$instances[$monitor_id];
        }

        return self::get_one(array('monitor_id' => $monitor_id));
    }
    
    /**
    * Get all rows as Objects
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    *
    * @return Orm_Tst_Exam_Monitors[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Tst_Exam_Monitors
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Tst_Exam_Monitors();
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
        $db_params['exam_id'] = $this->get_exam_id();
        $db_params['monitor_id'] = $this->get_monitor_id();

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
    
    public function set_exam_id($value) {
        $this->add_object_field('exam_id', $value);
        $this->exam_id = $value;
    }
    
    public function get_exam_id() {
        return $this->exam_id;
    }
    
    public function set_monitor_id($value) {
        $this->add_object_field('monitor_id', $value);
        $this->monitor_id = $value;
    }
    
    public function get_monitor_id($obj=false) {
        if($obj) {
            return Orm_User::get_instance($this->monitor_id);
        }

        return $this->monitor_id;
    }


    public static function get_exams($monitor_exams=array(), $exam_filters = array()){
        /**
         * @var $monitor_exams Orm_Tst_Exam_Monitors[]
         */
        $exams_instances = array();
        $exam_filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        foreach ($monitor_exams as $exam){
            $exam_filters['id'] = $exam->get_exam_id();
            $exam = Orm_Tst_Exam::get_one($exam_filters);

            if ($exam->get_id())
                $exams_instances[] = $exam;

        }
        return $exams_instances;
    }
    
}

