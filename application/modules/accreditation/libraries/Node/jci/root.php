<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of root
 *
 * @author ahmadgx
 */
class Root extends \Orm_Node
{
    protected $is_form = 0;
    protected $class_type = __CLASS__;
    protected $name = 'Joint Commissiom International V.2014';

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
        $childrens[] = new Jci_Section_1();
        $childrens[] = new Jci_Section_2();
        $childrens[] = new Jci_Section_3();
        $childrens[] = new Jci_Section_4();
        //$childrens[] = new Test();

        return $childrens;
    }

    public function system_validator(&$view_params = array())
    {

        $year = (int) \Orm::get_ci()->input->post('year');

        \Validator::not_empty_field_validator('year', $year, lang('Please Select Year'));

        if (\Validator::success() && self::get_count(array('class_type' => $this->get_class_type(), 'year' => $year))) {
            \Validator::set_error('year', lang('You can not have more than one Institutional - Accreditations per Year.'));
        }

        $view_params['year'] = $year;

        $this->set_year($year);

        return 0;
    }

    public function draw_system_forms()
    {
        \Orm::get_ci()->load->view('accreditation/form/year');
    }

}
