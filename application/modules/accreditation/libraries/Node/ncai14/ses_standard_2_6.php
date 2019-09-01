<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_2_6
 *
 * @author user
 */
class Ses_Standard_2_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.6 Internal Policies and Regulations';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_2_6_1('');
            $this->set_2_6_2('');
            $this->set_2_6_3('');
            $this->set_2_6_4('');
            $this->set_2_6_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The institution must have a comprehensive and widely accessible set of policies and regulations establishing the terms of reference and operating procedures for major committees, administrative units and positions within the institution.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_6_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_6_1', $value);
        $property->set_description(' 2.6.1 A policy and procedures manual has been prepared setting out internal regulations and procedures for dealing with major areas of activity within the institution.');
        $this->set_property($property);
    }

    public function get_2_6_1()
    {
        return $this->get_property('2_6_1')->get_value();
    }

    public function set_2_6_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_6_2', $value);
        $property->set_description('2.6.2 Terms of reference or statements of responsibility have been specified for major committees and administrative and academic positions and included in the policy and procedures manual.');
        $this->set_property($property);
    }

    public function get_2_6_2()
    {
        return $this->get_property('2_6_2')->get_value();
    }

    public function set_2_6_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_6_3', $value);
        $property->set_description('2.6.3 Policies and regulations are accessible to teaching and other staff and students including new members of staff, and members of committees, and effective strategies used to ensure they are understood and complied with.');
        $this->set_property($property);
    }

    public function get_2_6_3()
    {
        return $this->get_property('2_6_3')->get_value();
    }

    public function set_2_6_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_6_4', $value);
        $property->set_description('2.6.4 Student responsibilities, codes of conduct, and regulations affecting their behaviour are defined and made known to students when they begin studies at the institution.');
        $this->set_property($property);
    }

    public function get_2_6_4()
    {
        return $this->get_property('2_6_4')->get_value();
    }

    public function set_2_6_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_6_5', $value);
        $property->set_description('2.6.5 The institution has a program for the periodic review and amendment of all its policies and regulations over specified time periods.');
        $this->set_property($property);
    }

    public function get_2_6_5()
    {
        return $this->get_property('2_6_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('2_6_1');
        $property->add_property_name('2_6_2');
        $property->add_property_name('2_6_3');
        $property->add_property_name('2_6_4');
        $property->add_property_name('2_6_5');

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
