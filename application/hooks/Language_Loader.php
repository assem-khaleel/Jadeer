<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language_Loader
{

    function initialize()
    {

        $CI =& get_instance();

        if(is_null($CI)) {
            define('UI_LANG', 'english');
        } else {

            if(Orm_User::is_logged_in()) {
                License::get_instance()->verify(true);
            }

            if (!is_cli()) {
                $site_lang = $CI->session->userdata('site_lang');
            }

            if (empty($site_lang)) {
                $site_lang = $CI->config->item('language');
            }

            $file = APPPATH . "language/{$site_lang}/all_lang.php";
            if (!file_exists($file)) {
                Orm_Translation::generate_lang_file();
            }

            define('UI_LANG', $site_lang);
            $CI->lang->load('all', $site_lang);
        }

    }

}
