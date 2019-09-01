<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_g
 *
 * @author ahmadgx
 */
class Ssr_G extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'G. Program Developments';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_list('');
            $this->set_comparison(array());
            $this->set_analysis('');
    }

    public function set_list($value)
    {
        $property = new \Orm_Property_Textarea('list', $value);
        $property->set_description('1. Provide a list of changes made in the program in the period since the previous self-study or since the program was introduced.  This should include such things as courses added or deleted or significant changes in their content, changes in approaches to teaching or student assessment, or program evaluation processes etc.');
        $this->set_property($property);
    }

    public function get_list()
    {
        return $this->get_property('list')->get_value();
    }

    public function set_comparison($value)
    {
        $property = new \Orm_Property_Table_Dynamic('comparison', $value);
        $property->set_description('2. Comparison of planned and actual enrollments table.');

        $year = new \Orm_Property_Text('year');
        $year->set_description('Year');
        $year->set_width(230);
        $property->add_property($year);

        $planned_enrollment = new \Orm_Property_Text('planned_enrollment');
        $planned_enrollment->set_description('Planned Enrollment');
        $planned_enrollment->set_width(230);
        $property->add_property($planned_enrollment);

        $actual_enrollment = new \Orm_Property_Text('actual_enrollment');
        $actual_enrollment->set_description('Actual Enrollment');
        $actual_enrollment->set_width(230);
        $property->add_property($actual_enrollment);

        $this->set_property($property);
    }

    public function get_comparison()
    {
        return $this->get_property('comparison')->get_value();
    }

    public function set_analysis($value)
    {
        $property = new \Orm_Property_Textarea('analysis', $value);
        $property->set_description('Provide analysis and an explanation report if there are significant differences between planned and actual numbers.');
        $this->set_property($property);
    }

    public function get_analysis()
    {
        return $this->get_property('analysis')->get_value();
    }

}
