<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_c
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_C extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Subsection IIC: Students';
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
        $childrens[] = new Acpe_Section_2_Sub_C_Standard14();
        $childrens[] = new Acpe_Section_2_Sub_C_Standard15();
        $childrens[] = new Acpe_Section_2_Sub_C_Standard16();
        $childrens[] = new Acpe_Section_2_Sub_C_Standard17();
        return $childrens;
    }

}
