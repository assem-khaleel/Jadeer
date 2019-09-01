<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_3_2
 *
 * @author user
 */
class Ses_Standard_3_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.2 Scope of Quality Assurance Processes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_3_2_1('');
            $this->set_3_2_2('');
            $this->set_3_2_3('');
            $this->set_3_2_4('');
            $this->set_3_2_5('');
            $this->set_3_2_6('');
            $this->set_3_2_7('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Quality assurance activities that are necessary to ensure good quality must apply to all functions carried out in the institution and involve teaching and other staff in all parts of the institution in performance evaluations and planning for improvement.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_3_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_1', $value);
        $property->set_description('3.2.1 All academic and administrative units within the institution (including the governing body, and senior management) participate in the processes of quality assurance and improvement.');
        $this->set_property($property);
    }

    public function get_3_2_1()
    {
        return $this->get_property('3_2_1')->get_value();
    }

    public function set_3_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_2', $value);
        $property->set_description('3.2.2 Regular evaluations are carried out and reports prepared to provide an overview of performance for the institution as a whole, and for organizational units and functions within it.');
        $this->set_property($property);
    }

    public function get_3_2_2()
    {
        return $this->get_property('3_2_2')->get_value();
    }

    public function set_3_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_3', $value);
        $property->set_description('3.2.3 Quality evaluations consider inputs, processes and outcomes, with particular attention to quality of outcomes.');
        $this->set_property($property);
    }

    public function get_3_2_3()
    {
        return $this->get_property('3_2_3')->get_value();
    }

    public function set_3_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_4', $value);
        $property->set_description('3.2.4 Evaluations are carried out for both routine activities and for strategic priorities for improvement.');
        $this->set_property($property);
    }

    public function get_3_2_4()
    {
        return $this->get_property('3_2_4')->get_value();
    }

    public function set_3_2_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_5', $value);
        $property->set_description('3.2.5 Quality assurance processes are designed to ensure both that acceptable standards are met, and that there is continuing improvement in performance.');
        $this->set_property($property);
    }

    public function get_3_2_5()
    {
        return $this->get_property('3_2_5')->get_value();
    }

    public function set_3_2_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_6', $value);
        $property->set_description("3.2.6 A program of institutional research on quality issues is carried out to investigate and report to the Rector or Dean and the governing body, and inform the institution as a whole on the quality of the institution's activities and achievement of its objectives.");
        $this->set_property($property);
    }

    public function get_3_2_6()
    {
        return $this->get_property('3_2_6')->get_value();
    }

    public function set_3_2_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_2_7', $value);
        $property->set_description('3.2.7 In sections for male and female students detailed evaluations in relation  to all standards should be carried out in a consistent way in both sections and quality reports on those standards should note any significant differences found and make appropriate recommendations for action in response to what is found.');
        $this->set_property($property);
    }

    public function get_3_2_7()
    {
        return $this->get_property('3_2_7')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('3_2_1');
        $property->add_property_name('3_2_2');
        $property->add_property_name('3_2_3');
        $property->add_property_name('3_2_4');
        $property->add_property_name('3_2_5');
        $property->add_property_name('3_2_6');
        $property->add_property_name('3_2_7');

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
