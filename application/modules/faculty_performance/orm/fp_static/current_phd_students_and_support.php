<?php

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/06/17
 * Time: 04:58 م
 */
class Orm_Fp_Static_Current_Phd_Students_And_Support extends Orm_Fp_Static
{
    // 34 Name
    /**
     * draw the text for the input id =34
     * @return object|string
     */
    protected function draw_34() {
        return self::get_ci()->load->view('static/text',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_34($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);


        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), "Please Enter {$this->get_input()->get_input_label_en()}");
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_arabic", $this->get_result()->get_input_value_ar(), "الرجاء ادخال {$this->get_input()->get_input_label_ar()}");
    }

    // 35 Department

    /**
     *  get the value of input if set as selected  " Department that chosen "
     * @return string
     */
    protected function get_input_35() {
        return Orm_Department::get_instance($this->get_result()->get_input_value_en())->get_name();
    }

    /**
     * draw the department selector for the input id =35
     * @return object|string
     */
    protected function draw_35() {
        return self::get_ci()->load->view('static/department',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_35($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);


        $college_id = self::get_ci()->input->get_post("college_id_{$this->get_input()->get_id()}");

        Validator::not_empty_field_validator("ids_{$this->get_input()->get_id()}_department", $this->get_result()->get_input_value_en(), lang('Please Select Department'));
        Validator::not_empty_field_validator("ids_{$this->get_input()->get_id()}_college", $college_id, lang('Please Select College'));

    }

}