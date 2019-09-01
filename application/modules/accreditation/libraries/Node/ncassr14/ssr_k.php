<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_k
 *
 * @author ahmadgx
 */
class Ssr_K extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'K. Action Proposals';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_intoduction('');
            $this->set_course_required('');
            $this->set_course_required_list('');
            $this->set_recommendation('');
            $this->set_add_Recommendation(array());
            $this->set_kpi_assessment(array());
            $this->set_kpi_analysis('');
            $this->set_note('');
            $this->set_student_learning_outcom(array());
            $this->set_list('');
            $this->set_strength('');
            $this->set_recommendation_list('');
    }

    public function set_intoduction()
    {
        $property = new \Orm_Property_Fixedtext('intoduction', '<strong>K1. Action Proposals <br/> <br/> list:</strong>Action proposal should be based on the matters identified in sections F, G, H, and I and indicate recommendations for improvement proposed to deal with the most important priorities for action identified in those sections.');
        $this->set_property($property);
    }

    public function get_intoduction()
    {
        return $this->get_property('intoduction')->get_value();
    }

    public function set_course_required()
    {
        $property = new \Orm_Property_Fixedtext('course_required', '<strong>1. Changes in Course Requirements  (if any) <br/> <br/>List and briefly state reasons</strong>for any changes recommended in course requirements, e.g. <br/> <br/>'
            . '<ul> <li>Courses no longer needed;</li>'
            . '<li>New courses required;</li>'
            . '<li>Courses merged together or subdivided;</li>'
            . '<li>Required courses made optional or elective courses made compulsory;</li>'
            . '<li>Changes in pre-requisites or co-requisites</li>'
            . '<li>Changes in the allocation of responsibility for learning outcomes as shown in the course planning matrix.</li>'
            . '</ul>');
        $this->set_property($property);
    }

    public function get_course_required()
    {
        return $this->get_property('course_required')->get_value();
    }

    public function set_course_required_list($value)
    {
        $property = new \Orm_Property_Textarea('course_required_list', $value);
        $property->set_group('action_proposal');
        $this->set_property($property);
    }

    public function get_course_required_list()
    {
        return $this->get_property('course_required_list')->get_value();
    }

    public function set_recommendation()
    {
        $property = new \Orm_Property_Fixedtext('recommendation', '<strong>2.  Action Recommendations.</strong> <br/>'
            . 'Recommendations for improvement are made for action to be taken to overcome problems or weaknesses identified.  The actions recommended should be expressed in specific, measurable for terms for assessment, rather than as general statements.  Each action recommendation should indicate who should be responsible for the action, timelines, and any necessary resources.');
        $this->set_property($property);
    }

    public function get_recommendation()
    {
        return $this->get_property('recommendation')->get_value();
    }

    public function set_add_Recommendation($value)
    {
        $property = new \Orm_Property_Add_More('add_Recommendation', $value);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action Recommendation');
        $property->add_property($action);

        $person = new \Orm_Property_Text('person');
        $person->set_description('Person (s) responsible');
        $property->add_property($person);

        $time_line = new \Orm_Property_Text('time_line');
        $time_line->set_description('Timelines (For total initiative and for major stages of development)');
        $property->add_property($time_line);

        $resource = new \Orm_Property_Text('resource');
        $resource->set_description('Resources Required');
        $property->add_property($resource);

        $this->set_property($property);
    }

    public function get_add_Recommendation()
    {
        return $this->get_property('add_Recommendation')->get_value();
    }

    public function set_kpi_assessment($value)
    {
        $property = new \Orm_Property_Table_Dynamic("kpi_assessment", $value);
        $property->set_description('2. Program KPI and Assessment');
        $property->set_is_responsive(true);

        $kpi_num = new \Orm_Property_Text('kpi_num');
        $kpi_num->set_description('KPI #');
        $kpi_num->set_width(100);
        $property->add_property($kpi_num);

        $kpi_list = new \Orm_Property_Textarea('kpi_list');
        $kpi_list->set_description('List of Program KPIs Approved by the Institution');
        $kpi_list->set_enable_tinymce(0);
        $kpi_list->set_width(200);
        $property->add_property($kpi_list);

        $target = new \Orm_Property_Text('target');
        $target->set_description('KPI Target Benchmark');
        $target->set_width(100);
        $property->add_property($target);

        $actual = new \Orm_Property_Text('actual');
        $actual->set_description('KPI Actual Benchmark');
        $actual->set_width(100);
        $property->add_property($actual);

        $internal = new \Orm_Property_Textarea('internal');
        $internal->set_description('KPI Internal Benchmark');
        $internal->set_enable_tinymce(0);
        $internal->set_width(100);
        $property->add_property($internal);

        $external = new \Orm_Property_Textarea('external');
        $external->set_description('KPI External Benchmar');
        $external->set_enable_tinymce(0);
        $external->set_width(100);
        $property->add_property($external);

        $kpi_analys = new \Orm_Property_Radio('kpi_analys');
        $kpi_analys->set_options(array('Yes', 'No'));
        $kpi_analys->set_description('KPI Analysis Complete (Y or N)');
        $kpi_analys->set_width(100);
        $property->add_property($kpi_analys);

        $new_target = new \Orm_Property_Text('new_target');
        $new_target->set_description('KPI New Target Benchmark');
        $new_target->set_width(100);
        $property->add_property($new_target);

        $this->set_property($property);
    }

    public function get_kpi_assessment()
    {
        return $this->get_property('kpi_assessment')->get_value();
    }

    public function set_kpi_analysis($value)
    {
        $property = new \Orm_Property_Textarea('kpi_analysis', $value);
        $property->set_description('Analysis of KPIs and Benchmarks (comprehensive analysis of all program KPIs):');
        $this->set_property($property);
    }

    public function get_kpi_analysis()
    {
        return $this->get_property('kpi_analysis')->get_value();
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', '<strong>NOTE :</strong>  The following definitions are provided to guide the completion of the above table for Program KPI and Assessment. <br/> <br/>'
            . '<strong>KPI</strong>  refers to the key performance indicators the program used in the SSR and approved by the institution (if applicable at this time). This includes both the NCAAA suggested KPIs chosen and all additional KPIs determined by the program (including 50% of the NCAAA suggested KPIs and all others). <br/>'
            . '<strong>Target Benchmark</strong>&nbsprefers to the anticipated or desired outcome (goal or aim) for each KPI. <br/>'
            . '<strong>Actual Benchmark</strong>&nbsprefers to the actual outcome determined when the KPI is measured or calculated. <br/>'
            . '<strong>Internal Benchmarks</strong>&nbsprefer to comparable benchmarks (actual benchmarks) from inside the program (like data results from previous years or data results from other departments within the same college). <br/>'
            . '<strong>External Benchmarks</strong>&nbsprefer to comparable benchmarks (actual benchmarks) from similar programs that are outside the program (like from similar programs that are national or international). <br/>'
            . '<strong>KPI Analysis</strong>&nbsprefers to a comparison and contrast of the benchmarks to determine strengths and recommendations for improvement. <br/>'
            . '<strong>New Target Benchmark</strong>&nbsprefers to the establishment of a new anticipated or desired outcome for the KPI that is based on the KPI analysis. <br/> <br/>'
            . '<strong>Student Learning Outcome Assessment <br/> Use the rating scale with 5 reflecting the higher value and 1 the lowest value</strong>');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

    public function set_student_learning_outcom($value)
    {
        $rank = new \Orm_Property_Rank('rank');
        $rank->set_width(100);

        $property = new \Orm_Property_Table("student_learning_outcom", $value);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('learning_domain', 'Learning Domains for Learning Outcomes Rating Scale'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('1', '1 - 5'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('knowledge', 'Knowledge Content – Assessment'));
        $property->add_cell(2, 2, $rank);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('knowledge_content', 'Do the knowledge content requirements align with the requirements normally expected by a professional society or employers?'));
        $property->add_cell(3, 2, $rank);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('congitive', 'Cognitive Skills – Assessment'));
        $property->add_cell(4, 2, $rank);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('congitive_skills', 'Do the cognitive skill requirements align with the requirements normally expected  by a professional society or employers?'));
        $property->add_cell(5, 2, $rank);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('interpersonal', 'Interpersonal Skills and Responsibility – Assessment'));
        $property->add_cell(6, 2, $rank);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('interpersonal_skills', 'Do the interpersonal skills and responsibility requirements align with the requirements normally expected  by a professional society or employers?'));
        $property->add_cell(7, 2, $rank);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('communication', 'Communication, Information Technology, Numerical -- Assessment'));
        $property->add_cell(8, 2, $rank);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('communication_assessment', 'Do the communication, information technology, and numerical requirements align with the requirements normally expected by a professional society or employers?'));
        $property->add_cell(9, 2, $rank);

        $property->add_cell(10, 1, new \Orm_Property_Fixedtext('psychomotor', 'Psychomotor Skills -- Assessment'));
        $property->add_cell(10, 2, $rank);

        $property->add_cell(11, 1, new \Orm_Property_Fixedtext('psychomotor_skill', 'Do the psychomotor skills requirements align with the requirements normally expected  by a professional society or employers?'));
        $property->add_cell(11, 2, $rank);

        $property->add_cell(12, 1, new \Orm_Property_Fixedtext('total', 'Total Scores'));
        $property->add_cell(12, 2, $rank);

        $property->add_cell(13, 1, new \Orm_Property_Fixedtext('compsite', 'Composite Score'));
        $property->add_cell(13, 2, $rank);

        $this->set_property($property);
    }

    public function get_student_learning_outcom()
    {
        return $this->get_property('student_learning_outcom')->get_value();
    }

    public function set_list()
    {
        $property = new \Orm_Property_Fixedtext('list', '<strong>Analysis of Student Learning Outcomes (Provide strengths and recommendations for improvement):</strong>');
        $this->set_property($property);
    }

    public function get_list()
    {
        return $this->get_property('list')->get_value();
    }

    public function set_strength($value)
    {
        $property = new \Orm_Property_Textarea('strength', $value);
        $property->set_description('Strengths');
        $this->set_property($property);
    }

    public function get_strength()
    {
        return $this->get_property('strength')->get_value();
    }

    public function set_recommendation_list($value)
    {
        $property = new \Orm_Property_Textarea('recommendation_list', $value);
        $property->set_description('Recommendations for Improvement');
        $this->set_property($property);
    }

    public function get_recommendation_list()
    {
        return $this->get_property('recommendation_list')->get_value();
    }

    public function header_actions(&$actions = array()) {

        if ($this->check_if_editable()) {
            if(\License::get_instance()->check_module('kpi')) {
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

        if(\License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {
            $KPIs = \Orm_Kpi::get_all(array('category_id' => \Orm_Kpi::KPI_ACCREDITATION,'college_id' => $this->get_parent_college_node()->get_item_id()));
            $data_kpis = array();
            foreach ($KPIs as $kpi) {

                $info = $kpi->get_info(\Orm_Kpi_Detail::TYPE_PROGRAM, array('program_id' => $this->get_parent_program_node()->get_item_id()));

                $data_kpis[$kpi->get_id()]['kpi_num'] = $info['code'];
                $data_kpis[$kpi->get_id()]['kpi_list'] = $kpi->get_title();
                $data_kpis[$kpi->get_id()]['target'] = $info['target_benchmarks'];
                $data_kpis[$kpi->get_id()]['actual'] = $info['actual_benchmarks'];
                $data_kpis[$kpi->get_id()]['internal'] = $info['internal_benchmarks'];
                $data_kpis[$kpi->get_id()]['external'] = $info['external_benchmarks'];
                $data_kpis[$kpi->get_id()]['new_target'] = $info['new_benchmarks'];
            }

            $this->set_kpi_assessment(array_values($data_kpis));
            $this->save();
        }
    }

}
