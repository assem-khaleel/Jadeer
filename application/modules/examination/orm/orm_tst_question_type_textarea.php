<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 4/6/15
 * Time: 5:31 PM
 */

class Orm_Tst_Question_Type_Textarea extends Orm_Tst_Question {

    const NUMBER_OF_RESPONSE = 6;

    protected $class_type = __CLASS__;

    public function __construct() {
        parent::__construct();
    }

    /** function to draw the question
    */
    public function draw_question() {
        return Orm::get_ci()->load->view('examination/design/question/types/preview/textarea',array('question' => $this),true);
    }

    /** draw report for text area questions
    */
    public function draw_report($filters = array()) {
        return Orm::get_ci()->load->view('examination/design/question/types/report/textarea',array('question' => $this, 'filters' => $filters),true);
    }

    /** save user response for the question if its textarea
    */
    public function save_user_response($exam_id) {

        $value = Orm::get_ci()->input->post($this->get_html_question_name());

        if(empty($value)) {
            return false;
        }

        if($value) {
            $response = Orm_Tst_Exam_Response_Text::get_one([
                'user_id'     => Orm_User::get_logged_user_id(),
                'question_id' => $this->get_id(),
                'exam_id'     => $exam_id
            ]);
            $response->set_question_id($this->get_id());
            $response->set_user_id(Orm_User::get_logged_user_id());
            $response->set_exam_id($exam_id);
            $response->set_text($value);
            $response->save();
        }

        return true;
    }

    public function get_question_with_user_response($exam_id, $user_id=0, $correction_more=false) {

        $user_id = $user_id?: Orm_User::get_logged_user_id();

        $view = $correction_more?
            'design/question/types/answer_preview/textarea':
            'design/question/types/preview/textarea';

        $file = Orm_Tst_Exam_Response_Attachment::get_one([
            'exam_id'     => $exam_id,
            'question_id' => $this->get_id(),
            'user_id'     => $user_id
        ]);

        return $this->get_ci()->load->view($view, [
            'question' => $this,
            'question_mark' => Orm_Tst_Exam_Questions::get_one(['exam_id'=>$exam_id, 'question_id'=>$this->get_id()])->get_mark(),
            'mark'         => Orm_Tst_Exam_Student_Mark::get_one(['exam_id'=>$exam_id, 'user_id'=>$user_id, 'question_id'=>$this->get_id()])->get_mark(),
            'value' => Orm_Tst_Exam_Response_Text::get_One([
                'exam_id'     => $exam_id,
                'question_id' => $this->get_id(),
                'user_id'     => $user_id
            ]),
            'attach'        => $file
        ], true);

    }


    /**
     * @param array $filters
     * @return int|Orm_Survey_User_Response_Text[]
     */
    public function get_user_response($filters = array()) {

        if(!is_array($filters)) {
            $filters = array();
        }

        $filters['question_id'] = $this->get_id();

        return Orm_Survey_User_Response_Text::get_all($filters,1, self::NUMBER_OF_RESPONSE);
    }
}