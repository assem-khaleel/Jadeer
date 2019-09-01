<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_2_requirments_3
 *
 * @author laith
 */
class Asiinp_2_Requirements_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.3 Requirements for degree programmes with a special outline';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Degree programmes with a special outline may include dual/cooperative programmes, combined programmes such as teacher training or dual subject programmes, project programmes, e-learning and distance learning, intensive programmes or binational and multinational programmes. <br/> <br/>'
            . 'The general requirements listed in section 2.2, as well as the procedural directions documented in this brochure (section 3), apply for all types of programmes. <br/> <br/>'
            . 'If ASIIN considers it necessary to ensure an adequate assessment, supplementary criteria will be published as separate documents on ASIIN’s website. As with all questions regarding criteria and procedures, the agency’s head office will provide further information as required. <br/> <br/>'
            . 'Furthermore, when the seal of German Accreditation Council is awarded, its specific rules for special types of degree programmes apply. <br/> <br/>'
            . 'For accreditation procedures for combined programmes (such as teacher training degrees), the appropriate procedural rules and regulations may be found in section 3.1 (procedure types) and section 5.5 (guidelines for two-stage procedures) of this document.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
