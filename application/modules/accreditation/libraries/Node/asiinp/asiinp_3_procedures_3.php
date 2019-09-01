<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_3_procedures_3
 *
 * @author laith
 */
class Asiinp_3_Procedures_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.3 Request submission';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'As the basis for the entire accreditation procedure, the requesting institution provides documentation which includes two central aspects: <br/> <br/>'
            . '1. A self-assessment in regard to how and to what extent the requirements for the accreditation of the degree programmes and the award of the seal(s) applied are fulfilled; <br/> <br/>'
            . '2. Documentation of the statements made in the self-assessment or that the requirements for accreditation are met. <br/> <br/>'
            . 'For the self-assessment, the higher education institution should provide a critical presentation of its state of development and draw conclusions as to the extent to which its own objectives have been met and how these objectives correspond to external requirements. An institution that demonstrates its ability to critically examine its own organisation or degree programmes has passed a central hurdle on the path to acquiring an accreditation seal. <br/> <br/>'
            . 'Wherever possible, the documentation for an accreditation procedure should not be specially produced, with the exception of the self-assessment. ASIIN assumes that the documents used are essentially the same as those employed within the institution for internal communication and quality management of the degree programmes. If necessary, they may be adapted for the accreditation procedure in order to make them understandable to outsiders, and presented in a way which clearly shows their applicability for the accreditation. <br/> <br/>'
            . 'In the interests of all those involved with the procedure at the higher education institution and within the agency, descriptions should be kept as short as possible, the self-assessment should be specific, brief and precise, and only information which is relevant to the requirements for accreditation should be included in the application. <br/> <br/>'
            . 'It is also important that the documentation be consistent and coherent, and this can be achieved by systematically dealing with the applicable requirements. If it is a reaccreditation, it will be important to demonstrate the changes that have occurred over the prior accreditation period. <br/> <br/>'
            . 'In the procedure for reaccreditation, it is also important to show how recommendations from the previous accreditation have been dealt with in the meantime. In order to acquire the seal of the German Accreditation Council, it is also important to ensure that its rules for the accreditation of degree programmes, which may subsequently have changed, are adhered to in their applicable version. <br/> <br/>'
            . 'ASIIN has a set of templates for the outline of the self-assessment which can be provided by the ASIIN office upon request. <br/> <br/>'
            . 'In the case of <b>cluster procedures</b>, where degree programmes in related subject areas are audited together in bundles, ASIIN requires <b>integrated self-assessment/documentation</b> which contains information that applies to several programmes only once, and provides specific information on individual programmes in a clear manner (for instance, by further subdividing the report or having separate report sections). <br/> <br/>'
            . 'The application should be kept as brief as possible. It will be needed in both electronic form and hard copy (1 copy for each peer and 1 copy for the office).');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
