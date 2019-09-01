<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_3_standard_25
 *
 * @author ahmadgx
 */
class Acpe_Section_3_Standard_25 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 25: Assessment Elements for Section II: Structure and Process';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_key('');
            $this->set_assessment_effectiveness('');
            $this->set_program_evaluation('');
            $this->set_curriculum_assessment('');
            $this->set_faculty_productivity('');
            $this->set_pathway('');
            $this->set_interprofessional_preparedness('');
            $this->set_clinical_reasoning('');
            $this->set_appe_preparedness('');
            $this->set_admission_criteria('');
    }

    public function set_college()
    {
        $property = new \Orm_Property_Fixedtext('college', 'The college or school develops, resources, and implements a plan to assess attainment of the Key Elements within Standards 5–23.');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
    }

    public function set_key()
    {
        $property = new \Orm_Property_Fixedtext('key', '<b>Specific Key Elements:</b>');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_key()
    {
        return $this->get_property('key')->get_value();
    }

    public function set_assessment_effectiveness($value)
    {
        $property = new \Orm_Property_Textarea('assessment_effectiveness', $value);
        $property->set_description('25.1. Assessment of organizational effectiveness – The college or school’s assessment plan is designed to provide insight into the effectiveness of the organizational structure in engaging and uniting constituents and positioning the college or school for success through purposeful planning.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_assessment_effectiveness()
    {
        return $this->get_property('assessment_effectiveness')->get_value();
    }

    public function set_program_evaluation($value)
    {
        $property = new \Orm_Property_Textarea('program_evaluation', $value);
        $property->set_description('25.2. Program evaluation by stakeholders – The assessment plan includes the use of data from AACP standardized surveys of graduating students, faculty, preceptors, and alumni.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_program_evaluation()
    {
        return $this->get_property('program_evaluation')->get_value();
    }

    public function set_curriculum_assessment($value)
    {
        $property = new \Orm_Property_Textarea('curriculum_assessment', $value);
        $property->set_description('25.3. Curriculum assessment and improvement – The college or school systematically assesses its curricular structure, content, organization, and outcomes. The college or school documents the use of assessment data for continuous improvement of the curriculum and its delivery.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_curriculum_assessment()
    {
        return $this->get_property('curriculum_assessment')->get_value();
    }

    public function set_faculty_productivity($value)
    {
        $property = new \Orm_Property_Textarea('faculty_productivity', $value);
        $property->set_description('25.4. Faculty productivity assessment – The college or school systematically assesses the productivity of its faculty in scholarship, teaching effectiveness, and professional and community service.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_faculty_productivity()
    {
        return $this->get_property('faculty_productivity')->get_value();
    }

    public function set_pathway($value)
    {
        $property = new \Orm_Property_Textarea('pathway', $value);
        $property->set_description('25.5. Pathway comparability* – The assessment plan includes a variety of [assessments that will allow comparison and establishment of educational parity of alternative program pathways to degree completion, including geographically dispersed campuses and online or distance learning-based programs.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_pathway()
    {
        return $this->get_property('pathway')->get_value();
    }

    public function set_interprofessional_preparedness($value)
    {
        $property = new \Orm_Property_Textarea('interprofessional_preparedness', $value);
        $property->set_description('25.6. Interprofessional preparedness – The college or school assesses the preparedness of all students to function effectively and professionally on an interprofessional healthcare team.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_interprofessional_preparedness()
    {
        return $this->get_property('interprofessional_preparedness')->get_value();
    }

    public function set_clinical_reasoning($value)
    {
        $property = new \Orm_Property_Textarea('clinical_reasoning', $value);
        $property->set_description('25.7. Clinical reasoning skills – Evidence-based clinical reasoning skills, the ability to apply these skills across the patient’s lifespan, and the retention of knowledge that underpins these skills, are regularly assessed throughout the curriculum.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_clinical_reasoning()
    {
        return $this->get_property('clinical_reasoning')->get_value();
    }

    public function set_appe_preparedness($value)
    {
        $property = new \Orm_Property_Textarea('appe_preparedness', $value);
        $property->set_description('25.8. APPE preparedness – The Pre-APPE curriculum leads to a defined level of competence in professional knowledge, knowledge application, patient and population-based care, medication therapy management skills, and the attitudes important to success in the advanced experiential program. Competence in these areas is assessed prior to the first APPE.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_appe_preparedness()
    {
        return $this->get_property('appe_preparedness')->get_value();
    }

    public function set_admission_criteria($value)
    {
        $property = new \Orm_Property_Textarea('admission_criteria', $value);
        $property->set_description('25.9. Admission criteria – The college or school regularly assesses the criteria, policies, and procedures to ensure the selection of a qualified and diverse student body, members of which have the potential for academic success and the ability to practice in team-centered and culturally diverse environments.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_admission_criteria()
    {
        return $this->get_property('admission_criteria')->get_value();
    }

}
