<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_11
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_11 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 11';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_degree_program('');
            $this->set_expectations('');
            $this->set_schools('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', "<b>Degree program structure and design, including the normal time-to-degree, are appropriate to the level of the degree program and ensure achievement of high-quality learning outcomes. Programs resulting in the same degree credential are structured and designed to ensure equivalence. [DEGREE PROGRAM EDUCATIONAL LEVEL, STRUCTURE, AND EQUIVALENCE]</b>");
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Definitions</strong>'
            . '<br/><ul>'
            . '<li>Normal time-to-degree reflects the period of time (years, terms, etc.) that is customary to complete a full-time degree program. Local, provincial, or national norms, as well as the practice of other AACSB-accredited institutions, provide guidance to establish what constitutes normal time-to-degree.</li>'
            . '<li>Teaching/learning models include traditional face-to-face classroom models, distance (online) models, blended models that employ face-to-face and distance (online) components, other forms of technologically enhanced instruction, or any other form of instructional methodology.</li>'
            . '</ul>'
            . '<br/><br/><strong>Basis for Judgment</strong> <br/>'
            . '<ul>'
            . '<li>Degree programs are structured and designed to support the content coverage, rigor, interactions, and engagement that are normally expected at this level of study. Expectations may vary dependent on the educational practices and structures in different world regions and cultures.</li>'
            . '<li>Expectations for student effort for the same degree credentials are equivalent in terms of depth and rigor, regardless of delivery mode or location. The school is responsible for establishing, supporting, and maintaining the quality of learning that students must demonstrate to satisfy degree requirements, regardless of delivery mode or location.</li>'
            . '<li>Normally, the majority of learning in traditional business subjects counted toward degree fulfillment (as determined by credits, contact hours, or other metrics) is earned through the institution awarding the degree.</li>'
            . '<li>The school defines and broadly disseminates its policies for evaluating, awarding, and accepting transfer credits/courses from other institutions. These policies are consistent with its mission, expected outcomes, strategies, and degree programs. These policies should ensure that the academic work accepted from other institutions is comparable to the academic work required for the school’s own degree programs.</li>'
            . '<li>If the school awards a business degree as part of a joint/partnership degree program, the expectation that the majority of business subjects counted toward degree fulfillment is earned at the institution awarding the degree can be met through the agreements supporting the joint/partnership degree program. However, in such joint programmatic efforts, the school must demonstrate that appropriate quality control provisions are included in the cooperative agreements and that these agreements are functioning to ensure high quality and continuous improvement. Such agreements should address and ensure that the joint/partnership programs: demonstrate mission alignment in the content they offer and the students they serve; have student admission criteria that are consistent for all students admitted by all partner institutions; deploy sufficient and qualified faculty at all partner institutions; and implement curricula management processes, including assurance of learning processes, which function for the entire program including components delivered by partner or collaborating institutions. Furthermore, the school should demonstrate appropriate, ongoing oversight and engagement in managing such programs. If such joint degree programs involve partners that do not hold AACSB accreditation, quality and continuous improvement must be demonstrated.</li>'
            . '</ul>'
            . '<br/><strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_degree_program($value)
    {
        $property = new \Orm_Property_Textarea('degree_program', $value);
        $property->set_description('Show that degree program structure and design expectations are appropriate to the level of degree programs, regardless of delivery mode or location.');
        $this->set_property($property);
    }

    public function get_degree_program()
    {
        return $this->get_property('degree_program')->get_value();
    }

    public function set_expectations($value)
    {
        $property = new \Orm_Property_Textarea('expectations', $value);
        $property->set_description('Demonstrate that expectations across educational programs that result in the same degree credentials are equivalent, regardless of delivery mode, location, or time to completion.');
        $this->set_property($property);
    }

    public function get_expectations()
    {
        return $this->get_property('expectations')->get_value();
    }

    public function set_schools($value)
    {
        $property = new \Orm_Property_Textarea('schools', $value);
        $property->set_description('Schools will be expected to describe the amount of effort normally required to complete the degree. The descriptive characteristics will differ by the pedagogical and delivery characteristics of the degree. Traditional, campus-based education may be described by contact hours, credit hours, or course equivalencies. Distance learning programs may require other metrics and may depend more heavily on demonstration of achievement of learning outcomes. The school should assist accreditation reviewers by clarifying the delivery modes and the kinds and extent of student effort involved in degree programs and by demonstrating that the spirit and intent of these standards are met by such programs.');
        $this->set_property($property);
    }

    public function get_schools()
    {
        return $this->get_property('schools')->get_value();
    }

}
