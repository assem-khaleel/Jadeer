<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ssri_c_self_study_process
 *
 * @author ahmadgx
 */
class Ssri_C_Self_Study_Process extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'C. Self-Study Process';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_description_of_procedures('');
    }

    public function set_description_of_procedures($value)
    {
        $property = new \Orm_Property_Textarea('description_of_procedures', $value);
        $property->set_description(' Provide a brief description of procedures followed and administrative arrangements for the self-study.  Include an organization flowchart.  Membership and terms of reference for committees and /or working parties should be attached');
        $this->set_property($property);
    }

    public function get_description_of_procedures()
    {
        return $this->get_property('description_of_procedures')->get_value();
    }

}
