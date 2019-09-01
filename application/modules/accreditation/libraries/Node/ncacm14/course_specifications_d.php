<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_specifications_d
 *
 * @author laith
 */
class Course_Specifications_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'D. Student Academic Counseling and Support';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_student_support('');
    }

    public function set_student_support($value)
    {
        $property = new \Orm_Property_Textarea('student_support', $value);
        $property->set_description('1. Arrangements for availability of faculty and teaching staff for individual student consultations and academic advice. (include amount of time teaching staff are expected to be available each week)');
        $this->set_property($property);
    }

    public function get_student_support()
    {
        return $this->get_property('student_support')->get_value();
    }

}
