<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 03:21 م
 */

namespace Node\ncacm18;


class Field_Experience_Specification_E extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'E. Evaluation of the Field Experience';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_info();
        $this->set_student_eval('');
        $this->set_staff_eval('');
        $this->set_faculty_eval('');
        $this->set_others_eval('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>1. Describe the evaluation process and list recommendations for improvement of field experience activities by:</strong>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_student_eval($value)
    {
        $property = new \Orm_Property_Textarea('student_eval', $value);
        $property->set_description('a. Students: Describe evaluation process');
        $this->set_property($property);
    }

    public function get_student_eval()
    {
        return $this->get_property('student_eval')->get_value();
    }


    public function set_staff_eval($value)
    {
        $property = new \Orm_Property_Textarea('staff_eval', $value);
        $property->set_description('b. Supervising staff in the field setting: Describe evaluation process');
        $this->set_property($property);
    }

    public function get_staff_eval()
    {
        return $this->get_property('staff_eval')->get_value();
    }


    public function set_faculty_eval($value)
    {
        $property = new \Orm_Property_Textarea('faculty_eval', $value);
        $property->set_description('c. Supervising faculty from the institution:  Describe evaluation process');
        $this->set_property($property);
    }

    public function get_faculty_eval()
    {
        return $this->get_property('faculty_eval')->get_value();
    }

    public function set_others_eval($value)
    {
        $property = new \Orm_Property_Textarea('others_eval', $value);
        $property->set_description('d. Others—(e.g. graduates, independent evaluator, etc.): Describe evaluation process');
        $this->set_property($property);
    }

    public function get_others_eval()
    {
        return $this->get_property('others_eval')->get_value();
    }
}