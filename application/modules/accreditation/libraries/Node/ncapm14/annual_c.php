<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of Annual_C
 *
 * @author user
 */
class Annual_C extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'C. Program Context';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_significant_changes_within_institution('');
            $this->set_within_implications_for_the_program('');
            $this->set_significant_changes_external_institution('');
            $this->set_external_implications_for_the_program('');
    }

    public function set_significant_changes_within_institution($value)
    {
        $property = new \Orm_Property_Textarea('significant_changes_within_institution', $value);
        $property->set_description('1. Significant changes within the institution affecting the program (if any) during the past year.');
        $this->set_property($property);
    }

    public function get_significant_changes_within_institution()
    {
        return $this->get_property('significant_changes_within_institution')->get_value();
    }

    public function set_within_implications_for_the_program($value)
    {
        $property = new \Orm_Property_Textarea('within_implications_for_the_program', $value);
        $property->set_description('Implications for the program');
        $this->set_property($property);
    }

    public function get_within_implications_for_the_program()
    {
        return $this->get_property('within_implications_for_the_program')->get_value();
    }

    public function set_significant_changes_external_institution($value)
    {
        $property = new \Orm_Property_Textarea('significant_changes_external_institution', $value);
        $property->set_description('2. Significant changes external to the institution affecting the program (if any) during the past year.');
        $this->set_property($property);
    }

    public function get_significant_changes_external_institution()
    {
        return $this->get_property('significant_changes_external_institution')->get_value();
    }

    public function set_external_implications_for_the_program($value)
    {
        $property = new \Orm_Property_Textarea('external_implications_for_the_program', $value);
        $property->set_description('Implications for the program');
        $this->set_property($property);
    }

    public function get_external_implications_for_the_program()
    {
        return $this->get_property('external_implications_for_the_program')->get_value();
    }

}
