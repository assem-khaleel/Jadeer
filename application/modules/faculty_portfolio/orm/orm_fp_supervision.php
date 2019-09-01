<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Supervision extends Orm {
    
    /**
    * @var $instances Orm_Fp_Supervision[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_supervision';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $thises_type = 0;
    protected $type = 0;
    protected $level = 0;
    protected $thises_title_ar = '';
    protected $thises_title_en = '';
    protected $grant_date = '0000-00-00';
    protected $researcher = '';
    protected $summary_ar = '';
    protected $summary_en = '';
    protected $attachment = '';

    const TYPE_THESIS = 1;
    const TYPE_PROJECT = 2;

    public static $types = array(
        self::TYPE_THESIS => 'Thesis',
        self::TYPE_PROJECT => 'Project'
    );
    
    /**
    * @return Fp_Supervision_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Supervision_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Supervision
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
    * @return Orm_Fp_Supervision[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Supervision
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Supervision();
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
        $db_params['user_id'] = $this->get_user_id();
        $db_params['thises_type'] = $this->get_thises_type();
        $db_params['type'] = $this->get_type();
        $db_params['level'] = $this->get_level();
        $db_params['thises_title_ar'] = $this->get_thises_title_ar();
        $db_params['thises_title_en'] = $this->get_thises_title_en();
        $db_params['grant_date'] = $this->get_grant_date();
        $db_params['researcher'] = $this->get_researcher();
        $db_params['summary_ar'] = $this->get_summary_ar();
        $db_params['summary_en'] = $this->get_summary_en();
        $db_params['attachment'] = $this->get_attachment();

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
    public function set_thises_type($value) {
        $this->add_object_field('thises_type', $value);
        $this->thises_type = $value;
    }

    /**
     * @return int
     */
    public function get_thises_type() {
        return $this->thises_type;
    }

    /**
     * @param $value
     */
    public function set_type($value) {
        $this->add_object_field('type', $value);
        $this->type = $value;
    }

    /**
     * @return int
     */
    public function get_type() {
        return $this->type;
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
    public function set_thises_title_ar($value) {
        $this->add_object_field('thises_title_ar', $value);
        $this->thises_title_ar = $value;
    }

    /**
     * @return string
     */
    public function get_thises_title_ar() {
        return $this->thises_title_ar;
    }

    /**
     * @param $value
     */
    public function set_thises_title_en($value) {
        $this->add_object_field('thises_title_en', $value);
        $this->thises_title_en = $value;
    }

    /**
     * @return string
     */
    public function get_thises_title_en() {
        return $this->thises_title_en;
    }

    /**
     * @param $value
     */
    public function set_grant_date($value) {
        $this->add_object_field('grant_date', $value);
        $this->grant_date = $value;
    }

    /**
     * @return string
     */
    public function get_grant_date() {
        return $this->grant_date;
    }

    /**
     * @param $value
     */
    public function set_researcher($value) {
        $this->add_object_field('researcher', $value);
        $this->researcher = $value;
    }

    /**
     * @return string
     */
    public function get_researcher() {
        return $this->researcher;
    }

    /**
     * @param $value
     */
    public function set_summary_ar($value) {
        $this->add_object_field('summary_ar', $value);
        $this->summary_ar = $value;
    }

    /**
     * @return string
     */
    public function get_summary_ar() {
        return $this->summary_ar;
    }

    /**
     * @param $value
     */
    public function set_summary_en($value) {
        $this->add_object_field('summary_en', $value);
        $this->summary_en = $value;
    }

    /**
     * @return string
     */
    public function get_summary_en() {
        return $this->summary_en;
    }

    /**
     * @param $value
     */
    public function set_attachment($value) {
        $this->add_object_field('attachment', $value);
        $this->attachment = $value;
    }

    /**
     * @return string
     */
    public function get_attachment() {
        return $this->attachment;
    }

    /**
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_thises_title($lang = UI_LANG) {
        if($lang=='arabic') {
            return $this->get_thises_title_ar();
        }
        return $this->get_thises_title_en();
    }
    
}

