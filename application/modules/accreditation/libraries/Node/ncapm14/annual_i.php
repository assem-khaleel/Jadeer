<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of Annual_I
 *
 * @author user
 */
class Annual_I extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'I. Action Plan Progress Report';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_action_plan_progress(array());
    }

    public function set_action_plan_progress($value)
    {
        $property = new \Orm_Property_Table_Dynamic('action_plan_progress', $value);
        $property->set_description('1. Progress on Implementation of  Previous Year’s Action Plans');

        $actions_planned = new \Orm_Property_Textarea('actions_planned');
        $actions_planned->set_description('Action Planned');
        $actions_planned->set_enable_tinymce(0);
        $actions_planned->set_width(180);
        $property->add_property($actions_planned);

        $planned_date = new \Orm_Property_Text('planned_copletion_date');
        $planned_date->set_description('Planned Completion Date');
        $planned_date->set_width(100);
        $property->add_property($planned_date);

        $person_resposible = new \Orm_Property_Text('person_resposible');
        $person_resposible->set_description('Person Responsible');
        $person_resposible->set_width(180);
        $property->add_property($person_resposible);

        $completed = new \Orm_Property_Percentage('completed');
        $completed->set_description('Completed');
        $completed->set_width(100);
        $property->add_property($completed);

        $completed_explain = new \Orm_Property_Textarea('if_not_complete');
        $completed_explain->set_description('If Not Complete, Give Reasons');
        $completed_explain->set_enable_tinymce(0);
        $completed_explain->set_width(150);
        $property->add_property($completed_explain);

        $this->set_property($property);
    }

    public function get_action_plan_progress()
    {
        return $this->get_property('action_plan_progress')->get_value();
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

            if (\License::get_instance()->check_module('strategic_planning') && \Modules::load('strategic_planning')) {
                $active_strategy = \Orm_Sp_Strategy::get_one(array('item_class' => 'Orm_Sp_Strategy_Program','item_id' => $program_obj->get_id()));

                $old_actions = $this->get_action_plan_progress();
                $action_plans = \Orm_Sp_Action_Plan::get_all(array('strategy_id' => $active_strategy->get_id()));
                foreach ($action_plans as $plan) {

                    $old_actions[$plan->get_id()]['actions_planned'] = $plan->get_title('english');
                    $old_actions[$plan->get_id()]['planned_copletion_date'] = $plan->get_end_date();
                    $old_actions[$plan->get_id()]['person_resposible'] = isset($old_actions[$plan->get_id()]['person_resposible']) ? $old_actions[$plan->get_id()]['person_resposible'] : '';
                    $old_actions[$plan->get_id()]['completed'] = $plan->get_progress_lead();
                    $old_actions[$plan->get_id()]['if_not_complete'] = isset($old_actions[$plan->get_id()]['if_not_complete']) ? $old_actions[$plan->get_id()]['if_not_complete'] : '';
                }
                $this->set_action_plan_progress($old_actions);

                $this->save();
            }
        }
    }
}
