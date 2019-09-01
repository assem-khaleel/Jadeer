<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_3_1
 *
 * @author ahmadgx
 */
class Ses_Standard_3_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.1 Commitment to Quality Improvement in the Program';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_3_1_1('');
            $this->set_3_1_2('');
            $this->set_3_1_3('');
            $this->set_3_1_4('');
            $this->set_3_1_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Program administrators and teaching and other staff must be committed to maintaining and improving the quality of the program.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_3_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_1', $value);
        $property->set_description('3.1.1 All teaching and other staff participate in self-assessments and cooperate with reporting and improvement processes in their sphere of activity.');
        $this->set_property($property);
    }

    public function get_3_1_1()
    {
        return $this->get_property('3_1_1')->get_value();
    }

    public function set_3_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_2', $value);
        $property->set_description('3.1.2 Creativity and innovation combined with clear guidelines and accountability processes are actively encouraged.');
        $this->set_property($property);
    }

    public function get_3_1_2()
    {
        return $this->get_property('3_1_2')->get_value();
    }

    public function set_3_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_3', $value);
        $property->set_description('3.1.3 Mistakes and weaknesses are acknowledged, and dealt with constructively, with help given for improvement.');
        $this->set_property($property);
    }

    public function get_3_1_3()
    {
        return $this->get_property('3_1_3')->get_value();
    }

    public function set_3_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_4', $value);
        $property->set_description('3.1.4 Improvements in quality are appropriately acknowledged and outstanding achievements recognized.');
        $this->set_property($property);
    }

    public function get_3_1_4()
    {
        return $this->get_property('3_1_4')->get_value();
    }

    public function set_3_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_5', $value);
        $property->set_description('3.1.5 Evaluation and planning for quality improvement are integrated into normal administrative processes.');
        $this->set_property($property);
    }

    public function get_3_1_5()
    {
        return $this->get_property('3_1_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('3_1_1');
        $property->add_property_name('3_1_2');
        $property->add_property_name('3_1_3');
        $property->add_property_name('3_1_4');
        $property->add_property_name('3_1_5');
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
