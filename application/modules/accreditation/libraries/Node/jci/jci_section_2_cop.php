<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_2_cop
 *
 * @author ahmadgx
 */
class Jci_Section_2_Cop extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Care of Patients (COP)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_goals('');
            /**/
            $this->set_goal_1('');
            $this->set_cop_1('');
            $this->set_hospital_1('');
            $this->set_cop_2('');
            $this->set_hospital_2('');
            $this->set_cop_2_1('');
            $this->set_hospital_2_1('');
            $this->set_cop_2_2('');
            $this->set_hospital_2_2('');
            $this->set_cop_2_3('');
            $this->set_hospital_2_3('');
            /**/
            $this->set_goal_2('');
            $this->set_cop_3('');
            $this->set_hospital_3('');
            /**/
            $this->set_goal_3('');
            $this->set_cop_3_1('');
            $this->set_hospital_3_1('');
            /**/
            $this->set_goal_4('');
            $this->set_cop_3_2('');
            $this->set_hospital_3_2('');
            $this->set_cop_3_3('');
            $this->set_hospital_3_3('');
            /**/
            $this->set_goal_5('');
            $this->set_cop_4('');
            $this->set_hospital_4('');
            $this->set_cop_5('');
            $this->set_hospital_5('');
            /**/
            $this->set_goal_6('');
            $this->set_cop_6('');
            $this->set_hospital_6('');
            /**/
            $this->set_goal_7('');
            $this->set_cop_7('');
            $this->set_hospital_7('');
            $this->set_cop_7_1('');
            $this->set_hospital_7_1('');
            /**/
            $this->set_goal_8('');
            $this->set_note_8('');
            $this->set_cop_8('');
            $this->set_hospital_8('');
            $this->set_cop_8_1('');
            $this->set_hospital_8_1('');
            $this->set_cop_8_2('');
            $this->set_hospital_8_2('');
            $this->set_cop_8_3('');
            $this->set_hospital_8_3('');
            $this->set_cop_8_4('');
            $this->set_hospital_8_4('');
            $this->set_cop_8_5('');
            $this->set_hospital_8_5('');
            $this->set_cop_8_6('');
            $this->set_hospital_8_6('');
            $this->set_cop_8_7('');
            $this->set_hospital_8_7('');
            /**/
            $this->set_goal_9('');
            $this->set_cop_9('');
            $this->set_hospital_9('');
            $this->set_cop_9_1('');
            $this->set_hospital_9_1('');
            $this->set_cop_9_2('');
            $this->set_hospital_9_2('');
            $this->set_cop_9_3('');
            $this->set_hospital_9_3('');
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

    public function set_goal_1()
    {
        $property = new \Orm_Property_Fixedtext('goal_1', '<b>Care Delivery for All Patients</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_goal_1()
    {
        return $this->get_property('goal_1')->get_value();
    }

    public function set_cop_1()
    {
        $property = new \Orm_Property_Fixedtext('cop_1', '<b>Standard COP.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_cop_1()
    {
        return $this->get_property('cop_1')->get_value();
    }

    public function set_hospital_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_1', 'Uniform care of all patients is provided and follows applicable laws and regulations.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_1()
    {
        return $this->get_property('hospital_1')->get_value();
    }

    public function set_cop_2()
    {
        $property = new \Orm_Property_Fixedtext('cop_2', '<b>Standard COP.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_cop_2()
    {
        return $this->get_property('cop_2')->get_value();
    }

    public function set_hospital_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2', 'There is a process to integrate and to coordinate the care provided to each patient.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2()
    {
        return $this->get_property('hospital_2')->get_value();
    }

    public function set_cop_2_1()
    {
        $property = new \Orm_Property_Fixedtext('cop_2_1', '<b>Standard COP.2.1</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_cop_2_1()
    {
        return $this->get_property('cop_2_1')->get_value();
    }

    public function set_hospital_2_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_1', 'An individualized plan of care is developed and documented for each patient.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2_1()
    {
        return $this->get_property('hospital_2_1')->get_value();
    }

    public function set_cop_2_2()
    {
        $property = new \Orm_Property_Fixedtext('cop_2_2', '<b>Standard COP.2.2</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_cop_2_2()
    {
        return $this->get_property('cop_2_2')->get_value();
    }

    public function set_hospital_2_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_2', 'The hospital develops and implements a uniform process for prescribing patient orders.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_hospital_2_2()
    {
        return $this->get_property('hospital_2_2')->get_value();
    }

    public function set_cop_2_3()
    {
        $property = new \Orm_Property_Fixedtext('cop_2_3', '<b>Standard COP.2.3</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_cop_2_3()
    {
        return $this->get_property('cop_2_3')->get_value();
    }

    public function set_hospital_2_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_2_3', 'Clinical and diagnostic procedures and treatments performed, and the results or outcomes, are documented in the patient’s record.');
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

    public function set_goal_2()
    {
        $property = new \Orm_Property_Fixedtext('goal_2', '<b>Care of High-Risk Patients and Provision of High-Risk Services</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_goal_2()
    {
        return $this->get_property('goal_2')->get_value();
    }

    public function set_cop_3()
    {
        $property = new \Orm_Property_Fixedtext('cop_3', '<b>Standard COP.3</b>');
        $property->set_group('group_2');
        $this->set_property($property);
    }

    public function get_cop_3()
    {
        return $this->get_property('cop_3')->get_value();
    }

    public function set_hospital_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3', 'The care of high-risk patients and the provision of high-risk services are guided by professional practice guidelines, laws, and regulations.');
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
        $property = new \Orm_Property_Fixedtext('goal_3', '<b>Recognition of Changes to Patient Condition</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_goal_3()
    {
        return $this->get_property('goal_3')->get_value();
    }

    public function set_cop_3_1()
    {
        $property = new \Orm_Property_Fixedtext('cop_3_1', '<b>Standard COP.3.1</b>');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_cop_3_1()
    {
        return $this->get_property('cop_3_1')->get_value();
    }

    public function set_hospital_3_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_1', 'Clinical staff are trained to recognize and respond to changes in a patient’s condition.');
        $property->set_group('group_3');
        $this->set_property($property);
    }

    public function get_hospital_3_1()
    {
        return $this->get_property('hospital_3_1')->get_value();
    }

    /*
     * 
     */

    public function set_goal_4()
    {
        $property = new \Orm_Property_Fixedtext('goal_4', '<b>Resuscitation Services</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_goal_4()
    {
        return $this->get_property('goal_4')->get_value();
    }

    public function set_cop_3_2()
    {
        $property = new \Orm_Property_Fixedtext('cop_3_2', '<b>Standard COP.3.2</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_cop_3_2()
    {
        return $this->get_property('cop_3_2')->get_value();
    }

    public function set_hospital_3_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_2', 'Resuscitation services are available throughout the hospital.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_3_2()
    {
        return $this->get_property('hospital_3_2')->get_value();
    }

    public function set_cop_3_3()
    {
        $property = new \Orm_Property_Fixedtext('cop_3_3', '<b>Standard COP.3.3</b>');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_cop_3_3()
    {
        return $this->get_property('cop_3_3')->get_value();
    }

    public function set_hospital_3_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_3_3', 'Clinical guidelines and procedures are established and implemented for the handling, use, and administration of blood and blood products.');
        $property->set_group('group_4');
        $this->set_property($property);
    }

    public function get_hospital_3_3()
    {
        return $this->get_property('hospital_3_3')->get_value();
    }

    /*
     * 
     */

    public function set_goal_5()
    {
        $property = new \Orm_Property_Fixedtext('goal_5', '<b>Food and Nutrition Therapy</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_goal_5()
    {
        return $this->get_property('goal_5')->get_value();
    }

    public function set_cop_4()
    {
        $property = new \Orm_Property_Fixedtext('cop_4', '<b>Standard COP.4</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_cop_4()
    {
        return $this->get_property('cop_4')->get_value();
    }

    public function set_hospital_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_4', 'A variety of food choices, appropriate for the patient’s nutritional status and consistent with his or her clinical care, is available.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_4()
    {
        return $this->get_property('hospital_4')->get_value();
    }

    public function set_cop_5()
    {
        $property = new \Orm_Property_Fixedtext('cop_5', '<b>Standard COP.5</b>');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_cop_5()
    {
        return $this->get_property('cop_5')->get_value();
    }

    public function set_hospital_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_5', 'Patients at nutrition risk receive nutrition therapy.');
        $property->set_group('group_5');
        $this->set_property($property);
    }

    public function get_hospital_5()
    {
        return $this->get_property('hospital_5')->get_value();
    }

    /*
     * 
     */

    public function set_goal_6()
    {
        $property = new \Orm_Property_Fixedtext('goal_6', '<b>Pain Management</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_goal_6()
    {
        return $this->get_property('goal_6')->get_value();
    }

    public function set_cop_6()
    {
        $property = new \Orm_Property_Fixedtext('cop_6', '<b>Standard COP.6</b>');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_cop_6()
    {
        return $this->get_property('cop_6')->get_value();
    }

    public function set_hospital_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_6', 'Patients are supported in managing pain effectively.');
        $property->set_group('group_6');
        $this->set_property($property);
    }

    public function get_hospital_6()
    {
        return $this->get_property('hospital_6')->get_value();
    }

    /*
     * 
     */

    public function set_goal_7()
    {
        $property = new \Orm_Property_Fixedtext('goal_7', '<b>End-of-Life Care</b> <br/> <br/>'
            . 'Patients who are approaching the end of life require care focused on their unique needs. Dying patients may experience symptoms related to the disease process or curative treatments or may need help in dealing with psychosocial, spiritual, and cultural issues associated with death and dying. Their families and caregivers may require respite from caring for a terminally ill family member or help in coping with grief and loss. <br/> <br/>'
            . 'The hospital’s goal for providing care at the end of life considers the settings in which care or service is provided (such as a hospice or palliative care unit), the type of services provided, and the patient population served. The hospital develops processes to manage end-of-life care. These processes'
            . ' <br/><ul><li>ensure that symptoms will be assessed and appropriately managed;</li>'
            . '<li>ensure that terminally ill patients will be treated with dignity and respect;</li>'
            . '<li>assess patients as frequently as necessary to identify symptoms;</li>'
            . '<li>plan preventive and therapeutic approaches to manage symptoms; and</li>'
            . '<li>educate patients and staff about managing symptoms.</li></ul>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_goal_7()
    {
        return $this->get_property('goal_7')->get_value();
    }

    public function set_cop_7()
    {
        $property = new \Orm_Property_Fixedtext('cop_7', '<b>Standard COP.7</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_cop_7()
    {
        return $this->get_property('cop_7')->get_value();
    }

    public function set_hospital_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7', 'The hospital addresses end-of-life care.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_7()
    {
        return $this->get_property('hospital_7')->get_value();
    }

    public function set_cop_7_1()
    {
        $property = new \Orm_Property_Fixedtext('cop_7_1', '<b>Standard COP.7.1</b>');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_cop_7_1()
    {
        return $this->get_property('cop_7_1')->get_value();
    }

    public function set_hospital_7_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_7_1', 'Care of the dying patient optimizes his or her comfort and dignity.');
        $property->set_group('group_7');
        $this->set_property($property);
    }

    public function get_hospital_7_1()
    {
        return $this->get_property('hospital_7_1')->get_value();
    }

    /**
     *
     */
    public function set_goal_8()
    {
        $property = new \Orm_Property_Fixedtext('goal_8', '<b>Hospitals Providing Organ and/or Tissue Transplant Services</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_goal_8()
    {
        return $this->get_property('goal_8')->get_value();
    }

    public function set_note_8()
    {
        $property = new \Orm_Property_Fixedtext('note_8', '<b>Note:</b>Standards COP.8 through COP.9.3 are intended to be used by hospitals providing organ and/or tissue transplant services. Please contact the JCI Accreditation Office with inquiries.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_note_8()
    {
        return $this->get_property('note_8')->get_value();
    }

    public function set_cop_8()
    {
        $property = new \Orm_Property_Fixedtext('cop_8', '<b>Standard COP.8</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_cop_8()
    {
        return $this->get_property('cop_8')->get_value();
    }

    public function set_hospital_8()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8', 'The hospital’s leadership provides resources to support the organ/tissue transplant program.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_8()
    {
        return $this->get_property('hospital_8')->get_value();
    }

    public function set_cop_8_1()
    {
        $property = new \Orm_Property_Fixedtext('cop_8_1', '<b>Standard COP.8.1</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_cop_8_1()
    {
        return $this->get_property('cop_8_1')->get_value();
    }

    public function set_hospital_8_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8_1', 'A qualified transplant program leader is responsible for the transplant program.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_8_1()
    {
        return $this->get_property('hospital_8_1')->get_value();
    }

    public function set_cop_8_2()
    {
        $property = new \Orm_Property_Fixedtext('cop_8_2', '<b>Standard COP.8.2</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_cop_8_2()
    {
        return $this->get_property('cop_8_2')->get_value();
    }

    public function set_hospital_8_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8_2', 'The transplant program includes a multidisciplinary team that consists of people with expertise in the relevant organ-specific transplant programs.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_8_2()
    {
        return $this->get_property('hospital_8_2')->get_value();
    }

    public function set_cop_8_3()
    {
        $property = new \Orm_Property_Fixedtext('cop_8_3', '<b>Standard COP.8.3</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_cop_8_3()
    {
        return $this->get_property('cop_8_3')->get_value();
    }

    public function set_hospital_8_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8_3', 'There is a designated coordination mechanism for all transplant activities that involves physicians, nurses, and other health care practitioners.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_8_3()
    {
        return $this->get_property('hospital_8_3')->get_value();
    }

    public function set_cop_8_4()
    {
        $property = new \Orm_Property_Fixedtext('cop_8_4', '<b>Standard COP.8.4</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_cop_8_4()
    {
        return $this->get_property('cop_8_4')->get_value();
    }

    public function set_hospital_8_4()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8_4', 'The transplant program uses organ-specific transplant clinical eligibility, psychological, and social suitability criteria for transplant candidates.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_8_4()
    {
        return $this->get_property('hospital_8_4')->get_value();
    }

    public function set_cop_8_5()
    {
        $property = new \Orm_Property_Fixedtext('cop_8_5', '<b>Standard COP.8.5</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_cop_8_5()
    {
        return $this->get_property('cop_8_5')->get_value();
    }

    public function set_hospital_8_5()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8_5', 'The transplant program obtains informed consent specific to organ transplantation from the transplant candidate.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_8_5()
    {
        return $this->get_property('hospital_8_5')->get_value();
    }

    public function set_cop_8_6()
    {
        $property = new \Orm_Property_Fixedtext('cop_8_6', '<b>Standard COP.8.6</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_cop_8_6()
    {
        return $this->get_property('cop_8_6')->get_value();
    }

    public function set_hospital_8_6()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8_6', 'The transplant program has documented protocols (or procedures) for organ recovery and organ receipt to ensure the compatibility, safety, efficacy, and quality of human cells, tissues, and organs for transplantation.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_8_6()
    {
        return $this->get_property('hospital_8_6')->get_value();
    }

    public function set_cop_8_7()
    {
        $property = new \Orm_Property_Fixedtext('cop_8_7', '<b>Standard COP.8.7</b>');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_cop_8_7()
    {
        return $this->get_property('cop_8_7')->get_value();
    }

    public function set_hospital_8_7()
    {
        $property = new \Orm_Property_Fixedtext('hospital_8_7', 'Individualized patient care plans guide the care of transplant patients.');
        $property->set_group('group_8');
        $this->set_property($property);
    }

    public function get_hospital_8_7()
    {
        return $this->get_property('hospital_8_7')->get_value();
    }

    /*
     * 
     */

    public function set_goal_9()
    {
        $property = new \Orm_Property_Fixedtext('goal_9', '<b>Transplant Programs Using Living Donor Organs</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_goal_9()
    {
        return $this->get_property('goal_9')->get_value();
    }

    public function set_cop_9()
    {
        $property = new \Orm_Property_Fixedtext('cop_9', '<b>Standard COP.9</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_cop_9()
    {
        return $this->get_property('cop_9')->get_value();
    }

    public function set_hospital_9()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9', 'Transplant programs that perform living donor transplantation protect the rights of prospective or actual donors.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_9()
    {
        return $this->get_property('hospital_9')->get_value();
    }

    public function set_cop_9_1()
    {
        $property = new \Orm_Property_Fixedtext('cop_9_1', '<b>Standard COP.9.1</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_cop_9_1()
    {
        return $this->get_property('cop_9_1')->get_value();
    }

    public function set_hospital_9_1()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9_1', 'Transplant programs performing living donor transplants obtain informed consent specific to organ donation from the prospective living donor.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_9_1()
    {
        return $this->get_property('hospital_9_1')->get_value();
    }

    public function set_cop_9_2()
    {
        $property = new \Orm_Property_Fixedtext('cop_9_2', '<b>Standard COP.9.2</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_cop_9_2()
    {
        return $this->get_property('cop_9_2')->get_value();
    }

    public function set_hospital_9_2()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9_2', 'Transplant programs that perform living donor transplants use clinical and psychological selection criteria to determine the suitability of potential living donors.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_9_2()
    {
        return $this->get_property('hospital_9_2')->get_value();
    }

    public function set_cop_9_3()
    {
        $property = new \Orm_Property_Fixedtext('cop_9_3', '<b>Standard COP.9.3</b>');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_cop_9_3()
    {
        return $this->get_property('cop_9_3')->get_value();
    }

    public function set_hospital_9_3()
    {
        $property = new \Orm_Property_Fixedtext('hospital_9_3', 'Individualized patient care plans guide the care of living donors.');
        $property->set_group('group_9');
        $this->set_property($property);
    }

    public function get_hospital_9_3()
    {
        return $this->get_property('hospital_9_3')->get_value();
    }

}
