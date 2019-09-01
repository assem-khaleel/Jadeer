<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ssri_g_evaluation_11_institutional_relationships
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation_11_Institutional_Relationships extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '11. Institutional Relationships with the Community';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_community();
            $this->set_explanatory_report('');
            $this->set_standard_description('');
            $this->set_report_on_sub_standards();
            $this->set_11_1('');
            $this->set_11_2('');
            $this->set_11_3('');
            $this->set_quality_mission('');
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
            $kpi_1->set_name('KPI S11.1');
            $kpi_1->set_kpi_info('32. Proportion of full time teaching and other staff actively engaged in community service activities.');
            $kpi_1->set_kpi_ref_num('S11.1');
            $children[] = $kpi_1;

            $kpi_2 = new kpi();
            $kpi_2->set_name('KPI S11.2');
            $kpi_2->set_kpi_info('33. Number of community education programs provided as a proportion of the number of departments.');
            $kpi_2->set_kpi_ref_num('S11.2');
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
        $property->set_class('Node\ncai18\Ses_Standard_11_Overall');
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

    public function set_community()
    {
        $property = new \Orm_Property_Fixedtext('community', 'Contributing to the community must be recognized as an important institutional responsibility.  Facilities and services are made available to assist with community developments, teaching and other staff must be encouraged to be involved in the community and information about the institution and its activities made known.  Community perceptions of the institution must be monitored and appropriate strategies adopted to improve understanding and enhance its reputation.');
        $this->set_property($property);
    }

    public function get_community()
    {
        return $this->get_property('community')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description("Provide an explanatory report about institutional policies for community service activities and media or other contacts to develop community understanding and support.  The explanation should include information about how contributions to the community are recognized within the institution.");
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

    public function set_11_1($value)
    {
        $property = new \Orm_Property_Textarea('11_1', $value);
        $property->set_description('11.1 Institutional Policies on Community Relationships ');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				11.1.1 The service commitment of the institution is relevant to the community or communities within which the institution operates, and included in its mission.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.1.2  Policies on the institution’s service role have been approved by the governing body and these policies should be supported in decisions made by senior administrators
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.1.3  Annual reports are prepared on the institutions contributions to the community.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.1.4  Promotion criteria and faculty assessments include contributions made to the community.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.1.5   Websites providing details of institutional structures and activities, including news items of potential interest to potential students and members of  the wider community, are provided and  kept up to date.
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
        $property->set_description('11.2 Interactions with the Community');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				11.2.1  Staff are encouraged to participate in forums in which significant community issues are discussed and plans for community development considered.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.2.2 The institution and its colleges and departments cooperate in the establishment of community support or professional service agencies relevant to the needs of the community, drawing on the expertise of staff members.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.2.3 A range of community education courses are provided in areas of interest and need.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.2.4 Relationships are established with local industries and employers to assist program delivery.  (These may include, for example, placement of students for work-study programs, part time employment opportunities, and identification of issues for analysis in student project activities.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.2.5 Local employers and members of professions have been  invited to join appropriate advisory committees considering programs and other institutional activities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.2.6 Continuing contact is maintained with schools in the community, offering assistance and support in areas of specialization, providing information about the institution’s programs and activities and subsequent career opportunities, and arranging enrichment activities for the schools.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.2.7 Regular contact is maintained with alumni, keeping them informed about institutional developments, inviting their participation in activities, and encouraging their financial and other support for new developments.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.2.8 Advantage is taken of opportunities to seek funding support from individuals and organizations in the community for research and other developments in the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.2.9 A central data-base is maintained in which records are maintained of community services undertaken by individuals and organizations throughout the institution.
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

    public function set_11_3($value)
    {
        $property = new \Orm_Property_Textarea('11_3', $value);
        $property->set_description('11.3 Institutional Reputation');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				11.3.1 A comprehensive strategy has been developed for monitoring and improving the reputation of the institution in the local and other relevant communities.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.3.2 Clear guidelines have been established for public comments on behalf of the institution, normally restricting such comments to the Rector or Dean or a media office responsible to the Rector or Dean.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.3.3 Guidelines have been established for public comments on community issues by members of staff, where such comments could be associated with the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.3.4 An institutional media office has been established with responsibility for managing media communications, seeking information about activities of the institution of potential interest to the community, and arranging for publication.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.3.5 Community views about the institution and its activities are sought and strategies developed for improving perceptions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				11.3.6 If issues or concerns about operational issues involving the institution are raised in public forums these are dealt with immediately and objectively by the Rector or Dean or other designated senior members of faculty or staff.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_11_3()
    {
        return $this->get_property('11_3')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Quality Standard 11.  Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

}
