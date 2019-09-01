<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_2_acc
 *
 * @author ahmadgx
 */
class Jci_Section_2_Acc extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Access to Care and Continuity of Care (ACC)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_goals_1('');
            $this->set_acc_1('');
            $this->set_hospital_1('');
            $this->set_acc_1_1('');
            $this->set_hospital_1_1('');
            $this->set_acc_1_2('');
            $this->set_hospital_1_2('');
            /**/
            $this->set_goals_2('');
            $this->set_acc_2('');
            $this->set_hospital_2('');
            $this->set_acc_2_1('');
            $this->set_hospital_2_1('');
            $this->set_acc_2_2('');
            $this->set_hospital_2_2('');
            $this->set_acc_2_2_1('');
            $this->set_hospital_2_2_1('');
            $this->set_acc_2_3('');
            $this->set_hospital_2_3('');
            $this->set_acc_2_3_1('');
            $this->set_hospital_2_3_1('');
            /**/
            $this->set_goals_3('');
            $this->set_acc_3('');
            $this->set_hospital_3('');
            $this->set_acc_3_1('');
            $this->set_hospital_3_1('');
            $this->set_acc_3_2('');
            $this->set_hospital_3_2('');
            /**/
            $this->set_goals_4('');
            $this->set_acc_4('');
            $this->set_hospital_4('');
            $this->set_acc_4_1('');
            $this->set_hospital_4_1('');
            $this->set_acc_4_2('');
            $this->set_hospital_4_2('');
            $this->set_acc_4_3('');
            $this->set_hospital_4_3('');
            $this->set_acc_4_3_1('');
            $this->set_hospital_4_3_1('');
            $this->set_acc_4_3_2('');
            $this->set_hospital_4_3_2('');
            $this->set_acc_4_4('');
            $this->set_hospital_4_4('');
            $this->set_acc_4_5('');
            $this->set_hospital_4_5('');
            $this->set_acc_4_5_1('');
            $this->set_hospital_4_5_1('');
            /**/
            $this->set_goals_5('');
            $this->set_acc_5('');
            $this->set_hospital_5('');
            $this->set_acc_5_1('');
            $this->set_hospital_5_1('');
            $this->set_acc_5_2('');
            $this->set_hospital_5_2('');
            $this->set_acc_5_3('');
            $this->set_hospital_5_3('');
            /**/
            $this->set_goals_6('');
            $this->set_acc_6('');
            $this->set_hospital_6('');
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

    public function set_goals_1()
    {
        $property = new \Orm_Property_Fixedtext('goals_1', '<b>Screening for Admission to the Hospital</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_goals_1()
    {
        return $this->get_property('goals_1')->get_value();
    }

    public function set_acc_1()
    {
        $property = new \Orm_Property_Fixedtext('acc_1', '<b>Standard ACC.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_acc_1()
    {
        return $this->get_property('acc_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'Patients who may be admitted to the hospital or who seek outpatient services are screened to identify if their  health care needs match the hospital’s mission and resources.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_acc_1_1()
    {
        $property = new \Orm_Property_Fixedtext('acc_1_1', '<b>Standard ACC.1.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_acc_1_1()
    {
        return $this->get_property('acc_1_1')->get_value();
    }

    public function set_hospital_1_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_1', 'Patients with emergent, urgent, or immediate needs are given priority for assessment and treatment.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1_1()
    {
        return $this->get_property('hospital_1_1')->get_value();
    }

    public function set_acc_1_2()
    {
        $property = new \Orm_Property_Fixedtext('acc_1_2', '<b>Standard ACC.1.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_acc_1_2()
    {
        return $this->get_property('acc_1_2')->get_value();
    }

    public function set_hospital_1_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_2', 'The hospital considers the clinical needs of patients and informs patients when there are waiting periods or sdelays for diagnostic and/or treatment services.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1_2()
    {
        return $this->get_property('hospital_1_2')->get_value();
    }

    /*
     * 
     */

    public function set_goals_2()
    {
        $property = new \Orm_Property_Fixedtext('goals_2', '<b>Admission to the Hospital</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goals_2()
    {
        return $this->get_property('goals_2')->get_value();
    }

    public function set_acc_2()
    {
        $property = new \Orm_Property_Fixedtext('acc_2', '<b>Standard ACC.2</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_acc_2()
    {
        return $this->get_property('acc_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'The hospital has a process for admitting inpatients and for registering outpatients.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_acc_2_1()
    {
        $property = new \Orm_Property_Fixedtext('acc_2_1', '<b>Standard ACC.2.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_acc_2_1()
    {
        return $this->get_property('acc_2_1')->get_value();
    }

    public function set_hospital_2_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_1', 'Patient needs for preventive, palliative, curative, and rehabilitative services are prioritized based on the patient’s condition at the time of admission as an inpatient to the hospital.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2_1()
    {
        return $this->get_property('hospital_2_1')->get_value();
    }

    public function set_acc_2_2()
    {
        $property = new \Orm_Property_Fixedtext('acc_2_2', '<b>Standard ACC.2.2</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_acc_2_2()
    {
        return $this->get_property('acc_2_2')->get_value();
    }

    public function set_hospital_2_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_2', 'At admission as an inpatient, patients and families receive information on the proposed care, the expected outcomes of care, and any expected cost to the patient for care.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2_2()
    {
        return $this->get_property('hospital_2_2')->get_value();
    }

    public function set_acc_2_2_1()
    {
        $property = new \Orm_Property_Fixedtext('acc_2_2_1', '<b>Standard ACC.2.2.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_acc_2_2_1()
    {
        return $this->get_property('acc_2_2_1')->get_value();
    }

    public function set_hospital_2_2_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_2_1', 'The hospital develops a process to manage the flow of patients throughout the hospital.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2_2_1()
    {
        return $this->get_property('hospital_2_2_1')->get_value();
    }

    public function set_acc_2_3()
    {
        $property = new \Orm_Property_Fixedtext('acc_2_3', '<b>Standard ACC.2.3</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_acc_2_3()
    {
        return $this->get_property('acc_2_3')->get_value();
    }

    public function set_hospital_2_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_3', 'Admission to units providing intensive or specialized services is determined by established criteria.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2_3()
    {
        return $this->get_property('hospital_2_3')->get_value();
    }

    public function set_acc_2_3_1()
    {
        $property = new \Orm_Property_Fixedtext('acc_2_3_1', '<b>Standard ACC.2.3.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_acc_2_3_1()
    {
        return $this->get_property('acc_2_3_1')->get_value();
    }

    public function set_hospital_2_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_3_1', 'Discharge from units providing intensive or specialized services is determined by established criteria.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2_3_1()
    {
        return $this->get_property('hospital_2_3_1')->get_value();
    }

    /*
     * 
     */

    public function set_goals_3()
    {
        $property = new \Orm_Property_Fixedtext('goals_3', '<b>Continuity of Care</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_goals_3()
    {
        return $this->get_property('goals_3')->get_value();
    }

    public function set_acc_3()
    {
        $property = new \Orm_Property_Fixedtext('acc_3', '<b>Standard ACC.3</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_acc_3()
    {
        return $this->get_property('acc_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'The hospital designs and carries out processes to provide continuity of patient care services in the hospital and coordination among health care practitioners.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    public function set_acc_3_1()
    {
        $property = new \Orm_Property_Fixedtext('acc_3_1', '<b>Standard ACC.3.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_acc_3_1()
    {
        return $this->get_property('acc_3_1')->get_value();
    }

    public function set_hospital_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_1', 'During all phases of inpatient care, there is a qualified individual identified as responsible for the patient’s care.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3_1()
    {
        return $this->get_property('hospital_3_1')->get_value();
    }

    public function set_acc_3_2()
    {
        $property = new \Orm_Property_Fixedtext('acc_3_2', '<b>Standard ACC.3.2</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_acc_3_2()
    {
        return $this->get_property('acc_3_2')->get_value();
    }

    public function set_hospital_3_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_2', 'Information related to the patient’s care is transferred with the patient');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3_2()
    {
        return $this->get_property('hospital_3_2')->get_value();
    }

    /*
     * 
     */

    public function set_goals_4()
    {
        $property = new \Orm_Property_Fixedtext('goals_4', '<b>Discharge, Referral, and Follow-Up</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_goals_4()
    {
        return $this->get_property('goals_4')->get_value();
    }

    public function set_acc_4()
    {
        $property = new \Orm_Property_Fixedtext('acc_4', '<b>Standard ACC.4</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_acc_4()
    {
        return $this->get_property('acc_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'There is a process for the referral or discharge of patients that is based on the patient’s health status and the need for continuing care or services.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_acc_4_1()
    {
        $property = new \Orm_Property_Fixedtext('acc_4_1', '<b>Standard ACC.4.1</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_acc_4_1()
    {
        return $this->get_property('acc_4_1')->get_value();
    }

    public function set_hospital_4_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_1', 'Patient and family education and instruction are related to the patient’s continuing care needs.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_1()
    {
        return $this->get_property('hospital_4_1')->get_value();
    }

    public function set_acc_4_2()
    {
        $property = new \Orm_Property_Fixedtext('acc_4_2', '<b>Standard ACC.4.2</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_acc_4_2()
    {
        return $this->get_property('acc_4_2')->get_value();
    }

    public function set_hospital_4_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_2', 'The hospital cooperates with health care practitioners and outside agencies to ensure timely referrals.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_2()
    {
        return $this->get_property('hospital_4_2')->get_value();
    }

    public function set_acc_4_3()
    {
        $property = new \Orm_Property_Fixedtext('acc_4_3', '<b>Standard ACC.4.3</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_acc_4_3()
    {
        return $this->get_property('acc_4_3')->get_value();
    }

    public function set_hospital_4_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_3', 'The complete discharge summary is prepared for all inpatients.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_3()
    {
        return $this->get_property('hospital_4_3')->get_value();
    }

    public function set_acc_4_3_1()
    {
        $property = new \Orm_Property_Fixedtext('acc_4_3_1', '<b>Standard ACC.4.3.1</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_acc_4_3_1()
    {
        return $this->get_property('acc_4_3_1')->get_value();
    }

    public function set_hospital_4_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_3_1', 'Patient education and follow-up instructions are given in a form and language the patient can understand.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_3_1()
    {
        return $this->get_property('hospital_4_3_1')->get_value();
    }

    public function set_acc_4_3_2()
    {
        $property = new \Orm_Property_Fixedtext('acc_4_3_2', '<b>Standard ACC.4.3.2</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_acc_4_3_2()
    {
        return $this->get_property('acc_4_3_2')->get_value();
    }

    public function set_hospital_4_3_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_3_2', 'The clinical records of inpatients contain a copy of the discharge summary.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_3_2()
    {
        return $this->get_property('hospital_4_3_2')->get_value();
    }

    public function set_acc_4_4()
    {
        $property = new \Orm_Property_Fixedtext('acc_4_4', '<b>Standard ACC.4.4</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_acc_4_4()
    {
        return $this->get_property('acc_4_4')->get_value();
    }

    public function set_hospital_4_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_4', 'The records of outpatients requiring complex care or with complex diagnoses contain profiles of the medical care and are made available to health care practitioners providing care to those patients.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_4()
    {
        return $this->get_property('hospital_4_4')->get_value();
    }

    public function set_acc_4_5()
    {
        $property = new \Orm_Property_Fixedtext('acc_4_5', '<b>Standard ACC.4.5</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_acc_4_5()
    {
        return $this->get_property('acc_4_5')->get_value();
    }

    public function set_hospital_4_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_5', 'The hospital has a process for the management and follow-up of patients who notify hospital staff that they intend to leave against medical advice');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_5()
    {
        return $this->get_property('hospital_4_5')->get_value();
    }

    public function set_acc_4_5_1()
    {
        $property = new \Orm_Property_Fixedtext('acc_4_5_1', '<b>Standard ACC.4.5.1</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_acc_4_5_1()
    {
        return $this->get_property('acc_4_5_1')->get_value();
    }

    public function set_hospital_4_5_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_5_1', 'The hospital has a process for the management of patients who leave the hospital against medical advice without notifying hospital staff.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_5_1()
    {
        return $this->get_property('hospital_4_5_1')->get_value();
    }

    /*
     * 
     */

    public function set_goals_5()
    {
        $property = new \Orm_Property_Fixedtext('goals_5', '<b>Transfer of Patients</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_goals_5()
    {
        return $this->get_property('goals_5')->get_value();
    }

    public function set_acc_5()
    {
        $property = new \Orm_Property_Fixedtext('acc_5', '<b>Standard ACC.5</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_acc_5()
    {
        return $this->get_property('acc_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'Patients are transferred to other organizations based on status, the need to meet their continuing care needs, and the ability of the receiving organization to meet patients’ needs.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_acc_5_1()
    {
        $property = new \Orm_Property_Fixedtext('acc_5_1', '<b>Standard ACC.5.1</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_acc_5_1()
    {
        return $this->get_property('acc_5_1')->get_value();
    }

    public function set_hospital_5_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_1', 'The referring hospital develops a transfer process to ensure that patients are transferred safely.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5_1()
    {
        return $this->get_property('hospital_5_1')->get_value();
    }

    public function set_acc_5_2()
    {
        $property = new \Orm_Property_Fixedtext('acc_5_2', '<b>Standard ACC.5.2</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_acc_5_2()
    {
        return $this->get_property('acc_5_2')->get_value();
    }

    public function set_hospital_5_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_2', 'The receiving organization is given a written summary of the patient’s clinical condition and the interventions provided by the referring hospital.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5_2()
    {
        return $this->get_property('hospital_5_2')->get_value();
    }

    public function set_acc_5_3()
    {
        $property = new \Orm_Property_Fixedtext('acc_5_3', '<b>Standard ACC.5.3</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_acc_5_3()
    {
        return $this->get_property('acc_5_3')->get_value();
    }

    public function set_hospital_5_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_3', 'The transfer process is documented in the patient’s record.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5_3()
    {
        return $this->get_property('hospital_5_3')->get_value();
    }

    /*
     * 
     */

    public function set_goals_6()
    {
        $property = new \Orm_Property_Fixedtext('goals_6', '<b>Transportation</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_goals_6()
    {
        return $this->get_property('goals_6')->get_value();
    }

    public function set_acc_6()
    {
        $property = new \Orm_Property_Fixedtext('acc_6', '<b>Standard ACC.6</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_acc_6()
    {
        return $this->get_property('acc_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'The process for referring, transferring, or discharging patients, both inpatients and outpatients, includes planning to meet patients’ transportation needs.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

}
