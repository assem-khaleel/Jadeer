<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Portfolio Course
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author ADwairi
 * @author Hamzah
 * @author Laith
 */
class Portfolio_Course extends MX_Controller {

    private $view_params = array();

    /**
     * Portfolio_Course constructor.
     */
    public function __construct() {
        parent::__construct();

        if(!License::get_instance()->check_module('portfolio_course', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->breadcrumbs->push(lang('Portfolio Course'), '/portfolio_course');

        //
        //menu_tab
        //
        $this->view_params['menu_tab'] = 'portfolio_course';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Portfolio Course'),
            'icon' => 'fa fa-briefcase'
        ), true);

        $this->view_params['category'] = 'general';
    }

    /**
     * this function get list
     * @return string the call function
     */
    private function get_list()
    {

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        Orm_User::get_logged_user()->get_filters($fltr);

        $filters = array();

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if (Orm_User::has_role_teacher() && Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['in_id'] = Orm_Course_Section_Teacher::get_course_ids();
        } elseif (Orm_User::get_logged_user()->get_class_type() == Orm_User_Student::class) {
            $filters['in_id'] = Orm_Course_Section_Student::get_course_ids();
        } else {
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

    /**
     *this function index
     * @return string the html view
     */
     public function index()
    {
       $this->get_list();
        $this->layout->view('index', $this->view_params);
    }

    /**
     *this function filter
     * @return string the html view
     */
    public function filter(){
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('course_list', $this->view_params);
        } else {
            $this->index();
        }
    }

}
