<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Am_Assessment_Metric_Clo extends Orm_Am_Assessment_Metric {

    protected $item_class = __CLASS__;

    /**
     * Orm_Am_Assessment_Metric_Clo constructor.
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
        $extra_data = $this->get_ci()->input->get_post('extra_data');

        $learning_domain = (isset($extra_data['learning_domain']) ? $extra_data['learning_domain'] : null);

        if(is_null($learning_domain)) {
            $learning_domain = $this->get_item_from_extra_data('learning_domain');
        }

        if(is_null($learning_domain)) {
            $learning_domain = -1;
        }


        $program_learning_outcome = (isset($extra_data['program_learning_outcome']) ? $extra_data['program_learning_outcome'] : null);

        if(is_null($program_learning_outcome)) {
            $program_learning_outcome = $this->get_item_from_extra_data('program_learning_outcome');
        }

        if(is_null($program_learning_outcome)) {
            $program_learning_outcome = -1;
        }


        switch($this->get_ci()->input->get_post('filter_type')) {
            case 'plo':
                echo '<option value="-1">'.lang('Select One').'</option>';
                foreach(Orm_Cm_Program_Learning_Outcome::get_all(['program_id' => $this->get_ci()->input->post('program_id'), 'learning_domain_id'=>$learning_domain]) as $plo) {
                    $selected = (!is_null($this->get_item_from_extra_data('program_learning_outcome')) && $plo->get_id() == $this->get_item_from_extra_data('program_learning_outcome')) ? 'selected="selected"' : '';

                    echo "<option value='".$plo->get_id()."' ".$selected.'>'.$plo->get_code().' - '.$plo->get_text() .'</option>';
                }
                return;

            case 'course':
                echo '<option value="-1">'.lang('Select One').'</option>';


                $courses = Orm_Cm_Course_Learning_Outcome::get_model()
                    ->get_all([
                        'learning_domain_id'=>$learning_domain,
                        'program_learning_outcome_id'=>$program_learning_outcome
                    ], 0, 10, [], Orm::FETCH_ARRAY);

                $courses = array_column($courses, 'course_id');
                $courses = array_unique($courses);
                if(count($courses)) {
                    foreach (Orm_Course::get_all(['in_id' => $courses]) as $course) {
                        $selected = (!is_null($this->get_item_from_extra_data('course')) && $course->get_id() == $this->get_item_from_extra_data('course')) ? 'selected="selected"' : '';

                        echo '<option value="' . $course->get_id() . '" ' . $selected . '>' . $course->get_name() . '</option>';
                    }
                }
                return;
        }


        echo Orm::get_ci()->load->view('types/clo/properties', array('assessment_metric' => $this), true);
    }

    /**
     * this function ajax
     * @return string|void html the call function
     */
    public function ajax() {
        echo Orm::get_ci()->load->view('types/clo/ajax', array('assessment_metric' => $this), true);
    }
    /**
     * this function get item title
     * @return string the call function
     */
    public function get_item_title() {
        $obj = Orm_Cm_Course_Learning_Outcome::get_instance($this->get_item_id());
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

        $clo = Orm_Cm_Course_Learning_Outcome::get_instance($this->get_item_id());

        $data = array(
            'learning_domain' => $clo->get_learning_domain_id(),
            'program_learning_outcome_id' => $clo->get_program_learning_outcome_id(),
            'course_id' => $clo->get_course_id()
        );

        $this->set_extra_data($data);
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
            'margin-top' => 30,
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

        $name =  'Assessment Metric (Course Learning Outcome #'.Orm_Cm_Course_Learning_Outcome::get_instance($this->get_item_id())->get_code().').pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    /**
     * @param $pdf
     * @param $all_component
     */
    public function generate_pdf_page($pdf, $all_component) {

        Orm::get_ci()->layout->set_layout('layout_pdf');

        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_metric/view_simple', array('assessment_metric' => $this,'all_component' => $all_component), true);
        $pdf->addPage($content);
    }


}

