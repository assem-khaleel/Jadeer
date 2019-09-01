<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_8_2
 *
 * @author ahmadgx
 */
class Ses_Standard_8_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '8.2 Financial Management';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_8_2_1('');
            $this->set_8_2_2('');
            $this->set_8_2_3('');
            $this->set_8_2_4('');
            $this->set_8_2_5('');
            $this->set_8_2_6('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Financial affairs must be effectively managed with a proper balance between flexibility for the cost center manager and institutional accountability and responsibility.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_8_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_2_1', $value);
        $property->set_description('8.2.1 Sufficient delegation of spending authority is given to the program manager (or department chair) for effective program administration');
        $this->set_property($property);
    }

    public function get_8_2_1()
    {
        return $this->get_property('8_2_1')->get_value();
    }

    public function set_8_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_2_2', $value);
        $property->set_description('8.2.2 Delegations of spending authority are accompanied by appropriate');
        $this->set_property($property);
    }

    public function get_8_2_2()
    {
        return $this->get_property('8_2_2')->get_value();
    }

    public function set_8_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_2_3', $value);
        $property->set_description('8.2.3 The program manager/head of department is involved in the budget planning process, and is held accountable for expenditure within the approved budget');
        $this->set_property($property);
    }

    public function get_8_2_3()
    {
        return $this->get_property('8_2_3')->get_value();
    }

    public function set_8_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_2_4', $value);
        $property->set_description('8.2.4 The accounting system provides for accurate and continuing monitoring by the program manager of expenditure and commitments against budgets');
        $this->set_property($property);
    }

    public function get_8_2_4()
    {
        return $this->get_property('8_2_4')->get_value();
    }

    public function set_8_2_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_2_5', $value);
        $property->set_description('8.2.5 Where possibilities of conflict of interest exist, either actual or perceived, the persons concerned declare their interest and refrain from participation in decisions');
        $this->set_property($property);
    }

    public function get_8_2_5()
    {
        return $this->get_property('8_2_5')->get_value();
    }

    public function set_8_2_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_2_6', $value);
        $property->set_description('8.2.6 Allowable financial carry-forward provisions are sufficiently flexible to avoid rushed end of year expenditure or disincentives for long term planning');
        $this->set_property($property);
    }

    public function get_8_2_6()
    {
        return $this->get_property('8_2_6')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('8_2_1');
        $property->add_property_name('8_2_2');
        $property->add_property_name('8_2_3');
        $property->add_property_name('8_2_4');
        $property->add_property_name('8_2_5');
        $property->add_property_name('8_2_6');
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
