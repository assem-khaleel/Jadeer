<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_7_2
 *
 * @author ahmadgx
 */
class Ses_Standard_7_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '7.2 Quality and Adequacy of Facilities and Equipment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_7_2_1('');
            $this->set_7_2_2('');
            $this->set_7_2_3('');
            $this->set_7_2_4('');
            $this->set_7_2_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Facilities and equipment must be of good quality with effective strategies used to evaluate their adequacy for the program, their quality and the services associated with them.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_7_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_2_1', $value);
        $property->set_description('7.2 1 Facilities meet health and safety requirements and make adequate provision for the personal security of faculty, staff and students.');
        $this->set_property($property);
    }

    public function get_7_2_1()
    {
        return $this->get_property('7_2_1')->get_value();
    }

    public function set_7_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_2_2', $value);
        $property->set_description('7.2.2 Quality assessment processes include both feedback from principal users about the adequacy and quality of facilities, and mechanisms for considering and responding to their views.');
        $this->set_property($property);
    }

    public function get_7_2_2()
    {
        return $this->get_property('7_2_2')->get_value();
    }

    public function set_7_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_2_3', $value);
        $property->set_description('7.2.3 Standards of provision of teaching, laboratory and research facilities are adequate for the needs of the program and benchmarked through comparisons with other comparable institutions. (This includes such things as classroom space, laboratory facilities and equipment, access to computing facilities and associated software, private study facilities, and research equipment.)');
        $this->set_property($property);
    }

    public function get_7_2_3()
    {
        return $this->get_property('7_2_3')->get_value();
    }

    public function set_7_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_2_4', $value);
        $property->set_description('7.2.4 Adequate facilities are available for confidential consultations between faculty and students');
        $this->set_property($property);
    }

    public function get_7_2_4()
    {
        return $this->get_property('7_2_4')->get_value();
    }

    public function set_7_2_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_2_5', $value);
        $property->set_description('7.2.5 Provision is made for students, faculty and staff with physical disabilities or other special needs.');
        $this->set_property($property);
    }

    public function get_7_2_5()
    {
        return $this->get_property('7_2_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('7_2_1');
        $property->add_property_name('7_2_2');
        $property->add_property_name('7_2_3');
        $property->add_property_name('7_2_4');
        $property->add_property_name('7_2_5');
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
