<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_b_standard13
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_B_Standard13 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 13: Advanced Pharmacy Practice Experience (APPE) Curriculum';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_advance_pharmacy('');
            $this->set_key('');
            $this->set_patient_care('');
            $this->set_diverse('');
            $this->set_experiences('');
            $this->set_duration('');
            $this->set_timing('');
            $this->set_required_appe('');
            $this->set_elective_appe('');
            $this->set_restrictions('');
    }

    public function set_advance_pharmacy()
    {
        $property = new \Orm_Property_Fixedtext('advance_pharmacy', 'A continuum of required and elective APPEs is of the scope, intensity, and duration required to support the achievement of the Educational Outcomes articulated in Standards 1–4 and within Appendix 2 to prepare practice-ready graduates. APPEs integrate, apply, reinforce, and advance the knowledge, skills, attitudes, abilities, and behaviors developed in the Pre-APPE curriculum and in co-curricular activities.');
        $this->set_property($property);
    }

    public function get_advance_pharmacy()
    {
        return $this->get_property('advance_pharmacy')->get_value();
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
        $property->set_description('13.1. Patient care emphasis – Collectively, APPEs emphasize continuity of care and incorporate acute, chronic, and wellness-promoting patient-care services in outpatient (community/ambulatory care) and inpatient (hospital/health system) settings.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_patient_care()
    {
        return $this->get_property('patient_care')->get_value();
    }

    public function set_diverse($value)
    {
        $property = new \Orm_Property_Textarea('diverse', $value);
        $property->set_description('13.2. Diverse populations – In the aggregate, APPEs expose students to diverse patient populations as related to age, gender, race/ethnicity, socioeconomic factors (e.g., rural/urban, poverty/affluence), and disease states)');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_diverse()
    {
        return $this->get_property('diverse')->get_value();
    }

    public function set_experiences($value)
    {
        $property = new \Orm_Property_Textarea('experiences', $value);
        $property->set_description('13.3. Interprofessional experiences – In the aggregate, students gain in-depth experience in delivering direct patient care as part of an interprofessional team.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_experiences()
    {
        return $this->get_property('experiences')->get_value();
    }

    public function set_duration($value)
    {
        $property = new \Orm_Property_Textarea('duration', $value);
        $property->set_description('13.4. APPE duration – The curriculum includes no less than 36 weeks (1440 hours) of APPE. All students are exposed to a minimum of 160 hours in each required APPE area. The majority of APPE is focused on direct patient care.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_duration()
    {
        return $this->get_property('duration')->get_value();
    }

    public function set_timing($value)
    {
        $property = new \Orm_Property_Textarea('timing', $value);
        $property->set_description('13.5. Timing – APPEs follow successful completion of all IPPE and required didactic curricular content. Required capstone courses or activities that provide opportunity for additional professional growth and insight are allowed during or after completion of APPEs. These activities do not compromise the quality of the APPEs, nor count toward the required 1440 hours of APPE.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_timing()
    {
        return $this->get_property('timing')->get_value();
    }

    public function set_required_appe($value)
    {
        $property = new \Orm_Property_Textarea('required_appe', $value);
        $property->set_description('13.6. Required APPE – Required APPEs occur in four practice settings: (1) community pharmacy; (2) ambulatory patient care; (3) hospital/health system pharmacy; and (4) inpatient general medicine patient care.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_required_appe()
    {
        return $this->get_property('required_appe')->get_value();
    }

    public function set_elective_appe($value)
    {
        $property = new \Orm_Property_Textarea('elective_appe', $value);
        $property->set_description('13.7. Elective APPE – Elective APPEs are structured to give students the opportunity to: (1) mature professionally, (2) secure the breadth and depth of experiences needed to achieve the Educational Outcomes articulated in Standards 1–4, and (3) explore various sectors of practice.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_elective_appe()
    {
        return $this->get_property('elective_appe')->get_value();
    }

    public function set_restrictions($value)
    {
        $property = new \Orm_Property_Textarea('restrictions', $value);
        $property->set_description('13.8. Geographic restrictions – Required APPEs are completed in the United States or its territories or possessions. All quality assurance expectations for U.S.-based experiential education courses apply to elective APPEs offered outside of the U.S.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_restrictions()
    {
        return $this->get_property('restrictions')->get_value();
    }

}
