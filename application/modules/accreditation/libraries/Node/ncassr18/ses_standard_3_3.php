<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_3_3
 *
 * @author ahmadgx
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

            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Quality assurance arrangements for the program must be effectively administered and coordinated with the quality assurance arrangements for the institution as a whole.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_3_3_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_1', $value);
        $property->set_description('3.3.1 Quality assurance processes are  fully integrated into normal planning and program delivery arrangements.');
        $this->set_property($property);
    }

    public function get_3_3_1()
    {
        return $this->get_property('3_3_1')->get_value();
    }

    public function set_3_3_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_2', $value);
        $property->set_description('3.3.2 Evaluations are (i) based on evidence, (ii) linked to appropriate standards, (iii) include predetermined performance indicators, and (iv) take account of independent verification of interpretations.');
        $this->set_property($property);
    }

    public function get_3_3_2()
    {
        return $this->get_property('3_3_2')->get_value();
    }

    public function set_3_3_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_3', $value);
        $property->set_description('3.3.3 Quality assurance processes make use of standard forms and survey instruments for use across the institution with any special additional elements added to meet the particular requirements of the program.');
        $this->set_property($property);
    }

    public function get_3_3_3()
    {
        return $this->get_property('3_3_3')->get_value();
    }

    public function set_3_3_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_4', $value);
        $property->set_description('3.3.4 Survey data is collected from students and analysed for individual courses, the program as.a whole, and also from graduates and employers of those graduates.');
        $this->set_property($property);
    }

    public function get_3_3_4()
    {
        return $this->get_property('3_3_4')->get_value();
    }

    public function set_3_3_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_5', $value);
        $property->set_description('3.3.5 Statistical data on indicators, including grade distributions, progression and completion rates are retained in an accessible central data base and regularly reviewed and reported in annual. program reports');
        $this->set_property($property);
    }

    public function get_3_3_5()
    {
        return $this->get_property('3_3_5')->get_value();
    }

    public function set_3_3_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_6', $value);
        $property->set_description('3.3.6 Responsibility is given to a member of the teaching staff to provide leadership and support for the management of quality assurance processes.  The responsible person should involve other staff in planning and carrying out the quality assurance processes.');
        $this->set_property($property);
    }

    public function get_3_3_6()
    {
        return $this->get_property('3_3_6')->get_value();
    }

    public function set_3_3_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_7', $value);
        $property->set_description('3.3.7 The quality assurance arrangements for the program should be regularly evaluated and improved.  As part of these reviews unnecessary requirements should be removed to streamline the system and avoid unnecessary work');
        $this->set_property($property);
    }

    public function get_3_3_7()
    {
        return $this->get_property('3_3_7')->get_value();
    }

    public function set_3_3_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('3_3_8', $value);
        $property->set_description('3.3.8 Processes for evaluation of quality should be transparent with criteria for judgments and evidence considered made clear');
        $this->set_property($property);
    }

    public function get_3_3_8()
    {
        return $this->get_property('3_3_8')->get_value();
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
