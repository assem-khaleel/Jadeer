<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of Annual_E
 *
 * @author user
 */
class Annual_E extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'E. Program Management and Administration';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_program_managemnet(array());
    }

    public function set_program_managemnet($value)
    {
        $property = new \Orm_Property_Table_Dynamic('program_managemnet', $value);

        $list = new \Orm_Property_Textarea('list_diffculties');
        $list->set_description('List difficulties (if any) encountered in management of the program');
        $list->set_enable_tinymce(0);
        $list->set_width(230);
        $property->add_property($list);

        $impact = new \Orm_Property_Textarea('impact_difficulties');
        $impact->set_description('Impact of difficulties on the achievement of the program objectives');
        $impact->set_enable_tinymce(0);
        $impact->set_width(230);
        $property->add_property($impact);

        $proposed = new \Orm_Property_Textarea('proposed_action');
        $proposed->set_description('Proposed action to avoid future difficulties in response.');
        $proposed->set_enable_tinymce(0);
        $proposed->set_width(230);
        $property->add_property($proposed);

        $this->set_property($property);
    }

    public function get_program_managemnet()
    {
        return $this->get_property('program_managemnet')->get_value();
    }

}
