<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ssri_g_evaluation_1_mission
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation_1_Mission extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '1. Mission and Objectives';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_institution_missions();
            $this->set_explanatory_report('');
            $this->set_standard_description('');
            $this->set_report_on_sub_standards();
            $this->set_1_1('');
            $this->set_1_2('');
            $this->set_1_3('');
            $this->set_1_4('');
            $this->set_1_5('');
            $this->set_quality_mission('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes() {

        $standard = 1;
        $standard_obj = \Orm_Standard::get_one(['code' => 1]);

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
            $kpi_1->set_name('KPI S1.1');
            $kpi_1->set_kpi_info('1. Stakeholders awareness ratings of the Mission Statement and Objectives (Average rating on how well the mission is known to teaching staff, and undergraduate and graduate students, respectively, on a five- point scale in an annual survey).');
            $kpi_1->set_kpi_ref_num('S1.1');
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
        $property->set_class('Node\ncai18\Ses_Standard_1_Overall');
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

    public function set_institution_missions()
    {
        $property = new \Orm_Property_Fixedtext('institution_missions', "The institution's mission statement must clearly and appropriately define its principal purposes and priorities and be influential in guiding planning and action within the institution.");
        $this->set_property($property);
    }

    public function get_institution_missions()
    {
        return $this->get_property('institution_missions')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description('Provide an explanatory report about the development and use of the mission.');
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

    public function set_1_1($value)
    {
        $property = new \Orm_Property_Textarea('1_1', $value);
        $property->set_description('1.1 Appropriateness of the Mission');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				1.1.1 The mission statement is consistent with the establishment charter of the institution.(including any objectives or purposes in by-laws, company objectives or comparable documents)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.1.2 The mission statement is appropriate for an institution of its type. (eg a small private college, a research university, a girls college in a regional community, etc.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.1.3 The mission statement is consistent with Islamic beliefs and values.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				1.1.4 The mission is relevant to needs of the community or communities served by the institution
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				1.1.5 The mission is consistent with the economic and cultural requirements of the Kingdom of Saudi Arabia.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				1.1.6 The appropriateness of the mission is explained to stakeholders in an accompanying statement commenting on significant aspects of the environment within which it operates. (which may relate to local, national or international issues)
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_1_1()
    {
        return $this->get_property('1_1')->get_value();
    }

    public function set_1_2($value)
    {
        $property = new \Orm_Property_Textarea('1_2', $value);
        $property->set_description('1.2 Usefulness  of the Mission Statement');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				1.2.1 The mission statement is sufficiently specific to provide an effective guide to decision-making and choices among alternative planning strategies.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.2.2 The mission statement is relevant to all of the institution’s important activities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.2.3 The mission is achievable through effective strategies within the level of resources expected to be available.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				1.2.4 The mission statement is clear enough to provide criteria for evaluation of the institution’s progress towards its goals and objectives.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_1_2()
    {
        return $this->get_property('1_2')->get_value();
    }

    public function set_1_3($value)
    {
        $property = new \Orm_Property_Textarea('1_3', $value);
        $property->set_description('1.3 Development and Review of the Mission');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				1.3.1 Major stakeholders within the institution and the communities it serves have been consulted and support the mission.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.3.2 The governing body of the institution formally approved the mission statement.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.3.3 The governing body periodically reviews the mission statement and confirms or amends it in the light of changing circumstances.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				1.3.4  Stakeholders are kept informed about the mission and any changes in it.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_1_3()
    {
        return $this->get_property('1_3')->get_value();
    }

    public function set_1_4($value)
    {
        $property = new \Orm_Property_Textarea('1_4', $value);
        $property->set_description('1.4 Use Made of the Mission Statement');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				1.4.1 The mission is used as a basis for a strategic plan over a medium term planning period. (eg. five years)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.4.2 The mission is widely publicised, known about and supported by teaching and other staff and students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.4.3 The mission is used consistently as a guide in resource allocations and consideration of major program and project proposals and policy decisions.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_1_4()
    {
        return $this->get_property('1_4')->get_value();
    }

    public function set_1_5($value)
    {
        $property = new \Orm_Property_Textarea('1_5', $value);
        $property->set_description('1.5 Relationship Between Mission and Goals and Objectives');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				1.5.1 Medium and long term goals for the development of the institution and its programs and organizational units are consistent with and support the mission.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.5.2 Goals are stated with sufficient clarity to effectively guide planning and decision-making in ways that are consistent with the mission.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.5.3  Goals and objectives are periodically reviewed and reaffirmed or modified as necessary in the light of changing circumstances to ensure they continue to support the mission.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.5.4  Specific objectives for total institutional initiatives and for internal organizational units are consistent with the mission and broad goals for development.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.5.5  Statements of major objectives are accompanied by specification of clearly defined and measurable indicators that are used to judge the extent to which objectives and the mission are being achieved.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_1_5()
    {
        return $this->get_property('1_5')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Quality Standard 1.  Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
