<?php

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/06/17
 * Time: 02:13 م
 */
class Orm_Fp_Static_Course_Development extends Orm_Fp_Static
{

    // 4 Semester
    /**
     * get the value of input if set as selected  " semester that chosen "
     * @return string
     */
    protected function get_input_4() {
        return Orm_Semester::get_instance($this->get_result()->get_input_value_en())->get_name();
    }

    /**
     * draw the semester selector for the input id = 4
     * @return object|string
     */
    protected function draw_4() {
        return self::get_ci()->load->view('static/semester',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_4($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        $error_msg = "Please Select {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء اختيار {$this->get_input()->get_input_label_ar()}";
        }

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $error_msg);
    }

    // 6 Course Title

    /**
     * * get the value of input if set as selected  " Course that chosen "
     * @return string
     */
    protected function get_input_6() {
        return Orm_Course::get_instance($this->get_result()->get_input_value_en())->get_name();

    }

    /**
     * draw the find_course selector for the input id = 6
     * @return object|string
     */
    protected function draw_6() {
        return self::get_ci()->load->view('static/find_course',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_6($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        $error_msg = "Please Select {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء اختيار {$this->get_input()->get_input_label_ar()}";
        }

        Validator::not_empty_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $error_msg);
    }

}