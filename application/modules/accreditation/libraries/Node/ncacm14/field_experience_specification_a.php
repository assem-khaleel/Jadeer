<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of field_experience_specification_a
 *
 * @author laith
 */
class Field_Experience_Specification_A extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'A. Field Experience Course Identification and General Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_course('');
            $this->set_course_code('');
            $this->set_credit('');
            $this->set_member('');
            $this->set_date_time();
            $this->set_date('');
            $this->set_time('');
            $this->set_time_1('');
            $this->set_time_2('');
            $this->set_level('');
            $this->set_contact_info(array());
    }

    public function set_course($value)
    {
        $property = new \Orm_Property_Text('course', $value);
        $property->set_description('1. Field experience course title');
        $this->set_property($property);
    }

    public function get_course()
    {
        return $this->get_property('course')->get_value();
    }
    public function set_course_code($value)
    {
        $property = new \Orm_Property_Text('course_code', $value);
        $property->set_description('1. Field experience course code');
        $this->set_property($property);
    }

    public function get_course_code()
    {
        return $this->get_property('course_code')->get_value();
    }

    public function set_credit($value)
    {
        $property = new \Orm_Property_Text('credit', $value);
        $property->set_description('2. Credit hours (if any)');
        $this->set_property($property);
    }

    public function get_credit()
    {
        return $this->get_property('credit')->get_value();
    }

    public function set_member($value)
    {
        $property = new \Orm_Property_Text('member', $value);
        $property->set_description('3. Name and title of faculty or teaching staff member responsible for the field experience.');
        $this->set_property($property);
    }

    public function get_member()
    {
        return $this->get_property('member')->get_value();
    }

    public function set_date_time()
    {
        $property = new \Orm_Property_Fixedtext('date_time', '<strong>4. Dates and times allocation of field experience activities.</strong>');
        $this->set_property($property);
    }

    public function get_date_time()
    {
        return $this->get_property('date_time')->get_value();
    }

    public function set_date($value)
    {
        $property = new \Orm_Property_Text('date', $value);
        $property->set_description('a. Dates');
        $this->set_property($property);
    }

    public function get_date()
    {
        return $this->get_property('date')->get_value();
    }

    /* time must be modified from date to time */

    public function set_time()
    {
        $property = new \Orm_Property_Fixedtext('time', '<strong>b. Times (e.g., from 8:00 am to 2:30 pm)</strong>');
        $property->set_group('date_and_time');
        $this->set_property($property);
    }

    public function get_time()
    {
        return $this->get_property('time')->get_value();
    }

    public function set_time_1($value)
    {
        $property = new \Orm_Property_Text('time_1', $value);
        $property->set_description('From:');
        $property->set_group('date_and_time');
        $this->set_property($property);
    }

    public function get_time_1()
    {
        return $this->get_property('time_1')->get_value();
    }

    public function set_time_2($value)
    {
        $property = new \Orm_Property_Text('time_2', $value);
        $property->set_description('To');
        $property->set_group('date_and_time');
        $this->set_property($property);
    }

    public function get_time_2()
    {
        return $this->get_property('time_2')->get_value();
    }

    public function set_level($value)
    {
        $property = new \Orm_Property_Text('level', $value);
        $property->set_description('5. Level or year of the field experience.');
        $this->set_property($property);
    }

    public function get_level()
    {
        return $this->get_property('level')->get_value();
    }

    public function set_contact_info($value)
    {
        $property = new \Orm_Property_Table_Dynamic('contact_info', $value);
        $property->set_description('6. List names, addresses, and contact information for all field experience locations currently being utilized by the program.');

        $name_and_address = new \Orm_Property_Text('name_and_address');
        $name_and_address->set_description('Name and Address of the Organization');
        $name_and_address->set_width(200);
        $property->add_property($name_and_address);


        $contact_name = new \Orm_Property_Text('contact_name');
        $contact_name->set_description('Name of Contact Person');
        $contact_name->set_width(200);
        $property->add_property($contact_name);

        $contact_information = new \Orm_Property_Text('contact_information');
        $contact_information->set_description('Contact Information (email address or mobile)');
        $contact_information->set_width(200);
        $property->add_property($contact_information);

        $this->set_property($property);
    }

    public function get_contact_info()
    {
        return $this->get_property('contact_info')->get_value();
    }

//    public function after_node_load()
//    {
//        parent::after_node_load();
//
//        $course_node = $this->get_parent_course_node();
//        if (!is_null($course_node) && $course_node->get_id()) {
//            $plan_obj = $course_node->get_item_obj();
//
//            $this->set_course($plan_obj->get_course_obj()->get_name('english') . ' (' . $plan_obj->get_course_obj()->get_number('english') . ')');
//        }
//    }
    
    public function header_actions(&$actions = array())
    {
        if ($this->check_if_editable()) {
            $actions[] = array(
                'class' => 'btn',
                'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
            );
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

        $course_section_node = $this->get_parent_course_section_node();
        $course_node = $this->get_parent_course_node();

        if (!is_null($course_node) && $course_node->get_id()) {
            /** @var \Orm_Course $course */
            $course = $course_node->get_item_obj();

            $this->set_course($course->get_name('english'));
            $this->set_course_code($course->get_number('english'));
        }


        if ($course_section_node->get_item_id()) {

            $instructors = \Orm_Course_Section_Teacher::get_all(array('section_id' => $course_section_node->get_item_id()));
            $instructors_text = array();
            foreach ($instructors as $instructor) {
                $instructors_text[] = $instructor->get_user_obj()->get_full_name();
            }
            $this->set_member(implode('-',$instructors_text));
        } else {
            $sections = \Orm_Course_Section::get_all(array('course_id' => $course_node->get_item_id()));
            $instructors_text = array();
            foreach ($sections as $section) {
                $instructors = \Orm_Course_Section_Teacher::get_all(array('section_id' => $section->get_id()));
                foreach ($instructors as $instructor) {
                    $instructors_text[] = $instructor->get_user_obj()->get_full_name();
                }
            }

            $this->set_member(implode('-',$instructors_text));

        }
        $plans = \Orm_Program_Plan::get_all(array('course_id' => $course_node->get_item_id()));

        $plan_text = array();
        $credit_hours = array();
        $programs = array();
        $levels = array();
        foreach ($plans as $plan) {
            $programs[] = $plan->get_program_obj()->get_name('english');
            $plan_text[] = $plan->get_program_obj()->get_code('english'). ' - Level:' . $plan->get_level();
            $credit_hours[] = $plan->get_program_obj()->get_code('english') . ' ('.$plan->get_credit_hours().' Hours)';
            $levels[] = $plan->get_program_obj()->get_code('english') . ' (Level '.$plan->get_level().' )';
        }
        $this->set_level(implode('/',$levels));
        $this->set_credit(implode('/',$credit_hours));
        $this->save();
    }

}
