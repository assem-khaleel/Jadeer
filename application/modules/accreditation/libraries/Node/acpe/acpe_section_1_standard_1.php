<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_1_standard_1
 *
 * @author ahmadgx
 */
class Acpe_Section_1_Standard_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 1: Foundational Knowledge';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_foundational_sciences('');
            $this->set_key();
            $this->set_foundational_knowledge('');
    }

    public function set_foundational_sciences($value)
    {
        $property = new \Orm_Property_Textarea('foundational_sciences', $value);
        $property->set_description('The professional program leading to the Doctor of Pharmacy degree (hereinafter “the program”) develops in the graduate the knowledge, skills, abilities, behaviors, and attitudes necessary to apply the foundational sciences to the provision of patient-centered care.');
        $this->set_property($property);
    }

    public function get_foundational_sciences()
    {
        return $this->get_property('foundational_sciences')->get_value();
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

    public function set_foundational_knowledge($value)
    {
        $property = new \Orm_Property_Textarea('foundational_knowledge', $value);
        $property->set_description('1.1. Foundational knowledge – The graduate is able to develop, integrate, and apply knowledge from the foundational sciences (i.e., biomedical, pharmaceutical, social/behavioral/administrative, and clinical sciences) to evaluate the scientific literature, explain drug action, solve therapeutic problems, and advance population health and patient-centered care.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_foundational_knowledge()
    {
        return $this->get_property('foundational_knowledge')->get_value();
    }

}
