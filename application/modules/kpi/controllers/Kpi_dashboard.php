<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 11/19/15
 * Time: 11:04 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
defined('MODULES_ONLY') OR exit('No direct script access allowed');


/**
 * @property CI_Input $input
 * @property Layout $layout
 * Class Kpi_Dashboard
 */
class Kpi_Dashboard extends MX_Controller {

    /**
     * @var $view_params  (array) => the array pf data that will send to views
     */

    private $view_params;

    /**
     * Kpi_Dashboard constructor.
     */
    public function __construct() {

        parent::__construct();

        if(!License::get_instance()->check_module('kpi', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->layout->add_javascript('https://www.google.com/jsapi', false);
    }

    /**
     * show all data that are needed in Dashboard of KPI with the information for each one
     */
    public function index() {

        if($this->input->is_ajax_request()) {
            /** @var Orm_User_Faculty | Orm_User_Staff $user */
            $user = Orm_User::get_logged_user();
            $standard_id = $this->input->post('standard_id');
            $category_id = $this->input->post('category_id');

            $filter_kpis = array('standard_id' => $standard_id,'category_id' => $category_id);

            $view_type = Orm_Kpi_Detail::TYPE_INSTITUTION;
            $filter = array();
            $filter['academic_year'] = Orm_Semester::get_active_semester()->get_year();
            if ($user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_PROGRAM_ADMIN)
            {
                $filter['college_id'] = $user->get_college_id();
                $filter['program_id'] = $user->get_program_id();
                $filter_kpis['college_id'] = $user->get_college_id();
                $view_type = Orm_Kpi_Detail::TYPE_PROGRAM;
            }
            elseif ($user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_PROGRAM_ADMIN)
            {
                $filter['college_id'] = $user->get_college_id();
                $filter_kpis['college_id'] = $user->get_college_id();
                $view_type = Orm_Kpi_Detail::TYPE_COLLEGE;
            } elseif ($user->get_role_obj()->get_admin_level() == Orm_Role::ROLE_INSTITUTION_ADMIN) {
                $filter_kpis['college_id'] = 0;
            }

            $KPIs = Orm_Kpi::get_all($filter_kpis);
            $this->view_params['KPIs'] = $KPIs;
            $this->view_params['category'] = $category_id;
            $filter['disable_table'] = true;
            $this->view_params['filters'] = $filter;
            $this->view_params['type'] = $view_type;
            $this->view_params['category_id'] = $category_id;

            $this->load->view('kpi/dashboard/kpi',$this->view_params);
        } else {
            $this->load->view('kpi/dashboard/list', $this->view_params);
        }
    }
}