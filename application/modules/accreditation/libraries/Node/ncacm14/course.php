<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of Course
 *
 * @author qanah
 */
class Course extends \Orm_Node
{
    protected $is_form = 0;
    protected $class_type = __CLASS__;

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();

        $type = $this->get_item_obj()->get_type();
        if ($type == 'theoretical') {
            $childrens[] = new Sections();
            $childrens[] = new Course_Specifications();
            $childrens[] = new Course_Report();
        }
        if ($type == 'practical') {
            $childrens[] = new Sections();
            $childrens[] = new Field_Experience_Specification();
            $childrens[] = new Field_Report();
        }

        return $childrens;
    }

    /**
     * @return \Orm_Course
     */
    public function get_item_obj()
    {
        return \Orm_Course::get_instance($this->get_item_id());
    }

}