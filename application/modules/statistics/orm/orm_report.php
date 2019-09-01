<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/27/16
 * Time: 10:55 PM
 */

class Orm_Report extends Orm {

    /**
     * prepare the pdf for the statistics table and call library of WKHTMLTOPDF , the parameters that need are the following
     * @param $title
     * @param $view
     * name of tables and the html for view table
     */
    public function generate_pdf($title , $view) {

        $headerText = 'Academic Year: ' . Orm_Semester::get_active_semester()->get_year() . "<br>";
        $headerText .= $title . "<br>";
        $headerText .=  Orm_Institution::get_instance()->get_name();

        $config_array = Orm::get_ci()->config->item('wk_pdf_options');
        $config_array['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($config_array);
        $header_html = Orm::get_ci()->load->view('pdf_header', array('header' => $headerText), true);

        $pdf->setOptions(array(
            'margin-top' => 27,
            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line'
        ));

        $this->generate_pdf_page($pdf, $view);

        $files_dir = '/files/Documents/'.Orm_Semester::get_active_semester()->get_year().'/Institution/';

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name = str_replace('/', '-', $title) . '.pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    /**
     * prepare one page of pdf, the parameters that needs is the following
     * $pdf -> after we prepate the library will send here to continue and added on page
     * $content -> the html files that has the view that we need for the table
     * @param \mikehaertl\wkhtmlto\Pdf $pdf
     * @param $content
     */
    private function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf, $content) {

        Orm::get_ci()->layout->set_layout('layout_pdf');
        Orm::get_ci()->layout->content_as_html(true);

        $html = Orm::get_ci()->layout->view($content, array(), true);
        
        $pdf->addPage($html);
    }
}