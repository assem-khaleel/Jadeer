<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Fp_General_Information extends Orm {
    
    /**
    * @var $instances Orm_Fp_General_Information[]
    */
    protected static $instances = array();
    protected static $table_name = 'fp_general_information';
    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $user_id = 0;
    protected $mobile_no = '';
    protected $personal_email = '';
    protected $contract_date = '0000-00-00';
    protected $contract_type = 0;
    protected $contract_attachment = '';
    protected $cv_attachment = '';
    protected $cv_text_ar = '';
    protected $cv_text_en = '';
    protected $website = '';
    protected $twitter = '';
    protected $facebook = '';
    protected $linkedin = '';

    const CONTRACT_TYPE_FULL_TIME = 1;
    const CONTRACT_TYPE_PART_TIME = 2;

    public static $contract_types = array(
        self::CONTRACT_TYPE_FULL_TIME => 'Full Time',
        self::CONTRACT_TYPE_PART_TIME => 'Part Time'
    );
    
    /**
    * @return Fp_General_Information_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Fp_General_Information_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Fp_General_Information
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
    * @return Orm_Fp_General_Information[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Fp_General_Information
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Fp_General_Information();
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
        $db_params['mobile_no'] = $this->get_mobile_no();
        $db_params['personal_email'] = $this->get_personal_email();
        $db_params['contract_date'] = $this->get_contract_date();
        $db_params['contract_type'] = $this->get_contract_type();
        $db_params['contract_attachment'] = $this->get_contract_attachment();
        $db_params['cv_attachment'] = $this->get_cv_attachment();
        $db_params['cv_text_ar'] = $this->get_cv_text_ar();
        $db_params['cv_text_en'] = $this->get_cv_text_en();
        $db_params['website'] = $this->get_website();
        $db_params['twitter'] = $this->get_twitter();
        $db_params['facebook'] = $this->get_facebook();
        $db_params['linkedin'] = $this->get_linkedin();
        
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
    public function set_mobile_no($value) {
        $this->add_object_field('mobile_no', $value);
        $this->mobile_no = $value;
    }

    /**
     * @return string
     */
    public function get_mobile_no() {
        return $this->mobile_no;
    }

    /**
     * @param $value
     */
    public function set_personal_email($value) {
        $this->add_object_field('personal_email', $value);
        $this->personal_email = $value;
    }

    /**
     * @return string
     */
    public function get_personal_email() {
        return $this->personal_email;
    }

    /**
     * @param $value
     */
    public function set_contract_date($value) {
        $this->add_object_field('contract_date', $value);
        $this->contract_date = $value;
    }

    /**
     * @return string
     */
    public function get_contract_date() {
        return $this->contract_date;
    }

    /**
     * @param $value
     */
    public function set_contract_type($value) {
        $this->add_object_field('contract_type', $value);
        $this->contract_type = $value;
    }

    /**
     * @param bool $to_string
     * @return int|mixed|string
     */
    public function get_contract_type($to_string = false) {

        if($to_string) {
            return isset(self::$contract_types[$this->contract_type]) ? self::$contract_types[$this->contract_type] : '';
        }

        return $this->contract_type;
    }

    /**
     * @param $value
     */
    public function set_contract_attachment($value) {
        $this->add_object_field('contract_attachment', $value);
        $this->contract_attachment = $value;
    }

    /**
     * @return string
     */
    public function get_contract_attachment() {
        return $this->contract_attachment;
    }

    /**
     * @param $value
     */
    public function set_cv_attachment($value) {
        $this->add_object_field('cv_attachment', $value);
        $this->cv_attachment = $value;
    }

    /**
     * @return string
     */
    public function get_cv_attachment() {
        return $this->cv_attachment;
    }

    /**
     * @param mixed|null|string $lang
     * @return string
     */
    public function get_cv_text($lang = UI_LANG)
    {
        if ($lang == 'arabic') {
            return $this->get_cv_text_ar();
        }
        return $this->get_cv_text_en();
    }

    /**
     * @param $value
     */
    public function set_cv_text_ar($value) {
        $this->add_object_field('cv_text_ar', $value);
        $this->cv_text_ar = $value;
    }

    /**
     * @return string
     */
    public function get_cv_text_ar() {
        return $this->cv_text_ar;
    }

    /**
     * @param $value
     */
    public function set_cv_text_en($value) {
        $this->add_object_field('cv_text_en', $value);
        $this->cv_text_en = $value;
    }

    /**
     * @return string
     */
    public function get_cv_text_en() {
        return $this->cv_text_en;
    }

    /**
     * @param $value
     */
    public function set_website($value) {
        $this->add_object_field('website', $value);
        $this->website = $value;
    }

    /**
     * @return string
     */
    public function get_website() {
        return $this->website;
    }

    /**
     * @param $value
     */
    public function set_twitter($value) {
        $this->add_object_field('twitter', $value);
        $this->twitter = $value;
    }

    /**
     * @return string
     */
    public function get_twitter() {
        return $this->twitter;
    }

    /**
     * @param $value
     */
    public function set_facebook($value) {
        $this->add_object_field('facebook', $value);
        $this->facebook = $value;
    }

    /**
     * @return string
     */
    public function get_facebook() {
        return $this->facebook;
    }

    /**
     * @param $value
     */
    public function set_linkedin($value) {
        $this->add_object_field('linkedin', $value);
        $this->linkedin = $value;
    }

    /**
     * @return string
     */
    public function get_linkedin() {
        return $this->linkedin;
    }
    
    
}

