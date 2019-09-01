<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_3_procedures_7
 *
 * @author laith
 */
class Asiinp_3_Procedures_7 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.7 Extending an accreditation period';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<b>Extension where a reaccreditation is planned</b> <br/>'
            . '<br/>If a request is made to reaccredit a programme up to six weeks before the previous accreditation expires, the Accreditation Commission may decide to extend the accreditation until renewal if the reaccreditation procedure is to be implemented by ASIIN. This prevents gaps in the validity of a programme’s accreditation. <br/> If this rule is applied under the seal of the German Accreditation Council, its relevant deadlines and conditions must be adhered to <br/> <br/>'
            . '<b>Extension for the run-down period when a programme is closed</b> <br/> <br/>If a higher education institution is not going to continue a programme which has previously received accreditation, and ASIIN has taken a final accreditation decision, the existing accreditation may be extended for the duration of the degrees of students who were matriculated when the validity of the accreditation expired, upon request of the institution. The relevant conditions are: <br/>'
            . '<ol type="1">'
            . '<li>The programme was closed before the accreditation period expired.</li>'
            . '<li>The institution can substantiate that the programme will not differ significantly from the accredited programme.</li>'
            . '<li>The required staff and infrastructure will continue to be available.</li>'
            . '</ol>'
            . '<br/> If this rule is applied under the seal of the German Accreditation Council, its relevant deadlines and conditions must be adhered to.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
