<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_eac;

/**
 * Description of criterion_3
 *
 * @author ahmadgx
 */
class Criterion_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'CRITERION 3. STUDENT OUTCOMES ';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_student_outcomes('');
            $this->set_student_characteristics('');
            $this->set_relationship('');
            $this->set_program_educational_objectives('');
    }

    public function set_student_outcomes()
    {
        $property = new \Orm_Property_Fixedtext('student_outcomes', '<b>A. Process for the Establishment and Revision of the Student Outcomes</b> <br/> <br/>'
            . 'List the student outcomes for the program and indicate where the student outcomes are documented.  If the student outcomes are stated differently than those listed in Criterion 3, provide a mapping to the (a) through (k) Student Outcomes');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_student_outcomes()
    {
        return $this->get_property('student_outcomes')->get_value();
    }

    public function set_student_characteristics($value)
    {
        $answer = new \Orm_Property_Checkbox('answer');
        $answer->set_width(100);

        $property = new \Orm_Property_Table('student_characteristics', $value);
        $property->set_group('group_a');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('characteristic_1', '(a) an ability to apply knowledge of mathematics, science, and engineering'));
        $property->add_cell(1, 2, $answer);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('characteristic_2', '(b) an ability to design and conduct experiments, as well as to analyze and interpret data'));
        $property->add_cell(2, 2, $answer);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('characteristic_3', '(c) an ability to design a system, component, or process to meet desired needs within realistic constraints such as economic, environmental, social, political, ethical, health and safety, manufacturability, and sustainability'));
        $property->add_cell(3, 2, $answer);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('characteristic_4', '(d) an ability to function on multidisciplinary teams'));
        $property->add_cell(4, 2, $answer);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('characteristic_5', '(e) an ability to identify, formulate, and solve engineering problems'));
        $property->add_cell(5, 2, $answer);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('characteristic_6', '(f) an understanding of professional and ethical responsibility'));
        $property->add_cell(6, 2, $answer);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('characteristic_7', '(g) an ability to communicate effectively'));
        $property->add_cell(7, 2, $answer);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('characteristic_8', '(h) the broad education necessary to understand the impact of engineering solutions in a global, economic, environmental, and societal context'));
        $property->add_cell(8, 2, $answer);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('characteristic_9', '(i) a recognition of the need for, and an ability to engage in life-long learning'));
        $property->add_cell(9, 2, $answer);

        $property->add_cell(10, 1, new \Orm_Property_Fixedtext('characteristic_10', '(j) a knowledge of contemporary issues'));
        $property->add_cell(10, 2, $answer);

        $property->add_cell(11, 1, new \Orm_Property_Fixedtext('characteristic_11', '(k) an ability to use the techniques, skills, and modern engineering tools necessary for engineering practice.'));
        $property->add_cell(11, 2, $answer);


        $this->set_property($property);
    }

    public function get_student_characteristics()
    {
        return $this->get_property('student_characteristics')->get_value();
    }

    public function set_relationship()
    {
        $property = new \Orm_Property_Fixedtext('relationship', '<b>B. Relationship of Student Outcomes to Program Educational Objectives</b>');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_relationship()
    {
        return $this->get_property('relationship')->get_value();
    }

    public function set_program_educational_objectives($value)
    {
        $property = new \Orm_Property_Textarea('program_educational_objectives', $value);
        $property->set_description('Describe how the student outcomes prepare graduates to attain the program educational objectives.');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_program_educational_objectives()
    {
        return $this->get_property('program_educational_objectives')->get_value();
    }

}
