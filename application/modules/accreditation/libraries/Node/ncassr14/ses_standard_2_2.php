<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_2_2
 *
 * @author ahmadgx
 */
class Ses_Standard_2_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.2 Planning Processes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_2_2_1('');
            $this->set_2_2_2('');
            $this->set_2_2_3('');
            $this->set_2_2_4('');
            $this->set_2_2_5('');
            $this->set_2_2_6('');
            $this->set_2_2_7('');
            $this->set_2_2_8('');
            $this->set_2_2_9('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Planning processes must be managed effectively to achieve the mission and goals of the program through cooperative action by the instructional team, and program and course reporting and decision making.  Planning must combine coordinated strategic planning with flexibility to adapt to results achieved and changing circumstances.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_1', $value);
        $property->set_description('2.2.1 Planning is strategic, incorporating priorities for development and appropriate sequencing of action to produce the most effective short-term and long term-results.');
        $this->set_property($property);
    }

    public function get_2_2_1()
    {
        return $this->get_property('2_2_1')->get_value();
    }

    public function set_2_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_2', $value);
        $property->set_description('2.2.2 Plans take full and realistic account of aspects of the external environment affecting demand for graduates and skills required by them.');
        $this->set_property($property);
    }

    public function get_2_2_2()
    {
        return $this->get_property('2_2_2')->get_value();
    }

    public function set_2_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_3', $value);
        $property->set_description('2.2.3 Planning processes provide for appropriate levels of involvement by teaching and other staff, students and other stakeholders.');
        $this->set_property($property);
    }

    public function get_2_2_3()
    {
        return $this->get_property('2_2_3')->get_value();
    }

    public function set_2_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_4', $value);
        $property->set_description('2.2.4 Planning has a particular focus on intended learning outcomes for students with course content and teaching and assessment strategies that reflect both the background of students and theory and research on different kinds of learning. (For advice on the planning of new programs and review and documentation of existing programs refer to Section 2.4.7 in Handbook for Quality Assurance and Accreditation in Saudi Arabia Part 2, Internal Quality Assurance Arrangements.');
        $this->set_property($property);
    }

    public function get_2_2_4()
    {
        return $this->get_property('2_2_4')->get_value();
    }

    public function set_2_2_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_5', $value);
        $property->set_description('2.2.5 Plans are effectively communicated to all concerned with impacts and requirements for different constituencies made clear.');
        $this->set_property($property);
    }

    public function get_2_2_5()
    {
        return $this->get_property('2_2_5')->get_value();
    }

    public function set_2_2_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_6', $value);
        $property->set_description('2.2.6 Implementation of plans is monitored with checks made against short term and medium term targets, and outcomes evaluated.');
        $this->set_property($property);
    }

    public function get_2_2_6()
    {
        return $this->get_property('2_2_6')->get_value();
    }

    public function set_2_2_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_7', $value);
        $property->set_description('2.2.7 Planning provides for reports on key performance indicators to be made on a regular basis to senior management within the institution.');
        $this->set_property($property);
    }

    public function get_2_2_7()
    {
        return $this->get_property('2_2_7')->get_value();
    }

    public function set_2_2_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_8', $value);
        $property->set_description('2.2.8 Plans are reviewed, adapted and modified, with corrective action taken as required in response to operational developments, formative evaluation, and changing circumstances.');
        $this->set_property($property);
    }

    public function get_2_2_8()
    {
        return $this->get_property('2_2_8')->get_value();
    }

    public function set_2_2_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_9', $value);
        $property->set_description('2.2.9 Risk management is included as an integral component of planning strategies with appropriate mechanisms developed for risk assessment and minimization.');
        $this->set_property($property);
    }

    public function get_2_2_9()
    {
        return $this->get_property('2_2_9')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('2_2_1');
        $property->add_property_name('2_2_2');
        $property->add_property_name('2_2_3');
        $property->add_property_name('2_2_4');
        $property->add_property_name('2_2_5');
        $property->add_property_name('2_2_6');
        $property->add_property_name('2_2_7');
        $property->add_property_name('2_2_8');
        $property->add_property_name('2_2_9');
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
