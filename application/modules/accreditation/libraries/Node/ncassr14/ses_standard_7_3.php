<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_7_3
 *
 * @author ahmadgx
 */
class Ses_Standard_7_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '7.3 Management and Administration';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_7_3_1('');
            $this->set_7_3_2('');
            $this->set_7_3_3('');
            $this->set_7_3_4('');
            $this->set_7_3_5('');
            $this->set_7_3_6('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Management and administration of facilities, equipment and associated services must be efficient and ensure maximum effective utilization of facilities provided.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_7_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_3_1', $value);
        $property->set_description('7.3.1 A complete inventory is maintained of equipment used in the program that is owned or controlled by the institution including equipment assigned to individual faculty or staff for teaching and research.');
        $this->set_property($property);
    }

    public function get_7_3_1()
    {
        return $this->get_property('7_3_1')->get_value();
    }

    public function set_7_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_3_2', $value);
        $property->set_description('7.3.2 Services such as cleaning, waste disposal, minor maintenance, safety, and environmental management are efficiently and effectively carried out.');
        $this->set_property($property);
    }

    public function get_7_3_2()
    {
        return $this->get_property('7_3_2')->get_value();
    }

    public function set_7_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_3_3', $value);
        $property->set_description('7.3.3 Provision is made for regular condition assessments, preventative and corrective maintenance, and replacement.');
        $this->set_property($property);
    }

    public function get_7_3_3()
    {
        return $this->get_property('7_3_3')->get_value();
    }

    public function set_7_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_3_4', $value);
        $property->set_description('7.3.4 Effective security is provided for specialized facilities and equipment for teaching and research, with responsibility between individual faculty, departments or colleges, or central administration clearly defined.');
        $this->set_property($property);
    }

    public function get_7_3_4()
    {
        return $this->get_property('7_3_4')->get_value();
    }

    public function set_7_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_3_5', $value);
        $property->set_description('7.3.5 Effective systems are in place to ensure the personal security of faculty, staff and students, with appropriate provisions for the security of their personal property.');
        $this->set_property($property);
    }

    public function get_7_3_5()
    {
        return $this->get_property('7_3_5')->get_value();
    }

    public function set_7_3_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_3_6', $value);
        $property->set_description('7.3.6 Arrangements are made for shared use of underutilized facilities with adequate mechanisms for security of equipment.');
        $this->set_property($property);
    }

    public function get_7_3_6()
    {
        return $this->get_property('7_3_6')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('7_3_1');
        $property->add_property_name('7_3_2');
        $property->add_property_name('7_3_3');
        $property->add_property_name('7_3_4');
        $property->add_property_name('7_3_5');
        $property->add_property_name('7_3_6');
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
