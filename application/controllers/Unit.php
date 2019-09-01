<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Config $config
 * Class Unit
 */
class Unit extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-unit');

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'unit';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Unit'),
            'icon' => 'fa fa-university'
        ), true);

    }

    public function index()
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Unit'),
            'icon' => 'fa fa-university',
            'link_attr' => 'href="/unit/create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Unit')
        ), true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $unites = Orm_Unit::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Unit::get_count($filters));



        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['unites'] = $unites;
        $this->view_params['fltr'] = $fltr;

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Unit'), '/unit');

        $this->layout->view('/unit/list', $this->view_params);
    }

    public function create()
    {
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Unit'), '/unit');
        $this->breadcrumbs->push(lang('Add').' '.lang('Unit'), '/unit/create');

        $this->view_params['unit'] = new Orm_Unit();
        $this->layout->view('/unit/create_edit', $this->view_params);
    }

    public function save()
    {
        // post data
        $id = (int)$this->input->post('id');
        $unit_name_en = $this->input->post('name_en');
        $unit_name_ar = $this->input->post('name_ar');
        $type = $this->input->post('type');
        $parent_id = $this->input->post('parent_id');
        $is_academic = (int) $this->input->post('academic_unit');
        $head_id = (int) $this->input->post('head_id');

        //get instances object
        $obj = Orm_Unit::get_instance($id);
        $obj->set_name_en($unit_name_en);
        $obj->set_name_ar($unit_name_ar);
        $obj->set_class_type($type);
        $obj->set_parent_id($parent_id);
        $obj->set_is_academic($is_academic);

        //validation errors
        Validator::required_field_validator('name_ar', $unit_name_ar, lang('Please Enter Unit Name').' '.lang('Arabic'));
        Validator::required_field_validator('name_en', $unit_name_en, lang('Please Enter Unit Name').' '.lang('English'));
        Validator::database_unique_field_validator($obj, 'name_ar', 'name_ar', $unit_name_ar, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'name_en', 'name_en', $unit_name_en, lang('Unique Field'));
        Validator::required_field_validator('type', $type, lang('Please Select the Unit Type'));

        if (!in_array($type, Orm_Unit::class_types())) {
            Validator::set_error('type', lang('Please Select the Unit Type'));
        }

        switch ($type) {
            case Orm_Unit_Rector::class:
                $obj->set_parent_id(0);
                break;
            case Orm_Unit_College::class:
                break;
            default:
                if ($id == $parent_id) {
                    Validator::set_error('parent_id', lang('Invalid Parent'));
                }
                break;
        }

        //check validation
        if (Validator::success()) {
            $obj->save();

            if ($head_id) {
                $log_obj = Orm_Unit_Log::get_one(array('unit_id' => $obj->get_id(), 'year' => Orm_Semester::get_active_semester()->get_year()));
                $log_obj->set_unit_id($obj->get_id());
                $log_obj->set_year(Orm_Semester::get_active_semester()->get_year());
                $log_obj->set_user_id($head_id);
                $log_obj->save();
            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/unit');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Unit'), '/unit');
        $this->breadcrumbs->push(lang('Add').' '.lang('Unit'), '/unit/create');

        // parameter
        $this->view_params['unit'] = $obj;
        $this->layout->view('/unit/create_edit', $this->view_params);
    }

    public function edit($id)
    {

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Unit'), '/unit');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Unit'), '/unit/edit/' . $id);

        $this->view_params['unit'] = Orm_Unit::get_instance($id);
        $this->layout->view('/unit/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        $obj = Orm_Unit::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/unit');
    }

    public function filter($class_type, $unit_id = 0) {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }


        $filter = '';
        if (class_exists($class_type)) {
            $unit = $class_type::get_instance($unit_id);
            if (($unit->get_class_type() != $class_type && $unit->get_id()) || !$unit->get_id()) {
                $new_unit = new $class_type();
                $filter = $new_unit->draw_parents();
            } else {
                $filter = $unit->draw_parents();
            }
        }

        json_response(array('html' => $filter));
    }

    public function info($id) {

        $type = preg_replace('/[0-9]+/', '', $id);

        $unit_id = preg_replace('/\D/', '', $id);

        if (strtoupper($type) == 'U') {
            $unit = Orm_Unit::get_instance($unit_id);
        } else {
            $unit = Orm_College::get_instance($unit_id);
        }

        $this->view_params['unit'] = $unit;

        $this->load->view('unit/info', $this->view_params);

    }

    public function vision_mission($id) {

        $unit = Orm_Unit::get_instance($id);

        if (!$unit->get_id()) {
            redirect('/unit');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Unit') . ' ' . lang('Mission & Vision') . ': ' . htmlfilter($unit->get_name()),
            'icon' => 'fa fa-university'
        ), true);

        $this->breadcrumbs->push(lang('Unit'), '/unit');
        $this->breadcrumbs->push(lang('Vision & Mission'), '/unit/vision_mission/' . $id);

        $this->view_params['unit'] = $unit;

        $this->layout->view('unit/vision_mission', $this->view_params);

    }
    public function load_unit( $check = 0)
    {

        if ($check == 0) {
            if (!$this->input->is_ajax_request()) {

                Validator::set_error_flash_message(lang('No direct script access allowed'));
                redirect('/');

            }
        }

		$page = $this->input->get_post('page');
		$unit_id = (int)$this->input->get_post('unit_id');


        $filters = array();

        $keyword = trim($this->input->get_post('keyword') ?: '');

        if (!$page) {
            $page = 1;
        }

        if ($keyword != '') {
            $filters['keyword'] = $keyword;
        }


        echo Orm_Unit::draw_find_unit($filters,$page,5,$unit_id);


    }
}