<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Ad_Student_Faculty extends Orm {
    
    /**
    * @var $instances Orm_Ad_Student_Faculty[]
    */
    protected static $instances = array();
    protected static $table_name = 'ad_student_faculty';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $student_id = 0;
    protected $faculty_id = 0;
    protected $program_id = 0;
    
    /**
    * @return Ad_Student_Faculty_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Ad_Student_Faculty_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Ad_Student_Faculty
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
    * @return Orm_Ad_Student_Faculty[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Ad_Student_Faculty
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Ad_Student_Faculty();
    }

	public static function get_student_ids($filter) {
		$Student_id=[];
		if(empty($Student_id)) {
			$Student_id = array_column(self::get_model()->get_all($filter,0,0, [],Orm::FETCH_ARRAY), 'student_id');
		}

		return $Student_id;

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
        $db_params['student_id'] = $this->get_student_id();
        $db_params['faculty_id'] = $this->get_faculty_id();
        $db_params['program_id'] = $this->get_program_id();
        
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
     * @param array $array
     * @return mixed
     */
    public static function deleteMany($array=[]) {
        return self::get_model()->deleteMany($array);
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
    public function set_student_id($value) {
        $this->add_object_field('student_id', $value);
        $this->student_id = $value;
    }

    /**
     * @return int
     */
    public function get_student_id() {
        return $this->student_id;
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
    public function set_program_id($value) {
        $this->add_object_field('program_id', $value);
        $this->program_id = $value;
    }

    /**
     * @return int
     */
    public function get_program_id() {
        return $this->program_id;
    }

    /**
     * this function get meeting
     * @return array the call function
     */
    function get_meeting(){
      return Orm_Ad_Student_Faculty::get_model()->get_meeting();
    }

    /**
     * this function get user ids
     * @return array the call function
     */
    public function get_user_ids() {
        $return = array_column(Orm_Ad_Student_Faculty::get_model()->get_all(['faculty_id' => $this->get_faculty_id() ], 0, 0, array(), Orm::FETCH_ARRAY), 'student_id');

        return $return;
    }

    
}

