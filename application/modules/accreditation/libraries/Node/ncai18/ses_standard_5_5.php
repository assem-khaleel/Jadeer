<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_5_5
 *
 * @author user
 */
class Ses_Standard_5_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.5 Medical and Counselling Services';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_5_5_1('');
            $this->set_5_5_2('');
            $this->set_5_5_3('');
            $this->set_5_5_4('');
            $this->set_5_5_5('');
            $this->set_5_5_6('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Medical and counselling services appropriate for the needs of the student population must be provided by individuals fully qualified for their responsibilities, with confidentiality maintained and effective follow up processes used for students in need.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_5_5_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_5_1', $value);
        $property->set_description('5.5.1 Student medical services are staffed by people with the necessary professional qualifications.');
        $this->set_property($property);
    }

    public function get_5_5_1()
    {
        return $this->get_property('5_5_1')->get_value();
    }

    public function set_5_5_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_5_2', $value);
        $property->set_description('5.5.2 Medical services are readily accessible with provision made for emergency assistance when required. (Fees for services may be charged and they may be provided on a part time basis but emergency access must still be available)');
        $this->set_property($property);
    }

    public function get_5_5_2()
    {
        return $this->get_property('5_5_2')->get_value();
    }

    public function set_5_5_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_5_3', $value);
        $property->set_description('5.5.3 Provision is made for academic counselling and for career planning and employment advice in colleges, departments or other appropriate locations within the institution.');
        $this->set_property($property);
    }

    public function get_5_5_3()
    {
        return $this->get_property('5_5_3')->get_value();
    }

    public function set_5_5_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_5_4', $value);
        $property->set_description('5.5.4 Personal or psychological counselling services are made available with easy access for students from any part of the institution.');
        $this->set_property($property);
    }

    public function get_5_5_4()
    {
        return $this->get_property('5_5_4')->get_value();
    }

    public function set_5_5_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_5_5', $value);
        $property->set_description('5.5.5 Adequate protection is provided, and supported by regulation or a code of conduct, to protect the confidentiality of personal issues discussed with teaching or other staff or students.');
        $this->set_property($property);
    }

    public function get_5_5_5()
    {
        return $this->get_property('5_5_5')->get_value();
    }

    public function set_5_5_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_5_6', $value);
        $property->set_description('5.5.6 Effective mechanisms are established for follow up to ensure student welfare and to evaluate quality of service.');
        $this->set_property($property);
    }

    public function get_5_5_6()
    {
        return $this->get_property('5_5_6')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('5_5_1');
        $property->add_property_name('5_5_2');
        $property->add_property_name('5_5_3');
        $property->add_property_name('5_5_4');
        $property->add_property_name('5_5_5');
        $property->add_property_name('5_5_6');
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
