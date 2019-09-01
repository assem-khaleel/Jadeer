<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_7_5
 *
 * @author user
 */
class Ses_Standard_7_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '7.5 Student Residences';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_7_5_1('');
            $this->set_7_5_2('');
            $this->set_7_5_3('');
            $this->set_7_5_4('');
            $this->set_7_5_5('');
            $this->set_7_5_6('');
            $this->set_7_5_7('');
            $this->set_7_5_8('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>If student residential accommodation is provided it should be a healthy and secure environment with all the facilities and services necessary for students studying at the institution.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_7_5_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_5_1', $value);
        $property->set_description('7.5.1 Residences are of appropriate standard, providing a healthy, safe and secure environment for students.');
        $this->set_property($property);
    }

    public function get_7_5_1()
    {
        return $this->get_property('7_5_1')->get_value();
    }

    public function set_7_5_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_5_2', $value);
        $property->set_description('7.5.2 Adequate facilities are available for privacy and individual study.');
        $this->set_property($property);
    }

    public function get_7_5_2()
    {
        return $this->get_property('7_5_2')->get_value();
    }

    public function set_7_5_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_5_3', $value);
        $property->set_description('7.5.3 Facilities that are adequate and appropriate for the students attending the institution are provided for social and cultural and physical activities.');
        $this->set_property($property);
    }

    public function get_7_5_3()
    {
        return $this->get_property('7_5_3')->get_value();
    }

    public function set_7_5_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_5_4', $value);
        $property->set_description('7.5.4 Clearly defined codes of behaviour for student residences are established and formally agreed to by students.');
        $this->set_property($property);
    }

    public function get_7_5_4()
    {
        return $this->get_property('7_5_4')->get_value();
    }

    public function set_7_5_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_5_5', $value);
        $property->set_description('7.5.5 The residences are effectively supervised by staff with the experience, expertise and authority to manage the facility as a secure and supportive learning environment.');
        $this->set_property($property);
    }

    public function get_7_5_5()
    {
        return $this->get_property('7_5_5')->get_value();
    }

    public function set_7_5_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_5_6', $value);
        $property->set_description('7.5.6 Adequate food, service, and medical facilities are available or readily accessible.');
        $this->set_property($property);
    }

    public function get_7_5_6()
    {
        return $this->get_property('7_5_6')->get_value();
    }

    public function set_7_5_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_5_7', $value);
        $property->set_description('7.5.7 Adequate and appropriate religious facilities are provided and maintained.');
        $this->set_property($property);
    }

    public function get_7_5_7()
    {
        return $this->get_property('7_5_7')->get_value();
    }

    public function set_7_5_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_5_8', $value);
        $property->set_description('7.5.8 The residences are close to the campus or adequate transport facilities are provided to ensure easy access');
        $this->set_property($property);
    }

    public function get_7_5_8()
    {
        return $this->get_property('7_5_8')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('7_5_1');
        $property->add_property_name('7_5_2');
        $property->add_property_name('7_5_3');
        $property->add_property_name('7_5_4');
        $property->add_property_name('7_5_5');
        $property->add_property_name('7_5_6');
        $property->add_property_name('7_5_7');
        $property->add_property_name('7_5_8');
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
