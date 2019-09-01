<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ses_Standard_5_Overall
 *
 * @author user
 */
class Ses_Standard_5_Overall extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Overall Assessment of Student Administration and Support Services';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_5_1('');
            $this->set_5_2('');
            $this->set_5_3('');
            $this->set_5_4('');
            $this->set_5_5('');
            $this->set_5_6('');
            $this->set_combined_assessment('');
            $this->set_comment('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
            $this->set_indicators_considered('');
            $this->set_priorities_for_improvement('');
    }

    public function set_5_1($value)
    {
        $property = new \Orm_Property_Smart_Field('5_1', $value);
        $property->set_class('Node\ncai14\Ses_Standard_5_1');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('5.1 Student Admissionst');
        $this->set_property($property);
    }

    public function get_5_1()
    {
        return $this->get_property('5_1')->get_value();
    }

    public function set_5_2($value)
    {
        $property = new \Orm_Property_Smart_Field('5_2', $value);
        $property->set_class('Node\ncai14\Ses_Standard_5_2');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('5.2 Student Records');
        $this->set_property($property);
    }

    public function get_5_2()
    {
        return $this->get_property('5_2')->get_value();
    }

    public function set_5_3($value)
    {
        $property = new \Orm_Property_Smart_Field('5_3', $value);
        $property->set_class('Node\ncai14\Ses_Standard_5_3');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('5.3 Student Management');
        $this->set_property($property);
    }

    public function get_5_3()
    {
        return $this->get_property('5_3')->get_value();
    }

    public function set_5_4($value)
    {
        $property = new \Orm_Property_Smart_Field('5_4', $value);
        $property->set_class('Node\ncai14\Ses_Standard_5_4');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('5.4 Planning and Evaluation of Student Services');
        $this->set_property($property);
    }

    public function get_5_4()
    {
        return $this->get_property('5_4')->get_value();
    }

    public function set_5_5($value)
    {
        $property = new \Orm_Property_Smart_Field('5_5', $value);
        $property->set_class('Node\ncai14\Ses_Standard_5_5');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('5.5 Medical and Counselling Services');
        $this->set_property($property);
    }

    public function get_5_5()
    {
        return $this->get_property('5_5')->get_value();
    }

    public function set_5_6($value)
    {
        $property = new \Orm_Property_Smart_Field('5_6', $value);
        $property->set_class('Node\ncai14\Ses_Standard_5_6');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('5.6 Extra-curricular Activities for Students');
        $this->set_property($property);
    }

    public function get_5_6()
    {
        return $this->get_property('5_6')->get_value();
    }

    public function set_combined_assessment($value)
    {
        $property = new \Orm_Property_Equation('combined_assessment', $value);
        $property->set_description('Combined Assessment');

        $property->set_node($this);
        $property->set_equation('([5_1]+[5_2]+[5_3]+[5_4]+[5_5]+[5_6])/6');

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
            $standard = \Orm_Standard::get_one(['code' => 5]);
            $kpis = \Orm_Kpi::get_all(array('standard_id' => $standard->get_id(), 'college_id' => 0));
            $indicators = '<ol>';
            foreach ($kpis as $kpi) {
                $benchmarks = $kpi->get_info(\Orm_Kpi_Detail::TYPE_INSTITUTION,array('academic_year' => $this->get_year()));
                $indicators .= '<li>' . $kpi->get_title() . ' Results: ' . $benchmarks['actual_benchmarks'] .'</li>';
            }
            $indicators .= '</ol>';
            $this->set_indicators_considered($indicators);
            $this->save();
        }
    }

}
