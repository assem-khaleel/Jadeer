<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_eac;

/**
 * Description of criterion_5
 *
 * @author ahmadgx
 */
class Criterion_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'CRITERION 5. CURRICULUM';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

            $this->set_program_curriculum('');
            $this->set_curriculum_table_name('');
            $this->set_program_name('');
            $this->set_curriculum_table(array());
            $this->set_curriculum_table_overall(array());
            $this->set_curriculum_table_percent('');
            $this->set_total_percentage(array());
            $this->set_credit_hours_or_percentage(array());
            $this->set_curriculum_table_note('');
            $this->set_curriculum_aligns('');
            $this->set_prerequisite('');
            $this->set_worksheet('');
            $this->set_specific_requirements('');
            $this->set_culminating_experience('');
            $this->set_curricular_requirements('');
            $this->set_example('');
            $this->set_course_syllabi('');
            $this->set_syllabi('');
    }

    public function set_program_curriculum()
    {
        $property = new \Orm_Property_Fixedtext('program_curriculum', '<strong>A. Program Curriculum</strong>');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_program_curriculum()
    {
        return $this->get_property('program_curriculum')->get_value();
    }

    public function set_curriculum_table_name()
    {
        $property = new \Orm_Property_Fixedtext('curriculum_table_name', '<strong>1. Complete Table 5-1 that describes the plan of study for students in this program including information on course offerings in the form of a recommended schedule by year and term along with maximum section enrollments for all courses in the program for the last two terms the course was taught.  If there is more than one curricular path, Table 5-1 should be provided for each path.   State whether you are on quarters or semesters and complete a separate table for each option in the program.</strong>');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_curriculum_table_name()
    {
        return $this->get_property('curriculum_table_name')->get_value();
    }

    public function set_program_name($value)
    {
        $property = new \Orm_Property_Text('program_name', $value);
        $property->set_description('Name of Program');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_program_name()
    {
        return $this->get_property('program_name')->get_value();
    }

    public function set_curriculum_table($value)
    {
        $property = new \Orm_Property_Table_Dynamic('curriculum_table', $value);
        $property->set_description('Table 5-1 Curriculum');
        $property->set_group('group_a');
        $property->set_is_responsive(true);

        $course = new \Orm_Property_Text('course');
        $course->set_description('Course (Department, Number, Title) List all courses in the program by term starting with the first term of the first year and ending with the last term of the final year.');
        $course->set_width(200);
        $property->add_property($course);

        $indicate = new \Orm_Property_Text('indicate');
        $indicate->set_description('Indicate Whether Course is Required,  Elective or a Selected Elective by an R, an E or an SE.(1)');
        $indicate->set_width(200);
        $property->add_property($indicate);

        $math = new \Orm_Property_Text('math');
        $math->set_description('Subject Area (Credit Hours) (Math and Basic Sciences)');
        $math->set_width(200);
        $property->add_property($math);

        $topics = new \Orm_Property_Text('topics');
        $topics->set_description('Subject Area (Credit Hours)(Engineering Topics Check if Contains Significant Design (???))');
        $topics->set_width(200);
        $property->add_property($topics);

        $education = new \Orm_Property_Text('education');
        $education->set_description('Subject Area (Credit Hours) (General Education)');
        $education->set_width(200);
        $property->add_property($education);

        $other = new \Orm_Property_Text('other');
        $other->set_description('Subject Area (Credit Hours) (Other)');
        $other->set_width(200);
        $property->add_property($other);

        $course_term = new \Orm_Property_Text('course_term');
        $course_term->set_description('Last Two Terms the  Course was Offered: Year and, Semester, or Quarter');
        $course_term->set_width(200);
        $property->add_property($course_term);

        $average_section = new \Orm_Property_Text('average_section');
        $average_section->set_description('Maximum Section Enrollment for the Last Two Terms the  Course was Offered (2)');
        $average_section->set_width(200);
        $property->add_property($average_section);

        $this->set_property($property);
    }

    public function get_curriculum_table()
    {
        return $this->get_property('curriculum_table')->get_value();
    }

    public function set_curriculum_table_overall($value)
    {
        $overall = new \Orm_Property_Text('overall');
        $overall->set_width(200);

        $property = new \Orm_Property_Table('curriculum_table_overall', $value);
        $property->set_description('TOTALS-ABET BASIC-LEVEL REQUIREMENTS');
        $property->set_group('group_a');
        $property->set_is_responsive(true);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('credit_hour', 'Subject Area (Credit Hours)'), 0, 4);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('math', 'Math and Basic Sciences'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('topic', 'Engineering Topics Check if Contains Significant Design (???)'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('education', 'General Education'));
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('other', 'Other'));

        $property->add_cell(3, 1, $overall);
        $property->add_cell(3, 2, $overall);
        $property->add_cell(3, 3, $overall);
        $property->add_cell(3, 4, $overall);

        $this->set_property($property);
    }

    public function get_curriculum_table_overall()
    {
        return $this->get_property('curriculum_table_overall')->get_value();
    }

    public function set_curriculum_table_percent($value)
    {

        $property = new \Orm_Property_Text('curriculum_table_percent', $value);
        $property->set_description('OVERALL TOTAL CREDIT HOURS FOR COMPLETION OF THE PROGRAM');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_curriculum_table_percent()
    {
        return $this->get_property('curriculum_table_percent')->get_value();
    }

    public function set_total_percentage($value)
    {
        $overall = new \Orm_Property_Percentage('overall');
        $overall->set_width(200);

        $property = new \Orm_Property_Table('total_percentage', $value);
        $property->set_description('PERCENT OF TOTAL');
        $property->set_group('group_a');
        $property->set_is_responsive(true);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('credit_hour', 'Subject Area (Credit Hours)'), 0, 4);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('math', 'Math and Basic Sciences'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('topic', 'Engineering Topics Check if Contains Significant Design (???)'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('education', 'General Education'));
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('other', 'Other'));

        $property->add_cell(3, 2, $overall);
        $property->add_cell(3, 3, $overall);
        $property->add_cell(3, 4, $overall);
        $property->add_cell(3, 5, $overall);

        $this->set_property($property);
    }

    public function get_total_percentage()
    {
        return $this->get_property('total_percentage')->get_value();
    }

    public function set_credit_hours_or_percentage($value)
    {
        $credit_hour = new \Orm_Property_text('credit_hour');
        $credit_hour->set_width(200);

        $percent = new \Orm_Property_Percentage('percent');
        $percent->set_width(200);

        $total = new \Orm_Property_Fixedtext('total', '', 0, 2);
        $total->set_width(200);

        $empty = new \Orm_Property_Fixedtext('empty', '');
        $empty->set_width(500);


        $property = new \Orm_Property_Table('credit_hours_or_percentage', $value);
        $property->set_description('Total must satisfy either credit hours or percentage');
        $property->set_group('group_a');
        $property->set_is_responsive(true);

        $property->add_cell(1, 1, $empty, 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('credit_hour', 'Subject Area (Credit Hours)'), 0, 4);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('math', 'Math and Basic Sciences'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('topic', 'Engineering Topics Check if Contains Significant Design (???)'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('education', 'General Education'));
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('other', 'Other'));

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('total', 'Minimum Semester Credit Hours'));
        $property->add_cell(3, 2, new \Orm_Property_Fixedtext('hour', '32 Hours'));
        $property->add_cell(3, 3, new \Orm_Property_Fixedtext('hours', '48 Hours'));
        $property->add_cell(3, 4, $credit_hour);
        $property->add_cell(3, 5, $credit_hour);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('total', 'Minimum Percentage'));
        $property->add_cell(4, 2, new \Orm_Property_Fixedtext('percent', '25%'));
        $property->add_cell(4, 3, new \Orm_Property_Fixedtext('percentage', '37.5 %'));
        $property->add_cell(4, 4, $percent);
        $property->add_cell(4, 5, $percent);
        $this->set_property($property);
    }

    public function get_credit_hours_or_percentage()
    {
        return $this->get_property('credit_hours_or_percentage')->get_value();
    }

    public function set_curriculum_table_note()
    {
        $property = new \Orm_Property_Fixedtext('curriculum_table_note', '<ol type= "1">'
            . '<li>Required courses are required of all students in the program, elective courses (often referred to as open or free electives) are optional for students, and selected elective courses are those for which students must take one or more courses from a specified group</li>'
            . '<li>For courses that include multiple elements (lecture, laboratory, recitation, etc.), indicate the maximum enrollment in each element. For selected elective courses, indicate the maximum enrollment for each option.</li>'
            . '</ol>'
            . 'Instructional materials and student work verifying compliance with ABET criteria for the categories indicated above will be required during the campus visit.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_curriculum_table_note()
    {
        return $this->get_property('curriculum_table_note')->get_value();
    }

    public function set_curriculum_aligns($value)
    {
        $property = new \Orm_Property_Textarea('curriculum_aligns', $value);
        $property->set_description('2. Describe how the curriculum aligns with the program educational objectives.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_curriculum_aligns()
    {
        return $this->get_property('curriculum_aligns')->get_value();
    }

    public function set_prerequisite($value)
    {
        $property = new \Orm_Property_Textarea('prerequisite', $value);
        $property->set_description('3. Describe how the curriculum and its associated prerequisite structure support the attainment of the student outcomes.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_prerequisite()
    {
        return $this->get_property('prerequisite')->get_value();
    }

    public function set_worksheet($value)
    {
        $property = new \Orm_Property_Upload('worksheet', $value);
        $property->set_description('4. Attach a flowchart or worksheet that illustrates the prerequisite structure of the program???s required courses.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_worksheet()
    {
        return $this->get_property('worksheet')->get_value();
    }

    public function set_specific_requirements($value)
    {
        $property = new \Orm_Property_Textarea('specific_requirements', $value);
        $property->set_description('5. Describe how your program meets the requirements in terms of hours and depth of study for each subject area (Math and Basic Sciences, Engineering Topics, and General Education) specifically addressed by either the general criteria or the program criteria.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_specific_requirements()
    {
        return $this->get_property('specific_requirements')->get_value();
    }

    public function set_culminating_experience($value)
    {
        $property = new \Orm_Property_Textarea('culminating_experience', $value);
        $property->set_description('6. Describe the major design experience that prepares students for engineering practice.  Describe how this experience is based upon the knowledge and skills acquired in earlier coursework and incorporates appropriate engineering standards and multiple design constraints.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_culminating_experience()
    {
        return $this->get_property('culminating_experience')->get_value();
    }

    public function set_curricular_requirements($value)
    {
        $property = new \Orm_Property_Textarea('curricular_requirements', $value);
        $property->set_description('7. If your program allows cooperative education to satisfy curricular requirements specifically addressed by either the general or program criteria, describe the academic component of this experience and how it is evaluated by the faculty.  (Note this language is harmonized but could be either #6 or #7.)');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_curricular_requirements()
    {
        return $this->get_property('curricular_requirements')->get_value();
    }

    public function set_example($value)
    {
        $property = new \Orm_Property_Textarea('example', $value);
        $property->set_description('8. Describe the materials (course syllabi, textbooks, sample student work, etc.), that will be available for review during the visit to demonstrate achievement related to this criterion.  (See the 2015-2016 APPM Section II.G.6.b.(2) regarding display materials.).');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_example()
    {
        return $this->get_property('example')->get_value();
    }

    public function set_course_syllabi()
    {
        $property = new \Orm_Property_Fixedtext('course_syllabi', '<strong>B. Course Syllabi</strong> <br/>'
            . 'In Appendix A, include a syllabus for each course used to satisfy the mathematics, science, and discipline-specific requirements required by Criterion 5 or any applicable program criteria. <br/> <br/>'
        );
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_course_syllabi()
    {
        return $this->get_property('course_syllabi')->get_value();
    }

    public function set_syllabi($value)
    {
        $property = new \Orm_Property_Textarea('syllabi', $value);
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_syllabi()
    {
        return $this->get_property('syllabi')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            $program_obj = $program_node->get_item_obj();

            $this->set_program_name($program_obj->get_name('english'));
        }
    }

}
