<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_9_3
 *
 * @author user
 */
class Ses_Standard_9_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '9.3 Personal and Career Development';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_9_3_1('');
            $this->set_9_3_2('');
            $this->set_9_3_3('');
            $this->set_9_3_4('');
            $this->set_9_3_5('');
            $this->set_9_3_6('');
            $this->set_9_3_7('');
            $this->set_9_3_8('');
            $this->set_9_3_9('');
            $this->set_9_3_10('');
            $this->set_9_3_11('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Processes for personal and professional development must be fair to all teaching and other staff, designed to encourage and support improvements in performance, and recognize outstanding achievements.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_9_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_3_1', $value);
        $property->set_description('9.3.1 Criteria for performance evaluation are clearly specified in advance and made known to teaching and other staff.');
        $this->set_property($property);
    }

    public function get_9_3_1()
    {
        return $this->get_property('9_3_1')->get_value();
    }

    public function set_9_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_3_2', $value);
        $property->set_description('9.3.2 Consultations about work performance by supervisors (including heads of department, deans, administrative supervisors) are confidential and supportive, and occur on a formal basis at least once each year.');
        $this->set_property($property);
    }

    public function get_9_3_2()
    {
        return $this->get_property('9_3_2')->get_value();
    }

    public function set_9_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_3_3', $value);
        $property->set_description('9.3.3 If performance is considered less than satisfactory clear requirements are established for improvement.');
        $this->set_property($property);
    }

    public function get_9_3_3()
    {
        return $this->get_property('9_3_3')->get_value();
    }

    public function set_9_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_3_4', $value);
        $property->set_description('9.3.4 Formal performance assessments of teaching and other staff are kept confidential but are documented and retained. Teaching and other staff have the opportunity to include on file their own comments relating to these assessments, including points of disagreement.');
        $this->set_property($property);
    }

    public function get_9_3_4()
    {
        return $this->get_property('9_3_4')->get_value();
    }

    public function set_9_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_3_5', $value);
        $property->set_description('9.3.5 Outstanding academic or administrative performance at any level of the institution is recognized and rewarded.');
        $this->set_property($property);
    }

    public function get_9_3_5()
    {
        return $this->get_property('9_3_5')->get_value();
    }

    public function set_9_3_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_3_6', $value);
        $property->set_description('9.3.6 All teaching and other staff should be given appropriate and fair opportunities for personal and career development.');
        $this->set_property($property);
    }

    public function get_9_3_6()
    {
        return $this->get_property('9_3_6')->get_value();
    }

    public function set_9_3_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_3_7', $value);
        $property->set_description('9.3.7 Junior teaching and other staff with leadership potential are identified and given a range of experiences to prepare them for future career development.');
        $this->set_property($property);
    }

    public function get_9_3_7()
    {
        return $this->get_property('9_3_7')->get_value();
    }

    public function set_9_3_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_3_8', $value);
        $property->set_description('9.3.8 Promotion criteria include contributions to achievement of the mission of the institution, and in the case of teaching staff include proper recognition of quality of teaching and efforts to improve it, and service to the institution and the community as well as research.');
        $this->set_property($property);
    }

    public function get_9_3_8()
    {
        return $this->get_property('9_3_8')->get_value();
    }

    public function set_9_3_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_3_9', $value);
        $property->set_description('9.3.9 Assistance is given in arranging professional development activities to improve skills and upgrade qualifications.');
        $this->set_property($property);
    }

    public function get_9_3_9()
    {
        return $this->get_property('9_3_9')->get_value();
    }

    public function set_9_3_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_3_10', $value);
        $property->set_description('9.3.10 Appropriate professional development activities are provided to assist with new programs or policy initiatives.');
        $this->set_property($property);
    }

    public function get_9_3_10()
    {
        return $this->get_property('9_3_10')->get_value();
    }

    public function set_9_3_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_3_11', $value);
        $property->set_description('9.3.11 Teaching staff are expected to participate in activities that ensure they keep up to date with developments in their field and the extent to which they do so is monitored.');
        $this->set_property($property);
    }

    public function get_9_3_11()
    {
        return $this->get_property('9_3_11')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('9_3_1');
        $property->add_property_name('9_3_2');
        $property->add_property_name('9_3_3');
        $property->add_property_name('9_3_4');
        $property->add_property_name('9_3_5');
        $property->add_property_name('9_3_6');
        $property->add_property_name('9_3_7');
        $property->add_property_name('9_3_8');
        $property->add_property_name('9_3_9');
        $property->add_property_name('9_3_10');
        $property->add_property_name('9_3_11');
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
