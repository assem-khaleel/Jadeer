<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_2_pfr
 *
 * @author ahmadgx
 */
class Jci_Section_2_Pfr extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Patient and Family Rights (PFR)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_pfr_1('');
            $this->set_hospital_1('');
            $this->set_pfr_1_1('');
            $this->set_hospital_1_1('');
            $this->set_pfr_1_2('');
            $this->set_hospital_1_2('');
            $this->set_pfr_1_3('');
            $this->set_hospital_1_3('');
            $this->set_pfr_1_4('');
            $this->set_hospital_1_4('');
            $this->set_pfr_1_5('');
            $this->set_hospital_1_5('');
            /**/
            $this->set_pfr_2('');
            $this->set_hospital_2('');
            $this->set_pfr_2_1('');
            $this->set_hospital_2_1('');
            $this->set_pfr_2_2('');
            $this->set_hospital_2_2('');
            $this->set_pfr_2_3('');
            $this->set_hospital_2_3('');
            /**/
            $this->set_pfr_3('');
            $this->set_hospital_3('');
            /**/
            $this->set_pfr_4('');
            $this->set_hospital_4('');
            /**/
            $this->set_goals_5('');
            $this->set_pfr_5('');
            $this->set_hospital_5('');
            $this->set_goals_5_1('');
            $this->set_pfr_5_1('');
            $this->set_hospital_5_1('');
            $this->set_pfr_5_2('');
            $this->set_hospital_5_2('');
            $this->set_pfr_5_3('');
            $this->set_hospital_5_3('');
            $this->set_pfr_5_4('');
            $this->set_hospital_5_4('');
            /**/
            $this->set_goals_6('');
            $this->set_note('');
            $this->set_pfr_6('');
            $this->set_hospital_6('');
            $this->set_pfr_6_1('');
            $this->set_hospital_6_1('');
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

    public function set_pfr_1()
    {
        $property = new \Orm_Property_Fixedtext('pfr_1', '<b>Standard PFR.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_1()
    {
        return $this->get_property('pfr_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'The hospital is responsible for providing processes that support patients’ and families’ rights during care.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_pfr_1_1()
    {
        $property = new \Orm_Property_Fixedtext('pfr_1_1', '<b>Standard PFR.1.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_1_1()
    {
        return $this->get_property('pfr_1_1')->get_value();
    }

    public function set_hospital_1_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_1', 'The hospital is responsible for providing processes that support patients’ and families’ rights during care.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1_1()
    {
        return $this->get_property('hospital_1_1')->get_value();
    }

    public function set_pfr_1_2()
    {
        $property = new \Orm_Property_Fixedtext('pfr_1_2', '<b>Standard PFR.1.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_1_2()
    {
        return $this->get_property('pfr_1_2')->get_value();
    }

    public function set_hospital_1_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_2', 'The hospital provides care that is respectful of the patient’s personal values and beliefs and responds to requests related to spiritual and religious beliefs.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1_2()
    {
        return $this->get_property('hospital_1_2')->get_value();
    }

    public function set_pfr_1_3()
    {
        $property = new \Orm_Property_Fixedtext('pfr_1_3', '<b>Standard PFR.1.3</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_1_3()
    {
        return $this->get_property('pfr_1_3')->get_value();
    }

    public function set_hospital_1_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_3', 'The patient’s rights to privacy and confidentiality of care and information are respected.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1_3()
    {
        return $this->get_property('hospital_1_3')->get_value();
    }

    public function set_pfr_1_4()
    {
        $property = new \Orm_Property_Fixedtext('pfr_1_4', '<b>Standard PFR.1.4</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_1_4()
    {
        return $this->get_property('pfr_1_4')->get_value();
    }

    public function set_hospital_1_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_4', 'The hospital takes measures to protect patients’ possessions from theft or loss.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1_4()
    {
        return $this->get_property('hospital_1_4')->get_value();
    }

    public function set_pfr_1_5()
    {
        $property = new \Orm_Property_Fixedtext('pfr_1_5', '<b>Standard PFR.1.5</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_1_5()
    {
        return $this->get_property('pfr_1_5')->get_value();
    }

    public function set_hospital_1_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1_5', 'Patients are protected from physical assault, and populations at risk are identified and protected from additional vulnerabilities.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1_5()
    {
        return $this->get_property('hospital_1_5')->get_value();
    }

    /*
     * 
     */

    public function set_pfr_2()
    {
        $property = new \Orm_Property_Fixedtext('pfr_2', '<b>Standard PFR.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_2()
    {
        return $this->get_property('pfr_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'The hospital supports patients’ and families’ rights to participate in the care process.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_pfr_2_1()
    {
        $property = new \Orm_Property_Fixedtext('pfr_2_1', '<b>Standard PFR.2.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_2_1()
    {
        return $this->get_property('pfr_2_1')->get_value();
    }

    public function set_hospital_2_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_1', 'Patients are informed about all aspects of their medical care and treatment.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2_1()
    {
        return $this->get_property('hospital_2_1')->get_value();
    }

    public function set_pfr_2_2()
    {
        $property = new \Orm_Property_Fixedtext('pfr_2_2', '<b>Standard PFR.2.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_2_2()
    {
        return $this->get_property('pfr_2_2')->get_value();
    }

    public function set_hospital_2_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_2', 'The hospital informs patients and families about their rights and responsibilities to refuse or discontinue treatment, withhold resuscitative services, and forgo or withdraw life-sustaining treatments.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2_2()
    {
        return $this->get_property('hospital_2_2')->get_value();
    }

    public function set_pfr_2_3()
    {
        $property = new \Orm_Property_Fixedtext('pfr_2_3', '<b>Standard PFR.2.3</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_2_3()
    {
        return $this->get_property('pfr_2_3')->get_value();
    }

    public function set_hospital_2_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_3', 'The hospital informs patients and families about its process to receive and to act on complaints, conflicts, and differences of opinion about patient care and the patient’s right to participate in these processes.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2_3()
    {
        return $this->get_property('hospital_2_3')->get_value();
    }

    /*
     * 
     */

    public function set_pfr_3()
    {
        $property = new \Orm_Property_Fixedtext('pfr_3', '<b>Standard PFR.3</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_3()
    {
        return $this->get_property('pfr_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'The hospital informs patients and families about its process to receive and to act on complaints, conflicts, and differences of opinion about patient care and the patient’s right to participate in these processes');
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

    public function set_pfr_4()
    {
        $property = new \Orm_Property_Fixedtext('pfr_4', '<b>Standard PFR.4</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_pfr_4()
    {
        return $this->get_property('pfr_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'All patients are informed about their rights and responsibilities in a manner and language they can understand.');
        $property->set_group('group_1');
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
        $property = new \Orm_Property_Fixedtext('goals_5', '<b>General Consent</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goals_5()
    {
        return $this->get_property('goals_5')->get_value();
    }

    public function set_pfr_5()
    {
        $property = new \Orm_Property_Fixedtext('pfr_5', '<b>Standard PFR.5</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_pfr_5()
    {
        return $this->get_property('pfr_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'Patient informed consent is obtained through a process defined by the hospital and carried out by trained staff in a manner and language the patient can understand.');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    public function set_goals_5_1()
    {
        $property = new \Orm_Property_Fixedtext('goals_5_1', '<b>Informed Consent</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_goals_5_1()
    {
        return $this->get_property('goals_5_1')->get_value();
    }

    public function set_pfr_5_1()
    {
        $property = new \Orm_Property_Fixedtext('pfr_5_1', '<b>Standard PFR.5.1</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_pfr_5_1()
    {
        return $this->get_property('pfr_5_1')->get_value();
    }

    public function set_hospital_5_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_1', 'Patient informed consent is obtained through a process defined by the hospital and carried out by trained staff in a manner and language the patient can understand.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5_1()
    {
        return $this->get_property('hospital_5_1')->get_value();
    }

    public function set_pfr_5_2()
    {
        $property = new \Orm_Property_Fixedtext('pfr_5_2', '<b>Standard PFR.5.2</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_pfr_5_2()
    {
        return $this->get_property('pfr_5_2')->get_value();
    }

    public function set_hospital_5_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_2', 'Informed consent is obtained before surgery, anesthesia, procedural sedation, use of blood and blood products, and other high-risk treatments and procedures.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5_2()
    {
        return $this->get_property('hospital_5_2')->get_value();
    }

    public function set_pfr_5_3()
    {
        $property = new \Orm_Property_Fixedtext('pfr_5_3', '<b>Standard PFR.5.3</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_pfr_5_3()
    {
        return $this->get_property('pfr_5_3')->get_value();
    }

    public function set_hospital_5_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_3', 'Patients and families receive adequate information about the illness, proposed treatment(s), and health care practitioners so that they can make care decisions.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5_3()
    {
        return $this->get_property('hospital_5_3')->get_value();
    }

    public function set_pfr_5_4()
    {
        $property = new \Orm_Property_Fixedtext('pfr_5_4', '<b>Standard PFR.5.4</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_pfr_5_4()
    {
        return $this->get_property('pfr_5_4')->get_value();
    }

    public function set_hospital_5_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5_4', 'The hospital establishes a process, within the context of existing law and culture, for when others can grant consent.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5_4()
    {
        return $this->get_property('hospital_5_4')->get_value();
    }

    /*
     * 
     */

    public function set_goals_6()
    {
        $property = new \Orm_Property_Fixedtext('goals_6', '<b>Organ Donation</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_goals_6()
    {
        return $this->get_property('goals_6')->get_value();
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', '<b>Note: </b>The following standards are intended to be used in situations in which organ or tissue transplantation will not occur but during those times when patients request information about organ and tissue donation and/or when organ or tissue donation may occur. When organ or tissue donation and transplantation are performed, the standards for organ and tissue transplant programs (found in COP.8 through COP.9.3) apply.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

    public function set_pfr_6()
    {
        $property = new \Orm_Property_Fixedtext('pfr_6', '<b>Standard PFR.6</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_pfr_6()
    {
        return $this->get_property('pfr_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'The hospital informs patients and families about how to choose to donate organs and other tissues.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    public function set_pfr_6_1()
    {
        $property = new \Orm_Property_Fixedtext('pfr_6_1', '<b>Standard PFR.6.1</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_pfr_6_1()
    {
        return $this->get_property('pfr_6_1')->get_value();
    }

    public function set_hospital_6_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6_1', 'The hospital provides oversight for the process of organ and tissue procurement.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_6_1()
    {
        return $this->get_property('hospital_6_1')->get_value();
    }

}
