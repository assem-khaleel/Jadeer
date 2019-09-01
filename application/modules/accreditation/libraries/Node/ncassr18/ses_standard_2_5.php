<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_2_5
 *
 * @author ahmadgx
 */
class Ses_Standard_2_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.5 Internal Policies and Regulations';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_2_5_1('');
            $this->set_2_5_2('');
            $this->set_2_5_3('');
            $this->set_2_5_4('');
            $this->set_2_5_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Policies and regulations must be established that clearly define the major responsibilities and procedures for the administration of the program and for committees and teaching and other staff and students involved.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_5_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_5_1', $value);
        $property->set_description('2.5.1 The terms of reference and operating procedures for major committees and academic and administrative positions associated with the program are clearly specified and included in the policy and procedures manual.');
        $this->set_property($property);
    }

    public function get_2_5_1()
    {
        return $this->get_property('2_5_1')->get_value();
    }

    public function set_2_5_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_5_2', $value);
        $property->set_description('2.5.2 Policies and regulations relating to the program are made accessible to faculty, staff and students, and effective strategies are used to ensure they are understood and complied with.');
        $this->set_property($property);
    }

    public function get_2_5_2()
    {
        return $this->get_property('2_5_2')->get_value();
    }

    public function set_2_5_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_5_3', $value);
        $property->set_description('2.5.3 Decisions made by committees on procedural or academic matters are recorded and referred to when future similar issues are considered.');
        $this->set_property($property);
    }

    public function get_2_5_3()
    {
        return $this->get_property('2_5_3')->get_value();
    }

    public function set_2_5_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_5_4', $value);
        $property->set_description('2.5.4 Guidelines, bylaws or regulations are established for recurring procedural or academic issues');
        $this->set_property($property);
    }

    public function get_2_5_4()
    {
        return $this->get_property('2_5_4')->get_value();
    }

    public function set_2_5_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_5_5', $value);
        $property->set_description('2.5.5 The policies and regulations for the management of the program are periodically reviewed and amended as required in the light of changing circumstances.');
        $this->set_property($property);
    }

    public function get_2_5_5()
    {
        return $this->get_property('2_5_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('2_5_1');
        $property->add_property_name('2_5_2');
        $property->add_property_name('2_5_3');
        $property->add_property_name('2_5_4');
        $property->add_property_name('2_5_5');
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
