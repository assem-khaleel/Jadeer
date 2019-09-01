<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_1_part_2_f
 *
 * @author laith
 */
class Aacsb_Section_1_part_2_F extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard F';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info('');
            $this->set_basis('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>All degree programs included in the AACSB accounting accreditation review must demonstrate continuing adherence to the AACSB accounting accreditation standards and applicable business accreditation standards. Accounting academic units are expected to maintain and provide accurate information in support of each accreditation review. [POLICY ON CONTINUED ADHERENCE TO STANDARDS AND INTEGRITY OF SUBMISSIONS TO AACSB]</strong>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_basis()
    {
        $property = new \Orm_Property_Fixedtext('basis', 'All degree programs included in the AACSB accounting accreditation review must demonstrate continuing adherence to the AACSB business and accounting accreditation standards and processes. After an institution’s accounting academic unit achieves accreditation, AACSB reserves the right to request a review of that institution’s accredited accounting academic unit at any time if questions arise concerning the continuation of educational quality as defined by the standards. In addition, accounting academic units are expected to maintain and provide accurate information in support of each accreditation review.<br/><br/>'
            . 'Deliberate misrepresentation of information presented to AACSB in support of a business or accounting accreditation review shall be grounds for the appropriate committee to recommend the immediate denial of an accounting academic unit’s initial application for accreditation, or, in the case of a continuous improvement review, the revocation of an accounting academic unit’s membership in the Accreditation Council.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_basis()
    {
        return $this->get_property('basis')->get_value();
    }

}
