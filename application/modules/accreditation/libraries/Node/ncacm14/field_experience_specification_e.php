<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of field_experience_specification_e
 *
 * @author laith
 */
class Field_Experience_Specification_E extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'E. Evaluation of the Field Experience';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_student_eval('');
            $this->set_student_rec('');
            $this->set_staff_eval('');
            $this->set_staff_rec('');
            $this->set_faculty_eval('');
            $this->set_faculty_rec('');
            $this->set_others_eval('');
            $this->set_others_rec('');
            $this->set_action_plan(array());
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>1. Describe the evaluation process and list recommendations for improvement of field experience activities by:</strong>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_student_eval($value)
    {
        $property = new \Orm_Property_Textarea('student_eval', $value);
        $property->set_description('a. Students: Describe evaluation process');
        $this->set_property($property);
    }

    public function get_student_eval()
    {
        return $this->get_property('student_eval')->get_value();
    }

    public function set_student_rec($value)
    {
        $property = new \Orm_Property_Textarea('student_rec', $value);
        $property->set_description('List recommendations for improvement');
        $this->set_property($property);
    }

    public function get_student_rec()
    {
        return $this->get_property('student_rec')->get_value();
    }

    public function set_staff_eval($value)
    {
        $property = new \Orm_Property_Textarea('staff_eval', $value);
        $property->set_description('b. Supervising staff in the field setting: Describe evaluation process');
        $this->set_property($property);
    }

    public function get_staff_eval()
    {
        return $this->get_property('staff_eval')->get_value();
    }

    public function set_staff_rec($value)
    {
        $property = new \Orm_Property_Textarea('staff_rec', $value);
        $property->set_description('List recommendations for improvement');
        $this->set_property($property);
    }

    public function get_staff_rec()
    {
        return $this->get_property('staff_rec')->get_value();
    }

    public function set_faculty_eval($value)
    {
        $property = new \Orm_Property_Textarea('faculty_eval', $value);
        $property->set_description('c. Supervising faculty from the institution: Describe evaluation process');
        $this->set_property($property);
    }

    public function get_faculty_eval()
    {
        return $this->get_property('faculty_eval')->get_value();
    }

    public function set_faculty_rec($value)
    {
        $property = new \Orm_Property_Textarea('faculty_rec', $value);
        $property->set_description('List recommendations for improvement');
        $this->set_property($property);
    }

    public function get_faculty_rec()
    {
        return $this->get_property('faculty_rec')->get_value();
    }

    public function set_others_eval($value)
    {
        $property = new \Orm_Property_Textarea('others_eval', $value);
        $property->set_description('d. Others—(e.g. graduates, independent evaluator, etc.): Describe evaluation process');
        $this->set_property($property);
    }

    public function get_others_eval()
    {
        return $this->get_property('others_eval')->get_value();
    }

    public function set_others_rec($value)
    {
        $property = new \Orm_Property_Textarea('others_rec', $value);
        $property->set_description('List recommendations for improvement');
        $this->set_property($property);
    }

    public function get_others_rec()
    {
        return $this->get_property('others_rec')->get_value();
    }

    public function set_action_plan($value)
    {
        $property = new \Orm_Property_Table_Dynamic('action_plan', $value);
        $property->set_description('2. Action Plan for Improvement for Next Semester/Year');

        $action_recommendation = new \Orm_Property_Textarea('action_recommendation');
        $action_recommendation->set_description('Actions Recommended');
        $action_recommendation->set_enable_tinymce(0);
        $action_recommendation->set_width(170);
        $property->add_property($action_recommendation);

        $action_points = new \Orm_Property_Textarea('action_points');
        $action_points->set_description('Intended Action Points (should be measurable)');
        $action_points->set_enable_tinymce(0);
        $action_points->set_width(170);
        $property->add_property($action_points);

        $start_date = new \Orm_Property_Text('start_date');
        $start_date->set_description('Start Date');
        $start_date->set_width(100);
        $property->add_property($start_date);

        $completion_date = new \Orm_Property_Text('completion_date');
        $completion_date->set_description('Completion Date');
        $completion_date->set_width(100);
        $property->add_property($completion_date);

        $Person = new \Orm_Property_Text('Person');
        $Person->set_description('Person Responsible');
        $Person->set_width(150);
        $property->add_property($Person);
        $this->set_property($property);
    }

    public function get_action_plan()
    {
        return $this->get_property('action_plan')->get_value();
    }

}
