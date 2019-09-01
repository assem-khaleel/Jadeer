<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_h_standard_7
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 7. Facilities and Equipment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_teaching_and_learning('');
            $this->set_standard_description('');
            $this->set_explanatory_report('');
            $this->set_7_1('');
            $this->set_7_2('');
            $this->set_7_3('');
            $this->set_7_4('');
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
            $kpi_1->set_name('KPI S7.1');
            $kpi_1->set_kpi_info('20. Annual expenditure on IT budget,  including:'
                . '<ol  type="a"> '
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
            $kpi_3->set_kpi_info('22. Stakeholder evaluation of'
                . '<ol  type="a">'
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
        $property->set_class('Node\ncassr14\Ses_Standard_7_Overall');
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

    public function set_teaching_and_learning()
    {
        $property = new \Orm_Property_Fixedtext('teaching_and_learning', 'Adequate facilities and equipment must be available for the teaching and learning requirements of the program.  Use of facilities and equipment should be monitored and regular assessments of adequacy made through consultations with teaching and other staff and students <br/>'
            . 'Much of the responsibility for this standard may be institutional rather than program administration. However, the program is responsible to assessing the quality of this standard.   In this standard analysis should be made on matters that impact on the quality of delivery of the program.  These matters would include, for example, adequacy of classroom and laboratory facilities, availability and maintenance of equipment, appropriateness for the program of scheduling arrangements, and availability, maintenance, and technical support for IT equipment in meeting program needs');
        $this->set_property($property);
    }

    public function get_teaching_and_learning()
    {
        return $this->get_property('teaching_and_learning')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Describe the processes used to evaluate the quality of provision of facilities and equipment for the program.');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description('Provide an explanatory report about arrangements for provision of facilities and equipment for the following sub-standards');
        $this->set_property($property);
    }

    public function get_explanatory_report()
    {
        return $this->get_property('explanatory_report')->get_value();
    }

    public function set_7_1($value)
    {
        $property = new \Orm_Property_Textarea('7_1', $value);
        $property->set_description('7.1 Policy and Planning');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				7.1.1 Equipment acquisitions meet program requirements and are also consistent with institutional policies to achieve compatibility of equipment and software systems across the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.1.2  Teaching staff are consulted before major equipment acquisitions to ensure that current and anticipated emerging needs are met.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.1.3  Equipment planning provides for acquisition, servicing and  replacement according to a planned schedule.
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
				7.2 1  Facilities meet health and safety requirements and make adequate provision for the personal security of faculty, staff and students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.2.2 Quality assessment processes include both feedback from principal users about the adequacy and quality of facilities, and mechanisms for considering and responding to their views.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.2.3 Standards of provision of teaching, laboratory and research facilities are adequate for the needs of the program and benchmarked through comparisons with other comparable institutions. (This includes such things as classroom space, laboratory facilities and equipment, access to computing facilities and associated software, private study facilities, and research equipment.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.2.4 Adequate facilities are available for confidential consultations between faculty and students)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.2.5 Provision is made for students, faculty and staff with physical disabilities or other special needs.
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
        $property->set_description('7.3 Management and Administration of Facilities and Equipment');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				7.3.1 A complete inventory is maintained of equipment used in the program that is owned or controlled by the institution including equipment assigned to individual faculty or staff for teaching and research.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.3.2 Services such as cleaning, waste disposal, minor maintenance, safety, and environmental management are efficiently and effectively carried out.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.3.3 Provision is made for regular condition assessments, preventative and corrective maintenance, and replacement.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.3.4 Effective security is provided for specialized facilities and equipment for teaching and research, with responsibility between individual faculty, departments or colleges, or central administration clearly defined.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.3.5 Effective systems are in place to ensure the personal security of faculty, staff and students, with appropriate provisions for the security of their personal property.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.3.6 Arrangements are made for shared use of underutilized facilities with adequate mechanisms for security of equipment.
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
				7.4.1  Computing equipment is available and accessible for faculty, staff and students and the adequacy of this provision is regularly assessed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.2 Institutional policies governing the use of personal computers by students are complied with
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.3 Technical support is available for  teaching staff and students using information and communications technology.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.4 Opportunities are available for teaching staff input into plans for acquisition and replacement of IT equipment for use in the program.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.5 Security systems are in place to protect privacy of personal and sensitive personal and institutional information, and to protect against externally introduced viruses.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.6 Compliance with a code of conduct relating to inappropriate use of material on the internet is checked and instances of inappropriate behavior dealt with appropriately.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				7.4.7 Training programs are available for faculty and staff to ensure effective use of computing equipment and appropriate software for teaching, student assessment, and administration
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

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Evaluation of facilities and equipment for the program.  Refer to evidence about the standard and sub-standards within it and provide a report including a list of strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
