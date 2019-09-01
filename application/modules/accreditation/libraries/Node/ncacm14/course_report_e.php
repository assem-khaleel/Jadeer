<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_report_administrative_issues
 *
 * @author ahmadgx
 */
class Course_Report_E extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'E. Administrative Issues';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_administrative_difficulties('');
            $this->set_student_learning('');
    }

    public function set_administrative_difficulties($value)
    {
        $property = new \Orm_Property_Textarea('administrative_difficulties', $value);
        $property->set_description("1. Organizational or administrative difficulties encountered (if any)");
        $this->set_property($property);
    }

    public function get_administrative_difficulties()
    {
        return $this->get_property('administrative_difficulties')->get_value();
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
