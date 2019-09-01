<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_specifications_b
 *
 * @author laith
 */
class Course_Specifications_B extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'B. Objectives';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_purpose('');
            $this->set_plan('');
    }

    public function set_purpose($value)
    {
        $property = new \Orm_Property_Textarea('purpose', $value);
        $property->set_description('1. What is the main purpose for this course?');
        $this->set_property($property);
    }

    public function get_purpose()
    {
        return $this->get_property('purpose')->get_value();
    }

    public function set_plan($value)
    {
        $property = new \Orm_Property_Textarea('plan', $value);
        $property->set_description('2. Briefly describe any plans for developing and improving the course that are being implemented. (e.g. increased use of IT or web based reference material,  changes in content as a result of new research in the field)');
        $this->set_property($property);
    }

    public function get_plan()
    {
        return $this->get_property('plan')->get_value();
    }
}
