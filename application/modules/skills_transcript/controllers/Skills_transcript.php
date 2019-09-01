<?php

defined('BASEPATH') OR exit('No direct script access allowed');
define('MODULES_ONLY', true);

/**
 * Description of Skills Transcript
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author Laith
 */
Class Skills_Transcript extends MX_Controller
{

    private $view_params = array();

    /**
     * Skills_Transcript constructor.
     */
    public function __construct()
    {
        parent::__construct();


        $this->logged_user = Orm_User::get_logged_user();

        if (!License::get_instance()->check_module('skills_transcript', true)) {
            show_404();
        }

        Modules::load('rubrics');

        if (!License::get_instance()->check_module('rubrics', true)) {
            show_404();
        }


        Orm_User::check_logged_in();
        $this->view_params['menu_tab'] = 'skills_transcript';

        $this->breadcrumbs->push(lang('Skills Transcript'), '/skills_transcript');

    }

    /**
     *this function get list
     * @return string the calling function
     */
    private function get_list()
    {

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        $fltr = $this->input->get_post('fltr');
        $filters = [];

        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['program_id'])) {
            $filters['program_id'] = (int)$fltr['program_id'];
        }
        if (!empty($fltr['in_user_id'])) {
            $filters['in_user_id'] = (int)$fltr['in_user_id'];
        }
        if ($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
            $filters['college_id'] = Orm_User::get_logged_user()->get_college_id();
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['program_id'] = Orm_User::get_logged_user()->get_program_id();

        }
        if ($this->logged_user->get_role_obj()->get_admin_level() === Orm_Role::ROLE_NOT_ADMIN) {
            $filters['program_id'] = Orm_User::get_logged_user()->get_program_id();
        }
        if (Orm_User::has_role_teacher() && Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['college_id'] = $this->logged_user->get_college_id();
            $filters['program_id'] = $this->logged_user->get_program_id();
        }

        if (!$page) {
            $page = 0;
        }

        $filters['page'] = $page - 1 < 0 ? 0 : $page - 1;

        $filters['semester_id'] = Orm_Semester::get_active_semester_id();

        $user_program = Orm_User_Student::get_all();
        $users = [];

        foreach ($user_program as $one_user) {
            array_push($users, $one_user->get_user_id());
        }
        $results = Orm_Rb_Result::get_all_group_by_user_id($filters);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Rb_Result::get_all_group_by_user_id_count($filters));

        $this->view_params['students'] = $results;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;

    }

    /**
     * this function index
     * @return string the html view
     */
    public function index()
    {
        $header = array(
            'title' => lang('Skills Transcript'),
            'icon' => 'fa fa-leaf'
        );
        $this->view_params['page_header'] = $this->load->view('/common/page_header', $header, true);
        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Student::class) {

            $user_id = Orm_User::get_logged_user()->get_user_id();
            $rbSkills = Orm_Rb_Result::get_all(['user_id' => $user_id]);

            $this->view_params['rbSkills'] = $rbSkills;
            $this->view_params['user_id'] = $user_id;
            $this->layout->view('details', $this->view_params);
        } else {


            $this->get_list();

            $this->layout->view('list', $this->view_params);
        }

    }

    /**
     * this function filter
     * @return string the html view
     */
    public function filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_list();

            $this->load->view('data_table', $this->view_params);

        } else {
            $this->index();
        }
    }

    /**
     * this function details by its  user id
     * @param int $user_id the user id of the details to be viewed
     * @return string the html view
     */
    public function details($user_id = 0)
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Skills Transcript'),
            'icon' => 'fa fa-leaf',
            'link_attr' => ' href="/skills_transcript/pdf/' . $user_id . '"',
            'link_title' => lang('Download PDF'),
            'menu_params' => array('type' => 'view')
        ), true);


        if (!License::get_instance()->check_module('rubrics', true)) {
            show_404();
        }
        Modules::load('rubrics');
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }
        $rbSkills = Orm_Rb_Result::get_all(['user_id' => $user_id]);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Rb_Result::get_count(['user_id' => $user_id]));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['rbSkills'] = $rbSkills;
        $this->view_params['user_id'] = $user_id;

        $this->layout->view('details', $this->view_params);
    }

    /**
     *this function pdf by its  user id
     * @param int $user_id the user id of the pdf to be viewed
     * @return string pdf the calling function
     */
    public function pdf($user_id = 0)
    {

        if (!License::get_instance()->check_module('rubrics', true)) {
            show_404();
        }
        Modules::load('rubrics');

        Orm_Rb_Result::generate_pdf($user_id);

    }


}