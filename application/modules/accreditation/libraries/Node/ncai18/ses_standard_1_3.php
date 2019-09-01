<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_1_3
 *
 * @author user
 */
class Ses_Standard_1_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '1.3 Development and Review of the Mission';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_1_3_1('');
            $this->set_1_3_2('');
            $this->set_1_3_3('');
            $this->set_1_3_4('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The mission statement must be developed through consultative processes and formally adopted and periodically reviewed.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_1_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_3_1', $value);
        $property->set_description('1.3.1 Major stakeholders within the institution and the communities it serves have been consulted and support the mission.');
        $this->set_property($property);
    }

    public function get_1_3_1()
    {
        return $this->get_property('1_3_1')->get_value();
    }

    public function set_1_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_3_2', $value);
        $property->set_description('1.3.2 The governing body of the institution formally approved the mission statement.');
        $this->set_property($property);
    }

    public function get_1_3_2()
    {
        return $this->get_property('1_3_2')->get_value();
    }

    public function set_1_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_3_3', $value);
        $property->set_description('1.3.3 The governing body periodically reviews the mission statement and confirms or amends it in the light of changing circumstances.');
        $this->set_property($property);
    }

    public function get_1_3_3()
    {
        return $this->get_property('1_3_3')->get_value();
    }

    public function set_1_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_3_4', $value);
        $property->set_description('1.3.4 Stakeholders are kept informed about the mission and any changes in it.');
        $this->set_property($property);
    }

    public function get_1_3_4()
    {
        return $this->get_property('1_3_4')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('1_3_1');
        $property->add_property_name('1_3_2');
        $property->add_property_name('1_3_3');
        $property->add_property_name('1_3_4');
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
