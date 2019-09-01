<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Evaluation extends Orm {
    
    /**
    * @var $instances Orm_Fp_Evaluation[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_evaluation';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $academic_year = 0;
    protected $level = 0;
    protected $user_id = 0;
    protected $user_score = 0;
    protected $peer_id = 0;
    protected $peer_score = 0;
    protected $supervisor_id = 0;
    protected $supervisor_score = 0;
    protected $eva_tab_id = 0;
    protected $eva_tab_col_id = 0;
    protected $eva_tab_row_id = 0;

    const Level_1 = 1;
    const Level_2 = 2;
    const Level_3 = 3;
    const Level_4 = 4;
    const Level_5 = 5;

    public static function get_levels() {
        $levels = array();

        $levels[self::Level_1] = array('point' => 20 ,'name' => 'Course Evaluations');

        if(License::get_instance()->check_module('accreditation')) {
            $levels[self::Level_2] = array('point' => 25 ,'name' => 'Quality Efforts Contribution');
        }

        $levels[self::Level_3] = array('point' => 25 ,'name' => 'Research Contributions');
        $levels[self::Level_4] = array('point' => 15 ,'name' => 'Administrative Work Contribution');
        $levels[self::Level_5] = array('point' => 15 ,'name' => 'Societal Responsibility Contribution');

        return $levels;
    }
    
    /**
    * @return Fp_Evaluation_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Evaluation_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Evaluation
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
    * @return Orm_Fp_Evaluation[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Evaluation
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Evaluation();
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
     * @param $get_id
     * @param $user_id
     * @return mixed
     */
    public static function get_avg_rows($get_id, $user_id) {
        return self::get_model()->get_avg_rows($get_id, $user_id);
    }

    /**
     * @return array
     */
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['academic_year'] = $this->get_academic_year();
        $db_params['level'] = $this->get_level();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['user_score'] = $this->get_user_score();
        $db_params['peer_id'] = $this->get_peer_id();
        $db_params['peer_score'] = $this->get_peer_score();
        $db_params['supervisor_id'] = $this->get_supervisor_id();
        $db_params['supervisor_score'] = $this->get_supervisor_score();
        $db_params['eva_tab_id'] = $this->get_eva_tab_id();
        $db_params['eva_tab_col_id'] = $this->get_eva_tab_col_id();
        $db_params['eva_tab_row_id'] = $this->get_eva_tab_row_id();

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
    public function set_academic_year($value) {
        $this->add_object_field('academic_year', $value);
        $this->academic_year = $value;
    }

    /**
     * @return int
     */
    public function get_academic_year() {
        return $this->academic_year;
    }

    /**
     * @param $value
     */
    public function set_level($value) {
        $this->add_object_field('level', $value);
        $this->level = $value;
    }

    /**
     * @return int
     */
    public function get_level() {
        return $this->level;
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
    public function set_user_score($value) {
        $this->add_object_field('user_score', $value);
        $this->user_score = $value;
    }

    /**
     * @return int
     */
    public function get_user_score() {
        return $this->user_score;
    }

    /**
     * @param $value
     */
    public function set_peer_id($value) {
        $this->add_object_field('peer_id', $value);
        $this->peer_id = $value;
    }

    /**
     * @return int
     */
    public function get_peer_id() {
        return $this->peer_id;
    }

    /**
     * @param $value
     */
    public function set_peer_score($value) {
        $this->add_object_field('peer_score', $value);
        $this->peer_score = $value;
    }

    /**
     * @return int
     */
    public function get_peer_score() {
        return $this->peer_score;
    }

    /**
     * @param $value
     */
    public function set_supervisor_id($value) {
        $this->add_object_field('supervisor_id', $value);
        $this->supervisor_id = $value;
    }

    /**
     * @return int
     */
    public function get_supervisor_id() {
        return $this->supervisor_id;
    }

    /**
     * @param $value
     */
    public function set_supervisor_score($value) {
        $this->add_object_field('supervisor_score', $value);
        $this->supervisor_score = $value;
    }

    /**
     * @return int
     */
    public function get_supervisor_score() {
        return $this->supervisor_score;
    }

    /**
     * @param $value
     */
    public function set_eva_tab_id($value) {
        $this->add_object_field('eva_tab_id', $value);
        $this->eva_tab_id = $value;
    }

    /**
     * @return int
     */
    public function get_eva_tab_id() {
        return $this->eva_tab_id;
    }

    /**
     * @param $value
     */
    public function set_eva_tab_col_id($value) {
        $this->add_object_field('eva_tab_col_id', $value);
        $this->eva_tab_col_id = $value;
    }

    /**
     * @return int
     */
    public function get_eva_tab_col_id() {
        return $this->eva_tab_col_id;
    }

    /**
     * @param $value
     */
    public function set_eva_tab_row_id($value) {
        $this->add_object_field('eva_tab_row_id', $value);
        $this->eva_tab_row_id = $value;
    }

    /**
     * @return int
     */
    public function get_eva_tab_row_id() {
        return $this->eva_tab_row_id;
    }
}

