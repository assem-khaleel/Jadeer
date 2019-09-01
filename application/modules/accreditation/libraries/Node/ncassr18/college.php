<?php

namespace Node\ncassr18;

/**
 * Description of programs_selected_program
 */


class College extends \Orm_Node
{
    protected $is_form = 0;
    protected $class_type = __CLASS__;
    public $program_id;

    public function add_program($name, $item_id = 0, $assessor_ids = array())
    {

        $node_obj = self::get_one(array('class_type' => self::PROGRAM_SSR, 'item_id' => $item_id, 'system_number' => $this->get_system_number()));

        if (!$node_obj->get_id()) {
            $node_obj = new Program();
        }

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

        if ($this->program_id) {
            $program = \Orm_Program::get_instance($this->program_id);
            $assessor_ids = \Orm_User::get_user_ids_by_role(\Orm_Role::ROLE_PROGRAM_ADMIN, array('program_id' => $program->get_id()));
            $this->add_program($program->get_name('english'), $program->get_id(), $assessor_ids);
        }

        return array();
    }

    /**
     * @return \Orm_College
     */
    public function get_item_obj()
    {
        return \Orm_College::get_instance($this->get_item_id());
    }


}