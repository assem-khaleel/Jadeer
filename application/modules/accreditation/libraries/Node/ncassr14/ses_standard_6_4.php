<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_6_4
 *
 * @author ahmadgx
 */
class Ses_Standard_6_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '6.4 Resources and Facilities';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_6_4_1('');
            $this->set_6_4_2('');
            $this->set_6_4_3('');
            $this->set_6_4_4('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Adequate reference material for the program must be available and facilities in the library or resource center must be appropriate for the needs of the program,</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_6_4_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_1', $value);
        $property->set_description('6.4.1 Adequate books journals and other reference material including on line resources are available to meet program requirements');
        $this->set_property($property);
    }

    public function get_6_4_1()
    {
        return $this->get_property('6_4_1')->get_value();
    }

    public function set_6_4_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_2', $value);
        $property->set_description('6.4.2 Up to date computer equipment and software is available on a sufficient scale to meet program requirements to support electronic access to resources and reference material.');
        $this->set_property($property);
    }

    public function get_6_4_2()
    {
        return $this->get_property('6_4_2')->get_value();
    }

    public function set_6_4_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_3', $value);
        $property->set_description('6.4.3 Books and journals and other materials are available in Arabic and English (or other languages) as required for the program and associated research.');
        $this->set_property($property);
    }

    public function get_6_4_3()
    {
        return $this->get_property('6_4_3')->get_value();
    }

    public function set_6_4_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_4_4', $value);
        $property->set_description('6.4.4 Sufficient facilities are provided for both individual and small group study and research as required for the program.');
        $this->set_property($property);
    }

    public function get_6_4_4()
    {
        return $this->get_property('6_4_4')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('6_4_1');
        $property->add_property_name('6_4_2');
        $property->add_property_name('6_4_3');
        $property->add_property_name('6_4_4');
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
