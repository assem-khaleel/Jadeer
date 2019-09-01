<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Language extends Orm {
    
    /**
    * @var $instances Orm_Fp_Language[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_language';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $language = '';
    protected $level = 0;

    const LEVEL_1 = 1;
    const LEVEL_2 = 2;
    const LEVEL_3 = 3;
    const LEVEL_4 = 4;
    const LEVEL_5 = 5;

    public static $language_levels = array(
        self::LEVEL_1 => 'Elementary proficiency',
        self::LEVEL_2 => 'Limited working proficiency',
        self::LEVEL_3 => 'Professional working proficiency',
        self::LEVEL_4 => 'Full professional proficiency',
        self::LEVEL_5 => 'Native or bilingual proficiency'
    );
    
    /**
    * @return Fp_Language_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Language_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Language
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
    * @return Orm_Fp_Language[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Language
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Language();
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
        $db_params['language'] = $this->get_language();
        $db_params['level'] = $this->get_level();
        
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
    public function set_language($value) {
        $this->add_object_field('language', $value);
        $this->language = $value;
    }

    /**
     * @return string
     */
    public function get_language() {
        return $this->language;
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
     * @return int|mixed|string
     */
    public function get_level($to_string = false) {

        if($to_string) {
            return isset(self::$language_levels[$this->level]) ? self::$language_levels[$this->level] : '';
        }

        return $this->level;
    }
    
    
}

