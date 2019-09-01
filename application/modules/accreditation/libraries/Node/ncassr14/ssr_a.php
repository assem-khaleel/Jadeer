<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of ssr_a
 *
 * @author duaa
 */
class Ssr_A extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'A. General Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_institution('');
            $this->set_title_of_college('');
            $this->set_title_of_department('');
            $this->set_title_of_program('');
            $this->set_date_of_report('');
            $this->set_dean_name('');
            $this->set_dean_contact('');
            $this->set_name_of_person('');
            $this->set_name_and_contact_for_person('');
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

    public function set_title_of_college($value)
    {
        $property = new \Orm_Property_Text('title_of_college', $value);
        $property->set_description('Title of College in which the program is offered.');
        $this->set_property($property);
    }

    public function get_title_of_college()
    {
        return $this->get_property('title_of_college')->get_value();
    }
    public function set_title_of_department($value)
    {
        $property = new \Orm_Property_Text('title_of_department', $value);
        $property->set_description('Title of Department in which the program is offered.');
        $this->set_property($property);
    }

    public function get_title_of_department()
    {
        return $this->get_property('title_of_department')->get_value();
    }

    public function set_title_of_program($value)
    {
        $property = new \Orm_Property_Text('title_of_program', $value);
        $property->set_description('Title of Program');
        $this->set_property($property);
    }

    public function get_title_of_program()
    {
        return $this->get_property('title_of_program')->get_value();
    }

    public function set_date_of_report($value)
    {
        $property = new \Orm_Property_Text('date_of_report', $value);
        $property->set_description('Date of Report');
        $this->set_property($property);
    }

    public function get_date_of_report()
    {
        return $this->get_property('date_of_report')->get_value();
    }

    public function set_dean_name($value)
    {
        $property = new \Orm_Property_Text('dean_name', $value);
        $property->set_description(' Dean Name');
        $this->set_property($property);
    }

    public function get_dean_name()
    {
        return $this->get_property('dean_name')->get_value();
    }

    public function set_dean_contact($value)
    {
        $property = new \Orm_Property_Text('dean_contact', $value);
        $property->set_description('Contact details for Dean');
        $this->set_property($property);
    }

    public function get_dean_contact()
    {
        return $this->get_property('dean_contact')->get_value();
    }

    public function set_name_of_person($value)
    {
        $property = new \Orm_Property_Text('name_of_person', $value);
        $property->set_description('Name of Person Responsible for Preparation of Report (Head of Department)');
        $this->set_property($property);
    }

    public function get_name_of_person()
    {
        return $this->get_property('name_of_person')->get_value();
    }

    public function set_name_and_contact_for_person($value)
    {
        $property = new \Orm_Property_Textarea('name_and_contact_for_person', $value);
        $property->set_description('Name and contact details for person to contact for further information about matters discussed in the report and for arrangements for an external review visit.  (if different from above)');
        $this->set_property($property);
    }

    public function get_name_and_contact_for_person()
    {
        return $this->get_property('name_and_contact_for_person')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();

        $this->set_institution(\Orm_Institution::get_university_name('english'));
        $program_node = $this->get_parent_program_node();
        if (!is_null($program_node) && $program_node->get_id()) {
            /** @var \Orm_Program $program_obj */
            $program_obj = $program_node->get_item_obj();
            $department_obj = $program_obj->get_department_obj();
            $this->set_title_of_college($department_obj->get_college_obj()->get_name('english'));
            $this->set_title_of_department( $department_obj->get_name('english'));
            $this->set_title_of_program($program_obj->get_name('english'));
        }
        $this->set_date_of_report(date('Y-m-d', strtotime($this->get_date_added())));
    }

}
