<?php

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/06/17
 * Time: 04:56 م
 */
class Orm_Fp_Static_Ms_Non_Thesis_Completed extends Orm_Fp_Static
{
    // 24 Name
    /**
     * draw the text for the input id = 24
     * @return object|string
     */
    protected function draw_24() {
        return self::get_ci()->load->view('static/text',['static' => $this],true);
    }

    /**
     * et validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_24($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);


        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), "Please Enter {$this->get_input()->get_input_label_en()}");
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_arabic", $this->get_result()->get_input_value_ar(), "الرجاء ادخال {$this->get_input()->get_input_label_ar()}");
    }

    // 25 Degree

    /**
     * get the value of input if set as selected  " Degree that chosen "
     * @return string
     */
    protected function get_input_25() {
        return Orm_Degree::get_instance($this->get_result()->get_input_value_en())->get_name();

    }

    /**
     * draw the Degree Selector for the input id = 25
     * @return object|string
     */
    protected function draw_25() {
        return self::get_ci()->load->view('static/degree',['static' => $this],true);
    }

    /**
     * et validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_25($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        $error_msg = "Please Select {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء اختيار {$this->get_input()->get_input_label_ar()}";
        }

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $error_msg);
    }

    // 26 Thesis Title

    /**
     * draw the text for the input id = 26
     * @return object|string
     */
    protected function draw_26() {
        return self::get_ci()->load->view('static/text',['static' => $this],true);
    }

    /**
     * et validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_26($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), "Please Enter {$this->get_input()->get_input_label_en()}");
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_arabic", $this->get_result()->get_input_value_ar(), "الرجاء ادخال {$this->get_input()->get_input_label_ar()}");
    }

}