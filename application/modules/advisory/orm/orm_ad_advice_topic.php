<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Ad_Advice_Topic extends Orm {
    
    /**
    * @var $instances Orm_Ad_Advice_Topic[]
    */
    protected static $instances = array();
    protected static $table_name = 'ad_advice_topic';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $topic_ar = '';
    protected $topic_en = '';
    protected $user_id = '';
    protected $program_id = '';
    protected $is_deleted = '0';
    protected $created_at = '0000-00-00 00:00:00';
    
    /**
    * @return Ad_Advice_Topic_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Ad_Advice_Topic_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Ad_Advice_Topic
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
    * @return Orm_Ad_Advice_Topic[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Ad_Advice_Topic
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Ad_Advice_Topic();
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
        $db_params['topic_ar'] = $this->get_topic_ar();
        $db_params['topic_en'] = $this->get_topic_en();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['program_id'] = $this->get_program_id();
        $db_params['is_deleted'] = $this->get_is_deleted();
        $db_params['created_at'] = $this->get_created_at();
        
        return $db_params;
    }

    /**
     * @return int
     */
    public function save() {

        if ($this->get_object_status() == 'new') {
            $this->set_created_at(date('Y-m-d H:i:s'));
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
     * this function set id
     * @param int $value the database
     */
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }

    /**
     *this function get id
     * @return int the controller
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * this function set topic ar
     * @param string $value the database
     */
    public function set_topic_ar($value) {
        $this->add_object_field('topic_ar', $value);
        $this->topic_ar = $value;
    }

    /**
     *this function get topic_ar
     * @return string the controller
     */
    public function get_topic_ar() {
        return $this->topic_ar;
    }

    /**
     * this function set topic en
     * @param string $value the database
     */
    public function set_topic_en($value) {
        $this->add_object_field('topic_en', $value);
        $this->topic_en = $value;
    }

    /**
     *this function get topic en
     * @return string the controller
     */
    public function get_topic_en() {
        return $this->topic_en;
    }

    /**
     *this function get user id
     * @param mixed|null|string $lang of the controller
     * @return string the controller
     */
    public function get_topic($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_topic_ar();
        }
        return $this->get_topic_en();
    }

    /**
     * this function set user id
     * @param int $value the database
     */
    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }

    /**
     *this function get user id
     * @return int the controller
     */
    public function get_user_id() {
        return $this->user_id;
    }

    /**
     * this function set program id
     * @param int $value the database
     */
    public function set_program_id($value) {
        $this->add_object_field('program_id', $value);
        $this->program_id = $value;
    }

    /**
     *this function get program id
     * @return int the controller
     */
    public function get_program_id() {
        return $this->program_id;
    }
    /**
     * this function set is deleted
     * @param int $value the database
     */
    public function set_is_deleted($value) {
        $this->add_object_field('is_deleted', $value);
        $this->is_deleted = $value;
    }

    /**
     *this function get is deleted
     * @return int the controller
     */
    public function get_is_deleted() {
        return $this->is_deleted;
    }

    /**
     * this function set created at
     * @param int $value the database
     */
    public function set_created_at($value) {
        $this->add_object_field('created_at', $value);
        $this->created_at = $value;
    }

    /**
     *this function get created at
     * @return int the controller
     */
    public function get_created_at() {
        return $this->created_at;
    }
    
    
}

