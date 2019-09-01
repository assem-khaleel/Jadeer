<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_3_3
 *
 * @author user
 */
class Ses_Standard_3_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.3 Administration of Quality Assurance Processes';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_3_3_1('');
            $this->set_3_3_2('');
            $this->set_3_3_3('');
            $this->set_3_3_4('');
            $this->set_3_3_5('');
            $this->set_3_3_6('');
            $this->set_3_3_7('');
            $this->set_3_3_8('');
            $this->set_3_3_9('');
            $this->set_3_3_10('');
            $this->set_3_3_11('');
            $this->set_3_3_12('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The institution must make adequate arrangements for the leadership and administrative support for quality assurance processes throughout the organization.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_3_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_1', $value);
        $property->set_description('3.3.1 A senior member of faculty is assigned responsibility and given a sufficient time allowance to provide guidance and support for the quality processes within the institution.');
        $this->set_property($property);
    }

    public function get_3_3_1()
    {
        return $this->get_property('3_3_1')->get_value();
    }

    public function set_3_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_2', $value);
        $property->set_description("3.3.2 A quality center is established within the institution's central administration and given sufficient staff and resources to operate effectively.");
        $this->set_property($property);
    }

    public function get_3_3_2()
    {
        return $this->get_property('3_3_2')->get_value();
    }

    public function set_3_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_3', $value);
        $property->set_description('3.3.3 A quality committee is formed with members drawn from all major sections of the institution. As a general guideline this might involve 12 to 15 members and in a large institution might require representatives from groups of Colleges in similar fields rather than from each college.');
        $this->set_property($property);
    }

    public function get_3_3_3()
    {
        return $this->get_property('3_3_3')->get_value();
    }

    public function set_3_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_4', $value);
        $property->set_description("3.3.4 The committee is chaired by a member of the institution's senior administration who works closely with the director of the quality center in guiding and supporting quality initiatives throughout the institution.");
        $this->set_property($property);
    }

    public function get_3_3_4()
    {
        return $this->get_property('3_3_4')->get_value();
    }

    public function set_3_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_5', $value);
        $property->set_description('3.3.5 The roles and responsibilities of the head of the quality centre, the centre itself, and the quality committee are formally defined and their relationship with other planning and administrative units made clear.');
        $this->set_property($property);
    }

    public function get_3_3_5()
    {
        return $this->get_property('3_3_5')->get_value();
    }

    public function set_3_3_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_6', $value);
        $property->set_description('3.3.6 If quality assurance functions are managed by more than one organizational unit, the activities of these units are effectively coordinated under the supervision of a senior administrator.');
        $this->set_property($property);
    }

    public function get_3_3_6()
    {
        return $this->get_property('3_3_6')->get_value();
    }

    public function set_3_3_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_7', $value);
        $property->set_description("3.3.7 The institution's quality assurance system is fully integrated into normal planning and development strategies in a defined cycle of planning, implementation, assessment and review.");
        $this->set_property($property);
    }

    public function get_3_3_7()
    {
        return $this->get_property('3_3_7')->get_value();
    }

    public function set_3_3_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_8', $value);
        $property->set_description('3.3.8 Evaluations are (i) based on evidence, (ii) linked to appropriate standards, (iii) include consideration of predetermined indicators, and (iv) take account of independent verification of interpretations.');
        $this->set_property($property);
    }

    public function get_3_3_8()
    {
        return $this->get_property('3_3_8')->get_value();
    }

    public function set_3_3_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_9', $value);
        $property->set_description('3.3.9 Common forms and survey instruments are prepared for use for similar activities across the institution (eg. programs, courses, libraries etc.) and responses used in independent analyses of results including trends over time. (This does not preclude additional questions relevant to different programs or special instruments dealing with particular functions eg. specialized libraries or student services)');
        $this->set_property($property);
    }

    public function get_3_3_9()
    {
        return $this->get_property('3_3_9')->get_value();
    }

    public function set_3_3_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_10', $value);
        $property->set_description('3.3.10 Statistical data (including pass rates, progression and completion rates and other data required for indicators) are retained in a central data base and provided routinely and promptly to colleges and departments (normally each semester or at least annually) for their use in preparation of reports on indicators and other tasks in monitoring quality.');
        $this->set_property($property);
    }

    public function get_3_3_10()
    {
        return $this->get_property('3_3_10')->get_value();
    }

    public function set_3_3_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_11', $value);
        $property->set_description('3.3.11 The administrative arrangements and processes used for quality assurance in the institution are evaluated and reported on in a way that is comparable to the quality assurance processes for other functions and organizational units.');
        $this->set_property($property);
    }

    public function get_3_3_11()
    {
        return $this->get_property('3_3_11')->get_value();
    }

    public function set_3_3_12($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_12', $value);
        $property->set_description('3.3.12 Processes for evaluation of quality should be transparent with criteria for judgments and evidence considered made clear.');
        $this->set_property($property);
    }

    public function get_3_3_12()
    {
        return $this->get_property('3_3_12')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('3_3_1');
        $property->add_property_name('3_3_2');
        $property->add_property_name('3_3_3');
        $property->add_property_name('3_3_4');
        $property->add_property_name('3_3_5');
        $property->add_property_name('3_3_6');
        $property->add_property_name('3_3_7');
        $property->add_property_name('3_3_8');
        $property->add_property_name('3_3_9');
        $property->add_property_name('3_3_10');
        $property->add_property_name('3_3_11');
        $property->add_property_name('3_3_12');
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
