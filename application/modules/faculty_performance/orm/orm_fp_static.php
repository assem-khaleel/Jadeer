<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Orm_Fp_Forms_Result $result
 * @property Orm_Fp_Forms_Inputs $input
 *
 * Class Orm_Fp_Static
 */
class Orm_Fp_Static extends Orm {

    protected $result;
    protected $input;

    /**
     * Orm_Fp_Static constructor.
     * @param Orm_Fp_Forms_Inputs $input
     * @param Orm_Fp_Forms_Result $result
     */
    public function __construct(Orm_Fp_Forms_Inputs $input, Orm_Fp_Forms_Result $result) {
        $this->result = $result;
        $this->input = $input;
    }

    /**
     * get the value of inputs
     * @return string
     */
    public function get_value() {
        $function_name = "get_input_{$this->input->get_id()}";

        if(method_exists($this, $function_name)) {
            return $this->$function_name();
        }

        return $this->result->get_values();
    }

    /**
     * draw the html for every inputs depends on type of html input ( text , number , date, selectors .... etc)
     * @return object|string
     */
    public function draw() {
        $function_name = "draw_{$this->input->get_id()}";

        if(method_exists($this, $function_name)) {
            return $this->$function_name();
        }

        return self::get_ci()->load->view('static/textarea',['static' => $this],true);
    }

    /**
     * set the data in the inputs if save and validation appear
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     * @return Orm_Fp_Forms_Result
     */
    protected function refill($deadline_id, $english_value, $arabic_value) {
        $this->get_result()->set_user_id(Orm_User::get_logged_user_id());
        $this->get_result()->set_input_id($this->get_input()->get_id());
        $this->get_result()->set_form_id($this->get_input()->get_form_id());
        $this->get_result()->set_deadline_id($deadline_id);
        $this->get_result()->set_input_value_en($english_value);
        $this->get_result()->set_input_value_ar($arabic_value);

        return $this->get_result();
    }

    /**
     * validation of values depends on current deadline and the values that set in the arabic and english field
     * @param $deadline_id
     * @param $english_value
     * @param $arabic_value
     * @return mixed
     */
    public function validate($deadline_id, $english_value, $arabic_value) {

        $function_name = "validate_{$this->input->get_id()}";

        if(method_exists($this, $function_name)) {
            return $this->$function_name($deadline_id, $english_value, $arabic_value);
        }

        $this->refill($deadline_id, $english_value, $arabic_value);

        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_english", $this->get_result()->get_input_value_en(), "Please Enter {$this->get_input()->get_input_label_en()}");
        Validator::required_field_validator("ids_{$this->get_input()->get_id()}_arabic", $this->get_result()->get_input_value_ar(), "الرجاء ادخال {$this->get_input()->get_input_label_ar()}");
    }

    /**
     * save data after check validation in result database
     */
    public function save() {
        $this->get_result()->save();
    }

    /**
     * get the inputs of forms
     * @return Orm_Fp_Forms_Inputs
     */
    public function get_input() {
        return $this->input;
    }

    /**
     * get the result of inputs
     * @return Orm_Fp_Forms_Result
     */
    public function get_result() {
        return $this->result;
    }

}

