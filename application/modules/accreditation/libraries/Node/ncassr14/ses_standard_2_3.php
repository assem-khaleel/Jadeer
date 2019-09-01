<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_2_3
 *
 * @author ahmadgx
 */
class Ses_Standard_2_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.3 Relationship Between Sections for Male and Female Students';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_2_3_1('');
            $this->set_2_3_2('');
            $this->set_2_3_3('');
            $this->set_2_3_4('');
            $this->set_2_3_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>In sections for male and female students the program coordinators and teaching staff in both sections must participate fully in cooperative planning, decision making and program and course reporting. There must be equitable distribution of resources and facilities to meet the requirements of program delivery, research, and associated services in each section and quality evaluations must consider both performance in each section as well as the program as a whole.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_1', $value);
        $property->set_description('2.3.1 In sections for male and female students resources, facilities and staffing provisions are provided at comparable levels.');
        $this->set_property($property);
    }

    public function get_2_3_1()
    {
        return $this->get_property('2_3_1')->get_value();
    }

    public function set_2_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_2', $value);
        $property->set_description('2.3.2 Program administrators in both sections and staff teaching the same courses are fully involved in planning and reporting processes and communicate regularly about the program through processes that are consistent with bylaws and regulations of the Higher Council of Education.');
        $this->set_property($property);
    }

    public function get_2_3_2()
    {
        return $this->get_property('2_3_2')->get_value();
    }

    public function set_2_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_3', $value);
        $property->set_description('2.3.3 Male and female sections are adequately represented in the membership of relevant committees and councils.');
        $this->set_property($property);
    }

    public function get_2_3_3()
    {
        return $this->get_property('2_3_3')->get_value();
    }

    public function set_2_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_4', $value);
        $property->set_description('2.3.4 Plans for the program and course specifications require the same standards of delivery and are consistent for both sections, subject to any appropriate variations to meet differing needs of students.');
        $this->set_property($property);
    }

    public function get_2_3_4()
    {
        return $this->get_property('2_3_4')->get_value();
    }

    public function set_2_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_5', $value);
        $property->set_description('2.3.5 Performance indicators and reports on courses and programs show results for each section, and also overall results for the program as a whole.');
        $this->set_property($property);
    }

    public function get_2_3_5()
    {
        return $this->get_property('2_3_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('2_3_1');
        $property->add_property_name('2_3_2');
        $property->add_property_name('2_3_3');
        $property->add_property_name('2_3_4');
        $property->add_property_name('2_3_5');
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
