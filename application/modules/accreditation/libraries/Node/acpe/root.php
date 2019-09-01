<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of root
 *
 * @author laith
 */
class Root extends \Orm_Node
{
    protected $is_form = 0;
    protected $class_type = __CLASS__;
    protected $name = 'ACPE For Pharmacy V.2016';

    public function draw_system_node()
    {
        return \Orm::get_ci()->load->view('accreditation/system', array('node' => $this));
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Acpe_Section_1();
        $childrens[] = new Acpe_Section_2();
        $childrens[] = new Acpe_Section_3();
        $childrens[] = new Acpe_Appendices();
        return $childrens;
    }

    public function system_validator(&$view_params = array())
    {

        $year = (int) \Orm::get_ci()->input->post('year');
        $college_id = (int) \Orm::get_ci()->input->post('college_id');
        $department_id = (int) \Orm::get_ci()->input->post('department_id');
        $program_id = (int) \Orm::get_ci()->input->post('program_id');

        \Validator::not_empty_field_validator('year', $year, lang('Please Select Year'));
        \Validator::not_empty_field_validator('college_id', $college_id, lang('Please Select College'));
        \Validator::not_empty_field_validator('department_id', $department_id, lang('Please Select Department'));
        \Validator::not_empty_field_validator('program_id', $program_id, lang('Please Select Program'));

        if (\Validator::success() && self::get_count(array('class_type' => $this->get_class_type(), 'year' => $year, 'item_id' => $program_id))) {
            \Validator::set_error('year', lang('You can not have more than one Program - Accreditations per year.'));
        }

        $view_params['year'] = $year;
        $view_params['college_id'] = $college_id;
        $view_params['department_id'] = $department_id;
        $view_params['program_id'] = $program_id;

        $this->set_year($year);

        return $program_id;
    }

    public function draw_system_forms()
    {
        \Orm::get_ci()->load->view('accreditation/form/year');
        \Orm::get_ci()->load->view('accreditation/form/cdp');
    }
}
