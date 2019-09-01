<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 08/10/18
 * Time: 12:30 م
 */

namespace Node\ncapm18;


class Annual_A extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'A. Program Previous Action Plan Implementation';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_action_plan(array());
    }


    public function set_action_plan($value)
    {
        $property = new \Orm_Property_Table_Dynamic('action_plan', $value);
        $property->set_description('Accordioning the recommendations of previous year annual report, list the planned actions and their status.');

        $action_plan = new \Orm_Property_Text('action_plan');
        $action_plan->set_description('Actions Planned');
        $action_plan->set_width(300);
        $property->add_property($action_plan);

        $completion_date = new \Orm_Property_Text('completion_date');
        $completion_date->set_description('Planned Completion Date');
        $completion_date->set_width(200);
        $property->add_property($completion_date);

        $person_responsible = new \Orm_Property_Text('person_responsible');
        $person_responsible->set_description('Person Responsible');
        $person_responsible->set_width(200);
        $property->add_property($person_responsible);

        $completed = new \Orm_Property_Radio('completed');
        $completed->set_description('Completedyes-no');
        $completed->set_options(array('Yes', 'No'));
        $completed->set_width(200);
        $property->add_property($completed);

        $reason = new \Orm_Property_Textarea('reason');
        $reason->set_description('Reasons');
        $reason->set_group('If Not Complete');
        $reason->set_enable_tinymce(false);
        $reason->set_width(400);
        $property->add_property($reason);

        $proposed_action = new \Orm_Property_Textarea('proposed_action');
        $proposed_action->set_description('Proposed action');
        $proposed_action->set_group('If Not Complete');
        $proposed_action->set_enable_tinymce(false);
        $proposed_action->set_width(400);
        $property->add_property($proposed_action);


        $this->set_property($property);
    }

    public function get_action_plan()
    {
        return $this->get_property('action_plan')->get_value();
    }

}