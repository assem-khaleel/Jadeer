<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_2_pfe
 *
 * @author ahmadgx
 */
class Jci_Section_2_Pfe extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Patient and Family Education (PFE)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            $this->set_pfe_1('');
            $this->set_hospital_1('');
            $this->set_pfe_2('');
            $this->set_hospital_2('');
            $this->set_pfe_2_1('');
            $this->set_hospital_2_1('');
            $this->set_pfe_3('');
            $this->set_hospital_3('');
            $this->set_pfe_4('');
            $this->set_hospital_4('');
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

    public function set_pfe_1()
    {
        $property = new \Orm_Property_Fixedtext('pfe_1', '<b>Standard PFE.1</b>');
        $this->set_property($property);
    }

    public function get_pfe_1()
    {
        return $this->get_property('pfe_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'The hospital provides education that supports patient and family participation in care decisions and care processes.');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_pfe_2()
    {
        $property = new \Orm_Property_Fixedtext('pfe_2', '<b>Standard PFE.2</b>');
        $this->set_property($property);
    }

    public function get_pfe_2()
    {
        return $this->get_property('pfe_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'Each patient’s educational needs are assessed and recorded in his or her record.');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_pfe_2_1()
    {
        $property = new \Orm_Property_Fixedtext('pfe_2_1', '<b>Standard PFE.2.1</b>');
        $this->set_property($property);
    }

    public function get_pfe_2_1()
    {
        return $this->get_property('pfe_2_1')->get_value();
    }

    public function set_hospital_2_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_1', 'The patient’s and family’s ability to learn and willingness to learn are assessed.');
        $this->set_property($property);
    }

    public function get_hospital_2_1()
    {
        return $this->get_property('hospital_2_1')->get_value();
    }

    public function set_pfe_3()
    {
        $property = new \Orm_Property_Fixedtext('pfe_3', '<b>Standard PFE.3</b>');
        $this->set_property($property);
    }

    public function get_pfe_3()
    {
        return $this->get_property('pfe_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'Education methods include the patient’s and family’s values and preferences and allow sufficient interaction among the patient, family, and staff for learning to occur.');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    public function set_pfe_4()
    {
        $property = new \Orm_Property_Fixedtext('pfe_4', '<b>Standard PFE.4</b>');
        $this->set_property($property);
    }

    public function get_pfe_4()
    {
        return $this->get_property('pfe_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'Health professionals caring for the patient collaborate to provide education.');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

}
