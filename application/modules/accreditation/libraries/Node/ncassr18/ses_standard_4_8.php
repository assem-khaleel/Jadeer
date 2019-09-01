<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_4_8
 *
 * @author ahmadgx
 */
class Ses_Standard_4_8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.8 Qualifications and Experience of Teaching Staff';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_8_1('');
            $this->set_4_8_2('');
            $this->set_4_8_3('');
            $this->set_4_8_4('');
            $this->set_4_8_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Teaching staff have qualifications and experience necessary for teaching the courses they teach, and keep up to date with academic and/or professional developments in their field.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_8_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_1', $value);
        $property->set_description('4.8.1 Teaching staff  have appropriate qualifications and experience for the courses they teach.  (For undergraduate and masters degree programs this would normally require academic qualifications in their specific teaching area at least one level above that of the program in which they teach.)');
        $this->set_property($property);
    }

    public function get_4_8_1()
    {
        return $this->get_property('4_8_1')->get_value();
    }

    public function set_4_8_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_2', $value);
        $property->set_description('4.8.2 If part time teaching staff are appointed (for example in a professional program where current industry experience may be sought)  there is an appropriate mix of full time and part time teaching staff. (As a general guideline at least 75 % of faculty should be employed on a full time basis.)');
        $this->set_property($property);
    }

    public function get_4_8_2()
    {
        return $this->get_property('4_8_2')->get_value();
    }

    public function set_4_8_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_3', $value);
        $property->set_description('4.8.3 All teaching staff are involved on a continuing basis in scholarly activities that ensure they remain up to date with the latest developments in their field and can involve their students in learning that incorporates those developments.');
        $this->set_property($property);
    }

    public function get_4_8_3()
    {
        return $this->get_property('4_8_3')->get_value();
    }

    public function set_4_8_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_4', $value);
        $property->set_description('4.8.4 Full time staff teaching in post-graduate courses, are themselves active in scholarship and research in the fields of study they teach.');
        $this->set_property($property);
    }

    public function get_4_8_4()
    {
        return $this->get_property('4_8_4')->get_value();
    }

    public function set_4_8_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_8_5', $value);
        $property->set_description('4.8.5 In professional programs teaching teams include some experienced and highly skilled professionals in the field.');
        $this->set_property($property);
    }

    public function get_4_8_5()
    {
        return $this->get_property('4_8_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_8_1');
        $property->add_property_name('4_8_2');
        $property->add_property_name('4_8_3');
        $property->add_property_name('4_8_4');
        $property->add_property_name('4_8_5');
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
