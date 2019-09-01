<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Config $config
 * Class Risk_management
 * @property CI_Input $input
 */
class Risk_management extends MX_Controller {

    private $view_params = array();
    public function __construct() {

        parent::__construct();

        if(!License::get_instance()->check_module('risk_management', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        $this->logged_user = Orm_User::get_logged_user();

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Risk Management'),
            'icon' => 'fa fa-bug'
        ), true);
        $this->view_params['menu_tab'] = 'risk_management';

        $this->breadcrumbs->push(lang('Risk Management'), '/risk_management');

    }


    /** get risk management depending on active semester
     * render it in index function
    */
    private function get_list(){

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if(!empty($fltr['type'])){
            $filters['type'] = $fltr['type'];
        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if(!empty($fltr['institution']) && $fltr['institution']==1) {
            $filters['level_type'] = Orm_Rim_Risk_Management::RISK_INSTITUTION_LEVEL;
            $filters['level_id'] =0;
        }
        elseif(!empty($fltr['program_id']) && $fltr['program_id']>0) {
            $filters['level_type'] = Orm_Rim_Risk_Management::RISK_PROGRAM_LEVEL;
            $filters['level_id'] = $fltr['program_id'];
        }
        elseif(!empty($fltr['college_id']) && $fltr['college_id']>0) {
            $filters['level_type'] = Orm_Rim_Risk_Management::RISK_COLLEGE_LEVEL;
            $filters['level_id'] = $fltr['college_id'];
        }

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
            $filters['level_type'] = Orm_Rim_Risk_Management::RISK_COLLEGE_LEVEL;
            $filters['in_level_id'] = !empty($fltr['program_id']) && $fltr['program_id'] > 0 ? [$fltr['program_id']] : (array_merge(array_column(Orm_Program::get_model()->get_all(['college_id'=>$this->logged_user->get_college_id()],0,0,[],Orm::FETCH_ARRAY),'id'), [0]));
            $filters['level_id'] = $this->logged_user->get_college_id();
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['level_type'] = Orm_Rim_Risk_Management::RISK_PROGRAM_LEVEL;
            $filters['level_id'] = $this->logged_user->get_program_id();
        }


        $risk_objs = Orm_Rim_Risk_Management::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Rim_Risk_Management::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['risk_objs'] = $risk_objs;
        $this->view_params['fltr'] = $fltr;

    }

/** risk management dashboard and render get list
 * render it in list view
*/
    public function index() {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Risk Management'),
            'icon' => 'fa fa-bug',
            'link_attr' => 'href="/risk_management/add_edit" data-toggle="ajaxModal"',
            'link_icon' => 'plus',
            'link_title' => lang('Add').' '.lang('New')
        ), true);

        $this->get_list();

        $this->layout->view('list', $this->view_params);

    }

    /** if it's ajax request render it in data table view else that render in index
    */
    public function filter(){
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('data_table', $this->view_params);
        } else {
            $this->index();
        }

    }

    /** add or edit risk management without save
     * render it in add edit view
    */
    public function add_edit($id = 0) {

        $this->view_params['risk_management'] = Orm_Rim_Risk_Management::get_instance($id);
        $this->load->view('add_edit', $this->view_params);
    }

    /** save risk management object and save them related for every type of modules
     * return json response
    */
    public function save() {

        $id = $this->input->post('id');
        $type = $this->input->post('type_class'); /** @var $type Orm_Rim_Risk_Management */
        $type_id = $this->input->post('type_id');
        $level_type = intval($this->input->post('level_type'));
        $college_id = intval($this->input->post('college_id'));
        $department_id = intval($this->input->post('department_id'));
        $program_id = intval($this->input->post('program_id'));
        $unit_id = intval($this->input->post('unit_id'));
        $severity = $this->input->post('severity');
        $likely = $this->input->post('likely');

        Validator::required_field_validator('type_class', $type, lang('Required Field'));
        Validator::class_exists_validator('type_class', $type, lang('Invalid Type'));
        Validator::in_array_validator('type_class', $type, Orm_Rim_Risk_Management::get_type_types(), lang('Invalid Type'));
        Validator::not_empty_field_validator('type_id', $type_id, lang('It is a required Field to select one item.'));
        Validator::required_field_validator('severity', $severity, lang('Required Field'));
        Validator::required_field_validator('likely', $likely, lang('Required Field'));

        $type = in_array($type, Orm_Rim_Risk_Management::get_type_types()) ? $type : Orm_Rim_Risk_Management::class;

        $level_id = 0;

        switch ($level_type) {

            case Orm_Rim_Risk_Management::RISK_COLLEGE_LEVEL:

                Validator::not_empty_field_validator('college_id', $college_id, lang('Required Field'));

                $level_id = $college_id;
                break;

            case Orm_Rim_Risk_Management::RISK_PROGRAM_LEVEL:

                Validator::not_empty_field_validator('college_id', $college_id, lang('Required Field'));
                Validator::not_empty_field_validator('department_id', $department_id, lang('Required Field'));
                Validator::not_empty_field_validator('program_id', $program_id, lang('Required Field'));

                $level_id = $program_id;
                break;

            case Orm_Rim_Risk_Management::RISK_UNIT_LEVEL:

                Validator::not_empty_field_validator('unit_id', $unit_id, lang('Required Field'));

                $level_id = $unit_id;
                break;
        }

        $risk_management = $type::get_instance($id);

        if ($risk_management->get_id()) {
            if ($risk_management->get_level_type() != $level_type) {
                Validator::set_error('level_type' , lang('Can not be changed in edit mode'));
            }
            if ($risk_management->get_level_id() != $level_id) {
                Validator::set_error('level_type' , lang('Can not be changed in edit mode'));
            }
            if ($risk_management->get_type() != $type) {
                Validator::set_error('type_class' , lang('Can not be changed in edit mode'));
            }
        }

        $risk_management->set_type($type);
        $risk_management->set_level_type($level_type);
        $risk_management->set_level_id($level_id);
        $risk_management->set_likely($likely);
        $risk_management->set_severity($severity);
        $risk_management->set_type_id($type_id);

        if($risk_management->is_valid() && Validator::success() ) {
            json_response(['success' => true, 'id' => $risk_management->save()]);
        }

        $this->view_params['risk_management'] = $risk_management;

        json_response(['success' => false, 'html' => $this->load->view('add_edit', $this->view_params, true)]);

    }

    /** draw risk management depending on level and types of risk management
     *
     */
    public function draw_properties() {

        $id = $this->input->post('id');
        $type = $this->input->post('type_class'); /** @var $type Orm_Rim_Risk_Management */

        $type = in_array($type, Orm_Rim_Risk_Management::get_type_types()) ? $type : Orm_Rim_Risk_Management::class;

        echo $type::get_instance($id)->draw_properties();
    }

    /** return ajax request depending on risk management type that derivation form ajax parent fuction
    */
    public function ajax() {

        $id = $this->input->post('id');
        $type = $this->input->post('type'); /** @var $type Orm_Rim_Risk_Management */

        $type = in_array($type, Orm_Rim_Risk_Management::get_type_types()) ? $type : Orm_Rim_Risk_Management::class;

        echo $type::get_instance($id)->ajax();
    }
/** delete risk management if exist
*/
    public function delete($id) {
        $risk_management = Orm_Rim_Risk_Management::get_instance($id);

        if($risk_management->get_id()) {
            $risk_management->delete();
            Validator::set_success_flash_message(lang('Successful Delete'));
        }
    }

    /** generate pdf file for risk management
     * redirect to the parent page
    */
    public function pdf($id) {
        $risk_management = Orm_Rim_Risk_Management::get_instance($id);

        if($risk_management->get_id()) {
            $risk_management->generate_pdf();
        }

        redirect($this->input->server('HTTP_REFERER'));
    }
}