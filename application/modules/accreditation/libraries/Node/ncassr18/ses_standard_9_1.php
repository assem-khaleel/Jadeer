<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_9_1
 *
 * @author ahmadgx
 */
class Ses_Standard_9_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '9.1 Recruitment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_9_1_1('');
            $this->set_9_1_2('');
            $this->set_9_1_3('');
            $this->set_9_1_4('');
            $this->set_9_1_5('');
            $this->set_9_1_6('');
            $this->set_9_1_7('');
            $this->set_9_1_8('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Recruitment processes must be designed to ensure that capable and appropriately qualified teaching and other staff are available for all teaching and administrative functions, administered fairly, and that new staff are thoroughly prepared for their responsibilities.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_9_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_1', $value);
        $property->set_description('9.1.1 Recruitment processes ensure that teaching staff have the specific areas of expertise, and the personal qualities, experience and skill to meet teaching requirements.');
        $this->set_property($property);
    }

    public function get_9_1_1()
    {
        return $this->get_property('9_1_1')->get_value();
    }

    public function set_9_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_2', $value);
        $property->set_description('9.1.2 Candidates for employment are provided with full position descriptions and conditions of employment, together with specific information about expectations for contributing to the program as part of the teaching team. (The information provided should include details of employment expectations, indicators of performance, and processes of performance evaluation.)');
        $this->set_property($property);
    }

    public function get_9_1_2()
    {
        return $this->get_property('9_1_2')->get_value();
    }

    public function set_9_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_3', $value);
        $property->set_description('9.1.3 References are checked, and claims of experience and qualifications verified before appointments are made.');
        $this->set_property($property);
    }

    public function get_9_1_3()
    {
        return $this->get_property('9_1_3')->get_value();
    }

    public function set_9_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_4', $value);
        $property->set_description('9.1.4 Assessment of qualifications includes verification of the standing and reputation of the institutions from which they were obtained, taking account of recognition of qualifications by the Ministry of Higher Education.');
        $this->set_property($property);
    }

    public function get_9_1_4()
    {
        return $this->get_property('9_1_4')->get_value();
    }

    public function set_9_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_5', $value);
        $property->set_description('9.1.5 In professional programs there are sufficient teaching staff with successful experience in the relevant profession to provide practical advice and guidance to students about work place requirements.');
        $this->set_property($property);
    }

    public function get_9_1_5()
    {
        return $this->get_property('9_1_5')->get_value();
    }

    public function set_9_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_6', $value);
        $property->set_description('9.1.6 New teaching staff are given an effective orientation to the institution to ensure familiarity with the institution and its operating procedures, services and priorities for development.');
        $this->set_property($property);
    }

    public function get_9_1_6()
    {
        return $this->get_property('9_1_6')->get_value();
    }

    public function set_9_1_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_7', $value);
        $property->set_description('9.1.7 New teaching staff are given a thorough orientation to the program to ensure they have a thorough understanding of the program as a whole, of the contributions to be made to it through the courses they teach, and of the expectations for coordinated planning and delivery of courses and evaluation and reporting requirements.');
        $this->set_property($property);
    }

    public function get_9_1_7()
    {
        return $this->get_property('9_1_7')->get_value();
    }

    public function set_9_1_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_8', $value);
        $property->set_description('9.1.8 The level of provision of teaching staff (i.e. the ratio of students per teaching staff member calculated as full time equivalents) is adequate for the program and benchmarked against comparable student/teaching staff ratios at good quality Saudi Arabian and international institutions.');
        $this->set_property($property);
    }

    public function get_9_1_8()
    {
        return $this->get_property('9_1_8')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('9_1_1');
        $property->add_property_name('9_1_2');
        $property->add_property_name('9_1_3');
        $property->add_property_name('9_1_4');
        $property->add_property_name('9_1_5');
        $property->add_property_name('9_1_6');
        $property->add_property_name('9_1_7');
        $property->add_property_name('9_1_8');
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
