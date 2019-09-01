<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of Field_Report_G
 *
 * @author user
 */
class Field_Report_G extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'G. Planning for Improvement';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_progress_on_actions(array());
            $this->set_list_what_Action_have('');
            $this->set_action_plan_next_year(array());
    }

    public function set_progress_on_actions($value)
    {
        $property = new \Orm_Property_Table_Dynamic('progress_on_actions', $value);
        $property->set_description('1. Progress on actions proposed for improving the field experience in previous field experience reports (if any).');

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Actions recommended from the most recent field experience report(s)');
        $recommendation->set_enable_tinymce(0);
        $recommendation->set_width(180);
        $property->add_property($recommendation);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Actions Taken');
        $action->set_enable_tinymce(0);
        $action->set_width(180);
        $property->add_property($action);

        $results = new \Orm_Property_Textarea('results');
        $results->set_description('Action Results');
        $results->set_enable_tinymce(0);
        $results->set_width(180);
        $property->add_property($results);

        $analysis = new \Orm_Property_Textarea('analysis');
        $analysis->set_description('Action Analysis');
        $analysis->set_enable_tinymce(0);
        $analysis->set_width(170);
        $property->add_property($analysis);
        $this->set_property($property);
    }

    public function get_progress_on_actions()
    {
        return $this->get_property('progress_on_actions')->get_value();
    }

    public function set_list_what_Action_have($value)
    {
        $property = new \Orm_Property_Textarea('list_what_Action_have', $value);
        $property->set_description('2. List what additional actions have been taken to improve the field experience (based on previous experience, reports, surveys, independent opinion, or evaluation).');
        $this->set_property($property);
    }

    public function get_list_what_Action_have()
    {
        return $this->get_property('list_what_Action_have')->get_value();
    }

    public function set_action_plan_next_year($value)
    {
        $property = new \Orm_Property_Table_Dynamic('action_plan_next_year', $value);
        $property->set_description('3.Action Plan for Next Semester/Year');

        $action_recommendation = new \Orm_Property_Textarea('action_recommendation');
        $action_recommendation->set_description('Actions Recommended for Further Improvement');
        $action_recommendation->set_enable_tinymce(0);
        $action_recommendation->set_width(170);
        $property->add_property($action_recommendation);

        $action_points = new \Orm_Property_Textarea('action_points');
        $action_points->set_description('Intended Action Points (should be measurable)');
        $action_points->set_enable_tinymce(0);
        $action_points->set_width(170);
        $property->add_property($action_points);

        $start_date = new \Orm_Property_Text('start_date');
        $start_date->set_description('Start Date');
        $start_date->set_width(100);
        $property->add_property($start_date);

        $completion_date = new \Orm_Property_Text('completion_date');
        $completion_date->set_description('Completion Date');
        $completion_date->set_width(100);
        $property->add_property($completion_date);

        $Person = new \Orm_Property_Text('Person');
        $Person->set_description('Person Responsible');
        $Person->set_width(150);
        $property->add_property($Person);

        $this->set_property($property);
    }

    public function get_action_plan_next_year()
    {
        return $this->get_property('action_plan_next_year')->get_value();
    }

}
