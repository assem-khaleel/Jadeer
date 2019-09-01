<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_4_mpe
 *
 * @author ahmadgx
 */
class Jci_Section_4_Mpe extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Medical Professional Education (MPE)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_mpe_1('');
            $this->set_hospital_1('');
            $this->set_mpe_2('');
            $this->set_hospital_2('');
            $this->set_mpe_3('');
            $this->set_hospital_3('');
            $this->set_mpe_4('');
            $this->set_hospital_4('');
            $this->set_mpe_5('');
            $this->set_hospital_5('');
            $this->set_mpe_6('');
            $this->set_hospital_6('');
            $this->set_mpe_7('');
            $this->set_hospital_7('');
    }

    public function set_goals()
    {
        $property = new \Orm_Property_Fixedtext('goals', '<b>Standards</b>');
        $this->set_property($property);
    }

    public function get_goals()
    {
        return $this->get_property('goals')->get_value();
    }

    public function set_mpe_1()
    {
        $property = new \Orm_Property_Fixedtext('mpe_1', '<b>Standard MPE.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_mpe_1()
    {
        return $this->get_property('mpe_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'Those responsible for governance and leadership of the hospital approve and monitor the participation of the hospital in providing medical education.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_mpe_2()
    {
        $property = new \Orm_Property_Fixedtext('mpe_2', '<b>Standard MPE.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_mpe_2()
    {
        return $this->get_property('mpe_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'The hospital’s clinical staff, patient population, technology, and facility are consistent with the goals and objectives of the education program.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_mpe_3()
    {
        $property = new \Orm_Property_Fixedtext('mpe_3', '<b>Standard MPE.3</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_mpe_3()
    {
        return $this->get_property('mpe_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'Clinical teaching staff are identified, and each staff member’s role and relationship to the academic institution is defined.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    public function set_mpe_4()
    {
        $property = new \Orm_Property_Fixedtext('mpe_4', '<b>Standard MPE.4</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_mpe_4()
    {
        return $this->get_property('mpe_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'The hospital understands and provides the required frequency and intensity of medical supervision for each type and level of medical student and trainee.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_mpe_5()
    {
        $property = new \Orm_Property_Fixedtext('mpe_5', '<b>Standard MPE.5</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_mpe_5()
    {
        return $this->get_property('mpe_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'Medical education provided in the hospital is coordinated and managed through a defined operational mechanism and management structure.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_mpe_6()
    {
        $property = new \Orm_Property_Fixedtext('mpe_6', '<b>Standard MPE.6</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_mpe_6()
    {
        return $this->get_property('mpe_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'Medical students and trainees comply with all hospital policies and procedures, and all care is provided within the quality and patient safety parameters of the hospital.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    public function set_mpe_7()
    {
        $property = new \Orm_Property_Fixedtext('mpe_7', '<b>Standard MPE.7</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_mpe_7()
    {
        return $this->get_property('mpe_7')->get_value();
    }

    public function set_hospital_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7', 'Medical trainees who provide care or services within the hospital—outside of the parameters of their academic program—are granted permission to provide those services through the hospital’s established credentialing, privileging, job specification, or other relevant processes.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_7()
    {
        return $this->get_property('hospital_7')->get_value();
    }

}
