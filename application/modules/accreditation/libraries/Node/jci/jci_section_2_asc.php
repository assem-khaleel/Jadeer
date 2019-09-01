<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_2_asc
 *
 * @author ahmadgx
 */
class Jci_Section_2_Asc extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Anesthesia and Surgical Care (ASC)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_note('');
            $this->set_goals('');
            /**/
            $this->set_goal_1('');
            $this->set_asc_1('');
            $this->set_hospital_1('');
            $this->set_asc_2('');
            $this->set_hospital_2('');
            /**/
            $this->set_goal_2('');
            $this->set_asc_3('');
            $this->set_hospital_3('');
            $this->set_asc_3_1('');
            $this->set_hospital_3_1('');
            $this->set_asc_3_2('');
            $this->set_hospital_3_2('');
            $this->set_asc_3_3('');
            $this->set_hospital_3_3('');
            /**/
            $this->set_goal_3('');
            $this->set_asc_4('');
            $this->set_hospital_4('');
            $this->set_asc_5('');
            $this->set_hospital_5('');
            $this->set_asc_5_1('');
            $this->set_hospital_5_1('');
            $this->set_asc_6('');
            $this->set_hospital_6('');
            $this->set_asc_6_1('');
            $this->set_hospital_6_1('');
            /**/
            $this->set_goal_4('');
            $this->set_asc_7('');
            $this->set_hospital_7('');
            $this->set_asc_7_1('');
            $this->set_hospital_7_1('');
            $this->set_asc_7_2('');
            $this->set_hospital_7_2('');
            $this->set_asc_7_3('');
            $this->set_hospital_7_3('');
            $this->set_asc_7_4('');
            $this->set_hospital_7_4('');
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', '<b>Note:</b>The anesthesia and surgery standards are applicable in any setting in which anesthesia and/or procedural sedation are used, and surgical and other invasive procedures that require consent (also see PFR.5.2) are performed. Such settings include hospital operating theatres, day surgery and day hospital units, dental and other outpatient clinics, emergency services, intensive care areas, and others. These standards do not address the use of minimal sedation (anxiolysis). Definitions of the levels of sedation can be found in the Glossary.');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
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

    public function set_asc_1()
    {
        $property = new \Orm_Property_Fixedtext('asc_1', '<b>Standard ASC.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_asc_1()
    {
        return $this->get_property('asc_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'Sedation and anesthesia services are available to meet patient needs, and all such services meet professional Fstandards and applicable local and national standards, laws, and regulations.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_asc_2()
    {
        $property = new \Orm_Property_Fixedtext('asc_2', '<b>Standard ASC.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_asc_2()
    {
        return $this->get_property('asc_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'A qualified individual(s) is responsible for managing the sedation and anesthesia services.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    /*
     * 
     */

    public function set_goal_2()
    {
        $property = new \Orm_Property_Fixedtext('goal_2', '<b>Sedation Care</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goal_2()
    {
        return $this->get_property('goal_2')->get_value();
    }

    public function set_asc_3()
    {
        $property = new \Orm_Property_Fixedtext('asc_3', '<b>Standard ASC.3</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_asc_3()
    {
        return $this->get_property('asc_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'The administration of procedural sedation is standardized throughout the hospital.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    public function set_asc_3_1()
    {
        $property = new \Orm_Property_Fixedtext('asc_3_1', '<b>Standard ASC.3.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_asc_3_1()
    {
        return $this->get_property('asc_3_1')->get_value();
    }

    public function set_hospital_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_1', 'Practitioners responsible for procedural sedation and individuals responsible for monitoring patients receiving sedation are qualified.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_3_1()
    {
        return $this->get_property('hospital_3_1')->get_value();
    }

    public function set_asc_3_2()
    {
        $property = new \Orm_Property_Fixedtext('asc_3_2', '<b>Standard ASC.3.2</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_asc_3_2()
    {
        return $this->get_property('asc_3_2')->get_value();
    }

    public function set_hospital_3_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_2', 'Procedural sedation is administered and monitored according to professional practice guidelines.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_3_2()
    {
        return $this->get_property('hospital_3_2')->get_value();
    }

    public function set_asc_3_3()
    {
        $property = new \Orm_Property_Fixedtext('asc_3_3', '<b>Standard ASC.3.3</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_asc_3_3()
    {
        return $this->get_property('asc_3_3')->get_value();
    }

    public function set_hospital_3_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_3', 'The risks, benefits, and alternatives related to procedural sedation are discussed with the patient, his or her family, or those who make decisions for the patient.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_3_3()
    {
        return $this->get_property('hospital_3_3')->get_value();
    }

    /*
     * 
     */

    public function set_goal_3()
    {
        $property = new \Orm_Property_Fixedtext('goal_3', '<b>Anesthesia Care</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_goal_3()
    {
        return $this->get_property('goal_3')->get_value();
    }

    public function set_asc_4()
    {
        $property = new \Orm_Property_Fixedtext('asc_4', '<b>Standard ASC.4</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_asc_4()
    {
        return $this->get_property('asc_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'A qualified individual conducts a preanesthesia assessment and preinduction assessment.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_asc_5()
    {
        $property = new \Orm_Property_Fixedtext('asc_5', '<b>Standard ASC.5</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_asc_5()
    {
        return $this->get_property('asc_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'Each patient’s anesthesia care is planned and documented, and the anesthesia and technique used are documented in the patient’s record.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_asc_5_1()
    {
        $property = new \Orm_Property_Fixedtext('asc_5_1', '<b>Standard ASC.5.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_asc_5_1()
    {
        return $this->get_property('asc_5_1')->get_value();
    }

    public function set_hospital_5_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_1', 'The risks, benefits, and alternatives related to anesthesia are discussed with the patient, his or her family, or those who make decisions for the patient.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_5_1()
    {
        return $this->get_property('hospital_5_1')->get_value();
    }

    public function set_asc_6()
    {
        $property = new \Orm_Property_Fixedtext('asc_6', '<b>Standard ASC.6</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_asc_6()
    {
        return $this->get_property('asc_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'Each patient’s physiological status during anesthesia and surgery is monitored according to professional practice guidelines and documented in the patient’s record.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    public function set_asc_6_1()
    {
        $property = new \Orm_Property_Fixedtext('asc_6_1', '<b>Standard ASC.6.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_asc_6_1()
    {
        return $this->get_property('asc_6_1')->get_value();
    }

    public function set_hospital_6_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_1', 'Each patient’s postanesthesia status is monitored and documented, and the patient is discharged from the recovery area by a qualified individual or by using established criteria.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_6_1()
    {
        return $this->get_property('hospital_6_1')->get_value();
    }

    /*
     * 
     */

    public function set_goal_4()
    {
        $property = new \Orm_Property_Fixedtext('goal_4', '<b>Surgical Care</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_goal_4()
    {
        return $this->get_property('goal_4')->get_value();
    }

    public function set_asc_7()
    {
        $property = new \Orm_Property_Fixedtext('asc_7', '<b>Standard ASC.7</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_asc_7()
    {
        return $this->get_property('asc_7')->get_value();
    }

    public function set_hospital_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7', 'Each patient’s surgical care is planned and documented based on the results of the assessment.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_7()
    {
        return $this->get_property('hospital_7')->get_value();
    }

    public function set_asc_7_1()
    {
        $property = new \Orm_Property_Fixedtext('asc_7_1', '<b>Standard ASC.7.1</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_asc_7_1()
    {
        return $this->get_property('asc_7_1')->get_value();
    }

    public function set_hospital_7_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_1', 'The risks, benefits, and alternatives are discussed with the patient and his or her family or those who make decisions for the patient.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_7_1()
    {
        return $this->get_property('hospital_7_1')->get_value();
    }

    public function set_asc_7_2()
    {
        $property = new \Orm_Property_Fixedtext('asc_7_2', '<b>Standard ASC.7.2</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_asc_7_2()
    {
        return $this->get_property('asc_7_2')->get_value();
    }

    public function set_hospital_7_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_2', 'Information about the surgical procedure is documented in the patient’s record to facilitate continuing care.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_7_2()
    {
        return $this->get_property('hospital_7_2')->get_value();
    }

    public function set_asc_7_3()
    {
        $property = new \Orm_Property_Fixedtext('asc_7_3', '<b>Standard ASC.7.3</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_asc_7_3()
    {
        return $this->get_property('asc_7_3')->get_value();
    }

    public function set_hospital_7_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_3', 'Patient care after surgery is planned and documented.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_7_3()
    {
        return $this->get_property('hospital_7_3')->get_value();
    }

    public function set_asc_7_4()
    {
        $property = new \Orm_Property_Fixedtext('asc_7_4', '<b>Standard ASC.7.4</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_asc_7_4()
    {
        return $this->get_property('asc_7_4')->get_value();
    }

    public function set_hospital_7_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_4', 'Surgical care that includes the implanting of a medical device is planned with special consideration of how standard processes and procedures must be modified.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_7_4()
    {
        return $this->get_property('hospital_7_4')->get_value();
    }

}
