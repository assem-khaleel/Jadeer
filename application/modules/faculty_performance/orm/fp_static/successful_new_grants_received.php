<?php

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/06/17
 * Time: 04:15 م
 */
class Orm_Fp_Static_Successful_New_Grants_Received extends  Orm_Fp_Static
{
    // 111 Title
    /**
     * draw the text for the input id = 111
     * @return object|string
     */
    protected function draw_111() {
        return self::get_ci()->load->view('static/text',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_111($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), "Please Enter {$this->get_input()->get_input_label_en()}");
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_arabic", $this->get_result()->get_input_value_ar(), "الرجاء ادخال {$this->get_input()->get_input_label_ar()}");
    }

    // 116 Date

    /**
     * draw the number for the input id = 116
     * @return object|string
     */
    protected function draw_116() {
        return self::get_ci()->load->view('static/number',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_116($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        $error_msg = "Please Enter {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء إدخال {$this->get_input()->get_input_label_ar()}";
        }

        $number_error_msg = "{$this->get_input()->get_input_label_en()} Filed must be a Nmuber";

        if(UI_LANG == 'arabic') {
            $number_error_msg = "الحقل {$this->get_input()->get_input_label_ar()}  يجب أن يحتوي على رقم";
        }

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(),$error_msg);
        Validator::numeric_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $number_error_msg);
    }

}