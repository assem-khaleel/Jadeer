<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_3_2
 *
 * @author ahmadgx
 */
class Ses_Standard_3_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.2 Scope of Quality Assurance Processes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_3_2_1('');
            $this->set_3_2_2('');
            $this->set_3_2_3('');
            $this->set_3_2_4('');
            $this->set_3_2_5('');
            $this->set_3_2_6('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Quality assurance activities that are necessary to ensure good quality must apply to all aspects of program planning and delivery including provision of related services, and to all teaching and other staff involved in those processes.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_3_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_1', $value);
        $property->set_description('3.2.1 Quality evaluations deal with all aspects of program planning and delivery including student learning outcomes and facilities and services to support that learning whether they are managed by administrators of the program or by others based elsewhere in the institution.');
        $this->set_property($property);
    }

    public function get_3_2_1()
    {
        return $this->get_property('3_2_1')->get_value();
    }

    public function set_3_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_2', $value);
        $property->set_description('3.2.2 Quality evaluations and reports provide an overview of performance for the total program as a whole as well as components within it, including all courses and both sections if the program is offered in male and female sections');
        $this->set_property($property);
    }

    public function get_3_2_2()
    {
        return $this->get_property('3_2_2')->get_value();
    }

    public function set_3_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_3', $value);
        $property->set_description('3.2.3 Evaluations consider inputs, processes, outcomes and processes, with particular attention to learning outcomes for students.');
        $this->set_property($property);
    }

    public function get_3_2_3()
    {
        return $this->get_property('3_2_3')->get_value();
    }

    public function set_3_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_4', $value);
        $property->set_description('3.2.4 Evaluations include both routine activities and strategic priorities for improvement.');
        $this->set_property($property);
    }

    public function get_3_2_4()
    {
        return $this->get_property('3_2_4')->get_value();
    }

    public function set_3_2_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_5', $value);
        $property->set_description('3.2.5 Processes are designed to ensure both that acceptable standards are met, and that there is continuing improvement in performance.');
        $this->set_property($property);
    }

    public function get_3_2_5()
    {
        return $this->get_property('3_2_5')->get_value();
    }

    public function set_3_2_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_6', $value);
        $property->set_description('3.2.6 In sections for male and female students detailed evaluations in relation to all standards are carried out in a consistent way in both sections and quality reports on those  standards report on any significant differences found and make appropriate recommendations  for action in response');
        $this->set_property($property);
    }

    public function get_3_2_6()
    {
        return $this->get_property('3_2_6')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('3_2_1');
        $property->add_property_name('3_2_2');
        $property->add_property_name('3_2_3');
        $property->add_property_name('3_2_4');
        $property->add_property_name('3_2_5');
        $property->add_property_name('3_2_6');
        $this->set_property($property);
    }

    public function get_overall_assessment()
    {
        return $this->get_property('overall_assessment')->get_value();
    }

    public function set_comment($value)
    {
        $property = new \Orm_Property_Textarea('comment', $value);
        $property->set_description('Comment');
        $this->set_property($property);
    }

    public function get_comment()
    {
        return $this->get_property('comment')->get_value();
    }

    public function set_priorities_for_improvement($value)
    {
        $property = new \Orm_Property_Textarea('priorities_for_improvement', $value);
        $property->set_description('Priorities For Improvement');
        $this->set_property($property);
    }

    public function get_priorities_for_improvement()
    {
        return $this->get_property('priorities_for_improvement')->get_value();
    }

    public function set_independent_opinion($value)
    {
        $property = new \Orm_Property_Rank('independent_opinion', $value);
        $property->set_description('Independent Opinion');
        $this->set_property($property, true);
    }

    public function get_independent_opinion()
    {
        return $this->get_property('independent_opinion')->get_value();
    }

    public function set_independent_opinion_comment($value)
    {
        $property = new \Orm_Property_Textarea('independent_opinion_comment', $value);
        $property->set_description('Comment');
        $this->set_property($property, true);
    }

    public function get_independent_opinion_comment()
    {
        return $this->get_property('independent_opinion_comment')->get_value();
    }

}
