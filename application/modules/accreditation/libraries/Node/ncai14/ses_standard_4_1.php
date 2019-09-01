<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ses_standard_4_2
 *
 * @author user
 */
class Ses_Standard_4_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.1 Institutional Oversight of Quality of Learning and Teaching';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_1_1('');
            $this->set_4_1_2('');
            $this->set_4_1_3('');
            $this->set_4_1_4('');
            $this->set_4_1_5('');
            $this->set_4_1_6('');
            $this->set_4_1_7('');
            $this->set_4_1_8('');
            $this->set_4_1_9('');
            $this->set_4_1_10('');
            $this->set_4_1_11('');
            $this->set_4_1_12('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The institution must have effective systems for ensuring that high standards of learning and teaching are achieved in all programs offered, and for supporting their improvement. Institutional processes must be in place to monitor and report on the extent to which the requirements included in the standard for learning and teaching are met for all the programs across the institution. Appropriate action must be taken by the institution to deal with problems and support improvements through general institutional strategies or support for initiatives within particular organizational units where they are needed.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_1', $value);
        $property->set_description("4.1.1 New program proposals and proposals for major changes in programs are thoroughly evaluated and approved by the institution's senior academic committee.");
        $this->set_property($property);
    }

    public function get_4_1_1()
    {
        return $this->get_property('4_1_1')->get_value();
    }

    public function set_4_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_2', $value);
        $property->set_description('4.1.2 The evaluation of new programs or major changes in programs by the senior academic committee includes consideration of the matters described in the standard for learning and teaching, including any special requirements applicable to the field of study concerned and requirements for graduates in that field in Saudi Arabia.');
        $this->set_property($property);
    }

    public function get_4_1_2()
    {
        return $this->get_property('4_1_2')->get_value();
    }

    public function set_4_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_3', $value);
        $property->set_description('4.1.3 Guidelines are established defining the levels for reviewing indicators and reports on courses and programs. (for example a head of department might consider course reports for all courses and a departmental committee approve minor changes to keep courses up to date. A dean might consider program reports that include summary information about courses. The vice rector responsible for academic affairs, the quality committee and the senior academic committee might consider a general summary of program reports and data on key performance indicators, and approve more significant changes in programs.) (See also section 2.2.4)');
        $this->set_property($property);
    }

    public function get_4_1_3()
    {
        return $this->get_property('4_1_3')->get_value();
    }

    public function set_4_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_4', $value);
        $property->set_description('4.1.4 Guidelines have been established defining the levels for approval of changes in courses and programs.  Minor changes required to keep programs up to date and respond to course and program evaluations should be made flexibly and rapidly at departmental level and more substantial changes referred to the relevant senior committees for approval.(Note that these approvals for changes in courses and programs  in sections 4.1.3 and 4.1.4 are under delegations from the university council or other responsible authority and are subject to conditions and constraints that may be set by that council or authority.)');
        $this->set_property($property);
    }

    public function get_4_1_4()
    {
        return $this->get_property('4_1_4')->get_value();
    }

    public function set_4_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_5', $value);
        $property->set_description("4.1.5 Data on key performance indicators for all programs are reviewed at least annually by senior administrators responsible for academic affairs, the institution's quality committee and the institution's senior academic committee, with overall institutional performance reported to the governing board.");
        $this->set_property($property);
    }

    public function get_4_1_5()
    {
        return $this->get_property('4_1_5')->get_value();
    }

    public function set_4_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_6', $value);
        $property->set_description('4.1.6 Annual reports are prepared for all programs, and reviewed by department/college committees, with appropriate action taken in response to recommendations in those reports.');
        $this->set_property($property);
    }

    public function get_4_1_6()
    {
        return $this->get_property('4_1_6')->get_value();
    }

    public function set_4_1_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_7', $value);
        $property->set_description('4.1.7 Self evaluations using the self evaluation scales for higher education programs are undertaken periodically (eg. every two or three years) for each program and reports prepared for consideration by the quality committee and the relevant academic committees.');
        $this->set_property($property);
    }

    public function get_4_1_7()
    {
        return $this->get_property('4_1_7')->get_value();
    }

    public function set_4_1_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_8', $value);
        $property->set_description('4.1.8 Reports on the overall quality of teaching and learning for the institution as a whole are prepared periodically (eg. every three years) indicating common strengths and weaknesses, and significant variations in quality between programs/departments and sections.');
        $this->set_property($property);
    }

    public function get_4_1_8()
    {
        return $this->get_property('4_1_8')->get_value();
    }

    public function set_4_1_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_9', $value);
        $property->set_description('4.1.9 Reports by departments to their college, or by departments or colleges to the central administration, are acknowledged with responses made to any queries or proposals made.');
        $this->set_property($property);
    }

    public function get_4_1_9()
    {
        return $this->get_property('4_1_9')->get_value();
    }

    public function set_4_1_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_10', $value);
        $property->set_description('4.1.10 The senior administrator responsible for academic affairs takes responsibility, in cooperation with the quality committee and deans/heads of department, for developing and implementing strategies for improvement to deal with common issues affecting programs across the institution.');
        $this->set_property($property);
    }

    public function get_4_1_10()
    {
        return $this->get_property('4_1_10')->get_value();
    }

    public function set_4_1_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_11', $value);
        $property->set_description('4.1.11 Colleges/departments cooperate with and participate in general institutional strategies for improvement, and arrange complementary further initiatives to deal with quality issues found in their own programs.');
        $this->set_property($property);
    }

    public function get_4_1_11()
    {
        return $this->get_property('4_1_11')->get_value();
    }

    public function set_4_1_12($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_1_12', $value);
        $property->set_description('4.1.12 If programs are offered in different sections, including sections for male and female students, or in branch campuses, the standards of learning outcomes, the resources provided (including learning resources and staffing provisions and resources to undertake research) should be comparable in all sections.  Data used for evaluations and performance indicators should be provided for all sections as well as for the programs in total.');
        $this->set_property($property);
    }

    public function get_4_1_12()
    {
        return $this->get_property('4_1_12')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_1_1');
        $property->add_property_name('4_1_2');
        $property->add_property_name('4_1_3');
        $property->add_property_name('4_1_4');
        $property->add_property_name('4_1_5');
        $property->add_property_name('4_1_6');
        $property->add_property_name('4_1_7');
        $property->add_property_name('4_1_8');
        $property->add_property_name('4_1_9');
        $property->add_property_name('4_1_10');
        $property->add_property_name('4_1_11');
        $property->add_property_name('4_1_12');
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
