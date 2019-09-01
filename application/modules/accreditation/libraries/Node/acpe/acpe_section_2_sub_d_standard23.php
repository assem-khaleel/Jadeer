<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_section_2_sub_d_standard23
 *
 * @author ahmadgx
 */
class Acpe_Section_2_Sub_D_Standard23 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 23: Financial Resources';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_college('');
            $this->set_key('');
            $this->set_enrollment_support('');
            $this->set_budgetary_input('');
            $this->set_revenue_allcation('');
            $this->set_equitable_allocation('');
    }

    public function set_college()
    {
        $property = new \Orm_Property_Fixedtext('college', 'The college or school has current and anticipated financial resources to support the stability of the educational program and accomplish its mission, goals, and strategic plan.');
        $this->set_property($property);
    }

    public function get_college()
    {
        return $this->get_property('college')->get_value();
    }

    public function set_key()
    {
        $property = new \Orm_Property_Fixedtext('key', '<b>Key Element:</b>');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_key()
    {
        return $this->get_property('key')->get_value();
    }

    public function set_enrollment_support($value)
    {
        $property = new \Orm_Property_Text('enrollment_support', $value);
        $property->set_description('23.1. Enrollment support – The college or school ensures that student enrollment is commensurate with resources.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_enrollment_support()
    {
        return $this->get_property('enrollment_support')->get_value();
    }

    public function set_budgetary_input($value)
    {
        $property = new \Orm_Property_Textarea('budgetary_input', $value);
        $property->set_description('23.2. Budgetary input – The college or school provides input into the development and operation of a budget that is planned, executed, and managed in accordance with sound and accepted business practices.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_budgetary_input()
    {
        return $this->get_property('budgetary_input')->get_value();
    }

    public function set_revenue_allcation($value)
    {
        $property = new \Orm_Property_Textarea('revenue_allcation', $value);
        $property->set_description('23.3. Revenue allocation – Tuition and fees for pharmacy students are not increased to support other educational programs if it compromises the quality of the professional program.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_revenue_allcation()
    {
        return $this->get_property('revenue_allcation')->get_value();
    }

    public function set_equitable_allocation($value)
    {
        $property = new \Orm_Property_Textarea('equitable_allocation', $value);
        $property->set_description('23.4. Equitable allocation – The college or school ensures that funds are sufficient to maintain equitable facilities (commensurate with services and activities) across all program pathways.');
        $property->set_group('key_element');
        $this->set_property($property);
    }

    public function get_equitable_allocation()
    {
        return $this->get_property('equitable_allocation')->get_value();
    }

}
