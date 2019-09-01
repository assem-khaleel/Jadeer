<?php


namespace Node\ncacm18;


class Program extends \Orm_Node
{
    protected $is_form = 0;
    protected $class_type = __CLASS__;
    public $plan_id;

    public function add_course($name, $item_id = 0, $assessor_ids = array())
    {

        if ($this->plan_id) {
            $node_obj = self::get_one(array('class_type' => self::COURSE_COURSE18, 'item_id' => $item_id, 'system_number' => $this->get_system_number()));

            if (!$node_obj->get_id()) {
                $node_obj = new Course();
            }
        } else {
            $node_obj = new Course();
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

        if ($this->plan_id) {
            $plan = \Orm_Program_Plan::get_instance($this->plan_id);
            $this->add_course($plan->get_course_obj()->get_name('english'), $plan->get_id());
        } else {
            foreach (\Orm_Program_Plan::get_all(array('program_id' => $this->get_item_id(), 'semester_id' => $this->get_system_obj()->get_item_id())) as $plan) {
                $this->add_course($plan->get_course_obj()->get_name('english'), $plan->get_id());
            }
        }

        return array();
    }

    /**
     * @return \Orm_Program
     */
    public function get_item_obj()
    {
        return \Orm_Program::get_instance($this->get_item_id());
    }

}