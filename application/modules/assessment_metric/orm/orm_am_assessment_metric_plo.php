<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Am_Assessment_Metric_Plo extends Orm_Am_Assessment_Metric {

    protected $item_class = __CLASS__;

    /**
     * Orm_Am_Assessment_Metric_Plo constructor.
     */
    public function __construct(){
        parent::__construct();

        Modules::load('curriculum_mapping');
    }

    /**
     * this function draw properties
     * @return string|void html the call function
     */
    public function draw_properties() {
        echo Orm::get_ci()->load->view('types/plo/properties', array('assessment_metric' => $this), true);
    }

    /**
     * this function ajax
     * @return string|void html the call function
     */
    public function ajax() {
        echo Orm::get_ci()->load->view('types/plo/ajax', array('assessment_metric' => $this), true);
    }

    /**
     * this function get item title
     * @return string the call function
     */
    public function get_item_title() {

        $obj = Orm_Cm_Program_Learning_Outcome::get_instance($this->get_item_id());
        return $obj->get_id() ? $obj->get_text() : lang('Source Deleted');
    }

    /**
     * @param bool $pdf
     * @return string
     */
    public function draw($pdf=false) {

        return htmlfilter($this->get_item_title());
    }

    /**
     * this function check extra data
     * @return string the call function
     */
    public function check_extra_data() {

        $plo = Orm_Cm_Program_Learning_Outcome::get_instance($this->get_item_id());

        $data = array(
            'learning_domain' => $plo->get_learning_domain_id()
        );

        $this->set_extra_data($data);
    }

    /**
     * @param int $all_component
     */
    public function generate_pdf($all_component=0) {

        $headerText = lang('Assessment Metric')." : ";
        $headerText .= $this->get_item_title(). "<br />";

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
            'footer-left' => lang('Assessment Metric')
        ));

        $this->generate_pdf_page($pdf,$all_component);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($this->get_item_id());

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name =  'Assessment Metric (Program Learning Outcome #'.Orm_Cm_Program_Learning_Outcome::get_instance($this->get_item_id())->get_code().').pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    /**
     * @param \mikehaertl\wkhtmlto\Pdf $pdf
     * @param $all_component
     */
    public function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf, $all_component) {

        Orm::get_ci()->layout->set_layout('layout_pdf');
        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_metric/view_simple', array('assessment_metric' => $this,'all_component' => $all_component), true);
        $pdf->addPage($content);

    }


}

