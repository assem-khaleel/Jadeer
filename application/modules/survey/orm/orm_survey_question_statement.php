<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Survey_Question_Statement extends Orm
{

    /**
     * @var $instances Orm_Survey_Question_Statement[]
     */
    protected static $instances = array();
    protected static $table_name = 'survey_question_statement';


    /**
     * class attributes
     */
    protected $id = 0;
    protected $factor_id = 0;
    protected $title_english = '';
    protected $title_arabic = '';
    protected $abbreviation_english = '';
    protected $abbreviation_arabic = '';


    /**
     * @return Survey_Question_Statement_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Survey_Question_Statement_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Survey_Question_Statement
     */
    public static function get_instance($id)
    {
        $id = intval($id);
        if (isset(self::$instances[$id])) {
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
     * @return Orm_Survey_Question_Statement[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array())
    {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Survey_Question_Statement
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Survey_Question_Statement();
    }

    /**
     * get count
     *
     * @param array $filters
     * @return int
     */
    public static function get_count($filters = array())
    {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }

    public function to_array()
    {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['factor_id'] = $this->get_factor_id();
        $db_params['title_english'] = $this->get_title_english();
        $db_params['title_arabic'] = $this->get_title_arabic();
        $db_params['abbreviation_english'] = $this->get_abbreviation_english();
        $db_params['abbreviation_arabic'] = $this->get_abbreviation_arabic();

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

    public function delete()
    {
        return self::get_model()->delete($this->get_id());
    }

    public function set_id($value)
    {
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_factor_id($value)
    {
        $this->add_object_field('factor_id',$value);
        $this->factor_id = $value;
    }

    public function get_factor_id()
    {
        return $this->factor_id;
    }

    public function set_title_english($value)
    {
        $this->add_object_field('title_english',$value);
        $this->title_english = $value;
    }

    public function get_title_english()
    {
        return $this->title_english;
    }

    public function set_title_arabic($value)
    {
        $this->add_object_field('title_arabic',$value);
        $this->title_arabic = $value;
    }

    public function get_title_arabic()
    {
        return $this->title_arabic;
    }

    public function get_title($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_title_arabic();
        }

        return $this->get_title_english();
    }

    public function set_abbreviation_english($value)
    {
        $this->add_object_field('abbreviation_english',$value);
        $this->abbreviation_english = $value;
    }

    public function get_abbreviation_english()
    {
        return $this->abbreviation_english;
    }

    public function set_abbreviation_arabic($value)
    {
        $this->add_object_field('abbreviation_arabic',$value);
        $this->abbreviation_arabic = $value;
    }

    public function get_abbreviation_arabic()
    {
        return $this->abbreviation_arabic;
    }

    public function get_abbreviation($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_abbreviation_arabic();
        }

        return $this->get_abbreviation_english();
    }
    /**
     * this function delete old statements by its factor id and exclude ids
     * @param int $factor_id the factor id of the delete old statements to be call function
     * @param int $exclude_ids the exclude ids of the delete old statements to be call function
     * @redirect success or error
     */
    public static function delete_old_statements($factor_id, $exclude_ids){
        return self::get_model()->delete_old_statements($factor_id, $exclude_ids);
    }
    /**
     * this function get statement ids by its factor id
     * @param int $factor_id the factor id of the get statement ids to be call function
     * @return array the call function
     */
    public static function get_statement_ids($factor_id){
        return self::get_model()->get_statement_ids($factor_id);
    }
    /**
     * this function clone me by its factor id and with response
     * @param int $factor_id the factor id of the clone me to be call function
     * @param bool $with_response the with response of the clone me to be call function
     * @return bool|Orm_Survey_Question_Statement the call function
     */
    public function clone_me($factor_id, $with_response = true) {

        $object = new Orm_Survey_Question_Statement();
        $object->set_factor_id($factor_id);
        $object->set_abbreviation_english($this->get_abbreviation_english());
        $object->set_abbreviation_arabic($this->get_abbreviation_arabic());
        $object->set_title_english($this->get_title_english());
        $object->set_title_arabic($this->get_title_arabic());

        if ($object->save()) {

            if($with_response) {

            }

            return $object;
        }

        return false;
    }
    /**
     * this function get user response by its filters
     * @param array $filters the filter of the get user response to be call function
     * @return array the call function
     */
    public function get_user_response($filters = array()) {

        if(!is_array($filters)) {
            $filters = array();
        }

        $filters['statement_id'] = $this->get_id();

        return Orm_Survey_User_Response_Factor::get_user_response($filters);
    }
    /**
     * this function get factor obj
     * @return Orm_Survey_Question_Factor object
     */
    public function get_factor_obj() {
        return Orm_Survey_Question_Factor::get_instance($this->get_factor_id());
    }
}

