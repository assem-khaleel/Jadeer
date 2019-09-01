<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_b
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_B extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Subsection IIB: Educational Program for the Doctor of Pharmacy Degree';
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
        $childrens[] = new Acpe_Section_2_Sub_B_Standard10();
        $childrens[] = new Acpe_Section_2_Sub_B_Standard11();
        $childrens[] = new Acpe_Section_2_Sub_B_Standard12();
        $childrens[] = new Acpe_Section_2_Sub_B_Standard13();
        return $childrens;
    }

}
