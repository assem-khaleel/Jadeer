<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\abet_cac;

/**
 * Description of root
 *
 * @author ahmadgx
 */
class Root extends \Orm_Node
{
    protected $is_form = 0;
    protected $class_type = __CLASS__;
    protected $name = 'ABET CAC V.2015';
    public $system_name = 'ABET';
    public $system_type = 'CAC';
    public $system_version = 'V.2015';
    protected $link_pdf = true;

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
        $childrens[] = new Background_Info();
        $childrens[] = new Criterion_1();
        $childrens[] = new Criterion_2();
        $childrens[] = new Criterion_3();
        $childrens[] = new Criterion_4();
        $childrens[] = new Criterion_5();
        $childrens[] = new Criterion_6();
        $childrens[] = new Criterion_7();
        $childrens[] = new Criterion_8();
        $childrens[] = new Program_Criteria();
        $childrens[] = new Appendix_A();
        $childrens[] = new Appendix_B();
        $childrens[] = new Appendix_C();
        $childrens[] = new Appendix_D();
        return $childrens;
    }

    /**
     * @return \Orm_Program
     */
    public function get_item_obj()
    {
        return \Orm_Program::get_instance($this->get_item_id());
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