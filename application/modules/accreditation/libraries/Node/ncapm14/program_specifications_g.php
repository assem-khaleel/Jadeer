<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of program_specifications_g
 *
 * @author ahmadgx
 */
class Program_Specifications_G extends \Orm_Node
{

    protected $class_type = __class__;
    protected $name = 'G. Learning Resources, Facilities and Equipment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_processes('');
            $this->set_teaching_staff_processes('');
            $this->set_text_book('');
            $this->set_resourses('');
            $this->set_acquisition_and_approval('');
    }

    public function set_processes($value)
    {
        $property = new \Orm_Property_Textarea('processes', $value);
        $property->set_description('1a. What processes are followed by faculty and teaching staff for planning and acquisition of textbooks, reference and other resource material including electronic and web based resources?');
        $this->set_property($property);
    }

    public function get_processes()
    {
        $this->get_property('processes')->get_value();
    }

    public function set_teaching_staff_processes($value)
    {
        $property = new \Orm_Property_Textarea('teaching_staff_processes', $value);
        $property->set_description('1b. What processes are followed by faculty and teaching staff for planning and acquisition resources for library, laboratories, and classrooms.');
        $this->set_property($property);
    }

    public function get_teaching_staff_processes()
    {
        $this->get_property('teaching_staff_processes')->get_value();
    }

    public function set_text_book($value)
    {
        $property = new \Orm_Property_Textarea('text_book', $value);
        $property->set_description('2. What processes are followed by faculty and teaching staff for evaluating the adequacy of textbooks, reference and other resource provisions?');
        $this->set_property($property);
    }

    public function get_text_book()
    {
        $this->get_property('text_book')->get_value();
    }

    public function set_resourses($value)
    {
        $property = new \Orm_Property_Textarea('resourses', $value);
        $property->set_description('3. What processes are followed by students for evaluating the adequacy of textbooks, reference and other resource provisions?');
        $this->set_property($property);
    }

    public function get_resourses()
    {
        $this->get_property('resourses')->get_value();
    }

    public function set_acquisition_and_approval($value)
    {
        $property = new \Orm_Property_Textarea('acquisition_and_approval', $value);
        $property->set_description('4. What processes are followed for textbook acquisition and approval?');
        $this->set_property($property);
    }

    public function get_acquisition_and_approval()
    {
        $this->get_property('acquisition_and_approval')->get_value();
    }

}
