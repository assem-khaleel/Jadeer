<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Config $config
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * Class Risk_treatment
 */
class Risk_treatment extends MX_Controller {

    private $view_params = array();
    private $risk_id = null;

    public function __construct() {

        parent::__construct();

        if(!License::get_instance()->check_module('risk_management', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        $this->risk_id = (int) $this->input->get_post('risk_id');

        $risk_management = Orm_Rim_Risk_Management::get_instance($this->risk_id);

        $this->view_params['risk_management'] = $risk_management;
        $this->view_params['risk_id'] = $risk_management->get_id();

        if (!$risk_management->get_id()) {
            Validator::set_error_flash_message(lang('Invalid Resource'));
            if ($this->input->is_ajax_request()) {
                exit('<script>window.location.replace("/risk_management")</script>');
            } else {
                redirect('/risk_management');
            }
        }

        $this->breadcrumbs->push(lang('Risk Management'), '/risk_management');

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Risk Treatment'),
            'icon' => 'fa fa-bug'
        ), true);
        $this->view_params['menu_tab'] = 'risk_treatment';

        $this->breadcrumbs->push(lang('Risk Management'), '/risk_management');

    }
/**  it's dashboard for risk treatment that fetch data from risk management to display risk data
 * render it in manage view
*/
    public function index() {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Risk Treatment'),
            'icon' => 'fa fa-bug',
            'link_attr' => 'href="/risk_management/pdf/'.$this->risk_id.'"',
            'link_icon' => 'file-pdf-o',
            'link_title' => lang('Extract to').' '.lang('PDF')
        ), true);

        $risk_treatments = Orm_Rim_Risk_Treatment::get_all(['risk_id' => $this->risk_id]);
        $risk = Orm_Rim_Risk_Management::get_instance($this->risk_id);

        $this->view_params['risk_treatments'] = $risk_treatments;
        $this->view_params['risk'] = $risk;
        $this->view_params['menu_tab'] = 'risk_management';
        $this->breadcrumbs->push(lang('Risk Treatment'), '/risk_Management/risk_treatment/');
        $this->layout->view('/risk_treatment/manage', $this->view_params);
    }
/** add or edit risk treatment without save
 * render in add edit view
*/
    public function add_edit($id = 0) {

        $this->view_params['risk_treatment'] = Orm_Rim_Risk_Treatment::get_instance($id);
        $this->load->view('risk_management/risk_treatment/add_edit', $this->view_params);
    }
/** save risk treatment object
 * back with json response for ajax
*/
    public function save() {

        $id = $this->input->post('id');
        $responsible_id = $this->input->post('responsible_id'); /** @var $type Orm_Rim_Risk_Treatment */
        $desc_ar = $this->input->post('desc_ar');
        $desc_en = $this->input->post('desc_en');
        $risk_desc_ar = $this->input->post('risk_desc_ar');
        $risk_desc_en = $this->input->post('risk_desc_en');
        $impact_ar = $this->input->post('impact_ar');
        $impact_en = $this->input->post('impact_en');

        Validator::required_field_validator('desc_ar', $desc_ar, lang('Required Field'));
        Validator::required_field_validator('desc_en', $desc_en, lang('Required Field'));
        Validator::required_field_validator('responsible_id', $responsible_id, lang('Required Field'));
        Validator::not_empty_field_validator('responsible_id', $responsible_id, lang('Required Field'));

        $risk_treatment = Orm_Rim_Risk_Treatment::get_instance($id);

        $risk_treatment->set_responsible_id($responsible_id);
        $risk_treatment->set_risk_id($this->risk_id);
        $risk_treatment->set_desc_ar($desc_ar);
        $risk_treatment->set_desc_en($desc_en);
        $risk_treatment->set_risk_desc_ar($risk_desc_ar);
        $risk_treatment->set_risk_desc_en($risk_desc_en);
        $risk_treatment->set_impact_ar($impact_ar);
        $risk_treatment->set_impact_en($impact_en);

        if($risk_treatment->is_valid() && Validator::success() ) {
            json_response(['status' => true, 'id' => $risk_treatment->save()]);
        }

        $this->view_params['risk_treatment'] = $risk_treatment;
        json_response(['status' => false, 'html' => $this->load->view('risk_treatment/add_edit', $this->view_params, true)]);

    }

    /** delete risk treatment object if exist
    */
    public function delete($id) {
        $risk_treatment = Orm_Rim_Risk_Treatment::get_instance($id);

        if($risk_treatment->get_id()) {
            $risk_treatment->delete();
            Validator::set_success_flash_message(lang('Successfully Delete'));
        }
    }
}