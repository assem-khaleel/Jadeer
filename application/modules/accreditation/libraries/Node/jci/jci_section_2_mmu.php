<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_2_mmu
 *
 * @author ahmadgx
 */
class Jci_Section_2_Mmu extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Medication Management and Use (MMU)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_goal_1('');
            $this->set_mmu_1('');
            $this->set_hospital_1('');
            /**/
            $this->set_goal_2('');
            $this->set_mmu_2('');
            $this->set_hospital_2('');
            $this->set_mmu_2_1('');
            $this->set_hospital_2_1('');
            /**/
            $this->set_goal_3('');
            $this->set_mmu_3('');
            $this->set_hospital_3('');
            $this->set_mmu_3_1('');
            $this->set_hospital_3_1('');
            $this->set_mmu_3_2('');
            $this->set_hospital_3_2('');
            $this->set_mmu_3_3('');
            $this->set_hospital_3_3('');
            /**/
            $this->set_goal_4('');
            $this->set_mmu_4('');
            $this->set_hospital_4('');
            $this->set_mmu_4_1('');
            $this->set_hospital_4_1('');
            $this->set_mmu_4_2('');
            $this->set_hospital_4_2('');
            $this->set_mmu_4_3('');
            $this->set_hospital_4_3('');
            /**/
            $this->set_goal_5('');
            $this->set_mmu_5('');
            $this->set_hospital_5('');
            $this->set_mmu_5_1('');
            $this->set_hospital_5_1('');
            $this->set_mmu_5_2('');
            $this->set_hospital_5_2('');
            /**/
            $this->set_goal_6('');
            $this->set_mmu_6('');
            $this->set_hospital_6('');
            $this->set_mmu_6_1('');
            $this->set_hospital_6_1('');
            $this->set_mmu_6_2('');
            $this->set_hospital_6_2('');
            /**/
            $this->set_goal_7('');
            $this->set_mmu_7('');
            $this->set_hospital_7('');
            $this->set_mmu_7_1('');
            $this->set_hospital_7_1('');
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

    /*
     * 
     */

    public function set_goal_1()
    {
        $property = new \Orm_Property_Fixedtext('goal_1', '<b>Organization and Management</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_goal_1()
    {
        return $this->get_property('goal_1')->get_value();
    }

    public function set_mmu_1()
    {
        $property = new \Orm_Property_Fixedtext('mmu_1', '<b>Standard MMU.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_mmu_1()
    {
        return $this->get_property('mmu_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'Medication use in the hospital is organized to meet patient needs, complies with applicable laws and regulations, and is under the direction and supervision of a licensed pharmacist or other qualified professional.');
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

    public function set_goal_2()
    {
        $property = new \Orm_Property_Fixedtext('goal_2', '<b>Selection and Procurement</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goal_2()
    {
        return $this->get_property('goal_2')->get_value();
    }

    public function set_mmu_2()
    {
        $property = new \Orm_Property_Fixedtext('mmu_2', '<b>Standard MMU.2</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_mmu_2()
    {
        return $this->get_property('mmu_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'Medications for prescribing or ordering are stocked, and there is a process for medications not stocked or normally available to the hospital or for times when the pharmacy is closed.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_mmu_2_1()
    {
        $property = new \Orm_Property_Fixedtext('mmu_2_1', '<b>Standard MMU.2.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_mmu_2_1()
    {
        return $this->get_property('mmu_2_1')->get_value();
    }

    public function set_hospital_2_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_1', 'There is a method for overseeing the hospital’s medication list and medication use.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2_1()
    {
        return $this->get_property('hospital_2_1')->get_value();
    }

    /*
     * 
     */

    public function set_goal_3()
    {
        $property = new \Orm_Property_Fixedtext('goal_3', '<b>Storage</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_goal_3()
    {
        return $this->get_property('goal_3')->get_value();
    }

    public function set_mmu_3()
    {
        $property = new \Orm_Property_Fixedtext('mmu_3', '<b>Standard MMU.3</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_mmu_3()
    {
        return $this->get_property('mmu_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'Medications are properly and safely stored.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    public function set_mmu_3_1()
    {
        $property = new \Orm_Property_Fixedtext('mmu_3_1', '<b>Standard MMU.3.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_mmu_3_1()
    {
        return $this->get_property('mmu_3_1')->get_value();
    }

    public function set_hospital_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_1', 'There is a process for storage of medications and nutrition products that require special consideration.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3_1()
    {
        return $this->get_property('hospital_3_1')->get_value();
    }

    public function set_mmu_3_2()
    {
        $property = new \Orm_Property_Fixedtext('mmu_3_2', '<b>Standard MMU.3.2</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_mmu_3_2()
    {
        return $this->get_property('mmu_3_2')->get_value();
    }

    public function set_hospital_3_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_2', 'Emergency medications are available, monitored, and safe when stored out of the pharmacy.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3_2()
    {
        return $this->get_property('hospital_3_2')->get_value();
    }

    public function set_mmu_3_3()
    {
        $property = new \Orm_Property_Fixedtext('mmu_3_3', '<b>Standard MMU.3.3</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_mmu_3_3()
    {
        return $this->get_property('mmu_3_3')->get_value();
    }

    public function set_hospital_3_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_3', 'The hospital has a medication recall system.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3_3()
    {
        return $this->get_property('hospital_3_3')->get_value();
    }

    /*
     * 
     */

    public function set_goal_4()
    {
        $property = new \Orm_Property_Fixedtext('goal_4', '<b>Ordering and Transcribing</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_goal_4()
    {
        return $this->get_property('goal_4')->get_value();
    }

    public function set_mmu_4()
    {
        $property = new \Orm_Property_Fixedtext('mmu_4', '<b>Standard MMU.4</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_mmu_4()
    {
        return $this->get_property('mmu_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'Prescribing, ordering, and transcribing are guided by policies and procedures.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_mmu_4_1()
    {
        $property = new \Orm_Property_Fixedtext('mmu_4_1', '<b>Standard MMU.4.1</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_mmu_4_1()
    {
        return $this->get_property('mmu_4_1')->get_value();
    }

    public function set_hospital_4_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_1', 'The hospital defines the elements of a complete order or prescription.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_1()
    {
        return $this->get_property('hospital_4_1')->get_value();
    }

    public function set_mmu_4_2()
    {
        $property = new \Orm_Property_Fixedtext('mmu_4_2', '<b>Standard MMU.4.2</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_mmu_4_2()
    {
        return $this->get_property('mmu_4_2')->get_value();
    }

    public function set_hospital_4_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_2', 'The hospital identifies those qualified individuals permitted to prescribe or to order medications.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_2()
    {
        return $this->get_property('hospital_4_2')->get_value();
    }

    public function set_mmu_4_3()
    {
        $property = new \Orm_Property_Fixedtext('mmu_4_3', '<b>Standard MMU.4.3</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_mmu_4_3()
    {
        return $this->get_property('mmu_4_3')->get_value();
    }

    public function set_hospital_4_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_3', 'Medications prescribed and administered are written in the patient’s record.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_3()
    {
        return $this->get_property('hospital_4_3')->get_value();
    }

    /*
     * 
     */

    public function set_goal_5()
    {
        $property = new \Orm_Property_Fixedtext('goal_5', '<b>Preparing and Dispensing</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_goal_5()
    {
        return $this->get_property('goal_5')->get_value();
    }

    public function set_mmu_5()
    {
        $property = new \Orm_Property_Fixedtext('mmu_5', '<b>Standard MMU.5</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_mmu_5()
    {
        return $this->get_property('mmu_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'Medications are prepared and dispensed in a safe and clean environment.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_mmu_5_1()
    {
        $property = new \Orm_Property_Fixedtext('mmu_5_1', '<b>Standard MMU.5.1</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_mmu_5_1()
    {
        return $this->get_property('mmu_5_1')->get_value();
    }

    public function set_hospital_5_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_1', 'Medication prescriptions or orders are reviewed for appropriateness.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5_1()
    {
        return $this->get_property('hospital_5_1')->get_value();
    }

    public function set_mmu_5_2()
    {
        $property = new \Orm_Property_Fixedtext('mmu_5_2', '<b>Standard MMU.5.2</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_mmu_5_2()
    {
        return $this->get_property('mmu_5_2')->get_value();
    }

    public function set_hospital_5_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_2', 'A system is used to dispense medications in the right dose to the right patient at the right time.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5_2()
    {
        return $this->get_property('hospital_5_2')->get_value();
    }

    public function set_goal_6()
    {
        $property = new \Orm_Property_Fixedtext('goal_6', '<b>Administration</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_goal_6()
    {
        return $this->get_property('goal_6')->get_value();
    }

    public function set_mmu_6()
    {
        $property = new \Orm_Property_Fixedtext('mmu_6', '<b>Standard MMU.6</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_mmu_6()
    {
        return $this->get_property('mmu_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'The hospital identifies those qualified individuals permitted to administer medications.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    public function set_mmu_6_1()
    {
        $property = new \Orm_Property_Fixedtext('mmu_6_1', '<b>Standard MMU.6.1</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_mmu_6_1()
    {
        return $this->get_property('mmu_6_1')->get_value();
    }

    public function set_hospital_6_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_1', 'Medication administration includes a process to verify the medication is correct based on the medication prescription or order.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_6_1()
    {
        return $this->get_property('hospital_6_1')->get_value();
    }

    public function set_mmu_6_2()
    {
        $property = new \Orm_Property_Fixedtext('mmu_6_2', '<b>Standard MMU.6.2</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_mmu_6_2()
    {
        return $this->get_property('mmu_6_2')->get_value();
    }

    public function set_hospital_6_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_2', 'Policies and procedures govern medications brought into the hospital for patient self-administration or as samples.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_6_2()
    {
        return $this->get_property('hospital_6_2')->get_value();
    }

    public function set_goal_7()
    {
        $property = new \Orm_Property_Fixedtext('goal_7', '<b>Monitoring</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_goal_7()
    {
        return $this->get_property('goal_7')->get_value();
    }

    public function set_mmu_7()
    {
        $property = new \Orm_Property_Fixedtext('mmu_7', '<b>Standard MMU.7</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_mmu_7()
    {
        return $this->get_property('mmu_7')->get_value();
    }

    public function set_hospital_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7', 'Medication effects on patients are monitored.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_7()
    {
        return $this->get_property('hospital_7')->get_value();
    }

    public function set_mmu_7_1()
    {
        $property = new \Orm_Property_Fixedtext('mmu_7_1', '<b>Standard MMU.7.1</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_mmu_7_1()
    {
        return $this->get_property('mmu_7_1')->get_value();
    }

    public function set_hospital_7_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_1', 'The hospital establishes and implements a process for reporting and acting on medication errors and near misses.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_7_1()
    {
        return $this->get_property('hospital_7_1')->get_value();
    }

}
