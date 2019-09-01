<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_11_3
 *
 * @author user
 */
class Ses_Standard_11_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '11.3 Institutional Reputation';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_11_3_1('');
            $this->set_11_3_2('');
            $this->set_11_3_3('');
            $this->set_11_3_4('');
            $this->set_11_3_5('');
            $this->set_11_3_6('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The reputation of the institution in the community must be monitored and enhanced through provision of reliable and accurate information about its activities.</strong><br/><br/><strong>The level of compliance with this standard is judged by the extent to which the following good practices are followed.</strong>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_11_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_3_1', $value);
        $property->set_description('11.3.1 A comprehensive strategy has been developed for monitoring and improving the reputation of the institution in the local and other relevant communities.');
        $this->set_property($property);
    }

    public function get_11_3_1()
    {
        return $this->get_property('11_3_1')->get_value();
    }

    public function set_11_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_3_2', $value);
        $property->set_description('11.3.2 Clear guidelines have been established for public comments on behalf of the institution, normally restricting such comments to the Rector or Dean or a media office responsible to the Rector or Dean.');
        $this->set_property($property);
    }

    public function get_11_3_2()
    {
        return $this->get_property('11_3_2')->get_value();
    }

    public function set_11_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_3_3', $value);
        $property->set_description('11.3.3 Guidelines have been established for public comments on community issues by members of staff, where such comments could be associated with the institution.');
        $this->set_property($property);
    }

    public function get_11_3_3()
    {
        return $this->get_property('11_3_3')->get_value();
    }

    public function set_11_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_3_4', $value);
        $property->set_description('11.3.4 An institutional media office has been established with responsibility for managing media communications, seeking information about activities of the institution of potential interest to the community, and arranging for publication.');
        $this->set_property($property);
    }

    public function get_11_3_4()
    {
        return $this->get_property('11_3_4')->get_value();
    }

    public function set_11_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_3_5', $value);
        $property->set_description('11.3.5 Community views about the institution and its activities are sought and strategies developed for improving perceptions.');
        $this->set_property($property);
    }

    public function get_11_3_5()
    {
        return $this->get_property('11_3_5')->get_value();
    }

    public function set_11_3_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('11_3_6', $value);
        $property->set_description('11.3.6 If issues or concerns about operational issues involving the institution are raised in public forums these are dealt with immediately and objectively by the Rector or Dean or other designated senior members of faculty or staff.');
        $this->set_property($property);
    }

    public function get_11_3_6()
    {
        return $this->get_property('11_3_6')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('11_3_1');
        $property->add_property_name('11_3_2');
        $property->add_property_name('11_3_3');
        $property->add_property_name('11_3_4');
        $property->add_property_name('11_3_5');
        $property->add_property_name('11_3_6');
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
