<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of examination_bank
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author ADwairi
 * @author Hamzah
 * @author Laith
 */
class Examination_bank extends MX_Controller
{
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('examination', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-list');

        $this->breadcrumbs->push(lang('Examination'), '/examination');
        $this->breadcrumbs->push(lang('Examination Bank'), '/examination/examination_bank');

        $this->view_params['menu_tab'] = 'examination';
        $this->view_params['type'] = 'exam_bank';
    }

    /** get all courses related to exam bank
     * render them in list view
    */
    public function index()
    {

        $fltr = $this->input->get_post('fltr');
        $user = Orm_User::get_logged_user();
        $filters = $fltr;

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $page_header_arr = [
            'title' => lang('Examination Bank'),
            'icon' => 'fa fa-file-text-o',
            'menu_view' => 'examination/sub_menu',
            'type' => 'exam_bank'
        ];


        if($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){
            $filters['college_id'] = $user->get_college_id();

        }

        if($user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)){
            $filters['college_id'] = $user->get_college_id();
            $filters['program_id'] = $user->get_program_id();

        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header_arr, true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course::get_count($filters));


        $total_page = intval($pager->get_total_count() / $pager->get_per_page());
        $total_page += $pager->get_total_count() % $pager->get_per_page() ? 1 : 0;

        if ($total_page < $page) {
            $page = 1;
        }

        $page = $page ?: 1;
        $pager->set_page($page);

        $courses = Orm_Course::get_all($filters, $page, $per_page);


        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['courses'] = $courses;
        $this->layout->view('exam_bank/list', $this->view_params);
    }

    /** render index as ajax request and get all courses
     * render it in ajax_list view
     *
    */
    public function ajax_list()
    {

        $fltr = $this->input->get_post('fltr');

        $filters = $fltr;

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course::get_count($filters));


        $total_page = intval($pager->get_total_count() / $pager->get_per_page());
        $total_page += $pager->get_total_count() % $pager->get_per_page() ? 1 : 0;

        if ($total_page < $page) {
            $page = 1;
        }

        $page = $page ?: 1;
        $pager->set_page($page);

        // Added by shamaseen : program_plan is needed in the model, idk why !
        $filters['program_plan'] = true;

        $courses = Orm_Course::get_all($filters, $page, $per_page);

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['courses'] = $courses;
        $this->load->view('exam_bank/ajax_list', $this->view_params);
    }

    /** get all exams after validation
     * render them exam_list view
    */
    public function exams($course_id = 0)
    {

        $course = Orm_Course::get_instance($course_id);

        if (!($course && $course->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->breadcrumbs->push(htmlfilter($course->get_name()), '/examination/examination_bank/exams');

        $fltr = $this->input->get_post('fltr');

        $filters = array();

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $page_header_arr = [
            'title' => lang('Exam') . ": " . htmlfilter($course->get_name()),
            'icon' => 'fa fa-file-text-o',
            'menu_view' => 'examination/sub_menu',
            'type' => 'exam_bank'
        ];

        $filters['course_id'] = $course_id;

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header_arr, true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');


        $filters['type'] = Orm_Tst_Exam::TYPE_EXAM;

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Tst_Exam::get_count($filters));

        $total_page = intval($pager->get_total_count() / $pager->get_per_page());
        $total_page += $pager->get_total_count() % $pager->get_per_page() ? 1 : 0;

        if ($total_page < $page) {
            $page = 1;
        }

        $page = $page ?: 1;
        $pager->set_page($page);

        $exams = Orm_Tst_Exam::get_all($filters, $page, $per_page, ['start desc']);


        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['course_id'] = $course_id;
        $this->view_params['exams'] = $exams;
        $this->layout->view('exam_bank/exams_list', $this->view_params);
    }
}