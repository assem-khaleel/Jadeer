<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_6_2
 *
 * @author user
 */
class Ses_Standard_6_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '6.2 Organization';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_6_2_1('');
            $this->set_6_2_2('');
            $this->set_6_2_3('');
            $this->set_6_2_4('');
            $this->set_6_2_5('');
            $this->set_6_2_6('');
            $this->set_6_2_7('');
            $this->set_6_2_8('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The library or resource center must be managed efficiently to provide required services in a secure environment conducive to effective study.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_6_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_2_1', $value);
        $property->set_description('6.2.1 Library and resource centers and associated facilities and services are available for sufficient extended hours to ensure access when required by users.');
        $this->set_property($property);
    }

    public function get_6_2_1()
    {
        return $this->get_property('6_2_1')->get_value();
    }

    public function set_6_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_2_2', $value);
        $property->set_description('6.2.2 Collections are arranged appropriately and cataloged according to internationally recognized good practice.');
        $this->set_property($property);
    }

    public function get_6_2_2()
    {
        return $this->get_property('6_2_2')->get_value();
    }

    public function set_6_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_2_3', $value);
        $property->set_description('6.2.3 Agreements are established for cooperation with other libraries and resource centers for interlibrary loans and sharing of resources and services.');
        $this->set_property($property);
    }

    public function get_6_2_3()
    {
        return $this->get_property('6_2_3')->get_value();
    }

    public function set_6_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_2_4', $value);
        $property->set_description('6.2.4 Reliable systems are in place for recording of loans and returns, with efficient follow up for overdue material.');
        $this->set_property($property);
    }

    public function get_6_2_4()
    {
        return $this->get_property('6_2_4')->get_value();
    }

    public function set_6_2_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_2_5', $value);
        $property->set_description('6.2.5 Heavy demand and required reading materials are held in reserve collections.');
        $this->set_property($property);
    }

    public function get_6_2_5()
    {
        return $this->get_property('6_2_5')->get_value();
    }

    public function set_6_2_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_2_6', $value);
        $property->set_description("6.2.6 Ready access to on-line data-bases and research and journal material relevant to the institution’s programs is provided ");
        $this->set_property($property);
    }

    public function get_6_2_6()
    {
        return $this->get_property('6_2_6')->get_value();
    }

    public function set_6_2_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_2_7', $value);
        $property->set_description('6.2.7 Rules for behavior within the library are established and enforced to ensure maintenance of an environment conducive to effective study and student and staff research.');
        $this->set_property($property);
    }

    public function get_6_2_7()
    {
        return $this->get_property('6_2_7')->get_value();
    }

    public function set_6_2_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_2_8', $value);
        $property->set_description('6.2.8 Effective security systems are in place to prevent loss of materials and inappropriate use of the internet.');
        $this->set_property($property);
    }

    public function get_6_2_8()
    {
        return $this->get_property('6_2_8')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('6_2_1');
        $property->add_property_name('6_2_2');
        $property->add_property_name('6_2_3');
        $property->add_property_name('6_2_4');
        $property->add_property_name('6_2_5');
        $property->add_property_name('6_2_6');
        $property->add_property_name('6_2_7');
        $property->add_property_name('6_2_8');
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
