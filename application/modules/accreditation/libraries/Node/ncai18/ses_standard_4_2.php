<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_4_2
 *
 * @author user
 */
class Ses_Standard_4_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.2 Student Learning Outcomes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_2_1('');
            $this->set_4_2_2('');
            $this->set_4_2_3('');
            $this->set_4_2_4('');
            $this->set_4_2_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Intended student learning outcomes must be consistent with the National Qualifications Framework, and with generally accepted standards for the field of study concerned, including requirements for any professions for which students are being prepared. Programs must be planned in a way that ensures that all courses contribute to program learning outcomes in a coordinated way.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_2_1', $value);
        $property->set_description('4.2.1 Intended learning outcomes are specified after consideration of relevant academic and professional advice.');
        $this->set_property($property);
    }

    public function get_4_2_1()
    {
        return $this->get_property('4_2_1')->get_value();
    }

    public function set_4_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_2_2', $value);
        $property->set_description('4.2.2 Intended learning outcomes are consistent with the Qualifications Framework. (covering all of the domains of learning at the standards required).');
        $this->set_property($property);
    }

    public function get_4_2_2()
    {
        return $this->get_property('4_2_2')->get_value();
    }

    public function set_4_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_2_3', $value);
        $property->set_description('4.2.3 Intended learning outcomes are consistent with requirements for professional practice in Saudi Arabia in the fields concerned. (These requirements should include local accreditation requirements and also take account of international accreditation requirements for that field of study, and any Saudi Arabian regulations or regional needs)');
        $this->set_property($property);
    }

    public function get_4_2_3()
    {
        return $this->get_property('4_2_3')->get_value();
    }

    public function set_4_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_2_4', $value);
        $property->set_description('4.2.4 If an institution has identified special attributes to be developed in students graduating from the institution comprehensive strategies are established for these to be developed.  (This means that the attributes to be developed in students are clearly defined, strategies for developing them planned and implemented across all programs, and mechanisms for assessing and reporting on the extent to which graduating students have developed them are in place.)');
        $this->set_property($property);
    }

    public function get_4_2_4()
    {
        return $this->get_property('4_2_4')->get_value();
    }

    public function set_4_2_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_2_5', $value);
        $property->set_description('4.2.5 Appropriate program evaluation mechanisms, including graduating student surveys, employment outcome data, employer feedback and subsequent performance of graduates, are  used to provide evidence about the appropriateness of  intended learning outcomes and the extent to which they are achieved.  (see also sections 4.3 and 4.5.2 dealing with processes for program evaluation  and verification of standards of student achievement)');
        $this->set_property($property);
    }

    public function get_4_2_5()
    {
        return $this->get_property('4_2_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_2_1');
        $property->add_property_name('4_2_2');
        $property->add_property_name('4_2_3');
        $property->add_property_name('4_2_4');
        $property->add_property_name('4_2_5');

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
