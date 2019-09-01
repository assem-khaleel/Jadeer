<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_11
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_11 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 11. Relationships with the Community';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_community_relation();
            $this->set_standard_description('');
            $this->set_explanatory_report('');
            $this->set_11_1('');
            $this->set_11_2('');
            $this->set_evaluation_report('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 11;
        $standard_obj = \Orm_Standard::get_one(['code' => 11]);

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
            $kpi_1->set_name('KPI S11.1');
            $kpi_1->set_kpi_info('32. Proportion of full time teaching and other staff actively engaged in community service activities.');
            $kpi_1->set_kpi_ref_num('S11.1');
            $children[] = $kpi_1;
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
        $property->set_class('Node\ncassr18\Ses_Standard_11_Overall');
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

    public function set_community_relation()
    {
        $property = new \Orm_Property_Fixedtext('community_relation', 'Significant and appropriate contributions must be made to the community in which the institution is established drawing on the knowledge and experience of staff and the needs of the community for that expertise. Community contributions should include both activities initiated and carried out by individuals and more formal programs of assistance arranged by the institution or by program administrators. Activities should be documented and made known in the institution and the community and staff contributions appropriately recognized within the institution');
        $this->set_property($property);
    }

    public function get_community_relation()
    {
        return $this->get_property('community_relation')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Describe the processes used to evaluate performance in relation to this standard and summarize the evidence obtained.');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description('Provide an explanatory report about community activities carried out in connection with the program for the following sub-standards');
        $this->set_property($property);
    }

    public function get_explanatory_report()
    {
        return $this->get_property('explanatory_report')->get_value();
    }

    public function set_11_1($value)
    {
        $property = new \Orm_Property_Textarea('11_1', $value);
        $property->set_description('11.1 Policies on Community Relationships');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				11.1 The service commitment of the program should be defined in a way that reflects the community or communities within which the institution operates, and the skills and abilities of staff teaching in the program.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.1.2 The contributions to the community made by staff  teaching in the program are recorded and reported upon on  an annual basis.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.1.3 Promotion criteria and faculty assessments include contributions made to the community.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				11.1.4 Departmental or program initiatives in working with the community are coordinated with responsible units in the institution to avoid duplication and possible confusion.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_11_1()
    {
        return $this->get_property('11_1')->get_value();
    }

    public function set_11_2($value)
    {
        $property = new \Orm_Property_Textarea('11_2', $value);
        $property->set_description('11.2 Interactions with the Community (Report description should include reference to interactions with the community by faculty)');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				11.2.1 Staff are encouraged to participate in forums in which significant community issues are discussed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.2.2 In a professional program relationships are established with local industries and employers to participate on advisory committees and assist program delivery.  (These may include, for example, placement of students for work-study programs, part time employment opportunities, and identification of issues for analysis in student project activities.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.2.3 Local employers and members of professions are invited to join appropriate advisory committees.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				11.2.4 Contacts are established with schools in the region offering assistance and support in areas of specialization, providing information about the program and subsequent career opportunities for graduates, and arranging enrichment activities for students at the schools. (If a section within the institution has responsibility for coordinating these relationships these contacts are arranged in consultation with that section.)
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				11.2.5 Regular contact is maintained with alumni, keeping them informed about institutional developments, inviting their participation in activities, and encouraging their financial and other support for new initiatives.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				11.2.6  Opportunities are taken in cooperation with institutional administrators to seek funding support from individuals and organizations in the community for research and other developments associated with the program.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				11.2.7  Records are maintained of community services undertaken by individuals and centers or other organizations within the department and provided regularly for recording in a central data base within the institution.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_11_2()
    {
        return $this->get_property('11_2')->get_value();
    }

    public function set_evaluation_report($value)
    {
        $property = new \Orm_Property_Textarea('evaluation_report', $value);
        $property->set_description('Evaluation of the extent and quality of community activities associated with the program and of staff teaching in it. Provide a  report about the standard and sub-standards within it including tables showing the extent of community activities and  a list of  strengths, recommendations for improvement, and priorities for action');
        $this->set_property($property);
    }

    public function get_evaluation_report()
    {
        return $this->get_property('evaluation_report')->get_value();
    }

}
