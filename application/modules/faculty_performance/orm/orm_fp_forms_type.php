<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Forms_Type extends Orm {

    /**
     * @var $instances Orm_Fp_Forms_Type[]
     */
    protected static $instances = array();
    protected static $table_name = 'fp_forms_type';

    const TYPE_TEACHING = 1;
    const TYPE_RESEARCH = 2;
    const TYPE_SERVICE = 3;

    /**
     * class attributes
     */
    protected $id = 0;
    protected $type_name_en = '';
    protected $type_name_ar = '';
    protected $created_at = '0000-00-00 00:00:00';
    protected $updated_at = '0000-00-00 00:00:00';
    protected $deleted_at = 0;
    protected $is_removable = 0;

    /**
     * @return Fp_Forms_Type_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Forms_Type_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Fp_Forms_Type
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
     * @return Orm_Fp_Forms_Type[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Fp_Forms_Type
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Fp_Forms_Type();
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
        $db_params['type_name_en'] = $this->get_type_name_en();
        $db_params['type_name_ar'] = $this->get_type_name_ar();
        $db_params['deleted_at'] = $this->get_deleted_at();
        $db_params['created_at'] = $this->get_created_at();
        $db_params['updated_at'] = $this->get_updated_at();
        $db_params['is_removable'] = $this->get_is_removable();

        return $db_params;
    }

    public function save() {
        $this->set_updated_at(date('Y-m-d H:i:s'));
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

    public function set_type_name_en($value) {
        $this->add_object_field('type_name_en', $value);
        $this->type_name_en = $value;
    }

    public function get_type_name_en() {
        return $this->type_name_en;
    }

    public function set_type_name_ar($value) {
        $this->add_object_field('type_name_ar', $value);
        $this->type_name_ar = $value;
    }

    public function get_type_name_ar() {
        return $this->type_name_ar;
    }

    public function set_created_at($value) {
        $this->add_object_field('created_at', $value);
        $this->created_at = $value;
    }

    public function get_created_at() {
        return $this->created_at;
    }

    public function set_updated_at($value) {
        $this->add_object_field('updated_at', $value);
        $this->updated_at = $value;
    }

    public function get_updated_at() {
        return $this->updated_at;
    }

    public function set_deleted_at($value) {
        $this->add_object_field('deleted_at', $value);
        $this->deleted_at = $value;
    }

    public function get_deleted_at() {
        return intval($this->deleted_at);
    }

    public function set_is_removable($value) {
        $this->add_object_field('is_removable', $value);
        $this->is_removable = $value;
    }

    public function get_is_removable() {
        return $this->is_removable;
    }

    /**
     * get type name depends on active language
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_name($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_type_name_ar();
        }
        return $this->get_type_name_en();
    }

    /**
     * change the value for input " is_delete" from 0 to one
     * @param $type_id
     */
    public function soft_delete($type_id){

        $data = Orm_Fp_Forms::get_one(['type_id'=>$type_id]);
        $rate=Orm_Fp_Forms_Rate::get_one(['type_id'=>$type_id]);
        if(!$data->get_id()){
           $this->set_deleted_at(1);
            if(isset($rate)){
                $rate->set_deleted_at(1);
                $rate->save();
            }

            self::save();
            Validator::set_success_flash_message(lang('Successfully Deleted'), true);
            redirect('/faculty_performance/faculty_settings/type');
        }
        else{

            Validator::set_error_flash_message(lang('This type has forms, to remove it make sure that all forms & result are remove'),true);
            redirect('/faculty_performance/faculty_settings/type');
        }
    }

    private $rate = [];

    /**
     * get the rates of types depends on current deadline
     * @param $deadline_id
     * @return mixed
     */
    public function get_rate($deadline_id) {

        if(!isset($this->rate[$deadline_id])) {
            $this->rate[$deadline_id] = Orm_Fp_Forms_Rate::get_rate_by_type($this->get_id(),$deadline_id)->get_rate();
        }

        return $this->rate[$deadline_id];
    }
}

