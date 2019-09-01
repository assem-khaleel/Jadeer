<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_4_3
 *
 * @author ahmadgx
 */
class Ses_Standard_4_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.3 Program Evaluation and Review Processes';
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
            $this->set_4_3_8('');
            $this->set_4_3_9('');
            $this->set_4_3_10('');
            $this->set_4_3_11('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The quality of all courses and of the program as a whole must be monitored regularly through appropriate evaluation mechanisms and amended as required, with more extensive quality reviews conducted periodically.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_1', $value);
        $property->set_description('4.3.1 Courses and programs are evaluated and reported on annually with information about the effectiveness of planned strategies and the extent to which intended learning outcomes are being achieved.');
        $this->set_property($property);
    }

    public function get_4_3_1()
    {
        return $this->get_property('4_3_1')->get_value();
    }

    public function set_4_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_2', $value);
        $property->set_description('4.3.2 When changes are made as a result of evaluations details of those changes and the reasons for them are retained in course and program portfolios.');
        $this->set_property($property);
    }

    public function get_4_3_2()
    {
        return $this->get_property('4_3_2')->get_value();
    }

    public function set_4_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_3', $value);
        $property->set_description('4.3.3 Quality indicators that include learning outcome measures are identified and used for all courses and the program as a whole.');
        $this->set_property($property);
    }

    public function get_4_3_3()
    {
        return $this->get_property('4_3_3')->get_value();
    }

    public function set_4_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_4', $value);
        $property->set_description('4.3.4 Records of student completion rates in all courses and the program as a whole are kept and used as quality indicators.');
        $this->set_property($property);
    }

    public function get_4_3_4()
    {
        return $this->get_property('4_3_4')->get_value();
    }

    public function set_4_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_5', $value);
        $property->set_description('4.3.5 Annual reports including quality assurance data are provided and reviewed by senior administrators and quality committees.');
        $this->set_property($property);
    }

    public function get_4_3_5()
    {
        return $this->get_property('4_3_5')->get_value();
    }

    public function set_4_3_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_6', $value);
        $property->set_description('4.3.6 Course completion, program progression and completion rates,  and student course and program evaluations, are retained in central records in a form that can be readily accessed by the department and college, and analysed centrally with summaries and comparative data distributed automatically to departments, colleges, senior administrators and relevant committees at least once each year.');
        $this->set_property($property);
    }

    public function get_4_3_6()
    {
        return $this->get_property('4_3_6')->get_value();
    }

    public function set_4_3_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_7', $value);
        $property->set_description('4.3.7 If problems are found through program evaluations appropriate action is taken to make improvements');
        $this->set_property($property);
    }

    public function get_4_3_7()
    {
        return $this->get_property('4_3_7')->get_value();
    }

    public function set_4_3_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_8', $value);
        $property->set_description('4.3.8 In addition to annual evaluations a comprehensive reassessment of the  program should be conducted at least once every five years.  Procedures for conducting these reassessments should be consistent with policies and procedures for the institution');
        $this->set_property($property);
    }

    public function get_4_3_8()
    {
        return $this->get_property('4_3_8')->get_value();
    }

    public function set_4_3_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_9', $value);
        $property->set_description('4.3.9 Program reviews conducted within the institution involve experienced people from relevant industries and professions, and experienced teaching staff from other institutions.');
        $this->set_property($property);
    }

    public function get_4_3_9()
    {
        return $this->get_property('4_3_9')->get_value();
    }

    public function set_4_3_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_10', $value);
        $property->set_description('4.3.10 Procedures are followed that ensure that in program reviews information about the appropriateness of learning outcomes sought and the extent to which they are achieved is sought from students and graduates through surveys and interviews, discussions with teaching staff, and other stakeholders such as employers.');
        $this->set_property($property);
    }

    public function get_4_3_10()
    {
        return $this->get_property('4_3_10')->get_value();
    }

    public function set_4_3_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_3_11', $value);
        $property->set_description('4.3.11 In sections for male and female students evaluations provide data for each section as well as for the program as a whole, and any deficiencies in one or the other section dealt with appropriately in recommendations for action.');
        $this->set_property($property);
    }

    public function get_4_3_11()
    {
        return $this->get_property('4_3_11')->get_value();
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
        $property->add_property_name('4_3_8');
        $property->add_property_name('4_3_9');
        $property->add_property_name('4_3_10');
        $property->add_property_name('4_3_11');
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
