<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/9/18
 * Time: 4:05 PM
 */

namespace Node\ncacm18;


class Signature extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'Authorized Signatures';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_signatures('');

    }

    public function set_signatures($value)
    {
        $text = new \Orm_Property_Text('signatures');
        $date= new \Orm_Property_Date('date',$value);

        $property = new \Orm_Property_Table('signatures', $value);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('Title', 'Title'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('name', 'Name'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('signature', 'Signature'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('date', 'Date'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('course_instructor', 'Course Instructor'));
        $property->add_cell(2, 2, $text);
        $property->add_cell(2, 3, $text);
        $property->add_cell(2, 4, $date);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('program_coordinator', 'Program Coordinator'));
        $property->add_cell(3, 2, $text);
        $property->add_cell(3, 3, $text);
        $property->add_cell(3, 4, $date);

        $this->set_property($property);
    }

    public function get_signatures()
    {
        return $this->get_property('signatures')->get_value();
    }
}