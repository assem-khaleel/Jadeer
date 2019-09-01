<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ssri_g_evaluation_8_financial_planning
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation_8_Financial_Planning extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '8. Financial Planning and Management';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_teaching_and_other_staff('');
            $this->set_explanatory_report('');
            $this->set_standard_description('');
            $this->set_report_on_sub_standards('');
            $this->set_8_1('');
            $this->set_8_2('');
            $this->set_8_3('');
            $this->set_quality_mission('');
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
            $KPIs = \Orm_Kpi::get_all(array('standard_id' => $standard_obj->get_id(), 'college_id' => 0));
            if ($KPIs) {
                foreach ($KPIs as $kpi) {

                    $info = $kpi->get_info(\Orm_Kpi_Detail::TYPE_INSTITUTION);

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
            $kpi_1 = new kpi();
            $kpi_1->set_name('KPI S8.1');
            $kpi_1->set_kpi_info('23. Total operating expenditure (other than accommodation and student allowances) per student.');
            $kpi_1->set_kpi_ref_num('S8.1');
            $children[] = $kpi_1;
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
        $property->set_class('Node\ncai14\Ses_Standard_8_Overall');
        $property->set_function('get_combined_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('Overall Rating');
        $this->set_property($property);
    }

    public function get_overall_rating()
    {
        return $this->get_property('overall_rating')->get_value();
    }

    public function set_teaching_and_other_staff()
    {
        $property = new \Orm_Property_Fixedtext('teaching_and_other_staff', "Financial resources must be adequate for the programs and services offered and efficiently managed in keeping with program requirements and institutional priorities.  Effective systems must be used for budgeting and for financial delegations and accountability providing local flexibility, institutional oversight and effective risk management.");
        $this->set_property($property);
    }

    public function get_teaching_and_other_staff()
    {
        return $this->get_property('teaching_and_other_staff')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description("Provide an explanatory report describing budgeting, financial planning and funding submission processes and arrangements for an audit.  The explanation should include a list of financial reports that are prepared.  Information should be given about levels of financial delegation within the institution with reference to other documents that set out institutional policies and regulations relating to these delegations.");
        $this->set_property($property);
    }

    public function get_explanatory_report()
    {
        return $this->get_property('explanatory_report')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Provide a description of the process for the preparation on this standard.');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_report_on_sub_standards()
    {
        $property = new \Orm_Property_Fixedtext('report_on_sub_standard', "<strong>Report on sub-standards</strong> <br/> <br/>");
        $this->set_property($property);
    }

    public function get_report_on_sub_standards()
    {
        return $this->get_property('report_on_sub_standards')->get_value();
    }

    public function set_8_1($value)
    {
        $property = new \Orm_Property_Textarea('8_1', $value);
        $property->set_description('8.1 Financial Planning');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				8.1.1  Budgeting and resource allocation  are aligned with the mission and goals of the institution and strategic planning to achieve those goals.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    8.1.2  Annual budgets are developed within a framework of long term revenue and expenditure projections that are progressively adjusted in the light of experience.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.1.3  Budget proposals are developed by senior academic and administrative staff in consultation with cost center managers, carefully reviewed, and presented to the governing body for approval.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.1.4  Proposals for new programs or major activities, equipment or facilities are accompanied by business plans that include independently verified cost estimates and cost impacts on other services and activities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.1.5  If new ventures are cross-subsidized from existing funding sources the cost sharing strategy is made explicit and intermediate and long term costs and benefits are assessed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.1.6  If loans are used debt and liquidity ratios are monitored and benchmarked against commercial practice and equivalent ratios in other higher education institutions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.1.7  Ratios of expenditure on salaries to total expenditure are planned and monitored, with variations for colleges or departments with different cost structures.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.1.8  Borrowing and other long term financing schemes are used sparingly as a strategic financing strategy to improve capacity rather than to meet unanticipated short term operating costs, with obligations to be met from projected additional revenue, or from known existing revenue sources.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.1.9  Financial planning aims to diversify revenue through a range of activities, which, while consistent with the charter and mission of the institution, reduce its dependence on a single funding source.
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
				8.2.1 The oversight and management of the institution’s budgeting and accounting functions are coordinated by a business or financial office responsible to a senior manager.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    8.2.2 Sufficient delegation of spending authority is given to managers of organizational units within the institution for effective and efficient administration.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.2.3 Financial delegations are clearly specified, and conformity with regulations and reporting requirements confirmed through audit processes.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.2.4 Cost center managers are involved in the budget planning process, and are held accountable for expenditure within approved budgets.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.2.5 The accounting system provides for accurate monitoring of expenditure and commitments against budgets with reports prepared for each cost center and for the institution as a whole at least once every semester.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.2.6 Discrepancies from expenditure estimates are explained and impact on annual budget projections assessed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.2.7 Accounting systems comply with accepted professional accounting standards and as far as possible attribute total cost to particular activities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.2.8 The accounting and reporting systems ensure that funds provided for particular purposes are used for those purposes.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.2.9 Where possibilities of conflict of interest exist, either actual or perceived, the persons concerned declare their interest and refrain from participation in decisions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.2.10 Financial carry-forward provisions are sufficiently flexible to avoid rushed end of year expenditure or disincentives for long term planning.
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

    public function set_8_3($value)
    {
        $property = new \Orm_Property_Textarea('8_3', $value);
        $property->set_description('8.3 Auditing and Risk Management');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				8.3.1 Planning processes include independently verified risk assessment.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    8.3.2 Risk minimization strategies are in place and adequate reserves maintained to meet realistically assessed financial risks.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.3.3 Internal audit processes operate independently of accounting and business managers, reporting directly to the Rector or Dean or chair of the relevant governing board committee.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				8.3.4 External audits are conducted annually by an independent government agency or a reputable external audit firm that is independent of the institution, financial, or other senior staff in the institution, and members of the governing body.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_8_3()
    {
        return $this->get_property('8_3')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Quality of Standard 8.  Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
