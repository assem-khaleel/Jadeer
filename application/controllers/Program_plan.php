<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Output $output
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Config $config
 * Class Program_Plan
 */
class Program_Plan extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();
    private $program = NULL;

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();

        $program_id = (int)$this->input->get_post('program_id');

        $this->program = Orm_Program::get_instance($program_id);

        if (!$this->program->get_id()) {
            Validator::set_error_flash_message(lang('Error: Please try again'));
            redirect('/program');
        }

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'program';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['program'] = $this->program;
    }

    private function get_list()
    {

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array('program_id' => $this->program->get_id());
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $plans = Orm_Program_Plan::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Program_Plan::get_count($filters));


        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['plans'] = $plans;
        $this->view_params['fltr'] = $fltr;
    }

    public function index()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-program_plan');
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program Plan') . ' : ' . htmlfilter($this->program->get_name()),
            'icon' => 'fa fa-gears',
            'link_attr' => 'href="/program_plan/create?program_id= ' . $this->program->get_id() . '"',
             'link_icon' => 'plus',
            'link_title' => lang('Add').' '.lang('Program Plan')
        ), true);

        $this->get_list();

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Programs'), '/program');
        $this->breadcrumbs->push(htmlfilter($this->program->get_name()), '/program_plan?program_id=' . $this->program->get_id());

        $this->layout->view('/program_plan/list', $this->view_params);
    }

    public function filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('/program_plan/data_table', $this->view_params);
        } else {
            $this->index();
        }
    }

    public function create()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-program_plan');
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program Plan') . ' : ' . htmlfilter($this->program->get_name()),
            'icon' => 'fa fa-gears'
        ), true);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Programs'), '/program');
        $this->breadcrumbs->push(htmlfilter($this->program->get_name()), '/program_plan?program_id=' . $this->program->get_id());
        $this->breadcrumbs->push(lang('Add').' '.lang('Course'), '/program_plan/create');

        $this->view_params['plan'] = new Orm_Program_Plan();
        $this->layout->view('/program_plan/create_edit', $this->view_params);
    }

    public function save()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-program_plan');
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program Plan') . ' : ' . htmlfilter($this->program->get_name()),
            'icon' => 'fa fa-gears'
        ), true);

        $id = $this->input->post('id');
        $course_id = $this->input->post('course_id');
        $level = $this->input->post('level');
        $credit_hours = $this->input->post('credit_hours');
        $is_required = $this->input->post('is_required');

        Validator::not_empty_field_validator('course_id', $course_id, lang('Please Select Course'));
        Validator::not_empty_field_validator('level', $level, lang('Please Select Level'));
        Validator::not_empty_field_validator('credit_hours', $credit_hours, lang('Credit Hours is Required'));

        $plan_obj = Orm_Program_Plan::get_instance($id);
        $plan_obj->set_program_id($this->program->get_id());
        $plan_obj->set_course_id($course_id);
        $plan_obj->set_credit_hours($credit_hours);
        $plan_obj->set_is_required($is_required);
        $plan_obj->set_level($level);

        if (Validator::success()) {
            $plan_obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/program_plan?program_id=' . $this->program->get_id());
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Programs'), '/program');
        $this->breadcrumbs->push($this->program->get_name(), '/program_plan?program_id=' . $this->program->get_id());

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program Plan') . ' : ' . htmlfilter($this->program->get_name()),
            'icon' => 'fa fa-gears'
        ), true);

        $this->view_params['plan'] = $plan_obj;
        $this->layout->view('/program_plan/create_edit', $this->view_params);
    }

    public function edit($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-program_plan');
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program Plan') . ' : ' . htmlfilter($this->program->get_name()),
            'icon' => 'fa fa-gears'
        ), true);

        $plan = Orm_Program_Plan::get_instance($id);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Programs'), '/program');
        $this->breadcrumbs->push($this->program->get_name(), '/program_plan?program_id=' . $this->program->get_id());
        $this->breadcrumbs->push(lang('Edit').' '.lang('Course'), '/plan/edit/' . $id);

        $this->view_params['plan'] = $plan;
        $this->layout->view('/program_plan/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-program_plan');
        $obj = Orm_Program_Plan::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/program_plan');
    }

}
