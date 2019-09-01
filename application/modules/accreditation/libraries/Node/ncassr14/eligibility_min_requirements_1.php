<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of Eligibility_Requirements_1
 *
 * @author laith
 */
class Eligibility_Min_Requirements_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '1. Strategic Plan';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_attachment('');
            $this->set_comment('');
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('Provide a copy of the institutions approved strategic plan');
        $this->set_property($property);
    }

    public function get_attachment()
    {
        return $this->get_property('attachment')->get_value();
    }

    public function set_comment($value)
    {
        $property = new \Orm_Property_Textarea('comment', $value);
        $property->set_description('Comment');
        $this->set_property($property);
    }

    public function get_comment()
    {
        return $this->get_property('comment')->get_value();
    }

}
