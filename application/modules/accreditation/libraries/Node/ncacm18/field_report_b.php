<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 03:35 م
 */

namespace Node\ncacm18;


class Field_Report_B extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'B. Field Experience Modifications or Adaptations from Planned Field Experience Specifications';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_field_experiance_modifiactions(array());
    }

    public function set_field_experiance_modifiactions($value)
    {
        $reason_for_modification = new \Orm_Property_Textarea('reason_for_modification');
        $reason_for_modification->set_enable_tinymce(0);
        $reason_for_modification->set_width(170);
        $action_taken = new \Orm_Property_Textarea('action_taken');
        $action_taken->set_enable_tinymce(0);
        $action_taken->set_width(170);
        $responsibility = new \Orm_Property_Textarea('responsibility');
        $responsibility->set_enable_tinymce(0);
        $responsibility->set_width(170);
        $implications_for_future = new \Orm_Property_Textarea('implications_for_future');
        $implications_for_future->set_enable_tinymce(0);
        $implications_for_future->set_width(170);

        $property = new \Orm_Property_Table('field_experiance_modifiactions', $value);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('empty', ''));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('reason_for_modification', 'Reason for Modification'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('action_taken', 'Action Taken'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('responsibility', 'Responsibility'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('implications_for_future', 'Implications for Future'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('student_enrollment', 'Student Enrollment'));
        $property->add_cell(2, 2, $reason_for_modification);
        $property->add_cell(2, 3, $action_taken);
        $property->add_cell(2, 4, $responsibility);
        $property->add_cell(2, 5, $implications_for_future);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('field_staff', 'Field Teaching Staff'));
        $property->add_cell(3, 2, $reason_for_modification);
        $property->add_cell(3, 3, $action_taken);
        $property->add_cell(3, 4, $responsibility);
        $property->add_cell(3, 5, $implications_for_future);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('program_faculty', 'Program Faculty or Teaching Staff'));
        $property->add_cell(4, 2, $reason_for_modification);
        $property->add_cell(4, 3, $action_taken);
        $property->add_cell(4, 4, $responsibility);
        $property->add_cell(4, 5, $implications_for_future);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('organizational_arrangements', 'Organizational Arrangements'));
        $property->add_cell(5, 2, $reason_for_modification);
        $property->add_cell(5, 3, $action_taken);
        $property->add_cell(5, 4, $responsibility);
        $property->add_cell(5, 5, $implications_for_future);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('required_activities', 'Required Activities'));
        $property->add_cell(6, 2, $reason_for_modification);
        $property->add_cell(6, 3, $action_taken);
        $property->add_cell(6, 4, $responsibility);
        $property->add_cell(6, 5, $implications_for_future);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('student_guidance', 'Student Guidance and Support'));
        $property->add_cell(7, 2, $reason_for_modification);
        $property->add_cell(7, 3, $action_taken);
        $property->add_cell(7, 4, $responsibility);
        $property->add_cell(7, 5, $implications_for_future);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('learning_outcomes', 'Learning Outcomes'));
        $property->add_cell(8, 2, $reason_for_modification);
        $property->add_cell(8, 3, $action_taken);
        $property->add_cell(8, 4, $responsibility);
        $property->add_cell(8, 5, $implications_for_future);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('other', 'Other'));
        $property->add_cell(9, 2, $reason_for_modification);
        $property->add_cell(9, 3, $action_taken);
        $property->add_cell(9, 4, $responsibility);
        $property->add_cell(9, 5, $implications_for_future);

        $this->set_property($property);
    }

    public function get_field_experiance_modifiactions()
    {
        return $this->get_property('field_experiance_modifiactions')->get_value();
    }


}