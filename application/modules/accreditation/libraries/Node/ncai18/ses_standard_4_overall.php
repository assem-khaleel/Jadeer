<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_4_Overall
 *
 * @author user
 */
class Ses_Standard_4_Overall extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Overall Assessment of Learning and Teaching';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_4_1('');
            $this->set_4_2('');
            $this->set_4_3('');
            $this->set_4_4('');
            $this->set_4_5('');
            $this->set_4_6('');
            $this->set_4_7('');
            $this->set_4_8('');
            $this->set_4_9('');
            $this->set_4_10('');
            $this->set_4_11('');
            $this->set_combined_assessment('');
            $this->set_comment('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
            $this->set_indicators_considered('');
            $this->set_priorities_for_improvement('');
    }

    public function set_4_1($value)
    {
        $property = new \Orm_Property_Smart_Field('4_1', $value);
        $property->set_class('Node\ncai18\Ses_Standard_4_1');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('4.1 Institutional Oversight of Quality of Learning and Teaching');
        $this->set_property($property);
    }

    public function get_4_1()
    {
        return $this->get_property('4_1')->get_value();
    }

    public function set_4_2($value)
    {
        $property = new \Orm_Property_Smart_Field('4_2', $value);
        $property->set_class('Node\ncai18\Ses_Standard_4_2');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('4.2 Student Learning Outcomes');
        $this->set_property($property);
    }

    public function get_4_2()
    {
        return $this->get_property('4_2')->get_value();
    }

    public function set_4_3($value)
    {
        $property = new \Orm_Property_Smart_Field('4_3', $value);
        $property->set_class('Node\ncai18\Ses_Standard_4_3');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('4.3 Program Development Processes');
        $this->set_property($property);
    }

    public function get_4_3()
    {
        return $this->get_property('4_3')->get_value();
    }

    public function set_4_4($value)
    {
        $property = new \Orm_Property_Smart_Field('4_4', $value);
        $property->set_class('Node\ncai18\Ses_Standard_4_4');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('4.4 Program Evaluation and Review Processes');
        $this->set_property($property);
    }

    public function get_4_4()
    {
        return $this->get_property('4_4')->get_value();
    }

    public function set_4_5($value)
    {
        $property = new \Orm_Property_Smart_Field('4_5', $value);
        $property->set_class('Node\ncai18\Ses_Standard_4_5');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('4.5 Student Assessment');
        $this->set_property($property);
    }

    public function get_4_5()
    {
        return $this->get_property('4_5')->get_value();
    }

    public function set_4_6($value)
    {
        $property = new \Orm_Property_Smart_Field('4_6', $value);
        $property->set_class('Node\ncai18\Ses_Standard_4_6');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('4.6 Educational Assistance for Students');
        $this->set_property($property);
    }

    public function get_4_6()
    {
        return $this->get_property('4_6')->get_value();
    }

    public function set_4_7($value)
    {
        $property = new \Orm_Property_Smart_Field('4_7', $value);
        $property->set_class('Node\ncai18\Ses_Standard_4_7');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('4.7 Quality of Teaching');
        $this->set_property($property);
    }

    public function get_4_7()
    {
        return $this->get_property('4_7')->get_value();
    }

    public function set_4_8($value)
    {
        $property = new \Orm_Property_Smart_Field('4_8', $value);
        $property->set_class('Node\ncai18\Ses_Standard_4_8');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('4.8 Support for Improvements in Quality of Teaching');
        $this->set_property($property);
    }

    public function get_4_8()
    {
        return $this->get_property('4_8')->get_value();
    }

    public function set_4_9($value)
    {
        $property = new \Orm_Property_Smart_Field('4_9', $value);
        $property->set_class('Node\ncai18\Ses_Standard_4_9');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('4.9 Qualifications and Experience of Teaching Staff');
        $this->set_property($property);
    }

    public function get_4_9()
    {
        return $this->get_property('4_9')->get_value();
    }

    public function set_4_10($value)
    {
        $property = new \Orm_Property_Smart_Field('4_10', $value);
        $property->set_class('Node\ncai18\Ses_Standard_4_10');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('4.10 Field Experience Activities');
        $this->set_property($property);
    }

    public function get_4_10()
    {
        return $this->get_property('4_10')->get_value();
    }

    public function set_4_11($value)
    {
        $property = new \Orm_Property_Smart_Field('4_11', $value);
        $property->set_class('Node\ncai18\Ses_Standard_4_11');
        $property->set_function('get_overall_assessment');
        $property->add_filter('system_number', $this->get_system_obj()->get_system_number());
        $property->add_filter('parent_lft', $this->get_system_obj()->get_parent_lft());
        $property->add_filter('parent_rgt', $this->get_system_obj()->get_parent_rgt());
        $property->set_description('4.11 Partnership Arrangements With Other Institutions');

        $this->set_property($property);
    }

    public function get_4_11()
    {
        return $this->get_property('4_11')->get_value();
    }

    public function set_combined_assessment($value)
    {
        $property = new \Orm_Property_Equation('combined_assessment', $value);
        $property->set_description('Combined Assessment');

        $property->set_node($this);
        $property->set_equation('([4_1]+[4_2]+[4_3]+[4_4]+[4_5]+[4_6]+[4_7]+[4_8]+[4_9]+[4_10]+[4_11])/11');

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
            $standard = \Orm_Standard::get_one(['code' => 4]);
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
