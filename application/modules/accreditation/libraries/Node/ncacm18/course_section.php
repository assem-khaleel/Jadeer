<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 09:43 ص
 */

namespace Node\ncacm18;


class Course_Section extends \Orm_Node
{
    protected $is_form = 0;
    protected $class_type = __CLASS__;

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();

        $course_node = $this->get_parent_course_node();
        $type = $course_node->get_item_obj()->get_type();
        if ($type == 'theoretical') {
            $childrens[] = new Course_Report();
        }
        if ($type == 'practical') {
            $childrens[] = new Field_Report();
        }

        return $childrens;
    }

    /**
     * @return \Orm_Course_Section
     */
    public function get_item_obj()
    {
        return \Orm_Course_Section::get_instance($this->get_item_id());
    }
}