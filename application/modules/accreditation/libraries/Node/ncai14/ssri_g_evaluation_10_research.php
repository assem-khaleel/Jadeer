<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ssri_g_evaluation_10_research
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation_10_Research extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '10. Research';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_teaching_staff('');
            $this->set_explanatory_report('');
            $this->set_standard_description('');
            $this->set_report_on_sub_standards('');
            $this->set_10_1('');
            $this->set_10_2('');
            $this->set_10_3('');
            $this->set_10_4('');
            $this->set_quality_mission('');
            $this->set_quality_mission_1('');
            $this->set_quality_mission_2('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 10;
        $standard_obj = \Orm_Standard::get_one(['code' => 10]);

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
            $kpi_1->set_name('KPI S10.1');
            $kpi_1->set_kpi_info('26. Number of refereed publications in the previous year per full time equivalent teaching staff. (Publications based on the formula in the Higher Council Bylaw excluding conference presentations)');
            $kpi_1->set_kpi_ref_num('S10.1');
            $children[] = $kpi_1;

            $kpi_2 = new kpi();
            $kpi_2->set_name('KPI S10.2');
            $kpi_2->set_kpi_info('27. Number of citations in refereed journals in the previous year per full time equivalent faculty members.');
            $kpi_2->set_kpi_ref_num('S10.2');
            $children[] = $kpi_2;

            $kpi_3 = new kpi();
            $kpi_3->set_name('KPI S10.3');
            $kpi_3->set_kpi_info('28. Proportion of full time member of teaching staff with at least one refereed publication during the previous year.');
            $kpi_3->set_kpi_ref_num('S10.3');
            $children[] = $kpi_3;

            $kpi_4 = new kpi();
            $kpi_4->set_name('KPI S10.4');
            $kpi_4->set_kpi_info('29. Number of papers or reports presented at academic conferences during the past year per full time equivalent faculty members.');
            $kpi_4->set_kpi_ref_num('S10.4');
            $children[] = $kpi_4;

            $kpi_5 = new kpi();
            $kpi_5->set_name('KPI S10.5');
            $kpi_5->set_kpi_info('30. Research income from external sources in the past year as a proportion of the number of full time faculty members.');
            $kpi_5->set_kpi_ref_num('S10.5');
            $children[] = $kpi_5;

            $kpi_6 = new kpi();
            $kpi_6->set_name('KPI S10.6');
            $kpi_6->set_kpi_info('31. Proportion of the total, annual operational budget dedicated to research.');
            $kpi_6->set_kpi_ref_num('S10.6');
            $children[] = $kpi_6;
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
        $property->set_class('Node\ncai14\Ses_Standard_10_Overall');
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

    public function set_teaching_staff()
    {
        $property = new \Orm_Property_Fixedtext('teaching_staff', 'All staff teaching higher education programs must be involved in sufficient appropriate scholarly activities to ensure they remain up to date with developments in their field, and those developments should be reflected in their teaching.  Staff teaching in post graduate programs or supervising higher degree research students must be actively involved in research in their field.  Adequate facilities and equipment must be available to support the research activities of teaching staff and post graduate students to meet these requirements. In universities and other institutions with research responsibility, teaching staff must be encouraged to pursue research interests and to publish the results of that research.   Their research contributions must be recognized and reflected in evaluation and promotion criteria.  The research output of the institution must be monitored and benchmarked against that of other similar institutions.  Clear and equitable policies must be established for ownership and commercialization of intellectual property.');
        $this->set_property($property);
    }

    public function get_teaching_staff()
    {
        return $this->get_property('teaching_staff')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description("Provide an explanatory report describing the nature and extent of research involvement of the institution and of teaching staff within it.  The explanation should include a description of organizational arrangements for developing and monitoring research activity across the institution; including any research centers and activities to encourage research by individual staff members.  Indicators used for monitoring research performance should be listed.");
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

    public function set_10_1($value)
    {
        $property = new \Orm_Property_Textarea('10_1', $value);
        $property->set_description('10.1 Institutional Research Policies');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				10.1.1   A research development plans consistent with the nature and mission of the institution and the economic and cultural development needs of the region  has been developed and published.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.1.2 The research development plan  includes clearly specified indicators and benchmarks of performance.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.1.3 Clear policies are established for defining what is recognized as research, consistent with international standards.  (This normally includes both self-generated and commissioned activity, but requires creative original work, independently validated by peers, and published in media that are highly regarded by scholars in the field.)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.1.4 Reports on overall institutional research performance are published annually and records maintained of the research activities of individuals, departments and colleges..
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.1.5   Cooperation with local industry and with other research agencies is actively encouraged.  Where appropriate these forms of cooperation may involve joint research projects, shared use of equipment, and cooperative strategies for development.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.1.6   Mechanisms are established for collaboration and cooperation with international universities and research networks.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.1.7   The institution has policies that deal with the establishment, accountability, and periodic review of research institutes or centers.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.1.8  The establishment of research institutes or centers does not inhibit research activities of others who are not directly associated with them.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.1.9   A high level committee is established to monitor compliance with ethical standards and approve research projects with potential impact on ethical issues.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.1.10 An adequate research budget is provided to enable the achievement of the institution’s research plan.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_10_1()
    {
        return $this->get_property('10_1')->get_value();
    }

    public function set_10_2($value)
    {
        $property = new \Orm_Property_Textarea('10_2', $value);
        $property->set_description('10.2 Faculty and Student Involvement in Research');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				10.2.1 Expectations for teaching staff involvement in research and scholarly activities are clearly specified and considered in performance evaluation and promotion criteria. (For universities there is an expectation of at least some research and/or appropriate scholarly activity of all full time teaching staff).
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.2.2 Support is provided for junior teaching staff in the development of their research programs through mechanisms such as mentoring by senior colleagues, inclusion in project teams, assistance in developing research proposals, and start up funding.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.2.3 Postgraduate research students are given opportunities for participation in joint research projects.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.2.4 When research students are involved in joint research projects their contributions are appropriately acknowledged.  When a significant contribution has been made reports and publications carry joint authorship.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.2.5 Assistance is available for teaching staff to develop collaborative research arrangements with colleagues in other institutions and in the international community.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.2.6 Research and scholarly activities of teaching staff that are relevant to courses they teach are reflected in their teaching together with other significant research developments in the field.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.2.7 Strategies are developed for identifying and capitalizing on the expertise of teaching staff and postgraduate students in providing research and development services to the community and generating financial returns to the institution.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_10_2()
    {
        return $this->get_property('10_2')->get_value();
    }

    public function set_10_3($value)
    {
        $property = new \Orm_Property_Textarea('10_3', $value);
        $property->set_description('10.3 Commercialization of Research');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				10.3.1 A research development unit or center is established with capacity to identify and publicize institutional expertise and commercial development opportunities, assist in developing proposals and business plans,  preparation of contracts, and when appropriate, development of spin off companies.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.3.2 Ideas with potential for commercial development are critically evaluated with advice from experienced persons from industry and relevant professions before investment by the institution is authorized.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.3.3 Intellectual property policies define ownership and establish procedures for commercialization of ideas developed by staff and students, and specify scales for equitable sharing of returns to the inventor(s), and the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.3.4 A culture of entrepreneurship is actively encouraged throughout the institution, with particular emphasis on teaching staff and postgraduate students.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.3.5 Regulations are established that require disclosure of pecuniary interest and avoidance of conflict of interest in activities related to research.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_10_3()
    {
        return $this->get_property('10_3')->get_value();
    }

    public function set_10_4($value)
    {
        $property = new \Orm_Property_Textarea('10_4', $value);
        $property->set_description('10.4  Facilities and Equipment');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				10.4.1  Adequate laboratory space and equipment, library and information systems and resources are available to support the research activities of teaching staff and students in the fields in which programs are offered.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.4.2 An adequate budget is provided for funding of research equipment and facilities in all academic sections of the institution
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.4.3 Arrangements are made for joint ownership or shared access to major equipment items within the institution and with other organizations if appropriate.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.4.4   Security systems are established that ensure safety for researchers and their activities,  the institutional community and the surrounding area.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.4.5 Policies are established to make clear the ownership and responsibility for maintenance of equipment obtained through research grants, commissioned research or other external sources.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_10_4()
    {
        return $this->get_property('10_4')->get_value();
    }

    public function set_quality_mission()
    {
        $property = new \Orm_Property_Fixedtext('quality_mission', '<strong>Overall Evaluation of Research Performance.  Provide a report:</strong>');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
    }

    public function set_quality_mission_1($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission_1', $value);
        $property->set_description('1) for a university, the report should include statistical data on the extent and quality of research activities; including competitive grants, publications and citations and other relevant information benchmarked against appropriate institutional benchmarks;');
        $this->set_property($property);
    }

    public function get_quality_mission_1()
    {
        return $this->get_property('quality_mission_1')->get_value();
    }

    public function set_quality_mission_2($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission_2', $value);
        $property->set_description('2) for a college, this information can be included but the report must include data on professional or scholarly activities that ensure teaching staff are up to date with developments in their teaching field.  The report should include summary analysis that lists strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_quality_mission_2()
    {
        return $this->get_property('quality_mission_2')->get_value();
    }

}
