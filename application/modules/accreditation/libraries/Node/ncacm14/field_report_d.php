<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of Field_Report_D
 *
 * @author user
 */
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
        $property->set_description('2. Consequences of any difficulties experienced for student learning in the field experience');
        $this->set_property($property);
    }

    public function get_consequences()
    {
        return $this->get_property('consequences')->get_value();
    }
}
