<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_4_10
 *
 * @author ahmadgx
 */
class Ses_Standard_4_10 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.10 Partnership Arrangements With Other Institutions';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();

            $this->set_4_10_1('');
            $this->set_4_10_2('');
            $this->set_4_10_3('');
            $this->set_4_10_4('');
            $this->set_4_10_5('');
            $this->set_4_10_6('');
            $this->set_4_10_7('');
            $this->set_4_10_8('');
            $this->set_4_10_9('');

            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');

            $this->set_note();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>In situations in which local institutions deliver programs through cooperative arrangements with another institution these arrangements must be clearly specified, enforceable under Saudi Arabian law, and all requirements for programs in the Kingdom of Saudi Arabia must be fully complied with. <br/> <br/>'
            . 'Educational programs or courses offered by international organizations including on line or other distance education programs or courses, must not be used unless they have been accredited or otherwise quality assured and approved by the relevant government authorized educational quality assurance agency in the country of origin.   Any such programs must be adapted as needed to suit the needs of students in this country, and must meet all Saudi Arabian requirements regardless of where and by whom materials are developed.  <br/> <br/>'
            . 'If an institution delivers programs using materials developed by another institution, the institution granting the academic award must accept full responsibility for the quality of the program including the materials used and the teaching and other services provided. <br/> <br/>'
            . 'An institution based in another country and delivering programs in Saudi Arabia through a Saudi Arabian agent or local institution, and for which it grants an academic award, must meet all Saudi Arabian requirements for standards of educational provision and for cross border provision of education into the country.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_10_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_1', $value);
        $property->set_description('4.10.1 Responsibilities of the local institution and the partner are clearly defined in formal agreements enforceable under the laws of Saudi Arabia.');
        $this->set_property($property);
    }

    public function get_4_10_1()
    {
        return $this->get_property('4_10_1')->get_value();
    }

    public function set_4_10_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_2', $value);
        $property->set_description('4.10.2 The effectiveness of the arrangements is regularly evaluated.');
        $this->set_property($property);
    }

    public function get_4_10_2()
    {
        return $this->get_property('4_10_2')->get_value();
    }

    public function set_4_10_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_3', $value);
        $property->set_description('4.10.3 Briefings and consultations on course requirements are adequate, with mechanisms available for ongoing consultation on emerging issues.');
        $this->set_property($property);
    }

    public function get_4_10_3()
    {
        return $this->get_property('4_10_3')->get_value();
    }

    public function set_4_10_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_4', $value);
        $property->set_description('4.10.4 Teaching staff who are familiar with the content of courses visit regularly for consultation about course details and standards of assessments.');
        $this->set_property($property);
    }

    public function get_4_10_4()
    {
        return $this->get_property('4_10_4')->get_value();
    }

    public function set_4_10_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_5', $value);
        $property->set_description('4.10.5 If arrangements involve assessment of student work by the partner in addition to assessments within the institution, final assessments are completed promptly and results made available to students within the time specified for reporting of student results under Saudi Arabian regulations.');
        $this->set_property($property);
    }

    public function get_4_10_5()
    {
        return $this->get_property('4_10_5')->get_value();
    }

    public function set_4_10_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_6', $value);
        $property->set_description('4.10.6 If programs are based on those of partner institutions, courses, assignments and examinations are adapted to the local environment, avoiding colloquial expressions, and using examples and illustrations relevant to the setting where the programs are to be offered.');
        $this->set_property($property);
    }

    public function get_4_10_6()
    {
        return $this->get_property('4_10_6')->get_value();
    }

    public function set_4_10_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_7', $value);
        $property->set_description('4.10.7 Programs and courses are consistent with the requirements of the Qualifications Framework for Saudi Arabia, and in professional programs, include regulations and conventions relevant to the Saudi environment.');
        $this->set_property($property);
    }

    public function get_4_10_7()
    {
        return $this->get_property('4_10_7')->get_value();
    }

    public function set_4_10_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_8', $value);
        $property->set_description('4.10.8 If courses or a programs developed by a partner institution are delivered in Saudi Arabia adequate processes are followed to ensure that standards of student achievement are at least equal  to those achieved elsewhere by the partner institution as well as by other appropriate institutions selected for benchmarking purposes');
        $this->set_property($property);
    }

    public function get_4_10_8()
    {
        return $this->get_property('4_10_8')->get_value();
    }

    public function set_4_10_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_9', $value);
        $property->set_description('4.10.9 If an international institution or other organization is invited to provide programs, or to assist in the development of programs for use in Saudi Arabia full information is provided in advance about relevant Ministry regulations and NCAAA requirements for the National Qualifications Framework and requirements for program and course specifications and reports.');
        $this->set_property($property);
    }

    public function get_4_10_9()
    {
        return $this->get_property('4_10_9')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_10_1');
        $property->add_property_name('4_10_2');
        $property->add_property_name('4_10_3');
        $property->add_property_name('4_10_4');
        $property->add_property_name('4_10_5');
        $property->add_property_name('4_10_6');
        $property->add_property_name('4_10_7');
        $property->add_property_name('4_10_8');
        $property->add_property_name('4_10_9');
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

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', '<strong>Special Note</strong> <br/> <br/>'
            . 'Programs offered with the same title in different parts of an institution, for example in male and female sections, on a central and a branch campus, by daytime, evening or parallel classes, or by face to face or distance education, delivery will normally be considered as the same program and must be considered together in the self study and external review. The Commission MAY consider treating them as separate programs in exceptional circumstances but this will require special approval in advance, and normally a difference in the title of the award to make it clear that they are intended to be different programs. <br/> <br/>'
            . 'If  programs are offered in different parts of the institution the self study will have to show clearly any differences between the sections concerned and strategies to respond to any differences in quality found. <br/> <br/>'
            . 'Requirements for distance education programs have been recommended by the National Center for ELearning and Distance Education and approved by the Higher Council of Education. The NCAAA has also specified requirements for the accreditation of programs offered by distance education. <br/> <br/>'
            . 'Under the Higher Education Council requirements students can no longer be admitted to .distance education programs that do not meet these requirements, and older style distance education programs that do not meet the new requirements must be phased out before September 2015. <br/> <br/>'
            . 'If a program is offered by distance education it must meet both the Higher Council regulations and the standards for higher education programs offered by distance education. <br/> <br/>'
            . 'A program offered by distance education must have been formally approved for delivery in that mode by the institutions senior academic committee after considering it in relation to the required standards. This must be done whether the program is considered as the same program as one delivered face to face, or as a different program. <br/> <br/>'
            . 'If a program is offered by distance education as well as by face to face instruction the distance education arrangements must meet both the requirements of the Ministry of Higher Education and the distance education standards of the NCAAA, and the on campus arrangements must meet the general requirements for higher education programs. However a period of transition is allowed to give a reasonable amount of time for processes used for those programs to be modified. <br/> <br/>'
            . 'The following arrangements will apply: <br/> <br/>'
            . 'To be eligible for consideration for accreditation the NCAAA’s self evaluation scales for distance education programs must have been completed for the distance education program(s) and a strategic plan prepared for transition to meet both the Higher Council regulations and the NCAAA distance education programs before September 2015.');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

}
