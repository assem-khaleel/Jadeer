<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_5_appendix
 *
 * @author laith
 */
class Asiinp_5_Appendix extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5. Appendix';
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
        $childrens[] = new Asiinp_5_Appendix_1();
        $childrens[] = new Asiinp_5_Appendix_2();
        $childrens[] = new Asiinp_5_Appendix_3();
        $childrens[] = new Asiinp_5_Appendix_4();
        $childrens[] = new Asiinp_5_Appendix_5();
        $childrens[] = new Asiinp_5_Appendix_6();

        return $childrens;
    }

}
