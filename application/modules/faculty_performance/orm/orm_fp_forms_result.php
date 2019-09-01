<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Forms_Result extends Orm {

    /**
     * @var $instances Orm_Fp_Forms_Result[]
     */
    protected static $instances = array();
    protected static $table_name = 'fp_forms_result';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $form_id = 0;
    protected $input_id = 0;
    protected $input_value_en = '';
    protected $input_value_ar = '';
    protected $user_id = 0;
    protected $deadline_id = 0;
    protected $created_at = '0000-00-00 00:00:00';
    protected $updated_at = '0000-00-00 00:00:00';
    protected $deleted_at = 0;

    /**
     * @return Fp_Forms_Result_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Forms_Result_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Fp_Forms_Result
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
     * @return Orm_Fp_Forms_Result[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Fp_Forms_Result
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Fp_Forms_Result();
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
        $db_params['input_id'] = $this->get_input_id();
        $db_params['input_value_en'] = $this->get_input_value_en();
        $db_params['input_value_ar'] = $this->get_input_value_ar();
        $db_params['user_id'] = $this->get_user_id();
        $db_params['deadline_id'] = $this->get_deadline_id();
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

    public function set_form_id($value) {
        $this->add_object_field('form_id', $value);
        $this->form_id = $value;
    }

    public function get_form_id() {
        return $this->form_id;
    }

    public function set_input_id($value) {
        $this->add_object_field('input_id', $value);
        $this->input_id = $value;
    }

    public function get_input_id() {
        return $this->input_id;
    }

    public function set_input_value_en($value) {
        $this->add_object_field('input_value_en', $value);
        $this->input_value_en = $value;
    }

    public function get_input_value_en() {
        return $this->input_value_en;
    }

    public function set_input_value_ar($value) {
        $this->add_object_field('input_value_ar', $value);
        $this->input_value_ar = $value;
    }

    public function get_input_value_ar() {
        return $this->input_value_ar;
    }

    public function set_user_id($value) {
        $this->add_object_field('user_id', $value);
        $this->user_id = $value;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function set_deadline_id($value) {
        $this->add_object_field('deadline_id', $value);
        $this->deadline_id = $value;
    }

    public function get_deadline_id() {
        return $this->deadline_id;
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
    
    public function soft_delete()
    {
        $this->set_deleted_at(1);
        $this->save();
    }

    /**
     * get the input value depends on active language
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_values($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_input_value_ar();
        }
        return $this->get_input_value_en();
    }

    /**
     * get the result of forms depends on the following :
     * @param $user_id -> user set the value
     * @param $form_id -> form id of these inputs
     * @param $dealine -> current deadline
     * @return int|Orm_Fp_Forms_Result[]
     */
    public static function get_res_by_user_form($user_id, $form_id, $dealine){
        $val= self::get_all(['user_id'=>$user_id,'form_id'=>$form_id,'deadline_id'=>$dealine]);
        
        return $val;
        
        
    }

    /**
     * get input data as object
     * @return Orm_Fp_Forms_Inputs
     */
    public function get_input_obj() {
        return Orm_Fp_Forms_Inputs::get_instance($this->get_input_id());
    }

    /**
     * get orm data as object
     * @return Orm_Fp_Forms
     */
    public function get_form_obj() {
        return Orm_Fp_Forms::get_instance($this->get_form_id());
    }

    /**
     * get result of inputs
     * @param $inputs
     * @param $result
     * @return array
     */
    public static function get_result($inputs, $result) {

        $i = 0;
        $input_ids = array();

        foreach ($inputs as $input) { /** @var Orm_Fp_Forms_Inputs $input */
            $input_ids[$input->get_id()] = $input->get_id();
        }

        $data = array();
        foreach ($result as $form_result) { /** @var Orm_Fp_Forms_Result $form_result */

            if(empty($tmp_input_ids)) {
                $tmp_input_ids = $input_ids;
                $i++;
            }

            unset($tmp_input_ids[$form_result->get_input_id()]);

            if(in_array($form_result->get_input_id(), $input_ids)) {
                $data[$i][$form_result->get_input_id()]['id'] = $form_result->get_id();
                $data[$i][$form_result->get_input_id()]['value'] = Orm_Fp_Forms::get_static_form($form_result->get_input_obj(), $form_result)->get_value();
            }
        }

        return $data;
    }
}

