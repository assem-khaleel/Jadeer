<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_5
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 5. Student Administration and Support Services';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_admission_processes();
            $this->set_standard_description('');
            $this->set_student_adminstration('');
            $this->set_5_1('');
            $this->set_5_2('');
            $this->set_5_3('');
            $this->set_5_4('');
            $this->set_quality_mission('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 5;
        $standard_obj = \Orm_Standard::get_one(['code' => 5]);

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
            $kpi_3 = new kpi();
            $kpi_3->set_name('KPI S5.3');
            $kpi_3->set_kpi_info('16. Student evaluation of academic and career counselling.  (Average rating on the adequacy of academic and career counselling on a five- point scale in an annual survey of final year students.)');
            $kpi_3->set_kpi_ref_num('S5.3');
            $children[] = $kpi_3;
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
        $property->set_class('Node\ncassr18\Ses_Standard_5_Overall');
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

    public function set_admission_processes()
    {
        $property = new \Orm_Property_Fixedtext('admission_processes', 'Admission processes must be efficient, fair, and responsive to the needs of students entering the program.  Clear information about program requirements and criteria for admission and program completion must be readily available for prospective students and when required at later stages during the program. Mechanisms for student appeals and dispute resolution must be clearly described, made known, and fairly administered. Career advice must be provided in relation to occupations related to the fields of study dealt with in the program <br/>'
            . 'Much of the responsibility for this standard may be institutional rather than program administration. However, the program is responsible to assessing the quality of this standard.   In this standard analysis should be made not only on what is done within the department or program, but also on how the services provided elsewhere in the institution affect the quality of the program and the learning outcomes of students');

        $this->set_property($property);
    }

    public function get_admission_processes()
    {
        return $this->get_property('admission_processes')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Describe the processes used to evaluate performance in relation to this standard.');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_student_adminstration($value)
    {
        $property = new \Orm_Property_Textarea('student_adminstration', $value);
        $property->set_description('Provide an explanatory report about the student administration arrangements and support services for each of the following sub-standards');
        $this->set_property($property);
    }

    public function get_student_adminstration()
    {
        return $this->get_property('student_adminstration')->get_value();
    }

    public function set_5_1($value)
    {
        $property = new \Orm_Property_Textarea('5_1', $value);
        $property->set_description('5.1 Student Admissions');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				5.1.1   Admission requirements are consistently and fairly applied for all students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.2 For programs or courses that include components offered by distance education, or use of e-learning in blended programs information is provided before enrolment about any special skills or resources needed to study in these modes. (For distance education programs a separate set of standards that include requirements for that mode of program delivery are set out in a different document, Standards for Quality Assurance and Accreditation of Higher Education Programs Offered by Distance Education)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.3 Student advisors familiar with details of course requirements are available to provide assistance prior to and during the student registration process.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				5.1.4 Rules governing admission with credit for previous studies are clearly specified.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				5.1.5 Decisions on credit for previous studies are made known to students by qualified teaching or other authorized staff before classes commence.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				5.1.6 Complete information about the program, including the range of courses, program requirements, costs, services and other relevant information is publicly available to potential students and families prior to applications for admission.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				5.1.7 A comprehensive orientation program is available for commencing students to ensure thorough understanding of program requirements and reasons for them, the range of services and facilities available to them, and of their obligations and responsibilities.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_5_1()
    {
        return $this->get_property('5_1')->get_value();
    }

    public function set_5_2($value)
    {
        $property = new \Orm_Property_Textarea('5_2', $value);
        $property->set_description('5.2 Student Records');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				5.2.1 Automated procedures are in place for monitoring student progress throughout their programs.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.2.2 The student record system regularly provides aggregated statistical data required for planning, reporting and quality assurance.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.2.3 Clear rules are established and maintained governing privacy of information and controlling access to individual student records.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				5.2.4 Eligibility for graduation is formally verified in relation to program and course requirements.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_5_2()
    {
        return $this->get_property('5_2')->get_value();
    }

    public function set_5_3($value)
    {
        $property = new \Orm_Property_Textarea('5_3', $value);
        $property->set_description('5.3 Student Management');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				5.3.1 Attendance requirements are made clear to students, monitored and enforced.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.3.2 Student appeal and grievance procedures are specified in regulations, published, and made widely known within the institution.  The regulations make clear the grounds on which academic appeals may be based, the criteria for decisions, and the remedies available.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.3.3 Appeal and grievance procedures protect against time wasting on trivial issues, but still provide adequate opportunity for matters of concern to students to be fairly dealt with and supported by student counselling provisions.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				5.3.4 Appeal and grievance procedures guarantee impartial consideration by persons or committees independent of the parties involved in the issue, or who made a decision or imposed a penalty that is being appealed against
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				5.3.5 Procedures have been developed to ensure that students are protected against subsequent punitive action or discrimination following consideration of a grievance or appeal.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				5.3.6 Appropriate policies and procedures are in place to deal with academic misconduct, including plagiarism and other forms of cheating.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_5_3()
    {
        return $this->get_property('5_3')->get_value();
    }

    public function set_5_4($value)
    {
        $property = new \Orm_Property_Textarea('5_4', $value);
        $property->set_description('5.4 Student Advising and Counselling Services');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				5.4.1  Provision is made for academic counselling and for career planning and employment advice within the college, department or another appropriate location within the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.4.2  Adequate protection is provided, and supported by regulations or a codes of conduct, to protect the confidentiality of academic or personal issues discussed with teaching or other staff or students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.4.3  Effective mechanisms are established for follow up to ensure student welfare and to evaluate quality of service.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				5.4.4  An effective student support system is available to identify students in difficulty and provide help with personal, study related, financial, family, psychological or health problems.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_5_4()
    {
        return $this->get_property('5_4')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Evaluation of student administration arrangements and support services for students in the program.  Refer to evidence about the standard and sub-standards within it and provide a report including a list of strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
