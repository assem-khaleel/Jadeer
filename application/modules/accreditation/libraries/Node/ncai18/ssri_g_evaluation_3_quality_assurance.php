<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ssri_g_evaluation_3_quality_assurance
 *
 * @author ahmadgx
 */
class Ssri_G_Evaluation_3_Quality_Assurance extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3. Management of Quality Assurance and Improvement';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_quality_assurance();
            $this->set_standard_description('');
            $this->set_summary_report('');
            $this->set_standard_kpi(array());
            $this->set_summary_and_analysis('');
            $this->set_report_on_sub_standards();
            $this->set_3_1('');
            $this->set_3_2('');
            $this->set_3_3('');
            $this->set_3_4('');
            $this->set_3_5('');
            $this->set_quality_mission('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 3;
        $standard_obj = \Orm_Standard::get_one(['code' => 3]);

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
            $kpi_1->set_name('KPI S3.1');
            $kpi_1->set_kpi_info('3. Students overall evaluation on the quality of their learning experiences.(Average rating of the overall quality on a five point scale in an annual survey of final year students.) ');
            $kpi_1->set_kpi_ref_num('S3.1');
            $children[] = $kpi_1;

            $kpi_2 = new kpi();
            $kpi_2->set_name('KPI S3.2');
            $kpi_2->set_kpi_info('4. Proportion of courses in which student evaluations were conducted during the year.');
            $kpi_2->set_kpi_ref_num('S3.2');
            $children[] = $kpi_2;

            $kpi_3 = new kpi();
            $kpi_3->set_name('KPI S3.3');
            $kpi_3->set_kpi_info('5. Proportion of programs in which there was an independent verification, within the institution, of standards of student achievement during the year.');
            $kpi_3->set_kpi_ref_num('S3.3');
            $children[] = $kpi_3;

            $kpi_4 = new kpi();
            $kpi_4->set_name('KPI S3.4');
            $kpi_4->set_kpi_info('6. Proportion of programs in which there was an independent verification of standards of student achievement by people (evaluators) external to the institution during the year');
            $kpi_4->set_kpi_ref_num('S3.4');
            $children[] = $kpi_4;
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
        $property->set_class('Node\ncai18\Ses_Standard_3_Overall');
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

    public function set_quality_assurance()
    {
        $property = new \Orm_Property_Fixedtext('quality_assurance', "Quality assurance processes must involve all sections of the institution and be effectively integrated into normal planning and administrative processes.  Criteria for assessment of quality must include inputs, processes and outcomes with a particular focus on outcomes.  Processes must be established to ensure that teaching and other staff and students are committed to improvement and regularly evaluate their own performance.  Quality must be assessed by reference to evidence based on indicators of performance and challenging external standards.");
        $this->set_property($property);
    }

    public function get_quality_assurance()
    {
        return $this->get_property('quality_assurance')->get_value();
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

    public function set_summary_report($value)
    {
        $property = new \Orm_Property_Textarea('summary_report', $value);
        $property->set_description('Provide a summary explanation of arrangements for quality assurance including major committees and organizational unit(s) and activities carried out at different levels of the institution (including colleges or departments).');
        $this->set_property($property);
    }

    public function get_summary_report()
    {
        return $this->get_property('summary_report')->get_value();
    }

    public function set_standard_kpi($value)
    {
        $property = new \Orm_Property_Table_Dynamic('standard_kpi', $value);
        $property->set_description('Provide a complete list of the institutional KPIs that are utilized in the SSRI to demonstrate that the institution meets NCAAA standards. Institutions are required to use 70% or more of the suggested NCAAA KPIs. Detailed individual KPI tables are located throughout the SSRI for institutions to demonstrate scientific evidence that a given standard or sub-standard is met.');
        $property->set_group('standard_kpi');

        $kpi_no = new \Orm_Property_Text('kpi_no');
        $kpi_no->set_description('KPI No.');
        $kpi_no->set_width(100);
        $property->add_property($kpi_no);

        $standard = new \Orm_Property_Text('standard');
        $standard->set_description('Standard / Sub-Standard the KPI applies to:');
        $standard->set_width(250);
        $property->add_property($standard);

        $kpi = new \Orm_Property_Text('kpi');
        $kpi->set_description('KPI');
        $kpi->set_width(250);
        $property->add_property($kpi);

        $this->set_property($property);
    }

    public function get_standard_kpi()
    {
        return $this->get_property('standard_kpi')->get_value();
    }

    public function set_summary_and_analysis($value)
    {
        $property = new \Orm_Property_Textarea('summary_and_analysis', $value);
        $property->set_description('Provide a summary and analysis of the institutional KPI outcomes (list strengths and recommendations for improvement based on an assessment of all the KPIs).');
        $this->set_property($property);
    }

    public function get_summary_and_analysis()
    {
        return $this->get_property('summary_and_analysis')->get_value();
    }

    public function set_report_on_sub_standards()
    {
        $property = new \Orm_Property_Fixedtext('report_on_sub_standard', "<strong>Report on subsection-standards</strong> <br/> <br/>");
        $this->set_property($property);
    }

    public function get_report_on_sub_standards()
    {
        return $this->get_property('report_on_sub_standards')->get_value();
    }

    public function set_3_1($value)
    {
        $property = new \Orm_Property_Textarea('3_1', $value);
        $property->set_description('3.1 Institutional Commitment to Quality Improvement');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				3.1.1 The Rector or Dean strongly supports involvement in quality assurance processes
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.1.2  Adequate resources are provided for the leadership and management of quality assurance processes, and provision of assistance where it is needed.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.1.3 All teaching and other staff participate in self-assessments and cooperate with reporting and improvement processes in their sphere of activity.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.1.4  Creativity and innovation combined with clear guidelines and accountability processes are actively encouraged at all levels.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.1.5  Mistakes and weaknesses are recognized and used as a basis for planning for improvement.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.1.6  Improvements in performance and outstanding achievements  are recognized and appropriately acknowledged.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.1.7  Evaluation and planning for quality improvement are integrated into normal administrative processes
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_3_1()
    {
        return $this->get_property('3_1')->get_value();
    }

    public function set_3_2($value)
    {
        $property = new \Orm_Property_Textarea('3_2', $value);
        $property->set_description('3.2 Scope of Quality Improvement Processes');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				3.2.1 All academic and administrative units within the institution (including the governing body, and senior management) participate in the processes of quality assurance and improvement
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.2.2 Regular evaluations are carried out and reports prepared to provide an overview of performance for the institution as a whole, and  for organizational units and functions within it.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.2.3 Quality evaluations consider inputs, processes and outcomes, with particular attention to quality of outcomes.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.2.4 Evaluations are carried out for both routine activities and for strategic priorities for improvement.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.2.5 Quality assurance processes are designed to ensure both that acceptable standards are met, and that there is continuing improvement in performance.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.2.6 A program of institutional research on quality issues is carried out to investigate and report to the Rector or Dean and the governing body, and inform the institution as a whole on the quality of the institution’s activities and achievement of its objectives.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.2.7 In sections for male and female students detailed evaluations in relation to all standards should be carried out in a consistent way in both sections and quality reports on those standards should note any significant differences found and make appropriate recommendations for action in response to what is found.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_3_2()
    {
        return $this->get_property('3_2')->get_value();
    }

    public function set_3_3($value)
    {
        $property = new \Orm_Property_Textarea('3_3', $value);
        $property->set_description('3.3 Administration of Quality Assurance Processes');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				3.3.1 A senior member of faculty is assigned responsibility and given a sufficient time allowance to provide guidance and support for the quality processes within the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.2   A quality center is established within the institution’s central administration and given sufficient staff and resources to operate effectively.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.3 A quality committee is formed with members drawn from all major sections of the institution. As a general guideline this might involve12 to 15 members and in a large institution might require representatives from groups of colleges in similar fields rather than from each college.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.4 The committee is chaired by a member of the institution’s senior administration who works closely with the director of the quality center in guiding and supporting quality initiatives throughout the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.5 The roles and responsibilities of the head of the quality centre, the centre itself, and the quality committee are formally defined and their relationship with other planning and administrative units made clear.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.6 If quality assurance functions are managed by more than one organizational unit, the activities of these units are effectively coordinated under the supervision of a senior administrator.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.7 The institution’s quality assurance system is fully integrated into normal planning and development strategies in a defined cycle of planning, implementation, assessment and review.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.8 Evaluations are (i) based on evidence, (ii) linked to appropriate standards, (iii) include consideration of predetermined indicators, and (iv) take account of independent verification of interpretations.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.9 Common forms and survey instruments are prepared for use for similar activities  across the institution (eg. programs, courses, libraries etc.) and responses used in independent analyses of results including trends over time.  (This does not preclude additional questions relevant to different programs or special instruments dealing with particular  functions eg. specialized libraries or student services)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.10 Statistical data (including pass rates, progression and completion rates and other data required for indicators) are retained in a central data base and provided routinely and promptly to colleges and departments (normally each semester or at least annually) for their use in preparation of reports on indicators and other tasks in monitoring quality.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.11 The administrative arrangements and processes used for quality assurance in the institution are evaluated and reported on in a way that is comparable to the quality assurance processes for other functions and organizational units.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.3.12 Processes for evaluation of quality should be transparent with criteria for judgments and evidence considered made clear
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_3_3()
    {
        return $this->get_property('3_3')->get_value();
    }

    public function set_3_4($value)
    {
        $property = new \Orm_Property_Textarea('3_4', $value);
        $property->set_description('3.4 Use of Indicators and Benchmarks');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				3.4.1 A limited number of key performance indicators that are capable of objective measurement have been identified and provide clear objective evidence of quality of performance for sections within the institution (including colleges and departments) and for the institution as a whole.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.4.2 Additional indicators that provide clear evidence of quality of performance in achieving their objectives are selected by or for each academic and administrative  unit within the institution.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.4.3 When  functions that are carried out by different organizational units (eg. teaching, research, community service) some common indicators are selected for all such units as measures of quality and to provide for comparisons of performance.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.4.4 Benchmarks for comparing quality of performance (including past performance and at least some comparisons with other institutions) are established and achievements in relation to those benchmarks is regularly monitored.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.4.5  Key performance indicators and  benchmarks for major organizational units or functions  are approved by the appropriate committee or council within the institution (eg. senior academic committee, university council)
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.4.6  The format for indicators and benchmarks is consistent across the institution and provides specific evidence relating to important objectives.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_3_4()
    {
        return $this->get_property('3_4')->get_value();
    }

    public function set_3_5($value)
    {
        $property = new \Orm_Property_Textarea('3_5', $value);
        $property->set_description('3.5 Independent Verification of Standards');
        $property->set_hint(
            "
            <ul class='list-group m-a-0'>
                <li class='list-group-item no-border-hr padding-xs-hr no-bg no-border-radius'>
				3.5.1   Self-evaluations of quality of performance are based on several related sources of evidence  including feedback through user surveys and opinions of stakeholders such as students and teaching staff, graduates and employers.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.5.2 Interpretations of evidence of quality of performance are verified through independent advice from persons familiar with the type of activity concerned and impartial mechanisms are used to reconcile differing opinions.
				</li>
				<li class='list-group-item no-border-hr padding-xs-hr no-bg'>
				3.5.3  Institutional policies and procedures have been established for the verification of standards of achievement by students in relation to other institutions and the requirements of the National Qualifications Framework.
				</li>
			</ul>
            "
        );
        $this->set_property($property);
    }

    public function get_3_5()
    {
        return $this->get_property('3_5')->get_value();
    }

    public function set_quality_mission($value)
    {
        $property = new \Orm_Property_Textarea('quality_mission', $value);
        $property->set_description('Overall Evaluation of Quality Standard 3.  Refer to evidence obtained and provide a report based on that evidence; including a list of particular strengths, recommendations for improvement, and priorities for action');
        $this->set_property($property);
    }

    public function get_quality_mission()
    {
        return $this->get_property('quality_mission')->get_value();
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
            if(\License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {
                $kpis = \Orm_Kpi::get_all(array('category_id' => \Orm_Kpi::KPI_ACCREDITATION,'college_id' => 0));

                $indicators = array();
                foreach ($kpis as $i => $kpi) {

                    $indicators[$i]['kpi_no'] = $kpi->get_code();
                    $indicators[$i]['standard'] = $kpi->get_criteria_obj()->get_standard_obj()->get_code().'.'.$kpi->get_criteria_obj()->get_standard_obj()->get_title();
                    $indicators[$i]['kpi'] = $kpi->get_title();
                }
                $this->set_standard_kpi($indicators);
                $this->save();
            }
        }
    }
}
