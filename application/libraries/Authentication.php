<?php

/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 4/4/16
 * Time: 10:48 AM
 */
class Authentication
{

    public static function init() {

        $class = null;

        if (Orm::get_ci()->config->item('external_auth')) {
            $university = ucfirst(Orm::get_ci()->config->item('university'));
            $class = "Authentication_{$university}";
            Orm::get_ci()->load->library($class);
        }

        return $class;
    }

    public static function before_login() {
        $class = self::init();
        if(!is_null($class)) {
            $class::before_login();
        }
    }

    public static function after_login() {
        $class = self::init();
        if(!is_null($class)) {
            $class::after_login();
        }
    }

    public static function logout() {
        $class = self::init();
        if(!is_null($class)) {
            $class::logout();
        }
    }
}