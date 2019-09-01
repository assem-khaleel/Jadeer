<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of eligibility_requirements_11
 *
 * @author laith
 */
class Eligibility_Requirements_11 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '11. Record Management';
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
        $property = new \Orm_Property_Fixedtext('info', 'The institution must have established arrangements for maintaining records and providing summary statistical data to departments, colleges and central committees (Quality committee and Curriculum Committee or equivalent) including at least the following information: <br/> <br/>'
            . '<ol type="a">'
            . '<li>Grade distributions for all courses.</li>'
            . '<li>Mean grade distributions for all courses for each department (or program), college, and the institution as a whole.  (desirably provided for courses at each year level)</li>'
            . '<li>Completion rates for all courses.</li>'
            . '<li>Mean completion rates for all courses for each department (or program), college, and the institution as a whole.  (desirably provided for courses at each year level)</li>'
            . '<li>Year to year progression rates and total program completion rates for all programs.</li>'
            . '</ol>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('Provide a summary report and evidence about the analysis and reporting of statistical data');
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
