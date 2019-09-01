<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_2_1
 *
 * @author ahmadgx
 */
class Ses_Standard_2_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.1 Leadership';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_2_1_1('');
            $this->set_2_1_2('');
            $this->set_2_1_3('');
            $this->set_2_1_4('');
            $this->set_2_1_5('');
            $this->set_2_1_6('');
            $this->set_2_1_7('');
            $this->set_2_1_8('');
            $this->set_2_1_9('');
            $this->set_2_1_10('');
            $this->set_2_1_11('');
            $this->set_2_1_12('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Program administrators must provide effective and responsible leadership for the development and improvement of the program.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_1', $value);
        $property->set_description('2.1.1 The responsibilities of program administrators are clearly defined in position descriptions');
        $this->set_property($property);
    }

    public function get_2_1_1()
    {
        return $this->get_property('2_1_1')->get_value();
    }

    public function set_2_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_2', $value);
        $property->set_description('2.1.2 There is sufficient flexibility at the level of the department or college offering the program to respond rapidly to course and program evaluations and changes in program learning outcome requirements,(eg. Departments should have delegated authority to change text and reference lists, modify planned teaching strategies, details of assessment tasks and updating of course content as far as possible subject to conditions set by the university council or other responsible authority.)');
        $this->set_property($property);
    }

    public function get_2_1_2()
    {
        return $this->get_property('2_1_2')->get_value();
    }

    public function set_2_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_3', $value);
        $property->set_description('2.1.3 Program administrators anticipate issues and opportunities and exercise initiative in response.');
        $this->set_property($property);
    }

    public function get_2_1_3()
    {
        return $this->get_property('2_1_3')->get_value();
    }

    public function set_2_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_4', $value);
        $property->set_description('2.1.4 Program administrators ensure that when action is needed it is taken in an effective and timely manner.');
        $this->set_property($property);
    }

    public function get_2_1_4()
    {
        return $this->get_property('2_1_4')->get_value();
    }

    public function set_2_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_5', $value);
        $property->set_description('2.1.5 Program administrators have sufficient authority to ensure compliance with formally established or agreed institutional or program policies and procedures.');
        $this->set_property($property);
    }

    public function get_2_1_5()
    {
        return $this->get_property('2_1_5')->get_value();
    }

    public function set_2_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_6', $value);
        $property->set_description('2.1.6 Program administrators provide leadership, and encourage and reward  initiative on the part of teaching and other staff.');
        $this->set_property($property);
    }

    public function get_2_1_6()
    {
        return $this->get_property('2_1_6')->get_value();
    }

    public function set_2_1_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_7', $value);
        $property->set_description('2.1.7 Program managers accept responsibility for the effectiveness of action taken within their area of responsibility regardless of whether that action is taken by them personally or by others responsible to them.');
        $this->set_property($property);
    }

    public function get_2_1_7()
    {
        return $this->get_property('2_1_7')->get_value();
    }

    public function set_2_1_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_8', $value);
        $property->set_description('2.1.8 Regular feedback is given on performance of  teaching and other staff  by the head of the department');
        $this->set_property($property);
    }

    public function get_2_1_8()
    {
        return $this->get_property('2_1_8')->get_value();
    }

    public function set_2_1_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_9', $value);
        $property->set_description('2.1.9 Delegations of responsibility to program administrators are formally specified in documents signed by the person delegating and the person given delegated authority, that describe clearly the limits of delegated responsibility and responsibility for reporting on decisions made.');
        $this->set_property($property);
    }

    public function get_2_1_9()
    {
        return $this->get_property('2_1_9')->get_value();
    }

    public function set_2_1_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_10', $value);
        $property->set_description('2.1.10 Regulations governing delegations of authority are established for the institution and approved by the governing board. These regulations indicate key functions that cannot be delegated, and specify that delegation of authority to another person or organization does not remove responsibility for consequences of decisions made from the person giving the delegation.');
        $this->set_property($property);
    }

    public function get_2_1_10()
    {
        return $this->get_property('2_1_10')->get_value();
    }

    public function set_2_1_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_11', $value);
        $property->set_description('2.1.11 Advice and support are made available to faculty and staff  in a manner that contributes to their personal and  professional development');
        $this->set_property($property);
    }

    public function get_2_1_11()
    {
        return $this->get_property('2_1_11')->get_value();
    }

    public function set_2_1_12($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_12', $value);
        $property->set_description('2.1.12 Proposals for program developments and recommendations on policy issues are presented to the appropriate decision making body in a form that clearly identifies the issues for decision and the consequences of alternatives.');
        $this->set_property($property);
    }

    public function get_2_1_12()
    {
        return $this->get_property('2_1_12')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('2_1_1');
        $property->add_property_name('2_1_2');
        $property->add_property_name('2_1_3');
        $property->add_property_name('2_1_4');
        $property->add_property_name('2_1_5');
        $property->add_property_name('2_1_6');
        $property->add_property_name('2_1_7');
        $property->add_property_name('2_1_8');
        $property->add_property_name('2_1_9');
        $property->add_property_name('2_1_10');
        $property->add_property_name('2_1_11');
        $property->add_property_name('2_1_12');
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
