<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 4/6/15
 * Time: 5:31 PM
 */

class Orm_Survey_Question_Type_Factors_And_Statements extends Orm_Survey_Question {

    protected $class_type = __CLASS__;

    public function __construct() {
        parent::__construct();
    }

    /**
     * @return object|string
     */
    public function draw_add_edit() {
        return Orm::get_ci()->load->view(
            'survey/design/question/types/add_edit/factors_and_statements',
            array(
                'question' => $this,
                'factors' => Orm::get_ci()->input->post('factors')
            ),
            true
        );
    }

    public function draw_question() {
        return Orm::get_ci()->load->view('survey/design/question/types/preview/factors_and_statements',array('question' => $this),true);
    }

    /**
     * @param array $filters
     * @return object|string
     */
    public function draw_report($filters = array()) {
        return Orm::get_ci()->load->view('survey/design/question/types/report/factors_and_statements',array('question' => $this, 'filters' => $filters),true);
    }

    /**
     * @param $question_id
     * @param bool $with_response
     */
    public function clone_me_type($question_id, $with_response = true) {
        foreach($this->get_factors() as $factor) {
            $factor->clone_me($question_id , $with_response);
        }
    }

    /**
     * @return string
     */
    public function get_js_validator() {

        $rules = array();
        $factors = $this->get_factors();
        foreach($factors as $factor) {
            foreach($factor->get_statements() as $statement) {
                $rules[] = "'{$this->get_html_question_name()}[{$statement->get_id()}]': { required: true }";
            }
        }

        return implode(",\n", $rules);
    }

    /**
     *
     */
    public function validator() {

        $factors = Orm::get_ci()->input->post('factors');
        if($factors && is_array($factors)) {

            $index_factor = 0;
            foreach($factors as $factor) {

                $abbreviation_english = (isset($factor['abbreviation_english']) ? $factor['abbreviation_english'] : '');
                $abbreviation_arabic = (isset($factor['abbreviation_arabic']) ? $factor['abbreviation_arabic'] : '');
                $title_english = (isset($factor['title_english']) ? $factor['title_english'] : '');
                $title_arabic = (isset($factor['title_arabic']) ? $factor['title_arabic'] : '');

                Validator::required_field_validator('factor_abbreviation_english', $abbreviation_english, lang('Required Factor Abbreviation').' ( '.lang('English').' ) ', $index_factor);
                Validator::required_field_validator('factor_abbreviation_arabic', $abbreviation_arabic, lang('Required Factor Abbreviation').' ( '.lang('Arabic').' ) ', $index_factor);
                Validator::required_field_validator('factor_title_english', $title_english, lang('Required Factor title').' ( '.lang('English').' ) ', $index_factor);
                Validator::required_field_validator('factor_title_arabic', $title_arabic, lang('Required Factor title').' ( '.lang('Arabic').' ) ', $index_factor);

                $statements = isset($factor['statements']) ? $factor['statements'] : array();
                if($statements && is_array($statements)) {

                    $index_statement = 0;
                    foreach($statements as $statement) {

                        $abbreviation_english = (isset($statement['abbreviation_english']) ? $statement['abbreviation_english'] : '');
                        $abbreviation_arabic = (isset($statement['abbreviation_arabic']) ? $statement['abbreviation_arabic'] : '');
                        $title_english = (isset($statement['title_english']) ? $statement['title_english'] : '');
                        $title_arabic = (isset($statement['title_arabic']) ? $statement['title_arabic'] : '');

                        Validator::required_field_validator('statement_abbreviation_english', $abbreviation_english, lang('Required Statement abbreviation').' ( '.lang('English').' ) ', "f_{$index_factor}_s_{$index_statement}");
                        Validator::required_field_validator('statement_abbreviation_arabic', $abbreviation_arabic, lang('Required Statement abbreviation').' ( '.lang('Arabic').' ) ', "f_{$index_factor}_s_{$index_statement}");
                        Validator::required_field_validator('statement_title_english', $title_english, lang('Required Statement title').' ( '.lang('English').' ) ', "f_{$index_factor}_s_{$index_statement}");
                        Validator::required_field_validator('statement_title_arabic', $title_arabic, lang('Required Statement title').' ( '.lang('Arabic').' ) ', "f_{$index_factor}_s_{$index_statement}");

                        $index_statement++;
                    }
                }

                $index_factor++;
            }
        }

    }

    /**
     * this function save process
     * @redirect success or error
     */
    public function save_process() {

        if($this->save()) {

            $factors = Orm::get_ci()->input->post('factors');
            if($factors && is_array($factors)) {

                Orm_Survey_Question_Factor::delete_old_factors($this->get_id(), array_column($factors,'id'));

                foreach($factors as $factor) {

                    $factor_obj = Orm_Survey_Question_Factor::get_instance(isset($factor['id']) ? $factor['id'] : 0);
                    $factor_obj->set_question_id($this->get_id());
                    $factor_obj->set_abbreviation_english(isset($factor['abbreviation_english']) ? $factor['abbreviation_english'] : '');
                    $factor_obj->set_abbreviation_arabic(isset($factor['abbreviation_arabic']) ? $factor['abbreviation_arabic'] : '');
                    $factor_obj->set_title_english(isset($factor['title_english']) ? $factor['title_english'] : '');
                    $factor_obj->set_title_arabic(isset($factor['title_arabic']) ? $factor['title_arabic'] : '');

                    if($factor_obj->save()){

                        $statements = isset($factor['statements']) ? $factor['statements'] : array();
                        if($statements && is_array($statements)) {

                            Orm_Survey_Question_Statement::delete_old_statements($factor_obj->get_id(), array_column($statements, 'id'));

                            foreach($statements as $statement) {
                                $statement_obj = Orm_Survey_Question_Statement::get_instance(isset($statement['id']) ? $statement['id'] : 0);
                                $statement_obj->set_factor_id($factor_obj->get_id());
                                $statement_obj->set_abbreviation_english(isset($statement['abbreviation_english']) ? $statement['abbreviation_english'] : '');
                                $statement_obj->set_abbreviation_arabic(isset($statement['abbreviation_arabic']) ? $statement['abbreviation_arabic'] : '');
                                $statement_obj->set_title_english(isset($statement['title_english']) ? $statement['title_english'] : '');
                                $statement_obj->set_title_arabic(isset($statement['title_arabic']) ? $statement['title_arabic'] : '');

                                $statement_obj->save();
                            }
                        }
                    }

                }
            }
        }
    }

    /**
     * this function save user response by its evaluator id
     * @param int $evaluator_id the evaluator id of the save user response to be call function
     * @return bool|void the call function
     */
    public function save_user_response($evaluator_id) {

        $values = Orm::get_ci()->input->post($this->get_html_question_name());

        $statement_ids = array();
        foreach($this->get_factors() as $factor) {
            foreach($factor->get_statements() as $statement) {
                $statement_ids[$statement->get_id()] = $statement->get_id();
                if($this->get_is_require()) {
                    if(empty($values[$statement->get_id()])) {
                        return false;
                    } elseif($values[$statement->get_id()] > 5 || $values[$statement->get_id()] < 1) {
                        return false;
                    }
                }
            }
        }

        if($values && is_array($values)) {
            foreach($values as $key => $value) {
                if(in_array($key, $statement_ids)) {
                    $response = new Orm_Survey_User_Response_Factor();
                    $response->set_question_id($this->get_id());
                    $response->set_survey_evaluator_id($evaluator_id);
                    $response->set_statement_id($key);
                    $response->set_rank($value);
                    $response->save();
                }
            }
        }

        return true;

    }
}