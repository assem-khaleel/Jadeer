<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_etac;

/**
 * Description of criterion_3
 *
 * @author ahmadgx
 */
class Criterion_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'CRITERION 3.  STUDENT OUTCOMES';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_student_outcomes('');
            $this->set_student_ourcones_revision('');
            $this->set_student_outcome('');
            $this->set_student_outcomes_list('');
            $this->set_relationship('');
            $this->set_educational_objective('');
    }

    public function set_student_outcomes()
    {
        $property = new \Orm_Property_Fixedtext('student_outcomes', '<b>A. Process for the Establishment and Revision of the Student Outcomes</b>');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_student_outcomes()
    {
        return $this->get_property('student_outcomes')->get_value();
    }

    public function set_student_ourcones_revision($value)
    {
        $property = new \Orm_Property_Textarea('student_ourcones_revision', $value);
        $property->set_description('Describe the process used for establishing and revising student outcomes.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_student_ourcones_revision()
    {
        return $this->get_property('student_ourcones_revision')->get_value();
    }

    public function set_student_outcome()
    {
        $property = new \Orm_Property_Fixedtext('student_outcome', '<b>B. Student Outcomes</b>');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_student_outcome()
    {
        return $this->get_property('student_outcome')->get_value();
    }

    public function set_student_outcomes_list($value)
    {
        $property = new \Orm_Property_Textarea('student_outcomes_list', $value);
        $property->set_description('List the student outcomes for the program and describe their mapping to those in Criterion 3 and any applicable program criteria.  Indicate where the student outcomes are documented.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_student_outcomes_list()
    {
        return $this->get_property('student_outcomes_list')->get_value();
    }

    public function set_relationship()
    {
        $property = new \Orm_Property_Fixedtext('relationship', '<b>C. Relationship of Student Outcomes to Program Educational Objectives</b>');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_relationship()
    {
        return $this->get_property('relationship')->get_value();
    }

    public function set_educational_objective($value)
    {
        $property = new \Orm_Property_Textarea('educational_objective', $value);
        $property->set_description('Describe how the student outcomes prepare graduates to attain the program educational objectives');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_educational_objective()
    {
        return $this->get_property('educational_objective')->get_value();
    }

}
