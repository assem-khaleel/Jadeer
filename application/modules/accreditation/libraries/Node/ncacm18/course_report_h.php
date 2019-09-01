<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/9/18
 * Time: 1:20 PM
 */

namespace Node\ncacm18;


class Course_Report_H extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'H. Course Improvement Plan';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_course_improvement('');
        $this->set_action_plan('');

    }

    public function set_course_improvement($value)
    {
        $text = new \Orm_Property_Text('course_improvement');


        $property = new \Orm_Property_Table('course_improvement', $value);
        $property->set_description('1. Course improvement actions');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('recommended', 'Recommended actions'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('actions_taken', 'Actions Taken'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('results', 'Results'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('comments', 'Comments'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('revious', 'a. Previous course report recommendations'), 1, 4);

        $property->add_cell(3, 1, $text);
        $property->add_cell(3, 2, $text);
        $property->add_cell(3, 3, $text);
        $property->add_cell(3, 4, $text);

        $property->add_cell(4, 1, $text);
        $property->add_cell(4, 2, $text);
        $property->add_cell(4, 3, $text);
        $property->add_cell(4, 4, $text);

        $property->add_cell(5, 1, $text);
        $property->add_cell(5, 2, $text);
        $property->add_cell(5, 3, $text);
        $property->add_cell(5, 4, $text);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('other', 'b. Other improvement actions '), 1, 4);

        $property->add_cell(7, 1, $text);
        $property->add_cell(7, 2, $text);
        $property->add_cell(7, 3, $text);
        $property->add_cell(7, 4, $text);

        $property->add_cell(8, 1, $text);
        $property->add_cell(8, 2, $text);
        $property->add_cell(8, 3, $text);
        $property->add_cell(8, 4, $text);


        $this->set_property($property);
    }

    public function get_course_improvement()
    {
        return $this->get_property('course_improvement')->get_value();
    }

    public function set_action_plan($value)
    {
        $text = new \Orm_Property_Text('action_plan');


        $property = new \Orm_Property_Table('action_plan', $value);
        $property->set_description('2. Action Plan for Next Semester/Year');

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('recommendations', 'Recommendations'), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('action', 'Action'), 2, 0);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('person_responsible', 'Person Responsible'), 2, 0);
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('time', 'Time'), 1, 2);
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('support_needed', 'Support needed'), 2, 0);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('start', 'Start'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('end', 'End'));

        $property->add_cell(3, 1, $text);
        $property->add_cell(3, 2, $text);
        $property->add_cell(3, 3, $text);
        $property->add_cell(3, 4, $text);
        $property->add_cell(3, 5, $text);
        $property->add_cell(3, 6, $text);

        $property->add_cell(4, 1, $text);
        $property->add_cell(4, 2, $text);
        $property->add_cell(4, 3, $text);
        $property->add_cell(4, 4, $text);
        $property->add_cell(4, 5, $text);
        $property->add_cell(4, 6, $text);

        $property->add_cell(5, 1, $text);
        $property->add_cell(5, 2, $text);
        $property->add_cell(5, 3, $text);
        $property->add_cell(5, 4, $text);
        $property->add_cell(5, 5, $text);
        $property->add_cell(5, 6, $text);


        $this->set_property($property);
    }

    public function get_action_plan()
    {
        return $this->get_property('action_plan')->get_value();
    }
}