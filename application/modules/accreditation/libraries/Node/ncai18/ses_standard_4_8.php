<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_4_8
 *
 * @author user
 */
class Ses_Standard_4_8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.8 Support for Improvements in Quality of Teaching';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_8_1('');
            $this->set_4_8_2('');
            $this->set_4_8_3('');
            $this->set_4_8_4('');
            $this->set_4_8_5('');
            $this->set_4_8_6('');
            $this->set_4_8_7('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The institution must implement appropriate strategies to support continuing improvement in quality of teaching.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_8_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_1', $value);
        $property->set_description('4.8.1 Training programs in teaching skills are provided for both new and continuing teaching staff including those in part time positions.');
        $this->set_property($property);
    }

    public function get_4_8_1()
    {
        return $this->get_property('4_8_1')->get_value();
    }

    public function set_4_8_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_2', $value);
        $property->set_description('4.8.2 Training programs in teaching should include effective use of new and emerging technology.');
        $this->set_property($property);
    }

    public function get_4_8_2()
    {
        return $this->get_property('4_8_2')->get_value();
    }

    public function set_4_8_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_3', $value);
        $property->set_description('4.8.3 Adequate opportunities are provided for the professional and academic development of teaching staff with special assistance given to any who are facing difficulties.');
        $this->set_property($property);
    }

    public function get_4_8_3()
    {
        return $this->get_property('4_8_3')->get_value();
    }

    public function set_4_8_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_4', $value);
        $property->set_description('4.8.4 The extent to which teaching staff are involved in professional development to improve quality of teaching is monitored.');
        $this->set_property($property);
    }

    public function get_4_8_4()
    {
        return $this->get_property('4_8_4')->get_value();
    }

    public function set_4_8_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_5', $value);
        $property->set_description('4.8.5 Teaching staff develop strategies for improvement of their own teaching and maintain a portfolio of evidence of evaluations and strategies for improvement.');
        $this->set_property($property);
    }

    public function get_4_8_5()
    {
        return $this->get_property('4_8_5')->get_value();
    }

    public function set_4_8_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_6', $value);
        $property->set_description('4.8.6 Formal recognition is given to outstanding teaching, and encouragement given for innovation and creativity.');
        $this->set_property($property);
    }

    public function get_4_8_6()
    {
        return $this->get_property('4_8_6')->get_value();
    }

    public function set_4_8_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_7', $value);
        $property->set_description('4.8.7 Strategies for improving quality of teaching include improving the quality of learning materials and the teaching strategies associated with them.');
        $this->set_property($property);
    }

    public function get_4_8_7()
    {
        return $this->get_property('4_8_7')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_8_1');
        $property->add_property_name('4_8_2');
        $property->add_property_name('4_8_3');
        $property->add_property_name('4_8_4');
        $property->add_property_name('4_8_5');
        $property->add_property_name('4_8_6');
        $property->add_property_name('4_8_7');
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
