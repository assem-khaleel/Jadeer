<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Orm_Fp_Forms_Result $result
 *
 * Class Orm_Fp_Static_Courses_Taught
 */
class Orm_Fp_Static_Courses_Taught extends Orm_Fp_Static {

    // 53 Semester
    /**
     *  get the value of input if set as selected  " semester that chosen "
     * @return string
     */
    protected function get_input_53() {
        return Orm_Semester::get_instance($this->get_result()->get_input_value_en())->get_name();
    }

    /**
     * draw the semester selector for the input id = 53
     * @return object|string
     */
    protected function draw_53() {
        return self::get_ci()->load->view('static/semester',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_53($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        $error_msg = "Please Select {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء اختيار {$this->get_input()->get_input_label_ar()}";
        }

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $error_msg);
    }


    // 55 Course Title

    /**
     *  get the value of input if set as selected  " Course that chosen "
     * @return string
     */
    protected function get_input_55() {
        return Orm_Course::get_instance($this->get_result()->get_input_value_en())->get_name();

    }

    /**
     * draw the find_course selector for the input id = 55
     * @return object|string
     */
    protected function draw_55() {
        return self::get_ci()->load->view('static/find_course',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_55($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        $error_msg = "Please Select {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء اختيار {$this->get_input()->get_input_label_ar()}";
        }

        Validator::not_empty_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $error_msg);
    }

    // 57 Number of Students Enrolled

    /**
     * draw the number for the input id = 57
     * @return object|string
     */
    protected function draw_57() {
        return self::get_ci()->load->view('static/number',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_57($deadline_id, $english_value, $arabic_value) {
        $this->refill($deadline_id, $english_value, $arabic_value);

        $error_msg = "Please Enter {$this->get_input()->get_input_label_en()}";

        if(UI_LANG == 'arabic') {
            $error_msg = "الرجاء إدخال {$this->get_input()->get_input_label_ar()}";
        }

        $number_error_msg = "{$this->get_input()->get_input_label_en()} Filed must be a Nmuber";

        if(UI_LANG == 'arabic') {
            $number_error_msg = "الحقل {$this->get_input()->get_input_label_ar()}  يجب أن يحتوي على رقم";
        }

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $error_msg);
        Validator::numeric_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), $number_error_msg);
    }


    // 58 Course Evaluation Overall Rating

    /**
     * draw the number  for the input id = 58
     * @return object|string
     */
    protected function draw_58() {
        return self::get_ci()->load->view('static/number',['static' => $this],true);
    }

    /**
     * set validation for the input depends on deadline id , the value in 2 language
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     */
    protected function validate_58($deadline_id, $english_value, $arabic_value) {
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

