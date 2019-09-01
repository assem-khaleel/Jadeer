<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Reports
 */
class Reports extends MX_Controller
{
    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

//        Orm_User::check_logged_in();

        $this->view_params['sub_tab'] = 'reports';
        $this->view_params['menu_tab'] = 'reports';
        $this->breadcrumbs->push(lang('Reports'), '/Reports');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Reports'),
            'icon' => 'ion-stats-bars'
        ), true);
    }

    public function index()
    {

        $reports = [
            [
                'module'=>lang('Curriculum Mapping'),
                'license'=>License::get_instance()->check_module('curriculum_mapping'),
                'mReports'=>[
                    ['name'=>lang('Course Assessment Rubric'), 'category'=>'', 'link'=>'/curriculum_mapping/reporting/course_assessment_rubric'],
                    ['name'=>lang('Student Assessment Rubric'), 'category'=>'', 'link'=>'/curriculum_mapping/reporting/student_assessment_rubric'],
                    ['name'=>lang('Learning Domains Dashboard'), 'category'=>'', 'link'=>'/curriculum_mapping/reporting/outcomes'],
                    ['name'=>lang('Assessment Methods Dashboard'), 'category'=>'', 'link'=>'/curriculum_mapping/reporting/assessment_methods'],
                    ['name'=>lang('Learning Domains Indirect Assessment Results Dashboard'), 'category'=>'', 'link'=>'/curriculum_mapping/reporting/qualitative'],
                ]
            ],
            [
                'module'=>lang('KPI'),
                'license'=>License::get_instance()->check_module('kpi'),
                'mReports'=>[
                    ['name'=>lang('Accreditation KPIs Trend Report'), 'category'=>lang('Accreditation KPIs'), 'link'=>'/kpi/report/'.Orm_Kpi::KPI_LIST_REPORT_HISTORICAL],
                    ['name'=>lang('Accreditation KPIs Details Report'), 'category'=>lang('Accreditation KPIs'), 'link'=>'/kpi/report/'.Orm_Kpi::KPI_LIST_REPORT_DETAILS],
                    ['name'=>lang('Accreditation KPIs Benchmarks Report'), 'category'=>lang('Accreditation KPIs'), 'link'=>'/kpi/report/'.Orm_Kpi::KPI_LIST_REPORT_NORMAL],
                    ['name'=>lang('Strategic KPIs Trend Report'), 'category'=>lang('Strategic KPIs'), 'link'=>'/kpi/report/'.Orm_Kpi::KPI_LIST_REPORT_HISTORICAL.'/0/1'],
                    ['name'=>lang('Strategic KPIs Details Report'), 'category'=>lang('Strategic KPIs'), 'link'=>'/kpi/report/'.Orm_Kpi::KPI_LIST_REPORT_DETAILS.'/0/1'],
                    ['name'=>lang('Strategic KPIs Benchmarks Report'), 'category'=>lang('Strategic KPIs'), 'link'=>'/kpi/report/'.Orm_Kpi::KPI_LIST_REPORT_NORMAL.'/0/1'],
                ]
            ],
            [
                'module'=>lang('Dashboards'),
                'license'=>true,
                'mReports'=>[
                    ['name'=>lang('Organization Chart'), 'category'=>'', 'link'=>'/dashboard/org_chart'],
                ]
            ],

        ];

        $this->view_params['reports']=$reports;
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Reports'),
            'icon' => 'ion-stats-bars',
        ), true);

        $this->layout->view('reports/index', $this->view_params);
    }
}