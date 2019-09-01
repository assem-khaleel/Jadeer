<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/8/18
 * Time: 12:15 PM
 */

namespace Node\ncacm18;


class Course_Specifications_H  extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'H. Authorized Signatures';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;


    public function init()
    {
        parent::init();
        $this->set_authorized_signatures(array());
        $this->set_attachment('');

    }
    public function set_authorized_signatures($value)
    {
        $name = new \Orm_Property_Text('name');
        $name->set_width(100);
        $signature=new \Orm_Property_Text('signature');
        $signature->set_width(100);
        $date= new \Orm_Property_Date('date');
        $date->set_width(100);

        $property = new \Orm_Property_Table('authorized_signatures', $value);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('dean', 'Dean/Chair'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('name', 'Name'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('signature', 'Signature'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('date', 'Date'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('course', 'Course Instructor'));
        $property->add_cell(2, 2, $name);
        $property->add_cell(2, 3, $signature);
        $property->add_cell(2, 4, $date);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('program', 'Program Coordinator'));
        $property->add_cell(3, 2, $name);
        $property->add_cell(3, 3, $signature);
        $property->add_cell(3, 4, $date);


        $this->set_property($property);
    }

    public function get_authorized_signatures ()
    {
        return $this->get_property('authorized_signatures')->get_value();
    }
    public function set_attachment($value)
    {

        $resources = new \Orm_Property_Upload('item');
        $resources->set_width(100);


        $property = new \Orm_Property_Table('attachment', $value);
        $property->set_description('Attachment');


        $property->add_cell(1, 1, $resources);


        $this->set_property($property);
    }

    public function get_attachment ()
    {
        return $this->get_property('attachment')->get_value();
    }

}