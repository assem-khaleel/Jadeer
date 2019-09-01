<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_5_2
 *
 * @author ahmadgx
 */
class Ses_Standard_5_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.2 Student Records';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_5_2_1('');
            $this->set_5_2_2('');
            $this->set_5_2_3('');
            $this->set_5_2_4('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Student records must be maintained in a secure and confidential location.  Statistical data needed for quality indicators and internal and external reporting requirements and generation of reports on student progress and achievements must be readily available through automated processes that protect the confidentiality of individual student information.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_5_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_2_1', $value);
        $property->set_description('5.2.1 Automated procedures are in place for monitoring student progress throughout their programs.');
        $this->set_property($property);
    }

    public function get_5_2_1()
    {
        return $this->get_property('5_2_1')->get_value();
    }

    public function set_5_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_2_2', $value);
        $property->set_description('5.2.2 The student record system regularly provides aggregated statistical data required for planning, reporting and quality assurance.');
        $this->set_property($property);
    }

    public function get_5_2_2()
    {
        return $this->get_property('5_2_2')->get_value();
    }

    public function set_5_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_2_3', $value);
        $property->set_description('5.2.3 Clear rules are established and maintained governing privacy of information and controlling access to individual student records.');
        $this->set_property($property);
    }

    public function get_5_2_3()
    {
        return $this->get_property('5_2_3')->get_value();
    }

    public function set_5_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_2_4', $value);
        $property->set_description('5.2.4 Eligibility for graduation is formally verified in relation to program and course requirements.');
        $this->set_property($property);
    }

    public function get_5_2_4()
    {
        return $this->get_property('5_2_4')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('5_2_1');
        $property->add_property_name('5_2_2');
        $property->add_property_name('5_2_3');
        $property->add_property_name('5_2_4');
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
