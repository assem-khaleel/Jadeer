<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_j
 *
 * @author ahmadgx
 */
class Ssr_J extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'J. Conclusions ';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_describtion_list('');
            $this->set_improved_program('');
    }

    public function set_describtion_list($value)
    {
        $property = new \Orm_Property_Textarea('describtion_list', $value);
        $property->set_description('1. List and briefly describe aspects of the program that are particularly successful or that demonstrate high quality.');
        $this->set_property($property);
    }

    public function get_describtion_list()
    {
        return $this->get_property('describtion_list')->get_value();
    }

    public function set_improved_program($value)
    {
        $property = new \Orm_Property_Textarea('improved_program', $value);
        $property->set_description('2. List and briefly describe aspects of the program that are less than satisfactory and that need to be improved.');
        $this->set_property($property);
    }

    public function get_improved_program()
    {
        return $this->get_property('improved_program')->get_value();
    }

}
