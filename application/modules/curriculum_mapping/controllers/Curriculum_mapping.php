<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of accreditation
 *
 * @author qanah
 */

/**
 * @property CI_Config $config
 * Class Curriculum_Mapping
 */
class Curriculum_Mapping extends MX_Controller {

    /**
     * @var $view_params array => the array pf data that will send to views
     */

    private $view_params = array();

    /**
     * Curriculum_Mapping constructor.
     */
    public function __construct() {

        parent::__construct();

        Orm_User::check_logged_in();

        if(!License::get_instance()->check_module('curriculum_mapping', true)) {
            show_404();
        }

        $this->view_params['menu_tab'] = 'curriculum_mapping';

    }

    /**
     * get the main page depends on the logged user role
     */
    public function index() {

        if(Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            echo Modules::run('curriculum_mapping/course/index');
        } else {
            echo Modules::run('curriculum_mapping/program/index');
        }

    }

}