<?php

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/06/17
 * Time: 02:16 م
 */
class Orm_Fp_Static_Laboratory_Course_Development extends  Orm_Fp_Static
{
    // 9 Semester
    /**
     * get the value of input if set as selected  " semester that chosen "
     * @return string
     */
    protected function get_input_9() {
        return Orm_Semester::get_instance($this->get_result()->get_input_value_en())->get_name();
    }

    /**
     * draw the semester for the input id = 9
     * @return object|string
     */
    protected function draw_9() {
        return self::get_ci()->load->view('static/semester',['static' => $this],true);
    }

    protected function validate_9($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        $error_msg = "Please Select {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء اختيار {$this->get_input()->get_input_label_ar()}";
        }

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $error_msg);
    }

    // 11 Course Title

    /**
     * get the value of input if set as selected  " Course that chosen "
     * @return string
     */
    protected function get_input_11() {
        return Orm_Course::get_instance($this->get_result()->get_input_value_en())->get_name();

    }

    /**
     * draw the find_course selector for the input id = 11
     * @return object|string
     */
    protected function draw_11() {
        return self::get_ci()->load->view('static/find_course',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_11($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        $error_msg = "Please Select {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء اختيار {$this->get_input()->get_input_label_ar()}";
        }

        Validator::not_empty_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $error_msg);
    }

}