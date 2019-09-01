<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_3_gld
 *
 * @author ahmadgx
 */
class Jci_Section_3_Gld extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Governance, Leadership, and Direction (GLD)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_goal_1('');
            $this->set_gld_1('');
            $this->set_hospital_1('');
            $this->set_gld_1_1('');
            $this->set_hospital_1_1('');
            $this->set_gld_1_2('');
            $this->set_hospital_1_2('');
            /**/
            $this->set_goal_2('');
            $this->set_gld_2('');
            $this->set_hospital_2('');
            /**/
            $this->set_goal_3('');
            $this->set_gld_3('');
            $this->set_hospital_3('');
            $this->set_gld_3_1('');
            $this->set_hospital_3_1('');
            $this->set_gld_3_2('');
            $this->set_hospital_3_2('');
            $this->set_gld_3_3('');
            $this->set_hospital_3_3('');
            /**/
            $this->set_goal_4('');
            $this->set_gld_4('');
            $this->set_hospital_4('');
            $this->set_gld_4_1('');
            $this->set_hospital_4_1('');
            $this->set_gld_5('');
            $this->set_hospital_5('');
            /**/
            $this->set_goal_5('');
            $this->set_gld_6('');
            $this->set_hospital_6('');
            $this->set_gld_6_1('');
            $this->set_hospital_6_1('');
            $this->set_gld_6_2('');
            $this->set_hospital_6_2('');
            /**/
            $this->set_goal_6('');
            $this->set_gld_7('');
            $this->set_hospital_7('');
            $this->set_gld_7_1('');
            $this->set_hospital_7_1('');
            /**/
            $this->set_goal_7('');
            $this->set_gld_8('');
            $this->set_hospital_8('');
            /**/
            $this->set_goal_8('');
            $this->set_gld_9('');
            $this->set_hospital_9('');
            $this->set_gld_10('');
            $this->set_hospital_10('');
            $this->set_gld_11('');
            $this->set_hospital_11('');
            $this->set_gld_11_1('');
            $this->set_hospital_11_1('');
            $this->set_gld_11_2('');
            $this->set_hospital_11_2('');
            /**/
            $this->set_goal_9('');
            $this->set_gld_12('');
            $this->set_hospital_12('');
            $this->set_gld_12_1('');
            $this->set_hospital_12_1('');
            $this->set_gld_12_2('');
            $this->set_hospital_12_2('');
            $this->set_gld_13('');
            $this->set_hospital_13('');
            $this->set_gld_13_1('');
            $this->set_hospital_13_1('');
            /**/
            $this->set_goal_10('');
            $this->set_note_10('');
            $this->set_gld_14('');
            $this->set_hospital_14('');
            /**/
            $this->set_goal_11('');
            $this->set_note_11('');
            $this->set_gld_15('');
            $this->set_hospital_15('');
            $this->set_gld_16('');
            $this->set_hospital_16('');
            $this->set_gld_17('');
            $this->set_hospital_17('');
            $this->set_gld_18('');
            $this->set_hospital_18('');
            $this->set_gld_19('');
            $this->set_hospital_19('');
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

    /*
     * 
     */

    public function set_goal_1()
    {
        $property = new \Orm_Property_Fixedtext('goal_1', '<b>Governance of the Hospital</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_goal_1()
    {
        return $this->get_property('goal_1')->get_value();
    }

    public function set_gld_1()
    {
        $property = new \Orm_Property_Fixedtext('gld_1', '<b>Standard GLD.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_gld_1()
    {
        return $this->get_property('gld_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'Governance structure and authority are described in bylaws, policies and procedures, or similar documents.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_gld_1_1()
    {
        $property = new \Orm_Property_Fixedtext('gld_1_1', '<b>Standard GLD.1.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_gld_1_1()
    {
        return $this->get_property('gld_1_1')->get_value();
    }

    public function set_hospital_1_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_1', 'The operational responsibilities and accountabilities of the governing entity are described in a written document(s).');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1_1()
    {
        return $this->get_property('hospital_1_1')->get_value();
    }

    public function set_gld_1_2()
    {
        $property = new \Orm_Property_Fixedtext('gld_1_2', '<b>Standard GLD.1.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_gld_1_2()
    {
        return $this->get_property('gld_1_2')->get_value();
    }

    public function set_hospital_1_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_2', 'Those responsible for governance approve the hospital’s program for quality and patient safety and regularly receive and act on reports of the quality and patient safety program.');
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

    public function set_goal_2()
    {
        $property = new \Orm_Property_Fixedtext('goal_2', '<b>Chief Executive(s) Accountabilities</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goal_2()
    {
        return $this->get_property('goal_2')->get_value();
    }

    public function set_gld_2()
    {
        $property = new \Orm_Property_Fixedtext('gld_2', '<b>Standard GLD.2</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_gld_2()
    {
        return $this->get_property('gld_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'A chief executive(s) is responsible for operating the hospital and complying with applicable laws and regulations.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    /*
     * 
     */

    public function set_goal_3()
    {
        $property = new \Orm_Property_Fixedtext('goal_3', '<b>Hospital Leadership Accountabilities</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_goal_3()
    {
        return $this->get_property('goal_3')->get_value();
    }

    public function set_gld_3()
    {
        $property = new \Orm_Property_Fixedtext('gld_3', '<b>Standard GLD.3</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_gld_3()
    {
        return $this->get_property('gld_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'Hospital leadership is identified and is collectively responsible for defining the hospital’s mission and creating the programs and policies needed to fulfill the mission.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    public function set_gld_3_1()
    {
        $property = new \Orm_Property_Fixedtext('gld_3_1', '<b>Standard GLD.3.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_gld_3_1()
    {
        return $this->get_property('gld_3_1')->get_value();
    }

    public function set_hospital_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_1', 'Hospital leadership identifies and plans for the type of clinical services required to meet the needs of the patients served by the hospital.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3_1()
    {
        return $this->get_property('hospital_3_1')->get_value();
    }

    public function set_gld_3_2()
    {
        $property = new \Orm_Property_Fixedtext('gld_3_2', '<b>Standard GLD.3.2</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_gld_3_2()
    {
        return $this->get_property('gld_3_2')->get_value();
    }

    public function set_hospital_3_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_2', 'Hospital leadership ensures effective communication throughout the hospital.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3_2()
    {
        return $this->get_property('hospital_3_2')->get_value();
    }

    public function set_gld_3_3()
    {
        $property = new \Orm_Property_Fixedtext('gld_3_3', '<b>Standard GLD.3.3</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_gld_3_3()
    {
        return $this->get_property('gld_3_3')->get_value();
    }

    public function set_hospital_3_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_3', 'Hospital leadership ensures that there are uniform programs for the recruitment, retention, development, and continuing education of all staff.');
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
        $property = new \Orm_Property_Fixedtext('goal_4', '<b>Hospital Leadership for Quality and Patient Safety</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_goal_4()
    {
        return $this->get_property('goal_4')->get_value();
    }

    public function set_gld_4()
    {
        $property = new \Orm_Property_Fixedtext('gld_4', '<b>Standard GLD.4</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_gld_4()
    {
        return $this->get_property('gld_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'Hospital leadership plans, develops, and implements a quality improvement and patient safety program.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_gld_4_1()
    {
        $property = new \Orm_Property_Fixedtext('gld_4_1', '<b>Standard GLD.4.1</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_gld_4_1()
    {
        return $this->get_property('gld_4_1')->get_value();
    }

    public function set_hospital_4_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_1', 'Hospital leadership communicates quality improvement and patient safety information to governance and hospital staff on a regular basis.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_4_1()
    {
        return $this->get_property('hospital_4_1')->get_value();
    }

    public function set_gld_5()
    {
        $property = new \Orm_Property_Fixedtext('gld_5', '<b>Standard GLD.5</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_gld_5()
    {
        return $this->get_property('gld_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'Hospital leadership prioritizes which hospitalwide processes will be measured, which hospitalwide improvement and patient safety activities will be implemented, and how success of these hospitalwide efforts will be measured.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    /*
     * 
     */

    public function set_goal_5()
    {
        $property = new \Orm_Property_Fixedtext('goal_5', '<b>Hospital Leadership for Contracts</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_goal_5()
    {
        return $this->get_property('goal_5')->get_value();
    }

    public function set_gld_6()
    {
        $property = new \Orm_Property_Fixedtext('gld_6', '<b>Standard GLD.6</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_gld_6()
    {
        return $this->get_property('gld_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'Hospital leadership is accountable for the review, selection, and monitoring of clinical or nonclinical contracts.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    public function set_gld_6_1()
    {
        $property = new \Orm_Property_Fixedtext('gld_6_1', '<b>Standard GLD.6.1</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_gld_6_1()
    {
        return $this->get_property('gld_6_1')->get_value();
    }

    public function set_hospital_6_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_1', 'Hospital leadership ensures that contracts and other arrangements are included as part of the hospital’s quality improvement and patient safety program.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_6_1()
    {
        return $this->get_property('hospital_6_1')->get_value();
    }

    public function set_gld_6_2()
    {
        $property = new \Orm_Property_Fixedtext('gld_6_2', '<b>Standard GLD.6.2</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_gld_6_2()
    {
        return $this->get_property('gld_6_2')->get_value();
    }

    public function set_hospital_6_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_2', 'Hospital leadership ensures that independent practitioners not employed by the hospital have the right credentials for the services provided to the hospital’s patients.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_6_2()
    {
        return $this->get_property('hospital_6_2')->get_value();
    }

    /*
     * 
     */

    public function set_goal_6()
    {
        $property = new \Orm_Property_Fixedtext('goal_6', '<b>Hospital Leadership for Resource Decisions</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_goal_6()
    {
        return $this->get_property('goal_6')->get_value();
    }

    public function set_gld_7()
    {
        $property = new \Orm_Property_Fixedtext('gld_7', '<b>Standard GLD.7</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_gld_7()
    {
        return $this->get_property('gld_7')->get_value();
    }

    public function set_hospital_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7', 'Hospital leadership makes decisions related to the purchase or use of resources—human and technical—with an understanding of the quality and safety implications of those decisions.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_7()
    {
        return $this->get_property('hospital_7')->get_value();
    }

    public function set_gld_7_1()
    {
        $property = new \Orm_Property_Fixedtext('gld_7_1', '<b>Standard GLD.7.1</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_gld_7_1()
    {
        return $this->get_property('gld_7_1')->get_value();
    }

    public function set_hospital_7_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_1', 'Hospital leadership seeks and uses data and information on the safety of the supply chain for drugs, medical technology, and supplies to protect patients and staff from contaminated, fake, and diverted products.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_7_1()
    {
        return $this->get_property('hospital_7_1')->get_value();
    }

    /*
     * 
     */

    public function set_goal_7()
    {
        $property = new \Orm_Property_Fixedtext('goal_7', '<b>Clinical Staff Organization and Accountabilities</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_goal_7()
    {
        return $this->get_property('goal_7')->get_value();
    }

    public function set_gld_8()
    {
        $property = new \Orm_Property_Fixedtext('gld_8', '<b>Standard GLD.8</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_gld_8()
    {
        return $this->get_property('gld_8')->get_value();
    }

    public function set_hospital_8()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8', 'Medical, nursing, and other leaders of departments and clinical services plan and implement a professional staff structure to support their responsibilities and authority.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_8()
    {
        return $this->get_property('hospital_8')->get_value();
    }

    /*
     * 
     */

    public function set_goal_8()
    {
        $property = new \Orm_Property_Fixedtext('goal_8', '<b>Direction of Hospital Departments and Services</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_goal_8()
    {
        return $this->get_property('goal_8')->get_value();
    }

    public function set_gld_9()
    {
        $property = new \Orm_Property_Fixedtext('gld_9', '<b>Standard GLD.9</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_gld_9()
    {
        return $this->get_property('gld_9')->get_value();
    }

    public function set_hospital_9()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9', 'One or more qualified individuals provide direction for each department or service in the hospital.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_9()
    {
        return $this->get_property('hospital_9')->get_value();
    }

    public function set_gld_10()
    {
        $property = new \Orm_Property_Fixedtext('gld_10', '<b>Standard GLD.10</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_gld_10()
    {
        return $this->get_property('gld_10')->get_value();
    }

    public function set_hospital_10()
    {
        $property = new \Orm_Property_Fixedtext('hospital_10', 'Each department/service leader identifies, in writing, the services to be provided by the department, and integrates or coordinates those services with the services of other departments.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_10()
    {
        return $this->get_property('hospital_10')->get_value();
    }

    public function set_gld_11()
    {
        $property = new \Orm_Property_Fixedtext('gld_11', '<b>Standard GLD.11</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_gld_11()
    {
        return $this->get_property('gld_11')->get_value();
    }

    public function set_hospital_11()
    {
        $property = new \Orm_Property_Fixedtext('hospital_11', 'Department/service leaders improve quality and patient safety by participating in hospitalwide improvement priorities and in monitoring and improving patient care specific to the department/service.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_11()
    {
        return $this->get_property('hospital_11')->get_value();
    }

    public function set_gld_11_1()
    {
        $property = new \Orm_Property_Fixedtext('gld_11_1', '<b>Standard GLD.11.1</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_gld_11_1()
    {
        return $this->get_property('gld_11_1')->get_value();
    }

    public function set_hospital_11_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_11_1', 'Department/service leaders of clinical departments or services select and implement quality and patient safety measures specific to the scope of services provided by the department or service and useful in the evaluation of the physicians, nurses, and other professional staff participating in the clinical care processes.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_11_1()
    {
        return $this->get_property('hospital_11_1')->get_value();
    }

    public function set_gld_11_2()
    {
        $property = new \Orm_Property_Fixedtext('gld_11_2', '<b>Standard GLD.11.2</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_gld_11_2()
    {
        return $this->get_property('gld_11_2')->get_value();
    }

    public function set_hospital_11_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_11_2', 'Department/service leaders select and implement clinical practice guidelines, and related clinical pathways, and/or clinical protocols, to guide clinical care.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_11_2()
    {
        return $this->get_property('hospital_11_2')->get_value();
    }

    /*
     * 
     */

    public function set_goal_9()
    {
        $property = new \Orm_Property_Fixedtext('goal_9', '<b>Organizational and Clinical Ethics</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_goal_9()
    {
        return $this->get_property('goal_9')->get_value();
    }

    public function set_gld_12()
    {
        $property = new \Orm_Property_Fixedtext('gld_12', '<b>Standard GLD.12</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_gld_12()
    {
        return $this->get_property('gld_12')->get_value();
    }

    public function set_hospital_12()
    {
        $property = new \Orm_Property_Fixedtext('hospital_12', 'Hospital leadership establishes a framework for ethical management that promotes a culture of ethical practices and decision making to ensure that patient care is provided within business, financial, ethical, and legal norms and protects patients and their rights.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_12()
    {
        return $this->get_property('hospital_12')->get_value();
    }

    public function set_gld_12_1()
    {
        $property = new \Orm_Property_Fixedtext('gld_12_1', '<b>Standard GLD.12.1</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_gld_12_1()
    {
        return $this->get_property('gld_12_1')->get_value();
    }

    public function set_hospital_12_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_12_1', 'The hospital’s framework for ethical management addresses operational and business issues, including marketing, admissions, transfer, discharge, and disclosure of ownership and any business and professional conflicts that may not be in patients’ best interests.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_12_1()
    {
        return $this->get_property('hospital_12_1')->get_value();
    }

    public function set_gld_12_2()
    {
        $property = new \Orm_Property_Fixedtext('gld_12_2', '<b>Standard GLD.12.2</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_gld_12_2()
    {
        return $this->get_property('gld_12_2')->get_value();
    }

    public function set_hospital_12_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_12_2', 'The hospital’s framework for ethical management addresses ethical issues and decision making in clinical care.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_12_2()
    {
        return $this->get_property('hospital_12_2')->get_value();
    }

    public function set_gld_13()
    {
        $property = new \Orm_Property_Fixedtext('gld_13', '<b>Standard GLD.13</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_gld_13()
    {
        return $this->get_property('gld_13')->get_value();
    }

    public function set_hospital_13()
    {
        $property = new \Orm_Property_Fixedtext('hospital_13', 'Hospital leadership creates and supports a culture of safety program throughout the hospital.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_13()
    {
        return $this->get_property('hospital_13')->get_value();
    }

    public function set_gld_13_1()
    {
        $property = new \Orm_Property_Fixedtext('gld_13_1', '<b>Standard GLD.13.1</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_gld_13_1()
    {
        return $this->get_property('gld_13_1')->get_value();
    }

    public function set_hospital_13_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_13_1', 'Hospital leadership implements, monitors, and takes action to improve the program for a culture of safety throughout the hospital.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_13_1()
    {
        return $this->get_property('hospital_13_1')->get_value();
    }

    /*
     * 
     */

    public function set_goal_10()
    {
        $property = new \Orm_Property_Fixedtext('goal_10', '<b>Health Professional Education and Human Subjects Research</b>');
        $property->set_group('group_10');
        $this->set_property($property);
    }

    public function get_goal_10()
    {
        return $this->get_property('goal_10')->get_value();
    }

    public function set_note_10()
    {
        $property = new \Orm_Property_Fixedtext('note_10', '<b>Note:</b>This standard applies to hospitals that provide health professional education but do not meet the eligibility criteria for Academic Medical Center Hospital accreditation.');
        $property->set_group('group_10');
        $this->set_property($property);
    }

    public function get_note_10()
    {
        return $this->get_property('note_10')->get_value();
    }

    public function set_gld_14()
    {
        $property = new \Orm_Property_Fixedtext('gld_14', '<b>Standard GLD.14</b>');
        $property->set_group('group_10');
        $this->set_property($property);
    }

    public function get_gld_14()
    {
        return $this->get_property('gld_14')->get_value();
    }

    public function set_hospital_14()
    {
        $property = new \Orm_Property_Fixedtext('hospital_14', 'Health professional education, when provided within the hospital, is guided by the educational parameters defined by the sponsoring academic program and the hospital’s leadership.');
        $property->set_group('group_10');
        $this->set_property($property);
    }

    public function get_hospital_14()
    {
        return $this->get_property('hospital_14')->get_value();
    }

    /*
     * 
     */

    public function set_goal_11()
    {
        $property = new \Orm_Property_Fixedtext('goal_11', '<b>Human Subjects Research</b>');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_goal_11()
    {
        return $this->get_property('goal_11')->get_value();
    }

    public function set_note_11()
    {
        $property = new \Orm_Property_Fixedtext('note_11', '<b>Note:</b>This standard applies to hospitals that conduct human subjects research but do not meet the eligibility criteria for Academic Medical Center Hospital accreditation.');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_note_11()
    {
        return $this->get_property('note_11')->get_value();
    }

    public function set_gld_15()
    {
        $property = new \Orm_Property_Fixedtext('gld_15', '<b>Standard GLD.15</b>');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_gld_15()
    {
        return $this->get_property('gld_15')->get_value();
    }

    public function set_hospital_15()
    {
        $property = new \Orm_Property_Fixedtext('hospital_15', 'Human subjects research, when provided within the hospital, is guided by laws, regulations, and hospital leadership.');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_hospital_15()
    {
        return $this->get_property('hospital_15')->get_value();
    }

    public function set_gld_16()
    {
        $property = new \Orm_Property_Fixedtext('gld_16', '<b>Standard GLD.16</b>');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_gld_16()
    {
        return $this->get_property('gld_16')->get_value();
    }

    public function set_hospital_16()
    {
        $property = new \Orm_Property_Fixedtext('hospital_16', 'Patients and families are informed about how to gain access to clinical research, clinical investigation, or clinical trials involving human subjects.');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_hospital_16()
    {
        return $this->get_property('hospital_16')->get_value();
    }

    public function set_gld_17()
    {
        $property = new \Orm_Property_Fixedtext('gld_17', '<b>Standard GLD.17</b>');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_gld_17()
    {
        return $this->get_property('gld_17')->get_value();
    }

    public function set_hospital_17()
    {
        $property = new \Orm_Property_Fixedtext('hospital_17', 'Patients and families are informed about how patients who choose to participate in clinical research, clinical investigations, or clinical trials are protected.');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_hospital_17()
    {
        return $this->get_property('hospital_17')->get_value();
    }

    public function set_gld_18()
    {
        $property = new \Orm_Property_Fixedtext('gld_18', '<b>Standard GLD.18</b>');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_gld_18()
    {
        return $this->get_property('gld_18')->get_value();
    }

    public function set_hospital_18()
    {
        $property = new \Orm_Property_Fixedtext('hospital_18', 'Informed consent is obtained before a patient participates in clinical research, clinical investigations, or clinical trials.');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_hospital_18()
    {
        return $this->get_property('hospital_18')->get_value();
    }

    public function set_gld_19()
    {
        $property = new \Orm_Property_Fixedtext('gld_19', '<b>Standard GLD.19</b>');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_gld_19()
    {
        return $this->get_property('gld_19')->get_value();
    }

    public function set_hospital_19()
    {
        $property = new \Orm_Property_Fixedtext('hospital_19', 'The hospital has a committee or another way to oversee all research in the hospital involving human subjects.');
        $property->set_group('group_11');
        $this->set_property($property);
    }

    public function get_hospital_19()
    {
        return $this->get_property('hospital_19')->get_value();
    }

}
