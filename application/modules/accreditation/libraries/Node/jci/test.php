<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_4_mpe
 *
 * @author ahmadgx
 */
class Test extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Test';
    protected $link_view = true;
    protected $link_edit = true;

    public function init()
    {
        parent::init();

            $this->set_factors(array());
    }

    public function set_factors($value)
    {
        $property = new \Orm_Property_Add_More('factors', $value);
        $property->set_description('Factors');

        $title = new \Orm_Property_Text('title');
        $title->set_description('Title');
        $property->add_property($title);

        $title_arabic = new \Orm_Property_Text('title_arabic');
        $title_arabic->set_description('Arabic Title');
        $property->add_property($title_arabic);

        $abbreviation = new \Orm_Property_Text('abbreviation');
        $abbreviation->set_description('Abbreviation');
        $property->add_property($abbreviation);

        $abbreviation_arabic = new \Orm_Property_Text('abbreviation_arabic');
        $abbreviation_arabic->set_description('Arabic Abbreviation');
        $property->add_property($abbreviation_arabic);


        $statements = new \Orm_Property_Add_More('statements', $value);
        $statements->set_description('Statements');

        $title = new \Orm_Property_Text('title');
        $title->set_description('Title');
        $statements->add_property($title);

        $title_arabic = new \Orm_Property_Text('title_arabic');
        $title_arabic->set_description('Arabic Title');
        $statements->add_property($title_arabic);

        $abbreviation = new \Orm_Property_Text('abbreviation');
        $abbreviation->set_description('Abbreviation');
        $statements->add_property($abbreviation);

        $abbreviation_arabic = new \Orm_Property_Text('abbreviation_arabic');
        $abbreviation_arabic->set_description('Arabic Abbreviation');
        $statements->add_property($abbreviation_arabic);


        $property->add_property($statements);


        $this->set_property($property);
    }

    public function get_users()
    {
        return $this->get_property('users')->get_value();
    }

}
