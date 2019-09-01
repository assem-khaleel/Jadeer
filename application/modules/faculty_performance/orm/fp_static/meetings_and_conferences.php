<?php

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/06/17
 * Time: 03:45 م
 */
class Orm_Fp_Static_Meetings_And_Conferences extends Orm_Fp_Static
{
    // 75 Presentation Title
    /**
     * draw the text for the input id = 75
     * @return object|string
     */
    protected function draw_75() {
        return self::get_ci()->load->view('static/text',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_75($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), "Please Enter {$this->get_input()->get_input_label_en()}");
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_arabic", $this->get_result()->get_input_value_ar(), "الرجاء ادخال {$this->get_input()->get_input_label_ar()}");
    }

    // 77  Date

    /**
     * draw the date for the input id = 77
     * @return object|string
     */
    protected function draw_77() {
        return self::get_ci()->load->view('static/date',['static' => $this],true);
    }

    protected function validate_77($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $english_value);

        $error_msg = "Please Select {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء اختيار {$this->get_input()->get_input_label_ar()}";
        }

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $error_msg);
    }


    // 78 Meeting or Conference

    /**
     * draw the text for the input id = 78
     * @return object|string
     */
    protected function draw_78() {
        return self::get_ci()->load->view('static/text',['static' => $this],true);
    }

    protected function validate_78($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), "Please Enter {$this->get_input()->get_input_label_en()}");
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_arabic", $this->get_result()->get_input_value_ar(), "الرجاء ادخال {$this->get_input()->get_input_label_ar()}");
    }

}