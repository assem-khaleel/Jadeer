<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of field_experience_specification_c
 *
 * @author laith
 */
class Field_Experience_Specification_C extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'C. Description of Field Experience Activity';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_activity('');
            $this->set_assignment('');
            $this->set_follow_up('');
            $this->set_attachment('');
            $this->set_responsibility_table('');
            $this->set_assessment('');
    }

    public function set_activity($value)
    {
        $property = new \Orm_Property_Textarea('activity', $value);
        $property->set_description('1. Describe the major student activities taking place during the field experience.');
        $this->set_property($property);
    }

    public function get_activity()
    {
        return $this->get_property('activity')->get_value();
    }

    public function set_assignment($value)
    {
        $property = new \Orm_Property_Add_More('assignment', $value);
        $property->set_description('2. List required assignments, projects, and reports.');

        $requierd_list = new \Orm_Property_Textarea('requierd_list');
        $property->add_property($requierd_list);
        $this->set_property($property);
    }

    public function get_assignment()
    {
        return $this->get_property('assignment')->get_value();
    }

    public function set_follow_up($value)
    {
        $property = new \Orm_Property_Textarea('follow_up', $value);
        $property->set_description('3. Follow up with students. What arrangements are made to collect student feedback?');
        $this->set_property($property);
    }

    public function get_follow_up()
    {
        return $this->get_property('follow_up')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('4. Insert a field experience flowchart for responsibility and decision-making (including a provision for conflict resolution).');
        $this->set_property($property);
    }

    public function get_attachment()
    {
        return $this->get_property('attachment')->get_value();
    }

    public function set_responsibility_table($value)
    {
        $student = new \Orm_Property_Checkbox('student');
        $student->set_width(200);
        $field_teching = new \Orm_Property_Checkbox('field_teching');
        $field_teching->set_width(200);
        $program_Faculty = new \Orm_Property_Checkbox('program_Faculty');
        $program_Faculty->set_width(200);

        $property = new \Orm_Property_Table('responsibility_table', $value, 23, 3);
        $property->set_description('5. Supervisory Responsibilities');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('empty', ''));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('student', '<strong>Student</strong>'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('field_teching', '<strong>Field Teaching Staff</strong>'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('program_Faculty', '<strong>Program Faculty and Teaching Staff</strong>'));


        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('student_activities', '<strong>Student Activities</strong>'), 0, 4);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('transport', 'a. transport to and from site'));
        $property->add_cell(3, 2, $student);
        $property->add_cell(3, 3, $field_teching);
        $property->add_cell(3, 4, $program_Faculty);


        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('learning_outcomes', 'b. demonstrate learning outcome performance'));
        $property->add_cell(4, 2, $student);
        $property->add_cell(4, 3, $field_teching);
        $property->add_cell(4, 4, $program_Faculty);


        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('required_task', 'c. completion of required tasks, assignments, reports, and projects'));
        $property->add_cell(5, 2, $student);
        $property->add_cell(5, 3, $field_teching);
        $property->add_cell(5, 4, $program_Faculty);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('supervisions', '<strong>Supervision Activities</strong>'), 0, 4);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('field_site', 'a. field site – safety'));
        $property->add_cell(7, 2, $student);
        $property->add_cell(7, 3, $field_teching);
        $property->add_cell(7, 4, $program_Faculty);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('student', 'b. student learning activities'));
        $property->add_cell(8, 2, $student);
        $property->add_cell(8, 3, $field_teching);
        $property->add_cell(8, 4, $program_Faculty);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('learning_resourse', 'c. learning resources'));
        $property->add_cell(9, 2, $student);
        $property->add_cell(9, 3, $field_teching);
        $property->add_cell(9, 4, $program_Faculty);


        $property->add_cell(10, 1, new \Orm_Property_Fixedtext('administrative', 'd. administrative (attendance)'));
        $property->add_cell(10, 2, $student);
        $property->add_cell(10, 3, $field_teching);
        $property->add_cell(10, 4, $program_Faculty);

        $property->add_cell(11, 1, new \Orm_Property_Fixedtext('planned_activities', '<strong>Planning Activities</strong>'), 0, 4);


        $property->add_cell(12, 1, new \Orm_Property_Fixedtext('student_activities', 'a. student activities'));
        $property->add_cell(12, 2, $student);
        $property->add_cell(12, 3, $field_teching);
        $property->add_cell(12, 4, $program_Faculty);

        $property->add_cell(13, 1, new \Orm_Property_Fixedtext('learning', 'b. learning experiences'));
        $property->add_cell(13, 2, $student);
        $property->add_cell(13, 3, $field_teching);
        $property->add_cell(13, 4, $program_Faculty);

        $property->add_cell(14, 1, new \Orm_Property_Fixedtext('learning_resources', 'c. learning resources'));
        $property->add_cell(14, 2, $student);
        $property->add_cell(14, 3, $field_teching);
        $property->add_cell(14, 4, $program_Faculty);

        $property->add_cell(15, 1, new \Orm_Property_Fixedtext('field_Site', 'd. field site preparations'));
        $property->add_cell(15, 2, $student);
        $property->add_cell(15, 3, $field_teching);
        $property->add_cell(15, 4, $program_Faculty);


        $property->add_cell(16, 1, new \Orm_Property_Fixedtext('student_support', 'e. student guidance and support'));
        $property->add_cell(16, 2, $student);
        $property->add_cell(16, 3, $field_teching);
        $property->add_cell(16, 4, $program_Faculty);

        $property->add_cell(17, 1, new \Orm_Property_Fixedtext('assessment_activities', '<strong>Assessment Activities</strong>'), 0, 4);

        $property->add_cell(18, 1, new \Orm_Property_Fixedtext('outcomes', 'a. student learning outcomes'));
        $property->add_cell(18, 2, $student);
        $property->add_cell(18, 3, $field_teching);
        $property->add_cell(18, 4, $program_Faculty);

        $property->add_cell(19, 1, new \Orm_Property_Fixedtext('field_Exp', 'b. field experience'));
        $property->add_cell(19, 2, $student);
        $property->add_cell(19, 3, $field_teching);
        $property->add_cell(19, 4, $program_Faculty);

        $property->add_cell(20, 1, new \Orm_Property_Fixedtext('teaching_staff', 'c. field teaching staff'));
        $property->add_cell(20, 2, $student);
        $property->add_cell(20, 3, $field_teching);
        $property->add_cell(20, 4, $program_Faculty);

        $property->add_cell(21, 1, new \Orm_Property_Fixedtext('fautly_teaching_staff', 'd. program faulty and teaching staff'));
        $property->add_cell(21, 2, $student);
        $property->add_cell(21, 3, $field_teching);
        $property->add_cell(21, 4, $program_Faculty);

        $property->add_cell(22, 1, new \Orm_Property_Fixedtext('site', 'e. field site'));
        $property->add_cell(22, 2, $student);
        $property->add_cell(22, 3, $field_teching);
        $property->add_cell(22, 4, $program_Faculty);

        $property->add_cell(23, 1, new \Orm_Property_Fixedtext('learning_Resource', 'f. learning resources'));
        $property->add_cell(23, 2, $student);
        $property->add_cell(23, 3, $field_teching);
        $property->add_cell(23, 4, $program_Faculty);

        $this->set_property($property);
    }

    public function get_responsibility_table()
    {
        return $this->get_property('responsibility_table')->get_value();
    }

    public function set_assessment($value)
    {
        $property = new \Orm_Property_Textarea('assessment', $value);
        $property->set_description('b. Explain the student assessment process.');
        $this->set_property($property);
    }

    public function get_assessment()
    {
        return $this->get_property('assessment')->get_value();
    }

}
