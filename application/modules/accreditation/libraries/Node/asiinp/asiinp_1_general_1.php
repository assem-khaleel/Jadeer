<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_1_general_1
 *
 * @author laith
 */
class Asiinp_1_General_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '1.1 Function of the general criteria';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'This document provides information regarding: <br/>'
            . '<ul type="circle">'
            . '<li>ASIIN’s approach to the accreditation of degree programmes;</li>'
            . '<li>Requirements a programme must meet in order to obtain one of the quality seals awarded by ASIIN;</li>'
            . '<li>The fundamental principles of ASIIN upon which the accreditation procedure is based.</li>'
            . '</ul>'
            . ' <br/>The ASIIN criteria are subject to revision at regular intervals in order to keep them up-to-date with the latest developments and knowledge in the field of accreditation. The version that was in force when the contract for a given accreditation procedure was signed is always the one used.'
            . ' <br/> <br/>In addition to the General Criteria for the accreditation of degree programmes (programme accreditation), ASIIN’s Technical Committees have drawn up Subject-Specific Criteria (SSC) for the individual disciplinary fields; they are published as separate documents to be used as a source of subject-specific orientation for the award of the disciplinary seal of ASIIN and the disciplinary European labels awarded by ASIIN.'
            . ' <br/> <br/>Within the area of programme accreditation, ASIIN concentrates on the assessment of degree programmes in engineering, architecture, informatics, natural sciences, mathematics, and interdisciplinary combinations of one of these subjects with other subject areas.'
            . ' <br/> <br/>The ASIIN’s General Criteria are defined and further developed in tandem with: national and international specialist academic organisations, faculty and specialist conferences, gatherings of faculty deans, organisations of higher education institutions, technical and professional associations, and important bodies involved in the industry.'
            . ' <br/> <br/>In all cases, ASIIN’s General Criteria take into account the European Standards and Guidelines (ESG) of the European Association for Quality Assurance in Higher Education (ENQA).'
            . ' <br/> <br/>If an ASIIN accreditation procedure is carried out with the aim of acquiring the national seal of the German Accreditation Council, its relevant requirements are the authoritative basis for the accreditation decision.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
