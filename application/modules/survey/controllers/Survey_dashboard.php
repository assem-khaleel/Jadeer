<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 11/19/15
 * Time: 2:11 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
defined('MODULES_ONLY') OR exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property Layout $layout
 * @property CI_Config $config
 * Class Survey_Dashboard
 */
class Survey_Dashboard extends MX_Controller {

    private $view_params;

    /**
     * Survey_Dashboard constructor.
     */
    public function __construct() {
        parent::__construct();

        if(!License::get_instance()->check_module('survey', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
    }

    /**
     *this function personal
     * @return string the html view
     */
    public function personal() {
        $this->load->view('survey/dashboard/personal', $this->view_params);
    }


    /**
     *this function hint
     * @return string the html view
     */
    public function hint(){
        $this->load->view('survey/dashboard/hint',$this->view_params);
    }
}