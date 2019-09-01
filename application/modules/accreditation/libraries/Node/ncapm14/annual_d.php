<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of Annual_D
 *
 * @author user
 */
class Annual_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'D. Course Information Summary';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info1();
            $this->set_describe_how_the_individual('');
            $this->set_info1b();
            $this->set_completion_rate_analysis('');
            $this->set_grade_distribution_analysis('');
            $this->set_trend_analysis('');
            $this->set_course();
            $this->set_list_courses(array());
            $this->set_info4();
            $this->set_delivery_of_planned_courses(array());
            $this->set_compensating_action(array());
    }

    public function set_info1()
    {
        $property = new \Orm_Property_Fixedtext('info1', '1. Course Reports Results. Describe and analyze how the individual NCAAA course reports are utilized to assess the program and to ensure ongoing quality assurance (eg. Analysis of course completion rates, grade distributions, and trend studies.)');
        $this->set_property($property);
    }

    public function get_info1()
    {
        return $this->get_property('info1')->get_value();
    }

    public function set_describe_how_the_individual($value)
    {
        $property = new \Orm_Property_Textarea('describe_how_the_individual', $value);
        $property->set_description('(a.) Describe how the individual course reports are used to evaluate the program');
        $this->set_property($property);
    }

    public function get_describe_how_the_individual()
    {
        return $this->get_property('describe_how_the_individual')->get_value();
    }

    public function set_info1b()
    {
        $property = new \Orm_Property_Fixedtext('info1b', '(b.) Analyze the completion rates, grade distributions, and trends to determine strengths and recommendations for improvement.');
        $this->set_property($property);
    }

    public function get_info1b()
    {
        return $this->get_property('info1b')->get_value();
    }

    public function set_completion_rate_analysis($value)
    {
        $property = new \Orm_Property_Textarea('completion_rate_analysis', $value);
        $property->set_description('(1.) Completion rate analysis:');
        $this->set_property($property);
    }

    public function get_completion_rate_analysis()
    {
        return $this->get_property('completion_rate_analysis')->get_value();
    }

    public function set_grade_distribution_analysis($value)
    {
        $property = new \Orm_Property_Textarea('grade_distribution_analysis', $value);
        $property->set_description('(2.) Grade distribution analysis:');
        $this->set_property($property);
    }

    public function get_grade_distribution_analysis()
    {
        return $this->get_property('grade_distribution_analysis')->get_value();
    }

    public function set_trend_analysis($value)
    {
        $property = new \Orm_Property_Textarea('trend_analysis', $value);
        $property->set_description('(3.) Trend analysis (a study of the differences, changes, or developments over time; normally several years):');
        $this->set_property($property);
    }

    public function get_trend_analysis()
    {
        return $this->get_property('trend_analysis')->get_value();
    }

    public function set_course()
    {
        $property = new \Orm_Property_Fixedtext('course', '<strong> 2. Analysis of Significant Results or Variations (25% or more)</strong> <br/>'
            . 'List any courses where completion rates, grade distribution, or trends are significantly skewed, high or low results, or departed from policies on grades or assessments.  For each course indicate what was done to investigate, the reason for the significant result, and what action has been taken.');
        $this->set_property($property);
    }

    public function get_course()
    {
        return $this->get_property('course')->get_value();
    }

    public function set_list_courses($value)
    {
        $property = new \Orm_Property_Add_More('list_courses', $value);

        $course = new \Orm_Property_Text('course');
        $course->set_description('Course');
        $property->add_property($course);

        $significant = new \Orm_Property_Textarea('significant');
        $significant->set_description('Significant result or variation');
        $property->add_property($significant);

        $invigation = new \Orm_Property_Textarea('invigation');
        $invigation->set_description('Investigation undertaken');
        $property->add_property($invigation);

        $reason = new \Orm_Property_Textarea('reason');
        $reason->set_description('Reason for significant result or variation');
        $property->add_property($reason);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action taken (if required)');
        $property->add_property($action);

        $this->set_property($property);
    }

    public function get_list_courses()
    {
        return $this->get_property('list_courses')->get_value();
    }

    public function set_attach_additional($value)
    {
        $property = new \Orm_Property_Upload('attach_additional', $value);
        $property->set_description('(Attach additional summaries if necessary)');
        $this->set_property($property);
    }

    public function get_attach_additional()
    {
        return $this->get_property('attach_additional')->get_value();
    }

    public function set_info4()
    {
        $property = new \Orm_Property_Fixedtext('info4', '<strong>4. Delivery of Planned Courses</strong>');
        $this->set_property($property);
    }

    public function get_info4()
    {
        return $this->get_property('info4')->get_value();
    }

    public function set_delivery_of_planned_courses($value)
    {
        $property = new \Orm_Property_Table_Dynamic('delivery_of_planned_courses', $value);
        $property->set_description('(a)  List any courses that were planned but not taught during this academic year and indicate the reason and what will need to be done if any compensating action is required.');

        $course_title = new \Orm_Property_Text('course_title');
        $course_title->set_description('Course title');
        $course_title->set_width(230);
        $property->add_property($course_title);

        $course_code = new \Orm_Property_Text('course_code');
        $course_code->set_description('Course code');
        $course_code->set_width(230);
        $property->add_property($course_code);

        $explanation = new \Orm_Property_Textarea('explanation');
        $explanation->set_description('Explanation');
        $explanation->set_enable_tinymce(0);
        $explanation->set_width(230);
        $property->add_property($explanation);

        $compensating = new \Orm_Property_Textarea('compensating');
        $compensating->set_description('Compensating action if required');
        $compensating->set_enable_tinymce(0);
        $compensating->set_width(230);
        $property->add_property($compensating);

        $this->set_property($property);
    }

    public function get_delivery_of_planned_courses()
    {
        return $this->get_property('delivery_of_planned_courses')->get_value();
    }

    public function set_compensating_action($value)
    {
        $property = new \Orm_Property_Add_More('compensating_action', $value);
        $property->set_description('(b) Compensating Action Required for Units of Work Not Taught in Courses that were Offered.  (Complete only where units not taught were of sufficient importance to require some compensating action)');

        $course = new \Orm_Property_Text('course');
        $course->set_description('Course');
        $property->add_property($course);

        $unit = new \Orm_Property_Text('unit_of_work');
        $unit->set_description('Unit of work');
        $property->add_property($unit);

        $reason = new \Orm_Property_Textarea('reason');
        $reason->set_description('Reason');
        $property->add_property($reason);

        $compensating = new \Orm_Property_Textarea('compensating_action_if_required');
        $compensating->set_description('Compensating action if required');
        $property->add_property($compensating);

        $this->set_property($property);
    }

    public function get_compensating_action()
    {
        return $this->get_property('compensating_action')->get_value();
    }

}
