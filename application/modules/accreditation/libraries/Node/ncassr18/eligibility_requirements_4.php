<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of eligibility_requirements_4
 *
 * @author laith
 */
class Eligibility_Requirements_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4. Course Specifications and their corresponding Course Reports – T6';
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
        $property = new \Orm_Property_Fixedtext('info', 'Course Specifications must have been prepared, using the NCAAA template, and approved for all courses included in the program. Course Reports must have been prepared for at least one year for the application to be approved and for a second year by the time of the site visit.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('Complete two Course Specifications together with their corresponding Course Reports for each semester (or provide a link) (click → T6).');
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

    public function set_explain()
    {
        $property = new \Orm_Property_Fixedtext('explain', 'For Example:  Four (4) year programs require a total of 16 Course Specifications with their Course Reports');
        $this->set_property($property);
    }

    public function get_explain()
    {
        return $this->get_property('explain')->get_value();
    }

}
