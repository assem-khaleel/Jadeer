<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_2
 *
 * @author ahmadgx
 */
class Jci_Section_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Section II: Patient-Centered Standards';
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
        $childrens[] = new Jci_Section_2_Ipsg();
        $childrens[] = new Jci_Section_2_Acc();
        $childrens[] = new Jci_Section_2_Pfr();
        $childrens[] = new Jci_Section_2_Aop();
        $childrens[] = new Jci_Section_2_Cop();
        $childrens[] = new Jci_Section_2_Asc();
        $childrens[] = new Jci_Section_2_Mmu();
        $childrens[] = new Jci_Section_2_Pfe();
        return $childrens;
    }

}
