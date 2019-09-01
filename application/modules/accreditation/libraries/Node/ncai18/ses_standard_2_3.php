<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_2_3
 *
 * @author user
 */
class Ses_Standard_2_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.3 Planning Processes';
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
            $this->set_2_3_6('');
            $this->set_2_3_7('');
            $this->set_2_3_8('');
            $this->set_2_3_9('');
            $this->set_2_3_10('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Planning processes must be managed effectively to achieve the mission and goals through cooperative action across the institution.  Planning must combine coordinated strategic planning with flexibility to adapt to results achieved and changing circumstances.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_1', $value);
        $property->set_description('2.3.1 A comprehensive strategic plan has been developed and provides a planning framework for all sections within the institution should be developed for the institution as a whole.');
        $this->set_property($property);
    }

    public function get_2_3_1()
    {
        return $this->get_property('2_3_1')->get_value();
    }

    public function set_2_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_2', $value);
        $property->set_description('2.3.2 Planning is strategic, incorporating priorities for development and appropriate sequencing of action to produce the most effective short-term and long term-results.');
        $this->set_property($property);
    }

    public function get_2_3_2()
    {
        return $this->get_property('2_3_2')->get_value();
    }

    public function set_2_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_3', $value);
        $property->set_description('2.3.3 Plans take full and realistic account of aspects of the external environment affecting development of the institution.');
        $this->set_property($property);
    }

    public function get_2_3_3()
    {
        return $this->get_property('2_3_3')->get_value();
    }

    public function set_2_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_4', $value);
        $property->set_description('2.3.4 The processes for developing major plans for the institution provide for involvement and understanding with stakeholders throughout the institutional community.');
        $this->set_property($property);
    }

    public function get_2_3_4()
    {
        return $this->get_property('2_3_4')->get_value();
    }

    public function set_2_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_5', $value);
        $property->set_description('2.3.5  When major planning decisions are announced they are effectively communicated to all concerned with impacts and requirements for different constituencies made clear.');
        $this->set_property($property);
    }

    public function get_2_3_5()
    {
        return $this->get_property('2_3_5')->get_value();
    }

    public function set_2_3_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_6', $value);
        $property->set_description('2.3.6 Implementation of plans is monitored in relation to short term and medium term targets and outcomes evaluated.');
        $this->set_property($property);
    }

    public function get_2_3_6()
    {
        return $this->get_property('2_3_6')->get_value();
    }

    public function set_2_3_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_7', $value);
        $property->set_description('2.3.7 Plans are reviewed, adapted and modified, and corrective action taken as required in response to operational developments, formative evaluation, and changing circumstances.');
        $this->set_property($property);
    }

    public function get_2_3_7()
    {
        return $this->get_property('2_3_7')->get_value();
    }

    public function set_2_3_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_8', $value);
        $property->set_description('2.3.8 Information management systems provide regular feedback on both ongoing routine activities and progress in strategic initiatives through key performance indicators and other information as required.');
        $this->set_property($property);
    }

    public function get_2_3_8()
    {
        return $this->get_property('2_3_8')->get_value();
    }

    public function set_2_3_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_9', $value);
        $property->set_description('2.3.9 Risk management is included as an integral component of planning strategies with appropriate mechanisms developed for risk assessment and minimization.');
        $this->set_property($property);
    }

    public function get_2_3_9()
    {
        return $this->get_property('2_3_9')->get_value();
    }

    public function set_2_3_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_3_10', $value);
        $property->set_description('2.3.10 Strategic planning is integrated with annual and longer term budget processes with capacity for medium term adjustments as required.');
        $this->set_property($property);
    }

    public function get_2_3_10()
    {
        return $this->get_property('2_3_10')->get_value();
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
        $property->add_property_name('2_3_6');
        $property->add_property_name('2_3_7');
        $property->add_property_name('2_3_8');
        $property->add_property_name('2_3_9');
        $property->add_property_name('2_3_10');

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
