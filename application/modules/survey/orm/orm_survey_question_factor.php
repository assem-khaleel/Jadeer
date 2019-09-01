<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Survey_Question_Factor extends Orm
{

    /**
     * @var $instances Orm_Survey_Question_Factor[]
     */
    protected static $instances = array();
    protected static $table_name = 'survey_question_factor';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $question_id = 0;
    protected $title_english = '';
    protected $title_arabic = '';
    protected $abbreviation_english = '';
    protected $abbreviation_arabic = '';



    /**
     * @return Survey_Question_Factor_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Survey_Question_Factor_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Survey_Question_Factor
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
     * @return Orm_Survey_Question_Factor[] | int
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
     * @return Orm_Survey_Question_Factor
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Survey_Question_Factor();
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
        $db_params['question_id'] = $this->get_question_id();
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

    public function set_question_id($value)
    {
        $this->add_object_field('question_id',$value);
        $this->question_id = $value;
    }

    public function get_question_id()
    {
        return $this->question_id;
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

    public function get_report_title()
    {
        $str = $this->get_title();
        if (($tmp = strstr($this->get_title(), ':',true)) !== false) {
            $str = $tmp;
        }
        elseif (($tmp = strstr($this->get_title(), ',',true)) !== false)
        {
            $str = $tmp;
        }
        return $str;
    }
    /**
     * this function get statements
     * @return Orm_Survey_Question_Statement[] the call function
     */
    public function get_statements() {
        return Orm_Survey_Question_Statement::get_all(array('factor_id' => $this->get_id()));
    }

    /**
     * @param $question_id
     * @param $exclude_ids
     */
    public static function delete_old_factors($question_id, $exclude_ids){
        return self::get_model()->delete_old_factors($question_id, $exclude_ids);
    }
    /**
     * this function clone me by its question id and with response
     * @param int $question_id the question id of the clone me to be call function
     * @param bool $with_response the with response of the clone me to be call function
     * @return bool|Orm_Survey_Question_Factor the call function
     */
    public function clone_me($question_id, $with_response = true) {

        $object = new Orm_Survey_Question_Factor();
        $object->set_question_id($question_id);
        $object->set_abbreviation_english($this->get_abbreviation_english());
        $object->set_abbreviation_arabic($this->get_abbreviation_arabic());
        $object->set_title_english($this->get_title_english());
        $object->set_title_arabic($this->get_title_arabic());

        if ($object->save()) {

            foreach($this->get_statements() as $statement) {
                $statement->clone_me($object->get_id(), $with_response);
            }

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

        $filters['factor_id'] = $this->get_id();

        return Orm_Survey_User_Response_Factor::get_user_response($filters);
    }


    /**
     * this function get detail user response by its filters
     * @param array $filters the filter of the get detail user response to be call function
     * @return array the call function
     */
    public function get_detail_user_response($filters = array()) {

        if(!is_array($filters)) {
            $filters = array();
        }

        $filters['factor_id'] = $this->get_id();

        return Orm_Survey_User_Response_Factor::get_detail_user_response($filters);
    }
    /**
     * this function get question obj
     * @return Orm_Survey_Question object
     */
    public function get_question_obj() {
        return Orm_Survey_Question::get_instance($this->get_question_id());
    }
}

