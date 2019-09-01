<?php

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/06/17
 * Time: 03:10 م
 */
class Orm_Fp_Static_Current_Undergraduate_Students extends Orm_Fp_Static
{
    // 42 Name
    /**
     * draw the text for the input id = 42
     * @return object|string
     */
    protected function draw_42() {
        return self::get_ci()->load->view('static/text',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_42($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);


        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), "Please Enter {$this->get_input()->get_input_label_en()}");
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_arabic", $this->get_result()->get_input_value_ar(), "الرجاء ادخال {$this->get_input()->get_input_label_ar()}");
    }

    // 43 Course Number

    /**
     *  get the value of input if set as selected  " Course that chosen "
     * @return string
     */
    protected function get_input_43() {
        return Orm_Program::get_instance($this->get_result()->get_input_value_en())->get_name();
    }

    /**
     * draw the program selector for the input id = 43
     * @return object|string
     */
    protected function draw_43() {
        return self::get_ci()->load->view('static/program',['static' => $this],true);
    }
//

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_43($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);


        $college_id = self::get_ci()->input->get_post("college_id_{$this->get_input()->get_id()}");
        $department_id = self::get_ci()->input->get_post("department_id_{$this->get_input()->get_id()}");

        Validator::not_empty_field_validator("ids_{$this->get_input()->get_id()}_program", $this->get_result()->get_input_value_en(), lang('Please Select Program'));
        Validator::not_empty_field_validator("ids_{$this->get_input()->get_id()}_department", $department_id,lang( 'Please Select Department'));
        Validator::not_empty_field_validator("ids_{$this->get_input()->get_id()}_college", $college_id, lang('Please Select College'));

    }

    // 44 Year

    /**
     * draw the year selector for the input id = 44
     * @return object|string
     */
    protected function draw_44() {
        return self::get_ci()->load->view('static/year',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_44($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        $error_msg = "Please Select {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء اختيار {$this->get_input()->get_input_label_ar()}";
        }


        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $error_msg);
    }
    
    

}