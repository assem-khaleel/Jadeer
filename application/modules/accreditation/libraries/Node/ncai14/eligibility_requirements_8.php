<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of eligibility_requirements_8
 *
 * @author laith
 */
class Eligibility_Requirements_8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '8. Course Specifications  (refer attachment  2)';
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
        $property = new \Orm_Property_Fixedtext('info', 'The institution must have course specifications using the template required by the NCAAA for all courses in all its programs and firm commitments to complete specifications for all remaining courses by the proposed time for the external review.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('Complete three course specifications for each level (x12) as attached to the eligibility list');
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
