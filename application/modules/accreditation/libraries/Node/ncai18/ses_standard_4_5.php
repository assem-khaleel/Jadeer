<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_4_5
 *
 * @author user
 */
class Ses_Standard_4_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.5 Student Assessment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_5_1('');
            $this->set_4_5_2('');
            $this->set_4_5_3('');
            $this->set_4_5_4('');
            $this->set_4_5_5('');
            $this->set_4_5_6('');
            $this->set_4_5_7('');
            $this->set_4_5_8('');
            $this->set_4_5_9('');
            $this->set_4_5_10('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Student assessment processes must be appropriate for the intended learning outcomes and effectively and fairly administered with independent verification of standards achieved.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_5_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_1', $value);
        $property->set_description('4.5.1 Student assessment mechanisms are appropriate for the forms of learning sought.');
        $this->set_property($property);
    }

    public function get_4_5_1()
    {
        return $this->get_property('4_5_1')->get_value();
    }

    public function set_4_5_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_2', $value);
        $property->set_description('4.5.2 Assessment processes are clearly communicated to students at the beginning of courses.');
        $this->set_property($property);
    }

    public function get_4_5_2()
    {
        return $this->get_property('4_5_2')->get_value();
    }

    public function set_4_5_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_3', $value);
        $property->set_description('4.5.3 Appropriate, valid and reliable mechanisms are used in programs throughout the institution for verifying standards of student achievement in relation to relevant internal and external benchmarks. The standard of work required for different grades should be consistent over time, comparable in courses offered within a program and college and the institution as a whole, and in comparison with other highly regarded institutions. (Arrangements for verifying standards may include measures such as check marking of random samples of student work by teaching staff at other institutions, and independent comparisons of standards achieved with other comparable institutions within Saudi Arabia, and internationally.)');
        $this->set_property($property);
    }

    public function get_4_5_3()
    {
        return $this->get_property('4_5_3')->get_value();
    }

    public function set_4_5_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_4', $value);
        $property->set_description('4.5.4 Grading of students tests, assignments and projects is assisted by the use of matrices or other means to ensure that the planned range of domains of student learning outcomes are addressed.');
        $this->set_property($property);
    }

    public function get_4_5_4()
    {
        return $this->get_property('4_5_4')->get_value();
    }

    public function set_4_5_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_5', $value);
        $property->set_description('4.5.5 Arrangements are made within the institution for training of teaching staff in the theory and practice of student assessment.');
        $this->set_property($property);
    }

    public function get_4_5_5()
    {
        return $this->get_property('4_5_5')->get_value();
    }

    public function set_4_5_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_6', $value);
        $property->set_description('4.5.6 Appropriate procedures are followed to deal with situations where standards of student achievement are inadequate or inconsistently assessed.');
        $this->set_property($property);
    }

    public function get_4_5_6()
    {
        return $this->get_property('4_5_6')->get_value();
    }

    public function set_4_5_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_7', $value);
        $property->set_description('4.5.7 Effective procedures are followed that ensure that work submitted by students is actually done by the students concerned.');
        $this->set_property($property);
    }

    public function get_4_5_7()
    {
        return $this->get_property('4_5_7')->get_value();
    }

    public function set_4_5_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_8', $value);
        $property->set_description('4.5.8 Feedback to students on their performance and results of assessments during each semester is given promptly and accompanied by mechanisms for assistance if needed.');
        $this->set_property($property);
    }

    public function get_4_5_8()
    {
        return $this->get_property('4_5_8')->get_value();
    }

    public function set_4_5_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_9', $value);
        $property->set_description('4.5.9 Assessments of students work are conducted fairly and objectively.');
        $this->set_property($property);
    }

    public function get_4_5_9()
    {
        return $this->get_property('4_5_9')->get_value();
    }

    public function set_4_5_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_10', $value);
        $property->set_description('4.5.10 Criteria and processes for academic appeals are made known to students and administered equitably (see also item 5.3)');
        $this->set_property($property);
    }

    public function get_4_5_10()
    {
        return $this->get_property('4_5_10')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_5_1');
        $property->add_property_name('4_5_2');
        $property->add_property_name('4_5_3');
        $property->add_property_name('4_5_4');
        $property->add_property_name('4_5_5');
        $property->add_property_name('4_5_6');
        $property->add_property_name('4_5_7');
        $property->add_property_name('4_5_8');
        $property->add_property_name('4_5_9');
        $property->add_property_name('4_5_10');

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
