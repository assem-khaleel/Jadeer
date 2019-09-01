<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_h_standard_8
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 8. Financial Planning and Management';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_financial_resource('');
            $this->set_standard_description('');
            $this->set_8_1('');
            $this->set_8_2('');
            $this->set_explanatory_report('');
            $this->set_evaluation_report('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 8;
        $standard_obj = \Orm_Standard::get_one(['code' => 8]);

        $children = array();

        if(\License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {

            $program_node = $this->get_parent_program_node();

            $KPIs = \Orm_Kpi::get_all(array('standard_id' => $standard_obj->get_id(), 'college_id' => $program_node->get_parent_college_node()->get_item_id()));
            if ($KPIs) {
                foreach ($KPIs as $kpi) {

                    $info = $kpi->get_info(\Orm_Kpi_Detail::TYPE_PROGRAM, array('college_id' => $program_node->get_parent_college_node()->get_item_id(), 'program_id' => $program_node->get_item_id()));

                    $kpi_obj = new Kpi();
                    $kpi_obj->set_standard($standard);
                    $kpi_obj->set_kpi_id($kpi->get_id());
                    $kpi_obj->set_name("KPI {$info['code']}");
                    $kpi_obj->set_kpi_info($kpi->get_title());
                    $kpi_obj->set_kpi_ref_num($info['code']);
                    $kpi_obj->set_actual($info['actual_benchmarks']);
                    $kpi_obj->set_target($info['target_benchmarks']);
                    $kpi_obj->set_internal($info['internal_benchmarks']);
                    $kpi_obj->set_external($info['external_benchmarks']);
                    $kpi_obj->set_new_target($info['new_benchmarks']);
                    $children[] = $kpi_obj;
                }
            }
        } else {

        }

        $annexes = new Annexes_List();
        $annexes->set_standard($standard);
        $annexes->set_name("List of Annexes for standard {$standard}");
        $children[] = $annexes;

        return $children;
    }

    public function set_overall_rating($value)
    {
        $property = new \Orm_Property_Smart_Field('overall_rating', $value);
        $property->set_class('Node\ncassr14\Ses_Standard_8_Overall');
        $property->set_function('get_combined_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('Overall Rating');
        $this->set_property($property);
    }

    public function get_overall_rating()
    {
        return $this->get_property('overall_rating')->get_value();
    }

    public function set_financial_resource()
    {
        $property = new \Orm_Property_Fixedtext('financial_resource', 'Financial resources must be sufficient for the effective delivery of the program. Program requirements must be made known sufficiently far in advance to be considered in institutional budgeting. Budgetary processes should allow for long term planning over at least a three year period. Sufficient flexibility must be provided for effective management and responses to unexpected events and this flexibility must be combined with appropriate accountability and reporting mechanisms. <br/>'
            . 'Much of the responsibility for this standard may be institutional rather than program administration. However, the program is responsible to assessing the quality of this standard.     In this standard the effect of financial planning and management arrangements on the program should be analyzed, as well as matters that are carried out by program administrators themselves.');
        $this->set_property($property);
    }

    public function get_financial_resource()
    {
        return $this->get_property('financial_resource')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Describe the processes used to consider quality of performance in relation to this standard.');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description('Provide an explanatory report about recruitment and other employment activities for the following sub-standards');
        $this->set_property($property);
    }

    public function get_explanatory_report()
    {
        return $this->get_property('explanatory_report')->get_value();
    }

    public function set_8_1($value)
    {
        $property = new \Orm_Property_Textarea('8_1', $value);
        $property->set_description('8.1 Financial Planning and Budgeting');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				8.1.1 Proposals for new programs, major program changes or other activities, equipment or facilities are accompanied by business plans, which include independently verified cost estimates and cost impacts on other services and activities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.1.2 If new projects or activities are cross-subsidized from existing funding sources the cost sharing strategy is made clear and intermediate and long term costs and benefits are assessed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.1.3 Financial resources available for the program are sufficient for good quality program provision and benchmarked against costs of equivalent programs at other similar institutions.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				8.1.4 The program coordinator (or department chair or dean) submits annual budget proposals setting out detailed program requirements and follows up as necessary to make adjustments after those proposals have been considered
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				8.1.5 Budget  proposals support strategic priorities for program development and quality improvement and consider possibilities for possible savings or alternative revenue sources as well as seeking additional funding if necessary.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_8_1()
    {
        return $this->get_property('8_1')->get_value();
    }

    public function set_8_2($value)
    {
        $property = new \Orm_Property_Textarea('8_2', $value);
        $property->set_description('8.2 Financial Management');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				8.2.1 Sufficient delegation of spending authority is given to the program manager (or department chair) for effective program administration
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.2.2 Delegations of spending authority are accompanied by appropriate
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.2.3  The program manager/head of department is involved in the budget planning accountability and reporting processes. process, and is held accountable for expenditure within the approved budget.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				8.2.4  The accounting system provides for accurate and continuing monitoring by the program manager of expenditure and commitments against budgets.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				8.2.5  Where possibilities of conflict of interest exist, either actual or perceived, the persons concerned declare their interest and refrain from participation in decisions.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				8.2.6  Allowable financial carry-forward provisions are sufficiently flexible to avoid rushed end of year expenditure or disincentives for long term planning.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_8_2()
    {
        return $this->get_property('8_2')->get_value();
    }

    public function set_evaluation_report($value)
    {
        $property = new \Orm_Property_Textarea('evaluation_report', $value);
        $property->set_description('Evaluation of employment processes for the program.  Refer to evidence about the standard and sub-standards within it and provide a report including a list of strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_evaluation_report()
    {
        return $this->get_property('evaluation_report')->get_value();
    }

}
