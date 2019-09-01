<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_asac;

/**
 * Description of program_criteria
 *
 * @author ahmadgx
 */
class Program_Criteria extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'PROGRAM CRITERIA';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_list('');
            $this->set_attchment('');
    }

    public function set_list($value)
    {
        $property = new \Orm_Property_Textarea('list', $value);
        $property->set_description('Describe how the program satisfies any applicable program criteria.  If already covered elsewhere in the self-study report, provide appropriate references.');
        $this->set_property($property);
    }

    public function get_list()
    {
        return $this->get_property('list')->get_value();
    }

    public function set_attchment($value)
    {
        $property = new \Orm_Property_Upload('attchment', $value);
        $this->set_property($property);
    }

    public function get_attchment()
    {
        return $this->get_property('attchment')->get_value();
    }

}
