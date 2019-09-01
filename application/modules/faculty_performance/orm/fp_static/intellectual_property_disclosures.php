<?php

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/06/17
 * Time: 03:58 م
 */
class Orm_Fp_Static_Intellectual_Property_Disclosures extends Orm_Fp_Static
{
    // 140 Name
    /**
     * draw the text for the input id = 140
     * @return object|string
     */
    protected function draw_140() {
        return self::get_ci()->load->view('static/text',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_140($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);


        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), "Please Enter {$this->get_input()->get_input_label_en()}");
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_arabic", $this->get_result()->get_input_value_ar(), "الرجاء ادخال {$this->get_input()->get_input_label_ar()}");
    }

    // 141 Date

    /**
     * draw the date selector for the input id = 141
     * @return object|string
     */
    protected function draw_141() {
        return self::get_ci()->load->view('static/date',['static' => $this],true);
    }

    protected function validate_141($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        $error_msg = "Please Select {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء اختيار {$this->get_input()->get_input_label_ar()}";
        }

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $error_msg);
    }

}