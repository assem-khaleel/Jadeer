<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_4_7
 *
 * @author user
 */
class Ses_Standard_4_7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.7 Quality of Teaching';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_7_1('');
            $this->set_4_7_2('');
            $this->set_4_7_3('');
            $this->set_4_7_4('');
            $this->set_4_7_5('');
            $this->set_4_7_6('');
            $this->set_4_7_7('');
            $this->set_4_7_8('');
            $this->set_4_7_9('');
            $this->set_4_7_10('');
            $this->set_4_7_11('');
            $this->set_4_7_12('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Teaching must be of high quality with appropriate strategies used for different categories of learning outcomes.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_7_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_1', $value);
        $property->set_description('4.7.1 Effective orientation and training programs are provided for new, short term and part time staff. (To be effective these programs should ensure that faculty are fully briefed on required learning outcomes, on planned teaching strategies, and the contribution of their course to the program as a whole.)');
        $this->set_property($property);
    }

    public function get_4_7_1()
    {
        return $this->get_property('4_7_1')->get_value();
    }

    public function set_4_7_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_2', $value);
        $property->set_description('4.7.2 Teaching strategies are appropriate for the different types of learning outcomes programs are intended to develop.');
        $this->set_property($property);
    }

    public function get_4_7_2()
    {
        return $this->get_property('4_7_2')->get_value();
    }

    public function set_4_7_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_3', $value);
        $property->set_description('4.7.3 Strategies of teaching and assessment set out in program and course specifications are followed by teaching staff with flexibility to meet the needs of different groups of students.');
        $this->set_property($property);
    }

    public function get_4_7_3()
    {
        return $this->get_property('4_7_3')->get_value();
    }

    public function set_4_7_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_4', $value);
        $property->set_description('4.7.4 Students are fully informed about course requirements in advance through course descriptions that include knowledge and skills to be developed, work requirements and assessment processes.');
        $this->set_property($property);
    }

    public function get_4_7_4()
    {
        return $this->get_property('4_7_4')->get_value();
    }

    public function set_4_7_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_5', $value);
        $property->set_description('4.7.5 The conduct of courses is consistent with the outlines provided to students and with the course specifications.');
        $this->set_property($property);
    }

    public function get_4_7_5()
    {
        return $this->get_property('4_7_5')->get_value();
    }

    public function set_4_7_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_6', $value);
        $property->set_description('4.7.6 Textbooks and reference materials are up to date with latest developments in the field of study.');
        $this->set_property($property);
    }

    public function get_4_7_6()
    {
        return $this->get_property('4_7_6')->get_value();
    }

    public function set_4_7_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_7', $value);
        $property->set_description('4.7.7 Textbooks and other required materials are available in sufficient quantities before classes commence.');
        $this->set_property($property);
    }

    public function get_4_7_7()
    {
        return $this->get_property('4_7_7')->get_value();
    }

    public function set_4_7_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_8', $value);
        $property->set_description('4.7.8 Student attendance requirements in classes are made clear in student orientations, attendance is monitored, and regulations rigorously enforced.');
        $this->set_property($property);
    }

    public function get_4_7_8()
    {
        return $this->get_property('4_7_8')->get_value();
    }

    public function set_4_7_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_9', $value);
        $property->set_description('4.7.9 A comprehensive system , (including but not limited to student surveys) is in place for evaluation of teaching effectiveness in all courses.');
        $this->set_property($property);
    }

    public function get_4_7_9()
    {
        return $this->get_property('4_7_9')->get_value();
    }

    public function set_4_7_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_10', $value);
        $property->set_description('4.7.10 The effectiveness of planned teaching strategies in developing learning outcomes is regularly assessed, and adjustments made in response to evidence about their effectiveness.');
        $this->set_property($property);
    }

    public function get_4_7_10()
    {
        return $this->get_property('4_7_10')->get_value();
    }

    public function set_4_7_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_11', $value);
        $property->set_description('4.7.11 Regular (at least annual) reports are provided to program administrators on the delivery of each course including any material that could not be covered and any difficulties found in using planned strategies.');
        $this->set_property($property);
    }

    public function get_4_7_11()
    {
        return $this->get_property('4_7_11')->get_value();
    }

    public function set_4_7_12($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_12', $value);
        $property->set_description('4.7.12 Appropriate adjustments made in plans for teaching as a result of course reports.');
        $this->set_property($property);
    }

    public function get_4_7_12()
    {
        return $this->get_property('4_7_12')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_7_1');
        $property->add_property_name('4_7_2');
        $property->add_property_name('4_7_3');
        $property->add_property_name('4_7_4');
        $property->add_property_name('4_7_5');
        $property->add_property_name('4_7_6');
        $property->add_property_name('4_7_7');
        $property->add_property_name('4_7_8');
        $property->add_property_name('4_7_9');
        $property->add_property_name('4_7_10');
        $property->add_property_name('4_7_11');
        $property->add_property_name('4_7_12');
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
