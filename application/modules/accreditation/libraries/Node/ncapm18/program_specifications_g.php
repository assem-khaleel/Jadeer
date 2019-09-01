<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 11/10/18
 * Time: 12:33 م
 */

namespace Node\ncapm18;


class Program_Specifications_G extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'G. Faculty and Staff';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_faculty_staff(array());
        $this->set_orientation();
        $this->set_new_fac_staff('');
        $this->set_professional_development('');

    }

    public function set_faculty_staff($value)
    {

        $general = new \Orm_Property_Text('general');
        $general->set_width(100);

        $specific = new \Orm_Property_Text('specific');
        $specific->set_width(100);

        $skills = new \Orm_Property_Textarea('skills');
        $skills->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $skills->set_width(200);

        $male = new \Orm_Property_Text('male');
        $male->set_width(100);

        $female = new \Orm_Property_Text('female');
        $female->set_width(100);

        $total = new \Orm_Property_Text('total');
        $total->set_width(100);

        $property = new \Orm_Property_Table('faculty_staff', $value);
        $property->set_description('1. Needed faculty and staff');
        $property->set_is_responsive(true);
        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('rank', 'Academic Rank'), 2, 0);
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('specialty', 'Specialty'), 0, 2);
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('skills', 'Special requirements / Skills ( if any )'), 2, 0);
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('required_no', 'Required Numbers'), 0, 3);

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('general', 'General'));
        $property->add_cell(2, 2, new \Orm_Property_Fixedtext('specific', 'Specific'));
        $property->add_cell(2, 3, new \Orm_Property_Fixedtext('male', 'M'));
        $property->add_cell(2, 4, new \Orm_Property_Fixedtext('female', 'F'));
        $property->add_cell(2, 5, new \Orm_Property_Fixedtext('total', 'T'));

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('prof', 'Professors'));
        $property->add_cell(3, 2, $general);
        $property->add_cell(3, 3, $specific);
        $property->add_cell(3, 4, $skills);
        $property->add_cell(3, 5, $male);
        $property->add_cell(3, 6, $female);
        $property->add_cell(3, 7, $total);

        $property->add_cell(4, 1, new \Orm_Property_Fixedtext('assoc_prof', 'Associate Professors'));
        $property->add_cell(4, 2, $general);
        $property->add_cell(4, 3, $specific);
        $property->add_cell(4, 4, $skills);
        $property->add_cell(4, 5, $male);
        $property->add_cell(4, 6, $female);
        $property->add_cell(4, 7, $total);

        $property->add_cell(5, 1, new \Orm_Property_Fixedtext('assist_prof', 'Assistant Professors'));
        $property->add_cell(5, 2, $general);
        $property->add_cell(5, 3, $specific);
        $property->add_cell(5, 4, $skills);
        $property->add_cell(5, 5, $male);
        $property->add_cell(5, 6, $female);
        $property->add_cell(5, 7, $total);

        $property->add_cell(6, 1, new \Orm_Property_Fixedtext('lectures', 'Lecturers'));
        $property->add_cell(6, 2, $general);
        $property->add_cell(6, 3, $specific);
        $property->add_cell(6, 4, $skills);
        $property->add_cell(6, 5, $male);
        $property->add_cell(6, 6, $female);
        $property->add_cell(6, 7, $total);

        $property->add_cell(7, 1, new \Orm_Property_Fixedtext('teach_assist', 'Teaching Assistants'));
        $property->add_cell(7, 2, $general);
        $property->add_cell(7, 3, $specific);
        $property->add_cell(7, 4, $skills);
        $property->add_cell(7, 5, $male);
        $property->add_cell(7, 6, $female);
        $property->add_cell(7, 7, $total);

        $property->add_cell(8, 1, new \Orm_Property_Fixedtext('lab_technic', 'Technicians and Laboratory Assistants'));
        $property->add_cell(8, 2, $general);
        $property->add_cell(8, 3, $specific);
        $property->add_cell(8, 4, $skills);
        $property->add_cell(8, 5, $male);
        $property->add_cell(8, 6, $female);
        $property->add_cell(8, 7, $total);

        $property->add_cell(9, 1, new \Orm_Property_Fixedtext('staff_Support', 'Administrative and supportive staff'));
        $property->add_cell(9, 2, $general);
        $property->add_cell(9, 3, $specific);
        $property->add_cell(9, 4, $skills);
        $property->add_cell(9, 5, $male);
        $property->add_cell(9, 6, $female);
        $property->add_cell(9, 7, $total);
        $property->add_cell(10, 1, new \Orm_Property_Fixedtext('other', 'Others ( specify )'));
        $property->add_cell(10, 2, $general);
        $property->add_cell(10, 3, $specific);
        $property->add_cell(10, 4, $skills);
        $property->add_cell(10, 5, $male);
        $property->add_cell(10, 6, $female);
        $property->add_cell(10, 7, $total);

        $this->set_property($property);

    }

    public function get_faculty_staff()
    {
        return $this->get_property('faculty_staff')->get_value();
    }

    public function set_orientation()
    {
        $property = New \Orm_Property_Fixedtext('orientation', '<strong>2. Orientation and Professional Development</strong>');
        $property->set_group('orientation');
        $this->set_property($property);
    }

    public function get_orientation()
    {
        return $this->get_property('orientation')->get_value();
    }

    public function set_new_fac_staff($value)
    {
        $property = new \Orm_Property_Textarea('new_fac_staff', $value);
        $property->set_description('2.1 Orientation of New faculty and teaching staff Describe briefly the process used for orientation of new, visiting or part time teaching staff');
        $property->set_group('orientation');
        $this->set_property($property);
    }

    public function get_new_fac_staff()
    {
        return $this->get_property('new_fac_staff')->get_value();
    }

    public function set_professional_development($value)
    {
        $property = new \Orm_Property_Textarea('professional_development', $value);
        $property->set_description('2.2 Professional Development for faculty and teaching staff Describe briefly the plan and arrangements for Academic and professional development of faculty and teaching staff (Teaching & learning strategies, Learning Outcomes assessment, Professional development…etc.)');
        $property->set_group('orientation');
        $this->set_property($property);
    }

    public function get_professional_development()
    {
        return $this->get_property('professional_development')->get_value();
    }


}