<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_10_2
 *
 * @author ahmadgx
 */
class Ses_Standard_10_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '10.2 Research Facilities and Equipmen';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_10_2_1('');
            $this->set_10_2_2('');
            $this->set_10_2_3('');
            $this->set_10_2_4('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Adequate facilities and equipment appropriate for research in the program field of study must be available for use by teaching staff and postgraduate students.  Clear policies must be established for ownership and care for specialized facilities and equipment obtained through research grants or cooperation with industry</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_10_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_2_1', $value);
        $property->set_description('10.2.1 Adequate laboratory space and equipment, library and information systems resources are available to support the research activities of faculty and students in  the field in which the program is offered');
        $this->set_property($property);
    }

    public function get_10_2_1()
    {
        return $this->get_property('10_2_1')->get_value();
    }

    public function set_10_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_2_2', $value);
        $property->set_description('10.2.2 Security systems  are established that ensure safety for researchers and their  activities, the institutional community and the surrounding region');
        $this->set_property($property);
    }

    public function get_10_2_2()
    {
        return $this->get_property('10_2_2')->get_value();
    }

    public function set_10_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_2_3', $value);
        $property->set_description('10.2.3 Policies are established to make clear the ownership and responsibility for maintenance of equipment obtained through faculty research grants, commissioned research or other external sources.');
        $this->set_property($property);
    }

    public function get_10_2_3()
    {
        return $this->get_property('10_2_3')->get_value();
    }

    public function set_10_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_2_4', $value);
        $property->set_description('10.2.4 Adequate budget and facilities are provided for the conduct of research at a level consistent with institutional, program and departmental');
        $this->set_property($property);
    }

    public function get_10_2_4()
    {
        return $this->get_property('10_2_4')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('10_2_1');
        $property->add_property_name('10_2_2');
        $property->add_property_name('10_2_3');
        $property->add_property_name('10_2_4');
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
