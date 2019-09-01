<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ses_standard_5_3
 *
 * @author user
 */
class Ses_Standard_5_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.3 Student Management';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_5_3_1('');
            $this->set_5_3_2('');
            $this->set_5_3_3('');
            $this->set_5_3_4('');
            $this->set_5_3_5('');
            $this->set_5_3_6('');
            $this->set_5_3_7('');
            $this->set_5_3_8('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Policies and regulations must be established for fair and consistent processes of student management, with effective safeguards for independent consideration of disputes and appeals.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_5_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_3_1', $value);
        $property->set_description('5.3.1 A code of behaviour is approved by the governing body and made widely available within the institution specifying rights and responsibilities of students.');
        $this->set_property($property);
    }

    public function get_5_3_1()
    {
        return $this->get_property('5_3_1')->get_value();
    }

    public function set_5_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_3_2', $value);
        $property->set_description('5.3.2 Regulations specify action to be taken for breaches of student discipline including the responsibilities of relevant officers and committees, and penalties, which may be imposed.');
        $this->set_property($property);
    }

    public function get_5_3_2()
    {
        return $this->get_property('5_3_2')->get_value();
    }

    public function set_5_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_3_3', $value);
        $property->set_description('5.3.3 Disciplinary action is taken promptly, and full documentation including details of evidence is retained in secure institutional records.');
        $this->set_property($property);
    }

    public function get_5_3_3()
    {
        return $this->get_property('5_3_3')->get_value();
    }

    public function set_5_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_3_4', $value);
        $property->set_description('5.3.4 Student appeal and grievance procedures are specified in regulations, published, and made widely known within the institution. The regulations make clear the grounds on which academic appeals may be based, the criteria for decisions, and the remedies available.');
        $this->set_property($property);
    }

    public function get_5_3_4()
    {
        return $this->get_property('5_3_4')->get_value();
    }

    public function set_5_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_3_5', $value);
        $property->set_description('5.3.5 Appeal and grievance procedures protect against time wasting on trivial issues, but still provide adequate opportunity for matters of concern to students to be fairly dealt with and supported by student counselling provisions.');
        $this->set_property($property);
    }

    public function get_5_3_5()
    {
        return $this->get_property('5_3_5')->get_value();
    }

    public function set_5_3_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_3_6', $value);
        $property->set_description('5.3.6 Appeal and grievance procedures guarantee impartial consideration by persons or committees independent of the parties involved in the issue, or who made a decision or imposed a penalty that is being appealed against.');
        $this->set_property($property);
    }

    public function get_5_3_6()
    {
        return $this->get_property('5_3_6')->get_value();
    }

    public function set_5_3_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_3_7', $value);
        $property->set_description('5.3.7 Procedures have been developed to ensure that students are protected against subsequent punitive action or discrimination following consideration of a grievance or appeal.');
        $this->set_property($property);
    }

    public function get_5_3_7()
    {
        return $this->get_property('5_3_7')->get_value();
    }

    public function set_5_3_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_3_8', $value);
        $property->set_description('5.3.8 Appropriate policies and procedures are in place to deal with academic misconduct, including plagiarism and other forms of cheating.');
        $this->set_property($property);
    }

    public function get_5_3_8()
    {
        return $this->get_property('5_3_8')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('5_3_1');
        $property->add_property_name('5_3_2');
        $property->add_property_name('5_3_3');
        $property->add_property_name('5_3_4');
        $property->add_property_name('5_3_5');
        $property->add_property_name('5_3_6');
        $property->add_property_name('5_3_7');
        $property->add_property_name('5_3_8');
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
