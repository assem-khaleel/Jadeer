<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ssri_g_evaluation_4_learning_and_teaching
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation_4_Learning_And_Teaching extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4. Learning and Teaching.';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_effective_system();
            $this->set_info();
            $this->set_standard_description('');
            $this->set_report_on_sub_standards();
            $this->set_4_1('');
            $this->set_4_2('');
            $this->set_4_3('');
            $this->set_4_4('');
            $this->set_4_5('');
            $this->set_4_6('');
            $this->set_4_7('');
            $this->set_4_8('');
            $this->set_4_9('');
            $this->set_4_10('');
            $this->set_4_11('');
            $this->set_quality_mission('');
            $this->set_general_conclusion('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 4;
        $standard_obj = \Orm_Standard::get_one(['code' => 4]);

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
            $kpi_1->set_name('KPI S4.1');
            $kpi_1->set_kpi_info('7. Ratio of students to teaching staff. (Based on full time equivalents)');
            $kpi_1->set_kpi_ref_num('S4.1');
            $children[] = $kpi_1;

            $kpi_2 = new kpi();
            $kpi_2->set_name('KPI S4.2');
            $kpi_2->set_kpi_info('8. Students overall rating on the quality of their courses. (Average rating of students on a five point scale on overall evaluation of courses.)');
            $kpi_2->set_kpi_ref_num('S4.2');
            $children[] = $kpi_2;

            $kpi_3 = new kpi();
            $kpi_3->set_name('KPI S4.3');
            $kpi_3->set_kpi_info('9. Proportion of teaching staff with verified doctoral qualifications.');
            $kpi_3->set_kpi_ref_num('S4.3');
            $children[] = $kpi_3;

            $kpi_4 = new kpi();
            $kpi_4->set_name('KPI S4.4');
            $kpi_4->set_kpi_info('Retention Rate; <br/> 10. Percentage of students entering programs who successfully complete first year.');
            $kpi_4->set_kpi_ref_num('S4.4');
            $children[] = $kpi_4;

            $kpi_5 = new kpi();
            $kpi_5->set_name('KPI S4.5');
            $kpi_5->set_kpi_info('Graduation Rate for Undergraduate Students: <br/> 11. Proportion of students entering undergraduate programs who complete those programs in minimum time.');
            $kpi_5->set_kpi_ref_num('S4.5');
            $children[] = $kpi_5;

            $kpi_6 = new kpi();
            $kpi_6->set_name('KPI S4.6');
            $kpi_6->set_kpi_info('Graduation Rates for Post Graduate Students: <br/> 12. Proportion of students entering post graduate programs who complete those programs in specified time.');
            $kpi_6->set_kpi_ref_num('S4.6');
            $children[] = $kpi_6;

            $kpi_7 = new kpi();
            $kpi_7->set_name('KPI S4.7');
            $kpi_7->set_kpi_info('13. Proportion of graduates from undergraduate programs who within six months of graduation are: <br/> (a) employed <br/> (b) enrolled in further study <br/> (c) not seeking employment or further study');
            $kpi_7->set_kpi_ref_num('S4.7');
            $children[] = $kpi_7;
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
        $property->set_class('Node\ncai18\Ses_Standard_4_Overall');
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

    public function set_effective_system()
    {
        $property = new \Orm_Property_Fixedtext('effective_system', 'The institution must have an effective system for ensuring that all programs meet high standards of learning and teaching through initial approvals on their plans, monitoring of performance, and provision of institution-wide support services. In all programs student learning outcomes must be clearly specified, consistent with the National Qualifications Framework and (for professional programs) requirements for employment or professional practice. Standards of learning must be assessed and verified through appropriate processes and benchmarked against demanding and relevant external reference points.  Teaching staff must be appropriately qualified and experienced for their particular teaching responsibilities, use teaching strategies appropriate for different kinds of learning outcomes, and participate in activities to improve their teaching effectiveness.  Teaching quality and the effectiveness of programs must be evaluated through student assessments and graduate and employer surveys, with feedback used as a basis for plans for improvement.');
        $this->set_property($property);
    }

    public function get_effective_system()
    {
        return $this->get_property('effective_system')->get_value();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Note: See Periodic Program Profiles, Program Specifications, and Annual Program Reports. The institution should demonstrate that these reports are complete and current. Based on a summary and analysis of these documents, the institution should proceed to complete its report on this standard and the sub-standards.</strong>'
            . ' <br/> <br/><strong>Note: For Standard 4 the institution must provide 5 or more KPI tables to demonstrate quality assurance. KPI tables are required for sub-standards 4.2, 4.5, and 4.7. Copy and paste additional tables and place them in the SSRI in the appropriate sub-standard. </strong>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
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
        $property = new \Orm_Property_Fixedtext('report_on_sub_standard', "<strong>Report on sub-standards <br/> <br/>(In sub-standard 4.1 a description should be given of the institution’s processes for oversight of quality of learning and teaching.  In each other sub-standard include an explanatory statement describing what is done throughout the institution.  If common procedures are not followed this should be indicated and an explanation given of major variations and how the institution as a whole monitors quality of performance.)</strong>");
        $this->set_property($property);
    }

    public function get_report_on_sub_standards()
    {
        return $this->get_property('report_on_sub_standards')->get_value();
    }

    public function set_4_1($value)
    {
        $property = new \Orm_Property_Textarea('4_1', $value);
        $property->set_description('4.1 Institutional Oversight of Quality of Learning and Teaching');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				4.1.1  New program proposals and proposals for major changes in programs are thoroughly evaluated and approved by the institution’s senior academic committee.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.1.2  The evaluation of new programs or major changes in programs by the senior academic committee includes consideration of  the matters described in the standard for learning and teaching, including any special requirements applicable to the field of study concerned and requirements for graduates in that field  in Saudi Arabia.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.1.3   Guidelines are established defining the levels for reviewing indicators and reports on courses and programs. (for example a head of department might consider course reports for all courses and a departmental committee approve minor changes to keep courses up to date. A dean might consider program reports that include summary information about courses. The vice rector responsible for academic affairs, the quality committee and the senior academic committee might consider a general summary of program reports and data on key performance indicators, and approve more significant changes in programs.)  (See also section 2.2.4)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.1.4  Guidelines have been established defining the levels for approval of changes in courses and programs.  Minor changes required to keep programs up to date and respond to course and program evaluations should be made flexibly and rapidly at departmental level and more substantial changes referred to the relevant senior committees for approval.(Note that these approvals for changes in courses and programs  in sections 4.1.3 and 4.1.4 are under delegations from the university council or other responsible authority and are subject to conditions and constraints that may be set by that council or authority.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.1.5 Data on key performance indicators for all programs are reviewed at least annually by senior administrators responsible for academic affairs, the institution’s quality committee and the institution’s senior academic committee, with overall institutional performance reported to the governing board.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.1.6  Annual reports are prepared for all programs, and reviewed by department/college committees, with appropriate action taken in response to recommendations in those reports.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.1.7  Self evaluations using the self evaluation scales for higher education programs are undertaken periodically (eg. every two or three years) for each program and reports prepared for consideration by the quality committee and the relevant academic committees.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.1.8 Reports on the overall quality of teaching and learning for the institution as a whole are prepared periodically (eg. every three years) indicating common strengths and weaknesses, and significant variations in quality between programs/departments and sections.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.1.9  Reports by departments to their college, or by departments or colleges to the central administration, are acknowledged with responses made to any queries or proposals made.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.1.10 The senior administrator responsible for academic affairs takes responsibility, in cooperation with the quality committee and deans/heads of department, for developing and implementing strategies for improvement to deal with common issues affecting programs across the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.1.11  Colleges/departments cooperate with and  participate in general institutional strategies for improvement, and arrange complementary further initiatives to deal with quality issues found in their own programs.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.1.12 If programs are offered in different sections, including sections for male and female students, or in branch campuses, the standards of learning outcomes, the resources provided (including learning resources and staffing provisions and resources to undertake research) should be comparable in all sections.  Data used for evaluations and performance indicators should be provided for all sections as well as for the programs in total.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_4_1()
    {
        return $this->get_property('4_1')->get_value();
    }

    public function set_4_2($value)
    {
        $property = new \Orm_Property_Textarea('4_2', $value);
        $property->set_description('4.2 Student Learning Outcomes (for all Programs)');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				4.2.1 Intended learning outcomes are specified after consideration of relevant academic and professional advice.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.2.2 Intended learning outcomes are consistent with the Qualifications Framework. (covering all of the domains of learning at the standards required).
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.2.3    Intended learning outcomes are consistent with requirements for professional practice in Saudi Arabia in the fields concerned. (These requirements should include local accreditation requirements and also take account of international accreditation requirements for that field of study, and any Saudi Arabian regulations or regional needs)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.2.4 If an institution has identified special attributes to be developed in students graduating from the institution comprehensive strategies are established for these to be developed.  (This means that the attributes to be developed in students are clearly defined, strategies for developing them planned and implemented across all programs, and mechanisms for assessing and reporting on the extent to which graduating students have developed them are in place.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.2.5   Appropriate program evaluation mechanisms, including graduating student surveys, employment outcome data, employer feedback and subsequent performance of graduates, are  used to provide evidence about the appropriateness of  intended learning outcomes and the extent to which they are achieved.  (see also sections 4.3 and 4.5.2 dealing with processes for program evaluation  and verification of standards of student achievement)
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_4_2()
    {
        return $this->get_property('4_2')->get_value();
    }

    public function set_4_3($value)
    {
        $property = new \Orm_Property_Textarea('4_3', $value);
        $property->set_description('4.3 Program Development Processes');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				4.3.1  Plans for the delivery of programs and for their evaluation are set out in detailed program specifications. (These should include knowledge and skills to be acquired, and strategies for teaching and assessment for the progressive development of learning in all the domains of learning.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.3.2  Plans for courses are set out in course specifications that include knowledge and skills to be acquired and strategies for teaching and assessment for the domains of learning to be addressed in each course.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.3.3  The content and strategies set out in course specifications are coordinated to ensure effective progressive development of learning for the total program in all the domains of learning.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.3.4  Planning includes any actions necessary to ensure that teaching staff are familiar with and are able to use the strategies included in the program and course specifications.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.3.5  The academic or professional fields for which students are being prepared are monitored on a continuing basis with necessary adjustments made in programs and in text and reference materials to ensure continuing relevance and quality.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.3.6  In  professional programs practitioners from the relevant occupations or professions  are included in continuing advisory committees that monitor and advise on content and quality of programs.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.3.7  New program proposals are assessed and approved or rejected by the institution’s senior academic committee using criteria that ensure thorough and appropriate consultation in planning and capacity for effective implementation.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_4_3()
    {
        return $this->get_property('4_3')->get_value();
    }

    public function set_4_4($value)
    {
        $property = new \Orm_Property_Textarea('4_4', $value);
        $property->set_description('4.4 Program Evaluation and Review Processes');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				4.4.1  Courses and programs are evaluated and reported on annually and  reports include information about the effectiveness of planned strategies and the extent to which intended learning outcomes are being achieved.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.4.2   When changes are made as a result of evaluations details of those changes and the reasons for them should be retained in course and program portfolios.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.4.3  Quality indicators that include learning outcome measures are used for all courses and programs.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.4.4  Records of student completion rates are kept for all courses and for programs as a whole and included among quality indicators.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.4.5  Reports on programs are  reviewed annually by senior administrators and quality committees.  (See also  item 4.1 3 relating to the level of detail for these reports at different levels of academic administration)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.4.6  Systems have been established for central recording and analysis of course completion and program progression and completion rates and student course and program evaluations, with summaries and comparative data distributed automatically to departments, colleges, senior administrators and relevant committees at least once each year.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.4.7  If problems are found through program evaluations appropriate action is taken to make improvements, either within the program concerned or through institutional action as appropriate.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.4.8 In addition to annual evaluations a comprehensive reassessment of every program is conducted at least once every five years.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.4.9 Program reviews involve experienced people from relevant industries and professions, and experienced teaching staff from other institutions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.4.10  In program reviews  opinions about the quality of the program including the extent to which intended learning outcomes are achieved is sought from students and graduates through surveys and interviews, discussions with teaching staff, and other stakeholders such
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_4_4()
    {
        return $this->get_property('4_4')->get_value();
    }

    public function set_4_5($value)
    {
        $property = new \Orm_Property_Textarea('4_5', $value);
        $property->set_description('4.5 Student Assessment');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				4.5.1  Student assessment mechanisms are appropriate for the forms of learning sought.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.5.2  Assessment processes are clearly communicated to students at the beginning of courses.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.5.3  Appropriate, valid and reliable mechanisms are used in programs throughout the institution for verifying standards of student achievement in relation to relevant internal and external benchmarks.    The standard of work required for different grades should be consistent over time, comparable in courses offered within a program and college and the institution as a whole, and in comparison with other highly regarded institutions. (Arrangements for verifying standards may include measures such as check marking of random samples of student work by teaching staff at other institutions, and independent comparisons of standards achieved with  other comparable institutions within Saudi Arabia, and internationally.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.5.4  Grading of students tests, assignments and projects is assisted by the use of matrices or other means to ensure that the planned range of domains of student learning outcomes are addressed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.5.5 Arrangements are made within the institution for training of teaching staff in the theory and practice of student assessment.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.5.6  Appropriate procedures are followed to deal with situations where standards of student achievement are inadequate or inconsistently assessed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.5.7   Effective procedures are followed that ensure that work submitted by students is actually done by the students concerned.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.5.8   Feedback to students on their performance and results of assessments during each semester is given promptly and accompanied by mechanisms for assistance if needed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.5.9  Assessments of students work are conducted fairly and objectively.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.5.10 Criteria and processes for academic appeals are made known to students and administered equitably   (see also item 5.3)
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_4_5()
    {
        return $this->get_property('4_5')->get_value();
    }

    public function set_4_6($value)
    {
        $property = new \Orm_Property_Textarea('4_6', $value);
        $property->set_description('4.6 Educational Assistance for Students');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				4.6.1  Teaching staff are available at sufficient scheduled times for consultation and advice to students.  (this is confirmed, not simply scheduled, and if there are part time as well as full time students the scheduled times provide for access by both groups)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.2 Teaching resources (including staffing, learning resources and equipment, and clinical or other field placements) should be sufficient to ensure achievement of the intended learning outcomes.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.3 If arrangements for student academic counselling and advice include electronic communications through email or other means the effectiveness of those processes is  evaluated through means such as analysis of response times and student evaluations.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.4  Adequate tutorial assistance is provided to ensure understanding and ability to apply learning.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.5  Appropriate preparatory and orientation mechanisms are used  to prepare students for study in a higher education environment.  Particular attention is given to preparation for the language of instruction, self directed learning, and transition programs if necessary for students transferring to the institution with credit for previous studies.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.6   Preparatory studies are not counted within the credit hours for the programs that follow.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.7   For any programs in which the language of instruction is not Arabic, action is taken to ensure that language skills are adequate for instruction in that language before students begin their higher education studies.  (This may be done through language training prior to admission to the program.  Language skills expected on entry should be benchmarked against other highly regarded institutions with the objective of skills at least comparable to minimum requirements for admission of international students in universities in countries where that language is the native language.   (Verification of standards should involve testing of at least a representative sample of students on a major recognized language test.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.8  If preparatory programs are required but outsourced to other providers the institution accepts  responsibility for ensuring the quality of these programs and ensures that required standards for entry are met.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.9  Systems are in place within each program throughout the institution for monitoring and coordinating student workload across courses.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.10  Systems are in place for monitoring the progress of individual students and assistance and/or counselling is provided to those facing difficulties.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.11  Year to year progression rates and program completion rates are monitored, and action taken to help any categories or types of students needing help.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.12   Adequate facilities are available for private study with access to computer terminals and other necessary equipment
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.13  Teaching staff are familiar with the range of support services available in the institution  for students, and refer them to appropriate sources of assistance when required.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.6.14 The adequacy of arrangements for assistance to students should be periodically assessed through processes that include, but are not restricted to, feedback from students.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_4_6()
    {
        return $this->get_property('4_6')->get_value();
    }

    public function set_4_7($value)
    {
        $property = new \Orm_Property_Textarea('4_7', $value);
        $property->set_description('4.7 Quality of Teaching');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				4.7.1 Effective orientation and training programs are provided for new, short term and part time staff.  (To be effective these programs should ensure that faculty are fully briefed on required learning outcomes, on planned teaching strategies, and the contribution of their course to the program as a whole.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.7.2 Teaching strategies are appropriate for the different types of learning outcomes programs are intended to develop.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.7.3  Strategies of teaching and assessment set out in program and course specifications are followed by teaching staff with flexibility to meet the needs of different groups of students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.7.4   Students are fully informed about course requirements in advance through course descriptions that include knowledge and skills to be developed, work requirements and assessment processes.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.7.5   The conduct of courses is consistent with the outlines provided to students and with the course specifications.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.7.6   Textbooks and reference materials are up to date with latest developments in the field of study.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.7.7   Textbooks and other required materials are available in sufficient quantities before classes commence.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.7.8   Student attendance requirements in classes are made clear in student orientations, attendance is monitored, and regulations rigorously enforced.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.7.9   A comprehensive system, (including but not limited to student surveys) is in place for evaluation of teaching effectiveness in all courses.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.7.10   The effectiveness of planned teaching strategies in developing learning outcomes is regularly assessed, and adjustments made in response to evidence about their effectiveness.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.7.11 Regular (at least annual) reports are provided to program administrators on the delivery of each course including any material that could not be covered and any difficulties found in using planned strategies.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.7.12  Appropriate adjustments made in plans for teaching as a result of course reports.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_4_7()
    {
        return $this->get_property('4_7')->get_value();
    }

    public function set_4_8($value)
    {
        $property = new \Orm_Property_Textarea('4_8', $value);
        $property->set_description('4.8 Support for Improvements in Quality of Teaching');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				4.8.1 Training programs in teaching skills are provided for both new and continuing teaching staff including those in part time positions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.8.2 Training programs in teaching should include effective use of new and emerging technology.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.8.3  Adequate opportunities are provided for the professional and academic development of teaching staff with special assistance given to any who are facing difficulties.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.8.4 The extent to which teaching staff are involved in professional development to improve quality of teaching is monitored
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.8.5 Teaching staff develop strategies for improvement of their own teaching and maintain a portfolio of evidence of evaluations and strategies for improvement.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.8.6 Formal recognition is given to outstanding teaching, and encouragement given for innovation and creativity.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.8.7 Strategies for improving quality of teaching include improving the quality of learning materials and the teaching strategies associated with them.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_4_8()
    {
        return $this->get_property('4_8')->get_value();
    }

    public function set_4_9($value)
    {
        $property = new \Orm_Property_Textarea('4_9', $value);
        $property->set_description('4.9 Qualifications and Experience of Teaching Staff');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				4.9.1   Teaching staff have appropriate qualifications and experience for the courses they teach.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.9.2   If  part time teaching staff are needed there is an appropriate mix of full time and part time teaching staff.   (As a general guideline at least 75 % of teaching staff should be employed on a full time basis.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.9.3   All teaching staff are involved on a continuing basis in scholarly activities that ensure they remain up to date with the latest developments in their field and can involve their students in learning that incorporates those developments.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.9.4   Full time staff  teaching postgraduate courses, are themselves active in scholarship and research in the fields of study they teach.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.9.5   In professional programs teaching teams include some experienced and highly skilled professionals in the field.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_4_9()
    {
        return $this->get_property('4_9')->get_value();
    }

    public function set_4_10($value)
    {
        $property = new \Orm_Property_Textarea('4_10', $value);
        $property->set_description('4.10 Field Experience Activities');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				4.10.1  In programs that include field experience activities the student learning to be developed through that experience is clearly specified and appropriate steps taken to ensure that those learning outcomes and expected experiences to develop that learning are understood by students and supervising staff in the field setting
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.10.2  Supervising staff in field locations are thoroughly briefed on their role and the relationship of the field experience to the program as a whole.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.10.3  Teaching staff from the institution should visit the field setting for observations and consultations with students and field supervisors often enough to provide proper oversight and support. (Normally at least twice during a field experience activity)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.10.4   Students are thoroughly prepared through briefings and descriptive material for participation in the field experience.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.10.5 Students should be required to prepare a report on their field experience that is appropriate for the nature of the activity and the learning outcomes expected.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.10.6    Follow up meetings or classes are organized in which students can reflect on and generalize from their experience.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.10.7   Field experience placements are selected because of their capacity to develop the learning outcomes sought and their effectiveness in doing so is evaluated.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.10.8   In situations where the supervisors in the field setting and teaching staff from the institution are both involved in student assessments, criteria for assessment are clearly specified and explained, and procedures established for reconciling differing opinions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.10.9  Provision is made for evaluations of the field experience activity (i) by students, (ii) by supervising staff in the field setting, and (iii) by staff of the institution, and results of those evaluations considered in subsequent planning.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.10.10  Preparation for the field experience includes thorough risk assessment for all parties involved, and planning to minimize and deal with those risks.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_4_10()
    {
        return $this->get_property('4_10')->get_value();
    }

    public function set_4_11($value)
    {
        $property = new \Orm_Property_Textarea('4_11', $value);
        $property->set_description('4.11 Partnership Arrangements with Other Institutions (If applicable)');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				4.11.1  Responsibilities of the local institution and the partner are clearly defined in formal agreements enforceable under the laws of Saudi Arabia.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.11.2  The effectiveness of the partnership arrangements is regularly evaluated..
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.11.3  Briefings and consultations on course requirements are adequate, with mechanisms available for ongoing consultation on emerging issues.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.11.4  Teaching staff  from the partner institution who are familiar with the content of courses visit regularly for consultation about course details and standards of assessments.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.11.5  If  arrangements involve assessment of student work by the partner in addition to assessments within the institution, final assessments are completed promptly and results made available to students within the time specified for reporting results under Saudi Arabian regulations..
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.11.6  If programs are based on those of partner institutions, courses, assignments and examinations are adapted to the local environment, avoiding colloquial expressions, and using examples and illustrations relevant to the setting where the programs are to be offered.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.11.7  Programs and courses are consistent with the requirements of the Qualifications Framework for Saudi Arabia, and when relevant include regulations and conventions relevant to the Saudi environment.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.11.8  If courses or programs developed by a partner institution are delivered in Saudi Arabia adequate processes should be followed to ensure that standards of student achievement are at least equal to those achieved elsewhere by the partner institution as well as by other appropriate institutions selected for benchmarking purposes.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				4.11.9  If an international institution or other organization is invited to provide programs, or to assist in the development of programs for use in Saudi Arabia full information should be provided in advance about relevant Ministry regulations and NCAAA requirements for the National Qualifications Framework and requirements for program and course specifications and reports.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_4_11()
    {
        return $this->get_property('4_11')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Quality of Standard 4.  Refer to evidence obtained and provide a report based on that evidence about the extent to which the requirements of the standard of learning are met throughout the institution.  The evidence of performance should be summarized and referred to in other documents; including KPIs, survey summary reports and other relevant sources of evidence.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

    public function set_general_conclusion($value)
    {
        $property = new \Orm_Property_Textarea('general_conclusion', $value);
        $property->set_description('Provide a general conclusion that includes a list of particular strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_general_conclusion()
    {
        return $this->get_property('general_conclusion')->get_value();
    }

}
