<?php

namespace Node\ncapm18;

class Root extends \Orm_Node
{
    protected $is_form = 0;
    protected $class_type = __CLASS__;
    protected $name = 'Program Specifications and Reports V.2018';
    public $college_id;
    public $program_id;

    public function draw_system_node()
    {
        return \Orm::get_ci()->load->view('accreditation/system', array('node' => $this, 'abbreviation' => 'P'));
    }

    public function add_college($name, $item_id = 0, $assessor_ids = array())
    {

        $node_obj = self::get_one(array('class_type' => self::COLLEGE_PROGRAM18, 'item_id' => $item_id, 'system_number' => $this->get_system_number()));

        if (!$node_obj->get_id()) {
            $node_obj = new College();
        }


        $node_obj->program_id = $this->program_id;

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

        if ($this->college_id) {
            $college = \Orm_College::get_instance($this->college_id);
            $assessor_ids = \Orm_User::get_user_ids_by_role(\Orm_Role::ROLE_COLLEGE_ADMIN, array('college_id' => $college->get_id()));
            $this->add_college($college->get_name('english'), $college->get_id(), $assessor_ids);
        }

        return array();
    }

    public function system_validator(&$view_params = array())
    {

        $node = self::get_active_program2018_node();
        $node15 = self::get_active_program_node();
        if ($node->get_id() || $node15->get_id()) {
            \Validator::set_error('common_error', lang('You can not have more than one Program - Accreditations per year.'));
        }

        if ($node->get_id()) {
            $this->set_id($node->get_id());
            $this->set_year($node->get_year());

            return $node->get_item_id();
        } else {
            $semester = \Orm_Semester::get_active_semester();
            $this->set_year($semester->get_year());

            return $semester->get_id();
        }
    }

    public function get_system_url()
    {
        return '/accreditation/generate';
    }

    /**
     * @return \Orm_Semester
     */
    public function get_item_obj()
    {
        return \Orm_Semester::get_instance($this->get_item_id());
    }


}