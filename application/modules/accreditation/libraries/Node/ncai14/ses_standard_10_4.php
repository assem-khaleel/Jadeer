<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_10_4
 *
 * @author user
 */
class Ses_Standard_10_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '10.4 Research Facilities and Equipment';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_10_4_1('');
            $this->set_10_4_2('');
            $this->set_10_4_3('');
            $this->set_10_4_4('');
            $this->set_10_4_5('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Adequate facilities and equipment appropriate for research in the fields of study offered in the institution must be available for use by teaching staff and postgraduate students.  Clear policies should be established for ownership and care of specialized facilities and equipment obtained through research grants or cooperation with industry.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_10_4_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_4_1', $value);
        $property->set_description('10.4.1 Adequate laboratory space and equipment, library and information systems and resources are available to support the research activities of teaching staff and students in the fields in which programs are offered.');
        $this->set_property($property);
    }

    public function get_10_4_1()
    {
        return $this->get_property('10_4_1')->get_value();
    }

    public function set_10_4_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_4_2', $value);
        $property->set_description('10.4.2 An adequate budget is provided for funding of research equipment and facilities in all academic sections of the institution');
        $this->set_property($property);
    }

    public function get_10_4_2()
    {
        return $this->get_property('10_4_2')->get_value();
    }

    public function set_10_4_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_4_3', $value);
        $property->set_description('10.4.3 Arrangements are made for joint ownership or shared access to major equipment items within the institution and with other organizations if appropriate.');
        $this->set_property($property);
    }

    public function get_10_4_3()
    {
        return $this->get_property('10_4_3')->get_value();
    }

    public function set_10_4_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_4_4', $value);
        $property->set_description('10.4.4 Security systems are established that ensure safety for researchers and their activities, the institutional community and the surrounding area.');
        $this->set_property($property);
    }

    public function get_10_4_4()
    {
        return $this->get_property('10_4_4')->get_value();
    }

    public function set_10_4_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_4_5', $value);
        $property->set_description('10.4.5 Policies are established to make clear the ownership and responsibility for maintenance of equipment obtained through research grants, commissioned research or other external sources.');
        $this->set_property($property);
    }

    public function get_10_4_5()
    {
        return $this->get_property('10_4_5')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('10_4_1');
        $property->add_property_name('10_4_2');
        $property->add_property_name('10_4_3');
        $property->add_property_name('10_4_4');
        $property->add_property_name('10_4_5');
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
