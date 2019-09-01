<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of Annual_A
 *
 * @author user
 */
class Annual_A extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'A. Program Identification and General Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_program_title('');
            $this->set_program_code('');
            $this->set_name_and_position('');
            $this->set_academic_year('');
    }

    public function set_program_title($value)
    {
        $property = new \Orm_Property_Text('program_title', $value);
        $property->set_description('Program title');
        $this->set_property($property);
    }

    public function get_program_title()
    {
        return $this->get_property('program_title')->get_value();
    }

    public function set_program_code($value)
    {
        $property = new \Orm_Property_Text('program_code', $value);
        $property->set_description('Program Code');
        $this->set_property($property);
    }

    public function get_program_code()
    {
        return $this->get_property('program_code')->get_value();
    }

    public function set_name_and_position($value)
    {
        $property = new \Orm_Property_Text('name_and_position', $value);
        $property->set_description('Name and position of person completing the APR');
        $this->set_property($property);
    }

    public function get_name_and_position()
    {
        return $this->get_property('name_and_position')->get_value();
    }

    public function set_academic_year($value)
    {
        $property = new \Orm_Property_Text('academic_year', $value);
        $property->set_description('Academic year to which this report applies.');
        $this->set_property($property);
    }

    public function get_academic_year()
    {
        return $this->get_property('academic_year')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            /** @var \Orm_Program $program_obj */
            $program_obj = $program_node->get_item_obj();

            $this->set_program_title($program_obj->get_name('english'));
            $this->set_program_code($program_obj->get_number('english'));
            $this->set_academic_year($this->get_year());
        }
    }

}
