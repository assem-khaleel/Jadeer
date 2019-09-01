<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of ncaaa
 *
 * @author qanah
 */
class Root extends \Orm_Node
{

    protected $is_form = 0;
    protected $class_type = __CLASS__;
    protected $name = 'Institutional Forms V.2015';

    public function draw_system_node()
    {
        return \Orm::get_ci()->load->view('accreditation/system', array('node' => $this, 'abbreviation' => 'I'));
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Inst_Profile();
        $childrens[] = new Eligibility_Requirements();
        $childrens[] = new Ses();
        $childrens[] = new Ssri();
        $childrens[] = new Provisional_Accreditation();

        return $childrens;
    }

    public function get_system_url()
    {
        return '/accreditation/generate';
    }

    public function system_validator(&$view_params = array())
    {

        $semester = \Orm_Semester::get_active_semester();
        $item_id = $semester->get_id();

        $node = \Orm_Node::get_count(array('year' => $semester->get_year(), 'class_type' => $this->get_class_type()));
        $node18 = \Orm_Node::get_count(array('year' => $semester->get_year(), 'class_type' => self::SYSTEM_INSTITUTIONAL2018));

        if ($node || $node18) {
            \Validator::set_error('common_error', lang('You can not have more than one Institutional - Accreditations per Year.'));
        }

        $this->set_year($semester->get_year());

        return $item_id;

    }


    /**
     * @return \Orm_Semester
     */
    public function get_item_obj()
    {
        return \Orm_Semester::get_instance($this->get_item_id());
    }
}
