<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_report_planning_for_improvement
 *
 * @author ahmadgx
 */
class Course_Report_G extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'G. Planning for Improvement';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_actions(array());
            $this->set_list_of_actions('');
            $this->set_action_plan_improvement(array());
    }

    public function set_actions($value)
    {
        $property = new \Orm_Property_Table_Dynamic('actions', $value);
        $property->set_description('1. Progress on actions proposed for improving the course in previous course reports (if any).');

        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Actions recommended from the most recent course report(s)');
        $recommendation->set_enable_tinymce(0);
        $recommendation->set_width(180);
        $property->add_property($recommendation);


        $action_taken = new \Orm_Property_Textarea('action_taken');
        $action_taken->set_description('Actions Taken');
        $action_taken->set_enable_tinymce(0);
        $action_taken->set_width(180);
        $property->add_property($action_taken);


        $results = new \Orm_Property_Textarea('results');
        $results->set_description('Results');
        $results->set_enable_tinymce(0);
        $results->set_width(180);
        $property->add_property($results);

        $analysis = new \Orm_Property_Textarea('analysis');
        $analysis->set_description('Analysis');
        $analysis->set_enable_tinymce(0);
        $analysis->set_width(170);
        $property->add_property($analysis);

        $this->set_property($property);
    }

    public function get_actions()
    {
        return $this->get_property('actions')->get_value();
    }

    public function set_list_of_actions($value)
    {

        $property = new \Orm_Property_Textarea('list_of_actions', $value);
        $property->set_description('2. List what other actions have been taken to improve the course (based on previous CR, surveys, independent opinion, or course evaluation).');
        $this->set_property($property);
    }

    public function get_list_of_actions()
    {
        return $this->get_property('list_of_actions')->get_value();
    }

    public function set_action_plan_improvement($value)
    {
        $property = new \Orm_Property_Table_Dynamic('action_plan_improvement', $value);
        $property->set_description('3. Action Plan for Next Semester/Year');

        $recommendation_3 = new \Orm_Property_Textarea('recommendation_3');
        $recommendation_3->set_description('Actions Recommended');
        $recommendation_3->set_enable_tinymce(0);
        $recommendation_3->set_width(170);
        $property->add_property($recommendation_3);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Intended Action Points and Process');
        $action->set_enable_tinymce(0);
        $action->set_width(170);
        $property->add_property($action);

        $start_date = new \Orm_Property_Text('start_date');
        $start_date->set_description('Start Date');
        $start_date->set_width(100);
        $property->add_property($start_date);

        $completion_date = new \Orm_Property_Text('completion_date');
        $completion_date->set_description('Completion Date');
        $completion_date->set_width(100);
        $property->add_property($completion_date);

        $person_responsible = new \Orm_Property_Text('person_responsible');
        $person_responsible->set_description('Person Responsible');
        $person_responsible->set_width(150);
        $property->add_property($person_responsible);

        $this->set_property($property);
    }

    public function get_action_plan_improvement()
    {
        return $this->get_property('action_plan_improvement')->get_value();
    }

}
