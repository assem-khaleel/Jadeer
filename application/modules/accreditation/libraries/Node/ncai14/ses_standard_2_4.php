<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_2_4
 *
 * @author user
 */
class Ses_Standard_2_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.4 Relationship Between Sections for Male and Female Students';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_2_4_1('');
            $this->set_2_4_2('');
            $this->set_2_4_3('');
            $this->set_2_4_4('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>In sections for male and female students the leaders of both sections must participate in institutional governance and be fully involved in strategic planning, decision making, and senior management with effective and continuing communication between sections. Strategic planning should ensure equitable distribution of resources and facilities to meet the requirements of program delivery, research, and associated services in each section as well as for the institution as a whole.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_4_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_4_1', $value);
        $property->set_description('2.4.1 Male and female sections are adequately represented in the membership of relevant committees and councils through processes that are consistent with bylaws and regulations of the Higher Council of Education.');
        $this->set_property($property);
    }

    public function get_2_4_1()
    {
        return $this->get_property('2_4_1')->get_value();
    }

    public function set_2_4_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_4_2', $value);
        $property->set_description('2.4.2 There is effective communication between members of committees and councils and between individuals in the different sections carrying out related activities.');
        $this->set_property($property);
    }

    public function get_2_4_2()
    {
        return $this->get_property('2_4_2')->get_value();
    }

    public function set_2_4_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_4_3', $value);
        $property->set_description('2.4.3 Programs, facilities and services are planned and resources provided that ensure comparable standards are achieved in each section, while taking account of variations appropriate for different needs.');
        $this->set_property($property);
    }

    public function get_2_4_3()
    {
        return $this->get_property('2_4_3')->get_value();
    }

    public function set_2_4_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_4_4', $value);
        $property->set_description('2.4.4 Quality indicators, evaluations and reports show results for both sections indicating similarities and differences as well as overall performance.');
        $this->set_property($property);
    }

    public function get_2_4_4()
    {
        return $this->get_property('2_4_4')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('2_4_1');
        $property->add_property_name('2_4_2');
        $property->add_property_name('2_4_3');
        $property->add_property_name('2_4_4');

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
