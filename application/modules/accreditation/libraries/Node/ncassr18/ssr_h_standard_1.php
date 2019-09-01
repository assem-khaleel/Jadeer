<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_1
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 1. Mission and Objectives';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_program_mission();
            $this->set_standard_description('');
            $this->set_explanatory_report('');
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
    public function get_children_nodes()
    {

        $standard = 1;
        $standard_obj = \Orm_Standard::get_one(['code' => 1]);

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
            $kpi_1 = new Kpi();
            $kpi_1->set_name('KPI S1.1');
            $kpi_1->set_kpi_info("1. Stakeholders' awareness ratings of the Mission Statement and Objectives (Average rating on how well the mission is known to teaching staff, and undergraduate and graduate students, respectively, on a five- point scale in an annual survey)");
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
        $property->set_class('Node\ncassr18\Ses_Standard_1_Overall');
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

    public function set_program_mission()
    {
        $property = new \Orm_Property_Fixedtext('program_mission', 'The mission of the program must be consistent with that for the institution and apply that mission to the particular goals and requirements of the program concerned.  It must clearly and appropriately define the program’s principal purposes and priorities and be influential in guiding planning and action.');
        $this->set_property($property);
    }

    public function get_program_mission()
    {
        return $this->get_property('program_mission')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Provide a description of the process for investigation and preparation of report on this standard.');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description('Provide an explanatory report about the development and use of the mission for each of the following sub-standards:');
        $this->set_property($property);
    }

    public function get_explanatory_report()
    {
        return $this->get_property('explanatory_report')->get_value();
    }

    public function set_1_1($value)
    {
        $property = new \Orm_Property_Textarea('1_1', $value);
        $property->set_description('1.1 Appropriateness of the Mission');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				1.1.1 The mission for the program is consistent with the mission of the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.1.2 The mission establishes directions for the development of the program that are appropriate for a program of its type and for the needs of students in the context for which they are prepared.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.1.3 The mission is consistent with Islamic beliefs and values.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				1.1.4 The appropriateness of the mission is explained in an accompanying statement commenting on significant aspects of the environment within which it operates. (which may relate to local, national or international issues)
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
        $property->set_description('1.2 Usefulness of the Mission Statement');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				1.2.1 The mission statement is sufficiently specific to provide an effective guide to decision-making and choices among alternative planning strategies.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.2.2 The mission is achievable through effective strategies within the level of resources expected to be available.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.2.3 The mission statement provides clear criteria for evaluation of progress towards the goals and objectives of the program.
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
				1.3.1 Major stakeholders associated with the program have been consulted and support the mission.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.3.2 The decision making body responsible for approving the program within the institution formally approved the mission statement.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.3.3 The mission statement is periodically reaffirmed or amended if necessary in the light of changing circumstances.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				1.3.4  Stakeholders are kept informed about the mission and any changes made to it.
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
        $property->set_description('1.4 Use Made of the Mission');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				1.4.1 The mission statement is used as a basis for a strategic plan for development of the program over a medium term planning period. (normally five to seven years)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.4.2 The mission statement is known about and supported by teaching and other staff and students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.4.3 Consistency with the mission is listed among criteria for consideration of program and project proposals by committees and decision makers.
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
        $property->set_description('1.5 Relationship Between Mission, Goals, and Objectives');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				1.5.1 Goals for development of the program are consistent with and support the mission.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.5.2 Goals are stated with sufficient clarity to effectively guide planning and decision-making in ways that are consistent with the mission.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				1.5.3  Goals and objectives for the development of the program are reviewed periodically and modified if necessary in response to results achieved and changing circumstances.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				1.5.4  Statements of major objectives should be accompanied by specification of clearly defined and measurable indicators that are used to judge the extent to which objectives are being achieved.
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
        $property->set_description('Overall Evaluation of Quality of Mission, Goals and Objectives.  Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
