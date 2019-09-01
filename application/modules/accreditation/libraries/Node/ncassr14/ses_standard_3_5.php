<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_3_5
 *
 * @author ahmadgx
 */
class Ses_Standard_3_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.5 Independent Verification of Standards';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_3_5_1('');
            $this->set_3_5_2('');
            $this->set_3_5_3('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Evaluations of performance must be based on evidence (including but not restricted to predetermined performance indicators and benchmarks) and conclusions based on that evidence must be independently verified.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_3_5_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_5_1', $value);
        $property->set_description('3.5.1 Self-evaluations of quality of performance are checked against several related sources  evidence including feedback through user surveys and opinions of stakeholders such as students and faculty, graduates and employers.');
        $this->set_property($property);
    }

    public function get_3_5_1()
    {
        return $this->get_property('3_5_1')->get_value();
    }

    public function set_3_5_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_5_2', $value);
        $property->set_description('3.5.2 Interpretations of evidence of quality of performance are verified through independent advice from persons familiar with the type of activity concerned and impartial mechanisms are used to reconcile differing opinions.');
        $this->set_property($property);
    }

    public function get_3_5_2()
    {
        return $this->get_property('3_5_2')->get_value();
    }

    public function set_3_5_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_5_3', $value);
        $property->set_description('3.5.3 Institutional policies and procedures are adhered to for the verification of standards of achievement by students in relation to other institutions and the requirements of the National Qualifications Framework.');
        $this->set_property($property);
    }

    public function get_3_5_3()
    {
        return $this->get_property('3_5_3')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('3_5_1');
        $property->add_property_name('3_5_2');
        $property->add_property_name('3_5_3');
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
