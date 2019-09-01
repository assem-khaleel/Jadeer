<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of program_specifications_c
 *
 * @author ahmadgx
 */
class Program_Specifications_C extends \Orm_Node
{

    protected $class_type = __class__;
    protected $name = 'C. Mission, Goals and Objectives';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_program_missions('');
            $this->set_list_of_goals('');
            $this->set_goals_and_objective(array());
    }

    public function set_program_missions($value)
    {

        $property = new \Orm_Property_Textarea('program_missions', $value);
        $property->set_description('1. Program Mission Statement (insert)');
        $this->set_property($property);
    }

    public function get_program_missions()
    {
        $this->get_property('program_missions')->get_value();
    }

    public function set_list_of_goals($value)
    {
        $property = new \Orm_Property_Textarea('list_of_goals', $value);
        $property->set_description('2. List Program Goals (eg. long term, broad based initiatives for the program, if any)');
        $this->set_property($property);
    }

    public function get_list_of_goals()
    {
        $this->get_property('list_of_goals')->get_value();
    }

    public function set_goals_and_objective($value)
    {

        $property = new \Orm_Property_Table_Dynamic('goals_and_objective', $value);
        $property->set_description('3. List major objectives of the program within to help achieve the mission.  For each measurable objective describe the measurable performance indicators to be followed and list the major strategies taken to achieve the objectives.');

        $objectives = new \Orm_Property_Textarea('objectives');
        $objectives->set_description('Measurable Objectives');
        $objectives->set_width(200);
        $objectives->set_enable_tinymce(0);
        $property->add_property($objectives);

        $measurable_indicators = new \Orm_Property_Textarea('measurable_indicators');
        $measurable_indicators->set_description('Measurable Performance Indicators');
        $measurable_indicators->set_width(200);
        $measurable_indicators->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $property->add_property($measurable_indicators);

        $major_strategies = new \Orm_Property_Textarea('major_strategies');
        $major_strategies->set_description('Major Strategies');
        $major_strategies->set_width(200);
        $major_strategies->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $property->add_property($major_strategies);


        $this->set_property($property);
    }

    public function get_goals_and_objective()
    {
        return $this->get_property('goals_and_objective')->get_value();
    }

    public function header_actions(&$actions = array()) {

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            if ($this->check_if_editable()) {
                if(\License::get_instance()->check_module('strategic_planning')) {
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

        if(\License::get_instance()->check_module('strategic_planning') && \Modules::load('strategic_planning')) {
            if (!is_null($program_node) && $program_node->get_id()) {
                $program_obj = $program_node->get_item_obj();
                /* @var $program_obj \Orm_Program */
                $department_obj = $program_obj->get_department_obj();
                $college_obj = $department_obj->get_college_obj();

                $active_strategy = \Orm_Sp_Strategy_Program::get_one(array('item_class' => 'Orm_Sp_Strategy_Program', 'item_id' => $program_obj->get_id()));
                $objectives = \Orm_Sp_Objective::get_all(array('strategy_id' => $active_strategy->get_id()));

                $this->set_program_missions($active_strategy->get_mission('english'));

                $goals = \Orm_Sp_Goal::get_all(array('strategy_id' => $active_strategy->get_id()));

                $goals_list = '';
                foreach ($goals as $goal) {
                    $goals_list .= '<li>' . $goal->get_title('english') . '</li>';
                }

                $this->set_list_of_goals("<ul>{$goals_list}</ul>");

                $strategy = $this->get_goals_and_objective();
                foreach ($objectives as $key => $objective) {
                    $indicators = \Orm_Sp_Kpi::get_all(array('class_type' => 'Orm_Sp_Objective', 'type_id' => $objective->get_id()));
                    $kpi = '';
                    foreach ($indicators as $indicator) {
                        $kpi .= "<li>{$indicator->get_indicator_obj()->get_title()}</li>";
                    }
                    $strategy[$key] = array(
                        'objectives' => $objective->get_title('english'),
                        'measurable_indicators' => '<ul>' . $kpi . '</ul>',
                        'major_strategies' => isset($strategy[$key]['major_strategies']) ? $strategy[$key]['major_strategies'] : '',
                    );
                }

                $this->set_goals_and_objective($strategy);
            }
            $this->save();
        }
    }
}
