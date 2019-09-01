<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ses_standard_5_6
 *
 * @author user
 */
class Ses_Standard_5_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.6 Extra-curricular Activities for Students';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_5_6_1('');
            $this->set_5_6_2('');
            $this->set_5_6_3('');
            $this->set_5_6_4('');
            $this->set_5_6_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Adequate provision must be made for extra curricula activities for students<br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_5_6_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_6_1', $value);
        $property->set_description('5.6.1 Opportunities are provided for participation in religious observances consistent with Islamic beliefs and traditions.');
        $this->set_property($property);
    }

    public function get_5_6_1()
    {
        return $this->get_property('5_6_1')->get_value();
    }

    public function set_5_6_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_6_2', $value);
        $property->set_description('5.6.2 Arrangements are made to organize and encourage student participation in cultural activities such as clubs and societies and in the arts and other fields appropriate to their interests and needs.');
        $this->set_property($property);
    }

    public function get_5_6_2()
    {
        return $this->get_property('5_6_2')->get_value();
    }

    public function set_5_6_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_6_3', $value);
        $property->set_description('5.6.3 Opportunities are provided through appropriate facilities and organizational arrangements for informal social interaction among students.');
        $this->set_property($property);
    }

    public function get_5_6_3()
    {
        return $this->get_property('5_6_3')->get_value();
    }

    public function set_5_6_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_6_4', $value);
        $property->set_description('5.6.4 Participation in sports is encouraged, both for skilled athletes and for others, and appropriate competitive and non-competitive physical activities in which they can be involved are arranged.');
        $this->set_property($property);
    }

    public function get_5_6_4()
    {
        return $this->get_property('5_6_4')->get_value();
    }

    public function set_5_6_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_6_5', $value);
        $property->set_description('5.6.5 The extent of student participation in extra-curricular activities is monitored and benchmarked against other comparable institutions, and where necessary strategies developed to improve levels of participation.');
        $this->set_property($property);
    }

    public function get_5_6_5()
    {
        return $this->get_property('5_6_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('5_6_1');
        $property->add_property_name('5_6_2');
        $property->add_property_name('5_6_3');
        $property->add_property_name('5_6_4');
        $property->add_property_name('5_6_5');
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
