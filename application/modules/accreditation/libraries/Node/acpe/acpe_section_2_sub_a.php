<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_a
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_A extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Subsection IIA: Planning and Organization';
    protected $link_pdf = true;

    public function init()
    {
        parent::init();
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Acpe_Section_2_Sub_A_Standard5();
        $childrens[] = new Acpe_Section_2_Sub_A_Standard6();
        $childrens[] = new Acpe_Section_2_Sub_A_Standard7();
        $childrens[] = new Acpe_Section_2_Sub_A_Standard8();
        $childrens[] = new Acpe_Section_2_Sub_A_Standard9();
        return $childrens;
    }

}
