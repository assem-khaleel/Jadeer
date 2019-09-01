<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:33 م
 */

namespace Node\ncapm18;


class Program_Specifications_I extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'I. Program management and regulations';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();
        $this->set_structure();
        $this->set_program_structure('');
        $this->set_stakeholder('');
        $this->set_program_regulation('');

    }

    public function set_structure()
    {
        $property = new \Orm_Property_Fixedtext('structure', '<strong>1. Program management structure</strong>');
        $property->set_group('structure');
        $this->set_property($property);
    }

    public function get_structure()
    {
        return $this->get_property('structure')->get_value();
    }

    public function set_program_structure($value)
    {
        $property = new \Orm_Property_Textarea('program_structure', $value);
        $property->set_description('1.1 Describe the Program structure (including committees, council, units, boards …)');
        $property->set_group('structure');
        $this->set_property($property);
    }

    public function get_program_structure()
    {
        return $this->get_property('program_structure')->get_value();
    }

    public function set_stakeholder($value)
    {
        $property = new \Orm_Property_Textarea('stakeholder', $value);
        $property->set_description("1.2  Describe the stakeholder's representation in the Program management system (students, professional bodies, scientific societies alumni, employers, etc.)");
        $property->set_group('structure');
        $this->set_property($property);
    }

    public function get_stakeholder()
    {
        return $this->get_property('stakeholder')->get_value();
    }

    public function set_program_regulation($value)
    {
        $property = new \Orm_Property_Textarea('program_regulation', $value);
        $property->set_description('2. Program regulations(link to on-line version)');
        $this->set_property($property);
    }

    public function get_program_regulation()
    {
        return $this->get_property('program_regulation')->get_value();
    }
}