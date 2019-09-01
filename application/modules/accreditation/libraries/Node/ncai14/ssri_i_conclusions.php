<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ssri_i_conclusions
 *
 * @author ahmadgx
 */
class Ssri_I_Conclusions extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'I. Conclusions';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_successful('');
            $this->set_satisfactory('');
    }

    public function set_successful($value)
    {
        $property = new \Orm_Property_Textarea('successful', $value);
        $property->set_description("1. List and briefly describe institutional activities that are particularly successful or that demonstrate high quality.");
        $this->set_property($property);
    }

    public function get_successful()
    {
        return $this->get_property('successful')->get_value();
    }

    public function set_satisfactory($value)
    {
        $property = new \Orm_Property_Textarea('satisfactory', $value);
        $property->set_description("2.  List and briefly describe institutional activities that are less than satisfactory and that need to be improved.");
        $this->set_property($property);
    }

    public function get_satisfactory()
    {
        return $this->get_property('satisfactory')->get_value();
    }

}
