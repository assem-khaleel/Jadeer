<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_h_standard_9
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_9 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 9. Employment Processes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_knowledge_and_experience('');
            $this->set_standard_description('');
            $this->set_explanatory_report('');
            $this->set_9_1('');
            $this->set_9_2('');
            $this->set_evaluation_report('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 9;
        $standard_obj = \Orm_Standard::get_one(['code' => 9]);

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
            $kpi_1 = new kpi();
            $kpi_1->set_name('KPI S9.1');
            $kpi_1->set_kpi_info('24. Proportion of teaching staff leaving the institution in the past year for reasons other than age retirement.');
            $kpi_1->set_kpi_ref_num('S9.1');
            $children[] = $kpi_1;

            $kpi_2 = new kpi();
            $kpi_2->set_name('KPI S9.2');
            $kpi_2->set_kpi_info('25. Proportion of teaching staff participating in professional development activities during the past year.');
            $kpi_2->set_kpi_ref_num('S9.2');
            $children[] = $kpi_2;
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
        $property->set_class('Node\ncassr14\Ses_Standard_9_Overall');
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

    public function set_knowledge_and_experience()
    {
        $property = new \Orm_Property_Fixedtext('knowledge_and_experience', 'Teaching and other staff must have the knowledge and experience needed for their particular teaching or other responsibilities and their qualifications and experience must be verified before appointment.  New teaching staff must be thoroughly briefed about the program and their teaching responsibilities before they begin. Performance of all teaching and other staff must be periodically evaluated, with outstanding performance recognized and support provided for professional development and improvement in teaching skills. <br/>'
            . 'Much of the responsibility for this standard may be institutional rather than program administration. However, the program is responsible to assessing the quality of this standard. In this standard analysis should be made on employment matters that affect the quality of the program. These matters include the appointment of appropriately qualified faculty, their participation in relevant professional development and scholarly activities, and their preparation for participation in the program.');
        $this->set_property($property);
    }

    public function get_knowledge_and_experience()
    {
        return $this->get_property('knowledge_and_experience')->get_value();
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

    public function set_9_1($value)
    {
        $property = new \Orm_Property_Textarea('9_1', $value);
        $property->set_description('9.1 Recruitment');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				9.1.1 Recruitment processes ensure that teaching  staff  have  the specific areas of expertise, and  the personal qualities, experience and skill to meet teaching requirements.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.1.2 Candidates for employment are provided with full position descriptions and conditions of employment, together with specific information about expectations for contributing to the program as part of the teaching team. (The information provided should include details of employment expectations, indicators of performance, and processes of performance evaluation.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.1.3 References are checked, and claims of experience and qualifications verified before appointments are made.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.1.4 Assessment of qualifications includes verification of the standing and reputation of the institutions from which they were obtained, taking account of recognition of qualifications by the Ministry of Higher Education.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.1.5 In professional programs there are  sufficient teaching staff with successful experience in the relevant profession to provide practical advice and guidance to students about work place requirements.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.1.6 New teaching staff are given an effective orientation to the institution to ensure familiarity with the institution and its operating procedures, services and priorities for development.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.1.7 New teaching staff are given a thorough orientation to the program to ensure they have a thorough understanding of the program as a whole, of the contributions to be made to it through the courses they teach, and of the expectations for coordinated planning and delivery of courses and evaluation and reporting requirements.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.1.8 The level of provision of teaching staff (i.e. the ratio of students per teaching staff member calculated as full time equivalents) is adequate for the program and benchmarked against comparable student/teaching staff ratios at good quality Saudi Arabian and international institutions.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_9_1()
    {
        return $this->get_property('9_1')->get_value();
    }

    public function set_9_2($value)
    {
        $property = new \Orm_Property_Textarea('9_2', $value);
        $property->set_description('9.2 Personal and Career Development');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				9.2.1 Criteria for performance evaluation are clearly specified in advance and made known to teaching and other staff.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.2.2 Consultations about work performance are confidential and supportive, and occur on a formal basis at least once each year.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.2.3 If performance is considered less than satisfactory clear requirements are established for improvement.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.2.4 Formal performance assessments of teaching and other staff are kept confidential but are documented and retained.  Faculty and staff have the opportunity to include on file their own comments relating to these assessments, including points of disagreement.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.2.5 Outstanding academic or administrative performance is recognized and rewarded.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.2.6 All teaching and other staff are given appropriate and fair opportunities for personal and career development.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.2.7 Junior teaching and other staff with leadership potential are identified and given a range of experiences to prepare them for future career development.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.2.8 Assistance is given in arranging professional development activities to improve skills and upgrade qualifications.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.2.9 Appropriate professional development activities are provided to assist with new programs or policy initiatives.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				9.2.10 Teaching staff are expected to participate in activities that ensure they keep up to date with developments in their field and the extent to which they do so is monitored.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_9_2()
    {
        return $this->get_property('9_2')->get_value();
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
