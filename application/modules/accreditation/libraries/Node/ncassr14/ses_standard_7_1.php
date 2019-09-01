<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_7_1
 *
 * @author ahmadgx
 */
class Ses_Standard_7_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '7.1 Policy and Planning';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_7_1_1('');
            $this->set_7_1_2('');
            $this->set_7_1_3('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Planning processes for the provision of facilities and the acquisition and maintenance of equipment must include consultation with program representatives to ensure clear specification of program requirements.  Plans for provision must appropriately balance program requirements with institutional policies to ensure compatibility of systems and resources available</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_7_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_1_1', $value);
        $property->set_description('7.1.1 Equipment acquisitions meet program requirements and are also consistent with institutional policies to achieve compatibility of equipment and software systems across the institution.');
        $this->set_property($property);
    }

    public function get_7_1_1()
    {
        return $this->get_property('7_1_1')->get_value();
    }

    public function set_7_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_1_2', $value);
        $property->set_description('7.1.2 Teaching staff are consulted before major equipment acquisitions to ensure that current and anticipated emerging needs are met.');
        $this->set_property($property);
    }

    public function get_7_1_2()
    {
        return $this->get_property('7_1_2')->get_value();
    }

    public function set_7_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('7_1_3', $value);
        $property->set_description('7.1.3 Equipment planning provides for acquisition, servicing and replacement according to a planned schedule.');
        $this->set_property($property);
    }

    public function get_7_1_3()
    {
        return $this->get_property('7_1_3')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('7_1_1');
        $property->add_property_name('7_1_2');
        $property->add_property_name('7_1_3');
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
