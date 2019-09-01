<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_d
 *
 * @author duaa
 */
class Ssr_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'D. Program Faculty Profile Template B: College Data';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

        $this->set_college('');
        $this->set_department('');
        $this->set_program('');
        $this->set_template_b(array());
        $this->set_strength('');
        $this->set_recommendation('');
        $this->set_predictions('');
        $this->set_interventions('');
        $this->set_action('');
        $this->set_note();
    }

    public function set_college($value)
    {
        $property = new \Orm_Property_Text('college', $value);
        $property->set_description('College:');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
    }

    public function set_department($value)
    {
        $property = new \Orm_Property_Text('department', $value);
        $property->set_description('Department:');
        $this->set_property($property);
    }

    public function get_department()
    {
        return $this->get_property('department')->get_value();
    }

    public function set_program($value)
    {
        $property = new \Orm_Property_Text('program', $value);
        $property->set_description('Program:');
        $this->set_property($property);
    }

    public function get_program()
    {
        return $this->get_property('program')->get_value();
    }


    public function set_template_b($value)
    {
        $property = new \Orm_Property_Table_Dynamic('template_b', $value);
        $property->set_is_responsive(true);

        $teaching_staff_name = new \Orm_Property_Text('teaching_staff_name');
        $teaching_staff_name->set_description('Faculty / Teaching Staff Name');
        $teaching_staff_name->set_width(100);
        $property->add_property($teaching_staff_name);

        $gender = new \Orm_Property_Radio('gender');
        $gender->set_description('Gender');
        $gender->set_options(array('M', "F"));
        $gender->set_width(50);
        $property->add_property($gender);

        $nationality = new \Orm_Property_Text('nationality');
        $nationality->set_description('Nationality');
        $nationality->set_width(60);


        $academic_rank = new \Orm_Property_Text('academic_rank');
        $academic_rank->set_description('Academic Rank');
        $academic_rank->set_width(60);
        $property->add_property($academic_rank);

        $general_specialty = new \Orm_Property_Text('general_specialty');
        $general_specialty->set_description('General Specialty');
        $general_specialty->set_width(60);
        $property->add_property($general_specialty);

        $specific_specialty = new \Orm_Property_Text('specific_specialty');
        $specific_specialty->set_description('Specific Specialty');
        $specific_specialty->set_width(60);
        $property->add_property($specific_specialty);

        $graduated_From = new \Orm_Property_Text('graduated_From');
        $graduated_From->set_description('Institution Graduated From');
        $graduated_From->set_width(60);
        $property->add_property($graduated_From);

        $highest_degree = new \Orm_Property_Text('highest_degree');
        $highest_degree->set_description('Degree');
        $highest_degree->set_width(60);
        $property->add_property($highest_degree);

        $study_mode = new \Orm_Property_Text('study_mode');
        $study_mode->set_description('*Study Mode');
        $study_mode->set_width(60);
        $property->add_property($study_mode);

        $course_list = new \Orm_Property_Textarea('course_list');
        $course_list->set_description('List of Courses Taught This Academic Year');
        $course_list->set_width(60);
        $course_list->set_enable_tinymce(0);
        $property->add_property($course_list);

        $full_part_time = new \Orm_Property_Radio("full_part_time");
        $full_part_time->set_description('Full or Part Time');
        $full_part_time->set_options(array("FT", 'PT'));
        $full_part_time->set_width(50);
        $property->add_property($full_part_time);

        $this->set_property($property);
    }

    public function get_template_b()
    {
        return $this->get_property('template_b')->get_value();
    }

    public function set_strength($value){

        $property = new \Orm_Property_Textarea('strength',$value);
        $property->set_description('Strengths');
        $this->set_property($property);

    }
    public function get_strength(){
        return $this->get_property('strength')->get_value();
    }

    public function set_recommendation($value){

        $property = new \Orm_Property_Textarea('recommendation',$value);
        $property->set_description('Recommendations for Improvement');
        $this->set_property($property);

    }
    public function get_recommendation(){
        return $this->get_property('recommendation')->get_value();
    }

    public function set_predictions($value){

        $property = new \Orm_Property_Textarea('predictions',$value);
        $property->set_description('Predictions');
        $this->set_property($property);

    }
    public function get_predictions(){
        return $this->get_property('predictions')->get_value();
    }

    public function set_interventions($value){

        $property = new \Orm_Property_Textarea('interventions',$value);
        $property->set_description('Interventions');
        $this->set_property($property);

    }
    public function get_interventions(){
        return $this->get_property('interventions')->get_value();
    }

    public function set_action($value){

        $property = new \Orm_Property_Textarea('action',$value);
        $property->set_description('Action Plans');
        $this->set_property($property);

    }
    public function get_action(){
        return $this->get_property('action')->get_value();
    }

    public function set_note(){
        $property = new \Orm_Property_Fixedtext('note','<strong>*(On Campus Programs, Distance Learning)<br/>Note: </strong>The number of faculty and teaching academic staff should include:'
        .'<ul>'
        .'<li>Faculty:  Assistant, Associate and Full Professors whether involved with teaching, research or both teaching and research</li>'
        .'<li>Teaching staff:  Lectures, Teaching Assistants, Practical Preceptors</li>'
        .'<li>The number should not include Technicians and Laboratory Assistants.</li>'
        .'</ul>'
        );
        $this->set_property($property);
    }

    public function get_note(){
        return $this->get_property('note')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            /** @var \Orm_Program $program_obj */
            $program_obj = $program_node->get_item_obj();
            $department_obj = $program_obj->get_department_obj();
            $this->set_college($department_obj->get_college_obj()->get_name('english'));
            $this->set_department( $department_obj->get_name('english'));
            $this->set_program($program_obj->get_name('english'));
        }
    }


}
