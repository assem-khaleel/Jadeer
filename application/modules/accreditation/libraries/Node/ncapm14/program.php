<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncapm14;

/**
 * Description of programs_selected_program
 *
 * @author qanah
 */
class Program extends \Orm_Node
{
    protected $is_form = 0;
    protected $class_type = __CLASS__;

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Program_Specifications();
        $childrens[] = new Annual();

        return $childrens;
    }

    /**
     * @return \Orm_Program
     */
    public function get_item_obj()
    {
        return \Orm_Program::get_instance($this->get_item_id());
    }

}
