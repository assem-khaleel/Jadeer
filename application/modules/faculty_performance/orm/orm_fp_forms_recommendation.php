<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Forms_Recommendation extends Orm {

    /**
     * @var $instances Orm_Fp_Forms_Recommendation[]
     */
    protected static $instances = array();
    protected static $table_name = 'fp_forms_recommendation';

    /**
     * class attributes
     */
    protected $recommendation_ar = '';
    protected $recommendation_en = '';
    protected $action_ar = '';
    protected $action_en = '';
    protected $deadline_id = 0;
    protected $category_id = 0;
    protected $type_id = 0;
    protected $id = 0;

    /**
     * @return Fp_Forms_Recommendation_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Forms_Recommendation_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Fp_Forms_Recommendation
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
     * @return Orm_Fp_Forms_Recommendation[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Fp_Forms_Recommendation
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Fp_Forms_Recommendation();
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
        $db_params['recommendation_ar'] = $this->get_recommendation_ar();
        $db_params['recommendation_en'] = $this->get_recommendation_en();
        $db_params['action_ar'] = $this->get_action_ar();
        $db_params['action_en'] = $this->get_action_en();
        $db_params['deadline_id'] = $this->get_deadline_id();
        $db_params['category_id'] = $this->get_category_id();
        $db_params['type_id'] = $this->get_type_id();
        $db_params['id'] = $this->get_id();

        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            self::get_model()->insert($this->to_array());
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this;
    }

    public function delete() {
        return self::get_model()->delete($this->get_id());
    }

    public function set_recommendation_ar($value) {
        $this->add_object_field('recommendation_ar', $value);
        $this->recommendation_ar = $value;
    }

    public function get_recommendation_ar() {
        return $this->recommendation_ar;
    }

    public function set_recommendation_en($value) {
        $this->add_object_field('recommendation_en', $value);
        $this->recommendation_en = $value;
    }

    public function get_recommendation_en() {
        return $this->recommendation_en;
    }

    public function set_action_ar($value) {
        $this->add_object_field('action_ar', $value);
        $this->action_ar = $value;
    }

    public function get_action_ar() {
        return $this->action_ar;
    }

    public function set_action_en($value) {
        $this->add_object_field('action_en', $value);
        $this->action_en = $value;
    }

    public function get_action_en() {
        return $this->action_en;
    }

    public function set_deadline_id($value) {
        $this->add_object_field('deadline_id', $value);
        $this->deadline_id = $value;
    }

    public function get_deadline_id() {
        return $this->deadline_id;
    }

    public function set_category_id($value) {
        $this->add_object_field('category_id', $value);
        $this->category_id = $value;
    }

    public function get_category_id() {
        return $this->category_id;
    }
    public function set_type_id($value) {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }

    public function get_type_id() {
        return $this->type_id;
    }
    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;

        $this->push_instance();
    }

    public function get_id() {
        return $this->id;
    }

    /**
     * get all recommendation for specific on the category ( program , college, faculty) and the following :
     * @param $category_id
     * @param $type_id
     * @param int $deadline
     * @return int|Orm_Fp_Forms_Recommendation|Orm_Fp_Forms_Recommendation[]
     */
    public static function get_recmmedation_by_values($category_id, $type_id, $deadline=0){

        if(intval($deadline) == 0){

            $deadline = Orm_Fp_Forms_Deadline::get_current_deadline();

        }elseif(intval($deadline) < 0){

            return self::get_all(['category_id'=>$category_id,'type_id'=>$type_id]);
        }

        return self::get_one(['category_id'=>$category_id,'type_id'=>$type_id,'deadline_id'=>$deadline]);
    }

    /**
     * get recommendation depends on active language
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_recommendation($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_recommendation_ar();
        }
        return $this->get_recommendation_en();
    }

    /**
     * get action depends on active language
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_action($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_action_ar();
        }
        return $this->get_action_en();
    }


}

