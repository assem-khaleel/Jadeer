<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_4
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 4. Learning and Teaching.';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_overall_rating('');
            $this->set_larning_and_teaching();
            $this->set_explanatory_report('');
            $this->set_standard_description('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens [] = new Ssr_H_Standard_4_1();
        $childrens [] = new Ssr_H_Standard_4_2();
        $childrens [] = new Ssr_H_Standard_4_3();
        $childrens [] = new Ssr_H_Standard_4_4();
        $childrens [] = new Ssr_H_Standard_4_5();
        $childrens [] = new Ssr_H_Standard_4_6();
        $childrens [] = new Ssr_H_Standard_4_7();
        $childrens [] = new Ssr_H_Standard_4_8();
        $childrens [] = new Ssr_H_Standard_4_9();
        $childrens [] = new Ssr_H_Standard_4_10();
        $childrens [] = new Ssr_H_Standard_4_kpi();


        return $childrens;
    }

    public function set_overall_rating($value)
    {
        $property = new \Orm_Property_Smart_Field('overall_rating', $value);
        $property->set_class('Node\ncassr18\Ses_Standard_4_Overall');
        $property->set_function('get_combined_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('Overall Rating');
        $this->set_property($property);
    }

    public function get_overall_rating()
    {
        return $this->get_property('overall_rating')->get_value();
    }

    public function set_larning_and_teaching()
    {
        $property = new \Orm_Property_Fixedtext('larning_and_teaching', 'Student learning outcomes must be clearly specified, consistent with the National Qualifications Framework and requirements for employment or professional practice. Standards of learning must be assessed and verified through appropriate processes and benchmarked against demanding and relevant external reference points. Teaching staff must be appropriately qualified and experienced for their particular teaching responsibilities, use teaching strategies suitable for different kinds of learning outcomes and participate in activities to improve their teaching effectiveness. Teaching quality and the effectiveness of programs must be evaluated through student assessments and graduate and employer surveys with evidence from these sources used as a basis for plans for improvement.');
        $this->set_property($property);
    }

    public function get_larning_and_teaching()
    {
        return $this->get_property('larning_and_teaching')->get_value();
    }

    public function set_explanatory_report($value)
    {
        $property = new \Orm_Property_Textarea('explanatory_report', $value);
        $property->set_description('Provide an explanatory report about the organizational framework and process arrangements followed to demonstrate that the sub-standards are met (For example, use information provided in reports of survey summaries, KPIs and benchmarking analysis, indirect and direct learning outcome assessments or in annual program reports).');
        $this->set_property($property);
    }

    public function get_explanatory_report()
    {
        return $this->get_property('explanatory_report')->get_value();
    }

    public function set_standard_description($value)
    {
        $property = new \Orm_Property_Textarea('standard_description', $value);
        $property->set_description('Provide a description of the quality assurance response processes used to verify the organizational framework and processes for learning and teaching are valid  (For example if steps were taken to check the standards of student achievement against appropriate external benchmarks, what was done, and what conclusions were reached?).');
        $this->set_property($property);
    }

    public function get_standard_description()
    {
        return $this->get_property('standard_description')->get_value();
    }

}
