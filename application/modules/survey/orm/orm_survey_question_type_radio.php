<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 4/6/15
 * Time: 5:31 PM
 */

class Orm_Survey_Question_Type_Radio extends Orm_Survey_Question {

    protected $class_type = __CLASS__;

    public function __construct() {
        parent::__construct();
    }

    /**
     * @return object|string
     */
    public function draw_add_edit() {
        return Orm::get_ci()->load->view(
            'survey/design/question/types/add_edit/choices',
            array(
                'question' => $this,
                'choices' => Orm::get_ci()->input->post('choices')
            ),
            true
        );
    }

    public function draw_question() {
        return Orm::get_ci()->load->view('survey/design/question/types/preview/radio',array('question' => $this),true);
    }

    /**
     * @param array $filters
     * @return object|string
     */
    public function draw_report($filters = array()) {
        return Orm::get_ci()->load->view('survey/design/question/types/report/radio',array('question' => $this, 'filters' => $filters),true);
    }

    /**
     * @param $question_id
     * @param bool $with_response
     */
    public function clone_me_type($question_id, $with_response = true) {
        foreach($this->get_choices() as $choice) {
            $choice->clone_me($question_id , $with_response);
        }
    }

    /**
     *
     */
    public function validator() {

        $choices = Orm::get_ci()->input->post('choices');
        if($choices && is_array($choices)) {

            $index = 0;
            foreach($choices as $choice) {

                $choice_en = isset($choice['choice_english']) ? $choice['choice_english'] : '';
                $choice_ar = isset($choice['choice_arabic']) ? $choice['choice_arabic'] : '';

                Validator::required_field_validator('choice_english', $choice_en, lang('Required Question choice').' ( '.lang('English').' ) ', $index);
                Validator::required_field_validator('choice_arabic', $choice_ar, lang('Required Question choice').' ( '.lang('Arabic').' ) ', $index);

                $index++;
            }
        }

    }

    /**
     * this function save process
     * @redirect success or error
     */
    public function save_process() {

        if($this->save()) {

            $choices = Orm::get_ci()->input->post('choices');
            if($choices && is_array($choices)) {
                Orm_Survey_Question_Choice::delete_old_choices($this->get_id(), array_column($choices,'id'));

                foreach($choices as $choice) {

                    $choice_id = isset($choice['id']) ? $choice['id'] : 0;
                    $choice_en = isset($choice['choice_english']) ? $choice['choice_english'] : '';
                    $choice_ar = isset($choice['choice_arabic']) ? $choice['choice_arabic'] : '';

                    $choice_obj = Orm_Survey_Question_Choice::get_instance($choice_id);
                    $choice_obj->set_choice_english($choice_en);
                    $choice_obj->set_choice_arabic($choice_ar);
                    $choice_obj->set_question_id($this->get_id());
                    $choice_obj->save();

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

        $value = Orm::get_ci()->input->post($this->get_html_question_name());

        if($this->get_is_require() && empty($value)) {
            return false;
        }

        if($value) {
            if(!in_array($value ,Orm_Survey_Question_Choice::get_choice_ids($this->get_id()))) {
                return false;
            }

            $response = new Orm_Survey_User_Response_Choice();
            $response->set_question_id($this->get_id());
            $response->set_survey_evaluator_id($evaluator_id);
            $response->set_choice_id($value);
            $response->save();
        }

        return true;

    }
}