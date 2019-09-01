<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_3_1
 *
 * @author user
 */
class Ses_Standard_3_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.1 Institutional Commitment to Quality Improvement';
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
            $this->set_3_1_6('');
            $this->set_3_1_7('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>An institution must be committed to maintaining and improving quality through effective leadership and active involvement of teaching and other staff.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_3_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_1', $value);
        $property->set_description('3.1.1 The Rector or Dean strongly supports involvement in quality assurance processes.');
        $this->set_property($property);
    }

    public function get_3_1_1()
    {
        return $this->get_property('3_1_1')->get_value();
    }

    public function set_3_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_2', $value);
        $property->set_description('3.1.2 Adequate resources are provided for the leadership and management of quality assurance processes, and provision of assistance where it is needed.');
        $this->set_property($property);
    }

    public function get_3_1_2()
    {
        return $this->get_property('3_1_2')->get_value();
    }

    public function set_3_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_3', $value);
        $property->set_description('3.1.3 All teaching and other staff participate in self-assessments and cooperate with reporting and improvement processes in their sphere of activity.');
        $this->set_property($property);
    }

    public function get_3_1_3()
    {
        return $this->get_property('3_1_3')->get_value();
    }

    public function set_3_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_4', $value);
        $property->set_description('3.1.4 Creativity and innovation combined with clear guidelines and accountability processes are actively encouraged at all levels.');
        $this->set_property($property);
    }

    public function get_3_1_4()
    {
        return $this->get_property('3_1_4')->get_value();
    }

    public function set_3_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_5', $value);
        $property->set_description('3.1.5 Mistakes and weaknesses are recognized and used as a basis for planning for improvement.');
        $this->set_property($property);
    }

    public function get_3_1_5()
    {
        return $this->get_property('3_1_5')->get_value();
    }

    public function set_3_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_6', $value);
        $property->set_description('3.1.6 Improvements in performance and outstanding achievements  are recognized and appropriately acknowledged.');
        $this->set_property($property);
    }

    public function get_3_1_6()
    {
        return $this->get_property('3_1_6')->get_value();
    }

    public function set_3_1_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_1_7', $value);
        $property->set_description('3.1.7 Evaluation and planning for quality improvement are integrated into normal administrative processes.');
        $this->set_property($property);
    }

    public function get_3_1_7()
    {
        return $this->get_property('3_1_7')->get_value();
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
        $property->add_property_name('3_1_6');
        $property->add_property_name('3_1_7');

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
