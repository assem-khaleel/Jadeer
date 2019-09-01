<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Forms_Inputs extends Orm {

    /**
     * @var $instances Orm_Fp_Forms_Inputs[]
     */
    protected static $instances = array();
    protected static $table_name = 'fp_forms_inputs';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $form_id = 0;
    protected $input_label_en = '';
    protected $input_label_ar = '';
    protected $created_at = '0000-00-00 00:00:00';
    protected $updated_at = '0000-00-00 00:00:00';
    protected $deleted_at = 0;

    /**
     * @return Fp_Forms_Inputs_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Forms_Inputs_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Fp_Forms_Inputs
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
     * @return Orm_Fp_Forms_Inputs[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Fp_Forms_Inputs
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Fp_Forms_Inputs();
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
        $db_params['form_id'] = $this->get_form_id();
        $db_params['input_label_en'] = $this->get_input_label_en();
        $db_params['input_label_ar'] = $this->get_input_label_ar();
        $db_params['deleted_at'] = $this->get_deleted_at();
        $db_params['created_at'] = $this->get_created_at();
        $db_params['updated_at'] = $this->get_updated_at();
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
        return $this->set_deleted_at(1);
    }

    public function set_id($value) {
        $this->add_object_field('id', $value);
        $this->id = $value;

        $this->push_instance();
    }

    public function get_id() {
        return $this->id;
    }

    public function set_form_id($value) {
        $this->add_object_field('form_id', $value);
        $this->form_id = $value;
    }

    public function get_form_id() {
        return $this->form_id;
    }

    public function set_input_label_en($value) {
        $this->add_object_field('input_label_en', $value);
        $this->input_label_en = $value;
    }

    public function get_input_label_en() {
        return $this->input_label_en;
    }

    public function set_input_label_ar($value) {
        $this->add_object_field('input_label_ar', $value);
        $this->input_label_ar = $value;
    }

    public function get_input_label_ar() {
        return $this->input_label_ar;
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
        return $this->deleted_at;
    }

    /**
     * change the value for input " is_delete" from 0 to one
     * @param $input_id
     * @return bool
     */
    public function soft_delete($input_id)
    {
        $data = Orm_Fp_Forms_Result::get_one(['input_id'=>$input_id]);

        if(!$data->get_id()){
            $this->set_deleted_at(1);
            self::save();
            return true;
        }
        else{
            Validator::set_error('input',lang('These Inputs  have results, to remove it make sure that all result are remove'));
            json_response(array('html' => Validator::get_error_message('input')));

            return false;
        }
    }

    /**
     * get label of inputs depends on language active
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_label($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_input_label_ar();
        }
        return $this->get_input_label_en();
    }

    /**
     * get the label of inputs depends on the id of label
     * @param $id
     * @param mixed|null|string $lang
     * @return Orm_Fp_Forms_Inputs
     */
    public static function get_label_by_id($id, $lang = UI_LANG){
      return self::get_instance($id);
    }

    /**
     * get the form data
     * @return Orm_Fp_Forms
     */
    public function get_form_obj() {
        return Orm_Fp_Forms::get_instance($this->get_form_id());
    }

}

