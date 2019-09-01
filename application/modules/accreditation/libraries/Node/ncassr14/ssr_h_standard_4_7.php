<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_h_standard_4_7
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_4_7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Subsection 4.7 Support for Improvements in Quality of Teaching';
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
        $property->set_class('Node\ncassr14\Ses_Standard_4_7');
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
        $property->set_description('Provide a report that describes the strategies for the improvement of teaching.  Include a table showing staff participation in training and/or other activities designed for the improvement of teaching and other related professional development activities. The description should include processes used for investigating and dealing with situations where evidence suggests there may be problems in teaching quality, and arrangements for recognizing outstanding teaching performance.');
        $this->set_property($property);
    }

    public function get_summary_report()
    {
        return $this->get_property('summary_report')->get_value();
    }

    public function set_evaluation_report($value)
    {
        $property = new \Orm_Property_Textarea('evaluation_report', $value);
        $property->set_description('Evaluation of arrangements for supporting improvements in quality of teaching.  Refer to evidence about the effectiveness of strategies used and provide a report including a list of strengths, recommendations for improvement, and priorities for action.  This evidence could include matters, such as, trend data and analysis from student course evaluations and survey responses from staff participating in programs offered.');
        $this->set_property($property);
    }

    public function get_evaluation_report()
    {
        return $this->get_property('evaluation_report')->get_value();
    }

}
