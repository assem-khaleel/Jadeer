<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\jci;

/**
 * Description of jci_section_4
 *
 * @author ahmadgx
 */
class Jci_Section_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Section IV: Academic Medical Center Hospital Standards';
    protected $link_pdf = true;
    protected $link_view = true;


    public function init()
    {
        parent::init();

            $this->set_info('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Jci_Section_4_Mpe();
        $childrens[] = new Jci_Section_4_Hrp();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'The Medical Professional Education (MPE) and Human Subjects Research Programs (HRP) standards for Academic Medical Center Hospitals were developed and first published in 2012 to recognize the unique resource such centers represent for health professional education and human subjects research in their community and country. These standards also present a framework for including medical education and human subjects research into the quality and patient safety activities of academic medical center hospitals. Unless deliberately included in the quality framework, education and research activities often are the unnoticed partners in patient care quality monitoring and improvement.'
            . ' <br/>The standards are divided into two chapters, as medical education and clinical research are most frequently organized and administered separately within academic medical centers. For all hospitals meeting the eligibility criteria in the “Summary of Key Accreditation Policies” section of this publication, compliance with the requirements in these two chapters, in addition to the other requirements detailed in this fifth edition manual, will result in an organization being deemed accredited under the Joint Commission International Standards for Academic Medical Center Hospitals.'
            . 'Organizations with questions about their eligibility for Academic Medical Center Hospital accreditation should contact JCI Accreditation’s Central Office at jciaccreditation@jcrinc.com.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info');
    }

}
