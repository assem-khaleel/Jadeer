<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_2_7
 *
 * @author user
 */
class Ses_Standard_2_7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.7 Organizational Climate';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_2_7_1('');
            $this->set_2_7_2('');
            $this->set_2_7_3('');
            $this->set_2_7_4('');
            $this->set_2_7_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The institution must implement systems to maintain a positive organizational climate. (defined as one that is characterized by a sense of involvement in decision making, capacity to take initiative and pursue career goals, and a belief among teaching and other staff that their contributions are valued.)</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_7_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_7_1', $value);
        $property->set_description('2.7.1 A systematic approach is adopted by senior managers to develop and maintain a positive organizational climate.');
        $this->set_property($property);
    }

    public function get_2_7_1()
    {
        return $this->get_property('2_7_1')->get_value();
    }

    public function set_2_7_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_7_2', $value);
        $property->set_description('2.7.2 Opinions of staff on major initiatives are sought and information is provided on how those opinions have been considered and responded to.');
        $this->set_property($property);
    }

    public function get_2_7_2()
    {
        return $this->get_property('2_7_2')->get_value();
    }

    public function set_2_7_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_7_3', $value);
        $property->set_description('2.7.3 Significant achievements and contributions to the institution and the community by staff or students are recognized and appropriately acknowledged.');
        $this->set_property($property);
    }

    public function get_2_7_3()
    {
        return $this->get_property('2_7_3')->get_value();
    }

    public function set_2_7_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_7_4', $value);
        $property->set_description('2.7.4 Information about issues, plans and developments at the institution are regularly communicated to teaching and other staff through means such as newsletters, internal publications or electronic communications.');
        $this->set_property($property);
    }

    public function get_2_7_4()
    {
        return $this->get_property('2_7_4')->get_value();
    }

    public function set_2_7_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_7_5', $value);
        $property->set_description('2.7.5 Responsibility is given to a senior administrator or central unit to conduct periodic surveys dealing with issues relevant to organizational climate including such matters as job satisfaction, confidence in future development, sense of involvement in planning and development.');
        $this->set_property($property);
    }

    public function get_2_7_5()
    {
        return $this->get_property('2_7_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('2_7_1');
        $property->add_property_name('2_7_2');
        $property->add_property_name('2_7_3');
        $property->add_property_name('2_7_4');
        $property->add_property_name('2_7_5');

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
