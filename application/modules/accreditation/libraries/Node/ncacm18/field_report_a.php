<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 03:28 م
 */

namespace Node\ncacm18;


class Field_Report_A extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'A. Field Experience Course Identification and General Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_field_experience('');
        $this->set_field_experience_code('');
        $this->set_credit_hours('');
        $this->set_name_and_title('');
        $this->set_level_or_year('');
        $this->set_info4();
        $this->set_dates('');
        $this->set_time('');
        $this->set_list_name(array());
    }

    public function set_field_experience($value)
    {
        $property = new \Orm_Property_Text('field_experience', $value);
        $property->set_description('1. Field experience course title');
        $this->set_property($property);
    }

    public function get_field_experience()
    {
        return $this->get_property('field_experience')->get_value();
    }
    public function set_field_experience_code($value)
    {
        $property = new \Orm_Property_Text('field_experience_code', $value);
        $property->set_description('1. Field experience course code');
        $this->set_property($property);
    }

    public function get_field_experience_code()
    {
        return $this->get_property('field_experience_code')->get_value();
    }

    public function set_credit_hours($value)
    {
        $property = new \Orm_Property_Text('credit_hours', $value);
        $property->set_description('2. Credit hours (if any)');
        $this->set_property($property);
    }

    public function get_credit_hours()
    {
        return $this->get_property('credit_hours')->get_value();
    }

    public function set_name_and_title($value)
    {
        $property = new \Orm_Property_Text('name_and_title', $value);
        $property->set_description('3. Name and title of faculty or teaching staff member responsible for the field experience.');
        $this->set_property($property);
    }

    public function get_name_and_title()
    {
        return $this->get_property('name_and_title')->get_value();
    }
    public function set_level_or_year($value)
    {
        $property = new \Orm_Property_Text('level_or_year', $value);
        $property->set_description('4. Level or year of the field experience.');
        $this->set_property($property);
    }

    public function get_level_or_year()
    {
        return $this->get_property('level_or_year')->get_value();
    }


    public function set_info4()
    {
        $property = new \Orm_Property_Fixedtext('info4', '5. Dates and times allocation of field experience activities.');
        $property->set_group('time_date');
        $this->set_property($property);
    }

    public function get_info4()
    {
        return $this->get_property('info4')->get_value();
    }

    public function set_dates($value)
    {
        $property = new \Orm_Property_Text('dates', $value);
        $property->set_description('a. Dates');
        $property->set_group('time_date');
        $this->set_property($property);
    }

    public function get_dates()
    {
        return $this->get_property('dates')->get_value();
    }

    public function set_time($value)
    {
        $property = new \Orm_Property_Text('time', $value);
        $property->set_description('b. Times');
        $property->set_group('time_date');
        $this->set_property($property);
    }

    public function get_time()
    {
        return $this->get_property('time')->get_value();
    }

    public function set_list_name($value)
    {
        $property = new \Orm_Property_Table_Dynamic('list_name', $value);
        $property->set_description('6. List names, addresses, and contact information for all field experience locations.');

        $name_and_address = new \Orm_Property_Textarea('name_and_address');
        $name_and_address->set_description('Name and Address of the Organization');
        $name_and_address->set_enable_tinymce(0);
        $name_and_address->set_width(300);
        $property->add_property($name_and_address);


        $contact_name = new \Orm_Property_Text('contact_name');
        $contact_name->set_description('Name of Contact Person');
        $contact_name->set_width(200);
        $property->add_property($contact_name);

        $contact_information = new \Orm_Property_Text('contact_information');
        $contact_information->set_description('Contact Information (email address and mobile)');
        $contact_information->set_width(200);
        $property->add_property($contact_information);

        $this->set_property($property);
    }

    public function get_list_name()
    {
        return $this->get_property('list_name')->get_value();
    }


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

        $course_node = $this->get_parent_course_node();
        $course_section_node = $this->get_parent_course_section_node();

        if (!is_null($course_node) && $course_node->get_id()) {
            /** @var \Orm_Course $course */
            $course = $course_node->get_item_obj();

            $this->set_field_experience($course->get_name('english'));
            $this->set_field_experience_code($course->get_number('english'));
        }

        if ($course_section_node->get_item_id()) {
            $instructors = \Orm_Course_Section_Teacher::get_all(array('section_id' => $course_section_node->get_item_id()));
            $instructors_text = array();
            foreach ($instructors as $instructor) {
                $instructors_text[] = $instructor->get_user_obj()->get_full_name();
            }
            $this->set_name_and_title(implode('-',$instructors_text));

        } else {
            $sections = \Orm_Course_Section::get_all(array('course_id' => $course_node->get_item_id()));
            $sections_text = array();
            $instructors_text = array();
            foreach ($sections as $section) {
                $sections_text[] = $section->get_section_no();

                $instructors = \Orm_Course_Section_Teacher::get_all(array('section_id' => $section->get_id()));
                foreach ($instructors as $instructor) {
                    $instructors_text[] = $instructor->get_user_obj()->get_full_name();
                }
            }

            $this->set_name_and_title(implode('-',$instructors_text));

        }
        $plans = \Orm_Program_Plan::get_all(array('course_id' => $course_node->get_item_id()));
        $plan_text = array();
        $credit_hours = array();
        foreach ($plans as $plan) {
            $plan_text[] = $plan->get_program_obj()->get_code('english'). ' - Level:' . $plan->get_level();
            $credit_hours[] = $plan->get_program_obj()->get_code('english') . ' ('.$plan->get_credit_hours().' Hours)';

        }
        $this->set_level_or_year(implode('/',$plan_text));
        $this->set_credit_hours(implode('/',$credit_hours));

        $this->save();
    }

}