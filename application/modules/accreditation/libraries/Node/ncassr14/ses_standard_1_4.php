<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_1_4
 *
 * @author ahmadgx
 */
class Ses_Standard_1_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '1.4 Use Made of the Mission Statement';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_1_4_1('');
            $this->set_1_4_2('');
            $this->set_1_4_3('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The mission must be used consistently as a basis for planning and major policy decisions.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_1_4_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_4_1', $value);
        $property->set_description('1.4.1 The mission statement is used as a basis for a strategic plan for development of the program over a medium term planning period. (normally five to seven years)');
        $this->set_property($property);
    }

    public function get_1_4_1()
    {
        return $this->get_property('1_4_1')->get_value();
    }

    public function set_1_4_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_4_2', $value);
        $property->set_description('1.4.2 The mission statement is known about and supported by teaching and other staff and students.');
        $this->set_property($property);
    }

    public function get_1_4_2()
    {
        return $this->get_property('1_4_2')->get_value();
    }

    public function set_1_4_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('1_4_3', $value);
        $property->set_description('1.4.3 Consistency with the mission is listed among criteria for consideration of program and project proposals by committees and decision makers.');
        $this->set_property($property);
    }

    public function get_1_4_3()
    {
        return $this->get_property('1_4_3')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('1_4_1');
        $property->add_property_name('1_4_2');
        $property->add_property_name('1_4_3');
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
