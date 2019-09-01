<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ses_standard_3_overall
 *
 * @author ahmadgx
 */
class Ses_Standard_3_Overall extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Overall Assessment of Management of Program Quality Assurance';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_3_1('');
            $this->set_3_2('');
            $this->set_3_3('');
            $this->set_3_4('');
            $this->set_3_5('');
            $this->set_combined_assessment('');
            $this->set_comment('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
            $this->set_indicators_considered('');
            $this->set_priorities_for_improvement('');
    }

    public function set_3_1($value)
    {
        $property = new \Orm_Property_Smart_Field('3_1', $value);
        $property->set_class('Node\ncassr14\Ses_Standard_3_1');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('3.1 Commitment to Quality Improvement in the Program');
        $this->set_property($property);
    }

    public function get_3_1()
    {
        return $this->get_property('3_1')->get_value();
    }

    public function set_3_2($value)
    {
        $property = new \Orm_Property_Smart_Field('3_2', $value);
        $property->set_class('Node\ncassr14\Ses_Standard_3_2');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('3.2 Scope of Quality Assurance Processes');
        $this->set_property($property);
    }

    public function get_3_2()
    {
        return $this->get_property('3_2')->get_value();
    }

    public function set_3_3($value)
    {
        $property = new \Orm_Property_Smart_Field('3_3', $value);
        $property->set_class('Node\ncassr14\Ses_Standard_3_3');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('3.3 Administration of Quality Assurance Processes');
        $this->set_property($property);
    }

    public function get_3_3()
    {
        return $this->get_property('3_3')->get_value();
    }

    public function set_3_4($value)
    {
        $property = new \Orm_Property_Smart_Field('3_4', $value);
        $property->set_class('Node\ncassr14\Ses_Standard_3_4');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('3.4 Use of Performance Indicators and Benchmarks');
        $this->set_property($property);
    }

    public function get_3_4()
    {
        return $this->get_property('3_4')->get_value();
    }

    public function set_3_5($value)
    {
        $property = new \Orm_Property_Smart_Field('3_5', $value);
        $property->set_class('Node\ncassr14\Ses_Standard_3_5');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('3.5 Independent Verification of Standards');
        $this->set_property($property);
    }

    public function get_3_5()
    {
        return $this->get_property('3_5')->get_value();
    }

    public function set_combined_assessment($value)
    {
        $property = new \Orm_Property_Equation('combined_assessment', $value);
        $property->set_description('Combined Assessment');

        $property->set_node($this);
        $property->set_equation('([3_1]+[3_2]+[3_3]+[3_4]+[3_5])/5');
        $this->set_property($property);
    }

    public function get_combined_assessment()
    {
        return $this->get_property('combined_assessment')->get_value();
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

    public function set_indicators_considered($value)
    {
        $property = new \Orm_Property_Textarea('indicators_considered', $value);
        $property->set_description('Indicators Considered');
        $this->set_property($property);
    }

    public function get_indicators_considered()
    {
        return $this->get_property('indicators_considered')->get_value();
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

    public function header_actions(&$actions = array()) {

        if ($this->check_if_editable()) {
            if(\License::get_instance()->check_module('kpi')) {
                $actions[] = array(
                    'class' => 'btn',
                    'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                    'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
                );
            }
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

        if(\License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {
            $standard = \Orm_Standard::get_one(['code' => 3]);
            $kpis = \Orm_Kpi::get_all(array('standard_id' => $standard->get_id(), 'college_id' => $this->get_parent_college_node()->get_item_id()));
            $indicators = '<ol>';
            foreach ($kpis as $kpi) {
                $benchmarks = $kpi->get_info(\Orm_Kpi_Detail::TYPE_PROGRAM,array('college_id' => $this->get_parent_college_node()->get_item_id(),'program_id' => $this->get_parent_program_node()->get_item_id(),'academic_year' => $this->get_year()));
                $indicators .= '<li>' . $kpi->get_title() . ' Results: ' . $benchmarks['actual_benchmarks'] .'</li>';
            }
            $indicators .= '</ol>';
            $this->set_indicators_considered($indicators);
            $this->save();
        }
    }

}
