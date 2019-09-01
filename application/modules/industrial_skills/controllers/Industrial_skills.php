<?php

defined('BASEPATH') OR exit('No direct script access allowed');
define('MODULES_ONLY', true);
/**
 * Description of Industrial Skills
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 */
class Industrial_skills extends MX_Controller
{

    private $view_params = array();

    /**
     * Industrial_skills constructor.
     */
    public function __construct()
    {
        parent::__construct();


        $this->logged_user = Orm_User::get_logged_user();

        if (!License::get_instance()->check_module('industrial_skills', true)) {
            show_404();
        }

        if (!License::get_instance()->check_module('rubrics', true)) {
            show_404();
        }

        Modules::load('rubrics');

        Orm_User::check_logged_in();

        $this->breadcrumbs->push(lang('Industrial Skills'), '/industrial_skills');

        $this->view_params['menu_tab'] = 'industrial_skills';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Industrial Skills'),
            'icon' => 'fa fa-leaf'
        ), true);


    }

    /**
     *this function get list
     * @return string the call function
     */
    private function get_list()
    {
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['program_id'])) {
            $filters['program_id'] = (int)$fltr['program_id'];
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = (int)$fltr['college_id'];
        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
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

        $items = Orm_Is_Industrial_Skills::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Is_Industrial_Skills::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['items'] = $items;
        $this->view_params['fltr'] = $fltr;

    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {

        if (Orm_Is_Industrial_Skills::check_if_can_add() && $this->logged_user->get_class_type() != Orm_User::USER_STUDENT) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="industrial_skills/add_edit" data-toggle="ajaxModal"',
                'link_icon' => 'plus',
                'link_title' => lang('Create') . ' ' . lang('Industrial Skills')
            ), true);
        }

        $this->get_list();

        $this->layout->view('list', $this->view_params);
    }

    /**
     *this function filter
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
     * this function add edit by its id
     * @param int $id the id of the  add edit to be viewed
     * @return string the html view
     */
    public function add_edit($id = 0)
    {
        Orm_Is_Industrial_Skills::check_if_can_add();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $industrial = Orm_Is_Industrial_Skills::get_instance($id);
        $relations = Orm_Is_Industrial_Relation::get_all(array('industrial_id' => $industrial->get_id()));

        $this->view_params['relations'] = $relations;
        $this->view_params['industrial'] = $industrial;
        $this->load->view('add_edit', $this->view_params);
    }


    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        Orm_Is_Industrial_Skills::check_if_can_add();

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/industrial_skills');
        }


        $id = (int)$this->input->post('id');
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');
        $program_id = (int)$this->input->post('program_id');
        $college_id = (int)$this->input->post('college_id');
        $skills = (array)$this->input->post('skills');
        $current_skills = (array)$this->input->post('current_skills');

        $skills = ($skills == array())? $current_skills : $skills;

        Validator::required_field_validator('name_en', $name_en, lang('Required Field'));
        Validator::required_field_validator('name_ar', $name_ar, lang('Required Field'));
        Validator::not_empty_field_validator('program_id', $program_id, lang('Required Field'));
        Validator::not_empty_field_validator('college_id', $college_id, lang('Required Field'));
        Validator::required_array_validator('select_rubric', $skills, lang('Required Field'));



        $industrial = Orm_Is_Industrial_Skills::get_instance($id);
        $industrial->set_program_id($program_id);
        $industrial->set_college_id($college_id);
        $industrial->set_name_en($name_en);
        $industrial->set_name_ar($name_ar);

        if (Validator::success()) {
            $industrial->save();

            $industrial_relation = Orm_Is_Industrial_Relation::get_skill_ids($id);

            foreach ($skills as $skill) {
                $relation = Orm_Is_Industrial_Relation::get_one(array('industrial_id' => $industrial->get_id(), 'rubric_row_id' => $skill));
                $relation->set_industrial_id($industrial->get_id());
                $relation->set_rubric_row_id($skill);
                $relation->save();
            }

            $to_delete = array_diff($industrial_relation, $skills);

            foreach ($to_delete as $relation) {
                $relation = Orm_Is_Industrial_Relation::get_one(array('industrial_id' => $id, 'rubric_row_id' => $relation));
                $relation->delete();
            }


            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['success' => true]);
        }

        $this->view_params['relations'] = $skills;
        $this->view_params['industrial'] = $industrial;

        json_response(['success' => false, 'html' => $this->load->view('/add_edit', $this->view_params, true)]);


    }

    /**
     * this function  get details list by its industrial id and student id
     * @param int $industrial_id the industrial id  of the call to be controller
     * @param int $student_id the student id of the call to be controller
     * @return string call the function
     */
    private function get_details_list($industrial_id, $student_id)
    {
        $industrial = Orm_Is_Industrial_Skills::get_instance($industrial_id);
        $industrial_skills = Orm_Is_Industrial_Relation::get_skill_ids($industrial->get_id());



        if($this->logged_user->get_class_type() == Orm_User::USER_STUDENT){
            if($this->logged_user->get_program_id() != $industrial->get_program_id()){
                Validator::set_error_flash_message(lang('Error: Permission Denied!'));
                redirect('/industrial_skills');
            }
        }

        if(!$this->logged_user->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){
            if($this->logged_user->get_college_id() != $industrial->get_college_id()){
                Validator::set_error_flash_message(lang('Error: Permission Denied!'));
                redirect('/industrial_skills');
            }

        }elseif($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){
            if($this->logged_user->get_college_id() != $industrial->get_college_id()){
                Validator::set_error_flash_message(lang('Error: Permission Denied!'));
                redirect('/industrial_skills');
            }
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }


        $filters = array('program_id' => $industrial->get_program_id());

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if($this->logged_user->get_class_type() == Orm_User::USER_STUDENT){
            $filters['user_id'] = $this->logged_user->get_id();
        }

        $program_students = Orm_User_Student::get_all($filters,$page,$per_page);
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_User_Student::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['industrial'] = $industrial;
        $this->view_params['industrial_skills'] = $industrial_skills;
        $this->view_params['program_students'] = $program_students;
        $this->view_params['student_id'] = $student_id;
        $this->view_params['fltr'] = $fltr;

    }

    /**
     * this function details by its industrial id and student id
     * @param int $industrial_id the industrial id  of the details to be viewed
     * @param int $student_id the student id of the details to be viewed
     * @return string the html view
     */
    public function details($industrial_id, $student_id = 0)
    {

        if (empty($industrial_id)) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/industrial_skills');
        }

        $this->get_details_list($industrial_id, $student_id);

        $this->layout->view('details', $this->view_params);

    }
    /**
     * this function details filter by its industrial id and student id
     * @param int $industrial_id the industrial id  of the details filter to be viewed
     * @param int $student_id the student id of the details filter to be viewed
     * @return string the html view
     */
    public function details_filter($industrial_id, $student_id = 0)
    {
        if ($this->input->is_ajax_request()) {
            $this->get_details_list($industrial_id,$student_id);
            $this->load->view('details_data_table', $this->view_params);
        } else {
            $this->details($industrial_id,$student_id);
        }
    }


    /**
     * this function load rubric by its id
     * @param int $id the id of the load rubric to be viewed
     * @return string the html view
     */
    public function load_rubric($id = 0)
    {
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }
        $filters = array('rubric_class' => Orm_Rb_Rubrics_Course::class);

        $keyword = trim($this->input->get_post('keyword') ?: '');

        if ($keyword != '') {
            $filters['keyword'] = $keyword;
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Rb_Rubrics::get_count($filters));
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="search-rubric"');

        $items = Orm_Rb_Rubrics::get_all($filters, $page, $per_page);

        $industrial = Orm_Is_Industrial_Skills::get_instance($id);
        $relations = Orm_Is_Industrial_Relation::get_all(array('industrial_id' => $industrial->get_id()));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['items'] = $items;
        $this->view_params['relations'] = $relations;
        $this->view_params['industrial'] = $industrial;

        $this->load->view('search_rubric', $this->view_params);
    }

    /**
     * this function delete by its id
     * @param int $id the id  of the delete to be viewed
     * @redirect success or error
     */
    public function delete($id)
    {
        Orm_Is_Industrial_Skills::check_if_can_add();

        $industrial = Orm_Is_Industrial_Skills::get_instance($id);
        if ($industrial->get_id()) {
            $industrial->delete();
            Validator::set_success_flash_message(lang('Deleted Successfully'));
        }
    }

}