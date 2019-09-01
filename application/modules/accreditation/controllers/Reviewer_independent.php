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
 * @property Layout $layout
 * Class Reviewer_Independent
 */
class Reviewer_Independent extends Reviewer
{

    public function __construct() {
        parent::__construct();

        $this->page_header('independent');

        $this->view_params['sub_menu'] = 'reviewer/independent/sub_menu';

        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');
        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
    }

    public function index() {
        if($this->is_admin || Orm_Acc_Independent_Reviewer::can_manege(Orm_Acc_Independent_Reviewer::TYPE_INSTITUTION)) {
            $this->institution();
        } elseif (Orm_Acc_Independent_Reviewer::can_manege(Orm_Acc_Independent_Reviewer::TYPE_PROGRAM)) {
            $this->program();
        } else {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/accreditation/reviewer');
        }
    }

    public function institution(){
        $this->get_reviewer_list(Orm_Acc_Independent_Reviewer::TYPE_INSTITUTION);

        $this->breadcrumbs->push(lang('Independent Reviewer'), '/accreditation/reviewer_independent');
        $this->breadcrumbs->push(lang('Institution'), '/accreditation/reviewer_independent/institution');

        $this->view_params['active_sub_menu'] = Orm_Acc_Independent_Reviewer::TYPE_INSTITUTION;
        $this->layout->view("reviewer/independent/institution/index", $this->view_params);
    }

    public function program(){
        $this->get_list_programs();

        $this->breadcrumbs->push(lang('Independent Reviewer'), '/accreditation/reviewer_independent');
        $this->breadcrumbs->push(lang('Programs'), '/accreditation/reviewer_independent/program');

        $this->view_params['active_sub_menu'] = Orm_Acc_Independent_Reviewer::TYPE_PROGRAM;
        $this->layout->view("reviewer/independent/program/index", $this->view_params);
    }

    public function filter_program() {
        if ($this->input->is_ajax_request()) {
            $this->get_list_programs();
            $this->load->view('reviewer/independent/program/data_table', $this->view_params);
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

        if(!$this->is_admin && Orm_Acc_Independent_Reviewer::can_manege(Orm_Acc_Independent_Reviewer::TYPE_PROGRAM)) {
            $filters['in_id'] = Orm_Acc_Independent_Reviewer::get_reviewer_program_ids();
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

    public function reviewer_add_edit($type, $type_id = 0, $id = 0)
    {

        if (!in_array($type, [Orm_Acc_Independent_Reviewer::TYPE_INSTITUTION, Orm_Acc_Independent_Reviewer::TYPE_PROGRAM])) {
            Validator::set_error_flash_message(lang("Error : Please try Again"));
            exit('<script>location.href="/accreditation/reviewer_independent";</script>');
        }

        $reviewer = Orm_Acc_Independent_Reviewer::get_instance($id);

        $reviewer->set_type($type);
        $reviewer->set_type_id($type_id);

        if($this->input->method() == 'post') {
            $reviewer_id = $this->input->post('reviewer_id');
            $cv_text = $this->input->post('cv_text');

            Validator::required_field_validator('reviewer_id', $reviewer_id, lang('Please select Reviewer'));

            Uploader::validator('cv_attachment', false);

            if(Orm_Acc_Independent_Reviewer::get_one(['type' => $type, 'type_id' => $type_id, 'reviewer_id' => $reviewer_id, 'not_id' => $reviewer->get_id()])->get_id()) {
                Validator::set_error('reviewer_id', lang('Reviewer already selected'));
            }

            $reviewer->set_reviewer_id($reviewer_id);
            $reviewer->set_cv_text($cv_text);

            if(Validator::success()) {

                $reviewer->save();

                $file = Uploader::do_process('cv_attachment',$reviewer->get_directory() . 'CV-'.$reviewer->get_reviewer_obj()->get_full_name());
                if($file) {
                    $reviewer->set_cv_attachment($file);
                    $reviewer->save();
                }

                json_response(array('status' => true));
            }
        }

        $this->view_params['reviewer'] = $reviewer;

        $html = $this->load->view('reviewer/independent/reviewer_add_edit', $this->view_params, true);
        if ($this->input->method() == 'post') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    public function report_add_edit($id)
    {
        $reviewer = Orm_Acc_Independent_Reviewer::get_instance($id);

        if($this->input->method() == 'post') {
            $cv_text = $this->input->post('cv_text');
            $recommendations = $this->input->post('recommendations');
            $report_text = $this->input->post('report_text');

            Uploader::validator('cv_attachment', false);
            Uploader::validator('report_attachment', false);

            $reviewer->set_cv_text($cv_text);
            $reviewer->set_recommendations($recommendations);
            $reviewer->set_report_text($report_text);

            if(Validator::success()) {

                $reviewer->save();

                $cv = Uploader::do_process('cv_attachment',$reviewer->get_directory() . 'CV-'.$reviewer->get_reviewer_obj()->get_full_name());
                $report = Uploader::do_process('report_attachment',$reviewer->get_directory() . 'Report-'.$reviewer->get_reviewer_obj()->get_full_name());

                if ($cv) {
                    $reviewer->set_cv_attachment($cv);
                }
                if($report) {
                    $reviewer->set_report_attachment($report);
                }
                $reviewer->save();

                json_response(array('status' => true));
            }
        }

        $this->view_params['reviewer'] = $reviewer;

        $html = $this->load->view('reviewer/independent/report_add_edit', $this->view_params, true);
        if ($this->input->method() == 'post') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            if ($this->is_admin && $reviewer->get_reviewer_id() != Orm_User::get_logged_user_id()) {
                $html = $this->load->view('reviewer/independent/reviewer_info', $this->view_params, true);
            }
            echo $html;
        }
    }

    public function reviewer_list($type, $type_id = 0)
    {
        if (!in_array($type, [Orm_Acc_Independent_Reviewer::TYPE_INSTITUTION, Orm_Acc_Independent_Reviewer::TYPE_PROGRAM])) {
            exit('<script>location.href="/accreditation/reviewer_independent";</script>');
        }

        if(Orm_Node::get_count(array('item_id' =>$type_id)) == 0){
            Validator::set_error_flash_message(lang('There is no').' '.lang('Node'));
            exit('<script>location.href="/accreditation/reviewer_independent/program";</script>');
        }

        $this->get_reviewer_list($type, $type_id);

        $this->breadcrumbs->push(lang('Independent Reviewer'), '/accreditation/reviewer_independent');
        $this->breadcrumbs->push(lang('Programs'), '/accreditation/reviewer_independent/program');
        $this->breadcrumbs->push(lang('Reviewers').' '.lang('for').' '.Orm_Program::get_instance($type_id)->get_name(), '/accreditation/reviewer_independent/reviewer_list/program');

        $this->view_params['active_sub_menu'] = $type;
        $this->layout->view("reviewer/independent/reviewer_list", $this->view_params);
    }

    private function get_reviewer_list($type, $type_id = 0) {
        $per_page = intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));

        if (!$page) {
            $page = 1;
        }

        $filters = ['type' => $type, 'type_id' => $type_id];

        $reviewers = Orm_Acc_Independent_Reviewer::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Acc_Independent_Reviewer::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['reviewers'] = $reviewers;
        $this->view_params['type'] = $type;
        $this->view_params['type_id'] = $type_id;
    }

    public function reviewer_delete($id) {

        $reviewer = Orm_Acc_Independent_Reviewer::get_instance($id);

        if (!$reviewer->get_id()) {
            Validator::set_error_flash_message(lang('Please Try Again'));
            redirect('/accreditation/reviewer_independent');
        }

        $reviewer->delete();

        Validator::set_success_flash_message(lang('Deleted Successfully'));
        redirect("/accreditation/reviewer_independent/reviewer_list/{$reviewer->get_type()}/{$reviewer->get_type_id()}");

    }

}