<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Dissertation extends Orm {
    
    /**
    * @var $instances Orm_Fp_Dissertation[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_dissertation';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $level = 0;
    protected $semester_id = 0;
    protected $is_new = 0;
    protected $is_main = 0;
    protected $dissertation_no = 0;
    
    /**
    * @return Fp_Dissertation_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Dissertation_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Dissertation
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
    * @return Orm_Fp_Dissertation[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Dissertation
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Dissertation();
    }

    /**
     * get count
     *
     * @param array $filters
     * @return array
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
        $db_params['user_id'] = $this->get_user_id();
        $db_params['level'] = $this->get_level();
        $db_params['semester_id'] = $this->get_semester_id();
        $db_params['is_new'] = $this->get_is_new();
        $db_params['is_main'] = $this->get_is_main();
        $db_params['dissertation_no'] = $this->get_dissertation_no();
        
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
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }

    /**
     * @return int
     */
    public function get_user_id() {
        return $this->user_id;
    }

    /**
     * @param $value
     */
    public function set_level($value) {
        $this->add_object_field('level', $value);
        $this->level = $value;
    }

    /**
     * @param bool $to_string
     * @return int|string
     */
    public function get_level($to_string = false)
    {
        if ($to_string) {
            return (isset(Orm_Fp_Advising::$levels[$this->level]) ? Orm_Fp_Advising::$levels[$this->level] : '');
        }

        return $this->level;
    }

    /**
     * @param $value
     */
    public function set_semester_id($value) {
        $this->add_object_field('semester_id', $value);
        $this->semester_id = $value;
    }

    /**
     * @return int
     */
    public function get_semester_id() {
        return $this->semester_id;
    }

    /**
     * @param $value
     */
    public function set_is_new($value) {
        $this->add_object_field('is_new', $value);
        $this->is_new = $value;
    }

    /**
     * @return int
     */
    public function get_is_new() {
        return $this->is_new;
    }

    /**
     * @param $value
     */
    public function set_is_main($value) {
        $this->add_object_field('is_main', $value);
        $this->is_main = $value;
    }

    /**
     * @return int
     */
    public function get_is_main() {
        return $this->is_main;
    }

    /**
     * @param $value
     */
    public function set_dissertation_no($value) {
        $this->add_object_field('dissertation_no', $value);
        $this->dissertation_no = $value;
    }

    /**
     * @return int
     */
    public function get_dissertation_no() {
        return $this->dissertation_no;
    }

    /**
     * @return Orm_Semester
     */
    public function get_semester_obj() {
        return Orm_Semester::get_instance($this->get_semester_id());
    }
}

