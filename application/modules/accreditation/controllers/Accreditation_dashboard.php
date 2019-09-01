<?php
defined('BASEPATH') OR exit('No direct script access allowed');
defined('MODULES_ONLY') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 4/9/15
 * Time: 11:43 AM
 */

/**
 * @property CI_Input $input
 * Class Accreditation_Dashboard
 */
class Accreditation_Dashboard extends MX_Controller
{
    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('accreditation', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->load->library('Node/Node_Autoloader');
        Node_Autoloader::register();
    }

    public function international()
    {

        $year = (int)$this->input->get_post('year');
        if (empty($year)) {
            $year = date('Y');
        }
        $this->view_params['year'] = $year;
        $this->view_params['node_id'] = $this->input->get_post('node_id');

        if ($this->input->is_ajax_request()) {

            switch ($this->input->get_post('type')) {
                case 'systems':
                    $this->load->view('accreditation/dashboard/international/systems', $this->view_params);
                    break;

                case 'system':
                    $this->load->view('accreditation/dashboard/international/system', $this->view_params);
                    break;
            }

        } else {
            $this->load->view('accreditation/dashboard/international', $this->view_params);
        }

        //$this->output->enable_profiler();
    }

    public function national()
    {

        $type = $this->input->get_post('type');

        $this->view_params['college_id'] = $this->input->get_post('college_id');
        $this->view_params['program_id'] = $this->input->get_post('program_id');
        $this->view_params['plan_id'] = $this->input->get_post('plan_id');

        if (!in_array($type, array('plans', 'sections', 'plans18', 'sections18'))) {

            $this->view_params['ssr_active_node'] = Orm_Node::get_active_ssr_node();
            $this->view_params['program_active_node'] = Orm_Node::get_active_program_node();
            $this->view_params['ssr2018_active_node'] = Orm_Node::get_active_program2018_node();
            $this->view_params['program2018_active_node'] = Orm_Node::get_active_ssr2018_node();
        }

        $this->view_params['course_active_node'] = Orm_Node::get_active_course_node();
        $this->view_params['course2018_active_node'] = Orm_Node::get_active_course2018_node();

        switch (Orm_User::get_logged_user()->get_institution_role()) {

            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                break;

            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $this->view_params['college_id'] = (int)Orm_User::get_logged_user()->get_college_id();
                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $this->view_params['program_id'] = (int)Orm_User::get_logged_user()->get_program_id();
                $this->view_params['college_id'] = (int)Orm_User::get_logged_user()->get_college_id();
                break;

            default :
                $this->view_params['program_id'] = (int)Orm_User::get_logged_user()->get_program_id();
                $this->view_params['college_id'] = (int)Orm_User::get_logged_user()->get_college_id();
                $this->view_params['teacher_id'] = (int)Orm_User::get_logged_user()->get_id();
                break;
        }

        if ($this->input->is_ajax_request()) {

            if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_NOT_ADMIN) {
                $this->view_params['teacher_id'] = (int)Orm_User::get_logged_user()->get_id();
            }

            switch ($type) {
                case 'colleges':
                    $this->load->view('accreditation/dashboard/national/colleges', $this->view_params);
                    break;

                case 'programs':
                    $this->load->view('accreditation/dashboard/national/programs', $this->view_params);
                    break;

                case 'plans':
                    $this->load->view('accreditation/dashboard/national/courses', $this->view_params);
                    break;

                case 'sections':
                    $this->load->view('accreditation/dashboard/national/sections', $this->view_params);
                    break;

                case 'ssr-i':
                    $this->view_params['node_id'] = $this->input->get_post('node_id');
                    $this->load->view('accreditation/dashboard/national/ssr_i', $this->view_params);
                    break;

                case 'ssr-p':
                    $this->load->view('accreditation/dashboard/national/ssr_p', $this->view_params);
                    break;

                case 'ps-pr':
                    $this->load->view('accreditation/dashboard/national/ps_pr', $this->view_params);
                    break;

                case 'colleges18':
                    $this->load->view('accreditation/dashboard/national/colleges18', $this->view_params);
                    break;

                case 'programs18':
                    $this->load->view('accreditation/dashboard/national/programs18', $this->view_params);
                    break;

                case 'plans18':
                    $this->load->view('accreditation/dashboard/national/courses18', $this->view_params);
                    break;

                case 'sections18':
                    $this->load->view('accreditation/dashboard/national/sections18', $this->view_params);
                    break;

                case 'ssr-i18':
                    $this->view_params['node_id'] = $this->input->get_post('node_id');
                    $this->load->view('accreditation/dashboard/national/ssr_i18', $this->view_params);
                    break;

                case 'ssr-p18':
                    $this->load->view('accreditation/dashboard/national/ssr_p18', $this->view_params);
                    break;

                case 'ps-pr18':
                    $this->load->view('accreditation/dashboard/national/ps_pr18', $this->view_params);
                    break;

            }

        } else {

            $this->load->view('accreditation/dashboard/national', $this->view_params);
        }

        //$this->output->enable_profiler();

    }

    public function personal()
    {
        $this->load->view('accreditation/dashboard/personal', $this->view_params);
    }
}
