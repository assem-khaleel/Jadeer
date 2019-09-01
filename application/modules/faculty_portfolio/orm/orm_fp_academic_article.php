<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Academic_Article extends Orm {
    
    /**
    * @var $instances Orm_Fp_Academic_Article[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_academic_article';

    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $authors = '';
    protected $year = 0;
    protected $author_type = 0;
    protected $title = '';
    protected $publisher = '';

    const Author_Type_1 = 1;
    const Author_Type_2 = 2;
    const Author_Type_3 = 3;

    public static $author_types = array(
        self::Author_Type_1 => 'Main Author',
        self::Author_Type_2 => 'Co – Author',
        self::Author_Type_3 => 'Other',
    );
    
    /**
    * @return Fp_Academic_Article_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Academic_Article_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_Academic_Article
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
    * @return Orm_Fp_Academic_Article[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_Academic_Article
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_Academic_Article();
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
        $db_params['authors'] = $this->get_authors();
        $db_params['year'] = $this->get_year();
        $db_params['author_type'] = $this->get_author_type();
        $db_params['title'] = $this->get_title();
        $db_params['publisher'] = $this->get_publisher();
        
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
    public function set_year($value) {
        $this->add_object_field('year', $value);
        $this->year = $value;
    }

    /**
     * @return int
     */
    public function get_year() {
        return $this->year;
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
    public function get_author_type($to_string = false)
    {
        if ($to_string) {
            return (isset(self::$author_types[$this->author_type]) ? self::$author_types[$this->author_type] : '');
        }

        return $this->author_type;
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
    
    
}

