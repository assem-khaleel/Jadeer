<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_5_appendix_5
 *
 * @author laith
 */
class Asiinp_5_Appendix_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.5 Guidelines for the self-assessment of higher education institutions for stage 1 of two-stage procedures';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'If a two-stage accreditation procedure is carried out, at stage 1 of the procedure a self-assessment of the programme model (e.g. combined programmes) or the overarching structures for programmes takes place, initially independent of disciplinary assessments. For Higher Education Institutions undergoing a two-stage procedure a guide for producing the self-assessment of the programme model (stage 1 of the procedure) is available from the ASIIN office');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
