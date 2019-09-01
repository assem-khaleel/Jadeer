<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_4_6
 *
 * @author ahmadgx
 */
class Ses_Standard_4_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.6 Quality of Teaching';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_6_1('');
            $this->set_4_6_2('');
            $this->set_4_6_3('');
            $this->set_4_6_4('');
            $this->set_4_6_5('');
            $this->set_4_6_6('');
            $this->set_4_6_7('');
            $this->set_4_6_8('');
            $this->set_4_6_9('');
            $this->set_4_6_10('');
            $this->set_4_6_11('');
            $this->set_4_6_12('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Teaching must be of high quality with appropriate strategies used for different categories of learning outcomes.</strong>\
             <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_6_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_1', $value);
        $property->set_description('4.6.1 Effective orientation and training programs are provided for new, short term and part time teaching staff.  (To be effective these programs should ensure that teaching staff are fully briefed on required learning outcomes, on planned teaching and assessment strategies, and the contribution of their course to the program as a whole.)');
        $this->set_property($property);
    }

    public function get_4_6_1()
    {
        return $this->get_property('4_6_1')->get_value();
    }

    public function set_4_6_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_2', $value);
        $property->set_description('4.6.2 Appropriate strategies of teaching are planned and used for the different kinds of learning outcomes the program is intended to develop.');
        $this->set_property($property);
    }

    public function get_4_6_2()
    {
        return $this->get_property('4_6_2')->get_value();
    }

    public function set_4_6_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_3', $value);
        $property->set_description('4.6.3 The strategies of teaching and assessment set out in program and course specifications are followed by teaching staff with flexibility to respond to the needs of different groups of students.');
        $this->set_property($property);
    }

    public function get_4_6_3()
    {
        return $this->get_property('4_6_3')->get_value();
    }

    public function set_4_6_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_4', $value);
        $property->set_description('4.6.4 Students are fully informed about course requirements in advance through course descriptions that include knowledge and skills to be developed, work requirements and assessment processes.');
        $this->set_property($property);
    }

    public function get_4_6_4()
    {
        return $this->get_property('4_6_4')->get_value();
    }

    public function set_4_6_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_5', $value);
        $property->set_description('4.6.5 The conduct of courses is consistent with the outlines provided to students and with the course specifications.');
        $this->set_property($property);
    }

    public function get_4_6_5()
    {
        return $this->get_property('4_6_5')->get_value();
    }

    public function set_4_6_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_6', $value);
        $property->set_description('4.6.6 Textbooks and reference material are up to date and incorporate the latest developments in the field of study.');
        $this->set_property($property);
    }

    public function get_4_6_6()
    {
        return $this->get_property('4_6_6')->get_value();
    }

    public function set_4_6_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_7', $value);
        $property->set_description('4.6.7 Textbooks and other required materials are available in sufficient quantities before classes commence');
        $this->set_property($property);
    }

    public function get_4_6_7()
    {
        return $this->get_property('4_6_7')->get_value();
    }

    public function set_4_6_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_8', $value);
        $property->set_description('4.6.8 Attendance requirements are made clear to students and compliance with these   requirements is monitored and enforced');
        $this->set_property($property);
    }

    public function get_4_6_8()
    {
        return $this->get_property('4_6_8')->get_value();
    }

    public function set_4_6_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_9', $value);
        $property->set_description('4.6.9 Effective systems are used for evaluation of courses and of teaching.');
        $this->set_property($property);
    }

    public function get_4_6_9()
    {
        return $this->get_property('4_6_9')->get_value();
    }

    public function set_4_6_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_10', $value);
        $property->set_description('4.6.10 The effectiveness of different planned teaching strategies in achieving learning outcomes in different domains of learning is regularly reviewed and adjustments are made in response to evidence about their effectiveness.');
        $this->set_property($property);
    }

    public function get_4_6_10()
    {
        return $this->get_property('4_6_10')->get_value();
    }

    public function set_4_6_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_11', $value);
        $property->set_description('4.6.11 Reports are provided to program administrators on the delivery of each course and these include details if any planned content could not be dealt with and any difficulties found in using the planned strategies');
        $this->set_property($property);
    }

    public function get_4_6_11()
    {
        return $this->get_property('4_6_11')->get_value();
    }

    public function set_4_6_12($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_6_12', $value);
        $property->set_description('4.6.12 Appropriate adjustments are made in plans for teaching if needed after consideration of course reports.');
        $this->set_property($property);
    }

    public function get_4_6_12()
    {
        return $this->get_property('4_6_12')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_6_1');
        $property->add_property_name('4_6_2');
        $property->add_property_name('4_6_3');
        $property->add_property_name('4_6_4');
        $property->add_property_name('4_6_5');
        $property->add_property_name('4_6_6');
        $property->add_property_name('4_6_7');
        $property->add_property_name('4_6_8');
        $property->add_property_name('4_6_9');
        $property->add_property_name('4_6_10');
        $property->add_property_name('4_6_11');
        $property->add_property_name('4_6_12');
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
