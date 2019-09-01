<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_1
 *
 * @author ahmadgx
 */
class Jci_Section_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Section I: Accreditation Participation Requirements';
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
        $childrens[] = new Jci_Section_1_Apr();
        return $childrens;
    }

}
