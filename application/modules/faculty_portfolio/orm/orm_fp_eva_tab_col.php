<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Eva_Tab_Col extends Orm {
    
    /**
    * @var $instances Orm_Fp_Eva_Tab_Col[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_eva_tab_col';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $title_en = '';
    protected $title_ar = '';
    protected $eva_tab_id = 0;
    
    /**
    * @return Fp_Eva_Tab_Col_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Eva_Tab_Col_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Eva_Tab_Col
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
    * @return Orm_Fp_Eva_Tab_Col[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Eva_Tab_Col
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Eva_Tab_Col();
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
        $db_params['title_en'] = $this->get_title_en();
        $db_params['title_ar'] = $this->get_title_ar();
        $db_params['eva_tab_id'] = $this->get_eva_tab_id();
        
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
    public function set_eva_tab_id($value) {
        $this->add_object_field('eva_tab_id', $value);
        $this->eva_tab_id = $value;
    }

    /**
     * @param bool $obj
     * @return int|Orm_Fp_Eva_Tabs
     */
    public function get_eva_tab_id($obj = false) {
        if($obj){
            return Orm_Fp_Eva_Tabs::get_instance($this->eva_tab_id);
        }
        return $this->eva_tab_id;
    }

    /**
     * this function get evaluation by its row id and academic year and user id
     * @param int $row_id the row id  of the call to be controller
     * @param int $academic_year the academic year of the call to be controller
     * @param int $user_id the user id  of the call to be controller
     * @return Orm_Fp_Evaluation
     */
    public function get_evaluation($row_id, $academic_year, $user_id=0) {
        return $this->get_eva_tab_id(true)->get_evaluation($row_id, $this->get_id(), $academic_year, $user_id);
    }
    
    
}

