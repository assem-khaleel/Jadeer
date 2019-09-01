<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_report_general_information
 *
 * @author ahmadgx
 */
class Course_Report_A extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'A. Course Identification and General Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_course_title('');
            $this->set_code_num('');
            $this->set_section_num('');
            $this->set_instructer('');
            $this->set_location('');
            $this->set_semester('');
            $this->set_student_starting_course('');
            $this->set_student_complete_course('');
            $this->set_course_component(array());
    }

    /*
     * 1. course information
     */

    public function set_course_title($value)
    {
        $property = new \Orm_Property_Text('course_title', $value);
        $property->set_description('1. Course title ');
        $this->set_property($property);
    }

    public function get_course_title()
    {
        return $this->get_property("course_title")->get_value();
    }

    public function set_code_num($value)
    {
        $property = new \Orm_Property_Text('code_num', $value);
        $property->set_description('Code #');
        $this->set_property($property);
    }

    public function get_code_num()
    {
        return $this->get_property("code_num")->get_value();
    }

    public function set_section_num($value)
    {
        $property = new \Orm_Property_Text('section_num', $value);
        $property->set_description(' Section #');
        $this->set_property($property);
    }

    public function get_section_num()
    {
        return $this->get_property("section_num")->get_value();
    }

    /*
     * 2. instucter
     */

    public function set_instructer($value)
    {
        $property = new \Orm_Property_Text('instructer', $value);
        $property->set_description('2. Name of course instructor');
        $this->set_property($property);
    }

    public function get_instructer()
    {
        return $this->get_property("instructer")->get_value();
    }

    public function set_location($value)
    {
        $property = new \Orm_Property_Text('location', $value);
        $property->set_description('Location');
        $this->set_property($property);
    }

    public function get_location()
    {
        return $this->get_property("location")->get_value();
    }

    /*
     * 3. semester
     */

    public function set_semester($value)
    {
        $property = new \Orm_Property_Text('semester', $value);
        $property->set_description('3. Year and semester to which this report applies.');
        $this->set_property($property);
    }

    public function get_semester()
    {
        return $this->get_property("semester")->get_value();
    }

    /*
     * 4. student
     */

    public function set_student_starting_course($value)
    {
        $property = new \Orm_Property_Text('student_starting_course', $value);
        $property->set_description('4. Number of students starting the course?');
        $this->set_property($property);
    }

    public function get_student_starting_course()
    {
        return $this->get_property("student_starting_course")->get_value();
    }

    public function set_student_complete_course($value)
    {
        $property = new \Orm_Property_Text('student_complete_course', $value);
        $property->set_description('Students completing the course?');
        $this->set_property($property);
    }

    public function get_student_complete_course()
    {
        return $this->get_property("student_complete_course")->get_value();
    }

    /*
     * 5. Course components
     */

    public function set_course_component($value)
    {
        $lecture = new \Orm_Property_Text('lecture');
        $lecture->set_width(80);
        $tutorial = new \Orm_Property_Text('tutorial');
        $tutorial->set_width(80);
        $lab = new \Orm_Property_Text('lab');
        $lab->set_width(80);
        $practical = new \Orm_Property_Text('practical');
        $practical->set_width(80);
        $other = new \Orm_Property_Text('other');
        $other->set_width(80);
        $total = new \Orm_Property_Text('total');
        $total->set_width(80);

        $property = new \Orm_Property_Table('course_component', $value);
        $property->set_description('5. Course components (actual total contact hours and credits per semester):');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('', ''));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('lecture', 'Lecture'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('tutorial', 'Tutorial'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('laboratory', 'Laboratory / Studio'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('practical', 'Practical'));
        $property->add_cell(1, 6, new \Orm_Property_Fixedtext('other', 'Other'));
        $property->add_cell(1, 7, new \Orm_Property_Fixedtext('total', 'Total'));


        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('contact_hours', 'Contact Hours'));
        $property->add_cell(2, 2, $lecture);
        $property->add_cell(2, 3, $tutorial);
        $property->add_cell(2, 4, $lab);
        $property->add_cell(2, 5, $practical);
        $property->add_cell(2, 6, $other);
        $property->add_cell(2, 7, $total);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('credit', 'Credit'));
        $property->add_cell(3, 2, $lecture);
        $property->add_cell(3, 3, $tutorial);
        $property->add_cell(3, 4, $lab);
        $property->add_cell(3, 5, $practical);
        $property->add_cell(3, 6, $other);
        $property->add_cell(3, 7, $total);


        $this->set_property($property);
    }

    public function get_course_component()
    {
        return $this->get_property('course_component')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();
//	$course_node = $this->get_parent_course_node();
//        if (!is_null($course_node) && $course_node->get_id()) {
            /** @var \Orm_Course $course */
//            $course = $course_node->get_item_obj();

//            $this->set_course_title($course->get_name('english'));
//            $this->set_code_num($course->get_number('english'));
//        }
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

    public function integration_processes() {
        parent::integration_processes();

        $course_node = $this->get_parent_course_node();
        if (!is_null($course_node) && $course_node->get_id()) {
            /** @var \Orm_Course $course */
            $course = $course_node->get_item_obj();

            $this->set_course_title($course->get_name('english'));
            $this->set_code_num($course->get_number('english'));
        }

        $course_section_node = $this->get_parent_course_section_node();
        if ($course_section_node->get_item_id()) {
            $this->set_section_num(\Orm_Course_Section::get_instance($course_section_node->get_item_id())->get_section_no());
            $instructors = \Orm_Course_Section_Teacher::get_all(array('section_id' => $course_section_node->get_item_id()));
            $instructors_text = array();
            foreach ($instructors as $instructor) {
                $instructors_text[] = $instructor->get_user_obj()->get_full_name();
            }
            $this->set_instructer(implode('-',$instructors_text));

            $course_students = \Orm_Data_Course_Students::get_sum(array('section_id' => $course_section_node->get_item_id()));
            $this->set_student_starting_course($course_students['starting']);
            $this->set_student_complete_course($course_students['completing']);
        } else {
            $sections = \Orm_Course_Section::get_all(array('course_id' => $course_node->get_item_id()));
            $sections_text = array();
            $instructors_text = array();
            foreach ($sections as $section) {
                $sections_text[] = $section->get_section_no();

                $instructors = \Orm_Course_Section_Teacher::get_all(array('section_id' => $section->get_id()));
                foreach ($instructors as $instructor) {
                    $instructors_text[] = $instructor->get_user_obj()->get_full_name();
                }
            }
            $this->set_section_num(implode('-',$sections_text));

            $this->set_instructer(implode('-',$instructors_text));

            $course_students = \Orm_Data_Course_Students::get_sum(array('section_id' => $course_section_node->get_item_id()));
            $this->set_student_starting_course($course_students['starting']);
            $this->set_student_complete_course($course_students['completing']);
        }
        $plans = \Orm_Program_Plan::get_all(array('course_id' => $course_node->get_item_id()));
        $plan_text = array();
        foreach ($plans as $plan) {
            $plan_text[] = $plan->get_program_obj()->get_code('english'). ' - Level:' . $plan->get_level();
        }
        $this->set_semester(implode('/',$plan_text));
        $this->save();
    }

}
