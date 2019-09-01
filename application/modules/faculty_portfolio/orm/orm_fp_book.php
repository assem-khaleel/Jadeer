<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Book extends Orm {
    
    /**
    * @var $instances Orm_Fp_Book[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_book';


    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $title = '';
    protected $author_type = 0;
    protected $authors = '';
    protected $authors_no = 0;
    protected $publish_date = '0000-00-00';
    protected $publisher = '';
    protected $pages_count = 0;
    protected $attachment = '';
    protected $is_translate = 0;

    const AUTHOR_TYPE_1 = 1;
    const AUTHOR_TYPE_2 = 2;

    public static $author_types = array(
        self::AUTHOR_TYPE_1 => 'Shared',
        self::AUTHOR_TYPE_2 => 'Single'
    );
    
    /**
    * @return Fp_Book_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Book_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Book
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
    * @return Orm_Fp_Book[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Book
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Book();
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
        $db_params['title'] = $this->get_title();
        $db_params['author_type'] = $this->get_author_type();
        $db_params['authors'] = $this->get_authors();
        $db_params['authors_no'] = $this->get_authors_no();
        $db_params['publish_date'] = $this->get_publish_date();
        $db_params['publisher'] = $this->get_publisher();
        $db_params['pages_count'] = $this->get_pages_count();
        $db_params['attachment'] = $this->get_attachment();
        $db_params['is_translate'] = $this->get_is_translate();
        
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
    public function set_title($value) {
        $this->add_object_field('title', $value);
        $this->title = $value;
    }

    /**
     * @return string
     */
    public function get_title() {
        return $this->title;
    }

    /**
     * @param $value
     */
    public function set_author_type($value) {
        $this->add_object_field('author_type', $value);
        $this->author_type = $value;
    }

    /**
     * @param bool $to_string
     * @return int|mixed|string
     */
    public function get_author_type($to_string = false) {

        if($to_string) {
            return isset(self::$author_types[$this->author_type]) ? self::$author_types[$this->author_type] : '';
        }

        return $this->author_type;
    }

    /**
     * @param $value
     */
    public function set_authors($value) {
        $this->add_object_field('authors', $value);
        $this->authors = $value;
    }

    /**
     * @return string
     */
    public function get_authors() {
        return $this->authors;
    }

    /**
     * @param $value
     */
    public function set_authors_no($value) {
        $this->add_object_field('authors_no', $value);
        $this->authors_no = $value;
    }

    /**
     * @return int
     */
    public function get_authors_no() {
        return $this->authors_no;
    }

    /**
     * @param $value
     */
    public function set_publish_date($value) {
        $this->add_object_field('publish_date', $value);
        $this->publish_date = $value;
    }

    /**
     * @return string
     */
    public function get_publish_date() {
        return $this->publish_date;
    }

    /**
     * @param $value
     */
    public function set_publisher($value) {
        $this->add_object_field('publisher', $value);
        $this->publisher = $value;
    }

    /**
     * @return string
     */
    public function get_publisher() {
        return $this->publisher;
    }

    /**
     * @param $value
     */
    public function set_pages_count($value) {
        $this->add_object_field('pages_count', $value);
        $this->pages_count = $value;
    }

    /**
     * @return int
     */
    public function get_pages_count() {
        return $this->pages_count;
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
     * @param $value
     */
    public function set_is_translate($value) {
        $this->add_object_field('is_translate', $value);
        $this->is_translate = $value;
    }

    /**
     * @return int
     */
    public function get_is_translate() {
        return $this->is_translate;
    }
    
    
}

