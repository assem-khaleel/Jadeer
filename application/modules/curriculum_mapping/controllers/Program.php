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
 * @property CI_Loader $load
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Program
 */
class Program extends MX_Controller
{
    /**
     * @var $view_params array => the array pf data that will send to views
     */
    private $view_params;

    /**
     * Program constructor.
     */
    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        if (!License::get_instance()->check_module('curriculum_mapping', true)) {
            show_404();
        }

        $this->view_params['menu_tab'] = 'curriculum_mapping';

        $this->breadcrumbs->push(lang('Curriculum Mapping'), '/curriculum_mapping');
        $this->breadcrumbs->push(lang('Program Management'), '/curriculum_mapping/program');

        $this->layout->add_javascript('/assets/jadeer/js/add_more.js');
        $this->layout->add_javascript('/assets/jadeer/js/jstree/jstree.min.js');
        $this->layout->add_stylesheet('/assets/jadeer/js/jstree/themes/proton/style.min.css');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Program Management'),
            'icon' => 'fa fa-book',
            'menu_view' => 'curriculum_mapping/sub_menu',
            'menu_params' => array('type' => 'program')
        ), true);
    }

    /**
     * collect and prepare data for programs
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

        Orm_User::get_logged_user()->get_filters($fltr);

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
            $filters['id'] = (int)$fltr['program_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $programs = Orm_Program::get_all($filters, $page, $per_page, array('p.department_id ASC', 'p.name_en ASC'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_program::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['programs'] = $programs;
        $this->view_params['fltr'] = $fltr;
    }

    /**
     * get all needed data to show in view
     */
    public function index()
    {
        $this->get_list();
        $this->layout->view('program/management', $this->view_params);
    }

    /**
     *filter will get a specific view for user when use the filter block will refresh the main view with the new data
     * if not will redirect for the page with the origin view
     */
    public function filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('program/data_table', $this->view_params);
        } else {
            $this->index();
        }
    }

    /**
     * active program to start work on setting data on current semester
     * @param $program_id
     */
    public function activate($program_id)
    {

        $program = Orm_Program::get_instance($program_id);

        if (!$program->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/');
        }

        if (!Orm_Cm_Active_Data::is_active_program($program_id)) {

            if (Orm_Cm_Program_Learning_Outcome::get_count(array('program_id' => $program_id))) {
                $semester_ids = Orm_Cm_Active_Data::get_not_archived_program_semester_ids($program_id);

                foreach (Orm_Semester::get_all(array('not_in_id' => $semester_ids)) as $semester) {
                    Orm_Cm_Program_Learning_Outcome::archive($semester->get_id());
                    Orm_Cm_Program_Assessment_Method::archive($semester->get_id());
                    Orm_Cm_Program_Assessment_Component::archive($semester->get_id());
                    Orm_Cm_Program_Mapping_Matrix::archive($semester->get_id());
                    Orm_Cm_Program_Learning_Outcome_Target::archive($semester->get_id());

                    $program_data = new Orm_Cm_Active_Data();
                    $program_data->set_semester_id($semester->get_id());
                    $program_data->set_type(Orm_Cm_Active_Data::TYPE_PROGRAM);
                    $program_data->set_type_id($program_id);
                    $program_data->set_is_archived(1);
                    $program_data->save();
                }
            }

            $program_data = new Orm_Cm_Active_Data();
            $program_data->set_semester_id(Orm_Semester::get_active_semester()->get_id());
            $program_data->set_type(Orm_Cm_Active_Data::TYPE_PROGRAM);
            $program_data->set_type_id($program_id);
            $program_data->save();
        }
        Validator::set_success_flash_message(lang('The program has been initiated'));
        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     * get learning outcomes for programs
     * @param $program_id
     */
    public function learning_outcome($program_id)
    {

        $program = Orm_Program::get_instance($program_id);

        if (!$program->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Program Learning Domain'),
            'icon' => 'fa fa-book'
        ), true);

        $types = Orm_Cm_Program_Domain::get_all(array('program_id' => $program->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id()), 0, 0, array('id'));

        $this->view_params['program_id'] = $program_id;
        $this->view_params['types'] = $types;
        $this->view_params['link'] = 'learning_outcome';
        $this->layout->view('program/learning_outcome/list', $this->view_params);
    }

    /**
     * set target for every learning outcomes that related to the learning domain
     * @param $program_id
     * @param $learning_domain_id
     */
    public function learning_outcome_target($program_id, $learning_domain_id)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $program = Orm_Program::get_instance($program_id);
        //echo "<pre>";print_r($program);die();

        if (!$program->get_id()) {
            Validator::set_error_flash_message(lang('The resources you requested does not exist!'));
            exit('<script>window.location.reload();</script>');
        }

        $learning_domain_obj = Orm_Cm_Learning_Domain::get_instance($learning_domain_id);
        // echo "<pre>";print_r($learning_domain_obj);die();

        if (!$learning_domain_obj->get_id()) {
            Validator::set_error_flash_message(lang('The resources you requested does not exist!'));
            exit('<script>window.location.reload();</script>');
        }

        $outcomes = Orm_Cm_Program_Learning_Outcome::get_all(['learning_domain_id' => $learning_domain_id, 'program_id' => $program_id]);
        //echo "<pre>";print_r($outcomes);die();
        $this->view_params['outcomes'] = $outcomes;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $targets = (array)$this->input->post('outcome');

            foreach ($targets as $target) {
                if (!empty($target['id'])) {
                    $target_obj = Orm_Cm_Program_Learning_Outcome_Target::get_instance($target['id']);
                    $target_obj->set_program_learning_outcome_id($target['outcome_id']);
                    $target_obj->set_target($target['target']);
                    $target_obj->save();
                } elseif (!empty($target['outcome_id'])) {
                    $target_obj = Orm_Cm_Program_Learning_Outcome_Target::get_one(['program_learning_outcome_id' => $target['outcome_id']]);
                    $target_obj->set_program_learning_outcome_id($target['outcome_id']);
                    $target_obj->set_target($target['target']);
                    $target_obj->save();
                }
            }
            Validator::set_success_flash_message(lang('Learning Outcome Target has been set successfully'));
            json_response(['status' => true]);
        }

        $this->view_params['outcomes'] = $outcomes;
        $this->view_params['domain'] = Orm_Cm_Learning_Domain::get_instance($learning_domain_id);
        $this->view_params['program_id'] = $program_id;

        $this->load->view('program/learning_outcome/target', $this->view_params);
    }

    /**
     * add new learning outcomes for domain or update the old learning outcomes then save it on database
     * @param $program_id
     * @param $learning_domain_id
     */
    public function learning_outcome_add_edit($program_id, $learning_domain_id)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $program = Orm_Program::get_instance($program_id);

        if (!$program->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        $learning_domain_obj = Orm_Cm_Learning_Domain::get_instance($learning_domain_id);

        if (!$learning_domain_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        if (Orm_Semester::get_active_semester_id() != Orm_Semester::get_current_semester()->get_id()) {
            Validator::set_error_flash_message(lang("Error : Please try Again"));
            exit("<script>location.href='/curriculum_mapping/program/learning_outcome/{$program_id}';</script>");
        }

        $outcomes = array();

        $program_learning_outcomes = Orm_Cm_Program_Learning_Outcome::get_program_learning_outcomes($program_id, $learning_domain_id);
        $learning_domain = Orm_Cm_Learning_Domain::get_instance($learning_domain_id);

        //echo "<pre>";print_r($program_learning_outcomes);die();
        $outcome_key = 0;

        foreach (Orm_Cm_Learning_Outcome::get_all(array('learning_domain_id' => $learning_domain->get_id())) as $outcome_key => $learning_outcome) {
            //  echo "<pre>";print_r($learning_outcome);die();
            $outcomes[$outcome_key]['outcome_id'] = $learning_outcome->get_id();
            $outcomes[$outcome_key]['outcome_title_en'] = $learning_outcome->get_title_en();
            $outcomes[$outcome_key]['outcome_title_ar'] = $learning_outcome->get_title_ar();

            if ($program_learning_outcomes) {
                foreach ($program_learning_outcomes as $program_outcome_key => $program_learning_outcome) {
                    if ($learning_outcome->get_id() == $program_learning_outcome->get_learning_outcome_id()) {
                        $outcomes[$outcome_key]['program_outcome_id'] = $program_learning_outcome->get_id();
                        $outcomes[$outcome_key]['program_outcome_text_en'] = $program_learning_outcome->get_text_en();
                        $outcomes[$outcome_key]['program_outcome_text_ar'] = $program_learning_outcome->get_text_ar();
                        $outcomes[$outcome_key]['program_outcome_code'] = $program_learning_outcome->get_code();

                        unset($program_learning_outcomes[$program_outcome_key]);
                    }
                }
            }
        }

        if ($program_learning_outcomes) {
            foreach ($program_learning_outcomes as $program_learning_outcome) {

                $outcome_key++;

                $outcomes[$outcome_key]['program_outcome_id'] = $program_learning_outcome->get_id();
                $outcomes[$outcome_key]['program_outcome_text_en'] = $program_learning_outcome->get_text_en();
                $outcomes[$outcome_key]['program_outcome_text_ar'] = $program_learning_outcome->get_text_ar();
                $outcomes[$outcome_key]['program_outcome_code'] = $program_learning_outcome->get_code();
            }
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $old_outcomes = $outcomes;
            $outcomes = $this->input->post('outcomes');

            // Validation Loop
            if ($outcomes) {
                foreach ($outcomes as $key => $outcome) {
                    if (isset($outcome['program_outcome_id'])) {
                        Validator::required_field_validator('required_learning_outcome_en_' . (!empty($key) ? $key : '0'), $outcome['program_outcome_text_en'], lang('Required Fields Missing'));
                        Validator::required_field_validator('required_learning_outcome_ar_' . (!empty($key) ? $key : '0'), $outcome['program_outcome_text_ar'], lang('Required Fields Missing'));
                        Validator::required_field_validator('required_learning_outcome_code_' . (!empty($key) ? $key : '0'), $outcome['program_outcome_code'], lang('Required Fields Missing'));
                    }
                }
            }

            if ($outcomes && Validator::success()) {
                foreach ($outcomes as $outcome) {
                    if (isset($outcome['program_outcome_id'])) {
                        if (!empty($outcome['outcome_id'])) {
                            $program_outcome = Orm_Cm_Program_Learning_Outcome::get_one(array('program_id' => $program_id, 'learning_domain_id' => $learning_domain->get_id(), 'learning_outcome_id' => $outcome['outcome_id']));
                            $program_outcome->set_learning_domain_id($learning_domain->get_id());
                            $program_outcome->set_program_id($program_id);
                            $program_outcome->set_code($outcome['program_outcome_code']);
                            $program_outcome->set_learning_outcome_id($outcome['outcome_id']);
                            $program_outcome->set_text_en($outcome['program_outcome_text_en']);
                            $program_outcome->set_text_ar($outcome['program_outcome_text_ar']);
                            $program_outcome->save();

                        } else {

                            $program_outcome = Orm_Cm_Program_Learning_Outcome::get_instance($outcome['program_outcome_id']);
                            $program_outcome->set_learning_domain_id($learning_domain->get_id());
                            $program_outcome->set_program_id($program_id);
                            $program_outcome->set_code($outcome['program_outcome_code']);
                            $program_outcome->set_text_en($outcome['program_outcome_text_en']);
                            $program_outcome->set_text_ar($outcome['program_outcome_text_ar']);
                            $program_outcome->save();

                        }
                    }
                }
            }

            $remove_outcomes = arrayRecursiveDiff($old_outcomes, $outcomes);

            if ($remove_outcomes && Validator::success()) {
                foreach ($remove_outcomes as $outcome) {
                    if (isset($outcome['program_outcome_id'])) {
                        $program_outcome = Orm_Cm_Program_Learning_Outcome::get_instance($outcome['program_outcome_id']);
                        $program_outcome->delete();
                    }
                }
            }

            if (Validator::success()) {
                json_response(array('status' => true));
            } else {
                $this->view_params['outcomes'] = $outcomes;
                $this->view_params['program_id'] = $program_id;
                $this->view_params['domain'] = $learning_domain;
                json_response(array('status' => false, 'html' => $this->load->view('program/learning_outcome/add_edit', $this->view_params, true)));
            }

        }

        $this->view_params['outcomes'] = $outcomes;
        $this->view_params['program_id'] = $program_id;
        $this->view_params['domain'] = $learning_domain;

        $html = $this->load->view('program/learning_outcome/add_edit', $this->view_params, true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * map program learning outcomes with survey
     * @param $id => learning outcome id
     */
    public function plo_survey($id)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $plo = Orm_Cm_Program_Learning_Outcome::get_instance($id);

        if (!$plo->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        if (License::get_instance()->check_module('survey') && $this->input->is_ajax_request()) {
            Modules::load('survey');
        } else {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>location.href="/curriculum_mapping/program/learning_outcome/' . $plo->get_program_id() . '";</script>');
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $selected_statement = $this->input->post('selected_items');

            $items = json_decode($selected_statement);
            $statement_ids = [0];

            foreach ($items as $item) {
                if (is_numeric($item)) {
                    $statement_obj = Orm_Survey_Question_Statement::get_instance($item);
                    $plo_survey = Orm_Cm_Program_Learning_Outcome_Survey::get_one(array('program_learning_outcome_id' => $id, 'statement_id' => $item));
                    $plo_survey->set_survey_id($statement_obj->get_factor_obj()->get_question_obj()->get_page_obj()->get_survey_id());
                    $plo_survey->set_factor_id($statement_obj->get_factor_id());
                    $plo_survey->set_statement_id($statement_obj->get_id());
                    $plo_survey->set_program_learning_outcome_id($id);
                    $plo_survey->save();

                    $statement_ids[] = $item;
                }
            }

            foreach (Orm_Cm_Program_Learning_Outcome_Survey::get_all(['program_learning_outcome_id' => $id, 'statement_not_ids' => $statement_ids]) as $statement) {
                $statement->delete();
            }

            Validator::set_success_flash_message(lang('Program Learning Outcome Mapped to Survey'));
            json_response(array('error' => false));
        }

        $this->view_params['plo'] = $plo;

        $this->load->view('program/learning_outcome/survey_mapping', $this->view_params);
    }

    /**
     * get all assessment methodes that associated with program
     * @param $program_id
     */
    public function assessment_method($program_id)
    {

        $program = Orm_Program::get_instance($program_id);

        //echo "<pre>";print_r($program);die();

        if (!$program->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Program Assessment Method'),
            'icon' => 'fa fa-book',
            'link_attr' => 'data-toggle="ajaxModal" href="/curriculum_mapping/program/assessment_method_add_edit/' . $program_id . '"',
            'link_icon' => 'cog',
            'link_title' => lang('Manage') . ' ' . lang('Assessment Method')
        ), true);

        $this->view_params['program_id'] = $program_id;
        $this->view_params['link'] = 'assessment_method';
        $this->layout->view('program/assessment_method/list', $this->view_params);
    }

    /**
     * add new assessment method for program or update the old assessment method
     * @param $program_id
     */
    public function assessment_method_add_edit($program_id)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $programObj = Orm_Program::get_instance($program_id);

        //   echo "<pre>";print_r($programObj);die();

        if (!$programObj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        if (Orm_Semester::get_active_semester_id() != Orm_Semester::get_current_semester()->get_id()) {
            Validator::set_error_flash_message(lang("Error : Please try Again"));
            exit('<script>location.href="/curriculum_mapping/program/assessment_method/' . $program_id . '";</script>');
        }

        $assessment_methods = Orm_Cm_Assessment_Method::get_all();
        $program_assessment_method_ids = Orm_Cm_Program_Assessment_Method::get_assessment_method_ids($program_id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $assessment_method_ids = $this->input->post('assessment_method_ids');

            if (!is_array($assessment_method_ids)) {
                $assessment_method_ids = array();
            }

            foreach ($assessment_method_ids as $assessment_method_id) {
                $program_assessment_method = Orm_Cm_Program_Assessment_Method::get_one(array('program_id' => $program_id, 'assessment_method_id' => $assessment_method_id));
                $program_assessment_method->set_program_id($program_id);
                $program_assessment_method->set_assessment_method_id($assessment_method_id);
                $program_assessment_method->save();
            }

            $to_delete = array_diff($program_assessment_method_ids, $assessment_method_ids);

            foreach ($to_delete as $assessment_method_id) {
                $program_assessment_method = Orm_Cm_Program_Assessment_Method::get_one(array('program_id' => $program_id, 'assessment_method_id' => $assessment_method_id));
                $program_assessment_method->delete();
            }

            json_response(array('status' => true));
        }

        $this->view_params['program_id'] = $program_id;
        $this->view_params['assessment_methods'] = $assessment_methods;
        $this->view_params['program_assessment_method_ids'] = $program_assessment_method_ids;

        $html = $this->load->view('program/assessment_method/add_edit', $this->view_params, true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }

    }

    /**
     * add new component for assessment method or update the old components then save it on database
     * @param $program_assessment_method_id
     */
    public function assessment_method_add_edit_component($program_assessment_method_id)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $program_assessment_method = Orm_Cm_Program_Assessment_Method::get_instance($program_assessment_method_id);

        if (!$program_assessment_method->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        if (Orm_Semester::get_active_semester_id() != Orm_Semester::get_current_semester()->get_id()) {
            Validator::set_error_flash_message(lang("Error : Please try Again"));
            exit('<script>location.href="/curriculum_mapping/program/assessment_method/' . $program_assessment_method->get_program_id() . '";</script>');
        }

        $program_assessment_components = $program_assessment_method->get_assessment_components();

        $components = array();
        foreach (Orm_Cm_Assessment_Component::get_all(array('assessment_method_id' => $program_assessment_method->get_assessment_method_id())) as $component_key => $component) {
            $components[$component_key]['component_id'] = $component->get_id();
            $components[$component_key]['component_title_en'] = $component->get_title_en();
            $components[$component_key]['component_title_ar'] = $component->get_title_ar();

            foreach ($program_assessment_components as $program_component_key => $program_component) {
                if ($component->get_id() == $program_component->get_assessment_component_id()) {
                    $components[$component_key]['program_component_id'] = $program_component->get_id();
                    $components[$component_key]['program_component_text_en'] = $program_component->get_text_en();
                    $components[$component_key]['program_component_text_ar'] = $program_component->get_text_ar();

                    unset($program_assessment_components[$program_component_key]);
                }
            }
        }

        $component_key = 0;

        if ($program_assessment_components) {
            foreach ($program_assessment_components as $program_component) {

                $component_key++;

                $components[$component_key]['program_component_id'] = $program_component->get_id();
                $components[$component_key]['program_component_text_en'] = $program_component->get_text_en();
                $components[$component_key]['program_component_text_ar'] = $program_component->get_text_ar();
            }
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $old_components = $components;
            $components = $this->input->post('components');

            // Validation Loop
            if ($components) {
                foreach ($components as $component_key => $component) {
                    if (isset($component['program_component_id'])) {
                        if (!empty($component['component_id'])) {
                            $message = lang('You can not change this to a blank value');
                        } else {
                            $message = lang('Required Fields Missing');
                        }
                        Validator::required_field_validator('required_assessment_component_en_' . (!empty($component['component_id']) ? $component['component_id'] : $component_key), $component['program_component_text_en'], $message);
                        Validator::required_field_validator('required_assessment_component_ar_' . (!empty($component['component_id']) ? $component['component_id'] : $component_key), $component['program_component_text_ar'], $message);
                    }
                }
            }

            if ($components && Validator::success()) {

                foreach ($components as $component) {
                    if (isset($component['program_component_id'])) {
                        if (!empty($component['component_id'])) {

                            $program_component = Orm_Cm_Program_Assessment_Component::get_one(array('program_assessment_method_id' => $program_assessment_method_id, 'assessment_component_id' => $component['component_id']));
                            $program_component->set_assessment_component_id($component['component_id']);
                            $program_component->set_program_assessment_method_id($program_assessment_method_id);
                            $program_component->set_text_en($component['program_component_text_en']);
                            $program_component->set_text_ar($component['program_component_text_ar']);
                            $program_component->save();

                        } else {

                            $program_component = Orm_Cm_Program_Assessment_Component::get_instance($component['program_component_id']);
                            $program_component->set_program_assessment_method_id($program_assessment_method_id);
                            $program_component->set_text_en($component['program_component_text_en']);
                            $program_component->set_text_ar($component['program_component_text_ar']);
                            $program_component->save();

                        }
                    }
                }

                $remove_components = arrayRecursiveDiff($old_components, $components);

                if ($remove_components) {
                    foreach ($remove_components as $component) {
                        if (isset($component['program_component_id'])) {
                            $program_component = Orm_Cm_Program_Assessment_Component::get_instance($component['program_component_id']);
                            $program_component->delete();
                        }
                    }
                }

                json_response(array('status' => true));

            }

        }

        $this->view_params['components'] = $components;
        $this->view_params['program_assessment_method_id'] = $program_assessment_method_id;

        $html = $this->load->view('program/assessment_method/add_edit_component', $this->view_params, true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }

    }

    /**
     * IPMA Matrix relation between the courses in program plan and program learning outcomes
     * @param $program_id
     * @param int $level
     */
    public function mapping_matrix($program_id, $level = 0)
    {

        $program_obj = Orm_Program::get_instance($program_id);

        if (!$program_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Program Mapping Matrix'),
            'icon' => 'fa fa-book'
        ), true);

        $this->view_params['level'] = intval($level);
        $this->view_params['program_id'] = $program_id;
        $this->view_params['link'] = 'mapping';
        $this->layout->view('program/mapping_matrix/list', $this->view_params);
    }

    /**
     * add the relation between course and program learning outcomes (I =>introduced , P=> practiced , M => Mastery, A=> Assessed)
     * @param $program_id
     * @param int $level
     */
    public function mapping_matrix_add_edit($program_id, $level = 0)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $program_obj = Orm_Program::get_instance($program_id);
        if (!$program_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        $this->view_params['program_id'] = $program_id;
        $this->view_params['level'] = $level;

        $this->load->view('program/mapping_matrix/edit', $this->view_params);
    }


    /**
     * save the relation between courses and program learning outcomes
     * @param $program_id
     */
    public function mapping_matrix_save($program_id)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $program_obj = Orm_Program::get_instance($program_id);

        if (!$program_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }


        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $mapping = $this->input->post('mapping');

            $program_plans = Orm_Program_Plan::get_all(array('program_id' => $program_id));
            $program_outcomes = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_id));

            if ($mapping) {

                foreach ($program_outcomes as $outcome) {

                    foreach ($program_plans as $plan) {

                        $map_obj = Orm_Cm_Program_Mapping_Matrix::get_one(array('program_id' => $program_id, 'course_id' => $plan->get_course_id(), 'program_learning_outcome_id' => $outcome->get_learning_outcome_id()));

                        if (isset($mapping[$plan->get_course_id()][$outcome->get_learning_outcome_id()]) && in_array($mapping[$plan->get_course_id()][$outcome->get_learning_outcome_id()], array_keys(Orm_Cm_Program_Mapping_Matrix::get_ipa_list()))) {

                            $map_obj->set_program_id($program_id);
                            $map_obj->set_course_id($plan->get_course_id());
                            $map_obj->set_program_learning_outcome_id($outcome->get_learning_outcome_id());
                            $map_obj->set_ipa($mapping[$plan->get_course_id()][$outcome->get_learning_outcome_id()]);
                            $map_obj->save();
                        } else {

                            $map_obj->delete();
                        }
                    }
                }
            }

            json_response(array('status' => true));
        }
    }

    /**
     * X - Matrix relation between the courses in program plan and program learning outcomes
     * @param $program_id
     */
    public function x_matrix($program_id)
    {

        $program_obj = Orm_Program::get_instance($program_id);

        if (!$program_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Program Mapping Matrix'),
            'icon' => 'fa fa-book'
        ), true);

        $this->view_params['program_id'] = $program_id;
        $this->view_params['link'] = 'x-matrix';
        $this->layout->view('program/x_matrix/list', $this->view_params);
    }

    /**
     *save the relation betwwen program learning outcome and courses as a general matrix
     */
    public function x_matrix_save()
    {
        $program_id = intval($this->input->get_post('program_id'));
        $relations = array($this->input->get_post('relation'));
        $program_obj = Orm_Program::get_instance($program_id);
        if (!$program_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }


        $relationsToDel = Orm_Cm_Program_X_Matrix::get_all(['program_id' => $program_id]);
        foreach ($relationsToDel as $relationToDel) {
            $relationToDel->delete();
        }

        if (count($relations)) {
            foreach ($relations as $key => $val) {
                if (count($val)) {
                    foreach ($val as $k => $v) {
                        foreach ($v as $v2) {
                            $PloRelationXmatrix = new Orm_Cm_Program_X_Matrix();
                            $PloRelationXmatrix->set_xmatrix(1);
                            $PloRelationXmatrix->set_course_id($k);
                            $PloRelationXmatrix->set_program_id($program_id);
                            $PloRelationXmatrix->set_program_learning_outcome_id($v2);
                            $PloRelationXmatrix->save();
                        }
                    }
                }
            }
        }

        $this->view_params['link'] = 'x-matrix';
        $this->view_params['program_id'] = $program_id;

        Validator::set_success_flash_message(lang('Successfully Saved'));
        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     *  Assessment - Matrix relation between the courses in program plan and program learning outcomes plus the assessment methods that mapped with program learning outcomes
     * @param $program_id
     */
    public function assessment_matrix($program_id)
    {

        $program_obj = Orm_Program::get_instance($program_id);

        if (!$program_obj->get_id()) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Program Mapping Matrix'),
            'icon' => 'fa fa-book'
        ), true);

        $this->view_params['program_id'] = $program_id;
        $this->view_params['link'] = 'assessment-matrix';
        $this->layout->view('program/assessment_matrix/list', $this->view_params);
    }

    /**
     * add the mapping of assessment methods with course and the target for each assessment method
     * @param int $program_id
     * @param int $course_id
     * @param int $plo_id
     */
    public function assessment_matrix_edit($program_id = 0, $course_id = 0, $plo_id = 0)
    {
        if (!$program_id) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }
        if (!$course_id) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }
        if (!$plo_id) {
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect("/");
        }

        $program_method = Orm_Cm_Program_Assessment_Method::get_all(['program_id' => $program_id]);

        $this->view_params['program_id'] = $program_id;
        $this->view_params['course_id'] = $course_id;
        $this->view_params['plo_id'] = $plo_id;
        $this->view_params['program_method'] = $program_method;
        $this->load->view('program/assessment_matrix/edit_assessment_matrix', $this->view_params);
    }

    /**
     * save the relation of assessment methods and courses
     */
    public function save_assessment_matrix()
    {
        $program_id = $this->input->post('program_id');
        $course_id = $this->input->post('course_id');
        $plo_id = $this->input->post('plo_id');
        $value = $this->input->post('value');
        $assessment_method_id = $this->input->post('assessment_method_id');

        $assessment_metric_old = Orm_Cm_Program_X_Matrix_Method::get_all(['program_id' => $program_id, 'course_id' => $course_id, 'program_learning_outcome_id' => $plo_id]);

        foreach ($assessment_metric_old as $relationToDel) {
            $relationToDel->delete();
        }

        foreach ($assessment_method_id as $method) {
            $methodRelationXmatrix = new Orm_Cm_Program_X_Matrix_Method();
            $methodRelationXmatrix->set_program_id($program_id);
            $methodRelationXmatrix->set_course_id($course_id);
            $methodRelationXmatrix->set_program_learning_outcome_id($plo_id);
            $methodRelationXmatrix->set_assessment_method_id($method);
            foreach ($value as $key => $val) {
                if ($key == $method) {
                    $methodRelationXmatrix->set_value($val);
                }
            }
            $methodRelationXmatrix->save();
        }

        json_response(['success' => true]);

    }


    /**
     * get all Program learning outcomes depends on specific program
     */
    public function find_plo()
    {

        $id = intval($this->input->get_post('id'));

        $plo = Orm_Cm_Program_Learning_Outcome::get_instance($id);

        $program_id = intval($this->input->post_get('program_id'));
        $department_id = intval($this->input->post_get('department_id'));
        $college_id = intval($this->input->post_get('college_id'));

        if ($plo && $plo->get_id()) {
            $program_id = $program_id ?: $plo->get_program_id();
            $department_id = $department_id ?: Orm_Program::get_instance($plo->get_program_id())->get_department_id();
            $college_id = $college_id ?: Orm_Program::get_instance($plo->get_program_id())->get_department_obj()->get_college_id();
        }

        $this->view_params['program_id'] = $program_id;
        $this->view_params['department_id'] = $department_id;
        $this->view_params['college_id'] = $college_id;

        $this->view_params['plo_id'] = $id;


        $this->layout->set_layout('layout_blank')->view('program/plo', $this->view_params);
    }

    /**
     * choose on of learning domain type
     * @param $program_id
     */
    public function select_domain_type($program_id)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        if (!isset($program_id)) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $domain_types = Orm_Learning_Domain_Type::get_all();

        $this->view_params['domain_types'] = $domain_types;
        $this->view_params['program_id'] = $program_id;

        $this->load->view('program/learning_outcome/select_domain_type', $this->view_params);

    }

    /**
     *save the type of learning domain that has chosen for program
     */
    public function save_domain_type()
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $id = (int)$this->input->post('id');
        $type = $this->input->post('type');
        $program_id = $this->input->post('program_id');

        Validator::not_empty_field_validator('type', $type, lang('Please select learning domain type'));


        if (Orm_Cm_Program_Domain::get_count(array('domain_type' => $type, 'program_id' => $program_id)) != 0) {

            Validator::set_error('type', lang('This Learning Domain Type are used befor by this Program'));

        } else {
//            $map = Orm_Cm_Program_Domain::get_instance($id);
//            $map->set_domain_type($type);
//            $map->set_program_id($program_id);
//            $map->set_semester_id(Orm_Semester::get_active_semester()->get_id());
            $map = new Orm_Cm_Program_Domain();
            $map->set_domain_type($type);
            $map->set_program_id($program_id);
            $map->set_semester_id(Orm_Semester::get_active_semester()->get_id());
        }


        if (Validator::success()) {
            $map->save();

            Validator::set_success_flash_message('Successfully Saved');
            json_response(array('success' => true));
        }

        $this->view_params['domain_types'] = Orm_Learning_Domain_Type::get_all();
        $this->view_params['program_id'] = $program_id;

        $html = $this->load->view('program/learning_outcome/select_domain_type', $this->view_params, true);
        json_response(array('success' => false, 'html' => $html));

    }

    /**
     * delete the type of learning domain that has chosen for program
     * @param $map_id
     */
    public function delete_type($map_id)
    {

        if (!$this->input->is_ajax_request()) {

            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $program_domain = Orm_Cm_Program_Domain::get_instance($map_id);

        $program_learning_outcomes = Orm_Cm_Program_Learning_Outcome::get_count(array('domain_type' => $program_domain->get_domain_type()));

        if ($program_learning_outcomes != 0) {
            Validator::set_error_flash_message(lang("One of Domains Contain Learning Outcome you can't remove it"), true);
        } else {
            if ($program_domain->get_id()) {
                $program_domain->delete();

                Validator::set_success_flash_message(lang('Successfully Deleted'), true);

            }
        }

        redirect($this->input->server('HTTP_REFERER'));

    }

}