<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Manager
 */
class Faculty_Report extends MX_Controller
{

    /**
     * @var $view_params array => the array pf data that will send to views
     * @var $deadline int (deadline id active)
     */


    private $view_params = array();
    private $deadline = 0;

    /**
     * Faculty_Report constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('faculty_performance', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'faculty_performance-report');

        $this->deadline = Orm_Fp_Forms_Deadline::get_current_deadline();

        $this->view_params['menu_tab'] = 'faculty_performance';
        $this->breadcrumbs->push(lang('Faculty Performance Report'), '/faculty_performance/faculty_report');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance'),
            'icon' => 'fa fa-university'
        ), true);


    }

    /**
     * show the main page and collect the data for reports depends on the role og logged user
     *@return object|string
     */
    public function index()
    {
        $user = Orm_User::get_logged_user();
        $type_id = (int)$this->input->get_post('type_id');
        $user_id = (int)$this->input->get_post('user_id');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);

        $this->view_params['menu_tab'] = 'faculty_report';
        $this->view_params['sub_menu'] = 'faculty_performance/report/sub_menu';
        $this->view_params['type_id'] = $type_id;
        $this->view_params['fltr'] = $filters;
        $this->view_params['user_id'] = $user_id;
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance Report'),
            'icon' => 'fa fa-th',
        ), true);

        $this->view_params['form_types'] = Orm_Fp_Forms_Type::get_all();

        $this->view_params['deadline'] = $this->deadline;


        switch ($type_id) {
            case 3:
                if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {

                    $this->breadcrumbs->push(lang('University Report'), '/faculty_performance/faculty_report?type_id=3');
                    $university = Orm_Fp_Forms_Recommendation::get_recmmedation_by_values(0, 3, $this->deadline);
                    $this->view_params['university'] = $university;
                    $this->layout->view('faculty_performance/report/university_report', $this->view_params);
                } else {
                    Validator::get_html_error_message("You Don't Have permission");
                    redirect('/dashboard');
                }
                break;
            case 5:
                $this->breadcrumbs->push(lang('Summary'), '/faculty_performance/faculty_report?type_id=5');
                $this->layout->add_javascript('https://www.google.com/jsapi', false);
                $this->layout->view('faculty_performance/report/summary', $this->view_params);
                break;
            case 6:
                $result = Orm_Fp_Forms_Result::get_all();
                $arrIds = [];
                foreach ($result as $val) {
                    array_push($arrIds, $val->get_user_id());
                }
                $filters['user_id_not_in'] = $arrIds;
                $pager->set_total_count(Orm_User_Faculty::get_count($filters));
                $this->view_params['pager'] = $pager->render(true);
                $this->view_params['facilities'] = Orm_User_Faculty::get_all($filters, $page, $per_page);
                $this->layout->view('faculty_performance/report/faculty_no_submit_report', $this->view_params);
                break;
            default:
                $this->breadcrumbs->push(lang('Faculty Report'), '/faculty_performance/faculty_report?type_id=0');

                if ($user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
                    $this->layout->add_javascript('https://www.google.com/jsapi', false);
                    $this->view_params['facilities'] = Orm_User_Faculty::get_instance($user->get_id());
                    $this->layout->view('faculty_performance/report/self_report', $this->view_params);
                } else {

                    if ($user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                        $filters['program_id'] = $user->get_program_id();
                    }
                    if ($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
                        $filters['college_id'] = $user->get_college_id();
                    }
                    $result = Orm_Fp_Forms_Result::get_all();
                    $arrIds = [];

                    foreach ($result as $val) {
                        array_push($arrIds, $val->get_user_id());
                    }

                    $filters['user_id_in'] = $arrIds;
                    $pager->set_total_count(Orm_User_Faculty::get_count($filters));
                    $this->view_params['pager'] = $pager->render(true);
                    $this->view_params['facilities'] = Orm_User_Faculty::get_all($filters, $page, $per_page);
                    $this->layout->view('faculty_performance/report/faculty_report', $this->view_params);
                }
        }

    }


    /**
     * show all data for programs depends on logged user
     * @return object|string
     */
    private function get_program_list()
    {

        $user = Orm_User::get_logged_user();

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');


        if (!$page) {
            $page = 1;
        }
        $filters = array();

        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }
        if (!empty($fltr['department_id'])) {
            $filters['department_id'] = (int)$fltr['department_id'];
        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if ($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {

            $filters['college_id'] = $user->get_college_id();
        }

        if ($user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['id'] = $user->get_program_id();
        }


        $program = Orm_Program::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Program::get_count($filters));

        $this->view_params['form_types'] = Orm_Fp_Forms_Type::get_all();
        $this->view_params['programs'] = $program;
        $this->view_params['deadline'] = $this->deadline;
        $this->view_params['fltr'] = $fltr;
        $this->view_params['pager'] = $pager->render(true);
    }

    /**
     * show the report of all programs
     * @return object|string
     */
    public function program_report()
    {

        $this->breadcrumbs->push(lang('Program Report'), '/faculty_performance/faculty_report/program_report');

        $user_id = (int)$this->input->get_post('user_id');

        $this->view_params['menu_tab'] = 'program_report';
        $this->view_params['sub_menu'] = 'faculty_performance/report/sub_menu';
        $this->view_params['type_id'] = 4;
        $this->view_params['user_id'] = $user_id;
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance Report'),
            'icon' => 'fa fa-th',
        ), true);

        $this->get_program_list();

        $this->layout->view('faculty_performance/report/program_report', $this->view_params);
    }


    /**
     * get specific view depends on data that send Ajax or not
     */
    public function program_filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_program_list();
            $this->load->view('faculty_performance/report/program_data_table', $this->view_params);
        } else {
            $this->program_report();
        }
    }


    /**
     * collect departments data that are needed
     *@return object|string
     */
    private function get_department_list()
    {

        $user = Orm_User::get_logged_user();

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');


        if (!$page) {
            $page = 1;
        }
        $filters = array();

        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if ($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {

            $filters['college_id'] = $user->get_college_id();
        }

        $department = Orm_Department::get_all($filters, $page, $per_page);


        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Department::get_count($filters));

        $this->view_params['departments'] = $department;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['form_types'] = Orm_Fp_Forms_Type::get_all();
        $this->view_params['deadline'] = $this->deadline;
        $this->view_params['fltr'] = $fltr;
    }

    /**
     * show all departments that can appear for user depends on the logged user role
     */
    public function department_report()
    {

        $this->breadcrumbs->push(lang('Department Report'), '/faculty_performance/faculty_report/department_report');

        $user_id = (int)$this->input->get_post('user_id');

        $this->view_params['menu_tab'] = 'department_report';
        $this->view_params['sub_menu'] = 'faculty_performance/report/sub_menu';
        $this->view_params['type_id'] = 1;
        $this->view_params['user_id'] = $user_id;
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance Report'),
            'icon' => 'fa fa-th',
        ), true);

        $this->get_department_list();

        $this->layout->view('faculty_performance/report/department_report', $this->view_params);
    }


    /**
     *get specific view depends on data that send Ajax or not
     */
    public function department_filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_department_list();
            $this->load->view('faculty_performance/report/department_data_table', $this->view_params);
        } else {
            $this->department_report();
        }
    }


    /**
     * get and prepare the data of colleges that will appear in view
     * @return object|string
     */
    private function get_college_list()
    {

        $user = Orm_User::get_logged_user();

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');


        if (!$page) {
            $page = 1;
        }
        $filters = array();
        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if ($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {

            $filters['id'] = $user->get_college_id();
        }

        $college = Orm_College::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_College::get_count($filters));
        $this->view_params['pager'] = $pager->render(true);

        $this->view_params['colleges'] = $college;
        $this->view_params['form_types'] = Orm_Fp_Forms_Type::get_all();
        $this->view_params['deadline'] = $this->deadline;
        $this->view_params['fltr'] = $fltr;
    }

    /**
     * get all colleges information and data depends on logged user role
     * @return object|string
     */
    public function college_report()
    {

        $this->breadcrumbs->push(lang('College Report'), '/faculty_performance/faculty_report/college_report');

        $user_id = (int)$this->input->get_post('user_id');

        $this->view_params['menu_tab'] = 'college_report';
        $this->view_params['sub_menu'] = 'faculty_performance/report/sub_menu';
        $this->view_params['type_id'] = 2;
        $this->view_params['user_id'] = $user_id;
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance Report'),
            'icon' => 'fa fa-th',
        ), true);

        $this->get_college_list();

        $this->layout->view('faculty_performance/report/college_report', $this->view_params);
    }


    /**
     *get specific view depends on data that send Ajax or not
     */
    public function college_filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_college_list();
            $this->load->view('faculty_performance/report/college_data_table', $this->view_params);
        } else {
            $this->college_report();
        }
    }


    /**
     * general report for user will get all information that inserted by user and on specific deadline  sa a charts
     * @return object|string
     */
    public function summaryReport()
    {
        $types = Orm_Fp_Forms_Type::get_all(['deadline' => $this->deadline, 'deleted_at' => 0]);
        $user_id = $this->input->get_post('user_id');
        $user = Orm_User_Faculty::get_instance($user_id);

        //faculty report
        $data = [];
        array_push(
            $data,
            [
                lang('Criterion'),
                lang('Criteria Rate'),
                $user->get_full_name() . ' ' . lang('Score'),

            ]
        );

        $is_data = false;

        /** @var Orm_Fp_Forms_Type $type */
        foreach ($types as $type) {
            $is_data = true;
            /** @var Orm_Fp_Forms_Evaluations $evaluation */
            $evaluation = Orm_Fp_Forms_Evaluations::get_one(['deadline_id' => $this->deadline, 'type_id' => $type->get_id(), 'user_id' => $user_id]);

            array_push($data, [
                $type->get_name(),
                (float)$type->get_rate($this->deadline),
                (float)$evaluation->get_value(),
            ]);
        }

        if ($is_data == false) {
            foreach ($types as $type) {
                array_push($data, [$type->get_name(), 0, (float)$type->get_rate($this->deadline)]);

            }
        }

        if (count($data) == 1) {
            foreach ($types as $type) {
                array_push($data, [$type->get_name(), 0]);
            }
        }

        //program report
        $program_report[] = [
            lang('Criterion'),
            lang('Criteria Rate'),
            $user->get_program_obj()->get_name(),
        ];

        foreach ($types as $type) {
            $avg = Orm_Fp_Forms_Evaluations::get_avg('program_id', $user->get_program_obj()->get_id(), $type->get_id(), $this->deadline);

            $program_report[] = [
                $type->get_name(),
                (float)$type->get_rate($this->deadline),
                (float)$avg,
            ];
        };
        //department report
        $department_report[] = [
            lang('Criterion'),
            lang('Criteria Rate'),
            $user->get_department_obj()->get_name(),
        ];

        foreach ($types as $type) {
            $avg2 = Orm_Fp_Forms_Evaluations::get_avg('department_id', $user->get_department_obj()->get_id(), $type->get_id(), $this->deadline);
            $department_report[] = [
                $type->get_name(),
                (float)$type->get_rate($this->deadline),
                (float)$avg2,
            ];
        };
        //college report

        $college_report [] = [
            lang('Criterion'),
            lang('Criteria Rate'),
            $user->get_college_obj()->get_name(),
        ];

        foreach ($types as $type) {
            $avg3 = Orm_Fp_Forms_Evaluations::get_avg('college_id', $user->get_college_obj()->get_id(), $type->get_id(), $this->deadline);
            $college_report[] = [
                $type->get_name(),
                (float)$type->get_rate($this->deadline),
                (float)$avg3,
            ];
        };

        //university report
        $university = Orm_Institution::get_instance();

        $university_report [] = [
            lang('Criterion'),
            lang('Criteria Rate'),
            $university->get_name(),
        ];

        foreach ($types as $type) {
            $avg4 = Orm_Fp_Forms_Evaluations::get_avg('', '', $type->get_id(), $this->deadline);
            $university_report[] = [
                $type->get_name(),
                (float)$type->get_rate($this->deadline),
                (float)$avg4,
            ];
        };

        json_response(
            [
                'common' => ['performance' => lang('Performance'), 'type' => lang('Criteria'), 'countTypes' => count($types)],
                'faculty' => ['data' => $data, 'title' => lang('Faculty performance')],
                'department' => ['data' => $department_report, 'title' => lang('Department performance')],
                'program' => ['data' => $program_report, 'title' => lang('Program performance')],
                'college' => ['data' => $college_report, 'title' => lang('College performance')],
                'university' => ['data' => $university_report, 'title' => lang('University performance')]
            ]
        );
    }

    /**
     * Save the recommendations and rate for each report type (faculty , program ....etc)
     */
    public function save()
    {
        $re_id = (int)$this->input->post('re_id');
        $user_id = (int)$this->input->post('user_id');
        $rate = (array)$this->input->post('rate');
        $recommendation_en = $this->input->post('recommendation_en');
        $recommendation_ar = $this->input->post('recommendation_ar');
        $action_ar = $this->input->post('action_ar');
        $action_en = $this->input->post('action_en');

        $reco = Orm_Fp_Forms_Recommendation::get_instance($re_id);
        $reco->set_recommendation_en($recommendation_en);
        $reco->set_recommendation_ar($recommendation_ar);
        $reco->set_action_en($action_en);
        $reco->set_action_ar($action_ar);
        $reco->set_category_id($user_id);
        $reco->set_type_id(0);
        $reco->set_deadline_id($this->deadline);

        foreach ($rate as $value => $key) {

            Orm_Fp_Forms_Evaluations::compare_rate_values($value, $key["value"], $this->deadline);

        }
        if (Validator::success()) {
            foreach ($rate as $value => $key) {
                $eva = Orm_Fp_Forms_Evaluations::get_instance((int)$key["id"]);
                $eva->set_value($key["value"]);
                $eva->set_user_id($user_id);
                $eva->set_type_id($value);
                $eva->set_deadline_id($this->deadline);
                $eva->save();
            }

            $reco->save();

            Validator::set_success_flash_message(lang('Successfully Saved'), true);
            json_response(['success' => true]);
        }
        json_response(['success' => false, 'html' => Validator::get_error_message('rate')]);


    }

    /**
     * set recommendation and updates on reports with different types (faculty, program, college ..etc)
     * @param $category_id => id of the on of th following ( program id , faculty user id , college id )
     * @param $type => type of report ( faculty report , college report, program report)
     */
    public function edit_recommendation($category_id, $type)
    {

        $obj = Orm_Fp_Forms_Recommendation::get_recmmedation_by_values($category_id, $type, $this->deadline);
        $this->view_params['recommendation'] = $obj;
        $this->view_params['type_id'] = $type;
        $this->view_params['category_id'] = $category_id;
        $this->load->view('faculty_performance/report/edit_recommendation', $this->view_params);

    }

    /**
     * save recommendation after adding or updates for every type of reports
     * @redirect success or error message
     */
    public function save_recommendation()
    {
        $id = (int)$this->input->post('id');
        $category_id = (int)$this->input->post('category_id');
        $type_id = (int)$this->input->post('type_id');
        $recommendation_en = $this->input->post('recommendation_en');
        $recommendation_ar = $this->input->post('recommendation_ar');
        $action_en = $this->input->post('action_en');
        $action_ar = $this->input->post('action_ar');


        $recommendation = Orm_Fp_Forms_Recommendation::get_instance($id);
        $recommendation->set_type_id($type_id);
        $recommendation->set_category_id($category_id);
        $recommendation->set_deadline_id($this->deadline);
        $recommendation->set_recommendation_en($recommendation_en);
        $recommendation->set_recommendation_ar($recommendation_ar);
        $recommendation->set_action_en($action_en);
        $recommendation->set_action_ar($action_ar);
        $recommendation->save();
        Validator::set_success_flash_message(lang('Successfully Saved'), true);

        if ($this->input->is_ajax_request()) {
            json_response(['success' => true]);
        } else {
            redirect('faculty_performance/faculty_report?type_id=3');
        }

    }

    /**
     * get report for ome faculty and set all data on
     * @param $user_id
     */
    public function getReport($user_id)
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance From'),
            'icon' => 'fa fa-file-pdf-o',
            'link_attr' => 'href="/faculty_performance/faculty_report/generate_pdf/' . $user_id . '"',
            'link_title' => lang('Generate PDF')
        ), true);

        $type = Orm_Fp_Forms_Type::get_all(['deadline_id' => $this->deadline]);
        $recommendation = Orm_Fp_Forms_Recommendation::get_recmmedation_by_values($user_id, 0, $this->deadline);
        $evaluation = Orm_Fp_Forms_Evaluations::get_all(['user_id' => $user_id, 'deadline_id' => $this->deadline]);
        $faculty = Orm_User_Faculty::get_instance($user_id);

        $this->view_params['types'] = $type;
        $this->view_params['recommendations'] = $recommendation;
        $this->view_params['faculty'] = $faculty;
        $this->view_params['evaluations'] = $evaluation;
        $this->view_params['user_id'] = $user_id;
        $this->view_params['deadline'] = $this->deadline;
        $this->view_params['menu_tab'] = 'faculty_report';

        $this->layout->view('faculty_performance/report/all_report', $this->view_params);
    }

    /**
     * convert the data in reports to pdf file
     * @param $user_id
     */
    public function generate_pdf($user_id)
    {
        $faculty = Orm_User_Faculty::get_instance($user_id);

        if ($faculty->get_id() == 0) {
            redirect('faculty_performance/faculty_report');
        } else {
            $report = new  Orm_Fp_Forms_Evaluations();
            $report->generate_pdf($user_id, $this->deadline);
        }
    }

}
