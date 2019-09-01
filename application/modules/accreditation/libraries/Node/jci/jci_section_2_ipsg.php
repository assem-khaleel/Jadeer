<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_2_ipsg
 *
 * @author ahmadgx
 */
class Jci_Section_2_Ipsg extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'International Patient Safety Goals (IPSG)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_goals_1('');
            $this->set_ipsg_1('');
            $this->set_hospital_1('');
            /**/
            $this->set_goals_2('');
            $this->set_ipsg_2('');
            $this->set_hospital_2('');
            $this->set_ipsg_2_1('');
            $this->set_hospital_2_1('');
            $this->set_ipsg_2_2('');
            $this->set_hospital_2_2('');
            /**/
            $this->set_goals_3('');
            $this->set_ipsg_3('');
            $this->set_hospital_3('');
            $this->set_ipsg_3_1('');
            $this->set_hospital_3_1('');
            /**/
            $this->set_goals_4('');
            $this->set_ipsg_4('');
            $this->set_hospital_4('');
            $this->set_ipsg_4_1('');
            $this->set_hospital_4_1('');
            /**/
            $this->set_goals_5('');
            $this->set_ipsg_5('');
            $this->set_hospital_5('');
            /**/
            $this->set_goals_6('');
            $this->set_ipsg_6('');
            $this->set_hospital_6('');
    }

    public function set_goals()
    {
        $property = new \Orm_Property_Fixedtext('goals', '<b>Goals and Standards</b>');
        $this->set_property($property);
    }

    public function get_goals()
    {
        return $this->get_property('goals')->get_value();
    }

    /*
     * 
     */

    public function set_goals_1()
    {
        $property = new \Orm_Property_Fixedtext('goals_1', '<b>Goal 1: Identify Patients Correctly</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_goals_1()
    {
        return $this->get_property('goals_1')->get_value();
    }

    public function set_ipsg_1()
    {
        $property = new \Orm_Property_Fixedtext('ipsg_1', '<b>Standard IPSG.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_ipsg_1()
    {
        return $this->get_property('ipsg_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'The hospital develops and implements a process to improve accuracy of patient identifications.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    /*
     * 
     */

    public function set_goals_2()
    {
        $property = new \Orm_Property_Fixedtext('goals_2', '<b>Goal 2: Improve Effective Communication</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goals_2()
    {
        return $this->get_property('goals_2')->get_value();
    }

    public function set_ipsg_2()
    {
        $property = new \Orm_Property_Fixedtext('ipsg_2', '<b>Standard IPSG.2</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_ipsg_2()
    {
        return $this->get_property('ipsg_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'The hospital develops and implements a process to improve the effectiveness of verbal and/or telephone communication among caregivers');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_ipsg_2_1()
    {
        $property = new \Orm_Property_Fixedtext('ipsg_2_1', '<b>Standard IPSG.2.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_ipsg_2_1()
    {
        return $this->get_property('ipsg_2_1')->get_value();
    }

    public function set_hospital_2_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_1', 'The hospital develops and implements a process for reporting critical results of diagnostic tests.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2_1()
    {
        return $this->get_property('hospital_2_1')->get_value();
    }

    public function set_ipsg_2_2()
    {
        $property = new \Orm_Property_Fixedtext('ipsg_2_2', '<b>Standard IPSG.2.2</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_ipsg_2_2()
    {
        return $this->get_property('ipsg_2_2')->get_value();
    }

    public function set_hospital_2_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_2', 'The hospital develops and implements a process for handover communication.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2_2()
    {
        return $this->get_property('hospital_2_2')->get_value();
    }

    /*
     * 
     */

    public function set_goals_3()
    {
        $property = new \Orm_Property_Fixedtext('goals_3', '<b>Goal 3: Improve the Safety of High-Alert Medications</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_goals_3()
    {
        return $this->get_property('goals_3')->get_value();
    }

    public function set_ipsg_3()
    {
        $property = new \Orm_Property_Fixedtext('ipsg_3', '<b>Standard IPSG.3</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_ipsg_3()
    {
        return $this->get_property('ipsg_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'The hospital develops and implements a process to improve the safety of high-alert medications.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    public function set_ipsg_3_1()
    {
        $property = new \Orm_Property_Fixedtext('ipsg_3_1', '<b>Standard IPSG.3.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_ipsg_3_1()
    {
        return $this->get_property('ipsg_3_1')->get_value();
    }

    public function set_hospital_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_1', 'The hospital develops and implements a process to manage the safe use of concentrated electrolytes.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3_1()
    {
        return $this->get_property('hospital_3_1')->get_value();
    }

    /*
     * 
     */

    public function set_goals_4()
    {
        $property = new \Orm_Property_Fixedtext('goals_4', '<b>Goal 4: Ensure Correct-Site, Correct-Procedure, Correct- Patient Surgery</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_goals_4()
    {
        return $this->get_property('goals_4')->get_value();
    }

    public function set_ipsg_4()
    {
        $property = new \Orm_Property_Fixedtext('ipsg_4', '<b>Standard IPSG.4</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_ipsg_4()
    {
        return $this->get_property('ipsg_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'The hospital develops and implements a process for ensuring correct-site, correct-procedure, and correct-patient surgery.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_ipsg_4_1()
    {
        $property = new \Orm_Property_Fixedtext('ipsg_4_1', '<b>Standard IPSG.4.1</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_ipsg_4_1()
    {
        return $this->get_property('ipsg_4_1')->get_value();
    }

    public function set_hospital_4_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_1', 'The hospital develops and implements a process for the time-out that is performed in the operating theatre immediately prior to the start of surgery to ensure correct-site, correct-procedure, and correct-patient surgery.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_1()
    {
        return $this->get_property('hospital_4_1')->get_value();
    }

    /*
     * 
     */

    public function set_goals_5()
    {
        $property = new \Orm_Property_Fixedtext('goals_5', '<b>Goal 5: Reduce the Risk of Health Care–Associated Infections</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_goals_5()
    {
        return $this->get_property('goals_5')->get_value();
    }

    public function set_ipsg_5()
    {
        $property = new \Orm_Property_Fixedtext('ipsg_5', '<b>Standard IPSG.5</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_ipsg_5()
    {
        return $this->get_property('ipsg_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'The hospital adopts and implements evidence-based hand-hygiene guidelines to reduce the risk of health care–associated infections.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    /*
     * 
     */

    public function set_goals_6()
    {
        $property = new \Orm_Property_Fixedtext('goals_6', '<b>Goal 6: Reduce the Risk of Patient Harm Resulting from Falls</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_goals_6()
    {
        return $this->get_property('goals_6')->get_value();
    }

    public function set_ipsg_6()
    {
        $property = new \Orm_Property_Fixedtext('ipsg_6', '<b>Standard IPSG.6</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_ipsg_6()
    {
        return $this->get_property('ipsg_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'The hospital develops and implements a process to reduce the risk of patient harm resulting from falls.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

}
