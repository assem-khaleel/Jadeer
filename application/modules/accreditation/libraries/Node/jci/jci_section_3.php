<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_3
 *
 * @author ahmadgx
 */
class Jci_Section_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Section III: Health Care Organization Management Standards';
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
        $childrens[] = new Jci_Section_3_Qps();
        $childrens[] = new Jci_Section_3_Pci();
        $childrens[] = new Jci_Section_3_Gld();
        $childrens[] = new Jci_Section_3_Fms();
        $childrens[] = new Jci_Section_3_Sqe();
        $childrens[] = new Jci_Section_3_Moi();

        return $childrens;
    }

}
