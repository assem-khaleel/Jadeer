<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr14;

/**
 * Description of Eligibility_Requirements
 *
 * @author laith
 */
class Eligibility_Requirements extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $code = 'Eligibility_Programmatic';
    protected $name = 'Eligibility Requirements for an Application for Program Accreditation (ER)';
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
        $childrens[] = new Eligibility_Checklist();
        $childrens[] = new Eligibility_Requirements_Signature();


        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<p>The process for accreditation of a Program involves a rigorous self evaluation in relation to the eleven standards specified by the NCAAA followed by an independent external review. In that external review a panel of experts will verify the conclusions of the Program’s self evaluation and consider the quality of performance in relation to the NCAAA standards.</p>
             <br/>
            <p>Before program accreditation site visit process begins, the NCAAA must be satisfied that certain requirements are met. These requirements relate to core elements in the standards for quality assurance and accreditation, and to compliance with the terms and conditions of its official approval or (for a private institution) its license to operate.</p>
             <br/>
            <p>The major steps involved are:</p>
            <div style="border-style:double; padding:5px;">
                <strong>Step 1: </strong>
                <p> Completion of an initial self-evaluation scales by the Program in relation to standards for accreditation. Application by a program including a letter of certification that it:</p>
                <ol type="a">
                    <li>Believes those standards are met, and</li>
                    <li>Meets eligibility requirements</li>
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
                <p>Completion of a Self Study Report for Programs (SSRP) using the criteria and processes specified by the NCAAA. This is normally a 9 to 12 month process. NCAAA will provide ongoing advice during this period to ensure full understanding of requirements.</p>
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
            </div>
            <p>Accreditation is public recognition that necessary standards are met in the management and delivery of a program, and the quality of learning outcomes is achieved by students. The standards must exceed or be equivalent to what is done in high quality international programs</p>
            <p>The process for accreditation of a program involves a rigorous self evaluation in relation to the eleven standards specified by the NCAAA, followed by an independent external review. In the external review a panel of experts will verify the conclusions of the program self evaluation and consider the quality of performance in relation to the NCAAA standards.</p>
            <div style="margin-top: -5px; text-align: center;"><strong>Relationship to Institutional Accreditation:</strong></div>
            <p>Criteria for program accreditation relate primarily to the program concerned. However, the quality of a program and the evidence that is required for accreditation depend to a considerable extent on processes within the institution as a whole. These may be beyond the control of those managing the program but they still affect its quality and must be considered in program evaluation. Consequently, the NCAAA requires an institutional accreditation review as a whole before going on to accredit individual programs.</p>
            <p>It is important to recognize that if a program is to be accredited ALL the standards required must be met, regardless of who is responsible for delivering particular services.</p>
            <p>If the institution has earned accreditation recognition by the NCAAA the institutional requirements will be assumed to have been met.</p>
            <div style="border-style:double; padding:5px;">
            <p style="color:red;">There are extra-ordinary circumstances when special arrangements related to program eligibility for accreditation are made by the NCAAA if the institution has not yet been accredited. These institutional requirements are provided below (see Minimum Institutional Requirements for Eligibility for Program Accreditation and page 10).</p>
            </div>');

        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function tree_item_actions(\Orm_Tree_Item &$tree_item)
    {

        if ($this->check_if_can_manage()) {
            $tree_item->add_action('fa fa-th', '/accreditation/add_institutional_requirement/' . $this->get_id(), 'title="' . lang('Add').' '.lang('Institutional Requirement') . '"');
        }

        parent::tree_item_actions($tree_item);
    }

}
