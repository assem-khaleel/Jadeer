<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_4_3
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_4_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Subsection 4.3 Program Evaluation and Review Processes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_rating('');
            $this->set_process('');
            $this->set_evaluation_report('');
            $this->set_process_list('');
    }

    public function set_rating($value)
    {
        $property = new \Orm_Property_Smart_Field('rating', $value);
        $property->set_class('Node\ncassr18\Ses_Standard_4_3');
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

    public function set_process($value)
    {
        $property = new \Orm_Property_Textarea('process', $value);
        $property->set_description('Describe the processes followed for program evaluation and review. ');
        $this->set_property($property);
    }

    public function get_process()
    {
        return $this->get_property('process')->get_value();
    }

    public function set_evaluation_report($value)
    {
        $property = new \Orm_Property_Textarea('evaluation_report', $value);
        $property->set_description('Evaluation of program evaluation and review processes.  Refer to evidence and provide a report including a list of strengths, areas recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_evaluation_report()
    {
        return $this->get_property('evaluation_report')->get_value();
    }

    public function set_process_list($value)
    {
        $property = new \Orm_Property_Textarea('process_list', $value);
        $property->set_description('List the conclusions that were reached about the quality of the program as a result of using the program evaluation and review processes.  Reference should be made to data on indicators and survey results as appropriate.');
        $this->set_property($property);
    }

    public function get_process_list()
    {
        return $this->get_property('process_list')->get_value();
    }

}
