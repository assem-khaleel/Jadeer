<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 1/4/16
 * Time: 7:42 PM
 */

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Reporting
 */
class Reporting extends MX_Controller {
    /**
     * @var $view_params array => the array pf data that will send to views
     */
    private $view_params;

    /**
     * Reporting constructor.
     */
    public function __construct() {
        parent::__construct();

        Orm_User::check_logged_in();
        if(!License::get_instance()->check_module('curriculum_mapping', true)) {
            show_404();
        }

        $this->breadcrumbs->push(lang('Curriculum Mapping'), '/curriculum_mapping');
        $this->breadcrumbs->push(lang('Reporting'), '/curriculum_mapping/reporting');
        $this->layout->add_javascript('https://www.google.com/jsapi', false);

        $this->view_params['menu_tab'] = 'curriculum_mapping';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Reporting'),
            'icon' => 'fa fa-book',
            'menu_view' => 'curriculum_mapping/sub_menu',
            'menu_params' => array('type' => 'reporting')
        ), true);
    }

    /**
     *  show the static main page that contain the report menu
     */
    public function index() {

        $this->layout->view('reporting/management', $this->view_params);
    }

    /**
     * collect and prepare data for courses
     * @param $course_id
     * @param $section_id
     */
    private function get_course_list($course_id, $section_id){
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        Orm_User::get_logged_user()->get_filters($fltr);

        $this->view_params['fltr'] = $fltr;

        Orm_User::get_logged_user()->get_filters($fltr);

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
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
        $this->view_params['course_id'] = $course_id;
        $this->view_params['section_id'] = $section_id;
    }

    /**
     * get all data that we needs depends on the following parameters:
     * @param int $course_id =>course id
     * @param int $section_id => section id
     */
    public function course_assessment_rubric($course_id = 0, $section_id = 0) {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Course Assessment Rubric'),
            'icon' => 'fa fa-book'
        ), true);

        $this->get_course_list($course_id,$section_id);

        $this->layout->view('reporting/assessment_rubric',$this->view_params);
    }

    /**
     * filter will get a specific view for user when use the filter block will refresh the main view with the new data
     * if not will redirect for the page with the origin view
     * @param int $course_id
     * @param int $section_id
     */
    public function course_filter($course_id = 0, $section_id = 0){
        if ($this->input->is_ajax_request()) {
            $this->get_course_list($course_id,$section_id);
            $this->load->view('reporting/course_data_table',$this->view_params);
        } else {
            $this->course_assessment_rubric($course_id, $section_id);
        }

    }

    /**
     * prepare data for set in image or pdf depends on the following parameters:
     * @param string $mode => pdf or image
     * @param int $course_id
     * @param int $section_id
     * @param int $student_id
     */
    public function report($mode = 'pdf', $course_id = 0, $section_id = 0, $student_id = 0) {

        $this->view_params['course_id'] = $course_id;
        $this->view_params['section_id'] = $section_id;
        $this->view_params['student_id'] = $student_id;
        if ($mode == 'img') {
            Orm_Cm_Assessment_Rubric::generate_image($this->view_params);
        } else {
            Orm_Cm_Assessment_Rubric::generate_pdf($this->view_params);
        }
    }

    /**
     *  collect and prepare data for student
     * @param $course_id
     * @param $section_id
     * @param $student_id
     */
    private function get_student_list($course_id, $section_id, $student_id){
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        Orm_User::get_logged_user()->get_filters($fltr);

        $this->view_params['fltr'] = $fltr;

        Orm_User::get_logged_user()->get_filters($fltr);

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
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
        $this->view_params['course_id'] = $course_id;
        $this->view_params['section_id'] = $section_id;
        $this->view_params['student_id'] = $student_id;
    }

    /**
     *  get all data that we needs depends on the following parameters:
     * @param int $course_id =>course id
     * @param int $section_id => section id
     * @param int $student_id =>student that take the course
     */
    public function student_assessment_rubric($course_id = 0, $section_id = 0, $student_id = 0) {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Student Assessment Rubric'),
            'icon' => 'fa fa-book'
        ), true);

        $this->get_student_list($course_id, $section_id, $student_id );

        $this->layout->view('reporting/student_assessment_rubric',$this->view_params);
    }

    /**
     * filter will get a specific view for user when use the filter block will refresh the main view with the new data
     * if not will redirect for the page with the origin view
     * @param int $course_id
     * @param int $section_id
     * @param int $student_id
     */
    public function student_filter($course_id = 0, $section_id = 0, $student_id = 0){
        if ($this->input->is_ajax_request()) {
            $this->get_student_list($course_id, $section_id, $student_id);
            $this->load->view('reporting/student_data_table', $this->view_params);
        } else {
            $this->student_assessment_rubric($course_id, $section_id, $student_id);
        }
    }

    /**
     * get the results of all learning outcomes associate with the following parameters:
     * @param $course_id => course id
     * @param $section_id => course section id
     * @param $domain_id => learning domain id
     * @param int $student_id =>student that take the course
     */
    public function clo_results($course_id, $section_id, $domain_id, $student_id = 0) {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }


        $results = array();
        foreach (Orm_Cm_Course_Learning_Outcome::get_all(array('learning_domain_id' => $domain_id, 'course_id' => $course_id)) as $outcome) {
            $results[$outcome->get_id()] = array('outcome' => $outcome->get_text(), 'score' => Orm_Cm_Section_Student_Assessment::get_course_assessment_method_score($course_id,0,$domain_id, $outcome->get_id(), $section_id, $student_id));
        }

        $this->view_params['result'] = $results;
        $this->view_params['domain'] = Orm_Cm_Learning_Domain::get_instance($domain_id);

        $this->load->view('reporting/rubric_clo', $this->view_params);
    }

    /**
     * collect the data for learning outcomes on charts
     */
    public function outcomes()
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Dashboard'),
            'icon' => 'fa fa-book'
        ), true);

        if ($this->input->is_ajax_request()) {

            $type = $this->input->get_post('type');
            $domain_id = $this->input->get('domain_id');

            $this->view_params['domain_id'] = $domain_id;

            if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_NOT_ADMIN) {
                $this->view_params['teacher_id'] = (int) Orm_User::get_logged_user()->get_id();
            }

            switch ($type) {
                case 'colleges':
                    $this->view_params['colleges'] = Orm_Cm_Section_Student_Assessment::get_level_learning_domain_score($domain_id);
                    $this->view_params['outcomes'] = Orm_Cm_Section_Student_Assessment::get_outcomes_score($domain_id);
                    $this->load->view('curriculum_mapping/reporting/dashboard/learning_outcomes/colleges', $this->view_params);
                    break;

                case 'programs':
                    $college_id = $this->input->get('college_id');
                    $this->view_params['college_id'] = $college_id;
                    $this->view_params['programs'] = Orm_Cm_Section_Student_Assessment::get_level_learning_domain_score($domain_id, $college_id);
                    $this->view_params['outcomes'] = Orm_Cm_Section_Student_Assessment::get_outcomes_score($domain_id, $college_id);
                    $this->load->view('curriculum_mapping/reporting/dashboard/learning_outcomes/programs', $this->view_params);
                    break;

                case 'courses':
                    $program_id = $this->input->get('program_id');
                    $this->view_params['program_id'] = $program_id;
                    $this->view_params['courses'] = Orm_Cm_Section_Student_Assessment::get_level_learning_domain_score($domain_id, null, $program_id);
                    $this->view_params['outcomes'] = Orm_Cm_Section_Student_Assessment::get_outcomes_score($domain_id, null, $program_id);
                    $this->load->view('curriculum_mapping/reporting/dashboard/learning_outcomes/courses', $this->view_params);
                    break;

                case 'sections':
                    $course_id = $this->input->get('course_id');
                    $target = $this->input->get('target');
                    $this->view_params['overall_target'] = $target;
                    $this->view_params['course_id'] = $course_id;
                    $this->view_params['sections'] = Orm_Cm_Section_Student_Assessment::get_level_learning_domain_score($domain_id, null, null, $course_id);
                    $this->view_params['outcomes'] = Orm_Cm_Section_Student_Assessment::get_outcomes_score($domain_id, null, null, $course_id);
                    $this->load->view('curriculum_mapping/reporting/dashboard/learning_outcomes/sections', $this->view_params);
                    break;

                case 'students':
                    $section_id = $this->input->get('section_id');
                    $target = $this->input->get('target');
                    $this->view_params['overall_target'] = $target;
                    $this->view_params['students'] = Orm_Cm_Section_Student_Assessment::get_level_learning_domain_score($domain_id, null, null, null, $section_id);
                    $this->view_params['outcomes'] = Orm_Cm_Section_Student_Assessment::get_outcomes_score($domain_id, null, null, null, $section_id);
                    $this->view_params['section_id'] = $section_id;
                    $this->load->view('curriculum_mapping/reporting/dashboard/learning_outcomes/students', $this->view_params);
                    break;
                case 'student':
                    $student_id = $this->input->get('student_id');
                    $section_id = $this->input->get('section_id');
                    $this->view_params['section_id'] = $section_id;
                    $this->view_params['student_id'] = $student_id;
                    $this->view_params['outcomes'] = Orm_Cm_Section_Student_Assessment::get_outcomes_score($domain_id, null, null, null, $section_id, $student_id);
                    $this->load->view('curriculum_mapping/reporting/dashboard/learning_outcomes/student', $this->view_params);
                    break;
            }

        } else {
            switch (Orm_User::get_logged_user()->get_role_obj()->get_admin_level()) {
                case Orm_Role::ROLE_INSTITUTION_ADMIN:
                    $this->view_params['domains'] = Orm_Cm_Section_Student_Assessment::get_learning_domain_score();
                    $this->layout->view('curriculum_mapping/reporting/dashboard/learning_outcomes/institution', $this->view_params);
                    break;
                case Orm_Role::ROLE_COLLEGE_ADMIN:
                    $this->view_params['domains'] = Orm_Cm_Section_Student_Assessment::get_learning_domain_score(Orm_User::get_logged_user()->get_college_id());
                    $this->layout->view('curriculum_mapping/reporting/dashboard/learning_outcomes/college', $this->view_params);
                    break;
                case Orm_Role::ROLE_PROGRAM_ADMIN:
                    $this->view_params['domains'] = Orm_Cm_Section_Student_Assessment::get_learning_domain_score(null,Orm_User::get_logged_user()->get_program_id());
                    $this->layout->view('curriculum_mapping/reporting/dashboard/learning_outcomes/program', $this->view_params);
                    break;
                default:
                    $course_id = $this->input->get('course_id');
                    $section_id = $this->input->get('section_id');
                    $this->view_params['course_id'] = $course_id;
                    $this->view_params['section_id'] = $section_id;
                    if ($course_id && $section_id) {
                        $this->view_params['domains'] = Orm_Cm_Section_Student_Assessment::get_learning_domain_score(null,null,$course_id, $section_id);
                    } else {
                        $this->view_params['domains'] = array();
                    }
                    $this->layout->view('curriculum_mapping/reporting/dashboard/learning_outcomes/faculty', $this->view_params);
                    break;

            }
        }
    }

    /**
     * collect the data for assessment methods on charts
     */
    public function assessment_methods()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Dashboard'),
            'icon' => 'fa fa-book'
        ), true);

        if ($this->input->is_ajax_request()) {

            $type = $this->input->get_post('type');
            $method_id = $this->input->get('method_id');

            $this->view_params['method_id'] = $method_id;

            if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_NOT_ADMIN) {
                $this->view_params['teacher_id'] = (int) Orm_User::get_logged_user()->get_id();
            }

            switch ($type) {
                case 'colleges':
                    $this->view_params['colleges'] = Orm_Cm_Section_Student_Assessment::get_level_assessment_method_score($method_id);
                    $this->load->view('curriculum_mapping/reporting/dashboard/assessment_method/colleges', $this->view_params);
                    break;

                case 'programs':
                    $college_id = $this->input->get('college_id');
                    $this->view_params['programs'] = Orm_Cm_Section_Student_Assessment::get_level_assessment_method_score($method_id, $college_id);
                    $this->load->view('curriculum_mapping/reporting/dashboard/assessment_method/programs', $this->view_params);
                    break;

                case 'courses':
                    $program_id = $this->input->get('program_id');
                    $this->view_params['courses'] = Orm_Cm_Section_Student_Assessment::get_level_assessment_method_score($method_id, null, $program_id);
                    $this->load->view('curriculum_mapping/reporting/dashboard/assessment_method/courses', $this->view_params);
                    break;

                case 'sections':
                    $course_id = $this->input->get('course_id');
                    $this->view_params['sections'] = Orm_Cm_Section_Student_Assessment::get_level_assessment_method_score($method_id, null, null, $course_id);
                    $this->load->view('curriculum_mapping/reporting/dashboard/assessment_method/sections', $this->view_params);
                    break;

                case 'students':
                    $section_id = $this->input->get('section_id');
                    $this->view_params['students'] = Orm_Cm_Section_Student_Assessment::get_level_assessment_method_score($method_id, null, null, null, $section_id);
                    $this->view_params['section_id'] = $section_id;
                    $this->load->view('curriculum_mapping/reporting/dashboard/assessment_method/students', $this->view_params);
                    break;
                case 'student':
                    $student_id = $this->input->get('student_id');
                    $section_id = $this->input->get('section_id');
                    $this->view_params['section_id'] = $section_id;
                    $this->view_params['outcomes'] = Orm_Cm_Section_Student_Assessment::get_outcomes_score($method_id, null, null, null, $section_id, $student_id);
                    $this->load->view('curriculum_mapping/reporting/dashboard/assessment_method/student', $this->view_params);
                    break;
            }

        } else {
            switch (Orm_User::get_logged_user()->get_role_obj()->get_admin_level()) {
                case Orm_Role::ROLE_INSTITUTION_ADMIN:
                    $this->view_params['methods'] = Orm_Cm_Section_Student_Assessment::get_assessment_method_score();
                    $this->layout->view('curriculum_mapping/reporting/dashboard/assessment_method/institution', $this->view_params);
                    break;
                case Orm_Role::ROLE_COLLEGE_ADMIN:
                    $this->view_params['methods'] = Orm_Cm_Section_Student_Assessment::get_assessment_method_score(Orm_User::get_logged_user()->get_college_id());
                    $this->layout->view('curriculum_mapping/reporting/dashboard/assessment_method/college', $this->view_params);
                    break;
                case Orm_Role::ROLE_PROGRAM_ADMIN:
                    $this->view_params['methods'] = Orm_Cm_Section_Student_Assessment::get_assessment_method_score(null,Orm_User::get_logged_user()->get_program_id());
                    $this->layout->view('curriculum_mapping/reporting/dashboard/assessment_method/program', $this->view_params);
                    break;
                default:
                    $course_id = $this->input->get('course_id');
                    $section_id = $this->input->get('section_id');
                    $this->view_params['course_id'] = $course_id;
                    $this->view_params['section_id'] = $section_id;
                    if ($course_id && $section_id) {
                        $this->view_params['methods'] = Orm_Cm_Section_Student_Assessment::get_assessment_method_score(null,null,$course_id, $section_id);
                    } else {
                        $this->view_params['methods'] = array();
                    }
                    $this->layout->view('curriculum_mapping/reporting/dashboard/assessment_method/faculty', $this->view_params);
                    break;
            }
        }
    }

    /**
     * collect the data depends ot the type to put in charts
     */
    public function qualitative() {

        if (License::get_instance()->check_module('survey')) {
            Modules::load('survey');
        } else {
            redirect('/curriculum_mapping/reporting');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Dashboard'),
            'icon' => 'fa fa-book'
        ), true);

        if ($this->input->is_ajax_request()) {

            $type = $this->input->get_post('type');

            if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_NOT_ADMIN) {
                $this->view_params['teacher_id'] = (int) Orm_User::get_logged_user()->get_id();
            }

            switch ($type) {
                case 'programs':
                    $college_id = $this->input->get('college_id');
                    $this->view_params['college_id'] = $college_id;
                    $this->load->view('curriculum_mapping/reporting/qualitative_dashboard/programs', $this->view_params);
                    break;

                case 'courses':
                    $program_id = $this->input->get('program_id');
                    $this->view_params['program_id'] = $program_id;
                    $this->load->view('curriculum_mapping/reporting/qualitative_dashboard/courses', $this->view_params);
                    break;

                case 'sections':
                    $course_id = $this->input->get('course_id');
                    $this->view_params['course_id'] = $course_id;
                    $this->load->view('curriculum_mapping/reporting/qualitative_dashboard/sections', $this->view_params);
                    break;

                case 'section':
                    $section_id = $this->input->get('section_id');
                    $this->view_params['section_id'] = $section_id;
                    $this->load->view('curriculum_mapping/reporting/qualitative_dashboard/section', $this->view_params);
                    break;

                case 'clo':
                    $clo_id = $this->input->get('id');
                    $section_id = $this->input->get('section_id');

                    $this->view_params['clo_id'] = $clo_id;
                    $this->view_params['section_id'] = $section_id;
                    $this->load->view('curriculum_mapping/reporting/qualitative_dashboard/clo', $this->view_params);
                    break;

                case 'plo':
                    $plo_id = $this->input->get('id');
                    $this->view_params['plo_id'] = $plo_id;
                    $this->load->view('curriculum_mapping/reporting/qualitative_dashboard/plo', $this->view_params);
                    break;
            }

        } else {
            switch (Orm_User::get_logged_user()->get_role_obj()->get_admin_level()) {
                case Orm_Role::ROLE_INSTITUTION_ADMIN:
                    $this->layout->view('curriculum_mapping/reporting/qualitative_dashboard/institution', $this->view_params);
                    break;
                case Orm_Role::ROLE_COLLEGE_ADMIN:
                    $this->layout->view('curriculum_mapping/reporting/qualitative_dashboard/college', $this->view_params);
                    break;
                case Orm_Role::ROLE_PROGRAM_ADMIN:
                    $this->layout->view('curriculum_mapping/reporting/qualitative_dashboard/program', $this->view_params);
                    break;
                default:
                    $course_id = $this->input->get('course_id');
                    $section_id = $this->input->get('section_id');
                    $this->view_params['course_id'] = $course_id;
                    $this->view_params['section_id'] = $section_id;
                    $this->layout->view('curriculum_mapping/reporting/qualitative_dashboard/faculty', $this->view_params);
                    break;

            }
        }
    }
}