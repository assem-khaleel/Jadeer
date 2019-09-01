<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of program_specifications_e
 *
 * @author ahmadgx
 */
class Program_Specifications_E extends \Orm_Node
{

    protected $class_type = __class__;
    protected $name = 'E. Regulations for Student Assessment and Verification of Standards';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_processes('');
    }

    public function set_processes($value)
    {
        $property = new \Orm_Property_Textarea('processes', $value);
        $property->set_description('What processes will be used for verifying standards of achievement (eg., verify grading samples of tests or assignments? Independent assessment by faculty from another institution)(Processes may vary for different courses or domains of learning.)');
        $this->set_property($property);
    }

    public function get_processes()
    {
        $this->get_property('processes')->get_value();
    }

}
