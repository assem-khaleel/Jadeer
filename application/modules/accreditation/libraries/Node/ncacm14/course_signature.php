<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncacm14;

/**
 * Description of course_signature
 *
 * @author ahmadgx
 */
class Course_Signature extends \Orm_Node {

    protected $class_type = __CLASS__;
    protected $name = 'Signatures';
    //
    protected $link_edit = true;
    protected $link_view = true;
    protected $link_pdf = true;

    public function init() {
        parent::init();

            $this->set_signatures(array());
    }

    public function set_signatures($value) {
        $name = new \Orm_Property_Text('name');
        $name->set_width(670);
        $signature = new \Orm_Property_Text('signature');
        $signature->set_width(670);
        $date = new \Orm_Property_Date('date');
        $date->set_width(670);

        $faculty = new \Orm_Property_Fixedtext('faculty', 'Faculty or Teaching Staff:');
        $faculty->set_width(162);

        $signatures = new \Orm_Property_Fixedtext('signature', 'Signature: ');
        $signatures->set_width(162);

        $date_report = new \Orm_Property_Fixedtext('report_date', 'Date Report Completed:');
        $date_report->set_width(162);

        $coordinator = new \Orm_Property_Fixedtext('coordinator', 'Program Coordinator:');
        $coordinator->set_width(162);

        $received = new \Orm_Property_Fixedtext('date', 'Date Received:');
        $received->set_width(162);

        $dean = new \Orm_Property_Fixedtext('dean', 'Dean/Department Head:');
        $dean->set_width(162);

        $dates = new \Orm_Property_Fixedtext('dates', 'Date:');
        $dates->set_width(162);



        $property = new \Orm_Property_Table('signatures', $value);

        $property->add_cell(1, 1,$faculty);
        $property->add_cell(1, 2, $name);

        $property->add_cell(2, 1,$signatures);
        $property->add_cell(2, 2, $signature);

        $property->add_cell(3, 1,$date_report);
        $property->add_cell(3, 2, $date);

        $property->add_cell(4, 1,$received);
        $property->add_cell(4, 2, $name);

        $property->add_cell(5, 1, $dean);
        $property->add_cell(5, 2, $name);

        $property->add_cell(6, 1,$signatures);
        $property->add_cell(6, 2, $signature);

        $property->add_cell(7, 1, $dates);
        $property->add_cell(7, 2, $date);

        $this->set_property($property);
    }

    public function get_signatures() {
        return $this->get_property('signatures')->get_value();
    }

}
