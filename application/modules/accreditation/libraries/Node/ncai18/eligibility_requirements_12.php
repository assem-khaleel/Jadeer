<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of eligibility_requirements_12
 *
 * @author laith
 */
class Eligibility_Requirements_12 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '12. Student Evaluation';
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
        $property = new \Orm_Property_Fixedtext('info', 'The institution must have established arrangements for student evaluation of courses and programs and mechanisms for the use of those survey results in program and course evaluations at department, college and institutional levels.  These arrangements should include a number of common questions across the institution for internal benchmarking purposes, and centralized processing of survey results with regular reports provided to relevant levels within the institution.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('Provide a summary report and evidence of student surveys');
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
