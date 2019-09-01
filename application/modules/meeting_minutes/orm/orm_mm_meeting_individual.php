<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Mm_Meeting_Individual extends Orm_Mm_Meeting {


    /** generate components of pdf page to draw it
     */
    public function generate_pdf()
    {

        $headerText = lang('Meeting Minutes')." : ";
        $headerText .= $this->get_name(). "<br />";
        $headerText .= lang('Level')." : ";
        $headerText .= $this->get_level(true)." (".$this->get_level_id(true).")";

        $var=Orm::get_ci()->config->item('wk_pdf_options');
        $var['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($var);
        $header_html = Orm::get_ci()->load->view('pdf_header', array('header' => $headerText), true);

        $pdf->setOptions(array(
            'margin-top' => 27,

            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line',
            //footer
            'footer-left' => lang('Meeting Minutes')
        ));

        $pdf->addToc();

        $this->generate_pdf_page($pdf);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory();

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name =  'Meeting Minutes ('.$this->get_name().').pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }


    /** generate pages of pdf
     */
    private function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf &$pdf) {

        Orm::get_ci()->layout->set_layout('layout_pdf');

        $content = Orm::get_ci()->layout->content_as_html(false)->view('meeting_minutes/manage/report/page1', array('meeting' => $this), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('meeting_minutes/manage/report/page2', array('meeting' => $this), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('meeting_minutes/manage/report/page3', array('meeting' => $this), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('meeting_minutes/manage/report/page4', array('meeting' => $this), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('meeting_minutes/manage/report/page5', array('meeting' => $this), true);
        $pdf->addPage($content);
    }
}

