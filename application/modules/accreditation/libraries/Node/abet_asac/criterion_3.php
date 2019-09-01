<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_asac;

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
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

            $this->set_student_outcomes('');
            $this->set_student_ourcones_revision('');
            $this->set_student_outcomes_list('');
            $this->set_program_name('');
            $this->set_student_outcomes_table(array());
            $this->set_student_outcomes_table_note('');
            $this->set_relationship('');
            $this->set_educational_objective('');
    }

    public function set_student_outcomes()
    {
        $property = new \Orm_Property_Fixedtext('student_outcomes', '<strong>A. Process for the Establishment and Revision of the Student Outcomes</strong>');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_student_outcomes()
    {
        return $this->get_property('student_outcomes')->get_value();
    }

    public function set_student_ourcones_revision($value)
    {
        $property = new \Orm_Property_Textarea('student_ourcones_revision', $value);
        $property->set_description('Describe the process used for establishing and revising student outcomes.');
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_student_ourcones_revision()
    {
        return $this->get_property('student_ourcones_revision')->get_value();
    }

    public function set_student_outcomes_list()
    {
        $property = new \Orm_Property_Fixedtext('student_outcomes_list', '<strong>B. Student Outcomes</strong> <br/> <br/>List the student outcomes for the program and describe their relationship to those in Criterion 3 of the general criteria and any applicable program criteria.  Display this information in Table 3-1.  Indicate where the student outcomes are documented.'
            . ' <br/> <br/><strong>Table 3-1. Relationship Between Program Student Outcomes and Criterion 3 Student Outcomes/Program Criteria</strong> <br/>'
            . 'Relationship of Program Student Outcomes to General Criteria Student Outcomes and Program Specific Criteria Student Outcomes');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_student_outcomes_list()
    {
        return $this->get_property('student_outcomes_list')->get_value();
    }

    public function set_program_name($value)
    {
        $property = new \Orm_Property_Text('program_name', $value);
        $property->set_description('Program Name');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_program_name()
    {
        return $this->get_property('program_name')->get_value();
    }

    public function set_student_outcomes_table($value)
    {
        $property = new \Orm_Property_Table_Dynamic('student_outcomes_table', $value);
        $property->set_group('group_b');
        $property->set_is_responsive(true);

        $program_student = new \Orm_Property_Textarea('program_student');
        $program_student->set_description('Program Student Outcomes');
        $program_student->set_width(200);
        $program_student->set_enable_tinymce(0);
        $property->add_property($program_student);

        $general_a = new \Orm_Property_Checkbox('general_a');
        $general_a->set_description('<a href="javascript:void(0)" title="an ability to apply knowledge of mathematics, science, and applied sciences">*a</a>');
        $general_a->set_width(30);
        $property->add_property($general_a);

        $general_b = new \Orm_Property_Checkbox('general_b');
        $general_b->set_description('<a href="javascript:void(0)" title="an ability to design and conduct experiments, as well as to analyze and interpret data">*b</a>');
        $general_b->set_width(30);
        $property->add_property($general_b);

        $general_c = new \Orm_Property_Checkbox('general_c');
        $general_c->set_description('<a href="javascript:void(0)" title="an ability to formulate or design a system, process, or program to meet desired needs">*c</a>');
        $general_c->set_width(30);
        $property->add_property($general_c);

        $general_d = new \Orm_Property_Checkbox('general_d');
        $general_d->set_description('<a href="javascript:void(0)" title="an ability to function on multidisciplinary teams">*d</a>');
        $general_d->set_width(30);
        $property->add_property($general_d);

        $general_e = new \Orm_Property_Checkbox('general_e');
        $general_e->set_description('<a href="javascript:void(0)" title="an ability to identify and solve applied science problems ">*e</a>');
        $general_e->set_width(30);
        $property->add_property($general_e);

        $general_f = new \Orm_Property_Checkbox('general_f');
        $general_f->set_description('<a href="javascript:void(0)" title="an understanding of professional and ethical responsibility">*f</a>');
        $general_f->set_width(30);
        $property->add_property($general_f);

        $general_g = new \Orm_Property_Checkbox('general_g');
        $general_g->set_description('<a href="javascript:void(0)" title="an ability to communicate effectively">*g</a>');
        $general_g->set_width(30);
        $property->add_property($general_g);

        $general_h = new \Orm_Property_Checkbox('general_h');
        $general_h->set_description('<a href="javascript:void(0)" title="the broad education necessary to understand the impact of solutions in a global and societal context">*h</a>');
        $general_h->set_width(30);
        $property->add_property($general_h);

        $general_i = new \Orm_Property_Checkbox('general_i');
        $general_i->set_description('<a href="javascript:void(0)" title="a recognition of the need for and an ability to engage in life-long learning">*i</a>');
        $general_i->set_width(30);
        $property->add_property($general_i);

        $general_j = new \Orm_Property_Checkbox('general_j');
        $general_j->set_description('<a href="javascript:void(0)" title="a knowledge of contemporary issues">*j</a>');
        $general_j->set_width(30);
        $property->add_property($general_j);

        $general_k = new \Orm_Property_Checkbox('general_k');
        $general_k->set_description('<a href="javascript:void(0)" title="an ability to use the techniques, skills, and modern scientific and technical tools necessary for professional practice.">*k</a>');
        $general_k->set_width(30);
        $property->add_property($general_k);

        $program_specific_a = new \Orm_Property_Checkbox('program_specific_a');
        $program_specific_a->set_description('<a href="javascript:void(0)" title="an ability to apply knowledge of mathematics, sciences, and other related disciplines">**a</a>');
        $program_specific_a->set_width(30);
        $property->add_property($program_specific_a);

        $program_specific_b = new \Orm_Property_Checkbox('program_specific_b');
        $program_specific_b->set_description('<a href="javascript:void(0)" title="an ability to conduct experiments, as well as to analyze and interpret data">**b</a>');
        $program_specific_b->set_width(30);
        $property->add_property($program_specific_b);

        $program_specific_c = new \Orm_Property_Checkbox('program_specific_c');
        $program_specific_c->set_description('<a href="javascript:void(0)" title="an ability to identify, formulate, and solve applied science problems">**c</a>');
        $program_specific_c->set_width(30);
        $property->add_property($program_specific_c);

        $program_specific_d = new \Orm_Property_Checkbox('program_specific_d');
        $program_specific_d->set_description('<a href="javascript:void(0)" title="an ability to function on teams">**d</a>');
        $program_specific_d->set_width(30);
        $property->add_property($program_specific_d);

        $program_specific_e = new \Orm_Property_Checkbox('program_specific_e');
        $program_specific_e->set_description('<a href="javascript:void(0)" title="an understanding of professional and ethical responsibility ">**e</a>');
        $program_specific_e->set_width(30);
        $property->add_property($program_specific_e);

        $program_specific_f = new \Orm_Property_Checkbox('program_specific_f');
        $program_specific_f->set_description('<a href="javascript:void(0)" title="an ability to communicate effectively">**f</a>');
        $program_specific_f->set_width(30);
        $property->add_property($program_specific_f);

        $program_specific_g = new \Orm_Property_Checkbox('program_specific_g');
        $program_specific_g->set_description('<a href="javascript:void(0)" title="a recognition of the need for and an ability to engage in life-long learning">**g</a>');
        $program_specific_g->set_width(30);
        $property->add_property($program_specific_g);

        $program_specific_h = new \Orm_Property_Checkbox('program_specific_h');
        $program_specific_h->set_description('<a href="javascript:void(0)" title="a knowledge of contemporary issues">**h</a>');
        $program_specific_h->set_width(30);
        $property->add_property($program_specific_h);

        $program_specific_i = new \Orm_Property_Checkbox('program_specific_i');
        $program_specific_i->set_description('<a href="javascript:void(0)" title="an ability to use the techniques, skills, and modern applied science tools necessary for professional practice">**i</a>');
        $program_specific_i->set_width(30);
        $property->add_property($program_specific_i);

        $this->set_property($property);
    }

    public function get_student_outcomes_table()
    {
        return $this->get_property('student_outcomes_table')->get_value();
    }

    public function set_student_outcomes_table_note()
    {
        $property = new \Orm_Property_Fixedtext('student_outcomes_table_note', ''
            . '*  Baccalaureate degree programs must demonstrate that graduates have:'
            . '<ol type="a">'
            . '<li>an ability to apply knowledge of mathematics, science, and applied sciences</li>'
            . '<li>an ability to design and conduct experiments, as well as to analyze and interpret data</li>'
            . '<li>an ability to formulate or design a system, process, or program to meet desired needs</li>'
            . '<li>an ability to function on multidisciplinary teams</li>'
            . '<li>an ability to identify and solve applied science problems </li>'
            . '<li>an understanding of professional and ethical responsibility</li>'
            . '<li>an ability to communicate effectively</li>'
            . '<li>the broad education necessary to understand the impact of solutions in a global and societal context</li>'
            . '<li>a recognition of the need for and an ability to engage in life-long learning</li>'
            . '<li>a knowledge of contemporary issues</li>'
            . '<li>an ability to use the techniques, skills, and modern scientific and technical tools necessary for professional practice.</li>'
            . '</ol>'
            . '** Associate degree programs must demonstrate that graduates have:'
            . '<ol type="a">'
            . '<li>an ability to apply knowledge of mathematics, sciences, and other related disciplines</li>'
            . '<li>an ability to conduct experiments, as well as to analyze and interpret data</li>'
            . '<li>an ability to identify, formulate, and solve applied science problems</li>'
            . '<li>an ability to function on teams</li>'
            . '<li>an understanding of professional and ethical responsibility </li>'
            . '<li>an ability to communicate effectively</li>'
            . '<li>a recognition of the need for and an ability to engage in life-long learning</li>'
            . '<li>a knowledge of contemporary issues</li>'
            . '<li>an ability to use the techniques, skills, and modern applied science tools necessary for professional practice</li>'
            . '</ol>');
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_student_outcomes_table_note()
    {
        return $this->get_property('student_outcomes_table_note')->get_value();
    }

    public function set_relationship()
    {
        $property = new \Orm_Property_Fixedtext('relationship', '<strong>C. Relationship of Student Outcomes to Program Educational Objectives</strong>');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_relationship()
    {
        return $this->get_property('relationship')->get_value();
    }

    public function set_educational_objective($value)
    {
        $property = new \Orm_Property_Textarea('educational_objective', $value);
        $property->set_description('Describe how the student outcomes prepare graduates to attain the program educational objectives');
        $property->set_group('group_c');
        $this->set_property($property);
    }

    public function get_educational_objective()
    {
        return $this->get_property('educational_objective')->get_value();
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
