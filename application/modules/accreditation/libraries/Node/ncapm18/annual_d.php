<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 09/10/18
 * Time: 12:23 م
 */

namespace Node\ncapm18;


class Annual_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'D. Courses Analysis';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_course_result(array());
        $this->set_comment('');
        $this->set_result_variation_note();
        $this->set_result_variation(array());
        $this->set_planned_course_note();
        $this->set_planned_course(array());
        $this->set_analysis(array());


    }

    public function set_course_result($value)
    {
        $property = new \Orm_Property_Add_More('course_result', $value);
        $property->set_description('1. Courses result ( including field experience )');
        $property->set_group('result');

        $semester = new \Orm_Property_Text('semester');
        $semester->set_description('Semester');
        $property->add_property($semester);

        $course_res = new \Orm_Property_Table_Dynamic('course_res');

        $code = new \Orm_Property_Text('code');
        $code->set_description('Course Code');
        $code->set_width(200);
        $course_res->add_property($code);

        $total_std = new \Orm_Property_Text('total_std');
        $total_std->set_description('Total no. of students');
        $total_std->set_width(100);
        $course_res->add_property($total_std);

        $passed_std = new \Orm_Property_Text('passed_std');
        $passed_std->set_description('No. of passed students');
        $passed_std->set_width(100);
        $course_res->add_property($passed_std);

        $rate = new \Orm_Property_Text('rate');
        $rate->set_description('Passing rate');
        $rate->set_width(100);
        $course_res->add_property($rate);

        $prev_rate = new \Orm_Property_Text('prev_rate');
        $prev_rate->set_description('Previous year passing rate');
        $prev_rate->set_width(100);
        $course_res->add_property($prev_rate);

        $property->add_property($course_res);

        $this->set_property($property);

    }

    public function get_course_result()
    {
        return $this->get_property('course_result')->get_value();
    }

    public function set_comment($value)
    {
        $property = new \Orm_Property_Textarea('comment', $value);
        $property->set_description('Comments on the passing rates, grade distributions, and trends');
        $property->set_group('result');
        $this->set_property($property);
    }

    public function get_comment()
    {
        return $this->get_property('comment')->get_value();
    }

    public function set_result_variation_note()
    {
        $property = new \Orm_Property_Fixedtext('result_variation_note', '
        <strong>2.Analysis of Significant Results or Variations (25% or more).</strong><br>
        List any courses where passing rates, grade distribution, or trends are significantly skewed, high or low results, 
        or departed from policies on grades or assessments.  For each course indicate what was done to investigate, the reason 
        for the significant result, and what action has been taken
        ');
        $property->set_group('result_variation');
        $this->set_property($property);

    }

    public function get_result_variation_note()
    {

        return $this->get_property('result_variation_note')->get_value();
    }

    public function set_result_variation($value)
    {
        $property = new \Orm_Property_Add_More('result_variation', $value);
        $property->set_group('result_variation');

        $course = new \Orm_Property_Text('course');
        $course->set_description('Course');
        $property->add_property($course);

        $result = new \Orm_Property_Textarea('result');
        $result->set_description('Significant result or variation');
        $property->add_property($result);

        $investigation = new \Orm_Property_Textarea('investigation');
        $investigation->set_description('Investigation undertaken');
        $property->add_property($investigation);

        $reason = new \Orm_Property_Textarea('reason');
        $reason->set_description('Reasons for significant result or variation');
        $property->add_property($reason);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Action taken (if required)');
        $property->add_property($action);

        $this->set_property($property);

    }

    public function get_result_variation()
    {

        return $this->get_property('result_variation')->get_value();
    }

    public function set_planned_course_note()
    {
        $property = new \Orm_Property_Fixedtext('planned_course_note', '
        <strong>3.Delivery of Planned Courses</strong><br>
      Compensating Action Required for Units of Work <strong>Not Taught</strong> in Courses that were Offered. 
       (Complete only where units not taught were of enough importance to require some compensating action)
        ');
        $property->set_group('planned_course');
        $this->set_property($property);

    }

    public function get_planned_course_note()
    {

        return $this->get_property('planned_course_note')->get_value();
    }

    public function set_planned_course($value)
    {
        $property = new \Orm_Property_Add_More('planned_course', $value);
        $property->set_group('planned_course');

        $course = new \Orm_Property_Text('course');
        $course->set_description('Course');
        $property->add_property($course);

        $unit_work = new \Orm_Property_Text('unit_work');
        $unit_work->set_description('Unit of work');
        $property->add_property($unit_work);

        $reason = new \Orm_Property_Textarea('reason');
        $reason->set_description('Reason');
        $property->add_property($reason);

        $action = new \Orm_Property_Textarea('action');
        $action->set_description('Compensating action if required');
        $property->add_property($action);

        $this->set_property($property);

    }

    public function get_planned_course()
    {

        return $this->get_property('planned_course')->get_value();
    }

    public function set_analysis($value)
    {
        $property = new \Orm_Property_Add_More('analysis', $value);
        $property->set_description('4. Analysis ( list of strength, points for improvements and recommendations of Courses Analysis )');

        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $points = new \Orm_Property_Textarea('points');
        $points->set_description('Points for improvements');
        $property->add_property($points);


        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations');
        $property->add_property($recommendation);

        $this->set_property($property);


    }

    public function get_analysis()
    {

        return $this->get_property('analysis')->get_value();
    }

    public function header_actions(&$actions = array())
    {

        if ($this->check_if_editable()) {
            $actions[] = array(
                'class' => 'btn',
                'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
            );
        }

        return parent::header_actions($actions);
    }

    public function integration_processes()
    {

        parent::integration_processes();

        if (\Orm::get_ci()->config->item('integration_enabled')) {

            $program_node = $this->get_parent_program_node();
            if (!is_null($program_node) && $program_node->get_id()) {
                $program_obj = $program_node->get_item_obj();
                /* @var $program_obj \Orm_Program */
                $department_obj = $program_obj->get_department_obj();
                $college_obj = $department_obj->get_college_obj();

                $semesters = \Orm_Semester::get_all(array('year' => $program_node->get_year()));

                $data = array();
                foreach ($semesters as $semester) {

                    $course_plan = \Orm_Program_Plan::get_all(array('program_id' => $program_obj->get_id(), 'semester_id' => $semester->get_id()));
                    $mapped_courses = array();
                    foreach ($course_plan as $course) {
                        $data_course = \Orm_Data_Course_Students::get_one(array('program_id' => $program_obj->get_id(), 'course_id' => $course->get_course_id(), 'semester_id' => $semester->get_id()));
                        $mapped_courses[] = array(
                            'code' => $course->get_course_obj()->get_code(),
                            'total_std' => $data_course->get_student_start_count(),
                            'passed_std' => $data_course->get_student_complete_count()

                        );
                    }
                    $data[] = array(
                        'semester' => $semester->get_name(),
                        'course_res' => $mapped_courses,
                    );
                }


                $this->set_course_result($data);


            }
            $this->save();
        }


    }

}