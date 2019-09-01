<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_9_1
 *
 * @author user
 */
class Ses_Standard_9_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '9.1 Policy and Administration';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_9_1_1('');
            $this->set_9_1_2('');
            $this->set_9_1_3('');
            $this->set_9_1_4('');
            $this->set_9_1_5('');
            $this->set_9_1_6('');
            $this->set_9_1_7('');
            $this->set_9_1_8('');
            $this->set_9_1_9('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The institution must have clearly defined staffing and employment policies. The policies should include a desired staffing profile (eg. numbers, qualification levels, areas of specialization, experience requirements etc.) and other matters including employment and promotion policies and procedures, workloads, performance evaluations, professional development, delegations of responsibilities and procedures for reporting on performance in relation to these matters.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_9_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_1', $value);
        $property->set_description('9.1.1 A desired staffing profile appropriate to the mission and nature of the institution is approved by the governing body. (The profile includes matters such as age structure, gender balance where relevant, classification levels, qualifications, cultural mix and educational background, and objectives for Saudization.)');
        $this->set_property($property);
    }

    public function get_9_1_1()
    {
        return $this->get_property('9_1_1')->get_value();
    }

    public function set_9_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_2', $value);
        $property->set_description('9.1.2 A comparison of current teaching and other staff provision with the desired staffing profile is maintained and progress towards that profile is monitored on a continuing basis.');
        $this->set_property($property);
    }

    public function get_9_1_2()
    {
        return $this->get_property('9_1_2')->get_value();
    }

    public function set_9_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_3', $value);
        $property->set_description('9.1.3 A comprehensive set of policies and regulations is established and made widely available in an employment handbook or manual. (This should include rights and responsibilities of faculty and staff, recruitment processes, supervision, performance evaluation, promotion, counseling and support processes, professional development, and complaints, discipline and appeal procedures.)');
        $this->set_property($property);
    }

    public function get_9_1_3()
    {
        return $this->get_property('9_1_3')->get_value();
    }

    public function set_9_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_4', $value);
        $property->set_description('9.1.4 Effective strategies are used for succession planning for senior positions.');
        $this->set_property($property);
    }

    public function get_9_1_4()
    {
        return $this->get_property('9_1_4')->get_value();
    }

    public function set_9_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_5', $value);
        $property->set_description('9.1.5 Teaching loads are established equitably across the institution, taking account of the nature of teaching requirements in different fields of study');
        $this->set_property($property);
    }

    public function get_9_1_5()
    {
        return $this->get_property('9_1_5')->get_value();
    }

    public function set_9_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_6', $value);
        $property->set_description('9.1.6 Promotion policies and processes are clearly documented and fair.');
        $this->set_property($property);
    }

    public function get_9_1_6()
    {
        return $this->get_property('9_1_6')->get_value();
    }

    public function set_9_1_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_7', $value);
        $property->set_description('9.1.7 The exercise of delegations relating to employment processes is monitored and coordinated to ensure equitable treatment across the institution. (These delegations may relate to matters such as junior appointments, promotions, rewards for outstanding performance, and professional development opportunities.)');
        $this->set_property($property);
    }

    public function get_9_1_7()
    {
        return $this->get_property('9_1_7')->get_value();
    }

    public function set_9_1_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_8', $value);
        $property->set_description('9.1.8 Indicators of successful administration of staffing and employment policies are clearly specified and performance compared with successful practice elsewhere.');
        $this->set_property($property);
    }

    public function get_9_1_8()
    {
        return $this->get_property('9_1_8')->get_value();
    }

    public function set_9_1_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_1_9', $value);
        $property->set_description('9.1.9 The governing board studies annual reports from the person with overall responsibility for employment practices on implementation of policies on staffing and employment practices.');
        $this->set_property($property);
    }

    public function get_9_1_9()
    {
        return $this->get_property('9_1_9')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('9_1_1');
        $property->add_property_name('9_1_2');
        $property->add_property_name('9_1_3');
        $property->add_property_name('9_1_4');
        $property->add_property_name('9_1_5');
        $property->add_property_name('9_1_6');
        $property->add_property_name('9_1_7');
        $property->add_property_name('9_1_8');
        $property->add_property_name('9_1_9');
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
