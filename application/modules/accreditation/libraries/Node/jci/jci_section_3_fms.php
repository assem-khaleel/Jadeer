<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_3_fms
 *
 * @author ahmadgx
 */
class Jci_Section_3_Fms extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Facility Management and Safety (FMS)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_goal_1('');
            $this->set_fms_1('');
            $this->set_hospital_1('');
            $this->set_fms_2('');
            $this->set_hospital_2('');
            $this->set_fms_3('');
            $this->set_hospital_3('');
            /**/
            $this->set_goal_2('');
            $this->set_fms_4('');
            $this->set_hospital_4('');
            $this->set_fms_4_1('');
            $this->set_hospital_4_1('');
            $this->set_fms_4_2('');
            $this->set_hospital_4_2('');
            /**/
            $this->set_goal_3('');
            $this->set_fms_5('');
            $this->set_hospital_5('');
            $this->set_fms_5_1('');
            $this->set_hospital_5_1('');
            /**/
            $this->set_goal_4('');
            $this->set_fms_6('');
            $this->set_hospital_6('');
            /**/
            $this->set_goal_5('');
            $this->set_fms_7('');
            $this->set_hospital_7('');
            $this->set_fms_7_1('');
            $this->set_hospital_7_1('');
            $this->set_fms_7_2('');
            $this->set_hospital_7_2('');
            /**/
            $this->set_goal_6('');
            $this->set_fms_8('');
            $this->set_hospital_8('');
            $this->set_fms_8_1('');
            $this->set_hospital_8_1('');
            /**/
            $this->set_goal_7('');
            $this->set_fms_9('');
            $this->set_hospital_9('');
            $this->set_fms_9_1('');
            $this->set_hospital_9_1('');
            $this->set_fms_9_2('');
            $this->set_hospital_9_2('');
            $this->set_fms_9_2_1('');
            $this->set_hospital_9_2_1('');
            $this->set_fms_9_3('');
            $this->set_hospital_9_3('');
            /**/
            $this->set_goal_8('');
            $this->set_fms_10('');
            $this->set_hospital_10('');
            /**/
            $this->set_goal_9('');
            $this->set_fms_11('');
            $this->set_hospital_11('');
            $this->set_fms_11_1('');
            $this->set_hospital_11_1('');
            $this->set_gld_11_2('');
            $this->set_hospital_11_2('');
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
        $property = new \Orm_Property_Fixedtext('goal_1', '<b>Leadership and Planning</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_goal_1()
    {
        return $this->get_property('goal_1')->get_value();
    }

    public function set_fms_1()
    {
        $property = new \Orm_Property_Fixedtext('fms_1', '<b>Standard FMS.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_fms_1()
    {
        return $this->get_property('fms_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'The hospital complies with relevant laws, regulations, and facility inspection requirements.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_fms_2()
    {
        $property = new \Orm_Property_Fixedtext('fms_2', '<b>Standard FMS.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_fms_2()
    {
        return $this->get_property('fms_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'The hospital develops and maintains a written program(s) describing the processes to manage risks to patients, families, visitors, and staff.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_fms_3()
    {
        $property = new \Orm_Property_Fixedtext('fms_3', '<b>Standard FMS.3</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_fms_3()
    {
        return $this->get_property('fms_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'One or more qualified individuals oversee the planning and implementation of the facility management program to reduce and control risks in the care environment.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    /*
     * 
     */

    public function set_goal_2()
    {
        $property = new \Orm_Property_Fixedtext('goal_2', '<b>Safety and Security</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goal_2()
    {
        return $this->get_property('goal_2')->get_value();
    }

    public function set_fms_4()
    {
        $property = new \Orm_Property_Fixedtext('fms_4', '<b>Standard FMS.4</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_fms_4()
    {
        return $this->get_property('fms_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'The hospital plans and implements a program to provide a safe physical facility through inspection and planning to reduce risks.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_fms_4_1()
    {
        $property = new \Orm_Property_Fixedtext('fms_4_1', '<b>Standard FMS.4.1</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_fms_4_1()
    {
        return $this->get_property('fms_4_1')->get_value();
    }

    public function set_hospital_4_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_1', 'The hospital plans and implements a program to provide a secure environment for patients, families, staff, and visitors.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_4_1()
    {
        return $this->get_property('hospital_4_1')->get_value();
    }

    public function set_fms_4_2()
    {
        $property = new \Orm_Property_Fixedtext('fms_4_2', '<b>Standard FMS.4.2</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_fms_4_2()
    {
        return $this->get_property('fms_4_2')->get_value();
    }

    public function set_hospital_4_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_2', 'The hospital plans and budgets for upgrading or replacing key systems, buildings, or components based on the facility inspection and in keeping with laws and regulations.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_4_2()
    {
        return $this->get_property('hospital_4_2')->get_value();
    }

    /*
     * 
     */

    public function set_goal_3()
    {
        $property = new \Orm_Property_Fixedtext('goal_3', '<b>Hazardous Materials</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_goal_3()
    {
        return $this->get_property('goal_3')->get_value();
    }

    public function set_fms_5()
    {
        $property = new \Orm_Property_Fixedtext('fms_5', '<b>Standard FMS.5</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_fms_5()
    {
        return $this->get_property('fms_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'The hospital has a program for the inventory, handling, storage, and use of hazardous materials.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_fms_5_1()
    {
        $property = new \Orm_Property_Fixedtext('fms_5_1', '<b>Standard FMS.5.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_fms_5_1()
    {
        return $this->get_property('fms_5_1')->get_value();
    }

    public function set_hospital_5_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_1', 'The hospital has a program for the control and disposal of hazardous materials and waste.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_5_1()
    {
        return $this->get_property('hospital_5_1')->get_value();
    }

    /*
     * 
     */

    public function set_goal_4()
    {
        $property = new \Orm_Property_Fixedtext('goal_4', '<b>Disaster Preparedness</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_goal_4()
    {
        return $this->get_property('goal_4')->get_value();
    }

    public function set_fms_6()
    {
        $property = new \Orm_Property_Fixedtext('fms_6', '<b>Standard FMS.6</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_fms_6()
    {
        return $this->get_property('fms_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'The hospital develops, maintains, and tests an emergency management program to respond to emergencies, epidemics, and natural or other disasters that have the potential of occurring within their community.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    /*
     * 
     */

    public function set_goal_5()
    {
        $property = new \Orm_Property_Fixedtext('goal_5', '<b>Fire Safety</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_goal_5()
    {
        return $this->get_property('goal_5')->get_value();
    }

    public function set_fms_7()
    {
        $property = new \Orm_Property_Fixedtext('fms_7', '<b>Standard FMS.7</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_fms_7()
    {
        return $this->get_property('fms_7')->get_value();
    }

    public function set_hospital_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7', 'The hospital establishes and implements a program for the prevention, early detection, suppression, abatement, and safe exit from the facility in response to fires and nonfire emergencies.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_7()
    {
        return $this->get_property('hospital_7')->get_value();
    }

    public function set_fms_7_1()
    {
        $property = new \Orm_Property_Fixedtext('fms_7_1', '<b>Standard FMS.7.1</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_fms_7_1()
    {
        return $this->get_property('fms_7_1')->get_value();
    }

    public function set_hospital_7_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_1', 'The hospital regularly tests its fire and smoke safety program, including any devices related to early detection and suppression, and documents the results.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_7_1()
    {
        return $this->get_property('hospital_7_1')->get_value();
    }

    public function set_fms_7_2()
    {
        $property = new \Orm_Property_Fixedtext('fms_7_2', '<b>Standard FMS.7.2</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_fms_7_2()
    {
        return $this->get_property('fms_7_2')->get_value();
    }

    public function set_hospital_7_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_2', 'The fire safety program includes limiting smoking by staff and patients to designated non–patient care areas of the facility.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_7_2()
    {
        return $this->get_property('hospital_7_2')->get_value();
    }

    /*
     * 
     */

    public function set_goal_6()
    {
        $property = new \Orm_Property_Fixedtext('goal_6', '<b>Medical Technology</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_goal_6()
    {
        return $this->get_property('goal_6')->get_value();
    }

    public function set_fms_8()
    {
        $property = new \Orm_Property_Fixedtext('fms_8', '<b>Standard FMS.8</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_fms_8()
    {
        return $this->get_property('fms_8')->get_value();
    }

    public function set_hospital_8()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8', 'The hospital establishes and implements a program for inspecting, testing, and maintaining medical technology and documenting the results.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_8()
    {
        return $this->get_property('hospital_8')->get_value();
    }

    public function set_fms_8_1()
    {
        $property = new \Orm_Property_Fixedtext('fms_8_1', '<b>Standard FMS.8.1</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_fms_8_1()
    {
        return $this->get_property('fms_8_1')->get_value();
    }

    public function set_hospital_8_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8_1', 'The hospital has a system in place for monitoring and acting on medical technology hazard notices, recalls, reportable incidents, problems, and failures.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_8_1()
    {
        return $this->get_property('hospital_8_1')->get_value();
    }

    /*
     * 
     */

    public function set_goal_7()
    {
        $property = new \Orm_Property_Fixedtext('goal_7', '<b>Utility Systems</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_goal_7()
    {
        return $this->get_property('goal_7')->get_value();
    }

    public function set_fms_9()
    {
        $property = new \Orm_Property_Fixedtext('fms_9', '<b>Standard FMS.9</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_fms_9()
    {
        return $this->get_property('fms_9')->get_value();
    }

    public function set_hospital_9()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9', 'The hospital establishes and implements a program to ensure that all utility systems operate effectively and efficiently.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_9()
    {
        return $this->get_property('hospital_9')->get_value();
    }

    public function set_fms_9_1()
    {
        $property = new \Orm_Property_Fixedtext('fms_9_1', '<b>Standard FMS.9.1</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_fms_9_1()
    {
        return $this->get_property('fms_9_1')->get_value();
    }

    public function set_hospital_9_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9_1', 'Utility systems are inspected, maintained, and improved.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_9_1()
    {
        return $this->get_property('hospital_9_1')->get_value();
    }

    public function set_fms_9_2()
    {
        $property = new \Orm_Property_Fixedtext('fms_9_2', '<b>Standard FMS.9.2</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_fms_9_2()
    {
        return $this->get_property('fms_9_2')->get_value();
    }

    public function set_hospital_9_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9_2', 'The hospital utility systems program ensures that potable water and electrical power are available at all times and establishes and implements alternative sources of water and power during system disruption, contamination, or failure.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_9_2()
    {
        return $this->get_property('hospital_9_2')->get_value();
    }

    public function set_fms_9_2_1()
    {
        $property = new \Orm_Property_Fixedtext('fms_9_2_1', '<b>Standard FMS.9.2.1</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_fms_9_2_1()
    {
        return $this->get_property('fms_9_2_1')->get_value();
    }

    public function set_hospital_9_2_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9_2_1', 'The hospital tests its emergency water and electrical systems and documents the results.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_9_2_1()
    {
        return $this->get_property('hospital_9_2_1')->get_value();
    }

    public function set_fms_9_3()
    {
        $property = new \Orm_Property_Fixedtext('fms_9_3', '<b>Standard FMS.9.3</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_fms_9_3()
    {
        return $this->get_property('fms_9_3')->get_value();
    }

    public function set_hospital_9_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9_3', 'Designated individuals or authorities monitor water quality regularly.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_9_3()
    {
        return $this->get_property('hospital_9_3')->get_value();
    }

    /*
     * 
     */

    public function set_goal_8()
    {
        $property = new \Orm_Property_Fixedtext('goal_8', '<b>Facility Management Program Monitoring</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_goal_8()
    {
        return $this->get_property('goal_8')->get_value();
    }

    public function set_fms_10()
    {
        $property = new \Orm_Property_Fixedtext('fms_10', '<b>Standard FMS.10</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_fms_10()
    {
        return $this->get_property('fms_10')->get_value();
    }

    public function set_hospital_10()
    {
        $property = new \Orm_Property_Fixedtext('hospital_10', 'The hospital collects and analyzes data from each of the facility management programs to support planning for replacing or upgrading medical technology, equipment, and systems, and reducing risks in the environment.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_10()
    {
        return $this->get_property('hospital_10')->get_value();
    }

    /*
     * 
     */

    public function set_goal_9()
    {
        $property = new \Orm_Property_Fixedtext('goal_9', '<b>Staff Education</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_goal_9()
    {
        return $this->get_property('goal_9')->get_value();
    }

    public function set_fms_11()
    {
        $property = new \Orm_Property_Fixedtext('fms_11', '<b>Standard FMS.11</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_fms_11()
    {
        return $this->get_property('fms_11')->get_value();
    }

    public function set_hospital_11()
    {
        $property = new \Orm_Property_Fixedtext('hospital_11', 'The hospital educates, trains, and tests all staff about their roles in providing a safe and effective patient care facility.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_11()
    {
        return $this->get_property('hospital_11')->get_value();
    }

    public function set_fms_11_1()
    {
        $property = new \Orm_Property_Fixedtext('fms_11_1', '<b>Standard FMS.11.1</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_fms_11_1()
    {
        return $this->get_property('fms_11_1')->get_value();
    }

    public function set_hospital_11_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_11_1', 'Staff members are trained and knowledgeable about their roles in the hospital’s programs for fire safety, Fsecurity, hazardous materials, and emergencies.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_11_1()
    {
        return $this->get_property('hospital_11_1')->get_value();
    }

    public function set_gld_11_2()
    {
        $property = new \Orm_Property_Fixedtext('gld_11_2', '<b>Standard FMS.11.2</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_gld_11_2()
    {
        return $this->get_property('gld_11_2')->get_value();
    }

    public function set_hospital_11_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_11_2', 'Staff are trained to operate and to maintain medical technology and utility systems.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_11_2()
    {
        return $this->get_property('hospital_11_2')->get_value();
    }

}
