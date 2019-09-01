<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_3_procedures_5
 *
 * @author laith
 */
class Asiinp_3_Procedures_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.5 Role and function of project managers';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'The peers and ASIIN’s committees carry out their accreditation tasks on a pro bono basis. However, the overall coordination of a procedure is carried out by a full-time project manager at the ASIIN office. <br/> <br/>'
            . 'ASIIN project managers coordinate and organise the accreditation procedure. They ensure that the relevant rules are followed in each procedure, are responsible for time management and the adherence to deadlines, and provide support to everyone involved in the procedure, answering questions based on their experience and background knowledge. Project managers are present with the peers during the visit and at all committee meetings. They produce draft reports, proposals and documentation for the procedure. Throughout the procedure, they also support the higher education institution seeking accreditation as the contact person within ASIIN. <br/> <br/>'
            . 'Thus, project managers manage the information between institution(s), peers and other committees involved. <br/> <br/>'
            . 'To be considered relevant and to be taken into account for the procedure, procedure-related communication between institutions, auditors and committee has to pass through the ASIIN office.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
