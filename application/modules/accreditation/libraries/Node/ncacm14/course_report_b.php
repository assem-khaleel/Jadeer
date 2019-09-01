<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_report_course_delivery
 *
 * @author ahmadgx
 */
class Course_Report_B extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'B. Course Delivery';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_coverage_table(array());
            $this->set_consequences_of_non_coverage_of_topics(array());
            $this->set_course_learning(array());
            $this->set_summerize_action('');
            $this->set_effectivenes_strategic_plan(array());
            $this->set_note();
    }

    public function set_coverage_table($value)
    {
        $property = new \Orm_Property_Table_Dynamic('coverage_table', $value);
        $property->set_description('1. Coverage of Planned Program');

        $topic_1 = new \Orm_Property_Text('topic_1');
        $topic_1->set_description('Topics Covered');
        $topic_1->set_width(200);
        $property->add_property($topic_1);

        $planned_hour = new \Orm_Property_Text('planned_hour');
        $planned_hour->set_description('Planned Contact Hours');
        $planned_hour->set_width(100);
        $property->add_property($planned_hour);

        $actual_hour = new \Orm_Property_Text('actual_hour');
        $actual_hour->set_description('Actual Contact Hours');
        $actual_hour->set_width(100);
        $property->add_property($actual_hour);

        $reason = new \Orm_Property_Textarea('reason');
        $reason->set_description('Reason for Variations if there is a difference of more than 25% of the hours planned');
        $reason->set_enable_tinymce(0);
        $reason->set_width(300);
        $property->add_property($reason);

        $this->set_property($property);
    }

    public function get_coverage_table()
    {
        return $this->get_property('coverage_table')->get_value();
    }

    public function set_consequences_of_non_coverage_of_topics($value)
    {
        $property = new \Orm_Property_Table_Dynamic('consequences_of_non_coverage_of_topics', $value);
        $property->set_description('2. Consequences of Non Coverage of Topics For any topics where the topic was not taught or practically delivered, comment on how significant you believe the lack of coverage is for the course learning outcomes or for later courses in the program. Suggest possible compensating action.');

        $topic_2 = new \Orm_Property_Text('topic_2');
        $topic_2->set_description('Topics (if any) not Fully Covered');
        $topic_2->set_width(230);
        $property->add_property($topic_2);

        $learning_outcomes_2 = new \Orm_Property_Textarea('learning_outcomes_2');
        $learning_outcomes_2->set_description('Effected Learning Outcomes');
        $learning_outcomes_2->set_enable_tinymce(0);
        $learning_outcomes_2->set_width(230);
        $property->add_property($learning_outcomes_2);

        $actions = new \Orm_Property_Textarea('actions');
        $actions->set_description('Possible Compensating  Action');
        $actions->set_enable_tinymce(0);
        $actions->set_width(230);
        $property->add_property($actions);

        $this->set_property($property);
    }

    public function get_consequences_of_non_coverage_of_topics()
    {
        return $this->get_property('consequences_of_non_coverage_of_topics')->get_value();
    }

    public function set_course_learning($value)
    {
        $property = new \Orm_Property_Table_Dynamic('course_learning', $value);
        $property->set_description('3. Course learning outcome assessment.');

        $learning_outcomes_3 = new \Orm_Property_Textarea('learning_outcomes_3');
        $learning_outcomes_3->set_description('List course learning outcomes');
        $learning_outcomes_3->set_enable_tinymce(0);
        $learning_outcomes_3->set_width(230);
        $property->add_property($learning_outcomes_3);

        $methods_3 = new \Orm_Property_Textarea('methods_3');
        $methods_3->set_description('List methods of assessment for each LO');
        $methods_3->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $methods_3->set_width(230);
        $property->add_property($methods_3);

        $analysis = new \Orm_Property_Textarea('analysis');
        $analysis->set_description('Summary analysis of assessment results for each LO');
        $analysis->set_enable_tinymce(0);
        $analysis->set_width(230);
        $property->add_property($analysis);

        $this->set_property($property);
    }

    public function get_course_learnin()
    {
        return $this->get_property('course_learnin')->get_value();
    }

    public function set_summerize_action($value)
    {
        $property = new \Orm_Property_Textarea('summerize_action', $value);
        $property->set_description('Summarize any actions you recommend for improving teaching strategies as a result of evaluations in table 3 above.');

        $this->set_property($property);
    }

    public function get_summerize_action()
    {
        return $this->get_property('summerize_action')->get_value();
    }

    public function set_effectivenes_strategic_plan($value)
    {
        $property = new \Orm_Property_Table_Dynamic('effectivenes_strategic_plan', $value);
        $property->set_description('4. Effectiveness of Planned Teaching Strategies for Intended Learning Outcomes set out in the Course Specification. (Refer to planned teaching strategies in Course Specification and description of Domains of Learning Outcomes in the National Qualifications Framework)');

        $teaching_methods = new \Orm_Property_Textarea('teaching_methods');
        $teaching_methods->set_description('List Teaching Methods set out in Course Specification');
        $teaching_methods->set_enable_tinymce(0);
        $teaching_methods->set_width(300);
        $property->add_property($teaching_methods);

        $methods_4 = new \Orm_Property_Radio('methods_4');
        $methods_4->set_description('Were They Effective ?');
        $methods_4->set_options(array('yes', 'no'));
        $methods_4->set_width(100);
        $property->add_property($methods_4);

        $strategy = new \Orm_Property_Textarea('strategy');
        $strategy->set_description('Difficulties Experienced (if any) in Using the Strategy and Suggested Action to Deal with Those Difficulties.');
        $strategy->set_enable_tinymce(0);
        $strategy->set_width(300);
        $property->add_property($strategy);

        $this->set_property($property);
    }

    public function get_effectivenes_strategic_plan()
    {
        return $this->get_property('effectivenes_strategic_plan')->get_value();
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', '<strong>Note: </strong>In order to analyze the assessment of student achievement for each course learning outcome, student performance results can be measured and assessed using a KPI, a rubric, or some grading system that aligns student work, exam scores, or other demonstration of successful learning.');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('info')->get_value();
    }

    public function header_actions(&$actions = array())
    {
        if (\Orm::get_ci()->config->item('integration_enabled')) {
            if ($this->check_if_editable()) {
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

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            $course_section_id = $this->get_parent_course_section_node()->get_item_id();
            $course_id = $this->get_parent_course_node()->get_item_id();

            if (\License::get_instance()->check_module('curriculum_mapping') && \Modules::load('curriculum_mapping')) {
                if ($course_section_id) {
                    $outcomes = array();
                    foreach (\Orm_Cm_Learning_Domain::get_all(array('type'=>\Orm_Cm_Learning_Domain::TYPE_NCAAA_OLD)) as $domain) {
                        $outcome_objects = \Orm_Cm_Course_Learning_Outcome::get_outcomes($course_id, $domain->get_id());
                        foreach ($outcome_objects as $outcome_obj) {
                            $methods_list = '';
                            $methods_analysis = '';
                            $methods = [];
                            foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $outcome_obj->get_id()]) as $method) {
                                $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                                $methods[$method_name] = $method_name;
                            }
                            foreach ($methods as $key => $method) {
                                $methods_list .= '<li>'.$method.'</li>';
                                $methods_analysis .= $method.': '.\Orm_Cm_Section_Student_Assessment::get_course_assessment_method_score($course_id, $key, $domain->get_id(), $outcome_obj->get_id()) ."\n";
                            }
                            $outcomes[] = array(
                                'learning_outcomes_3' => $outcome_obj->get_text(),
                                'methods_3' => '<ol>'.$methods_list.'</ol>',
                                'analysis' => $methods_analysis
                            );
                        }
                    }
                    $this->set_course_learning($outcomes);
                } else {
                    $outcomes = array();
                    foreach (\Orm_Cm_Learning_Domain::get_all(array('type'=>\Orm_Cm_Learning_Domain::TYPE_NCAAA_OLD)) as $domain) {
                        $outcome_objects = \Orm_Cm_Course_Learning_Outcome::get_outcomes($course_id, $domain->get_id());
                        foreach ($outcome_objects as $outcome_obj) {
                            $methods_list = '';
                            $methods_analysis = '';
                            $methods = [];
                            foreach (\Orm_Cm_Course_Mapping_Matrix::get_all(['course_learning_outcome_id' => $outcome_obj->get_id()]) as $method) {
                                $method_name = $method->get_course_assessment_component_obj()->get_program_assessment_method_obj()->get_assessment_method_obj()->get_title();
                                $methods[$method_name] = $method_name;
                            }
                            foreach ($methods as $key => $method) {
                                $methods_list .= '<li>'.$method.'</li>';
                                $methods_analysis .= $method.': '. \Orm_Cm_Section_Student_Assessment::get_course_assessment_method_score($course_id, $key, $domain->get_id(), $outcome_obj->get_id(), $course_section_id) ."\n";
                            }
                            $outcomes[] = array(
                                'learning_outcomes_3' => $outcome_obj->get_text(),
                                'methods_3' => '<ol>'.$methods_list.'</ol>',
                                'analysis' => $methods_analysis
                            );
                        }
                    }
                    $this->set_course_learning($outcomes);
                }
                $this->save();
            }
        }
    }
}
