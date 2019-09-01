<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_10
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_10 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 10';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_curricula('');
            $this->set_student('');
            $this->set_faculty('');
            $this->set_interactions('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>Curricula facilitate student-faculty and student-student interactions appropriate to the program type and achievement of learning goals. [STUDENT-FACULTY INTERACTIONS]</b>");
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Basis for Judgment</strong> <br/> <br/>'
            . '<ul>'
            . '<li>The level and quality of sustained, documented student-student and student-faculty interactions are consistent with the degree program type and achievement of learning goals. For any teaching/learning model employed, students have opportunities to work together on some learning tasks and learn from each other.</li>'
            . '<li>Student-faculty interactions involve all types of faculty members, particularly those faculty members who have primary responsibilities for program development, course development, course delivery, and evaluation. For any teaching/learning model employed, students have access to content experts (for instruction, dialogue, and feedback) in curricula and extracurricular situations for instruction.</li>'
            . '<li>Curricula design and documented activities support alignment with the spirit and intent of the standard.</li>'
            . '</ul>'
            . '<br/><br/><strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_curricula($value)
    {
        $property = new \Orm_Property_Textarea('curricula', $value);
        $property->set_description('Describe how curricula include opportunities for student-student and student-faculty interaction to facilitate learning across program types and delivery modes. Required and voluntary opportunities for interaction may be measured by review of syllabi, classroom observation, or other appropriate means.');
        $this->set_property($property);
    }

    public function get_curricula()
    {
        return $this->get_property('curricula')->get_value();
    }

    public function set_student($value)
    {
        $property = new \Orm_Property_Textarea('student', $value);
        $property->set_description('Summarize how student-student and student-faculty interactions are supported, encouraged, and documented across program types and delivery modes. Describe how the associated division of labor across faculty and professional staff supports these interactions. Demonstrate that students have access to relevant content and learning process expertise.');
        $this->set_property($property);
    }

    public function get_student()
    {
        return $this->get_property('student')->get_value();
    }

    public function set_faculty($value)
    {
        $property = new \Orm_Property_Textarea('faculty', $value);
        $property->set_description('Document how student-student and student-faculty interactions are assessed for impact and quality across program types and delivery modes.');
        $this->set_property($property);
    }

    public function get_faculty()
    {
        return $this->get_property('faculty')->get_value();
    }

    public function set_interactions($value)
    {
        $property = new \Orm_Property_Textarea('interactions', $value);
        $property->set_description('Provide analysis of how the interactions are aligned with mission and the degree program portfolio.');
        $this->set_property($property);
    }

    public function get_interactions()
    {
        return $this->get_property('interactions')->get_value();
    }

}
