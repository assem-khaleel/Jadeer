<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_8_1
 *
 * @author ahmadgx
 */
class Ses_Standard_8_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '8.1 Financial Planning and Budgeting';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_8_1_1('');
            $this->set_8_1_2('');
            $this->set_8_1_3('');
            $this->set_8_1_4('');
            $this->set_8_1_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Funding must be adequate for program requirements and planning must involve full cost estimates and both short and medium term cost projections.  Sufficient flexibility must be provided for effective management and responses to unexpected events and this flexibility must be combined with appropriate accountability and reporting mechanisms</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_8_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_1', $value);
        $property->set_description('8.1.1 Proposals for new programs, major program changes or other activities, equipment or facilities are accompanied by business plans, which include independently verified cost estimates and cost impacts on other services and activities.');
        $this->set_property($property);
    }

    public function get_8_1_1()
    {
        return $this->get_property('8_1_1')->get_value();
    }

    public function set_8_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_2', $value);
        $property->set_description('8.1.2 If new projects or activities are cross-subsidized from existing funding sources the cost sharing strategy is made clear and intermediate and long term costs and benefits are assessed.');
        $this->set_property($property);
    }

    public function get_8_1_2()
    {
        return $this->get_property('8_1_2')->get_value();
    }

    public function set_8_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_3', $value);
        $property->set_description('8.1.3 Financial resources available for the program are sufficient for good quality program provision and benchmarked against costs of equivalent programs at other similar institutions.');
        $this->set_property($property);
    }

    public function get_8_1_3()
    {
        return $this->get_property('8_1_3')->get_value();
    }

    public function set_8_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_4', $value);
        $property->set_description('8.1.4 The program coordinator (or department chair or dean) submits annual budget proposals setting out detailed program requirements and follows up as necessary to make adjustments after those proposals have been considered.');
        $this->set_property($property);
    }

    public function get_8_1_4()
    {
        return $this->get_property('8_1_4')->get_value();
    }

    public function set_8_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_5', $value);
        $property->set_description('8.1.5 Budget proposals support strategic priorities for program development and quality improvement and consider possibilities for possible savings or alternative revenue sources as well as seeking additional funding if necessary');
        $this->set_property($property);
    }

    public function get_8_1_5()
    {
        return $this->get_property('8_1_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('8_1_1');
        $property->add_property_name('8_1_2');
        $property->add_property_name('8_1_3');
        $property->add_property_name('8_1_4');
        $property->add_property_name('8_1_5');
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
