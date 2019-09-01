<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_cac;

/**
 * Description of criterion_3
 *
 * @author ahmadgx
 */
class Criterion_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'CRITERION 3. STUDENT OUTCOMES';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_student_outcomes('');
            $this->set_student_outcomes_list('');
            $this->set_relationship('');
            $this->set_program_educational_objectives('');
            $this->set_process('');
            $this->set_establishment('');
            $this->set_student('');
            $this->set_student_characteristics(array());
    }

    public function set_student_outcomes()
    {
        $property = new \Orm_Property_Fixedtext('student_outcomes', '<strong>A. Student Outcomes</strong>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_student_outcomes()
    {
        return $this->get_property('student_outcomes')->get_value();
    }

    public function set_student_outcomes_list($value)
    {
        $property = new \Orm_Property_Textarea('student_outcomes_list', $value);
        $property->set_description('List the student outcomes for the program and indicate where the student outcomes are documented');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_student_outcomes_list()
    {
        return $this->get_property('student_outcomes_list')->get_value();
    }

    public function set_relationship()
    {
        $property = new \Orm_Property_Fixedtext('relationship', '<strong>B. Relationship of Student Outcomes to Program Educational Objectives</strong>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_relationship()
    {
        return $this->get_property('relationship')->get_value();
    }

    public function set_program_educational_objectives($value)
    {
        $property = new \Orm_Property_Textarea('program_educational_objectives', $value);
        $property->set_description('Describe how the student outcomes prepare graduates to attain the program educational objectives');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_program_educational_objectives()
    {
        return $this->get_property('program_educational_objectives')->get_value();
    }

    public function set_process()
    {
        $property = new \Orm_Property_Fixedtext('process', '<strong>C. Process for the Establishment and Revision of the Student Outcomes</strong>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_process()
    {
        return $this->get_property('process')->get_value();
    }

    public function set_establishment($value)
    {
        $property = new \Orm_Property_Textarea('establishment', $value);
        $property->set_description('Describe the process used for reviewing and revising student outcomes');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_establishment()
    {
        return $this->get_property('establishment')->get_value();
    }

    public function set_student()
    {
        $property = new \Orm_Property_Fixedtext('student', '<strong>D. Enabled Student Characteristics</strong> <br/>'
            . 'All computing programs must show how they enable students to attain, by the time of graduation, characteristics (a) through (i) as listed in Criterion 3 as well as any applicable characteristics defined within the program criteria.  For each characteristic listed either in the general criteria or the applicable program criteria, indicate how the program enables that characteristic.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_student()
    {
        return $this->get_property('student')->get_value();
    }

    public function set_student_characteristics($value)
    {
        $answer = new \Orm_Property_Checkbox('answer');
        $answer->set_width(100);

        $property = new \Orm_Property_Table('student_characteristics', $value);
        $property->set_group('group_4');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('characteristic_1', '(a) An ability to apply knowledge of computing and mathematics appropriate to the program’s student outcomes and to the discipline'));
        $property->add_cell(1, 2, $answer);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('characteristic_2', '(b) An ability to analyze a problem, and identify and define the computing requirements appropriate to its solution'));
        $property->add_cell(2, 2, $answer);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('characteristic_3', '(c) An ability to design, implement, and evaluate a computer-based system, process, component, or program to meet desired needs'));
        $property->add_cell(3, 2, $answer);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('characteristic_4', '(d) An ability to function effectively on teams to accomplish a common goal '));
        $property->add_cell(4, 2, $answer);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('characteristic_5', '(e) An understanding of professional, ethical, legal, security and social issues and responsibilities'));
        $property->add_cell(5, 2, $answer);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('characteristic_6', '(f) An ability to communicate effectively with a range of audiences '));
        $property->add_cell(6, 2, $answer);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('characteristic_7', '(g) An ability to analyze the local and global impact of computing on individuals, organizations, and society'));
        $property->add_cell(7, 2, $answer);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('characteristic_8', '(h) Recognition of the need for and an ability to engage in continuing professional development'));
        $property->add_cell(8, 2, $answer);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('characteristic_9', '(i) An ability to use current techniques, skills, and tools necessary for computing practice'));
        $property->add_cell(9, 2, $answer);


        $this->set_property($property);
    }

    public function get_student_characteristics()
    {
        return $this->get_property('student_characteristics')->get_value();
    }

}
