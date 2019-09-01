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
 * Class Course_Section
 */
class Course_Section extends MX_Controller
{

    /**
     *@var $view_params array => the array pf data that will send to views
     * @var $course  object of course information
     */
    private $view_params;
    private $course;

    /**
     * Course_Section constructor.
     */
    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        if (!License::get_instance()->check_module('curriculum_mapping', true)) {
            show_404();
        }

        $course_id = (int)$this->input->get_post('course_id');
        $this->course = Orm_Course::get_instance($course_id);

        if (!$this->course->get_id()) {
            Validator::set_error_flash_message(lang('There are no') . ' ' . lang('Course'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        $course_mapping = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id));

        if(!$course_mapping->get_id()){
            Validator::set_error_flash_message("The resources you requested does not exist!");
            redirect('/curriculum_mapping/course');
        }

        $this->breadcrumbs->push(lang('Curriculum Mapping'), '/curriculum_mapping');
        $this->breadcrumbs->push(lang('Course Management'), '/curriculum_mapping/course');

        $this->layout->add_javascript('/assets/jadeer/js/add_more.js');

        $this->view_params['menu_tab'] = 'curriculum_mapping';
        $this->view_params['link'] = 'section';
        $this->view_params['course'] = $this->course;

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Course Management'),
            'icon' => 'fa fa-book',
            'menu_view' => 'curriculum_mapping/sub_menu',
            'menu_params' => array('type' => 'course')
        ), true);
    }

    /**
     * collect all data that related to course section
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
        $filters['course_id'] = $this->course->get_id();
        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

        if (Orm_User::has_role_teacher() && Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['in_id'] = Orm_Course_Section_Teacher::get_section_ids();
        }

        $course_sections = Orm_Course_Section::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course_Section::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['course_sections'] = $course_sections;
        $this->view_params['fltr'] = $fltr;

        $this->layout->view('course_section/management', $this->view_params);
    }

    /**
     * create question for each assessment methods and map it with learning outcomes
     * @param $section_id
     * @param int $method_id
     */
    public function question_mapping($section_id, $method_id = 0)
    {

        $section_obj = Orm_Course_Section::get_instance($section_id);

        if ($section_obj->get_semester_id() != Orm_Semester::get_active_semester()->get_id()) {
            Validator::set_error_flash_message(lang('This Section is not Available in this Semester'));
            redirect("/curriculum_mapping/course_section?course_id={$this->course->get_id()}");
        }

        $course_assessment_methods = Orm_Cm_Course_Assessment_Method::get_all(array('course_id' => $this->course->get_id()));

        if ($this->input->is_ajax_request() && empty($course_assessment_methods)) {
            Validator::set_error_flash_message(lang('There are no') . ' ' . lang('Assessment methods defined in') . " ({$this->course->get_name()})");
            exit('<script>window.location.replace("/curriculum_mapping/course_section?course_id=' . $this->course->get_id() . '");</script>');
        }

        $domains = array();
        $questions = array();
        if ($method_id) {

            $assessment_method_obj = Orm_Cm_Course_Assessment_Method::get_instance($method_id);
            if (!$assessment_method_obj->get_id()) {
                Validator::set_error_flash_message(lang('The selected course does not have the selected assessment method'));
                redirect('/curriculum_mapping/course_section?course_id=' . $this->course->get_id());
            }

            foreach (Orm_Cm_Course_Mapping_Matrix::get_all(array('course_id' => $section_obj->get_course_id(), 'course_assessment_method_id' => $method_id)) as $row) {

                $domains[$row->get_course_learning_outcome_obj()->get_learning_domain_id()][$row->get_course_learning_outcome_id()] = $row->get_course_learning_outcome_obj();
            }
            $matrix = Orm_Cm_Section_Mapping_Question::get_all(array('section_id' => $section_id, 'course_assessment_method_id' => $method_id));

            foreach ($matrix as $question) {
                $questions[$question->get_id()]['text'] = $question->get_question();
                $questions[$question->get_id()]['scale'] = $question->get_full_mark();
                $questions[$question->get_id()]['id'] = $question->get_id();
                $questions[$question->get_id()]['outcomes'] = array();
                if (is_array($question->get_course_learning_outcomes_ids())) {
                    foreach ($question->get_course_learning_outcomes_ids() as $outcome_id) {
                        $questions[$question->get_id()]['outcomes'][$outcome_id] = $outcome_id;
                    }
                }
            }
            sort($questions);
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $old_questions = $questions;
            $questions = $this->input->post('questions');

            if ($questions) {
                foreach ($questions as $key => $question) {
                    if (isset($question['id'])) {
                        $message = lang('Required Field');
                        Validator::required_field_validator('required_question_scale_' . (!empty($key) ? $key : '0'), $question['scale'], $message);
                        Validator::required_field_validator('required_question_text_' . (!empty($key) ? $key : '0'), $question['text'], $message);
                        Validator::required_array_validator('required_question_outcomes_' . (!empty($key) ? $key : '0'), isset($question['outcomes']) ? $question['outcomes'] : array(), lang('Select at least one Learning Outcome'));
                    }
                }
            }

            if ($questions && Validator::success()) {
                foreach ($questions as $item) {
                    if (isset($item['id'])) {
                        $outcomes = array();
                        $question = Orm_Cm_Section_Mapping_Question::get_instance($item['id']);
                        $question->set_course_assessment_method_id($method_id);
                        $question->set_section_id($section_id);
                        $question->set_full_mark($item['scale']);
                        $question->set_question($item['text']);
                        foreach ($item['outcomes'] as $outcome) {
                            $outcomes[] = intval($outcome);
                        }
                        $question->set_course_learning_outcomes_ids($outcomes);
                        $question->save();
                    }
                }
            }

            $remove_questions = arrayRecursiveDiff($old_questions, $questions);

            if ($remove_questions && Validator::success()) {
                foreach ($remove_questions as $question) {
                    if (isset($question['id'])) {
                        $question_obj = Orm_Cm_Section_Mapping_Question::get_instance($question['id']);
                        $question_obj->delete();
                    }
                }
            }

            if (Validator::success()) {
                Validator::set_success_flash_message(lang('Questions Saved Successfully'));
                json_response(array('status' => true));

            } else {
                $this->view_params['domains'] = $domains;
                $this->view_params['questions'] = $questions;

                $this->view_params['assessment_methods'] = $course_assessment_methods;
                $this->view_params['section_id'] = $section_id;
                $this->view_params['method_id'] = $method_id;
                json_response(array('status' => false, 'html' => $this->load->view('course_section/questions', $this->view_params, true)));
            }
        }

        $this->view_params['domains'] = $domains;
        $this->view_params['questions'] = $questions;

        $this->view_params['assessment_methods'] = $course_assessment_methods;
        $this->view_params['section_id'] = $section_id;
        $this->view_params['method_id'] = $method_id;

        $this->layout->view('course_section/question_mapping', $this->view_params);
    }

    /**
     * show student score in each assessment methods
     * @param $section_id
     * @param int $method_id
     */
    public function students_assessment($section_id, $method_id = 0)
    {
        $section_obj = Orm_Course_Section::get_instance($section_id);

        if ($section_obj->get_semester_id() != Orm_Semester::get_active_semester()->get_id()) {
            Validator::set_error_flash_message(lang('This Section is not Available in this Semester'));
            redirect("/curriculum_mapping/course_section?course_id={$this->course->get_id()}");
        }

        $course_assessment_methods = Orm_Cm_Course_Assessment_Method::get_all(array('course_id' => $this->course->get_id()));

        if (empty($course_assessment_methods)) {
            Validator::set_error_flash_message(lang('There are no') . ' ' . lang('Assessment methods defined in') . " ({$this->course->get_name()})");
            redirect("/curriculum_mapping/course_section?course_id=" . $this->course->get_id());
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array(
            'section_id' => $section_id
        );

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }
        $students = Orm_Course_Section_Student::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course_Section_Student::get_count($filters));

        $domains = array();
        $questions = array();


        if ($method_id) {

            $assessment_method_obj = Orm_Cm_Course_Assessment_Method::get_instance($method_id);
            if (!$assessment_method_obj->get_id()) {
                Validator::set_error_flash_message(lang('The selected course does not have the selected assessment method'));
                redirect('/curriculum_mapping/course_section?course_id=' . $this->course->get_id());
            }

            foreach (Orm_Cm_Course_Mapping_Matrix::get_all(array('course_id' => $section_obj->get_course_id(), 'course_assessment_method_id' => $method_id)) as $row) {
                $domains[$row->get_course_learning_outcome_obj()->get_learning_domain_id()][$row->get_course_learning_outcome_id()] = $row->get_course_learning_outcome_obj();
            }
            $questions = Orm_Cm_Section_Mapping_Question::get_all(array('section_id' => $section_id, 'course_assessment_method_id' => $method_id), 0, 0, array('id'));

        }

        $this->view_params['assessment_methods'] = $course_assessment_methods;
        $this->view_params['section_id'] = $section_id;
        $this->view_params['domains'] = $domains;
        $this->view_params['method_id'] = $method_id;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['students'] = $students;
        $this->view_params['questions'] = $questions;

        $this->layout->view('course_section/view_students_curriculum', $this->view_params);
    }

    /**
     * save the scores that student get it in every question
     * @param $section_id
     */
    public function save_scores($section_id)
    {
        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'), true);
            redirect('/');
        }

        $section = Orm_Course_Section::get_instance($section_id);


        if (!($section && $section->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $all_scores = $this->input->post('scores');
        $full_marks = $this->input->post('q_full_marks');

        if ($all_scores) {

            foreach ($all_scores as $student_id => $questions) {
                foreach ($questions as $question_id => $scores) {
                    foreach ($scores as $score_id => $score) {

                        $validator_name = 'scores_' . $student_id . '_' . $question_id . '_' . $score_id;

                        Validator::less_than_validator($validator_name, $score, 0, lang('Score Must be Greater than 0'));
                        Validator::greater_than_validator($validator_name, $score, $full_marks[$question_id], lang('Score must be less than') . ' ' . $full_marks[$question_id]);
                    }
                }
            }

            if (Validator::success()) {

                foreach ($all_scores as $student_id => $questions) {
                    foreach ($questions as $question_id => $scores) {
                        foreach ($scores as $score_id => $score) {

                            $obj = Orm_Cm_Section_Student_Assessment::get_instance($score_id);
                            $obj->set_section_id($section_id);
                            $obj->set_section_mapping_question_id($question_id);
                            $obj->set_student_id($student_id);
                            $obj->set_score($score);
                            $obj->save();
                        }
                    }
                }
                Validator::set_success_flash_message(lang('Student Score Successfully Saved'));
                json_response(['success' => true]);

            } else {
                json_response(['success' => false, 'errors' => Validator::get_errors()]);
            }
        }
    }

    /**
     * show learning outcomes that the question already mapped
     * @param $section_id
     * @param $method_id
     */
    public function view_outcomes($section_id, $method_id)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'), true);
            redirect('/');
        }


        $section_obj = Orm_Course_Section::get_instance($section_id);


        if (!($section_obj && $section_obj->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect("/curriculum_mapping/course_section?course_id={$this->course->get_id()}");
        }
        if (!($method_id)) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect("/curriculum_mapping/course_section?course_id={$this->course->get_id()}");
        }

        $domains = array();
        $questions = array();

        foreach (Orm_Cm_Course_Mapping_Matrix::get_all(array('course_id' => $section_obj->get_course_id(), 'course_assessment_method_id' => $method_id)) as $row) {
            $domains[$row->get_course_learning_outcome_obj()->get_learning_domain_id()][$row->get_course_learning_outcome_id()] = $row->get_course_learning_outcome_obj();
        }

        $questions = Orm_Cm_Section_Mapping_Question::get_all(array('section_id' => $section_id, 'course_assessment_method_id' => $method_id), 0, 0, array('id'));

        $this->view_params['section_id'] = $section_id;
        $this->view_params['method_id'] = $method_id;
        $this->view_params['domains'] = $domains;
        $this->view_params['questions'] = $questions;

        $this->load->view('course_section/view_outcomes', $this->view_params);


    }
}