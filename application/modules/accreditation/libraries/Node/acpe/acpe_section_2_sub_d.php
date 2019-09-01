<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_d
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Subsection IID: Resources';
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
        $childrens[] = new Acpe_Section_2_Sub_D_Standard18();
        $childrens[] = new Acpe_Section_2_Sub_D_Standard19();
        $childrens[] = new Acpe_Section_2_Sub_D_Standard20();
        $childrens[] = new Acpe_Section_2_Sub_D_Standard21();
        $childrens[] = new Acpe_Section_2_Sub_D_Standard22();
        $childrens[] = new Acpe_Section_2_Sub_D_Standard23();

        return $childrens;
    }

}
