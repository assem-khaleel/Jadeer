<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Assessment_metric
 */
class Assessment_metric extends MX_Controller
{

    private $view_params = array();

    /**
     * Assessment_metric constructor.
     */
    public function __construct()
    {

        parent::__construct();

        Orm_User::check_logged_in();

        if (!License::get_instance()->check_module('assessment_metric', true)) {
            show_404();
        }
        Orm_User::check_logged_in();

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js', false);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Assessment Metric'),
            'icon' => 'fa fa-calculator'
        ), true);
        $this->view_params['menu_tab'] = 'assessment_metric';
        $this->breadcrumbs->push(lang('Assessment Metric'), '/assessment_metric');
    }

    /**
     *this function get list
     * @return string the calling function
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
            $filters['program_id'] = $fltr['program_id'];
        }
        if (!empty($fltr['college_id'])) {
            $filters['college_id'] = $fltr['college_id'];
        }

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

        $assessment_metric_objs = Orm_Am_Assessment_Metric::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Am_Assessment_Metric::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['assessment_metric_objs'] = $assessment_metric_objs;
        $this->view_params['fltr'] = $fltr;

    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Assessment Metric'),
            'link_attr' => 'href="/assessment_metric/add_edit" data-toggle="ajaxModal"',
            'link_icon' => 'plus',
            'link_title' => lang('Add') . ' ' . lang('New')
        ), true);

        $this->get_list();

        $this->layout->view('list', $this->view_params);
    }

    /**
     * this function add edit meeting by its id
     * @param int $id the id of the assessment metric to be viewed
     * @return string the html view
     */
    public function add_edit($id = 0)
    {

        $this->view_params['assessment_metric'] = Orm_Am_Assessment_Metric::get_instance($id);
        $this->load->view('add_edit', $this->view_params);
    }

    /**
     *this function draw properties
     * @return string the calling function
     */
    public function draw_properties()
    {

        $id = $this->input->post('id');
        $item_class = $this->input->post('item_class');

        $item_class = in_array($item_class, Orm_Am_Assessment_Metric::get_item_class_types()) ? $item_class : Orm_Am_Assessment_Metric::class;
        echo $item_class::get_instance($id)->draw_properties();
    }

    /**
     * this function ajax
     * @return string the html view
     */
    public function ajax()
    {

        $id = $this->input->post('id');
        $item_class = $this->input->post('item_class');
        /** @var $item_class Orm_Am_Assessment_Metric */

        $item_class = in_array($item_class, Orm_Am_Assessment_Metric::get_item_class_types()) ? $item_class : Orm_Am_Assessment_Metric::class;
        echo $item_class::get_instance($id)->ajax();
    }

    /**
     * this function save assessment metric
     * @redirect success or error
     */
    public function save()
    {

        $id = $this->input->post('id');
        $item_class = $this->input->post('item_class');
        /** @var $item_class Orm_Am_Assessment_Metric */
        $item_id = $this->input->post('item_id');
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');
        $college_id = intval($this->input->post('college_id'));
        $department_id = intval($this->input->post('department_id'));
        $program_id = intval($this->input->post('program_id'));
        $target = $this->input->post('target');
        $level = $this->input->post('level');
        $type = $this->input->post('type');
        $extra_data = $this->input->post('extra_data');
        if (!is_array($extra_data)) {
            $extra_data = array();
        }

        if(empty($level)):
            $level = $this->input->post('old_level');
            endif;
        Validator::required_field_validator('item_class', $item_class, lang('Required Filed'));
        Validator::required_field_validator('level', $level, lang('Required Filed'));
        Validator::required_field_validator('name_en', $name_en, lang('Required Filed'));
        Validator::required_field_validator('name_ar', $name_ar, lang('Required Filed'));
        Validator::numeric_field_validator('target', $target, lang('Target should hold a numeric value'));
        Validator::class_exists_validator('item_class', $item_class, lang('Invalid Type'));
        Validator::in_array_validator('item_class', $item_class, Orm_Am_Assessment_Metric::get_item_class_types(), lang('Invalid Type'));
        Validator::not_empty_field_validator('item_id', $item_id, lang('It is a required filed to select one item.'));


        $item_class = in_array($item_class, Orm_Am_Assessment_Metric::get_item_class_types()) ? $item_class : Orm_Am_Assessment_Metric::class;


        Validator::not_empty_field_validator('college_id', $college_id, lang('Required Filed'));
        Validator::not_empty_field_validator('department_id', $department_id, lang('Required Filed'));
        Validator::not_empty_field_validator('program_id', $program_id, lang('Required Filed'));
        if ($target <= 0) {

            Validator::set_error('target', lang('Target Should Be Bigger Than 0'));
        }
        if ($target > 100) {

            Validator::set_error('target', lang('Target Should Be Less Than Or Equal 100'));
        }

        $assessment_metric = $item_class::get_instance($id);

        $assessment_metric->set_item_class($item_class);
        $assessment_metric->set_name_ar($name_ar);
        $assessment_metric->set_name_en($name_en);
        $assessment_metric->set_semester_id(Orm_Semester::get_active_semester_id());
        $assessment_metric->set_level($level);
        $assessment_metric->set_type($type);
        $assessment_metric->set_target($target);
        $assessment_metric->set_extra_data($extra_data);
        $assessment_metric->set_item_id($item_id);
        $assessment_metric->set_college_id($college_id);
        $assessment_metric->set_department_id($department_id);
        $assessment_metric->set_program_id($program_id);


        if (Validator::success()) {
            json_response(['success' => true, 'id' => $assessment_metric->save()]);
        }

        $this->view_params['assessment_metric'] = $assessment_metric;

        json_response(['success' => false, 'html' => $this->load->view('add_edit', $this->view_params, true)]);

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
     * this function delete by its id
     * @param int $id the id of the button to be viewed
     * @redirect success or error
     */
    public function delete($id)
    {
        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($id);

        if ($assessment_metric->get_id()) {
            $assessment_metric->delete();
            Validator::set_success_flash_message(lang('Successful Delete'));
        }

        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     * this function delete component by its id
     * @param int $id the id of the button to be viewed
     * @redirect success or error
     */
    public function delete_component($id)
    {

        $metric_item = Orm_Am_Metric_Item::get_instance($id);

        if ($metric_item->get_id()) {
            $metric_item->delete();
            Validator::set_success_flash_message(lang('Successful Delete'));
        }

        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     *this function manage by its id and level
     * @param int $id the id of the manage
     * @param int $level the level of the manage
     * @return string the html view
     */
    public function manage($id, $level)
    {

        $this->breadcrumbs->push(lang('Manage'), '/manage/' . $id . '/' . $level);


        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($id);
        $all_component = Orm_Am_Metric_Item::get_all(['assessment_metric_id' => $assessment_metric->get_id()]);
        if (!$assessment_metric->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }
        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['item_title'] = $assessment_metric->get_item_title();
        $this->view_params['all_component'] = $all_component;

        if ($level == 1) {
            $this->layout->view('manage_advance', $this->view_params);
        }
        if ($level == 2) {
            $this->layout->view('manage_simple', $this->view_params);
        }

    }

    /**
     *this function add component by its assessment Metric id  and id
     * @param int $assessment_Metric_id the assessment Metric id of the add component
     * @param int $id the id of the add component
     * @return string the html view
     */
    public function add_component($assessment_Metric_id = 0, $id = 0)
    {
        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($assessment_Metric_id);
        $all_component = Orm_Am_Metric_Item::get_all(['assessment_metric_id' => $assessment_metric->get_id()]);

        $sum_weight = 0;
        foreach ($all_component as $one_component) {
            $weight = $one_component->get_weight();
            $sum_weight += $weight;
        }
        $this->view_params['sum_weight'] = $sum_weight;

        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['component'] = Orm_Am_Metric_Item::get_instance($id);
        $this->view_params['program_id'] = $assessment_metric->get_program_id();
        $this->load->view('add_component', $this->view_params);
    }

    /**
     *this function add component gradebook by its assessment Metric id  and id
     * @param int $assessment_Metric_id the assessment Metric id of the add component gradebook
     * @param int $id the id of the add component gradebook
     * @return string the html view
     */
    public function add_component_gradebook($assessment_Metric_id = 0, $id = 0)
    {
        Modules::load('examination');
        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($assessment_Metric_id);
        $all_component = Orm_Am_Metric_Item::get_all(['assessment_metric_id' => $assessment_metric->get_id()]);
        $sum_weight = 0;
        foreach ($all_component as $one_component) {
            $weight = $one_component->get_weight();
            $sum_weight += $weight;
        }
        $this->view_params['sum_weight'] = $sum_weight;
        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['component'] = Orm_Am_Metric_Item::get_instance($id);
        $this->view_params['program_id'] = $assessment_metric->get_program_id();
        $this->load->view('add_component_gradebook', $this->view_params);

    }

    /**
     *this function add component survey by its assessment Metric id  and id
     * @param int $assessment_Metric_id the assessment Metric id of the add component survey
     * @param int $id the id of the add component survey
     * @return string the html view
     */
    public function add_component_survey($assessment_Metric_id = 0, $id = 0)
    {
        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($assessment_Metric_id);
        $all_component = Orm_Am_Metric_Item::get_all(['assessment_metric_id' => $assessment_metric->get_id()]);

        $sum_weight = 0;
        foreach ($all_component as $one_component) {
            $weight = $one_component->get_weight();
            $sum_weight += $weight;
        }
        $this->view_params['sum_weight'] = $sum_weight;
        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['component'] = Orm_Am_Metric_Item::get_instance($id);
        $this->view_params['program_id'] = $assessment_metric->get_program_id();
        $this->load->view('add_component_survey', $this->view_params);

    }

    /**
     *this function getSurveys by its survey type
     * @param string $survey_type the survey type of the getSurveys
     * @return string the calling function
     */
    public function getSurveys($survey_type)
    {
        Modules::load('survey');
        $surveys = Orm_Survey::get_all(['type' => $survey_type, 'has_factor_question' => 'true']);
        $html = '<option value="">' . lang("All surveys") . '</option>';

        foreach ($surveys as $survey) {
            $html .= '<option value="' . $survey->get_id() . '">' . $survey->get_title() . '</option>';
        }
        echo $html;
    }


    /**
     *this function getTests by its course id  and type and current
     * @param int $course_id the course id of the getTests
     * @param array $type the type of the getTests
     * @param int current the current of the getTests
     * @return string the calling function
     */
    public function getTests($course_id, $type, $current = 0)
    {
        Modules::load('examination');
        $testObj = Orm_Tst_Exam::get_all(['course_id' => $course_id, 'type' => $type]);
        $html = '<option value="">'.lang('All tests').'</option>';

        foreach ($testObj as $test) {
            $html .= '<option value="' . $test->get_id() . '"';
            if ($current == $test->get_id())
                $html .= ' selected';
            $html .= '>' . $test->get_name() . '</option>';
        }
        echo $html;
    }

    /**
     *this function save component survey
     * @redirect success or error
     */
    public function save_component_survey()
    {
        Modules::load('survey');
        $id = $this->input->post('id');
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');
        $type = $this->input->post('type');
        $survey_id = $this->input->post('surveys');
        $weight = floatval($this->input->post('weight'));
        $assessment_id = intval($this->input->post('assessment_id'));
        $component_type = $this->input->post('component_type');
        $sum_weight = $this->input->post('sum_weight');

        $survey = Orm_Survey::get_instance($survey_id);

        $average = Orm_Survey_User_Response_Factor::get_average_ranked(['survey_id' => $survey_id]) * 20;

        $score = 100;

        Validator::required_field_validator('surveys', $survey_id, lang('Required Filed'));

        Validator::required_field_validator('name_en', $name_en, lang('Required Filed'));
        Validator::required_field_validator('name_ar', $name_ar, lang('Required Filed'));
        Validator::required_field_validator('weight', $weight, lang('Required Filed'));
        Validator::integer_field_validator('weight', $weight, lang('Only integer value is allowed'));

        Validator::greater_than_validator('weight', 1, $weight, lang('Target must be equal or greater than zero'));

        Validator::required_field_validator('type', $type, lang('Required Filed'));
        Validator::integer_field_validator('type', $type, lang('Only integer value is allowed'));
        if (($sum_weight + $weight) > 100) {
            Validator::set_error('weight', lang('Sum Of Weight Should be Less Than 100'));
        }
        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($assessment_id);
        $component = Orm_Am_Metric_Item::get_instance($id);

        $component->set_component_ar($name_ar);
        $component->set_component_en($name_en);
        $component->set_weight($weight);
        $component->set_high_score($score);
        $component->set_average($average);

        $component->set_assessment_metric_id($assessment_id);

        $component->set_component_id($survey->get_id());
        $component->set_component_type($component_type);


        if ($component->is_valid() && Validator::success()) {
            $result = $average * (100 / $score);
            $result = $result * ($weight / 100);
            $component->set_result($result);

            json_response(['success' => true, 'id' => $component->save()]);
        }
        $this->view_params['sum_weight'] = $sum_weight;
        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['component'] = $component;

        json_response(['success' => false, 'html' => $this->load->view('add_component_survey', $this->view_params, true)]);
    }

    /**
     *this function save component gradebook
     * @redirect success or error
     */
    public function save_component_gradebook()
    {
        Modules::load('examination');
        $id = $this->input->post('id');
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');
        $type = $this->input->post('type');
        $test_id = $this->input->post('test');
        $weight = floatval($this->input->post('weight'));
        $course_id = $this->input->post('course_id');
        $assessment_id = intval($this->input->post('assessment_id'));
        $component_type = $this->input->post('component_type');
        $sum_weight = $this->input->post('sum_weight');

        $test = Orm_Tst_Exam::get_instance($test_id);
        $score = $test->get_fullmark();


        $average = Orm_Tst_Exam_Student_Mark::get_mark_average(['exam_id' => $test_id]);

        Validator::required_field_validator('course_id', $course_id, lang('Required Filed'));
        Validator::integer_field_validator('course_id', $course_id, lang('Only integer value is allowed'));

        Validator::required_field_validator('test', $test_id, lang('Required Filed'));

        Validator::required_field_validator('name_en', $name_en, lang('Required Filed'));
        Validator::required_field_validator('name_ar', $name_ar, lang('Required Filed'));
        Validator::required_field_validator('weight', $weight, lang('Required Filed'));
        Validator::integer_field_validator('weight', $weight, lang('Only integer value is allowed'));

        Validator::greater_than_validator('weight', 1, $weight, lang('Target must be equal or greater than zero'));

        Validator::required_field_validator('type', $type, lang('Required Filed'));
        Validator::integer_field_validator('type', $type, lang('Only integer value is allowed'));
        if (($sum_weight + $weight) > 100) {
            Validator::set_error('weight', lang('Sum Of Weight Should be Less Than 100'));
        }
        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($assessment_id);
        $component = Orm_Am_Metric_Item::get_instance($id);


        $component->set_component_ar($name_ar);
        $component->set_component_en($name_en);
        $component->set_weight($weight);
        $component->set_high_score($score);
        $component->set_average($average);

        $component->set_assessment_metric_id($assessment_id);
        $component->set_course_id($course_id);

        $component->set_component_id($test->get_id());
        $component->set_component_type($component_type);


        if ($component->is_valid() && Validator::success()) {
            $result = $average * (100 / $score);
            $result = $result * ($weight / 100);
            $component->set_result($result);

            json_response(['success' => true, 'id' => $component->save()]);
        }
        $this->view_params['sum_weight'] = $sum_weight;
        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['component'] = $component;
        $this->view_params['program_id'] = $assessment_metric->get_program_id();

        json_response(['success' => false, 'html' => $this->load->view('add_component_gradebook', $this->view_params, true)]);
    }

    /**
     *this function save component
     * @redirect success or error
     */
    public function save_component()
    {

        $id = $this->input->post('id');
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');
        $weight = $this->input->post('weight');
        $score = $this->input->post('score');
        $course_id = $this->input->post('course_id');
        $assessment_id = intval($this->input->post('assessment_id'));

        $sum_weight = $this->input->post('sum_weight');


        Validator::required_field_validator('course_id', $course_id, lang('Required Filed'));
        Validator::required_field_validator('name_en', $name_en, lang('Required Filed'));
        Validator::required_field_validator('name_ar', $name_ar, lang('Required Filed'));
        Validator::required_field_validator('weight', $weight, lang('Required Filed'));
        Validator::required_field_validator('score', $score, lang('Required Filed'));
        Validator::numeric_field_validator('weight', $weight, lang('This field must be a Number'));
        Validator::numeric_field_validator('score', $score, lang('This field must be a Number'));


        if ($weight <= 0) {

            Validator::set_error('weight', lang('Weight Should Be Bigger Than 0'));
        }
        if ($weight > 100) {

            Validator::set_error('weight', lang('Weight Should Be Less Than Or Equal 100'));
        }

        if ($score <= 0) {

            Validator::set_error('score', lang('Component Value Should Be Bigger Than 0'));
        }

        if (($sum_weight + $weight) > 100) {
            Validator::set_error('weight', lang('Sum Of Weight Should be Less Than 100'));
        }


        $component = Orm_Am_Metric_Item::get_instance($id);
        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($assessment_id);
        $component->set_component_ar($name_ar);
        $component->set_component_en($name_en);
        $component->set_weight($weight);
        $component->set_high_score($score);
        $component->set_assessment_metric_id($assessment_id);
        $component->set_course_id($course_id);

        if ($component->is_valid() && Validator::success()) {

            json_response(['success' => true, 'id' => $component->save()]);
            Validator::set_success_flash_message(lang('Successfully Saved'));
        }
        $this->view_params['program_id'] = $assessment_metric->get_program_id();
        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['component'] = $component;
        $this->view_params['sum_weight'] = $sum_weight;


        json_response(['success' => false, 'html' => $this->load->view('add_component', $this->view_params, true)]);

    }

    /**
     *this function save average
     * @redirect success or error
     */
    public function save_average()
    {

        $average = $this->input->post('average');
        $assessment_id = intval($this->input->post('assessment_id'));
        $sum_weight = $this->input->post('sum_weight');


        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($assessment_id);
        if (empty($average)) {
            redirect('/assessment_metric/manage/' . $assessment_id . '/' . $assessment_metric->get_level());
        }

        foreach ($average as $key => $val) {

            $component = Orm_Am_Metric_Item::get_instance($key);
            $score = $component->get_high_score();
            $weight = $component->get_weight();

            Validator::required_field_validator("average_{$component->get_id()}", $val, lang('Required Filed'));
            Validator::numeric_field_validator("average_{$component->get_id()}", $val, lang('This field must be a Number'));

            if ($score < $val) {

                Validator::set_error("average_{$component->get_id()}", lang('Average Should Be Less Than Component Value Or Equal') . ' ' . $score);
            }
            if ($val <= 0) {
                Validator::set_error("average_{$component->get_id()}", lang('Average Should Be Bigger Than 0'));
            }
            if ($score >= $val && $val > 0) {
                $component->set_average($val);
                $result = $val * (100 / $score);
                $result = $result * ($weight / 100);
                $component->set_result($result);
                $component->save();
            }

        }
        $this->view_params['program_id'] = $assessment_metric->get_program_id();
        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['component'] = $component;
        $this->view_params['sum_weight'] = $sum_weight;
        $all_component = Orm_Am_Metric_Item::get_all(['assessment_metric_id' => $assessment_id]);
        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['item_title'] = $assessment_metric->get_item_title();
        $this->view_params['all_component'] = $all_component;

        if (Validator::success()) {
            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['success' => true]);
        } else {
            json_response(['success' => false, 'errors' => Validator::get_errors()]);
        }

    }

    /**
     *this function edit component by its assessment Metric id and id and type
     * @param int $assessment_Metric_id the assessment Metric id of the edit component
     * @param int $id the id of the edit component
     * @param null $type the type of the edit component
     * @return string the calling function
     */
    public function edit_component($assessment_Metric_id = 0, $id = 0, $type = null)
    {
        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($assessment_Metric_id);
        $component = Orm_Am_Metric_Item::get_instance($id);
        $all_component = Orm_Am_Metric_Item::get_all(['assessment_metric_id' => $assessment_metric->get_id()]);

        $item_weight = $component->get_weight();
        $sum_weight = 0;
        foreach ($all_component as $one_component) {
            $weight = $one_component->get_weight();
            $sum_weight += $weight;
        }
        $sum_weight = $sum_weight - $item_weight;
        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['sum_weight'] = $sum_weight;
        $this->view_params['component'] = $component;
        $this->view_params['program_id'] = $assessment_metric->get_program_id();

        switch ($type) {
            case Orm_Tst_Exam::class:
                Modules::load('examination');
                $this->load->view('add_component_gradebook', $this->view_params);
                break;
            case Orm_Survey::class:
                Modules::load('survey');
                $this->load->view('add_component_survey', $this->view_params);
                break;
            case null:
            default:
            $this->load->view('add_component', $this->view_params);
            break;
        }

    }

    /**
     *this function view by its id and level
     * @param int $id the id of the view
     * @param int $level the level of the view
     * @return string the html view
     */
    public function view($id, $level)
    {

        $this->breadcrumbs->push(lang('View'), '/view/' . $id . '/' . $level);

        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($id);
        $all_component = Orm_Am_Metric_Item::get_all(['assessment_metric_id' => $assessment_metric->get_id()]);

        if (!$assessment_metric->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }
        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['item_title'] = $assessment_metric->get_item_title();
        $this->view_params['all_component'] = $all_component;

        if ($level == 1) {
            $this->layout->view('view_advance', $this->view_params);
        }
        if ($level == 2) {
            $this->layout->view('view_simple', $this->view_params);
        }

    }

    /**
     *this function pdf by its id
     * @param int $id the id of the pdf
     * @redirect download file
     */
    public function pdf($id)
    {
        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($id);
        $all_component = Orm_Am_Metric_Item::get_all(['assessment_metric_id' => $assessment_metric->get_id()]);

        if ($assessment_metric->get_id()) {
            $assessment_metric->generate_pdf($all_component);
        }

        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     * this function analysis by its id
     * @param int $id the id of the analysis to be viewed
     * @return string the html view
     */
    public function analysis($id = 0)
    {
        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($id);
        $all_component = Orm_Am_Metric_Item::get_all(['assessment_metric_id' => $assessment_metric->get_id()]);
        $this->view_params['assessment_metric'] = $assessment_metric;
        $this->view_params['all_component'] = $all_component;
        $this->load->view('edit_analysis', $this->view_params);
    }

    /**
     *this function save evaluation
     * @redirect success or error
     */
    public function save_analysis()
    {
        $id = $this->input->post('id');
        $weakness_en = $this->input->post('weakness_en');
        $weakness_ar = $this->input->post('weakness_ar');
        $strength_en = $this->input->post('strength_en');
        $strength_ar = $this->input->post('strength_ar');

        $assessment_metric = Orm_Am_Assessment_Metric::get_instance($id);
        $assessment_metric->set_weakness_ar($weakness_ar);
        $assessment_metric->set_weakness_en($weakness_en);
        $assessment_metric->set_strength_en($strength_en);
        $assessment_metric->set_strength_ar($strength_ar);

        Validator::not_empty_field_validator('weakness_en', $weakness_en, lang('Error: This field is required'));
        Validator::not_empty_field_validator('weakness_ar', $weakness_ar, lang('Error: This field is required'));
        Validator::not_empty_field_validator('strength_en', $strength_en, lang('Error: This field is required'));
        Validator::not_empty_field_validator('strength_ar', $strength_ar, lang('Error: This field is required'));

        if ($assessment_metric->is_valid() && Validator::success()) {
            $assessment_metric->save();

            Validator::set_success_flash_message(lang('Successfully saved'));
            json_response(['success' => true]);
        }

        $this->view_params['assessment_metric'] = $assessment_metric;
        json_response(['success' => false, 'html' => $this->load->view('add_edit', $this->view_params, true)]);


    }

    /**
     *this function get_domain
     * @return string this string is a html <select> for all domain fetch curriculum mapping
     */
    public function get_domain()
    {

        if (!License::get_instance()->check_module('curriculum_mapping')) {
            show_404();
        }

        Modules::load('curriculum_mapping');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $type_id = intval($this->input->post('type_id'));
        $list = Orm_Cm_Learning_Domain::get_all(array('type' => $type_id));

        $options = '<option value="0">' . lang('All Domains') . '</option>';
        if ($list) {

            foreach ($list as $option) {

                $options .= '<option value="' . $option->get_id() . '">' . htmlfilter($option->get_title()) . '</option>';

            }

        }
        $html = '';
        if (boolval($this->input->post('option_only'))) {
            $html .= $options;
        } else {

            $html .= '<div class="form-group">';
            $html .= '<label class=" col-md-2 control-label">' . lang('Learning Domain') . '</label>';
            $html .= '<div class="col-md-10">';
            $html .= "<select name='domain_id' class='form-control'>";
            $html .= $options;
            $html .= '</select>';
            $html .= '</div>';
            $html .= '</div>';
        }

        exit($html);

    }


}