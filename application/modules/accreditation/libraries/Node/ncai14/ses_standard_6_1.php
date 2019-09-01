<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ses_standard_6_1
 *
 * @author user
 */
class Ses_Standard_6_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '6.1 Planning and Evaluation';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_6_1_1('');
            $this->set_6_1_2('');
            $this->set_6_1_3('');
            $this->set_6_1_4('');
            $this->set_6_1_5('');
            $this->set_6_1_6('');
            $this->set_6_1_7('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Policies and procedures must be in place to ensure that resource materials and services needed to support student learning are adequate and appropriate for the programs offered at the institution, regularly evaluated, and kept up to date as required.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_6_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_1', $value);
        $property->set_description('6.1.1 Policies for the development of library and other learning resources and support services give special attention to the particular requirements for programs and research requirements at the institution.');
        $this->set_property($property);
    }

    public function get_6_1_1()
    {
        return $this->get_property('6_1_1')->get_value();
    }

    public function set_6_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_2', $value);
        $property->set_description('6.1.2 A learning resource strategy has been developed which is directly linked to strategic priorities for program development, and adjusted as required as new programs are introduced.');
        $this->set_property($property);
    }

    public function get_6_1_2()
    {
        return $this->get_property('6_1_2')->get_value();
    }

    public function set_6_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_3', $value);
        $property->set_description('6.1.3 The adequacy of library and resource center materials is formally evaluated at least once every two years.');
        $this->set_property($property);
    }

    public function get_6_1_3()
    {
        return $this->get_property('6_1_3')->get_value();
    }

    public function set_6_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_4', $value);
        $property->set_description('6.1.4 Evaluation procedures include user surveys dealing with teaching staff and student satisfaction, extent of usage, consistency with requirements of teaching and learning at the institution, range of services, and comparisons of provision and user satisfaction with other comparable institutions.');
        $this->set_property($property);
    }

    public function get_6_1_4()
    {
        return $this->get_property('6_1_4')->get_value();
    }

    public function set_6_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_5', $value);
        $property->set_description('6.1.5 Evaluation processes include gathering of information on the extent to which library and other learning resources are used and analysis of this data in relation to teaching and learning requirements for different programs in the institution.');
        $this->set_property($property);
    }

    public function get_6_1_5()
    {
        return $this->get_property('6_1_5')->get_value();
    }

    public function set_6_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_6', $value);
        $property->set_description('6.1.6 Teaching staff responsible for courses and programs regularly provide advice on materials required to support teaching and learning early enough for appropriate provision to be made.');
        $this->set_property($property);
    }

    public function get_6_1_6()
    {
        return $this->get_property('6_1_6')->get_value();
    }

    public function set_6_1_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('6_1_7', $value);
        $property->set_description('6.1.7 Reserve book and other reference materials are regularly reviewed with advice from teaching staff to ensure adequate access to necessary materials for courses on offer at any time.');
        $this->set_property($property);
    }

    public function get_6_1_7()
    {
        return $this->get_property('6_1_7')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('6_1_1');
        $property->add_property_name('6_1_2');
        $property->add_property_name('6_1_3');
        $property->add_property_name('6_1_4');
        $property->add_property_name('6_1_5');
        $property->add_property_name('6_1_6');
        $property->add_property_name('6_1_7');
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
