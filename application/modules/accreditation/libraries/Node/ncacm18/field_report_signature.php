<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 05/07/18
 * Time: 04:07 م
 */

namespace Node\ncacm18;


class Field_Report_Signature extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'Signatures';
    protected $link_edit = true;
    protected $link_view = true;
    protected $link_pdf = true;

    public function init() {
        parent::init();

        $this->set_signatures(array());
    }

    public function set_signatures($value) {
        $name = new \Orm_Property_Text('name');
        $name->set_width(590);
        $signature = new \Orm_Property_Text('signature');
        $signature->set_width(590);
        $date = new \Orm_Property_Date('date');
        $date->set_width(590);

        $instructor = new \Orm_Property_Fixedtext('instructor_name', 'Name of Instructor: ');
        $instructor->set_width(240);

        $signatures = new \Orm_Property_Fixedtext('signature', 'Signature: ');
        $signatures->set_width(240);

        $date_report = new \Orm_Property_Fixedtext('report_date', ' Date Report Completed:');
        $date_report->set_width(240);

        $teaching_staff =  new \Orm_Property_Fixedtext('teaching_staff ', 'Name of Field Experience Teaching Staff : ');
        $teaching_staff->set_width(240);

        $coordinator = new \Orm_Property_Fixedtext('coordinator', 'Program Coordinator: ');
        $coordinator->set_width(240);

        $received = new \Orm_Property_Fixedtext('date', 'Date Received:');
        $received->set_width(240);


        $property = new \Orm_Property_Table('signatures', $value);

        $property->add_cell(1, 1, $instructor);
        $property->add_cell(1, 2, $name);

        $property->add_cell(2, 1, $signatures);
        $property->add_cell(2, 2, $signature);

        $property->add_cell(3, 1,$date_report);
        $property->add_cell(3, 2, $date);

        $property->add_cell(5, 1, $teaching_staff);
        $property->add_cell(5, 2, $name);

        $property->add_cell(6, 1, $coordinator);
        $property->add_cell(6, 2, $name);

        $property->add_cell(7, 1,$signatures);
        $property->add_cell(7, 2, $signature);

        $property->add_cell(8, 1,$received);
        $property->add_cell(8, 2, $date);

        $this->set_property($property);
    }


    public function get_signatures() {
        return $this->get_property('signatures')->get_value();
    }


}