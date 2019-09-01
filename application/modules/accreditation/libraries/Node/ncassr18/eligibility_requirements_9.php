<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of eligibility_requirements_9
 *
 * @author laith
 */
class Eligibility_Requirements_9 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '9. Program Advisory committees';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_attachment('');
            $this->set_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'For any program designed to prepare students for professional practice, a program, department or college advisory committee must have been established with a majority of members in the profession(s) concerned who are external to the institution. Terms of reference of that committee must include reviewing program evaluation data and providing advice on program content and delivery arrangements.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('Insert a sample of minutes, records and reports of the Program Advisory Committee for the last two years.');
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
