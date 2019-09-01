<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_4_basis
 *
 * @author laith
 */
class Asiinp_4_Basis extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4. Contractual basis';
    protected $link_pdf = true;
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'The cooperation between ASIIN e. V. and a higher education institution is based on a contract. This comes into force upon acceptance of ASIIN’s tender by the higher education institution or contracting party. <br/>'
            . 'The detailed conditions which define the form of this contractual relationship are derived from the tender provided by ASIIN and the General Terms and Conditions <b>(GTC)</b>. <br/>'
            . 'An essential aspect of the contract between ASIIN e. V. and a higher education institution is that it covers the execution of an accreditation procedure, but not the result. <br/>'
            . 'The accreditation procedure begins when the contract enters into force. <br/>'
            . 'ASIIN informs the respective seal owner(s) whose seal is involved in the procedure.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
