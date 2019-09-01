<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_9_2
 *
 * @author ahmadgx
 */
class Ses_Standard_9_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '9.2 Personal and Career Development';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_9_2_1('');
            $this->set_9_2_2('');
            $this->set_9_2_3('');
            $this->set_9_2_4('');
            $this->set_9_2_5('');
            $this->set_9_2_6('');
            $this->set_9_2_7('');
            $this->set_9_2_8('');
            $this->set_9_2_9('');
            $this->set_9_2_10('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Processes for personal and professional development must be fair to all teaching and other staff, designed to encourage and support improvements in performance and recognize outstanding achievements.</strong> <br/> <br/>'
            . 'The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_9_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_1', $value);
        $property->set_description('9.2.1 Criteria for performance evaluation are clearly specified in advance and made known to teaching and other staff.');
        $this->set_property($property);
    }

    public function get_9_2_1()
    {
        return $this->get_property('9_2_1')->get_value();
    }

    public function set_9_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_2', $value);
        $property->set_description('9.2.2 Consultations about work performance are confidential and supportive, and occur on a formal basis at least once each year.');
        $this->set_property($property);
    }

    public function get_9_2_2()
    {
        return $this->get_property('9_2_2')->get_value();
    }

    public function set_9_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_3', $value);
        $property->set_description('9.2.3 If performance is considered less than satisfactory clear requirements are established for improvement.');
        $this->set_property($property);
    }

    public function get_9_2_3()
    {
        return $this->get_property('9_2_3')->get_value();
    }

    public function set_9_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_4', $value);
        $property->set_description(' 9.2.4 Formal performance assessments of teaching and other staff are kept confidential but are documented and retained.  Faculty and staff have the opportunity to include on file their own comments relating to these assessments, including points of disagreement');
        $this->set_property($property);
    }

    public function get_9_2_4()
    {
        return $this->get_property('9_2_4')->get_value();
    }

    public function set_9_2_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_5', $value);
        $property->set_description('9.2.5 Outstanding academic or administrative performance is recognized and rewarded.');
        $this->set_property($property);
    }

    public function get_9_2_5()
    {
        return $this->get_property('9_2_5')->get_value();
    }

    public function set_9_2_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_6', $value);
        $property->set_description('9.2.6 All teaching and other staff are given appropriate and fair opportunities for personal and career development.');
        $this->set_property($property);
    }

    public function get_9_2_6()
    {
        return $this->get_property('9_2_6')->get_value();
    }

    public function set_9_2_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_7', $value);
        $property->set_description('9.2.7 Junior teaching and other staff with leadership potential are identified and given a range of experiences to prepare them for future career development.');
        $this->set_property($property);
    }

    public function get_9_2_7()
    {
        return $this->get_property('9_2_7')->get_value();
    }

    public function set_9_2_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_8', $value);
        $property->set_description('9.2.8 Assistance is given in arranging professional development activities to improve skills and upgrade qualifications.');
        $this->set_property($property);
    }

    public function get_9_2_8()
    {
        return $this->get_property('9_2_8')->get_value();
    }

    public function set_9_2_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_9', $value);
        $property->set_description('9.2.9 Appropriate professional development activities are provided to assist with new programs or policy initiatives .');
        $this->set_property($property);
    }

    public function get_9_2_9()
    {
        return $this->get_property('9_2_9')->get_value();
    }

    public function set_9_2_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_10', $value);
        $property->set_description('9.2.10 Teaching staff are expected to participate in activities that ensure they keep up to date with developments in their field and the extent to which they do so is monitored.');
        $this->set_property($property);
    }

    public function get_9_2_10()
    {
        return $this->get_property('9_2_10')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('9_2_1');
        $property->add_property_name('9_2_2');
        $property->add_property_name('9_2_3');
        $property->add_property_name('9_2_4');
        $property->add_property_name('9_2_5');
        $property->add_property_name('9_2_6');
        $property->add_property_name('9_2_7');
        $property->add_property_name('9_2_8');
        $property->add_property_name('9_2_9');
        $property->add_property_name('9_2_10');
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
