<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Input $input
 * @property Layout $layout
 * @property CI_Config $config
 * Class Major
 */
class Major extends MX_Controller
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
        $this->view_params['sub_tab'] = 'major';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Major'),
            'icon' => 'fa fa-shield'
        ), true);

    }
    private function get_list(){

    $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
        'title' => lang('Major'),
        'icon' => 'fa fa-shield',
        'link_attr' => 'href="/major/create"',
        'link_icon' => 'plus',
        'link_title' => lang('Create').' '.lang('Major')
    ), true);

    $per_page = $this->config->item('per_page');
    $page = (int)$this->input->get_post('page');
    $fltr = $this->input->get_post('fltr');

    if (!$page) {
        $page = 1;
    }

    $filters = array();

    if (!empty($fltr['campus_id'])) {
        $filters['campus_id'] = intval($fltr['campus_id']);
    }
    if (!empty($fltr['college_id'])) {
        $filters['college_id'] = (int)$fltr['college_id'];
    }
    if (!empty($fltr['program_id'])) {
        $filters['program_id'] = (int)$fltr['program_id'];
    }
    if (!empty($fltr['keyword'])) {
        $filters['keyword'] = trim($fltr['keyword']);
    }

    $majors = Orm_Major::get_all($filters, $page, $per_page);

    $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
    $pager->set_page($page);
    $pager->set_per_page($per_page);
    $pager->set_total_count(Orm_Major::get_count($filters));

    $this->view_params['pager'] = $pager->render(true);
    $this->view_params['majors'] = $majors;
    $this->view_params['fltr'] = $fltr;

}

    public function index()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-major');

$this->get_list();
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Major'), '/major');


        $this->layout->view('/major/list', $this->view_params);
    }
    
    public function filter(){
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('/major/data_table', $this->view_params);
        } else {
            $this->index();
        }
    }

    public function create()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-major');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Major'), '/major');
        $this->breadcrumbs->push(lang('Add').' '.lang('Major'), '/major/create');

        $this->view_params['major'] = new Orm_Major();
        $this->layout->view('/major/create_edit', $this->view_params);
    }

    public function save()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-major');

        // post data
        $id = (int)$this->input->post('id');
        $program_id = (int)$this->input->post('program_id');
        $major_name_en = $this->input->post('name_en');
        $major_name_ar = $this->input->post('name_ar');

        //get instances object
        $obj = Orm_Major::get_instance($id);
        $obj->set_name_en($major_name_en);
        $obj->set_name_ar($major_name_ar);
        $obj->set_program_id($program_id);

        //validation errors
        Validator::required_field_validator('name_ar', $major_name_ar, lang('Please Enter Major Name').' ( '.lang('Arabic').' ) ');
        Validator::required_field_validator('name_en', $major_name_en, lang('Please Enter Major Name').' ( '.lang('English').' ) ');
        Validator::database_unique_field_validator($obj, 'name_ar', 'name_ar', $major_name_ar, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'name_en', 'name_en', $major_name_en, lang('Unique Field'));
        Validator::not_empty_field_validator('program_id', $program_id, lang('Please Select Program'));

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/major');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Major'), '/major');
        $this->breadcrumbs->push(lang('Add').' '.lang('Major'), '/major/create');

        // parameter
        $this->view_params['major'] = $obj;
        $this->layout->view('/major/create_edit', $this->view_params);
    }

    public function edit($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-major');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Major'), '/major');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Major'), '/major/edit/' . $id);

        $this->view_params['major'] = Orm_Major::get_instance($id);
        $this->layout->view('/major/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-major');

        $obj = Orm_Major::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/major');
    }
}
