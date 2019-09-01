<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ssri_g_evaluation_6_learning_resources
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation_6_Learning_Resources extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '6. Learning Resources';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_learning_resources('');
            $this->set_explanatory_report('');
            $this->set_standard_description('');
            $this->set_report_on_sub_standards('');
            $this->set_6_1('');
            $this->set_6_2('');
            $this->set_6_3('');
            $this->set_6_4('');
            $this->set_quality_mission('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 6;
        $standard_obj = \Orm_Standard::get_one(['code' => 6]);

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
            $kpi_1->set_name('KPI S6.1');
            $kpi_1->set_kpi_info('17.  Stakeholder evaluation of library and media center. (Average overall rating of the adequacy of the library and media center, including:'
                . '<ol type="a">'
                . '<li>Staff assistance,</li>'
                . '<li>Current and up-to-date</li>'
                . '<li>Copy and print facilities,</li>'
                . '<li>Functionality of equipment,</li>'
                . '<li>Atmosphere or climate for studying</li>'
                . '<li>Availability of study sites, and</li>'
                . '<li>Any other quality indicators of service on a five- point scale of an annual survey.)</li>'
                . '</ol>');
            $kpi_1->set_kpi_ref_num('S6.1');
            $children[] = $kpi_1;

            $kpi_2 = new kpi();
            $kpi_2->set_name('KPI S6.2');
            $kpi_2->set_kpi_info('18. Number of web site publication and journal subscriptions as a proportion of the number of programs offered.');
            $kpi_2->set_kpi_ref_num('S6.2');
            $children[] = $kpi_2;

            $kpi_3 = new kpi();
            $kpi_3->set_name('KPI S6.3');
            $kpi_3->set_kpi_info('19. Stakeholder evaluation of the digital library. (Average overall rating of the adequacy of the digital library, including: '
                . '<ol type="a">'
                . '<li> User friendly website</li>'
                . '<li>Availability of the digital databases,</li>'
                . '<li>Accessibility for users,</li>'
                . '<li>Library skill training and </li>'
                . '<li>Any other quality indicators of service on a five- point scale of an annual survey.)</li>'
                . '</ol>');
            $kpi_3->set_kpi_ref_num('S6.3');
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
        $property->set_class('Node\ncai14\Ses_Standard_6_Overall');
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

    public function set_learning_resources()
    {
        $property = new \Orm_Property_Fixedtext('learning_resources', 'Learning resources including libraries and provisions for access to electronic and other reference material must be planned to meet the particular requirements of the institution’s programs and provided at an adequate level.  Library and associated IT facilities must be accessible at times to support independent learning, with assistance provided in finding material required.  Facilities must be provided for individual and group study in an environment conducive to effective investigations and research. The services must be evaluated and improved in response to systematic feedback from teaching staff and students.');
        $this->set_property($property);
    }

    public function get_learning_resources()
    {
        return $this->get_property('learning_resources')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description("Provide an explanatory report about the provision of learning resources within the institution.  This should include information about the extent to which library services are provided centrally or within colleges.  If they are provided in different locations, descriptions should be given of any overall institutional coordination and performance monitoring.");
        $this->set_property($property);
    }

    public function get_explanatory_report()
    {
        return $this->get_property('explanatory_report')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Provide a description of the process for the preparation on this standard (if library services are provided in different locations this investigation should deal with provisions throughout the institution and draw conclusions about overall performance and variations between different locations).');
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

    public function set_6_1($value)
    {
        $property = new \Orm_Property_Textarea('6_1', $value);
        $property->set_description('6.1 Planning and Evaluation');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				6.1.1 Policies for the development of library and other learning resources and support services give special attention to the particular requirements for programs and research requirements at the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    6.1.2 A learning resource strategy has been developed which is directly linked to strategic priorities for program development, and adjusted as required as new programs are introduced.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.1.3 The adequacy of library and resource center materials is formally evaluated at least once every two years.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.1.4 Evaluation procedures include user surveys dealing with teaching staff and student satisfaction, extent of usage, consistency with requirements of teaching and learning at the institution, range of services, and comparisons of provision and user satisfaction with other comparable institutions
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.1.5 Evaluation processes include gathering of information on the extent to which library and other learning resources are used and analysis of this data in relation to teaching and learning requirements for different programs in the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.1.6   Teaching staff responsible for courses and programs regularly provide advice on materials required to support teaching and learning early enough for appropriate provision to be made.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.1.7 Reserve book and other reference materials are regularly reviewed with advice from teaching staff to ensure adequate access to necessary materials for courses on offer at any time.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_6_1()
    {
        return $this->get_property('6_1')->get_value();
    }

    public function set_6_2($value)
    {
        $property = new \Orm_Property_Textarea('6_2', $value);
        $property->set_description('6.2 Organization');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				6.2.1 Library and resource centers and associated facilities and services are available for sufficient extended hours to ensure access when required by users.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    6.2.2 Collections are arranged appropriately and cataloged according to internationally recognized good practice.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.2.3 Agreements are established for cooperation with other libraries and resource centers for interlibrary loans and sharing of resources and services.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.2.4 Reliable systems are in place for recording of  loans and returns, with efficient follow up for overdue material.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.2.5 Heavy demand and required reading materials are held in reserve collections.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.2.6 Ready access to on-line data-bases and research and journal material relevant to the institution’s programs is provided
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.2.7 Rules for behavior within the library are established and enforced to ensure maintenance of an environment conducive to effective study and student and staff research.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.2.8 Effective security systems are in place to prevent loss of materials and inappropriate use of the internet.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_6_2()
    {
        return $this->get_property('6_2')->get_value();
    }

    public function set_6_3($value)
    {
        $property = new \Orm_Property_Textarea('6_3', $value);
        $property->set_description('6.3 Support for Users');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				6.3.1 Orientation and training programs are provided for new students and other users to prepare them to access facilities and services.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    6.3.2 Assistance is available to assist users in conducting searches and locating and using information.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.3.3 A reference service is available through which in-depth questions are answered by qualified librarians.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.3.4 Electronic and/or other automated systems with search facilities are available to assist in locating resources within the institution and elsewhere.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.3.5 Users are kept informed of library developments such as acquisition of new materials, training programs, or changes in services or opening hours.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.3.6 Printed or electronic guides are provided to help users find materials for popular subject areas, compiling reference lists or using data bases.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.3.7 The library and resource centers are staffed by a sufficient number of people qualified and skilled in relevant fields of librarianship and information technology.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_6_3()
    {
        return $this->get_property('6_3')->get_value();
    }

    public function set_6_4($value)
    {
        $property = new \Orm_Property_Textarea('6_4', $value);
        $property->set_description('6.4 Resources and Facilities');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				6.4.1 Adequate financial resources are provided for acquisitions, cataloguing, equipment, and for services and system development.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
			    6.4.2 The availability of on line access and inter library loan facilities is not used to reduce commitment to providing adequate physical resources on site.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.4.3 Adequate facilities are available to house collections in a way that makes them readily accessible
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.4.4 Up to date computer equipment and software is available to support electronic access to resources and reference material.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.4.5 Copying facilities supported by efficient payment mechanisms are available for users.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.4.6 Adequate facilities are provided for use of personal  laptop computers.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.4.7 Books and journals and other materials are available in Arabic and English (or other languages) as required for the programs taught and research undertaken in the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.4.8 Sufficient facilities are provided for both individual and small group study and research.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.4.9 The level of provision of facilities and resources (numbers of books, seats, group study facilities etc.) is benchmarked against provisions at similar good quality institutions and is adequate for the size of the institution and the programs offered.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_6_4()
    {
        return $this->get_property('6_4')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Quality of Standard 6.  Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
