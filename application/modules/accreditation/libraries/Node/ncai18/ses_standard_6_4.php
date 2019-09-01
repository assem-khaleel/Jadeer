<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_6_4
 *
 * @author user
 */
class Ses_Standard_6_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '6.4 Resources and Facilities';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_6_4_1('');
            $this->set_6_4_2('');
            $this->set_6_4_3('');
            $this->set_6_4_4('');
            $this->set_6_4_5('');
            $this->set_6_4_6('');
            $this->set_6_4_7('');
            $this->set_6_4_8('');
            $this->set_6_4_9('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Resources and facilities must be adequate for the learning and research requirements of the institution.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_6_4_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_1', $value);
        $property->set_description('6.4.1 Adequate financial resources are provided for acquisitions, cataloguing, equipment, and for services and system development.');
        $this->set_property($property);
    }

    public function get_6_4_1()
    {
        return $this->get_property('6_4_1')->get_value();
    }

    public function set_6_4_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_2', $value);
        $property->set_description('6.4.2 The availability of on line access and inter library loan facilities is not used to reduce commitment to providing adequate physical resources on site.');
        $this->set_property($property);
    }

    public function get_6_4_2()
    {
        return $this->get_property('6_4_2')->get_value();
    }

    public function set_6_4_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_3', $value);
        $property->set_description('6.4.3 Adequate facilities are available to house collections in a way that makes them readily accessible.');
        $this->set_property($property);
    }

    public function get_6_4_3()
    {
        return $this->get_property('6_4_3')->get_value();
    }

    public function set_6_4_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_4', $value);
        $property->set_description('6.4.4 Up to date computer equipment and software is available to support electronic access to resources and reference material.');
        $this->set_property($property);
    }

    public function get_6_4_4()
    {
        return $this->get_property('6_4_4')->get_value();
    }

    public function set_6_4_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_5', $value);
        $property->set_description('6.4.5 Copying facilities supported by efficient payment mechanisms are available for users.');
        $this->set_property($property);
    }

    public function get_6_4_5()
    {
        return $this->get_property('6_4_5')->get_value();
    }

    public function set_6_4_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_6', $value);
        $property->set_description('6.4.6 Adequate facilities are provided for use of personal laptop computers.');
        $this->set_property($property);
    }

    public function get_6_4_6()
    {
        return $this->get_property('6_4_6')->get_value();
    }

    public function set_6_4_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_7', $value);
        $property->set_description('6.4.7 Books and journals and other materials are available in Arabic and English (or other languages) as required for the programs taught and research undertaken in the institution.');
        $this->set_property($property);
    }

    public function get_6_4_7()
    {
        return $this->get_property('6_4_7')->get_value();
    }

    public function set_6_4_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_8', $value);
        $property->set_description('6.4.8 Sufficient facilities are provided for both individual and small group study and research.');
        $this->set_property($property);
    }

    public function get_6_4_8()
    {
        return $this->get_property('6_4_8')->get_value();
    }

    public function set_6_4_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_9', $value);
        $property->set_description('6.4.9 The level of provision of facilities and resources (numbers of books, seats, group study facilities etc.) is benchmarked against provisions at similar good quality institutions and is adequate for the size of the institution and the programs offered.');
        $this->set_property($property);
    }

    public function get_6_4_9()
    {
        return $this->get_property('6_4_9')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('6_4_1');
        $property->add_property_name('6_4_2');
        $property->add_property_name('6_4_3');
        $property->add_property_name('6_4_4');
        $property->add_property_name('6_4_5');
        $property->add_property_name('6_4_6');
        $property->add_property_name('6_4_7');
        $property->add_property_name('6_4_8');
        $property->add_property_name('6_4_9');
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
