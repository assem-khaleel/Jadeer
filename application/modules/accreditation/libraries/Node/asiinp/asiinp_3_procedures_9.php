<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_3_procedures_9
 *
 * @author laith
 */
class Asiinp_3_Procedures_9 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.9 Procedure for the acquisition of additional seals';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'At the European and international level, ASIIN cooperates with a series of organisations which grant quality seals for degree programmes <br/>'
            . 'Therefore, if the result is positive, several seals can be awarded for a degree programme in a single accreditation procedure. This also includes the so-called “subject labels”. In these cases, ASIIN generally possesses an entitlement granted by a European or international association or network to award a subject-based quality seal as part of its own procedure if the corresponding requirements are met. <br/>'
            . 'The procedure and requirements for awarding the ASIIN seal form the basis for the procedure during which the responsible auditors and committees check that further specific requirements (depending on the seal or label sought) are fulfilled, and document their findings. The decision as to whether to grant each seal is then made separately, even if the assessment was carried out as part of a single procedure. <br/>'
            . 'The procedure <br/>'
            . '<ul type="circle">'
            . '<li>Is generally organised jointly with ASIIN’s accreditation procedure;</li>'
            . '<li>Even when carried out on its own/on a second-tier basis, always follows the process described in the available criteria, as well as the overall general criteria of ASIIN;</li>'
            . '<li>Is only carried out if specially requested by a higher education institution;</li>'
            . '<li>May lead to varying results (e.g. the ASIIN seal and the seal of the German Accreditation Council are granted, but not the seal of another organisation);</li>'
            . '<li>Is always based on the criteria for ASIIN’s accreditation procedure as well as additional criteria and requirements for the information to be submitted, as applicable.</li>'
            . '</ul>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
