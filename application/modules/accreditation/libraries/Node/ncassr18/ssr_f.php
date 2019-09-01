<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_f
 *
 * @author ahmadgx
 */
class Ssr_F extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'F. MISSION, GOALS AND OBJECTIVES';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_mission('');
        $this->set_info();
        $this->set_goals_and_mission(array());
        $this->set_strength('');
        $this->set_note();
        $this->set_report_and_information();
        $this->set_program_evaluation('');


    }

    public function set_mission($value)
    {
        $property = new \Orm_Property_Textarea('mission', $value);
        $property->set_description('1. Mission Statement of the Program (Insert the Mission Statement).');
        $this->set_property($property);
    }

    public function get_mission()
    {
        return $this->get_property('mission')->get_value();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Use the following table and write clear, measurable goals and objectives of the program and align each one with quality performance indicators and the target benchmark.'
            . ' <br/><strong>NOTE: A separate table must be used for each branch/location campus (This table is not referring to NCAAA KPIs or the program KPIs).</strong> <br/>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_goals_and_mission($value)
    {
        $property = new \Orm_Property_Table_Dynamic('goals_and_mission', $value);

        $goals = new \Orm_Property_Textarea('goals');
        $goals->set_description('Goals');
        $goals->set_enable_tinymce(0);
        $goals->set_width(200);
        $property->add_property($goals);

        $objectives = new \Orm_Property_Textarea('objectives');
        $objectives->set_description('Objectives for each goal');
        $objectives->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $objectives->set_width(200);
        $property->add_property($objectives);

        $performance_indicators = new \Orm_Property_Textarea('performance_indicators');
        $performance_indicators->set_description('Performance Indicators');
        $performance_indicators->set_width(200);
        $performance_indicators->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $property->add_property($performance_indicators);

        $benchmark_targets = new \Orm_Property_Textarea('benchmark_targets');
        $benchmark_targets->set_description('Benchmark Targets');
        $benchmark_targets->set_width(200);
        $benchmark_targets->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $property->add_property($benchmark_targets);

        $this->set_property($property);
    }

    public function get_goals_and_mission()
    {
        return $this->get_property('goals_and_mission')->get_value();
    }

    public function set_strength($value)
    {
        $property = new \Orm_Property_Textarea('strength', $value);
        $property->set_description('Provide a list of the strengths and recommendations for improvement based on an assessment of this data.');
        $this->set_property($property);
    }

    public function get_strength()
    {
        return $this->get_property('strength')->get_value();
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', '<strong>GOALS</strong> refer to the major program aims, ambitions, and purposes (What the program is attempting to accomplish?) <br/> <br/>'
            . '<strong>OBJECTIVES</strong>  refer to specific action points the program has in place to achieve each goal (How is the program attempting to accomplish the goals). <br/> <br/>'
            . '<strong>PERFORMANCE INDICATORS </strong>  refer to the measurement criteria used to evaluate each objective. <br/> <br/>'
            . '<strong>TARGET BENCHMARK</strong>  refers to the intended or desired outcome that is anticipated when each goal is complete. <br/> <br/>'
            . '<strong>SUMMARY ANALYSIS</strong>   refers to a study comparing all the target benchmarks with the actual outcomes determined by the performance indicators (Examine all the goals/objectives together and compare and contrast the expected target results with the actual results provided by the performance indicators.). The summary analysis is an overall assessment of the success that the program in achieving its goals/objectives.');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

    public function set_report_and_information()
    {
        $property = new \Orm_Property_Fixedtext('report_and_information', '<strong>2. Program Evaluation in Relation to Goals and Objectives for Development of the Program  <br/> <br/>NOTE: </strong> <br/>I. Reports on these items should be expanded as necessary to include tables, charts or other appropriate forms of evidence, including trends and comparisons with past performance, or with other institutions where relevant.)'
            . ' <br/>II. Information should be provided on  performance indicators that relate directly in alignment with the mission, goals and objectives');
        $this->set_property($property);
    }

    public function get_report_and_information()
    {
        return $this->get_property('report_and_information')->get_value();
    }

    public function set_program_evaluation($value)
    {
        $property = new \Orm_Property_Add_More('program_evaluation', $value);

        $goal_and_objective = new \Orm_Property_Textarea('goal_and_objective');
        $goal_and_objective->set_description('1.State goal/objective');
        $property->add_property($goal_and_objective);

        $target_and_benchmark = new \Orm_Property_Textarea('target_and_benchmark');
        $target_and_benchmark->set_description('Target benchmark or standard of performance');
        $property->add_property($target_and_benchmark);

        $result = new \Orm_Property_Textarea('result');
        $result->set_description('Result achieved or actual benchmark');
        $property->add_property($result);

        $comment = new \Orm_Property_Textarea('comment');
        $comment->set_description('Comments and analysis');
        $property->add_property($comment);

        $this->set_property($property);
    }

    public function get_program_evaluation()
    {
        return $this->get_property('program_evaluation')->get_value();
    }

    public function header_actions(&$actions = array()) {

        if ($this->check_if_editable()) {
            if(\License::get_instance()->check_module('strategic_planning')) {
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

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj(); /* @var $program_obj \Orm_Program */
            $department_obj = $program_obj->get_department_obj();
            $college_obj = $department_obj->get_college_obj();

            if(\License::get_instance()->check_module('strategic_planning') && \Modules::load('strategic_planning')){

                $active_strategy = \Orm_Sp_Strategy_Program::get_one(array('item_class' => 'Orm_Sp_Strategy_Program','item_id' => $program_obj->get_id()));
                $objectives = \Orm_Sp_Objective::get_all(array('strategy_id' => $active_strategy->get_id()));

                $this->set_mission($active_strategy->get_mission('english'));

                $strategy = array();
                foreach ($objectives as $key => $objective) {
                    $indicators = \Orm_Sp_Kpi::get_all(array('class_type' => 'Orm_Sp_Objective', 'type_id' => $objective->get_id()));
                    $kpi = '';
                    foreach ($indicators as $indicator) {
                        $kpi .= "<li>{$indicator->get_indicator_obj()->get_title()}</li>";
                    }
                    $strategy[$key] = array(
                        'goals' => $objective->get_goal_obj()->get_title('english'),
                        'objectives' => $objective->get_title('english'),
                        'performance_indicators' => '<ul>'.$kpi.'</ul>',
                        'benchmark_targets' => \Orm_Sp_Objective_Milestone::get_one(array('objective_id' => $objective->get_id(),'year' => $this->get_year()))->get_target(),
                    );
                }

                $this->set_goals_and_mission($strategy);
                $this->save();
            }
        }
    }


}
