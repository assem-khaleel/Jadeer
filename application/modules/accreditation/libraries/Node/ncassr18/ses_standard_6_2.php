<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_6_2
 *
 * @author ahmadgx
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
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The library or resource center must be managed in a way that meets the requirements of the program for student access and availability of resources and services.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_6_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_2_1', $value);
        $property->set_description('6.2.1 Library and resource centers and associated facilities and services are available for sufficient extended hours to ensure access when required by users in the program.');
        $this->set_property($property);
    }

    public function get_6_2_1()
    {
        return $this->get_property('6_2_1')->get_value();
    }

    public function set_6_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_2_2', $value);
        $property->set_description('6.2.2 Heavy demand and required reading materials needed in the program are held in reserve collections.');
        $this->set_property($property);
    }

    public function get_6_2_2()
    {
        return $this->get_property('6_2_2')->get_value();
    }

    public function set_6_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_2_3', $value);
        $property->set_description('6.2.3 Ready access to on-line data-bases and research and journal material relevant to the program is provided for.');
        $this->set_property($property);
    }

    public function get_6_2_3()
    {
        return $this->get_property('6_2_3')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('6_2_1');
        $property->add_property_name('6_2_2');
        $property->add_property_name('6_2_3');
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
