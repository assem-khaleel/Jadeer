<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of ses_standard_4_10
 *
 * @author user
 */
class Ses_Standard_4_10 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.10 Field Experience Activities';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_10_1('');
            $this->set_4_10_2('');
            $this->set_4_10_3('');
            $this->set_4_10_4('');
            $this->set_4_10_5('');
            $this->set_4_10_6('');
            $this->set_4_10_7('');
            $this->set_4_10_8('');
            $this->set_4_10_9('');
            $this->set_4_10_10('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '(Field experience includes any work based activity such as internships, cooperative training, practicums, clinical placements or other activities in a work or clinical setting under the supervision of staff employed in that work or professional setting)<br/><br/><strong> In programs that include field experience activities, the field experience activities must be planned and administered as fully integrated components of the program, with learning outcomes specified, supervising staff considered as members of teaching teams, and appropriate evaluation and course improvement strategies carried out.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_10_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_1', $value);
        $property->set_description('4.10.1 In programs that include field experience activities the student learning to be developed through that experience is clearly specified and appropriate steps taken to ensure that those learning outcomes and expected experiences to develop that learning are understood by students and supervising staff in the field setting');
        $this->set_property($property);
    }

    public function get_4_10_1()
    {
        return $this->get_property('4_10_1')->get_value();
    }

    public function set_4_10_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_2', $value);
        $property->set_description('4.10.2 Supervising staff in field locations are thoroughly briefed on their role and the relationship of the field experience to the program as a whole.');
        $this->set_property($property);
    }

    public function get_4_10_2()
    {
        return $this->get_property('4_10_2')->get_value();
    }

    public function set_4_10_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_3', $value);
        $property->set_description('4.10.3 Teaching staff from the institution should visit the field setting for observations and consultations with students and field supervisors often enough to provide proper oversight and support. (Normally at least twice during a field experience activity)');
        $this->set_property($property);
    }

    public function get_4_10_3()
    {
        return $this->get_property('4_10_3')->get_value();
    }

    public function set_4_10_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_4', $value);
        $property->set_description('4.10.4 Students are thoroughly prepared through briefings and descriptive material for participation in the field experience.');
        $this->set_property($property);
    }

    public function get_4_10_4()
    {
        return $this->get_property('4_10_4')->get_value();
    }

    public function set_4_10_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_5', $value);
        $property->set_description('4.10.5 Students should be required to prepare a report on their field experience that is appropriate for the nature of the activity and the learning outcomes expected.');
        $this->set_property($property);
    }

    public function get_4_10_5()
    {
        return $this->get_property('4_10_5')->get_value();
    }

    public function set_4_10_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_6', $value);
        $property->set_description('4.10.6 Follow up meetings or classes are organized in which students can reflect on and generalize from their experience');
        $this->set_property($property);
    }

    public function get_4_10_6()
    {
        return $this->get_property('4_10_6')->get_value();
    }

    public function set_4_10_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_7', $value);
        $property->set_description('4.10.7 Field experience placements are selected because of their capacity to develop the learning outcomes sought and their effectiveness in doing so is evaluated.');
        $this->set_property($property);
    }

    public function get_4_10_7()
    {
        return $this->get_property('4_10_7')->get_value();
    }

    public function set_4_10_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_8', $value);
        $property->set_description('4.10.8 In situations where the supervisors in the field setting and teaching staff from the institution are both involved in student assessments, criteria for assessment are clearly specified and explained, and procedures established for reconciling differing opinions.');
        $this->set_property($property);
    }

    public function get_4_10_8()
    {
        return $this->get_property('4_10_8')->get_value();
    }

    public function set_4_10_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_9', $value);
        $property->set_description('4.10.9 Provision is made for evaluations of the field experience activity (i) by students, (ii) by supervising staff in the field setting, and (iii) by staff of the institution, and results of those evaluations considered in subsequent planning.');
        $this->set_property($property);
    }

    public function get_4_10_9()
    {
        return $this->get_property('4_10_9')->get_value();
    }

    public function set_4_10_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_10_10', $value);
        $property->set_description('4.10.10 Preparation for the field experience includes thorough risk assessment for all parties involved, and planning to minimize and deal with those risks.');
        $this->set_property($property);
    }

    public function get_4_10_10()
    {
        return $this->get_property('4_10_10')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_10_1');
        $property->add_property_name('4_10_2');
        $property->add_property_name('4_10_3');
        $property->add_property_name('4_10_4');
        $property->add_property_name('4_10_5');
        $property->add_property_name('4_10_6');
        $property->add_property_name('4_10_7');
        $property->add_property_name('4_10_8');
        $property->add_property_name('4_10_9');
        $property->add_property_name('4_10_10');
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
