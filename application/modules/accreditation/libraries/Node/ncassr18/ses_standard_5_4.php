<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_5_4
 *
 * @author ahmadgx
 */
class Ses_Standard_5_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.4 Student Advising and Counseling Services';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_5_4_1('');
            $this->set_5_4_2('');
            $this->set_5_4_3('');
            $this->set_5_4_4('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong> Adequate provision must be made for academic advising and counselling services to assist students in planning their participation in the program and in seeking subsequent employment.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_5_4_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_4_1', $value);
        $property->set_description('5.4.1 Provision is made for academic counselling and for career planning and employment advice within the college, department or another appropriate location within the institution.');
        $this->set_property($property);
    }

    public function get_5_4_1()
    {
        return $this->get_property('5_4_1')->get_value();
    }

    public function set_5_4_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_4_2', $value);
        $property->set_description('5.4.2 Adequate protection is provided, and supported by regulations or a codes of conduct, to protect the confidentiality of academic or personal issues discussed with teaching or other staff or students');
        $this->set_property($property);
    }

    public function get_5_4_2()
    {
        return $this->get_property('5_4_2')->get_value();
    }

    public function set_5_4_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_4_3', $value);
        $property->set_description('5.4.3 Effective mechanisms are established for follow up to ensure student welfare and to evaluate quality of service.');
        $this->set_property($property);
    }

    public function get_5_4_3()
    {
        return $this->get_property('5_4_3')->get_value();
    }

    public function set_5_4_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_4_4', $value);
        $property->set_description('5.4.4 An effective student support system is available to identify students in difficulty and provide help with personal, study related, financial, family, psychological or health problems.');
        $this->set_property($property);
    }

    public function get_5_4_4()
    {
        return $this->get_property('5_4_4')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('5_4_1');
        $property->add_property_name('5_4_2');
        $property->add_property_name('5_4_3');
        $property->add_property_name('5_4_4');
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
