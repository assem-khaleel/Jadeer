<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ssri_g_evaluation_7_facilities_and_equipment
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation_7_Facilities_And_Equipment extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '7. Facilities and Equipment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_facilities_requirements();
            $this->set_info();
            $this->set_explanatory_report('');
            $this->set_standard_description('');
            $this->set_report_on_sub_standards();
            $this->set_7_1('');
            $this->set_7_2('');
            $this->set_7_3('');
            $this->set_7_4('');
            $this->set_7_5('');
            $this->set_quality_mission('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 7;
        $standard_obj = \Orm_Standard::get_one(['code' => 7]);

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
            $kpi_1->set_name('KPI S7.1');
            $kpi_1->set_kpi_info('20. Annual expenditure on IT budget,  including:'
                . '<ol  type="a">'
                . '<li>Percentage of the total Institution, or College, or Program  budget allocated for IT;</li>'
                . '<li>Percentage of IT budget allocated per program for institutional or per student for programmatic;</li>'
                . '<li>Percentage of IT budget allocated for software licences;</li>'
                . '<li>Percentage of IT budget allocated for IT security;</li>'
                . '<li>Percentage of IT budge allocated for IT maintenance.</li>'
                . '</ol>');
            $kpi_1->set_kpi_ref_num('S7.1');
            $children[] = $kpi_1;

            $kpi_2 = new kpi();
            $kpi_2->set_name('KPI S7.2');
            $kpi_2->set_kpi_info('21. Stakeholder evaluation of the IT services. (Average overall rating of the adequacy of:'
                . '<ol  type="a">'
                . '<li>IT availability,</li>'
                . '<li>Security,</li>'
                . '<li>Maintenance,</li>'
                . '<li>Accessibility</li>'
                . '<li>Support systems,</li>'
                . '<li>Software and up-dates,</li>'
                . '<li>Age of hardware, and</li>'
                . '<li>Other viable indicators of service on a five- point scale of an annual survey.)</li>'
                . '</ol>');
            $kpi_2->set_kpi_ref_num('S7.2');
            $children[] = $kpi_2;

            $kpi_3 = new kpi();
            $kpi_3->set_name('KPI S7.3');
            $kpi_3->set_kpi_info('22.  Stakeholder evaluation of'
                . '<ol type="a">'
                . '<li>Websites,</li>'
                . '<li>e-learning services</li>'
                . '<li>Hardware and software</li>'
                . '<li>Accessibility</li>'
                . '<li>Learning and Teaching</li>'
                . '<li>Assessment and service</li>'
                . '<li>Web-based electronic data management system or electronic resources (for example:  institutional website providing resource sharing, networking and relevant information, including e-learning, interactive learning and teaching between students and faculty on a five- point scale of an annual survey).</li>'
                . '</ol>');
            $kpi_3->set_kpi_ref_num('S7.3');
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
        $property->set_class('Node\ncai18\Ses_Standard_7_Overall');
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

    public function set_facilities_requirements()
    {
        $property = new \Orm_Property_Fixedtext('facilities_requirements', 'Facilities must be designed or adapted to meet the particular requirements for teaching and learning in the programs offered by the institution, and offer a safe and healthy environment for high quality education.  Use of facilities must be monitored and user surveys used to assist in planning for improvement.  Adequate provision must be made for classrooms and laboratories, use of computer technology and research equipment by faculty and student and appropriate provision  made for associated services such as food services, extra-curricular activities, and where relevant, student accommodation.');
        $this->set_property($property);
    }

    public function get_facilities_requirements()
    {
        return $this->get_property('facilities_requirements')->get_value();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Note: For Standard 7 the institution must provide 2 or more KPI tables to demonstrate quality assurance. A KPI tables is required for sub-standard 7.2. Copy and paste additional tables and place them in the SSRI in the appropriate sub-standard.</strong>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description("Provide an explanatory report about the administration of arrangements for planning, development and maintenance of facilities and equipment.  This should include cross references to other more detailed facilities planning documents.");
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

    public function set_7_1($value)
    {
        $property = new \Orm_Property_Textarea('7_1', $value);
        $property->set_description('7.1 Policy and Planning');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				7.1.1 The institution has a long-term master plan approved by the governing body that provides for capital developments and maintenance of facilities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    7.1.2 Equipment planning processes include plans and schedules for major equipment acquisitions and for servicing and replacement following a planned schedule.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.1.3 Future users of facilities or major equipment are consulted prior to acquisitions or development to ensure that current and anticipated future needs are accurately met.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.1.4 The institution has an equipment policy designed to ensure to the greatest feasible extent, compatibility of equipment and systems across the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.1.5 Business plans are prepared prior to major equipment acquisitions, with evaluation of alternatives of leasing or shared use with other agencies.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.1.6 Proposals for leasing of major facilities and for outsourced building and management of facilities are fully evaluated in the long-term interests of the institution and managed in a way that ensures effective quality control and financial benefits
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_7_1()
    {
        return $this->get_property('7_1')->get_value();
    }

    public function set_7_2($value)
    {
        $property = new \Orm_Property_Textarea('7_2', $value);
        $property->set_description('7.2 Quality and Adequacy of Facilities and Equipment');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				7.2.1  Buildings and grounds provide a clean attractive and well maintained physical environment.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    7.2.2  Facilities fully meet health and safety requirements
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.2.3  Quality evaluation processes include both feedback from principal users about the adequacy and quality of facilities, and mechanisms for considering and responding to their views
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.2.4  Standards of provision of teaching, laboratory and research facilities are benchmarked against equivalent provisions at other  institutions (This includes such things as classroom space, laboratory facilities and equipment, access to computing facilities and associated software, private study facilities, and research equipment)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.2.5  Adequate and accessible facilities are available for confidential consultation between teaching staff and students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.2.6  Appropriate facilities are provided for religious observances.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.2.7  Food service facilities are adequate, and appropriate for the needs of staff and students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.2.8  Provision is made for students and staff with physical disabilities or other special needs.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.2.9  Facilities appropriate for the needs of the students attending the institution are provided for cultural, sporting and other extra curricular activities.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_7_2()
    {
        return $this->get_property('7_2')->get_value();
    }

    public function set_7_3($value)
    {
        $property = new \Orm_Property_Textarea('7_3', $value);
        $property->set_description('7.3 Management and Administration');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				7.3.1 A complete inventory is maintained of equipment owned or controlled by the institution including equipment assigned to individual staff for teaching and research.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    7.3.2 Services such as cleaning, waste disposal, minor maintenance, safety, and environmental management are efficiently and effectively carried out under the supervision of a senior administrative officer.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.3.3 Provision is made for regular condition assessments, preventative and corrective maintenance, and replacement.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.3.4 Effective security is provided for specialized facilities and equipment for teaching and research, with responsibility between individual faculty, departments or colleges, or central administration clearly defined.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.3.5 Effective systems are in place to ensure the personal security of teaching or other staff and students, with appropriate provisions for the security of their personal property.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.3.6 Space utilization is monitored and facilities reallocated in response to changing requirements.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.3.7 Scheduling of general-purpose facilities is managed through an electronic booking and reservation system, and the extent and efficiency of use is monitored and reported
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.3.8 Arrangements are made for shared use of underutilized facilities with adequate mechanisms for security of equipment.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_7_3()
    {
        return $this->get_property('7_3')->get_value();
    }

    public function set_7_4($value)
    {
        $property = new \Orm_Property_Textarea('7_4', $value);
        $property->set_description('7.4 Information Technology');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				7.4.1   Adequate computing equipment is available and accessible for teaching and other staff and students throughout the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    7.4.2   The adequacy of provision of computer equipment and support services is regularly assessed (through surveys or other means and comparisons with other institutions). 7.3.2 Services such as cleaning, waste disposal, minor maintenance, safety, and environmental management are efficiently and effectively carried out under the supervision of a senior administrative officer.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.3 Policies are established and effectively implemented governing the use of personal computers by students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.4 Technical support is available for staff and students using information and communications technology.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.5 Opportunities are available for teaching staff input into plans for acquisition and replacement of IT equipment.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.6 An institution-wide acquisitions and replacement policy is established for software and hardware to ensure that systems remain up to date and that compatibility is maintained as replacements are made
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.7 Security systems are in place to protect privacy of sensitive personal and institutional information, and to protect against externally introduced viruses.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.8 A code of conduct is established relating to inappropriate use of material on the Internet.  Compliance with this code of conduct is checked and instances of inappropriate behavior dealt with appropriately.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.9 Training programs are provided for teaching and other staff to ensure effective use of computing equipment and appropriate software for teaching, student assessment, and administration.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.10  Effective use is made of information technology for administrative systems, reporting, and communications across the institution.  Software systems are coordinated to ensure compatibility where relevant.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.11 Internal information systems are compatible and integrated with external reporting requirements.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_7_4()
    {
        return $this->get_property('7_4')->get_value();
    }

    public function set_7_5($value)
    {
        $property = new \Orm_Property_Textarea('7_5', $value);
        $property->set_description('7.5 Student Residences');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				7.5.1 Residences are of appropriate standard, providing a healthy, safe and secure environment for students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    7.5.2 Adequate facilities are available for privacy and individual study.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.5.3 Facilities that are adequate and appropriate for the students attending the institution are provided for social and cultural and physical activities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.5.4 Clearly defined codes of behaviour for student residences are established and formally agreed to by students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.5.5 The residences are effectively supervised by staff with the experience, expertise and authority to manage the facility as a secure and supportive learning environment.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.5.6 Adequate food, service, and medical facilities are available or readily accessible.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.5.7 Adequate and appropriate religious facilities are provided and maintained.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.5.8 The residences are close to the campus or adequate transport facilities are provided to ensure easy access
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_7_5()
    {
        return $this->get_property('7_5')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Quality of Standard 7. Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
