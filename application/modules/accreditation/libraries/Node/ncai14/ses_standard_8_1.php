<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_8_1
 *
 * @author user
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
            $this->set_8_1_6('');
            $this->set_8_1_7('');
            $this->set_8_1_8('');
            $this->set_8_1_9('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Financial planning processes must be responsive to institutional goals and priorities, maintain viable revenue/expenditure relationships and take full account of long term and short term funding implications.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_8_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_1', $value);
        $property->set_description('8.1.1 Budgeting and resource allocation  are aligned with the mission and goals of the institution and strategic planning to achieve those goals');
        $this->set_property($property);
    }

    public function get_8_1_1()
    {
        return $this->get_property('8_1_1')->get_value();
    }

    public function set_8_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_2', $value);
        $property->set_description('8.1.2 Annual budgets are developed within a framework of long term revenue and expenditure projections that are progressively adjusted in the light of experience.');
        $this->set_property($property);
    }

    public function get_8_1_2()
    {
        return $this->get_property('8_1_2')->get_value();
    }

    public function set_8_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_3', $value);
        $property->set_description('8.1.3 Budget proposals are developed by senior academic and administrative staff in consultation with cost center managers, carefully reviewed, and presented to the governing body for approval.');
        $this->set_property($property);
    }

    public function get_8_1_3()
    {
        return $this->get_property('8_1_3')->get_value();
    }

    public function set_8_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_4', $value);
        $property->set_description('8.1.4 Proposals for new programs or major activities, equipment or facilities are accompanied by business plans that include independently verified cost estimates and cost impacts on other services and activities.');
        $this->set_property($property);
    }

    public function get_8_1_4()
    {
        return $this->get_property('8_1_4')->get_value();
    }

    public function set_8_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_5', $value);
        $property->set_description('8.1.5 If new ventures are cross-subsidized from existing funding sources the cost sharing strategy is made explicit and intermediate and long term costs and benefits are assessed.');
        $this->set_property($property);
    }

    public function get_8_1_5()
    {
        return $this->get_property('8_1_5')->get_value();
    }

    public function set_8_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_6', $value);
        $property->set_description('8.1.6 If loans are used debt and liquidity ratios are monitored and benchmarked against commercial practice and equivalent ratios in other higher education institutions.');
        $this->set_property($property);
    }

    public function get_8_1_6()
    {
        return $this->get_property('8_1_6')->get_value();
    }

    public function set_8_1_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_7', $value);
        $property->set_description('8.1.7 Ratios of expenditure on salaries to total expenditure are planned and monitored, with variations for colleges or departments with different cost structures.');
        $this->set_property($property);
    }

    public function get_8_1_7()
    {
        return $this->get_property('8_1_7')->get_value();
    }

    public function set_8_1_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_8', $value);
        $property->set_description('8.1.8 Borrowing and other long term financing schemes are used sparingly as a strategic financing strategy to improve capacity rather than to meet unanticipated short term operating costs, with obligations to be met from projected additional revenue, or from known existing revenue sources.');
        $this->set_property($property);
    }

    public function get_8_1_8()
    {
        return $this->get_property('8_1_8')->get_value();
    }

    public function set_8_1_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('8_1_9', $value);
        $property->set_description('8.1.9 Financial planning aims to diversify revenue through a range of activities, which, while consistent with the charter and mission of the institution, reduce its dependence on a single funding source.');
        $this->set_property($property);
    }

    public function get_8_1_9()
    {
        return $this->get_property('8_1_9')->get_value();
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
        $property->add_property_name('8_1_6');
        $property->add_property_name('8_1_7');
        $property->add_property_name('8_1_8');
        $property->add_property_name('8_1_9');
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
