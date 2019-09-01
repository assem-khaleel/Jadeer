<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ssri_g_evaluation_5_student_administration
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation_5_Student_Administration extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5. Student Administration and Support Services';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_admissions_and_student('');
            $this->set_info('');
            $this->set_explanatory_report('');
            $this->set_standard_description('');
            $this->set_report_on_sub_standards('');
            $this->set_5_1('');
            $this->set_5_2('');
            $this->set_5_3('');
            $this->set_5_4('');
            $this->set_5_5('');
            $this->set_5_6('');
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
            $kpi_1->set_name('KPI S5.1');
            $kpi_1->set_kpi_info('14. Ratio of students to administrative staff.');
            $kpi_1->set_kpi_ref_num('S5.1');
            $children[] = $kpi_1;

            $kpi_2 = new kpi();
            $kpi_2->set_name('KPI S5.2');
            $kpi_2->set_kpi_info('15. Proportion of total operating funds (other than accommodation and student allowances) allocated to provision of student services.');
            $kpi_2->set_kpi_ref_num('S5.2');
            $children[] = $kpi_2;

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
        $property->set_class('Node\ncai14\Ses_Standard_5_Overall');
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

    public function set_admissions_and_student()
    {
        $property = new \Orm_Property_Fixedtext('admissions_and_student', 'Administration of admissions and student record systems must be reliable and responsive, with confidentiality of records maintained in keeping with stated policies.  Students’ rights and responsibilities must be clearly defined and understood, with transparent and fair procedures available for discipline and appeals. Mechanisms for academic advice, counselling and support services must be accessible and responsive to student needs.  Support services for students must  go beyond formal academic requirements and include extracurricular provisions for religious, cultural, sporting, and other activities relevant to the needs of the student body.');
        $this->set_property($property);
    }

    public function get_admissions_and_student()
    {
        return $this->get_property('admissions_and_student')->get_value();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Note: For Standard 5 the institution must provide 3 or more KPI tables to demonstrate quality assurance. A KPI table is required for sub-standard 5.4. Copy and paste additional tables and place them in the SSRI in the appropriate sub-standard.</strong>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description("Provide an explanatory report about the student administration arrangements and support services, including functions carried out centrally and those managed in colleges or departments.  For those managed in departments or colleges, refer to any relevant institution-wide policies or regulations and describe the processes used by the institution to monitor how effectively local services are provided.");
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

    public function set_5_1($value)
    {
        $property = new \Orm_Property_Textarea('5_1', $value);
        $property->set_description('5.1 Student Admissions');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				5.1.1  The admission and student registration processes are efficient and simple for students to use
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.2 Computerized systems used for admission processes are linked to data recording and retrieval systems.  (For example to fee payment requirements, the issue of student identity cards, program and course registrations, and statistical reporting requirements.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.3 Admission requirements are clearly described, and appropriate for the institution and its programs.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.4 Admission requirements are consistently and fairly applied.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.5 If programs or courses include components offered by distance education, or use of e-learning in blended programs information is provided before enrolment about any special skills or resources needed to study in these modes. (For distance education programs a separate set of standards that include requirements for that mode of program delivery are set out in a different document, Standards for Quality Assurance and Accreditation of Higher Education Programs Offered by Distance Education.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.6 Student fees, if required, are paid at the time of registration unless deferral has been approved in advance.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.7 If the institution’s regulations provide for deferral of payments, the conditions and dates for payment are clearly specified in a formal agreement signed by the student and witnessed, and opportunities for financial counselling provided.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.8 Student advisors familiar with details of course requirements are available to provide assistance prior to and during the student registration process
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.9    Rules governing admission with credit for previous studies are clearly specified.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.10   Decisions on credit for previous studies are made known to students by qualified faculty or authorized staff before classes commence.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.11 Complete information about the institution, including the range of courses and programs, program requirements, costs, services and other relevant information is publicly available to potential students and families prior to applications for admission.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.1.12 A comprehensive orientation program is available for commencing students to ensure thorough understanding of the range of services and facilities available to them, and of their obligations and responsibilities.
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
				5.2.1  Effective security is provided for student records.  (Central files containing cumulative records of each student’s enrolment and performance are maintained in a secure area with back up files kept in a different and secure location, preferably in a different building off campus)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    5.2.2  Formal policies establish the content of permanent student records and their retention and disposal.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.2.3 The student record system regularly provides statistical data they require for planning, reporting and quality assurance to departments, colleges, the quality center and senior managers.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.2.4 Clear rules are established and maintained governing privacy of information and controlling access to individual student records.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.2.5   Automated procedures are in place for monitoring student progress throughout their programs.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.2.6   Timelines for reporting and recording results and updating records are clearly defined and adhered to.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.2.7   Results are finalized, officially approved, and communicated to students within times specified in institutional and Ministry regulations.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.2.8   Eligibility for graduation is formally verified in relation to program and course requirements.
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
				5.3.1 A code of behaviour is approved by the governing body and made widely available within the institution specifying rights and responsibilities of students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    5.3.2 Regulations specify action to be taken for breaches of student discipline including the responsibilities of relevant officers and committees, and penalties, which may be imposed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.3.3 Disciplinary action is taken promptly, and full documentation including details of evidence is retained in secure institutional records.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.3.4 Student appeal and grievance procedures are specified in regulations, published, and  made widely known within the institution.  The regulations make clear the grounds on which academic appeals may be based, the criteria for decisions, and the remedies available.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.3.5 Appeal and grievance procedures protect against time wasting on trivial issues, but still provide adequate opportunity for matters of concern to students to be fairly dealt with and supported by student counselling provisions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.3.6 Appeal and grievance procedures guarantee impartial consideration by persons or committees independent of the parties involved in the issue, or who made a decision or imposed a penalty that is being appealed against
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.3.7 Procedures have been developed to ensure that students are protected against subsequent punitive action or discrimination following consideration of a grievance or appeal
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.3.8 Appropriate policies and procedures are in place to deal with academic misconduct, including plagiarism and other forms of cheating.
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
        $property->set_description('5.4 Planning and Evaluation of Student Services');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				5.4.1 The range of services provided and the resources devoted to them reflect the mission of the institution and any special requirements of the student population.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    5.4.2 Formal plans are developed for the provision and improvement of student services and the implementation and effectiveness of those plans is monitored on a regular basis.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.4.3 A senior member of teaching or other staff is assigned responsibility for oversight and development of student services.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.4.4 The effectiveness and relevance of services is regularly monitored through processes which include surveys of student usage and satisfaction.  Services are modified in response to evaluation and feedback.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.4.5 Adequate facilities and financial support are provided for the services that are needed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.4.6 If services are provided through student organizations, assistance is given in management and organization if required, and there is effective oversight of financial management and reporting.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.4.7 If student newspapers or other student documents are published there are clear guidelines defining publication standards and editorial policy and the extent and nature of oversight by the institution.
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

    public function set_5_5($value)
    {
        $property = new \Orm_Property_Textarea('5_5', $value);
        $property->set_description('5.5 Medical and Counseling Services');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				5.5.1  Student medical services are staffed by people with the necessary professional qualifications.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    5.5.2 Medical services are readily accessible with provision made for emergency assistance when required.  (Fees for services may be charged and they may be provided on a part time basis but emergency access must still be available)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.5.3 Provision is made for academic counselling and for career planning and employment advice in colleges, departments or other appropriate locations within the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.5.4 Personal or psychological counselling services are made available with easy access for students from any part of the institution
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.5.5 Adequate protection is provided, and supported by regulation or a code of conduct, to protect the confidentiality of personal issues discussed with teaching or other staff or students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.5.6 Effective mechanisms are established for follow up to ensure student welfare and to evaluate quality of service.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_5_5()
    {
        return $this->get_property('5_5')->get_value();
    }

    public function set_5_6($value)
    {
        $property = new \Orm_Property_Textarea('5_6', $value);
        $property->set_description('5.6 Extra-Curricular Activities for Students');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				5.6.1 Opportunities are provided for participation in religious observances consistent with Islamic beliefs and traditions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    5.6.2 Arrangements are made to organize and encourage student participation in cultural activities such as clubs and societies and in the arts and other fields appropriate to their interests and needs.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.6.3 Opportunities are provided through appropriate facilities and organizational arrangements for informal social interaction among students
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.6.4 Participation in sports is encouraged, both for skilled athletes and for others, and appropriate competitive and non-competitive physical activities in which they can be involved are arranged.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				5.6.5 The extent of student participation in extra-curricular activities is monitored and benchmarked against other comparable institutions, and where necessary strategies developed to improve levels of participation.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_5_6()
    {
        return $this->get_property('5_6')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Quality Standard 5.  Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
