<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Rubrics
 */
class Rubrics extends MX_Controller
{

    private $view_params = array();

    /**
     * Rubrics constructor.
     */
    public function __construct()
    {
        parent::__construct();


        if (!License::get_instance()->check_module('rubrics', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        if (!defined('MODULES_ONLY')) {

            Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'rubrics-list');

            if (!Orm_User::check_credential_or([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, ['rubrics-manage', 'rubrics-admin'])) {
                redirect('/rubrics/assigned');
            }

        }
        $this->breadcrumbs->push(lang('Rubrics'), '/rubrics');


        $this->view_params['menu_tab'] = 'rubrics';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Rubrics'),
            'icon' => 'fa fa-file'
        ), true);
    }

    /**
     *this function index
     * @return string the html view
     * default controller action
     */
    public function index()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', [
            'title' => lang('Rubrics'),
            'icon' => 'fa fa-file',
            'menu_view' => 'rubrics/sub_menu',
            'list' => 'list',
            'link_attr' => 'href="/rubrics/add_edit/" data-toggle="ajaxModal"',
            'link_title' => lang('Add').' '.lang('Rubric'),
            'link_icon' => 'plus',
        ], true);

        $filter = [];

        if (!Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, ['rubrics-admin'])) {
            $filter = ['creator' => Orm_User::get_logged_user_id()];
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_per_page($this->config->item('per_page'));
        $pager->set_page((int)$this->input->get_post('page') ?: 1);
        $pager->set_total_count(Orm_Rb_Rubrics::get_count($filter));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['rubrics'] = Orm_Rb_Rubrics::get_all($filter, $pager->get_page(), $pager->get_per_page());


        $this->layout->view('list', $this->view_params);
    }

    /**
     *this function settings
     * @return string the html view
     */
    public function settings()
    {

        Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, ['rubrics-admin']);

        $vars = [
            'title' => lang('Rubrics'),
            'icon' => 'fa fa-file',
            'menu_view' => 'rubrics/sub_menu',
            'list' => 'settings'
        ];

        $this->view_params['values'] = [];


        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $values = $this->input->post('value');

            $this->view_params['values'] = $values;

            Validator::required_array_validator('value', $values, lang('field required'));

            $val = [];

            foreach ($values as $key => $value) {

                $val[$key] = Orm_Rb_Settings::get_one(['key_text' => $key]);

                if (!$val[$key]->get_id() || trim($value) == '') {
                    Validator::set_error($key, lang("Required Field"));
                }

                $val[$key]->set_key_value(trim($value));
            }

            if (Validator::success()) {
                foreach ($val as $row) {
                    $row->save();
                }

                Validator::set_success_flash_message(lang('Successfully Saved'));
            }
        }


        $this->view_params['page_header'] = $this->load->view('/common/page_header', $vars, true);
        $this->view_params['settings'] = Orm_Rb_Settings::get_all();
        $this->layout->view('settings', $this->view_params);
    }

    /**
     * this function add edit by its id
     * @param int $id the id of the add edit to be viewed
     * @redirect success or error
     */
    public function add_edit($id = 0)
    {

        $rubric = Orm_Rb_Rubrics::get_instance($id);

        if (intval($id) > 0 && !$rubric->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if ($rubric->get_id() && !$rubric->can_manage()) {
            if ($this->input->is_ajax_request()) {
                echo error_dialog(lang('Permissions Denied'));
                die();
            }
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(base_url('/'));
        }

        $this->view_params['rubric'] = $rubric;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $name_ar = $this->input->post('name_ar');
            $name_en = $this->input->post('name_en');
            $desc_ar = $this->input->post('desc_ar');
            $desc_en = $this->input->post('desc_en');
            $scale_count = intval($this->input->post('scale_count'));
            $weight_type = intval($this->input->post('weight_type'));
            $rubric_type = intval($this->input->post('rubric_type'));
            $rubric_class = $this->input->post('rubric_class');
            $extra_value = $this->input->post('extra_value');

            if ($weight_type) {
                $weight_type = $weight_type == Orm_Rb_Rubrics::WEIGHT_TYPE_POINTS ? Orm_Rb_Rubrics::WEIGHT_TYPE_POINTS : Orm_Rb_Rubrics::WEIGHT_TYPE_PERCENTAGE;
            }

            if ($rubric_type) {
                $rubric_type = $rubric_type == Orm_Rb_Rubrics::RUBRIC_TYPE_SUMMATIVE ? Orm_Rb_Rubrics::RUBRIC_TYPE_SUMMATIVE : Orm_Rb_Rubrics::RUBRIC_TYPE_FORMATIVE;
            }

            $rubric->set_name_ar($name_ar);
            $rubric->set_name_en($name_en);
            $rubric->set_desc_en($desc_en);
            $rubric->set_desc_ar($desc_ar);
            $rubric->set_date_modified(date('Y-m-d'));

            if (!$rubric->get_id()) {
                $rubric->set_rubric_class($rubric_class);
                $rubric->set_weight_type($weight_type);
                $rubric->set_rubric_type($rubric_type);
                $rubric->set_extra_data($extra_value);
                $rubric->set_creator(Orm_User::get_logged_user_id());
                $rubric->set_date_added(date('Y-m-d'));
            }


            Validator::required_field_validator('name_ar', $name_ar, lang('field required'));
            Validator::required_field_validator('name_en', $name_en, lang('field required'));
            Validator::required_field_validator('desc_ar', $desc_ar, lang('field required'));
            Validator::required_field_validator('desc_en', $desc_en, lang('field required'));
            if (!$rubric->get_id()) {
                Validator::in_array_validator('rubric_class', $rubric_class, Orm_Rb_Rubrics::get_classes(), lang('field required'));
                Validator::less_than_validator('scale_count', $scale_count, Orm_Rb_Settings::get_value('scale_count'), lang("Scale Count can't use be less than") . ' ' . Orm_Rb_Settings::get_value('scale_count'));
            }

            if ($rubric->get_id()) {
                $rubric_class = Orm_Rb_Rubrics::class;
            }

            if (Validator::success() && $rubric_class::is_valid()) {
                $id = $rubric->save();

                for ($i = 1; $i <= $scale_count; $i++) {
                    $scale_obj = new Orm_Rb_Scale();
                    $scale_obj->set_rubrics_id($id);
                    $scale_obj->set_name_en(Orm_Rb_Settings::get_value('scale_text_en') . ' ' . $i);
                    $scale_obj->set_name_ar(Orm_Rb_Settings::get_value('scale_text_ar') . ' ' . $i);
                    $scale_obj->set_weight(0);
                    $scale_obj->save();
                }

                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['success' => true]);
            }

            json_response(['success' => false, 'html' => $this->load->view('add_edit', $this->view_params, true)]);
        }

        $this->load->view('add_edit', $this->view_params);
    }

    /**
     * this function get properties
     * @return string the html view
     */
    public function get_properties()
    {

        $class = $this->input->get_post('class');

        if (!(in_array($class, Orm_Rb_Rubrics::get_classes()) && class_exists($class))) {
            $class = Orm_Rb_Rubrics::class;
        }

        echo $class::get_properties();
    }

    /**
     * this function delete by its id
     * @param int $id the id of the delete to be viewed
     * @redirect success or error
     */
    public function delete($id = 0)
    {

        $obj = Orm_Rb_Rubrics::get_instance($id);

        if (!$obj->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            if ($this->input->is_ajax_request()) {
                exit;
            }
            redirect(base_url('/'));
        }

        if (!$obj->can_manage()) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            if ($this->input->is_ajax_request()) {
                exit;
            }
            redirect(base_url('/'));
        }

        if ($obj->has_answer()) {
            Validator::set_error_flash_message(lang('This Rubric has answers'));
            if ($this->input->is_ajax_request()) {
                exit;
            }
            redirect(base_url('/'));
        }

        foreach ($obj->get_scales() as $scale) {
            $scale->delete();
        }

        foreach ($obj->get_skills() as $skill) {
            $skill->delete();
        }

        foreach ($obj->get_table() as $row) {
            $row->delete();
        }

        $obj->delete();
    }

    /**
     * this function preview by its id
     * @param int $id the id of the preview to be viewed
     * @return string the html view
     */
    public function preview($id = 0)
    {

        $rubric = Orm_Rb_Rubrics::get_instance($id);

        if (intval($id) > 0 && !$rubric->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if (!$rubric->can_manage()) {
            if ($this->input->is_ajax_request()) {
                echo error_dialog(lang('Permissions Denied'));
                die();
            }
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(base_url('/'));
        }


        $this->breadcrumbs->push(lang('Preview'), '/rubrics/preview/' . $id);


        $this->view_params['rubric'] = $rubric;

        $this->layout->view('rubrics/preview', $this->view_params);
    }

    /**
     * this function report by its id
     * @param int $id the id of the report to be viewed
     * @return string the html view
     */
    public function report($id = 0)
    {

        $rubric = Orm_Rb_Rubrics::get_instance($id);
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $filters = array();

        if (!$page) {
            $page = 1;
        }

        if (intval($id) > 0 && !$rubric->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if (!$rubric->can_manage()) {
            if ($this->input->is_ajax_request()) {
                echo error_dialog(lang('Permissions Denied'));
                die();
            }
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(base_url('/'));
        }

        $filters['rubric_id'] = $id;
        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

        $this->breadcrumbs->push(lang(' Report'), '/rubrics/report/' . $id);

        $results = Orm_Rb_Result::get_all($filters, $page, $per_page);

        //echo "<pre>";print_r($results);die();


        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Rb_Result::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['rubric'] = $rubric;
        $this->view_params['results'] = $results;

        $this->layout->view('rubrics/report', $this->view_params);
    }

    /**
     * this function manage by its id
     * @param int $id the id of the manage to be viewed
     *@redirect success or error
     */
    public function manage($id = 0)
    {

        $rubric = Orm_Rb_Rubrics::get_instance($id);

        if (intval($id) > 0 && !$rubric->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if (!$rubric->can_manage()) {
            if ($this->input->is_ajax_request()) {
                echo error_dialog(lang('Permissions Denied'));
                die();
            }
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(base_url('/'));
        }

        $this->breadcrumbs->push(lang('Manage'), '/rubrics/manage/' . $id);


        $this->view_params['rubric'] = $rubric;

        $this->view_params['current_skills'] = $rubric->get_skills();
        $this->view_params['current_scales'] = [];

        foreach ($rubric->get_table() as $scale) {
            $this->view_params['current_scales'][$scale->get_skill_id()][$scale->get_scale_id()] = $scale;
        }

        $this->view_params['new_skills'] = [];
        $this->view_params['new_scales'] = [];

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $current_skills = (array)$this->input->post('current_skill');
            $new_skills = (array)$this->input->post('new_skill');

            $skill_ids = [];

            $skill_total_value = 0;

            $cSkill = [];
            /** @var Orm_Rb_Table[][] $cScale */
            $cScale = $this->view_params['current_scales'];
            foreach ($current_skills as $key_skill => $cuSkill) {
                $skill_ids[] = $key_skill;
                $cSkill[$key_skill] = Orm_Rb_Skills::get_instance($key_skill);
                $cSkill[$key_skill]->set_name_ar($cuSkill['ar'] ?: '');
                $cSkill[$key_skill]->set_name_en($cuSkill['en'] ?: '');
                $cSkill[$key_skill]->set_value($cuSkill['value'] ?: 0);
                $cSkill[$key_skill]->set_date_modified(time());

                $skill_total_value += $cSkill[$key_skill]->get_value();

                Validator::required_field_validator('current_skill_ar', $cuSkill['ar'], lang('This field is required'), $key_skill);
                Validator::required_field_validator('current_skill_en', $cuSkill['en'], lang('This field is required'), $key_skill);
                Validator::required_field_validator('current_skill_value', $cuSkill['value'], lang('This field is required'), $key_skill);
                // Validator::less_than_validator('current_skill_value', $cuSkill['value'], 1, lang('This field is required'), $key_skill);
//                Validator::less_than_validator('current_skill_value', $cuSkill['value'], 100, lang('Skill value should not greater than 100 '), $key_skill);
//               Validator::greater_than_validator('current_skill_value', $cuSkill['value'], 101, lang('Skill value should not greater than 100 '), $key_skill);


                foreach ($cuSkill['scales'] as $key_scale => $scale) {

                    if (!isset($cScale[$key_skill])) {
                        $cScale[$key_skill] = [];

                    }
                    if (!isset($cScale[$key_skill][$key_scale])) {
                        $cScale[$key_skill][$key_scale] = new Orm_Rb_Table();
                        $cScale[$key_skill][$key_scale]->set_skill_id($key_skill);
                        $cScale[$key_skill][$key_scale]->set_date_added(time());
                    }

                    $cScale[$key_skill][$key_scale]->set_description_ar($scale['desc_ar']);
                    $cScale[$key_skill][$key_scale]->set_description_en($scale['desc_en']);
                    $cScale[$key_skill][$key_scale]->set_target($scale['target']);
                    $cScale[$key_skill][$key_scale]->set_scale_id($key_scale);
                    $cScale[$key_skill][$key_scale]->set_rubric_id($id);
                    $cScale[$key_skill][$key_scale]->set_date_modified(time());

                    Validator::required_field_validator('current_desc_ar_' . $key_skill, $scale['desc_ar'] ?: '', lang('This field is required'), $key_scale);
                    Validator::required_field_validator('current_desc_en_' . $key_skill, $scale['desc_en'] ?: '', lang('This field is required'), $key_scale);
                    Validator::required_field_validator('current_target_' . $key_skill, $scale['target'] ?: '', lang('This field is required'), $key_scale);
                    Validator::less_than_validator('current_target_' . $key_skill, $cuSkill['value'], 1, lang('This field is required'), $key_scale);
//                    Validator::greater_than_validator('current_target_' . $key_skill, $cScale[$key_skill][$key_scale]->get_target() ,  Orm_Rb_Scale::get_instance($key_scale)->get_weight(), lang('Scale Target Must be less than Scale weight'), $key_scale);
                }
            }

            $this->view_params['current_scales'] = $cScale;


            $nSkill = [];
            $nScale = [];
            foreach ($new_skills as $key_skill => $skill) {

                $nSkill[$key_skill] = new Orm_Rb_Skills();
                $nSkill[$key_skill]->set_rubrics_id($id);
                $nSkill[$key_skill]->set_name_ar($skill['ar'] ?: '');
                $nSkill[$key_skill]->set_name_en($skill['en'] ?: '');
                $nSkill[$key_skill]->set_value($skill['value'] ?: 0);
                $nSkill[$key_skill]->set_date_added(time());
                $nSkill[$key_skill]->set_date_modified(time());


                $skill_total_value += $nSkill[$key_skill]->get_value();


                Validator::required_field_validator('skill_ar', $skill['ar'], lang('This field is required'), $key_skill);
                Validator::required_field_validator('skill_en', $skill['en'], lang('This field is required'), $key_skill);
                Validator::required_field_validator('skill_value', $skill['value'], lang('This field is required'), $key_skill);
                Validator::less_than_validator('skill_value', $skill['value'], 1, lang('This field is required'), $key_skill);

                $nScale[$key_skill] = [];

                foreach ($skill['scales'] as $key_scale => $scale) {
                    $nScale[$key_skill][$key_scale] = new Orm_Rb_Table();

                    $nScale[$key_skill][$key_scale]->set_description_ar($scale['desc_ar']);
                    $nScale[$key_skill][$key_scale]->set_description_en($scale['desc_en']);
                    $nScale[$key_skill][$key_scale]->set_target($scale['target']);
                    $nScale[$key_skill][$key_scale]->set_scale_id($key_scale);
                    $nScale[$key_skill][$key_scale]->set_rubric_id($id);
                    $nScale[$key_skill][$key_scale]->set_date_added(time());
                    $nScale[$key_skill][$key_scale]->set_date_modified(time());

                    Validator::required_field_validator('desc_ar_' . $key_skill, $scale['desc_ar'] ?: '', lang('This field is required'), $key_scale);
                    Validator::required_field_validator('desc_en_' . $key_skill, $scale['desc_en'] ?: '', lang('This field is required'), $key_scale);
//                    Validator::required_field_validator('target_'.$key_skill, $scale['target']?:'', lang('This field is required'), $key_scale);
//                    Validator::less_than_validator('target_'.$key_skill, $skill['value'], 1, lang('This field is required'), $key_scale);
                }
            }

            $this->view_params['new_skills'] = $nSkill;
            $this->view_params['new_scales'] = $nScale;


            if ($rubric->get_weight_type() == Orm_Rb_Rubrics::WEIGHT_TYPE_PERCENTAGE and $skill_total_value > 100) {
                Validator::set_error('skills_weight', lang('Skill value Total should not greater than 100'));
            }
            if ($rubric->get_weight_type() == Orm_Rb_Rubrics::WEIGHT_TYPE_PERCENTAGE and $skill_total_value < 100) {
                Validator::set_error('skills_weight', lang('Skill value Total should not Less than 100'));

            }

            if (Validator::success()) {

                foreach ($cSkill as $skill) {
                    $skill->save();

                    foreach ($cScale[$skill->get_id()] as $scale) {
                        $scale->save();
                    }
                }

                $rubric->delete_skills_not_in($skill_ids);

                foreach ($new_skills as $key_skill => $skill) {
                    $nSkill[$key_skill]->save();

                    foreach ($nScale[$key_skill] as $key_scale => $scale) {

                        $scale->set_skill_id($nSkill[$key_skill]->get_id());
                        $scale->save();
                    }
                }

                Validator::set_success_flash_message(lang('Successfully Saved'));
                redirect('/rubrics/manage/' . $id);
            }
        }

        $this->layout->view('manage', $this->view_params);
    }

    /**
     * this function edit_scale by its id
     * @param int $id the id of the edit scale to be viewed
     * @redirect success or error
     */
    public function edit_scale($id = 0)
    {

        $rubric = Orm_Rb_Rubrics::get_instance($id);

        if (intval($id) > 0 && !$rubric->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if (!$rubric->can_manage()) {
            if ($this->input->is_ajax_request()) {
                echo error_dialog(lang('Permissions Denied'));
                die();
            }
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(base_url('/'));
        }

        $scales = $rubric->get_scales();

        $this->view_params['rubric'] = $rubric;
        $this->view_params['scales'] = $scales;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $scales_input = $this->input->post('scale');

            Validator::required_array_validator('scale', $scales_input, lang('Inputs incorrect'));

            if (count($scales_input) != count($scales)) {
                Validator::set_error('scale', $scales_input, lang('Inputs count not correct'));
            }

            if (Validator::success()) {
                foreach ($scales as $key => $scale) {
                    if (!isset($scales_input[$key]['name_ar']) || trim($scales_input[$key]['name_ar']) == '') {
                        Validator::set_error('name_ar', 'This Field is required', $key);
                    }

                    if (!isset($scales_input[$key]['name_en']) || trim($scales_input[$key]['name_en']) == '') {
                        Validator::set_error('name_en', lang('This Field is required'), $key);
                    }

                    if (!isset($scales_input[$key]['weight']) || (trim($scales_input[$key]['weight']) == '' || preg_match("/\D+/", trim($scales_input[$key]['weight'])))) {
                        Validator::set_error('weight', lang('This Field is required'), $key);
                    } elseif (intval($scales_input[$key]['weight']) > 100 || intval($scales_input[$key]['weight']) < 0) {
                        Validator::set_error('weight', lang('Weight value should be between 0-100'), $key);
                    }


                    $scale->set_name_ar($scales_input[$key]['name_ar']);
                    $scale->set_name_en($scales_input[$key]['name_en']);
                    $scale->set_weight($scales_input[$key]['weight']);
                }

                if (Validator::success()) {
                    foreach ($scales as $key => $scale) {
                        $scale->save();
                    }

                    json_response(['success' => true]);
                }
            }

            json_response(['success' => false, 'html' => $this->load->view('edit_scale', $this->view_params, true)]);
        }

        $this->load->view('edit_scale', $this->view_params);
    }

    /**
     * this function publish by its id
     * @param int $id the id of the publish to be viewed
     * @redirect success or error
     */
    public function publish($id = 0)
    {

        $rubric = Orm_Rb_Rubrics::get_instance($id);

        if (intval($id) > 0 && !$rubric->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if (!$rubric->can_manage()) {
            if ($this->input->is_ajax_request()) {
                echo error_dialog(lang('Permissions Denied'));
                die();
            }
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(base_url('/'));
        }

        if (!$rubric->ready_to_publish()) {
            if ($this->input->is_ajax_request()) {
                echo error_dialog(lang('Rubric not ready to publish'));
                die();
            }
            Validator::set_error_flash_message(lang('Rubric not ready to publish'));
            redirect(base_url('/'));
        }


        $this->view_params['rubric'] = $rubric;


        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $start = $this->input->post('start');
            $end = $this->input->post('end');


            $rubric->set_start_date(strtotime($start));
            $rubric->set_end_date(strtotime($end));


            if (strtotime($start) < strtotime(date('Y-m-d'))) {
                Validator::set_error('start', lang('Date entered is not correct'));
            }

            Validator::date_format_validator('start', $start, lang('This field is required'));
            Validator::date_format_validator('end', $end, lang('This field is required'));
            Validator::date_range_validator('start', $start, $end, lang('Rate date is not correct'));

            if (Validator::success()) {
                $rubric->save();
                foreach (Orm_Rb_Evaluations::get_all(['rubrics_id' => $rubric->get_id()]) as $evaluation) {

                    $criteria = json_decode($evaluation->get_criteria(), 1);
                    if (!empty($criteria['type'])) {

                        $filters = array();

                        if (!empty($criteria['college_id'])) {
                            $filters['college_id'] = $criteria['college_id'];
                        }
                        if (!empty($criteria['department_id"'])) {
                            $filters['department_id"'] = $criteria['department_id"'];
                        }
                        if (!empty($criteria['program_id'])) {
                            $filters['program_id'] = $criteria['program_id'];
                        }

                        switch ($criteria['type']) {
                            case Orm_User_Faculty::class:


                                $users_faculty = Orm_User_Faculty::get_all($filters);

                                foreach ($users_faculty as $user_faculty) {
                                    Orm_Notification::send_notification(
                                        Orm_User::get_logged_user_id(),
                                        $user_faculty->get_user_id(),
                                        Orm_Notification_Template::RUBRICS,
                                        Orm_Notification::TYPE_RUBRICS,
                                        array(

                                            '%link%',
                                            '%rubrics_name_english%',
                                            '%rubrics_name_arabic%'
                                        ),
                                        array(
                                            '<a href="' . base_url('rubrics/assigned/answer/' . $rubric->get_id()) . '">'.lang('Click Here').'</a>',
                                            $rubric->get_name_en(),
                                            $rubric->get_name_ar(),
                                        )
                                    );
                                }

                                break;
                            case Orm_User_Staff::class:

                                $users_staff = Orm_User_Staff::get_all($filters);

                                foreach ($users_staff as $user_staff) {
                                    Orm_Notification::send_notification(
                                        Orm_User::get_logged_user_id(),
                                        $user_staff->get_user_id(),
                                        Orm_Notification_Template::RUBRICS,
                                        Orm_Notification::TYPE_RUBRICS,
                                        array(

                                            '%link%',
                                            '%rubrics_name_english%',
                                            '%rubrics_name_arabic%'
                                        ),
                                        array(
                                            '<a href="' . base_url('rubrics/assigned/answer/' . $rubric->get_id()) . '">'.lang('Click Here').'</a>',
                                            $rubric->get_name_en(),
                                            $rubric->get_name_ar(),
                                        )
                                    );
                                }
                                break;
                            case Orm_User_Student::class :

                                $users_student = Orm_User_Student::get_all($filters);

                                foreach ($users_student as $user_student) {
                                    Orm_Notification::send_notification(
                                        Orm_User::get_logged_user_id(),
                                        $user_student->get_user_id(),
                                        Orm_Notification_Template::RUBRICS,
                                        Orm_Notification::TYPE_RUBRICS,
                                        array(

                                            '%link%',
                                            '%rubrics_name_english%',
                                            '%rubrics_name_arabic%'
                                        ),
                                        array(
                                            '<a href="' . base_url('rubrics/assigned/answer/' . $rubric->get_id()) . '">'.lang('Click Here').'</a>',
                                            $rubric->get_name_en(),
                                            $rubric->get_name_ar(),
                                        )
                                    );
                                }
                                break;
                        }

                    }

                }
                $rubric_notification_ = Orm_Rb_Rubrics::get_instance($rubric->get_id());

                switch ($rubric_notification_->get_rubric_class()) {

                    case Orm_Rb_Rubrics_Course::class:
                        $rubric_notification_->get_extra_data();
                        $users_id = Orm_Course_Section_Teacher::get_all(['course_id' => $rubric_notification_->get_extra_data(), 'semester_id' => Orm_Semester::get_active_semester_id()]);

                        foreach ($users_id as $user_id) {
                            Orm_Notification::send_notification(
                                Orm_User::get_logged_user_id(),
                                $user_id->get_user_id(),
                                Orm_Notification_Template::RUBRICS,
                                Orm_Notification::TYPE_RUBRICS,
                                array(

                                    '%link%',
                                    '%rubrics_name_english%',
                                    '%rubrics_name_arabic%'
                                ),
                                array(
                                    '<a href="' . base_url('rubrics/assigned/answer/' . $rubric->get_id()) . '">'.lang('Click Here').'</a>',
                                    $rubric->get_name_en(),
                                    $rubric->get_name_ar()
                                )
                            );
                        }
                        break;
                    case 'Orm_Rb_Rubrics_User':

                        if ($rubric_notification_->get_rubric_class() == 'Orm_Rb_Rubrics_User') {
                            foreach (Orm_Rb_Evaluations::get_all(['rubrics_id' => $rubric->get_id()]) as $evaluation) {
                                $criteria = json_decode($evaluation->get_criteria(), 1);
                                foreach ($criteria as $key => $user_id) {
                                    Orm_Notification::send_notification(
                                        Orm_User::get_logged_user_id(),
                                        $user_id,
                                        Orm_Notification_Template::RUBRICS,
                                        Orm_Notification::TYPE_RUBRICS,
                                        array(

                                            '%link%',
                                            '%rubrics_name_english%',
                                            '%rubrics_name_arabic%'
                                        ),
                                        array(
                                            '<a href="' . base_url('rubrics/assigned/answer/' . $rubric->get_id()) . '">'.lang('Click Here').'</a>',
                                            $rubric->get_name_en(),
                                            $rubric->get_name_ar(),
                                        )
                                    );
                                }


                            }
                        }
                        break;

                }


                json_response(['success' => true]);
            }

            json_response(['success' => false, 'html' => $this->load->view('publish', $this->view_params, true)]);
        }

        $this->load->view('publish', $this->view_params);

    }

    /**
     * this function unpublish by its id
     * @param int $id the id of the unpublish to be viewed
     * @redirect success or error
     */
    public function unpublish($id = 0)
    {

        $rubric = Orm_Rb_Rubrics::get_instance($id);

        if (intval($id) > 0 && !$rubric->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if (!$rubric->can_manage() && $rubric->is_end() && $rubric->has_answer()) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(base_url('/'));
        }


        $rubric->set_start_date(0);
        $rubric->set_end_date(0);

        $rubric->save();

        Validator::set_success_flash_message(lang('Rubric has unpublished'));
    }

    /**
     * this function invitation by its id
     * @param int $id the id of the invitation to be viewed
     * @redirect success or error
     */
    public function invitation($id = 0)
    {

        $rubric = Orm_Rb_Rubrics::get_instance($id);

        if (intval($id) > 0 && !$rubric->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if (!$rubric->can_manage() && !$rubric->has_invitation()) {
            if ($this->input->is_ajax_request()) {
                echo error_dialog(lang('Permissions Denied'));
                die();
            }
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(base_url('/'));
        }

        $invitation_id = intval($this->input->get_post('invitation_id'));

        $this->view_params['invitation_id'] = '';

        if ($invitation_id > 0) {

            $evaluation = Orm_Rb_Evaluations::get_instance($invitation_id);

            if (!$evaluation->get_id()) {
                if ($this->input->is_ajax_request()) {
                    echo error_dialog(lang('The resource you requested does not exist!'));
                    die();
                }
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                redirect(base_url('/'));
            }

            $_GET['fltr'] = json_decode($evaluation->get_criteria(), 1);
            $this->view_params['invitation_id'] = $invitation_id;

        }


        $this->view_params['rubric'] = $rubric;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $rubric->set_evaluation($this->view_params);
        }

        echo $rubric->get_invitation_form($this->view_params);
    }

    /**
     * this function invitation manager by its id
     * @param int $id the id of the invitation manager to be viewed
     * @return string the html view
     */
    public function invitation_manager($id = 0)
    {

        $rubric = Orm_Rb_Rubrics::get_instance($id);

        if (intval($id) > 0 && !$rubric->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if ($rubric->get_rubric_class() != Orm_Rb_Rubrics_Service::class || !$rubric->can_manage() || !$rubric->has_invitation()) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(base_url('/'));
        }

        $this->breadcrumbs->push(lang('Manage Invitation'), '/rubrics/invitation_manager/' . $id);

        $vars = [
            'title' => lang('Rubric Invitations') . ': ' . $rubric->get_name(),
            'icon' => 'fa fa-file',
            'link_attr' => 'href="/rubrics/invitation/' . $id . '" data-toggle="ajaxModal"',
            'link_title' => lang('Add').' '.lang('Invitations'),
            'link_icon' => 'plus'
        ];


        $this->view_params['page_header'] = $this->load->view('/common/page_header', $vars, true);

        $this->view_params['rubric'] = $rubric;


        $this->layout->view('invitation/service_manager', $this->view_params);
    }

    /**
     * this function invitation manager by its rubric id and id
     * @param int $rubric_id the rubric id of the invitation manager to be viewed
     * @param int $id the id of the invitation manager to be viewed
     * @redirect success or error
     */
    public function delete_invitation($rubric_id = 0, $id = 0)
    {

        $rubric = Orm_Rb_Rubrics::get_instance($rubric_id);

        $evaluation = Orm_Rb_Evaluations::get_one(['id' => $id, 'rubrics_id' => $rubric_id]);


        if (!$rubric->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            if ($this->input->is_ajax_request()) {
                exit;
            }
            redirect(base_url('/'));
        }

        if (!$evaluation->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            if ($this->input->is_ajax_request()) {
                exit;
            }
            redirect(base_url('/'));
        }

        if (!$rubric->can_manage()) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            if ($this->input->is_ajax_request()) {
                exit;
            }
            redirect(base_url('/'));
        }

        if ($rubric->has_answer()) {
            Validator::set_error_flash_message(lang('This Rubric has answers'));
            if ($this->input->is_ajax_request()) {
                exit;
            }
            redirect(base_url('/'));
        }

        $evaluation->delete();
    }

    /**
     * this function draw filter
     * @return string the html view
     */
    public function draw_filter()
    {

        $type = $this->input->get_post('type');

        switch ($type) {
            case Orm_User_Staff::class:
                echo Orm_User_Staff::draw_filters();
                break;

            case Orm_User_Student::class:
                echo Orm_User_Student::draw_filters();
                break;

            default:
                echo Orm_User_Faculty::draw_filters();
        }

    }

}
