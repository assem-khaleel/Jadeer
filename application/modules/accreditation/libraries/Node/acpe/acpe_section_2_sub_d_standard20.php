<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_d_standard20
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_D_Standard20 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standards 20: Preceptors';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_key('');
            $this->set_preceptor_criteria('');
            $this->set_student_ratio('');
            $this->set_preceptor_education('');
            $this->set_preceptor_engagement('');
            $this->set_educational_administration('');
    }

    public function set_college()
    {
        $property = new \Orm_Property_Fixedtext('college', 'The college or school has a sufficient number of preceptors (practice faculty or external practitioners) to effectively deliver and evaluate students in the experiential component of the curriculum. Preceptors have professional credentials and expertise commensurate with their responsibilities to the professional program.');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
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

    public function set_preceptor_criteria($value)
    {
        $property = new \Orm_Property_Textarea('preceptor_criteria', $value);
        $property->set_description('20.1. Preceptor criteria – The college or school makes available and applies quality criteria for preceptor recruitment, orientation, performance, and evaluation. The majority of preceptors for any given student are U.S. licensed pharmacists.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_preceptor_criteria()
    {
        return $this->get_property('preceptor_criteria')->get_value();
    }

    public function set_student_ratio($value)
    {
        $property = new \Orm_Property_Text('student_ratio', $value);
        $property->set_description('20.2. Student-to-preceptor ratio – Student to precepting pharmacist ratios allow for the individualized mentoring and targeted professional development of learners.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_student_ratio()
    {
        return $this->get_property('student_ratio')->get_value();
    }

    public function set_preceptor_education($value)
    {
        $property = new \Orm_Property_Textarea('preceptor_education', $value);
        $property->set_description('20.3. Preceptor education and development – Preceptors are oriented to the program’s mission, the specific learning expectations for the experience outlined in the syllabus, and effective performance evaluation techniques before accepting students. The college or school fosters the professional development of its preceptors commensurate with their educational responsibilities to the program.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_preceptor_education()
    {
        return $this->get_property('preceptor_education')->get_value();
    }

    public function set_preceptor_engagement($value)
    {
        $property = new \Orm_Property_Textarea('preceptor_engagement', $value);
        $property->set_description('20.4. Preceptor engagement – The college or school solicits the active involvement of preceptors in the continuous quality improvement of the educational program, especially the experiential component.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_preceptor_engagement()
    {
        return $this->get_property('preceptor_engagement')->get_value();
    }

    public function set_educational_administration($value)
    {
        $property = new \Orm_Property_Textarea('educational_administration', $value);
        $property->set_description('20.5. Experiential education administration – The experiential education component of the curriculum is led by a pharmacy professional with knowledge and experience in experiential learning. The experiential education program is supported by an appropriate number of qualified faculty and staff.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_educational_administration()
    {
        return $this->get_property('educational_administration')->get_value();
    }

}
