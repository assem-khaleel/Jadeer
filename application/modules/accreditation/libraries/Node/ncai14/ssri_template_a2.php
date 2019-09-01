<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;

/**
 * Description of Ssri_Template_A2
 *
 * @author ahmadgx
 */
class Ssri_Template_A2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Template A2';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;

    function init()
    {
        parent::init();

            $this->set_institution('');
            $this->set_date('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();

        foreach (\Orm_College::get_all() as $college) {

            $node = new Ssri_Template_A2_Program_Data();
            $node->set_name($college->get_name('english') . ' (Program Data)');
            $node->set_item_id($college->get_id());
            $childrens[] = $node;
        }

        return $childrens;
    }

    public function set_institution($value)
    {
        $property = new \Orm_Property_Text('institution', $value);
        $property->set_description('Institution');
        $this->set_property($property);
    }

    public function get_institution()
    {
        return $this->get_property('institution')->get_value();
    }

    public function set_date($value)
    {
        $property = new \Orm_Property_Text('date', $value);
        $property->set_description('Date');
        $this->set_property($property);
    }

    public function get_date()
    {
        return $this->get_property('date')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $this->set_institution(\Orm_Institution::get_university_name('english'));
        $this->set_date(date('Y-m-d', strtotime($this->get_date_added())));
    }

    public function tree_item_actions(\Orm_Tree_Item &$tree_item)
    {

        if (\Orm_User::has_role_type(\Orm_Role::ROLE_INSTITUTION_ADMIN)) {
            $tree_item->add_action('fa fa-th', '/accreditation/add_college/' . $this->get_id(), 'title="' . lang('Add').' '.lang('College Program Data') . '" data-toggle="ajaxModal"');
        }
        parent::tree_item_actions($tree_item);
    }

    public function system_validator(&$view_params = array())
    {

        $college_id = \Orm::get_ci()->input->post('college_id');

        \Validator::not_empty_field_validator('college_id', $college_id, lang('Please Select College'));

        $nodes_count = \Orm_Node::get_count(array('system_number' => $this->get_system_number(), 'item_id' => $college_id, 'class_type' => 'Node\ncai14\Ssri_Template_A2_Program_Data'));
        if ($nodes_count) {
            \Validator::set_error('college_id', lang('The College was added in this system'));
        }

        $view_params['college_id'] = $college_id;

        return $college_id;
    }

    public function add_college($college_id)
    {

        $college = \Orm_College::get_instance($college_id);

        $node = new Ssri_Template_A2_Program_Data();
        $node->set_system_number($this->get_system_number());
        $node->set_year($this->get_year());
        $node->set_parent_id($this->get_id());
        $node->set_name($college->get_name('english') . ' (Program Data)');
        $node->set_item_id($college->get_id());
        $node->generate();
    }

}
