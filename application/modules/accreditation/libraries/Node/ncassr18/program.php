<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 09:29 ص
 */

namespace Node\ncassr18;


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
        $childrens[] = new Program_Profile();
        $childrens[] = new Eligibility_Requirements();
        $childrens[] = new Ses();
        $childrens[] = new Ssr();


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