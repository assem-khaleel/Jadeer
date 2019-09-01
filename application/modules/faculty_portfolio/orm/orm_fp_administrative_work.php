<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Administrative_Work extends Orm {
    
    /**
    * @var $instances Orm_Fp_Administrative_Work[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_administrative_work';


    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $start_date = '0000-00-00';
    protected $end_date = '0000-00-00';
    protected $position = '';
    protected $college_id = 0;
    protected $department_id = 0;
    protected $deanship_id = 0;
    protected $vice_recotrate = '';
    protected $type = 0;


    const TYPE_COLLEGE = 1;
    const TYPE_DEPARTMENT = 2;
    const TYPE_DEANSHIP = 3;
    const TYPE_VICE_RECOTRATE = 4;



    /**
    * @return Fp_Administrative_Work_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Administrative_Work_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Administrative_Work
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
    * @return Orm_Fp_Administrative_Work[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Administrative_Work
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Administrative_Work();
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
        $db_params['start_date'] = $this->get_start_date();
        $db_params['end_date'] = $this->get_end_date();
        $db_params['position'] = $this->get_position();
        $db_params['college_id'] = $this->get_college_id();
        $db_params['department_id'] = $this->get_department_id();
        $db_params['deanship_id'] = $this->get_deanship_id();
        $db_params['vice_recotrate'] = $this->get_vice_recotrate();
        $db_params['type'] = $this->get_type();
        
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
    public function set_start_date($value) {
        $this->add_object_field('start_date', $value);
        $this->start_date = $value;
    }

    /**
     * @return string
     */
    public function get_start_date() {
        return $this->start_date;
    }

    /**
     * @param $value
     */
    public function set_end_date($value) {
        $this->add_object_field('end_date', $value);
        $this->end_date = $value;
    }

    /**
     * @return string
     */
    public function get_end_date() {
        return $this->end_date;
    }

    /**
     * @param $value
     */
    public function set_position($value) {
        $this->add_object_field('position', $value);
        $this->position = $value;
    }

    /**
     * @return string
     */
    public function get_position() {
        return $this->position;
    }

    /**
     * @param $value
     */
    public function set_college_id($value) {
        $this->add_object_field('college_id', $value);
        $this->college_id = $value;
    }

    /**
     * @return int
     */
    public function get_college_id() {
        return $this->college_id;
    }

    /**
     * @param $value
     */
    public function set_department_id($value) {
        $this->add_object_field('department_id', $value);
        $this->department_id = $value;
    }

    /**
     * @return int
     */
    public function get_department_id() {
        return $this->department_id;
    }

    /**
     * @param $value
     */
    public function set_deanship_id($value) {
        $this->add_object_field('deanship_id', $value);
        $this->deanship_id = $value;
    }

    /**
     * @return int
     */
    public function get_deanship_id() {
        return $this->deanship_id;
    }

    /**
     * @param $value
     */
    public function set_vice_recotrate($value) {
        $this->add_object_field('vice_recotrate', $value);
        $this->vice_recotrate = $value;
    }

    /**
     * @return string
     */
    public function get_vice_recotrate() {
        return $this->vice_recotrate;
    }

    /**
     * @param $value
     */
    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }

    /**
     * @param bool $to_string
     * @return int|mixed
     */
    public function get_type($to_string = false) {
        if($to_string) {
            return self::get_types_array()[$this->type];
        }
        return $this->type;
    }

    /**
     * @return array
     */
    public static function get_types_array() {
        return [
            self::TYPE_COLLEGE        => lang('College'),
            self::TYPE_DEPARTMENT     => lang('Department'),
            self::TYPE_DEANSHIP       => lang('Deanship'),
            self::TYPE_VICE_RECOTRATE => lang('Vice Rectorate')
        ];
    }
    
}

