<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_c_standard14
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_C_Standard14 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 14: Student Services';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_student_services('');
            $this->set_key('');
            $this->set_febra('');
            $this->set_financial_aid('');
            $this->set_healthcare('');
            $this->set_advising('');
            $this->set_nondiscrimination('');
            $this->set_accommodation('');
            $this->set_student_access('');
    }

    public function set_student_services()
    {
        $property = new \Orm_Property_Fixedtext('student_services', 'The college or school has an appropriately staffed and resourced organizational element dedicated to providing a comprehensive range of services that promote student success and well-being.');
        $this->set_property($property);
    }

    public function get_student_services()
    {
        return $this->get_property('student_services')->get_value();
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

    public function set_febra($value)
    {
        $property = new \Orm_Property_Textarea('febra', $value);
        $property->set_description('14.1. FERPA – The college or school has an ordered, accurate, and secure system of student records in compliance with the Family Educational Rights and Privacy Act (FERPA). Student services personnel and faculty are knowledgeable regarding FERPA law and its practices.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_febra()
    {
        return $this->get_property('febra')->get_value();
    }

    public function set_financial_aid($value)
    {
        $property = new \Orm_Property_Textarea('financial_aid', $value);
        $property->set_description('14.2. Financial aid – The college or school provides students with financial aid information and guidance by appropriately trained personnel.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_financial_aid()
    {
        return $this->get_property('financial_aid')->get_value();
    }

    public function set_healthcare($value)
    {
        $property = new \Orm_Property_Textarea('healthcare', $value);
        $property->set_description('14.3. Healthcare – The college or school offers students access to adequate health and counseling services. Appropriate immunization standards are established, along with the means to ensure that such standards are satisfied.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_healthcare()
    {
        return $this->get_property('healthcare')->get_value();
    }

    public function set_advising($value)
    {
        $property = new \Orm_Property_Textarea('advising', $value);
        $property->set_description('14.4. Advising – The college or school provides academic advising, curricular and career-pathway counseling, and information on post-graduate education and training opportunities adequate to meet the needs of its students.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_advising()
    {
        return $this->get_property('advising')->get_value();
    }

    public function set_nondiscrimination($value)
    {
        $property = new \Orm_Property_Textarea('nondiscrimination', $value);
        $property->set_description('14.5. Nondiscrimination – The college or school establishes and implements student service policies that ensure nondiscrimination as defined by state and federal laws and regulations.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_nondiscrimination()
    {
        return $this->get_property('nondiscrimination')->get_value();
    }

    public function set_accommodation($value)
    {
        $property = new \Orm_Property_Textarea('accommodation', $value);
        $property->set_description('14.6. Disability accommodation – The college or school provides accommodations to students with documented disabilities that are determined by the university Disability Office (or equivalent) to be reasonable, and provides support to faculty in accommodating disabled students.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_accommodation()
    {
        return $this->get_property('accommodation')->get_value();
    }

    public function set_student_access($value)
    {
        $property = new \Orm_Property_Textarea('student_access', $value);
        $property->set_description('14.7. Student services access* – The college or school offering multiple professional degree programs (e.g., PharmD/MPH) or pathways (campus and distance pathways) ensures that all students have equitable access to a comparable system of individualized student services (e.g., tutorial support, faculty advising, counseling, etc.).');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_student_access()
    {
        return $this->get_property('student_access')->get_value();
    }

}
