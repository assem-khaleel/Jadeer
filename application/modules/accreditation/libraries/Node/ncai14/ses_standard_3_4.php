<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_3_4
 *
 * @author user
 */
class Ses_Standard_3_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.4 Use of Indicators and Benchmarks';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_3_4_1('');
            $this->set_3_4_2('');
            $this->set_3_4_3('');
            $this->set_3_4_4('');
            $this->set_3_4_5('');
            $this->set_3_4_6('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Specific indicators must be identified for monitoring performance and appropriate benchmarks selected for evaluation of the achievement of goals and objectives and for the quality of major institutional functions.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_3_4_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_4_1', $value);
        $property->set_description('3.4.1 A limited number of key performance indicators that are capable of objective measurement have been identified and provide clear objective evidence of quality of performance for sections within the institution (including colleges and departments) and for the institution as a whole.');
        $this->set_property($property);
    }

    public function get_3_4_1()
    {
        return $this->get_property('3_4_1')->get_value();
    }

    public function set_3_4_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_4_2', $value);
        $property->set_description('3.4.2 Additional indicators that provide clear evidence of quality of performance in achieving their objectives are selected by or for each academic and administrative unit within the institution.');
        $this->set_property($property);
    }

    public function get_3_4_2()
    {
        return $this->get_property('3_4_2')->get_value();
    }

    public function set_3_4_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_4_3', $value);
        $property->set_description('3.4.3 When functions that are carried out by different organizational units (eg. teaching, research, community service) some common indicators are selected for all such units as measures of quality and to provide for comparisons of performance.');
        $this->set_property($property);
    }

    public function get_3_4_3()
    {
        return $this->get_property('3_4_3')->get_value();
    }

    public function set_3_4_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_4_4', $value);
        $property->set_description('3.4.4 Benchmarks for comparing quality of performance (including past performance and at least some comparisons with other institutions) are established and achievements in relation to those benchmarks is regularly monitored.');
        $this->set_property($property);
    }

    public function get_3_4_4()
    {
        return $this->get_property('3_4_4')->get_value();
    }

    public function set_3_4_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_4_5', $value);
        $property->set_description('3.4.5 Key performance indicators and benchmarks for major organizational units or functions are approved by the appropriate committee or council within the institution (eg. senior academic committee, university council)');
        $this->set_property($property);
    }

    public function get_3_4_5()
    {
        return $this->get_property('3_4_5')->get_value();
    }

    public function set_3_4_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_4_6', $value);
        $property->set_description('3.4.6 The format for indicators and benchmarks is consistent across the institution and provides specific evidence relating to important objectives.');
        $this->set_property($property);
    }

    public function get_3_4_6()
    {
        return $this->get_property('3_4_6')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('3_4_1');
        $property->add_property_name('3_4_2');
        $property->add_property_name('3_4_3');
        $property->add_property_name('3_4_4');
        $property->add_property_name('3_4_5');
        $property->add_property_name('3_4_6');

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
