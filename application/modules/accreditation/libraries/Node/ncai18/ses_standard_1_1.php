<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_1_1
 *
 * @author user
 */
class Ses_Standard_1_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '1.1 Appropriateness of the Mission';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_1_1_1('');
            $this->set_1_1_2('');
            $this->set_1_1_3('');
            $this->set_1_1_4('');
            $this->set_1_1_5('');
            $this->set_1_1_6('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The mission statement must be appropriate for the institution in the community in which it is operating.</strong><br/><br/> The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_1_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_1_1', $value);
        $property->set_description('1.1.1 The mission statement is consistent with the establishment charter of the institution.(including any objectives or purposes in by-laws, company objectives or comparable documents)');
        $this->set_property($property);
    }

    public function get_1_1_1()
    {
        return $this->get_property('1_1_1')->get_value();
    }

    public function set_1_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_1_2', $value);
        $property->set_description('1.1.2 The mission statement is appropriate for an institution of its type. (eg a small private college, a research university, a girls college in a regional community, etc.)');
        $this->set_property($property);
    }

    public function get_1_1_2()
    {
        return $this->get_property('1_1_2')->get_value();
    }

    public function set_1_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_1_3', $value);
        $property->set_description('1.1.3 The mission statement is consistent with Islamic beliefs and values.');
        $this->set_property($property);
    }

    public function get_1_1_3()
    {
        return $this->get_property('1_1_3')->get_value();
    }

    public function set_1_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_1_4', $value);
        $property->set_description('1.1.4 The mission is relevant to needs of the community or communities served by the institution');
        $this->set_property($property);
    }

    public function get_1_1_4()
    {
        return $this->get_property('1_1_4')->get_value();
    }

    public function set_1_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_1_5', $value);
        $property->set_description('1.1.5 The mission is consistent with the economic and cultural requirements of the Kingdom of Saudi Arabia.');
        $this->set_property($property);
    }

    public function get_1_1_5()
    {
        return $this->get_property('1_1_5')->get_value();
    }

    public function set_1_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_1_6', $value);
        $property->set_description('1.1.6 The appropriateness of the mission is explained to stakeholders in an accompanying statement commenting on significant aspects of the environment within which it operates. (which may relate to local, national or international issues)');
        $this->set_property($property);
    }

    public function get_1_1_6()
    {
        return $this->get_property('1_1_6')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('1_1_1');
        $property->add_property_name('1_1_2');
        $property->add_property_name('1_1_3');
        $property->add_property_name('1_1_4');
        $property->add_property_name('1_1_5');
        $property->add_property_name('1_1_6');

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
