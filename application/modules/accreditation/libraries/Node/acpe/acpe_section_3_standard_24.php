<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_3_standard_24
 *
 * @author ahmadgx
 */
class Acpe_Section_3_Standard_24 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 24: Assessment Elements for Section I: Educational Outcomes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_key('');
            $this->set_formative_assessment('');
            $this->set_standardized_assessments('');
            $this->set_student_readiness('');
            $this->set_student_achievement('');
            $this->set_continuous_improvement('');
    }

    public function set_college()
    {
        $property = new \Orm_Property_Fixedtext('college', 'The college or school develops, resources, and implements a plan to assess attainment of educational outcomes to ensure that graduates are prepared to enter practice.');
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

    public function set_formative_assessment($value)
    {
        $property = new \Orm_Property_Textarea('formative_assessment', $value);
        $property->set_description('24.1. Formative and summative assessment – The assessment plan incorporates systematic, valid, and reliable knowledge-based and performance-based formative and summative assessments.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_formative_assessment()
    {
        return $this->get_property('formative_assessment')->get_value();
    }

    public function set_standardized_assessments($value)
    {
        $property = new \Orm_Property_Textarea('standardized_assessments', $value);
        $property->set_description('24.2. Standardized and comparative assessments – The assessment plan includes standardized assessments as required by ACPE (see Appendix 3) that allow for national comparisons and college- or school-determined peer comparisons');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_standardized_assessments()
    {
        return $this->get_property('standardized_assessments')->get_value();
    }

    public function set_student_readiness()
    {
        $property = new \Orm_Property_Fixedtext('student_readiness', '<b>24.3. Student achievement and readiness – The assessment plan measures student achievement at defined levels of the professional competencies that support attainment of the Educational Outcomes in aggregate and at the individual student level. In addition to college/school desired assessments, the plan includes an assessment of student readiness to:'
            . '<ul><li>Enter advanced pharmacy practice experiences</li>'
            . '<li>Provide direct patient care in a variety of healthcare settings</li>'
            . '<li>Contribute as a member of an interprofessional collaborative patient care team</li></ul></b>');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_student_readiness()
    {
        return $this->get_property('student_readiness')->get_value();
    }

    public function set_student_achievement($value)
    {
        $property = new \Orm_Property_Textarea('student_achievement', $value);
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_student_achievement()
    {
        return $this->get_property('student_achievement')->get_value();
    }

    public function set_continuous_improvement($value)
    {
        $property = new \Orm_Property_Textarea('continuous_improvement', $value);
        $property->set_description('24.4. Continuous improvement – The college or school uses the analysis of assessment measures to improve student learning and the level of achievement of the Educational Outcomes.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_continuous_improvement()
    {
        return $this->get_property('continuous_improvement')->get_value();
    }

}
