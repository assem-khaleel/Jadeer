<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_c_standard16
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_C_Standard16 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 16: Admissions';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_admission('');
            $this->set_key('');
            $this->set_enrollment_management('');
            $this->set_admission_procedure('');
            $this->set_program_description('');
            $this->set_admission_criteria('');
            $this->set_admission_material('');
            $this->set_oral_communication('');
            $this->set_candidate_interview('');
            $this->set_transfer_policies('');
    }

    public function set_admission()
    {
        $property = new \Orm_Property_Fixedtext('admission', 'The college or school develops, implements, and assesses its admission criteria, policies, and procedures to ensure the selection of a qualified and diverse student body into the professional degree program.');
        $this->set_property($property);
    }

    public function get_admission()
    {
        return $this->get_property('admission')->get_value();
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

    public function set_enrollment_management($value)
    {
        $property = new \Orm_Property_Textarea('enrollment_management', $value);
        $property->set_description('16.1. Enrollment management – Student enrollment is managed by college or school administration. Enrollments are in alignment with available physical, educational, financial, faculty, staff, practice site, preceptor, and administrative resources.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_enrollment_management()
    {
        return $this->get_property('enrollment_management')->get_value();
    }

    public function set_admission_procedure($value)
    {
        $property = new \Orm_Property_Textarea('admission_procedure', $value);
        $property->set_description('16.2. Admission procedures – A duly constituted committee of the college or school has the responsibility and authority for the selection of students to be offered admission. Admission criteria, policies, and procedures are not compromised regardless of the size or quality of the applicant pool.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_admission_procedure()
    {
        return $this->get_property('admission_procedure')->get_value();
    }

    public function set_program_description($value)
    {
        $property = new \Orm_Property_Textarea('program_description', $value);
        $property->set_description('16.3. Program description and quality indicators – The college or school produces and makes available to the public, including prospective students: (1) a complete and accurate description of the professional degree program; (2) the program’s current accreditation status; and (3) ACPE-required program performance information including on-time graduation rates and most recent NAPLEX first-attempt pass rates.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_program_description()
    {
        return $this->get_property('program_description')->get_value();
    }

    public function set_admission_criteria($value)
    {
        $property = new \Orm_Property_Textarea('admission_criteria', $value);
        $property->set_description('16.4. Admission criteria – The college or school sets performance expectations for admission tests, evaluations, and interviews used in selecting students who have the potential for success in the professional degree program and the profession. Applicant performance on admission criteria is documented; and the related records are maintained by the college or school as per program/university requirements.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_admission_criteria()
    {
        return $this->get_property('admission_criteria')->get_value();
    }

    public function set_admission_material($value)
    {
        $property = new \Orm_Property_Textarea('admission_material', $value);
        $property->set_description('16.5. Admission materials – The college or school produces and makes available to prospective students the criteria, policies, and procedures for admission to the professional degree program. Admission materials clearly state academic expectations, required communication skills, types of personal history disclosures that may be required, and professional and technical standards for graduation.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_admission_material()
    {
        return $this->get_property('admission_material')->get_value();
    }

    public function set_oral_communication($value)
    {
        $property = new \Orm_Property_Textarea('oral_communication', $value);
        $property->set_description('16.6. Written and oral communication assessment – Written and oral communication skills are assessed in a standardized manner as part of the admission process.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_oral_communication()
    {
        return $this->get_property('oral_communication')->get_value();
    }

    public function set_candidate_interview($value)
    {
        $property = new \Orm_Property_Textarea('candidate_interview', $value);
        $property->set_description('16.7. Candidate interviews – Standardized interviews (in-person, telephonic, and/or computer-facilitated) of applicants are conducted as a part of the admission process to assess affective domain characteristics (i.e., the Personal and Professional Development domain articulated in Standard 4).');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_candidate_interview()
    {
        return $this->get_property('candidate_interview')->get_value();
    }

    public function set_transfer_policies($value)
    {
        $property = new \Orm_Property_Textarea('transfer_policies', $value);
        $property->set_description('16.8. Transfer and waiver policies – A college or school offering multiple professional degree programs, or accepting transfer students from other schools or colleges of pharmacy, establishes and implements policies and procedures for students who request to transfer credits between programs. Such policies and procedures are based on defensible assessments of course equivalency. A college or school offering multiple pathways to a single degree has policies and procedures for students who wish to change from one pathway to another.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_transfer_policies()
    {
        return $this->get_property('transfer_policies')->get_value();
    }

}
