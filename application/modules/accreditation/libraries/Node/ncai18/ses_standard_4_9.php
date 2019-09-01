<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_4_6
 *
 * @author user
 */
class Ses_Standard_4_9 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.9 Qualifications and Experience of Teaching Staff';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_9_1('');
            $this->set_4_9_2('');
            $this->set_4_9_3('');
            $this->set_4_9_4('');
            $this->set_4_9_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Teaching staff must be appropriately qualified and experienced for their particular teaching responsibilities.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_9_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_1', $value);
        $property->set_description('4.9.1 Teaching staff have appropriate qualifications and experience for the courses they teach.');
        $this->set_property($property);
    }

    public function get_4_9_1()
    {
        return $this->get_property('4_9_1')->get_value();
    }

    public function set_4_9_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_2', $value);
        $property->set_description('4.9.2 If part time teaching staff are needed there is an appropriate mix of full time and part time teaching staff. (As a general guideline at least 75 % of teaching staff should be employed on a full time basis.)');
        $this->set_property($property);
    }

    public function get_4_9_2()
    {
        return $this->get_property('4_9_2')->get_value();
    }

    public function set_4_9_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_3', $value);
        $property->set_description('4.9.3 All teaching staff are involved on a continuing basis in scholarly activities that ensure they remain up to date with the latest developments in their field and can involve their students in learning that incorporates those developments.');
        $this->set_property($property);
    }

    public function get_4_9_3()
    {
        return $this->get_property('4_9_3')->get_value();
    }

    public function set_4_9_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_4', $value);
        $property->set_description('4.9.4 Full time staff teaching postgraduate courses, are themselves active in scholarship and research in the fields of study they teach.');
        $this->set_property($property);
    }

    public function get_4_9_4()
    {
        return $this->get_property('4_9_4')->get_value();
    }

    public function set_4_9_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_5', $value);
        $property->set_description('4.9.5 In professional programs teaching teams include some experienced and highly skilled professionals in the field.');
        $this->set_property($property);
    }

    public function get_4_9_5()
    {
        return $this->get_property('4_9_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_9_1');
        $property->add_property_name('4_9_2');
        $property->add_property_name('4_9_3');
        $property->add_property_name('4_9_4');
        $property->add_property_name('4_9_5');
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
