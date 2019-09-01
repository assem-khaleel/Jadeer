<?php
/**
 * Created by PhpStorm.
 * User: ahmadgx
 * Date: 29/11/15
 * Time: 05:13 م
 */

namespace Node\ncai14;


class Ssri_Signatures extends \Orm_Node{

    protected $class_type = __CLASS__;
    protected $name = 'Authorized Signatures';
    //
    protected $link_edit = true;
    protected $link_view = true;
    protected $link_pdf = true;

    public function init() {
        parent::init();

            $this->set_authorized_signature(array());
    }

    public function set_authorized_signature($value) {
        $name = new \Orm_Property_Text('name');
        $title = new \Orm_Property_Text('title');
        $signature = new \Orm_Property_Text('signature');
        $date = new \Orm_Property_Date('date');

        $property = new \Orm_Property_Table('authorized_signature', $value);

        $property->add_cell(1, 1, new \Orm_Property_Fixedtext('dean', 'Dean / Program Chair'));
        $property->add_cell(1, 2, new \Orm_Property_Fixedtext('name', 'Name'));
        $property->add_cell(1, 3, new \Orm_Property_Fixedtext('title', 'Title'));
        $property->add_cell(1, 4, new \Orm_Property_Fixedtext('signature', 'Signature'));
        $property->add_cell(1, 5, new \Orm_Property_Fixedtext('date', 'Date'));

        $property->add_cell(2, 1, new \Orm_Property_Fixedtext('program_Dean', 'Program Dean or Chair of the Board of Trustees Main Campus'));
        $property->add_cell(2, 2, $name);
        $property->add_cell(2, 3, $title);
        $property->add_cell(2, 4, $signature);
        $property->add_cell(2, 5, $date);

        $property->add_cell(3, 1, new \Orm_Property_Fixedtext('vice_rector', 'Vice Rector'));
        $property->add_cell(3, 2, $name);
        $property->add_cell(3, 3, $title);
        $property->add_cell(3, 4, $signature);
        $property->add_cell(3, 5, $date);

        $this->set_property($property);
    }

    public function get_authorized_signature() {
        return $this->get_property('authorized_signature')->get_value();
    }
}