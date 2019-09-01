<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_6
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 6. Learning Resources';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_learning_resources();
            $this->set_standard_description('');
            $this->set_explanatory_report('');
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
            $kpi_1->set_name('KPI S6.1');
            $kpi_1->set_kpi_info('17. Stakeholder evaluation of library and media center. (Average overall rating of the adequacy of the library and media center, including: '
                . '<ol type="a">'
                . '<li>Staff assistance,</li>'
                . '<li>Current and up-to-date</li>'
                . '<li>Copy and print facilities</li>'
                . '<li>Functionality of equipment,</li>'
                . '<li>Atmosphere or climate for studying  f) Availability of study sites, and</li>'
                . '<li>Any other quality indicators of service on a five- point scale of an annual survey.)</li>'
                . '</ol>');
            $kpi_1->set_kpi_ref_num('S6.1');
            $children[] = $kpi_1;

            $kpi_3 = new kpi();
            $kpi_3->set_name('KPI S6.3');
            $kpi_3->set_kpi_info('19. Stakeholder evaluation of the digital library. (Average overall rating of the adequacy of the digital library, including:'
                . '<ol type="a">'
                . '<li>User friendly website</li>'
                . '<li>Availability of the digital databases,</li>'
                . '<li>Accessibility for users, <br/> d) Library skill training and</li>'
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
        $property->set_class('Node\ncassr18\Ses_Standard_6_Overall');
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

    public function set_learning_resources()
    {
        $property = new \Orm_Property_Fixedtext('learning_resources', 'Learning resource materials and associated services must be adequate for the requirements of the program and the courses offered within it and accessible when required for students in the program. Information about requirements must be made available by teaching staff in sufficient time for necessary provisions to be made for resources required, and staff and students must be involved in evaluations of what is provided.  Specific requirements for reference material and on-line data sources and for computer terminals and assistance in using this equipment will vary according to the nature of the program and the approach to teaching.');
        $this->set_property($property);
    }

    public function get_learning_resources()
    {
        return $this->get_property('learning_resources')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Describe the processes followed to investigate this standard and summarize the evidence obtained.');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description('Provide an explanatory report about processes for provision of learning resources for the program, including opportunities provided for teaching staff or program administrators to arrange for necessary resources to be made available, information about services provided and times available, equivalence of provisions for different sections, etc.  Complete this section using the following sub-standards');
        $this->set_property($property);
    }

    public function get_explanatory_report()
    {
        return $this->get_property('explanatory_report')->get_value();
    }

    public function set_6_1($value)
    {
        $property = new \Orm_Property_Textarea('6_1', $value);
        $property->set_description('6.1 Planning and Evaluation');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				6.1.1 Teaching staff responsible for the program and for courses within it regularly provide advice on materials required to support teaching and learning.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.1.2 Teaching staff and  students participate in user surveys dealing with adequacy of resources and services, extent of usage, consistency with requirements for teaching and learning
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.1.3 Data on the extent of usage of learning resources for the program are used in evaluations of learning and teaching in the program.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.1.4 In addition to participation in surveys program representatives have opportunities to provide input to evaluations of forward planning for provision of resources and services.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				6.1.5 Teaching staff provide regular advice on material that should be held in reserve to ensure access to necessary materials and this advice is responded to.
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
				6.2.1 Library and resource centers and associated facilities and services are available for sufficient extended hours to ensure access when required by users in the program.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.2.2 Heavy demand and required reading materials needed in the program are held in reserve collections.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.2.3 Ready access to on-line data-bases and research and journal material relevant to the program is provided for.
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
				6.3.1 Orientation and training programs are provided for new students in the program to prepare them to access facilities and services.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.3.2 Assistance is available to assist faculty and students in the program in conducting searches and locating and using information.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.3.3 A reference service is available through which in-depth questions are answered by qualified librarians
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.3.4 Electronic and/or other automated systems with search facilities are available to assist in locating resources within the institution and in other collections.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.3.5 Teaching staff and students in the program are kept informed of library developments such as acquisition of new materials, training programs, or changes in services or opening hours.
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
				6.4.1  Adequate books, journals and other reference material including on line resources are available to meet program requirements.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.4.2 Up to date computer equipment and software is available on a sufficient scale to meet program requirements to support electronic access to resources and reference material.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.4.3 Books and journals and other materials are available in Arabic and English (or other languages) as required for the program and associated research.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				6.4.4 Sufficient facilities are provided for both individual and small group study and research as required for the program.
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
        $property->set_description('Evaluation of learning resources for students in the program.  Refer to evidence about the standard and sub-standards within it and provide a report including a list of strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
