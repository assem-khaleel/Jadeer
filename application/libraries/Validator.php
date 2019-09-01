<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validator {

    private static $errors;
    private static $success_flag = true;
    private static $successes;

    public static function required_field_validator($field_name, $value = '', $error_msg = '', $index = NULL) {
        if (!mb_strlen(trim($value))) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function date_range_validator($field_name, $from_date = '', $to_date = '', $error_msg = '', $index = NULL) {
        if(strtotime($from_date) > strtotime($to_date)) {
            Validator::set_error($field_name, $error_msg, $index);
        }
    }

    public static function required_array_validator($field_name, $value = '', $error_msg = '', $index = NULL) {
        if (!is_array($value) or ! count($value)) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function email_field_validator($field_name, $value = '', $error_msg = '', $index = NULL) {
        $reg_exp = '#^[_a-z0-9\-]+(\.[_a-z0-9\-]+)*@[a-z0-9\-]+(\.[a-z0-9\-]+)*(\.[a-z0-9]{2,3})$#i';
        if (!preg_match($reg_exp, $value)) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function minimum_length_validator($field_name, $value = '', $min = 0, $error_msg = '', $index = NULL) {
        if (mb_strlen(trim($value)) < $min) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function maximum_length_validator($field_name, $value = '', $max = 100, $error_msg = '', $index = NULL) {
        if (mb_strlen(trim($value)) > $max) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function integer_field_validator($field_name, $value = '', $error_msg = '', $index = NULL) {
        $reg_exp = '#^[0-9]+$#i';
        if (!preg_match($reg_exp, $value)) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function database_name_field_validator($field_name, $value = '', $error_msg = '', $index = NULL) {
        $reg_exp = '^[a-z0-9_]+$';

        if (!preg_match("#$reg_exp#i", $value)) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    /**
     * @param Orm $orm current object
     * @param string $table_column database table column name
     * @param string $field_name html tag name
     * @param string $value post value
     * @param string $error_msg
     * @param null $index
     * @param array $filters
     * @param null $orm_class
     */
    public static function database_unique_field_validator(Orm $orm, $table_column, $field_name, $value = '', $error_msg = '', $index = NULL, $filters = array(), $orm_class = null) {

        $orm_class = is_null($orm_class) ? get_class($orm) : $orm_class; /** @var $orm_class Orm */

        if(!is_array($filters)) {
            $filters = array();
        }

        if(class_exists($orm_class) && method_exists($orm_class, 'get_one') && method_exists($orm_class, 'get_id') && method_exists($orm_class, "get_{$table_column}")) {

            $filters = array_merge([$table_column => $value, 'not_id' => $orm->get_id()], $filters);

            $obj = $orm_class::get_one($filters);

            if(!is_null($obj) && $obj->get_id()) {
                self::set_error($field_name, $error_msg, $index);
            }

        } else {
            self::set_error($field_name, 'Error: Database Unique Field Validator', $index);
        }

    }

    public static function date_format_validator($field_name, $value = '', $error_msg = '', $index = NULL) {

        $reg_exp = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
        if (!preg_match($reg_exp, $value)) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function alphanumeric_field_validator($field_name, $value = '', $error_msg = '', $index = NULL) {
        $is_alphanumeric = trim(ctype_alnum($value));

        if (!$is_alphanumeric) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function numeric_field_validator($field_name, $value = '', $error_msg = '', $index = NULL) {

        if (!is_numeric($value)) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function greater_than_validator($field_name, $value = '', $number = 0, $error_msg = '', $index = NULL) {

        if ($value > $number) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function less_than_validator($field_name, $value = '', $number = 0, $error_msg = '', $index = NULL) {

        if ($value < $number) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function username_field_validator($field_name, $value = '', $error_msg = '', $index = NULL) {
        $reg_exp = '#^([a-z0-9]+[\.]?[a-z0-9]+[_]?[a-z0-9]+)+[a-z0-9]+$#i';
        if (!preg_match($reg_exp, $value)) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function compare_value_validator($field_name, $value1, $value2, $error_msg = '', $index = NULL) {
        if ($value1 != $value2) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function not_empty_field_validator($field_name, $value = '', $error_msg = '', $index = NULL) {
        if (!isset($value) OR ( isset($value) AND ! $value)) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function zero_one_field_validator($field_name, $value = '', $error_msg = 'Invalid property value', $index = NULL) {
        if (0 !== $value && 1 !== $value) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function strip_tags_validator($field_name, $value = '', $error_msg = '', $index = NULL) {
        $clean_text = strip_tags($value);
        if ($clean_text != $value) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function class_exists_validator($field_name, $value = '', $error_msg = '', $index = NULL) {
        if (!class_exists(trim($value))) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function in_array_validator($field_name, $value = '', $array = array(), $error_msg = '', $index = NULL) {
        if (!in_array($value, $array)) {
            self::set_error($field_name, $error_msg, $index);
        }
    }

    public static function set_error($field_name, $error_msg, $index = NULL) {
        $can_set_error_flag = true;
        if (isset(self::$errors[$field_name])) {
            if (NULL !== $index) {
                $can_set_error_flag = !isset(self::$errors[$field_name][$index]);
            } else {
                $can_set_error_flag = false;
            }
        }

        if ($can_set_error_flag) {
            if (NULL === $index) {
                self::$errors[$field_name] = $error_msg;
            } else {
                self::$errors[$field_name][$index] = $error_msg;
            }
            self::$success_flag = false;
        }
    }

    public static function set_success($field_name, $success_msg, $index = NULL) {
        self::$successes[$field_name] = $success_msg;
    }

    public static function success() {
        return self::$success_flag;
    }

    public static function get_errors() {
        return self::$errors;
    }

    public static function get_successes() {
        return self::$successes;
    }

    public static function clear() {
        self::$errors = array();
        self::$successes = array();
        self::$success_flag = true;
    }

    public static function get_error_message($field_name, $index = NULL) {
        if (NULL !== $index) {
            return (isset(self::$errors[$field_name][$index]) ? self::$errors[$field_name][$index] : '' );
        } else {
            return (isset(self::$errors[$field_name]) ? self::$errors[$field_name] : '' );
        }
    }

    public static function get_html_error_message($field_name, $index = NULL) {
        $output = '';
        $message = self::get_error_message($field_name, $index);
        if ($message) {
            if (is_array($message)) {
                $message = implode(', ', $message);
            }

            $output  = '<div class="form-message">' . $message . '</div>';
            $output .= '<script>$(".form-message").parents(".form-group").addClass("form-message-light has-error")</script>';
        }
        return $output;
    }

    public static function get_html_error_message_no_arrow($field_name, $index = NULL) {
        $output = '';
        $message = self::get_error_message($field_name, $index);
        if ($message) {
            if (is_array($message)) {
                $message = implode(', ', $message);
            }

            $output = '<div class="form-message validation-error-no-arrow">' . $message . '</div>';
            $output .= '<script>$(".form-message").parents(".form-group").addClass("form-message-light has-error")</script>';
        }
        return $output;
    }

    public static function get_success_message($field_name, $index = NULL) {
        if (NULL !== $index) {
            return (isset(self::$successes[$field_name][$index]) ? self::$successes[$field_name][$index] : '' );
        } else {
            return (isset(self::$successes[$field_name]) ? self::$successes[$field_name] : '' );
        }
    }

    public static function get_html_success_message($field_name, $index = NULL) {
        $output = '';
        $message = self::get_success_message($field_name, $index);
        if ($message) {
            if (is_array($message)) {
                $message = implode(', ', $message);
            }

            $output = '<div class="form-message">' . $message . '</div>';
            $output .= '<script>$(".form-message").parents(".form-group").addClass("form-message-light has-success")</script>';
        }
        return $output;
    }

    public static function get_message($field_name, $index = NULL) {
        $message = self::get_error_message($field_name, $index);
        if ($message) {
            return $message;
        }
        return self::get_success_message($field_name, $index);
    }

    public static function get_html_message($field_name, $index = NULL) {
        $message = self::get_html_error_message($field_name, $index);
        if ($message) {
            return $message;
        }
        return self::get_html_success_message($field_name, $index);
    }

    public static function set_success_flash_message($message, $keep = false) {
        $ci = & get_instance();
        $ci->session->set_flashdata('flash_message', $message);
        $ci->session->set_flashdata('flash_status', 'success');
        $ci->session->set_flashdata('flash_keep', $keep);
    }

    public static function set_error_flash_message($message, $keep = false) {
        $ci = & get_instance();
        $ci->session->set_flashdata('flash_message', $message);
        $ci->session->set_flashdata('flash_status', 'error');
        $ci->session->set_flashdata('flash_keep', $keep);
    }

    public static function keep_flash_message() {
        $ci = & get_instance();
        $ci->session->keep_flashdata('flash_message');
        $ci->session->keep_flashdata('flash_status');
    }

    public static function get_html_flash_message() {
        $ci = & get_instance();
        $message = $ci->session->flashdata('flash_message');
        $status = $ci->session->flashdata('flash_status');

        //You can use this $this->session->keep_flashdata('message'); to preserve the data for an additional request.
        if ($ci->session->flashdata('flash_keep')) {
            $ci->session->keep_flashdata('flash_message');
            $ci->session->keep_flashdata('flash_status');
        }

        $output = '';
        if ($message) {
            $title = lang($status);
            $message = str_replace("'", "\'", $message);

            $output = <<<SCRIPT
            <script>
                pxInit.push(function () {
                  $.growl.{$status}({
                      title: '{$title}',
                      message: '{$message}'
                  });
                });
            </script>
SCRIPT;
        }
        return $output;
    }

}
