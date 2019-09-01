<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rim_Risk_Management_Kpi extends Orm_Rim_Risk_Management {

    protected $type = __CLASS__;

    public function __construct(){
        parent::__construct();

        Modules::load('kpi');
    }
    /** draw propriteies for this type(kpi management)
     */
    public function draw_properties() {
        echo Orm::get_ci()->load->view('types/kpi/properties', array('risk_management' => $this), true);
    }
    /** ajax for this specific type to render it as ajax
     */
    public function ajax() {
        echo Orm::get_ci()->load->view('types/kpi/ajax', array('risk_management' => $this), true);
    }
    /** get title of this activity type
     */
    public function get_type_title() {
        return Orm_Kpi::get_instance($this->get_type_id())->get_title();
    }
    /** draw pdf file and get title of it
     */
    public function draw($pdf=false) {
        $kpi = Orm_Kpi::get_instance($this->get_type_id());

        switch($this->get_level_type()) {
            case self::RISK_COLLEGE_LEVEL:
                $type = Orm_Kpi_Detail::TYPE_COLLEGE;
                $filter =['college_id' => $this->get_level_id()];
                break;

            case self::RISK_PROGRAM_LEVEL:
                $type = Orm_Kpi_Detail::TYPE_PROGRAM;
                $filter =[
                    'college_id' => Orm_Program::get_instance($this->get_level_id())->get_department_obj()->get_college_id(),
                    'program_id' => $this->get_level_id()
                ];
                break;

            default:
                $type = Orm_Kpi_Detail::TYPE_INSTITUTION;
                $filter =[];
                break;
        }

        $filter['is_report'] = $pdf;

        if($pdf){
            return "<script>google.load('visualization', '1', {packages: ['corechart', 'bar', 'table']});</script>".
                    $kpi->get_view_header(Orm_Kpi::KPI_REPORT_NORMAL,$type, $filter);
        }

        return "<script>google.load('visualization', '1', {packages: ['corechart', 'bar', 'table']});</script>".
                $kpi->draw_chart($type, $filter);
    }

    public function get_attachments_directory($type, $filters) {

        $path = Orm_Semester::get_active_semester()->get_year() . '/';
        switch ($type) {
            case self::RISK_INSTITUTION_LEVEL:
                $path .= 'Institution/';
                break;
            case self::RISK_COLLEGE_LEVEL:
                $path .= Orm_College::get_instance($filters)->get_name_en() . '/';
                break;
            case self::RISK_PROGRAM_LEVEL:
                $path .= Orm_Program::get_instance($filters)->get_department_obj()->get_college_obj()->get_name_en() . '/';
                $path .= Orm_Program::get_instance($filters)->get_name_en() . '/';
                break;
        }

        $path .= 'Risk Management';

        return $path;
    }
}

