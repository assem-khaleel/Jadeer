<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 11/29/15
 * Time: 5:26 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

    public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
    {
        if(ENVIRONMENT != 'development' && $status_code == 403) {

            $request_url = (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/');

            //redirect
            header('Location: '.$request_url, TRUE);
            exit;

        } else {
            return parent::show_error($heading, $message, $template, $status_code);
        }
    }

}