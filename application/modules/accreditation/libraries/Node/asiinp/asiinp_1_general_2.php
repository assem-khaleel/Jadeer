<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_1_general_2
 *
 * @author laith
 */
class Asiinp_1_General_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '1.2 Seal of accreditation';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'In the course of an ASIIN programme accreditation procedure, several quality seals may be awarded if the decision for the programme concerned is positive.'
            . ' <br/> <br/>Generally, all higher education institutions are awarded the agency-specific ASIIN seal for each programme that passes the accreditation as carried out by ASIIN e. V. through its accreditation commission for degree programmes, regardless of the country in which the higher education institution is located. The seal is always based on the European Standards and Guidelines (ESG).'
            . ' <br/> <br/>Within the scope of responsibility of the German Accreditation Council ( Foundation for the Accreditation of Study Programmes in Germany) , ASIIN e. V. grants that body’s seal in accordance with its applicable rules. Higher Education Institutions which award degrees according to German law, may also apply to ASIIN if they only seek the seal of the German Accreditation Council. To obtain the seal of the Accreditation Council in Germany only its regulations apply. The Subject-Specific Criteria (SSC) of ASIIN are not applied for the award of the seal of the German Accreditation Council.'
            . ' <br/> <br/>If the accreditation commission’s decision is positive, additional seals may be granted for degree programmes depending on the procedure’s scope, legal basis and authority in other countries. In Switzerland and the Netherlands, for instance, the national accreditation system relies on preparatory work up to and including the final recommendation carried out by an agency such as ASIIN; the actual accreditation decision with national validity then falls under the responsibility of the national bodies.'
            . ' <br/> <br/>If the programme meets the applicable requirements, an ASIIN programme accreditation procedure also allows for the awarding of specific subject-related quality seals (so-called “labels”) – but only in addition to the ASIIN seal. More details on subject-specific quality seals may be found on the ASIIN e. V. website (www.asiin.de). ASIIN e. V.’s office will also be more than happy to provide you with additional information and material.'
            . ' <br/> <br/>The higher education institution decides which of the above-mentioned seals it is seeking in an ASIIN accreditation procedure and indicates this decision accordingly in its accreditation application.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
