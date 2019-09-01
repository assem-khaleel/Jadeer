<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_10
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_10 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 10. Research ';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_research();
            $this->set_standard_description('');
            $this->set_explanatory_report('');
            $this->set_10_1('');
            $this->set_10_2('');
            $this->set_evaluation_report('');
            $this->set_program_research();
            $this->set_program_research_table(array());
            $this->set_research_approval('');
            $this->set_strategic_plan('');
            $this->set_policy_manual('');
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
        $property->set_class('Node\ncassr18\Ses_Standard_10_Overall');
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

    public function set_research()
    {
        $property = new \Orm_Property_Fixedtext('research', 'All staff teaching higher education programs must be involved in sufficient appropriate scholarly activities to ensure they remain up to date with developments in their field, and those developments should be reflected in their teaching.  Staff teaching in post graduate programs or supervising higher degree research students must be actively involved in research in their field.  Adequate facilities and equipment must be available to support the research activities of teaching staff and post graduate students to meet these requirements in areas relevant to the program. Staff research contributions must be recognized and reflected in evaluation and promotion criteria. <br/>'
            . 'Expectations for research vary according to the mission of the institution and the level of the program (e.g. college or university, undergraduate or postgraduate program).  In this standard an analysis should be made on the extent and quality of research activities of faculty teaching in the program, and on how their research and other current research in the field is reflected in teaching.');
        $this->set_property($property);
    }

    public function get_research()
    {
        return $this->get_property('research')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Describe the processes used to evaluate performance in relation to this standard');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description('Provide an explanatory report about nature and extent of research activities associated with the program or carried out by staff teaching in it for the following sub-standards');
        $this->set_property($property);
    }

    public function get_explanatory_report()
    {
        return $this->get_property('explanatory_report')->get_value();
    }

    public function set_10_1($value)
    {
        $property = new \Orm_Property_Textarea('10_1', $value);
        $property->set_description('10.1 Teaching Staff and Student Involvement in Research');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				10.1.1  Expectations for teaching staff involvement in research and scholarly activities are clearly specified and considered in performance evaluation and promotion criteria. (For universities criteria require at least some research and/or appropriate scholarly activity of all full time teaching staff).
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.1.2 Clear policies are established in the institution for defining what is recognized as research, consistent with international standards and established  norms in the field of study of  the program.  (This normally includes both self-generated and commissioned activity but requires creative original work, independently validated by peers, and published in media recognized internationally in the field of study)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.1.3  Support is provided for junior staff in the development of their research programs through mechanisms such as mentoring by senior colleagues, inclusion in project teams, assistance in developing research proposals, and seed funding.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				10.1.4  Postgraduate research students are given opportunities for participation in joint research projects.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				10.1.5  When research students are involved in joint research projects their contributions are appropriately acknowledged.  When a significant contribution has been made reports and publications carry joint authorship.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				10.1.6  Assistance is available for teaching staff  to develop collaborative research arrangements with colleagues in other institutions and in the international community.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				10.1.7  Research and scholarly activities of  teaching staff  that are relevant to courses they teach are reflected in their teaching together with other significant research developments in the field.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				10.1.8  Strategies are developed for identifying and capitalizing on the expertise of faculty and postgraduate students in providing research and development services to the community and generating financial returns to the institution.
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
        $property->set_description('10.2 Research Facilities and Equipment');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				10.2.1  Adequate  laboratory space and equipment, library and information systems resources are available to support the  research activities of faculty and students in  the field in which the program is offered.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.2.2  Security systems  are established that ensure safety for researchers and their  activities,  the institutional community and the surrounding region.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				10.2.3  Policies are established to make clear the ownership and responsibility for maintenance of equipment obtained through faculty research grants, commissioned research or other external sources.
				</li>
				<li class='list-group-item no-border-hr no-border-b padding-xs-hr no-bg'>
				10.2.4  Adequate budget and facilities are provided for the conduct of research at a level consistent with institutional, program and departmental.
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

    public function set_evaluation_report($value)
    {
        $property = new \Orm_Property_Textarea('evaluation_report', $value);
        $property->set_description('Evaluation of research activities associated with the program and of staff teaching in it. Provide a report about the standard and sub-standards within it.  Tables should be provided indicating the amount of research activity and other participation in scholarly activity and comparisons with appropriate benchmarks. The report should include a list of strengths, recommendations for improvement, and priorities for action.');
        $this->set_property($property);
    }

    public function get_evaluation_report()
    {
        return $this->get_property('evaluation_report')->get_value();
    }

    public function set_program_research()
    {
        $property = new \Orm_Property_Fixedtext('program_research', '<strong>Program Research Information Table <br/>(For all individual branch / location campuses)</strong>'
            . '<i>Complete the <strong> Program Research Information Table </strong> for each branch / location campus that offers the specific program. FTE (full-time equivalent) is calculated as 12 credit hours and should not include research, teaching or laboratory assistants.</i>');
        $this->set_property($property);
    }

    public function get_program_research()
    {
        return $this->get_property('program_research')->get_value();
    }

    public function set_program_research_table($value)
    {
        $property = new \Orm_Property_Table_dynamic('program_research_table', $value);
        $property->set_is_responsive(true);

        $branch = new \Orm_Property_Text('branches');
        $branch->set_description('Program Branch / Location Campus(City)');
        $property->add_property($branch);

        $annual_research = new \Orm_Property_Text('annual_research');
        $annual_research->set_description('Annual Research Budget Total Amount');
        $property->add_property($annual_research);

        $actual_research = new \Orm_Property_Text('actual_research');
        $actual_research->set_description('Annual Research Budget Actual Expenditure');
        $property->add_property($actual_research);

        $publication_male = new \Orm_Property_Text('publication_male');
        $publication_male->set_description('Publications Per FTE Faculty Member Per Year (male)');
        $property->add_property($publication_male);

        $publication_female = new \Orm_Property_Text('publication_female');
        $publication_female->set_description('Publications Per FTE Faculty Member Per Year (female)');
        $property->add_property($publication_female);

        $research_male = new \Orm_Property_Text('research_male');
        $research_male->set_description('Research Conference Presentations Per FTE Faculty Per Year (male)');
        $property->add_property($research_male);

        $research_female = new \Orm_Property_Text('research_female');
        $research_female->set_description('Research Conference Presentations Per FET Faculty Per Year (female)');
        $property->add_property($research_female);

        $describe_research = new \Orm_Property_Text('describe_research');
        $describe_research->set_description('Describe Research Activity (past 2 years)');
        $property->add_property($describe_research);

        $this->set_property($property);
    }

    public function get_program_research_table()
    {
        return $this->get_property('program_research_table')->get_value();
    }



    public function set_research_approval($value)
    {
        $property = new \Orm_Property_Upload('research_approval', $value);
        $property->set_description('1. Attach the research approval flowchart');
        $this->set_property($property);
    }

    public function get_research_approval()
    {
        return $this->get_property('research_approval')->get_value();
    }

    public function set_strategic_plan($value)
    {
        $property = new \Orm_Property_Upload('strategic_plan', $value);
        $property->set_description('2. Attach the program research strategic plan');
        $this->set_property($property);
    }

    public function get_strategic_plan()
    {
        return $this->get_property('strategic_plan')->get_value();
    }

    public function set_policy_manual($value)
    {
        $property = new \Orm_Property_Upload('policy_manual', $value);
        $property->set_description('3. Attach the research policy manual (including research ethics policy)');
        $this->set_property($property);
    }

    public function get_policy_manual()
    {
        return $this->get_property('policy_manual')->get_value();
    }

    public function header_actions(&$actions = array()) {

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            if ($this->check_if_editable()) {
                $actions[] = array(
                    'class' => 'btn',
                    'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                    'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
                );
            }
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            $program_node = $this->get_parent_program_node();
            if (!is_null($program_node) && $program_node->get_id()) {
                $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
                $department_obj = $program_obj->get_department_obj();
                $college_obj = $department_obj->get_college_obj();

                $research_data = $this->get_program_research_table();

                $annual_research = \Orm_Data_Research_Budget::get_one(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_research_budget_total_amount() +
                    \Orm_Data_Research_Budget::get_one(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_FEMALE))->get_research_budget_total_amount();

                $research_data[2]['branches'] = 'Main Campus';
                $research_data[2]['annual_research'] = $annual_research;
                $research_data[2]['actual_research'] = \Orm_Data_Research_Budget::get_one(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year()))->get_research_budget_actual_expenditure();
                $research_data[2]['publication_male'] = \Orm_Data_Research_Budget::get_one(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_publications_count();
                $research_data[2]['publication_female'] = \Orm_Data_Research_Budget::get_one(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_publications_count();
                $research_data[2]['research_male'] = \Orm_Data_Research_Budget::get_one(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_publications_count();
                $research_data[2]['research_female'] = \Orm_Data_Research_Budget::get_one(array('program_id' => $program_obj->get_id(),'academic_year' => $this->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_publications_count();

                $this->set_program_research_table($research_data);
            }

            $this->save();
        }
    }
}
