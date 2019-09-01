<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_5_4
 *
 * @author user
 */
class Ses_Standard_5_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.4 Planning and Evaluation of Student Services';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    
    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_5_4_1('');
            $this->set_5_4_2('');
            $this->set_5_4_3('');
            $this->set_5_4_4('');
            $this->set_5_4_5('');
            $this->set_5_4_6('');
            $this->set_5_4_7('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Effective processes must be established for the planning, administrative oversight and evaluation of student services and activities.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_5_4_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_4_1', $value);
        $property->set_description('5.4.1 The range of services provided and the resources devoted to them reflect the mission of the institution and any special requirements of the student population.');
        $this->set_property($property);
    }

    public function get_5_4_1()
    {
        return $this->get_property('5_4_1')->get_value();
    }

    public function set_5_4_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_4_2', $value);
        $property->set_description('5.4.2 Formal plans are developed for the provision and improvement of student services and the implementation and effectiveness of those plans is monitored on a regular basis.');
        $this->set_property($property);
    }

    public function get_5_4_2()
    {
        return $this->get_property('5_4_2')->get_value();
    }

    public function set_5_4_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_4_3', $value);
        $property->set_description('5.4.3 A senior member of teaching or other staff is assigned responsibility for oversight and development of student services.');
        $this->set_property($property);
    }

    public function get_5_4_3()
    {
        return $this->get_property('5_4_3')->get_value();
    }

    public function set_5_4_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_4_4', $value);
        $property->set_description('5.4.4 The effectiveness and relevance of services is regularly monitored through processes which include surveys of student usage and satisfaction. Services are modified in response to evaluation and feedback.');
        $this->set_property($property);
    }

    public function get_5_4_4()
    {
        return $this->get_property('5_4_4')->get_value();
    }

    public function set_5_4_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_4_5', $value);
        $property->set_description('5.4.5 Adequate facilities and financial support are provided for the services that are needed.');
        $this->set_property($property);
    }

    public function get_5_4_5()
    {
        return $this->get_property('5_4_5')->get_value();
    }

    public function set_5_4_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_4_6', $value);
        $property->set_description('5.4.6 If services are provided through student organizations, assistance is given in management and organization if required, and there is effective oversight of financial management and reporting.');
        $this->set_property($property);
    }

    public function get_5_4_6()
    {
        return $this->get_property('5_4_6')->get_value();
    }

    public function set_5_4_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('5_4_7', $value);
        $property->set_description('5.4.7 If student newspapers or other student documents are published there are clear guidelines defining publication standards and editorial policy and the extent and nature of oversight by the institution.');
        $this->set_property($property);
    }

    public function get_5_4_7()
    {
        return $this->get_property('5_4_7')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('5_4_1');
        $property->add_property_name('5_4_2');
        $property->add_property_name('5_4_3');
        $property->add_property_name('5_4_4');
        $property->add_property_name('5_4_5');
        $property->add_property_name('5_4_6');
        $property->add_property_name('5_4_7');
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
