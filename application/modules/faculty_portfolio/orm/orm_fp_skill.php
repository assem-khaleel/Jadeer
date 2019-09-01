<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Skill extends Orm {
    
    /**
    * @var $instances Orm_Fp_Skill[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_skill';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $name = '';
    protected $rank = 0;

    const RANK_1 = 1;
    const RANK_2 = 2;
    const RANK_3 = 3;

    public static $skill_ranks = array(
        self::RANK_1 => 'Junior',
        self::RANK_2 => 'Intermediate',
        self::RANK_3 => 'Expert',
    );
    
    /**
    * @return Fp_Skill_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Skill_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Skill
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
    * @return Orm_Fp_Skill[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Skill
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Skill();
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
        $db_params['name'] = $this->get_name();
        $db_params['rank'] = $this->get_rank();
        
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
    public function set_name($value) {
        $this->add_object_field('name', $value);
        $this->name = $value;
    }

    /**
     * @return string
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * @param $value
     */
    public function set_rank($value) {
        $this->add_object_field('rank', $value);
        $this->rank = $value;
    }

    /**
     * @param bool $to_string
     * @return int|mixed|string
     */
    public function get_rank($to_string = false) {

        if($to_string) {
            return isset(self::$skill_ranks[$this->rank]) ? self::$skill_ranks[$this->rank] : '';
        }

        return $this->rank;
    }
    
    
}

