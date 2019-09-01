<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_etac;

/**
 * Description of criterion_8
 *
 * @author ahmadgx
 */
class Criterion_8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'CRITERION 8.  INSTITUTIONAL SUPPORT';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_leader('');
            $this->set_leadership('');
            $this->set_program_budget('');
            $this->set_process('');
            $this->set_teaching('');
            $this->set_resources('');
            $this->set_sections('');
            $this->set_staffing('');
            $this->set_staffing_describtion('');
            $this->set_faculty_hiring('');
            $this->set_faculty_hiring_process('');
            $this->set_faculty_hiring_qualified('');
            $this->set_faculty_development('');
            $this->set_supports('');
    }

    public function set_leader()
    {
        $property = new \Orm_Property_Fixedtext('leader', '<b>A. Leadership</b>');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_leader()
    {
        return $this->get_property('leader')->get_value();
    }

    public function set_leadership($value)
    {
        $property = new \Orm_Property_Textarea('leadership', $value);
        $property->set_description('Describe the leadership of the program and discuss its adequacy to ensure the quality and continuity of the program and how the leadership is involved in decisions that affect the program.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_leadership()
    {
        return $this->get_property('leadership')->get_value();
    }

    public function set_program_budget()
    {
        $property = new \ Orm_Property_Fixedtext('program_budget', '<b>B. Program Budget and Financial Support</b>');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_program_budget()
    {
        return $this->get_property('program_budget')->get_value();
    }

    public function set_process($value)
    {
        $property = new \Orm_Property_Textarea('process', $value);
        $property->set_description('1. Describe the process used to establish the program’s budget and provide evidence of continuity of institutional support for the program.  Include the sources of financial support including both permanent (recurring) and temporary (one-time) funds.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_process()
    {
        return $this->get_property('process')->get_value();
    }

    public function set_teaching($value)
    {
        $property = new \Orm_Property_Textarea('teaching', $value);
        $property->set_description('2. Describe how teaching is supported by the institution in terms of graders, teaching assistants, teaching workshops, etc.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_teaching()
    {
        return $this->get_property('teaching')->get_value();
    }

    public function set_resources($value)
    {
        $property = new \Orm_Property_Textarea('resources', $value);
        $property->set_description('3. To the extent not described above, describe how resources are provided to acquire, maintain, and upgrade the infrastructures, facilities, and equipment used in the program.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_resources()
    {
        return $this->get_property('resources')->get_value();
    }

    public function set_sections($value)
    {
        $property = new \Orm_Property_Textarea('sections', $value);
        $property->set_description('4. Assess the adequacy of the resources described in this section with respect to the students in the program being able to attain the student outcomes.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_sections()
    {
        return $this->get_property('sections')->get_value();
    }

    public function set_staffing()
    {
        $property = new \Orm_Property_Fixedtext('staffing', '<b>C. Staffing</b>');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_staffing()
    {
        return $this->get_property('staffing')->get_value();
    }

    public function set_staffing_describtion($value)
    {
        $property = new \ Orm_Property_Textarea('staffing_describtion', $value);
        $property->set_description('Describe the adequacy of the staff (administrative, instructional, and technical) and institutional services provided to the program.  Discuss methods used to retain and train staff.');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_staffing_describtion()
    {
        return $this->get_property('staffing_describtion')->get_value();
    }

    public function set_faculty_hiring()
    {
        $property = new \ Orm_Property_Fixedtext('faculty_hiring', '<b>D. Faculty Hiring and Retention</b>');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_faculty_hiring()
    {
        return $this->get_property('faculty_hiring')->get_value();
    }

    public function set_faculty_hiring_process($value)
    {
        $property = new \Orm_Property_Textarea('faculty_hiring_process', $value);
        $property->set_description('1. Describe the process for hiring of new faculty.');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_faculty_hiring_process()
    {
        return $this->get_property('faculty_hiring_process')->get_value();
    }

    public function set_faculty_hiring_qualified($value)
    {
        $property = new \Orm_Property_Textarea('faculty_hiring_qualified', $value);
        $property->set_description('2. Describe strategies used to retain current qualified faculty.');
        $property->set_group('group_d');
        $this->set_property($property);
    }

    public function get_faculty_hiring_qualified()
    {
        return $this->get_property('faculty_hiring_qualified')->get_value();
    }

    public function set_faculty_development()
    {
        $property = new \ Orm_Property_Fixedtext('faculty_development', '<b>E. Support of Faculty Professional Development</b>');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_faculty_development()
    {
        return $this->get_property('faculty_development')->get_value();
    }

    public function set_supports($value)
    {
        $property = new \Orm_Property_Textarea('supports', $value);
        $property->set_description('Describe the adequacy of support for faculty professional development, how such activities such as sabbaticals, travel, workshops, seminars, etc., are planned and supported.');
        $property->set_group('group_e');
        $this->set_property($property);
    }

    public function get_supports()
    {
        return $this->get_property('supports')->get_value();
    }

}
