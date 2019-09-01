<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_9_4
 *
 * @author user
 */
class Ses_Standard_9_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '9.4 Discipline, Complaints and Dispute Resolution';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_9_4_1('');
            $this->set_9_4_2('');
            $this->set_9_4_3('');
            $this->set_9_4_4('');
            $this->set_9_4_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Procedures for management of disputes must be efficient and fair to all parties involved</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_9_4_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_4_1', $value);
        $property->set_description('9.4.1 Procedures for dealing with complaints about or by teaching or other staff, and resolving disputes among them, are clearly specified in policies and regulations.');
        $this->set_property($property);
    }

    public function get_9_4_1()
    {
        return $this->get_property('9_4_1')->get_value();
    }

    public function set_9_4_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_4_2', $value);
        $property->set_description('9.4.2 The normal initial step in resolving disputes that cannot be settled by those directly involved is through conciliation by a person independent of the issue, with the possibility if required for referral to a committee or senior officer for determination.');
        $this->set_property($property);
    }

    public function get_9_4_2()
    {
        return $this->get_property('9_4_2')->get_value();
    }

    public function set_9_4_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_4_3', $value);
        $property->set_description('9.4.3 Disciplinary processes for neglect of responsibilities, failure to comply with instructions, or inappropriate behavior, are clearly specified in regulations and consistently followed.');
        $this->set_property($property);
    }

    public function get_9_4_3()
    {
        return $this->get_property('9_4_3')->get_value();
    }

    public function set_9_4_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_4_4', $value);
        $property->set_description('9.4.4 The regulations provide for rights of appeal against decisions to a person or committee at least one level beyond that at which the dispute occurs.');
        $this->set_property($property);
    }

    public function get_9_4_4()
    {
        return $this->get_property('9_4_4')->get_value();
    }

    public function set_9_4_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_4_5', $value);
        $property->set_description('9.4.5 Serious disputes are addressed through quasi-judicial processes including provision and verification of evidence and impartial judgments by a person or persons experienced in such procedures.');
        $this->set_property($property);
    }

    public function get_9_4_5()
    {
        return $this->get_property('9_4_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('9_4_1');
        $property->add_property_name('9_4_2');
        $property->add_property_name('9_4_3');
        $property->add_property_name('9_4_4');
        $property->add_property_name('9_4_5');
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
