<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_2_requirements
 *
 * @author laith
 */
class Asiinp_2_Requirements extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2. Requirements for degree programmes';
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
        $childrens[] = new Asiinp_2_Requirements_1();
        $childrens[] = new Asiinp_2_Requirements_2();
        $childrens[] = new Asiinp_2_Requirements_3();

        return $childrens;
    }

}
