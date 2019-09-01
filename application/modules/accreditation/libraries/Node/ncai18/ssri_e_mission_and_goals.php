<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ssri_e_mission_and_goals
 *
 * @author ahmadgx
 */
class Ssri_E_Mission_And_Goals extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'E. Mission,Goals and Strategic Objectives for Quality Improvement.';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

        $this->set_mission('');
        $this->set_sp();
        $this->set_strategic_plan(array());
        $this->set_strengths_and_recommendations('');
    }

    public function set_mission($value)
    {
        $property = new \Orm_Property_Textarea('mission', $value);
        $property->set_description('1. Mission of the Institution (Insert the Mission Statement)');
        $this->set_property($property);
    }

    public function get_mission()
    {
        return $this->get_property('mission')->get_value();
    }


    public function set_sp()
    {
        $property = new \Orm_Property_Fixedtext('sp', '<strong>2. Provide a summary for the Strategic Plan for Quality Improvement and complete the below table <br/><br/>Summary:<br/></strong>'
            . 'Use the following table and write clear, goals and measurable objectives and align each one with quality performance indicators and the target benchmark.');
        $property->set_group('sp');
        $this->set_property($property);

    }

    public function get_sp()
    {
        return $this->get_property('sp')->get_value();
    }

    public function set_strategic_plan($value)
    {
        $property = new \Orm_Property_Table_Dynamic('strategic_plan', $value, 5, 5);
        $property->set_is_responsive(true);

        $major_goals = new \Orm_Property_Textarea('major_goals');
        $major_goals->set_description('Major Goals');
        $major_goals->set_enable_tinymce(0);
        $major_goals->set_width(195);
        $property->add_property($major_goals);

        $strategic_objectives = new \Orm_Property_Textarea('strategic_objectives');
        $strategic_objectives->set_description('Strategic Objectives');
        $strategic_objectives->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $strategic_objectives->set_width(195);
        $property->add_property($strategic_objectives);

        $performance_indicators = new \Orm_Property_Textarea('performance_indicators');
        $performance_indicators->set_description('Performance Indicators');
        $performance_indicators->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $performance_indicators->set_width(195);
        $property->add_property($performance_indicators);

        $benchmark_targets = new \Orm_Property_Textarea('benchmark_targets');
        $benchmark_targets->set_description('Benchmark Targets');
        $benchmark_targets->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $benchmark_targets->set_width(195);
        $property->add_property($benchmark_targets);

        $benchmark_actual_result = new \Orm_Property_Textarea('benchmark_actual_result');
        $benchmark_actual_result->set_description('Benchmark Actual Results');
        $benchmark_actual_result->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $benchmark_actual_result->set_width(195);
        $property->add_property($benchmark_actual_result);

        $property->set_group('sp');
        $this->set_property($property);
    }

    public function get_strategic_plan()
    {
        return $this->get_property('strategic_plan')->get_value();
    }

    /*
     * strength and recommendation 
     */

    public function set_strengths_and_recommendations($value)
    {
        $property = new \Orm_Property_Textarea('strengths_and_recommendations', $value);
        $property->set_description('Analysis (List the strengths and recommendations for improvement of the Strategic Plan).');
        $this->set_property($property);
    }

    public function get_strengths_and_recommendations()
    {
        return $this->get_property('strengths_and_recommendations')->get_value();
    }

    public function header_actions(&$actions = array())
    {

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            if ($this->check_if_editable()) {
                if (\License::get_instance()->check_module('strategic_planning')) {
                    $actions[] = array(
                        'class' => 'btn',
                        'title' => '<i class="glyphicon glyphicon-oil"></i> ' . lang('Integration'),
                        'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true)
                    );

                }
            }
        }

        return parent::header_actions($actions);
    }

    public function integration_processes()
    {
        parent::integration_processes();

        if (\License::get_instance()->check_module('strategic_planning') && \Modules::load('strategic_planning') && \License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {

            $institution_strategy = \Orm_Sp_Strategy::get_one(array('parent_id' => 0, 'year_less_than' => $this->get_year()));

            $this->set_mission($institution_strategy->get_mission('english'));
            $objective_table = $this->get_strategic_plan();
            foreach (\Orm_Sp_Objective::get_all(array('strategy_id' => $institution_strategy->get_id())) as $objective) {
                $KPIs = '';
                foreach (\Orm_Sp_Kpi::get_all(array('class_type' => 'Orm_Sp_Objective', 'type_id' => $objective->get_id())) as $KPI) {
                    $KPIs = '<li>' . $KPI->get_kpi_obj()->get_title() . '</li>';
                }
                $objective_table[] = array(
                    'major_goals' => $objective->get_goal_obj()->get_title('english'),
                    'strategic_objectives' => $objective->get_title('english'),
                    'performance_indicators' => '<ul>' . $KPIs . '</ul>',
                    'benchmark_targets' => $objective->get_target_lag(),
                    'benchmark_actual_result' => $objective->get_progress_lag()
                );
            }

            $this->set_strategic_plan($objective_table);
            $this->save();
        }
    }
}
