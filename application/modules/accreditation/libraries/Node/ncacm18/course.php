<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 09:43 ص
 */

namespace Node\ncacm18;


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