<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_b_standard12
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_B_Standard12 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 12: Pre-Advanced Pharmacy Practice Experience (Pre-APPE) Curriculum';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_preadvance_pharmacy('');
            $this->set_key('');
            $this->set_curriculum('');
            $this->set_development('');
            $this->set_domail_elements('');
            $this->set_lifespan('');
            $this->set_expectations('');
            $this->set_duration('');
            $this->set_simulation('');
    }

    public function set_preadvance_pharmacy()
    {
        $property = new \Orm_Property_Fixedtext('preadvance_pharmacy', 'The Pre-APPE curriculum provides a rigorous foundation in the biomedical, pharmaceutical, social/administrative/behavioral, and clinical sciences, incorporates Introductory Pharmacy Practice Experience (IPPE), and inculcates habits of self-directed lifelong learning to prepare students for Advanced Pharmacy Practice Experience (APPE).');
        $this->set_property($property);
    }

    public function get_preadvance_pharmacy()
    {
        return $this->get_property('preadvance_pharmacy')->get_value();
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

    public function set_curriculum($value)
    {
        $property = new \Orm_Property_Textarea('curriculum', $value);
        $property->set_description('12.1. Didactic curriculum – The didactic portion of the Pre-APPE curriculum includes rigorous instruction in all sciences that define the profession (see Appendix 1). Appropriate breadth and depth of instruction in these sciences is documented regardless of curricular model employed (e.g., blocked, integrated, traditional ‘stand-alone’ course structure, etc.).');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_curriculum()
    {
        return $this->get_property('curriculum')->get_value();
    }

    public function set_development($value)
    {
        $property = new \Orm_Property_Textarea('development', $value);
        $property->set_description('12.2. Development and maturation – The Pre-APPE curriculum allows for the development and maturation of the knowledge, skills, abilities, attitudes, and behaviors that underpin the Educational Outcomes articulated in Standards 1–4 and within Appendices 1 and 2.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_development()
    {
        return $this->get_property('development')->get_value();
    }

    public function set_domail_elements($value)
    {
        $property = new \Orm_Property_Textarea('domail_elements', $value);
        $property->set_description('12.3. Affective domain elements – Curricular and, if needed, co-curricular activities and experiences are purposely developed and implemented to ensure an array of opportunities for students to document competency in the affective domain-related expectations of Standards 3 and 4. Co-curricular activities complement and advance the learning that occurs within the formal didactic and experiential curriculum.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_domail_elements()
    {
        return $this->get_property('domail_elements')->get_value();
    }

    public function set_lifespan($value)
    {
        $property = new \Orm_Property_Textarea('lifespan', $value);
        $property->set_description('12.4. Care across the lifespan – The Pre-APPE curriculum provides foundational knowledge and skills that allow for care across the patient’s lifespan.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_lifespan()
    {
        return $this->get_property('lifespan')->get_value();
    }

    public function set_expectations($value)
    {
        $property = new \Orm_Property_Textarea('expectations', $value);
        $property->set_description('12.5. IPPE expectations – IPPEs expose students to common contemporary U.S. practice models, including interprofessional practice involving shared patient care decision-making, professional ethics and expected behaviors, and direct patient care activities. IPPEs are structured and sequenced to intentionally develop in students a clear understanding of what constitutes exemplary pharmacy practice in the U.S. prior to beginning APPE.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_expectations()
    {
        return $this->get_property('expectations')->get_value();
    }

    public function set_duration($value)
    {
        $property = new \Orm_Property_Textarea('duration', $value);
        $property->set_description('12.6. IPPE duration – IPPE totals no less than 300 clock hours of experience and is purposely integrated into the didactic curriculum. A minimum of 150 hours of IPPE are balanced between community and institutional health-system settings.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_duration()
    {
        return $this->get_property('duration')->get_value();
    }

    public function set_simulation($value)
    {
        $property = new \Orm_Property_Textarea('simulation', $value);
        $property->set_description('12.7. Simulation for IPPE – Simulated practice experiences (a maximum of 60 clock hours of the total 300 hours) may be used to mimic actual or realistic pharmacist-delivered patient care situations. However, simulation hours do not substitute for the 150 clock hours of required IPPE time in community and institutional health-system settings. Didactic instruction associated with the implementation of simulated practice experiences is not counted toward any portion of the 300 clock hour IPPE requirement.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_simulation()
    {
        return $this->get_property('simulation')->get_value();
    }

}
