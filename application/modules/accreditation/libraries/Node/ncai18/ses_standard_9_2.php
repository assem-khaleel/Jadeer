<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_9_2
 *
 * @author user
 */
class Ses_Standard_9_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '9.2 Recruitment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_9_2_1('');
            $this->set_9_2_2('');
            $this->set_9_2_3('');
            $this->set_9_2_4('');
            $this->set_9_2_5('');
            $this->set_9_2_6('');
            $this->set_9_2_7('');
            $this->set_9_2_8('');
            $this->set_9_2_9('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Recruitment processes must be designed to ensure that capable and appropriately qualified teaching and other staff are available for all teaching and administrative functions, administered fairly, and that new faculty and staff are thoroughly prepared for their responsibilities.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_9_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_1', $value);
        $property->set_description('9.2.1 Recruitment processes are managed to ensure that teaching staff have the specific areas of expertise, and the personal qualities, experience and skill to meet teaching requirements.');
        $this->set_property($property);
    }

    public function get_9_2_1()
    {
        return $this->get_property('9_2_1')->get_value();
    }

    public function set_9_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_2', $value);
        $property->set_description('9.2.2 When appointments are to be made through promotion or transfer within the institution rather than by external appointment, the appointments made meet qualifications and skill requirements, and contribute to achievement of the desired staffing profile.');
        $this->set_property($property);
    }

    public function get_9_2_2()
    {
        return $this->get_property('9_2_2')->get_value();
    }

    public function set_9_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_3', $value);
        $property->set_description('9.2.3 If a particular appointment can be made either from within or from outside the institution the position is publicly advertised, internal candidates are given adequate opportunity to apply, and judgments made are equitable considering the applicants experience, qualifications, and current levels of performance.');
        $this->set_property($property);
    }

    public function get_9_2_3()
    {
        return $this->get_property('9_2_3')->get_value();
    }

    public function set_9_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_4', $value);
        $property->set_description('9.2.4 Candidates for employment are provided with full position descriptions and conditions of employment, together with general information about the institution and its mission and programs. (The information provided should include details of employment expectations, indicators of performance, and processes of performance evaluation.)');
        $this->set_property($property);
    }

    public function get_9_2_4()
    {
        return $this->get_property('9_2_4')->get_value();
    }

    public function set_9_2_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_5', $value);
        $property->set_description('9.2.5 References are checked, and claims of experience and qualifications verified before appointments are made.');
        $this->set_property($property);
    }

    public function get_9_2_5()
    {
        return $this->get_property('9_2_5')->get_value();
    }

    public function set_9_2_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_6', $value);
        $property->set_description('9.2.6 Assessment of qualifications includes verification of the standing and reputation of the institutions from which they were obtained, taking account of recognition of qualifications by the Ministry of Higher Education.');
        $this->set_property($property);
    }

    public function get_9_2_6()
    {
        return $this->get_property('9_2_6')->get_value();
    }

    public function set_9_2_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_7', $value);
        $property->set_description('9.2.7 In professional programs there are sufficient teaching staff with successful experience in the relevant profession to provide practical advice and guidance to students about work place requirements.');
        $this->set_property($property);
    }

    public function get_9_2_7()
    {
        return $this->get_property('9_2_7')->get_value();
    }

    public function set_9_2_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_8', $value);
        $property->set_description('9.2.8 New teaching staff are given an effective orientation to ensure familiarity with the institution and its services, programs, and student development strategies, and institutional priorities for development.');
        $this->set_property($property);
    }

    public function get_9_2_8()
    {
        return $this->get_property('9_2_8')->get_value();
    }

    public function set_9_2_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('9_2_9', $value);
        $property->set_description('9.2.9 The level of provision of teaching staff in all programs (ie the ratio of students per teaching staff member calculated as full time equivalents) is adequate for the programs offered and benchmarked against comparable student/teaching staff ratios at good quality Saudi Arabian and international institutions.');
        $this->set_property($property);
    }

    public function get_9_2_9()
    {
        return $this->get_property('9_2_9')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('9_2_1');
        $property->add_property_name('9_2_2');
        $property->add_property_name('9_2_3');
        $property->add_property_name('9_2_4');
        $property->add_property_name('9_2_5');
        $property->add_property_name('9_2_6');
        $property->add_property_name('9_2_7');
        $property->add_property_name('9_2_8');
        $property->add_property_name('9_2_9');
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
