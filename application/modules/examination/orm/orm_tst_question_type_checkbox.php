<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 4/6/15
 * Time: 5:31 PM
 */

class Orm_tst_Question_Type_Checkbox extends Orm_tst_Question {

    protected $class_type = __CLASS__;

    public function __construct() {
        parent::__construct();
    }

    /** draw answers for students for questions type checkbox
    */
    public function draw_add_edit() {
        return Orm::get_ci()->load->view(
            'examination/design/question/types/add_edit/checkbox',
            array(
                'question' => $this,
                'choices' => Orm::get_ci()->input->post('choices')
            ),
            true
        );
    }

    /** draw question that of the exam that tyoe of it is checkbox
    */
    public function draw_question() {
        return Orm::get_ci()->load->view('examination/design/question/types/preview/checkbox',array('question' => $this),true);
    }

    /** draw report of the question and answer as charts
    */
    public function draw_report($filters = array()) {
        return Orm::get_ci()->load->view('examination/design/question/types/report/checkbox',array('question' => $this, 'filters' => $filters),true);
    }


    /** validate type of answer for this type
    */
    public function validator() {

        $choices = Orm::get_ci()->input->post('choices');

        if($choices && is_array($choices)) {

            $correct = false;
            $index = 0;
            foreach($choices as $choice) {

                $choice_en = isset($choice['choice_english']) ? $choice['choice_english'] : '';
                $choice_ar = isset($choice['choice_arabic']) ? $choice['choice_arabic'] : '';

                $correct   = $correct || (isset($choice['correct']) ? boolval($choice['correct']): false);

                Validator::required_field_validator('choice_english', $choice_en, lang('Required Question choice').' ( '.lang('English').' ) ', $index);
                Validator::required_field_validator('choice_arabic', $choice_ar, lang('Required Question choice').' ( '.lang('Arabic').' ) ', $index);

                $index++;
            }

            if(!$correct) {
                Validator::set_error('correct_answer', lang('You have to set correct answer'));
            }

            if(count($choices)<2) {
                Validator::set_error('correct_answer', lang('You have to add 2 choices at least'));
            }

        }
        else {
            Validator::set_error('class_type', lang('you have to add choices'));
        }
    }


    /** save choice that user student get it for checkbox type
    */
    public function save_process() {

        if($this->save()) {

            $choices = Orm::get_ci()->input->post('choices');
            if($choices && is_array($choices)) {
                Orm_Tst_Question_Options::delete_old_choices($this->get_id(), array_column($choices,'id'));

                foreach($choices as $choice) {

                    $choice_id = isset($choice['id']) ? $choice['id'] : 0;
                    $choice_en = isset($choice['choice_english']) ? $choice['choice_english'] : '';
                    $choice_ar = isset($choice['choice_arabic']) ? $choice['choice_arabic'] : '';
                    $correct   = isset($choice['correct']) ? $choice['correct']: 0;

                    $choice_obj = Orm_Tst_Question_Options::get_instance($choice_id);
                    $choice_obj->set_text_en($choice_en);
                    $choice_obj->set_text_ar($choice_ar);
                    $choice_obj->set_question_id($this->get_id());
                    $choice_obj->set_correct($correct);
                    $choice_obj->save();

                }
            }
        }
    }

    public function get_question_with_user_response($exam_id, $user_id=0, $correction_more=false) {

        $user_id = $user_id?: Orm_User::get_logged_user_id();

        $view = $correction_more?
            'design/question/types/answer_preview/checkbox':
            'design/question/types/preview/checkbox';


        $value =[];

        foreach(Orm_Tst_Exam_Response_Choice::get_all([
            'exam_id'     => $exam_id,
            'question_id' => $this->get_id(),
            'user_id'     => $user_id
        ]) as $response) {
            $value[] = $response->get_choice_id();
        }

        $file = Orm_Tst_Exam_Response_Attachment::get_one([
            'exam_id'     => $exam_id,
            'question_id' => $this->get_id(),
            'user_id'     => $user_id
        ]);

        return $this->get_ci()->load->view($view, [
            'question' => $this,
            'question_mark' => Orm_Tst_Exam_Questions::get_one(['exam_id'=>$exam_id, 'question_id'=>$this->get_id()])->get_mark(),
            'mark'          => Orm_Tst_Exam_Student_Mark::get_one(['exam_id'=>$exam_id, 'user_id'=>$user_id, 'question_id'=>$this->get_id()])->get_mark(),
            'value'         => $value,
            'attach'        => $file
        ], true);

    }

    /** save user response for the question type checkbox
    */
    public function save_user_response($exam_id) {

        $values = Orm::get_ci()->input->post($this->get_html_question_name());

        if(empty($values)) {
            return false;
        }

       $choice_ids = Orm_Tst_Question_Options::get_choice_ids($this->get_id());

        if($values && is_array($values)) {

            $responses = Orm_Tst_Exam_Response_Choice::get_all([
                'user_id'          => Orm_User::get_logged_user_id(),
                'question_id'      => $this->get_id(),
                'exam_id'          => $exam_id,
                'not_in_choice_id' => $values
            ]);

            foreach($responses as $response) {
                $response->delete();
            }

            foreach($values as $value) {

                if(!in_array($value , $choice_ids)) {
                    return false;
                }

                $response = Orm_Tst_Exam_Response_Choice::get_one([
                    'user_id'     => Orm_User::get_logged_user_id(),
                    'question_id' => $this->get_id(),
                    'exam_id'     => $exam_id,
                    'choice_id'   => $value
                ]);

                if($response && $response->get_id()) {
                    continue;
                }

                $response->set_question_id($this->get_id());
                $response->set_user_id(Orm_User::get_logged_user_id());
                $response->set_exam_id($exam_id);
                $response->set_choice_id($value);
                $response->save();
            }

            $correct_choices = Orm_Tst_Question_Options::get_choice_ids($this->get_id(), true);

            $mark =0;

            if(count($correct_choices) == count($values)) {
                $mark = Orm_Tst_Exam_Questions::get_one(['exam_id'=>$exam_id, 'question_id'=>$this->get_id()])->get_mark();

                foreach($values as $value) {
                    if(!in_array($value, $correct_choices)) {
                        $mark=0;
                        break;
                    }
                }
            }

            $mark_orm = Orm_Tst_Exam_Student_Mark::get_one([
                'user_id'     => Orm_User::get_logged_user_id() ,
                'exam_id'     => $exam_id,
                'question_id' => $this->get_id()
            ]);

            $mark_orm->set_user_id(Orm_User::get_logged_user_id());
            $mark_orm->set_exam_id($exam_id);
            $mark_orm->set_question_id($this->get_id());
            $mark_orm->set_mark($mark);
            $mark_orm->save();
        }
        return true;
    }
}