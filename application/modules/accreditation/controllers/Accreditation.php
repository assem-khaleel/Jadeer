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
 * @property CI_Input $input
 * @property CI_Config $config
 * @property Layout $layout
 * @property Breadcrumbs $breadcrumbs
 * Class Accreditation
 */
class Accreditation extends MX_Controller
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

    private function init()
    {

        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-list');

        $this->view_params['menu_tab'] = 'national';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Accreditation'),
            'icon' => 'fa fa-sitemap'
        ), true);

        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');
        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');

        $this->layout->add_stylesheet('/assets/jadeer/css/style.css');
        $this->layout->add_stylesheet('/assets/jadeer/css/tinymce_zero.css');

    }

    private function get_breadcrumbs(Orm_Node $obj)
    {

        if ($obj->get_parent_id()) {

            $parent = $obj->get_parent_obj();
            $item_obj = $parent->get_item_obj();
            if (!is_null($item_obj) && in_array(get_class($item_obj), array('Orm_Program', 'Orm_College', 'Orm_Course'))) {
                $this->get_breadcrumbs($parent);
            }
        }

        $this->breadcrumbs->push(htmlfilter($obj->get_name()), '/accreditation/item/' . $obj->get_id());
    }

    public function index()
    {
        $this->init();

        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');
        $this->layout->view('accreditation/list', $this->view_params);
    }

    public function national()
    {
        $this->init();

        $page_header = array(
            'title' => lang('National Accreditation'),
            'icon' => 'fa fa-home'
        );

        if (Orm_Node::check_if_can_generate(true)) {
            $page_header['link_attr'] = 'data-toggle="ajaxModal" href="/accreditation/wizard_step_1/national"';
            $page_header['link_icon'] = 'plus';
            $page_header['link_title'] = lang('Create') . ' ' . lang('Accreditation');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');
        $this->breadcrumbs->push(lang('National'), '/accreditation/national');

        $institutional_active_node = Orm_Node::get_active_institutional_node();
        $ssr_active_node = Orm_Node::get_active_ssr_node();
        $program_active_node = Orm_Node::get_active_program_node();
        $course_active_node = Orm_Node::get_active_course_node();

        $institutional2018_active_node = Orm_Node::get_active_institutional2018_node();
        $ssr2018_active_node = Orm_Node::get_active_ssr2018_node();
        $program2018_active_node = Orm_Node::get_active_program2018_node();
        $course2018_active_node = Orm_Node::get_active_course2018_node();

        $user = Orm_User::get_logged_user();
        switch ($user->get_institution_role()) {

            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                $this->view_params['institutional_active_node'] = $institutional_active_node;
                $this->view_params['ssr_active_node'] = $ssr_active_node;
                $this->view_params['program_active_node'] = $program_active_node;
                $this->view_params['course_active_node'] = $course_active_node;

                $this->view_params['institutional2018_active_node'] = $institutional2018_active_node;
                $this->view_params['ssr2018_active_node'] = $ssr2018_active_node;
                $this->view_params['program2018_active_node'] = $program2018_active_node;
                $this->view_params['course2018_active_node'] = $course2018_active_node;

                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
            case Orm_Role::ROLE_COLLEGE_ADMIN:

                if ($institutional_active_node->check_if_user_can_access_node()) {
                    $this->view_params['institutional_active_node'] = $institutional_active_node;
                }
                if ($institutional2018_active_node->check_if_user_can_access_node()) {
                    $this->view_params['institutional2018_active_node'] = $institutional2018_active_node;
                }

                $this->view_params['ssr_active_node'] = $ssr_active_node;
                $this->view_params['program_active_node'] = $program_active_node;
                $this->view_params['course_active_node'] = $course_active_node;

                $this->view_params['ssr2018_active_node'] = $ssr2018_active_node;
                $this->view_params['program2018_active_node'] = $program2018_active_node;
                $this->view_params['course2018_active_node'] = $course2018_active_node;
                break;

            default :
                if ($institutional_active_node->check_if_user_can_access_node()) {
                    $this->view_params['institutional_active_node'] = $institutional_active_node;
                }

                if ($ssr_active_node->check_if_user_can_access_node()) {
                    $this->view_params['ssr_active_node'] = $ssr_active_node;
                }

                if ($program_active_node->check_if_user_can_access_node()) {
                    $this->view_params['program_active_node'] = $program_active_node;
                }
                if ($course_active_node->check_if_user_can_access_node()) {
                    $this->view_params['course_active_node'] = $course_active_node;
                }

                if ($institutional2018_active_node->check_if_user_can_access_node()) {
                    $this->view_params['institutional2018_active_node'] = $institutional2018_active_node;
                }

                if ($ssr2018_active_node->check_if_user_can_access_node()) {
                    $this->view_params['ssr2018_active_node'] = $ssr2018_active_node;
                }

                if ($program2018_active_node->check_if_user_can_access_node()) {
                    $this->view_params['program2018_active_node'] = $program2018_active_node;
                }
                if ($course2018_active_node->check_if_user_can_access_node()) {
                    $this->view_params['course2018_active_node'] = $course2018_active_node;
                }
                break;
        }

        $this->layout->view('accreditation/list_national', $this->view_params);
    }

    private function national_ssr_list()
    {
        $this->init();

        $ssr_active_node = Orm_Node::get_active_ssr_node();

        if (!$ssr_active_node->get_id()) {
            Validator::set_error_flash_message(lang("Error : Please try Again"));
            redirect('/accreditation/national');
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['exclude_na'])) {
            $filters['in_id'] = $ssr_active_node->get_item_ids_by_class_type(Orm_Node::PROGRAM_SSR);
        }
        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['department_id'])) {
            $filters['department_id'] = (int)$fltr['department_id'];
        }
        if (!empty($fltr['program_id'])) {
            $filters['id'] = (int)$fltr['program_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $user = Orm_User::get_logged_user();
        switch ($user->get_institution_role()) {

            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                break;

            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();
                $filters['department_id'] = (int)$user->get_department_id();
                $filters['id'] = (int)$user->get_program_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                $fltr['department_id'] = (int)$user->get_department_id();
                $fltr['program_id'] = (int)$user->get_program_id();
                break;

            default :
                if (Orm_User::has_role_teacher()) {

                    $nodes = array();
                    if ($ssr_active_node->get_id()) {
                        $nodes = Orm_Node::get_user_nodes($ssr_active_node->get_system_number());
                    }

                    $program_ids = array(0);
                    foreach ($nodes as $node) {
                        /* @var $node Orm_Node */
                        if (get_class($node) == Orm_Node::PROGRAM_SSR && $node->get_system_number() == $ssr_active_node->get_id()) {
                            $program_ids[] = $node->get_item_id();
                        }
                    }

                    $filters['in_id'] = $program_ids;
                } else {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect('/accreditation/national');
                }
                break;
        }

        $programs = Orm_Program::get_all($filters, $page, $per_page, array('p.department_id ASC', 'p.name_en ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_program::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['programs'] = $programs;
        $this->view_params['fltr'] = $fltr;
    }

    public function national_ssr()
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('National Accreditation'),
            'icon' => 'fa fa-home'
        ), true);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');
        $this->breadcrumbs->push(lang('National'), '/accreditation/national');
        $this->breadcrumbs->push(lang('SSR Accreditation'), '/accreditation/national_ssr');

        $this->national_ssr_list();

        $this->layout->view('accreditation/list_national_ssr', $this->view_params);
    }

    public function national_ssr_filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->national_ssr_list();
            $this->load->view('accreditation/ssr_datatable', $this->view_params);
        } else {
            $this->national_ssr();
        }
    }


    private function national_program_list()
    {
        $this->init();

        $program_active_node = Orm_Node::get_active_program_node();
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['exclude_na'])) {
            $filters['in_id'] = $program_active_node->get_item_ids_by_class_type(Orm_Node::PROGRAM_PROGRAM);
        }
        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['department_id'])) {
            $filters['department_id'] = (int)$fltr['department_id'];
        }
        if (!empty($fltr['program_id'])) {
            $filters['id'] = (int)$fltr['program_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $user = Orm_User::get_logged_user();
        switch ($user->get_institution_role()) {

            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                break;

            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();
                $filters['department_id'] = (int)$user->get_department_id();
                $filters['id'] = (int)$user->get_program_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                $fltr['department_id'] = (int)$user->get_department_id();
                $fltr['program_id'] = (int)$user->get_program_id();
                break;

            default :
                if (Orm_User::has_role_teacher()) {

                    $nodes = array();
                    if ($program_active_node->get_id()) {
                        $nodes = Orm_Node::get_user_nodes($program_active_node->get_system_number());
                    }

                    $program_ids = array(0);
                    foreach ($nodes as $node) {
                        /* @var $node Orm_Node */
                        if (get_class($node) == Orm_Node::PROGRAM_PROGRAM && $node->get_system_number() == $program_active_node->get_id()) {
                            $program_ids[] = $node->get_item_id();
                        }
                    }

                    $filters['in_id'] = $program_ids;
                } else {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect('/accreditation/national');
                }
                break;
        }

        $programs = Orm_Program::get_all($filters, $page, $per_page, array('p.department_id ASC', 'p.name_en ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_program::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['programs'] = $programs;
        $this->view_params['fltr'] = $fltr;
    }

    public function national_program()
    {


//        if (!$program_active_node->get_id()) {
//            Validator::set_error_flash_message('<b>'. lang('Please Contact College / Program Admin').'</b><br>'.lang("Program Management has not been created!"));
//            redirect('/accreditation/national');
//        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('National Accreditation'),
            'icon' => 'fa fa-home'
        ), true);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');
        $this->breadcrumbs->push(lang('National'), '/accreditation/national');
        $this->breadcrumbs->push(lang('Programs Accreditation'), '/accreditation/national_program');

        $this->national_program_list();

        $this->layout->view('accreditation/list_national_program', $this->view_params);

        //$this->output->enable_profiler();
    }

    public function national_program_filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->national_program_list();
            $this->load->view('accreditation/program_datatable', $this->view_params);
        } else {
            $this->national_program();
        }

    }


    private function national_course_list()
    {
        $this->init();

        $course_active_node = Orm_Node::get_active_course_node();

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        $filters['semester_id'] = $course_active_node->get_item_id();

        if (!empty($fltr['exclude_na'])) {
            $filters['in_id'] = $course_active_node->get_item_ids_by_class_type(Orm_Node::COURSE_COURSE);
        }
        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['department_id'])) {
            $filters['department_id'] = (int)$fltr['department_id'];
        }
        if (!empty($fltr['program_id'])) {
            $filters['program_id'] = (int)$fltr['program_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $user = Orm_User::get_logged_user();

        switch ($user->get_institution_role()) {

            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                break;

            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();
                $filters['department_id'] = (int)$user->get_department_id();
                $filters['program_id'] = (int)$user->get_program_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                $fltr['department_id'] = (int)$user->get_department_id();
                $fltr['program_id'] = (int)$user->get_program_id();
                break;

            default:
                if (Orm_User::has_role_teacher()) {
                    $teacher_course_ids = Orm_Course::get_teacher_course_ids($user->get_id());
                    if ($teacher_course_ids) {
                        $filters['in_id'] = $teacher_course_ids;
                    } else {
                        $filters['in_id'] = array(0);
                    }
                } else {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect('/accreditation/national');
                }
                break;
        }

        if (!empty($filters['program_id'])) {
            $filters['program_plan'] = true;
        }

        $courses = Orm_Course::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['courses'] = $courses;
        $this->view_params['fltr'] = $fltr;
    }

    public function national_course()
    {


//        if (!$course_active_node->get_id()) {
//            Validator::set_error_flash_message('<b>'. lang('Please Contact College / Program Admin').'</b><br>'.lang("Course Management has not been created!"));
//            redirect('/accreditation/national');
//        }

        $page_header = array(
            'title' => lang('National Accreditation'),
            'icon' => 'fa fa-home'
        );

//        closed by Mazen
//
//        if (Orm_Node::check_if_can_generate()) {
//            $page_header['link_attr'] = 'data-toggle="ajaxModal" href="/accreditation/generate_courses"';
//            $page_header['link_title'] = lang('Generate All Forms');
//        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');
        $this->breadcrumbs->push(lang('National'), '/accreditation/national');
        $this->breadcrumbs->push(lang('Courses Accreditation'), '/accreditation/national_course');

        $this->national_course_list();

        $this->layout->view('accreditation/list_national_course', $this->view_params);
    }

    public function national_course_filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->national_course_list();
            $this->load->view('accreditation/course_datatable', $this->view_params);
        } else {
            $this->national_course();
        }
    }

    /*Start of 2018 new accreditation forms*/

    private function national_ssr18_list()
    {
        $this->init();

        $ssr2018_active_node = Orm_Node::get_active_ssr2018_node();

        if (!$ssr2018_active_node->get_id()) {
            Validator::set_error_flash_message(lang("Error : Please try Again"));
            redirect('/accreditation/national');
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['exclude_na'])) {
            $filters['in_id'] = $ssr2018_active_node->get_item_ids_by_class_type(Orm_Node::PROGRAM_SSR18);
        }
        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['department_id'])) {
            $filters['department_id'] = (int)$fltr['department_id'];
        }
        if (!empty($fltr['program_id'])) {
            $filters['id'] = (int)$fltr['program_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $user = Orm_User::get_logged_user();
        switch ($user->get_institution_role()) {

            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                break;

            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();
                $filters['department_id'] = (int)$user->get_department_id();
                $filters['id'] = (int)$user->get_program_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                $fltr['department_id'] = (int)$user->get_department_id();
                $fltr['program_id'] = (int)$user->get_program_id();
                break;

            default :
                if (Orm_User::has_role_teacher()) {

                    $nodes = array();
                    if ($ssr2018_active_node->get_id()) {
                        $nodes = Orm_Node::get_user_nodes($ssr2018_active_node->get_system_number());
                    }

                    $program_ids = array(0);
                    foreach ($nodes as $node) {
                        /* @var $node Orm_Node */
                        if (get_class($node) == Orm_Node::PROGRAM_SSR18 && $node->get_system_number() == $ssr2018_active_node->get_id()) {
                            $program_ids[] = $node->get_item_id();
                        }
                    }

                    $filters['in_id'] = $program_ids;
                } else {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect('/accreditation/national_ssr18');
                }
                break;
        }

        $programs = Orm_Program::get_all($filters, $page, $per_page, array('p.department_id ASC', 'p.name_en ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_program::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['programs'] = $programs;
        $this->view_params['fltr'] = $fltr;
    }

    public function national_ssr18()
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('National Accreditation'),
            'icon' => 'fa fa-home'
        ), true);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');
        $this->breadcrumbs->push(lang('National'), '/accreditation/national');
        $this->breadcrumbs->push(lang('SSR Accreditation').' 2018', '/accreditation/national_ssr18');

        $this->national_ssr18_list();

        $this->layout->view('accreditation/list_national_ssr18', $this->view_params);
    }

    public function national_ssr18_filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->national_ssr18_list();
            $this->load->view('accreditation/ssr18_datatable', $this->view_params);
        } else {
            $this->national_ssr18();
        }
    }

    private function national_program18_list()
    {
        $this->init();

        $program_active_node = Orm_Node::get_active_program2018_node();
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['exclude_na'])) {
            $filters['in_id'] = $program_active_node->get_item_ids_by_class_type(Orm_Node::PROGRAM_PROGRAM18);
        }
        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['department_id'])) {
            $filters['department_id'] = (int)$fltr['department_id'];
        }
        if (!empty($fltr['program_id'])) {
            $filters['id'] = (int)$fltr['program_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $user = Orm_User::get_logged_user();
        switch ($user->get_institution_role()) {

            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                break;

            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();
                $filters['department_id'] = (int)$user->get_department_id();
                $filters['id'] = (int)$user->get_program_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                $fltr['department_id'] = (int)$user->get_department_id();
                $fltr['program_id'] = (int)$user->get_program_id();
                break;

            default :
                if (Orm_User::has_role_teacher()) {

                    $nodes = array();
                    if ($program_active_node->get_id()) {
                        $nodes = Orm_Node::get_user_nodes($program_active_node->get_system_number());
                    }

                    $program_ids = array(0);
                    foreach ($nodes as $node) {
                        /* @var $node Orm_Node */
                        if (get_class($node) == Orm_Node::PROGRAM_PROGRAM18 && $node->get_system_number() == $program_active_node->get_id()) {
                            $program_ids[] = $node->get_item_id();
                        }
                    }

                    $filters['in_id'] = $program_ids;
                } else {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect('/accreditation/national');
                }
                break;
        }

        $programs = Orm_Program::get_all($filters, $page, $per_page, array('p.department_id ASC', 'p.name_en ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_program::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['programs'] = $programs;
        $this->view_params['fltr'] = $fltr;
    }

    public function national_program18()
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('National Accreditation'),
            'icon' => 'fa fa-home'
        ), true);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');
        $this->breadcrumbs->push(lang('National'), '/accreditation/national');
        $this->breadcrumbs->push(lang('Programs Accreditation').' 2018', '/accreditation/national_program18');

        $this->national_program18_list();

        $this->layout->view('accreditation/list_national_program18', $this->view_params);
    }

    public function national_program18_filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->national_program18_list();
            $this->load->view('accreditation/program18_datatable', $this->view_params);
        } else {
            $this->national_program18();
        }

    }

    private function national_course18_list()
    {
        $this->init();

        $course_active_node = Orm_Node::get_active_course2018_node();

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        $filters['semester_id'] = $course_active_node->get_item_id();

        if (!empty($fltr['exclude_na'])) {
            $filters['in_id'] = $course_active_node->get_item_ids_by_class_type(Orm_Node::COURSE_COURSE18);
        }
        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['department_id'])) {
            $filters['department_id'] = (int)$fltr['department_id'];
        }
        if (!empty($fltr['program_id'])) {
            $filters['program_id'] = (int)$fltr['program_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $user = Orm_User::get_logged_user();

        switch ($user->get_institution_role()) {

            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                break;

            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $filters['college_id'] = (int)$user->get_college_id();
                $filters['department_id'] = (int)$user->get_department_id();
                $filters['program_id'] = (int)$user->get_program_id();

                $fltr['college_id'] = (int)$user->get_college_id();
                $fltr['department_id'] = (int)$user->get_department_id();
                $fltr['program_id'] = (int)$user->get_program_id();
                break;

            default:
                if (Orm_User::has_role_teacher()) {
                    $teacher_course_ids = Orm_Course::get_teacher_course_ids($user->get_id());
                    if ($teacher_course_ids) {
                        $filters['in_id'] = $teacher_course_ids;
                    } else {
                        $filters['in_id'] = array(0);
                    }
                } else {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect('/accreditation/national');
                }
                break;
        }

        if (!empty($filters['program_id'])) {
            $filters['program_plan'] = true;
        }

        $courses = Orm_Course::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['courses'] = $courses;
        $this->view_params['fltr'] = $fltr;
    }

    public function national_course18()
    {

        $page_header = array(
            'title' => lang('National Accreditation'),
            'icon' => 'fa fa-home'
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');
        $this->breadcrumbs->push(lang('National'), '/accreditation/national');
        $this->breadcrumbs->push(lang('Courses Accreditation').' 2018', '/accreditation/national_course');

        $this->national_course18_list();

        $this->layout->view('accreditation/list_national_course18', $this->view_params);
    }

    public function national_course18_filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->national_course18_list();
            $this->load->view('accreditation/course_datatable18', $this->view_params);
        } else {
            $this->national_course18();
        }
    }


    /*End of 2018 new accreditation forms*/


    private function international_list()
    {
        $this->init();

        $per_page = $this->config->item('per_page');

        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = is_array($fltr) ? $fltr : array();
        $filters['parent_id'] = 0;
        $filters['class_type_in'] = Orm_Node::get_international_systems(false);

        $user = Orm_User::get_logged_user();
        switch ($user->get_institution_role()) {
            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                break;

            default:
                $system_number = array();
                $system_number += Orm_Node_Assessor::get_assessor_systems($user->get_id());
                $system_number += Orm_Node_Reviewer::get_reviewer_systems($user->get_id());
                $filters['system_number_in'] = $system_number;
                break;
        }

        $first_levels = Orm_Node::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Node::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['first_levels'] = $first_levels;
        $this->view_params['fltr'] = $fltr;
    }

    public function international()
    {
        $page_header = array(
            'title' => lang('International Accreditation'),
            'icon' => 'fa fa-home'
        );

        if (Orm_Node::check_if_can_generate(true)) {
            $page_header['link_attr'] = 'data-toggle="ajaxModal" href="/accreditation/wizard_step_1/international"';
            $page_header['link_icon'] = 'plus';
            $page_header['link_title'] = lang('Create') . ' ' . lang('Accreditation');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');
        $this->breadcrumbs->push(lang('International'), '/accreditation/international');

        $this->international_list();

        $this->view_params['menu_tab'] = 'international';

        $this->layout->view('accreditation/list_international', $this->view_params);
    }

    public function international_filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->international_list();
            $this->load->view('accreditation/international_datatable', $this->view_params);
        } else {
            $this->international();
        }

    }

    public function wizard_step_1($type = 'international', $common_error = false)
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!Orm_Node::check_if_can_generate(true)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        if ($common_error) {
            Validator::set_error('common_error', lang('Error: No System Selected, Please Select One'));
        }

        if ($type == 'national') {
            $this->view_params['systems'] = Orm_Node::get_national_systems();
        } else {
            $this->view_params['systems'] = Orm_Node::get_international_systems();
        }

        $this->view_params['type'] = $type;
        $this->load->view('accreditation/wizard_step_1', $this->view_params);
    }

    public function wizard_step_2()
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!Orm_Node::check_if_can_generate(true)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        $system = $this->input->post('system');
        $type = $this->input->post('type');

        if (!$type) {
            $type = 'international';
        }

        if ($system && class_exists($system)) {

            if (empty($this->view_params['system'])) {
                $this->view_params['system'] = new $system();
            }

            $this->view_params['type'] = $type;
            $this->load->view('accreditation/wizard_step_2', $this->view_params);
        } else {
            $this->wizard_step_1($type, true);
        }
    }

    public function generate()
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!Orm_Node::check_if_can_generate()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        $type = $this->input->post('type');
        $system = $this->input->post('system');

        if (class_exists($system)) {

            $node = new $system();
            /* @var $node Orm_Node */

            $item_id = $node->system_validator($this->view_params);
            $node->set_item_id($item_id);

            if (Validator::success()) {

                $system_number = $node->save(false);
                $node->set_system_number($system_number);

                $node->generate();
                $node->build_parent_tree();

                Validator::set_success_flash_message(lang('Successfully Created'));
                exit('<script>window.location.reload();</script>');
            }

            $this->view_params['system'] = $node;
            $this->view_params['type'] = $type;
        }

        if ($type == 'national') {
            $this->wizard_step_1($type, true);
        } else {
            $this->wizard_step_2();
        }
    }

    public function item($id)
    {
        $this->init();

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if (!$obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');

        $system_class = get_class($obj->get_system_obj());
        if (in_array($system_class, Orm_Node::get_national_systems(false, true))) {
            $this->breadcrumbs->push(lang('National'), '/accreditation/national');

            switch ($system_class) {
                case Orm_Node::SYSTEM_COURSE:
                    $this->breadcrumbs->push(lang('Courses Accreditation'), '/accreditation/national_course');
                    break;
                case Orm_Node::SYSTEM_PROGRAM:
                    $this->breadcrumbs->push(lang('Programs Accreditation'), '/accreditation/national_program');
                    break;
                case Orm_Node::SYSTEM_SSR:
                    $this->breadcrumbs->push(lang('SSR Accreditation'), '/accreditation/national_ssr');
                    break;
                case Orm_Node::SYSTEM_COURSE2018:
                    $this->breadcrumbs->push(lang('Courses Accreditation').' 2018', '/accreditation/national_course18');
                    break;
                case Orm_Node::SYSTEM_PROGRAM2018:
                    $this->breadcrumbs->push(lang('Programs Accreditation').' 2018', '/accreditation/national_program18');
                    break;
                case Orm_Node::SYSTEM_SSR2018:
                    $this->breadcrumbs->push(lang('SSR Accreditation').' 2018', '/accreditation/national_ssr18');
                    break;
            }

        } else {
            $this->breadcrumbs->push(lang('International'), '/accreditation/international');
            $this->view_params['menu_tab'] = 'international';
        }

        $this->get_breadcrumbs($obj);

        $this->view_params['node'] = $obj;
        $this->layout->view('accreditation/item', $this->view_params);

//        $this->output->enable_profiler();
    }

    public function save()
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!$can_manage) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $id = $this->input->post('id');
        $is_finished = $this->input->post('is_finished');
        $properties = $this->input->post('properties');
        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$obj->check_if_editable()) {
            Validator::set_error_flash_message(lang('Please Check Due Date'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $old_properties = Orm_Node::get_model()->get_lazy_properties($obj->get_id());

        if (!is_array($old_properties)) {
            $old_properties = json_decode($old_properties, true);
        }

        if ($properties) {

            if($obj instanceof Node\ncacm14\Course_Specifications_C) {

                $other_program = \Orm_Program_Plan::get_all(['course_id' => $course_node = $obj->get_parent_course_node()->get_item_id()]);

                foreach ($other_program as $val) {

                    $course_map = [];

                    foreach ($properties as $name => $value) {
                        if ($name == 'course_map_' . $val->get_id()) {
                            $course_map = $value;
                            break;
                        }
                    }

                    $obj->set_course_map($course_map, $val->get_id());
                    $obj->get_property('course_map_' . $val->get_id())->validat();
                }
            }


            foreach ($properties as $name => $value) {
                $set_function = 'set_' . $name;
                if (method_exists($obj, $set_function)) {
                    $obj->$set_function($value);
                    $obj->get_property($name)->validat();
                }
                if (isset($old_properties[$name])) {
                    unset($old_properties[$name]);
                }
            }
        }

        if ($old_properties) {
            foreach ($old_properties as $name => $value) {
                $set_function = 'set_' . $name;
                if (method_exists($obj, $set_function)) {
                    $obj->$set_function($value);
                    $obj->get_property($name)->validat();
                }
            }
        }

        if (Validator::success()) {
            if ($is_finished) {
                $obj->set_is_finished($is_finished);
            }
            $obj->save();

            json_response(array('status' => true, 'html_node' => $obj->get_tree_item(false)->draw()));
        }

        json_response(array('status' => false, 'html' => $this->load->view('accreditation/create_edit', array('node' => $obj), true)));
    }

    public function send_to_review($id)
    {
        $this->init();

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if (!$obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if (!$obj->check_if_can_send_to_review()) {
            Validator::set_error_flash_message(lang("Error : Please try Again"));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if ($obj->check_if_is_finished()) {
            Validator::set_error_flash_message(lang("Error: Please make sure you are Finished all Sub-Form"));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $obj->save_as_finished();

        foreach (Orm_Node_Reviewer::get_node_reviewers($obj->get_id()) as $reviewer) {
            Orm_Notification::send_node_notification(Orm_User::get_logged_user()->get_id(), $reviewer->get_reviewer_id(), $obj->get_id(), Orm_Notification_Template::ASSESSOR_FINISHED_ENTERING_FORMS_DATA);
        }

        Validator::set_success_flash_message(lang('Successfully Sent'));
        redirect($this->input->server('HTTP_REFERER'));
    }

    public function save_review()
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!$can_manage) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $node_id = $this->input->post("node_id");
        $review_status = $this->input->post('review_status');
//        $review_comment = $this->input->post('review_comment');
        $comments = (array)$this->input->post('comments');


        $node = Orm_Node::get_instance($node_id);

        if (!$node->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$node->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$node->check_if_can_review_node()) {
            Validator::set_error_flash_message(lang("Error : Please try Again"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        Validator::not_empty_field_validator('review_status', $review_status, lang('Please choose the review status'));

        $node->set_review_status($review_status);

        if (Validator::success()) {

            $review = new Orm_Node_Review();
            $review->set_node_id($node->get_id());
            $review->set_reviewer_id(Orm_User::get_logged_user_id());
            $review->set_status($review_status);
//            $review->set_comment($review_comment);
            $review->save();

            if (!empty($comments)) {
                foreach ($comments as $comment) {
                    $point = new Orm_Node_Review_Comments();
                    $point->set_review_id($review->get_id());
                    $point->set_comment($comment);
                    $point->save();
                }

            }

            $node->save(false);

            switch ($review_status) {
                case 'compliant':
                    foreach (Orm_User::get_all_admins() as $admin) {
                        Orm_Notification::send_node_notification(Orm_User::get_logged_user()->get_id(), $admin->get_id(), $node_id, Orm_Notification_Template::ALL_FORM_ENTERD_AND_CHECKED_COREECTLY);
                    }
                    break;
                default :
                    foreach (Orm_Node_Assessor::get_node_assessors($node_id) as $assessor) {
                        Orm_Notification::send_node_notification(Orm_User::get_logged_user()->get_id(), $assessor->get_assessor_id(), $node_id, Orm_Notification_Template::FORM_DATA_INCORRECT_OR_NOT_ENTERD);
                    }
                    break;
            }
            json_response(array('status' => true, 'html_node' => $node->get_tree_item(false)->draw()));
        }

        $this->view_params['node'] = $node;
        json_response(array('status' => false, 'html' => $this->load->view('accreditation/view', $this->view_params, true)));
    }

    public function edit($id)
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!$can_manage) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        if (!$obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/accreditation";</script>');
        }

        $this->load->view('accreditation/create_edit', array('node' => $obj));
    }

    public function view($id)
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        if (!$obj->check_if_viewable()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/accreditation";</script>');
        }

        if (!$obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/accreditation";</script>');
        }

        $this->load->view('accreditation/view', array('node' => $obj));
    }

    public function view_all($id, $word = false)
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        if (!$obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/accreditation";</script>');
        }

        $this->view_params['node'] = $obj;
        $this->view_params['word'] = $word;
        if ($word) {
            $this->view_params['test_word'] = true;
        }

        $this->load->view('accreditation/view_all', $this->view_params);
    }

    public function download($id)
    {
        $this->init();

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if (!$obj->check_if_can_download()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $this->load->view('accreditation/download', array('node' => $obj));
    }

    public function word($id)
    {
        $this->init();

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if (!$obj->check_if_can_download()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $obj->generate_word();
    }

    public function pdf($id)
    {
        $this->init();

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if (!$obj->check_if_can_download()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $obj->generate_pdf();

        //$this->output->enable_profiler();
    }

    public function delete($id)
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!Orm_Node::check_if_can_generate(true)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $obj->delete_children();
        json_response(array('status' => true));
    }

    public function due_date($id)
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        if (!$obj->check_if_can_manage()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        $this->load->view('accreditation/due_date', array('node' => $obj));
    }

    public function save_due_date()
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $id = $this->input->post('id');
        $due_date = $this->input->post('due_date');

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$obj->check_if_can_manage()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        Validator::required_field_validator('due_date', $due_date, lang('Please Enter a Due Date For This Form'));


        if (Validator::success()) {
            $obj->set_due_date(date('Y-m-d 23:59:59', strtotime($due_date)));
            $obj->save();

            foreach (Orm_Node_Reviewer::get_node_reviewers($obj->get_id()) as $reviewer) {
                Orm_Notification::send_node_notification(Orm_User::get_logged_user()->get_id(), $reviewer->get_reviewer_id(), $obj->get_id(), Orm_Notification_Template::ADMIN_ENTERD_DUE_DATE_TO_NODE);
            }

            foreach (Orm_Node_Assessor::get_node_assessors($obj->get_id()) as $assessor) {
                Orm_Notification::send_node_notification(Orm_User::get_logged_user()->get_id(), $assessor->get_assessor_id(), $obj->get_id(), Orm_Notification_Template::ADMIN_ENTERD_DUE_DATE_TO_NODE);
            }

            Validator::set_success_flash_message(lang('Successfully Saved'));

            json_response(array('status' => true));
        }

        json_response(array('status' => false, 'html' => $this->load->view('accreditation/due_date', array('node' => $obj), true)));
    }

    /*
     * add user
     */
    public function user_list($id)
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        if (!$obj->check_if_can_assign_user()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $this->view_params['node'] = $obj;
        $this->load->view('accreditation/user_list', $this->view_params);
    }

    public function add_user()
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $role = $this->input->post('role');

        $node_id = $this->input->post('node_id');
        $node = Orm_Node::get_instance($node_id);

        if (!$node->get_id()) {
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$node->check_if_can_assign_user()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $this->view_params['node'] = $node;
        $this->view_params['role'] = $role;
        json_response(array('status' => true, 'html' => $this->load->view('accreditation/add_user', $this->view_params, true)));
    }

    public function save_user()
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $node_id = $this->input->post("node_id");
        $user_id = $this->input->post('user_id');
        $role = $this->input->post('role');

        $obj = Orm_Node::get_instance($node_id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$obj->check_if_can_assign_user()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        Validator::required_field_validator('role', $role, lang('Please Select Role'));
        Validator::not_empty_field_validator('user_id', $user_id, lang('Please Select User'));

        if ($role == 'assessor') {
            $parent_assessors = array();
            Orm_Node_Assessor::get_parent_assessors($node_id, $parent_assessors);

            if (in_array($user_id, array_keys($parent_assessors))) {
                Validator::set_error('user_id', lang('This Assessor Has been Selected Before'));
            }
        } elseif ($role == 'reviewer') {
            $reviewers = array();
            Orm_Node_Reviewer::get_parent_reviewers($node_id, $reviewers);

            if (in_array($user_id, array_keys($reviewers))) {
                Validator::set_error('user_id', lang('This Reviewer Has been Selected Before'));
            }
        }

        if (Validator::success()) {
            if ($role == 'assessor') {
                $node_user_obj = Orm_Node_Assessor::get_one(array('node_id' => $node_id, 'assessor_id' => $user_id));
                $node_user_obj->set_node_id($node_id);
                $node_user_obj->set_assessor_id($user_id);
            } elseif ($role == 'reviewer') {
                $node_user_obj = Orm_Node_Reviewer::get_one(array('node_id' => $node_id, 'reviewer_id' => $user_id));
                $node_user_obj->set_node_id($node_id);
                $node_user_obj->set_reviewer_id($user_id);
            }

            $node_user_obj->save();

            $this->view_params['node'] = $obj;
            json_response(array('status' => true, 'html' => $this->load->view('accreditation/user_list', $this->view_params, true)));
        }

        $this->view_params['role'] = $role;
        $this->view_params['user_id'] = $user_id;
        $this->view_params['node'] = $obj;
        json_response(array('status' => false, 'html' => $this->load->view('accreditation/add_user', $this->view_params, true)));
    }

    public function delete_user($type, $node_id, $user_id)
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $obj = Orm_Node::get_instance($node_id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$obj->check_if_can_assign_user()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if ($type == 'assessor') {
            $node_user_obj = Orm_Node_Assessor::get_one(array('node_id' => $node_id, 'assessor_id' => $user_id));
            $node_user_obj->delete();
        } elseif ($type == 'reviewer') {
            $node_user_obj = Orm_Node_Reviewer::get_one(array('node_id' => $node_id, 'reviewer_id' => $user_id));
            $node_user_obj->delete();
        }

        $this->view_params['node'] = $obj;
        json_response(array('status' => true, 'html' => $this->load->view('accreditation/user_list', $this->view_params, true)));
    }

    public function import()
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!$can_manage) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $id = $this->input->post('node_id');
        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$obj->check_if_editable()) {
            Validator::set_error_flash_message(lang('Please Check Due Date'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $old_forms = array();

        switch (get_class($obj->get_system_obj())) {
            case Orm_Node::SYSTEM_INSTITUTIONAL:
                $old_forms = Orm_Node::get_all(array('not_system_number' => $obj->get_system_number(), 'class_type' => $obj->get_class_type(), 'year_less_equal' => $obj->get_year()), 0, 0, array('n.year DESC'));
                break;
            case Orm_Node::SYSTEM_COURSE:
                $parent_course_section = $obj->get_parent_course_section_node();
                if ($parent_course_section->get_id()) {
                    $old_course_sections = Orm_Node::get_all(array('not_system_number' => $obj->get_system_number(), 'class_type' => get_class($parent_course_section), 'item_id' => $parent_course_section->get_item_id(), 'year_less_equal' => $obj->get_year()), 0, 0, array('n.year DESC'));

                    foreach ($old_course_sections as $old_course_section) {
                        $old_forms[] = Orm_Node::get_one(array('class_type' => $obj->get_class_type(), 'system_number' => $old_course_section->get_system_number(), 'parent_lft' => $old_course_section->get_parent_lft(), 'parent_rgt' => $old_course_section->get_parent_rgt()));
                    }
                } else {
                    $parent_course = $obj->get_parent_course_node();
                    if ($parent_course->get_id()) {
                        $old_courses = Orm_Node::get_all(array('not_system_number' => $obj->get_system_number(), 'class_type' => get_class($parent_course), 'item_id' => $parent_course->get_item_id(), 'year_less_equal' => $obj->get_year()), 0, 0, array('n.year DESC'));

                        foreach ($old_courses as $old_course) {
                            $old_course_section = Orm_Node::get_one(array('class_type' => Orm_Node::COURSE_SECTIONS, 'system_number' => $old_course->get_system_number(), 'parent_lft' => $old_course->get_parent_lft(), 'parent_rgt' => $old_course->get_parent_rgt()));
                            if ($old_course_section->get_id()) {
                                $old_forms[] = Orm_Node::get_one(array('class_type' => $obj->get_class_type(), 'system_number' => $old_course->get_system_number(), 'parent_lft' => $old_course->get_parent_lft(), 'parent_rgt' => $old_course->get_parent_rgt(), 'not_parent_lft' => $old_course_section->get_parent_lft(), 'not_parent_rgt' => $old_course_section->get_parent_rgt()));
                            }
                        }
                    }
                }
                break;
            default:
                $parent_program = $obj->get_parent_program_node();
                if ($parent_program->get_id()) {
                    $old_programs = Orm_Node::get_all(array('not_system_number' => $obj->get_system_number(), 'class_type' => get_class($parent_program), 'item_id' => $parent_program->get_item_id(), 'year_less_equal' => $obj->get_year()), 0, 0, array('n.year DESC'));

                    foreach ($old_programs as $old_program) {
                        $old_forms[] = Orm_Node::get_one(array('class_type' => $obj->get_class_type(), 'system_number' => $old_program->get_system_number(), 'parent_lft' => $old_program->get_parent_lft(), 'parent_rgt' => $old_program->get_parent_rgt()));
                    }
                }
                break;
        }

        $this->view_params['node'] = $obj;
        $this->view_params['old_forms'] = $old_forms;

        json_response(array('status' => true, 'html' => $this->load->view('accreditation/import', $this->view_params, true)));
    }

    public function get_node_import()
    {
        $this->init();

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!$can_manage) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $old_id = $this->input->post('old_id');
        $old_obj = Orm_Node::get_instance($old_id);

        if (!$old_obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $node_id = $this->input->post('node_id');
        $node_obj = Orm_Node::get_instance($node_id);

        if (!$node_obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$node_obj->check_if_editable()) {
            Validator::set_error_flash_message(lang('Please Check Due Date'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$node_obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (is_null($node_obj)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        json_response(array('status' => true, 'html' => $old_obj->draw_properties('log'), 'title' => $old_obj->get_date_added()));
    }

    public function apply_node_import()
    {

        $this->init();

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!$can_manage) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $old_id = $this->input->post('old_id');
        $old_obj = Orm_Node::get_instance($old_id);

        if (!$old_obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $node_id = $this->input->post('node_id');
        $node_obj = Orm_Node::get_instance($node_id);

        if (!$node_obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$node_obj->check_if_editable()) {
            Validator::set_error_flash_message(lang('Please Check Due Date'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$node_obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (is_null($node_obj)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $properties = Orm_Node::get_model()->get_lazy_properties($old_obj->get_id());

        if (!is_array($properties)) {
            $properties = json_decode($properties, true);
        }

        if ($properties) {
            foreach ($properties as $name => $value) {
                $set_function = 'set_' . $name;
                if (method_exists($node_obj, $set_function)) {
                    $node_obj->$set_function($value);
                    $node_obj->get_property($name)->validat();
                }
            }
        }

        if (Validator::success()) {

            $node_obj->save();

            Validator::set_success_flash_message(lang('This form has been imported Successfully'));
            json_response(array('status' => true));
        }

        Validator::set_error_flash_message(lang('An error encountered during importing the form'));
        json_response(array('status' => false));
    }

    public function log()
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!$can_manage) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $id = $this->input->post('node_id');
        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$obj->check_if_editable()) {
            Validator::set_error_flash_message(lang('Please Check Due Date'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $logs = Orm_Node_Log::get_all(array('node_id' => $id), 0, 0, array('nl.id DESC'));

        $this->view_params['node'] = $obj;
        $this->view_params['logs'] = $logs;
        $this->view_params['current_log'] = current($logs);
        json_response(array('status' => true, 'html' => $this->load->view('accreditation/log', $this->view_params, true)));
    }

    public function get_node_log()
    {
        $this->init();

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!$can_manage) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $id = $this->input->post('log_id');
        $log_obj = Orm_Node_Log::get_instance($id);

        if (!$log_obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $node_obj = $log_obj->get_node_obj();

        if (!$node_obj->check_if_editable()) {
            Validator::set_error_flash_message(lang('Please Check Due Date'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$node_obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (is_null($node_obj)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        json_response(array('status' => true, 'html' => $node_obj->draw_properties('log'), 'title' => $log_obj->get_date_added()));
    }

    public function apply_node_log()
    {

        $this->init();

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!$can_manage) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $id = $this->input->post('log_id');
        $log_obj = Orm_Node_Log::get_instance($id);

        if (!$log_obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $node_obj = $log_obj->get_node_obj();

        if (!$node_obj->check_if_editable()) {
            Validator::set_error_flash_message(lang('Please Check Due Date'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$node_obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (is_null($node_obj)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $properties = $log_obj->get_node_properties();

        if (!is_array($properties)) {
            $properties = json_decode($properties, true);
        }

        if ($properties) {
            foreach ($properties as $name => $value) {
                $set_function = 'set_' . $name;
                if (method_exists($node_obj, $set_function)) {
                    $node_obj->$set_function($value);
                    $node_obj->get_property($name)->validat();
                }
            }
        }

        if (Validator::success()) {

            $node_obj->save();

            Validator::set_success_flash_message(lang('This form has been reverted Successfully'));
            json_response(array('status' => true));
        }

        Validator::set_error_flash_message(lang('An error encountered during revert the form'));
        json_response(array('status' => false));
    }

    public function upload($id)
    {
        $this->init();

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!$can_manage) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $obj = Orm_Node::get_instance($id);

        $this->load->library('Uploader');

        Uploader::common_validator('file_upload', 'file');
        Uploader::zero_size_validator('file_upload', 'file', lang('File not found.'));
        Uploader::max_size_validator('file_upload', 'file', $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
        Uploader::mime_type_validator('file_upload', 'file', $this->config->item('upload_allow'), lang('File type not allowed.'));

        if (Validator::success()) {
            $file = Uploader::get_file_name('file', '/files/' . $obj->get_attachments_directory(), false);
            Uploader::move_file_to('file', rtrim(FCPATH, '/') . $file);

            json_response(array('status' => true, 'file' => $file));
        }

        json_response(array('status' => false, 'error' => Validator::get_error_message('file_upload')));
    }

    public function integration()
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!$can_manage) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $id = $this->input->post('node_id');
        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$obj->check_if_editable()) {
            Validator::set_error_flash_message(lang('Please Check Due Date'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        if (!$obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $obj->integration_processes();

        json_response(array('status' => true, 'html' => $this->load->view('accreditation/create_edit', array('node' => $obj), true)));
    }

    public function add_college($id)
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!Orm_Node::check_if_can_generate(true)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            exit('<script>location.href="/accreditation";</script>');
        }

        $this->view_params['node'] = $obj;
        $this->load->view('accreditation/add_college', $this->view_params);
    }

    public function save_college()
    {
        $this->init();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!Orm_Node::check_if_can_generate(true)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $id = $this->input->post('id');

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            json_response(array('status' => false, 'html' => '<script>location.href="/accreditation";</script>'));
        }

        $college_id = $obj->system_validator($this->view_params);

        if (Validator::success()) {
            $obj->add_college($college_id);
            $obj->build_parent_tree();
            json_response(array('status' => true));
        }

        $this->view_params['node'] = $obj;
        json_response(array('status' => false, 'html' => $this->load->view('accreditation/add_college', $this->view_params, true)));
    }

    public function add_institutional_requirement($id)
    {
        $this->init();

        $class_name = 'Node\ncassr14\Eligibility_Min_Requirements';

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if (!$obj->check_if_can_manage()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if (Orm_Node::get_count(array('system_number' => $obj->get_system_number(), 'class_type' => $class_name, 'parent_id' => $obj->get_id()))) {
            Validator::set_error_flash_message(lang('Error: Eligibility minimum requirement already added'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $eli_min = new $class_name();
        $eli_min->set_parent_id($obj->get_id());
        $eli_min->set_year($obj->get_year());
        $eli_min->set_system_number($obj->get_system_number());
        $eli_min->generate();

        $obj->build_parent_tree();

        Validator::set_success_flash_message(lang('Eligibility minimum requirement was added successfully'));
        redirect($this->input->server('HTTP_REFERER'));
    }

    public function add_national($type, $item_id)
    {
        $this->init();

        switch ($type) {
            case 'ssr':
                $program = Orm_Program::get_instance($item_id);

                if (!$program->get_id()) {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect($this->input->server('HTTP_REFERER'));
                }

                if (!Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                    if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                        if (Orm_User::get_logged_user()->get_college_id() != $program->get_department_obj()->get_college_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } elseif (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                        if (Orm_User::get_logged_user()->get_program_id() != $program->get_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } else {
                        Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                        redirect($this->input->server('HTTP_REFERER'));
                    }
                }


                $active_node = Orm_Node::get_active_ssr_node();

                $class = Orm_Node::SYSTEM_SSR;
                $node = new $class();

                $node->college_id = $program->get_department_obj()->get_college_id();
                $node->program_id = $program->get_id();
                break;
            case 'program':
                $program = Orm_Program::get_instance($item_id);

                if (!$program->get_id()) {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect($this->input->server('HTTP_REFERER'));
                }

                if (!Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                    if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                        if (Orm_User::get_logged_user()->get_college_id() != $program->get_department_obj()->get_college_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } elseif (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                        if (Orm_User::get_logged_user()->get_program_id() != $program->get_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } else {
                        Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                        redirect($this->input->server('HTTP_REFERER'));
                    }
                }


                $active_node = Orm_Node::get_active_program_node();

                $class = Orm_Node::SYSTEM_PROGRAM;
                $node = new $class();

                $node->college_id = $program->get_department_obj()->get_college_id();
                $node->program_id = $program->get_id();
                break;

            case 'course':
                $course = Orm_Course::get_instance($item_id);

                if (!$course->get_id()) {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect($this->input->server('HTTP_REFERER'));
                }

                if (!Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                    if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                        if (Orm_User::get_logged_user()->get_college_id() != $course->get_department_obj()->get_college_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } elseif (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                        $plan = Orm_Program_Plan::get_one(array('course_id' => $course->get_id(), 'program_id' => Orm_User::get_logged_user()->get_program_id()));
                        if (!$plan->get_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } else {
                        if (!$course->is_course_teacher(Orm_User::get_logged_user()->get_id())) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    }
                }

                $active_node = Orm_Node::get_active_course_node();

                $class = Orm_Node::SYSTEM_COURSE;
                $node = new $class();

                $node->course_id = $course->get_id();

                break;
            /*2018 new forms */
            case 'ssr18':
                $program = Orm_Program::get_instance($item_id);

                if (!$program->get_id()) {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect($this->input->server('HTTP_REFERER'));
                }

                if (!Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                    if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                        if (Orm_User::get_logged_user()->get_college_id() != $program->get_department_obj()->get_college_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } elseif (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                        if (Orm_User::get_logged_user()->get_program_id() != $program->get_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } else {
                        Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                        redirect($this->input->server('HTTP_REFERER'));
                    }
                }


                $active_node = Orm_Node::get_active_ssr2018_node();

                $class = Orm_Node::SYSTEM_SSR2018;
                $node = new $class();

                $node->college_id = $program->get_department_obj()->get_college_id();
                $node->program_id = $program->get_id();
                break;
            case 'program18':
                $program = Orm_Program::get_instance($item_id);

                if (!$program->get_id()) {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect($this->input->server('HTTP_REFERER'));
                }

                if (!Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                    if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                        if (Orm_User::get_logged_user()->get_college_id() != $program->get_department_obj()->get_college_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } elseif (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                        if (Orm_User::get_logged_user()->get_program_id() != $program->get_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } else {
                        Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                        redirect($this->input->server('HTTP_REFERER'));
                    }
                }


                $active_node = Orm_Node::get_active_program2018_node();


                $class = Orm_Node::SYSTEM_PROGRAM2018;
                $node = new $class();

                $node->college_id = $program->get_department_obj()->get_college_id();
                $node->program_id = $program->get_id();
                break;
            case 'course18':
                $course = Orm_Course::get_instance($item_id);

                if (!$course->get_id()) {
                    Validator::set_error_flash_message(lang("Error : Please try Again"));
                    redirect($this->input->server('HTTP_REFERER'));
                }

                if (!Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                    if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                        if (Orm_User::get_logged_user()->get_college_id() != $course->get_department_obj()->get_college_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } elseif (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                        $plan = Orm_Program_Plan::get_one(array('course_id' => $course->get_id(), 'program_id' => Orm_User::get_logged_user()->get_program_id()));
                        if (!$plan->get_id()) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    } else {
                        if (!$course->is_course_teacher(Orm_User::get_logged_user()->get_id())) {
                            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
                            redirect($this->input->server('HTTP_REFERER'));
                        }
                    }
                }

                $active_node = Orm_Node::get_active_course2018_node();

                $class = Orm_Node::SYSTEM_COURSE2018;
                $node = new $class();

                $node->course_id = $course->get_id();

                break;

            default :
                Validator::set_error_flash_message(lang('Error : Please try Again'));
                redirect($this->input->server('HTTP_REFERER'));
                break;
        }

        /** @var $node Orm_Node */
        if ($active_node->get_id()) {
            $node->set_id($active_node->get_id());
            $node->set_year($active_node->get_year());
            $node->set_item_id($active_node->get_item_id());
            $node->set_due_date($active_node->get_due_date());
        } else {
            $semester = \Orm_Semester::get_active_semester();
            $node->set_year($semester->get_year());
            $node->set_item_id($semester->get_id());
        }

        $system_number = $node->save(false);
        $node->set_system_number($system_number);

        $node->generate();
        $node->build_parent_tree();

//        $this->output->enable_profiler();

        Validator::set_success_flash_message(lang('Successfully Added'));
        redirect($this->input->server('HTTP_REFERER'));
    }

    public function generate_courses()
    {
        $this->init();

        // closed by Mazen
        Validator::set_error_flash_message(lang('Error : Please try Again'));
        redirect($this->input->server('HTTP_REFERER'));

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!Orm_Node::check_if_can_generate(true)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $college_id = $this->input->post('college_id');
            $department_id = $this->input->post('department_id');
            $program_id = $this->input->post('program_id');

            Validator::required_field_validator('college_id', $college_id, lang('Please Select College'));
            Validator::required_field_validator('department_id', $department_id, lang('Please Select Department'));
            Validator::required_field_validator('program_id', $program_id, lang('Please Select Program'));

            if (Validator::success()) {

                ini_set('max_execution_time', -1);
                ini_set('memory_limit', -1);

                $active_node = Orm_Node::get_active_course_node();

                $class = Orm_Node::SYSTEM_COURSE;
                $node = new $class();

                $node->program_id = $program_id;

                /** @var $node Orm_Node */
                if ($active_node->get_id()) {
                    $node->set_id($active_node->get_id());
                    $node->set_year($active_node->get_year());
                    $node->set_item_id($active_node->get_item_id());
                    $node->set_due_date($active_node->get_due_date());
                } else {
                    $semester = \Orm_Semester::get_active_semester();
                    $node->set_year($semester->get_year());
                    $node->set_item_id($semester->get_id());
                }

                $system_number = $node->save(false);
                $node->set_system_number($system_number);

                $node->generate();
                $node->build_parent_tree();

                Validator::set_success_flash_message(lang('All Courses Form Generated Successfully'));
                json_response(array('status' => true));
            }

            $this->view_params['college_id'] = $college_id;
            $this->view_params['department_id'] = $department_id;
            $this->view_params['program_id'] = $program_id;

            json_response(array('status' => false, 'html' => $this->load->view('accreditation/generate_courses', $this->view_params, true)));
        }

        $this->load->view('accreditation/generate_courses', $this->view_params);
    }

    public function integrate_ams($type = 'institutional')
    {
        $this->init();

        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');
        $this->breadcrumbs->push(lang('AIMS Integration'), '/accreditation/integrate_ams/' . $type);
        $can_manage = Orm_User::check_credential(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY
        ), false, 'accreditation-manage');

        if (!(Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) && $can_manage)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $this->layout->add_javascript('/assets/jadeer/js/jstree/jstree.min.js');
        $this->layout->add_stylesheet('/assets/jadeer/js/jstree/themes/proton/style.min.css');

        $this->view_params['menu_tab'] = 'integrate_ams';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Accreditation') . ' - ' . lang('Push to AIMS'),
            'icon' => 'fa fa-archive'
        ), true);

        if (!in_array($type, array('institutional', 'programmatic'))) {
            $type = 'institutional';
        }

        $comment = '';
        $submission_type = 'programmatic';
        $integrate_forms = array();

        $log_id = $this->input->get('log_id');
        $log = Orm_Ams_Log::get_instance($log_id);
        if ($log->get_id()) {

            $comment = $log->get_comment();
            $integrate_forms = $log->get_forms();
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $forms = $this->input->post('forms');
            $submission_type = $this->input->post('submission_type');
            $comment = $this->input->post('comment');

            if (!is_array($forms)) {
                $forms = array();
            }

            Validator::required_field_validator('comment', $comment, lang('Please Enter a Comment.'));
            Validator::required_array_validator('forms', $forms, lang('Please Select at Least one Form.'));

            if ($type == 'programmatic' && !in_array($submission_type, array('institutional', 'programmatic'))) {
                Validator::set_error('submission_type', lang('Please select a valid type'));
            }

            if ($forms) {
                $valid_forms = array();
                $valid_forms[] = Orm_Node::FORM_CS;
                $valid_forms[] = Orm_Node::FORM_CR;
                $valid_forms[] = Orm_Node::FORM_FS;
                $valid_forms[] = Orm_Node::FORM_FR;
                $valid_forms[] = Orm_Node::FORM_PS;
                $valid_forms[] = Orm_Node::FORM_PR;

                if ($type == 'institutional') {
                    $valid_forms[] = Orm_Node::FORM_P_I;
                    $valid_forms[] = Orm_Node::FORM_ER_I;
                    $valid_forms[] = Orm_Node::FORM_PA_I;
                    $valid_forms[] = Orm_Node::FORM_SES_I;
                    $valid_forms[] = Orm_Node::FORM_SSR_I;
                } else {
                    $valid_forms[] = Orm_Node::FORM_PP_P;
                    $valid_forms[] = Orm_Node::FORM_ER_P;
                    $valid_forms[] = Orm_Node::FORM_PA_P;
                    $valid_forms[] = Orm_Node::FORM_SES_P;
                    $valid_forms[] = Orm_Node::FORM_SSR_P;
                }

                foreach ($forms as $form_key) {

                    if (strpos(strtolower($form_key), 'course-') === 0) {
                        $form_keys = explode('-', $form_key);
                        $form_id = end($form_keys);
                    } else {
                        $form_id = $form_key;
                    }

                    $form = Orm_Node::get_instance($form_id);

                    if (in_array(get_class($form), $valid_forms)) {
                        $integrate_forms[$form_key] = $form_key;
                    }
                }
            }

            if (Validator::success()) {
                $ams_log = new Orm_Ams_Log();

                $ams_log->set_comment($comment);
                $ams_log->set_forms($integrate_forms);
                $ams_log->set_type($type == 'institutional' ? $type : $submission_type);
                $ams_log->save();

                $cron_job = new Orm_Cron_Job();
                $cron_job->set_job('integrate_ams');
                $cron_job->save();

                Validator::set_success_flash_message(lang('Your Reintegration request is under Progress, you will be Emailed when the Integration Finishes (within 48 Hours)'));
                json_response(array('status' => true));
            }

        }

        $this->view_params['type'] = $type;
        $this->view_params['integrate_forms'] = $integrate_forms;
        $this->view_params['submission_type'] = $submission_type;
        $this->view_params['comment'] = $comment;

        if ($this->input->is_ajax_request()) {
            json_response(array('status' => false, 'html' => $this->load->view("accreditation/integrate/{$type}", $this->view_params, true)));
        } else {
            $this->layout->view("accreditation/integrate/{$type}", $this->view_params);
        }
    }

    public function share($id)
    {
        $this->init();

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if (!$obj->check_if_user_can_access_node()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if ($obj->check_if_is_finished()) {
            Validator::set_error_flash_message(lang("Error: Please make sure you are Finished all Sub-Form"));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $obj->save_as_shared();

        Validator::set_success_flash_message(lang('Successfully Shared'));
        redirect($this->input->server('HTTP_REFERER'));
    }


    public function add_missed_sections($id)
    {
        $this->init();

        $class_name = 'Node\ncacm14\Sections';

        $obj = Orm_Node::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if (!$obj->check_if_can_manage()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }


        if( $class_name == $obj->get_class_type() && $obj->get_id() == $id ){
            $section =  $class_name::get_instance($obj->get_id());
            $section->get_children_nodes();
        }else{

            $sections = new $class_name();
            $sections->set_parent_id($obj->get_id());
            $sections->set_year($obj->get_year());
            $sections->set_system_number($obj->get_system_number());
            $sections->generate();
        }

        $obj->build_parent_tree();

        Validator::set_success_flash_message(lang('Sections was added successfully'));
        redirect($this->input->server('HTTP_REFERER'));
    }

}
