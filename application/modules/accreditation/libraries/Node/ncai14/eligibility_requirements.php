<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai14;
use Node\ncassr14\Eligibility_Requirements_Signature;

/**
 * Description of Eligibility_Requirements
 *
 * @author laith
 */
class Eligibility_Requirements extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Eligibility Requirements for an Application for Institutional Accreditation (ER)';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_send_to_review = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Eligibility_Requirements_1();
        $childrens[] = new Eligibility_Requirements_2();
        $childrens[] = new Eligibility_Requirements_3();
        $childrens[] = new Eligibility_Requirements_4();
        $childrens[] = new Eligibility_Requirements_5();
        $childrens[] = new Eligibility_Requirements_6();
        $childrens[] = new Eligibility_Requirements_7();
        $childrens[] = new Eligibility_Requirements_8();
        $childrens[] = new Eligibility_Requirements_9();
        $childrens[] = new Eligibility_Requirements_10();
        $childrens[] = new Eligibility_Requirements_11();
        $childrens[] = new Eligibility_Requirements_12();
        $childrens[] = new Eligibility_Requirements_13();
        $childrens[] = new Eligibility_Requirements_14();
        $childrens[] = new Eligibility_Requirements_15();
        $childrens[] = new Eligibility_Requirements_16();
        $childrens[] = new Eligibility_Requirements_17();
        $childrens[] = new Eligibility_Requirements_18();
        $childrens[] = new Eligibility_Requirements_19();
        $childrens[] = new Eligibility_Checklist();
        $childrens[] = new Eligibility_Requirements_Signature();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<p>The process for accreditation of an institution involves a rigorous self evaluation in relation to the eleven standards specified by the NCAAA followed by an independent external review. In that external review a panel of experts will verify the conclusions of the institution’s self evaluation and consider the quality of performance in relation to the NCAAA standards.</p>
             <br/>
            <p>Before this process begins the NCAAA must be satisfied that certain requirements are met. These requirements relate to core elements in the standards for quality assurance and accreditation, and in compliance with the terms and conditions of its official approval or for a private institution, its license to operate.</p>
             <br/>
            <p>The major steps involved are:</p>
            <div style="border-style:double; padding:5px;">
                <strong>Step 1: </strong>
                <p>Completion of an initial self-evaluation scales by the institution in relation to standards for accreditation. Application by the institution including a letter of certification that it: </p>
                <ol type="a">
                    <li>Believes those standards are met, and</li>
                    <li>Meets eligibility requirements.</li>
                </ol>
            </div>
            <div style="margin-top: -5px; text-align: center;">↓</div>
            <div style="border-style:double; padding:5px;">
                <strong>Step 2: </strong>
                <p>Acceptance of the application by the NCAAA and scheduling of dates for review.</p>
            </div>
            <div style="margin-top: -5px; text-align: center;">↓</div>
            <div style="border-style:double; padding:5px;">
                <strong>Step 3: </strong>
                <p>Completion of a Self Study Report for Institutions (SSRI) using the criteria and processes specified by the NCAAA. This is normally a 9 to 12 month process. NCAAA will provide ongoing advice during this period to ensure full understanding of requirements.</p>
            </div>
            <div style="margin-top: -5px; text-align: center;">↓</div>
            <div style="border-style:double; padding:5px;">
                <strong>Step 4: </strong>
                <p>Independent external review arranged by the NCAAA, including a site visit by a review panel.</p>
            </div>
            <div style="margin-top: -5px; text-align: center;">↓</div>
            <div style="border-style:double; padding:5px; margin-bottom:15px">
                <strong>Step 5: </strong>
                <p>Decision on accreditation by the NCAAA after considering the recommendations of the external review panel.</p>
            </div>
            <div>
                <p>Details of requirements for a self study and the external review process are included in Part (3) of</p>
                <strong><i>Handbook for Quality Assurance and Accreditation of Higher Education Institutions.</i></strong>
            </div>');

        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
