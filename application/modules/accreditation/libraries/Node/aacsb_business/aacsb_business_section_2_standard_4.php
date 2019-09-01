<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_4
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 4';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_policies_and_process('');
            $this->set_characteristics('');
            $this->set_evidence('');
            $this->set_effectiveness('');
            $this->set_career_development('');
            $this->set_school_performance('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>Policies and procedures for student admissions, as well as those that ensure academic progression toward degree completion, and supporting career development are clear, effective, consistently applied, and aligned with the school's mission, expected outcomes, and strategies. [STUDENT ADMISSIONS, PROGRESSION, AND CAREER DEVELOPMENT]</b>");
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Basis for Judgment</strong>'
            . '<ul>'
            . '<li>Policies and procedures related to student admissions to degree programs are clear, effective, and transparent to all participants in the process and are consistent with the mission, expected outcomes, and supporting strategies of the school.</li>'
            . '<li>Normally, graduate business degree program admission criteria should include, among other requirements, the expectation that applicants have or will earn a bachelor’s degree prior to admission to the graduate program. The school should be prepared to document how exceptions support quality in the graduate business degree program.</li>'
            . '<li>The school prepares and supports students to ensure academic progression towards degree completion, including clear and effective academic performance standards and processes, consistent with degree program learning goals. The school has clearly articulated policies and processes to:'
            . '<ul>'
            . '<li>Prepare students to learn to employ the modalities and pedagogies of degree programs.</li>'
            . '<li>Evaluate student progress.</li>'
            . '<li>Provide early identification of retention and progression issues.</li>'
            . '<li>Intervene with support, where appropriate.</li>'
            . '<li>Separate students from programs, if necessary.</li>'
            . '</ul></li>'
            . '<li>The school provides effective career development support for students and graduates consistent with degree program expectations and the school’s mission, expected outcomes, and strategies.</li>'
            . '<li>In addition to public disclosure information required by national or regional accreditors, or by governmental mandate, schools provide reliable information to the public on their performance, including student achievement as determined by the school, including the number of students enrolled in each degree program and the number of graduates from each degree program on an annual basis.</li>'
            . '</ul><br/><br/>'
            . '<strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_policies_and_process($value)
    {
        $property = new \Orm_Property_Textarea('policies_and_process', $value);
        $property->set_description('Describe admissions policies and processes, demonstrate that they are consistent with program expectations and the mission of the school, and show that they are transparent to all participants.');
        $this->set_property($property);
    }

    public function get_policies_and_process()
    {
        return $this->get_property('policies_and_process')->get_value();
    }

    public function set_characteristics($value)
    {
        $property = new \Orm_Property_Textarea('characteristics', $value);
        $property->set_description('Document and explain how the characteristics of the current student body for each degree program are the result of the application of admission policies and processes that are consistent with the school’s mission and expected outcomes. If exceptions are made, provide justification and basis for quality.');
        $this->set_property($property);
    }

    public function get_characteristics()
    {
        return $this->get_property('characteristics')->get_value();
    }

    public function set_evidence($value)
    {
        $property = new \Orm_Property_Textarea('evidence', $value);
        $property->set_description('Describe and provide evidence that the school’s policies and procedures successfully prepare admitted students to make use of the teaching and learning model(s) employed.');
        $this->set_property($property);
    }

    public function get_evidence()
    {
        return $this->get_property('evidence')->get_value();
    }

    public function set_effectiveness($value)
    {
        $property = new \Orm_Property_Textarea('effectiveness', $value);
        $property->set_description('Document and demonstrate the effectiveness of current policies and procedures to ensure academic progression toward degree completion, including standards for academic performance, as well as to ensure integrity of student participation and appraisal in degree programs. Examples of evidence may include data on the completion rates in degree programs relative to the normal expected time-to-degree expectations, the number of students identified with retention issues, the interventions undertaken, and the number of students separated over the last academic year.');
        $this->set_property($property);
    }

    public function get_effectiveness()
    {
        return $this->get_property('effectiveness')->get_value();
    }

    public function set_career_development($value)
    {
        $property = new \Orm_Property_Textarea('career_development', $value);
        $property->set_description('Document processes and demonstrate the effectiveness of career development support that is consistent with degree program expectations and the mission of the school. Examples of evidence may include job acceptance rates for graduates over the most recent five-year period as well as case examples of successful graduates.');
        $this->set_property($property);
    }

    public function get_career_development()
    {
        return $this->get_property('career_development')->get_value();
    }

    public function set_school_performance($value)
    {
        $property = new \Orm_Property_Textarea('school_performance', $value);
        $property->set_description('Document school performance and student achievement information on an annual basis and document how this information is made available to the public via web sites and other means on an annual basis.');
        $this->set_property($property);
    }

    public function get_school_performance()
    {
        return $this->get_property('school_performance')->get_value();
    }

}
