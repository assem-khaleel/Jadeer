<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_1_apr
 *
 * @author ahmadgx
 */
class Jci_Section_1_Apr extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Accreditation Participation Requirements (APR)';
    protected $link_view = true;
    protected $link_edit = false;

    public function init()
    {
        parent::init();

            $this->set_introduction('');
            $this->set_requirement_1('');
            $this->set_apr_1('');
            $this->set_requirement_2('');
            $this->set_apr_2('');
            $this->set_requirement_3('');
            $this->set_apr_3('');
            $this->set_requirement_4('');
            $this->set_apr_4('');
            $this->set_requirement_5('');
            $this->set_apr_5('');
            $this->set_requirement_6('');
            $this->set_apr_6('');
            $this->set_requirement_7('');
            $this->set_apr_7('');
            $this->set_requirement_8('');
            $this->set_apr_8('');
            $this->set_requirement_9('');
            $this->set_apr_9('');
            $this->set_requirement_10('');
            $this->set_apr_10('');
            $this->set_requirement_11('');
            $this->set_apr_11('');
            $this->set_requirement_12('');
            $this->set_apr_12('');
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', '<b>Overview</b> <br/>'
            . 'This section, new to this accreditation manual, consists of specific requirements for participation in the Joint Commission International accreditation process and for maintaining an accreditation award. <br/> <br/>'
            . 'For a hospital seeking accreditation for the first time, compliance with many of the APRs is assessed during the initial survey. For the already-accredited hospital, compliance with the APRs is assessed throughout the accreditation cycle, through on-site surveys, the Strategic Improvement Plan (SIP), and periodic updates of hospital-specific data and information. <br/> <br/>'
            . 'Organizations are either compliant or not compliant with the APRs. When a hospital does not comply with certain APRs, the hospital may be asked to submit an SIP, or the noncompliance may result in being placed At Risk for Denial of Accreditation, or may lead to the loss of accreditation as with any refusal to permit performance of a survey. How the requirement is evaluated and the consequences of noncompliance are noted with each APR. <br/> <br/>'
            . 'Please note that the APR requirements are not scored similarly to the standards chapters, and their evaluation does not directly impact the outcome of an on-site initial or triennial accreditation survey. <br/> <br/>'
            . '<b>Requirements</b>');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

    public function set_requirement_1()
    {
        $property = new \Orm_Property_Fixedtext('requirement_1', '<b>Requirement: APR.1</b>');
        $this->set_property($property);
    }

    public function get_requirement_1()
    {
        return $this->get_property('requirement_1')->get_value();
    }

    public function set_apr_1()
    {
        $property = new \Orm_Property_Fixedtext('apr_1', 'The hospital meets all requirements for timely submissions of data and information to Joint Commission International (JCI).');
        $this->set_property($property);
    }

    public function get_apr_1()
    {
        return $this->get_property('apr_1')->get_value();
    }

    public function set_requirement_2()
    {
        $property = new \Orm_Property_Fixedtext('requirement_2', '<b>Requirement: APR.2</b>');
        $this->set_property($property);
    }

    public function get_requirement_2()
    {
        return $this->get_property('requirement_2')->get_value();
    }

    public function set_apr_2()
    {
        $property = new \Orm_Property_Fixedtext('apr_2', 'The hospital provides JCI with accurate and complete information through all phases of the accreditation process.');
        $this->set_property($property);
    }

    public function get_apr_2()
    {
        return $this->get_property('apr_2')->get_value();
    }

    public function set_requirement_3()
    {
        $property = new \Orm_Property_Fixedtext('requirement_3', '<b>Requirement: APR.3</b>');
        $this->set_property($property);
    }

    public function get_requirement_3()
    {
        return $this->get_property('requirement_3')->get_value();
    }

    public function set_apr_3()
    {
        $property = new \Orm_Property_Fixedtext('apr_3', 'The hospital reports within 15 days any changes in the hospital’s profile (electronic database) or information provided to JCI via the E-App before and between surveys.');
        $this->set_property($property);
    }

    public function get_apr_3()
    {
        return $this->get_property('apr_3')->get_value();
    }

    public function set_requirement_4()
    {
        $property = new \Orm_Property_Fixedtext('requirement_4', '<b>Requirement: APR.4</b>');
        $this->set_property($property);
    }

    public function get_requirement_4()
    {
        return $this->get_property('requirement_4')->get_value();
    }

    public function set_apr_4()
    {
        $property = new \Orm_Property_Fixedtext('apr_4', 'The hospital permits on-site evaluations of standards and policy compliance or verification of quality and safety concerns, reports, or regulatory authority sanctions at the discretion of JCI.');
        $this->set_property($property);
    }

    public function get_apr_4()
    {
        return $this->get_property('apr_4')->get_value();
    }

    public function set_requirement_5()
    {
        $property = new \Orm_Property_Fixedtext('requirement_5', '<b>Requirement: APR.5</b>');
        $this->set_property($property);
    }

    public function get_requirement_5()
    {
        return $this->get_property('requirement_5')->get_value();
    }

    public function set_apr_5()
    {
        $property = new \Orm_Property_Fixedtext('apr_5', 'The hospital allows JCI to request (from the hospital or outside agency) and review an original or authenticated copy of the results and reports of external evaluations from publicly recognized bodies.');
        $this->set_property($property);
    }

    public function get_apr_5()
    {
        return $this->get_property('apr_5')->get_value();
    }

    public function set_requirement_6()
    {
        $property = new \Orm_Property_Fixedtext('requirement_6', '<b>Requirement: APR.6</b>');
        $this->set_property($property);
    }

    public function get_requirement_6()
    {
        return $this->get_property('requirement_6')->get_value();
    }

    public function set_apr_6()
    {
        $property = new \Orm_Property_Fixedtext('apr_6', 'The hospital allows JCI Accreditation Program staff and members of JCI’s Board of Directors to observe the on-site survey.');
        $this->set_property($property);
    }

    public function get_apr_6()
    {
        return $this->get_property('apr_6')->get_value();
    }

    public function set_requirement_7()
    {
        $property = new \Orm_Property_Fixedtext('requirement_7', '<b>Requirement: APR.7</b>');
        $this->set_property($property);
    }

    public function get_requirement_7()
    {
        return $this->get_property('requirement_7')->get_value();
    }

    public function set_apr_7()
    {
        $property = new \Orm_Property_Fixedtext('apr_7', 'The hospital participates in the Joint Commission International Library of Measures quality improvement measurement system. The hospital’s leadership selects clinical measures from the Library applicable to the hospital’s patient populations and services. When Library measures are not applicable to the hospital’s patient populations and services, the hospital consults with JCI staff regarding an exemption from the measure requirements of APR.7. <br/> <br/>'
            . 'The hospital uses the current Library measure specifications and follows Library measure selection, use, and data submission requirements as found on the JCI Library of Measures website, which can be accessed directly from the JCI Direct Connect customer portal. The JCI Library of Measures website describes current requirements related to the following:'
            . '<ol type="1">'
            . '<li>Any required minimum number of measures sets or individual measures that must be selected and implemented</li>'
            . '<li>The process for obtaining an exemption from APR.7 requirements when the Library measures are not applicable to the hospital’s patient populations and services provided</li>'
            . '<li>The collection and aggregation process for Library measure data</li>'
            . '<li>The effective date and the process for submission of quarterly discharge data</li>'
            . '<li>The use of Library measure data in the accreditation process</li>'
            . '<li>The criteria for determining continued use or replacement of Library measures</li>'
            . '<li>How data quality issues are to be managed</li>'
            . '</ol>');
        $this->set_property($property);
    }

    public function get_apr_7()
    {
        return $this->get_property('apr_7')->get_value();
    }

    public function set_requirement_8()
    {
        $property = new \Orm_Property_Fixedtext('requirement_8', '<b>Requirement: APR.8</b>');
        $this->set_property($property);
    }

    public function get_requirement_8()
    {
        return $this->get_property('requirement_8')->get_value();
    }

    public function set_apr_8()
    {
        $property = new \Orm_Property_Fixedtext('apr_8', 'The hospital accurately represents its accreditation status and the programs and services to which JCI accreditation applies.');
        $this->set_property($property);
    }

    public function get_apr_8()
    {
        return $this->get_property('apr_8')->get_value();
    }

    public function set_requirement_9()
    {
        $property = new \Orm_Property_Fixedtext('requirement_9', '<b>Requirement: APR.9</b>');
        $this->set_property($property);
    }

    public function get_requirement_9()
    {
        return $this->get_property('requirement_9')->get_value();
    }

    public function set_apr_9()
    {
        $property = new \Orm_Property_Fixedtext('apr_9', 'Any individual hospital staff member (clinical or administrative) can report concerns about patient safety and quality of care to JCI without retaliatory action from the hospital  <br/> <br/>'
            . 'To support this culture of safety, the hospital must communicate to staff that such reporting is permitted. In addition, the hospital must make it clear to staff that no formal disciplinary actions (for example, demotions, reassignments, or change in working conditions or hours) or informal punitive actions (for example, harassment, isolation, or abuse) will be threatened or carried out in retaliation for reporting concerns to JCI.');
        $this->set_property($property);
    }

    public function get_apr_9()
    {
        return $this->get_property('apr_9')->get_value();
    }

    public function set_requirement_10()
    {
        $property = new \Orm_Property_Fixedtext('requirement_10', '<b>Requirement: APR.10</b>');
        $this->set_property($property);
    }

    public function get_requirement_10()
    {
        return $this->get_property('requirement_10')->get_value();
    }

    public function set_apr_10()
    {
        $property = new \Orm_Property_Fixedtext('apr_10', 'Translation and interpretation services arranged by the hospital for an accreditation survey and any related activities are provided by licensed and/or qualified translation and interpretation professionals who have no relationship to the hospital.');
        $this->set_property($property);
    }

    public function get_apr_10()
    {
        return $this->get_property('apr_10')->get_value();
    }

    public function set_requirement_11()
    {
        $property = new \Orm_Property_Fixedtext('requirement_11', '<b>Requirement: APR.11</b>');
        $this->set_property($property);
    }

    public function get_requirement_11()
    {
        return $this->get_property('requirement_11')->get_value();
    }

    public function set_apr_11()
    {
        $property = new \Orm_Property_Fixedtext('apr_11', 'The hospital notifies the public it serves about how to contact its hospital management and JCI to report concerns about patient safety and quality of care. <br/> <br/>'
            . 'Methods of notice may include, but are not limited to, distribution of information about JCI, including contact information in published materials such as brochures and/or posting this information on the hospital’s website.');
        $this->set_property($property);
    }

    public function get_apr_11()
    {
        return $this->get_property('apr_11')->get_value();
    }

    public function set_requirement_12()
    {
        $property = new \Orm_Property_Fixedtext('requirement_12', '<b>Requirement: APR.12</b>');
        $this->set_property($property);
    }

    public function get_requirement_12()
    {
        return $this->get_property('requirement_12')->get_value();
    }

    public function set_apr_12()
    {
        $property = new \Orm_Property_Fixedtext('apr_12', 'The hospital provides patient care in an environment that poses no risk of an immediate threat to patient safety, public health, or staff safety.');
        $this->set_property($property);
    }

    public function get_apr_12()
    {
        return $this->get_property('apr_12')->get_value();
    }

}
