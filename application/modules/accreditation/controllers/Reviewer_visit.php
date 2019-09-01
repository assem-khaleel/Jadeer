<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . 'modules' . DIRECTORY_SEPARATOR . 'accreditation' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'Reviewer.php';

/**
 * Created by PhpStorm.
 * User: ali
 * Date: 06/04/17
 * Time: 02:40 م
 */

/**
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property Layout $layout
 * @property Breadcrumbs $breadcrumbs
 * Class Reviewer_Visit
 */
class Reviewer_Visit extends Reviewer
{

    public function __construct() {
        parent::__construct();

        $this->load->helper('text_helper');
        $this->page_header('visit');

        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');

        if (!($this->is_admin || Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION) || Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_PROGRAM))){
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }

        $this->view_params['sub_menu'] = 'reviewer/visit/sub_menu';
    }

    public function index() {

        if($this->is_admin || Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION)) {
            $this->institution();
        } elseif (Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_PROGRAM)) {
            $this->program();
        } else {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }

    }

    public function institution() {

        if(!$this->is_admin && !Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION)) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }

        $this->get_reviewer_list(Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION);
        $this->get_recommendation_list(Orm_Acc_Visit_Reviewer_Recommendation::TYPE_INSTITUTION);

        $this->breadcrumbs->push(lang('Visit Reviewer'), '/accreditation/reviewer_visit');
        $this->breadcrumbs->push(lang('Institution'), '/accreditation/reviewer_visit/institution');

        $this->view_params['active_sub_menu'] = Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION;
        $this->layout->view("reviewer/visit/institution/index", $this->view_params);
    }

    public function program() {

        if(!$this->is_admin && !Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_PROGRAM)) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }

        $this->get_list_programs();

        $this->breadcrumbs->push(lang('Visit Reviewer'), '/accreditation/reviewer_visit');
        $this->breadcrumbs->push(lang('Programs'), '/accreditation/reviewer_visit/program');

        $this->view_params['active_sub_menu'] = Orm_Acc_Visit_Reviewer::TYPE_PROGRAM;
        $this->layout->view("reviewer/visit/program/index", $this->view_params);
    }

    public function filter_program() {

        if(!$this->is_admin && !Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_PROGRAM)) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }

        if ($this->input->is_ajax_request()) {
            $this->get_list_programs();
            $this->load->view('reviewer/visit/program/data_table', $this->view_params);
        } else {
            $this->program();
        }
    }


    private function get_list_programs() {

        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['campus_id'])) {
            $filters['campus_id'] = intval($fltr['campus_id']);
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = intval($fltr['college_id']);
        }
        if (!empty($fltr['department_id'])) {
            $filters['department_id'] = intval($fltr['department_id']);
        }
        if (!empty($fltr['program_id'])) {
            $filters['id'] = intval($fltr['program_id']);
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if(!$this->is_admin && Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_PROGRAM)) {
            $filters['in_id'] = Orm_Acc_Visit_Reviewer::get_reviewer_program_ids();
        }

        $programs = Orm_Program::get_all($filters, $page, $per_page, array('p.department_id ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_program::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['programs'] = $programs;
        $this->view_params['fltr'] = $fltr;
    }


    public function reviewer_add($type, $type_id = 0, $id = 0)
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!$this->is_admin) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/accreditation/reviewer";</script>');
        }

        if (!in_array($type, [Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION, Orm_Acc_Visit_Reviewer::TYPE_PROGRAM])) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            exit('<script>location.href="/accreditation/reviewer";</script>');
        }

        $reviewer = Orm_Acc_Visit_Reviewer::get_instance($id);

        $reviewer->set_type($type);
        $reviewer->set_type_id($type_id);

        if($this->input->method() == 'post') {
            $reviewer_id = $this->input->post('reviewer_id');

            Validator::required_field_validator('reviewer_id', $reviewer_id, lang('Please select Reviewer'));

            if(Orm_Acc_Visit_Reviewer::get_one(['type' => $type, 'type_id' => $type_id, 'reviewer_id' => $reviewer_id])->get_id()) {
                Validator::set_error('reviewer_id', lang('Reviewer already selected'));
            }

            $reviewer->set_reviewer_id($reviewer_id);

            if(Validator::success()) {
                $reviewer->save();

                if ($type == Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION) {
                    exit('<script>location.href="/accreditation/reviewer_visit/' . $type . '";</script>');
                } else {
                    exit('<script>location.href="/accreditation/reviewer_visit/reviewer_list/program/' . $type_id . '";</script>');
                }
            }
        }

        $this->view_params['visit_reviewer'] = $reviewer;

        $this->load->view('reviewer/visit/reviewer_add', $this->view_params);
    }



    private function get_reviewer_list($type, $type_id = 0) {
        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));

        if (!$page) {
            $page = 1;
        }

        $filters = ['type' => $type, 'type_id' => $type_id];

        $reviewers = Orm_Acc_Visit_Reviewer::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Acc_Visit_Reviewer::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['reviewers'] = $reviewers;
        $this->view_params['type'] = $type;
        $this->view_params['type_id'] = $type_id;
    }



    public function reviewer_list($type, $type_id = 0)
    {
        if (!in_array($type, [Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION, Orm_Acc_Visit_Reviewer::TYPE_PROGRAM])) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            exit('<script>location.href="/accreditation/reviewer";</script>');
        }

        if (!$this->is_admin) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/accreditation/reviewer";</script>');
        }

        $this->get_reviewer_list($type, $type_id);

        $this->breadcrumbs->push(lang('Visit Reviewer'), '/accreditation/reviewer_visit');
        $this->breadcrumbs->push(lang('Programs'), '/accreditation/reviewer_visit/program');
        $this->breadcrumbs->push(lang('Reviewers List').' '.lang('for').' '.Orm_Program::get_instance($type_id)->get_name(), '/accreditation/reviewer_visit/reviewer_list/institution');

        $this->view_params['active_sub_menu'] = $type;
        $this->layout->view("reviewer/visit/reviewer_list", $this->view_params);
    }


    public function reviewer_delete($id) {

        if (!$this->is_admin) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }

        $reviewer = Orm_Acc_Visit_Reviewer::get_instance($id);

        if (!$reviewer->get_id()) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            redirect('/accreditation/reviewer');
        }

        $reviewer->delete();

        Validator::set_success_flash_message(lang('Deleted Successfully'));

        if ($reviewer->get_type() == Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION) {
            redirect("/accreditation/reviewer_visit/{$reviewer->get_type()}");
        } else {
            redirect("/accreditation/reviewer_visit/reviewer_list/program/{$reviewer->get_type_id()}");
        }

    }

    private function get_recommendation_list($type, $type_id = 0) {
        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));

        if (!$page) {
            $page = 1;
        }

        $filters = [
            'type' => $type,
            'type_id' => $type_id
        ];

        if(!$this->is_admin && Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_PROGRAM)) {
            $filters['reviewer_id'] = Orm_User::get_logged_user_id();
        }

        $recommendations = Orm_Acc_Visit_Reviewer_Recommendation::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Acc_Visit_Reviewer_Recommendation::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['recommendations'] = $recommendations;
        $this->view_params['type'] = $type;
        $this->view_params['type_id'] = $type_id;
    }

    public function recommendation_list($type, $type_id = 0)
    {
        if(!$this->is_admin && !Orm_Acc_Visit_Reviewer::can_manege($type, $type_id)) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }

        if (!in_array($type, [Orm_Acc_Visit_Reviewer_Recommendation::TYPE_INSTITUTION, Orm_Acc_Visit_Reviewer_Recommendation::TYPE_PROGRAM])) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            exit('<script>location.href="/accreditation/reviewer";</script>');
        }

        $this->get_recommendation_list($type, $type_id);

        $this->breadcrumbs->push(lang('Visit Reviewer'), '/accreditation/reviewer_visit');
        $this->breadcrumbs->push(lang('Programs'), '/accreditation/reviewer_visit/program');
        $this->breadcrumbs->push(lang('Recommendation List').' '.lang('for').' '.Orm_Program::get_instance($type_id)->get_name(), '/accreditation/reviewer_visit/recommendation_list/program');

        $this->view_params['active_sub_menu'] = $type;
        $this->layout->view("reviewer/visit/recommendation_list", $this->view_params);
    }

    public function recommendation_view($id){

        $recommendation = Orm_Acc_Visit_Reviewer_Recommendation::get_instance($id);

        if (!$recommendation->get_id()) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            redirect('/accreditation/reviewer');
        }

        $visit_reviewer = $recommendation->get_visit_reviewer_obj();

        if(!$this->is_admin && !Orm_Acc_Visit_Reviewer::can_manege($visit_reviewer->get_type(), $visit_reviewer->get_type_id())) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }

        $this->view_params['recommendation'] = lang('There is no').' '.lang('Recommendation');

        if($recommendation->get_id()){
            $this->view_params['recommendation'] = $recommendation->get_recommendation();
        }

        $this->load->view('reviewer/visit/recommendation_view', $this->view_params);
    }


    public function recommendation_add_edit($type, $type_id = 0, $id = 0){

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if(!Orm_Acc_Visit_Reviewer::can_manege($type, $type_id)) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }

        if (!in_array($type, [Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION, Orm_Acc_Visit_Reviewer::TYPE_PROGRAM])) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            exit('<script>location.href="/accreditation/reviewer";</script>');
        }

        $reviewer = Orm_Acc_Visit_Reviewer::get_one(['type' => $type, 'type_id' => $type_id, 'reviewer_id' => Orm_User::get_logged_user_id()]);

        if (!$reviewer->get_id()) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            exit('<script>location.href="/accreditation/reviewer";</script>');
        }

        $recommendation = Orm_Acc_Visit_Reviewer_Recommendation::get_instance($id);

        if($this->input->method() == 'post') {
            $recommendation_text = $this->input->post('recommendation');

            Validator::required_field_validator('recommendation', $recommendation_text, lang('Please select Reviewer'));

            $recommendation->set_recommendation($recommendation_text);

            if(Validator::success()) {

                $recommendation->set_visit_reviewer_id($reviewer->get_id());
                $recommendation->set_reviewer_id($reviewer->get_reviewer_id());
                $recommendation->set_type($type);
                $recommendation->set_type_id($type_id);

                $recommendation->save();

                if ($type == Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION) {
                    exit('<script>location.href="/accreditation/reviewer_visit/' . $type . '";</script>');
                } else {
                    exit('<script>location.href="/accreditation/reviewer_visit/recommendation_list/program/' . $type_id . '";</script>');
                }

            }
        }

        $this->view_params['visit_reviewer'] = $reviewer;
        $this->view_params['recommendation'] = $recommendation;

        $this->load->view('reviewer/visit/recommendation_add', $this->view_params);
    }

    public function recommendation_delete($id){

        $recommendation = Orm_Acc_Visit_Reviewer_Recommendation::get_instance($id);

        if (!$recommendation->get_id()) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            redirect('/accreditation/reviewer');
        }

        $visit_reviewer = $recommendation->get_visit_reviewer_obj();

        if(!Orm_Acc_Visit_Reviewer::can_manege($visit_reviewer->get_type(), $visit_reviewer->get_type_id())) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }

        $recommendation->delete();

        Validator::set_success_flash_message(lang('Deleted Successfully'));

        if ($visit_reviewer->get_type() == Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION) {
            redirect("/accreditation/reviewer_visit/{$visit_reviewer->get_type()}");
        } else {
            redirect("/accreditation/reviewer_visit/recommendation_list/program/{$visit_reviewer->get_type_id()}");
        }
    }


    public function action_list($type, $type_id, $recommendation_id=0)
    {

        if (!in_array($type, [Orm_Acc_Visit_Reviewer_Action_Plan::TYPE_INSTITUTION, Orm_Acc_Visit_Reviewer_Action_Plan::TYPE_PROGRAM])) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            exit('<script>location.href="/accreditation/reviewer";</script>');
        }

        $this->get_action_list($type, $type_id, $recommendation_id);

        $this->breadcrumbs->push(lang('Visit Reviewer'), '/accreditation/reviewer_visit');
        $this->breadcrumbs->push(lang($type=='program'? 'programs': $type), '/accreditation/reviewer_visit/'.$type);

        if($type == Orm_Acc_Visit_Reviewer_Action_Plan::TYPE_PROGRAM) {
            $this->breadcrumbs->push(lang('Recommendation List').' '.lang('for').' '.Orm_Program::get_instance($type_id)->get_name(), "/accreditation/reviewer_visit/recommendation_list/program/".$type_id);
        }
        $this->breadcrumbs->push(lang('Action List'), '/accreditation/reviewer_visit/action_list/'.$type);

        $this->view_params['active_sub_menu'] = $type;
        $this->layout->view("reviewer/visit/action_list", $this->view_params);
    }

    private function get_action_list($type, $type_id, $recommendation_id=0) {
        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        if ($recommendation_id != 0)
            $filters = ['recommendation_id' => $recommendation_id];

        $action_plans = Orm_Acc_Visit_Reviewer_Action_Plan::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Acc_Visit_Reviewer_Action_Plan::get_count($filters));
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['action_plans'] = $action_plans;
        $this->view_params['type'] = $type;
        $this->view_params['type_id'] = $type_id;
        $this->view_params['recommendation_id'] = $recommendation_id;

    }

    public function action_view($id){
        $action_plan = Orm_Acc_Visit_Reviewer_Action_Plan::get_instance($id);
        $this->view_params['action_plan'] = lang('There is no').' '.lang('Action plans');
        if($action_plan->get_id()){
            $this->view_params['action_plan'] = $action_plan->get_description();
        }

        $this->load->view('reviewer/visit/action_view', $this->view_params);
    }

    public function action_add_edit($type, $type_id, $recommendation_id, $id = 0)
    {
        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        if (!in_array($type, [Orm_Acc_Visit_Reviewer_Action_Plan::TYPE_INSTITUTION, Orm_Acc_Visit_Reviewer_Action_Plan::TYPE_PROGRAM])) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            exit('<script>location.href="/accreditation/reviewer";</script>');
        }

        if (!$this->is_admin) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/accreditation/reviewer";</script>');
        }

        $recommendation = Orm_Acc_Visit_Reviewer_Recommendation::get_instance($recommendation_id);

        if (!$recommendation->get_id()) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            exit('<script>location.href="/accreditation/reviewer";</script>');
        }

        $action_plan = Orm_Acc_Visit_Reviewer_Action_Plan::get_instance($id);

        if($this->input->method() == 'post') {

            $description= $this->input->post('description');
            $due_date = $this->input->post('due_date');
            $responsible = $this->input->post('responsible');
            $progress = $this->input->post('progress');

            Validator::required_field_validator('description', $description, lang('Please fill description field'));
            Validator::required_field_validator('due_date', $due_date, lang('Please select due date'));
            Validator::required_field_validator('responsible', $responsible, lang('Please select responsible'));
            Validator::required_field_validator('progress', $progress, lang('Please fill progress field'));
            Validator::integer_field_validator('progress', $progress, lang('Only integer value is allowed'));
            Validator::less_than_validator('progress', 100, $progress, lang('Progress must be equal or less than 100'));
            Validator::greater_than_validator('progress', 0, $progress,lang('Progress must be equal or greater than zero'));

            $action_plan->set_description($description);
            $action_plan->set_due_date($due_date);
            $action_plan->set_responsible($responsible);
            $action_plan->set_progress($progress);
            $action_plan->set_recommendation_id($recommendation_id);

            if (Validator::success()) {
                $action_plan->save();
                exit('<script>location.href="/accreditation/reviewer_visit/action_list/' . $type . '/' . $type_id . '/' . $recommendation_id . '";</script>');
            }
        }

        $this->view_params['action_plan'] = $action_plan;
        $this->view_params['type'] = $type;
        $this->view_params['type_id'] = $type_id;
        $this->view_params['recommendation_id'] = $recommendation_id;
        $this->view_params['recommendation'] = $recommendation;

        $this->load->view('reviewer/visit/action_add', $this->view_params);
    }

    public function action_delete($id) {

        $action_plan = Orm_Acc_Visit_Reviewer_Action_Plan::get_instance($id);

        if (!$action_plan->get_id()) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            redirect('/accreditation/reviewer');
        }

        if (!$this->is_admin) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            redirect('/accreditation/reviewer');
        }

        $action_plan->delete();

        $recommendation = $action_plan->get_recommendation_obj();

        Validator::set_success_flash_message(lang('Deleted Successfully'));
        redirect("/accreditation/reviewer_visit/action_list/{$recommendation->get_type()}/{$recommendation->get_type_id()}/{$recommendation->get_id()}");

    }

    public function report($type, $type_id = 0, $details = false){

        if (!($this->is_admin || Orm_Acc_Visit_Reviewer::can_manege($type, $type_id))) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }

        if (!in_array($type, [Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION, Orm_Acc_Visit_Reviewer::TYPE_PROGRAM])) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            redirect('/accreditation/reviewer');
        }

        $this->breadcrumbs->push(lang('Visit Reviewer'), '/accreditation/reviewer_visit');
        $this->breadcrumbs->push(lang($type), '/accreditation/reviewer_visit/'.$type);

        if($type == Orm_Acc_Visit_Reviewer::TYPE_PROGRAM) {
            if($details){
                $this->breadcrumbs->push(lang('Report Details').' '.lang('for').' '.Orm_Program::get_instance($type_id)->get_name(), "/accreditation/reviewer_visit/report/program/".$type_id);
            } else {
                $this->breadcrumbs->push(lang('Report').' '.lang('for').' '.Orm_Program::get_instance($type_id)->get_name(), "/accreditation/reviewer_visit/report/program/".$type_id);
            }
        } else {
            if($details){
                $this->breadcrumbs->push(lang('Report Details'), '/accreditation/reviewer_visit/report/' . $type);
            } else {
                $this->breadcrumbs->push(lang('Report'), '/accreditation/reviewer_visit/report/' . $type);
            }
        }

        $this->view_params['type'] = $type;
        $this->view_params['type_id'] = $type_id;
        $this->view_params['details'] = $details;
        $this->view_params['active_sub_menu'] = $type;

        $this->layout->view("reviewer/visit/report", $this->view_params);
    }
}