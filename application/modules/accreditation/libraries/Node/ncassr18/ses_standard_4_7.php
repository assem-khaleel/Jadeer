<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_4_7
 *
 * @author ahmadgx
 */
class Ses_Standard_4_7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.7 Support for Improvements in Quality of Teaching';
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
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Appropriate strategies must be used by the program administrators and teaching staff to support continuing improvement in quality of teaching .</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_7_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_1', $value);
        $property->set_description('4.7.1 Training programs in teaching skills are provided within the institution for both new and continuing teaching staff including those with part time teaching responsibilities.');
        $this->set_property($property);
    }

    public function get_4_7_1()
    {
        return $this->get_property('4_7_1')->get_value();
    }

    public function set_4_7_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_2', $value);
        $property->set_description('4.7.2 Training programs in teaching include effective use of new and emerging technology.');
        $this->set_property($property);
    }

    public function get_4_7_2()
    {
        return $this->get_property('4_7_2')->get_value();
    }

    public function set_4_7_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_3', $value);
        $property->set_description('4.7.3 The extent to which teaching staff are involved in professional development to improve quality of teaching is monitored.');
        $this->set_property($property);
    }

    public function get_4_7_3()
    {
        return $this->get_property('4_7_3')->get_value();
    }

    public function set_4_7_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_4', $value);
        $property->set_description('4.7.4 Opportunities are provided for the professional and academic development of teaching staff with special assistance given to any who are facing difficulties');
        $this->set_property($property);
    }

    public function get_4_7_4()
    {
        return $this->get_property('4_7_4')->get_value();
    }

    public function set_4_7_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_5', $value);
        $property->set_description('4.7.5 Teaching staff are encouraged to develop strategies for improvement of their own teaching and maintain a portfolio of evidence of evaluations and strategies for improvement.');
        $this->set_property($property);
    }

    public function get_4_7_5()
    {
        return $this->get_property('4_7_5')->get_value();
    }

    public function set_4_7_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_6', $value);
        $property->set_description('4.7.6 Formal recognition is given to outstanding teaching, with encouragement given for innovation and creativity.');
        $this->set_property($property);
    }

    public function get_4_7_6()
    {
        return $this->get_property('4_7_6')->get_value();
    }

    public function set_4_7_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_7_7', $value);
        $property->set_description('4.7.7 Strategies for improving quality of teaching include improving the quality of learning materials and the teaching strategies incorporated in them.');
        $this->set_property($property);
    }

    public function get_4_7_7()
    {
        return $this->get_property('4_7_7')->get_value();
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
