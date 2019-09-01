<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_4_6
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_4_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Subsection 4.6 Quality of Teaching';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_rating('');
            $this->set_information('');
            $this->set_evaluation_report('');
    }

    public function set_rating($value)
    {
        $property = new \Orm_Property_Smart_Field('rating', $value);
        $property->set_class('Node\ncassr18\Ses_Standard_4_6');
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

    public function set_information($value)
    {
        $property = new \Orm_Property_Textarea('information', $value);
        $property->set_description('Provide information about the planning of teaching strategies to develop the intended learning outcomes of the program, for evaluating quality of teaching, and processes for preparation and consideration of course and program reports. This section should include a table indicating the proportion of teaching staff whose teaching is regularly assessed in student surveys (or by other mechanisms).');
        $this->set_property($property);
    }

    public function get_information()
    {
        return $this->get_property('information')->get_value();
    }

    public function set_evaluation_report($value)
    {
        $property = new \Orm_Property_Textarea('evaluation_report', $value);
        $property->set_description('Evaluation of quality of teaching.  Refer to evidence about teaching quality and provide a report including a list of strengths, recommendations for improvement, and priorities for action.  The report should include a summary of data from student surveys used for course and overall program evaluations, with information provided about sample size and response rates on those surveys. Comparative data from other similar surveys should be included.');
        $this->set_property($property);
    }

    public function get_evaluation_report()
    {
        return $this->get_property('evaluation_report')->get_value();
    }

}
