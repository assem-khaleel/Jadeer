<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of provisional_accreditation_quality_standards
 *
 * @author ahmadgx
 */
class Provisional_Accreditation_Quality_Standards extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Information Relating to Quality Standards';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            /* Mission */
            $this->set_mission('');
            $this->set_mission_statement('');
            $this->set_mission_rational('');
            /* Governance and Administration */
            $this->set_governance('');
            $this->set_charts('');
            $this->set_titles_and_job('');
            $this->set_titles_and_reference('');
            $this->set_articles('');
            /* Quality Assurance System */
            $this->set_quality_assurance('');
            $this->set_quality_assurance_systems('');
            /* Learning and Teaching */
            $this->set_learning_and_teaching('');
            $this->set_program_list('');
            $this->set_summary('');
            $this->set_policies_details('');
            /* Student admission requirements */
            $this->set_student_admission('');
            $this->set_evaluation_strategies('');
            $this->set_system_support('');
            $this->set_institutional_process('');
            $this->set_new_institution('');
            $this->set_sponsorship_institution('');
            $this->set_courses('');
            /* Student Administration and Support Services */
            $this->set_student_administration('');
            $this->set_student_identification('');
            $this->set_administration_details('');
            $this->set_plans('');
            $this->set_student_residences('');
            $this->set_copies('');
            $this->set_attached_copies('');
            /* Learning Resources */
            $this->set_learning_resource('');
            $this->set_nature('');
            $this->set_electronic('');
            $this->set_computing_facilities('');
            $this->set_planning_and_evaluation('');
            $this->set_sufficient_information('');
            /* Facilities and Equipment  */
            $this->set_facilities('');
            $this->set_policy('');
            $this->set_independent_report('');
            /* Faculty and Staff and Employment Processes */
            $this->set_faculty_and_staff('');
            $this->set_faculty_and_staff_number('');
            $this->set_policies('');
            $this->set_regulations('');
            $this->set_system_planned('');
            $this->set_supervision_regulations('');
            $this->set_dispute_resolution('');
            /* Research */
            $this->set_research('');
            $this->set_policies_and_teaching('');
            $this->set_proposed_university('');
            $this->set_development_plan('');
            $this->set_maintenance('');
            $this->set_strategy_and_timelines('');
            $this->set_student_participation('');
            $this->set_intellectual_property('');
            $this->set_indicators_and_benchmarks('');
            /* Institutional Relationships With the Community */
            $this->set_institutional_community('');
            $this->set_community_relations_strategy('');
            $this->set_community_indicator('');
    }

    /* Mission */

    public function set_mission()
    {
        $property = new \Orm_Property_Fixedtext('mission', '<strong>Mission</strong>');
        $this->set_property($property);
    }

    public function get_mission()
    {
        return $this->get_property('mission')->get_value();
    }

    public function set_mission_statement($value)
    {
        $property = new \Orm_Property_Textarea('mission_statement', $value);
        $property->set_description('Concise statement of the mission of the institution and goals for achievement in the first five years.');
        $this->set_property($property);
    }

    public function get_mission_statement()
    {
        return $this->get_property('mission_statement')->get_value();
    }

    public function set_mission_rational($value)
    {
        $property = new \Orm_Property_Textarea('mission_rational', $value);
        $property->set_description('A brief statement of the rationale for the mission including reference to major economic, cultural and demographic features of the region in which the institution is to be located.');
        $this->set_property($property);
    }

    public function get_mission_rational()
    {
        return $this->get_property('mission_rational')->get_value();
    }

    /* Governance and Administration */

    public function set_governance()
    {
        $property = new \Orm_Property_Fixedtext('governance', '<strong>Governance and Administration</strong>');
        $this->set_property($property);
    }

    public function get_governance()
    {
        return $this->get_property('governance')->get_value();
    }

    public function set_charts($value)
    {
        $property = new \Orm_Property_Upload('charts', $value);
        $property->set_description('Charts showing the proposed general and academic administrative structure of the institution.');
        $this->set_property($property);
    }

    public function get_charts()
    {
        return $this->get_property('charts')->get_value();
    }

    public function set_titles_and_job($value)
    {
        $property = new \Orm_Property_Textarea('titles_and_job', $value);
        $property->set_description('Titles and job descriptions for senior positions.');
        $this->set_property($property);
    }

    public function get_titles_and_job()
    {
        return $this->get_property('titles_and_job')->get_value();
    }

    public function set_titles_and_reference($value)
    {
        $property = new \Orm_Property_Textarea('titles_and_reference', $value);
        $property->set_description('Titles, terms of reference and membership of academic and administrative boards and committees.  If the proposed institution is to be established by an international institution or other organization the relative responsibilities of the Saudi Arabian institution and the international institution or other organization should be clearly specified.');
        $this->set_property($property);
    }

    public function get_titles_and_reference()
    {

        return $this->get_property('titles_and_reference')->get_value();
    }

    public function set_articles($value)
    {
        $property = new \Orm_Property_Upload('articles', $value);
        $property->set_description('A copy of the constitution or articles of governance for the institution.');
        $this->set_property($property);
    }

    public function get_articles()
    {
        return $this->get_property('articles')->get_value();
    }

    /* Quality Assurance System */

    public function set_quality_assurance()
    {
        $property = new \Orm_Property_Fixedtext('quality_assurance', '<strong>Quality Assurance System</strong>');
        $this->set_property($property);
    }

    public function get_quality_assurance()
    {
        return $this->get_property('quality_assurance')->get_value();
    }

    public function set_quality_assurance_systems($value)
    {
        $property = new \Orm_Property_Upload('quality_assurance_systems', $value);
        $property->set_description('A statement setting out organizational arrangements, responsibilities, processes and timelines for introduction of quality assurance arrangements dealing with the matters described under Standard 3 in Standards for Quality Assurance and Accreditation of Higher Education Institutions. This system should include proposed key performance indicators and benchmarks to be used for evidence of achievement. Details should be provided of staffing, resource provisions and terms of reference for a quality center and quality committee, a list of key performance indicators, sources of benchmarks for comparisons of quality of performance, and an annual quality performance monitoring system.');
        $this->set_property($property);
    }

    public function get_quality_assurance_systems()
    {
        return $this->get_property('quality_assurance_systems')->get_value();
    }

    /* Learning and Teaching */

    public function set_learning_and_teaching()
    {
        $property = new \Orm_Property_Fixedtext('learning_and_teaching', '<strong>Learning and Teaching</strong> <br/> <br/>'
            . '(<strong>Note : </strong>This section deals with overall institutional processes and arrangements for assuring the quality of teaching and learning throughout the institution. The accreditation of individual programs is dealt with separately in applications for program accreditation.)');
        $this->set_property($property);
    }

    public function get_learning_and_teaching()
    {
        return $this->get_property('learning_and_teaching')->get_value();
    }

    public function set_program_list($value)
    {
        $property = new \Orm_Property_Textarea('program_list', $value);
        $property->set_description('List of programs and qualifications to be awarded. These should be consistent with the National Qualifications Framework and planned dates of commencement for each program should be provided.');
        $this->set_property($property);
    }

    public function get_program_list()
    {
        return $this->get_property('program_list')->get_value();
    }

    public function set_summary($value)
    {
        $property = new \Orm_Property_Textarea('summary', $value);
        $property->set_description('Summary of any special student attributes that the institution intends to develop in its students, and strategies to be used in developing those attributes.');
        $this->set_property($property);
    }

    public function get_summary()
    {
        return $this->get_property('summary')->get_value();
    }

    public function set_policies_details($value)
    {
        $property = new \Orm_Property_Upload('policies_details', $value);
        $property->set_description('Details of policies or regulations establishing processes for verification of achievement of standards of intended learning outcomes by students and other aspects of course and program quality');
        $this->set_property($property);
    }

    public function get_policies_details()
    {
        return $this->get_property('policies_details')->get_value();
    }

    /* Student admission requirements */

    public function set_student_admission()
    {
        $property = new \Orm_Property_Fixedtext('student_admission', '<strong>Student admission requirements</strong>');
        $this->set_property($property);
    }

    public function get_student_admission()
    {
        return $this->get_property('student_admission')->get_value();
    }

    public function set_evaluation_strategies($value)
    {
        $property = new \Orm_Property_Textarea('evaluation_strategies', $value);
        $property->set_description('Strategies to be followed in evaluating and improving teaching effectiveness');
        $this->set_property($property);
    }

    public function get_evaluation_strategies()
    {
        return $this->get_property('evaluation_strategies')->get_value();
    }

    public function set_system_support($value)
    {
        $property = new \Orm_Property_Textarea('system_support', $value);
        $property->set_description('Systems for support of student learning including regulations governing faculty workloads and availability for student counseling and advice, tutorial assistance, and mechanisms for monitoring student progress and workload.');
        $this->set_property($property);
    }

    public function get_system_support()
    {
        return $this->get_property('system_support')->get_value();
    }

    public function set_institutional_process($value)
    {
        $property = new \Orm_Property_Textarea('institutional_process', $value);
        $property->set_description('Institutional processes for course development and review including program approval procedures, employer and student feedback, and industry or professional advice on programs.');
        $this->set_property($property);
    }

    public function get_institutional_process()
    {
        return $this->get_property('institutional_process')->get_value();
    }

    public function set_new_institution($value)
    {
        $property = new \Orm_Property_Upload('new_institution', $value);
        $property->set_description('If the new institution incorporates an existing institution or institutions, details of transition arrangements to ensure opportunities for current students to complete their programs.');
        $this->set_property($property);
    }

    public function get_new_institution()
    {

        return $this->get_property('new_institution')->get_value();
    }

    public function set_sponsorship_institution($value)
    {
        $property = new \Orm_Property_Upload('sponsorship_institution', $value);
        $property->set_description('If the institution is to be established under sponsorship by or in partnership with another institution, a copy of any contracts establishing those arrangements and, a description of the processes to be used for evaluating their effectiveness.');
        $this->set_property($property);
    }

    public function get_sponsorship_institution()
    {

        return $this->get_property('sponsorship_institution')->get_value();
    }

    public function set_courses($value)
    {
        $property = new \Orm_Property_Upload('courses', $value);
        $property->set_description('If courses are to be wholly or partly offered by distance education details of plans to meet the NCAAA Standards for Distance Education and the requirements of the Ministry of Higher Education.');
        $this->set_property($property);
    }

    public function get_courses()
    {
        return $this->get_property('courses')->get_value();
    }

    /* Student Administration and Support Services */

    public function set_student_administration()
    {
        $property = new \Orm_Property_Fixedtext('student_administration', '<strong>Student Administration and Support Services</strong>');
        $this->set_property($property);
    }

    public function get_student_administration()
    {

        return $this->get_property('student_administration')->get_value();
    }

    public function set_student_identification($value)
    {
        $property = new \Orm_Property_Textarea('student_identification', $value);
        $property->set_description('Identification (where a standard computing package is to be used) or description of the computing system to be used for student records and administration. This must be appropriate for the programs offered and provide reliable and secure student records, and have the capacity to provide the data necessary for key performance indicators.');
        $this->set_property($property);
    }

    public function get_student_identification()
    {

        return $this->get_property('student_identification')->get_value();
    }

    public function set_administration_details($value)
    {
        $property = new \Orm_Property_Textarea('administration_details', $value);
        $property->set_description('Details of administrative arrangements and funding provisions for student services including extracurricular activities, and indicators to be used for evaluation of quality of these provisions and services.');
        $this->set_property($property);
    }

    public function get_administration_details()
    {

        return $this->get_property('administration_details')->get_value();
    }

    public function set_plans($value)
    {
        $property = new \Orm_Property_Upload('plans', $value);
        $property->set_description('Plans for provision of student services, including medical, general counseling and academic advice.');
        $this->set_property($property);
    }

    public
    function get_plans()
    {
        return $this->get_property('plans')->get_value();
    }

    public function set_student_residences($value)
    {
        $property = new \Orm_Property_Upload('student_residences', $value);
        $property->set_description('If student residences are to be provided by the institution, details of supervision arrangements and services to be made available.');
        $this->set_property($property);
    }

    public function get_student_residences()
    {

        return $this->get_property('student_residences')->get_value();
    }

    public function set_copies()
    {
        $property = new \Orm_Property_Fixedtext('copies', '<strong>Copies of regulations dealing with the following matters should be provided. <br/> <br/>'
            . '<ul><li>Registration and admission procedures.</li>'
            . '<li>Security and privacy of student records.</li>'
            . '<li>Communication and publication of results.</li>'
            . '<li>Student progress rules.</li>'
            . '<li>Student discipline procedures.</li>'
            . '<li>Fee collection and refund policies if applicable.</li>'
            . '<li>Student appeal procedures.</li>'
            . '<li>Codes of Conduct for students, faculty and staff.</li>'
            . '<li>Assessment for advanced standing on admission.</li>'
            . '</ul></strong>');
        $this->set_property($property);
    }

    public function get_copies()
    {
        return $this->get_property('copies')->get_value();
    }

    public function set_attached_copies($value)
    {
        $property = new \Orm_Property_Upload('attached_copies', $value);
        $this->set_property($property);
    }

    public function get_attached_copies()
    {
        return $this->get_property('attached_copies')->get_value();
    }

    /* Learning Resources */

    public function set_learning_resource()
    {
        $property = new \Orm_Property_Fixedtext('learning_resource', '<strong>Learning Resources</strong>');
        $this->set_property($property);
    }

    public function get_learning_resource()
    {

        return $this->get_property('learning_resource')->get_value();
    }

    public function set_nature($value)
    {
        $property = new \Orm_Property_Textarea('nature', $value);
        $property->set_description('Details of the nature and extent of learning resource provision including the library and reference collection. An explanation should be given of the relationship of these plans to the approach to be taken to teaching and learning in the programs to be offered.');
        $this->set_property($property);
    }

    public function get_nature()
    {
        return $this->get_property('nature')->get_value();
    }

    public function set_electronic($value)
    {
        $property = new \Orm_Property_Textarea('electronic', $value);
        $property->set_description('Details of electronic and web based material to be made available.');
        $this->set_property($property);
    }

    public function get_electronic()
    {
        return $this->get_property('electronic')->get_value();
    }

    public function set_computing_facilities($value)
    {
        $property = new \Orm_Property_Textarea('computing_facilities', $value);
        $property->set_description('Details of computing facilities to be made available for access to electronic material through a library or learning resource center.');
        $this->set_property($property);
    }

    public function get_computing_facilities()
    {

        return $this->get_property('computing_facilities')->get_value();
    }

    public function set_planning_and_evaluation($value)
    {
        $property = new \Orm_Property_Upload('planning_and_evaluation', $value);
        $property->set_description('Details of planning and evaluation processes for learning resource provision, and indicators and benchmarks of effectiveness of provision.');
        $this->set_property($property);
    }

    public function get_planning_and_evaluation()
    {

        return $this->get_property('planning_and_evaluation')->get_value();
    }

    public function set_sufficient_information($value)
    {
        $property = new \Orm_Property_Upload('sufficient_information', $value);
        $property->set_description('Sufficient information should be provided about budget allocations, organization and user support, for an independent assessment of adequacy of provision.');
        $this->set_property($property);
    }

    public function get_sufficient_information()
    {
        return $this->get_property('sufficient_information')->get_value();
    }

    /* Facilities and Equipment  */

    public function set_facilities()
    {
        $property = new \Orm_Property_Fixedtext('facilities', '<strong>Facilities and Equipment</strong>');
        $this->set_property($property);
    }

    public function get_facilities()
    {
        return $this->get_property('facilities')->get_value();
    }

    public function set_policy($value)
    {
        $property = new \Orm_Property_Upload('policy', $value);
        $property->set_description('Copy of information technology policy and associated regulations including codes of conduct, security, compatibility of software and hardware.');
        $this->set_property($property);
    }

    public
    function get_policy()
    {
        return $this->get_property('policy')->get_value();
    }

    public function set_independent_report($value)
    {
        $property = new \Orm_Property_Upload('independent_report', $value);
        $property->set_description('An independent report on the adequacy of equipment for administrative and teaching requirements.  For a proposed university or other institution that is intended to be involved with research or the provision of postgraduate studies, an independent report on the adequacy of planned facilities and equipment for the proposed level of research activity.');
        $this->set_property($property);
    }

    public function get_independent_report()
    {
        return $this->get_property('independent_report')->get_value();
    }

    /* Faculty and Staff and Employment Processes */

    public function set_faculty_and_staff()
    {
        $property = new \Orm_Property_Fixedtext('faculty_and_staff', '<strong>Faculty and Staff and Employment Processes</strong>');
        $this->set_property($property);
    }

    public function get_faculty_and_staff()
    {

        return $this->get_property('faculty_and_staff')->get_value();
    }

    public function set_faculty_and_staff_number($value)
    {
        $property = new \Orm_Property_Textarea('faculty_and_staff_number', $value);
        $property->set_description('A table showing proposed faculty and staff numbers in each year for the first three years in relation to the numbers of students proposed to be enrolled, the courses to be offered, and the ratios of faculty and staff to students in each year.');
        $this->set_property($property);
    }

    public function get_faculty_and_staff_number()
    {

        return $this->get_property('faculty_and_staff_number')->get_value();
    }

    public function set_policies($value)
    {
        $property = new \Orm_Property_Textarea('policies', $value);
        $property->set_description('Statement of policies on level of qualifications required for employment of teaching staff.');
        $this->set_property($property);
    }

    public function get_policies()
    {
        return $this->get_property('policies')->get_value();
    }

    public function set_regulations($value)
    {
        $property = new \Orm_Property_Textarea('regulations', $value);
        $property->set_description('Details of regulations, processes and opportunities for staff professional development.');
        $this->set_property($property);
    }

    public function get_regulations()
    {
        return $this->get_property('regulations')->get_value();
    }

    public function set_system_planned($value)
    {
        $property = new \Orm_Property_Upload('system_planned', $value);
        $property->set_description('Planned system for recruitment, and orientation and training of new teaching and other staff.');
        $this->set_property($property);
    }

    public function get_system_planned()
    {
        return $this->get_property('system_planned')->get_value();
    }

    public function set_supervision_regulations($value)
    {
        $property = new \Orm_Property_Textarea('supervision_regulations', $value);
        $property->set_description('Policy and regulations on supervision and evaluation of staff, and mechanisms for recognizing and rewarding outstanding performance.');
        $this->set_property($property);
    }

    public function get_supervision_regulations()
    {

        return $this->get_property('supervision_regulations')->get_value();
    }

    public function set_dispute_resolution($value)
    {
        $property = new \Orm_Property_Textarea('dispute_resolution', $value);
        $property->set_description('Policies and regulations on dispute resolution, discipline and appeal procedures.');
        $this->set_property($property);
    }

    public function get_dispute_resolution()
    {
        return $this->get_property('dispute_resolution')->get_value();
    }

    /* Research */

    public function set_research()
    {
        $property = new \Orm_Property_Fixedtext('research', '<strong>Research</strong>');
        $this->set_property($property);
    }

    public function get_research()
    {
        return $this->get_property('research')->get_value();
    }

    public function set_policies_and_teaching($value)
    {
        $property = new \Orm_Property_Textarea('policies_and_teaching', $value);
        $property->set_description('Policy on teaching staff participation in scholarship and research.');
        $this->set_property($property);
    }

    public function get_policies_and_teaching()
    {

        return $this->get_property('policies_and_teaching')->get_value();
    }

    public function set_proposed_university()
    {
        $property = new \Orm_Property_Fixedtext('proposed_university', '(For a proposed university, or other institution wishing to develop postgraduate programs or research activities.)');
        $this->set_property($property);
    }

    public function get_proposed_university()
    {

        return $this->get_property('proposed_university')->get_value();
    }

    public function set_development_plan($value)
    {
        $property = new \Orm_Property_Textarea('development_plan', $value);
        $property->set_description('Research development plan including administrative arrangements, priority fields for development, mechanisms for cooperation with community and other organizations, and timelines for implementation.');
        $this->set_property($property);
    }

    public function get_development_plan()
    {

        return $this->get_property('development_plan')->get_value();
    }

    public function set_maintenance($value)
    {
        $property = new \Orm_Property_Textarea('maintenance', $value);
        $property->set_description('Policy on maintenance and management of equipment obtained through research funding.');
        $this->set_property($property);
    }

    public function get_maintenance()
    {
        return $this->get_property('maintenance')->get_value();
    }

    public function set_strategy_and_timelines($value)
    {
        $property = new \Orm_Property_Upload('strategy_and_timelines', $value);
        $property->set_description('Strategy and timelines for development of higher degree research programs.');
        $this->set_property($property);
    }

    public function get_strategy_and_timelines()
    {
        return $this->get_property('strategy_and_timelines')->get_value();
    }

    public function set_student_participation($value)
    {
        $property = new \Orm_Property_Textarea('student_participation', $value);
        $property->set_description('Policy on student participation in staff and institutional research.');
        $this->set_property($property);
    }

    public function get_student_participation()
    {

        return $this->get_property('student_participation')->get_value();
    }

    public function set_intellectual_property($value)
    {
        $property = new \Orm_Property_Textarea('intellectual_property', $value);
        $property->set_description('Policy and regulations on intellectual property and commercialization of research.');
        $this->set_property($property);
    }

    public function get_intellectual_property()
    {

        return $this->get_property('intellectual_property')->get_value();
    }

    public function set_indicators_and_benchmarks($value)
    {
        $property = new \Orm_Property_Upload('indicators_and_benchmarks', $value);
        $property->set_description('Summary of indicators and benchmarks to be used in evaluating the amount and quality of research activity.');
        $this->set_property($property);
    }

    public function get_indicators_and_benchmarks()
    {
        return $this->get_property('indicators_and_benchmarks')->get_value();
    }

    /* Institutional Relationships With the Community */

    public function set_institutional_community()
    {
        $property = new \Orm_Property_Fixedtext('institutional_community', '<strong>Institutional Relationships With the Community</strong>');
        $this->set_property($property);
    }

    public function get_institutional_community()
    {
        return $this->get_property('institutional_community')->get_value();
    }

    public function set_community_relations_strategy($value)
    {
        $property = new \Orm_Property_Textarea('community_relations_strategy', $value);
        $property->set_description('Community relations strategy including policy and mechanisms for encouraging staff involvement in community activities.');
        $this->set_property($property);
    }

    public function get_community_relations_strategy()
    {
        return $this->get_property('community_relations_strategy')->get_value();
    }

    public function set_community_indicator($value)
    {
        $property = new \Orm_Property_Upload('community_indicator', $value);
        $property->set_description('Indicators and benchmarks to be used in evaluating the quality of community relationships.');
        $this->set_property($property);
    }

    public function get_community_indicator()
    {
        return $this->get_property('community_indicator')->get_value();
    }

}
