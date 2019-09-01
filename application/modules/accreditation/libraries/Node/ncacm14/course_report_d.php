<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_report_resources
 *
 * @author ahmadgx
 */
class Course_Report_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'D. Resources and Facilities';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_access_to_resources('');
            $this->set_student_learning('');
    }

    public function set_access_to_resources($value)
    {
        $property = new \Orm_Property_Textarea('access_to_resources', $value);
        $property->set_description("1. Difficulties in access to resources or facilities (if any)");
        $this->set_property($property);
    }

    public function get_access_to_resources()
    {
        return $this->get_property('access_to_resources')->get_value();
    }

    public function set_student_learning($value)
    {
        $property = new \Orm_Property_Textarea('student_learning', $value);
        $property->set_description("2. Consequences of any difficulties experienced for student learning in the course.");
        $this->set_property($property);
    }

    public function get_student_learning()
    {
        return $this->get_property('student_learning')->get_value();
    }

}
