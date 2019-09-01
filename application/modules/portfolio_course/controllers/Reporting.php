<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 4/17/17
 * Time: 12:31 PM
 */

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 *
 * Class Reporting
 */
class Reporting extends MX_Controller {

    public $view_params;
    private $course_id;

    /**
     * Reporting constructor.
     */
    public function __construct() {
        parent::__construct();

        $this->course_id = $this->input->get_post('id');

        Orm_User::check_logged_in();
        if (!License::get_instance()->check_module('portfolio_course', true)) {
            show_404();
        }

        $this->view_params['course_id'] = $this->course_id;

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->breadcrumbs->push(lang('Portfolio Course'), '/portfolio_course');
        $this->breadcrumbs->push(lang('Reporting'), '/portfolio_course/reporting');

        $this->view_params['menu_tab'] = 'portfolio_course';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Course Portfolio') . ' - ' . lang('Reporting'),
            'icon' => 'fa fa-book',
            'menu_view' => 'portfolio_course/sub_menu',
            'menu_params' => array('type' => 'reporting', 'id' => $this->input->get('id'))
        ), true);

    }

    /**
     *this function index get all data report
     * @return string the html view
     */
    public function index() {

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        if (!$page) {
            $page = 1;
        }
        $filters = array();

        $reports = Orm_Pc_Report::get_all($filters, $page, $per_page);
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Pc_Report::get_count($filters));


        $this->view_params['reports'] = $reports;
        $this->view_params['pager'] = $pager->render(true);

        $this->layout->view('portfolio_course/reporting/list', $this->view_params);

    }

    /**
     * this function add edit by its id
     * @param int $id the id of the add edit to be viewed
     * @redirect success or error
     */
    public function add_edit($id = 0) {

        $report = Orm_Pc_Report::get_instance($id);
        $this->view_params['report'] = $report;
        $this->load->view('reporting/add_edit', $this->view_params);
    }

    /**
     * this function save by its id
     * @param int $id the id of the save to be viewed
     * @redirect success or error
     */
    public function save($id = 0) {

        $title_en = $this->input->post('title_en');
        $title_ar = $this->input->post('title_ar');
        $course_id = $this->input->get('id');
        $components = (array) $this->input->post('component');
        $custom_components = (array) $this->input->post('custom_component');

        // validation
        Validator::required_field_validator('title_en', $title_ar, lang('Required Field'));
        Validator::required_field_validator('title_ar', $title_en, lang('Required Field'));
        Validator::required_array_validator('component', $components, lang('Required Field'));

        $report = Orm_Pc_Report::get_instance($id);
        $report->set_title_ar($title_ar);
        $report->set_title_en($title_en);
        $report->set_course_id($course_id);

        if (Validator::success()) {

            $report->save();

            foreach ($components as $component) {
                $component_obj = Orm_Pc_Report_Components::get_one(['component_id' => $component, 'report_id' => $report->get_id(), 'is_core' => 1]);
                $component_obj->set_report_id($report->get_id());
                $component_obj->set_is_core(1);
                $component_obj->set_component_id($component);
                $component_obj->save();
            }

            foreach ($custom_components as $component) {
                $component_obj = Orm_Pc_Report_Components::get_one(['component_id' => $component, 'report_id' => $report->get_id(), 'is_core' => 0]);
                $component_obj->set_report_id($report->get_id());
                $component_obj->set_is_core(0);
                $component_obj->set_component_id($component);
                $component_obj->save();
            }

            $to_remove_components = array_diff($report->get_component_ids(), $components);

            foreach ($to_remove_components as $component_to_remove) {
                $component_obj = Orm_Pc_Report_Components::get_one(['component_id' => $component_to_remove, 'report_id' => $report->get_id(), 'is_core' => 1]);
                $component_obj->delete();
            }

            $to_remove_components = array_diff($report->get_component_ids(0), $custom_components);

            foreach ($to_remove_components as $component_to_remove) {
                $component_obj = Orm_Pc_Report_Components::get_one(['component_id' => $component_to_remove, 'report_id' => $report->get_id(), 'is_core' => 0]);
                $component_obj->delete();
            }

            Validator::set_success_flash_message(lang('Report Saved Successfully'));

            json_response(array('error' => false));
        }

        $this->view_params['report'] = $report;
        json_response(array('error' => true, 'html' => $this->load->view('reporting/add_edit', $this->view_params, true)));
    }

    /**
     * this function delete by its id
     * @param int $id the id of the delete to be viewed
     * @redirect success or error
     */
    public function delete($id) {

        $reports = Orm_Pc_Report::get_instance($id);
        $reports->delete();
        Validator::set_success_flash_message(lang('Report deleted successfully'));
    }

    /**
     * this function pdf by its id to be viewed
     * @param int $id the id the pdf
     * @return string the pdf view
     */
    public function pdf($id) {

        $report = Orm_Pc_Report::get_instance($id);
        $report->generate_pdf();

    }
}