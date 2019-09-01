<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_6_1
 *
 * @author ahmadgx
 */
class Ses_Standard_6_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '6.1 Planning and Evaluation';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_6_1_1('');
            $this->set_6_1_2('');
            $this->set_6_1_3('');
            $this->set_6_1_4('');
            $this->set_6_1_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Policies and procedures must be in place to ensure that resource materials and services needed to support student learning are adequate and appropriate for the program, regularly evaluated, and kept up to date as required.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_6_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_1', $value);
        $property->set_description('6.1.1 Teaching staff responsible for the program and for courses within it regularly provide advice on materials required to support teaching and learning.');
        $this->set_property($property);
    }

    public function get_6_1_1()
    {
        return $this->get_property('6_1_1')->get_value();
    }

    public function set_6_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_2', $value);
        $property->set_description('6.1.2 Teaching staff and  students participate in user surveys dealing with adequacy of resources and services, extent of usage, consistency with requirements for teaching and learning');
        $this->set_property($property);
    }

    public function get_6_1_2()
    {
        return $this->get_property('6_1_2')->get_value();
    }

    public function set_6_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_3', $value);
        $property->set_description('6.1.3 Data on the extent of usage of learning resources for the program are used in evaluations of learning and teaching in the program.');
        $this->set_property($property);
    }

    public function get_6_1_3()
    {
        return $this->get_property('6_1_3')->get_value();
    }

    public function set_6_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_4', $value);
        $property->set_description('6.1.4 In addition to participation in surveys program representatives have opportunities to provide input to evaluations of forward planning for provision of resources and services.');
        $this->set_property($property);
    }

    public function get_6_1_4()
    {
        return $this->get_property('6_1_4')->get_value();
    }

    public function set_6_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_5', $value);
        $property->set_description('6.1.5 Teaching staff provide regular advice on material that should be held in reserve to ensure access to necessary materials and this advice is responded to.');
        $this->set_property($property);
    }

    public function get_6_1_5()
    {
        return $this->get_property('6_1_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('6_1_1');
        $property->add_property_name('6_1_2');
        $property->add_property_name('6_1_3');
        $property->add_property_name('6_1_4');
        $property->add_property_name('6_1_5');
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
