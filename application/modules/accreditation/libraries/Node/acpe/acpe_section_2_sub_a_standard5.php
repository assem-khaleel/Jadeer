<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_a_standard5
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_A_Standard5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 5: Eligibility and Reporting Requirements';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_reporting_requirements('');
            $this->set_key('');
            $this->set_autonomy('');
            $this->set_legal('');
            $this->set_dean_leadership('');
            $this->set_regional('');
            $this->set_regional_action('');
            $this->set_change('');
    }

    public function set_reporting_requirements()
    {
        $property = new \Orm_Property_Fixedtext('reporting_requirements', 'The program meets all stated degree-granting eligibility and reporting requirements.');
        $this->set_property($property);
    }

    public function get_reporting_requirements()
    {
        return $this->get_property('reporting_requirements')->get_value();
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

    public function set_autonomy($value)
    {
        $property = new \Orm_Property_Textarea('autonomy', $value);
        $property->set_description('5.1. Autonomy – The academic unit offering the Doctor of Pharmacy program is an autonomous unit organized as a college or school of pharmacy (within a university or as an independent entity). This includes autonomy to manage the professional program within stated policies and procedures, as well as applicable state and federal regulations.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_autonomy()
    {
        return $this->get_property('autonomy')->get_value();
    }

    public function set_legal($value)
    {
        $property = new \Orm_Property_Textarea('legal', $value);
        $property->set_description('5.2. Legal empowerment – The college or school is legally empowered to offer and award the Doctor of Pharmacy degree.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_legal()
    {
        return $this->get_property('legal')->get_value();
    }

    public function set_dean_leadership($value)
    {
        $property = new \Orm_Property_Textarea('dean_leadership', $value);
        $property->set_description("5.3. Dean’s leadership – The college or school is led by a dean, who serves as the chief administrative and academic officer of the college or school and is responsible for ensuring that all accreditation requirements of ACPE are met.");
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_dean_leadership()
    {
        return $this->get_property('dean_leadership')->get_value();
    }

    public function set_regional($value)
    {
        $property = new \Orm_Property_Textarea('regional', $value);
        $property->set_description('5.4. Regional/institutional accreditation – The institution housing the college or school, or the independent college or school, has (or, in the case of new programs, is seeking) full accreditation by a regional/institutional accreditation agency recognized by the U.S. Department of Education.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_regional()
    {
        return $this->get_property('regional')->get_value();
    }

    public function set_regional_action($value)
    {
        $property = new \Orm_Property_Textarea('regional_action', $value);
        $property->set_description('5.5. Regional/institutional accreditation actions – The college or school reports to ACPE within 30 days any issue identified in regional/institutional accreditation actions that may have a negative impact on the quality of the professional degree program and compliance with ACPE standards.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_regional_action()
    {
        return $this->get_property('regional_action')->get_value();
    }

    public function set_change($value)
    {
        $property = new \Orm_Property_Textarea('change', $value);
        $property->set_description('5.6. Substantive change – The dean promptly reports substantive changes in organizational structure and/or processes (including financial factors) to ACPE for the purpose of evaluation of their impact on programmatic quality');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_change()
    {
        return $this->get_property('change')->get_value();
    }

}
