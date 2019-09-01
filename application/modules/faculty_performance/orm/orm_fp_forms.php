<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_Forms extends Orm {

    /**
     * @var $instances Orm_Fp_Forms[]
     */
    protected static $instances = array();
    protected static $table_name = 'fp_forms';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $type_id = 0;
    protected $form_name_en = '';
    protected $form_name_ar = '';
    protected $created_at = '0000-00-00 00:00:00';
    protected $updated_at = '0000-00-00 00:00:00';
    protected $deleted_at = 0;
    protected $static_file = '';
    protected $is_hidden = 0;
    protected $is_editable = 0;

    /**
     * @return Fp_Forms_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Fp_Forms_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Fp_Forms
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
     * @return Orm_Fp_Forms[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one row as Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Fp_Forms
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Fp_Forms();
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
        $db_params['type_id'] = $this->get_type_id();
        $db_params['form_name_en'] = $this->get_form_name_en();
        $db_params['form_name_ar'] = $this->get_form_name_ar();
        $db_params['deleted_at'] = $this->get_deleted_at();
        $db_params['created_at'] = $this->get_created_at();
        $db_params['updated_at'] = $this->get_updated_at();
        $db_params['static_file'] = $this->get_static_file();
        $db_params['is_hidden'] = $this->get_is_hidden();
        $db_params['is_editable'] = $this->get_is_editable();

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

    public function set_type_id($value) {
        $this->add_object_field('type_id', $value);
        $this->type_id = $value;
    }

    public function get_type_id() {
        return $this->type_id;
    }

    public function set_form_name_en($value) {
        $this->add_object_field('form_name_en', $value);
        $this->form_name_en = $value;
    }

    public function get_form_name_en() {
        return $this->form_name_en;
    }

    public function set_form_name_ar($value) {
        $this->add_object_field('form_name_ar', $value);
        $this->form_name_ar = $value;
    }

    public function get_form_name_ar() {
        return $this->form_name_ar;
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
     * @param $form_id
     */
    public function soft_delete($form_id)
    {
        $data = Orm_Fp_Forms_Result::get_one(['form_id'=>$form_id]);

        if(!$data->get_id()){
            $this->set_deleted_at(1);
            self::save();
            Validator::set_success_flash_message(lang('Successfully Deleted'),true);
            redirect('/faculty_performance/faculty_settings/settings');
        }
        else{

            Validator::set_error_flash_message(lang('This Form has results, to remove it make sure that all result are remove'),true);
            redirect('/faculty_performance/faculty_settings/settings');
        }
    }


    public function set_static_file($value) {
        $this->add_object_field('static_file', $value);
        $this->static_file = $value;
    }

    public function get_static_file() {
        return $this->static_file;
    }

    public function set_is_hidden($value) {
        $this->add_object_field('is_hidden', $value);
        $this->is_hidden = $value;
    }

    public function get_is_hidden() {
        return $this->is_hidden;
    }

    public function set_is_editable($value) {
        $this->add_object_field('is_editable', $value);
        $this->is_editable = $value;
    }

    public function get_is_editable() {
        return $this->is_editable;
    }


    /**
     * get the names of form depends on language
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_form_name($lang = UI_LANG){
        if ($lang == 'arabic') {
            return $this->get_form_name_ar();
        }
        return $this->get_form_name_en();
    }

    /**
     * check if the form has result or not
     * @param $form_id
     * @return bool
     */
    public static function get_result($form_id){
        
        $data = Orm_Fp_Forms_Result::get_one(['form_id'=>$form_id]);

       if($data->get_id() != 0){
           
           return true;
           
       }else{
           
           return false;
       }

    }

    private $inputs = null;

    /**
     * get all inputs for form depends on form id
     * @return int|null|Orm_Fp_Forms_Inputs[]
     */
    public function get_inputs() {

        if(is_null($this->inputs)) {
            $this->inputs = Orm_Fp_Forms_Inputs::get_all(['form_id' => $this->get_id()]);
        }

        return $this->inputs;
    }

    /**
     * show message for validation depends on the following:
     * @param $html_class
     * @param $title
     * @param $message
     * @param bool $return
     * @return object|string
     */
    public static function show_message($html_class, $title, $message, $return = false) {

        $view_param = ['html_class' => $html_class, 'title' => $title, 'message' => $message];

        if($return) {
            return self::get_ci()->load->view('message', $view_param, true);
        } else {
            self::get_ci()->layout->view('message', $view_param);
        }
    }

    private static $static_forms = array();

    /**
     * get all forms that are from type statics inculding the input and result for these input
     * @param Orm_Fp_Forms_Inputs $input
     * @param Orm_Fp_Forms_Result|null $result
     *
     * @return Orm_Fp_Static
     */
    public static function get_static_form(Orm_Fp_Forms_Inputs $input, Orm_Fp_Forms_Result $result)
    {
        if (!isset(self::$static_forms[$input->get_id()][$result->get_id()])) {

            $class = "Orm_Fp_Static";

            $static = explode('_', $input->get_form_obj()->get_static_file());

            if(is_array($static) && $static) {
                $static_class = implode('_', array_map(function ($v) {
                    return ucfirst($v);
                }, $static));

                $class .=  "_{$static_class}";
            }

            if(class_exists($class)) {
                self::$static_forms[$input->get_id()][$result->get_id()] = new $class($input, $result);
            } else {
                self::$static_forms[$input->get_id()][$result->get_id()] = new Orm_Fp_Static($input, $result);
            }
        }

        return self::$static_forms[$input->get_id()][$result->get_id()];
    }

}

