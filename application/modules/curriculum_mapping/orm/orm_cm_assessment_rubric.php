<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/2/17
 * Time: 3:58 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Cm_Assessment_Rubric extends Orm {


    /**
     * name of report
     * @return string
     */
    public static function get_title() {
        return 'Course Assessment Rubric';
    }

    /**
     * path of file that will save in it
     * @param $filters
     * @return int|string
     */
    public static function get_attachments_directory($filters)
    {
        $path = Orm_Semester::get_active_semester()->get_year();
        if (isset($filters['course_id']))
        {
            $path .= '/'.Orm_Course::get_instance($filters['course_id'])->get_department_obj()->get_college_obj()->get_name('english');
            $path .= '/'.Orm_Course::get_instance($filters['course_id'])->get_department_obj()->get_name('english');
            $path .= '/'.Orm_Semester::get_active_semester()->get_name();
            $path .= '/'.Orm_Course::get_instance($filters['course_id'])->get_name('english');
            if (isset($filters['section_id'])) {
                $path .= '/'.Orm_Course_Section::get_instance($filters['section_id'])->get_section_no();
            }
        }
        $path .= '/Rubrics/';
        return $path;
    }

    /**
     * prepare data for set in pdf file
     * @param $filters
     */
    public static function generate_pdf($filters)
    {
        $headerText = Orm_Semester::get_active_semester()->get_name() . ' Academic Year: ' . Orm_Semester::get_active_semester()->get_year() . "<br>";
        if (isset($filters['course_id']))
        {
            $course = Orm_Course::get_instance($filters['course_id']);
            $headerText .= $course->get_code_en() .' '. $course->get_name('english').(isset($filters['section_id']) ? ' ( Section #.:' . Orm_Course_Section::get_instance($filters['section_id'])->get_section_no() .' )' : '')."<br>";
            $headerText .= $course->get_department_obj()->get_name() ? $course->get_department_obj()->get_name()."<br>" : "";
            $headerText .= $course->get_department_obj()->get_college_obj()->get_name() ? $course->get_department_obj()->get_college_obj()->get_name()."<br>" : "";
        }
        $headerText .= Orm_Institution::get_one()->get_name_en();

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

        self::generate_pdf_page($pdf,$filters);

        $files_dir = '/files/Documents/' . self::get_attachments_directory($filters);

        //check if file exists or not
        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $name = self::get_title() .(isset($filters['section_id']) ? '-'.Orm_Course_Section::get_instance($filters['section_id'])->get_section_no() : ''). '.pdf';
        $file_name = rtrim($files_full_dir,'/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name))
        {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    /**
     *  prepare data for set in image file using WKHTMLTOIMAGE Library
     * @param $filters
     */
    public static function generate_image($filters) {

        $img = new \mikehaertl\wkhtmlto\Image(Orm::get_ci()->config->item('wk_image_options'));

        self::generate_image_page($img,$filters);

        $files_dir = '/files/Documents/' . self::get_attachments_directory($filters);;

        //check if file exists or not
        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $name = self::get_title() .(isset($filters['section_id']) ? '-'.Orm_Course_Section::get_instance($filters['section_id'])->get_section_no() : ''). '.png';
        $file_name = $files_full_dir . '/' . $name;

        $img->saveAs($file_name);
        if (!$img->send($name))
        {
            echo $img->getCommand()->getOutput();
            die($img->getError());
        }
    }

    /**
     * get one page of pdf file
     * @param $img
     * @param $filters
     */
    private static function generate_image_page(\mikehaertl\wkhtmlto\Image $img,$filters) {
        if (isset($filters['student_id']) && $filters['student_id']) {
            $content = Orm::get_ci()->load->view('reporting/student_rubric',$filters,true);
        } else {
            $content = Orm::get_ci()->load->view('reporting/rubric',$filters,true);
        }

        Orm::get_ci()->layout->content_as_html(true);
        Orm::get_ci()->layout->set_layout('layout_pdf');

        Orm::get_ci()->layout->stylesheet = array();

        $lang = (UI_LANG == 'arabic') ? '.rtl' : '';

        Orm::get_ci()->layout->add_stylesheet("/assets/pixel/css/bootstrap{$lang}.min.css");
        Orm::get_ci()->layout->add_stylesheet("/assets/pixel/css/themes/candy-green{$lang}.min.css");
        Orm::get_ci()->layout->add_stylesheet("/assets/jadeer/css/img-style.css");

        Orm::get_ci()->layout->add_javascript('https://www.google.com/jsapi', false);

        $html = Orm::get_ci()->layout->view($content, array(), true);
        $img->setPage($html);
    }

    /**
     * get one page of pdf and calling WKHTMLTOPDF library
     * @param \mikehaertl\wkhtmlto\Pdf $pdf
     * @param array $filters
     */
    private static function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf, $filters)
    {
        if (isset($filters['student_id']) && $filters['student_id']) {
            $content = Orm::get_ci()->load->view('reporting/student_rubric',$filters,true);
        } else {
            $content = Orm::get_ci()->load->view('reporting/rubric',$filters,true);
        }

        Orm::get_ci()->layout->content_as_html(true);
        Orm::get_ci()->layout->set_layout('layout_pdf');

        Orm::get_ci()->layout->add_javascript('https://www.google.com/jsapi', false);

        $html = Orm::get_ci()->layout->view($content,array(),true);

        $pdf->addPage($html);
    }
}