<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_3_pci
 *
 * @author ahmadgx
 */
class Jci_Section_3_Pci extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Prevention and Control of Infections (PCI)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_pci_1('');
            $this->set_hospital_1('');
            $this->set_pci_2('');
            $this->set_hospital_2('');
            $this->set_pci_3('');
            $this->set_hospital_3('');
            $this->set_pci_4('');
            $this->set_hospital_4('');
            $this->set_pci_5('');
            $this->set_hospital_5('');
            $this->set_pci_5_1('');
            $this->set_hospital_5_1('');
            $this->set_pci_6('');
            $this->set_hospital_6('');
            $this->set_pci_6_1('');
            $this->set_hospital_6_1('');
            $this->set_pci_7('');
            $this->set_hospital_7('');
            $this->set_pci_7_1('');
            $this->set_hospital_7_1('');
            $this->set_pci_7_1_1('');
            $this->set_hospital_7_1_1('');
            $this->set_pci_7_2('');
            $this->set_hospital_7_2('');
            $this->set_pci_7_3('');
            $this->set_hospital_7_3('');
            $this->set_pci_7_4('');
            $this->set_hospital_7_4('');
            $this->set_pci_7_5('');
            $this->set_hospital_7_5('');
            $this->set_pci_8('');
            $this->set_hospital_8('');
            $this->set_pci_8_1('');
            $this->set_hospital_8_1('');
            $this->set_pci_9('');
            $this->set_hospital_9('');
            $this->set_pci_10('');
            $this->set_hospital_10('');
            $this->set_pci_11('');
            $this->set_hospital_11('');
    }

    public function set_goals()
    {
        $property = new \Orm_Property_Fixedtext('goals', '<b>Standardss</b>');
        $this->set_property($property);
    }

    public function get_goals()
    {
        return $this->get_property('goals')->get_value();
    }

    public function set_pci_1()
    {
        $property = new \Orm_Property_Fixedtext('pci_1', '<b>Standard PCI.1</b>');
        $this->set_property($property);
    }

    public function get_pci_1()
    {
        return $this->get_property('pci_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'One or more individuals oversee all infection prevention and control activities. This individual(s) is qualified in infection prevention and control practices through education, training, experience, or certification.');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_pci_2()
    {
        $property = new \Orm_Property_Fixedtext('pci_2', '<b>Standard PCI.2</b>');
        $this->set_property($property);
    }

    public function get_pci_2()
    {
        return $this->get_property('pci_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'There is a designated coordination mechanism for all infection prevention and control activities that involves physicians, nurses, and others based on the size and complexity of the hospital.');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_pci_3()
    {
        $property = new \Orm_Property_Fixedtext('pci_3', '<b>Standard PCI.3</b>');
        $this->set_property($property);
    }

    public function get_pci_3()
    {
        return $this->get_property('pci_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'The infection prevention and control program is based on current scientific knowledge, accepted practice guidelines, applicable laws and regulations, and standards for sanitation and cleanliness.');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    public function set_pci_4()
    {
        $property = new \Orm_Property_Fixedtext('pci_4', '<b>Standard PCI.4</b>');
        $this->set_property($property);
    }

    public function get_pci_4()
    {
        return $this->get_property('pci_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'Hospital leadership provides resources to support the infection prevention and control program.');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_pci_5()
    {
        $property = new \Orm_Property_Fixedtext('pci_5', '<b>Standard PCI.5</b>');
        $this->set_property($property);
    }

    public function get_pci_5()
    {
        return $this->get_property('pci_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'The hospital designs and implements a comprehensive program to reduce the risks of health care–associated infections in patients and health care workers.');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_pci_5_1()
    {
        $property = new \Orm_Property_Fixedtext('pci_5_1', '<b>Standard PCI.5.1</b>');
        $this->set_property($property);
    }

    public function get_pci_5_1()
    {
        return $this->get_property('pci_5_1')->get_value();
    }

    public function set_hospital_5_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_1', 'All patient, staff, and visitor areas of the hospital are included in the infection prevention and control program.');
        $this->set_property($property);
    }

    public function get_hospital_5_1()
    {
        return $this->get_property('hospital_5_1')->get_value();
    }

    public function set_pci_6()
    {
        $property = new \Orm_Property_Fixedtext('pci_6', '<b>Standard PCI.6</b>');
        $this->set_property($property);
    }

    public function get_pci_6()
    {
        return $this->get_property('pci_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'The hospital uses a risk-based approach in establishing the focus of the health care–associated infection prevention and reduction program.');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    public function set_pci_6_1()
    {
        $property = new \Orm_Property_Fixedtext('pci_6_1', '<b>Standard PCI.6.1</b>');
        $this->set_property($property);
    }

    public function get_pci_6_1()
    {
        return $this->get_property('pci_6_1')->get_value();
    }

    public function set_hospital_6_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_1', 'The hospital tracks infection risks, infection rates, and trends in health care–associated infections to reduce the risks of those infections.');
        $this->set_property($property);
    }

    public function get_hospital_6_1()
    {
        return $this->get_property('hospital_6_1')->get_value();
    }

    public function set_pci_7()
    {
        $property = new \Orm_Property_Fixedtext('pci_7', '<b>Standard PCI.7</b>');
        $this->set_property($property);
    }

    public function get_pci_7()
    {
        return $this->get_property('pci_7')->get_value();
    }

    public function set_hospital_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7', 'The hospital identifies the procedures and processes associated with the risk of infection and implements strategies to reduce infection risk.');
        $this->set_property($property);
    }

    public function get_hospital_7()
    {
        return $this->get_property('hospital_7')->get_value();
    }

    public function set_pci_7_1()
    {
        $property = new \Orm_Property_Fixedtext('pci_7_1', '<b>Standard PCI.7.1</b>');
        $this->set_property($property);
    }

    public function get_pci_7_1()
    {
        return $this->get_property('pci_7_1')->get_value();
    }

    public function set_hospital_7_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_1', 'The hospital reduces the risk of infections by ensuring adequate medical technology cleaning and sterilization and the proper management of laundry and linen.');
        $this->set_property($property);
    }

    public function get_hospital_7_1()
    {
        return $this->get_property('hospital_7_1')->get_value();
    }

    public function set_pci_7_1_1()
    {
        $property = new \Orm_Property_Fixedtext('pci_7_1_1', '<b>Standard PCI.7.1.1</b>');
        $this->set_property($property);
    }

    public function get_pci_7_1_1()
    {
        return $this->get_property('pci_7_1_1')->get_value();
    }

    public function set_hospital_7_1_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_1_1', 'The hospital identifies and implements a process for managing expired supplies and the reuse of single-use devices when laws and regulations permit.');
        $this->set_property($property);
    }

    public function get_hospital_7_1_1()
    {
        return $this->get_property('hospital_7_1_1')->get_value();
    }

    public function set_pci_7_2()
    {
        $property = new \Orm_Property_Fixedtext('pci_7_2', '<b>Standard PCI.7.2</b>');
        $this->set_property($property);
    }

    public function get_pci_7_2()
    {
        return $this->get_property('pci_7_2')->get_value();
    }

    public function set_hospital_7_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_2', 'The hospital reduces the risk of infections through proper disposal of waste.');
        $this->set_property($property);
    }

    public function get_hospital_7_2()
    {
        return $this->get_property('hospital_7_2')->get_value();
    }

    public function set_pci_7_3()
    {
        $property = new \Orm_Property_Fixedtext('pci_7_3', '<b>Standard PCI.7.3</b>');
        $this->set_property($property);
    }

    public function get_pci_7_3()
    {
        return $this->get_property('pci_7_3')->get_value();
    }

    public function set_hospital_7_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_3', 'The hospital implements practices for safe handling and disposal of sharps and needles.');
        $this->set_property($property);
    }

    public function get_hospital_7_3()
    {
        return $this->get_property('hospital_7_3')->get_value();
    }

    public function set_pci_7_4()
    {
        $property = new \Orm_Property_Fixedtext('pci_7_4', '<b>Standard PCI.7.4</b>');
        $this->set_property($property);
    }

    public function get_pci_7_4()
    {
        return $this->get_property('pci_7_4')->get_value();
    }

    public function set_hospital_7_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_4', 'The hospital reduces the risk of infections associated with the operations of food services.');
        $this->set_property($property);
    }

    public function get_hospital_7_4()
    {
        return $this->get_property('hospital_7_4')->get_value();
    }

    public function set_pci_7_5()
    {
        $property = new \Orm_Property_Fixedtext('pci_7_5', '<b>Standard PCI.7.5</b>');
        $this->set_property($property);
    }

    public function get_pci_7_5()
    {
        return $this->get_property('pci_7_5')->get_value();
    }

    public function set_hospital_7_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_5', 'The hospital reduces the risk of infection in the facility associated with mechanical and engineering controls and during demolition, construction, and renovation.');
        $this->set_property($property);
    }

    public function get_hospital_7_5()
    {
        return $this->get_property('hospital_7_5')->get_value();
    }

    public function set_pci_8()
    {
        $property = new \Orm_Property_Fixedtext('pci_8', '<b>Standard PCI.8</b>');
        $this->set_property($property);
    }

    public function get_pci_8()
    {
        return $this->get_property('pci_8')->get_value();
    }

    public function set_hospital_8()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8', 'The hospital provides barrier precautions and isolation procedures that protect patients, visitors, and staff from communicable diseases and protects immunosuppressed patients from acquiring infections to which they are uniquely prone.');
        $this->set_property($property);
    }

    public function get_hospital_8()
    {
        return $this->get_property('hospital_8')->get_value();
    }

    public function set_pci_8_1()
    {
        $property = new \Orm_Property_Fixedtext('pci_8_1', '<b>Standard PCI.8.1</b>');
        $this->set_property($property);
    }

    public function get_pci_8_1()
    {
        return $this->get_property('pci_8_1')->get_value();
    }

    public function set_hospital_8_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8_1', 'The hospital develops and implements a process to manage a sudden influx of patients with airborne infections and when negative-pressure rooms are not available.');
        $this->set_property($property);
    }

    public function get_hospital_8_1()
    {
        return $this->get_property('hospital_8_1')->get_value();
    }

    public function set_pci_9()
    {
        $property = new \Orm_Property_Fixedtext('pci_9', '<b>Standard PCI.9</b>');
        $this->set_property($property);
    }

    public function get_pci_9()
    {
        return $this->get_property('pci_9')->get_value();
    }

    public function set_hospital_9()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9', 'Gloves, masks, eye protection, other protective equipment, soap, and disinfectants are available and used correctly when required.');
        $this->set_property($property);
    }

    public function get_hospital_9()
    {
        return $this->get_property('hospital_9')->get_value();
    }

    public function set_pci_10()
    {
        $property = new \Orm_Property_Fixedtext('pci_10', '<b>Standard PCI.10</b>');
        $this->set_property($property);
    }

    public function get_pci_10()
    {
        return $this->get_property('pci_10')->get_value();
    }

    public function set_hospital_10()
    {
        $property = new \Orm_Property_Fixedtext('hospital_10', 'The infection prevention and control process is integrated with the hospital’s overall program for quality improvement and patient safety, using measures that are epidemiologically important to the hospital.');
        $this->set_property($property);
    }

    public function get_hospital_10()
    {
        return $this->get_property('hospital_10')->get_value();
    }

    public function set_pci_11()
    {
        $property = new \Orm_Property_Fixedtext('pci_11', '<b>Standard PCI.11</b>');
        $this->set_property($property);
    }

    public function get_pci_11()
    {
        return $this->get_property('pci_11')->get_value();
    }

    public function set_hospital_11()
    {
        $property = new \Orm_Property_Fixedtext('hospital_11', 'The hospital provides education on infection prevention and control practices to staff, physicians, patients, families, and other caregivers when indicated by their involvement in care.');
        $this->set_property($property);
    }

    public function get_hospital_11()
    {
        return $this->get_property('hospital_11')->get_value();
    }

}
