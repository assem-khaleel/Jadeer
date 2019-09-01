<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 03:39 م
 */

namespace Node\ncacm18;


class Field_Report_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'D. Administrative Issues';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_organizational('');
        $this->set_consequences('');
        $this->set_process('');
    }

    public function set_organizational($value)
    {
        $property = new \Orm_Property_Textarea('organizational', $value);
        $property->set_description('1. Organizational or administrative difficulties encountered (if any)');
        $this->set_property($property);
    }

    public function get_organizational()
    {
        return $this->get_property('organizational')->get_value();
    }

    public function set_consequences($value)
    {
        $property = new \Orm_Property_Textarea('consequences', $value);
        $property->set_description('2. Consequences of any difficulties experienced for student learning in the field experience.');
        $this->set_property($property);
    }

    public function get_consequences()
    {
        return $this->get_property('consequences')->get_value();
    }

    public function set_process($value)
    {
        $property = new \Orm_Property_Textarea('process', $value);
        $property->set_description('3. Proposed process to overcome these difficulties.');
        $this->set_property($property);
    }

    public function get_process()
    {
        return $this->get_property('process')->get_value();
    }

}