<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Tf_Post extends Orm {
    
    /**
    * @var $instances Orm_Tf_Post[]
    */
    protected static $instances = array();
    protected static $table_name = 'tf_post';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $club_id = 0;
    protected $content = '';
    protected $date_created = '0000-00-00 00:00:00';
    protected $creator = 0;
    
    /**
    * @return Tf_Post_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Tf_Post_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Tf_Post
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
    * @return Orm_Tf_Post[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one row as Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Tf_Post
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Tf_Post();
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
    
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['club_id'] = $this->get_club_id();
        $db_params['content'] = $this->get_content();
        $db_params['date_created'] = $this->get_date_created();
        $db_params['creator'] = $this->get_creator();
        
        return $db_params;
    }
    
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
    
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }
    
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;
        
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_club_id($value) {
        $this->add_object_field('club_id', $value);
        $this->club_id = $value;
    }
    
    public function get_club_id() {
        return $this->club_id;
    }
    
    public function set_content($value) {
        $this->add_object_field('content', $value);
        $this->content = $value;
    }
    
    public function get_content() {
        return $this->content;
    }
    
    public function set_date_created($value) {
        $this->add_object_field('date_created', $value);
        $this->date_created = $value;
    }
    
    public function get_date_created() {
        return $this->date_created;
    }
    
    public function set_creator($value) {
        $this->add_object_field('creator', $value);
        $this->creator = $value;
    }
    
    public function get_creator() {
        return $this->creator;
    }

    /**
     * this function get club
     * @return Orm_Tf_Club the object call function
     */
    public function get_club(){
        return Orm_Tf_Club::get_instance($this->get_club_id());
    }
    
    
}

