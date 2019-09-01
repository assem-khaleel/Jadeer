<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 4/6/15
 * Time: 5:31 PM
 */

class Orm_Survey_Question_Type_Textarea extends Orm_Survey_Question {

    const NUMBER_OF_RESPONSE = 6;

    protected $class_type = __CLASS__;

    public function __construct() {
        parent::__construct();
    }

    public function draw_question() {
        return Orm::get_ci()->load->view('survey/design/question/types/preview/textarea',array('question' => $this),true);
    }

    /**
     * @param array $filters
     * @return object|string
     */
    public function draw_report($filters = array()) {
        return Orm::get_ci()->load->view('survey/design/question/types/report/textarea',array('question' => $this, 'filters' => $filters),true);
    }

    /**
     * this function save user response by its evaluator id
     * @param int $evaluator_id the evaluator id of the save user response to be call function
     * @return bool|void the call function
     */
    public function save_user_response($evaluator_id) {

        $value = Orm::get_ci()->input->post($this->get_html_question_name());

        if($this->get_is_require() && empty($value)) {
            return false;
        }

        if($value) {
            $response = new Orm_Survey_User_Response_Text();
            $response->set_question_id($this->get_id());
            $response->set_survey_evaluator_id($evaluator_id);
            $response->set_value($value);
            $response->save();
        }

        return true;

    }
    /**
     * this function get user response by its filters
     * @param array $filters the filters of the get user response to be call function
     * @return int|Orm_Survey_User_Response_Text[] the call function
     */
    public function get_user_response($filters = array()) {

        if(!is_array($filters)) {
            $filters = array();
        }

        $filters['question_id'] = $this->get_id();

        return Orm_Survey_User_Response_Text::get_all($filters,1, self::NUMBER_OF_RESPONSE);
    }
}