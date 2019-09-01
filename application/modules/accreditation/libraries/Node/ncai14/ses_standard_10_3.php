<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_10_3
 *
 * @author user
 */
class Ses_Standard_10_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '10.3 Commercialization of Research';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_10_3_1('');
            $this->set_10_3_2('');
            $this->set_10_3_3('');
            $this->set_10_3_4('');
            $this->set_10_3_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Commercialization of research should be encouraged, opportunities for commercial development of intellectual property carefully investigated, and help provided to establish appropriate commercial relationships. Policies on ownership of intellectual property must be clearly specified and consistently followed.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_10_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_3_1', $value);
        $property->set_description('10.3.1 A research development unit or center is established with capacity to identify and publicize institutional expertise and commercial development opportunities, assist in developing proposals and business plans, preparation of contracts, and when appropriate, development of spin off companies.');
        $this->set_property($property);
    }

    public function get_10_3_1()
    {
        return $this->get_property('10_3_1')->get_value();
    }

    public function set_10_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_3_2', $value);
        $property->set_description('10.3.2 Ideas with potential for commercial development are critically evaluated with advice from experienced persons from industry and relevant professions before investment by the institution is authorized.');
        $this->set_property($property);
    }

    public function get_10_3_2()
    {
        return $this->get_property('10_3_2')->get_value();
    }

    public function set_10_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_3_3', $value);
        $property->set_description('10.3.3 Intellectual property policies define ownership and establish procedures for commercialization of ideas developed by staff and students, and specify scales for equitable sharing of returns to the inventor(s), and the institution.');
        $this->set_property($property);
    }

    public function get_10_3_3()
    {
        return $this->get_property('10_3_3')->get_value();
    }

    public function set_10_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_3_4', $value);
        $property->set_description('10.3.4 A culture of entrepreneurship is actively encouraged throughout the institution, with particular emphasis on teaching staff and postgraduate students.');
        $this->set_property($property);
    }

    public function get_10_3_4()
    {
        return $this->get_property('10_3_4')->get_value();
    }

    public function set_10_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_3_5', $value);
        $property->set_description('10.3.5 Regulations are established that require disclosure of pecuniary interest and avoidance of conflict of interest in activities related to research.');
        $this->set_property($property);
    }

    public function get_10_3_5()
    {
        return $this->get_property('10_3_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('10_3_1');
        $property->add_property_name('10_3_2');
        $property->add_property_name('10_3_3');
        $property->add_property_name('10_3_4');
        $property->add_property_name('10_3_5');
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
