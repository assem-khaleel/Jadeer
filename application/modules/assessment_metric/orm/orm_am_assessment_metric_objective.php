<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Am_Assessment_Metric_Objective extends Orm_Am_Assessment_Metric {

    protected $item_class = __CLASS__;


    /**
     * this function draw properties
     * @return string|void html the call function
     */
    public function draw_properties() {
        echo Orm::get_ci()->load->view('types/objective/properties', array('assessment_metric' => $this), true);
    }

    /**
     * this function ajax
     * @return string|void html the call function
     */
    public function ajax() {
        echo Orm::get_ci()->load->view('types/objective/ajax', array('assessment_metric' => $this), true);
    }

    /**
     * this function get item title
     * @return string the call function
     */
    public function get_item_title() {

        /** @var Orm_Institution_Objective $class_type */

                $class_type = Orm_Program_Objective::class;


        if (class_exists($class_type)) {
            $item_object = $class_type::get_instance($this->get_item_id());

            if ($item_object->get_id()) {
                return $item_object->get_title();
            }
        }

        return lang('Source Deleted');
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
        $this->set_extra_data([]);
    }

    /**
     * @param int $all_component
     */
    public function generate_pdf($all_component=0) {

        $headerText = lang('Assessment Metric')." : ";
        $headerText .= $this->get_item_title(). "<br />";
        $headerText .= lang('Level')." : ";
        $headerText .= $this->get_level();

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

        $name =  'Assessment Metric (Objective '.$this->get_item_title().').pdf';
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

