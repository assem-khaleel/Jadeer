<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_13
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_13 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 13';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_curricula('');
            $this->set_learning_activities('');
            $this->set_academic('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>Curricula facilitate student academic and professional engagement appropriate to the degree program type and learning goals. [STUDENT ACADEMIC AND PROFESSIONAL ENGAGEMENT]</b>");
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Definitions</strong>'
            . '<ul>'
            . '<li>Student academic and professional engagement occurs when students are actively involved in their educational experiences, in both academic and professional settings, and when they are able to connect these experiences in meaningful ways.</li>'
            . '</ul>'
            . '<br/> <br/><strong>Basis for Judgment</strong>'
            . '<ul>'
            . '<li>For any teaching and learning model employed, students give the appropriate attention and dedication to the learning materials and maintain their engagement with these materials even when challenged by difficult learning activities.</li>'
            . '<li>For any teaching and learning model employed, degree program curricula include approaches that actively engage students in learning. Many pedagogical approaches are suitable for challenging students in this way—problem-based learning, projects, simulations, etc.</li>'
            . '<li>For any teaching and learning model employed, the school provides a portfolio of experiential learning opportunities for business students, through either formal coursework or extracurricular activities, which allow them to engage with faculty and active business leaders. These experiential learning activities provide exposure to business and management in both local and global contexts.</li>'
            . '<li>While all curricula should facilitate both academic and professional engagement, the amount and balance depend on a variety of factors, including degree program type, expected outcomes, and experience levels of incoming students.</li>'
            . '<li>Students are able to connect their academic and professional experiences in meaningful ways consistent with the degree program type and learning goals.</li>'
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
        $property->set_description('Document curricula approaches that actively engage students in academic learning across program types and teaching/learning models employed. The outcomes of the learning process in the form of projects, papers, presentations, examination performances, and other demonstrations of learning should show clear evidence of significant active student engagement in learning.');
        $this->set_property($property);
    }

    public function get_curricula()
    {
        return $this->get_property('curricula')->get_value();
    }

    public function set_learning_activities($value)
    {
        $property = new \Orm_Property_Textarea('learning_activities', $value);
        $property->set_description('Document experiential learning activities that provide business students with knowledge of and experience in the local and global practice of business and management across program types and teaching/learning models employed. These experiential learning activities may include field trips, internships, consulting projects, field research, interdisciplinary projects, extracurricular activities, etc.');
        $this->set_property($property);
    }

    public function get_learning_activities()
    {
        return $this->get_property('learning_activities')->get_value();
    }

    public function set_academic($value)
    {
        $property = new \Orm_Property_Textarea('academic', $value);
        $property->set_description('Demonstrate that approaches to academic and professional engagement are sufficient for and consistent with the degree program type and learning goals.');
        $this->set_property($property);
    }

    public function get_academic()
    {
        return $this->get_property('academic')->get_value();
    }

}
