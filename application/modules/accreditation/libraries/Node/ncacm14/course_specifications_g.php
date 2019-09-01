<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_specifications_g
 *
 * @author laith
 */
class Course_Specifications_G extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'G. Course Evaluation and Improvement Processes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_strategy('');
            $this->set_other_strategy('');
            $this->set_process_improve('');
            $this->set_process_verify('');
            $this->set_plan('');
    }

    public function set_strategy($value)
    {
        $property = new \Orm_Property_Textarea('strategy', $value);
        $property->set_description('1. Strategies for Obtaining Student Feedback on Effectiveness of Teaching');
        $this->set_property($property);
    }

    public function get_strategy()
    {
        return $this->get_property('strategy')->get_value();
    }

    public function set_other_strategy($value)
    {
        $property = new \Orm_Property_Textarea('other_strategy', $value);
        $property->set_description('2. Other Strategies for Evaluation of Teaching by the Instructor or by the Department');
        $this->set_property($property);
    }

    public function get_other_strategy()
    {
        return $this->get_property('other_strategy')->get_value();
    }

    public function set_process_improve($value)
    {
        $property = new \Orm_Property_Textarea('process_improve', $value);
        $property->set_description('3. Processes for Improvement of Teaching');
        $this->set_property($property);
    }

    public function get_process_improve()
    {
        return $this->get_property('process_improve')->get_value();
    }

    public function set_process_verify($value)
    {
        $property = new \Orm_Property_Textarea('process_verify', $value);
        $property->set_description('4. Processes for Verifying Standards of Student Achievement (e.g. check marking by an independent  member teaching staff of a sample of student work, periodic exchange and remarking of tests or a sample of assignments with staff at another institution)');
        $this->set_property($property);
    }

    public function get_process_verify()
    {
        return $this->get_property('process_verify')->get_value();
    }

    public function set_plan($value)
    {
        $property = new \Orm_Property_Textarea('plan', $value);
        $property->set_description('5. Describe the planning arrangements for periodically reviewing course effectiveness and planning for improvement.');
        $this->set_property($property);
    }

    public function get_plan()
    {
        return $this->get_property('plan')->get_value();
    }

}
