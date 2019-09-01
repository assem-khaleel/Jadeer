<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_4_9
 *
 * @author ahmadgx
 */
class Ses_Standard_4_9 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.9 Field Experience Activities';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_9_1('');
            $this->set_4_9_2('');
            $this->set_4_9_3('');
            $this->set_4_9_4('');
            $this->set_4_9_5('');
            $this->set_4_9_6('');
            $this->set_4_9_7('');
            $this->set_4_9_8('');
            $this->set_4_9_9('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>In programs that include field experience activities, the field experience activities must be planned and administered as fully integrated components of the program, with learning outcomes specified, supervising staff considered as members of teaching teams, and appropriate evaluation and course improvement strategies carried out. (Field experience includes any work based activity such as internships, cooperative training, practicums, clinical placements or other activities in a work or clinical setting under the supervision of staff employed in that work or professional setting)</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_9_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_1', $value);
        $property->set_description('4.9.1 In programs that include field experience activities the student learning to be developed through that experience is clearly specified and appropriate steps taken to ensure that those learning outcomes and expected experiences to develop that learning are understood by students and supervising staff in the field setting.');
        $this->set_property($property);
    }

    public function get_4_9_1()
    {
        return $this->get_property('4_9_1')->get_value();
    }

    public function set_4_9_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_2', $value);
        $property->set_description('4.9.2 Supervising staff in field locations are thoroughly briefed on their role and the relationship of the field experience to the program as a whole.');
        $this->set_property($property);
    }

    public function get_4_9_2()
    {
        return $this->get_property('4_9_2')->get_value();
    }

    public function set_4_9_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_3', $value);
        $property->set_description('4.9.3 Teaching staff from the program visit the field setting for observations and consultations with students and field supervisors often enough to provide proper oversight and support. (Normally at least twice during a field experience activity)');
        $this->set_property($property);
    }

    public function get_4_9_3()
    {
        return $this->get_property('4_9_3')->get_value();
    }

    public function set_4_9_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_4', $value);
        $property->set_description('4.9.4 Students are thoroughly prepared through briefings and descriptive material for participation in the field experience.');
        $this->set_property($property);
    }

    public function get_4_9_4()
    {
        return $this->get_property('4_9_4')->get_value();
    }

    public function set_4_9_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_5', $value);
        $property->set_description('4.9.5 Follow up meetings or classes are organized in which students can reflect on and generalize from their experience.');
        $this->set_property($property);
    }

    public function get_4_9_5()
    {
        return $this->get_property('4_9_5')->get_value();
    }

    public function set_4_9_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_6', $value);
        $property->set_description('4.9.6 Field experience placements are selected because of their capacity to develop the learning outcomes sought and their effectiveness in doing so is evaluated.');
        $this->set_property($property);
    }

    public function get_4_9_6()
    {
        return $this->get_property('4_9_6')->get_value();
    }

    public function set_4_9_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_7', $value);
        $property->set_description('4.9.7 In situations where the supervisors in the field setting and faculty from the institution are both involved in student assessments, criteria for assessment are clearly specified and explained, and procedures established for reconciling differing opinions.');
        $this->set_property($property);
    }

    public function get_4_9_7()
    {
        return $this->get_property('4_9_7')->get_value();
    }

    public function set_4_9_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_8', $value);
        $property->set_description('4.9.8 Provision is made for evaluations of the field experience activity by students, by supervising staff in the field setting, and by faculty of the post secondary institution, and results of those evaluations considered in subsequent planning.');
        $this->set_property($property);
    }

    public function get_4_9_8()
    {
        return $this->get_property('4_9_8')->get_value();
    }

    public function set_4_9_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_9_9', $value);
        $property->set_description('4.9.9 Preparation for the field experience includes thorough risk assessment for all parties involved, and planning to minimize and deal with those risks.');
        $this->set_property($property);
    }

    public function get_4_9_9()
    {
        return $this->get_property('4_9_9')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_9_1');
        $property->add_property_name('4_9_2');
        $property->add_property_name('4_9_3');
        $property->add_property_name('4_9_4');
        $property->add_property_name('4_9_5');
        $property->add_property_name('4_9_6');
        $property->add_property_name('4_9_7');
        $property->add_property_name('4_9_8');
        $property->add_property_name('4_9_9');

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
