<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ses_standard_4_11
 *
 * @author user
 */
class Ses_Standard_4_11 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.11 Partnership Arrangements With Other Institutions';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_11_1('');
            $this->set_4_11_2('');
            $this->set_4_11_3('');
            $this->set_4_11_4('');
            $this->set_4_11_5('');
            $this->set_4_11_6('');
            $this->set_4_11_7('');
            $this->set_4_11_8('');
            $this->set_4_11_9('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>In situations in which local institutions deliver programs through cooperative arrangements with another institution the arrangements must be clearly specified, enforceable under Saudi Arabian law and all requirements for programs in the Kingdom of Saudi Arabia must be fully complied with.</strong><br/><br/><strong> Educational programs or courses offered by international organizations including on line or other distance education programs or courses, must not be used unless they have been accredited or otherwise quality assured and approved by the relevant government authorized educational quality assurance agency in the country of origin. Any such programs must be adapted as needed to suit the needs of students in this country, and must meet all Saudi Arabian requirements regardless of where and by whom materials are developed.</strong><br/><br/><strong>If institutions deliver programs using materials developed by another institution, the institution granting the academic award must accept full responsibility for the quality of all aspects of the program including the materials used and the teaching and other services provided</strong><br/><br/><strong> An institution based in another country and delivering programs in Saudi Arabia through a Saudi Arabian agent or local institution, and for which it grants an academic award, must meet all Saudi Arabian requirements for standards of educational provision and for cross border provision of education into the country.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_11_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_11_1', $value);
        $property->set_description('4.11.1 Responsibilities of the local institution and the partner are clearly defined in formal agreements enforceable under the laws of Saudi Arabia.');
        $this->set_property($property);
    }

    public function get_4_11_1()
    {
        return $this->get_property('4_11_1')->get_value();
    }

    public function set_4_11_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_11_2', $value);
        $property->set_description('4.11.2 The effectiveness of the partnership arrangements is regularly evaluated.');
        $this->set_property($property);
    }

    public function get_4_11_2()
    {
        return $this->get_property('4_11_2')->get_value();
    }

    public function set_4_11_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_11_3', $value);
        $property->set_description('4.11.3 Briefings and consultations on course requirements are adequate, with mechanisms available for ongoing consultation on emerging issues.');
        $this->set_property($property);
    }

    public function get_4_11_3()
    {
        return $this->get_property('4_11_3')->get_value();
    }

    public function set_4_11_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_11_4', $value);
        $property->set_description('4.11.4 Teaching staff from the partner institution who are familiar with the content of courses visit regularly for consultation about course details and standards of assessments.');
        $this->set_property($property);
    }

    public function get_4_11_4()
    {
        return $this->get_property('4_11_4')->get_value();
    }

    public function set_4_11_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_11_5', $value);
        $property->set_description('4.11.5 If arrangements involve assessment of student work by the partner in addition to assessments within the institution, final assessments are completed promptly and results made available to students within the time specified for reporting results under Saudi Arabian regulations.');
        $this->set_property($property);
    }

    public function get_4_11_5()
    {
        return $this->get_property('4_11_5')->get_value();
    }

    public function set_4_11_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_11_6', $value);
        $property->set_description('4.11.6 If programs are based on those of partner institutions, courses, assignments and examinations are adapted to the local environment, avoiding colloquial expressions, and using examples and illustrations relevant to the setting where the programs are to be offered.');
        $this->set_property($property);
    }

    public function get_4_11_6()
    {
        return $this->get_property('4_11_6')->get_value();
    }

    public function set_4_11_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_11_7', $value);
        $property->set_description('4.11.7 Programs and courses are consistent with the requirements of the Qualifications Framework for Saudi Arabia, and when relevant include regulations and conventions relevant to the Saudi environment.');
        $this->set_property($property);
    }

    public function get_4_11_7()
    {
        return $this->get_property('4_11_7')->get_value();
    }

    public function set_4_11_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_11_8', $value);
        $property->set_description('4.11.8 If courses or programs developed by a partner institution are delivered in Saudi Arabia adequate processes should be followed to ensure that standards of student achievement are at least equal to those achieved elsewhere by the partner institution as well as by other appropriate institutions selected for benchmarking purposes.');
        $this->set_property($property);
    }

    public function get_4_11_8()
    {
        return $this->get_property('4_11_8')->get_value();
    }

    public function set_4_11_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_11_9', $value);
        $property->set_description('4.11.9 If an international institution or other organization is invited to provide programs, or to assist in the development of programs for use in Saudi Arabia full information should be provided in advance about relevant Ministry regulations and NCAAA requirements for the National Qualifications Framework and requirements for program and course specifications and reports.');
        $this->set_property($property);
    }

    public function get_4_11_9()
    {
        return $this->get_property('4_11_9')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_11_1');
        $property->add_property_name('4_11_2');
        $property->add_property_name('4_11_3');
        $property->add_property_name('4_11_4');
        $property->add_property_name('4_11_5');
        $property->add_property_name('4_11_6');
        $property->add_property_name('4_11_7');
        $property->add_property_name('4_11_8');
        $property->add_property_name('4_11_9');
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
