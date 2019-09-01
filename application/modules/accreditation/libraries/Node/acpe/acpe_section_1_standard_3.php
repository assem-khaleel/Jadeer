<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_1_standard_3
 *
 * @author ahmadgx
 */
class Acpe_Section_1_Standard_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 3: Approach to Practice and Care';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_approach_care('');
            $this->set_key('');
            $this->set_problem_solving('');
            $this->set_education('');
            $this->set_patient('');
            $this->set_collaboration('');
            $this->set_cultural_sensitivity('');
            $this->set_communication('');
    }

    public function set_approach_care($value)
    {
        $property = new \Orm_Property_Textarea('approach_care', $value);
        $property->set_description('The program imparts to the graduate the knowledge, skills, abilities, behaviors, and attitudes necessary to solve problems; educate, advocate, and collaborate, working with a broad range of people; recognize social determinants of health; and effectively communicate verbally and nonverbally.');
        $this->set_property($property);
    }

    public function get_approach_care()
    {
        return $this->get_property('approach_care')->get_value();
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

    public function set_problem_solving($value)
    {
        $property = new \Orm_Property_Textarea('problem_solving', $value);
        $property->set_description('3.1. Problem solving – The graduate is able to identify problems; explore and prioritize potential strategies; and design, implement, and evaluate a viable solution.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_problem_solving()
    {
        return $this->get_property('problem_solving')->get_value();
    }

    public function set_education($value)
    {
        $property = new \Orm_Property_Textarea('education', $value);
        $property->set_description('3.2. Education – The graduate is able to educate all audiences by determining the most effective and enduring ways to impart information and assess learning.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_education()
    {
        return $this->get_property('education')->get_value();
    }

    public function set_patient($value)
    {
        $property = new \Orm_Property_Textarea('patient', $value);
        $property->set_description('3.3. Patient advocacy – The graduate is able to represent the patient’s best interests.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_patient()
    {
        return $this->get_property('patient')->get_value();
    }

    public function set_collaboration($value)
    {
        $property = new \Orm_Property_Textarea('collaboration', $value);
        $property->set_description('3.4. Interprofessional collaboration – The graduate is able to actively participate and engage as a healthcare team member by demonstrating mutual respect, understanding, and values to meet patient care needs.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_collaboration()
    {
        return $this->get_property('collaboration')->get_value();
    }

    public function set_cultural_sensitivity($value)
    {
        $property = new \Orm_Property_Textarea('cultural_sensitivity', $value);
        $property->set_description('3.5. Cultural sensitivity – The graduate is able to recognize social determinants of health to diminish disparities and inequities in access to quality care.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_cultural_sensitivity()
    {
        return $this->get_property('cultural_sensitivity')->get_value();
    }

    public function set_communication($value)
    {
        $property = new \Orm_Property_Textarea('communication', $value);
        $property->set_description('3.6. Communication – The graduate is able to effectively communicate verbally and nonverbally when interacting with individuals, groups, and organizations.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_communication()
    {
        return $this->get_property('communication')->get_value();
    }

}
