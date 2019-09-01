<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of Aacsb_Section_2_Accounting_Professional_Standard_A8
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Professional_Standard_A8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard A8';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_guide();
            $this->set_textarea1('');
            $this->set_textarea2('');
            $this->set_textarea3('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong> The accounting academic unit’s faculty, as a whole, includes a sufficient number of individuals with professional accounting credentials, qualifications, certifications, and professional experience, and the unit deploys these individuals in ways that are consistent with the unit’s mission, expected outcomes, and supporting strategies. [FACULTY PROFESSIONAL CREDENTIALS—NO RELATED BUSINESS STANDARD]</strong> <br/> <br/>'
            . '<strong>Basis for Judgment</strong> <br/>'
            . '<ul type="circle">'
            . '<li>Professional certifications, licenses, and experience demonstrated by the accounting academic unit’s faculty and professional staff are appropriate with its mission and the degree programs it offers.</li>'
            . '<li>The accounting academic unit provides support for maintenance of certifications and licenses.</li>'
            . '</ul>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_guide()
    {
        $property = new \Orm_Property_Fixedtext('guide', '<strong>Guidance for Documentation</strong>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_guide()
    {
        return $this->get_property('guide')->get_value();
    }

    public function set_textarea1($value)
    {
        $property = new \Orm_Property_Textarea('textarea1', $value);
        $property->set_description('Document the professional accounting credentials (including certifications, qualifications, and licenses) held by the unit’s faculty and staff, as well as their experience in the field.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea1()
    {
        return $this->get_property('textarea1')->get_value();
    }

    public function set_textarea2($value)
    {
        $property = new \Orm_Property_Textarea('textarea2', $value);
        $property->set_description('Document the unit’s support to help faculty earn and maintain the above.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea2()
    {
        return $this->get_property('textarea2')->get_value();
    }

    public function set_textarea3($value)
    {
        $property = new \Orm_Property_Textarea('textarea3', $value);
        $property->set_description('If a focus of the units academic degree programs is preparation of students to seek certifications, qualifications, and licenses, discuss how faculty’s credentials, professional experiences, and related activities support this objective.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea3()
    {
        return $this->get_property('textarea3')->get_value();
    }

}
