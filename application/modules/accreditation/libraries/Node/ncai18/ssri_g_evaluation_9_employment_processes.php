<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ssri_g_evaluation_9_employment_processes
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation_9_Employment_Processes extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '9. Employment Processes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_qualifications_and_experience();
            $this->set_explanatory_report('');
            $this->set_standard_description('');
            $this->set_report_on_sub_standards();
            $this->set_9_1('');
            $this->set_9_2('');
            $this->set_9_3('');
            $this->set_9_4('');
            $this->set_quality_mission('');
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
        $property->set_class('Node\ncai18\Ses_Standard_9_Overall');
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

    public function set_qualifications_and_experience()
    {
        $property = new \Orm_Property_Fixedtext('qualifications_and_experience', 'Teaching and other staff must have the qualifications and experience for effective exercise of their responsibilities and professional development strategies must be followed to ensure continuing improvement in faculty and staff expertise.  Performance of all faculty and staff must be evaluated, with outstanding performance recognized and support provided for improvement where required.  Effective, fair, and transparent processes must be available for the resolution of conflicts and disputes involving faculty and or staff.');
        $this->set_property($property);
    }

    public function get_qualifications_and_experience()
    {
        return $this->get_property('qualifications_and_experience')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description("Provide an explanatory report about the processes for employment and professional development of teaching and other staff.  The explanation should include a description of how colleges and departments are involved in the selection of teaching staff, a description of institutional policies on staff development and promotion, and  indicators used for monitoring the quality of staff management processes throughout the institution,");
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

    public function set_9_1($value)
    {
        $property = new \Orm_Property_Textarea('9_1', $value);
        $property->set_description('9.1 Policy and Administration');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				9.1.1   A desired staffing profile appropriate to the mission and nature of the institution is approved by the governing body.  (The profile includes matters such as age structure, gender balance where relevant, classification levels, qualifications, cultural mix and educational background, and objectives for Saudization.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    9.1.2 A comparison of current teaching and other staff provision with the desired staffing profile is maintained and progress towards that profile is monitored on a continuing basis
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.1.3 A comprehensive set of policies and regulations is established and made widely available in an employment handbook or manual.  (This should include rights and responsibilities of faculty and staff, recruitment processes, supervision, performance evaluation, promotion, counseling and support processes, professional development, and complaints, discipline and appeal procedures.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.1.4 Effective strategies are used for succession planning for senior positions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.1.5 Teaching loads are established equitably across the institution, taking account of the nature of teaching requirements in different fields of study
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.1.6 Promotion policies and processes are clearly documented and fair.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.1.7 The exercise of delegations relating to employment processes is monitored and coordinated to ensure equitable treatment across the institution.  (These delegations may relate to matters such as junior appointments, promotions, rewards for outstanding performance, and professional development opportunities.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.1.8 Indicators of successful administration of staffing and employment policies are clearly specified and performance compared with successful practice elsewhere.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.1.9 The governing board studies annual reports from the person with overall responsibility for employment practices on implementation of policies on staffing and employment practices.
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
        $property->set_description('9.2 Recruitment');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				9.2.1   Recruitment processes are managed to ensure that teaching staff have the specific areas of expertise, and the personal qualities, experience and skill to meet teaching requirements.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.2.2 If a particular appointment can be made either from within or from outside the institution the position is publicly advertised, internal candidates are given adequate opportunity to apply, and judgments made are equitable considering the applicants experience, qualifications, and current levels of performance.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.2.3 Candidates for employment are provided with full position descriptions and conditions of employment, together with general information about the institution and its mission and programs. (The information provided should include details of employment expectations, indicators of performance, and processes of performance evaluation.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.2.4 References are checked, and claims of experience and qualifications verified before appointments are made.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.2.5 Assessment of qualifications includes verification of the standing and reputation of the institutions from which they were obtained, taking account of recognition of qualifications by the Ministry of Higher Education.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.2.6 In professional programs there are  sufficient teaching staff with successful experience in the relevant profession to provide practical advice and guidance to students about work place requirements.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.2.7 New teaching staff are given an effective orientation to ensure familiarity with the institution and its services, programs, and student development strategies, and institutional priorities for development.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.2.8 The level of provision of teaching staff in all programs (ie the ratio of students per teaching staff member calculated as full time equivalents) is adequate for the programs offered and benchmarked against comparable student/teaching staff ratios at good quality Saudi Arabian and international institutions.
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

    public function set_9_3($value)
    {
        $property = new \Orm_Property_Textarea('9_3', $value);
        $property->set_description('9.3 Personal and Career Development');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				9.3.1 Criteria for performance evaluation are clearly specified in advance and made known to teaching and other staff.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.3.2 Consultations about work performance by supervisors (including heads of department, deans, administrative supervisors) are confidential and supportive, and occur on a formal basis at least once each year.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.3.3 If performance is considered less than satisfactory clear requirements are established for improvement.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.3.4 Formal performance assessments of teaching and other staff are kept confidential but are documented and retained.  Teaching and other staff have the opportunity to include on file their own comments relating to these assessments, including points of disagreement.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.3.5 Outstanding academic or administrative performance at any level of the institution is recognized and rewarded.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.3.6 All teaching and other staff should be given appropriate and fair opportunities for personal and career development.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.3.7 Junior teaching and other staff with leadership potential are identified and given a range of experiences to prepare them for future career development.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.3.8 Promotion criteria include contributions to achievement of the mission of the institution, and in the case of teaching staff  include proper recognition of quality of teaching and efforts to improve it, and service to the institution and the community as well as research.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.3.9 Assistance is given in arranging professional development activities to improve skills and upgrade qualifications.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.3.10 Appropriate professional development activities are provided to assist with new programs or policy initiatives.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.3.11 Teaching staff are expected to participate in activities that ensure they keep up to date with developments in their field and the extent to which they do so is monitored.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_9_3()
    {
        return $this->get_property('9_3')->get_value();
    }

    public function set_9_4($value)
    {
        $property = new \Orm_Property_Textarea('9_4', $value);
        $property->set_description('9.4 Discipline, Complaints and Dispute Resolution');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				9.4.1 Procedures for dealing with complaints about or  by teaching or other staff, and resolving disputes among them, are clearly specified in policies and regulations.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.4.2 The normal initial step in resolving disputes that cannot be settled by those directly involved is through conciliation by a person independent of the issue, with the possibility if required for referral to a committee or senior officer for determination.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.4.3 Disciplinary processes for neglect of responsibilities, failure to comply with instructions, or inappropriate behavior, are clearly specified in regulations and consistently followed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.4.4 The regulations provide for rights of appeal against decisions to a person or committee at least one level beyond that at which the dispute occurs.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				9.4.5 Serious disputes are addressed through quasi-judicial processes including provision and verification of evidence and impartial judgments by a person or persons experienced in such procedures.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_9_4()
    {
        return $this->get_property('9_4')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Quality Standard 9.areport  Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
