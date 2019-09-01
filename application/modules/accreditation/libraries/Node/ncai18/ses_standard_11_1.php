<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_11_1
 *
 * @author user
 */
class Ses_Standard_11_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '11.1 Institutional Policies on Community Relationships';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_11_1_1('');
            $this->set_11_1_2('');
            $this->set_11_1_3('');
            $this->set_11_1_4('');
            $this->set_11_1_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', "<strong>The institutions commitment to service to the community must be clearly specified, clear in its nature and scope, supported by policies to encourage involvement and regular reports should be prepared on activities that take place.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.");
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_11_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_1_1', $value);
        $property->set_description('11.1.1 The service commitment of the institution is relevant to the community or communities within which the institution operates, and included in its mission');
        $this->set_property($property);
    }

    public function get_11_1_1()
    {
        return $this->get_property('11_1_1')->get_value();
    }

    public function set_11_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_1_2', $value);
        $property->set_description('11.1.2 Policies on the institution’s service role have been approved by the governing body and these policies should be supported in decisions made by senior administrators');
        $this->set_property($property);
    }

    public function get_11_1_2()
    {
        return $this->get_property('11_1_2')->get_value();
    }

    public function set_11_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_1_3', $value);
        $property->set_description("11.1.3 Annual reports are prepared on the institutions contributions to the community");
        $this->set_property($property);
    }

    public function get_11_1_3()
    {
        return $this->get_property('11_1_3')->get_value();
    }

    public function set_11_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_1_4', $value);
        $property->set_description('11.1.4 Promotion criteria and faculty assessments include contributions made to the community.');
        $this->set_property($property);
    }

    public function get_11_1_4()
    {
        return $this->get_property('11_1_4')->get_value();
    }

    public function set_11_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_1_5', $value);
        $property->set_description('11.1.5 Websites providing details of institutional structures and activities, including news items of potential interest to potential students and members of the wider community, are provided and kept up to date.');
        $this->set_property($property);
    }

    public function get_11_1_5()
    {
        return $this->get_property('11_1_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('11_1_1');
        $property->add_property_name('11_1_2');
        $property->add_property_name('11_1_3');
        $property->add_property_name('11_1_4');
        $property->add_property_name('11_1_5');
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
