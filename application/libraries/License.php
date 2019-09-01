<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 2/8/17
 * Time: 4:41 PM
 */

class License {

    private static $instance = null;

    const PACKAGE_STANDARD = 1;
    const PACKAGE_PREMIUM = 2;
    const PACKAGE_ULTIMATE = 3;

    public static $packages = array(
        self::PACKAGE_STANDARD => 'Standard',
        self::PACKAGE_PREMIUM  => 'Premium',
        self::PACKAGE_ULTIMATE => 'Ultimate'
    );

    public static function get_instance() {

        if(is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private $token;

    public function __construct() {

        $key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjb2xsZWdlcyI6W10sInByb2dyYW1zIjpbXSwiaXNzIjoiaHR0cDpcL1wvamFkZWVyLmxvY2FsXC9lYWEiLCJpYXQiOjE0ODY1NzE2MzcsImV4cCI6MTI2MjI5NjgwMH0.U1qAPwJJXpQKxv1pVbhNcnVknrwSwX8IA3VD2TK7xpQ';

        if(file_exists(FCPATH . 'license_' . ENVIRONMENT . '.key')){
            $key = file_get_contents(FCPATH . 'license_' . ENVIRONMENT . '.key');
        }

        $parser = new Lcobucci\JWT\Parser();
        $this->token = $parser->parse($key);

        self::$instance = $this;
    }

    private $verify = null;

    public function verify($show_license = false) {

        if(is_null($this->verify)) {

            $this->verify = false;

            $signer = new Lcobucci\JWT\Signer\Hmac\Sha256();

            if($this->token->verify($signer, md5('EAA-License-jfsSXgWYyGb2=wZv'))) {
                $validate_data = new Lcobucci\JWT\ValidationData();
                $validate_data->setIssuer(get_instance()->config->base_url('eaa'));

                if($this->token->validate($validate_data)) {
                    $this->verify = true;
                }
            }
        }

        if(!$this->verify && $show_license) {
            show_error('The Jadeer product validity for your institution expired. <br><br> Please contact <a href="http://eaa.com.sa/contact" target="_blank">eaa</a> to renew your expiration.', 401, 'Forbidden');
        }

        return $this->verify;
    }

    public function check_module($module, $show_license = false) {

        if($this->verify($show_license)) {

            $modules = $this->get_modules();

            if(isset($modules[$module]) && $modules[$module]) {
                return true;
            }

            if($show_license) {
                show_error('Your institution is not licensed to use the '.str_replace('_', ' ', $module).' module. <br><br> Please contact <a href="http://eaa.com.sa/contact" target="_blank">eaa</a> to license this module for your institution.', 401, 'Forbidden');
            }
        }

        return false;
    }

    private $colleges = null;

    public function get_colleges() {

        if(is_null($this->colleges)){
            $this->colleges = (array) $this->token->getClaim('colleges', array(0));
        }

        return $this->colleges;
    }

    private $programs = null;

    public function get_programs() {

        if(is_null($this->programs)){
            $this->programs = (array) $this->token->getClaim('programs', array(0));
        }

        return $this->programs;
    }

    private $modules = null;

    public function get_modules() {

        if(is_null($this->modules)) {
            $this->modules = (array) $this->token->getClaim('modules', array());
        }

        return $this->modules;
    }

    public function get_expiration() {
        return date('Y-m-d', $this->token->getClaim('exp', strtotime('next year - 1 day')));
    }

    public function get_package() {
        return intval($this->token->getClaim('package',self::PACKAGE_STANDARD));
    }

    public static function valid_colleges($field) {
        if(License::get_instance()->get_package() !== License::PACKAGE_ULTIMATE) {
            $ci = &get_instance();
            $ci->db->where_in($field, License::get_instance()->get_colleges());
        }
    }

    public static function valid_programs($field) {
        if(License::get_instance()->get_package() !== License::PACKAGE_ULTIMATE) {
            $ci = &get_instance();
            $ci->db->where_in($field, License::get_instance()->get_programs());
        }
    }
}