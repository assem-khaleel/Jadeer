<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_3
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 3. Management of  Program Quality Assurance';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_teaching_staff();
            $this->set_standard_description('');
            $this->set_quality_assurance_processes('');
            $this->set_3_1('');
            $this->set_3_2('');
            $this->set_3_3('');
            $this->set_3_4('');
            $this->set_3_5('');
            $this->set_quality_mission('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {
        $standard = 3;
        $standard_obj = \Orm_Standard::get_one(['code' => 3]);

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
            $kpi_1->set_name('KPI S3.1');
            $kpi_1->set_kpi_info("3. Students' overall evaluation on the quality of their learning experiences.(Average rating of the overall quality on a five point scale in an annual survey of final year students.)");
            $kpi_1->set_kpi_ref_num('S3.1');
            $children[] = $kpi_1;

            $kpi_2 = new Kpi();
            $kpi_2->set_name('KPI S3.2');
            $kpi_2->set_kpi_info('4. Proportion of courses in which student evaluations were conducted during the year.');
            $kpi_2->set_kpi_ref_num('S3.2');
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
        $property->set_class('Node\ncassr18\Ses_Standard_3_Overall');
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

    public function set_teaching_staff()
    {
        $property = new \Orm_Property_Fixedtext('teaching_staff', 'Teaching and other staff involved in the program must be committed to improving both their own performance and the quality of the program as a whole.  Regular evaluations of quality must be undertaken within each course based on valid evidence and appropriate benchmarks, and plans for improvement made and implemented. Central importance must be attached to student learning outcomes with each course contributing to the achievement of overall program objectives');
        $this->set_property($property);
    }

    public function get_teaching_staff()
    {
        return $this->get_property('teaching_staff')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Provide a description of the process for investigation and preparation of report.');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_quality_assurance_processes($value)
    {
        $property = new \Orm_Property_Textarea('quality_assurance_processes', $value);
        $property->set_description('Provide an explanatory report that describes and analyzes the quality assurance processes used in the program, particularly relating to indicators and benchmarks of performance and verification of standards for each of the following sub-standards');
        $this->set_property($property);
    }

    public function get_quality_assurance_processes()
    {
        return $this->get_property('quality_assurance_processes')->get_value();
    }

    public function set_3_1($value)
    {
        $property = new \Orm_Property_Textarea('3_1', $value);
        $property->set_description('3.1 Commitment to Quality Improvement in the Program');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				3.1.1 All teaching and other staff  participate in self-assessments and cooperate with reporting and improvement processes in their sphere of activity.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.1.2 Creativity and innovation combined with clear guidelines and accountability processes are actively encouraged.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.1.3 Mistakes and weaknesses are acknowledged, and dealt with constructively, with help given for improvement.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.1.4 Improvements in quality are appropriately acknowledged and outstanding achievements recognized.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.1.5 Evaluation and planning for quality improvement are integrated into normal administrative processes.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_3_1()
    {
        return $this->get_property('3_1')->get_value();
    }

    public function set_3_2($value)
    {
        $property = new \Orm_Property_Textarea('3_2', $value);
        $property->set_description('3.2 Scope of Quality Assurance Processes');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				3.2.1  Quality evaluations deal with all aspects of program planning and delivery including student learning outcomes and facilities and services to support that learning whether they are managed by administrators of the program or by others based elsewhere in the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.2.2 Quality evaluations and reports provide an overview of performance for the total program as a whole as well as components within it, including all courses and both sections if the program is offered in male and female sections.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.2.3 Evaluations consider inputs, processes, outcomes and processes, with particular attention to learning outcomes for students.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.2.4 Evaluations include both routine activities and strategic priorities for improvement.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.2.5 Processes are designed to ensure both that acceptable standards are met, and that there is continuing improvement in performance.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.2.6 In sections for male and female students detailed evaluations in relation to all standards are carried out in a consistent way in both sections and quality reports on those standards report on any significant differences found and make appropriate recommendations for action in response.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_3_2()
    {
        return $this->get_property('3_2')->get_value();
    }

    public function set_3_3($value)
    {
        $property = new \Orm_Property_Textarea('3_3', $value);
        $property->set_description('3.3 Administration of Quality Assurance Processes');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				3.3.1 Quality assurance processes are  fully integrated into normal planning and program delivery arrangements.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.2 Evaluations are (i) based on evidence, (ii) linked to appropriate standards,(iii) include predetermined performance indicators, and (iv) take account of independent verification of interpretations.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.3 Quality assurance processes make use of standard forms and survey instruments for use across the institution with any special additional elements added to meet the particular requirements of the program.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.3.4 Survey data is collected from students and analysed for individual courses, the program as.a whole, and also from graduates and employers of those graduates.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.3.5 Statistical data on indicators, including grade distributions, progression and completion rates are retained in an accessible central data base and regularly reviewed and reported in annual. program reports.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.3.6 Responsibility is given to a member of the teaching staff to provide leadership and support for the management of quality assurance processes.  The responsible person should involve other staff in planning and carrying out the quality assurance processes.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.3.7 The quality assurance arrangements for the program should be regularly evaluated and improved.  As part of these reviews unnecessary requirements should be removed to streamline the system and avoid unnecessary work.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.3.8 Processes for evaluation of quality should be transparent with criteria for judgments and evidence considered made clear.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_3_3()
    {
        return $this->get_property('3_3')->get_value();
    }

    public function set_3_4($value)
    {
        $property = new \Orm_Property_Textarea('3_4', $value);
        $property->set_description('3.4 Use of Performance Indicators and Benchmarks');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				3.4.1 Information is provided regularly on key performance indicators that are selected for all programs in the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.4.2 Additional performance indicators relevant to the particular program are also identified, used for program evaluations and regularly reported on.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.4.3 The additional benchmarks for the program are approved by the appropriate senior committee or council within the institution (eg. senior academic committee, university council).
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.4.4  Benchmarks for comparing quality of performance (for example with past performance or comparisons with other institutions) are established and achievements in relation to those  benchmarks is regularly monitored.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				3.4.5 The format for indicators and benchmarks is consistent with that adopted for the institution as a whole.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_3_4()
    {
        return $this->get_property('3_4')->get_value();
    }

    public function set_3_5($value)
    {
        $property = new \Orm_Property_Textarea('3_5', $value);
        $property->set_description('3.5 Independent Verification of Evaluations');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				3.5.1 Self-evaluations of quality of performance are checked against several related sources  evidence including feedback through user surveys and opinions of stakeholders such as students and faculty, graduates and employers.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.5.2 Interpretations of evidence of quality of performance are verified through independent advice from persons familiar with the type of activity concerned and impartial mechanisms are used to reconcile differing opinions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.5.3  Institutional policies and procedures are adhered to for the verification of standards of achievement by students in relation to other institutions and the requirements of the National Qualifications Framework.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_3_5()
    {
        return $this->get_property('3_5')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Management of  Program Quality Assurance. Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
