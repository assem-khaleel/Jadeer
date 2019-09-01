<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_6_overall
 *
 * @author ahmadgx
 */
class Ses_Standard_6_Overall extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Overall Assessment of Learning Resources';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_6_1('');
            $this->set_6_2('');
            $this->set_6_3('');
            $this->set_6_4('');
            $this->set_combined_assessment('');
            $this->set_comment('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
            $this->set_indicators_considered('');
            $this->set_priorities_for_improvement('');
    }

    public function set_6_1($value)
    {
        $property = new \Orm_Property_Smart_Field('6_1', $value);
        $property->set_class('Node\ncassr18\Ses_Standard_6_1');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('6.1 Planning and Evaluation');
        $this->set_property($property);
    }

    public function get_6_1()
    {
        return $this->get_property('6_1')->get_value();
    }

    public function set_6_2($value)
    {
        $property = new \Orm_Property_Smart_Field('6_2', $value);
        $property->set_class('Node\ncassr18\Ses_Standard_6_2');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('6.2 Organization');
        $this->set_property($property);
    }

    public function get_6_2()
    {
        return $this->get_property('6_2')->get_value();
    }

    public function set_6_3($value)
    {
        $property = new \Orm_Property_Smart_Field('6_3', $value);
        $property->set_class('Node\ncassr18\Ses_Standard_6_3');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('6.3 Support for Users');
        $this->set_property($property);
    }

    public function get_6_3()
    {
        return $this->get_property('6_3')->get_value();
    }

    public function set_6_4($value)
    {
        $property = new \Orm_Property_Smart_Field('6_4', $value);
        $property->set_class('Node\ncassr18\Ses_Standard_6_4');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_parent_program_node()->get_system_number());
        $property->add_filter('parent_lft', $this->get_parent_program_node()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_parent_program_node()->get_parent_rgt());
        $property->set_description('6.4 Resources and Facilities');
        $this->set_property($property);
    }

    public function get_6_4()
    {
        return $this->get_property('6_4')->get_value();
    }

    public function set_combined_assessment($value)
    {
        $property = new \Orm_Property_Equation('combined_assessment', $value);
        $property->set_description('Combined Assessment');

        $property->set_node($this);
        $property->set_equation('([6_1]+[6_2]+[6_3]+[6_4])/4');
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
            $standard = \Orm_Standard::get_one(['code' => 6]);
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
