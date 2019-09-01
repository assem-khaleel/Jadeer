<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Al_Assessment_Loop_Kpi extends Orm_Al_Assessment_Loop {

    protected $item_class = __CLASS__;

    public function __construct(){
        parent::__construct();

        Modules::load('kpi');
    }

    /**draw properties page to draw properties for kpi assessment loop after check credentials for program learning outcome
     */
    public function draw_properties() {
        echo Orm::get_ci()->load->view('types/kpi/properties', array('assessment_loop' => $this), true);
    }

    /** function derivation from parent class and load view as ajax request
     */
    public function ajax() {
        echo Orm::get_ci()->load->view('types/kpi/ajax', array('assessment_loop' => $this), true);
    }

    public function get_item_title() {
        return Orm_Kpi::get_instance($this->get_item_id())->get_title();
    }

    /** draw kpi object as charts  after filtering
     */
    public function draw($pdf=false) {
        $kpi = Orm_Kpi::get_instance($this->get_item_id());

        switch($this->get_item_type()) {
            case self::ASSESSMENT_COLLEGE_LEVEL:
                $type = Orm_Kpi_Detail::TYPE_COLLEGE;
                $filter =['college_id' => $this->get_item_type_id()];
                break;

            case self::ASSESSMENT_PROGRAM_LEVEL:
                $type = Orm_Kpi_Detail::TYPE_PROGRAM;
                $filter =[
                    'college_id' => Orm_Program::get_instance($this->get_item_type_id())->get_department_obj()->get_college_id(),
                    'program_id' => $this->get_item_type_id()
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

    /** add data for object if object exist
     */
    public function check_extra_data() {

        $kpi = Orm_Kpi::get_instance($this->get_item_id());

        $data = array(
            'kpi_category_id' => $kpi->get_category_id()
        );

        $this->set_extra_data($data);
    }

    /** draw pdf page for kpi page
     */
    public function generate_pdf() {

        $headerText = lang('Assessment Loop')." : ";
        $headerText .= $this->get_item_title(). "<br />";
        $headerText .= lang('Level')." : ";
        $headerText .= $this->get_item_types()[$this->get_item_type()];

        switch ($this->get_item_type()) {
            case Orm_Al_Assessment_Loop::ASSESSMENT_COLLEGE_LEVEL:
                $headerText .= " (".Orm_College::get_instance($this->get_item_type_id())->get_name() .")";
                break;
            case Orm_Al_Assessment_Loop::ASSESSMENT_PROGRAM_LEVEL:
                $headerText .= " (".Orm_Program::get_instance($this->get_item_type_id())->get_name().")";
                break;
        }

        $config_array = Orm::get_ci()->config->item('wk_pdf_options');
        $config_array['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($config_array);
        $header_html = Orm::get_ci()->load->view('pdf_header', array('header' => $headerText), true);

        $pdf->setOptions(array(
            'margin-top' => 27,
            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line',
            'footer-left' => lang('Assessment Loop')
        ));

        $pdf->addToc();

        $this->generate_pdf_page($pdf);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($this->get_item_type(), $this->get_item_type_id());

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name =  'Assessment Loop (KPI '.Orm_Kpi::get_instance($this->get_item_id())->get_code().').pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    /** set layout for pdf page and draw it
     */
    public function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf) {

        Orm::get_ci()->layout->set_layout('layout_pdf');

        Orm::get_ci()->layout->add_javascript('https://www.google.com/jsapi', false);
        Orm::get_ci()->layout->add_javascript('/assets/jadeer/js/jquery-2.2.0.min.js');

        $content = Orm::get_ci()->layout->content_as_html(true)->view($this->draw(true), array(), true);
        $pdf->addPage($content);

        //reset layout
        Orm::get_ci()->layout->set_layout('layout_pdf');

        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_loop/report/analysis', array('analysis' => $this->get_analysis_obj()), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_loop/report/measure', array('measures' => $this->get_measure_objs()), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_loop/report/result', array('results' => $this->get_result_objs()), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_loop/report/recommendation', array('recommendations' => $this->get_recommendation_objs()), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_loop/report/action', array('actions' => $this->get_action_objs()), true);
        $pdf->addPage($content);
    }

    public function get_attachments_directory($type, $filters)
    {
        $path = Orm_Semester::get_active_semester()->get_year() . '/';
        switch ($type) {
            case self::ASSESSMENT_INSTITUTION_LEVEL:
                $path .= 'Institution/';
                break;
            case self::ASSESSMENT_COLLEGE_LEVEL:
                $path .= Orm_College::get_instance($filters)->get_name_en() . '/';
                break;
            case self::ASSESSMENT_PROGRAM_LEVEL:
                $path .= Orm_Program::get_instance($filters)->get_department_obj()->get_college_obj()->get_name_en() . '/';
                $path .= Orm_Program::get_instance($filters)->get_name_en() . '/';
                break;
        }

        $path .= 'Assessment Loop';

        return $path;
    }
}

