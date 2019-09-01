<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Survey_Question_Choice extends Orm
{

    /**
     * @var $instances Orm_Survey_Question_Choice[]
     */
    protected static $instances = array();
    protected static $table_name = 'survey_question_choice';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $question_id = 0;
    protected $choice_english = '';
    protected $choice_arabic = '';


    /**
     * @return Survey_Question_Choice_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Survey_Question_Choice_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Survey_Question_Choice
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
     * @return Orm_Survey_Question_Choice[] | int
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
     * @return Orm_Survey_Question_Choice
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Survey_Question_Choice();
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
        $db_params['choice_english'] = $this->get_choice_english();
        $db_params['choice_arabic'] = $this->get_choice_arabic();

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

    public function set_choice_english($value)
    {
        $this->add_object_field('choice_english',$value);
        $this->choice_english = $value;
    }

    public function get_choice_english()
    {
        return $this->choice_english;
    }

    public function set_choice_arabic($value)
    {
        $this->add_object_field('choice_arabic',$value);
        $this->choice_arabic = $value;
    }

    public function get_choice_arabic()
    {
        return $this->choice_arabic;
    }

    public function get_choice($lang = UI_LANG) {

        if ($lang == 'arabic') {
            return $this->get_choice_arabic();
        }

        return $this->get_choice_english();
    }
    /**
     * this function delete old choices by its question id and exclude id
     * @param int $question_id the question id of the get choice ids to be call function
     * @param int $exclude_ids the exclude id of the get choice ids to be call function
     * @return array the call function
     */
    public static function delete_old_choices($question_id, $exclude_ids){
        return self::get_model()->delete_old_choices($question_id, $exclude_ids);
    }
    /**
     * this function get choice ids by its question id
     * @param int $question_id the question id of the get choice ids to be call function
     * @return array the call function
     */
    public static function get_choice_ids($question_id){
        return self::get_model()->get_choice_ids($question_id);
    }
    /**
     * this function clone me by its question id and with response
     * @param int $question_id the question id of the clone me to be call function
     * @param bool $with_response the with response of the clone me to be call function
     * @return bool|Orm_Survey_Question_Choice the call function
     */
    public function clone_me($question_id, $with_response = true) {

        $object = new Orm_Survey_Question_Choice();
        $object->set_question_id($question_id);
        $object->set_choice_english($this->get_choice_english());
        $object->set_choice_arabic($this->get_choice_arabic());

        if ($object->save()) {

            if($with_response) {

            }

            return $object;
        }

        return false;
    }
    /**
     * this function get user response by its filters
     * @param array $filters the filters of the get user response to be call function
     * @return int the call function
     */
    public function get_user_response($filters = array()) {

        if(!is_array($filters)) {
            $filters = array();
        }

        $filters['choice_id'] = $this->get_id();
        $filters['question_id'] = $this->get_question_id();

        return Orm_Survey_User_Response_Choice::get_count($filters);
    }
}

