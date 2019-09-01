<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_1_part_1_a
 *
 * @author laith
 */
class Aacsb_Section_1_part_1_A extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard A';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_basis();
            $this->set_guide();
            $this->set_textarea1('');
            $this->set_textarea2('');
            $this->set_textarea3('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong> The accounting academic unit must encourage and support ethical behavior by students, faculty, administrators, and professional staff. [ETHICAL BEHAVIOR]]</strong> <br/> <br/>'
            . '<strong>Basis for Judgment</strong>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_basis()
    {
        $property = new \Orm_Property_Fixedtext('basis', '<ul type="circle"><li>Accounting academic units must have appropriate systems, policies, and procedures that reflect the unit’s support for and importance of proper behavior for administrators, faculty, professional staff, and students in their professional and personal actions. The accounting academic unit may follow policies of the business school or the larger institution of which it is a part.</li>'
            . '<li>The systems, policies, and procedures must provide appropriate mechanisms for addressing breaches of ethical behavior.</li>'
            . '<li>This criterion relates to the general procedures of a unit. In no instance will AACSB become involved in the adjudication or review of individual cases of alleged misconduct, whether by administrators, faculty, professional staff, students, the accounting academic unit, or the school.</li></ul>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_basis()
    {
        return $this->get_property('basis')->get_value();
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
        $property->set_description('Provide published policies and procedures to support legal and ethical behaviors.');
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
        $property->set_description('Describe programs to educate participants about ethics policies and procedures.');
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
        $property->set_description('Describe systems for detecting and addressing breaches of ethical behaviors, such as honor codes, codes of conduct, and disciplinary systems to manage inappropriate behavior');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea3()
    {
        return $this->get_property('textarea3')->get_value();
    }

}
