<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of field_experience_specification_d
 *
 * @author laith
 */
class Field_Experience_Specification_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'D. Planning and Preparation';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_location(array());
            $this->set_experience_locations('');
            $this->set_staff(array());
            $this->set_staff_locations('');
            $this->set_student(array());
            $this->set_student_explanation('');
            $this->set_risk(array());
            $this->set_risk_explanation('');
            $this->set_resolution('');
    }

    /* All requier dynamic tables to add field */

    public function set_location($value)
    {
        $property = new \Orm_Property_Table_Dynamic('location', $value);
        $property->set_description('1. Identification of Field Locations');

        $required_list = new \Orm_Property_Textarea('required_list');
        $required_list->set_description('List Requirements for Field Site Locations (IT, equipment, labs, rooms, housing, learning resources, clinical)');
        $required_list->set_enable_tinymce(0);
        $required_list->set_width(230);
        $property->add_property($required_list);

        $safety_standard = new \Orm_Property_Textarea('safety_standard');
        $safety_standard->set_description('List Safety Standards');
        $safety_standard->set_enable_tinymce(0);
        $safety_standard->set_width(230);
        $property->add_property($safety_standard);

        $specialized_criteria = new \Orm_Property_Textarea('specialized_criteria');
        $specialized_criteria->set_description('List Specialized Criteria');
        $specialized_criteria->set_enable_tinymce(0);
        $specialized_criteria->set_width(230);
        $property->add_property($specialized_criteria);

        $this->set_property($property);
    }

    public function get_location()
    {
        return $this->get_property('location')->get_value();
    }

    public function set_experience_locations($value)
    {
        $property = new \Orm_Property_Textarea('experience_locations', $value);
        $property->set_description('Explain the decision-making process used to determine appropriate field experience locations.');
        $this->set_property($property);
    }

    public function get_experience_locations()
    {
        return $this->get_property('experience_locations')->get_value();
    }

    public function set_staff($value)
    {
        $property = new \Orm_Property_Table_Dynamic('staff', $value);
        $property->set_description('2. Identification of Field Staff and Supervisors');

        $qualification = new \Orm_Property_Textarea('qualification');
        $qualification->set_description('List Qualifications');
        $qualification->set_enable_tinymce(0);
        $qualification->set_width(230);
        $property->add_property($qualification);

        $responsibilities = new \Orm_Property_Textarea('responsibilities');
        $responsibilities->set_description('List Responsibilities');
        $responsibilities->set_enable_tinymce(0);
        $responsibilities->set_width(230);
        $property->add_property($responsibilities);

        $training_required = new \Orm_Property_Textarea('training_required');
        $training_required->set_description('List Training Required');
        $training_required->set_enable_tinymce(0);
        $training_required->set_width(230);
        $property->add_property($training_required);

        $this->set_property($property);
    }

    public function get_staff()
    {
        return $this->get_property('staff')->get_value();
    }

    public function set_staff_locations($value)
    {
        $property = new \Orm_Property_Textarea('staff_locations', $value);
        $property->set_description('Explain the decision-making process used to determine appropriate field staff and supervisors.');
        $this->set_property($property);
    }

    public function get_staff_locations()
    {
        return $this->get_property('staff_locations')->get_value();
    }

    public function set_student($value)
    {
        $property = new \Orm_Property_Table_Dynamic('student', $value);
        $property->set_description('3. Identification of Students');

        $requirement = new \Orm_Property_Textarea('requirement');
        $requirement->set_description('List Pre-Requisite Requirements');
        $requirement->set_enable_tinymce(0);
        $requirement->set_width(230);
        $property->add_property($requirement);

        $requirement_Testing = new \Orm_Property_Textarea('requirement_Testing');
        $requirement_Testing->set_description('List Testing Requirements');
        $requirement_Testing->set_enable_tinymce(0);
        $requirement_Testing->set_width(230);
        $property->add_property($requirement_Testing);

        $training = new \Orm_Property_Textarea('training');
        $training->set_description('List Special Training Required');
        $training->set_enable_tinymce(0);
        $training->set_width(230);
        $property->add_property($training);

        $this->set_property($property);
    }

    public function get_student()
    {
        return $this->get_property('student')->get_value();
    }

    public function set_student_explanation($value)
    {
        $property = new \Orm_Property_Textarea('student_explanation', $value);
        $property->set_description('Explain the decision-making process used to determine that a student is prepared to enroll in field experience activities.');
        $this->set_property($property);
    }

    public function get_student_explanation()
    {
        return $this->get_property('student_explanation')->get_value();
    }

    public function set_risk($value)
    {
        $property = new \Orm_Property_Table_Dynamic('risk', $value);
        $property->set_description('4. Safety and Risk Management by the Program');

        $requirement_4 = new \Orm_Property_Textarea('requirement_4');
        $requirement_4->set_description('List Insurance Requirements');
        $requirement_4->set_enable_tinymce(0);
        $requirement_4->set_width(180);
        $property->add_property($requirement_4);

        $potential_risk = new \Orm_Property_Textarea('potential_risk');
        $potential_risk->set_description('List Potential Risks');
        $potential_risk->set_enable_tinymce(0);
        $potential_risk->set_width(180);
        $property->add_property($potential_risk);

        $safety = new \Orm_Property_Textarea('safety');
        $safety->set_description('List Safety Precautions Taken');
        $safety->set_enable_tinymce(0);
        $safety->set_width(180);
        $property->add_property($safety);

        $safety_training = new \Orm_Property_Textarea('safety_training');
        $safety_training->set_description('List Safety Training Requirements');
        $safety_training->set_enable_tinymce(0);
        $safety_training->set_width(170);
        $property->add_property($safety_training);

        $this->set_property($property);
    }

    public function get_risk()
    {
        return $this->get_property('risk')->get_value();
    }

    public function set_risk_explanation($value)
    {
        $property = new \Orm_Property_Textarea('risk_explanation', $value);
        $property->set_description('Explain the decision-making process used to protect and minimize safety risks.');
        $this->set_property($property);
    }

    public function get_risk_explanation()
    {
        return $this->get_property('risk_explanation')->get_value();
    }

    public function set_resolution($value)
    {
        $property = new \Orm_Property_Textarea('resolution', $value);
        $property->set_description('5. Resolution of Differences in Assessments.  If supervising staff in the field location and faculty from the institution share responsibility for student assessment, what process is followed for resolving any differences between them?');
        $this->set_property($property);
    }

    public function get_resolution()
    {
        return $this->get_property('resolution')->get_value();
    }

}
