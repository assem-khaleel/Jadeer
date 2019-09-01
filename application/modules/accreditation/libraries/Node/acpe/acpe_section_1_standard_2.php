<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_1_standard_2
 *
 * @author ahmadgx
 */
class Acpe_Section_1_Standard_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 2: Essentials for Practice and Care';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_essentials('');
            $this->set_key('');
            $this->set_patient_care('');
            $this->set_medication_management('');
            $this->set_health('');
            $this->set_population('');
    }

    public function set_essentials($value)
    {
        $property = new \Orm_Property_Textarea('essentials', $value);
        $property->set_description('The program imparts to the graduate the knowledge, skills, abilities, behaviors, and attitudes necessary to provide patient-centered care, manage medication use systems, promote health and wellness, and describe the influence of population-based care on patient-centered care.');
        $this->set_property($property);
    }

    public function get_essentials()
    {
        return $this->get_property('essentials')->get_value();
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

    public function set_patient_care($value)
    {
        $property = new \Orm_Property_Textarea('patient_care', $value);
        $property->set_description('2.1. Patient-centered care – The graduate is able to provide patient-centered care as the medication expert (collect and interpret evidence, prioritize, formulate assessments and recommendations, implement, monitor and adjust plans, and document activities).');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_patient_care()
    {
        return $this->get_property('patient_care')->get_value();
    }

    public function set_medication_management($value)
    {
        $property = new \Orm_Property_Textarea('medication_management', $value);
        $property->set_description('2.2. Medication use systems management – The graduate is able to manage patient healthcare needs using human, financial, technological, and physical resources to optimize the safety and efficacy of medication use systems.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_medication_management()
    {
        return $this->get_property('medication_management')->get_value();
    }

    public function set_health($value)
    {
        $property = new \Orm_Property_Textarea('health', $value);
        $property->set_description('2.3. Health and wellness – The graduate is able to design prevention, intervention, and educational strategies for individuals and communities to manage chronic disease and improve health and wellness.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_health()
    {
        return $this->get_property('health')->get_value();
    }

    public function set_population($value)
    {
        $property = new \Orm_Property_Textarea('population', $value);
        $property->set_description('2.4. Population-based care – The graduate is able to describe how population-based care influences patient-centered care and the development of practice guidelines and evidence-based best practices.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_population()
    {
        return $this->get_property('population')->get_value();
    }

}
