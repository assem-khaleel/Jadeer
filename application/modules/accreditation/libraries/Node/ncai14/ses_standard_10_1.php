<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_10_1
 *
 * @author user
 */
class Ses_Standard_10_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '10.1 Institutional Research Policies';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_10_1_1('');
            $this->set_10_1_2('');
            $this->set_10_1_3('');
            $this->set_10_1_4('');
            $this->set_10_1_5('');
            $this->set_10_1_6('');
            $this->set_10_1_7('');
            $this->set_10_1_8('');
            $this->set_10_1_9('');
            $this->set_10_1_10('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>An institution with research responsibility must have a comprehensive research development plan based on its mission that includes performance targets, support and development strategies and administrative arrangements that encourage widespread involvement across the institution. It must have mechanisms for ensuring that ethical standards are maintained in the conduct and reporting on research.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_10_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_1', $value);
        $property->set_description('10.1.1 A research development plans consistent with the nature and mission of the institution and the economic and cultural development needs of the region  has been developed and published.');
        $this->set_property($property);
    }

    public function get_10_1_1()
    {
        return $this->get_property('10_1_1')->get_value();
    }

    public function set_10_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_2', $value);
        $property->set_description('10.1.2 The research development plan includes clearly specified indicators and benchmarks of performance.');
        $this->set_property($property);
    }

    public function get_10_1_2()
    {
        return $this->get_property('10_1_2')->get_value();
    }

    public function set_10_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_3', $value);
        $property->set_description('10.1.3 Clear policies are established for defining what is recognized as research, consistent with international standards. (This normally includes both self-generated and commissioned activity, but requires creative original work, independently validated by peers, and published in media that are highly regarded by scholars in the field.)');
        $this->set_property($property);
    }

    public function get_10_1_3()
    {
        return $this->get_property('10_1_3')->get_value();
    }

    public function set_10_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_4', $value);
        $property->set_description('10.1.4 Reports on overall institutional research performance are published annually and records maintained of the research activities of individuals, departments and colleges.');
        $this->set_property($property);
    }

    public function get_10_1_4()
    {
        return $this->get_property('10_1_4')->get_value();
    }

    public function set_10_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_5', $value);
        $property->set_description('10.1.5 Cooperation with local industry and with other research agencies is actively encouraged. Where appropriate these forms of cooperation may involve joint research projects, shared use of equipment, and cooperative strategies for development.');
        $this->set_property($property);
    }

    public function get_10_1_5()
    {
        return $this->get_property('10_1_5')->get_value();
    }

    public function set_10_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_6', $value);
        $property->set_description('10.1.6 Mechanisms are established for collaboration and cooperation with international universities and research networks.');
        $this->set_property($property);
    }

    public function get_10_1_6()
    {
        return $this->get_property('10_1_6')->get_value();
    }

    public function set_10_1_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_7', $value);
        $property->set_description('10.1.7 The institution has policies that deal with the establishment, accountability, and periodic review of research institutes or centers.');
        $this->set_property($property);
    }

    public function get_10_1_7()
    {
        return $this->get_property('10_1_7')->get_value();
    }

    public function set_10_1_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_8', $value);
        $property->set_description('10.1.8 The establishment of research institutes or centers does not inhibit research activities of others who are not directly associated with them.');
        $this->set_property($property);
    }

    public function get_10_1_8()
    {
        return $this->get_property('10_1_8')->get_value();
    }

    public function set_10_1_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_9', $value);
        $property->set_description('10.1.9 A high level committee is established to monitor compliance with ethical standards and approve research projects with potential impact on ethical issues.');
        $this->set_property($property);
    }

    public function get_10_1_9()
    {
        return $this->get_property('10_1_9')->get_value();
    }

    public function set_10_1_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('10_1_10', $value);
        $property->set_description("10.1.10 An adequate research budget is provided to enable the achievement of the institution's research plan.");
        $this->set_property($property);
    }

    public function get_10_1_10()
    {
        return $this->get_property('10_1_10')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('10_1_1');
        $property->add_property_name('10_1_2');
        $property->add_property_name('10_1_3');
        $property->add_property_name('10_1_4');
        $property->add_property_name('10_1_5');
        $property->add_property_name('10_1_6');
        $property->add_property_name('10_1_7');
        $property->add_property_name('10_1_8');
        $property->add_property_name('10_1_9');
        $property->add_property_name('10_1_10');
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
