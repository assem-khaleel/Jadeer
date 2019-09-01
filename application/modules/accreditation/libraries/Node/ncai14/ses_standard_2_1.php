<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_2_1
 *
 * @author user
 */
class Ses_Standard_2_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.1 Governing Body';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_2_1_1('');
            $this->set_2_1_2('');
            $this->set_2_1_3('');
            $this->set_2_1_4('');
            $this->set_2_1_5('');
            $this->set_2_1_6('');
            $this->set_2_1_7('');
            $this->set_2_1_8('');
            $this->set_2_1_9('');
            $this->set_2_1_10('');
            $this->set_2_1_11('');
            $this->set_2_1_12('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The governing body must operate effectively in the interests of the institution as a whole and the communities it serves.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_1_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_1', $value);
        $property->set_description('2.1.1 The governing body has as its primary objective the effective development of the institution in the interests of its students and the communities it serves.');
        $this->set_property($property);
    }

    public function get_2_1_1()
    {
        return $this->get_property('2_1_1')->get_value();
    }

    public function set_2_1_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_2', $value);
        $property->set_description('2.1.2 Membership of the governing body provides for the range of perspectives and expertise needed to guide the educational policies of the institution.');
        $this->set_property($property);
    }

    public function get_2_1_2()
    {
        return $this->get_property('2_1_2')->get_value();
    }

    public function set_2_1_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_3', $value);
        $property->set_description('2.1.3 Members of the governing body are familiar with the range of activities within the institution and the needs of the communities it serves.');
        $this->set_property($property);
    }

    public function get_2_1_3()
    {
        return $this->get_property('2_1_3')->get_value();
    }

    public function set_2_1_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_4', $value);
        $property->set_description('2.1.4 New members of the governing body are thoroughly inducted into their role with information about the institution and about the role and processes of the governing body itself.');
        $this->set_property($property);
    }

    public function get_2_1_4()
    {
        return $this->get_property('2_1_4')->get_value();
    }

    public function set_2_1_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_5', $value);
        $property->set_description('2.1.5 The governing body periodically reviews the mission, goals and objectives of the institution.');
        $this->set_property($property);
    }

    public function get_2_1_5()
    {
        return $this->get_property('2_1_5')->get_value();
    }

    public function set_2_1_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_6', $value);
        $property->set_description('2.1.6 The governing body ensures that the mission goals and objectives of the institution are reflected in detailed planning and activities.');
        $this->set_property($property);
    }

    public function get_2_1_6()
    {
        return $this->get_property('2_1_6')->get_value();
    }

    public function set_2_1_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_7', $value);
        $property->set_description('2.1.7 The governing body monitors and accepts responsibility for the total operations of the institution, but avoids interference in management or academic affairs.  If there are concerns about detailed  academic matters these are referred back for further consideration but not changed by the governing body itself.');
        $this->set_property($property);
    }

    public function get_2_1_7()
    {
        return $this->get_property('2_1_7')->get_value();
    }

    public function set_2_1_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_8', $value);
        $property->set_description('2.1.8 Sub committees of the governing body (including members of the governing body, senior faculty and staff, and outside persons as appropriate) are established to give detailed consideration to major responsibilities such as finance and budget, staffing policies and remuneration, strategic planning, and facilities.');
        $this->set_property($property);
    }

    public function get_2_1_8()
    {
        return $this->get_property('2_1_8')->get_value();
    }

    public function set_2_1_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_9', $value);
        $property->set_description('2.1.9 Responsibilities are defined in such a way that  the respective roles and responsibilities of the governing body for overall policy and accountability, the senior administration for management, and the academic decision making structures for academic  program development, are clearly differentiated, defined, and followed in practice.');
        $this->set_property($property);
    }

    public function get_2_1_9()
    {
        return $this->get_property('2_1_9')->get_value();
    }

    public function set_2_1_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_10', $value);
        $property->set_description('2.1.10 In a private institution the relative responsibilities of the owners or company directors and the governing body are clearly specified and avoid interference in academic matters.');
        $this->set_property($property);
    }

    public function get_2_1_10()
    {
        return $this->get_property('2_1_10')->get_value();
    }

    public function set_2_1_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_11', $value);
        $property->set_description('2.1.11 In their role as members of the governing body members who are also members of staff of the institution act in the interests of the institution as a whole rather than as representatives of sectional interests.');
        $this->set_property($property);
    }

    public function get_2_1_11()
    {
        return $this->get_property('2_1_11')->get_value();
    }

    public function set_2_1_12($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_1_12', $value);
        $property->set_description('2.1.12 The governing body regularly reviews its own effectiveness and develops plans for improvement in the way it operates.');
        $this->set_property($property);
    }

    public function get_2_1_12()
    {
        return $this->get_property('2_1_12')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('2_1_1');
        $property->add_property_name('2_1_2');
        $property->add_property_name('2_1_3');
        $property->add_property_name('2_1_4');
        $property->add_property_name('2_1_5');
        $property->add_property_name('2_1_6');
        $property->add_property_name('2_1_7');
        $property->add_property_name('2_1_8');
        $property->add_property_name('2_1_9');
        $property->add_property_name('2_1_10');
        $property->add_property_name('2_1_11');
        $property->add_property_name('2_1_12');
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
