<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Mm_Meeting_Advisory extends Orm_Mm_Meeting
{

public $student_ids = false;

    public function draw_properties()
    {
        if(!License::get_instance()->check_module('advisory')){
            return parent::draw_properties();
        }

        Modules::load('advisory');

        $per_page =5;
        $advisory_page = $this->get_ci()->input->post_get('page')?: 1;

        $advisory_search = $this->get_ci()->input->post_get('advisory_search');

        $student_ids = Orm_Mm_Attendance::get_all(['meeting_id'=>$this->get_id()]);

        if (!$advisory_page) {
            $advisory_page = 1;
        }
        
        $orm_filter =[];

        if(!empty($advisory_search)) {
            $orm_filter['student_like'] = $advisory_search;
        }

        $students = Orm_Ad_Student_Faculty::get_all($orm_filter, $advisory_page, $per_page);

        $uri  = explode("?",$_SERVER['REQUEST_URI']);

        $uri =isset($uri[1])?$uri[1]:'';

        return $this->get_ci()->load->view('list_advisory', ['students' => $students, 'orm_filter' => $orm_filter, 'advisory_page' => $advisory_page,'student_ids' => $student_ids], true);

    }

    /** save advisory object
    */

    public function save()
    {
        if(!License::get_instance()->check_module('advisory')){
            return parent::save();
        }

        Modules::load('advisory');
        parent::save();

        $student_ids = $this->student_ids;


        if(is_array($student_ids)){
            Orm_Mm_Attendance::get_model()->delete_all($this->get_id());

            foreach($student_ids as $id){

                $attendance = new Orm_Mm_Attendance();
                $attendance->set_meeting_id($this->get_id());
                $attendance->set_user_id($id);
                $attendance->save();
            }
        }


        Orm_Mm_Agenda::delete_unsigned_users($this->get_id());

        return $this->get_type_id();

    }

    /** generate pdf file and save it
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


    /** generate pages for pdf
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