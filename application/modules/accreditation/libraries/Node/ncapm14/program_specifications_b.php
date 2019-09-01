<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of program_specifications_b
 *
 * @author ahmadgx
 */
class Program_Specifications_B extends \Orm_Node
{

    protected $class_type = __class__;
    protected $name = 'B. Program Context';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_program_established();
            $this->set_economic_reasons('');
            $this->set_program_mission('');
            $this->set_program_efford();
            $this->set_program_courses('');
            $this->set_courses_meet_student('');
            $this->set_program_require_students('');
            $this->set_courses_meet_department_student('');
            $this->set_students_characteristics('');
            $this->set_modifications_and_services('');
    }

    public function set_program_established()
    {
        $property = new \Orm_Property_Fixedtext('program_established', '<strong>1. Explain why the program was established.</strong>');
        $this->set_property($property);
    }

    public function get_program_established()
    {
        return $this->get_property('program_established')->get_value();
    }

    public function set_economic_reasons($value)
    {
        $property = new \Orm_Property_Textarea('economic_reasons', $value);
        $property->set_description('a. Summarize economic reasons, social or cultural reasons, technological developments, national policy developments or other reasons.');
        $this->set_property($property);
    }

    public function get_economic_reasons()
    {
        return $this->get_property('economic_reasons')->get_value();
    }

    public function set_program_mission($value)
    {
        $property = new \Orm_Property_Textarea('program_mission', $value);
        $property->set_description('b. Explain the relevance of the program to the mission and goals of the institution.');
        $this->set_property($property);
    }

    public function get_program_mission()
    {
        return $this->get_property('program_mission')->get_value();
    }

    public function set_program_efford()
    {
        $property = new \Orm_Property_Fixedtext('program_efford', '<strong>2. Relationship (if any) to other programs offered by the institution/college/department.</strong>');
        $property = new \Orm_Property_Fixedtext('program_efford', '<strong>2. Relationship (if any) to other programs offered by the institution/college/department.</strong>');
        $this->set_property($property);
    }

    public function get_program_efford()
    {
        return $this->get_property('program_efford')->get_value();
    }

    public function set_program_courses($value)
    {
        $property = new \Orm_Property_Radio('program_courses', $value);
        $property->set_options(array('yes', 'no'));
        $property->set_description('a. Does this program offer courses that students in other programs are required to take?');
        $this->set_property($property);
    }

    public function get_program_courses()
    {
        return $this->get_property('program_courses')->get_value();
    }

    public function set_courses_meet_student($value)
    {
        $property = new \Orm_Property_Textarea('courses_meet_student', $value);
        $property->set_description('If yes, what has been done to make sure those courses meet the needs of students in the other programs?');
        $this->set_property($property);
    }

    public function get_courses_meet_student()
    {
        return $this->get_property('courses_meet_student')->get_value();
    }

    public function set_program_require_students($value)
    {
        $property = new \Orm_Property_Radio('program_require_students', $value);
        $property->set_options(array('yes', 'no'));
        $property->set_description('b. Does the program require students to take courses taught by other departments?');
        $this->set_property($property);
    }

    public function get_program_require_students()
    {
        return $this->get_property('program_require_students')->get_value();
    }

    public function set_courses_meet_department_student($value)
    {
        $property = new \Orm_Property_Textarea('courses_meet_department_student', $value);
        $property->set_description('If yes, what has been done to make sure those courses in other departments meet the needs of students in this program?');
        $this->set_property($property);
    }

    public function get_courses_meet_department_student()
    {
        return $this->get_property('courses_meet_department_student')->get_value();
    }

    public function set_students_characteristics($value)
    {
        $property = new \Orm_Property_Radio('students_characteristics', $value);
        $property->set_options(array('yes', 'no'));
        $property->set_description('3. Do students who are likely to be enrolled in the program have any special needs or characteristics? (eg. Part time evening students, physical and academic disabilities, limited IT or language skills).');
        $this->set_property($property);
    }

    public function get_students_characteristics()
    {
        return $this->get_property('students_characteristics')->get_value();
    }

    public function set_modifications_and_services($value)
    {
        $property = new \Orm_Property_Textarea('modifications_and_services', $value);
        $property->set_description('4. What modifications or services are you providing for special needs applicants?');
        $this->set_property($property);
    }

    public function get_modifications_and_services()
    {
        return $this->get_property('modifications_and_services')->get_value();
    }

}
