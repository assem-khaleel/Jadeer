<?php

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Course Evaluation
 */
class Course_evaluation extends MX_Controller
{

    private $view_params;
    private $course_id;

    /**
     * Course_evaluation constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->course_id = $this->input->get('id');

        if(intval($this->course_id) ==0) {
            Validator::set_error_flash_message(lang('Course not found'));
            redirect('/portfolio_course');
        }

        Orm_User::check_logged_in();
        if (!License::get_instance()->check_module('portfolio_course', true)) {
            show_404();
        }

        $this->breadcrumbs->push(lang('Portfolio Course'), '/portfolio_course');
        $this->breadcrumbs->push(lang('Evaluation Management'), '/portfolio_course/course_evaluation');

        $this->layout->add_javascript('https://www.google.com/jsapi', false);


    $this->view_params['menu_tab'] = 'portfolio_course';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Portfolio') . ' - ' . htmlfilter(Orm_Course::get_instance($this->course_id)->get_name()),
            'icon' => 'fa fa-book',
            'menu_view' => 'portfolio_course/sub_menu',
            'menu_params' => array('type' => 'course_evaluation', 'id' => $this->input->get('id'))
        ), true);

        $this->view_params['id'] = $this->course_id;
    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        Orm_User::get_logged_user()->get_filters($fltr);

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

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

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['course_id'] = $this->course_id;
        $this->layout->view('portfolio_course/course_evaluation/course_evaluation', $this->view_params);
    }

}