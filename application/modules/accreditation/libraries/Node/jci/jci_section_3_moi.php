<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_3_moi
 *
 * @author ahmadgx
 */
class Jci_Section_3_Moi extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Management of Information (MOI)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_goal_1('');
            $this->set_moi_1('');
            $this->set_hospital_1('');
            $this->set_moi_2('');
            $this->set_hospital_2('');
            $this->set_moi_3('');
            $this->set_hospital_3('');
            $this->set_moi_4('');
            $this->set_hospital_4('');
            $this->set_moi_5('');
            $this->set_hospital_5('');
            $this->set_moi_6('');
            $this->set_hospital_6('');
            $this->set_moi_7('');
            $this->set_hospital_7('');
            $this->set_moi_8('');
            $this->set_hospital_8('');
            /**/
            $this->set_goal_2('');
            $this->set_moi_9('');
            $this->set_hospital_9('');
            $this->set_moi_9_1('');
            $this->set_hospital_9_1('');
            /**/
            $this->set_goal_3('');
            $this->set_moi_10('');
            $this->set_hospital_10('');
            $this->set_moi_10_1('');
            $this->set_hospital_10_1('');
            $this->set_moi_10_1_1('');
            $this->set_hospital_10_1_1('');
            $this->set_moi_11('');
            $this->set_hospital_11('');
            $this->set_moi_11_1('');
            $this->set_hospital_11_1('');
            $this->set_moi_12('');
            $this->set_hospital_12('');
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
        $property = new \Orm_Property_Fixedtext('goal_1', '<b>Information Management</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_goal_1()
    {
        return $this->get_property('goal_1')->get_value();
    }

    public function set_moi_1()
    {
        $property = new \Orm_Property_Fixedtext('moi_1', '<b>Standard MOI.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_moi_1()
    {
        return $this->get_property('moi_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'The hospital plans and designs information management processes to meet internal and external information needs.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_moi_2()
    {
        $property = new \Orm_Property_Fixedtext('moi_2', '<b>Standard MOI.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_moi_2()
    {
        return $this->get_property('moi_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'Information privacy, confidentiality, and securityincluding data integrityare maintained.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_moi_3()
    {
        $property = new \Orm_Property_Fixedtext('moi_3', '<b>Standard MOI.3</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_moi_3()
    {
        return $this->get_property('moi_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'The hospital determines the retention time of records, data, and information.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    public function set_moi_4()
    {
        $property = new \Orm_Property_Fixedtext('moi_4', '<b>Standard MOI.4</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_moi_4()
    {
        return $this->get_property('moi_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'The hospital uses standardized diagnosis codes, procedure codes, symbols, abbreviations, and definitions.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_moi_5()
    {
        $property = new \Orm_Property_Fixedtext('moi_5', '<b>Standard MOI.5</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_moi_5()
    {
        return $this->get_property('moi_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'The data and information needs of those in and outside the hospital are met on a timely basis in a format that meets user expectations and with the desired frequency.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_moi_6()
    {
        $property = new \Orm_Property_Fixedtext('moi_6', '<b>Standard MOI.6</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_moi_6()
    {
        return $this->get_property('moi_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'Health information technology systems are assessed and tested prior to implementation within the hospital and evaluated for quality and patient safety following implementation.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    public function set_moi_7()
    {
        $property = new \Orm_Property_Fixedtext('moi_7', '<b>Standard MOI.7</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_moi_7()
    {
        return $this->get_property('moi_7')->get_value();
    }

    public function set_hospital_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7', 'Records and information are protected from loss, destruction, tampering, and unauthorized access or use.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_7()
    {
        return $this->get_property('hospital_7')->get_value();
    }

    public function set_moi_8()
    {
        $property = new \Orm_Property_Fixedtext('moi_8', '<b>Standard MOI.8</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_moi_8()
    {
        return $this->get_property('moi_8')->get_value();
    }

    public function set_hospital_8()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8', 'Decision makers and other staff members are educated and trained in the principles of information use and management.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_8()
    {
        return $this->get_property('hospital_8')->get_value();
    }

    /*
     * 
     */

    public function set_goal_2()
    {
        $property = new \Orm_Property_Fixedtext('goal_2', '<b>Management and Implementation of Documents</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goal_2()
    {
        return $this->get_property('goal_2')->get_value();
    }

    public function set_moi_9()
    {
        $property = new \Orm_Property_Fixedtext('moi_9', '<b>Standard MOI.9</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_moi_9()
    {
        return $this->get_property('moi_9')->get_value();
    }

    public function set_hospital_9()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9', 'Written documents, including policies, procedures, and programs, are managed in a consistent and uniform manner.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_9()
    {
        return $this->get_property('hospital_9')->get_value();
    }

    public function set_moi_9_1()
    {
        $property = new \Orm_Property_Fixedtext('moi_9_1', '<b>Standard MOI.9.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_moi_9_1()
    {
        return $this->get_property('moi_9_1')->get_value();
    }

    public function set_hospital_9_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9_1', 'The policies, procedures, plans, and other documents that guide consistent and uniform clinical and nonclinical processes and practices are fully implemented.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_9_1()
    {
        return $this->get_property('hospital_9_1')->get_value();
    }

    /*
     * 
     */

    public function set_goal_3()
    {
        $property = new \Orm_Property_Fixedtext('goal_3', '<b>Patient Clinical Record</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_goal_3()
    {
        return $this->get_property('goal_3')->get_value();
    }

    public function set_moi_10()
    {
        $property = new \Orm_Property_Fixedtext('moi_10', '<b>Standard MOI.10</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_moi_10()
    {
        return $this->get_property('moi_10')->get_value();
    }

    public function set_hospital_10()
    {
        $property = new \Orm_Property_Fixedtext('hospital_10', 'The hospital initiates and maintains a standardized clinical record for every patient assessed or treated and determines the record’s content, format, and location of entries.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_10()
    {
        return $this->get_property('hospital_10')->get_value();
    }

    public function set_moi_10_1()
    {
        $property = new \Orm_Property_Fixedtext('moi_10_1', '<b>Standard MOI.10.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_moi_10_1()
    {
        return $this->get_property('moi_10_1')->get_value();
    }

    public function set_hospital_10_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_10_1', 'The clinical record contains sufficient information to identify the patient, to support the diagnosis, to justify the treatment, and to document the course and results of treatment.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_10_1()
    {
        return $this->get_property('hospital_10_1')->get_value();
    }

    public function set_moi_10_1_1()
    {
        $property = new \Orm_Property_Fixedtext('moi_10_1_1', '<b>Standard MOI.10.1.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_moi_10_1_1()
    {
        return $this->get_property('moi_10_1_1')->get_value();
    }

    public function set_hospital_10_1_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_10_1_1', 'The clinical records of patients receiving emergency care include the time of arrival and departure, the conclusions at termination of treatment, the patient’s condition at discharge, and follow-up care instructions.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_10_1_1()
    {
        return $this->get_property('hospital_10_1_1')->get_value();
    }

    public function set_moi_11()
    {
        $property = new \Orm_Property_Fixedtext('moi_11', '<b>Standard MOI.11</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_moi_11()
    {
        return $this->get_property('moi_11')->get_value();
    }

    public function set_hospital_11()
    {
        $property = new \Orm_Property_Fixedtext('hospital_11', 'The hospital identifies those authorized to make entries in the patient clinical record.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_11()
    {
        return $this->get_property('hospital_11')->get_value();
    }

    public function set_moi_11_1()
    {
        $property = new \Orm_Property_Fixedtext('moi_11_1', '<b>Standard MOI.11.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_moi_11_1()
    {
        return $this->get_property('moi_11_1')->get_value();
    }

    public function set_hospital_11_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_11_1', 'Every patient clinical record entry identifies its author and when the entry was made in the record.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_11_1()
    {
        return $this->get_property('hospital_11_1')->get_value();
    }

    public function set_moi_12()
    {
        $property = new \Orm_Property_Fixedtext('moi_12', '<b>Standard MOI.12</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_moi_12()
    {
        return $this->get_property('moi_12')->get_value();
    }

    public function set_hospital_12()
    {
        $property = new \Orm_Property_Fixedtext('hospital_12', 'As part of its monitoring and performance improvement activities, the hospital regularly assesses patient clinical record content and the completeness of patient clinical records.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_12()
    {
        return $this->get_property('hospital_12')->get_value();
    }

}
