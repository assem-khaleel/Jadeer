<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_3_sqe
 *
 * @author ahmadgx
 */
class Jci_Section_3_Sqe extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Staff Qualifications and Education (SQE)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_goal_1('');
            $this->set_sqe_1('');
            $this->set_hospital_1('');
            $this->set_sqe_1_1('');
            $this->set_hospital_1_1('');
            $this->set_sqe_2('');
            $this->set_hospital_2('');
            $this->set_sqe_3('');
            $this->set_hospital_3('');
            $this->set_sqe_4('');
            $this->set_hospital_4('');
            $this->set_sqe_5('');
            $this->set_hospital_5('');
            $this->set_sqe_6('');
            $this->set_hospital_6('');
            $this->set_sqe_6_1('');
            $this->set_hospital_6_1('');
            $this->set_sqe_7('');
            $this->set_hospital_7('');
            $this->set_sqe_8('');
            $this->set_hospital_8('');
            $this->set_sqe_8_1('');
            $this->set_hospital_8_1('');
            $this->set_sqe_8_2('');
            $this->set_hospital_8_2('');
            /**/
            $this->set_goal_2('');
            $this->set_sqe_9('');
            $this->set_hospital_9('');
            $this->set_sqe_9_1('');
            $this->set_hospital_9_1('');
            $this->set_sqe_9_2('');
            $this->set_hospital_9_2('');
            /**/
            $this->set_goal_3('');
            $this->set_sqe_10('');
            $this->set_hospital_10('');
            /**/
            $this->set_goal_4('');
            $this->set_sqe_11('');
            $this->set_hospital_11('');
            /**/
            $this->set_goal_5('');
            $this->set_sqe_12('');
            $this->set_hospital_12('');
            /**/
            $this->set_goal_6('');
            $this->set_sqe_13('');
            $this->set_hospital_13('');
            $this->set_sqe_14('');
            $this->set_hospital_14('');
            $this->set_sqe_14_1('');
            $this->set_hospital_14_1('');
            /**/
            $this->set_goal_7('');
            $this->set_sqe_15('');
            $this->set_hospital_15('');
            $this->set_sqe_16('');
            $this->set_hospital_16('');
            $this->set_sqe_16_1('');
            $this->set_hospital_16_1('');
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
        $property = new \Orm_Property_Fixedtext('goal_1', '<b>Planning</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_goal_1()
    {
        return $this->get_property('goal_1')->get_value();
    }

    public function set_sqe_1()
    {
        $property = new \Orm_Property_Fixedtext('sqe_1', '<b>Standard SQE.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_1()
    {
        return $this->get_property('sqe_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'Leaders of hospital departments and services define the desired education, skills, knowledge, and other requirements of all staff members.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_sqe_1_1()
    {
        $property = new \Orm_Property_Fixedtext('sqe_1_1', '<b>Standard SQE.1.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_1_1()
    {
        return $this->get_property('sqe_1_1')->get_value();
    }

    public function set_hospital_1_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_1', 'Each staff member’s responsibilities are defined in a current job description.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1_1()
    {
        return $this->get_property('hospital_1_1')->get_value();
    }

    public function set_sqe_2()
    {
        $property = new \Orm_Property_Fixedtext('sqe_2', '<b>Standard SQE.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_2()
    {
        return $this->get_property('sqe_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'Leaders of hospital departments and services develop and implement processes for recruiting, evaluating, and appointing staff as well as other related procedures identified by the hospital.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_sqe_3()
    {
        $property = new \Orm_Property_Fixedtext('sqe_3', '<b>Standard SQE.3</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_3()
    {
        return $this->get_property('sqe_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'The hospital uses a defined process to ensure that clinical staff knowledge and skills are consistent with patient needs.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    public function set_sqe_4()
    {
        $property = new \Orm_Property_Fixedtext('sqe_4', '<b>Standard SQE.4</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_4()
    {
        return $this->get_property('sqe_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'The hospital uses a defined process to ensure that nonclinical staff knowledge and skills are consistent with hospital needs and the requirements of the position.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_sqe_5()
    {
        $property = new \Orm_Property_Fixedtext('sqe_5', '<b>Standard SQE.5</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_5()
    {
        return $this->get_property('sqe_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'There is documented personnel information for each staff member.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_sqe_6()
    {
        $property = new \Orm_Property_Fixedtext('sqe_6', '<b>Standard SQE.6</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_6()
    {
        return $this->get_property('sqe_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'A staffing strategy for the hospital, developed by the leaders of hospital departments and services, identifies the number, types, and desired qualifications of staff.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    public function set_sqe_6_1()
    {
        $property = new \Orm_Property_Fixedtext('sqe_6_1', '<b>Standard SQE.6.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_6_1()
    {
        return $this->get_property('sqe_6_1')->get_value();
    }

    public function set_hospital_6_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_1', 'The staffing strategy is reviewed on an ongoing basis and updated as necessary.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_6_1()
    {
        return $this->get_property('hospital_6_1')->get_value();
    }

    public function set_sqe_7()
    {
        $property = new \Orm_Property_Fixedtext('sqe_7', '<b>Standard SQE.7</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_7()
    {
        return $this->get_property('sqe_7')->get_value();
    }

    public function set_hospital_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7', 'All clinical and nonclinical staff members are oriented to the hospital, the department or unit to which they are assigned, and to their specific job responsibilities at appointment to the staff.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_7()
    {
        return $this->get_property('hospital_7')->get_value();
    }

    public function set_sqe_8()
    {
        $property = new \Orm_Property_Fixedtext('sqe_8', '<b>Standard SQE.8</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_8()
    {
        return $this->get_property('sqe_8')->get_value();
    }

    public function set_hospital_8()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8', 'Each staff member receives ongoing in-service and other education and training to maintain or to advance his or her skills and knowledge.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_8()
    {
        return $this->get_property('hospital_8')->get_value();
    }

    public function set_sqe_8_1()
    {
        $property = new \Orm_Property_Fixedtext('sqe_8_1', '<b>Standard SQE.8.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_8_1()
    {
        return $this->get_property('sqe_8_1')->get_value();
    }

    public function set_hospital_8_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8_1', 'Staff members who provide patient care and other staff identified by the hospital are trained and can demonstrate appropriate competence in resuscitative techniques.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_8_1()
    {
        return $this->get_property('hospital_8_1')->get_value();
    }

    public function set_sqe_8_2()
    {
        $property = new \Orm_Property_Fixedtext('sqe_8_2', '<b>Standard SQE.8.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_sqe_8_2()
    {
        return $this->get_property('sqe_8_2')->get_value();
    }

    public function set_hospital_8_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8_2', 'The hospital provides a staff health and safety program.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_8_2()
    {
        return $this->get_property('hospital_8_2')->get_value();
    }

    /*
     * 
     */

    public function set_goal_2()
    {
        $property = new \Orm_Property_Fixedtext('goal_2', '<b>Determining Medical Staff Membership</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goal_2()
    {
        return $this->get_property('goal_2')->get_value();
    }

    public function set_sqe_9()
    {
        $property = new \Orm_Property_Fixedtext('sqe_9', '<b>Standard SQE.9</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_sqe_9()
    {
        return $this->get_property('sqe_9')->get_value();
    }

    public function set_hospital_9()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9', 'The hospital has a uniform process for gathering the credentials of those medical staff members permitted to provide patient care without supervision.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_9()
    {
        return $this->get_property('hospital_9')->get_value();
    }

    public function set_sqe_9_1()
    {
        $property = new \Orm_Property_Fixedtext('sqe_9_1', '<b>Standard SQE.9.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_sqe_9_1()
    {
        return $this->get_property('sqe_9_1')->get_value();
    }

    public function set_hospital_9_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9_1', 'Medical staff members’ education, licensure/registration, and other credentials required by law or regulation and the hospital are verified and kept current.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_9_1()
    {
        return $this->get_property('hospital_9_1')->get_value();
    }

    public function set_sqe_9_2()
    {
        $property = new \Orm_Property_Fixedtext('sqe_9_2', '<b>Standard SQE.9.2</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_sqe_9_2()
    {
        return $this->get_property('sqe_9_2')->get_value();
    }

    public function set_hospital_9_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9_2', 'There is a uniform, transparent decision process for the initial appointment of medical staff members.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_9_2()
    {
        return $this->get_property('hospital_9_2')->get_value();
    }

    /*
     * 
     */

    public function set_goal_3()
    {
        $property = new \Orm_Property_Fixedtext('goal_3', '<b>The Assignment of Medical Staff Clinical Privileges</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_goal_3()
    {
        return $this->get_property('goal_3')->get_value();
    }

    public function set_sqe_10()
    {
        $property = new \Orm_Property_Fixedtext('sqe_10', '<b>Standard SQE.10</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_sqe_10()
    {
        return $this->get_property('sqe_10')->get_value();
    }

    public function set_hospital_10()
    {
        $property = new \Orm_Property_Fixedtext('hospital_10', 'The hospital has a standardized, objective, evidence-based procedure to authorize medical staff members to admit and to treat patients and/or to provide other clinical services consistent with their qualifications.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_10()
    {
        return $this->get_property('hospital_10')->get_value();
    }

    /*
     * 
     */

    public function set_goal_4()
    {
        $property = new \Orm_Property_Fixedtext('goal_4', '<b>Ongoing Monitoring and Evaluation of Medical Staff Members</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_goal_4()
    {
        return $this->get_property('goal_4')->get_value();
    }

    public function set_sqe_11()
    {
        $property = new \Orm_Property_Fixedtext('sqe_11', '<b>Standard SQE.11</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_sqe_11()
    {
        return $this->get_property('sqe_11')->get_value();
    }

    public function set_hospital_11()
    {
        $property = new \Orm_Property_Fixedtext('hospital_11', 'The hospital uses an ongoing standardized process to evaluate the quality and safety of the patient care provided by each medical staff member.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_11()
    {
        return $this->get_property('hospital_11')->get_value();
    }

    /*
     * 
     */

    public function set_goal_5()
    {
        $property = new \Orm_Property_Fixedtext('goal_5', '<b>Medical Staff Reappointment and Renewal of Clinical Privileges</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_goal_5()
    {
        return $this->get_property('goal_5')->get_value();
    }

    public function set_sqe_12()
    {
        $property = new \Orm_Property_Fixedtext('sqe_12', '<b>Standard SQE.12</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_sqe_12()
    {
        return $this->get_property('sqe_12')->get_value();
    }

    public function set_hospital_12()
    {
        $property = new \Orm_Property_Fixedtext('hospital_12', 'At least every three years, the hospital determines, from the ongoing monitoring and evaluation of each medical staff member, if medical staff membership and clinical privileges are to continue with or without modification.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_12()
    {
        return $this->get_property('hospital_12')->get_value();
    }

    /*
     * 
     */

    public function set_goal_6()
    {
        $property = new \Orm_Property_Fixedtext('goal_6', '<b>Nursing Staff</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_goal_6()
    {
        return $this->get_property('goal_6')->get_value();
    }

    public function set_sqe_13()
    {
        $property = new \Orm_Property_Fixedtext('sqe_13', '<b>Standard SQE.13</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_sqe_13()
    {
        return $this->get_property('sqe_13')->get_value();
    }

    public function set_hospital_13()
    {
        $property = new \Orm_Property_Fixedtext('hospital_13', 'The hospital has a uniform process to gather, to verify, and to evaluate the nursing staff’s credentials (license, education, training, and experience).');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_13()
    {
        return $this->get_property('hospital_13')->get_value();
    }

    public function set_sqe_14()
    {
        $property = new \Orm_Property_Fixedtext('sqe_14', '<b>Standard SQE.14</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_sqe_14()
    {
        return $this->get_property('sqe_14')->get_value();
    }

    public function set_hospital_14()
    {
        $property = new \Orm_Property_Fixedtext('hospital_14', 'The hospital has a standardized process to identify job responsibilities and to make clinical work assignments based on the nursing staff member’s credentials and any regulatory requirements.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_14()
    {
        return $this->get_property('hospital_14')->get_value();
    }

    public function set_sqe_14_1()
    {
        $property = new \Orm_Property_Fixedtext('sqe_14_1', '<b>Standard SQE.14.1</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_sqe_14_1()
    {
        return $this->get_property('sqe_14_1')->get_value();
    }

    public function set_hospital_14_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_14_1', 'The hospital has a standardized process for nursing staff participation in the hospital’s quality improvement activities, including evaluating individual performance when indicated.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_14_1()
    {
        return $this->get_property('hospital_14_1')->get_value();
    }

    /*
     * 
     */

    public function set_goal_7()
    {
        $property = new \Orm_Property_Fixedtext('goal_7', '<b>Other Health Care Practitioners</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_goal_7()
    {
        return $this->get_property('goal_7')->get_value();
    }

    public function set_sqe_15()
    {
        $property = new \Orm_Property_Fixedtext('sqe_15', '<b>Standard SQE.15</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_sqe_15()
    {
        return $this->get_property('sqe_15')->get_value();
    }

    public function set_hospital_15()
    {
        $property = new \Orm_Property_Fixedtext('hospital_15', 'The hospital has a uniform process to gather, to verify, and to evaluate other health professional staff members’ credentials (license, education, training, and experience).');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_15()
    {
        return $this->get_property('hospital_15')->get_value();
    }

    public function set_sqe_16()
    {
        $property = new \Orm_Property_Fixedtext('sqe_16', '<b>Standard SQE.16</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_sqe_16()
    {
        return $this->get_property('sqe_16')->get_value();
    }

    public function set_hospital_16()
    {
        $property = new \Orm_Property_Fixedtext('hospital_16', 'The hospital has a uniform process to identify job responsibilities and to make clinical work assignments based on other health professional staff members’ credentials and any regulatory requirements.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_16()
    {
        return $this->get_property('hospital_16')->get_value();
    }

    public function set_sqe_16_1()
    {
        $property = new \Orm_Property_Fixedtext('sqe_16_1', '<b>Standard SQE.16.1</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_sqe_16_1()
    {
        return $this->get_property('sqe_16_1')->get_value();
    }

    public function set_hospital_16_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_16_1', 'The hospital has a uniform process for other health professional staff members’ participation in the hospital’s quality improvement activities.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_16_1()
    {
        return $this->get_property('hospital_16_1')->get_value();
    }

}
