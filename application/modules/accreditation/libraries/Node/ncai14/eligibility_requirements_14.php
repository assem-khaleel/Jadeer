<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of eligibility_requirements_14
 *
 * @author laith
 */
class Eligibility_Requirements_14 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '14. Key Performance Indicators and Benchmarks';
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
        $property = new \Orm_Property_Fixedtext('info', 'The institution must be able to provide reliable data on the Key Performance Indicators specified by the NCAAA and any additional indicators identified by the institution for its own performance evaluation.  Note that for the initial accreditation reviews to be conducted in (e.g. 2010) it is recognized that systems for collecting required data for all the NCAAA’s KPIs may not yet be in place.  However, data must be available for use in the institutions self study for a majority of items, and plans must have been prepared for the remaining items to be available.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('Provide a summary report and evidence of key performance indicators and benchmarks');
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
