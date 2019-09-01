<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_2_2
 *
 * @author user
 */
class Ses_Standard_2_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.2 Leadership';
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
            $this->set_2_2_10('');
            $this->set_2_2_11('');
            $this->set_2_2_12('');
            $this->set_2_2_13('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', "<strong>The institution's administrators must provide effective and responsible leadership for the development and improvement of the institution.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.");
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_2_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_1', $value);
        $property->set_description('2.2.1 The responsibilities of administrators are clearly defined in position descriptions.');
        $this->set_property($property);
    }

    public function get_2_2_1()
    {
        return $this->get_property('2_2_1')->get_value();
    }

    public function set_2_2_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_2', $value);
        $property->set_description('2.2.2 Senior administrators (including the Rector or Dean and others throughout the institution) anticipate emerging issues and opportunities and exercise initiative in response.');
        $this->set_property($property);
    }

    public function get_2_2_2()
    {
        return $this->get_property('2_2_2')->get_value();
    }

    public function set_2_2_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_3', $value);
        $property->set_description('2.2.3 Administrators ensure that action needed in their area of responsibility is taken in an effective and timely manner.');
        $this->set_property($property);
    }

    public function get_2_2_3()
    {
        return $this->get_property('2_2_3')->get_value();
    }

    public function set_2_2_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_4', $value);
        $property->set_description('2.2.4 The levels of supervision and approval for academic affairs provide for monitoring of quality and approval of major changes by senior administrators and the senior academic committee while allowing appropriate flexibility at course and program levels.(eg. Departments  have delegated authority to change text and reference lists, modify planned teaching strategies, details of assessment tasks and updating of course content as far as possible subject to conditions set by the university council or other appropriate authority.) (see also section 4.1.3)');
        $this->set_property($property);
    }

    public function get_2_2_4()
    {
        return $this->get_property('2_2_4')->get_value();
    }

    public function set_2_2_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_5', $value);
        $property->set_description('2.2.5 Administrators encourage teamwork and cooperation in achievement of institutional goals and objectives within their area of responsibility.');
        $this->set_property($property);
    }

    public function get_2_2_5()
    {
        return $this->get_property('2_2_5')->get_value();
    }

    public function set_2_2_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_6', $value);
        $property->set_description('2.2.6 Administrators at all levels in the institution work cooperatively with colleagues in other sections of the institution to ensure effective overall functioning of the total institution.');
        $this->set_property($property);
    }

    public function get_2_2_6()
    {
        return $this->get_property('2_2_6')->get_value();
    }

    public function set_2_2_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_7', $value);
        $property->set_description('2.2.7 Administrators at all levels accept responsibility for the quality and effectiveness of activities within their area of responsibility regardless of whether those activities are undertaken by them personally or by others responsible to them.');
        $this->set_property($property);
    }

    public function get_2_2_7()
    {
        return $this->get_property('2_2_7')->get_value();
    }

    public function set_2_2_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_8', $value);
        $property->set_description('2.2.8 When responsibilities are delegated to others this is done appropriately within a clearly defined reporting and accountability framework.');
        $this->set_property($property);
    }

    public function get_2_2_8()
    {
        return $this->get_property('2_2_8')->get_value();
    }

    public function set_2_2_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_9', $value);
        $property->set_description('2.2.9 Delegations are formally specified in documents signed by the person delegating and the person given delegated authority, and that describe clearly the limits of delegated responsibility and responsibility for reporting on decisions made.');
        $this->set_property($property);
    }

    public function get_2_2_9()
    {
        return $this->get_property('2_2_9')->get_value();
    }

    public function set_2_2_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_10', $value);
        $property->set_description('2.2.10 Regulations governing delegations of authority are established for the institution and approved by the governing board. These regulations indicate key functions that cannot be delegated, and specify that delegation of authority to another person or organization does not remove responsibility for consequences of decisions made from the person giving the delegation.');
        $this->set_property($property);
    }

    public function get_2_2_10()
    {
        return $this->get_property('2_2_10')->get_value();
    }

    public function set_2_2_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_11', $value);
        $property->set_description('2.2.11 Administrators provide leadership and encourage and reward initiative on the part of subordinates within clear policy guidelines');
        $this->set_property($property);
    }

    public function get_2_2_11()
    {
        return $this->get_property('2_2_11')->get_value();
    }

    public function set_2_2_12($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_12', $value);
        $property->set_description('2.2.12 Regular and constructive feedback is given on performance of subordinates in a manner that contributes to their personal and professional development');
        $this->set_property($property);
    }

    public function get_2_2_12()
    {
        return $this->get_property('2_2_13')->get_value();
    }

    public function set_2_2_13($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_2_13', $value);
        $property->set_description('2.2.13 Senior administrators ensure that submissions to the governing body are fully documented and presented in a form that clearly identifies the policy issues for decision and the consequences of alternatives.');
        $this->set_property($property);
    }

    public function get_2_2_13()
    {
        return $this->get_property('2_2_13')->get_value();
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
        $property->add_property_name('2_2_10');
        $property->add_property_name('2_2_11');
        $property->add_property_name('2_2_12');
        $property->add_property_name('2_2_13');

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
