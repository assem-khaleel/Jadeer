<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_5_1
 *
 * @author user
 */
class Ses_Standard_5_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.1 Student Admissions';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_5_1_1('');
            $this->set_5_1_2('');
            $this->set_5_1_3('');
            $this->set_5_1_4('');
            $this->set_5_1_5('');
            $this->set_5_1_6('');
            $this->set_5_1_7('');
            $this->set_5_1_8('');
            $this->set_5_1_9('');
            $this->set_5_1_10('');
            $this->set_5_1_11('');
            $this->set_5_1_12('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Student admission processes must be reliable, efficient and simple for students to use.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_5_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_1', $value);
        $property->set_description('5.1.1 The admission and student registration processes are efficient and simple for students to use');
        $this->set_property($property);
    }

    public function get_5_1_1()
    {
        return $this->get_property('5_1_1')->get_value();
    }

    public function set_5_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_2', $value);
        $property->set_description('5.1.2 Computerized systems used for admission processes are linked to data recording and retrieval systems. (For example to fee payment requirements, the issue of student identity cards, program and course registrations, and statistical reporting requirements.)');
        $this->set_property($property);
    }

    public function get_5_1_2()
    {
        return $this->get_property('5_1_2')->get_value();
    }

    public function set_5_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_3', $value);
        $property->set_description('5.1.3 Admission requirements are clearly described, and appropriate for the institution and its programs.');
        $this->set_property($property);
    }

    public function get_5_1_3()
    {
        return $this->get_property('5_1_3')->get_value();
    }

    public function set_5_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_4', $value);
        $property->set_description('5.1.4 Admission requirements are consistently and fairly applied.');
        $this->set_property($property);
    }

    public function get_5_1_4()
    {
        return $this->get_property('5_1_4')->get_value();
    }

    public function set_5_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_5', $value);
        $property->set_description('5.1.5 If programs or courses include components offered by distance education, or use of e-learning in blended programs information is provided before enrolment about any special skills or resources needed to study in these modes. (For distance education programs a separate set of standards that include requirements for that mode of program delivery are set out in a different document, Standards for Quality Assurance and Accreditation of Higher Education Programs Offered by Distance Education.');
        $this->set_property($property);
    }

    public function get_5_1_5()
    {
        return $this->get_property('5_1_5')->get_value();
    }

    public function set_5_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_6', $value);
        $property->set_description('5.1.6 Student fees, if required, are paid at the time of registration unless deferral has been approved in advance.');
        $this->set_property($property);
    }

    public function get_5_1_6()
    {
        return $this->get_property('5_1_6')->get_value();
    }

    public function set_5_1_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_7', $value);
        $property->set_description("5.1.7 If the institution's regulations provide for deferral of payments, the conditions and dates for payment are clearly specified in a formal agreement signed by the student and witnessed, and opportunities for financial counselling provided.");
        $this->set_property($property);
    }

    public function get_5_1_7()
    {
        return $this->get_property('5_1_7')->get_value();
    }

    public function set_5_1_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_8', $value);
        $property->set_description('5.1.8 Student advisors familiar with details of course requirements are available to provide assistance prior to and during the student registration process.');
        $this->set_property($property);
    }

    public function get_5_1_8()
    {
        return $this->get_property('5_1_8')->get_value();
    }

    public function set_5_1_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_9', $value);
        $property->set_description('5.1.9 Rules governing admission with credit for previous studies are clearly specified.');
        $this->set_property($property);
    }

    public function get_5_1_9()
    {
        return $this->get_property('5_1_9')->get_value();
    }

    public function set_5_1_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_10', $value);
        $property->set_description('5.1.10 Decisions on credit for previous studies are made known to students by qualified faculty or authorized staff before classes commence.');
        $this->set_property($property);
    }

    public function get_5_1_10()
    {
        return $this->get_property('5_1_10')->get_value();
    }

    public function set_5_1_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_11', $value);
        $property->set_description('5.1.11 Complete information about the institution, including the range of courses and programs, program requirements, costs, services and other relevant information is publicly available to potential students and families prior to applications for admission.');
        $this->set_property($property);
    }

    public function get_5_1_11()
    {
        return $this->get_property('5_1_11')->get_value();
    }

    public function set_5_1_12($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_1_12', $value);
        $property->set_description('5.1.12 A comprehensive orientation program is available for commencing students to ensure thorough understanding of the range of services and facilities available to them, and of their obligations and responsibilities.');
        $this->set_property($property);
    }

    public function get_5_1_12()
    {
        return $this->get_property('5_1_12')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('5_1_1');
        $property->add_property_name('5_1_2');
        $property->add_property_name('5_1_3');
        $property->add_property_name('5_1_4');
        $property->add_property_name('5_1_5');
        $property->add_property_name('5_1_6');
        $property->add_property_name('5_1_7');
        $property->add_property_name('5_1_8');
        $property->add_property_name('5_1_9');
        $property->add_property_name('5_1_10');
        $property->add_property_name('5_1_11');
        $property->add_property_name('5_1_12');
        $this->set_property($property);
    }

    public function get_overall_assessment()
    {
        return $this->get_property('overall_assessment')->get_value();
    }

    public function set_comment($value)
    {
        $property = new \Orm_Property_Textarea('comment', $value);
        $property->set_description('Comment');
        $this->set_property($property);
    }

    public function get_comment()
    {
        return $this->get_property('comment')->get_value();
    }

    public function set_priorities_for_improvement($value)
    {
        $property = new \Orm_Property_Textarea('priorities_for_improvement', $value);
        $property->set_description('Priorities For Improvement');
        $this->set_property($property);
    }

    public function get_priorities_for_improvement()
    {
        return $this->get_property('priorities_for_improvement')->get_value();
    }

    public function set_independent_opinion($value)
    {
        $property = new \Orm_Property_Rank('independent_opinion', $value);
        $property->set_description('Independent Opinion');
        $this->set_property($property, true);
    }

    public function get_independent_opinion()
    {
        return $this->get_property('independent_opinion')->get_value();
    }

    public function set_independent_opinion_comment($value)
    {
        $property = new \Orm_Property_Textarea('independent_opinion_comment', $value);
        $property->set_description('Comment');
        $this->set_property($property, true);
    }

    public function get_independent_opinion_comment()
    {
        return $this->get_property('independent_opinion_comment')->get_value();
    }

}
