<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Survey_User_Response_Factor extends Orm
{

    /**
     * @var $instances Orm_Survey_User_Response_Factor[]
     */
    protected static $instances = array();
    protected static $table_name = 'survey_user_response_factor';


    /**
     * class attributes
     */
    protected $id = 0;
    protected $question_id = 0;
    protected $survey_evaluator_id = 0;
    protected $statement_id = 0;
    protected $rank = 0;

    /**
     * @return Survey_User_Response_Factor_Model
     */
    public static function get_model()
    {
        return Orm::get_ci_model('Survey_User_Response_Factor_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Survey_User_Response_Factor
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
     * @return Orm_Survey_User_Response_Factor[] | int
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
     * @return Orm_Survey_User_Response_Factor
     */
    public static function get_one($filters = array(), $orders = array())
    {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Survey_User_Response_Factor();
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
        $db_params['survey_evaluator_id'] = $this->get_survey_evaluator_id();
        $db_params['statement_id'] = $this->get_statement_id();
        $db_params['rank'] = $this->get_rank();

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

    public function set_survey_evaluator_id($value)
    {
        $this->add_object_field('survey_evaluator_id',$value);
        $this->survey_evaluator_id = $value;
    }

    public function get_survey_evaluator_id()
    {
        return $this->survey_evaluator_id;
    }

    public function set_statement_id($value)
    {
        $this->add_object_field('statement_id',$value);
        $this->statement_id = $value;
    }

    public function get_statement_id()
    {
        return $this->statement_id;
    }

    public function set_rank($value)
    {
        $this->add_object_field('rank',$value);
        $this->rank = $value;
    }

    public function get_rank()
    {
        return $this->rank;
    }
    /**
     * this function get user response by its filters
     * @param array $filters the filters of the get user response to be call function
     * @return array the call function
     */
    public static function get_user_response($filters = array()) {
        return self::get_model()->get_user_response($filters);
    }
    /**
     * this function get detail user response by its filters
     * @param array $filters the filters of the get detail user response to be call function
     * @return array the call function
     */
    public static function get_detail_user_response($filters = array()) {
        return self::get_model()->get_details_user_response($filters);
    }
    /**
     * this function get average ranked by its filters
     * @param array $filters the filters of the get average ranked to be call function
     * @return int the call function
     */
    public static function get_average_ranked($filters = array())
    {
        return self::get_model()->get_average($filters);
    }
}

