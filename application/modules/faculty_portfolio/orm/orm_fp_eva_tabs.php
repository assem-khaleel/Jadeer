<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Eva_Tabs extends Orm {
    
    /**
    * @var $instances Orm_Fp_Eva_Tabs[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_eva_tabs';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $legend_id = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $points = 0;
    protected $is_delete = 0;

    /**
    * @return Fp_Eva_Tabs_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Eva_Tabs_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Eva_Tabs
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
    * @return Orm_Fp_Eva_Tabs[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Eva_Tabs
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Eva_Tabs();
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
        $db_params['legend_id'] = $this->get_legend_id();
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['points'] = $this->get_points();
        $db_params['is_delete'] = $this->get_is_delete();

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
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_title($lang = UI_LANG){
        if($lang=='arabic'){
            return $this->get_title_ar();
        }

        return $this->get_title_en();
    }

    /**
     * @param $value
     */
    public function set_title_en($value) {
        $this->add_object_field('title_en', $value);
        $this->title_en = $value;
    }

    /**
     * @return string
     */
    public function get_title_en() {
        return $this->title_en;
    }

    /**
     * @param $value
     */
    public function set_title_ar($value) {
        $this->add_object_field('title_ar', $value);
        $this->title_ar = $value;
    }

    /**
     * @return string
     */
    public function get_title_ar() {
        return $this->title_ar;
    }

    /**
     * @param $value
     */
    public function set_is_delete($value) {
        $this->add_object_field('is_delete', $value);
        $this->is_delete= $value;
    }

    /**
     * @return int
     */
    public function get_is_delete() {
        return $this->is_delete;
    }

    /**
     * @param $value
     */
    public function set_points($value) {
        $this->add_object_field('points', $value);
        $this->points = $value;
    }

    /**
     * @return int
     */
    public function get_points() {
        return $this->points;
    }

    /**
     * @param $value
     */
    public function set_legend_id($value) {
        $this->add_object_field('legend_id', $value);
        $this->legend_id = $value;
    }

    /**
     * @param bool $obj
     * @return int|Orm_Fp_Legend
     */
    public function get_legend_id($obj = false) {
        if($obj){
            return Orm_Fp_Legend::get_instance($this->legend_id);
        }
        return $this->legend_id;
    }

    /**
     * @return int|Orm_Fp_Eva_Tab_Col[]
     */
    public function get_tab_cols() {
        return Orm_Fp_Eva_Tab_Col::get_all(['eva_tab_id'=> $this->get_id()], 0, 0, ['id']);
    }

    /**
     * @return int|Orm_Fp_Eva_Tab_Row[]
     */
    public function get_tab_rows() {
        return Orm_Fp_Eva_Tab_Row::get_all(['eva_tab_id'=> $this->get_id()], 0, 0, ['id']);
    }

    /**
     * this function get evaluation by its row id and col id and academic year and user id
     * @param int $row_id the row id  of the call to be controller
     * @param int $col_id the col id of the call to be controller
     * @param int $academic_year the academic year of the call to be controller
     * @param int $user_id the user id  of the call to be controller
     * @return Orm_Fp_Evaluation
     */
    public function get_evaluation($row_id, $col_id, $academic_year, $user_id=0){
        if($user_id==0) {
            $user_id = Orm_User::get_logged_user_id();
        }

        return Orm_Fp_Evaluation::get_one(['user_id'=>$user_id, 'eva_tab_id' => $this->get_id(), 'academic_year'=>$academic_year, 'eva_tab_col_id' => $col_id, 'eva_tab_row_id' => $row_id]);
    }

    /**
     * this function academic year list by its user id
     * @param int $user_id the user id  of the call to be controller
     * @return array
     */
    public function academic_year_list($user_id=0) {
        if(!$user_id) {
            $user_id = Orm_user::get_logged_user_id();
        }

        return self::get_model()->get_academic_years($this->get_id(), $user_id);
    }

    /**
     * this function get evaluation by rows by its user id
     * @param int $user_id the user id  of the call to be controller
     * @return mixed
     */
    public function get_evaluation_by_rows($user_id=0) {
        if($user_id==0) {
            $user_id = Orm_User::get_logged_user_id();
        }

        return Orm_Fp_Evaluation::get_avg_rows($this->get_id(), $user_id);
    }

    /**
     * this function have evaluation
     * @return bool
     */
    public function have_evaluation() {
        $evaluation = Orm_Fp_Evaluation::get_one(['eva_tab_id'=> $this->get_id()]);

        return boolval($evaluation->get_id());
    }
}

