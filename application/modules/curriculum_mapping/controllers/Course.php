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
 * Class Course
 */
class Course extends MX_Controller
{
    /**
     * @var $view_params array => the array pf data that will send to views
     */
    private $view_params;

    /**
     * Course constructor.
     */
    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        if (!License::get_instance()->check_module('curriculum_mapping', true)) {
            show_404();
        }



        $this->view_params['menu_tab'] = 'curriculum_mapping';

        $this->layout->add_javascript('/assets/jadeer/js/add_more.js');
        $this->layout->add_javascript('/assets/jadeer/js/jstree/jstree.min.js');
        $this->layout->add_stylesheet('/assets/jadeer/js/jstree/themes/proton/style.min.css');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Course Management'),
            'icon' => 'fa fa-book',
            'menu_view' => 'curriculum_mapping/sub_menu',
            'menu_params' => array('type' => 'course')
        ), true);
    }

    /**
     * collect and prepare course data
     */
    private function get_list(){
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        Orm_User::get_logged_user()->get_filters($fltr);

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }
        
        if (Orm_User::has_role_teacher() && Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['in_id'] = Orm_Course_Section_Teacher::get_course_ids();
        } else {
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
    }

    /**
     * get all data for course and set in view
     */
    public function index()
    {
        $this->breadcrumbs->push(lang('Curriculum Mapping'), '/curriculum_mapping');
        $this->breadcrumbs->push(lang('Course Management'), '/curriculum_mapping/course');
        
        $this->get_list();

        $this->layout->view('course/management', $this->view_params);
    }

    /**
     *filter will get a specific view for user when use the filter block will refresh the main view with the new data
     * if not will redirect for the page with the origin view
     */
    public function filter(){

        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('course/data_table', $this->view_params);
        } else {
            $this->index();
        }

    }

    /**
     *  active course to start work on setting data on current semester
     * @param $course_id
     */
    public function activate($course_id) {

        $course = Orm_Course::get_instance($course_id);

        if(!$course->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/');
        }

        if(!Orm_Cm_Active_Data::is_active_course($course_id)) {

            if (Orm_Cm_Course_Learning_Outcome::get_count(array('course_id' => $course_id))) {
                $semester_ids = Orm_Cm_Active_Data::get_not_archived_course_semester_ids($course_id);

                foreach (Orm_Semester::get_all(array('not_in_id' => $semester_ids)) as $semester) {
                    Orm_Cm_Course_Learning_Outcome::archive($semester->get_id());
                    Orm_Cm_Course_Assessment_Method::archive($semester->get_id());
                    Orm_Cm_Course_Mapping_Matrix::archive($semester->get_id());
                    Orm_Cm_Course_Learning_Outcome_Target::archive($semester->get_id());

                    $course_data = new Orm_Cm_Active_Data();
                    $course_data->set_semester_id($semester->get_id());
                    $course_data->set_type(Orm_Cm_Active_Data::TYPE_COURSE);
                    $course_data->set_type_id($course_id);
                    $course_data->set_is_archived(1);
                    $course_data->save();
                }
            }

            $program_data = new Orm_Cm_Active_Data();
            $program_data->set_semester_id(Orm_Semester::get_active_semester()->get_id());
            $program_data->set_type(Orm_Cm_Active_Data::TYPE_COURSE);
            $program_data->set_type_id($course_id);
            $program_data->save();
        }

        Validator::set_success_flash_message(lang('The course has been initiated'));

        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     * choose one of program that has the same college to map the program learning outcome of it with the course
     * @param $course_id
     */
    public function offered_program($course_id) {

        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/');
        }

        $course = Orm_Course::get_instance($course_id);

        if(!$course->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit("<script>window.location.replace('/curriculum_mapping/course')</script>");
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $program_id = $this->input->post('program_id');
            $program_obj = Orm_Program::get_instance($program_id);

            Validator::not_empty_field_validator('program_id', $program_obj->get_id(), lang('Select Offered Program'));

            if(Validator::success()) {
                $obj_offered = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id));
                $obj_offered->set_course_id($course_id);
                $obj_offered->set_program_id($program_id);
                $obj_offered->save();

                json_response(array('status' => true));
            }

        }

        $this->view_params['course_id'] = $course_id;

        $html = $this->load->view('course/offered_program', $this->view_params, true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }

    }

    /**
     * set the target for every course learning outcome
     * @param $course_id
     * @param $learning_domain_id
     */
    public function learning_outcome_target($course_id, $learning_domain_id) {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $course = Orm_Course::get_instance($course_id);

        if(!$course->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit("<script>window.location.replace('/curriculum_mapping/course')</script>");
        }

        $learning_domain = Orm_Cm_Learning_Domain::get_instance($learning_domain_id);

        if(!$learning_domain->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit("<script>window.location.replace('/curriculum_mapping/course')</script>");
        }

        $outcomes = Orm_Cm_Course_Learning_Outcome::get_all(['learning_domain_id' => $learning_domain_id, 'course_id' => $course_id]);
        $this->view_params['outcomes'] = $outcomes;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $targets = (array) $this->input->post('outcome');

            foreach ($targets as $target) {
                if (!empty($target['id'])) {
                    $target_obj = Orm_Cm_Course_Learning_Outcome_Target::get_instance($target['id']);
                    $target_obj->set_course_learning_outcome_id($target['outcome_id']);
                    $target_obj->set_target($target['target']);
                    $target_obj->save();
                } elseif (!empty($target['outcome_id'])) {
                    $target_obj = Orm_Cm_Course_Learning_Outcome_Target::get_one(['course_learning_outcome_id' => $target['outcome_id']]);
                    $target_obj->set_course_learning_outcome_id($target['outcome_id']);
                    $target_obj->set_target($target['target']);
                    $target_obj->save();
                }
            }

            json_response(['status' => true]);
        }

        $this->view_params['outcomes'] = $outcomes;
        $this->view_params['domain'] = Orm_Cm_Learning_Domain::get_instance($learning_domain_id);
        $this->view_params['course_id'] = $course_id;

        $this->load->view('course/learning_outcome/target', $this->view_params);
    }

    /**
     * map course learning outcomes with  programs learning outcomes (depends on program plan )
     * @param $course_id
     */
    public function x_matrix($course_id)
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('PLO - CLO Matrix'),
            'icon' => 'fa fa-book'
        ), true);

        $course_mapping = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id));

        if(!$course_mapping->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/curriculum_mapping/course');
        }

        $courses = Orm_Program_Plan::get_all(['course_id'=>$course_id]);
        $this->view_params['courses'] = $courses;
        $this->view_params['link'] = 'x_matrix';
        $this->view_params['course_id'] = $course_id;

        $this->layout->view('course/x_matrix/list', $this->view_params);

    }

    /**
     * save the relations between CLO and PLO
     */
    public function save_x_matrix()
    {

        $relationsToDel = Orm_Cm_Course_Matrix::get_all();
        foreach ($relationsToDel as $relationToDel) {
            $mappings = Orm_Cm_Course_Matrix::get_all(['id'=>$relationToDel->get_id()]);
            foreach ($mappings as $mapping) {
                $mapping->delete();
            }
        }

        if (Validator::success()) {
            $matrixs = (array)$this->input->post('relation');

            foreach ($matrixs as $plos_id => $clos_id) {
                foreach ($clos_id as $key => $clo_id) {
                    $map = Orm_Cm_Course_Matrix::get_instance($key);
                    $map->set_clo_id($clo_id);
                    $map->set_plo_id($plos_id);
                    $map->save();
                }
            }
            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    /**
     * get all course learning outcomes for course
     * @param $course_id
     */
    public function learning_outcome($course_id)
    {
        $course = Orm_Course::get_instance($course_id);

        if(!$course->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/curriculum_mapping/course');
        }

        $course_mapping = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id));

        if(!$course_mapping->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/curriculum_mapping/course');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Course Learning Domain'),
            'icon' => 'fa fa-book'
        ), true);

        $this->view_params['link'] = 'learning_outcome';
        $this->view_params['course_id'] = $course_id;
        $this->layout->view('course/learning_outcome/list', $this->view_params);
    }

    /**
     * add new learning outcomes or set new learning for course
     * @param $course_id
     * @param $domain_id
     */
    public function learning_outcome_add_edit($course_id, $domain_id)
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $course = Orm_Course::get_instance($course_id);

        if(!$course->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        $learning_domain = Orm_Cm_Learning_Domain::get_instance($domain_id);

        if(!$learning_domain->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        $obj_offered = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id));

        if(!$obj_offered->get_id()) {
            Validator::set_error_flash_message(lang('There are no').' '.lang('Program Linked to this course'));
            exit('<script>window.location.reload();</script>');
        }

        if (!Orm_Cm_Program_Learning_Outcome::get_program_learning_outcomes($obj_offered->get_program_id(), $domain_id)) {
            Validator::set_error_flash_message(lang('There are no').' '.lang('Learning Outcomes defined in').' '. " ({$obj_offered->get_program_obj()->get_name()})" );
            exit('<script>window.location.reload();</script>');
        }

        $outcomes = array();
        $course_outcomes = Orm_Cm_Course_Learning_Outcome::get_outcomes($course_id, $domain_id);

        $domain = Orm_Cm_Learning_Domain::get_instance($domain_id);

        if($course_outcomes) {
            foreach($course_outcomes as $outcome_key => $course_outcome) {

                $outcomes[$outcome_key]['course_outcome_id'] = $course_outcome->get_id();
                $outcomes[$outcome_key]['course_outcome_text_en'] = $course_outcome->get_text_en();
                $outcomes[$outcome_key]['course_outcome_text_ar'] = $course_outcome->get_text_ar();
                $outcomes[$outcome_key]['course_outcome_code'] = $course_outcome->get_code();
                $outcomes[$outcome_key]['program_outcome_id'] = $course_outcome->get_program_learning_outcome_id();
            }
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $old_outcomes = $outcomes;
            $outcomes = $this->input->post('outcomes');

            if(!empty($outcomes)) {
                foreach($outcomes as $key => $outcome) {
                    if(isset($outcome['course_outcome_id'])) {
                        Validator::required_field_validator('required_learning_outcome_en_'.(!empty($key) ? $key : '0'),$outcome['course_outcome_text_en'],lang('You can not change this to a blank value'));
                        Validator::required_field_validator('required_learning_outcome_ar_'.(!empty($key) ? $key : '0'),$outcome['course_outcome_text_ar'],lang('You can not change this to a blank value'));
                        Validator::required_field_validator('required_learning_outcome_code_'.(!empty($key) ? $key : '0'),$outcome['course_outcome_code'],lang('You can not leave this to a blank value'));
                        Validator::required_field_validator('required_learning_outcome_program_'.(!empty($key) ? $key : '0'),$outcome['program_outcome_id'],lang('You can not leave this to a blank value'));
                    }
                }
            }

            if($outcomes && Validator::success()) {
                foreach ($outcomes as $outcome) {
                    if (isset($outcome['course_outcome_id'])) {
                        if (!empty($outcome['program_outcome_id'])) {

                            $course_outcome = Orm_Cm_Course_Learning_Outcome::get_instance($outcome['course_outcome_id']);
                            $course_outcome->set_program_learning_outcome_id($outcome['program_outcome_id']);
                            $course_outcome->set_course_id($course_id);
                            $course_outcome->set_learning_domain_id($domain_id);
                            $course_outcome->set_text_en($outcome['course_outcome_text_en']);
                            $course_outcome->set_text_ar($outcome['course_outcome_text_ar']);
                            $course_outcome->set_code($outcome['course_outcome_code']);
                            $course_outcome->save();
                        }
                    }
                }
            }

            $remove_outcomes = arrayRecursiveDiff($old_outcomes, $outcomes);

            if($remove_outcomes && Validator::success()) {
                foreach ($remove_outcomes as $outcome) {
                    if (isset($outcome['course_outcome_id'])) {
                        $course_outcome = Orm_Cm_Course_Learning_Outcome::get_instance($outcome['course_outcome_id']);
                        $course_outcome->delete();
                    }
                }
            }

            if (Validator::success()) {
                json_response(array('status' => true));
            } else {
                $this->view_params['outcomes'] = $outcomes;
                $this->view_params['course_id'] = $course_id;
                $this->view_params['domain'] = $domain;
                $this->view_params['program_id'] = $obj_offered->get_program_id();
                json_response(array('status' => false, 'html' => $this->load->view('course/learning_outcome/add_edit', $this->view_params, true)));
            }

        }

        $this->view_params['outcomes'] = $outcomes;
        $this->view_params['course_id'] = $course_id;
        $this->view_params['domain'] = $domain;
        $this->view_params['program_id'] = $obj_offered->get_program_id();

        $html = $this->load->view('course/learning_outcome/add_edit', $this->view_params, true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * map cpoure learning outcomes with survey
     * @param $id
     */
    public function clo_survey($id) {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $clo = Orm_Cm_Course_Learning_Outcome::get_instance($id);

        if(!$clo->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }
        if (License::get_instance()->check_module('survey') && $this->input->is_ajax_request()) {
            Modules::load('survey');
        } else {
            Validator::set_error_flash_message(lang('The resources you requested does not exist!'));
            exit('<script>location.href="/curriculum_mapping/course/learning_outcome/'.$clo->get_course_id().'";</script>');
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $selected_statement = $this->input->post('selected_items');

            $items = json_decode($selected_statement);
            $statement_ids = [0];

            foreach ($items as $item) {
                if (is_numeric($item)) {
                    $statement_obj = Orm_Survey_Question_Statement::get_instance($item);
                    $plo_survey = Orm_Cm_Course_Learning_Outcome_Survey::get_one(array('course_learning_outcome_id' => $id, 'statement_id' => $item));
                    $plo_survey->set_survey_id($statement_obj->get_factor_obj()->get_question_obj()->get_page_obj()->get_survey_id());
                    $plo_survey->set_factor_id($statement_obj->get_factor_id());
                    $plo_survey->set_statement_id($statement_obj->get_id());
                    $plo_survey->set_course_learning_outcome_id($id);
                    $plo_survey->save();

                    $statement_ids[] = $item;
                }
            }

            foreach (Orm_Cm_Course_Learning_Outcome_Survey::get_all(['course_learning_outcome_id' => $id, 'statement_not_ids' => $statement_ids]) as $statement) {
                $statement->delete();
            }

            Validator::set_success_flash_message(lang('Course Learning Outcome Mapped to Survey'));
            json_response(array('error' => false));
        }

        $this->view_params['clo'] = $clo;

        $this->load->view('course/learning_outcome/survey_mapping', $this->view_params);
    }

    /**
     * get all assessment method for the course
     * @param $course_id
     */
    public function assessment_method($course_id) {

        $course = Orm_Course::get_instance($course_id);

        if(!$course->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/');
        }

        $course_mapping = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id));

        if(!$course_mapping->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/curriculum_mapping/course');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Course Assessment Method'),
            'icon' => 'fa fa-book'
        ), true);

        $this->view_params['link'] = 'assessment_method';
        $this->view_params['course_id'] = $course_id;
        $this->view_params['program_id'] = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id))->get_program_id();
        $this->layout->view('course/assessment_method/list', $this->view_params);
    }

    /**
     * add new assessment methode or update one for course
     * @param $course_id
     * @param $method_id
     */
    public function assessment_method_add_edit($course_id, $method_id) {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $course = Orm_Course::get_instance($course_id);

        if(!$course->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        $obj_offered = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id));

        $program_assessment_methods = Orm_Cm_Program_Assessment_Method::get_all(array('program_id' => $obj_offered->get_program_id()));

        if(empty($program_assessment_methods)) {
            Validator::set_error_flash_message(lang('There are no').' '.lang('Assessment methods defined in') . " ({$obj_offered->get_program_obj()->get_name()})" );
            exit('<script>window.location.reload();</script>');
        }

        $method_obj = Orm_Cm_Program_Assessment_Method::get_instance($method_id);

        if(!$method_obj->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        $methods = array();
        $course_methods = Orm_Cm_Course_Assessment_Method::get_all(array('course_id' => $course_id, 'program_assessment_method_id' => $method_id));

        if($course_methods) {
            foreach($course_methods as $key => $course_method) {
                $methods[$key]['course_method_id'] = $course_method->get_id();
                $methods[$key]['course_method_text_en'] = $course_method->get_text_en();
                $methods[$key]['course_method_text_ar'] = $course_method->get_text_ar();
            }
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $old_methods = $methods;
            $methods = $this->input->post('methods');

            if(!empty($methods)) {
                foreach($methods as $key => $method) {
                    if(isset($method['course_method_id'])) {
                        Validator::required_field_validator('required_learning_outcome_en_'.(!empty($course_key) ? $course_key : '0'),$method['course_method_text_en'],lang('You can not change this to a blank value'));
                        Validator::required_field_validator('required_learning_outcome_ar_'.(!empty($course_key) ? $course_key : '0'),$method['course_method_text_ar'],lang('You can not change this to a blank value'));
                    }
                }
            }

            if($methods && Validator::success()) {
                foreach($methods as $method) {
                    if(isset($method['course_method_id'])) {
                        $course_assessment_method = Orm_Cm_Course_Assessment_Method::get_instance($method['course_method_id']);
                        $course_assessment_method->set_program_assessment_method_id($method_obj->get_id());
                        $course_assessment_method->set_course_id($course_id);
                        $course_assessment_method->set_text_en($method['course_method_text_en']);
                        $course_assessment_method->set_text_ar($method['course_method_text_ar']);
                        $course_assessment_method->save();
                    }
                }
            }

            $remove_methods = arrayRecursiveDiff($old_methods, $methods);

            if($remove_methods && Validator::success()) {
                foreach ($remove_methods as $method) {
                    if (isset($method['course_method_id'])) {
                        $course_assessment_method = Orm_Cm_Course_Assessment_Method::get_instance($method['course_method_id']);
                        $course_assessment_method->delete();
                    }
                }
            }

            if (Validator::success()) {
                json_response(array('status' => true));
            } else {
                $this->view_params['methods'] = $methods;
                $this->view_params['course_id'] = $course_id;
                $this->view_params['method'] = $method_obj;
                json_response(array('status' => false, 'html' => $this->load->view('course/assessment_method/add_edit', $this->view_params, true)));
            }

        }

        $this->view_params['methods'] = $methods;
        $this->view_params['course_id'] = $course_id;
        $this->view_params['method'] = $method_obj;

        $html = $this->load->view('course/assessment_method/add_edit', $this->view_params,true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * map course learning outcomes with assessment method
     * @param $course_id
     * @param $clo_id
     */
    public function clo_assessment_method($course_id, $clo_id) {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $course = Orm_Course::get_instance($course_id);
        if(!$course->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        $col = Orm_Cm_Course_Learning_Outcome::get_instance($clo_id);
        if(!$col->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }


        $assessment_methods = Orm_Cm_Course_Assessment_Method::get_all(array('course_id' => $course_id));

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $mapping = $this->input->post('mapping');
            foreach ($assessment_methods as $method) {
                foreach ($method->get_program_assessment_method_obj()->get_assessment_components() as $assessment_component) {
                    $item = Orm_Cm_Course_Mapping_Matrix::get_one(array('course_id' => $course_id, 'course_learning_outcome_id' => $clo_id, 'course_assessment_method_id' => $method->get_id(), 'course_assessment_component_id' => $assessment_component->get_id()));
                    if (isset($mapping[$method->get_id()][$assessment_component->get_id()]) && $mapping[$method->get_id()][$assessment_component->get_id()]) {
                        $item->set_course_id($course_id);
                        $item->set_course_learning_outcome_id($clo_id);
                        $item->set_course_assessment_method_id($method->get_id());
                        $item->set_course_assessment_component_id($assessment_component->get_id());
                        $item->save();
                    } else {
                        $item->delete();
                    }
                }
            }

            json_response(array('status' => true));
        }

        $this->view_params['methods'] = $assessment_methods;
        $this->view_params['clo_id'] = $clo_id;
        $this->view_params['course_id'] = $course_id;

        $this->load->view('course/assessment_method/learning_outcome_assessment_methods', $this->view_params);
    }

    /**
     * get assessment plan for course
     * @param $course_id
     */
    public function assessment_plan($course_id) {

        $course = Orm_Course::get_instance($course_id);

        if(!$course->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/');
        }

        $course_mapping = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id));

        if(!$course_mapping->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/curriculum_mapping/course');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Course Assessment Plan'),
            'icon' => 'fa fa-book'
        ), true);

        $this->view_params['link'] = 'assessment_plan';
        $this->view_params['course_id'] = $course_id;
        $this->view_params['program_id'] = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id))->get_program_id();
        $this->layout->view('course/assessment_plan/list', $this->view_params);
    }

    /**
     * create new assessment plan or update the info for old assessment plan
     * @param int $id => assessment plan id
     */
    public function assessment_plan_add_edit($id = 0)
    {

        if (!$this->input->is_ajax_request()) {

            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $assessment_plan = Orm_Cm_Assessment_Plan::get_instance($id);

        if($id !=0 && !$assessment_plan->get_id()){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->view_params['assessment_plan'] = $assessment_plan;
        $this->load->view('course/assessment_plan/add_edit', $this->view_params);
    }

    /**
     * remove assessment plan from the course
     * @param $id
     */
    public function assessment_plan_delete($id){
        $assessment_plan = Orm_Cm_Assessment_Plan::get_instance($id);

        if($assessment_plan->delete()) {
            Validator::set_success_flash_message(lang('Successful Delete'));
            exit();
        }
    }

    /**
     * save the data and the updates for course assessment plan
     */
    public function assessment_plan_save()
    {

        $id = $this->input->post('id');
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');

        $assessment_plan = Orm_Cm_Assessment_Plan::get_instance($id);

        Validator::required_field_validator('name_en', $name_en, lang('Required Field'));
        Validator::required_field_validator('name_ar', $name_ar, lang('Required Field'));
        Validator::database_unique_field_validator($assessment_plan, 'name_en', 'name_en', $name_en, lang('Unique Field'));
        Validator::database_unique_field_validator($assessment_plan, 'name_ar', 'name_ar', $name_ar, lang('Unique Field'));

        $assessment_plan->set_name_ar($name_ar);
        $assessment_plan->set_name_en($name_en);

        if (Validator::success()) {

            Validator::set_success_flash_message(lang('Successfully Saved'));

            json_response(['success' => true, 'id' => $assessment_plan->save()]);
        }

        $this->view_params['assessment_plan'] = $assessment_plan;

        json_response(['success' => false, 'html' => $this->load->view('course/assessment_plan/add_edit', $this->view_params, true)]);
    }

    /**
     * @param $course_id
     * @param $method_id
     */
    public function assessment_plan_method_add_edit($course_id, $method_id)
    {

        $obj_offered = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id));

        $program_assessment_methods = Orm_Cm_Program_Assessment_Method::get_all(array('program_id' => $obj_offered->get_program_id()));

        if(empty($program_assessment_methods)) {
            Validator::set_error_flash_message(lang('There are no').' '.lang('Assessment methods defined in') . " ({$obj_offered->get_program_obj()->get_name()})" );
            exit('<script>window.location.reload();</script>');
        }

        $method_obj = Orm_Cm_Assessment_Plan::get_instance($method_id);

        if(!$method_obj->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            exit('<script>window.location.reload();</script>');
        }

        $methods = array();


        $course_methods = Orm_Cm_Course_Assessment_Method::get_all(['course_id'=>$course_id]);

        if($course_methods) {
            foreach($course_methods as $key => $course_method) {
                $methods[$key]['course_method_id'] = $course_method->get_id();
                $methods[$key]['course_method_text_en'] = $course_method->get_text_en();
                $methods[$key]['course_method_text_ar'] = $course_method->get_text_ar();
                $methods[$key]['course_method_text'] = $course_method->get_text();
                $map_methods = Orm_Cm_Assessment_Plan_Map::get_one(array('assessment_plan_id' => $method_id,'assessment_method_id'=>$course_method->get_id() ));


                $methods[$key]['selected'] = $map_methods->get_id();
            }
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $assessment_methods = (array)$this->input->post('assessment_method');

            Orm_Cm_Assessment_Plan_Map::delete_map($method_id);

            foreach ($assessment_methods as $assessment_method){
                $map = new Orm_Cm_Assessment_Plan_Map();
                $map->set_assessment_plan_id($method_id);
                $map->set_assessment_method_id($assessment_method);
                $map->save();
            }

            json_response(array('status' => true));

        }

        $this->view_params['methods'] = $methods;
        $this->view_params['course_id'] = $course_id;
        $this->view_params['method'] = $method_obj;

        $html = $this->load->view('course/assessment_plan/add_edit_component', $this->view_params,true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * get all Course learning outcomes depends on specific course
     */
    public function find_clo() {

        $id = intval($this->input->get_post('id'));

        $plo = Orm_Cm_Course_Learning_Outcome::get_instance($id);

        $course_id    = intval($this->input->post_get('course_id'));
        $program_id    = intval($this->input->post_get('program_id'));
        $department_id = intval($this->input->post_get('department_id'));
        $college_id    = intval($this->input->post_get('college_id'));

        if($plo && $plo->get_id()){
            $course_id    = $course_id?:    $plo->get_course_id();
            $program_id    = $program_id?:   Orm_Program_Plan::get_one(array('course_id' => $plo->get_course_id()))->get_program_id();
            $department_id = $department_id?: Orm_Course::get_instance($plo->get_course_id())->get_department_id();
            $college_id    = $college_id?:    Orm_Course::get_instance($plo->get_course_id())->get_department_obj()->get_college_id();
        }

        $this->view_params['course_id']    = $course_id;
        $this->view_params['program_id']    = $program_id;
        $this->view_params['department_id'] = $department_id;
        $this->view_params['college_id']    = $college_id;

        $this->view_params['clo_id']  = $id;


        $this->layout->set_layout('layout_blank')->view('course/clo', $this->view_params);
    }
}