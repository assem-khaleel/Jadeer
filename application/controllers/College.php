<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * @property CI_Input $input
 * @property Layout $layout
 * Class College
 */
class College extends MX_Controller
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

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'college';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('College'),
            'icon' => 'fa fa-suitcase'
        ), true);

    }

    private function get_list() {

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
        if (!empty($fltr['campus_in'])) {
            $filters['campus_in'] = $fltr['campus_in'];
        }

        $colleges = Orm_College::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_College::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['colleges'] = $colleges;
        $this->view_params['fltr'] = $fltr;
    }

    public function index()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-college');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('College'),
            'icon' => 'fa fa-suitcase',
            'link_attr' => 'href="/college/create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('College')
        ), true);

        $this->get_list();

        // add breadcrumbs
        $this->breadcrumbs->push(lang('College'), '/college');

        $this->layout->view('/college/list', $this->view_params);
    }

    public function filter() {
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('/college/data_table', $this->view_params);
        } else {
            $this->index();
        }
      
    }

    public function create()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-college');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('College'), '/college');
        $this->breadcrumbs->push(lang('Add').' '.lang('College'), '/college/create');

        $this->view_params['college'] = new Orm_College();
        $this->layout->view('/college/create_edit', $this->view_params);
    }

    public function save()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-college');

        // post data
        $id = (int)$this->input->post('id');
        $college_name_en = $this->input->post('name_en');
        $college_name_ar = $this->input->post('name_ar');
        $college_land_area = $this->input->post('land_area');
        $college_building_size = $this->input->post('building_size');
        $unit_id = $this->input->post('unit_id');
        $campus_ids = $this->input->post('campus_ids');

        //get instances object
        $obj = Orm_College::get_instance($id);
        $obj->set_name_en($college_name_en);
        $obj->set_name_ar($college_name_ar);
        $obj->set_unit_id($unit_id);
        $obj->set_area($college_land_area);
        $obj->set_size($college_building_size);

        //validation errors
        Validator::required_field_validator('name_ar', $college_name_ar, lang('Please Enter College Name').' '.lang('Arabic'));
        Validator::required_field_validator('name_en', $college_name_en, lang('Please Enter College Name').' '.lang('English'));
        Validator::database_unique_field_validator($obj, 'name_ar', 'name_ar', $college_name_ar, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'name_en', 'name_en', $college_name_en, lang('Unique Field'));
        Validator::required_array_validator('campus_ids', $campus_ids, lang('Please Select Campus'));

        //check validation
        if (Validator::success()) {

            if($campus_ids) {

                $college_id = $obj->save();

                $to_delete_campus_ids = array_diff($obj->get_campus_ids(), $campus_ids);

                foreach ($campus_ids as $campus_id) {
                    $campus_college = Orm_Campus_College::get_one(['college_id' => $college_id, 'campus_id' => $campus_id]);
                    $campus_college->set_college_id($college_id);
                    $campus_college->set_campus_id($campus_id);
                    $campus_college->save();
                }

                if($to_delete_campus_ids) {
                    foreach ($to_delete_campus_ids as $campus_id) {
                        $campus_college = Orm_Campus_College::get_one(['college_id' => $college_id, 'campus_id' => $campus_id]);
                        $campus_college->delete();
                    }
                }

            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/college');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('College'), '/college');
        $this->breadcrumbs->push(lang('Add').' '.lang('College'), '/college/create');

        // parameter
        $this->view_params['campus']=[];
        $this->view_params['college'] = $obj;
        $this->layout->view('/college/create_edit', $this->view_params);
    }

    public function edit($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-college');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('College'), '/college');
        $this->breadcrumbs->push(lang('Edit').' '.lang('College'), '/college/edit/' . $id);

        $this->view_params['college'] = Orm_College::get_instance($id);
        $this->layout->view('/college/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-college');

        $obj = Orm_College::get_instance($id);

        if (License::get_instance()->check_module('accreditation')) {

            Modules::load('accreditation');
            $mapping = Orm_As_Agency_Mapping::get_all(['college_id'=>$id]);

            if ($obj->get_id()) {
                $obj->delete();
                foreach ($mapping as $key => $value) {
                    $value->delete();
                }
            }
        } else {
            if ($obj->get_id()) {
                $obj->delete();
            }
        }


        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/college');
    }

    public function get_colleges($by = 'campus')
    {
        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        switch ($by) {
            case 'campus':
                // Edited by shamaseen, intval was removed because campus_id could be array
                $campus_id = $this->input->post('campus_id');

                // Edited by shamaseen
                if(is_array($campus_id))
                {
                    $list = Orm_College::get_all(array('campus_in' => $campus_id));
                }
                else
                {
                    $list = Orm_College::get_all(array('campus_id' => $campus_id));
                }
                break;
            default:
                $list = array();
                break;
        }

        $options = '<option value="">' . lang('All College') . '</option>';
        if ($list) {
            foreach ($list as $option) {
                $options .= '<option value="' . $option->get_id() . '">' . htmlfilter($option->get_name()) . '</option>';
            }
        }

        $html = '';
        if (boolval($this->input->post('option_only'))) {
            $html .= $options;
        } else {

            $enable = boolval($this->input->post('enable_departments'));
            $suffix = trim($this->input->post('suffix'));

            $onchange = ($enable ? 'onchange="get_departments_by_college(this);"' : '');

            $html .= '<div class="form-group">';
            $html .= '<label class="control-label">' . lang('College') . '</label>';
            $html .= "<select name='college_id' class='form-control' {$onchange}>";
            $html .= $options;
            $html .= '</select>';
            $html .= '</div>';

            if ($enable) {
                $html .= '<div id="department_block' . $suffix . '" ></div>';
            }
        }

        exit($html);
    }

    public function vision_mission($id) {

        $college = Orm_College::get_instance($id);

        if (!$college->get_id()) {
            redirect('/college');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('College') . ' ' . lang('Mission & Vision') . ': ' . htmlfilter($college->get_name()),
            'icon' => 'fa fa-university'
        ), true);

        $this->breadcrumbs->push(lang('College'), '/college');
        $this->breadcrumbs->push(lang('Vision & Mission'), '/college/vision_mission/' . $id);

        $this->view_params['college'] = $college;

        $this->layout->view('college/vision_mission', $this->view_params);

    }

}
