<?php

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/06/17
 * Time: 03:34 م
 */
class Orm_Fp_Static_Journal_Articles_Non_Refereed extends Orm_Fp_Static
{
    // 59 Article Title
    /**
     * draw the text for the input id = 59
     * @return object|string
     */
    protected function draw_59() {
        return self::get_ci()->load->view('static/text',['static' => $this],true);
    }

    /**
     *set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_59($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), "Please Enter {$this->get_input()->get_input_label_en()}");
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_arabic", $this->get_result()->get_input_value_ar(), "الرجاء ادخال {$this->get_input()->get_input_label_ar()}");
    }

    // 61 Appeared and Accepted

    /**
     * draw the text for the input id = 61
     * @return object|string
     */
    protected function draw_61() {
        return self::get_ci()->load->view('static/text',['static' => $this],true);
    }

    /**
     *set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_61($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);
        
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), lang('Required Field'));
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_arabic", $this->get_result()->get_input_value_ar(), lang('Required Field'));
    }

}