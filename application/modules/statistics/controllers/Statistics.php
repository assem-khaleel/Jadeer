<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/17/16
 * Time: 1:38 PM
 */

/**
 * @property CI_Config $config
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * Class Statistics
 */
class Statistics extends MX_Controller
{
    /**
     * View Params
     * @var array => the array pf data that will send to views
     */

    private $view_params = array();

    /**
     * Statistics constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('statistics', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'accreditation-statistics');

        Modules::load('accreditation');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Statistics'),
            'icon' => 'fa fa-calculator'
        ), true);
        $this->view_params['menu_tab'] = 'statistics';

        $this->breadcrumbs->push(lang('Statistics'), '/statistics');
    }

    /**
     * show all statistics Table that are important for University
     */
    public function index()
    {
        $this->layout->view('list', $this->view_params);
    }

    /**
     * Completion Rate Report to get data for it and if parameter is send then will show the pdf version of table
     * @param bool $pdf
     */
    public function completion_rate($pdf = false)
    {
        if (!is_bool($pdf) && $pdf != 1) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Statistics') . ' - ' . lang('Completion Rate'),
            'icon' => 'fa fa-calculator'
        ), true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (isset($fltr['academic_year']) && $fltr['academic_year'] != '') {
            $filters['academic_year'] = $fltr['academic_year'];
        }
        if (isset($fltr['college_id']) && $fltr['college_id'] != '') {
            $filters['college_id'] = $fltr['college_id'];
        }
        if (isset($fltr['program_id']) && $fltr['program_id'] != '') {
            $filters['program_id'] = $fltr['program_id'];
        }
        if (isset($fltr['gender']) && $fltr['gender'] != '') {
            $filters['gender'] = $fltr['gender'];
        }

        if ($pdf) {
            $report = new Orm_Report();

            $items = Orm_Data_Competion_Rate::get_all($filters);

            $this->view_params['pager'] = '';
            $this->view_params['items'] = $items;
            $this->view_params['pdf'] = $pdf;

            $html = $this->load->view('completion_rate', $this->view_params, true);

            $report->generate_pdf('Statistics - Completion Rate', $html);
        } else {
            $items = Orm_Data_Competion_Rate::get_all($filters, $page, $per_page);

            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_Data_Competion_Rate::get_count($filters));

            $this->view_params['pager'] = $pager->render(true);
            $this->view_params['items'] = $items;
            $this->view_params['fltr'] = $filters;

            $this->layout->view('completion_rate', $this->view_params);
        }
    }

    /**
     * 	Course Grades to get data for it, if parameter sed as true then the pdf version for this table will shown
     * @param bool $pdf
     */
    public function course_grade($pdf = false)
    {

        if (!is_bool($pdf) && $pdf != 1) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Statistics') . ' - ' . lang('Course Grades'),
            'icon' => 'fa fa-calculator'
        ), true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (isset($fltr['semester_id']) && $fltr['semester_id'] != '') {
            $filters['semester_id'] = $fltr['semester_id'];
        }
        if (isset($fltr['college_id']) && $fltr['college_id'] != '') {
            $filters['college_id'] = $fltr['college_id'];
        }
        if (isset($fltr['program_id']) && $fltr['program_id'] != '') {
            $filters['program_id'] = $fltr['program_id'];
        }
        if (isset($fltr['course_id']) && $fltr['course_id']) {
            $filters['course_id'] = $fltr['course_id'];
        }
        if (isset($fltr['section_id']) && $fltr['section_id']) {
            $filters['section_id'] = $fltr['section_id'];
        }

        if ($pdf) {
            $report = new Orm_Report();

            $items = Orm_Data_Course_Grade::get_all($filters);

            $this->view_params['pager'] = '';
            $this->view_params['items'] = $items;
            $this->view_params['pdf'] = $pdf;

            $html = $this->load->view('course_grade', $this->view_params, true);

            $report->generate_pdf('Statistics - Course Grades', $html);
        } else {
            $items = Orm_Data_Course_Grade::get_all($filters, $page, $per_page);
            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_Data_Course_Grade::get_count($filters));

            $this->view_params['pager'] = $pager->render(true);
            $this->view_params['items'] = $items;
            $this->view_params['fltr'] = $filters;

            $this->layout->view('course_grade', $this->view_params);
        }
    }

    /**
     * Course Statuses table and the data that will appear on< if parameter send as true then the pdf verion will appear for the table
     * @param bool $pdf
     */
    public function course_status($pdf = false)
    {

        if (!is_bool($pdf) && $pdf != 1) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Statistics') . ' - ' . lang('Course Status'),
            'icon' => 'fa fa-calculator'
        ), true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (isset($fltr['semester_id']) && $fltr['semester_id'] != '') {
            $filters['semester_id'] = $fltr['semester_id'];
        }
        if (isset($fltr['college_id']) && $fltr['college_id'] != '') {
            $filters['college_id'] = $fltr['college_id'];
        }
        if (isset($fltr['program_id']) && $fltr['program_id'] != '') {
            $filters['program_id'] = $fltr['program_id'];
        }
        if (isset($fltr['course_id']) && $fltr['course_id']) {
            $filters['course_id'] = $fltr['course_id'];
        }
        if (isset($fltr['section_id']) && $fltr['section_id']) {
            $filters['section_id'] = $fltr['section_id'];
        }

        if ($pdf) {
            $report = new Orm_Report();

            $items = Orm_Data_Course_Status::get_all($filters);

            $this->view_params['pager'] = '';
            $this->view_params['items'] = $items;
            $this->view_params['pdf'] = $pdf;

            $html = $this->load->view('course_status', $this->view_params, true);

            $report->generate_pdf('Statistics - Course Status', $html);
        } else {
            $items = Orm_Data_Course_Status::get_all($filters, $page, $per_page);

            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_Data_Course_Status::get_count($filters));

            $this->view_params['pager'] = $pager->render(true);
            $this->view_params['items'] = $items;
            $this->view_params['fltr'] = $filters;

            $this->layout->view('course_status', $this->view_params);
        }
    }

    /**
     * Course Completion Rate table and the data that will appear on< if the paremeter $pdf send as true then we will get the pdf version for it
     * @param bool $pdf
     */
    public function course_students($pdf = false)
    {

        if (!is_bool($pdf) && $pdf != 1) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Statistics') . ' - ' . lang('Course Completion Rate'),
            'icon' => 'fa fa-calculator'
        ), true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (isset($fltr['semester_id']) && $fltr['semester_id'] != '') {
            $filters['semester_id'] = $fltr['semester_id'];
        }
        if (isset($fltr['college_id']) && $fltr['college_id'] != '') {
            $filters['college_id'] = $fltr['college_id'];
        }
        if (isset($fltr['program_id']) && $fltr['program_id'] != '') {
            $filters['program_id'] = $fltr['program_id'];
        }
        if (isset($fltr['course_id']) && $fltr['course_id']) {
            $filters['course_id'] = $fltr['course_id'];
        }
        if (isset($fltr['section_id']) && $fltr['section_id']) {
            $filters['section_id'] = $fltr['section_id'];
        }

        if ($pdf) {
            $report = new Orm_Report();

            $items = Orm_Data_Course_Students::get_all($filters);

            $this->view_params['pager'] = '';
            $this->view_params['items'] = $items;
            $this->view_params['pdf'] = $pdf;

            $html = $this->load->view('course_students', $this->view_params, true);

            $report->generate_pdf('Statistics - Course Completion Rate', $html);
        } else {
            $items = Orm_Data_Course_Students::get_all($filters, $page, $per_page);

            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_Data_Course_Students::get_count($filters));

            $this->view_params['pager'] = $pager->render(true);
            $this->view_params['items'] = $items;
            $this->view_params['fltr'] = $filters;

            $this->layout->view('course_students', $this->view_params);
        }
    }

    /**
     * Program Graduates & Enrolled and all data will appear on will get by this functionK if parameter
     * $pdf send as true then the data will shown in pdf
     * @param bool $pdf
     */
    public function graduate_enrolled($pdf = false)
    {

        if (!is_bool($pdf) && $pdf != 1) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Statistics') . ' - ' . lang('Program Graduates & Enrolled'),
            'icon' => 'fa fa-calculator'
        ), true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (isset($fltr['academic_year']) && $fltr['academic_year'] != '') {
            $filters['academic_year'] = $fltr['academic_year'];
        }
        if (isset($fltr['college_id']) && $fltr['college_id'] != '') {
            $filters['college_id'] = $fltr['college_id'];
        }
        if (isset($fltr['program_id']) && $fltr['program_id'] != '') {
            $filters['program_id'] = $fltr['program_id'];
        }
        if (isset($fltr['gender']) && $fltr['gender'] != '') {
            $filters['gender'] = $fltr['gender'];
        }

        if ($pdf) {
            $report = new Orm_Report();

            $items = Orm_Data_Graduate::get_model()->grouped_result($filters, 0, 0, array(), Orm::FETCH_OBJECTS);

            $this->view_params['pager'] = '';
            $this->view_params['items'] = $items;
            $this->view_params['pdf'] = $pdf;

            $html = $this->load->view('graduate_enrolled', $this->view_params, true);

            $report->generate_pdf('Statistics - Program Graduates & Enrolled', $html);
        } else {

            $items = Orm_Data_Graduate::get_model()->grouped_result($filters, $page, $per_page, array(), Orm::FETCH_OBJECTS);
            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_Data_Graduate::get_count($filters));

            $this->view_params['pager'] = $pager->render(true);
            $this->view_params['items'] = $items;
            $this->view_params['fltr'] = $filters;

            $this->layout->view('graduate_enrolled', $this->view_params);
        }
    }

    /**
     * Program by Level Enrolled table and all data that will find on,
     * if parameter send with true value that means the data that are prepared on this function will appear in PDF version
     * @param bool $pdf
     */
    public function level_enrolled($pdf = false)
    {

        if (!is_bool($pdf) && $pdf != 1) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Statistics') . ' - ' . lang('Program by Level Enrolled'),
            'icon' => 'fa fa-calculator'
        ), true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (isset($fltr['academic_year']) && $fltr['academic_year'] != '') {
            $filters['academic_year'] = $fltr['academic_year'];
        }
        if (isset($fltr['college_id']) && $fltr['college_id'] != '') {
            $filters['college_id'] = $fltr['college_id'];
        }
        if (isset($fltr['program_id']) && $fltr['program_id'] != '') {
            $filters['program_id'] = $fltr['program_id'];
        }
        if (isset($fltr['gender']) && $fltr['gender'] != '') {
            $filters['gender'] = $fltr['gender'];
        }
        if ($pdf) {
            $report = new Orm_Report();

            $items = Orm_Data_Level_Enrolled::get_all($filters);

            $this->view_params['pager'] = '';
            $this->view_params['items'] = $items;
            $this->view_params['pdf'] = $pdf;

            $html = $this->load->view('level_enrolled', $this->view_params, true);

            $report->generate_pdf('Statistics - Program by Level Enrolled', $html);
        } else {
            $items = Orm_Data_Level_Enrolled::get_all($filters, $page, $per_page);

            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_Data_Level_Enrolled::get_count($filters));

            $this->view_params['pager'] = $pager->render(true);
            $this->view_params['items'] = $items;
            $this->view_params['fltr'] = $filters;

            $this->layout->view('level_enrolled', $this->view_params);
        }

    }

    /**
     * Program Faculty Profile table and all data that will find on,
     * if parameter send with true value that means the data that are prepared on this function will appear in PDF version
     * @param bool $pdf
     */
    public function periodic($pdf = false)
    {

        if (!is_bool($pdf) && $pdf != 1) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Statistics') . ' - ' . lang('Program Faculty Profile'),
            'icon' => 'fa fa-calculator'
        ), true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (isset($fltr['academic_year']) && $fltr['academic_year'] != '') {
            $filters['academic_year'] = $fltr['academic_year'];
        }
        if (isset($fltr['college_id']) && $fltr['college_id'] != '') {
            $filters['college_id'] = $fltr['college_id'];
        }
        if (isset($fltr['program_id']) && $fltr['program_id'] != '') {
            $filters['program_id'] = $fltr['program_id'];
        }
        if (isset($fltr['gender']) && $fltr['gender'] != '') {
            $filters['gender'] = $fltr['gender'];
        }

        if ($pdf) {
            $report = new Orm_Report();

            $items = Orm_Data_Periodic_Program::get_all($filters);

            $this->view_params['pager'] = '';
            $this->view_params['items'] = $items;
            $this->view_params['pdf'] = $pdf;

            $html = $this->load->view('periodic', $this->view_params, true);

            $report->generate_pdf('Statistics - Program Faculty Profile', $html);
        } else {
            $items = Orm_Data_Periodic_Program::get_all($filters, $page, $per_page);

            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_Data_Periodic_Program::get_count($filters));

            $this->view_params['pager'] = $pager->render(true);
            $this->view_params['items'] = $items;
            $this->view_params['fltr'] = $filters;

            $this->layout->view('periodic', $this->view_params);
        }
    }

    /**
     * Preparatory Year Report table and all data that will find on,
     * if parameter send with true value that means the data that are prepared on this function will appear in PDF version
     * @param bool $pdf
     */
    public function prep_year($pdf = false)
    {
        if (!is_bool($pdf) && $pdf != 1) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Statistics') . ' - ' . lang('Preparatory Year'),
            'icon' => 'fa fa-calculator'
        ), true);
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (isset($fltr['academic_year']) && $fltr['academic_year'] != '') {
            $filters['academic_year'] = $fltr['academic_year'];
        }

        if ($pdf) {
            $report = new Orm_Report();

            $items = Orm_Data_Preparatory_Year::get_all($filters);

            $this->view_params['pager'] = '';
            $this->view_params['items'] = $items;
            $this->view_params['pdf'] = $pdf;

            $html = $this->load->view('prep_year', $this->view_params, true);

            $report->generate_pdf('Statistics - Preparatory Year', $html);
        } else {
            $items = Orm_Data_Preparatory_Year::get_all($filters, $page, $per_page);

            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_Data_Preparatory_Year::get_count($filters));

            $this->view_params['pager'] = $pager->render(true);
            $this->view_params['items'] = $items;
            $this->view_params['fltr'] = $filters;

            $this->layout->view('prep_year', $this->view_params);
        }
    }

    /**
     *Research table and all data that will find on,
     *
     */
    public function research()
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Statistics') . ' - ' . lang('Research'),
            'icon' => 'fa fa-calculator'
        ), true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (isset($fltr['academic_year']) && $fltr['academic_year'] != '') {
            $filters['academic_year'] = $fltr['academic_year'];
        }
        if (isset($fltr['college_id']) && $fltr['college_id'] != '') {
            $filters['college_id'] = $fltr['college_id'];
        }
        if (isset($fltr['program_id']) && $fltr['program_id'] != '') {
            $filters['program_id'] = $fltr['program_id'];
        }

        $items = Orm_Data_Research_Budget::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Data_Research_Budget::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['items'] = $items;
        $this->view_params['fltr'] = $filters;

        $this->layout->view('research', $this->view_params);
    }

    /**
     * table number 2 in institutional profiles forms of NCAAA Accreditation  2015 that will show all Important data on
     *Table 2. Preparatory or Foundation Program
     */
    public function table_2()
    {
        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }

        $page_header = array(
            'title' => lang('Statistics'),
            'icon' => 'fa fa-calculator',
            'link_icon' => 'file-pdf-o',
            'link_attr' => 'href="/statistics/table_2_pdf"',
            'link_title' => lang('PDF')
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        $data = Orm_Data_Preparatory_Year::get_by_year($academic_year);
        $this->view_params['data'] = $data;
        $this->layout->view('institution_profile/table_2', $this->view_params);
    }

    /**
     *  this function will sprepare the PDF version of the table 2
     */
    public function table_2_pdf()
    {
        $report = new Orm_Report();

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }
        $data = Orm_Data_Preparatory_Year::get_by_year($academic_year);
        $this->view_params['data'] = $data;
        $html = $this->load->view('institution_profile/table_2', $this->view_params, true);

        $report->generate_pdf('Table 2. Preparatory or Foundation Program', $html);
    }

    /**
     * table number 3 in institutional profiles forms of NCAAA Accreditation  2015 that will show all Important data on
     * 	Table 3. Program Data
     */
    public function table_3()
    {
        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }

        $page_header = array(
            'title' => lang('Statistics'),
            'icon' => 'fa fa-calculator',
            'link_icon' => 'file-pdf-o',
            'link_attr' => 'href="/statistics/table_3_pdf"',
            'link_title' => lang('PDF')
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        $data = array();
        foreach (Orm_College::get_all() as $college) {
            foreach (Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                $faculty_count_m_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');
                $faculty_count_m_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');

                $faculty_count_f_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');
                $faculty_count_f_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');

                $student_enrolled_m_s = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year));
                $student_enrolled_m_o = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year));

                $student_enrolled_f_s = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year));
                $student_enrolled_f_o = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year));

                $workload_classsize_m = \Orm_Data_Workload::get_average(array('gender' => \Orm_User::GENDER_FEMALE, 'program_id' => $program->get_id(), 'academic_year' => $academic_year));
                $workload_classsize_f = \Orm_Data_Workload::get_average(array('gender' => \Orm_User::GENDER_MALE, 'program_id' => $program->get_id(), 'academic_year' => $academic_year));

                $workload_m = round($workload_classsize_m['work_load'], 2);
                $class_size_m = round($workload_classsize_m['class_size'], 2);

                $workload_f = round($workload_classsize_f['work_load'], 2);
                $class_size_f = round($workload_classsize_f['class_size'], 2);

                $data[$program->get_name('english')]['student_enrolled_male_saudi'] = $student_enrolled_m_s;
                $data[$program->get_name('english')]['student_enrolled_male_other'] = $student_enrolled_m_o;
                $data[$program->get_name('english')]['phd_holder_male_saudi'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                $data[$program->get_name('english')]['phd_holder_male_other'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                $data[$program->get_name('english')]['teaching_staff_male_saudi'] = $faculty_count_m_s;
                $data[$program->get_name('english')]['teaching_staff_male_other'] = $faculty_count_m_o;
                $data[$program->get_name('english')]['class_size_male'] = $class_size_m;
                $data[$program->get_name('english')]['teaching_load_male'] = $workload_m;
                $data[$program->get_name('english')]['ratio_total_student_fac'] = round(($faculty_count_m_o + $faculty_count_m_s + $faculty_count_f_s + $faculty_count_f_o) ? (($student_enrolled_m_s + $student_enrolled_m_o + $student_enrolled_f_s + $student_enrolled_f_o) / ($faculty_count_m_o + $faculty_count_m_s + $faculty_count_f_s + $faculty_count_f_o)) : 0) . ':' . '1';
                $data[$program->get_name('english')]['ratio_male_student_fac'] = round(($faculty_count_m_o + $faculty_count_m_s) ? (($student_enrolled_m_s + $student_enrolled_m_o) / ($faculty_count_m_o + $faculty_count_m_s)) : 0) . ':' . '1';
                $data[$program->get_name('english')]['ratio_female_student_fac'] = round(($faculty_count_m_o + $faculty_count_m_s) ? (($student_enrolled_f_s + $student_enrolled_f_o) / ($faculty_count_m_o + $faculty_count_m_s)) : 0) . ':' . '1';
                $data[$program->get_name('english')]['student_enrolled_female_saudi'] = $student_enrolled_f_s;
                $data[$program->get_name('english')]['student_enrolled_female_other'] = $student_enrolled_f_o;
                $data[$program->get_name('english')]['phd_holder_female_saudi'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                $data[$program->get_name('english')]['phd_holder_female_other'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                $data[$program->get_name('english')]['teaching_staff_female_saudi'] = $faculty_count_f_s;
                $data[$program->get_name('english')]['teaching_staff_female_other'] = $faculty_count_f_o;
                $data[$program->get_name('english')]['class_size_female'] = $class_size_f;
                $data[$program->get_name('english')]['teaching_load_female'] = $workload_f;

            }
        }

        $this->view_params['data'] = $data;
        $this->layout->view('institution_profile/table_3', $this->view_params);
    }

    /**
     *  this function will sprepare the PDF version of the table 3
     */
    public function table_3_pdf()
    {
        $report = new Orm_Report();

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }

        $data = array();
        foreach (Orm_College::get_all() as $college) {
            foreach (Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                $faculty_count_m_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');
                $faculty_count_m_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');

                $faculty_count_f_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');
                $faculty_count_f_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');

                $student_enrolled_m_s = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year));
                $student_enrolled_m_o = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year));

                $student_enrolled_f_s = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year));
                $student_enrolled_f_o = \Orm_Data_Level_Enrolled::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year));

                $workload_classsize_m = \Orm_Data_Workload::get_average(array('gender' => \Orm_User::GENDER_FEMALE, 'program_id' => $program->get_id(), 'academic_year' => $academic_year));
                $workload_classsize_f = \Orm_Data_Workload::get_average(array('gender' => \Orm_User::GENDER_MALE, 'program_id' => $program->get_id(), 'academic_year' => $academic_year));

                $workload_m = $workload_classsize_m['work_load'];
                $class_size_m = $workload_classsize_m['class_size'];

                $workload_f = $workload_classsize_f['work_load'];
                $class_size_f = $workload_classsize_f['class_size'];

                $data[$program->get_name('english')]['student_enrolled_male_saudi'] = $student_enrolled_m_s;
                $data[$program->get_name('english')]['student_enrolled_male_other'] = $student_enrolled_m_o;
                $data[$program->get_name('english')]['phd_holder_male_saudi'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                $data[$program->get_name('english')]['phd_holder_male_other'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                $data[$program->get_name('english')]['teaching_staff_male_saudi'] = $faculty_count_m_s;
                $data[$program->get_name('english')]['teaching_staff_male_other'] = $faculty_count_m_o;
                $data[$program->get_name('english')]['class_size_male'] = $class_size_m;
                $data[$program->get_name('english')]['teaching_load_male'] = $workload_m;
                $data[$program->get_name('english')]['ratio_total_student_fac'] = round(($faculty_count_m_o + $faculty_count_m_s + $faculty_count_f_s + $faculty_count_f_o) ? (($student_enrolled_m_s + $student_enrolled_m_o + $student_enrolled_f_s + $student_enrolled_f_o) / ($faculty_count_m_o + $faculty_count_m_s + $faculty_count_f_s + $faculty_count_f_o)) : 0) . ':' . '1';
                $data[$program->get_name('english')]['ratio_male_student_fac'] = round(($faculty_count_m_o + $faculty_count_m_s) ? (($student_enrolled_m_s + $student_enrolled_m_o) / ($faculty_count_m_o + $faculty_count_m_s)) : 0) . ':' . '1';
                $data[$program->get_name('english')]['ratio_female_student_fac'] = round(($faculty_count_m_o + $faculty_count_m_s) ? (($student_enrolled_f_s + $student_enrolled_f_o) / ($faculty_count_m_o + $faculty_count_m_s)) : 0) . ':' . '1';
                $data[$program->get_name('english')]['student_enrolled_female_saudi'] = $student_enrolled_f_s;
                $data[$program->get_name('english')]['student_enrolled_female_other'] = $student_enrolled_f_o;
                $data[$program->get_name('english')]['phd_holder_female_saudi'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                $data[$program->get_name('english')]['phd_holder_female_other'] = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'phd_holder');
                $data[$program->get_name('english')]['teaching_staff_female_saudi'] = $faculty_count_f_s;
                $data[$program->get_name('english')]['teaching_staff_female_other'] = $faculty_count_f_o;
                $data[$program->get_name('english')]['class_size_female'] = $class_size_f;
                $data[$program->get_name('english')]['teaching_load_female'] = $workload_f;

            }
        }

        $this->view_params['data'] = $data;
        $html = $this->load->view('institution_profile/table_3', $this->view_params, true);

        $report->generate_pdf('Table 3. Program Data', $html);
    }

    /**
     * table number 4 in institutional profiles forms of NCAAA Accreditation  2015 that will show all Important data on
     *Table 4. Summary of Programs' Teaching Staff
     */
    public function table_4()
    {

        $data = array();

        $page_header = array(
            'title' => lang('Statistics'),
            'icon' => 'fa fa-calculator',
            'link_icon' => 'file-pdf-o',
            'link_attr' => 'href="/statistics/table_4_pdf"',
            'link_title' => lang('PDF')
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        foreach (\Orm_Data_Faculty::get_all(array(), 0, 0, array('college_id')) as $faculty_count) {
            $data[$faculty_count->get_program_obj()->get_name('english')] = array(
                'professor_m_ft' => $faculty_count->get_prof_male(),
                'professor_m_pt' => 0,
                'professor_f_ft' => $faculty_count->get_prof_female(),
                'professor_f_pt' => 0,
                'associate_professor_m_ft' => $faculty_count->get_associate_prof_male(),
                'associate_professor_m_pt' => 0,
                'associate_professor_f_ft' => $faculty_count->get_associate_prof_female(),
                'associate_professor_f_pt' => 0,
                'assistant_professor_m_ft' => $faculty_count->get_assistant_prof_male(),
                'assistant_professor_m_pt' => 0,
                'assistant_professor_f_ft' => $faculty_count->get_assistant_prof_female(),
                'assistant_professor_f_pt' => 0,
                'lecture_m_ft' => $faculty_count->get_instructor_male(),
                'lecture_m_pt' => 0,
                'lecture_f_ft' => $faculty_count->get_instructor_female(),
                'lecture_f_pt' => 0,
                'teaching_m_ft' => $faculty_count->get_teaching_assistant_male(),
                'teaching_m_pt' => 0,
                'teaching_f_ft' => $faculty_count->get_teaching_assistant_female(),
                'teaching_f_pt' => 0,
                'total_m' => $faculty_count->get_total(),
                'total_f' => 0
            );
        }

        $this->view_params['data'] = $data;
        $this->layout->view('institution_profile/table_4', $this->view_params);
    }

    /**
     *  this function will sprepare the PDF version of the table 4
     */
    public function table_4_pdf()
    {

        $report = new Orm_Report();

        $data = array();
        foreach (\Orm_Data_Faculty::get_all(array(), 0, 0, array('college_id')) as $faculty_count) {
            $data[$faculty_count->get_program_obj()->get_name('english')] = array(
                'professor_m_ft' => $faculty_count->get_prof_male(),
                'professor_m_pt' => 0,
                'professor_f_ft' => $faculty_count->get_prof_female(),
                'professor_f_pt' => 0,
                'associate_professor_m_ft' => $faculty_count->get_associate_prof_male(),
                'associate_professor_m_pt' => 0,
                'associate_professor_f_ft' => $faculty_count->get_associate_prof_female(),
                'associate_professor_f_pt' => 0,
                'assistant_professor_m_ft' => $faculty_count->get_assistant_prof_male(),
                'assistant_professor_m_pt' => 0,
                'assistant_professor_f_ft' => $faculty_count->get_assistant_prof_female(),
                'assistant_professor_f_pt' => 0,
                'lecture_m_ft' => $faculty_count->get_instructor_male(),
                'lecture_m_pt' => 0,
                'lecture_f_ft' => $faculty_count->get_instructor_female(),
                'lecture_f_pt' => 0,
                'teaching_m_ft' => $faculty_count->get_teaching_assistant_male(),
                'teaching_m_pt' => 0,
                'teaching_f_ft' => $faculty_count->get_teaching_assistant_female(),
                'teaching_f_pt' => 0,
                'total_m' => $faculty_count->get_total(),
                'total_f' => 0
            );
        }

        $this->view_params['data'] = $data;
        $html = $this->load->view('institution_profile/table_4', $this->view_params, true);

        $report->generate_pdf('Table 4. Summary of Programs Teaching Staff', $html);
    }

    /**
     * table number 5 in institutional profiles forms of NCAAA Accreditation  2015 that will show all Important data on
     * 	Table 5. Numbers of Graduates in the Most Recent Year
     */
    public function table_5()
    {

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }
        $data = array();

        $page_header = array(
            'title' => lang('Statistics'),
            'icon' => 'fa fa-calculator',
            'link_icon' => 'file-pdf-o',
            'link_attr' => 'href="/statistics/table_5_pdf"',
            'link_title' => lang('PDF')
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        foreach (\Orm_College::get_all() as $college) {
            foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                $bsc_ids = array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(), 'degree_id' => '5'), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $diploma_ids = array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(), 'degree_id' => '3'), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $higher_diploma_ids = array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(), 'degree_id' => '6'), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $masters_ids = array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(), 'degree_id' => '8'), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $phd_ids = array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(), 'degree_id' => '10'), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $bsc_ids[] = 0;
                $diploma_ids[] = 0;
                $higher_diploma_ids[] = 0;
                $masters_ids[] = 0;
                $phd_ids[] = 0;

                $data[$program->get_name('english')]['undergraduate_students_diploma_saudi_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_diploma_saudi_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_saudi_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_saudi_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_saudi_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_saudi_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_saudi_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_saudi_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_saudi_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_saudi_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');

                $data[$program->get_name('english')]['undergraduate_students_diploma_others_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_diploma_others_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_others_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_others_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_others_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_others_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_others_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_others_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_others_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_others_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');

                $data[$program->get_name('english')]['undergraduate_students_diploma_total_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_diploma_total_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_total_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_total_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_total_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_total_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_total_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_total_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_total_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_total_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'graduate');
            }
        }
        $this->view_params['data'] = $data;
        $this->layout->view('institution_profile/table_5', $this->view_params);
    }

    /**
     *  this function will sprepare the PDF version of the table 5
     */
    public function table_5_pdf()
    {

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }
        $data = array();

        foreach (\Orm_College::get_all() as $college) {
            foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                $bsc_ids = array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(), 'degree_id' => '5'), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $diploma_ids = array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(), 'degree_id' => '3'), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $higher_diploma_ids = array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(), 'degree_id' => '6'), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $masters_ids = array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(), 'degree_id' => '8'), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $phd_ids = array_column(\Orm_Program::get_model()->get_all(array('id' => $program->get_id(), 'degree_id' => '10'), 0, 0, array(), \Orm::FETCH_ARRAY), 'id');
                $bsc_ids[] = 0;
                $diploma_ids[] = 0;
                $higher_diploma_ids[] = 0;
                $masters_ids[] = 0;
                $phd_ids[] = 0;

                $data[$program->get_name('english')]['undergraduate_students_diploma_saudi_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_diploma_saudi_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_saudi_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_saudi_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_saudi_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_saudi_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_saudi_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_saudi_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_saudi_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_saudi_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'graduate');

                $data[$program->get_name('english')]['undergraduate_students_diploma_others_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_diploma_others_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_others_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_others_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_others_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_others_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_others_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_others_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_others_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_others_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'graduate');

                $data[$program->get_name('english')]['undergraduate_students_diploma_total_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_diploma_total_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_total_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['undergraduate_students_bachelor_total_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $bsc_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_total_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_higher_diploma_total_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $higher_diploma_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_total_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_master_total_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $masters_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_total_m'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'graduate');
                $data[$program->get_name('english')]['postgraduate_students_phd_total_f'] = \Orm_Data_Graduate::get_sum(array('program_in' => $phd_ids, 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'graduate');
            }
        }
        $this->view_params['data'] = $data;
        $html = $this->load->view('institution_profile/table_5', $this->view_params, true);

        $report = new Orm_Report();
        $report->generate_pdf('Table 5. Numbers of Graduates in the Most Recent Year', $html);
    }

    /**
     * table number 6 in institutional profiles forms of NCAAA Accreditation  2015 that will show all Important data on
     * Table 6. Mode of Instruction – Student Enrollment
     */
    public function table_6()
    {

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }
        $data = array();

        $page_header = array(
            'title' => lang('Statistics'),
            'icon' => 'fa fa-calculator',
            'link_icon' => 'file-pdf-o',
            'link_attr' => 'href="/statistics/table_6_pdf"',
            'link_title' => lang('PDF')
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        foreach (\Orm_College::get_all() as $college) {
            foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {
                $data[$program->get_name('english')]['on_campus_ft_m_s'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_ft_f_s'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_pt_m_s'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_s'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_s'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_s'] = 0;
                $data[$program->get_name('english')]['on_campus_ft_m_o'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_ft_f_o'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_pt_m_o'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_o'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_o'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_o'] = 0;
                $data[$program->get_name('english')]['on_campus_ft_m_t'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_ft_f_t'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_pt_m_t'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_t'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_t'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_t'] = 0;

            }
        }
        $this->view_params['data'] = $data;
        $this->layout->view('institution_profile/table_6', $this->view_params);
    }

    /**
     *  this function will sprepare the PDF version of the table 6
     */
    public function table_6_pdf()
    {

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }
        $data = array();

        foreach (\Orm_College::get_all() as $college) {
            foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {
                $data[$program->get_name('english')]['on_campus_ft_m_s'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_ft_f_s'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_pt_m_s'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_s'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_s'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_s'] = 0;
                $data[$program->get_name('english')]['on_campus_ft_m_o'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_ft_f_o'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_pt_m_o'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_o'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_o'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_o'] = 0;
                $data[$program->get_name('english')]['on_campus_ft_m_t'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_MALE, 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_ft_f_t'] = \Orm_Data_Graduate::get_sum(array('program_id' => $program->get_id(), 'gender' => \Orm_User::GENDER_FEMALE, 'academic_year' => $academic_year), 'enrolled');
                $data[$program->get_name('english')]['on_campus_pt_m_t'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_t'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_t'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_t'] = 0;

            }
        }
        $this->view_params['data'] = $data;
        $html = $this->load->view('institution_profile/table_6', $this->view_params, true);

        $report = new Orm_Report();
        $report->generate_pdf('Table 6. Mode of Instruction – Student Enrollment', $html);
    }

    /**
     *  table number 7 in institutional profiles forms of NCAAA Accreditation  2015 that will show all Important data on
     * Table 7. Mode of Instruction – Teaching Staff
     */
    public function table_7()
    {

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }
        $data = array();

        $page_header = array(
            'title' => lang('Statistics'),
            'icon' => 'fa fa-calculator',
            'link_icon' => 'file-pdf-o',
            'link_attr' => 'href="/statistics/table_7_pdf"',
            'link_title' => lang('PDF')
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        foreach (\Orm_College::get_all() as $college) {
            foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {
                $faculty_count_m_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');
                $faculty_count_m_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');

                $faculty_count_f_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');
                $faculty_count_f_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');

                $data[$program->get_name('english')]['on_campus_ft_m_s'] = $faculty_count_m_s;
                $data[$program->get_name('english')]['on_campus_ft_f_s'] = $faculty_count_f_s;
                $data[$program->get_name('english')]['on_campus_pt_m_s'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_s'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_s'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_s'] = 0;
                $data[$program->get_name('english')]['on_campus_ft_m_o'] = $faculty_count_m_o;
                $data[$program->get_name('english')]['on_campus_ft_f_o'] = $faculty_count_f_o;
                $data[$program->get_name('english')]['on_campus_pt_m_o'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_o'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_o'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_o'] = 0;
                $data[$program->get_name('english')]['on_campus_ft_m_t'] = $faculty_count_m_s + $faculty_count_m_o;
                $data[$program->get_name('english')]['on_campus_ft_f_t'] = $faculty_count_f_s + $faculty_count_f_o;
                $data[$program->get_name('english')]['on_campus_pt_m_t'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_t'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_t'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_t'] = 0;

            }
        }
        $this->view_params['data'] = $data;
        $this->layout->view('institution_profile/table_7', $this->view_params);
    }

    /**
     *  this function will sprepare the PDF version of the table 7
     */
    public function table_7_pdf()
    {

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }
        $data = array();

        foreach (\Orm_College::get_all() as $college) {
            foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {
                $faculty_count_m_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');
                $faculty_count_m_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_MALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');

                $faculty_count_f_s = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 's', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');
                $faculty_count_f_o = \Orm_Data_Periodic_Program::get_sum(array('gender' => \Orm_User::GENDER_FEMALE, 'nationality' => 'o', 'program_id' => $program->get_id(), 'academic_year' => $academic_year), 'teaching_staff');

                $data[$program->get_name('english')]['on_campus_ft_m_s'] = $faculty_count_m_s;
                $data[$program->get_name('english')]['on_campus_ft_f_s'] = $faculty_count_f_s;
                $data[$program->get_name('english')]['on_campus_pt_m_s'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_s'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_s'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_s'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_s'] = 0;
                $data[$program->get_name('english')]['on_campus_ft_m_o'] = $faculty_count_m_o;
                $data[$program->get_name('english')]['on_campus_ft_f_o'] = $faculty_count_f_o;
                $data[$program->get_name('english')]['on_campus_pt_m_o'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_o'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_o'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_o'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_o'] = 0;
                $data[$program->get_name('english')]['on_campus_ft_m_t'] = $faculty_count_m_s + $faculty_count_m_o;
                $data[$program->get_name('english')]['on_campus_ft_f_t'] = $faculty_count_f_s + $faculty_count_f_o;
                $data[$program->get_name('english')]['on_campus_pt_m_t'] = 0;
                $data[$program->get_name('english')]['on_campus_pt_f_t'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_m_t'] = 0;
                $data[$program->get_name('english')]['on_campus_fte_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_ft_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_pt_f_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_m_t'] = 0;
                $data[$program->get_name('english')]['distance_education_programs_fte_f_t'] = 0;

            }
        }
        $this->view_params['data'] = $data;
        $html = $this->load->view('institution_profile/table_7', $this->view_params, true);

        $report = new Orm_Report();
        $report->generate_pdf('Table 7. Mode of Instruction – Teaching Staff', $html);
    }

    /**
     *  table number 8 in institutional profiles forms of NCAAA Accreditation  2015 that will show all Important data on
     * Table 8. Program Completion Rate/Graduation Rate
     */
    public function table_8()
    {

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }
        $data = array();

        $page_header = array(
            'title' => lang('Statistics'),
            'icon' => 'fa fa-calculator',
            'link_icon' => 'file-pdf-o',
            'link_attr' => 'href="/statistics/table_8_pdf"',
            'link_title' => lang('PDF')
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        foreach (\Orm_College::get_all() as $college) {
            foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                $four_programs = 0;
                $five_programs = 0;
                $six_programs = 0;
                $master_program = 0;
                $phd_program = 0;

                $total = 0;
                if ($program->get_degree_id() == 8) {
                    $master_program = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year));
                } elseif ($program->get_degree_id() == 10) {
                    $phd_program = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 4 && $program->get_degree_id() == 5) {
                    $four_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 5 && $program->get_degree_id() == 5) {
                    $five_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 6 && $program->get_degree_id() == 5) {
                    $six_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year));
                }

                if ($total) {
                    if (!isset($total_m) || !$total_m) {
                        $total_m = 1;
                    }
                    if (!isset($total_f) || !$total_f) {
                        $total_f = 1;
                    }
                    if (!isset($total) || !$total) {
                        $total = 1;
                    }

                    $data[$program->get_name('english')]['under_programs_4_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_4_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_4_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_7_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_7_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_8_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year, 'number_of_years_less' => 2, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_doctor_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;

                    $data[$program->get_name('english')]['under_programs_4_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_4_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_4_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_7_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_7_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_8_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year, 'number_of_years_less' => 2, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_doctor_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;

                    $data[$program->get_name('english')]['under_programs_4_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4)) / $total;
                    $data[$program->get_name('english')]['under_programs_4_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5)) / $total;
                    $data[$program->get_name('english')]['under_programs_4_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_7_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_7_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_8_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year, 'number_of_years_less' => 2)) / $total;
                    $data[$program->get_name('english')]['post_programs_doctor_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year, 'number_of_years_less' => 4)) / $total;
                }
            }
        }

        $this->view_params['data'] = $data;
        $this->layout->view('institution_profile/table_8', $this->view_params);
    }

    /**
     *  this function will sprepare the PDF version of the table 8 - 2015
     */
    public function table_8_pdf()
    {

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }
        $data = array();

        foreach (\Orm_College::get_all() as $college) {
            foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                $four_programs = 0;
                $five_programs = 0;
                $six_programs = 0;
                $master_program = 0;
                $phd_program = 0;

                $total = 0;
                if ($program->get_degree_id() == 8) {
                    $master_program = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year));
                } elseif ($program->get_degree_id() == 10) {
                    $phd_program = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 4 && $program->get_degree_id() == 5) {
                    $four_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 5 && $program->get_degree_id() == 5) {
                    $five_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 6 && $program->get_degree_id() == 5) {
                    $six_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year));
                }

                if (!isset($total_m) || !$total_m) {
                    $total_m = 1;
                }
                if (!isset($total_f) || !$total_f) {
                    $total_f = 1;
                }
                if (!isset($total) || !$total) {
                    $total = 1;
                }

                if ($total) {
                    if (!isset($total_m) || !$total_m) {
                        $total_m = 1;
                    }
                    if (!isset($total_f) || !$total_f) {
                        $total_f = 1;
                    }
                    if (!isset($total) || !$total) {
                        $total = 1;
                    }

                    $data[$program->get_name('english')]['under_programs_4_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_4_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_4_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_7_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_7_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_8_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year, 'number_of_years_less' => 2, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_doctor_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;

                    $data[$program->get_name('english')]['under_programs_4_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_4_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_4_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_7_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_7_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_8_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year, 'number_of_years_less' => 2, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_doctor_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;

                    $data[$program->get_name('english')]['under_programs_4_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4)) / $total;
                    $data[$program->get_name('english')]['under_programs_4_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5)) / $total;
                    $data[$program->get_name('english')]['under_programs_4_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_7_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_7_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_8_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $master_program, 'academic_year' => $academic_year, 'number_of_years_less' => 2)) / $total;
                    $data[$program->get_name('english')]['post_programs_doctor_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $phd_program, 'academic_year' => $academic_year, 'number_of_years_less' => 4)) / $total;
                }
            }
        }

        $this->view_params['data'] = $data;
        $html = $this->load->view('institution_profile/table_8', $this->view_params, true);

        $report = new Orm_Report();
        $report->generate_pdf('Table 8. Program Completion Rate/Graduation Rate', $html);
    }


    /**
     * table number 8 in institutional profiles forms of NCAAA Accreditation  2018 that will show all Important data on
     * Table 8. Program Completion Rate/Graduation Rate
     */
    public function table_8_2018()
    {

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }
        $data = array();

        $page_header = array(
            'title' => lang('Statistics'),
            'icon' => 'fa fa-calculator',
            'link_icon' => 'file-pdf-o',
            'link_attr' => 'href="/statistics/table_8_2018_pdf"',
            'link_title' => lang('PDF')
        );

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);

        foreach (\Orm_College::get_all() as $college) {
            foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                $four_programs = 0;
                $five_programs = 0;
                $six_programs = 0;

                $two_master_programs = 0;
                $three_master_programs = 0;
                $four_master_programs = 0;

                $three_phd_programs = 0;
                $four_phd_programs = 0;
                $five_phd_programs = 0;

                $total = 0;
                if ($program->get_duration() == 4 && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR) {
                    $four_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 5 && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR) {
                    $five_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 6 && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR) {
                    $six_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year));
                }elseif ($program->get_duration() == 2  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER) {
                    $two_master_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs,'academic_year' => $academic_year));
                }elseif ($program->get_duration() == 3  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER) {
                    $three_master_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs,'academic_year' => $academic_year));
                }elseif ($program->get_duration() == 4  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER) {
                    $four_master_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs,'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 3  &&  $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR) {
                    $three_phd_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs,'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 4  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR) {
                    $four_phd_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs,'academic_year' => $academic_year));
                }  elseif ($program->get_duration() == 5  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR) {
                    $five_phd_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs,'academic_year' => $academic_year));
                }  else

                    if (!isset($total_m) || !$total_m) {
                        $total_m = 1;
                    }
                if (!isset($total_f) || !$total_f) {
                    $total_f = 1;
                }
                if (!isset($total) || !$total) {
                    $total = 1;
                }

                if ($total) {
                    if (!isset($total_m) || !$total_m) {
                        $total_m = 1;
                    }
                    if (!isset($total_f) || !$total_f) {
                        $total_f = 1;
                    }
                    if (!isset($total) || !$total) {
                        $total = 1;
                    }

                    /*Male Part*/

                    $data[$program->get_name('english')]['under_programs_4_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_4_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_4_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_7_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_7_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_8_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;

                    $data[$program->get_name('english')]['post_programs_master_2_2_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 2, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_2_3_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 3, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_2_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_3_3_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 3, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_3_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_3_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_4_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_4_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_4_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;

                    $data[$program->get_name('english')]['post_programs_phd_3_3_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_3_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_3_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_4_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_4_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_4_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_5_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_5_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_5_7_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;

                    /*end Male Part*/

                    /*Female Part*/

                    $data[$program->get_name('english')]['under_programs_4_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_4_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_4_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_7_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_7_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_8_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;

                    $data[$program->get_name('english')]['post_programs_master_2_2_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 2, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_2_3_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 3, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_2_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_3_3_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 3, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_3_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_3_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_4_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_4_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_4_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;

                    $data[$program->get_name('english')]['post_programs_phd_3_3_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 3, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_3_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_3_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_4_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_4_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_4_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_5_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_5_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_5_7_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;

                    /*end Female Part*/

                    /*Total  Part*/
                    $data[$program->get_name('english')]['under_programs_4_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4)) / $total;
                    $data[$program->get_name('english')]['under_programs_4_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5)) / $total;
                    $data[$program->get_name('english')]['under_programs_4_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_7_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_7_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_8_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8)) / $total;

                    $data[$program->get_name('english')]['post_programs_master_2_2_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 2)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_2_3_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 3)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_2_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 4)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_3_3_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 3)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_3_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 4)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_3_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 5)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_4_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_4_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 5)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_4_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6)) / $total;

                    $data[$program->get_name('english')]['post_programs_phd_3_3_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 3)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_3_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 4)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_3_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 5)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_4_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_4_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 5)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_4_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_5_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_5_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 6)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_5_7_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7)) / $total;

                    /*end Total  Part*/
                }
            }
        }

        $this->view_params['data'] = $data;
        $this->layout->view('institution_profile/table_8_2018', $this->view_params);
    }

    /**
     * this function will sprepare the PDF version of the table 8 -2018
     */
    public function table_8_2018_pdf()
    {

        $academic_year = $this->input->get('academic_year');
        if (!$academic_year) {
            $academic_year = Orm_Semester::get_active_semester()->get_year();
        }
        $data = array();

        foreach (\Orm_College::get_all() as $college) {
            foreach (\Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                $four_programs = 0;
                $five_programs = 0;
                $six_programs = 0;

                $two_master_programs = 0;
                $three_master_programs = 0;
                $four_master_programs = 0;

                $three_phd_programs = 0;
                $four_phd_programs = 0;
                $five_phd_programs = 0;

                $total = 0;
                if ($program->get_duration() == 4 && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR) {
                    $four_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 5 && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR) {
                    $five_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 6 && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_UNDERGRAUDATE_BACHELOR) {
                    $six_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year));
                }elseif ($program->get_duration() == 2  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER) {
                    $two_master_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs,'academic_year' => $academic_year));
                }elseif ($program->get_duration() == 3  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER) {
                    $three_master_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs,'academic_year' => $academic_year));
                }elseif ($program->get_duration() == 4  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_MASTER) {
                    $four_master_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs,'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 3  &&  $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR) {
                    $three_phd_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs,'academic_year' => $academic_year));
                } elseif ($program->get_duration() == 4  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR) {
                    $four_phd_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs,'academic_year' => $academic_year));
                }  elseif ($program->get_duration() == 5  && $program->get_degree_obj()->get_is_undergraduate() == \Orm_Degree::DEGREE_POSTGRAUDATE_DOCTOR) {
                    $five_phd_programs = $program->get_id();
                    $total_m = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_MALE));
                    $total_f = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs,'academic_year' => $academic_year,'gender' => \Orm_User::GENDER_FEMALE));
                    $total = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs,'academic_year' => $academic_year));
                }  else

                if (!isset($total_m) || !$total_m) {
                    $total_m = 1;
                }
                if (!isset($total_f) || !$total_f) {
                    $total_f = 1;
                }
                if (!isset($total) || !$total) {
                    $total = 1;
                }

                if ($total) {
                    if (!isset($total_m) || !$total_m) {
                        $total_m = 1;
                    }
                    if (!isset($total_f) || !$total_f) {
                        $total_f = 1;
                    }
                    if (!isset($total) || !$total) {
                        $total = 1;
                    }
                    /*Male Part*/

                    $data[$program->get_name('english')]['under_programs_4_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_4_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_4_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_5_7_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_7_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['under_programs_6_8_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;

                    $data[$program->get_name('english')]['post_programs_master_2_2_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 2, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_2_3_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 3, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_2_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_3_3_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 3, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_3_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_3_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_4_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_4_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_master_4_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;

                    $data[$program->get_name('english')]['post_programs_phd_3_3_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_3_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_3_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_4_4_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_4_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_4_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_5_5_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_5_6_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;
                    $data[$program->get_name('english')]['post_programs_phd_5_7_m'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_MALE)) / $total_m;

                    /*end Male Part*/

                    /*Female Part*/

                    $data[$program->get_name('english')]['under_programs_4_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_4_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_4_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_5_7_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_7_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['under_programs_6_8_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;

                    $data[$program->get_name('english')]['post_programs_master_2_2_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 2, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_2_3_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 3, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_2_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_3_3_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 3, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_3_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_3_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_4_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_4_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_master_4_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;

                    $data[$program->get_name('english')]['post_programs_phd_3_3_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 3, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_3_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_3_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_4_4_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_4_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_4_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_5_5_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_5_6_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 6, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;
                    $data[$program->get_name('english')]['post_programs_phd_5_7_f'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7, 'gender' => \Orm_User::GENDER_FEMALE)) / $total_f;

                    /*end Female Part*/

                    /*Total  Part*/
                    $data[$program->get_name('english')]['under_programs_4_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4)) / $total;
                    $data[$program->get_name('english')]['under_programs_4_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years' => 5)) / $total;
                    $data[$program->get_name('english')]['under_programs_4_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_5_7_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 6)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_7_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years' => 7)) / $total;
                    $data[$program->get_name('english')]['under_programs_6_8_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $six_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 8)) / $total;

                    $data[$program->get_name('english')]['post_programs_master_2_2_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 2)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_2_3_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 3)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_2_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $two_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 4)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_3_3_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 3)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_3_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 4)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_3_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 5)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_4_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_4_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years' => 5)) / $total;
                    $data[$program->get_name('english')]['post_programs_master_4_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_master_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6)) / $total;

                    $data[$program->get_name('english')]['post_programs_phd_3_3_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 3)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_3_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 4)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_3_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $three_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 5)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_4_4_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 4)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_4_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 5)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_4_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $four_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 6)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_5_5_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_less' => 5)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_5_6_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years' => 6)) / $total;
                    $data[$program->get_name('english')]['post_programs_phd_5_7_t'] = \Orm_Data_Competion_Rate::get_sum(array('program_id' => $five_phd_programs, 'academic_year' => $academic_year, 'number_of_years_more' => 7)) / $total;

                    /*end Total  Part*/
                }
            }
        }

        $this->view_params['data'] = $data;
        $html = $this->load->view('institution_profile/table_8_2018', $this->view_params, true);

        $report = new Orm_Report();
        $report->generate_pdf('Table 8. Program Completion Rate/Graduation Rate', $html);
    }
}