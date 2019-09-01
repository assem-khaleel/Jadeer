<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_3_procedures
 *
 * @author laith
 */
class Asiinp_3_Procedures extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3. Procedures';
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
        $childrens[] = new Asiinp_3_Procedures_1();
        $childrens[] = new Asiinp_3_Procedures_2();
        $childrens[] = new Asiinp_3_Procedures_3();
        $childrens[] = new Asiinp_3_Procedures_4();
        $childrens[] = new Asiinp_3_Procedures_5();
        $childrens[] = new Asiinp_3_Procedures_6();
        $childrens[] = new Asiinp_3_Procedures_7();
        $childrens[] = new Asiinp_3_Procedures_8();
        $childrens[] = new Asiinp_3_Procedures_9();

        return $childrens;
    }

}
