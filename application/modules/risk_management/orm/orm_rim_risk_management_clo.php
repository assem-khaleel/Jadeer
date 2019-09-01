<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rim_Risk_Management_Clo extends Orm_Rim_Risk_Management {

    protected $type = __CLASS__;

    public function __construct(){
        parent::__construct();

        Modules::load('curriculum_mapping');
    }

     /** draw propriteies for this type(clo management)
     */
    public function draw_properties() {

        $learning_domain = $this->get_ci()->input->get_post('learning_domain');

        $program_learning_outcome = (isset($learning_domain['program_learning_outcome']) ? $learning_domain['program_learning_outcome'] : null);


        switch($this->get_ci()->input->get_post('filter_type')) {
            case 'plo':
                echo '<option value="-1">'.lang('Select One').'</option>';
                foreach(Orm_Cm_Program_Learning_Outcome::get_all(['program_id' => $this->get_ci()->input->post('program_id'), 'learning_domain_id'=>$learning_domain]) as $plo) {
                    $selected = ( $plo->get_id()) ? 'selected="selected"' : '';

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
                        $selected = ($course->get_id()) ? 'selected="selected"' : '';

                        echo '<option value="' . $course->get_id() . '" ' . $selected . '>' . $course->get_name() . '</option>';
                    }
                }
                return;
        }


        echo Orm::get_ci()->load->view('types/clo/properties', array('risk_management' => $this), true);
    }
    /** ajax for this specific type to render it as ajax
     */
    public function ajax() {
        echo Orm::get_ci()->load->view('types/clo/ajax', array('risk_management' => $this), true);
    }
    /** get title of this clo type
     */
    public function get_type_title() {
        $obj = Orm_Cm_Course_Learning_Outcome::get_instance($this->get_type_id());
        return $obj->get_id() ? $obj->get_text() : lang('Source Deleted');
    }
    /** draw pdf file and get title of it
     */
    public function draw($pdf=false) {

        return htmlfilter($this->get_type_title());
    }



}

