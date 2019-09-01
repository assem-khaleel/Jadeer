<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_2
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 2. Program Administration';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_program_leadership();
            $this->set_standard_description('');
            $this->set_explanatory_report('');
            $this->set_2_1('');
            $this->set_2_2('');
            $this->set_2_3('');
            $this->set_2_4('');
            $this->set_2_5('');
            $this->set_quality_mission('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 2;
        $standard_obj = \Orm_Standard::get_one(['code' => 2]);

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
            $kpi_1->set_name('KPI S2.1');
            $kpi_1->set_kpi_info('2. Stakeholder evaluation of the Policy Handbook, including administrative flow chart and job responsibilities (Average rating on the adequacy of the Policy Handbook on a five- point scale in an annual survey of teaching staff and final year students).');
            $kpi_1->set_kpi_ref_num('S2.1');
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
        $property->set_description('Overall Rating');
        $property->set_class('Node\ncassr18\Ses_Standard_2_Overall');
        $property->set_function('get_combined_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $this->set_property($property);
    }

    public function get_overall_rating()
    {
        return $this->get_property('overall_rating')->get_value();
    }

    public function set_program_leadership()
    {
        $property = new \Orm_Property_Fixedtext('program_leadership', 'Program administration must provide effective leadership and reflect an appropriate balance between accountability to senior management and the governing board of the institution within which the program is offered, and flexibility to meet the specific requirements of the program concerned.  Planning processes must involve stakeholders (e.g. students, professional bodies, industry representatives, teaching staff) in establishing goals and objectives and reviewing and responding to results achieved. If a program is offered in sections for male and female students resources for the program must be comparable in both sections, there must be effective communication between them, and full involvement in planning and decision making processes. The quality of delivery of courses and the program as a whole must be regularly monitored with adjustments made promptly in response to this feedback and to developments in the external environment affecting the program');
        $this->set_property($property);
    }

    public function get_program_leadership()
    {
        return $this->get_property('program_leadership')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Provide a description of the process for investigation and preparation of the report.');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description('Provide an explanatory report about the development and use of the program administration for each of the following sub-standards');
        $this->set_property($property);
    }

    public function get_explanatory_report()
    {
        return $this->get_property('explanatory_report')->get_value();
    }

    public function set_2_1($value)
    {
        $property = new \Orm_Property_Textarea('2_1', $value);
        $property->set_description('2.1 Leadership');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.1.1  The responsibilities of program administrators are clearly defined in position descriptions
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.2 There is sufficient flexibility at the level of the department or college offering the program to respond rapidly to course and program evaluations and changes in program learning outcome requirements, (eg. Departments should have delegated authority to change text and reference lists, modify planned teaching strategies, details of assessment tasks and updating of course content as far as possible subject to conditions set by the university council or other responsible authority.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.1.3 Program administrators anticipate issues and opportunities and exercise initiative in response.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.1.4  Program administrators ensure that when action is needed it is taken in an effective and timely manner.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.1.5   Program administrators have sufficient authority to ensure compliance with formally established or agreed institutional or program policies and procedures.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.1.6  Program administrators provide leadership, and encourage and reward  initiative on the part of teaching and other staff.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.1.7 Program managers accept responsibility for the effectiveness of action taken within their area of responsibility regardless of whether that action is taken by them personally or by others responsible to them.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.1.8 Regular feedback is given on performance of  teaching and other staff  by the head of the department
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.1.9 Delegations of responsibility to program administrators are formally specified in documents signed by the person delegating and the person given delegated authority, that describe clearly the limits of delegated responsibility and responsibility for reporting on decisions made.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.1.10 Regulations governing delegations of authority are established for the institution and approved by the governing board.  These regulations indicate key functions that cannot be delegated, and specify that delegation of authority to another person or organization does not remove responsibility for consequences of decisions made from the person giving the delegation.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.1.11 Advice and support are made available to faculty and staff  in a manner that contributes to their personal and  professional development
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.1.12  Proposals for program developments and recommendations on policy issues are presented to the appropriate decision making body in a form that clearly identifies the issues for decision and the consequences of alternatives.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_1()
    {
        return $this->get_property('2_1')->get_value();
    }

    public function set_2_2($value)
    {
        $property = new \Orm_Property_Textarea('2_2', $value);
        $property->set_description('2.2 Planning Processes');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.2.1  Planning is strategic, incorporating priorities for development and appropriate sequencing of action to produce the most effective short-term and long term-results.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.2  Plans take full and realistic account of aspects of the external environment affecting demand for graduates and skills required by them.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.2.3  Planning processes provide for appropriate levels of involvement by teaching and other staff, students and other stakeholders.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.2.4 Planning has a particular focus on intended learning outcomes for students with course content and teaching and assessment strategies that reflect both the background of students and theory and research on different kinds of learning.  (For advice on the planning of new programs and review and documentation of existing programs refer to Section 2.4.7 in Handbook for Quality Assurance and Accreditation in Saudi Arabia Part 2, Internal Quality Assurance Arrangements.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.2.5 Plans are effectively communicated to all concerned with impacts and requirements for different constituencies made clear
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.2.6 Implementation of plans is monitored with checks made against short term and medium term targets, and outcomes evaluated.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.2.7  Planning provides for reports on key performance indicators to be made on a regular basis to senior management within the institution.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.2.8  Plans are reviewed, adapted and modified, with corrective action taken as required in response to operational developments, formative evaluation, and changing circumstances.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.2.9  Risk management is included as an integral component of planning strategies with appropriate mechanisms developed for risk assessment and minimization.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_2()
    {
        return $this->get_property('2_2')->get_value();
    }

    public function set_2_3($value)
    {
        $property = new \Orm_Property_Textarea('2_3', $value);
        $property->set_description('2.3 Relationship Between Sections for Male and Female Students');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.3.1  In sections for male and female students resources, facilities and staffing provisions are provided at comparable levels.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.3.2  Program administrators in both sections and staff teaching the same courses are fully involved in planning and reporting processes and communicate regularly about the program through processes that are consistent with bylaws and regulations of the Higher Council of Education.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.3.3 Male and female sections are adequately represented in the membership of relevant committees and councils.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.3.4 Plans for the program and course specifications require the same standards of delivery and are consistent for both sections, subject to any appropriate variations to meet differing needs of students.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.3.5 Performance indicators and reports on courses and programs show results for each section, and also overall results for the program as a whole.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_3()
    {
        return $this->get_property('2_3')->get_value();
    }

    public function set_2_4($value)
    {
        $property = new \Orm_Property_Textarea('2_4', $value);
        $property->set_description('2.4 Integrity');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.4.1  Codes of practice for ethical and responsible behaviour have been developed and are followed dealing with matters such as the conduct and reporting on research, performance evaluation, student assessment, committee decision making, and the conduct of administrative and service activities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.4.2  Regulations dealing with declarations of pecuniary interest or conflict of interest for faculty and staff are consistently followed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.4.3   Advertising and promotional material are always truthful, avoid any actual or implied misrepresentations or exaggerated claims, or negative comments about other programs or institutions.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_4()
    {
        return $this->get_property('2_4')->get_value();
    }

    public function set_2_5($value)
    {
        $property = new \Orm_Property_Textarea('2_5', $value);
        $property->set_description('2.5 Internal Policies and Regulations');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				2.5.1   The terms of reference and operating procedures for major committees and academic and administrative positions associated with the program are clearly specified and included in the policy and procedures manual.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.5.2  Policies and regulations relating to the program are made accessible to faculty, staff and students, and effective strategies are used to ensure they are understood and complied with.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				2.5.3  Decisions made by committees on procedural or academic matters are recorded and referred to when future similar issues are considered.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.5.4 Guidelines, bylaws or regulations are established for recurring procedural or academic issues.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				2.5.5 The policies and regulations for the management of the program are periodically reviewed and amended as required in the light of changing circumstances.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_2_5()
    {
        return $this->get_property('2_5')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Quality of Program Administration.  Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
