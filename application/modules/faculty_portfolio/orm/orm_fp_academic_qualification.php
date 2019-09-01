<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Academic_Qualification extends Orm {
    
    /**
    * @var $instances Orm_Fp_Academic_Qualification[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_academic_qualification';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $country = '';
    protected $city = '';
    protected $university = '';
    protected $college = '';
    protected $date_from = '0000-00-00';
    protected $date_to = '0000-00-00';
    protected $degree = '';
    protected $grade = '';
    protected $speciality = '';
    protected $supervisor_name = '';
    protected $thises_title = '';
    protected $description = '';
    
    /**
    * @return Fp_Academic_Qualification_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Academic_Qualification_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Academic_Qualification
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
    * @return Orm_Fp_Academic_Qualification[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Academic_Qualification
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Academic_Qualification();
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
        $db_params['country'] = $this->get_country();
        $db_params['city'] = $this->get_city();
        $db_params['university'] = $this->get_university();
        $db_params['college'] = $this->get_college();
        $db_params['date_from'] = $this->get_date_from();
        $db_params['date_to'] = $this->get_date_to();
        $db_params['degree'] = $this->get_degree();
        $db_params['grade'] = $this->get_grade();
        $db_params['speciality'] = $this->get_speciality();
        $db_params['supervisor_name'] = $this->get_supervisor_name();
        $db_params['thises_title'] = $this->get_thises_title();
        $db_params['description'] = $this->get_description();
        
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
    public function set_country($value) {
        $this->add_object_field('country', $value);
        $this->country = $value;
    }

    /**
     * @return string
     */
    public function get_country() {
        return $this->country;
    }

    /**
     * @param $value
     */
    public function set_city($value) {
        $this->add_object_field('city', $value);
        $this->city = $value;
    }

    /**
     * @return string
     */
    public function get_city() {
        return $this->city;
    }

    /**
     * @param $value
     */
    public function set_university($value) {
        $this->add_object_field('university', $value);
        $this->university = $value;
    }

    /**
     * @return string
     */
    public function get_university() {
        return $this->university;
    }

    /**
     * @param $value
     */
    public function set_college($value) {
        $this->add_object_field('college', $value);
        $this->college = $value;
    }

    /**
     * @return string
     */
    public function get_college() {
        return $this->college;
    }

    /**
     * @param $value
     */
    public function set_date_from($value) {
        $this->add_object_field('date_from', $value);
        $this->date_from = $value;
    }

    /**
     * @return string
     */
    public function get_date_from() {
        return $this->date_from;
    }

    /**
     * @param $value
     */
    public function set_date_to($value) {
        $this->add_object_field('date_to', $value);
        $this->date_to = $value;
    }

    /**
     * @return string
     */
    public function get_date_to() {
        return $this->date_to;
    }

    /**
     * @param $value
     */
    public function set_degree($value) {
        $this->add_object_field('degree', $value);
        $this->degree = $value;
    }

    /**
     * @return string
     */
    public function get_degree() {
        return $this->degree;
    }

    /**
     * @param $value
     */
    public function set_grade($value) {
        $this->add_object_field('grade', $value);
        $this->grade = $value;
    }

    /**
     * @return string
     */
    public function get_grade() {
        return $this->grade;
    }

    /**
     * @param $value
     */
    public function set_speciality($value) {
        $this->add_object_field('speciality', $value);
        $this->speciality = $value;
    }

    /**
     * @return string
     */
    public function get_speciality() {
        return $this->speciality;
    }

    /**
     * @param $value
     */
    public function set_supervisor_name($value) {
        $this->add_object_field('supervisor_name', $value);
        $this->supervisor_name = $value;
    }

    /**
     * @return string
     */
    public function get_supervisor_name() {
        return $this->supervisor_name;
    }

    /**
     * @param $value
     */
    public function set_thises_title($value) {
        $this->add_object_field('thises_title', $value);
        $this->thises_title = $value;
    }

    /**
     * @return string
     */
    public function get_thises_title() {
        return $this->thises_title;
    }

    /**
     * @param $value
     */
    public function set_description($value) {
        $this->add_object_field('description', $value);
        $this->description = $value;
    }

    /**
     * @return string
     */
    public function get_description() {
        return $this->description;
    }
    
    
}

