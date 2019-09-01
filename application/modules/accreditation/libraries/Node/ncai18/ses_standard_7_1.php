<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_7_1
 *
 * @author user
 */
class Ses_Standard_7_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '7.1 Policy and Planning';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_7_1_1('');
            $this->set_7_1_2('');
            $this->set_7_1_3('');
            $this->set_7_1_4('');
            $this->set_7_1_5('');
            $this->set_7_1_6('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The college must develop and effectively implement master plans for development and management of facilities and equipment to meet its needs. This planning must be carried out in consultation with stakeholders and be responsive to their requirements.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_7_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_1_1', $value);
        $property->set_description('7.1.1 The institution has a long-term master plan approved by the governing body that provides for capital developments and maintenance of facilities.');
        $this->set_property($property);
    }

    public function get_7_1_1()
    {
        return $this->get_property('7_1_1')->get_value();
    }

    public function set_7_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_1_2', $value);
        $property->set_description('7.1.2 Equipment planning processes include plans and schedules for major equipment acquisitions and for servicing and replacement following a planned schedule.');
        $this->set_property($property);
    }

    public function get_7_1_2()
    {
        return $this->get_property('7_1_2')->get_value();
    }

    public function set_7_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_1_3', $value);
        $property->set_description('7.1.3 Future users of facilities or major equipment are consulted prior to acquisitions or development to ensure that current and anticipated future needs are accurately met.');
        $this->set_property($property);
    }

    public function get_7_1_3()
    {
        return $this->get_property('7_1_3')->get_value();
    }

    public function set_7_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_1_4', $value);
        $property->set_description('7.1.4 The institution has an equipment policy designed to ensure to the greatest feasible extent, compatibility of equipment and systems across the institution.');
        $this->set_property($property);
    }

    public function get_7_1_4()
    {
        return $this->get_property('7_1_4')->get_value();
    }

    public function set_7_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_1_5', $value);
        $property->set_description('7.1.5 Business plans are prepared prior to major equipment acquisitions, with evaluation of alternatives of leasing or shared use with other agencies.');
        $this->set_property($property);
    }

    public function get_7_1_5()
    {
        return $this->get_property('7_1_5')->get_value();
    }

    public function set_7_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_1_6', $value);
        $property->set_description('7.1.6 Proposals for leasing of major facilities and for outsourced building and management of facilities are fully evaluated in the long-term interests of the institution and managed in a way that ensures effective quality control and financial benefits');
        $this->set_property($property);
    }

    public function get_7_1_6()
    {
        return $this->get_property('7_1_6')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('7_1_1');
        $property->add_property_name('7_1_2');
        $property->add_property_name('7_1_3');
        $property->add_property_name('7_1_4');
        $property->add_property_name('7_1_5');
        $property->add_property_name('7_1_6');
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
