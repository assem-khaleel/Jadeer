<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @property Breadcrumbs $breadcrumbs
 * Class Dashboard
 */
class Dashboard extends MX_Controller {

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

        define('MODULES_ONLY', true);

        Orm_User::check_logged_in();

        $this->breadcrumbs->push(lang('Dashboard'), '/dashboard');

        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js');
        $this->layout->add_javascript('https://www.google.com/jsapi', false);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Dashboards'),
            'icon' => 'ion-ios-pulse-strong'
        ), true);

    }

    public function index()
    {
        if (is_null(Orm_User::get_institution_role()) || Orm_User::get_institution_role() == Orm_Role::ROLE_NOT_ADMIN) {
            $this->personal();
        } else {
            if(License::get_instance()->check_module('accreditation') && Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'dashboard-national_accreditation')) {
                $this->national();
            } elseif (License::get_instance()->check_module('accreditation') && Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'dashboard-international_accreditation')) {
                $this->international();
            } elseif (License::get_instance()->check_module('accreditation') && Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'dashboard-status')) {
                $this->status();
            } elseif(License::get_instance()->check_module('kpi') && Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'dashboard-kpi')) {
                $this->kpi();
            } else {
                $this->personal();
            }
        }
    }

    public function national() {

        if(!License::get_instance()->check_module('accreditation')) {
            show_404();
        }

        Orm_User::check_permission(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'dashboard-national_accreditation');

        $html = Modules::run('accreditation/accreditation_dashboard/national');

        if(Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)
            || (Orm_Node_Assessor::get_count(array('in_assessor_id'=>Orm_User::get_logged_user()->get_id())) != 0)
            || (Orm_Node_Reviewer::get_count(array('in_reviewer_id'=>Orm_User::get_logged_user()->get_id())) != 0)){

            $download_ssr= Orm_Node::get_node_id_by_year(Orm_Semester::get_active_semester()->get_year());

            if($download_ssr != 0){
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => "data-toggle='ajaxModal' href='/accreditation/download/{$download_ssr}'",
                    'link_icon' => 'download',
                    'link_title' => lang('Download SSRI')
                ), true);
            }
        }


        if ($this->input->is_ajax_request()) {
            exit($html);
        } else {
            $this->view_params['menu_tab'] = 'dashboard_national';

            $this->layout->content_as_html(true)->view($html, $this->view_params);
        }
    }

    public function international() {

        if(!License::get_instance()->check_module('accreditation')) {
            show_404();
        }

        Orm_User::check_permission(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'dashboard-international_accreditation');

        $html = Modules::run('accreditation/accreditation_dashboard/international');

        if ($this->input->is_ajax_request()) {
            exit($html);
        } else {
            $this->view_params['menu_tab'] = 'dashboard_international';

            $this->layout->content_as_html(true)->view($html, $this->view_params);
        }
    }

    public function kpi() {

        if(!License::get_instance()->check_module('kpi')) {
            show_404();
        }

        Orm_User::check_permission(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'dashboard-kpi');

        $html = Modules::run('kpi/kpi_dashboard/index');

        if ($this->input->is_ajax_request()) {
            exit($html);
        } else {
            $this->view_params['menu_tab'] = 'dashboard_kpi';

            $this->layout->content_as_html(true)->view($html, $this->view_params);
        }
    }
/*
    public function strategic_planning() {

        if(!License::get_instance()->check_module('strategic_planning')) {
            show_404();
        }

        Orm_User::check_permission(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'dashboard-strategic_planning');

        $html = Modules::run('strategic_planning/strategic_planning_dashboard/index');

        if ($this->input->is_ajax_request()) {
            exit($html);
        } else {
            $this->view_params['menu_tab'] = 'strategic_planning';

            $this->layout->content_as_html(true)->view($html, $this->view_params);
        }
    }
*/
    public function personal() {

        $html = $this->load->view('dashboard/personal', $this->view_params, true);

        if(License::get_instance()->check_module('accreditation')) {
            if (Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), true)) {
                $html .= Modules::run('accreditation/accreditation_dashboard/personal');
            }
        }

        $this->view_params['menu_tab'] = 'dashboard_personal';

        $this->layout->content_as_html(true)->view($html, $this->view_params);
    }

	public function status() {

        if(!License::get_instance()->check_module('accreditation')) {
            show_404();
        }

        Orm_User::check_permission(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'dashboard-status');

		$html = Modules::run('accreditation/status/index');

		$this->view_params['menu_tab'] = 'dashboard_status';

        $this->layout->content_as_html(true)->view($html, $this->view_params);
	}

	public function org_chart() {

        $root = Orm_Unit::get_one(array('class_type' => Orm_Unit_Rector::class, 'parent_id' => 0));

        $this->view_params['root'] = $root;
        $this->view_params['menu_tab'] = 'dashboard_orgchart';

        $this->layout->add_javascript('/assets/jadeer/js/jquery.orgchart.js');
        $this->layout->add_javascript('/assets/jadeer/js/jspdf.debug.js');
        $this->layout->add_stylesheet('/assets/jadeer/css/jquery.orgchart.css');

        $this->layout->view('unit/orgchart', $this->view_params);
    }

}
