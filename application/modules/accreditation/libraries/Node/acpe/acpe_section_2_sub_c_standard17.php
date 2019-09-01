<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_c_standard17
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_C_Standard17 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 17: Progression';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_progression('');
            $this->set_key('');
            $this->set_progression_polices('');
            $this->set_progression_polices_texts('');
            $this->set_early_intervention('');
    }

    public function set_progression()
    {
        $property = new \Orm_Property_Fixedtext('progression', 'The college or school develops, implements, and assesses its policies and procedures related to student progression through the PharmD program.');
        $this->set_property($property);
    }

    public function get_progression()
    {
        return $this->get_property('progression')->get_value();
    }

    public function set_key()
    {
        $property = new \Orm_Property_Fixedtext('key', '<b>Key Element:</b>');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_key()
    {
        return $this->get_property('key')->get_value();
    }

    public function set_progression_polices()
    {
        $property = new \Orm_Property_Fixedtext('progression_polices', '<b>17.1. Progression policies – The college or school creates, makes available to students and prospective students, and abides by criteria, policies, and procedures related to:'
            . '<ul><li>Academic progression</li>'
            . '<li>Remediation</li>'
            . '<li>Missed course work or credit</li>'
            . '<li>Academic probation</li>'
            . '<li>Academic dismissal</li>'
            . '<li>Dismissal for reasons of misconduct</li>'
            . '<li>Readmission</li>'
            . '<li>Leaves of absence</li>'
            . '<li>Rights to due process</li>'
            . '<li>Appeal mechanisms (including grade appeals)</li></ul></b>');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_progression_polices()
    {
        return $this->get_property('progression_polices')->get_value();
    }

    public function set_progression_polices_texts($value)
    {
        $property = new \Orm_Property_Textarea('progression_polices_texts', $value);
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_progression_polices_texts()
    {
        return $this->get_property('progression_polices_texts')->get_value();
    }

    public function set_early_intervention($value)
    {
        $property = new \Orm_Property_Textarea('early_intervention', $value);
        $property->set_description('17.2. Early intervention – The college or school’s system of monitoring student performance provides for early detection of academic and behavioral issues. The college or school develops and implements appropriate interventions that have the potential for successful resolution of the identified issues.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_early_intervention()
    {
        return $this->get_property('early_intervention')->get_value();
    }

}
