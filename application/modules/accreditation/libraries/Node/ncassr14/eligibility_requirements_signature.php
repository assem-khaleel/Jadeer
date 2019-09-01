<?php
/**
 * Created by PhpStorm.
 * User: ahmadgx
 * Date: 29/11/15
 * Time: 04:58 م
 */

namespace Node\ncassr14;


class Eligibility_Requirements_Signature extends \Orm_Node{
    protected $class_type = __CLASS__;
    protected $name = 'Signatures';
    //
    protected $link_edit = true;
    protected $link_view = true;
    protected $link_pdf = true;

    public function init() {
        parent::init();

            $this->set_university_rector('');
            $this->set_date('');
    }

    public function set_university_rector($value) {
        $property = new \Orm_Property_Textarea('university_rector', $value);
        $property->set_description('Name & Signature of University Rector (or Dean for Private Colleges)');
        $property->set_enable_tinymce(0);
        $this->set_property($property);
    }

    public function get_university_rector() {
        return $this->get_property('university_rector')->get_value();
    }

    public function set_date($value) {
        $property = new \Orm_Property_Date('date', $value);
        $property->set_description('Date');
        $this->set_property($property);
    }

    public function get_date() {
        return $this->get_property('date')->get_value();
    }

}