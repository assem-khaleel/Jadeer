<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_d_standard18
 *
 * @author laith
 */
class Acpe_Section_2_Sub_D_Standard18 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 18: Faculty and Staff—Quantitative Factors';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_faculty('');
            $this->set_key('');
            $this->set_sufficient_faculty('');
            $this->set_sufficient_faculty_texts('');
            $this->set_sufficient_staff('');
            $this->set_sufficient_staff_texts('');
    }

    public function set_faculty()
    {
        $property = new \Orm_Property_Fixedtext('faculty', 'The college or school has a cohort of faculty and staff with the qualifications and experience needed to effectively deliver and evaluate the professional degree program.');
        $this->set_property($property);
    }

    public function get_faculty()
    {
        return $this->get_property('faculty')->get_value();
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

    public function set_sufficient_faculty()
    {
        $property = new \Orm_Property_Fixedtext('sufficient_faculty', '<b>18.1. Sufficient faculty – The college or school has a sufficient number of faculty members to effectively address the following programmatic needs:'
            . '<ul><li>Teaching (didactic, simulation, and experiential)</li>'
            . '<li>Professional development</li>'
            . '<li>Research and other scholarly activities</li>'
            . '<li>Assessment activities</li>'
            . '<li>College/school and/or university service</li>'
            . '<li>Intraprofessional and interprofessional collaboration</li>'
            . '<li>Student advising and career counseling</li>'
            . '<li>Faculty mentoring</li>'
            . '<li>Professional service</li>'
            . '<li>Community service</li>'
            . '<li>Pharmacy practice</li>'
            . '<li>Responsibilities in other academic programs (if applicable)</li>'
            . '<li>Support of distance students and campus(es) (if applicable)*</li></ul></b>');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_sufficient_faculty()
    {
        return $this->get_property('sufficient_faculty')->get_value();
    }

    public function set_sufficient_faculty_texts($value)
    {
        $property = new \Orm_Property_Textarea('sufficient_faculty_texts', $value);
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_sufficient_faculty_texts()
    {
        return $this->get_property('sufficient_faculty_texts')->get_value();
    }

    public function set_sufficient_staff()
    {
        $property = new \Orm_Property_Fixedtext('sufficient_staff', '<b>18.2. Sufficient staff – The college or school has a sufficient number of staff to effectively address the following programmatic needs:'
            . '<ul><li>Student and academic affairs-related services, including recruitment and admission</li>'
            . '<li>Experiential education</li>'
            . '<li>Assessment activities</li>'
            . '<li>Research administration</li>'
            . '<li>Laboratory maintenance</li>'
            . '<li>Information technology infrastructure</li>'
            . '<li>Pedagogical and educational technology support</li>'
            . '<li>Teaching assistance</li>'
            . '<li>General faculty and administration clerical support</li>'
            . '<li>Support of distance students and campus(es) (if applicable)*</li></ul></b>');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_sufficient_staff()
    {
        return $this->get_property('sufficient_staff')->get_value();
    }

    public function set_sufficient_staff_texts($value)
    {
        $property = new \Orm_Property_Textarea('sufficient_staff_texts', $value);
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_sufficient_staff_texts()
    {
        return $this->get_property('sufficient_staff_texts')->get_value();
    }

}
