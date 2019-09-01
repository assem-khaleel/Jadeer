<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_specifications_a
 *
 * @author laith
 */
class Course_Specifications_A extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'A. Course Identification and General Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_course('');
            $this->set_course_code('');
            $this->set_credit('');
            $this->set_program('');
            $this->set_member('');
            $this->set_level('');
            $this->set_pre_req('');
            $this->set_co_req('');
            $this->set_location('');
            $this->set_instruction('');
            $this->set_comment('');
    }

    public function set_course($value)
    {
        $property = new \Orm_Property_Text('course', $value);
        $property->set_description('1. Course title:');
        $this->set_property($property);
    }

    public function get_course()
    {
        return $this->get_property('course')->get_value();
    }

    public function set_course_code($value)
    {
        $property = new \Orm_Property_Text('course_code', $value);
        $property->set_description('Course code:');
        $this->set_property($property);
    }

    public function get_course_code()
    {
        return $this->get_property('course_code')->get_value();
    }

    public function set_credit($value)
    {
        $property = new \Orm_Property_Text('credit', $value);
        $property->set_description('2. Credit hours');
        $this->set_property($property);
    }

    public function get_credit()
    {
        return $this->get_property('credit')->get_value();
    }

    public function set_program($value)
    {
        $property = new \Orm_Property_Text('program', $value);
        $property->set_description('3.  Program(s) in which the course is offered. (If general elective available in many programs indicate this rather than list programs)');
        $this->set_property($property);
    }

    public function get_program()
    {
        return $this->get_property('program')->get_value();
    }

    public function set_member($value)
    {
        $property = new \Orm_Property_Text('member', $value);
        $property->set_description('4. Name of faculty member responsible for the course');
        $this->set_property($property);
    }

    public function get_member()
    {
        return $this->get_property('member')->get_value();
    }

    public function set_level($value)
    {
        $property = new \Orm_Property_Text('level', $value);
        $property->set_description('5. Level/year at which this course is offered');
        $this->set_property($property);
    }

    public function get_level()
    {
        return $this->get_property('level')->get_value();
    }

    public function set_pre_req($value)
    {
        $property = new \Orm_Property_Text('pre_req', $value);
        $property->set_description('6. Pre-requisites for this course (if any)');
        $this->set_property($property);
    }

    public function get_pre_req()
    {
        return $this->get_property('pre_req')->get_value();
    }

    public function set_co_req($value)
    {
        $property = new \Orm_Property_Text('co_req', $value);
        $property->set_description('7. Co-requisites for this course (if any)');
        $this->set_property($property);
    }

    public function get_co_req()
    {
        return $this->get_property('co_req')->get_value();
    }

    public function set_location($value)
    {
        $property = new \Orm_Property_Text('location', $value);
        $property->set_description('8. Location if not on main campus');
        $this->set_property($property);
    }

    public function get_location()
    {
        return $this->get_property('location')->get_value();
    }

    public function set_instruction($value)
    {

        $checkboxes = new \Orm_Property_Checkbox('checkboxes');
        $percent = new \Orm_Property_Percentage('percent');
        $percentage = new \Orm_Property_Fixedtext('percentage', 'What percentage?');

        $property = new \Orm_Property_Table('instruction', $value, 5, 4);
        $property->set_description('9. Mode of Instruction (mark all that apply)');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('column_1', 'a. Traditional classroom'));
        $property->add_cell(1, 2, $checkboxes);
        $property->add_cell(1, 3, $percentage);
        $property->add_cell(1, 4, $percent);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('column_1', 'b. Blended (traditional and online)'));
        $property->add_cell(2, 2, $checkboxes);
        $property->add_cell(2, 3, $percentage);
        $property->add_cell(2, 4, $percent);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('column_1', 'c.  e-learning '));
        $property->add_cell(3, 2, $checkboxes);
        $property->add_cell(3, 3, $percentage);
        $property->add_cell(3, 4, $percent);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('column_1', 'd. Correspondence'));
        $property->add_cell(4, 2, $checkboxes);
        $property->add_cell(4, 3, $percentage);
        $property->add_cell(4, 4, $percent);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('column_1', 'f. Other'));
        $property->add_cell(5, 2, $checkboxes);
        $property->add_cell(5, 3, $percentage);
        $property->add_cell(5, 4, $percent);

        $this->set_property($property);
    }

    public function get_instruction()
    {
        return $this->get_property('instruction')->get_value();
    }

    public function set_comment($value)
    {
        $property = new \Orm_Property_Textarea('comment', $value);
        $property->set_description('Comment');
        $this->set_property($property);
    }

    public function get_comment()
    {
        return $this->get_property('comment')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $course_node = $this->get_parent_course_node();
        if (!is_null($course_node) && $course_node->get_id()) {
            $course_obj = $course_node->get_item_obj();
            /* @var $course_obj \Orm_Course */

            $this->set_course($course_obj->get_name('english'));
            $this->set_course_code($course_obj->get_number('english'));
            $this->set_credit($course_obj->get_credit_hour());
        }
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

        $course_section_node = $this->get_parent_course_section_node();
        $course_node = $this->get_parent_course_node();
        if ($course_section_node->get_item_id()) {

            $instructors = \Orm_Course_Section_Teacher::get_all(array('section_id' => $course_section_node->get_item_id()));
            $instructors_text = array();
            foreach ($instructors as $instructor) {
                $instructors_text[] = $instructor->get_user_obj()->get_full_name();
            }
            $this->set_member(implode('-',$instructors_text));
        } else {
            $sections = \Orm_Course_Section::get_all(array('course_id' => $course_node->get_item_id()));
            $instructors_text = array();
            foreach ($sections as $section) {
                $instructors = \Orm_Course_Section_Teacher::get_all(array('section_id' => $section->get_id()));
                foreach ($instructors as $instructor) {
                    $instructors_text[] = $instructor->get_user_obj()->get_full_name();
                }
            }

            $this->set_member(implode('-',$instructors_text));

        }
        $plans = \Orm_Program_Plan::get_all(array('course_id' => $course_node->get_item_id()));
        if (\Orm::get_ci()->config->item('integration_enabled')) {
            $pre_courses = \Orm_Data_Course_Pre::get_all(array('course_id' => $course_node->get_item_id()));
            $pre_text = array();
            foreach ($pre_courses as $pre) {
                $pre_text[] = $pre->get_program_obj()->get_name('english') . ' - ' . $pre->get_pre_course_obj()->get_name('english');
            }
            $this->set_pre_req(implode('/', $pre_text));
            $co_courses = \Orm_Data_Course_Pre::get_all(array('pre_course_id' => $course_node->get_item_id()));
            $co_text = array();
            foreach ($co_courses as $co) {
                $co_text[] = $co->get_program_obj()->get_name('english') . ' - ' . $co->get_course_obj()->get_name('english');
            }
            $this->set_co_req(implode('/', $co_text));
        }
        $plan_text = array();
        $credit_hours = array();
        $programs = array();
        $levels = array();
        foreach ($plans as $plan) {
            $programs[] = $plan->get_program_obj()->get_name('english');
            $plan_text[] = $plan->get_program_obj()->get_code('english'). ' - Level:' . $plan->get_level();
            $credit_hours[] = $plan->get_program_obj()->get_code('english') . ' ('.$plan->get_credit_hours().' Hours)';
            $levels[] = $plan->get_program_obj()->get_code('english') . ' (Level '.$plan->get_level().' )';
        }
        $this->set_program(implode('/', $programs));
        $this->set_level(implode('/',$levels));
        $this->set_credit(implode('/',$credit_hours));
        $this->save();
    }

}
