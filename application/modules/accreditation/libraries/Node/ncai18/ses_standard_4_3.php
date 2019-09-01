<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_4_3
 *
 * @author user
 */
class Ses_Standard_4_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.3 Program Development Processes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_3_1('');
            $this->set_4_3_2('');
            $this->set_4_3_3('');
            $this->set_4_3_4('');
            $this->set_4_3_5('');
            $this->set_4_3_6('');
            $this->set_4_3_7('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Programs must be planned as coherent packages of learning experiences in which all courses contribute in planned ways to the intended learning outcomes for the program.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_1', $value);
        $property->set_description('4.3.1 Plans for the delivery of programs and for their evaluation are set out in detailed program specifications. (These should include knowledge and skills to be acquired, and strategies for teaching and assessment for the progressive development of learning in all the domains of learning.)');
        $this->set_property($property);
    }

    public function get_4_3_1()
    {
        return $this->get_property('4_3_1')->get_value();
    }

    public function set_4_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_2', $value);
        $property->set_description('4.3.2 Plans for courses are set out in course specifications that include knowledge and skills to be acquired and strategies for teaching and assessment for the domains of learning to be addressed in each course.');
        $this->set_property($property);
    }

    public function get_4_3_2()
    {
        return $this->get_property('4_3_2')->get_value();
    }

    public function set_4_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_3', $value);
        $property->set_description('4.3.3 The content and strategies set out in course specifications are coordinated to ensure effective progressive development of learning for the total program in all the domains of learning.');
        $this->set_property($property);
    }

    public function get_4_3_3()
    {
        return $this->get_property('4_3_3')->get_value();
    }

    public function set_4_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_4', $value);
        $property->set_description('4.3.4 Planning includes any actions necessary to ensure that teaching staff are familiar with and are able to use the strategies included in the program and course specifications.');
        $this->set_property($property);
    }

    public function get_4_3_4()
    {
        return $this->get_property('4_3_4')->get_value();
    }

    public function set_4_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_5', $value);
        $property->set_description('4.3.5 The academic or professional fields for which students are being prepared are monitored on a continuing basis with necessary adjustments made in programs and in text and reference materials to ensure continuing relevance and quality.');
        $this->set_property($property);
    }

    public function get_4_3_5()
    {
        return $this->get_property('4_3_5')->get_value();
    }

    public function set_4_3_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_6', $value);
        $property->set_description('4.3.6 In professional programs practitioners from the relevant occupations or professions are included in continuing advisory committees that monitor and advise on content and quality of programs.');
        $this->set_property($property);
    }

    public function get_4_3_6()
    {
        return $this->get_property('4_3_6')->get_value();
    }

    public function set_4_3_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_7', $value);
        $property->set_description("4.3.7 New program proposals are assessed and approved or rejected by the institution's senior academic committee using criteria that ensure thorough and appropriate consultation in planning and capacity for effective implementation.");
        $this->set_property($property);
    }

    public function get_4_3_7()
    {
        return $this->get_property('4_3_7')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_3_1');
        $property->add_property_name('4_3_2');
        $property->add_property_name('4_3_3');
        $property->add_property_name('4_3_4');
        $property->add_property_name('4_3_5');
        $property->add_property_name('4_3_6');
        $property->add_property_name('4_3_7');
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
