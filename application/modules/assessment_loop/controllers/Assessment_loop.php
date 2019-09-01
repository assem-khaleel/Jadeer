<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 12/26/16
 * Time: 10:03 AM
 */

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Assessment_loop
 */
class Assessment_loop extends MX_Controller {

    private $view_params = array();

    public function __construct() {
        parent::__construct();

        if(!License::get_instance()->check_module('assessment_loop', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Assessment Loop'),
            'icon' => 'fa fa-circle-o-notch'
        ), true);
        $this->view_params['menu_tab'] = 'assessment_loop';

        $this->breadcrumbs->push(lang('Assessment Loop'), '/assessment_loop');
    }
    /** get all objects for assessment loop after filtering them  and depending on active semester
     */
    private function get_list(){

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if(!empty($fltr['item_class'])){
            $filters['item_class'] = $fltr['item_class'];
        }

        if(!empty($fltr['institution']) && $fltr['institution']==1) {
            $filters['item_type'] = Orm_Al_Assessment_Loop::ASSESSMENT_INSTITUTION_LEVEL;
        }
        elseif(!empty($fltr['program_id']) && $fltr['program_id']>0) {
            $filters['item_type'] = Orm_Al_Assessment_Loop::ASSESSMENT_PROGRAM_LEVEL;
            $filters['item_type_id'] = $fltr['program_id'];
        }
        elseif(!empty($fltr['college_id']) && $fltr['college_id']>0) {
            $filters['item_type'] = Orm_Al_Assessment_Loop::ASSESSMENT_COLLEGE_LEVEL;
            $filters['item_type_id'] = $fltr['college_id'];
        }

        $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

        $assessment_loop_objs = Orm_Al_Assessment_Loop::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Al_Assessment_Loop::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['assessment_loop_objs'] = $assessment_loop_objs;
        $this->view_params['fltr'] = $fltr;
    
}
/** get list from the above function and render it here in dashboard page
 * render in list view
*/
    public function index()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Assessment Loop'),
            'icon' => 'fa fa-circle-o-notch',
            'link_attr' => 'href="/assessment_loop/add_edit" data-toggle="ajaxModal"',
            'link_icon' => 'plus',
            'link_title' => lang('Add').' '.lang('New')
        ), true);

        $this->get_list();

        $this->layout->view('list', $this->view_params);
    }
    /** check if request ajax will render it in data table else in index view
    */
    public function filter(){
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('data_table', $this->view_params);
        } else {
            $this->index();
        }
      
    }
/** add or edit assessment loop object
 * render in add edit view
*/
    public function add_edit($id = 0) {
        $this->view_params['assessment_loop'] = Orm_Al_Assessment_Loop::get_instance($id);
        $this->load->view('add_edit', $this->view_params);
    }
/** save assessment loop after validation
 * return response
*/
    public function save() {

        $id = $this->input->post('id');
        $item_class = $this->input->post('item_class'); /** @var $item_class Orm_Al_Assessment_Loop */
        $item_id = $this->input->post('item_id');
        $item_type = intval($this->input->post('item_type'));
        $college_id = intval($this->input->post('college_id'));
        $department_id = intval($this->input->post('department_id'));
        $program_id = intval($this->input->post('program_id'));
        $unit_id = intval($this->input->post('unit_id'));
        $extra_data = $this->input->post('extra_data');
        $deadline = $this->input->post('deadline');
        $type_id = intval($this->input->post('type_id'));


        if(!is_array($extra_data)) {
            $extra_data = array();
        }

        Validator::required_field_validator('item_class', $item_class, lang('Required Filed'));
        Validator::class_exists_validator('item_class', $item_class, lang('Invalid Type'));
        Validator::in_array_validator('item_class', $item_class, Orm_Al_Assessment_Loop::get_item_class_types(), lang('Invalid Type'));
        Validator::not_empty_field_validator('item_id', $item_id, lang('It is a required filed to select one item.'));
        Validator::date_format_validator('deadline', $deadline, lang('It is a required filed to select date.'));

        $item_class = in_array($item_class, Orm_Al_Assessment_Loop::get_item_class_types()) ? $item_class : Orm_Al_Assessment_Loop::class;

        $item_type_id = 0;

        switch ($item_type) {

            case Orm_Al_Assessment_Loop::ASSESSMENT_COLLEGE_LEVEL:

                Validator::not_empty_field_validator('college_id', $college_id, lang('Required Filed'));

                $item_type_id = $college_id;
                break;

            case Orm_Al_Assessment_Loop::ASSESSMENT_PROGRAM_LEVEL:

                Validator::not_empty_field_validator('college_id', $college_id, lang('Required Filed'));
                Validator::not_empty_field_validator('department_id', $department_id, lang('Required Filed'));
                Validator::not_empty_field_validator('program_id', $program_id, lang('Required Filed'));

                $item_type_id = $program_id;
                break;

            case Orm_Al_Assessment_Loop::ASSESSMENT_UNIT_LEVEL:

                Validator::not_empty_field_validator('unit_id', $unit_id, lang('Required Filed'));

                $item_type_id = $unit_id;
                break;
        }

        $assessment_loop = $item_class::get_instance($id);

        if ($assessment_loop->get_id()) {
            if ($assessment_loop->get_item_type() != $item_type) {
                Validator::set_error('item_type' , lang('Can not be changed in edit mode'));
            }
            if ($assessment_loop->get_item_type_id() != $item_type_id) {
                Validator::set_error('item_type' , lang('Can not be changed in edit mode'));
            }
            if ($assessment_loop->get_item_class() != $item_class) {
                Validator::set_error('item_class' , lang('Can not be changed in edit mode'));
            }
        }

        $assessment_loop->set_item_class($item_class);
        $assessment_loop->set_item_type($item_type);
        $assessment_loop->set_item_type_id($item_type_id);
        $assessment_loop->set_extra_data($extra_data);
        $assessment_loop->set_deadline($deadline);
        $assessment_loop->set_item_id($item_id);
        $assessment_loop->set_type_id($type_id);

        if($assessment_loop->is_valid() && Validator::success() ) {
            json_response(['success' => true, 'id' => $assessment_loop->save()]);
        }

        $this->view_params['assessment_loop'] = $assessment_loop;

        json_response(['success' => false, 'html' => $this->load->view('add_edit', $this->view_params, true)]);

    }
/** draw assessment loop depending on assessment loop type
*/
    public function draw_properties() {

        $id = $this->input->post('id');
        $item_class = $this->input->post('item_class'); /** @var $item_class Orm_Al_Assessment_Loop */

        $item_class = in_array($item_class, Orm_Al_Assessment_Loop::get_item_class_types()) ? $item_class : Orm_Al_Assessment_Loop::class;

        echo $item_class::get_instance($id)->draw_properties();
    }
/** function te get instance and render it as ajax request depending on assessment loop type
 * if ajax for clo will come from orm_al_assessment_loop_clo:ajax
 * if ajax for kpi will come from orm_al_assessment_loop_kpi:ajax
 * if ajax for objective will come from orm_al_assessment_loop_objective:ajax
 * if ajax for plo will come from orm_al_assessment_loop_plo:ajax
*/
    public function ajax() {

        $id = $this->input->post('id');
        $item_class = $this->input->post('item_class'); /** @var $item_class Orm_Al_Assessment_Loop */

        $item_class = in_array($item_class, Orm_Al_Assessment_Loop::get_item_class_types()) ? $item_class : Orm_Al_Assessment_Loop::class;

        echo $item_class::get_instance($id)->ajax();
    }
/** delete assessment loop object if exist
*/
    public function delete($id) {
        $assessment_loop = Orm_Al_Assessment_Loop::get_instance($id);

        if($assessment_loop->get_id()) {
            $assessment_loop->delete();
            Validator::set_success_flash_message(lang('Successful Delete'));
        }

        redirect($this->input->server('HTTP_REFERER'));
    }
/** manage assessment loop depending on assessment loop type
 * redirect assessment loop for every specific type
*/
    public function manage($type = 'measure', $id) {

        $assessment_loop = Orm_Al_Assessment_Loop::get_instance($id);

        if(!$assessment_loop->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect($this->input->server('HTTP_REFERER'));
        }

        switch ($type) {

            case 'recommendation':
                redirect("assessment_loop/recommendation?assessment_loop_id={$assessment_loop->get_id()}");
                break;

            case 'result':
                redirect("assessment_loop/result?assessment_loop_id={$assessment_loop->get_id()}");
                break;

            case 'analysis':
                redirect("assessment_loop/analysis?assessment_loop_id={$assessment_loop->get_id()}");
                break;

            case 'action':
                redirect("assessment_loop/action?assessment_loop_id={$assessment_loop->get_id()}");
                break;

            case 'measure':
            default:
                redirect("assessment_loop/measure?assessment_loop_id={$assessment_loop->get_id()}");
                break;
        }
    }

    /** declare assessment loop and filter it depending on college ,program , institution
     *render it in analysis view
     * @param $item_class
     * @param $item_id
     * @param int $college_id
     * @param int $program_id
     */
    public function assessment($item_class, $item_id, $college_id = 0, $program_id = 0) {

        /** @var $item_class Orm_Al_Assessment_Loop */

        if(!in_array($item_class, Orm_Al_Assessment_Loop::get_item_class_types())){
            redirect('/assessment_loop');
        }

        if(empty($item_id)){
            redirect('/assessment_loop');
        }

        if($program_id) {
            $type = Orm_Al_Assessment_Loop::ASSESSMENT_PROGRAM_LEVEL;
            $type_id = $program_id;
        } elseif($college_id) {
            $type = Orm_Al_Assessment_Loop::ASSESSMENT_COLLEGE_LEVEL;
            $type_id = $college_id;
        } else {
            $type = Orm_Al_Assessment_Loop::ASSESSMENT_INSTITUTION_LEVEL;
            $type_id = 0;
        }

        $semester_id = Orm_Semester::get_current_semester()->get_id();

        $assessment_loop = $item_class::get_one(array(
            'item_class'    => $item_class,
            'item_id'       => $item_id,
            'item_type'     => $type,
            'item_type_id'  => $type_id,
            'semester_id'   => $semester_id
        ));

        if(empty($assessment_loop->get_id())) {
            $assessment_loop->set_item_class($item_class);
            $assessment_loop->set_item_id($item_id);
            $assessment_loop->set_item_type($type);
            $assessment_loop->set_item_type_id($type_id);
            $assessment_loop->set_deadline(date('Y-m-d', strtotime('+1 year')));
            $assessment_loop->check_extra_data();
            $assessment_loop->save();
        }

        redirect('/assessment_loop/manage/analysis/'.$assessment_loop->get_id());
    }
/** generate pdf file
 * redirect on the same page
*/
    public function pdf($id) {
        $assessment_loop = Orm_Al_Assessment_Loop::get_instance($id);

        if($assessment_loop->get_id()) {
            $assessment_loop->generate_pdf();
        }

        redirect($this->input->server('HTTP_REFERER'));
    }
/** get domains for curriculum mapping module
 * render them as html page
*/
    public function get_domain()
    {

        if(!License::get_instance()->check_module('curriculum_mapping')) {
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