<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_6_3
 *
 * @author ahmadgx
 */
class Ses_Standard_6_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '6.3 Support for Users';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_6_3_1('');
            $this->set_6_3_2('');
            $this->set_6_3_3('');
            $this->set_6_3_4('');
            $this->set_6_3_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Adequate support must be provided to assist students and teaching staff to make effective use of library services and resources.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_6_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_3_1', $value);
        $property->set_description('6.3.1 Orientation and training programs are provided for new students in the program to prepare them to access facilities and services.');
        $this->set_property($property);
    }

    public function get_6_3_1()
    {
        return $this->get_property('6_3_1')->get_value();
    }

    public function set_6_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_3_2', $value);
        $property->set_description('6.3.2 Assistance is available to assist faculty and students in the program in conducting searches and locating and using information.');
        $this->set_property($property);
    }

    public function get_6_3_2()
    {
        return $this->get_property('6_3_2')->get_value();
    }

    public function set_6_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_3_3', $value);
        $property->set_description('6.3.3 A reference service is available through which in-depth questions are answered by qualified librarians.');
        $this->set_property($property);
    }

    public function get_6_3_3()
    {
        return $this->get_property('6_3_3')->get_value();
    }

    public function set_6_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_3_4', $value);
        $property->set_description('6.3.4 Electronic and/or other automated systems with search facilities are available to assist in locating resources within the institution and in other collections.');
        $this->set_property($property);
    }

    public function get_6_3_4()
    {
        return $this->get_property('6_3_4')->get_value();
    }

    public function set_6_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_3_5', $value);
        $property->set_description('6.3.5 Teaching staff and students in the program are kept informed of library developments such as acquisition of new materials, training programs, or changes in services or opening hours.');
        $this->set_property($property);
    }

    public function get_6_3_5()
    {
        return $this->get_property('6_3_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('6_3_1');
        $property->add_property_name('6_3_2');
        $property->add_property_name('6_3_3');
        $property->add_property_name('6_3_4');
        $property->add_property_name('6_3_5');
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
