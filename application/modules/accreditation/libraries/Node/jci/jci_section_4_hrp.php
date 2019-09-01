<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_4_hrp
 *
 * @author ahmadgx
 */
class Jci_Section_4_Hrp extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Human Subjects Research Programs (HRP)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_hrp_1('');
            $this->set_hospital_1('');
            $this->set_hrp_1_1('');
            $this->set_hospital_1_1('');
            $this->set_hrp_2('');
            $this->set_hospital_2('');
            $this->set_hrp_3('');
            $this->set_hospital_3('');
            $this->set_hrp_3_1('');
            $this->set_hospital_3_1('');
            $this->set_hrp_4('');
            $this->set_hospital_4('');
            $this->set_hrp_5('');
            $this->set_hospital_5('');
            $this->set_hrp_6('');
            $this->set_hospital_6('');
            $this->set_hrp_7('');
            $this->set_hospital_7('');
            $this->set_hrp_7_1('');
            $this->set_hospital_7_1('');
    }

    public function set_goals()
    {
        $property = new \Orm_Property_Fixedtext('goals', '<b>Note:</b>This chapter was previous entitled “Human Subject Research Programs.” The title was changed to reflect the most common usage of the terminology in the field.'
            . ' <br/> <br/><b>Standards</b>');
        $this->set_property($property);
    }

    public function get_goals()
    {
        return $this->get_property('goals')->get_value();
    }

    public function set_hrp_1()
    {
        $property = new \Orm_Property_Fixedtext('hrp_1', '<b>Standard HRP.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hrp_1()
    {
        return $this->get_property('hrp_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'Hospital leadership is accountable for the protection of human research subjects.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_hrp_1_1()
    {
        $property = new \Orm_Property_Fixedtext('hrp_1_1', '<b>Standard HRP.1.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hrp_1_1()
    {
        return $this->get_property('hrp_1_1')->get_value();
    }

    public function set_hospital_1_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_1', 'Hospital leadership complies with all regulatory and professional requirements and provides adequate resources for effective operation of the research program.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1_1()
    {
        return $this->get_property('hospital_1_1')->get_value();
    }

    public function set_hrp_2()
    {
        $property = new \Orm_Property_Fixedtext('hrp_2', '<b>Standard HRP.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hrp_2()
    {
        return $this->get_property('hrp_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'Hospital leadership establishes the scope of research activities.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_hrp_3()
    {
        $property = new \Orm_Property_Fixedtext('hrp_3', '<b>Standard HRP.3</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hrp_3()
    {
        return $this->get_property('hrp_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'Hospital leadership establishes requirements for sponsors of research to ensure their commitment to the conduct of ethical research.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    public function set_hrp_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hrp_3_1', '<b>Standard HRP.3.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hrp_3_1()
    {
        return $this->get_property('hrp_3_1')->get_value();
    }

    public function set_hospital_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_1', 'When one or more of the research-related duties and functions of the sponsor are provided through an outside commercial or academic contract research organization, the accountabilities of the outside contract research organization are clearly defined.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_3_1()
    {
        return $this->get_property('hospital_3_1')->get_value();
    }

    public function set_hrp_4()
    {
        $property = new \Orm_Property_Fixedtext('hrp_4', '<b>Standard HRP.4</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hrp_4()
    {
        return $this->get_property('hrp_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'Hospital leadership creates or contracts for a process to provide the initial and ongoing review of all human subjects research.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_hrp_5()
    {
        $property = new \Orm_Property_Fixedtext('hrp_5', '<b>Standard HRP.5</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hrp_5()
    {
        return $this->get_property('hrp_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'The hospital identifies and manages conflicts of interest with research conducted at the hospital.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_hrp_6()
    {
        $property = new \Orm_Property_Fixedtext('hrp_6', '<b>Standard HRP.6</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hrp_6()
    {
        return $this->get_property('hrp_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'The hospital integrates the human subjects research program into the quality and patient safety program of the hospital.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    public function set_hrp_7()
    {
        $property = new \Orm_Property_Fixedtext('hrp_7', '<b>Standard HRP.7</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hrp_7()
    {
        return $this->get_property('hrp_7')->get_value();
    }

    public function set_hospital_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7', 'The hospital establishes and implements an informed consent process that enables patients to make informed and voluntary decisions about participating in clinical research, clinical investigations, or clinical trials.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_7()
    {
        return $this->get_property('hospital_7')->get_value();
    }

    public function set_hrp_7_1()
    {
        $property = new \Orm_Property_Fixedtext('hrp_7_1', '<b>Standard HRP.7.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hrp_7_1()
    {
        return $this->get_property('hrp_7_1')->get_value();
    }

    public function set_hospital_7_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_1', 'The hospital informs patients and families about how to gain access to clinical research, clinical investigations, or clinical trials and includes protections for vulnerable populations to minimize potential coercion or undue influence.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_7_1()
    {
        return $this->get_property('hospital_7_1')->get_value();
    }

}
