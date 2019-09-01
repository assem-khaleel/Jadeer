<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_2_aop
 *
 * @author ahmadgx
 */
class Jci_Section_2_Aop extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Assessment of Patients (AOP)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_aop_1('');
            $this->set_hospital_1('');
            $this->set_aop_1_1('');
            $this->set_hospital_1_1('');
            $this->set_aop_1_2('');
            $this->set_hospital_1_2('');
            $this->set_aop_1_2_1('');
            $this->set_hospital_1_2_1('');
            $this->set_aop_1_3('');
            $this->set_hospital_1_3('');
            $this->set_aop_1_3_1('');
            $this->set_hospital_1_3_1('');
            $this->set_aop_1_4('');
            $this->set_hospital_1_4('');
            $this->set_aop_1_5('');
            $this->set_hospital_1_5('');
            $this->set_aop_1_6('');
            $this->set_hospital_1_6('');
            $this->set_aop_1_7('');
            $this->set_hospital_1_7('');
            $this->set_aop_1_8('');
            $this->set_hospital_1_8('');
            /**/
            $this->set_aop_2('');
            $this->set_hospital_2('');
            /**/
            $this->set_aop_3('');
            $this->set_hospital_3('');
            /**/
            $this->set_aop_4('');
            $this->set_hospital_4('');
            /**/
            $this->set_goals_5('');
            $this->set_aop_5('');
            $this->set_hospital_5('');
            $this->set_aop_5_1('');
            $this->set_hospital_5_1('');
            $this->set_aop_5_2('');
            $this->set_hospital_5_2('');
            $this->set_aop_5_3('');
            $this->set_hospital_5_3('');
            $this->set_aop_5_3_1('');
            $this->set_hospital_5_3_1('');
            $this->set_aop_5_4('');
            $this->set_hospital_5_4('');
            $this->set_aop_5_5('');
            $this->set_hospital_5_5('');
            $this->set_aop_5_6('');
            $this->set_hospital_5_6('');
            $this->set_aop_5_7('');
            $this->set_hospital_5_7('');
            $this->set_aop_5_8('');
            $this->set_hospital_5_8('');
            $this->set_aop_5_9('');
            $this->set_hospital_5_9('');
            $this->set_aop_5_9_1('');
            $this->set_hospital_5_9_1('');
            $this->set_aop_5_10('');
            $this->set_hospital_5_10('');
            $this->set_aop_5_10_1('');
            $this->set_hospital_5_10_1('');
            $this->set_goals_5_11('');
            $this->set_aop_5_11('');
            $this->set_hospital_5_11('');
            /**/
            $this->set_goals_6('');
            $this->set_aop_6('');
            $this->set_hospital_6('');
            $this->set_aop_6_1('');
            $this->set_hospital_6_1('');
            $this->set_aop_6_2('');
            $this->set_hospital_6_2('');
            $this->set_aop_6_3('');
            $this->set_hospital_6_3('');
            $this->set_aop_6_4('');
            $this->set_hospital_6_4('');
            $this->set_aop_6_5('');
            $this->set_hospital_6_5('');
            $this->set_aop_6_6('');
            $this->set_hospital_6_6('');
            $this->set_aop_6_7('');
            $this->set_hospital_6_7('');
            $this->set_aop_6_8('');
            $this->set_hospital_6_8('');
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

    public function set_aop_1()
    {
        $property = new \Orm_Property_Fixedtext('aop_1', '<b>Standard AOP.1</b>');
        $this->set_property($property);
    }

    public function get_aop_1()
    {
        return $this->get_property('aop_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'All patients cared for by the hospital have their health care needs identified through an assessment process that has been defined by the hospital.');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_aop_1_1()
    {
        $property = new \Orm_Property_Fixedtext('aop_1_1', '<b>Standard AOP.1.1</b>');
        $this->set_property($property);
    }

    public function get_aop_1_1()
    {
        return $this->get_property('aop_1_1')->get_value();
    }

    public function set_hospital_1_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_1', 'Each patient’s initial assessment includes an evaluation of physical, psychological, social, and economic factors, including a physical examination and health history.');
        $this->set_property($property);
    }

    public function get_hospital_1_1()
    {
        return $this->get_property('hospital_1_1')->get_value();
    }

    public function set_aop_1_2()
    {
        $property = new \Orm_Property_Fixedtext('aop_1_2', '<b>Standard AOP.1.2</b>');
        $this->set_property($property);
    }

    public function get_aop_1_2()
    {
        return $this->get_property('aop_1_2')->get_value();
    }

    public function set_hospital_1_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_2', 'The patient’s medical and nursing needs are identified from the initial assessments, which are completed and documented in the clinical record within the first 24 hours after admission as an inpatient or earlier as indicated by the patient’s condition.');
        $this->set_property($property);
    }

    public function get_hospital_1_2()
    {
        return $this->get_property('hospital_1_2')->get_value();
    }

    public function set_aop_1_2_1()
    {
        $property = new \Orm_Property_Fixedtext('aop_1_2_1', '<b>Standard AOP.1.2.1</b>');
        $this->set_property($property);
    }

    public function get_aop_1_2_1()
    {
        return $this->get_property('aop_1_2_1')->get_value();
    }

    public function set_hospital_1_2_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_2_1', 'The initial medical and nursing assessments of emergency patients are based on their needs and conditions');
        $this->set_property($property);
    }

    public function get_hospital_1_2_1()
    {
        return $this->get_property('hospital_1_2_1')->get_value();
    }

    public function set_aop_1_3()
    {
        $property = new \Orm_Property_Fixedtext('aop_1_3', '<b>Standard AOP.1.3</b>');
        $this->set_property($property);
    }

    public function get_aop_1_3()
    {
        return $this->get_property('aop_1_3')->get_value();
    }

    public function set_hospital_1_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_3', 'The hospital has a process for accepting initial medical assessments conducted in a physician’s private office or other outpatient setting prior to admission or outpatient procedure.');
        $this->set_property($property);
    }

    public function get_hospital_1_3()
    {
        return $this->get_property('hospital_1_3')->get_value();
    }

    public function set_aop_1_3_1()
    {
        $property = new \Orm_Property_Fixedtext('aop_1_3_1', '<b>Standard AOP.1.3.1</b>');
        $this->set_property($property);
    }

    public function get_aop_1_3_1()
    {
        return $this->get_property('aop_1_3_1')->get_value();
    }

    public function set_hospital_1_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_3_1', 'A preoperative assessment is documented before anesthesia or surgical treatment and includes the patient’s medical, physical, psychological, and spiritual/cultural needs.');
        $this->set_property($property);
    }

    public function get_hospital_1_3_1()
    {
        return $this->get_property('hospital_1_3_1')->get_value();
    }

    public function set_aop_1_4()
    {
        $property = new \Orm_Property_Fixedtext('aop_1_4', '<b>Standard AOP.1.4</b>');
        $this->set_property($property);
    }

    public function get_aop_1_4()
    {
        return $this->get_property('aop_1_4')->get_value();
    }

    public function set_hospital_1_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_4', 'Patients are screened for nutritional status, functional needs, and other special needs and are referred for further assessment and treatment when necessary.');
        $this->set_property($property);
    }

    public function get_hospital_1_4()
    {
        return $this->get_property('hospital_1_4')->get_value();
    }

    public function set_aop_1_5()
    {
        $property = new \Orm_Property_Fixedtext('aop_1_5', '<b>Standard AOP.1.5</b>');
        $this->set_property($property);
    }

    public function get_aop_1_5()
    {
        return $this->get_property('aop_1_5')->get_value();
    }

    public function set_hospital_1_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_5', 'All inpatients and outpatients are screened for pain and assessed when pain is present.');
        $this->set_property($property);
    }

    public function get_hospital_1_5()
    {
        return $this->get_property('hospital_1_5')->get_value();
    }

    public function set_aop_1_6()
    {
        $property = new \Orm_Property_Fixedtext('aop_1_6', '<b>Standard AOP.1.6</b>');
        $this->set_property($property);
    }

    public function get_aop_1_6()
    {
        return $this->get_property('aop_1_6')->get_value();
    }

    public function set_hospital_1_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_6', 'The hospital conducts individualized initial assessments for special populations cared for by the hospital.');
        $this->set_property($property);
    }

    public function get_hospital_1_6()
    {
        return $this->get_property('hospital_1_6')->get_value();
    }

    public function set_aop_1_7()
    {
        $property = new \Orm_Property_Fixedtext('aop_1_7', '<b>Standard AOP.1.7</b>');
        $this->set_property($property);
    }

    public function get_aop_1_7()
    {
        return $this->get_property('aop_1_7')->get_value();
    }

    public function set_hospital_1_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_7', 'Dying patients and their families are assessed and reassessed according to their individualized needs.');
        $this->set_property($property);
    }

    public function get_hospital_1_7()
    {
        return $this->get_property('hospital_1_7')->get_value();
    }

    public function set_aop_1_8()
    {
        $property = new \Orm_Property_Fixedtext('aop_1_8', '<b>Standard AOP.1.8</b>');
        $this->set_property($property);
    }

    public function get_aop_1_8()
    {
        return $this->get_property('aop_1_8')->get_value();
    }

    public function set_hospital_1_8()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_8', 'The initial assessment includes determining the need for discharge planning.');
        $this->set_property($property);
    }

    public function get_hospital_1_8()
    {
        return $this->get_property('hospital_1_8')->get_value();
    }

    /*
     * 
     */

    public function set_aop_2()
    {
        $property = new \Orm_Property_Fixedtext('aop_2', '<b>Standard AOP.2</b>');
        $this->set_property($property);
    }

    public function get_aop_2()
    {
        return $this->get_property('aop_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'All patients are reassessed at intervals based on their condition and treatment to determine their response to treatment and to plan for continued treatment or discharge.');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    /*
     * 
     */

    public function set_aop_3()
    {
        $property = new \Orm_Property_Fixedtext('aop_3', '<b>Standard AOP.3</b>');
        $this->set_property($property);
    }

    public function get_aop_3()
    {
        return $this->get_property('aop_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'Qualified individuals conduct the assessments and reassessments.');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    /*
     * 
     */

    public function set_aop_4()
    {
        $property = new \Orm_Property_Fixedtext('aop_4', '<b>Standard AOP.4</b>');
        $this->set_property($property);
    }

    public function get_aop_4()
    {
        return $this->get_property('aop_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'Medical, nursing, and other individuals and services responsible for patient care collaborate to analyze and integrate patient assessments and prioritize the most urgent/important patient care needs.');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    /*
     * 
     */

    public function set_goals_5()
    {
        $property = new \Orm_Property_Fixedtext('goals_5', '<b>Laboratory Services</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goals_5()
    {
        return $this->get_property('goals_5')->get_value();
    }

    public function set_aop_5()
    {
        $property = new \Orm_Property_Fixedtext('aop_5', '<b>Standard AOP.5</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5()
    {
        return $this->get_property('aop_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'Laboratory services are available to meet patient needs, and all such services meet applicable local and national standards, laws, and regulations.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_aop_5_1()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_1', '<b>Standard AOP.5.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_1()
    {
        return $this->get_property('aop_5_1')->get_value();
    }

    public function set_hospital_5_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_1', 'A qualified individual(s) is responsible for managing the clinical laboratory service or pathology service');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_1()
    {
        return $this->get_property('hospital_5_1')->get_value();
    }

    public function set_aop_5_2()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_2', '<b>Standard AOP.5.2</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_2()
    {
        return $this->get_property('aop_5_2')->get_value();
    }

    public function set_hospital_5_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_2', 'All laboratory staff have the required education, training, qualifications, and experience to administer and perform the tests and interpret the results.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_2()
    {
        return $this->get_property('hospital_5_2')->get_value();
    }

    public function set_aop_5_3()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_3', '<b>Standard AOP.5.3</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_3()
    {
        return $this->get_property('aop_5_3')->get_value();
    }

    public function set_hospital_5_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_3', 'A laboratory safety program is in place, followed, and documented, and compliance with the facility management and infection control programs is maintained.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_3()
    {
        return $this->get_property('hospital_5_3')->get_value();
    }

    public function set_aop_5_3_1()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_3_1', '<b>Standard AOP.5.3.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_3_1()
    {
        return $this->get_property('aop_5_3_1')->get_value();
    }

    public function set_hospital_5_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_3_1', 'The laboratory uses a coordinated process to reduce the risks of infection as a result of exposure to biohazardous materials and waste.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_3_1()
    {
        return $this->get_property('hospital_5_3_1')->get_value();
    }

    public function set_aop_5_4()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_4', '<b>Standard AOP.5.4</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_4()
    {
        return $this->get_property('aop_5_4')->get_value();
    }

    public function set_hospital_5_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_4', 'Laboratory results are available in a timely way as defined by the hospital.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_4()
    {
        return $this->get_property('hospital_5_4')->get_value();
    }

    public function set_aop_5_5()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_5', '<b>Standard AOP.5.5</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_5()
    {
        return $this->get_property('aop_5_5')->get_value();
    }

    public function set_hospital_5_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_5', 'All equipment and medical technology used for laboratory testing is regularly inspected, maintained, and calibrated, and appropriate records are maintained for these activities.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_5()
    {
        return $this->get_property('hospital_5_5')->get_value();
    }

    public function set_aop_5_6()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_6', '<b>Standard AOP.5.6</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_6()
    {
        return $this->get_property('aop_5_6')->get_value();
    }

    public function set_hospital_5_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_6', 'Essential reagents and other supplies are regularly available and evaluated to ensure accuracy and precision of results.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_6()
    {
        return $this->get_property('hospital_5_6')->get_value();
    }

    public function set_aop_5_7()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_7', '<b>Standard AOP.5.7</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_7()
    {
        return $this->get_property('aop_5_7')->get_value();
    }

    public function set_hospital_5_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_7', 'Procedures for collecting, identifying, handling, safely transporting, and disposing of specimens are established and implemented.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_7()
    {
        return $this->get_property('hospital_5_7')->get_value();
    }

    public function set_aop_5_8()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_8', '<b>Standard AOP.5.8</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_8()
    {
        return $this->get_property('aop_5_8')->get_value();
    }

    public function set_hospital_5_8()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_8', 'Established norms and ranges are used to interpret and to report clinical laboratory results.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_8()
    {
        return $this->get_property('hospital_5_8')->get_value();
    }

    public function set_aop_5_9()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_9', '<b>Standard AOP.5.9</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_9()
    {
        return $this->get_property('aop_5_9')->get_value();
    }

    public function set_hospital_5_9()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_9', 'Quality control procedures for laboratory services are in place, followed, and documented.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_9()
    {
        return $this->get_property('hospital_5_9')->get_value();
    }

    public function set_aop_5_9_1()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_9_1', '<b>Standard AOP.5.9.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_9_1()
    {
        return $this->get_property('aop_5_9_!')->get_value();
    }

    public function set_hospital_5_9_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_9_1', 'There is a process for proficiency testing of laboratory services.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_9_1()
    {
        return $this->get_property('hospital_5_9_1')->get_value();
    }

    public function set_aop_5_10()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_10', '<b>Standard AOP.5.10</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_10()
    {
        return $this->get_property('aop_5_10')->get_value();
    }

    public function set_hospital_5_10()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_10', 'Reference (contract) laboratories used by the hospital are licensed, accredited, or certified by a recognized authority.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_10()
    {
        return $this->get_property('hospital_5_10')->get_value();
    }

    public function set_aop_5_10_1()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_10_1', '<b>Standard AOP.5.10.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_aop_5_10_1()
    {
        return $this->get_property('aop_5_10_1')->get_value();
    }

    public function set_hospital_5_10_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_10_1', 'The hospital identifies measures for monitoring the quality of the services to be provided by the reference (contract) laboratory.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5_10_1()
    {
        return $this->get_property('hospital_5_10_1')->get_value();
    }

    public function set_goals_5_11()
    {
        $property = new \Orm_Property_Fixedtext('goals_5_11', '<b>Blood Bank and/or Transfusion Services</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_goals_5_11()
    {
        return $this->get_property('goals_5_11')->get_value();
    }

    public function set_aop_5_11()
    {
        $property = new \Orm_Property_Fixedtext('aop_5_11', '<b>Standard AOP.5.11</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_aop_5_11()
    {
        return $this->get_property('aop_5_11')->get_value();
    }

    public function set_hospital_5_11()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_11', 'A qualified individual is responsible for blood bank and/or transfusion services and ensures that services adhere to laws and regulations and recognized standards of practice.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_5_11()
    {
        return $this->get_property('hospital_5_11')->get_value();
    }

    /*
     * 
     */

    public function set_goals_6()
    {
        $property = new \Orm_Property_Fixedtext('goals_6', '<b>Radiology and Diagnostic Imaging Services</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_goals_6()
    {
        return $this->get_property('goals_6')->get_value();
    }

    public function set_aop_6()
    {
        $property = new \Orm_Property_Fixedtext('aop_6', '<b>Standard AOP.6</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_aop_6()
    {
        return $this->get_property('aop_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'Radiology and diagnostic imaging services are available to meet patient needs, and all such services meet applicable local and national standards, laws, and regulations.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    public function set_aop_6_1()
    {
        $property = new \Orm_Property_Fixedtext('aop_6_1', '<b>Standard AOP.6.1</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_aop_6_1()
    {
        return $this->get_property('aop_6_1')->get_value();
    }

    public function set_hospital_6_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_1', 'A qualified individual(s) is responsible for managing the radiology and diagnostic imaging services.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_6_1()
    {
        return $this->get_property('hospital_6_1')->get_value();
    }

    public function set_aop_6_2()
    {
        $property = new \Orm_Property_Fixedtext('aop_6_2', '<b>Standard AOP.6.2</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_aop_6_2()
    {
        return $this->get_property('aop_6_2')->get_value();
    }

    public function set_hospital_6_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_2', 'Individuals with proper qualifications and experience perform diagnostic imaging studies, interpret the results, and report the results.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_6_2()
    {
        return $this->get_property('hospital_6_2')->get_value();
    }

    public function set_aop_6_3()
    {
        $property = new \Orm_Property_Fixedtext('aop_6_3', '<b>Standard AOP.6.3</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_aop_6_3()
    {
        return $this->get_property('aop_6_3')->get_value();
    }

    public function set_hospital_6_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_3', 'Radiation safety program is in place, followed, and documented, and compliance with the facility management sand infection control programs is maintained.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_6_3()
    {
        return $this->get_property('hospital_6_3')->get_value();
    }

    public function set_aop_6_4()
    {
        $property = new \Orm_Property_Fixedtext('aop_6_4', '<b>Standard AOP.6.4</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_aop_6_4()
    {
        return $this->get_property('aop_6_4')->get_value();
    }

    public function set_hospital_6_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_4', 'Laboratory results are available in a timely way as defined by the hospital.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_6_4()
    {
        return $this->get_property('hospital_6_4')->get_value();
    }

    public function set_aop_6_5()
    {
        $property = new \Orm_Property_Fixedtext('aop_6_5', '<b>Standard AOP.6.5</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_aop_6_5()
    {
        return $this->get_property('aop_6_5')->get_value();
    }

    public function set_hospital_6_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_5', 'All equipment and medical technology used for laboratory testing is regularly inspected, maintained, and calibrated, and appropriate records are maintained for these activities.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_6_5()
    {
        return $this->get_property('hospital_6_5')->get_value();
    }

    public function set_aop_6_6()
    {
        $property = new \Orm_Property_Fixedtext('aop_6_6', '<b>Standard AOP.6.6</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_aop_6_6()
    {
        return $this->get_property('aop_6_6')->get_value();
    }

    public function set_hospital_6_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_6', 'X-ray film and other supplies are regularly available.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_6_6()
    {
        return $this->get_property('hospital_6_6')->get_value();
    }

    public function set_aop_6_7()
    {
        $property = new \Orm_Property_Fixedtext('aop_6_7', '<b>Standard AOP.6.7</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_aop_6_7()
    {
        return $this->get_property('aop_6_7')->get_value();
    }

    public function set_hospital_6_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_7', 'Quality control procedures are in place, followed, and documented.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_6_7()
    {
        return $this->get_property('hospital_6_7')->get_value();
    }

    public function set_aop_6_8()
    {
        $property = new \Orm_Property_Fixedtext('aop_6_8', '<b>Standard AOP.6.8</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_aop_6_8()
    {
        return $this->get_property('aop_6_8')->get_value();
    }

    public function set_hospital_6_8()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_8', 'The hospital regularly reviews quality control results for all outside sources of diagnostic services.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_6_8()
    {
        return $this->get_property('hospital_6_8')->get_value();
    }

}
