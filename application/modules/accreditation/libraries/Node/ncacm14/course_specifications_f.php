<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_specifications_f
 *
 * @author laith
 */
class Course_Specifications_F extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'F. Facilities Required';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_accommodation('');
            $this->set_computing_resource('');
            $this->set_other_resource('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Indicate requirements for the course including size of classrooms and laboratories (i.e. number of seats in classrooms and laboratories, extent of computer access etc.)');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_accommodation($value)
    {
        $property = new \Orm_Property_Textarea('accommodation', $value);
        $property->set_description('1. Accommodation (Classrooms, laboratories, demonstration rooms/labs, etc.)');
        $this->set_property($property);
    }

    public function get_accommodation()
    {
        return $this->get_property('accommodation')->get_value();
    }

    public function set_computing_resource($value)
    {
        $property = new \Orm_Property_Textarea('computing_resource', $value);
        $property->set_description('2. Computing resources (AV, data show, Smart Board, software, etc.)');
        $this->set_property($property);
    }

    public function get_computing_resource()
    {
        return $this->get_property('computing_resource')->get_value();
    }

    public function set_other_resource($value)
    {
        $property = new \Orm_Property_Textarea('other_resource', $value);
        $property->set_description('3. Other resources (specify, e.g. if specific laboratory equipment is required, list requirements or attach list)');
        $this->set_property($property);
    }

    public function get_other_resource()
    {
        return $this->get_property('other_resource')->get_value();
    }

}
