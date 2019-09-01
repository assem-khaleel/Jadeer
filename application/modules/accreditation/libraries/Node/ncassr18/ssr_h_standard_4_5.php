<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_4_5
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_4_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Subsection 4.5 Educational Assistance for Students';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_rating('');
            $this->set_summary_report('');
            $this->set_evaluation_report('');
    }

    public function set_rating($value)
    {
        $property = new \Orm_Property_Smart_Field('rating', $value);
        $property->set_class('Node\ncassr18\Ses_Standard_4_5');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('Overall Rating');
        $this->set_property($property);
    }

    public function get_rating()
    {
        return $this->get_property('rating')->get_value();
    }

    public function set_summary_report($value)
    {
        $property = new \Orm_Property_Textarea('summary_report', $value);
        $property->set_description('Provide a summary report of what assistance is provided in relation to the matters listed in this sub-standard (e.g. orientation programs, office hours, identification and assistance for students in need, referrals to support services etc.).');
        $this->set_property($property);
    }

    public function get_summary_report()
    {
        return $this->get_property('summary_report')->get_value();
    }

    public function set_evaluation_report($value)
    {
        $property = new \Orm_Property_Textarea('evaluation_report', $value);
        $property->set_description('Provide an evaluation report of processes for educational assistance for students.  Refer to evidence about the appropriateness and effectiveness of processes for assistance of students in this program (e.g. Is the assistance what is needed for these students, is it actually provided as planned, and how is it evaluated by students?).  The report should include a list of strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_evaluation_report()
    {
        return $this->get_property('evaluation_report')->get_value();
    }

}
