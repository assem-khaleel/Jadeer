<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of Annual_H
 *
 * @author user
 */
class Annual_H extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'H. Independent Opinion on Quality of the Program';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_matters_raised('');
            $this->set_comment_by_program('');
            $this->set_implications_for_planning('');
            $this->set_kpi_table(array());
            $this->set_kpi_table_anlaysis('');
            $this->set_kpi_table_note('');
            $this->set_program_action_plan(array());
            $this->set_program_action_plan_analysis('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>(e.g. head of another similar department / program offering comment on evidence received and conclusions reached).</strong>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_matters_raised($value)
    {
        $property = new \Orm_Property_Textarea('matters_raised', $value);
        $property->set_description('1.Matters Raised by Evaluator Giving Opinion');
        $this->set_property($property);
    }

    public function get_matters_raised()
    {
        return $this->get_property('matters_raised')->get_value();
    }

    public function set_comment_by_program($value)
    {
        $property = new \Orm_Property_Textarea('comment_by_program', $value);
        $property->set_description('Comments by Program Coordinator');
        $this->set_property($property);
    }

    public function get_comment_by_program()
    {
        return $this->get_property('comment_by_program')->get_value();
    }

    public function set_implications_for_planning($value)
    {
        $property = new \Orm_Property_Textarea('implications_for_planning', $value);
        $property->set_description('2. Implications for Planning for the Program');
        $this->set_property($property);
    }

    public function get_implications_for_planning()
    {
        return $this->get_property('implications_for_planning')->get_value();
    }

    public function set_kpi_table($value)
    {
        $property = new \Orm_Property_Table_Dynamic('kpi_table', $value);
        $property->set_description('Program KPI and Assessment Table');
        $property->set_is_responsive(true);

        $kpi_num = new \Orm_Property_Text('kpi_num');
        $kpi_num->set_description('KPI #');
        $kpi_num->set_width(100);
        $property->add_property($kpi_num);

        $kpi = new \Orm_Property_Text('kpi');
        $kpi->set_description('KPI');
        $kpi->set_width(200);
        $property->add_property($kpi);

        $target_benchmark = new \Orm_Property_Text('target_benchmark');
        $target_benchmark->set_description('KPI Target Benchmark');
        $target_benchmark->set_width(100);
        $property->add_property($target_benchmark);

        $actual_benchmark = new \Orm_Property_Text('actual_benchmark');
        $actual_benchmark->set_description('KPI Actual Benchmark');
        $actual_benchmark->set_width(100);
        $property->add_property($actual_benchmark);

        $internal_benchmark = new \Orm_Property_Text('internal_benchmark');
        $internal_benchmark->set_description('KPI Internal Benchmark');
        $internal_benchmark->set_width(100);
        $property->add_property($internal_benchmark);

        $external_benchmark = new \Orm_Property_Text('external_benchmark');
        $external_benchmark->set_description('KPI External Benchmark');
        $external_benchmark->set_width(100);
        $property->add_property($external_benchmark);

        $kpi_analysis = new \Orm_Property_Textarea('kpi_analysis');
        $kpi_analysis->set_description('KPI Analysis');
        $kpi_analysis->set_width(200);
        $kpi_analysis->set_enable_tinymce(0);
        $property->add_property($kpi_analysis);

        $new_target_benchmark = new \Orm_Property_Text('new_target_benchmark');
        $new_target_benchmark->set_description('KPI New Target Benchmark');
        $new_target_benchmark->set_width(100);
        $property->add_property($new_target_benchmark);
        $this->set_property($property);
    }

    public function get_kpi_table()
    {
        return $this->get_property('kpi_table')->get_value();
    }

    public function set_kpi_table_anlaysis($value)
    {
        $property = new \Orm_Property_Textarea('kpi_table_anlaysis', $value);
        $property->set_description('Whole Program Analysis of KPIs and Benchmarks:  (list strengths and recommendations)');
        $this->set_property($property);
    }

    public function get_kpi_table_anlaysis()
    {
        return $this->get_property('kpi_table_anlaysis')->get_value();
    }

    public function set_kpi_table_note()
    {
        $property = new \Orm_Property_Fixedtext('kpi_table_note', '<strong>NOTE</strong> The following definitions are provided to guide the completion of the above table for Program KPI and Assessment. <br/> <br/>'
            . '<strong>KPI</strong> refers to the key performance indicators the program used in its SSRP. This includes both the NCAAA suggested KPIs chosen and all additional KPIs determined by the program (including 50% of the NCAAA suggested KPIs and all others). <br/>'
            . '<strong>Target Benchmark </strong> refers to the anticipated or desired outcome (goal or aim) for each KPI. <br/>'
            . '<strong>Finding Benchmark </strong>refers to the actual outcome determined when the KPI is measured or calculated <br/>'
            . '<strong>Internal Benchmarks </strong>refer to comparable benchmarks (actual findings) from inside the program (like data results from previous years or data results from other departments within the same college). <br/>'
            . '<strong>External Benchmarks </strong>refer to comparable benchmarks (actual findings) from similar programs that are outside the program (like from similar programs that are national or international). <br/>'
            . '<strong>KPI Analysis </strong>refers to a comparison and contrast of the benchmarks to determine strengths and recommendations for improvement. <br/>'
            . '<strong>New Target Benchmark </strong>refers to the establishment of a new anticipated or desired outcome for the KPI that is based on the KPI analysis. <br/> <br/> <br/>'
            . '<i><strong>Program Action Plan Table</strong> <br/>'
            . 'Directions:  Based on the “Analysis of KPIs and Benchmarks” provided in the above Program KPI and Assessment Table, list the recommendations identified and proceed to establish a continuous improvement action plan.</i>');
        $this->set_property($property);
    }

    public function get_kpi_table_note()
    {
        return $this->get_property('kpi_table_note')->get_value();
    }

    public function set_program_action_plan($value)
    {
        $property = new \Orm_Property_Table_Dynamic('program_action_plan', $value);
        $property->set_is_responsive(true);

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations');
        $recommendation->set_width(200);
        $recommendation->set_enable_tinymce(0);
        $property->add_property($recommendation);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Actions');
        $action->set_width(200);
        $action->set_enable_tinymce(0);
        $property->add_property($action);

        $assessment_creteria = new \Orm_Property_Textarea('assessment_creteria');
        $assessment_creteria->set_description('Assessment Criteria');
        $assessment_creteria->set_width(200);
        $assessment_creteria->set_enable_tinymce(0);
        $property->add_property($assessment_creteria);

        $responsible_person = new \Orm_Property_Text('responsible_person');
        $responsible_person->set_description('Responsible Person');
        $responsible_person->set_width(200);
        $property->add_property($responsible_person);

        $start_date = new \Orm_Property_Text('start_date');
        $start_date->set_description('Start Date');
        $start_date->set_width(100);
        $property->add_property($start_date);

        $completion_date = new \Orm_Property_Text('completion_date');
        $completion_date->set_description('Completion Date');
        $completion_date->set_width(100);
        $property->add_property($completion_date);

        $this->set_property($property);
    }

    public function get_program_action_plan()
    {
        return $this->get_property('program_action_plan')->get_value();
    }

    public function set_program_action_plan_analysis($value)
    {
        $property = new \Orm_Property_Textarea('program_action_plan_analysis', $value);
        $property->set_description('Action Plan Analysis (List the strengths and recommendations for improvement of the Program Action Plan).');
        $this->set_property($property);
    }

    public function get_program_action_plan_analysis()
    {
        return $this->get_property('program_action_plan_analysis')->get_value();
    }

    public function header_actions(&$actions = array()) {

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            if ($this->check_if_editable()) {
                if(\License::get_instance()->check_module('kpi')) {
                    $actions[] = array(
                        'class' => 'btn',
                        'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                        'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
                    );
                }
            }
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
            $department_obj = $program_obj->get_department_obj();
            $college_obj = $department_obj->get_college_obj();

            if(\License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {
                $KPIs = \Orm_Kpi::get_all(array('category_id' => \Orm_Kpi::KPI_ACCREDITATION,'college_id' => $college_obj->get_id()));
                $data_kpis = array();
                foreach ($KPIs as $kpi) {

                    $info = $kpi->get_info(\Orm_Kpi_Detail::TYPE_PROGRAM, array('program_id' => $program_obj->get_id()));

                    $data_kpis[$kpi->get_id()]['kpi_num'] = $info['code'];
                    $data_kpis[$kpi->get_id()]['kpi'] = $kpi->get_title();
                    $data_kpis[$kpi->get_id()]['target_benchmark'] = $info['target_benchmarks'];
                    $data_kpis[$kpi->get_id()]['actual_benchmark'] = $info['actual_benchmarks'];
                    $data_kpis[$kpi->get_id()]['internal_benchmark'] = $info['internal_benchmarks'];
                    $data_kpis[$kpi->get_id()]['external_benchmark'] = $info['external_benchmarks'];
                    $data_kpis[$kpi->get_id()]['new_target_benchmark'] = $info['new_benchmarks'];
                }

                $this->set_kpi_table(array_values($data_kpis));
            }
        }
        $this->save();
    }
}
