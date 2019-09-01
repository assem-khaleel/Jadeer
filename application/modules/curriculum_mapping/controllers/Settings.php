<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 1/4/16
 * Time: 7:42 PM
 */

/**
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * @property Layout $layout
 * @property CI_Input $input
 * Class Settings
 */
class Settings extends MX_Controller
{
    /**
     * @var $view_params array => the array pf data that will send to views
     */
    private $view_params;

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        if (!License::get_instance()->check_module('curriculum_mapping', true)) {
            show_404();
        }

        Orm_User::check_permission(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'curriculum_mapping-settings');

        $this->breadcrumbs->push(lang('Curriculum Mapping'), '/curriculum_mapping');
        $this->breadcrumbs->push(lang('Settings'), '/curriculum_mapping/settings');

        $this->view_params['menu_tab'] = 'curriculum_mapping';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Settings'),
            'icon' => 'fa fa-book',
            'menu_view' => 'curriculum_mapping/sub_menu',
            'menu_params' => array('type' => 'settings')
        ), true);

    }

    /**
     * show the static main page that contain the settings menu
     *
     */
    public function index()
    {
        $this->layout->view('settings/management', $this->view_params);
    }

    /**
     *  show all learning domain and the learning outcomes that related to depends on type of domain
     * (NCAAA 5 learning Domain, NCAAA 4 learning Domain, Standardized learning Domain , other dynamic types that added by users )
     *@redirect string | object
     */
    public function learning_domain()
    {

        $this->breadcrumbs->push(lang('Learning Domain'), '/curriculum_mapping/settings/learning_domain');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Settings'),
            'icon' => 'fa fa-book',
            'link_attr' => 'data-toggle="ajaxModal" href="/curriculum_mapping/settings/learning_domain_add_edit"',
            'link_icon' => 'plus',
            'link_title' => lang('Create') . ' ' . lang('Learning Domain')
        ), true);

        $this->layout->view('settings/learning_domain/list', $this->view_params);
    }

    /**
     * add new leaning domain or update an exist learning domain
     * @param int $id => learning domain id  (if id = 0 the its create for new one)
     */
    public function learning_domain_add_edit($id = 0)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $domain = Orm_Cm_Learning_Domain::get_instance($id);

        $outcomes = array();
        $old_outcome_ids = array();
        foreach (Orm_Cm_Learning_Outcome::get_all(array('learning_domain_id' => $domain->get_id())) as $key => $outcome) {
            $old_outcome_ids[] = $outcome->get_id();
            $outcomes[$key]['id'] = $outcome->get_id();
            $outcomes[$key]['title_en'] = $outcome->get_title_en();
            $outcomes[$key]['title_ar'] = $outcome->get_title_ar();
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $title_en = $this->input->post('title_en');
            $title_ar = $this->input->post('title_ar');
            $type = $this->input->post('type');
            $outcomes = $this->input->post('outcomes');
            $new_domain_id = $this->input->post('domain_id');

            Validator::required_field_validator('title_en', $title_en, lang('Please enter learning domain Title') . ' ' . lang('English'));
            Validator::required_field_validator('title_ar', $title_ar, lang('Please enter learning domain Title') . ' ' . lang('Arabic'));
            Validator::required_field_validator('type', $type, lang('Please select  learning domain type'));
            Validator::required_array_validator('outcomes', $outcomes, lang('Please add at least one learning outcome'));
//            Validator::database_unique_field_validator($domain, 'title_ar', 'title_ar', $title_ar, lang('Unique Field'));
//            Validator::database_unique_field_validator($domain, 'title_en', 'title_en', $title_en, lang('Unique Field'));


            $domain->set_title_en($title_en);
            $domain->set_title_ar($title_ar);
            $domain->set_type($type);
            $domain->set_ncaaa_code($new_domain_id ?: 0);

            if (Validator::success()) {

                $domain_id = $domain->save();

                $deleted_outcomes = array_diff($old_outcome_ids, array_column($outcomes, 'id'));
                if ($deleted_outcomes) {
                    foreach ($deleted_outcomes as $deleted_outcome_id) {
                        $outcome_obj = Orm_Cm_Learning_Outcome::get_one(array('id' => intval($deleted_outcome_id), 'learning_domain_id' => $domain_id));
                        $outcome_obj->delete();
                    }
                }

                foreach ($outcomes as $outcome) {

                    $outcome_id = isset($outcome['id']) ? $outcome['id'] : 0;
                    $outcome_title_en = isset($outcome['title_en']) ? $outcome['title_en'] : '';
                    $outcome_title_ar = isset($outcome['title_ar']) ? $outcome['title_ar'] : '';

                    if ($outcome_title_en && $outcome_title_ar) {
                        $outcome_obj = Orm_Cm_Learning_Outcome::get_one(array('id' => intval($outcome_id), 'learning_domain_id' => $domain_id));
                        $outcome_obj->set_learning_domain_id($domain_id);
                        $outcome_obj->set_title_en($outcome_title_en);
                        $outcome_obj->set_title_ar($outcome_title_ar);
                        $outcome_obj->save();
                    }
                }

                json_response(array('status' => true));
            }

        }

        $this->view_params['domain'] = $domain;
        $this->view_params['outcomes'] = $outcomes;

        $html = $this->load->view('settings/learning_domain/add_edit', $this->view_params, true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * remove learning domain from system
     * @param $id => learning domain id
     */
    public function learning_domain_delete($id)
    {
        $domain = Orm_Cm_Learning_Domain::get_instance($id);
        $domain->delete();

        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     *get all assessment methods and component that mapped with
     * @return string | object
     */
    public function assessment_method()
    {

        $this->breadcrumbs->push(lang('Assessment Method'), '/curriculum_mapping/settings/assessment_method');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Settings'),
            'icon' => 'fa fa-book',
            'link_attr' => 'data-toggle="ajaxModal" href="/curriculum_mapping/settings/assessment_method_add_edit"',
            'link_icon' => 'plus',
            'link_title' => lang('Create') . ' ' . lang('Assessment Method')
        ), true);

        $this->layout->view('settings/assessment_method/list', $this->view_params);
    }

    /**
     * create new assessment method or update new assessment method that was not exist before
     * @param int $id => assessment methode id  (if id = 0 the its create for new one)
     */
    public function assessment_method_add_edit($id = 0)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $method = Orm_Cm_Assessment_Method::get_instance($id);

        $components = array();
        $old_component_ids = array();
        foreach (Orm_Cm_Assessment_Component::get_all(array('assessment_method_id' => $method->get_id())) as $key => $component) {
            $old_component_ids[] = $component->get_id();
            $components[$key]['id'] = $component->get_id();
            $components[$key]['title_en'] = $component->get_title_en();
            $components[$key]['title_ar'] = $component->get_title_ar();
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $title_en = $this->input->post('title_en');
            $title_ar = $this->input->post('title_ar');
            $components = $this->input->post('components');

            Validator::required_field_validator('title_en', $title_en, lang('Please enter assessment method Title') . ' ' . lang('English'));
            Validator::required_field_validator('title_ar', $title_ar, lang('Please enter assessment method Title') . ' ' . lang('Arabic'));
            Validator::required_array_validator('components', $components, lang('Please add at least one assessment component'));

            $method->set_title_en($title_en);
            $method->set_title_ar($title_ar);

            if (Validator::success()) {

                $method_id = $method->save();

                $deleted_components = array_diff($old_component_ids, array_column($components, 'id'));
                if ($deleted_components) {
                    foreach ($deleted_components as $deleted_component_id) {
                        $component_obj = Orm_Cm_Assessment_Component::get_one(array('id' => intval($deleted_component_id), 'assessment_method_id' => $method_id));
                        $component_obj->delete();
                    }
                }

                foreach ($components as $component) {

                    $component_id = isset($component['id']) ? $component['id'] : 0;
                    $component_title_en = isset($component['title_en']) ? $component['title_en'] : '';
                    $component_title_ar = isset($component['title_ar']) ? $component['title_ar'] : '';

                    if ($component_title_en && $component_title_ar) {
                        $component_obj = Orm_Cm_Assessment_Component::get_one(array('id' => intval($component_id), 'assessment_method_id' => $method_id));
                        $component_obj->set_assessment_method_id($method_id);
                        $component_obj->set_title_en($component_title_en);
                        $component_obj->set_title_ar($component_title_ar);
                        $component_obj->save();
                    }
                }

                json_response(array('status' => true));
            }

        }

        $this->view_params['method'] = $method;
        $this->view_params['components'] = $components;

        $html = $this->load->view('settings/assessment_method/add_edit', $this->view_params, true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * remove assessment methods from system
     * @param $id => assessment method id
     */
    public function assessment_method_delete($id)
    {
        $method = Orm_Cm_Assessment_Method::get_instance($id);
        $method->delete();

        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     * get all learning domain that related to a specific types as a selector
     * ( as ajax if try to call it without ajaxt it will return error message and redirect to main page of system)
     */
    public function get_domain()
    {
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

    /**
     * get all learning domain types statics or dynamics with the default learning outcomes that mapped with
     */
    public function learning_domain_type()
    {

        $this->breadcrumbs->push(lang('Learning Domain Types'), '/curriculum_mapping/settings/learning_domain_type');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Curriculum Mapping') . ' - ' . lang('Settings'),
            'icon' => 'fa fa-book',
            'link_attr' => 'data-toggle="ajaxModal" href="/curriculum_mapping/settings/learning_domain_type_add_edit"',
            'link_icon' => 'plus',
            'link_title' => lang('Create') . ' ' . lang('Learning Domain Type')
        ), true);

        $this->layout->view('settings/learning_domain_type/list', $this->view_params);
    }

    /**
     * create new types not related to the static types or update types that already added
     * @param int $id => learning domain type
     */
    public function learning_domain_type_add_edit($id = 0)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }


        $type = Orm_Learning_Domain_Type::get_instance($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $name_en = $this->input->post('name_en');
            $name_ar = $this->input->post('name_ar');

            Validator::required_field_validator('name_en', $name_en, lang('Please enter Type Name') . ' ( ' . lang('English') . ' ) ');
            Validator::required_field_validator('name_ar', $name_ar, lang('Please enter Type Name') . ' ( ' . lang('Arabic') . ' ) ');

            $type->set_name_en($name_en);
            $type->set_name_ar($name_ar);
            /*
             * is_statics = 1 means you can't change on
             * is_statics = 2 means you can change on
            */
            $type->set_is_statics(2);

            if (Validator::success()) {
                $type->save();
                json_response(array('status' => true));
            }

        }
        $this->view_params['type'] = $type;

        $html = $this->load->view('settings/learning_domain_type/add_edit', $this->view_params, true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * remove one of the learning domain  types depends on id
     * @param $id
     * => learning domain type id
     */
    public function learning_domain_type_delete($id)
    {

        $type = Orm_Learning_Domain_Type::get_instance($id);

        if ($type->get_id() && $id != 0) {

            if (Orm_Cm_Learning_Domain::get_count(array('type' => $type->get_id())) != 0 || Orm_Cm_Program_Domain::get_count(array('domain_type'=>$type->get_id())) != 0) {

                Validator::set_error_flash_message(lang("This Type is Map with Learning Domain you can't Remove it"));

            } else {

                foreach (Orm_Cm_Program_Domain::get_all(array('domain_type'=>$type->get_id())) as $domain){

                    $program_learning_outcomes = Orm_Cm_Program_Learning_Outcome::get_count(array('domain_type' => $domain->get_domain_type()));

                    if ($program_learning_outcomes != 0) {
                        Validator::set_error_flash_message(lang("One of Domains Contain Learning Outcome you can't remove it"), true);
                    } else {
                        if ($domain->get_id()) {
                            $domain->delete();
                        }
                    }

                }

                $type->delete();
                Validator::set_success_flash_message(lang("Successfully Deleted"));
            }
        }
    }
}