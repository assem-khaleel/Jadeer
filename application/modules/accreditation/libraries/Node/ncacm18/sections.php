<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 09:44 ص
 */

namespace Node\ncacm18;


class Sections extends \Orm_Node
{
    protected $is_form = 0;
    protected $class_type = __CLASS__;
    protected $name = 'Sections';

    public function add_section($name, $item_id = 0, $assessor_ids = array())
    {

        $node_obj = new Course_Section();
        $node_obj->set_system_number($this->get_system_number());
        $node_obj->set_year($this->get_year());
        $node_obj->set_parent_id($this->get_id());
        $node_obj->set_name($name);
        $node_obj->set_item_id($item_id);
        $node_obj->generate();

        if ($assessor_ids) {
            foreach ($assessor_ids as $assessor_id) {
                $node_assessor = new \Orm_Node_Assessor();
                $node_assessor->set_assessor_id($assessor_id);
                $node_assessor->set_node_id($node_obj->get_id());
                $node_assessor->save();
            }
        }

        return $node_obj;
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $course_node = $this->get_parent_course_node();
        $sessions = \Orm_Course_Section::get_all(array('course_id' => $course_node->get_item_id(), 'semester_id' => $this->get_system_obj()->get_item_id()));

        foreach ($sessions as $session) {
            $this->add_section($session->get_name(), $session->get_id(), $session->get_teacher_ids());
        }

        return array();
    }

    public function tree_item_actions(\Orm_Tree_Item &$tree_item)
    {

        if ($this->check_if_can_manage()) {
            $tree_item->add_action('fa fa-th', '/accreditation/add_missed_sections/' . $this->get_id(), 'title="' . lang('Add') . ' ' . lang('Sections') . '"');
        }

        parent::tree_item_actions($tree_item);
    }


}