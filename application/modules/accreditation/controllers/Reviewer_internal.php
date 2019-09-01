<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . 'modules' . DIRECTORY_SEPARATOR . 'accreditation' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'Reviewer.php';

/**
 * Created by PhpStorm.
 * User: ali
 * Date: 06/04/17
 * Time: 02:40 م
 */
class Reviewer_Internal extends Reviewer
{

    public function __construct() {
        parent::__construct();

        $this->page_header('internal');

        $this->view_params['sub_menu'] = 'reviewer/internal/sub_menu';
    }

    public function index() {
        $this->institution();
    }

    public function institution(){

        $this->breadcrumbs->push(lang('Internal Reviewer'), '/accreditation/reviewer_internal');
        $this->breadcrumbs->push(lang('Institution'), '/accreditation/reviewer_internal/institution');

        $this->view_params['active_sub_menu'] = 'institution';
        $this->layout->view("reviewer/internal/institution/index", $this->view_params);
    }

    public function program(){
        $this->get_list_programs();

        $this->breadcrumbs->push(lang('Internal Reviewer'), '/accreditation/reviewer_internal');
        $this->breadcrumbs->push(lang('Programs'), '/accreditation/reviewer_internal/program');

        $this->view_params['active_sub_menu'] = 'program';
        $this->layout->view("reviewer/internal/program/index", $this->view_params);
    }

    public function filter_program() {
        if ($this->input->is_ajax_request()) {
            $this->get_list_programs();
            $this->load->view('reviewer/internal/program/data_table', $this->view_params);
        } else {
            $this->program();
        }
    }

    private function get_list_programs() {
        $per_page = 5;//intval($this->config->item('per_page'));
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

        $programs = Orm_Program::get_all($filters, $page, $per_page, array('p.department_id ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_program::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['programs'] = $programs;
        $this->view_params['fltr'] = $fltr;
    }

    public function course(){
        $this->get_list_courses();

        $this->breadcrumbs->push(lang('Internal Reviewer'), '/accreditation/reviewer_internal');
        $this->breadcrumbs->push(lang('Courses'), '/accreditation/reviewer_internal/course');

        $this->view_params['active_sub_menu'] = 'course';
        $this->layout->view("reviewer/internal/course/index", $this->view_params);
    }

    public function filter_course() {
        if ($this->input->is_ajax_request()) {
            $this->get_list_courses();
            $this->load->view('reviewer/internal/course/data_table', $this->view_params);
        } else {
            $this->course();
        }
    }

    private function get_list_courses() {
        $per_page = 5;//intval($this->config->item('per_page'));
        $page = intval($this->input->get_post('page'));
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }
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
            $filters['program_id'] = intval($fltr['program_id']);
        }
        if (!empty($filters['program_id'])) {
            $filters['program_plan'] = true;
        }

        $courses = Orm_Course::get_all($filters, $page, $per_page, array('c.department_id ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['courses'] = $courses;
        $this->view_params['fltr'] = $fltr;
    }
}