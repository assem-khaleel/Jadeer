<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of kpi
 *
 * @author ahmadgx
 */
class Kpi extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();


            $this->set_standard(0);
            $this->set_kpi_id(0);
            $this->set_kpi_desc('');
            $this->set_kpi_info('');
            $this->set_kpi_ref_num('');
            $this->set_target('');
            $this->set_actual('');
            $this->set_internal('');
            $this->set_external('');
            $this->set_new_target('');
            $this->set_kpi_analysis('');
            $this->set_explain();
            $this->set_provide_internal_benchmark('');
            $this->set_calculations_of_internal_benchmark('');
            $this->set_provider_of_internal_benchmark('');
            $this->set_explain_2();
            $this->set_provide_external_benchmark('');
            $this->set_calculations_of_external_benchmark('');
            $this->set_provider_of_external_benchmark('');
    }

    public function set_standard($value)
    {
        $property = new \Orm_Property_Hidden('standard', $value);
        $this->set_property($property);
    }

    public function get_standard()
    {
        return $this->get_property('standard')->get_value();
    }

    public function set_kpi_id($value)
    {
        $property = new \Orm_Property_Hidden('kpi_id', $value);
        $this->set_property($property);
    }

    public function get_kpi_id()
    {
        return $this->get_property('kpi_id')->get_value();
    }

    public function set_kpi_desc($value)
    {
        $property = new \Orm_Property_Fixedtext('kpi_desc', "<strong>{$value}</strong>");
        $this->set_property($property);
    }

    public function get_kpi_desc()
    {
        return $this->get_property('kpi_desc')->get_value();
    }

    public function set_kpi_info($value)
    {
        $property = new \Orm_Property_Hidden('kpi_info', $value);
        $this->set_property($property);

        if($value) {
            $this->set_kpi_desc($value);
        }
    }

    public function get_kpi_info()
    {
        return $this->get_property('kpi_info')->get_value();
    }

    public function set_kpi_ref_num($value)
    {
        $property = new \Orm_Property_Text('kpi_ref_num', $value);
        $property->set_description(' KPI Reference Number');
        $this->set_property($property);
    }

    public function get_kpi_ref_num()
    {
        return $this->get_property('kpi_ref_num')->get_value();
    }

    public function set_target($value)
    {
        $property = new \Orm_Property_Text('target', $value);
        $property->set_description('KPI Target Benchmark');
        $this->set_property($property);
    }

    public function get_target()
    {
        return $this->get_property('target')->get_value();
    }

    public function set_actual($value)
    {
        $property = new \Orm_Property_Text('actual', $value);
        $property->set_description('KPI Actual Benchmark');
        $this->set_property($property);
    }

    public function get_actual()
    {
        return $this->get_property('actual')->get_value();
    }

    public function set_internal($value)
    {
        $property = new \Orm_Property_Textarea('internal', $value);
        $property->set_enable_tinymce(0);
        $property->set_description('Internal Benchmark');
        $this->set_property($property);
    }

    public function get_internal()
    {
        return $this->get_property('internal')->get_value();
    }

    public function set_external($value)
    {
        $property = new \Orm_Property_Textarea('external', $value);
        $property->set_description('External Benchmark');
        $property->set_enable_tinymce(0);
        $this->set_property($property);
    }

    public function get_external()
    {
        return $this->get_property('external')->get_value();
    }

    public function set_new_target($value)
    {
        $property = new \Orm_Property_Text('new_target', $value);
        $property->set_description('New Target Benchmark');
        $this->set_property($property);
    }

    public function get_new_target()
    {
        return $this->get_property('new_target')->get_value();
    }

    public function set_kpi_analysis($value)
    {
        $property = new \Orm_Property_Textarea('kpi_analysis', $value);
        $property->set_description('KPI Analysis (List Strength and Recommendation:');
        $this->set_property($property);
    }

    public function get_kpi_analysis()
    {
        return $this->get_property('kpi_analysis')->get_value();
    }

    public function set_explain()
    {
        $property = new \Orm_Property_Fixedtext('explain', '<strong>* Explain:</strong>');
        $this->set_property($property);
    }

    public function get_explain()
    {
        return $this->get_property('explain')->get_value();
    }

    public function set_provide_internal_benchmark($value)
    {
        $property = new \Orm_Property_Textarea('provide_internal_benchmark', $value);
        $property->set_description('1. why this internal benchmark provider was chosen ?');
        $this->set_property($property);
    }

    public function get_provide_internal_benchmark()
    {
        return $this->get_property('provide_internal_benchmark')->get_value();
    }

    public function set_calculations_of_internal_benchmark($value)
    {
        $property = new \Orm_Property_Textarea('calculations_of_internal_benchmark', $value);
        $property->set_description('2. how was the benchmark calculated ?');
        $this->set_property($property);
    }

    public function get_calculations_of_internal_benchmark()
    {
        return $this->get_property('calculations_of_internal_benchmark')->get_value();
    }

    public function set_provider_of_internal_benchmark($value)
    {
        $property = new \Orm_Property_Text('provider_of_internal_benchmark', $value);
        $property->set_description('3. name of the internal benchmark provider.');
        $this->set_property($property);
    }

    public function get_provider_of_internal_benchmark()
    {
        return $this->get_property('provider_of_internal_benchmark')->get_value();
    }

    /*
     * 
     */

    public function set_explain_2()
    {
        $property = new \Orm_Property_Fixedtext('explain_2', '<strong>** Explain:</strong>');
        $this->set_property($property);
    }

    public function get_explain_2()
    {
        return $this->get_property('explain_2')->get_value();
    }

    public function set_provide_external_benchmark($value)
    {
        $property = new \Orm_Property_Textarea('provide_external_benchmark', $value);
        $property->set_description('1. why this external benchmark provider was chosen ?');
        $this->set_property($property);
    }

    public function get_provide_external_benchmark()
    {
        return $this->get_property('provide_external_benchmark')->get_value();
    }

    public function set_calculations_of_external_benchmark($value)
    {
        $property = new \Orm_Property_Textarea('calculations_of_external_benchmark', $value);
        $property->set_description('2. how was the benchmark calculated ?');
        $this->set_property($property);
    }

    public function get_calculations_of_external_benchmark()
    {
        return $this->get_property('calculations_of_external_benchmark')->get_value();
    }

    public function set_provider_of_external_benchmark($value)
    {
        $property = new \Orm_Property_Text('provider_of_external_benchmark', $value);
        $property->set_description('3. name of the external benchmark provider.');
        $this->set_property($property);
    }

    public function get_provider_of_external_benchmark()
    {
        return $this->get_property('provider_of_external_benchmark')->get_value();
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

            $kpi = \Orm_Kpi::get_instance($this->get_kpi_id());
            if ($kpi->get_id()) {

                $program_node = $this->get_parent_program_node();
                $info = $kpi->get_info(\Orm_Kpi_Detail::TYPE_PROGRAM, array('college_id' => $program_node->get_parent_college_node()->get_item_id(), 'program_id' => $program_node->get_item_id(),'academic_year' => $this->get_year()));

                $this->set_standard($this->get_standard());
                $this->set_kpi_id($kpi->get_id());
                $this->set_name("KPI {$info['code']}");
                $this->set_kpi_info($kpi->get_title());
                $this->set_kpi_ref_num($info['code']);
                $this->set_actual($info['actual_benchmarks']);
                $this->set_target($info['target_benchmarks']);
                $this->set_internal($info['internal_benchmarks']);
                $this->set_external($info['external_benchmarks']);
                $this->set_new_target($info['new_benchmarks']);
                $this->save();
            }
        }
    }

}
