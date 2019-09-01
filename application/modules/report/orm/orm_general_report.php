<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_General_Report extends Orm
{

    /**
     * check if the Module of Curriculum Mapping Active OR Not if Active then will return all data that need for report
     */
    public static function get_cm()
    {
        if (!License::get_instance()->check_module('program_tree')) {
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            redirect('/report');
        }

        Modules::load('curriculum_mapping');
    }


    /**
     * check if the Module of Program Tree Active OR Not if Active then will return all data that need for report
     */
    public static function get_obj()
    {
        if (!License::get_instance()->check_module('program_tree')) {
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            redirect('/report');
        }

        return Modules::load('program_tree');
    }

    /**
     * check if the Module of Assessment Metrics Active OR Not if Active then will return all data that need for report
     */
    public static function get_am()
    {
        if (!License::get_instance()->check_module('assessment_metric')) {
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            redirect('/report');
        }

        return Modules::load('assessment_metric');
    }

    /**
     * check if the Module of Assessment Loop Active OR Not if Active then will return all data that need for report
     */
    public static function get_al_loop()
    {
        if (!License::get_instance()->check_module('assessment_loop')) {
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            redirect('/report');
        }

        return  Modules::load('assessment_loop');
    }


    /**
     * prepare the pdf before Downloading and collect the Important Data on
     * @param $data
     */
    public Static function pdf($data)
    {
        switch ($data['type']) {
            case 'xmatrix':

                self::get_cm();
                $data['programs'] = Orm_Program_Plan::get_all(array('course_id' => $data['item_id']));
                $data['clos'] = Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $data['item_id']));

                break;
            case 'pxmatrix':

                self::get_cm();
                $data['programs'] = Orm_Program_Plan::get_all(array('program_id' => $data['item_id']));
                $data['clos'] = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $data['item_id']));

                break;

            case 'ipamatrix':

                self::get_cm();
                $data['programs'] = Orm_Program_Plan::get_all(array('program_id' => $data['item_id']));
                $data['clos'] = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $data['item_id']));

                break;

            case 'assessment_loop_pl':

                self::get_al_loop();
                $data['assessment_loops'] = Orm_Al_Assessment_Loop::get_all(array('item_class' => 'Orm_Al_Assessment_Loop_Plo', 'item_type_id' => $data['item_id'], 'semester_id' => Orm_Semester::get_active_semester_id()));
                break;

            case 'assessment_loop_obj':

                self::get_al_loop();
                $data['assessment_loops'] = Orm_Al_Assessment_Loop::get_all(array('item_class' => 'Orm_Al_Assessment_Loop_Objective', 'item_type_id' => $data['item_id'], 'semester_id' => Orm_Semester::get_active_semester_id()));
                break;

            case 'assess_metric':

                self::get_am();
                $data['all_assessment_metric'] = Orm_Am_Assessment_Metric::get_all(['program_id' => $data['item_id'], 'item_class' => 'Orm_Am_Assessment_Metric_Plo']);
                $data['program_id'] = $data['item_id'];
                break;

            case 'obj_assessment_metric':

                self::get_am();
                $data['all_assessment_metric'] = Orm_Am_Assessment_Metric::get_all(['program_id' => $data['item_id'], 'item_class' => 'Orm_Am_Assessment_Metric_Objective']);
                $data['program_id'] = $data['item_id'];
                break;

            case 'course_assess_metric':
                self::get_am();
                $data['all_assessment_metric'] = Orm_Am_Assessment_Metric::get_all(['course_extra_data' => $data['item_id'], 'item_class' => 'Orm_Am_Assessment_Metric_Clo']);
                $data['course_id'] = $data['item_id'];
                break;

            case 'course_obj_assessment_metric':
                self::get_am();
                $data['all_assessment_metric'] = Orm_Am_Assessment_Metric::get_all(['program_id' => $data['item_id'], 'item_class' => 'Orm_Am_Assessment_Metric_Objective']);
                $data['program_id'] = $data['item_id'];
                break;
            case 'obj_matrix':

                self::get_cm();
                self::get_obj();

                $data['objectives'] = Orm_Program_Objective::get_all(array('program_id' => $data['item_id']));
                $data['plos'] = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $data['item_id']));
                break;
        }

        self::generate_pdf($data);

    }

    /**
     * prepare the Pdf and calling the library WKHTMTOPDF
     * $data=> all data and parameters that will need in pdf
     * @param $data
     */
    public static function generate_pdf($data)
    {

        $config_array = Orm::get_ci()->config->item('wk_pdf_options');
        $config_array['zoom'] = 1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($config_array);

        $header_html = Orm::get_ci()->load->view('pdf_header', array(''), true);

        $pdf->setOptions(array(
            'margin-top' => 27,
            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line'
        ));


        self::generate_pdf_page($pdf, $data);

        $files_dir = '/files/Documents/' . self::get_attachments_directory($data['item_id']);

        $files_full_dir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_full_dir)) {
            mkdir($files_full_dir, 0777, true);
        }

        $today = date('Ymd');

        $name = '';
        switch ($data['type']) {
            case 'xmatrix':
            case 'course_assess_metric':
            case 'course_obj_assessment_metric':
                $name = Orm_Course::get_instance($data['item_id'])->get_name();
                break;

            case 'pxmatrix':
//            case 'obj_xmatrix':
            case 'ipamatrix':
            case 'obj_matrix':
            case 'assess_metric':
            case 'assessment_loop_obj':
            case 'obj_assessment_metric':
            case 'assessment_loop_pl':

                $name = Orm_Program::get_instance($data['item_id'])->get_name();
                break;

        }
        $file_title = str_replace(['&', ' ', '/', '(', ')', '-', '\\'], '_', $name);
        $file_title = str_replace(['__'], '_', $file_title);
        $file_title = str_replace(['__'], '_', $file_title);

        $full_file_name = self::get_type_name($data['type']).'-'.$file_title;

        $name = str_replace(['__'], '_', "{$full_file_name}_{$today}.pdf");
        $file_name = rtrim($files_full_dir, '/') . '/' . $name;

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
     * $params -> the html files that has the view that we need for the table
     * @param $pdf
     * @param $params
     */
    public static function generate_pdf_page($pdf, $params)
    {

        Orm::get_ci()->layout->content_as_html(true);
        Orm::get_ci()->layout->set_layout('layout_pdf');

        switch ($params['type']) {
            case 'xmatrix':
                $view = 'course_report/xmatrix/view';
                $data['data'] = $params;
                break;
            case 'pxmatrix':

                $view = 'program_report/xmatrix/view';
                $data['data'] = $params;

                break;
            case 'ipamatrix':
                $view = 'program_report/ipamatrix/view';
                $data['data'] = $params;
                break;

            case 'obj_matrix':
                $view = 'program_report/objective/view';
                $data['data'] = $params;
                break;

            case 'assess_metric':
            case 'obj_assessment_metric':
                $view = 'program_report/assessment_metric';
                $data['data'] = $params;
                $data = array('all_assessment_metric' => $data['data']['all_assessment_metric'], 'program_id' => $data['data']['program_id']);
                break;

            case 'course_assess_metric':
                $view = 'course_report/assessment_metric';
                $data['data'] = $params;
                $data = array('all_assessment_metric' => $data['data']['all_assessment_metric'], 'course_id' => $data['data']['course_id']);
                break;

            case 'assessment_loop_pl':
            case 'assessment_loop_obj':
                $view = 'program_report/assessment_loop/view';
                $data['data'] = $params;
                break;

        }

        $content = Orm::get_ci()->load->view($view, $data, true);
        $html = Orm::get_ci()->layout->view($content, array(), true);

        $pdf->addPage($html);
    }

    /**
     * get the url for the downloading file and where we can find in project or File Repo
     * @param $param
     * @return string
     */
    public static function get_attachments_directory($param)
    {

        $path = 'reports';
        $path .= '/' . $param;
        return $path;
    }

    /**
     * get the name of parts that we need to set and download depends on the type that already send on pdf data
     * @param $type => the type of part that we need to download such as  xmatrix,pxmatrix,ipamatrix,...etc
     * @return string =>name of file
     */
    public static function get_type_name($type){

        $type_name = '';
        switch ($type) {
            case 'xmatrix':
            case 'pxmatrix':
            $type_name = lang('X-Matrix');
                break;


            case 'ipamatrix':
                $type_name = lang('IPA-Matrix');

                break;

            case 'assessment_loop_pl':

            $type_name = lang('PLO Assessment Loop');
                break;
            case 'assessment_loop_obj':
                $type_name = lang('OBJ Assessment Loop');
                 break;

            case 'assess_metric':
            case 'course_assess_metric':
                $type_name = lang('Assessment Metrics');
                break;

            case 'obj_assessment_metric':
            case 'course_obj_assessment_metric':
                $type_name = lang('OBJ Assessment Metrics');
                break;

            case 'obj_matrix':
                $type_name = lang('OBJ Assessment Metrics');
                break;
        }

        return $type_name;

    }


}