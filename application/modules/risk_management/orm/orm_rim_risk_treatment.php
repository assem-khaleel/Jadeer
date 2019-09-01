<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rim_Risk_Treatment extends Orm {

    /**
     * @var $instances Orm_Rim_Risk_Treatment[]
     */
    protected static $instances = array();
    protected static $table_name = 'rim_risk_treatment';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $responsible_id = 0;
    protected $risk_id = 0;
    protected $desc_ar = '';
    protected $desc_en = '';
    protected $risk_desc_ar = '';
    protected $risk_desc_en = '';
    protected $impact_ar = '';
    protected $impact_en = '';

    /**
     * @return Rim_Risk_Treatment_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Rim_Risk_Treatment_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Rim_Risk_Treatment
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
     * @return Orm_Rim_Risk_Treatment[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Rim_Risk_Treatment
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Rim_Risk_Treatment();
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
        $db_params['responsible_id'] = $this->get_responsible_id();
        $db_params['risk_id'] = $this->get_risk_id();
        $db_params['desc_ar'] = $this->get_desc_ar();
        $db_params['desc_en'] = $this->get_desc_en();
        $db_params['risk_desc_ar'] = $this->get_risk_desc_ar();
        $db_params['risk_desc_en'] = $this->get_risk_desc_en();
        $db_params['impact_ar'] = $this->get_impact_ar();
        $db_params['impact_en'] = $this->get_impact_en();

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

    public function set_responsible_id($value) {
        $this->add_object_field('responsible_id', $value);
        $this->responsible_id = $value;
    }

    /**
     * @param bool $obj
     *
     * @return int|Orm_User
     */

    public function get_responsible_id($obj = false) {
        if ($obj) {
            return Orm_User::get_instance($this->responsible_id);
        }
        return $this->responsible_id;
    }

    public function set_risk_id($value) {
        $this->add_object_field('risk_id', $value);
        $this->risk_id = $value;
    }

    public function get_risk_id() {
        return $this->risk_id;
    }

    public function set_desc_ar($value) {
        $this->add_object_field('desc_ar', $value);
        $this->desc_ar = $value;
    }

    public function get_desc_ar() {
        return $this->desc_ar;
    }

    public function set_desc_en($value) {
        $this->add_object_field('desc_en', $value);
        $this->desc_en = $value;
    }

    public function get_desc_en() {
        return $this->desc_en;
    }

    public function get_desc($lang = UI_LANG) {
        if($lang=='arabic') {
            return $this->get_desc_ar();
        }
        return $this->get_desc_en();
    }

    public function set_risk_desc_ar($value) {
        $this->add_object_field('risk_desc_ar', $value);
        $this->risk_desc_ar = $value;
    }

    public function get_risk_desc_ar() {
        return $this->risk_desc_ar;
    }

    public function set_risk_desc_en($value) {
        $this->add_object_field('risk_desc_en', $value);
        $this->risk_desc_en = $value;
    }

    public function get_risk_desc_en() {
        return $this->risk_desc_en;
    }

    public function get_risk_desc($lang = UI_LANG) {
        if($lang=='arabic') {
            return $this->get_risk_desc_ar();
        }
        return $this->get_risk_desc_en();
    }

    public function set_impact_ar($value) {
        $this->add_object_field('impact_ar', $value);
        $this->impact_ar = $value;
    }

    public function get_impact_ar() {
        return $this->impact_ar;
    }

    public function set_impact_en($value) {
        $this->add_object_field('impact_en', $value);
        $this->impact_en = $value;
    }

    public function get_impact_en() {
        return $this->impact_en;
    }

    public function get_impact($lang = UI_LANG) {
        if($lang=='arabic') {
            return $this->get_impact_ar();
        }
        return $this->get_impact_en();
    }

    public function is_valid() {
        return true;
    }

    public function get_user_obj() {
        return Orm_User::get_instance($this->get_responsible_id());
    }

    public function get_user_name() {
        return  htmlfilter($this->get_user_obj()->get_full_name());
    }
}

