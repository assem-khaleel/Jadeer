<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_3_qps
 *
 * @author ahmadgx
 */
class Jci_Section_3_Qps extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Quality Improvement and Patient Safety (QPS)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_goal_1('');
            $this->set_qps_1('');
            $this->set_hospital_1('');
            /**/
            $this->set_goal_2('');
            $this->set_qps_2('');
            $this->set_hospital_2('');
            $this->set_qps_3('');
            $this->set_hospital_3('');
            /**/
            $this->set_goal_3('');
            $this->set_qps_4('');
            $this->set_hospital_4('');
            $this->set_qps_4_1('');
            $this->set_hospital_4_1('');
            $this->set_qps_5('');
            $this->set_hospital_5('');
            $this->set_qps_6('');
            $this->set_hospital_6('');
            $this->set_qps_7('');
            $this->set_hospital_7('');
            $this->set_qps_8('');
            $this->set_hospital_8('');
            $this->set_qps_9('');
            $this->set_hospital_9('');
            /**/
            $this->set_goal_4('');
            $this->set_qps_10('');
            $this->set_hospital_10('');
            $this->set_qps_11('');
            $this->set_hospital_11('');
    }

    public function set_goals()
    {
        $property = new \Orm_Property_Fixedtext('goals', '<b>Standards  <br/>Note:</b>'
            . 'In all QPS standards, leaders are individuals and leadership is the collective group. Accountabilities are described at the individual or collective level. (Also see the “Governance, Leadership, and Direction” [GLD] chapter for other related requirements.)');
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
        $property = new \Orm_Property_Fixedtext('goal_1', '<b>Management of Quality and Patient Safety Activities</b> <br/> <br/>'
            . 'The overall program for quality and patient safety in a hospital is approved by governance (see GLD.2), with the hospital’s leadership defining the structure and allocating resources required to implement the program (see GLD.4). Leadership also identifies the hospital’s overall priorities for measurement and improvement (see GLD.5), with the department/service leaders identifying the priorities for measurement and improvement within their department/service (see GLD.11 and GLD.11.1).'
            . ' <br/> <br/>The standards in this QPS chapter identify the structure, leadership, and activities to support the data collection, data analysis, and quality improvement for the identified priorities—hospitalwide, as well as department- and service-specific. This includes the collection and analysis on, and the response to, hospitalwide sentinel events, adverse events, and near-miss events. The standards also describe the central role of coordinating all the quality improvement and patient safety initiatives in the hospital and providing guidance and direction for staff training and communication of quality and patient safety information. The standards do not identify an organizational structure, such as a department, as this is up to each hospital to determine.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_goal_1()
    {
        return $this->get_property('goal_1')->get_value();
    }

    public function set_qps_1()
    {
        $property = new \Orm_Property_Fixedtext('qps_1', '<b>Standard QPS.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_qps_1()
    {
        return $this->get_property('qps_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'A qualified individual guides the implementation of the hospital’s program for quality improvement and patient safety and manages the activities needed to carry out an effective program of continuous quality improvement and patient safety within the hospital.');
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
        $property = new \Orm_Property_Fixedtext('goal_2', '<b>Measure Selection and Data Collection</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goal_2()
    {
        return $this->get_property('goal_2')->get_value();
    }

    public function set_qps_2()
    {
        $property = new \Orm_Property_Fixedtext('qps_2', '<b>Standard QPS.2</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_qps_2()
    {
        return $this->get_property('qps_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'Quality and patient safety program staff support the measure selection process throughout the hospital and provide coordination and integration of measurement activities throughout the hospital.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_qps_3()
    {
        $property = new \Orm_Property_Fixedtext('qps_3', '<b>Standard QPS.3</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_qps_3()
    {
        return $this->get_property('qps_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'The quality and patient safety program uses current scientific and other information to support patient care, health professional education, clinical research, and management.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_3()
    {
        return $this->get_property('hospital_3')->get_value();
    }

    /*
     * 
     */

    public function set_goal_3()
    {
        $property = new \Orm_Property_Fixedtext('goal_3', '<b>Analysis and Validation of Measurement Data</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_goal_3()
    {
        return $this->get_property('goal_3')->get_value();
    }

    public function set_qps_4()
    {
        $property = new \Orm_Property_Fixedtext('qps_4', '<b>Standard QPS.4</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_qps_4()
    {
        return $this->get_property('qps_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'The quality and patient safety program includes the aggregation and analysis of data to support patient care, hospital management, and the quality management program and participation in external databases.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_qps_4_1()
    {
        $property = new \Orm_Property_Fixedtext('qps_4_1', '<b>Standard QPS.4.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_qps_4_1()
    {
        return $this->get_property('qps_4_1')->get_value();
    }

    public function set_hospital_4_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4_1', 'Individuals with appropriate experience, knowledge, and skills systematically aggregate and analyze data in the hospital.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_4_1()
    {
        return $this->get_property('hospital_4_1')->get_value();
    }

    public function set_qps_5()
    {
        $property = new \Orm_Property_Fixedtext('qps_5', '<b>Standard QPS.5</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_qps_5()
    {
        return $this->get_property('qps_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'The data analysis process includes at least one determination per year of the impact of hospitalwide priority improvements on cost and efficiency.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_qps_6()
    {
        $property = new \Orm_Property_Fixedtext('qps_6', '<b>Standard QPS.6</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_qps_6()
    {
        return $this->get_property('qps_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'The hospital uses an internal process to validate data.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    public function set_qps_7()
    {
        $property = new \Orm_Property_Fixedtext('qps_7', '<b>Standard QPS.7</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_qps_7()
    {
        return $this->get_property('qps_7')->get_value();
    }

    public function set_hospital_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7', 'The hospital uses a defined process for identifying and managing sentinel events.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_7()
    {
        return $this->get_property('hospital_7')->get_value();
    }

    public function set_qps_8()
    {
        $property = new \Orm_Property_Fixedtext('qps_8', '<b>Standard QPS.8</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_qps_8()
    {
        return $this->get_property('qps_8')->get_value();
    }

    public function set_hospital_8()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8', 'Data are always analyzed when undesirable trends and variation are evident from the data.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_8()
    {
        return $this->get_property('hospital_8')->get_value();
    }

    public function set_qps_9()
    {
        $property = new \Orm_Property_Fixedtext('qps_9', '<b>Standard QPS.9</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_qps_9()
    {
        return $this->get_property('qps_9')->get_value();
    }

    public function set_hospital_9()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9', 'The organization uses a defined process for the identification and analysis of near-miss events.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_9()
    {
        return $this->get_property('hospital_9')->get_value();
    }

    /*
     * 
     */

    public function set_goal_4()
    {
        $property = new \Orm_Property_Fixedtext('goal_4', '<b>Gaining and Sustaining Improvement</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_goal_4()
    {
        return $this->get_property('goal_4')->get_value();
    }

    public function set_qps_10()
    {
        $property = new \Orm_Property_Fixedtext('qps_10', '<b>Standard QPS.10</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_qps_10()
    {
        return $this->get_property('qps_10')->get_value();
    }

    public function set_hospital_10()
    {
        $property = new \Orm_Property_Fixedtext('hospital_10', 'Improvement in quality and safety is achieved and sustained.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_10()
    {
        return $this->get_property('hospital_10')->get_value();
    }

    public function set_qps_11()
    {
        $property = new \Orm_Property_Fixedtext('qps_11', '<b>Standard QPS.11</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_qps_11()
    {
        return $this->get_property('qps_11')->get_value();
    }

    public function set_hospital_11()
    {
        $property = new \Orm_Property_Fixedtext('hospital_11', 'An ongoing program of risk management is used to identify and to proactively reduce unanticipated adverse events and other safety risks to patients and staff.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_11()
    {
        return $this->get_property('hospital_11')->get_value();
    }

}
